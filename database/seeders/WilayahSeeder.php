<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Master\MtErpNegara;

class WilayahSeeder extends Seeder
{
    private $urls = [
        'provinces' => 'https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/csv/provinces.csv',
        'regencies' => 'https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/csv/regencies.csv',
        'districts' => 'https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/csv/districts.csv',
        'villages' => 'https://raw.githubusercontent.com/edwardsamuel/Wilayah-Administratif-Indonesia/master/csv/villages.csv',
    ];

    public function run(): void
    {
        $this->command->info('Memulai Seeder Wilayah Indonesia...');

        // 1. Ensure Negara exists
        $negara = MtErpNegara::firstOrCreate(
            ['kode_negara' => 'ID'],
            ['nama_negara' => 'Indonesia', 'is_active' => true]
        );
        $negaraId = $negara->id;

        // 2. Download files
        $this->downloadFiles();

        // Arrays to keep mapping of kode -> new auto-increment ID
        $provinsiMap = [];
        $kotaMap = [];
        $kecamatanMap = [];

        // Clean tables to prevent duplicates if ran multiple times
        DB::statement('EXEC sp_MSforeachtable "ALTER TABLE ? NOCHECK CONSTRAINT all"');
        DB::table('mt_erp_kelurahan')->delete();
        DB::table('mt_erp_kecamatan')->delete();
        DB::table('mt_erp_kota')->delete();
        DB::table('mt_erp_provinsi')->delete();
        DB::statement('EXEC sp_MSforeachtable "ALTER TABLE ? WITH CHECK CHECK CONSTRAINT all"');

        // 3. Process Provinces
        $this->command->info('Memproses Provinsi...');
        $provinces = $this->readCSV('provinces.csv');
        DB::beginTransaction();
        foreach ($provinces as $row) {
            $id = DB::table('mt_erp_provinsi')->insertGetId([
                'negara_id' => $negaraId,
                'kode_provinsi' => $row[0],
                'nama_provinsi' => $row[1],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $provinsiMap[$row[0]] = $id;
        }
        DB::commit();

        // 4. Process Regencies
        $this->command->info('Memproses Kota/Kabupaten...');
        $regencies = $this->readCSV('regencies.csv');
        DB::beginTransaction();
        foreach ($regencies as $row) {
            if (count($row) >= 3) {
                $id = DB::table('mt_erp_kota')->insertGetId([
                    'provinsi_id' => $provinsiMap[$row[1]] ?? null,
                    'kode_kota' => $row[0],
                    'nama_kota' => $row[2],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $kotaMap[$row[0]] = $id;
            }
        }
        DB::commit();

        // 5. Process Districts
        $this->command->info('Memproses Kecamatan...');
        $districts = $this->readCSV('districts.csv');
        DB::beginTransaction();
        foreach ($districts as $row) {
            if (count($row) >= 3) {
                $id = DB::table('mt_erp_kecamatan')->insertGetId([
                    'kota_id' => $kotaMap[$row[1]] ?? null,
                    'kode_kecamatan' => $row[0],
                    'nama_kecamatan' => $row[2],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $kecamatanMap[$row[0]] = $id;
            }
        }
        DB::commit();

        // 6. Process Villages (Chunked)
        $this->command->info('Memproses Kelurahan (83.000+ baris, harap sabar)...');
        $villages = $this->readCSV('villages.csv');
        // SQL Server has a limit of 2100 parameters per query. 
        // We will use 100 rows per batch to be absolutely safe from ODBC limit.
        $chunks = array_chunk($villages, 100);
        $total = count($villages);
        $inserted = 0;
        $seenKelurahan = [];

        foreach ($chunks as $chunk) {
            $dataToInsert = [];
            foreach ($chunk as $row) {
                if (count($row) >= 3) {
                    $kode = $row[0];
                    if (!isset($seenKelurahan[$kode])) {
                        $seenKelurahan[$kode] = true;
                        $dataToInsert[] = [
                            'kecamatan_id' => $kecamatanMap[$row[1]] ?? null,
                            'kode_kelurahan' => $kode,
                            'nama_kelurahan' => rtrim($row[2]),
                            'kodepos' => null,
                            'is_active' => true,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
            DB::table('mt_erp_kelurahan')->insert($dataToInsert);
            $inserted += count($chunk);
            if ($inserted % 8000 === 0 || $inserted === $total) {
                $this->command->info("Tersimpan: {$inserted} / {$total} kelurahan...");
            }
        }

        $this->command->info('Seeding Wilayah Selesai!');
    }

    private function downloadFiles()
    {
        Storage::disk('local')->makeDirectory('wilayah');
        foreach ($this->urls as $name => $url) {
            $path = "wilayah/{$name}.csv";
            if (!Storage::disk('local')->exists($path)) {
                $this->command->info("Mengunduh {$name}.csv...");
                $content = Http::get($url)->body();
                Storage::disk('local')->put($path, $content);
            }
        }
    }

    private function readCSV($filename)
    {
        $path = storage_path("app/wilayah/{$filename}");
        $rows = [];
        if (($handle = fopen($path, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        }
        return $rows;
    }
}
