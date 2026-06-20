import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function AsesmenAwalPrint({ pasien, answers, skala_nyeri, petugas }) {
    useEffect(() => {
        // Otomatis print ketika halaman dimuat
        window.print();
    }, []);

    // Helper to format answers
    const getAnswer = (kd_periksa) => {
        const ans = answers.find(a => a.kode_pemeriksaan == kd_periksa);
        return ans ? ans : null;
    };

    return (
        <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif', fontSize: '12px', color: '#000' }}>
            <Head title={`Cetak Asesmen Awal - ${pasien.nama_pasien}`} />
            
            <table width="100%" style={{ borderBottom: '2px solid #000', marginBottom: '20px' }}>
                <tbody>
                    <tr>
                        <td width="60%">
                            <h2 style={{ margin: 0, fontSize: '18px' }}>Sistem ERP</h2>
                            <h3 style={{ margin: 0, fontSize: '14px' }}>ASESMEN AWAL KEPERAWATAN</h3>
                        </td>
                        <td width="40%" style={{ border: '1px solid #000', padding: '5px' }}>
                            <table width="100%" cellPadding="2">
                                <tbody>
                                    <tr>
                                        <td width="80">No. MR</td>
                                        <td>: {pasien.no_mr}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: {pasien.nama_pasien}</td>
                                    </tr>
                                    <tr>
                                        <td>Umur / Sex</td>
                                        <td>: {pasien.umur} Th / {pasien.jen_kelamin}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>I. STATUS PSIKOSOSIAL & SPIRITUAL</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}>
                <tbody>
                    {answers.filter(a => a.kode_pemeriksaan >= 95100 && a.kode_pemeriksaan < 95600).map((a, i) => (
                        <tr key={i}>
                            <td width="40%" style={{ verticalAlign: 'top', paddingLeft: (a.kd_lev == 2 || a.kd_lev == 3) ? '20px' : '0' }}>
                                {a.nama_pemeriksaan}
                            </td>
                            <td width="2%" style={{ verticalAlign: 'top' }}>:</td>
                            <td width="58%" style={{ verticalAlign: 'top' }}>
                                {a.hasil} {a.hasil2 ? `/ ${a.hasil2}` : ''} {a.ket}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>II. PENGKAJIAN AWAL KEPERAWATAN</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}>
                <tbody>
                    <tr>
                        <td width="40%">Skala Nyeri yang Digunakan</td>
                        <td width="2%">:</td>
                        <td width="58%"><strong>{skala_nyeri}</strong></td>
                    </tr>
                    {answers.filter(a => a.kode_pemeriksaan >= 10000 && a.kode_pemeriksaan < 10400).map((a, i) => (
                        <tr key={i}>
                            <td style={{ verticalAlign: 'top', paddingLeft: (a.kd_lev == 2 || a.kd_lev == 3) ? '20px' : '0' }}>
                                {a.nama_pemeriksaan}
                            </td>
                            <td style={{ verticalAlign: 'top' }}>:</td>
                            <td style={{ verticalAlign: 'top' }}>
                                {a.kode_pemeriksaan == '10217' ? (
                                    <span>{a.hasil} ({a.ket_hasil_bmi || 'Normal'})</span>
                                ) : (
                                    <span>{a.hasil} {a.hasil2 ? `/ ${a.hasil2}` : ''} {a.ket}</span>
                                )}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <table width="100%" style={{ marginTop: '40px' }}>
                <tbody>
                    <tr>
                        <td width="60%"></td>
                        <td width="40%" style={{ textAlign: 'center' }}>
                            <p>Perawat yang Mengkaji</p>
                            <br /><br /><br />
                            <p>( {petugas} )</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <style>
                {`
                    @media print {
                        body { background: #fff; margin: 0; padding: 0; }
                    }
                `}
            </style>
        </div>
    );
}
