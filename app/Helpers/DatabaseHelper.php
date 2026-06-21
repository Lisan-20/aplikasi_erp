<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

if (! function_exists('read_tabel')) {
    /**
     * Helper untuk mengambil record (setara dengan read_tabel lama)
     */
    function read_tabel($tabel, $field = '*', $kondisi = '')
    {
        $query = "SELECT $field FROM $tabel $kondisi";

        // Mengembalikan collection atau object DB yang mendukung iterasi FetchRow()
        // Di Laravel kita bisa pakai DB::select atau Query Builder
        return DB::select($query);
    }
}

if (! function_exists('baca_tabel')) {
    /**
     * Helper untuk mengambil single field (setara dengan baca_tabel lama)
     */
    function baca_tabel($tabel, $field, $kondisi = '')
    {
        $query = "SELECT $field FROM $tabel $kondisi LIMIT 1";
        $result = DB::selectOne($query);

        if ($result) {
            return $result->$field;
        }

        return null;
    }
}
