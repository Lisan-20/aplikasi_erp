<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class AsesmenPerawatController extends Controller
{
    /**
     * Show the dynamic form for Asesmen Awal Umum
     */
    public function createAwal($no_kunjungan)
    {
        // Get patient data
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select(
                'tc_kunjungan.no_kunjungan',
                'tc_kunjungan.no_registrasi',
                'tc_kunjungan.no_mr',
                'tc_kunjungan.kode_bagian_tujuan as kode_bagian',
                'mt_master_pasien.nama_pasien',
                'mt_master_pasien.jen_kelamin',
                'mt_master_pasien.tgl_lhr',
                'mt_nasabah.nama_kelompok as nm_nasabah',
                'tc_registrasi.kode_kelompok'
            )
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)
            ->first();

        if (!$pasien) {
            abort(404, 'Kunjungan tidak ditemukan');
        }

        // Hitung Umur
        $tgl_lhr = Carbon::parse($pasien->tgl_lhr);
        $pasien->umur = $tgl_lhr->diffInYears(Carbon::now());

        // Fetch existing answers if this is an edit
        $existingAnswersRaw = DB::table('tc_pemeriksaan_erm')
            ->where('no_kunjungan', $no_kunjungan)
            ->get();

        $existingAnswers = [];
        foreach ($existingAnswersRaw as $ans) {
            // Because one kd_periksa can have hasil and hasil2
            $existingAnswers[$ans->kode_pemeriksaan] = [
                'hasil' => $ans->hasil,
                'hasil2' => $ans->hasil2
            ];
        }

        // Fetch Psikososial Fields (kd_periksa 95100 - 95599)
        $psikososial = DB::table('mt_acc_erm')
            ->whereBetween('kd_periksa', [95100, 95599])
            ->orderBy('kd_periksa')
            ->get();

        // Fetch Fisik Fields (kd_periksa 10000 - 10399)
        $fisik = DB::table('mt_acc_erm')
            ->whereBetween('kd_periksa', [10000, 10399])
            ->orderBy('kd_periksa')
            ->get();

        // Fetch Skala Nyeri Fields - sesuai range DB aktual:
        // Wong Baker Faces (Skala Wajah) : 36000-36999
        // Numeric Rating Scale           : 38000-38999
        // FLACC                          : 13000-13999
        // CPOT                           : 14000-14999
        // NIPS                           : 12000-12999
        $skalaNyeri = DB::table('mt_acc_erm')
            ->where(function($q) {
                $q->whereBetween('kd_periksa', [36000, 36999]) // Wong Baker
                  ->orWhereBetween('kd_periksa', [38000, 38999]) // NRS
                  ->orWhereBetween('kd_periksa', [13000, 13999]) // FLACC
                  ->orWhereBetween('kd_periksa', [14000, 14999]) // CPOT
                  ->orWhereBetween('kd_periksa', [12000, 12999]); // NIPS
            })
            ->orderBy('kd_periksa')
            ->get();

        $resikoJatuh = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [16100, 16999])->orderBy('kd_periksa')->get();
        $skriningGizi = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [99000, 99499])->orderBy('kd_periksa')->get();
        $asuhanKeperawatan = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [10500, 10999])->orderBy('kd_periksa')->get();
        $dischargePlanning = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [15000, 15999])->orderBy('kd_periksa')->get();

        // Combine both to fetch details
        $allKdPeriksa = collect($psikososial)->pluck('kd_periksa')
            ->merge(collect($fisik)->pluck('kd_periksa'))
            ->merge(collect($skalaNyeri)->pluck('kd_periksa'))
            ->merge(collect($resikoJatuh)->pluck('kd_periksa'))
            ->merge(collect($skriningGizi)->pluck('kd_periksa'))
            ->merge(collect($asuhanKeperawatan)->pluck('kd_periksa'))
            ->merge(collect($dischargePlanning)->pluck('kd_periksa'))
            ->toArray();

        // Fetch Dropdown options (mt_acc_erm_det)
        $detailsRaw = DB::table('mt_acc_erm_det')
            ->whereIn('kd_periksa', $allKdPeriksa)
            ->orderBy('id_mt_kd_det')
            ->get();

        $details = [];
        foreach ($detailsRaw as $d) {
            if (!isset($details[$d->kd_periksa])) {
                $details[$d->kd_periksa] = [];
            }
            $details[$d->kd_periksa][] = $d;
        }

        // Map existing answers and details into questions
        $mapQuestions = function($questions) use ($details, $existingAnswers) {
            return $questions->map(function($q) use ($details, $existingAnswers) {
                $q->options = $details[$q->kd_periksa] ?? [];
                
                $ans = $existingAnswers[$q->kd_periksa] ?? null;
                // If answer exists, use it. Else fallback to value_3 (default input value)
                $q->answer = $ans ? $ans['hasil'] : ($q->kd_type == '1' || $q->kd_type == '3' || $q->kd_type == '5' ? $q->value_3 : '');
                $q->answer2 = $ans ? $ans['hasil2'] : ($q->kd_type == '3' && $q->kd_kk == '1' ? $q->value_3 : '');
                return $q;
            });
        };

        $emr = DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->pluck('kode_rm')->toArray();
        $radiogroup = '1';
        if (in_array(64, $emr)) $radiogroup = '1';
        elseif (in_array(66, $emr)) $radiogroup = '2';
        elseif (in_array(53, $emr)) $radiogroup = '3';
        elseif (in_array(54, $emr)) $radiogroup = '4';
        elseif (in_array(52, $emr)) $radiogroup = '5';

        return Inertia::render('Poli/Asesmen/AsesmenAwalForm', [
            'pasien' => $pasien,
            'psikososial' => $mapQuestions(collect($psikososial)),
            'fisik' => $mapQuestions(collect($fisik)),
            'skalaNyeri' => $mapQuestions(collect($skalaNyeri)),
            'resikoJatuh' => $mapQuestions(collect($resikoJatuh)),
            'skriningGizi' => $mapQuestions(collect($skriningGizi)),
            'asuhanKeperawatan' => $mapQuestions(collect($asuhanKeperawatan)),
            'dischargePlanning' => $mapQuestions(collect($dischargePlanning)),
            'radiogroup_val' => $radiogroup,
            'mode' => count($existingAnswersRaw) > 0 ? 'edit' : 'create'
        ]);
    }

    /**
     * Store answers and auto-calculate
     */
    public function storeAwal(Request $request)
    {
        $no_kunjungan = $request->no_kunjungan;
        $no_registrasi = $request->no_registrasi;
        $no_mr = $request->no_mr;
        $kode_bagian = $request->kode_bagian;
        $answers = $request->answers; // array of answers
        $radiogroup = $request->radiogroup;

        DB::beginTransaction();
        try {
            DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->whereIn('kode_rm', [64, 66, 53, 54, 52])->delete();
            // Hapus data skala nyeri sesuai range aktual di database
            DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)
                ->where(function($q) {
                    $q->whereBetween('kode_pemeriksaan', [36000, 36999]) // Wong Baker
                      ->orWhereBetween('kode_pemeriksaan', [38000, 38999]) // NRS
                      ->orWhereBetween('kode_pemeriksaan', [13000, 13999]) // FLACC
                      ->orWhereBetween('kode_pemeriksaan', [14000, 14999]) // CPOT
                      ->orWhereBetween('kode_pemeriksaan', [12000, 12999]); // NIPS
                })->delete();
            $kode_rm = 64;
            if ($radiogroup == '1') $kode_rm = 64;
            elseif ($radiogroup == '2') $kode_rm = 66;
            elseif ($radiogroup == '3') $kode_rm = 53;
            elseif ($radiogroup == '4') $kode_rm = 54;
            elseif ($radiogroup == '5') $kode_rm = 52;
            DB::table('tc_emr_form')->insert([
                'no_kunjungan' => $no_kunjungan,
                'kode_rm' => $kode_rm,
            ]);
            // Delete all answers for this kunjungan within the relevant kd_periksa range to handle removed fields
            // Or just updateOrInsert which is safer for not deleting other assessments.
            foreach ($answers as $ans) {
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(
                    [
                        'no_kunjungan' => $no_kunjungan,
                        'kode_pemeriksaan' => $ans['kd_periksa']
                    ],
                    [
                        'no_registrasi' => $no_registrasi,
                        'no_mr' => $no_mr,
                        'kode_bagian' => $kode_bagian,
                        'id_mt_kd' => $ans['id_mt_kd'] ?? null,
                        'nama_pemeriksaan' => $ans['nama_pemeriksaan'] ?? null,
                        'hasil' => $ans['answer'] ?? null,
                        'hasil2' => $ans['answer2'] ?? null,
                        'kd_lev' => $ans['kd_lev'] ?? null,
                        'kd_type' => $ans['kd_type'] ?? null,
                        'ket' => $ans['ket'] ?? null,
                        'sekor' => $ans['sekor'] ?? 0,
                    ]
                );
            }

            // ==========================
            // BMI Calculation
            // ==========================
            $tinggi = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '10216')->value('hasil');
            $berat = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '10215')->value('hasil');
            
            if ($tinggi && $berat && is_numeric($tinggi) && is_numeric($berat) && $tinggi > 0) {
                $tinggi_cm = $tinggi / 100;
                $bmi = $berat / ($tinggi_cm * $tinggi_cm);
                
                $hasil_bmi = "Normal";
                if ($bmi < 18.5) {
                    $hasil_bmi = "Underweight";
                } elseif ($bmi >= 18.5 && $bmi < 23) {
                    $hasil_bmi = "Normal";
                } elseif ($bmi >= 23 && $bmi < 25) {
                    $hasil_bmi = "Overweight";
                } elseif ($bmi >= 25) {
                    $hasil_bmi = "Obese";
                }

                DB::table('tc_pemeriksaan_erm')->updateOrInsert(
                    ['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '10217'],
                    ['hasil' => number_format($bmi, 2), 'ket_hasil_bmi' => $hasil_bmi]
                );
            }

            // ==========================
            // SKOR UP AND GO (16101 - 16104)
            // ==========================
            $var_a = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '16101')->where('hasil', '1')->count();
            $var_b = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '16102')->where('hasil', '1')->count();
            $var_cdef = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '16104')->where('hasil', '1')->count();

            if ($var_a == 0 && $var_b == 0) {
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '16201'], ['hasil' => 'Ya']);
            } elseif ($var_a > 0 && $var_b > 0) {
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '16202'], ['hasil' => 'Ya']);
            } elseif (($var_a > 0 && $var_b > 0) || $var_cdef > 0) {
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '16202'], ['hasil' => 'Ya']);
            } elseif ($var_a > 0 || $var_b > 0) {
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '16203'], ['hasil' => 'Ya']);
            }

            // ==========================
            // SKOR NUTRISI
            // ==========================
            DB::table('tc_pemeriksaan_erm')
                ->where('no_kunjungan', $no_kunjungan)
                ->where('kd_type', '2')
                ->where('hasil', '2')
                ->whereIn('kode_pemeriksaan', [99101, 99104, 99105, 99106, 99107, 99108, 99109, 99110])
                ->update(['sekor' => 0]);

            $tot_skor = DB::table('tc_pemeriksaan_erm')
                ->where('no_kunjungan', $no_kunjungan)
                ->where('kode_pemeriksaan', 'like', '99%')
                ->sum('sekor');
                
            DB::table('tc_pemeriksaan_erm')->updateOrInsert(
                ['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '99301'],
                ['hasil' => $tot_skor, 'sekor' => $tot_skor]
            );

            // ==========================
            // EMR Forms & Radiogroup (Wajah/Numerik/FLACC)
            // ==========================
            $id_user = auth()->id() ?? 1;
            $dateNow = Carbon::now();

            $updateEmr = function($kode_rm) use ($no_kunjungan, $no_registrasi, $no_mr, $id_user, $dateNow) {
                DB::table('tc_emr_form')->updateOrInsert(
                    ['no_registrasi' => $no_registrasi, 'kode_rm' => $kode_rm],
                    ['no_kunjungan' => $no_kunjungan, 'no_mr' => $no_mr, 'tgl_update' => $dateNow, 'id_user' => $id_user]
                );
            };

            if ($radiogroup == '1') {
                $updateEmr(64);
            } elseif ($radiogroup == '2') {
                $updateEmr(66);
            } elseif ($radiogroup == '3') {
                DB::table('tc_pemeriksaan_erm')
                    ->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', 'like', '13%')
                    ->where('kd_type', '2')->where(function($query) {
                        $query->where('hasil', '')->orWhereNull('hasil')->orWhere('hasil', '2');
                    })->update(['sekor' => 0]);
                $tot_flacc = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', 'like', '13%')->sum('sekor');
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '13601'], ['hasil' => $tot_flacc, 'sekor' => $tot_flacc]);
                $updateEmr(53);
            } elseif ($radiogroup == '4') {
                DB::table('tc_pemeriksaan_erm')
                    ->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', 'like', '14%')
                    ->where('kd_type', '2')->where(function($query) {
                        $query->where('hasil', '')->orWhereNull('hasil')->orWhere('hasil', '2');
                    })->update(['sekor' => 0]);
                $tot_cpot = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', 'like', '14%')->sum('sekor');
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '14601'], ['hasil' => $tot_cpot, 'sekor' => $tot_cpot]);
                $updateEmr(54);
            } elseif ($radiogroup == '5') {
                DB::table('tc_pemeriksaan_erm')
                    ->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', 'like', '12%')
                    ->where('kd_type', '2')->where(function($query) {
                        $query->where('hasil', '')->orWhereNull('hasil')->orWhere('hasil', '2');
                    })->update(['sekor' => 0]);
                $tot_nips = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', 'like', '12%')->sum('sekor');
                DB::table('tc_pemeriksaan_erm')->updateOrInsert(['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '12701'], ['hasil' => $tot_nips, 'sekor' => $tot_nips]);
                $updateEmr(52);
            }

            $updateEmr(56); // Discharge Planning

            // Update tc_registrasi
            DB::table('tc_registrasi')->where('no_registrasi', $no_registrasi)->update([
                'st_ass_awal' => 1,
                'tgl_jam_ass_awal' => $dateNow,
                'id_user_perawat' => $id_user
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Asesmen Awal berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal menyimpan asesmen: ' . $e->getMessage());
        }
    }

    /**
     * Tampilan Cetak Asesmen Awal
     */
    public function printAwal($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select(
                'tc_kunjungan.no_kunjungan',
                'tc_kunjungan.no_registrasi',
                'tc_kunjungan.no_mr',
                'mt_master_pasien.nama_pasien',
                'mt_master_pasien.jen_kelamin',
                'mt_master_pasien.tgl_lhr',
                'mt_nasabah.nama_kelompok as nm_nasabah',
                'tc_registrasi.kode_kelompok'
            )
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)
            ->first();

        if (!$pasien) {
            abort(404, 'Kunjungan tidak ditemukan');
        }

        $tgl_lhr = Carbon::parse($pasien->tgl_lhr);
        $pasien->umur = $tgl_lhr->diffInYears(Carbon::now());

        $answers = DB::table('tc_pemeriksaan_erm')
            ->where('no_kunjungan', $no_kunjungan)
            ->get();

        // Get radiogroup choice
        $emr = DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->pluck('kode_rm')->toArray();
        $skala_nyeri = 'Wong Baker Faces';
        if (in_array(64, $emr)) $skala_nyeri = 'Wong Baker Faces';
        elseif (in_array(66, $emr)) $skala_nyeri = 'Numeric Rating Scale';
        elseif (in_array(53, $emr)) $skala_nyeri = 'FLACC';
        elseif (in_array(54, $emr)) $skala_nyeri = 'CPOT';
        elseif (in_array(52, $emr)) $skala_nyeri = 'NIPS';

        return Inertia::render('Poli/Asesmen/AsesmenAwalPrint', [
            'pasien' => $pasien,
            'answers' => $answers,
            'skala_nyeri' => $skala_nyeri,
            'petugas' => DB::table('dd_user')->where('id_dd_user', auth()->id() ?? 1)->value('nama_lengkap') ?? 'Perawat Poli'
        ]);
    }

    /**
     * FORM INPUT ASESMEN LANJUTAN
     */
    public function createLanjutan($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select(
                'tc_kunjungan.no_kunjungan',
                'tc_kunjungan.no_registrasi',
                'tc_kunjungan.no_mr',
                'tc_kunjungan.kode_bagian_tujuan as kode_bagian',
                'mt_master_pasien.nama_pasien',
                'mt_master_pasien.jen_kelamin',
                'mt_master_pasien.tgl_lhr',
                'mt_nasabah.nama_kelompok as nm_nasabah',
                'tc_registrasi.kode_kelompok'
            )
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)
            ->first();

        if (!$pasien) {
            abort(404, 'Kunjungan tidak ditemukan');
        }

        $tgl_lhr = Carbon::parse($pasien->tgl_lhr);
        $pasien->umur = $tgl_lhr->diffInYears(Carbon::now());

        $existingAnswers = DB::table('tc_pemeriksaan_erm')
            ->where('no_kunjungan', $no_kunjungan)
            ->get()
            ->keyBy('kode_pemeriksaan');

        $questions_lanjut1 = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [50000, 50299])->orderBy('kd_periksa')->get();
        $questions_asuhan = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [50300, 50999])->orderBy('kd_periksa')->get();
        $questions_discharge = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [15000, 15999])->orderBy('kd_periksa')->get();
        $skalaNyeri = DB::table('mt_acc_erm')
            ->where(function($q) {
                $q->whereBetween('kd_periksa', [36000, 36999])
                  ->orWhereBetween('kd_periksa', [38000, 38999])
                  ->orWhereBetween('kd_periksa', [13000, 13999])
                  ->orWhereBetween('kd_periksa', [14000, 14999])
                  ->orWhereBetween('kd_periksa', [12000, 12999]);
            })
            ->orderBy('kd_periksa')
            ->get();
        $resikoJatuh = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [16100, 16999])->orderBy('kd_periksa')->get();
        $skriningGizi = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [99000, 99499])->orderBy('kd_periksa')->get();

        $mapQuestions = function($questions) use ($existingAnswers) {
            $mapped = [];
            foreach ($questions as $q) {
                $options = [];
                if (in_array($q->kd_type, ['2', '5'])) {
                    $options = DB::table('mt_acc_erm_det')->where('kd_periksa', $q->kd_periksa)->get();
                }

                $ans = $existingAnswers->get($q->kd_periksa);

                $mapped[] = [
                    'kd_periksa' => $q->kd_periksa,
                    'id_mt_kd' => $q->id_mt_kd,
                    'nama_pemeriksaan' => $q->nama_pemeriksaan,
                    'kd_lev' => $q->kd_lev,
                    'kd_type' => $q->kd_type,
                    'kd_kk' => $q->kd_kk,
                    'ket' => $q->ket,
                    'options' => $options,
                    'answer' => $ans ? $ans->hasil : '',
                    'answer2' => $ans ? $ans->hasil2 : ''
                ];
            }
            return $mapped;
        };

        $emr = DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->pluck('kode_rm')->toArray();
        $radiogroup = '1';
        if (in_array(64, $emr)) $radiogroup = '1';
        elseif (in_array(66, $emr)) $radiogroup = '2';
        elseif (in_array(53, $emr)) $radiogroup = '3';
        elseif (in_array(54, $emr)) $radiogroup = '4';
        elseif (in_array(52, $emr)) $radiogroup = '5';

        return Inertia::render('Poli/Asesmen/AsesmenLanjutanForm', [
            'pasien' => $pasien,
            'lanjut1' => $mapQuestions($questions_lanjut1),
            'asuhan' => $mapQuestions($questions_asuhan),
            'discharge' => $mapQuestions($questions_discharge),
            'skalaNyeri' => $mapQuestions($skalaNyeri),
            'resikoJatuh' => $mapQuestions($resikoJatuh),
            'skriningGizi' => $mapQuestions($skriningGizi),
            'radiogroup_val' => $radiogroup,
            'mode' => 'create'
        ]);
    }

    /**
     * STORE ASESMEN LANJUTAN
     */
    public function storeLanjutan(Request $request)
    {
        $no_kunjungan = $request->no_kunjungan;
        $no_registrasi = $request->no_registrasi;
        $no_mr = $request->no_mr;
        $kode_bagian = $request->kode_bagian;
        $answers = $request->answers; 
        $radiogroup = $request->radiogroup; 

        DB::beginTransaction();
        try {
            DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->whereIn('kode_rm', [64, 66, 53, 54, 52])->delete();
            $kode_rm = 64;
            if ($radiogroup == '1') $kode_rm = 64;
            elseif ($radiogroup == '2') $kode_rm = 66;
            elseif ($radiogroup == '3') $kode_rm = 53;
            elseif ($radiogroup == '4') $kode_rm = 54;
            elseif ($radiogroup == '5') $kode_rm = 52;
            DB::table('tc_emr_form')->insert([
                'no_kunjungan' => $no_kunjungan,
                'kode_rm' => $kode_rm,
            ]);
            DB::table('tc_pemeriksaan_erm')
                ->where('no_kunjungan', $no_kunjungan)
                ->where(function($query) {
                    $query->whereBetween('kode_pemeriksaan', [50000, 50999])
                          ->orWhereBetween('kode_pemeriksaan', [15000, 15999])
                          ->orWhereBetween('kode_pemeriksaan', [36000, 36999])
                          ->orWhereBetween('kode_pemeriksaan', [38000, 38999])
                          ->orWhereBetween('kode_pemeriksaan', [13000, 13999])
                          ->orWhereBetween('kode_pemeriksaan', [14000, 14999])
                          ->orWhereBetween('kode_pemeriksaan', [12000, 12999]);
                })
                ->delete();

            $inserts = [];
            foreach ($answers as $ans) {
                if ($ans['answer'] !== '' || $ans['answer2'] !== '') {
                    $sekor = 0;
                    if ($ans['kd_type'] == '2' && in_array($ans['kd_periksa'], [99101, 99104, 99105, 99106, 99107, 99108, 99109, 99110])) {
                        if ($ans['answer'] == '2') {
                            $sekor = 0; 
                        }
                    }

                    $inserts[] = [
                        'kd_type' => $ans['kd_type'],
                        'kode_pemeriksaan' => $ans['kd_periksa'],
                        'nama_pemeriksaan' => $ans['nama_pemeriksaan'],
                        'hasil' => $ans['answer'],
                        'hasil2' => $ans['answer2'] ?? '',
                        'kd_lev' => $ans['kd_lev'],
                        'ket' => $ans['ket'],
                        'sekor' => $sekor,
                        'no_kunjungan' => $no_kunjungan,
                        'no_registrasi' => $no_registrasi,
                        'id_mt_kd' => $ans['id_mt_kd'],
                        'kode_bagian' => $kode_bagian,
                        'no_mr' => $no_mr,
                    ];
                }
            }

            if (!empty($inserts)) {
                DB::table('tc_pemeriksaan_erm')->insert($inserts);
            }

            // Hitung Ulang BMI
            $tinggi = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '50209')->value('hasil');
            $berat = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->where('kode_pemeriksaan', '50208')->value('hasil');
            if ($tinggi && $berat && $tinggi > 0) {
                $tinggi_cm = $tinggi / 100;
                $bmi = $berat / ($tinggi_cm * $tinggi_cm);
                $hasil_bmi = "Normal";
                if ($bmi < 18.5) $hasil_bmi = "Underweight";
                elseif ($bmi >= 23 && $bmi < 25) $hasil_bmi = "Overweight";
                elseif ($bmi >= 25) $hasil_bmi = "Obese";

                DB::table('tc_pemeriksaan_erm')->updateOrInsert(
                    ['no_kunjungan' => $no_kunjungan, 'kode_pemeriksaan' => '50211'],
                    [
                        'nama_pemeriksaan' => 'BMI',
                        'kd_type' => '3',
                        'kd_lev' => '2',
                        'no_registrasi' => $no_registrasi,
                        'kode_bagian' => $kode_bagian,
                        'no_mr' => $no_mr,
                        'hasil' => number_format($bmi, 2),
                        'ket_hasil_bmi' => $hasil_bmi
                    ]
                );
            }

            // Radiogroup Nyeri
            if ($radiogroup) {
                $kode_rm = null;
                if ($radiogroup == '1') $kode_rm = 64;
                elseif ($radiogroup == '2') $kode_rm = 66;
                elseif ($radiogroup == '3') $kode_rm = 53;
                elseif ($radiogroup == '4') $kode_rm = 54;
                elseif ($radiogroup == '5') $kode_rm = 52;

                if ($kode_rm) {
                    DB::table('tc_emr_form')->updateOrInsert(
                        ['no_registrasi' => $no_registrasi, 'kode_rm' => $kode_rm],
                        [
                            'no_mr' => $no_mr,
                            'no_kunjungan' => $no_kunjungan,
                            'tgl_update' => Carbon::now(),
                            'id_user' => Session::get('id_dd_user') ?? auth()->id() ?? 1
                        ]
                    );
                }
            }

            // Update status lanjut di tc_registrasi
            DB::table('tc_registrasi')->where('no_registrasi', $no_registrasi)->update([
                'st_ass_awal_lanjutan' => 1,
                'tgl_jam_ass_awal_lanjutan' => Carbon::now(),
                'id_user_perawat' => Session::get('id_dd_user') ?? auth()->id() ?? 1
            ]);

            DB::table('mt_master_pasien')->where('no_mr', $no_mr)->update(['st_resum' => 1]);

            DB::commit();
            return redirect()->back()->with('success', 'Asesmen Lanjutan berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal menyimpan asesmen lanjutan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilan Cetak Asesmen Lanjutan
     */
    public function printLanjutan($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select(
                'tc_kunjungan.no_kunjungan',
                'tc_kunjungan.no_registrasi',
                'tc_kunjungan.no_mr',
                'mt_master_pasien.nama_pasien',
                'mt_master_pasien.jen_kelamin',
                'mt_master_pasien.tgl_lhr',
                'mt_nasabah.nama_kelompok as nm_nasabah',
                'tc_registrasi.kode_kelompok'
            )
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)
            ->first();

        if (!$pasien) {
            abort(404, 'Kunjungan tidak ditemukan');
        }

        $tgl_lhr = Carbon::parse($pasien->tgl_lhr);
        $pasien->umur = $tgl_lhr->diffInYears(Carbon::now());

        $answers = DB::table('tc_pemeriksaan_erm')
            ->where('no_kunjungan', $no_kunjungan)
            ->get();

        $emr = DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->pluck('kode_rm')->toArray();
        $skala_nyeri = 'Wong Baker Faces';
        if (in_array(64, $emr)) $skala_nyeri = 'Wong Baker Faces';
        elseif (in_array(66, $emr)) $skala_nyeri = 'Numeric Rating Scale';
        elseif (in_array(53, $emr)) $skala_nyeri = 'FLACC';
        elseif (in_array(54, $emr)) $skala_nyeri = 'CPOT';
        elseif (in_array(52, $emr)) $skala_nyeri = 'NIPS';

        return Inertia::render('Poli/Asesmen/AsesmenLanjutanPrint', [
            'pasien' => $pasien,
            'answers' => $answers,
            'skala_nyeri' => $skala_nyeri,
            'petugas' => DB::table('dd_user')->where('id_dd_user', auth()->id() ?? 1)->value('nama_lengkap') ?? 'Perawat Poli'
        ]);
    }

    /**
     * Helper mapping untuk form
     */
    private function mapQuestions($questions, $existingAnswers)
    {
        $mapped = [];
        foreach ($questions as $q) {
            $options = [];
            if (in_array($q->kd_type, ['2', '5'])) {
                $options = DB::table('mt_acc_erm_det')->where('kd_periksa', $q->kd_periksa)->get();
            }

            $ans = $existingAnswers->get($q->kd_periksa);

            $mapped[] = [
                'kd_periksa' => $q->kd_periksa,
                'id_mt_kd' => $q->id_mt_kd,
                'nama_pemeriksaan' => $q->nama_pemeriksaan,
                'kd_lev' => $q->kd_lev,
                'kd_type' => $q->kd_type,
                'kd_kk' => $q->kd_kk,
                'ket' => $q->ket,
                'options' => $options,
                'answer' => $ans ? $ans->hasil : '',
                'answer2' => $ans ? $ans->hasil2 : ''
            ];
        }
        return $mapped;
    }

    /**
     * FORM INPUT ASESMEN KANDUNGAN (ANC)
     */
    public function createANC($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select(
                'tc_kunjungan.no_kunjungan',
                'tc_kunjungan.no_registrasi',
                'tc_kunjungan.no_mr',
                'tc_kunjungan.kode_bagian_tujuan as kode_bagian',
                'mt_master_pasien.nama_pasien',
                'mt_master_pasien.jen_kelamin',
                'mt_master_pasien.tgl_lhr',
                'mt_nasabah.nama_kelompok as nm_nasabah',
                'tc_registrasi.kode_kelompok'
            )
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)
            ->first();

        if (!$pasien) abort(404, 'Kunjungan tidak ditemukan');

        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());

        $existingAnswers = DB::table('tc_pemeriksaan_erm')
            ->where('no_kunjungan', $no_kunjungan)
            ->get()
            ->keyBy('kode_pemeriksaan');

        $questions_psikososial = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [95100, 95599])->orderBy('kd_periksa')->get();
        $questions_anc = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [20000, 20499])->orderBy('kd_periksa')->get();
        $questions_jatuh = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [16100, 16199])->orderBy('kd_periksa')->get();
        $questions_gizi = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [99300, 99399])->orderBy('kd_periksa')->get();
        $questions_asuhan = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [20500, 20999])->orderBy('kd_periksa')->get();
        $questions_discharge = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [15000, 15999])->orderBy('kd_periksa')->get();

        $skalaNyeri = DB::table('mt_acc_erm')
            ->where(function($q) {
                $q->whereBetween('kd_periksa', [36000, 36999])
                  ->orWhereBetween('kd_periksa', [38000, 38999])
                  ->orWhereBetween('kd_periksa', [13000, 13999])
                  ->orWhereBetween('kd_periksa', [14000, 14999])
                  ->orWhereBetween('kd_periksa', [12000, 12999]);
            })
            ->orderBy('kd_periksa')
            ->get();

        return Inertia::render('Poli/Asesmen/AsesmenANCForm', [
            'pasien' => $pasien,
            'psikososial' => $this->mapQuestions($questions_psikososial, $existingAnswers),
            'anc' => $this->mapQuestions($questions_anc, $existingAnswers),
            'jatuh' => $this->mapQuestions($questions_jatuh, $existingAnswers),
            'gizi' => $this->mapQuestions($questions_gizi, $existingAnswers),
            'asuhan' => $this->mapQuestions($questions_asuhan, $existingAnswers),
            'discharge' => $this->mapQuestions($questions_discharge, $existingAnswers),
            'skalaNyeri' => $this->mapQuestions($skalaNyeri, $existingAnswers),
        ]);
    }

    public function storeANC(Request $request)
    {
        $no_kunjungan = $request->no_kunjungan;
        $no_registrasi = $request->no_registrasi;
        $no_mr = $request->no_mr;
        $kode_bagian = $request->kode_bagian;
        $answers = $request->answers; 
        $radiogroup = $request->radiogroup; 

        DB::beginTransaction();
        try {
            DB::table('tc_pemeriksaan_erm')
                ->where('no_kunjungan', $no_kunjungan)
                ->where(function($query) {
                    $query->whereBetween('kode_pemeriksaan', [95100, 95599])
                          ->orWhereBetween('kode_pemeriksaan', [20000, 20999])
                          ->orWhereBetween('kode_pemeriksaan', [16100, 16199])
                          ->orWhereBetween('kode_pemeriksaan', [99300, 99399])
                          ->orWhereBetween('kode_pemeriksaan', [15000, 15999])
                          ->orWhereBetween('kode_pemeriksaan', [36000, 36999])
                          ->orWhereBetween('kode_pemeriksaan', [38000, 38999])
                          ->orWhereBetween('kode_pemeriksaan', [13000, 13999])
                          ->orWhereBetween('kode_pemeriksaan', [14000, 14999])
                          ->orWhereBetween('kode_pemeriksaan', [12000, 12999]);
                })
                ->delete();

            $inserts = [];
            foreach ($answers as $ans) {
                if ($ans['answer'] !== '' || $ans['answer2'] !== '') {
                    $inserts[] = [
                        'kd_type' => $ans['kd_type'],
                        'kode_pemeriksaan' => $ans['kd_periksa'],
                        'nama_pemeriksaan' => $ans['nama_pemeriksaan'],
                        'hasil' => $ans['answer'],
                        'hasil2' => $ans['answer2'] ?? '',
                        'kd_lev' => $ans['kd_lev'],
                        'ket' => $ans['ket'],
                        'sekor' => 0,
                        'no_kunjungan' => $no_kunjungan,
                        'no_registrasi' => $no_registrasi,
                        'id_mt_kd' => $ans['id_mt_kd'],
                        'kode_bagian' => $kode_bagian,
                        'no_mr' => $no_mr,
                    ];
                }
            }

            if (!empty($inserts)) DB::table('tc_pemeriksaan_erm')->insert($inserts);

            // Nyeri
            if ($radiogroup) {
                $kode_rm = [1=>64, 2=>66, 3=>53, 4=>54, 5=>52][$radiogroup] ?? null;
                if ($kode_rm) {
                    DB::table('tc_emr_form')->updateOrInsert(
                        ['no_registrasi' => $no_registrasi, 'kode_rm' => $kode_rm],
                        ['no_mr' => $no_mr, 'no_kunjungan' => $no_kunjungan, 'tgl_update' => Carbon::now(), 'id_user' => auth()->id() ?? 1]
                    );
                }
            }

            DB::table('tc_registrasi')->where('no_registrasi', $no_registrasi)->update([
                'st_ass_perawat_ANC' => 1,
                'tgl_jam_ass_perawat_ANC' => Carbon::now(),
                'id_user_perawat_ANC' => auth()->id() ?? 1
            ]);
            DB::table('mt_master_pasien')->where('no_mr', $no_mr)->update(['st_resum' => 1]);

            DB::commit();
            return redirect()->back()->with('success', 'Asesmen ANC berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function printANC($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_mr', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();
        if (!$pasien) abort(404);
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        
        return Inertia::render('Poli/Asesmen/AsesmenANCPrint', [
            'pasien' => $pasien,
            'answers' => DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->get(),
            'petugas' => DB::table('dd_user')->where('id_dd_user', auth()->id() ?? 1)->value('nama_lengkap') ?? 'Perawat Poli'
        ]);
    }

    /**
     * FORM INPUT ASESMEN KANDUNGAN (PNC)
     */
    public function createPNC($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_registrasi', 'tc_kunjungan.no_mr', 'tc_kunjungan.kode_bagian_tujuan as kode_bagian', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr', 'mt_nasabah.nama_kelompok as nm_nasabah', 'tc_registrasi.kode_kelompok')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();

        if (!$pasien) abort(404, 'Kunjungan tidak ditemukan');
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        $existingAnswers = DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->get()->keyBy('kode_pemeriksaan');

        $skalaNyeri = DB::table('mt_acc_erm')
            ->where(function($q) {
                $q->whereBetween('kd_periksa', [36000, 36999])
                  ->orWhereBetween('kd_periksa', [38000, 38999])
                  ->orWhereBetween('kd_periksa', [13000, 13999])
                  ->orWhereBetween('kd_periksa', [14000, 14999])
                  ->orWhereBetween('kd_periksa', [12000, 12999]);
            })
            ->orderBy('kd_periksa')
            ->get();

        return Inertia::render('Poli/Asesmen/AsesmenPNCForm', [
            'pasien' => $pasien,
            'psikososial' => $this->mapQuestions(DB::table('mt_acc_erm')->whereBetween('kd_periksa', [95100, 95599])->orderBy('kd_periksa')->get(), $existingAnswers),
            'pnc' => $this->mapQuestions(DB::table('mt_acc_erm')->whereBetween('kd_periksa', [83000, 83299])->orderBy('kd_periksa')->get(), $existingAnswers),
            'jatuh' => $this->mapQuestions(DB::table('mt_acc_erm')->whereBetween('kd_periksa', [16100, 16199])->orderBy('kd_periksa')->get(), $existingAnswers),
            'gizi' => $this->mapQuestions(DB::table('mt_acc_erm')->whereBetween('kd_periksa', [99300, 99399])->orderBy('kd_periksa')->get(), $existingAnswers),
            'asuhan' => $this->mapQuestions(DB::table('mt_acc_erm')->whereBetween('kd_periksa', [83300, 83999])->orderBy('kd_periksa')->get(), $existingAnswers),
            'discharge' => $this->mapQuestions(DB::table('mt_acc_erm')->whereBetween('kd_periksa', [15000, 15999])->orderBy('kd_periksa')->get(), $existingAnswers),
            'skalaNyeri' => $this->mapQuestions($skalaNyeri, $existingAnswers),
        ]);
    }

    public function storePNC(Request $request)
    {
        $no_kunjungan = $request->no_kunjungan;
        $no_registrasi = $request->no_registrasi;
        $no_mr = $request->no_mr;
        $kode_bagian = $request->kode_bagian;
        $answers = $request->answers; 
        $radiogroup = $request->radiogroup; 

        DB::beginTransaction();
        try {
            DB::table('tc_pemeriksaan_erm')
                ->where('no_kunjungan', $no_kunjungan)
                ->where(function($query) {
                    $query->whereBetween('kode_pemeriksaan', [95100, 95599])
                          ->orWhereBetween('kode_pemeriksaan', [83000, 83999])
                          ->orWhereBetween('kode_pemeriksaan', [16100, 16199])
                          ->orWhereBetween('kode_pemeriksaan', [99300, 99399])
                          ->orWhereBetween('kode_pemeriksaan', [15000, 15999])
                          ->orWhereBetween('kode_pemeriksaan', [36000, 36999])
                          ->orWhereBetween('kode_pemeriksaan', [38000, 38999])
                          ->orWhereBetween('kode_pemeriksaan', [13000, 13999])
                          ->orWhereBetween('kode_pemeriksaan', [14000, 14999])
                          ->orWhereBetween('kode_pemeriksaan', [12000, 12999]);
                })->delete();

            $inserts = [];
            foreach ($answers as $ans) {
                if ($ans['answer'] !== '' || $ans['answer2'] !== '') {
                    $inserts[] = [
                        'kd_type' => $ans['kd_type'], 'kode_pemeriksaan' => $ans['kd_periksa'], 'nama_pemeriksaan' => $ans['nama_pemeriksaan'],
                        'hasil' => $ans['answer'], 'hasil2' => $ans['answer2'] ?? '', 'kd_lev' => $ans['kd_lev'], 'ket' => $ans['ket'],
                        'sekor' => 0, 'no_kunjungan' => $no_kunjungan, 'no_registrasi' => $no_registrasi, 'id_mt_kd' => $ans['id_mt_kd'],
                        'kode_bagian' => $kode_bagian, 'no_mr' => $no_mr,
                    ];
                }
            }
            if (!empty($inserts)) DB::table('tc_pemeriksaan_erm')->insert($inserts);

            if ($radiogroup) {
                $kode_rm = [1=>64, 2=>66, 3=>53, 4=>54, 5=>52][$radiogroup] ?? null;
                if ($kode_rm) {
                    DB::table('tc_emr_form')->updateOrInsert(
                        ['no_registrasi' => $no_registrasi, 'kode_rm' => $kode_rm],
                        ['no_mr' => $no_mr, 'no_kunjungan' => $no_kunjungan, 'tgl_update' => Carbon::now(), 'id_user' => auth()->id() ?? 1]
                    );
                }
            }

            DB::table('tc_registrasi')->where('no_registrasi', $no_registrasi)->update([
                'st_ass_perawat_PNC' => 1,
                'tgl_jam_ass_perawat_PNC' => Carbon::now(),
                'id_user_perawat_PNC' => auth()->id() ?? 1
            ]);
            DB::table('mt_master_pasien')->where('no_mr', $no_mr)->update(['st_resum' => 1]);

            DB::commit();
            return redirect()->back()->with('success', 'Asesmen PNC berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function printPNC($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_mr', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();
        if (!$pasien) abort(404);
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        
        return Inertia::render('Poli/Asesmen/AsesmenPNCPrint', [
            'pasien' => $pasien,
            'answers' => DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->get(),
            'petugas' => DB::table('dd_user')->where('id_dd_user', auth()->id() ?? 1)->value('nama_lengkap') ?? 'Perawat Poli'
        ]);
    }

    /**
     * RIWAYAT KEHAMILAN
     */
    public function createRiwayatHamil($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_registrasi', 'tc_kunjungan.no_mr', 'tc_kunjungan.kode_bagian_tujuan as kode_bagian', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr', 'mt_nasabah.nama_kelompok as nm_nasabah', 'tc_registrasi.kode_kelompok')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();

        if (!$pasien) abort(404);
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        
        $existingAnswers = DB::table('tc_riwayat_hamil_det')->where('no_kunjungan', $no_kunjungan)->get()->keyBy('kode_pemeriksaan');
        $questions = DB::table('mt_acc_erm')->whereBetween('kd_periksa', [21300, 21399])->orderBy('kd_periksa')->get();

        return Inertia::render('Poli/Asesmen/RiwayatHamilForm', [
            'pasien' => $pasien,
            'riwayat' => $this->mapQuestions($questions, $existingAnswers),
        ]);
    }

    public function storeRiwayatHamil(Request $request)
    {
        $no_kunjungan = $request->no_kunjungan;
        $no_registrasi = $request->no_registrasi;
        $no_mr = $request->no_mr;
        $kode_bagian = $request->kode_bagian;
        $answers = $request->answers;

        DB::beginTransaction();
        try {
            $riwayat = DB::table('tc_riwayat_hamil')->where('no_kunjungan', $no_kunjungan)->first();
            if (!$riwayat) {
                $no_urut_hamil = DB::table('tc_riwayat_hamil')->max('no_urut_hamil') + 1;
                DB::table('tc_riwayat_hamil')->insert([
                    'no_urut_hamil' => $no_urut_hamil, 'no_kunjungan' => $no_kunjungan, 'no_registrasi' => $no_registrasi,
                    'kode_bagian' => $kode_bagian, 'no_mr' => $no_mr, 'tgl_jam' => Carbon::now(), 'user_id' => auth()->id() ?? 1
                ]);
            } else {
                $no_urut_hamil = $riwayat->no_urut_hamil;
            }

            DB::table('tc_riwayat_hamil_det')->where('no_kunjungan', $no_kunjungan)->delete();

            $inserts = [];
            foreach ($answers as $ans) {
                if ($ans['answer'] !== '' || $ans['answer2'] !== '') {
                    $inserts[] = [
                        'no_urut_hamil' => $no_urut_hamil, 'no_kunjungan' => $no_kunjungan, 'no_registrasi' => $no_registrasi,
                        'kd_type' => $ans['kd_type'], 'kode_pemeriksaan' => $ans['kd_periksa'], 'nama_pemeriksaan' => $ans['nama_pemeriksaan'],
                        'hasil' => $ans['answer'], 'kd_lev' => $ans['kd_lev'], 'ket' => $ans['ket']
                    ];
                }
            }
            if (!empty($inserts)) DB::table('tc_riwayat_hamil_det')->insert($inserts);

            DB::table('tc_emr_form')->updateOrInsert(
                ['no_registrasi' => $no_registrasi, 'kode_rm' => 88],
                ['no_mr' => $no_mr, 'no_kunjungan' => $no_kunjungan, 'tgl_update' => Carbon::now(), 'id_user' => auth()->id() ?? 1]
            );

            DB::commit();
            return redirect()->back()->with('success', 'Riwayat Kehamilan berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal: ' . $e->getMessage());
        }
    }

    public function printRiwayatHamil($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_mr', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();
        if (!$pasien) abort(404);
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        
        return Inertia::render('Poli/Asesmen/RiwayatHamilPrint', [
            'pasien' => $pasien,
            'answers' => DB::table('tc_riwayat_hamil_det')->where('no_kunjungan', $no_kunjungan)->get()
        ]);
    }

    /**
     * PEMERIKSAAN LUAR
     */
    public function createPemLuar($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->leftJoin('mt_nasabah', 'tc_registrasi.kode_kelompok', '=', 'mt_nasabah.kode_kelompok')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_registrasi', 'tc_kunjungan.no_mr', 'tc_kunjungan.kode_bagian_tujuan as kode_bagian', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr', 'mt_nasabah.nama_kelompok as nm_nasabah', 'tc_registrasi.kode_kelompok')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();

        if (!$pasien) abort(404);
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        
        $existing = DB::table('tc_hasil_pemeriksaan_luar')->where('no_registrasi', $pasien->no_registrasi)->first();

        return Inertia::render('Poli/Asesmen/PemLuarForm', [
            'pasien' => $pasien,
            'existing' => $existing
        ]);
    }

    public function storePemLuar(Request $request)
    {
        $no_kunjungan = $request->no_kunjungan;
        $no_registrasi = $request->no_registrasi;
        $no_mr = $request->no_mr;
        $kesimpulan = $request->kesimpulan;
        
        DB::beginTransaction();
        try {
            $existing = DB::table('tc_hasil_pemeriksaan_luar')->where('no_registrasi', $no_registrasi)->first();
            $nama_dest = $existing ? $existing->nama_file : null;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $ext = $file->getClientOriginalExtension();
                $nama_dest = $no_registrasi . '.' . $ext;
                $file->storeAs('public/hasil_luar', $nama_dest);
            }

            if (!$existing) {
                DB::table('tc_hasil_pemeriksaan_luar')->insert([
                    'no_registrasi' => $no_registrasi, 'kesimpulan' => $kesimpulan, 'nama_file' => $nama_dest, 'kode_dokter' => auth()->id() ?? 1
                ]);
            } else {
                DB::table('tc_hasil_pemeriksaan_luar')->where('no_registrasi', $no_registrasi)->update([
                    'kesimpulan' => $kesimpulan, 'nama_file' => $nama_dest, 'kode_dokter' => auth()->id() ?? 1
                ]);
            }

            DB::table('tc_registrasi')->where('no_registrasi', $no_registrasi)->update(['st_ass_luar' => 1]);

            DB::table('tc_emr_form')->updateOrInsert(
                ['no_registrasi' => $no_registrasi, 'kode_rm' => 107],
                ['no_mr' => $no_mr, 'no_kunjungan' => $no_kunjungan, 'tgl_update' => Carbon::now(), 'id_user' => auth()->id() ?? 1]
            );

            DB::commit();
            return redirect()->back()->with('success', 'Pemeriksaan Luar berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function printPemLuar($no_kunjungan)
    {
        $pasien = DB::table('tc_kunjungan')
            ->join('tc_registrasi', 'tc_kunjungan.no_registrasi', '=', 'tc_registrasi.no_registrasi')
            ->join('mt_master_pasien', 'tc_kunjungan.no_mr', '=', 'mt_master_pasien.no_mr')
            ->select('tc_kunjungan.no_kunjungan', 'tc_kunjungan.no_registrasi', 'tc_kunjungan.no_mr', 'mt_master_pasien.nama_pasien', 'mt_master_pasien.jen_kelamin', 'mt_master_pasien.tgl_lhr')
            ->where('tc_kunjungan.no_kunjungan', $no_kunjungan)->first();
        if (!$pasien) abort(404);
        $pasien->umur = Carbon::parse($pasien->tgl_lhr)->diffInYears(Carbon::now());
        
        $existing = DB::table('tc_hasil_pemeriksaan_luar')->where('no_registrasi', $pasien->no_registrasi)->first();

        return Inertia::render('Poli/Asesmen/PemLuarPrint', [
            'pasien' => $pasien,
            'existing' => $existing,
            'petugas' => DB::table('dd_user')->where('id_dd_user', auth()->id() ?? 1)->value('nama_lengkap') ?? 'Perawat Poli'
        ]);
    }
}
