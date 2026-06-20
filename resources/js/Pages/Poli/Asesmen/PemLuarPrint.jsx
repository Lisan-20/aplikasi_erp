import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function PemLuarPrint({ pasien, existing, petugas }) {
    useEffect(() => {
        // Wait a bit for image to load before printing
        setTimeout(() => {
            window.print();
        }, 500);
    }, []);

    const imageUrl = existing?.nama_file ? `/storage/hasil_luar/${existing.nama_file}` : null;

    return (
        <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif', fontSize: '12px', color: '#000' }}>
            <Head title={`Cetak Pemeriksaan Luar - ${pasien.nama_pasien}`} />
            
            <table width="100%" style={{ borderBottom: '2px solid #000', marginBottom: '20px' }}>
                <tbody>
                    <tr>
                        <td width="60%">
                            <h2 style={{ margin: 0, fontSize: '18px' }}>Sistem ERP</h2>
                            <h3 style={{ margin: 0, fontSize: '14px' }}>HASIL PEMERIKSAAN LUAR</h3>
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

            <div style={{ marginBottom: '20px' }}>
                <h4 style={{ margin: '0 0 10px 0', borderBottom: '1px solid #ccc' }}>I. CATATAN / KESIMPULAN</h4>
                <p style={{ minHeight: '60px', padding: '10px', border: '1px solid #eee', borderRadius: '4px' }}>
                    {existing?.kesimpulan || '-'}
                </p>
            </div>

            <div style={{ marginBottom: '20px' }}>
                <h4 style={{ margin: '0 0 10px 0', borderBottom: '1px solid #ccc' }}>II. LAMPIRAN FOTO HASIL</h4>
                <div style={{ textAlign: 'center', padding: '20px', border: '1px solid #eee' }}>
                    {imageUrl ? (
                        <img src={imageUrl} alt="Lampiran Pemeriksaan Luar" style={{ maxWidth: '100%', maxHeight: '600px' }} />
                    ) : (
                        <p style={{ color: '#999' }}>Tidak ada lampiran foto</p>
                    )}
                </div>
            </div>

            <table width="100%" style={{ marginTop: '40px', pageBreakInside: 'avoid' }}>
                <tbody>
                    <tr>
                        <td width="60%"></td>
                        <td width="40%" style={{ textAlign: 'center' }}>
                            <p>Perawat</p><br /><br /><br /><p>( {petugas} )</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <style>
                {`@media print { body { background: #fff; margin: 0; padding: 0; } }`}
            </style>
        </div>
    );
}
