import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function RiwayatHamilPrint({ pasien, answers }) {
    useEffect(() => {
        window.print();
    }, []);

    const renderRows = () => {
        return answers.map((a, i) => (
            <tr key={i}>
                <td width="5%" style={{ verticalAlign: 'top', textAlign: 'center' }}>{i + 1}.</td>
                <td width="35%" style={{ verticalAlign: 'top', paddingLeft: (a.kd_lev == 2 || a.kd_lev == 3) ? '20px' : '0' }}>{a.nama_pemeriksaan}</td>
                <td width="2%" style={{ verticalAlign: 'top' }}>:</td>
                <td width="58%" style={{ verticalAlign: 'top' }}>
                    <span>{a.hasil} {a.ket}</span>
                </td>
            </tr>
        ));
    };

    return (
        <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif', fontSize: '12px', color: '#000' }}>
            <Head title={`Cetak Riwayat Kehamilan - ${pasien.nama_pasien}`} />
            
            <table width="100%" style={{ borderBottom: '2px solid #000', marginBottom: '20px' }}>
                <tbody>
                    <tr>
                        <td width="60%">
                            <h2 style={{ margin: 0, fontSize: '18px' }}>Sistem ERP</h2>
                            <h3 style={{ margin: 0, fontSize: '14px' }}>RIWAYAT KEHAMILAN, PERSALINAN, DAN NIFAS</h3>
                        </td>
                        <td width="40%" style={{ border: '1px solid #000', padding: '5px' }}>
                            <table width="100%" cellPadding="2">
                                <tbody>
                                    <tr><td width="80">No. MR</td><td>: {pasien.no_mr}</td></tr>
                                    <tr><td>Nama</td><td>: {pasien.nama_pasien}</td></tr>
                                    <tr><td>Umur / Sex</td><td>: {pasien.umur} Th / {pasien.jen_kelamin}</td></tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}>
                <tbody>
                    {answers.length > 0 ? renderRows() : (
                        <tr><td colSpan="4" style={{ textAlign: 'center', padding: '20px' }}>Belum ada data riwayat kehamilan</td></tr>
                    )}
                </tbody>
            </table>

            <style>
                {`@media print { body { background: #fff; margin: 0; padding: 0; } }`}
            </style>
        </div>
    );
}
