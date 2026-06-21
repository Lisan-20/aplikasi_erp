<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Services\GeminiAiService;
use App\Services\OllamaAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AiController extends Controller
{
    protected $geminiService;

    protected $ollamaService;

    public function __construct(GeminiAiService $geminiService, OllamaAiService $ollamaService)
    {
        $this->geminiService = $geminiService;
        $this->ollamaService = $ollamaService;
    }

    public function getAiRecommendations(Request $request)
    {
        $cartItemCodes = $request->input('cart', []);

        if (empty($cartItemCodes)) {
            return response()->json([]);
        }

        // Ambil nama barang berdasarkan kode untuk dikirim ke AI
        $itemNames = DB::table('mt_barang_nm')
            ->whereIn('kode_brg', $cartItemCodes)
            ->pluck('nama_brg')
            ->toArray();

        $provider = env('AI_PROVIDER', 'gemini');
        $recommendation = null;

        if ($provider === 'ollama') {
            $recommendation = $this->ollamaService->getRecommendation($itemNames);
        } else {
            $recommendation = $this->geminiService->getRecommendation($itemNames);
        }

        if ($recommendation) {
            return response()->json($recommendation);
        }

        return response()->json([]);
    }
}
