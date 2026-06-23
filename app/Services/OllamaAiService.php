<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OllamaAiService
{
    protected $apiUrl;

    protected $modelName;

    public function __construct()
    {
        $this->apiUrl = env('OLLAMA_API_URL', 'http://localhost:11434/api/generate');
        $this->modelName = env('OLLAMA_MODEL', 'gemma4:31b-cloud');
    }

    /**
     * Memanggil Ollama API untuk mendapatkan rekomendasi berdasarkan keranjang
     */
    public function getRecommendation(array $cartItemNames)
    {
        if (count($cartItemNames) === 0) {
            return null;
        }

        $inputString = implode(', ', $cartItemNames);
        $systemInstruction = 'Anda adalah asisten kasir cerdas di Sistem ERP. Tugas Anda adalah memberikan 1 rekomendasi barang (cross-selling/upselling) berdasarkan barang yang dibeli oleh pelanggan. Balas HANYA dengan format JSON yang valid: {"rekomendasi": "NAMA BARANG"}.';
        $userPrompt = 'Pelanggan membeli barang berikut: ['.$inputString.']. Tolong rekomendasikan 1 barang terkait.';

        try {
            $response = Http::timeout(30)->post($this->apiUrl, [
                'model' => $this->modelName,
                'system' => $systemInstruction,
                'prompt' => $userPrompt,
                'stream' => false,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['response'])) {
                    $jsonText = trim($data['response']);
                    Log::info('Ollama Raw Output: '.$jsonText);

                    // Bersihkan tag markdown ```json dan ``` jika Ollama mengirimkannya
                    $jsonText = preg_replace('/```json\s*/', '', $jsonText);
                    $jsonText = preg_replace('/```\s*/', '', $jsonText);
                    $jsonText = trim($jsonText);

                    $decoded = json_decode($jsonText, true);
                    $recommendationText = $decoded['rekomendasi'] ?? '';

                    if (! empty($recommendationText)) {
                        return $this->parseAndFetchItemDetails($recommendationText);
                    }
                }
            } else {
                Log::error('Ollama API Error: '.$response->body());
            }

        } catch (\Exception $e) {
            Log::error('Ollama API Exception: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Mencari detail barang di database berdasarkan nama barang dari AI
     */
    private function parseAndFetchItemDetails($aiOutputName)
    {
        $cleanName = str_replace(['"', '\''], '', $aiOutputName);

        // Ambil kata pertama saja agar pencarian SQL lebih longgar
        // Contoh: AI menjawab "MAP REKAM MEDIS", kita cari "%MAP%"
        $words = explode(' ', $cleanName);
        $searchKeyword = $words[0] ?? $cleanName;

        $barang = DB::table('mt_barang_jasa as b')
            ->join('mt_depo_stok_brg_jasa as s', 'b.kode_brg', '=', 's.kode_brg')
            ->where('s.kode_bagian', '070101')
            ->where('s.jml_sat_kcl', '>', 0)
            ->where('b.nama_brg', 'like', '%'.$searchKeyword.'%')
            ->select('b.kode_brg', 'b.nama_brg', 'b.harga_jual', 's.jml_sat_kcl', 'b.satuan_kecil')
            ->first();

        if ($barang) {
            return [
                [
                    'kode_brg' => $barang->kode_brg,
                    'nama_brg' => $barang->nama_brg,
                    'harga_jual' => $barang->harga_jual,
                    'jml_sat_kcl' => $barang->jml_sat_kcl,
                    'satuan_kecil' => $barang->satuan_kecil,
                    'frequency' => 999,
                ],
            ];
        }

        return [];
    }

    /**
     * Memanggil Ollama API untuk mengekstrak data dari pesan mentah WhatsApp
     */
    public function extractCustomerRequest(string $rawMessage)
    {
        if (empty(trim($rawMessage))) {
            return null;
        }

        $systemInstruction = 'Anda adalah AI ekstraktor data. Tugas Anda adalah mengekstrak data penting dari pesan WhatsApp pelanggan. Berikan respons HANYA dalam format JSON dengan struktur: {"nama_pelanggan": "nama atau null", "layanan_diminta": "deskripsi layanan atau null", "prioritas": "Normal atau High atau Urgent"}. Jika tidak disebutkan prioritas, default ke "Normal".';
        $userPrompt = 'Ekstrak data dari pesan pelanggan ini: "' . $rawMessage . '"';

        try {
            $response = Http::timeout(45)->post($this->apiUrl, [
                'model' => $this->modelName,
                'system' => $systemInstruction,
                'prompt' => $userPrompt,
                'stream' => false,
                'format' => 'json',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['response'])) {
                    $jsonText = trim($data['response']);
                    Log::info('Ollama Webhook Extraction Raw: '.$jsonText);

                    // Bersihkan markdown
                    $jsonText = preg_replace('/```json\s*/', '', $jsonText);
                    $jsonText = preg_replace('/```\s*/', '', $jsonText);
                    $jsonText = trim($jsonText);

                    return json_decode($jsonText, true);
                }
            } else {
                Log::error('Ollama API Error (Webhook): '.$response->body());
            }

        } catch (\Exception $e) {
            Log::error('Ollama API Exception (Webhook): '.$e->getMessage());
        }

        return null;
    }
}
