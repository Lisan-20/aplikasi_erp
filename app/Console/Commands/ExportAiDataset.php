<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExportAiDataset extends Command
{
    protected $signature = 'ai:export-kasir';

    protected $description = 'Mengekstrak riwayat transaksi kasir menjadi dataset JSONL untuk Fine-Tuning AI';

    public function handle()
    {
        $this->info('Memulai ekstraksi data historis transaksi kasir...');

        $transaksi = DB::table('tc_trans_kasir_detail as d')
            ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
            ->select('d.no_registrasi', 'b.nama_brg')
            ->orderBy('d.no_registrasi')
            ->get();

        $this->info('Ditemukan total '.count($transaksi).' item terjual.');

        $grouped = [];
        foreach ($transaksi as $t) {
            if (! isset($grouped[$t->no_registrasi])) {
                $grouped[$t->no_registrasi] = [];
            }
            $grouped[$t->no_registrasi][] = $t->nama_brg;
        }

        $this->info('Total transaksi (keranjang) unik: '.count($grouped));

        $jsonlData = '';
        $validTransactionCount = 0;

        foreach ($grouped as $no_reg => $items) {
            if (count($items) < 2) {
                continue;
            }

            $unique_items = array_values(array_unique($items));

            if (count($unique_items) < 2) {
                continue;
            }

            $target_item = array_pop($unique_items);
            $input_items_string = implode(', ', $unique_items);

            $system_prompt = 'Anda adalah asisten kasir cerdas di Sistem ERP. Tugas Anda adalah memberikan 1 rekomendasi barang (cross-selling/upselling) berdasarkan barang yang sedang dibeli oleh pelanggan.';
            $user_prompt = 'Pelanggan saat ini membeli barang berikut: ['.$input_items_string.']. Tolong rekomendasikan 1 barang terkait yang mungkin juga mereka butuhkan.';
            $assistant_response = 'Berdasarkan pola pembelian, pelanggan juga sering membeli: '.$target_item.'. Saya sangat merekomendasikan untuk menawarkannya.';

            $messageObj = [
                'messages' => [
                    ['role' => 'system', 'content' => $system_prompt],
                    ['role' => 'user', 'content' => $user_prompt],
                    ['role' => 'assistant', 'content' => $assistant_response],
                ],
            ];

            $jsonlData .= json_encode($messageObj)."\n";
            $validTransactionCount++;
        }

        $fileName = 'ai_dataset/kasir_finetune_'.date('Ymd_His').'.jsonl';
        Storage::disk('local')->put($fileName, $jsonlData);

        $this->info('Selesai! Berhasil membuat '.$validTransactionCount.' baris dataset pelatihan.');
        $this->info('File disimpan di: storage/app/'.$fileName);
    }
}
