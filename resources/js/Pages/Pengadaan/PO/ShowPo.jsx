import React, { useState } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { FileText, ArrowLeft, Trash2, Save, ShoppingCart, RefreshCw } from 'lucide-react';
import AsyncSelect from 'react-select/async';
import dayjs from 'dayjs';
import Swal from 'sweetalert2';

export default function ShowPo({ po, cart, supplier, selectedPr }) {
    // This is read-only
    const data = {
        tgl_po: po.tgl_po ? po.tgl_po.split(' ')[0] : dayjs().format('YYYY-MM-DD'),
        kodesupplier: supplier ? supplier.kodesupplier : '',
        ppn: po.ppn_persen || 0,
        ppn_nominal: po.ppn_nominal || 0,
        discount_harga: po.discount_harga || 0,
        total_sbl_ppn: po.total_sbl_ppn || 0,
        total_stl_ppn: po.total_stl_ppn || 0,
        cart: cart || []
    };

    const selectedSupplier = supplier ? { value: supplier.kodesupplier, label: supplier.namasupplier } : null;

    const loadSuppliers = async (inputValue) => {
        if (!inputValue || inputValue.length < 2) return [];
        const res = await fetch(`/pengadaan/api/search-supplier?search=${inputValue}`);
        const json = await res.json();
        return json.map(item => ({ label: item.namasupplier, value: item.kodesupplier }));
    };

    const loadPrs = async (inputValue) => {
        const query = inputValue ? `?search=${inputValue}` : '';
        const res = await fetch(`/pengadaan/api/search-pr${query}`);
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
            if (pr.kodesupplier && !data.kodesupplier) {
                setData('kodesupplier', pr.kodesupplier);
            }

            const newItems = pr.items.map(item => ({
                id_tc_permohonan: pr.id_tc_permohonan,
                id_tc_permohonan_det: item.id_tc_permohonan_det,
                kode_brg: item.kode_brg,
                nama_brg: item.nama_brg,
                satuan_besar: item.satuan_besar || 'PCS',
                qty: item.qty,
                harga_beli: 0
            }));

            const currentCart = [...data.cart];
            newItems.forEach(ni => {
                if (!currentCart.find(c => c.id_tc_permohonan_det === ni.id_tc_permohonan_det)) {
                    currentCart.push(ni);
                }
            });

            setData('cart', currentCart);
            setSelectedPr(null);
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

    return (
        <DashboardLayout>
            <Head title="Detail PO" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div>
                        <h1 style={{ fontSize: '1.5rem', fontWeight: 'bold', color: 'white', margin: 0 }}>
                            Detail Purchase Order
                        </h1>
                        <p style={{ color: 'var(--text-muted)', margin: '5px 0 0 0', fontSize: '0.9rem' }}>
                            Informasi pesanan dari PO {po.no_po}.
                        </p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        <button 
                            type="button" 
                            className="dash-btn secondary"
                            onClick={() => window.history.back()}
                        >
                            <ArrowLeft size={18} />
                            Kembali
                        </button>
                    </div>
                </div>

                <div className="row" style={{ padding: '0 20px', marginTop: '20px' }}>
                    <div className="col-lg-4 col-md-5">
                        <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px', display: 'flex', flexDirection: 'column', gap: '20px' }}>
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
                                    readOnly
                                />
                            </div>

                            <div style={{ marginBottom: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase' }}>Supplier Final</label>
                                <input 
                                    type="text" 
                                    className="premium-input"
                                    value={selectedSupplier ? selectedSupplier.label : '-'}
                                    readOnly
                                />
                            </div>
                        </div>
                    </div>
                    </div>

                    <div className="col-lg-8 col-md-7">
                        <div className="glass-panel table-wrap">
                            <div style={{ padding: '15px', borderBottom: '1px solid var(--border-color)' }}>
                                <h2 style={{ fontSize: '1.1rem', fontWeight: 'bold', margin: 0, color: 'var(--text-color)' }}>Daftar Barang Pesanan</h2>
                            </div>
                            
                            <div className="dash-table" style={{ maxHeight: '400px', overflowY: 'auto' }}>
                                <table className="dash-table" style={{ minWidth: '700px' }}>
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
                                                <div style={{ textAlign: 'center', fontWeight: 'bold' }}>{item.qty}</div>
                                            </td>
                                            <td>
                                                <div style={{ position: 'relative' }}>
                                                    <span style={{ position: 'absolute', left: '10px', top: '50%', transform: 'translateY(-50%)', color: 'var(--text-muted)' }}>Rp</span>
                                                    <input 
                                                        type="text" 
                                                        className="premium-input"
                                                        style={{ paddingLeft: '35px' }}
                                                        value={new Intl.NumberFormat('id-ID').format(item.harga_beli)}
                                                        readOnly
                                                    />
                                                </div>
                                            </td>
                                            <td style={{ textAlign: 'right', fontWeight: '500' }}>
                                                {new Intl.NumberFormat('id-ID').format(item.qty * item.harga_beli)}
                                            </td>
                                            <td style={{ textAlign: 'center' }}>
                                                {/* No trash button in view */}
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
                                        readOnly
                                    />
                                </div>
                                <div style={{ display: 'flex', alignItems: 'center', gap: '15px' }}>
                                    <label style={{ fontSize: '0.85rem', fontWeight: 'bold', color: 'var(--text-muted)', textTransform: 'uppercase', width: '80px' }}>Diskon (Rp)</label>
                                    <input 
                                        type="number" 
                                        className="premium-input"
                                        style={{ width: '200px' }}
                                        value={data.discount_harga}
                                        readOnly
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
