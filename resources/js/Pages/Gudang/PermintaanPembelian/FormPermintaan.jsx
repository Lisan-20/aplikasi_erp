import React, { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, Save, Plus, Trash2, PackageOpen } from 'lucide-react';
import AsyncSelect from 'react-select/async';
import Swal from 'sweetalert2';


export default function FormPermintaan() {
    const { data, setData, post, processing, errors } = useForm({
        kodesupplier: '',
        items: []
    });

    const [selectedSupplier, setSelectedSupplier] = useState(null);

    const loadSuppliers = async (inputValue) => {
        if (!inputValue || inputValue.length < 2) return [];
        const res = await fetch(`/pengadaan/api/search-supplier?search=${inputValue}`);
        const json = await res.json();
        return json.map(item => ({ label: item.namasupplier, value: item.kodesupplier }));
    };

    const loadBarang = async (inputValue) => {
        if (!inputValue || inputValue.length < 2) return [];
        const res = await fetch(`/pengadaan/api/search-barang?search=${inputValue}`);
        const json = await res.json();
        return json.map(item => ({
            label: `${item.nama_brg} (${item.satuan || '-'})`,
            value: item.kode_brg,
            satuan: item.satuan || '-'
        }));
    };

    const handleSupplierChange = (val) => {
        setSelectedSupplier(val);
        setData('kodesupplier', val ? val.value : '');
    };

    const addItem = () => {
        setData('items', [
            ...data.items, 
            { id: Date.now(), kode_brg: '', nama_brg: '', satuan: '', jumlah_besar: 1, selectedOption: null }
        ]);
    };

    const removeItem = (id) => {
        setData('items', data.items.filter(item => item.id !== id));
    };

    const updateItem = (id, field, value) => {
        setData('items', data.items.map(item => {
            if (item.id === id) {
                return { ...item, [field]: value };
            }
            return item;
        }));
    };

    const handleItemChange = (id, val) => {
        setData('items', data.items.map(item => {
            if (item.id === id) {
                return { 
                    ...item, 
                    kode_brg: val ? val.value : '',
                    nama_brg: val ? val.label : '',
                    satuan: val ? val.satuan : '',
                    selectedOption: val
                };
            }
            return item;
        }));
    };

    const submit = (e) => {
        e.preventDefault();
        
        if (!data.kodesupplier) {
            Swal.fire('Peringatan', 'Silakan pilih Supplier terlebih dahulu!', 'warning');
            return;
        }
        if (data.items.length === 0) {
            Swal.fire('Peringatan', 'Minimal harus ada 1 barang yang diminta!', 'warning');
            return;
        }
        
        post('/gudang/permintaan-pembelian');
    };

    return (
        <DashboardLayout>
            <Head title="Buat Permintaan Pembelian" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Buat Permintaan Pembelian (PR)</h1>
                        <p>Formulir pengajuan permintaan barang ke bagian Purchasing</p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        <Link href="/gudang/permintaan-pembelian" className="dash-btn secondary">
                            <ArrowLeft size={18} />
                            <span>Kembali</span>
                        </Link>
                        <button
                            type="button"
                            onClick={submit}
                            disabled={processing}
                            className="dash-btn primary"
                        >
                            <Save size={18} />
                            <span>Simpan Permintaan</span>
                        </button>
                    </div>
                </div>

                <div className="row" style={{ padding: '0 20px', marginTop: '20px' }}>
                    {/* Left Column - Supplier Section */}
                    <div className="col-lg-4 col-md-5">
                        <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px' }}>
                            <div style={{ marginBottom: '20px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontWeight: '500', color: 'var(--text-color)' }}>
                                    Pilih Supplier Tujuan (Rekomendasi) <span style={{color: '#ef4444'}}>*</span>
                                </label>
                                <AsyncSelect
                                    cacheOptions
                                    defaultOptions
                                    loadOptions={loadSuppliers}
                                    value={selectedSupplier}
                                    onChange={handleSupplierChange}
                                    placeholder="Ketik nama supplier..."
                                    menuPortalTarget={document.body}
                                    menuPosition={'fixed'}
                                    styles={{
                                        control: (base) => ({
                                            ...base,
                                            backgroundColor: 'rgba(255, 255, 255, 0.05)',
                                            borderColor: 'rgba(255, 255, 255, 0.2)',
                                            color: 'white',
                                        }),
                                        singleValue: (base) => ({ ...base, color: 'white' }),
                                        menu: (base) => ({
                                            ...base,
                                            backgroundColor: '#1f2937',
                                            zIndex: 9999
                                        }),
                                        option: (base, state) => ({
                                            ...base,
                                            backgroundColor: state.isFocused ? '#374151' : 'transparent',
                                            color: 'white',
                                            '&:hover': { backgroundColor: '#374151' }
                                        }),
                                        input: (base) => ({ ...base, color: 'white' })
                                    }}
                                />
                                {errors.kodesupplier && <p style={{ color: '#ef4444', fontSize: '0.8rem', marginTop: '4px' }}>{errors.kodesupplier}</p>}
                            </div>

                            <div style={{ background: 'rgba(59, 130, 246, 0.1)', border: '1px solid rgba(59, 130, 246, 0.2)', padding: '15px', borderRadius: '8px' }}>
                                <h3 style={{ fontSize: '0.9rem', fontWeight: 'bold', color: '#60a5fa', margin: '0 0 10px 0' }}>Panduan Pengisian:</h3>
                                <ul style={{ fontSize: '0.85rem', color: 'var(--text-muted)', margin: 0, paddingLeft: '20px', lineHeight: '1.6' }}>
                                    <li>Cari supplier tujuan tempat purchasing disarankan membeli.</li>
                                    <li>Klik tombol "Tambah Barang" untuk memasukkan list barang yang akan diminta.</li>
                                    <li>Setelah disimpan, data akan masuk ke daftar verifikasi (ACC Purchasing) oleh manajemen.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {/* Right Column - Items Section */}
                    <div className="col-lg-8 col-md-7">
                        <div className="glass-panel table-wrap">
                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', padding: '15px', borderBottom: '1px solid var(--border-color)' }}>
                                <h2 style={{ fontSize: '1.1rem', fontWeight: 'bold', margin: 0, color: 'var(--text-color)' }}>Daftar Barang Diminta</h2>
                                <button
                                    type="button"
                                    onClick={addItem}
                                    className="dash-btn secondary"
                                >
                                    <Plus size={16} />
                                    <span>Tambah Barang</span>
                                </button>
                            </div>

                            <div className="dash-table">
                                <table className="dash-table">
                                    <thead>
                                        <tr>
                                            <th>Pilih Barang</th>
                                            <th style={{ width: '100px' }}>Qty</th>
                                            <th style={{ width: '120px' }}>Satuan</th>
                                            <th style={{ width: '60px', textAlign: 'center' }}>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {data.items.length === 0 ? (
                                            <tr>
                                                <td colSpan="4" className="empty-state-td">
                                                    <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: '10px' }}>
                                                        <PackageOpen size={40} style={{ opacity: 0.3 }} />
                                                        <p style={{ margin: 0, fontWeight: '500' }}>Belum ada barang ditambahkan</p>
                                                        <p style={{ margin: '5px 0 0 0', fontSize: '0.85rem', color: 'var(--text-muted)' }}>Klik tombol 'Tambah Barang' di atas untuk menyusun daftar permintaan.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        ) : (
                                            data.items.map((item) => (
                                                <tr key={item.id}>
                                                    <td>
                                                        <AsyncSelect
                                                            cacheOptions
                                                            defaultOptions
                                                            loadOptions={loadBarang}
                                                            value={item.selectedOption}
                                                            onChange={(val) => handleItemChange(item.id, val)}
                                                            placeholder="Ketik nama barang..."
                                                            menuPortalTarget={document.body}
                                                            menuPosition={'fixed'}
                                                            styles={{
                                                                control: (base) => ({
                                                                    ...base, backgroundColor: 'rgba(255, 255, 255, 0.05)', borderColor: 'rgba(255, 255, 255, 0.2)', color: 'white'
                                                                }),
                                                                singleValue: (base) => ({ ...base, color: 'white' }),
                                                                menu: (base) => ({ ...base, backgroundColor: '#1f2937', zIndex: 9999 }),
                                                                option: (base, state) => ({ ...base, backgroundColor: state.isFocused ? '#374151' : 'transparent', color: 'white', '&:hover': { backgroundColor: '#374151' } }),
                                                                input: (base) => ({ ...base, color: 'white' })
                                                            }}
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            min="1"
                                                            value={item.jumlah_besar}
                                                            onChange={(e) => updateItem(item.id, 'jumlah_besar', e.target.value)}
                                                            className="premium-input"
                                                            style={{ textAlign: 'center' }}
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            readOnly
                                                            value={item.satuan}
                                                            className="premium-input"
                                                            style={{ background: 'rgba(0,0,0,0.3)', opacity: 0.7 }}
                                                            placeholder="-"
                                                        />
                                                    </td>
                                                    <td style={{ textAlign: 'center' }}>
                                                        <button
                                                            type="button"
                                                            onClick={() => removeItem(item.id)}
                                                            className="dash-btn secondary"
                                                            style={{ color: '#ef4444', borderColor: 'transparent', padding: '6px' }}
                                                            title="Hapus baris"
                                                        >
                                                            <Trash2 size={16} />
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
