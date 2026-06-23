import React, { useEffect } from 'react';
import { Head } from '@inertiajs/react';

export default function StrukKasir({ header, details, nama_kasir, rs_name }) {
    // Format mata uang rupiah
    const formatRp = (angka) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka || 0);
    };

    // Format tanggal
    const formatTgl = (tgl) => {
        if (!tgl) return '';
        const d = new Date(tgl);
        return d.toLocaleString('id-ID', {
            day: '2-digit', month: '2-digit', year: 'numeric',
            hour: '2-digit', minute: '2-digit'
        });
    };

    useEffect(() => {
        // Auto print upon load
        setTimeout(() => {
            window.print();
        }, 500);
    }, []);

    // Calculate total qty
    const totalQty = details.reduce((acc, curr) => acc + parseFloat(curr.qty), 0);
    
    // Calculate amounts
    const bill = parseFloat(header.bill || 0);
    const diskon = parseFloat(header.diskon || 0);
    
    // Use uang_diterima if it's > 0 (new schema), otherwise fallback to tunai (old schema)
    const uangDiterimaVal = parseFloat(header.uang_diterima || 0);
    const tunai = uangDiterimaVal > 0 ? uangDiterimaVal : parseFloat(header.tunai || 0);
    
    const debet = parseFloat(header.debet || 0);
    const kredit = parseFloat(header.kredit || 0);
    
    // Use uang_kembali directly (new schema) or calculate manually for old schema
    let kembalian = parseFloat(header.uang_kembali || 0);
    if (kembalian === 0 && uangDiterimaVal === 0) {
        const totalDibayar = tunai + debet + kredit;
        const totalHarusDibayar = bill - diskon;
        kembalian = totalDibayar - totalHarusDibayar;
    }

    return (
        <>
            <Head title={`Struk - ${header.no_registrasi}`} />
            <div className="receipt-container">
                <style dangerouslySetInnerHTML={{__html: `
                    @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;700&display=swap');
                    
                    body {
                        margin: 0;
                        padding: 0;
                        background: #f0f0f0;
                        font-family: 'Inconsolata', monospace;
                        font-size: 13px;
                        color: #000;
                    }
                    .receipt-container {
                        max-width: 80mm;
                        margin: 20px auto;
                        background: #fff;
                        padding: 15px;
                        box-shadow: 0 0 5px rgba(0,0,0,0.2);
                    }
                    h1, h2, h3, h4, h5, h6, p {
                        margin: 0;
                        padding: 0;
                    }
                    .text-center { text-align: center; }
                    .text-right { text-align: right; }
                    .text-left { text-align: left; }
                    .font-bold { font-weight: bold; }
                    
                    .header { margin-bottom: 10px; border-bottom: 1px dashed #000; padding-bottom: 10px; }
                    .header h2 { font-size: 16px; margin-bottom: 5px; }
                    .header p { font-size: 12px; }
                    
                    .info { margin-bottom: 10px; border-bottom: 1px dashed #000; padding-bottom: 5px; }
                    .info table { width: 100%; font-size: 12px; }
                    .info table td { padding: 2px 0; vertical-align: top; }
                    
                    .items { margin-bottom: 10px; border-bottom: 1px dashed #000; padding-bottom: 5px; }
                    .item-row { margin-bottom: 5px; font-size: 12px; }
                    .item-name { margin-bottom: 2px; }
                    .item-detail { display: flex; justify-content: space-between; }
                    
                    .summary { margin-bottom: 10px; border-bottom: 1px dashed #000; padding-bottom: 5px; }
                    .summary table { width: 100%; font-size: 12px; }
                    .summary table td { padding: 2px 0; }
                    
                    .footer { font-size: 12px; margin-top: 10px; }
                    
                    /* Print specific styles */
                    @media print {
                        body { background: #fff; }
                        .receipt-container { 
                            margin: 0; 
                            box-shadow: none; 
                            width: 100%; 
                            max-width: 100%; 
                            padding: 0;
                        }
                        @page {
                            margin: 0;
                            size: 80mm auto;
                        }
                    }
                `}} />

                {/* Header */}
                <div className="header text-center">
                    <h2 className="font-bold">{rs_name}</h2>
                    <p>Jl. Raya Cikarang Cibarusah</p>
                    <p>Kab. Bekasi, Jawa Barat</p>
                </div>

                {/* Info Transaksi */}
                <div className="info">
                    <table>
                        <tbody>
                            <tr>
                                <td>No. Reg</td>
                                <td>:</td>
                                <td>{header.no_registrasi}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{formatTgl(header.tgl_jam)}</td>
                            </tr>
                            <tr>
                                <td>Kasir</td>
                                <td>:</td>
                                <td>{nama_kasir}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {/* Daftar Barang */}
                <div className="items">
                    {details.map((item, idx) => {
                        const qtyBeli = parseFloat(item.qty);
                        const qtyRetur = parseFloat(item.qty_retur || 0);
                        const effectiveQty = qtyBeli - qtyRetur;
                        const isFullyReturned = effectiveQty <= 0;
                        const displayQty = isFullyReturned ? qtyBeli : effectiveQty;
                        const displaySubtotal = displayQty * parseFloat(item.harga_jual);

                        return (
                            <div className="item-row" key={idx} style={isFullyReturned ? { textDecoration: 'line-through', color: '#888' } : {}}>
                                <div className="item-name">
                                    {item.nama_brg} 
                                    {qtyRetur > 0 && !isFullyReturned && <span style={{fontSize: '10px', fontStyle: 'italic'}}> (Retur {qtyRetur})</span>}
                                    {isFullyReturned && <span style={{fontSize: '10px', fontWeight: 'bold'}}> (DIRETUR)</span>}
                                </div>
                                <div className="item-detail">
                                    <span>{displayQty} x {formatRp(item.harga_jual)}</span>
                                    <span className="font-bold">{formatRp(displaySubtotal)}</span>
                                </div>
                            </div>
                        );
                    })}
                </div>

                {/* Summary */}
                <div className="summary">
                    <table>
                        <tbody>
                            <tr>
                                <td>Total Item</td>
                                <td>:</td>
                                <td className="text-right">{totalQty}</td>
                            </tr>
                            <tr>
                                <td>Subtotal</td>
                                <td>:</td>
                                <td className="text-right font-bold">{formatRp(bill)}</td>
                            </tr>
                            {diskon > 0 && (
                                <tr>
                                    <td>Diskon</td>
                                    <td>:</td>
                                    <td className="text-right">- {formatRp(diskon)}</td>
                                </tr>
                            )}
                            <tr>
                                <td>Tunai</td>
                                <td>:</td>
                                <td className="text-right">{formatRp(tunai)}</td>
                            </tr>
                            {debet > 0 && (
                                <tr>
                                    <td>Debit</td>
                                    <td>:</td>
                                    <td className="text-right">{formatRp(debet)}</td>
                                </tr>
                            )}
                            {kredit > 0 && (
                                <tr>
                                    <td>Kredit</td>
                                    <td>:</td>
                                    <td className="text-right">{formatRp(kredit)}</td>
                                </tr>
                            )}
                            <tr>
                                <td className="font-bold">Kembalian</td>
                                <td>:</td>
                                <td className="text-right font-bold">
                                    {formatRp(kembalian > 0 ? kembalian : 0)}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {/* Footer */}
                <div className="footer text-center">
                    <p>Terima Kasih</p>
                    <p>Semoga Lekas Sembuh</p>
                </div>
            </div>
        </>
    );
}
