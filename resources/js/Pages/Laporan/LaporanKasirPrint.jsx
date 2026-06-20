import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function LaporanKasirPrint({ data, rekap, filters, waktu_cetak, pencetak }) {
    
    // Auto print when component mounts
    useEffect(() => {
        window.print();
    }, []);

    const formatCurrency = (value) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value || 0);
    };

    return (
        <div style={{ fontFamily: 'sans-serif', fontSize: '12px', color: '#000', backgroundColor: '#fff', padding: '20px' }}>
            <Head title="Cetak Laporan Kasir" />
            
            {/* Kop Laporan */}
            <div style={{ textAlign: 'center', marginBottom: '20px' }}>
                <h2 style={{ margin: '5px 0', fontSize: '18px' }}>SISTEM ERP</h2>
                <h3 style={{ margin: '5px 0', fontSize: '16px' }}>LAPORAN TUTUP KASIR & PENJUALAN DETAIL</h3>
                <div style={{ margin: '5px 0' }}>
                    Tanggal: {filters.tgl_awal} s.d {filters.tgl_akhir}
                </div>
            </div>

            {/* Info Filter */}
            <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '20px' }}>
                <table style={{ width: '400px' }}>
                    <tbody>
                        <tr>
                            <td style={{ padding: '2px', width: '100px' }}>Petugas Kasir</td>
                            <td style={{ padding: '2px', width: '10px' }}>:</td>
                            <td style={{ padding: '2px' }}>{filters.petugas === 'all' ? 'Semua Petugas' : filters.petugas}</td>
                        </tr>
                        <tr>
                            <td style={{ padding: '2px' }}>Shift Kasir</td>
                            <td style={{ padding: '2px' }}>:</td>
                            <td style={{ padding: '2px' }}>{filters.shift === 'all' ? 'Semua Shift' : filters.shift}</td>
                        </tr>
                        <tr>
                            <td style={{ padding: '2px' }}>Loket</td>
                            <td style={{ padding: '2px' }}>:</td>
                            <td style={{ padding: '2px' }}>{filters.loket === 'all' ? 'Semua Loket' : filters.loket}</td>
                        </tr>
                    </tbody>
                </table>
                <table style={{ width: '300px' }}>
                    <tbody>
                        <tr>
                            <td style={{ padding: '2px', width: '100px' }}>Waktu Cetak</td>
                            <td style={{ padding: '2px', width: '10px' }}>:</td>
                            <td style={{ padding: '2px' }}>{waktu_cetak}</td>
                        </tr>
                        <tr>
                            <td style={{ padding: '2px' }}>Pencetak</td>
                            <td style={{ padding: '2px' }}>:</td>
                            <td style={{ padding: '2px' }}>{pencetak}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {/* Rekapitulasi */}
            <h4 style={{ margin: '15px 0 5px 0', fontSize: '13px' }}>REKAPITULASI (TUTUP KASIR)</h4>
            <table className="data-table" style={{ width: '100%', borderCollapse: 'collapse', marginBottom: '20px' }}>
                <thead>
                    <tr>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'center', backgroundColor: '#f2f2f2' }}>Total Transaksi</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'center', backgroundColor: '#f2f2f2' }}>Total Batal</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Tunai</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Kartu Kredit</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Kartu Debit</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Total Diskon</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Penerimaan Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'center' }}>{rekap.total_transaksi}</td>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'center' }}>{rekap.total_batal}</td>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(rekap.tunai)}</td>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(rekap.kredit)}</td>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(rekap.debet)}</td>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(rekap.diskon)}</td>
                        <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', fontWeight: 'bold' }}>{formatCurrency(rekap.total_bersih)}</td>
                    </tr>
                </tbody>
            </table>

            {/* Detail Transaksi */}
            <h4 style={{ margin: '20px 0 5px 0', fontSize: '13px' }}>DETAIL TRANSAKSI KASIR</h4>
            <table className="data-table" style={{ width: '100%', borderCollapse: 'collapse', marginBottom: '20px' }}>
                <thead>
                    <tr>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'left', backgroundColor: '#f2f2f2' }}>No. Transaksi</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'left', backgroundColor: '#f2f2f2' }}>Tanggal & Jam</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'left', backgroundColor: '#f2f2f2' }}>ID / Pelanggan</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'left', backgroundColor: '#f2f2f2' }}>Petugas / Shift</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Tagihan</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Tunai</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Non-Tunai</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Pembayaran</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', backgroundColor: '#f2f2f2' }}>Kembalian</th>
                        <th style={{ border: '1px solid #333', padding: '4px', textAlign: 'center', backgroundColor: '#f2f2f2' }}>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {data.length === 0 ? (
                        <tr>
                            <td colSpan="8" style={{ border: '1px solid #333', padding: '10px', textAlign: 'center' }}>Tidak ada data transaksi.</td>
                        </tr>
                    ) : (
                        data.map((row, idx) => (
                            <tr key={idx}>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'left' }}>
                                    {row.no_transaksi} <br />
                                    <span style={{ fontSize: '10px', color: '#555' }}>Ref: {row.no_registrasi}</span>
                                </td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'left' }}>{row.tgl_jam}</td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'left' }}>
                                    {row.no_mr} <br />
                                    <strong>{row.nama_pasien}</strong>
                                </td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'left' }}>
                                    {row.petugas} <br />
                                    <span style={{ fontSize: '10px', color: '#555' }}>Shift: {row.shift} | Loket: {row.loket}</span>
                                </td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right', fontWeight: 'bold' }}>{formatCurrency(row.total_tagihan)}</td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(row.tunai)}</td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>
                                    CC: {formatCurrency(row.kredit)} <br />
                                    DC: {formatCurrency(row.debet)}
                                </td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(row.uang_diterima)}</td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'right' }}>{formatCurrency(row.uang_kembali)}</td>
                                <td style={{ border: '1px solid #333', padding: '4px', textAlign: 'center' }}>
                                    {row.status_batal === 1 ? 'BATAL' : 'SUKSES'}
                                </td>
                            </tr>
                        ))
                    )}
                </tbody>
            </table>

            {/* Tanda Tangan */}
            <table style={{ width: '100%', marginTop: '40px' }}>
                <tbody>
                    <tr>
                        <td style={{ textAlign: 'center', width: '50%' }}>
                            Mengetahui,<br /><br /><br /><br /><br />
                            <span style={{ fontWeight: 'bold' }}>( ______________________ )</span><br />
                            Ka. Kasir / Keuangan
                        </td>
                        <td style={{ textAlign: 'center', width: '50%' }}>
                            Petugas Kasir,<br /><br /><br /><br /><br />
                            <span style={{ fontWeight: 'bold' }}>( {pencetak} )</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <style dangerouslySetInnerHTML={{__html: `
                @media print {
                    body { margin: 0; padding: 0; }
                    @page { margin: 1cm; size: landscape; }
                }
            `}} />
        </div>
    );
}
