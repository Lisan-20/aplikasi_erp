import React, { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { FileText, ArrowLeft, Trash2, Save, ShoppingCart, RefreshCw } from 'lucide-react';
import AsyncSelect from 'react-select/async';
import Swal from 'sweetalert2';

import dayjs from 'dayjs';

export default function FormPo() {
    const { data, setData, post, processing, errors } = useForm({
        kodesupplier: '',
        tgl_po: dayjs().format('YYYY-MM-DD'),
        cart: [],
        ppn: 11, // Default PPN 11%
        discount_harga: 0
    });

    const [selectedSupplier, setSelectedSupplier] = useState(null);
    const [selectedPr, setSelectedPr] = useState(null);
    const [selectedBarang, setSelectedBarang] = useState(null);

    const loadSuppliers = async (inputValue) => {
        if (!inputValue || inputValue.length < 2) return [];
        const res = await fetch(`/pengadaan/api/search-supplier?search=${inputValue}`);
        const json = await res.json();
        return json.map(item => ({ label: item.namasupplier, value: item.kodesupplier }));
    };

    const loadPrs = async (inputValue) => {
        if (!inputValue || inputValue.length < 2) return [];
        const res = await fetch(`/pengadaan/api/search-pr?search=${inputValue}`);
        const json = await res.json();
        return json.map(item => ({ 
            label: `${item.kode_permohonan} - ${item.items.length} Barang`, 
            value: item.id_tc_permohonan,
            data: item 
        }));
    };

    const loadBarangs = async (inputValue) => {
        if (!inputValue || inputValue.length < 2) return [];
        const res = await fetch(`/pengadaan/api/search-barang?search=${inputValue}`);
        const json = await res.json();
        return json.map(item => ({
            label: `${item.kode_brg} - ${item.nama_brg}`,
            value: item.kode_brg,
            data: item
        }));
    };

    const handleSelectBarang = (val) => {
        setSelectedBarang(val);
        if (val) {
            const barang = val.data;
            const currentCart = [...data.cart];
            
            // Periksa jika barang sudah ada di keranjang untuk PO manual
            if (!currentCart.find(c => c.kode_brg === barang.kode_brg && !c.id_tc_permohonan)) {
                currentCart.push({
                    id_tc_permohonan: null,
                    id_tc_permohonan_det: null,
                    kode_brg: barang.kode_brg,
                    nama_brg: barang.nama_brg,
                    satuan_besar: barang.satuan || 'PCS',
                    qty: 1,
                    harga_beli: 0
                });
                setData('cart', currentCart);
            } else {
                Swal.fire('Info', 'Barang sudah ada di daftar pesanan', 'info');
            }
            setSelectedBarang(null);
        }
    };

    const handleSelectPr = (val) => {
        setSelectedPr(val);
        if (val) {
            const pr = val.data;
            
            // Auto fill supplier if possible
            if (pr.kodesupplier && !data.kodesupplier) {
                // We'd ideally need the supplier name too, but we can just set the code
                setData('kodesupplier', pr.kodesupplier);
            }

            // Append items to cart
            const newItems = pr.items.map(item => ({
                id_tc_permohonan: pr.id_tc_permohonan,
                id_tc_permohonan_det: item.id_tc_permohonan_det,
                kode_brg: item.kode_brg,
                nama_brg: item.nama_brg,
                satuan_besar: item.satuan_besar || 'PCS',
                qty: item.qty,
                harga_beli: 0 // user needs to input this
            }));

            // merge with existing, avoid duplicates
            const currentCart = [...data.cart];
            newItems.forEach(ni => {
                if (!currentCart.find(c => c.id_tc_permohonan_det === ni.id_tc_permohonan_det)) {
                    currentCart.push(ni);
                }
            });

            setData('cart', currentCart);
            setSelectedPr(null); // reset selector
        }
    };

    const removeCart = (index) => {
        const newCart = [...data.cart];
        newCart.splice(index, 1);
        setData('cart', newCart);
    };

    const updateCartItem = (index, field, value) => {
        const newCart = [...data.cart];
        newCart[index][field] = value;
        setData('cart', newCart);
    };

    const subTotal = data.cart.reduce((sum, item) => sum + (item.qty * item.harga_beli), 0);
    const diskon = parseFloat(data.discount_harga || 0);
    const totalSetelahDiskon = subTotal - diskon;
    const ppnAmount = (totalSetelahDiskon * parseFloat(data.ppn || 0)) / 100;
    const grandTotal = totalSetelahDiskon + ppnAmount;

    const handleSubmit = (e) => {
        e.preventDefault();
        if (data.cart.length === 0) {
            Swal.fire('Error', 'Daftar pesanan masih kosong!', 'error');
            return;
        }
        
        post('/pengadaan/po', {
            onSuccess: () => {
                // Notifikasi dari flash message di index
            }
        });
    };

    return (
        <DashboardLayout>
            <Head title="Buat PO Baru" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Buat Purchase Order</h1>
                        <p>Tarik dari Permintaan Pembelian (PR) yang disetujui</p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        <Link href="/pengadaan/po" className="dash-btn secondary">
                            <ArrowLeft size={18} />
                            <span>Kembali</span>
                        </Link>
                        <button 
                            type="button" 
                            onClick={handleSubmit}
                            disabled={processing}
                            className="dash-btn primary"
                        >
                            {processing ? <div className="spinner-border spinner-border-sm" role="status" /> : <Save size={18} />}
                            <span>Simpan & Terbitkan PO</span>
                        </button>
                    </div>
                </div>

                <div className="row" style={{ padding: '0 20px', marginTop: '20px' }}>
                    {/* Left Column - Form Supplier & Add PR */}
                    <div className="col-lg-4 col-md-5">
                        <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px', display: 'flex', flexDirection: 'column', gap: '20px' }}>
                            <div>
                            <h3 style={{ fontSize: '1.1rem', fontWeight: 'bold', marginBottom: '15px', color: 'var(--text-color)', borderBottom: '1px solid var(--border-color)', paddingBottom: '10px', display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <FileText size={18} style={{ color: '#60a5fa' }} />
                                Tarik Permintaan Pembelian
                            </h3>
                            
                            <div style={{ marginBottom: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase' }}>Cari PR yang sudah di-ACC</label>
                                <AsyncSelect
                                    cacheOptions
                                    defaultOptions
                                    loadOptions={loadPrs}
                                    value={selectedPr}
                                    onChange={handleSelectPr}
                                    placeholder="Ketik Kode PR..."
                                    styles={{
                                        control: (base) => ({ ...base, backgroundColor: 'rgba(255, 255, 255, 0.05)', borderColor: 'rgba(255, 255, 255, 0.2)', color: 'white' }),
                                        singleValue: (base) => ({ ...base, color: 'white' }),
                                        menu: (base) => ({ ...base, backgroundColor: '#1f2937', zIndex: 9999 }),
                                        option: (base, state) => ({ ...base, backgroundColor: state.isFocused ? '#374151' : 'transparent', color: 'white', '&:hover': { backgroundColor: '#374151' } }),
                                        input: (base) => ({ ...base, color: 'white' })
                                    }}
                                />
                            </div>
                            
                            <div style={{ borderTop: '1px solid var(--border-color)', paddingTop: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase' }}>Tambah Barang Manual</label>
                                <AsyncSelect
                                    cacheOptions
                                    defaultOptions
                                    loadOptions={loadBarangs}
                                    value={selectedBarang}
                                    onChange={handleSelectBarang}
                                    placeholder="Ketik Nama Barang..."
                                    styles={{
                                        control: (base) => ({ ...base, backgroundColor: 'rgba(255, 255, 255, 0.05)', borderColor: 'rgba(255, 255, 255, 0.2)', color: 'white' }),
                                        singleValue: (base) => ({ ...base, color: 'white' }),
                                        menu: (base) => ({ ...base, backgroundColor: '#1f2937', zIndex: 9999 }),
                                        option: (base, state) => ({ ...base, backgroundColor: state.isFocused ? '#374151' : 'transparent', color: 'white', '&:hover': { backgroundColor: '#374151' } }),
                                        input: (base) => ({ ...base, color: 'white' })
                                    }}
                                />
                            </div>
                        </div>

                        <div>
                            <h3 style={{ fontSize: '1.1rem', fontWeight: 'bold', marginBottom: '15px', color: 'var(--text-color)', borderBottom: '1px solid var(--border-color)', paddingBottom: '10px', display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <ShoppingCart size={18} style={{ color: '#818cf8' }} />
                                Informasi PO
                            </h3>
                            
                            <div style={{ marginBottom: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase' }}>Tanggal PO</label>
                                <input 
                                    type="date" 
                                    className="premium-input"
                                    value={data.tgl_po}
                                    onChange={e => setData('tgl_po', e.target.value)}
                                />
                                {errors.tgl_po && <span style={{ color: '#ef4444', fontSize: '0.8rem', marginTop: '4px' }}>{errors.tgl_po}</span>}
                            </div>
                            
                            <div>
                                <label style={{ display: 'block', marginBottom: '8px', fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase' }}>Pilih Supplier Final</label>
                                <AsyncSelect
                                    cacheOptions
                                    defaultOptions
                                    loadOptions={loadSuppliers}
                                    value={selectedSupplier}
                                    onChange={(val) => {
                                        setSelectedSupplier(val);
                                        setData('kodesupplier', val ? val.value : '');
                                    }}
                                    placeholder="Ketik nama supplier..."
                                    styles={{
                                        control: (base) => ({ ...base, backgroundColor: 'rgba(255, 255, 255, 0.05)', borderColor: 'rgba(255, 255, 255, 0.2)', color: 'white' }),
                                        singleValue: (base) => ({ ...base, color: 'white' }),
                                        menu: (base) => ({ ...base, backgroundColor: '#1f2937', zIndex: 9999 }),
                                        option: (base, state) => ({ ...base, backgroundColor: state.isFocused ? '#374151' : 'transparent', color: 'white', '&:hover': { backgroundColor: '#374151' } }),
                                        input: (base) => ({ ...base, color: 'white' })
                                    }}
                                />
                                {errors.kodesupplier && <span style={{ color: '#ef4444', fontSize: '0.8rem', marginTop: '4px' }}>{errors.kodesupplier}</span>}
                            </div>
                        </div>
                    </div>
                    </div>

                    {/* Right Column - Cart & Summary */}
                    <div className="col-lg-8 col-md-7">
                        <div className="glass-panel table-wrap">
                            <div style={{ padding: '15px', borderBottom: '1px solid var(--border-color)' }}>
                                <h2 style={{ fontSize: '1.1rem', fontWeight: 'bold', margin: 0, color: 'var(--text-color)' }}>Daftar Barang Pesanan</h2>
                            </div>
                            
                            <div className="dash-table">
                                <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th>Barang & PR</th>
                                        <th style={{ width: '100px' }}>Qty</th>
                                        <th style={{ width: '200px' }}>Harga Beli</th>
                                        <th style={{ textAlign: 'right', width: '150px' }}>Subtotal</th>
                                        <th style={{ textAlign: 'center', width: '60px' }}>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.cart.map((item, idx) => (
                                        <tr key={idx}>
                                            <td>
                                                <div style={{ fontWeight: '500' }}>{item.nama_brg}</div>
                                                <div style={{ fontSize: '0.85rem', color: 'var(--text-muted)' }}>Satuan: {item.satuan_besar}</div>
                                            </td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    className="premium-input"
                                                    style={{ textAlign: 'center' }}
                                                    value={item.qty}
                                                    onChange={e => updateCartItem(idx, 'qty', e.target.value)}
                                                    min="1"
                                                />
                                            </td>
                                            <td>
                                                <div style={{ position: 'relative' }}>
                                                    <span style={{ position: 'absolute', left: '10px', top: '50%', transform: 'translateY(-50%)', color: 'var(--text-muted)' }}>Rp</span>
                                                    <input 
                                                        type="number" 
                                                        className="premium-input"
                                                        style={{ paddingLeft: '35px' }}
                                                        value={item.harga_beli}
                                                        onChange={e => updateCartItem(idx, 'harga_beli', e.target.value)}
                                                        min="0"
                                                    />
                                                </div>
                                            </td>
                                            <td style={{ textAlign: 'right', fontWeight: '500' }}>
                                                {new Intl.NumberFormat('id-ID').format(item.qty * item.harga_beli)}
                                            </td>
                                            <td style={{ textAlign: 'center' }}>
                                                <button onClick={() => removeCart(idx)} className="dash-btn secondary" style={{ color: '#ef4444', borderColor: 'transparent', padding: '6px' }}>
                                                    <Trash2 size={16} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                    {data.cart.length === 0 && (
                                        <tr>
                                            <td colSpan="5" className="empty-state-td" style={{ padding: '40px', border: '1px dashed var(--border-color)', borderRadius: '8px' }}>
                                                <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                                                    <p style={{ margin: 0, color: 'var(--text-muted)' }}>Tarik data Permintaan Pembelian (PR) untuk memunculkan barang.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>

                        {/* Summary & Submit */}
                        <div style={{ borderTop: '1px solid var(--border-color)', paddingTop: '20px', marginTop: '20px', display: 'flex', gap: '20px', flexWrap: 'wrap' }}>
                            <div style={{ flex: '1 1 250px', display: 'flex', flexDirection: 'column', gap: '15px' }}>
                                <div style={{ display: 'flex', alignItems: 'center', gap: '15px' }}>
                                    <label style={{ fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase', width: '80px' }}>PPN (%)</label>
                                    <input 
                                        type="number" 
                                        className="premium-input"
                                        style={{ width: '100px', textAlign: 'center' }}
                                        value={data.ppn}
                                        onChange={e => setData('ppn', e.target.value)}
                                        min="0" max="100"
                                    />
                                </div>
                                <div style={{ display: 'flex', alignItems: 'center', gap: '15px' }}>
                                    <label style={{ fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase', width: '80px' }}>Diskon (Rp)</label>
                                    <input 
                                        type="number" 
                                        className="premium-input"
                                        style={{ width: '200px' }}
                                        value={data.discount_harga}
                                        onChange={e => setData('discount_harga', e.target.value)}
                                        min="0"
                                    />
                                </div>
                            </div>
                            
                            <div style={{ flex: '1 1 300px', background: 'rgba(0,0,0,0.2)', padding: '20px', borderRadius: '8px', border: '1px solid var(--border-color)' }}>
                                <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: '0.9rem', marginBottom: '10px' }}>
                                    <span style={{ color: 'var(--text-muted)' }}>Subtotal</span>
                                    <span style={{ fontWeight: '500' }}>Rp {new Intl.NumberFormat('id-ID').format(subTotal)}</span>
                                </div>
                                <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: '0.9rem', marginBottom: '10px' }}>
                                    <span style={{ color: 'var(--text-muted)' }}>Diskon</span>
                                    <span style={{ color: '#ef4444', fontWeight: '500' }}>- Rp {new Intl.NumberFormat('id-ID').format(diskon)}</span>
                                </div>
                                <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: '0.9rem', marginBottom: '15px' }}>
                                    <span style={{ color: 'var(--text-muted)' }}>PPN ({data.ppn}%)</span>
                                    <span style={{ fontWeight: '500' }}>+ Rp {new Intl.NumberFormat('id-ID').format(ppnAmount)}</span>
                                </div>
                                <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: '1.2rem', fontWeight: 'bold', borderTop: '1px solid rgba(255,255,255,0.1)', paddingTop: '15px', color: 'var(--text-color)' }}>
                                    <span>Grand Total</span>
                                    <span style={{ color: 'var(--color-success)' }}>Rp {new Intl.NumberFormat('id-ID').format(grandTotal)}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </DashboardLayout>
    );
}
