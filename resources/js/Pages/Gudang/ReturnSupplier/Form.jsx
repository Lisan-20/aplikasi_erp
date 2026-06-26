import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, Save, PackageMinus, Info, AlertTriangle } from 'lucide-react';
import Swal from 'sweetalert2';
import dayjs from 'dayjs';

export default function FormReturn({ lpb, details }) {
    const [items, setItems] = useState(details);
    const [processing, setProcessing] = useState(false);

    const handleQtyReturChange = (index, value) => {
        let val = Number(value);
        if (val < 0) val = 0;
        
        const newItems = [...items];
        
        // Cannot return more than what's remaining to be returned
        if (val > newItems[index].qty_terima) {
            val = newItems[index].qty_terima;
            Swal.fire({
                icon: 'warning',
                title: 'Kuantitas Melebihi Batas',
                text: `Anda hanya bisa meretur sisa barang yang tersedia (${newItems[index].qty_terima} ${newItems[index].satuan})`,
                confirmButtonColor: 'var(--color-primary)'
            });
        }
        
        newItems[index].qty_retur = val;
        setItems(newItems);
    };

    const handleAlasanChange = (index, value) => {
        const newItems = [...items];
        newItems[index].alasan = value;
        setItems(newItems);
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        // Check if any items are being returned
        const totalRetur = items.reduce((sum, item) => sum + item.qty_retur, 0);
        if (totalRetur <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Belum Ada Barang Diretur',
                text: 'Silakan isi jumlah retur pada barang yang ingin dikembalikan.',
                confirmButtonColor: 'var(--color-primary)'
            });
            return;
        }

        // Validate reasons
        const missingReasons = items.some(item => item.qty_retur > 0 && (!item.alasan || item.alasan.trim() === ''));
        if (missingReasons) {
            Swal.fire({
                icon: 'error',
                title: 'Alasan Kosong',
                text: 'Silakan isi alasan/keterangan retur untuk setiap barang yang dikembalikan.',
                confirmButtonColor: 'var(--color-primary)'
            });
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Retur',
            html: `Apakah Anda yakin ingin meretur <b>${totalRetur}</b> barang dari LPB <b>${lpb.kode_penerimaan}</b>?<br><br><small>Stok akan dikurangi dan hutang akan dipotong otomatis.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--color-danger)',
            cancelButtonColor: 'var(--text-secondary)',
            confirmButtonText: 'Ya, Proses Retur!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                setProcessing(true);
                router.post('/gudang/return-supplier', {
                    lpb: lpb,
                    items: items
                }, {
                    onFinish: () => setProcessing(false)
                });
            }
        });
    };

    const totalNilaiRetur = items.reduce((sum, item) => sum + (item.qty_retur * item.harga_satuan), 0);

    return (
        <DashboardLayout title="Proses Retur ke Supplier">
            <Head title="Form Retur Barang" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <Link href="/gudang/return-supplier" className="back-btn" style={{ display: 'inline-flex', alignItems: 'center', gap: '5px', color: 'var(--text-secondary)', textDecoration: 'none', marginBottom: '10px' }}>
                            <ArrowLeft size={16} /> Kembali
                        </Link>
                        <h1 style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                            <PackageMinus size={24} style={{ color: 'var(--color-danger)' }} />
                            Formulir Retur Barang
                        </h1>
                        <p>Memproses retur untuk LPB: <strong>{lpb.kode_penerimaan}</strong></p>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px' }}>
                    <h3 style={{ borderBottom: '1px solid rgba(255,255,255,0.1)', paddingBottom: '10px', marginBottom: '15px', color: 'var(--color-primary)' }}>
                        Informasi Penerimaan (LPB)
                    </h3>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '20px' }}>
                        <div>
                            <p style={{ color: 'var(--text-secondary)', fontSize: '0.85rem', marginBottom: '5px' }}>No LPB</p>
                            <p style={{ fontWeight: '500' }}>{lpb.kode_penerimaan}</p>
                        </div>
                        <div>
                            <p style={{ color: 'var(--text-secondary)', fontSize: '0.85rem', marginBottom: '5px' }}>No PO Asal</p>
                            <p style={{ fontWeight: '500' }}>{lpb.no_po}</p>
                        </div>
                        <div>
                            <p style={{ color: 'var(--text-secondary)', fontSize: '0.85rem', marginBottom: '5px' }}>No Faktur</p>
                            <p style={{ fontWeight: '500' }}>{lpb.no_faktur || '-'}</p>
                        </div>
                        <div>
                            <p style={{ color: 'var(--text-secondary)', fontSize: '0.85rem', marginBottom: '5px' }}>Supplier</p>
                            <p style={{ fontWeight: '500' }}>{lpb.namasupplier}</p>
                        </div>
                        <div>
                            <p style={{ color: 'var(--text-secondary)', fontSize: '0.85rem', marginBottom: '5px' }}>Tgl Terima</p>
                            <p style={{ fontWeight: '500' }}>{dayjs(lpb.tgl_penerimaan).format('DD MMM YYYY')}</p>
                        </div>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px' }}>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '10px', marginBottom: '20px', padding: '15px', background: 'rgba(255,193,7,0.1)', borderLeft: '4px solid var(--color-warning)', borderRadius: '4px' }}>
                        <AlertTriangle size={20} style={{ color: 'var(--color-warning)' }} />
                        <p style={{ margin: 0, fontSize: '0.9rem', color: 'var(--text-primary)' }}>
                            Isi <strong>Kuantitas Retur</strong> pada barang yang ingin dikembalikan. Barang yang tidak diretur biarkan angka 0. Stok barang dan hutang akan otomatis dipotong.
                        </p>
                    </div>

                    <form onSubmit={handleSubmit}>
                        <div className="overflow-x-auto">
                            <table className="dash-table" style={{ minWidth: '800px' }}>
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th style={{ textAlign: 'center' }}>Sisa Qty Bisa Diretur</th>
                                        <th>Harga Satuan</th>
                                        <th style={{ width: '150px' }}>Qty Diretur</th>
                                        <th>Alasan / Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {items.map((item, index) => (
                                        <tr key={index}>
                                            <td>{item.kode_brg}</td>
                                            <td style={{ fontWeight: '500' }}>{item.nama_brg}</td>
                                            <td style={{ textAlign: 'center', fontWeight: '600', color: 'var(--color-success)' }}>
                                                {Number(item.qty_terima).toLocaleString('id-ID')} {item.satuan}
                                            </td>
                                            <td>Rp {Number(item.harga_satuan).toLocaleString('id-ID')}</td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    className="form-input" 
                                                    value={item.qty_retur}
                                                    onChange={(e) => handleQtyReturChange(index, e.target.value)}
                                                    min="0"
                                                    max={item.qty_terima}
                                                    disabled={item.qty_terima <= 0}
                                                    style={{ padding: '8px', width: '100%', backgroundColor: 'var(--bg-dark)', color: 'var(--text-primary)', border: '1px solid rgba(255,255,255,0.2)', borderRadius: '4px' }}
                                                />
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" 
                                                    className="form-input" 
                                                    value={item.alasan}
                                                    onChange={(e) => handleAlasanChange(index, e.target.value)}
                                                    placeholder="Contoh: Barang rusak..."
                                                    disabled={item.qty_retur <= 0}
                                                    required={item.qty_retur > 0}
                                                    style={{ padding: '8px', width: '100%', backgroundColor: 'var(--bg-dark)', color: 'var(--text-primary)', border: '1px solid rgba(255,255,255,0.2)', borderRadius: '4px' }}
                                                />
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>

                        <div style={{ marginTop: '30px', padding: '20px', background: 'rgba(0,0,0,0.2)', borderRadius: '8px', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                            <div>
                                <p style={{ margin: 0, color: 'var(--text-secondary)' }}>Total Nilai Potongan Hutang:</p>
                                <h2 style={{ margin: 0, color: 'var(--color-danger)', fontSize: '1.5rem' }}>
                                    Rp {totalNilaiRetur.toLocaleString('id-ID')}
                                </h2>
                            </div>
                            <button type="submit" className="dash-btn danger" disabled={processing} style={{ padding: '12px 24px', fontSize: '1rem' }}>
                                <Save size={18} />
                                <span>{processing ? 'Memproses...' : 'Simpan Retur'}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </DashboardLayout>
    );
}
