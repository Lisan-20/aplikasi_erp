import React, { useState, useEffect } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, CheckCircle, PackageOpen, Search } from 'lucide-react';
import AsyncSelect from 'react-select/async';
import Swal from 'sweetalert2';
import dayjs from 'dayjs';

export default function FormPenerimaan({ po, po_details }) {
    const [selectedPo, setSelectedPo] = useState(po ? { value: po.id_tc_po, label: po.no_po + ' - ' + po.namasupplier } : null);

    const { data, setData, post, processing, errors } = useForm({
        id_tc_po: po ? po.id_tc_po : '',
        no_faktur: '',
        tgl_penerimaan: dayjs().format('YYYY-MM-DD'),
        items: po_details || []
    });

    useEffect(() => {
        if (po && po_details) {
            setData(data => ({
                ...data,
                id_tc_po: po.id_tc_po,
                items: po_details
            }));
        }
    }, [po, po_details]);

    const loadPos = async (inputValue) => {
        const res = await fetch(`/gudang/api/search-po?search=${inputValue || ''}`);
        return await res.json();
    };

    const handlePoChange = (val) => {
        setSelectedPo(val);
        if (val) {
            router.get(`/gudang/penerimaan/create`, { id_tc_po: val.value }, { preserveState: true, replace: true });
        } else {
            setData(data => ({
                ...data,
                items: [],
                id_tc_po: ''
            }));
        }
    };

    const updateQtyTerima = (index, value) => {
        const newItems = [...data.items];
        newItems[index].qty_terima = value === '' ? '' : Number(value);
        setData('items', newItems);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        
        if (!data.id_tc_po) {
            Swal.fire('Oops', 'Pilih PO terlebih dahulu', 'warning');
            return;
        }

        if (!data.no_faktur) {
            Swal.fire('Oops', 'Nomor Faktur / Surat Jalan wajib diisi!', 'warning');
            return;
        }

        const hasExceedingQty = data.items.some(item => parseFloat(item.qty_terima) > parseFloat(item.qty_pesan));
        if (hasExceedingQty) {
            Swal.fire('Error', 'Terdapat barang dengan Qty Terima melebihi pesanan!', 'error');
            return;
        }

        const receivedItems = data.items.filter(i => parseFloat(i.qty_terima) > 0);
        if (receivedItems.length === 0) {
            Swal.fire('Error', 'Tidak ada barang yang diterima (Qty Terima semua 0)', 'error');
            return;
        }
        
        post('/gudang/penerimaan', {
            onSuccess: () => {
                // Flash message will trigger
            }
        });
    };

    return (
        <DashboardLayout title="Terima Barang">
            <Head title="Penerimaan Faktur" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1 style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                            <Link href="/gudang/penerimaan" style={{ color: 'var(--text-muted)' }}>
                                <ArrowLeft size={20} />
                            </Link>
                            Penerimaan Barang (Goods Receipt)
                        </h1>
                        <p>Catat penerimaan fisik dari supplier berdasarkan PO</p>
                    </div>
                </div>

                <div className="row" style={{ flex: 1, minHeight: 0, margin: 0, padding: 0 }}>
                    
                    {/* Left Column - Referensi PO & Faktur */}
                    <div className="col-lg-4" style={{ display: 'flex', flexDirection: 'column', gap: '1rem', paddingLeft: 0 }}>
                        <div className="glass-panel" style={{ flex: 'none' }}>
                            <h3 style={{ marginBottom: '1.5rem', paddingBottom: '0.5rem', borderBottom: '1px solid var(--glass-border)' }}>Informasi Faktur</h3>
                            
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
                                <div>
                                    <label style={{ display: 'block', fontSize: '0.875rem', marginBottom: '0.5rem', color: 'var(--text-secondary)' }}>Cari Referensi PO</label>
                                    <AsyncSelect
                                        cacheOptions
                                        defaultOptions
                                        loadOptions={loadPos}
                                        value={selectedPo}
                                        onChange={handlePoChange}
                                        placeholder="Ketik No PO..."
                                        styles={{
                                            control: (base) => ({
                                                ...base,
                                                background: 'var(--bg-surface-elevated)',
                                                borderColor: 'var(--border-color)',
                                                color: 'var(--text-primary)'
                                            }),
                                            singleValue: (base) => ({ ...base, color: 'var(--text-primary)' }),
                                            input: (base) => ({ ...base, color: 'var(--text-primary)' }),
                                            menu: (base) => ({ ...base, background: 'var(--bg-surface-elevated)' }),
                                            option: (base, state) => ({
                                                ...base,
                                                background: state.isFocused ? 'var(--color-primary-glow)' : 'transparent',
                                                color: 'var(--text-primary)'
                                            })
                                        }}
                                    />
                                    {errors.id_tc_po && <span style={{ color: 'var(--color-danger)', fontSize: '0.75rem' }}>{errors.id_tc_po}</span>}
                                </div>

                                {po && (
                                    <div style={{ padding: '0.75rem', background: 'var(--color-primary-glow)', borderRadius: '0.5rem', fontSize: '0.875rem' }}>
                                        <p style={{ color: 'var(--text-secondary)' }}>Supplier: <strong style={{ color: 'var(--color-primary)' }}>{po.namasupplier}</strong></p>
                                        <p style={{ color: 'var(--text-secondary)' }}>Total PO: <strong style={{ color: 'var(--text-primary)' }}>Rp {new Intl.NumberFormat('id-ID').format(po.total_stl_ppn)}</strong></p>
                                        <p style={{ color: 'var(--text-muted)', marginTop: '0.25rem', fontSize: '0.75rem' }}>Otomatis akan membentuk Hutang jika disimpan.</p>
                                    </div>
                                )}
                                
                                <div>
                                    <label style={{ display: 'block', fontSize: '0.875rem', marginBottom: '0.5rem', color: 'var(--text-secondary)' }}>Tanggal Diterima</label>
                                    <input 
                                        type="date" 
                                        className="search-input"
                                        style={{ width: '100%', padding: '0.5rem', background: 'var(--bg-surface-elevated)', color: 'var(--text-primary)' }}
                                        value={data.tgl_penerimaan}
                                        onChange={e => setData('tgl_penerimaan', e.target.value)}
                                    />
                                    {errors.tgl_penerimaan && <span style={{ color: 'var(--color-danger)', fontSize: '0.75rem' }}>{errors.tgl_penerimaan}</span>}
                                </div>

                                <div>
                                    <label style={{ display: 'block', fontSize: '0.875rem', marginBottom: '0.5rem', color: 'var(--text-secondary)' }}>No Faktur / Surat Jalan</label>
                                    <input 
                                        type="text" 
                                        placeholder="Wajib diisi..."
                                        className="search-input"
                                        style={{ width: '100%', padding: '0.5rem', background: 'var(--bg-surface-elevated)', color: 'var(--text-primary)' }}
                                        value={data.no_faktur}
                                        onChange={e => setData('no_faktur', e.target.value.toUpperCase())}
                                    />
                                    {errors.no_faktur && <span style={{ color: 'var(--color-danger)', fontSize: '0.75rem' }}>{errors.no_faktur}</span>}
                                </div>
                            </div>
                        </div>

                        {po && (
                            <button 
                                onClick={handleSubmit}
                                disabled={processing}
                                className="dash-btn primary"
                                style={{ width: '100%', justifyContent: 'center', padding: '1rem' }}
                            >
                                <CheckCircle size={20} /> {processing ? 'Menyimpan...' : 'Simpan Penerimaan'}
                            </button>
                        )}
                    </div>

                    {/* Right Column - Daftar Barang */}
                    <div className="col-lg-8 glass-panel table-wrap" style={{ paddingRight: 0 }}>
                        <div style={{ padding: '1.5rem 1.5rem 0' }}>
                            <h3 style={{ borderBottom: '1px solid var(--glass-border)', paddingBottom: '0.5rem', display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                                <PackageOpen size={20} style={{ color: 'var(--text-muted)' }} />
                                Daftar Barang Datang
                            </h3>
                        </div>
                        
                        <div className="dash-table" style={{ padding: '0 1.5rem 1.5rem' }}>
                            {!po ? (
                                <div className="empty-state">
                                    <Search className="empty-icon" />
                                    <p>Silakan cari dan pilih No PO terlebih dahulu di sebelah kiri.</p>
                                </div>
                            ) : (
                                <table className="dash-table">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Harga Satuan</th>
                                            <th style={{ textAlign: 'center' }}>Qty Pesan (PO)</th>
                                            <th style={{ textAlign: 'center', color: 'var(--color-primary)' }}>Qty Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {data.items.map((item, idx) => (
                                            <tr key={idx}>
                                                <td>
                                                    {item.nama_brg} <br/>
                                                    <span style={{ fontSize: '0.75rem', color: 'var(--text-muted)' }}>Satuan: {item.satuan}</span>
                                                </td>
                                                <td>
                                                    {new Intl.NumberFormat('id-ID').format(item.harga_satuan)}
                                                </td>
                                                <td style={{ textAlign: 'center', fontWeight: 'bold' }}>
                                                    {parseInt(item.qty_pesan)}
                                                </td>
                                                <td style={{ background: 'var(--color-primary-glow)' }}>
                                                    <input 
                                                        type="number" 
                                                        className="search-input"
                                                        style={{ 
                                                            width: '100%', 
                                                            textAlign: 'center', 
                                                            fontWeight: 'bold', 
                                                            padding: '0.5rem',
                                                            borderColor: Number(item.qty_terima) > Number(item.qty_pesan) ? 'var(--color-danger)' : 'var(--color-primary)',
                                                            background: 'var(--bg-surface-elevated)',
                                                            color: Number(item.qty_terima) > Number(item.qty_pesan) ? 'var(--color-danger)' : 'var(--color-primary)'
                                                        }}
                                                        value={item.qty_terima}
                                                        onChange={e => updateQtyTerima(idx, e.target.value)}
                                                        min="0"
                                                    />
                                                    {Number(item.qty_terima) > Number(item.qty_pesan) && (
                                                        <p style={{ fontSize: '10px', color: 'var(--color-danger)', marginTop: '0.25rem', textAlign: 'center' }}>Qty terima melebihi pesanan!</p>
                                                    )}
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
