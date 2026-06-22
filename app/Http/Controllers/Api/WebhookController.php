<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CrmClient;
use App\Models\DepartmentQueue;
use App\Services\OllamaAiService;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected $ollamaService;

    public function __construct(OllamaAiService $ollamaService)
    {
        $this->ollamaService = $ollamaService;
    }

    public function handleWhatsApp(Request $request)
    {
        // Simulasi validasi payload WhatsApp Webhook (contoh payload standar)
        $phoneNumber = $request->input('from') ?? $request->input('phone_number');
        $rawMessage = $request->input('body') ?? $request->input('message');

        if (!$phoneNumber || !$rawMessage) {
            return response()->json(['error' => 'Invalid payload. phone_number and message are required.'], 400);
        }

        Log::info("Menerima pesan WhatsApp dari {$phoneNumber}: {$rawMessage}");

        // 1. Ekstrak data menggunakan Ollama AI
        $extractedData = $this->ollamaService->extractCustomerRequest($rawMessage);

        if (!$extractedData) {
            return response()->json(['error' => 'AI failed to extract data.'], 500);
        }

        $clientName = $extractedData['nama_pelanggan'] ?? 'Pelanggan ' . $phoneNumber;
        $serviceRequested = $extractedData['layanan_diminta'] ?? 'Tidak diketahui';
        $priority = $extractedData['prioritas'] ?? 'Normal';

        // 2. Simpan atau cari Client di CRM (Berdasarkan nomor HP)
        $client = CrmClient::firstOrCreate(
            ['phone_number' => $phoneNumber],
            ['name' => $clientName]
        );

        // Update nama jika AI menemukan nama yang lebih baik dan nama sebelumnya default
        if (strpos($client->name, 'Pelanggan') !== false && $clientName !== 'Pelanggan ' . $phoneNumber && $clientName !== null) {
            $client->name = $clientName;
            $client->save();
        }

        // 3. Masukkan ke Antrean Departemen
        $queue = DepartmentQueue::create([
            'crm_client_id' => $client->id,
            'service_requested' => $serviceRequested,
            'priority' => $priority,
            'status' => 'Pending',
            'raw_message' => $rawMessage,
        ]);

        return response()->json([
            'message' => 'Pesanan berhasil diekstrak dan masuk antrean.',
            'client' => $client,
            'queue' => $queue,
            'ai_raw_extracted' => $extractedData
        ], 200);
    }
}
