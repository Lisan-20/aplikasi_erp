import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function AsesmenANCPrint({ pasien, answers, petugas }) {
    useEffect(() => {
        window.print();
    }, []);

    const filterPemeriksaan = (min, max) => {
        return answers.filter(a => a.kode_pemeriksaan >= min && a.kode_pemeriksaan < max);
    };

    const renderRows = (dataList) => {
        return dataList.map((a, i) => (
            <tr key={i}>
                <td width="40%" style={{ verticalAlign: 'top', paddingLeft: (a.kd_lev == 2 || a.kd_lev == 3) ? '20px' : '0' }}>{a.nama_pemeriksaan}</td>
                <td width="2%" style={{ verticalAlign: 'top' }}>:</td>
                <td width="58%" style={{ verticalAlign: 'top' }}>
                    <span>{a.hasil} {a.hasil2 ? `/ ${a.hasil2}` : ''} {a.ket}</span>
                </td>
            </tr>
        ));
    };

    return (
        <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif', fontSize: '12px', color: '#000' }}>
            <Head title={`Cetak Asesmen ANC - ${pasien.nama_pasien}`} />
            
            <table width="100%" style={{ borderBottom: '2px solid #000', marginBottom: '20px' }}>
                <tbody>
                    <tr>
                        <td width="60%">
                            <h2 style={{ margin: 0, fontSize: '18px' }}>Sistem ERP</h2>
                            <h3 style={{ margin: 0, fontSize: '14px' }}>ASESMEN AWAL KEPERAWATAN (KANDUNGAN - ANC)</h3>
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

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>I. PSIKOSOSIAL & BUDAYA</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}><tbody>{renderRows(filterPemeriksaan(95100, 95600))}</tbody></table>

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>II. PENGKAJIAN ANC</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}><tbody>{renderRows(filterPemeriksaan(20000, 20500))}</tbody></table>

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>III. RISIKO JATUH & GIZI</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}>
                <tbody>
                    {renderRows(filterPemeriksaan(16100, 16200))}
                    {renderRows(filterPemeriksaan(99300, 99400))}
                </tbody>
            </table>

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>IV. ASUHAN KEPERAWATAN</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}><tbody>{renderRows(filterPemeriksaan(20500, 21000))}</tbody></table>

            <h4 style={{ margin: '10px 0', borderBottom: '1px solid #ccc' }}>V. DISCHARGE PLANNING</h4>
            <table width="100%" cellPadding="4" style={{ marginBottom: '20px' }}><tbody>{renderRows(filterPemeriksaan(15000, 16000))}</tbody></table>

            <table width="100%" style={{ marginTop: '40px' }}>
                <tbody>
                    <tr>
                        <td width="60%"></td>
                        <td width="40%" style={{ textAlign: 'center' }}>
                            <p>Perawat yang Mengkaji</p><br /><br /><br /><p>( {petugas} )</p>
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
