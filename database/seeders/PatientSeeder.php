<?php

namespace Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'no_mr' => 'MR001',           // WAJIB
                'full_name' => 'Budi Santoso', // WAJIB (sebelumnya 'name')
                'birth_date' => '1985-05-20',
                'gender' => 'L',              // Harus 'L' atau 'P'
                'permanent_address' => 'Jl. Merdeka No. 123, Jakarta',
                'phone_mobile' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_mr' => 'MR002',
                'full_name' => 'Siti Aminah',
                'birth_date' => '1992-11-10',
                'gender' => 'P',
                'permanent_address' => 'Jl. Mawar No. 45, Bandung',
                'phone_mobile' => '085678901234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_mr' => 'MR003',
                'full_name' => 'Andi Wijaya',
                'birth_date' => '1978-02-15',
                'gender' => 'L',
                'permanent_address' => 'Jl. Diponegoro No. 7, Surabaya',
                'phone_mobile' => '087788990011',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('patients')->insert($patients);

        $this->command->info('Data pasien berhasil diinput sesuai struktur migrasi, San!');
    }
}
