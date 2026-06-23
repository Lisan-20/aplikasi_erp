<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAiService
{
    protected $apiKey;

    protected $tunedModel;

    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
        $this->tunedModel = env('GEMINI_TUNED_MODEL', 'gemini-1.5-pro'); // fallback ke base model jika blm ada tuned model
    }

    /**
     * Memanggil Gemini API untuk mendapatkan rekomendasi berdasarkan keranjang
     */
    public function getRecommendation(array $cartItemNames)
    {
        if (empty($this->apiKey)) {
            Log::warning('GEMINI_API_KEY belum diatur di .env');

            return null;
        }

        if (count($cartItemNames) === 0) {
            return null;
        }

        $inputString = implode(', ', $cartItemNames);
        $userPrompt = 'Pelanggan saat ini membeli barang berikut: ['.$inputString.']. Tolong rekomendasikan 1 barang terkait yang mungkin juga mereka butuhkan.';

        $systemInstruction = 'Anda adalah asisten kasir cerdas di Sistem ERP. Tugas Anda adalah memberikan 1 rekomendasi barang (cross-selling/upselling) berdasarkan barang yang sedang dibeli oleh pelanggan. Balas HANYA dengan format JSON yang valid: {"rekomendasi": "NAMA BARANG"}. Dilarang memberikan penjelasan atau pemikiran (thought process).';

        $cleanTunedModel = trim($this->tunedModel);
        $cleanApiKey = trim($this->apiKey);
        $endpoint = $this->baseUrl.$cleanTunedModel.':generateContent?key='.$cleanApiKey;

        try {
            $response = Http::post($endpoint, [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $userPrompt],
                        ],
                    ],
                ],
                'systemInstruction' => [
                    'role' => 'system',
                    'parts' => [
                        ['text' => $systemInstruction],
                    ],
                ],
                'generationConfig' => [
                    'temperature' => 0.1,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                    'responseMimeType' => 'application/json',
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $jsonText = trim($data['candidates'][0]['content']['parts'][0]['text']);
                    $decoded = json_decode($jsonText, true);
                    $recommendationText = $decoded['rekomendasi'] ?? '';

                    if (! empty($recommendationText)) {
                        return $this->parseAndFetchItemDetails($recommendationText);
                    }
                }
            } else {
                Log::error('Gemini API Error: '.$response->body());
            }

        } catch (\Exception $e) {
            Log::error('Gemini API Exception: '.$e->getMessage());
        }

        return null;
    }

    /**
     * Mencari detail barang di database berdasarkan nama barang dari Gemini
     */
    private function parseAndFetchItemDetails($aiOutputName)
    {
        $cleanName = str_replace(['"', '\''], '', $aiOutputName);

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
                    'frequency' => 999, // dummy value to match UI format
                ],
            ];
        }

        return [];
    }
}
