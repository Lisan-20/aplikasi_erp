import React, { useState, useEffect, useMemo } from 'react';
import { Head, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, ShoppingCart, Plus, Minus, Trash2, CreditCard, Banknote, Wallet, History, Printer, XCircle, Undo2, Sparkles } from 'lucide-react';
import Swal from 'sweetalert2';
import axios from 'axios';
import '../../../css/pos-kasir.css';

export default function Pos() {
    const { module_name } = usePage().props;

    const [products, setProducts] = useState([]);
    const [keyword, setKeyword] = useState('');
    const [loading, setLoading] = useState(false);
    
    // Pagination state
    const [currentPage, setCurrentPage] = useState(1);
    const [lastPage, setLastPage] = useState(1);

    const [cart, setCart] = useState([]);
    const [discountManual, setDiscountManual] = useState(0);
    const [discountPers, setDiscountPers] = useState(0);
    const [paymentMethod, setPaymentMethod] = useState('tunai'); // tunai, kredit, debet
    const [admCc, setAdmCc] = useState(0);
    const [uangDiterima, setUangDiterima] = useState(0);
    const [activeTab, setActiveTab] = useState('kasir'); // kasir, riwayat
    const [riwayat, setRiwayat] = useState([]);
    const [loadingRiwayat, setLoadingRiwayat] = useState(false);

    // Retur Parsial State
    const [showReturModal, setShowReturModal] = useState(false);
    const [returItems, setReturItems] = useState([]);
    const [returNoReg, setReturNoReg] = useState(null);
    const [returAlasan, setReturAlasan] = useState('');

    // AI Recommendations State
    const [recommendations, setRecommendations] = useState([]);

    useEffect(() => {
        const timer = setTimeout(() => {
            fetchProducts(keyword, 1);
        }, 300); // 300ms debounce
        return () => clearTimeout(timer);
    }, [keyword]);

    useEffect(() => {
        if (cart.length > 0) {
            fetchRecommendations();
        } else {
            setRecommendations([]);
        }
    }, [cart]);

    const fetchRecommendations = async () => {
        try {
            const cartCodes = cart.map(item => item.kode_brg);
            const res = await axios.post('/kasir/api/gemini-recommendations', { cart: cartCodes });
            setRecommendations(res.data);
        } catch (error) {
            console.error("Error fetching AI recommendations", error);
        }
    };

    const fetchProducts = async (q = '', page = 1) => {
        setLoading(true);
        try {
            const res = await fetch(`/kasir/api/barang-nm?q=${encodeURIComponent(q)}&page=${page}`);
            const data = await res.json();
            
            // Handle laravel paginator format
            if (data && data.data !== undefined) {
                setProducts(data.data);
                setCurrentPage(data.current_page || 1);
                setLastPage(data.last_page || 1);
            } else {
                setProducts(data);
                setCurrentPage(1);
                setLastPage(1);
            }
        } catch (error) {
            console.error(error);
        } finally {
            setLoading(false);
        }
    };

    const addToCart = (product) => {
        setCart(prev => {
            const existing = prev.find(item => item.kode_brg === product.kode_brg);
            if (existing) {
                // cek stok hanya untuk barang fisik (kd_tipe_brg == 1)
                if ((product.kd_tipe_brg === undefined || parseInt(product.kd_tipe_brg) === 1) && existing.qty + 1 > product.jml_sat_kcl) {
                    Swal.fire('Stok Tidak Cukup', `Sisa stok hanya ${product.jml_sat_kcl}`, 'warning');
                    return prev;
                }
                return prev.map(item =>
                    item.kode_brg === product.kode_brg
                    ? { ...item, qty: item.qty + 1 }
                    : item
                );
            } else {
                return [...prev, {
                    ...product,
                    qty: 1,
                    harga_jual: parseFloat(product.harga_jual || 0)
                }];
            }
        });
    };

    const updateQty = (kode_brg, delta) => {
        setCart(prev => prev.map(item => {
            if (item.kode_brg === kode_brg) {
                const newQty = item.qty + delta;
                if (newQty < 1) return item; // Cannot be less than 1
                
                // cek stok hanya untuk barang fisik (kd_tipe_brg == 1)
                if ((item.kd_tipe_brg === undefined || parseInt(item.kd_tipe_brg) === 1) && delta > 0 && newQty > item.jml_sat_kcl) {
                    Swal.fire('Stok Tidak Cukup', `Sisa stok hanya ${item.jml_sat_kcl}`, 'warning');
                    return item;
                }
                return { ...item, qty: newQty };
            }
            return item;
        }));
    };

    const removeFromCart = (kode_brg) => {
        setCart(prev => prev.filter(item => item.kode_brg !== kode_brg));
    };

    // Calculations
    const subtotal = useMemo(() => {
        return cart.reduce((acc, item) => acc + (item.harga_jual * item.qty), 0);
    }, [cart]);

    const totalDiscount = useMemo(() => {
        let nominal = parseFloat(discountManual) || 0;
        let percent = parseFloat(discountPers) || 0;
        let fromPercent = (subtotal * percent) / 100;
        return nominal + fromPercent;
    }, [subtotal, discountManual, discountPers]);

    const totalBill = useMemo(() => {
        let adminFee = paymentMethod === 'kredit' ? (parseFloat(admCc) || 0) : 0;
        return (subtotal - totalDiscount) + adminFee;
    }, [subtotal, totalDiscount, paymentMethod, admCc]);

    useEffect(() => {
        if (paymentMethod === 'tunai') {
            setUangDiterima(totalBill);
        }
    }, [totalBill, paymentMethod]);

    const formatRp = (num) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num || 0);
    };

    const handleCheckout = async () => {
        if (cart.length === 0) {
            return Swal.fire('Keranjang Kosong', 'Tambahkan barang terlebih dahulu', 'warning');
        }

        const kembalian = Math.max(0, parseFloat(uangDiterima || 0) - totalBill);

        const payload = {
            items: cart,
            tunai: paymentMethod === 'tunai' ? totalBill : 0,
            uang_diterima: paymentMethod === 'tunai' ? parseFloat(uangDiterima || 0) : 0,
            uang_kembali: paymentMethod === 'tunai' ? kembalian : 0,
            kredit: paymentMethod === 'kredit' ? totalBill : 0,
            debet: paymentMethod === 'debet' ? totalBill : 0,
            adm_cc: paymentMethod === 'kredit' ? parseFloat(admCc || 0) : 0,
            diskon: parseFloat(discountManual || 0),
            diskon_pers: parseFloat(discountPers || 0),
            bill: totalBill
        };

        try {
            Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

            const res = await axios.post('/kasir/checkout', payload);
            const data = res.data;

            if (data.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: `Transaksi sukses. No Reg: ${data.no_registrasi}`,
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup & Buka Struk'
                }).then(() => {
                    // Open the Struk page in a new tab
                    window.open(`/kasir/struk/${data.no_registrasi}`, '_blank');
                });

                setCart([]);
                setDiscountManual(0);
                setDiscountPers(0);
                setAdmCc(0);
                fetchProducts(); // Refresh stock
            } else {
                Swal.fire('Gagal', data.message || 'Terjadi kesalahan', 'error');
            }
        } catch (err) {
            console.error(err);
            const errorMsg = err.response?.data?.message || err.message || 'Terjadi kesalahan jaringan';
            Swal.fire('Gagal', errorMsg, 'error');
        }
    };

    useEffect(() => {
        if (activeTab === 'riwayat') {
            fetchRiwayat();
        }
    }, [activeTab]);

    const fetchRiwayat = async () => {
        setLoadingRiwayat(true);
        try {
            const res = await axios.get('/kasir/riwayat');
            setRiwayat(res.data);
        } catch (err) {
            console.error(err);
        } finally {
            setLoadingRiwayat(false);
        }
    };

    const handleReturParsialClick = async (no_registrasi) => {
        try {
            Swal.fire({ title: 'Memuat...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            const res = await axios.get(`/kasir/transaksi/${no_registrasi}/detail`);
            setReturItems(res.data.map(d => ({...d, qty_retur_input: 0})));
            setReturNoReg(no_registrasi);
            setReturAlasan('');
            Swal.close();
            setShowReturModal(true);
        } catch (err) {
            Swal.fire('Error', 'Gagal memuat detail transaksi', 'error');
        }
    };

    const submitReturParsial = async () => {
        if (!returAlasan) return Swal.fire('Peringatan', 'Alasan retur wajib diisi', 'warning');

        const itemsToReturn = returItems.filter(i => parseFloat(i.qty_retur_input) > 0).map(i => ({
            kode_brg: i.kode_brg,
            qty_retur: parseFloat(i.qty_retur_input)
        }));

        if (itemsToReturn.length === 0) return Swal.fire('Peringatan', 'Isi jumlah barang yang akan diretur (minimal 1 barang)', 'warning');

        try {
            Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            const res = await axios.post(`/kasir/retur-parsial/${returNoReg}`, {
                alasan: returAlasan,
                retur_items: itemsToReturn
            });
            if (res.data.success) {
                Swal.fire('Berhasil', res.data.message, 'success');
                setShowReturModal(false);
                fetchRiwayat();
                fetchProducts();
            } else {
                Swal.fire('Gagal', res.data.message, 'error');
            }
        } catch (err) {
            Swal.fire('Error', err.response?.data?.message || 'Terjadi kesalahan', 'error');
        }
    };

    const handleBatal = (no_registrasi) => {
        Swal.fire({
            title: 'Batalkan Transaksi?',
            text: "Anda wajib memasukkan alasan pembatalan. Stok akan dikembalikan otomatis.",
            input: 'text',
            inputPlaceholder: 'Ketik alasan retur...',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Tutup',
            preConfirm: (alasan) => {
                if (!alasan) {
                    Swal.showValidationMessage('Alasan pembatalan wajib diisi!');
                }
                return alasan;
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    Swal.fire({ title: 'Memproses...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                    const res = await axios.post(`/kasir/batal/${no_registrasi}`, { alasan: result.value });
                    if (res.data.success) {
                        Swal.fire('Berhasil', res.data.message || 'Transaksi dibatalkan.', 'success');
                        fetchRiwayat();
                        fetchProducts();
                    } else {
                        Swal.fire('Gagal', res.data.message, 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', err.response?.data?.message || 'Terjadi kesalahan', 'error');
                }
            }
        });
    };

    return (
        <DashboardLayout>
            <Head title="Point of Sale - Kasir" />

            <div className="pl-container">
                {/* Tabs */}
                <div className="glass-panel" style={{display: 'flex', gap: '10px', marginBottom: '15px', padding: '15px'}}>
                    <button
                        className={`dash-btn ${activeTab === 'kasir' ? 'primary' : 'secondary'}`}
                        onClick={() => setActiveTab('kasir')}
                        style={{ display: 'flex', alignItems: 'center', gap: '8px' }}
                    >
                        <ShoppingCart size={18} /> KASIR PENJUALAN
                    </button>
                    <button
                        className={`dash-btn ${activeTab === 'riwayat' ? 'primary' : 'secondary'}`}
                        onClick={() => setActiveTab('riwayat')}
                        style={{ display: 'flex', alignItems: 'center', gap: '8px' }}
                    >
                        <History size={18} /> RIWAYAT TRANSAKSI
                    </button>
                </div>

                {activeTab === 'kasir' ? (
                    <div className="pos-container">

                        {/* Left Panel - Product Grid */}
                        <div className="pos-left glass-panel">
                        <div className="pos-header">
                            <h2 style={{margin: 0}}><ShoppingCart size={20} style={{display: 'inline', marginRight: 10}}/> Etalase Barang</h2>
                            <div className="pos-search">
                                <Search size={18} />
                                <input
                                    type="text"
                                    placeholder="Cari nama barang..."
                                    value={keyword}
                                    onChange={(e) => setKeyword(e.target.value)}
                                />
                            </div>
                        </div>

                        <div className="pos-products">
                            {loading ? (
                                <div style={{textAlign: 'center', width: '100%', padding: '20px'}}>Memuat barang...</div>
                            ) : products.length > 0 ? (
                                products.map((p) => (
                                    <div key={p.kode_brg} className="pos-product-card" onClick={() => addToCart(p)}>
                                        <div className="pos-product-name">
                                            {p.nama_brg}
                                            {parseInt(p.kd_tipe_brg) === 2 ? 
                                                <span style={{fontSize: '0.7rem', background: '#10b981', color: 'white', padding: '2px 5px', borderRadius: '4px', marginLeft: '5px', verticalAlign: 'middle'}}>JASA</span> :
                                                <span style={{fontSize: '0.7rem', background: '#3b82f6', color: 'white', padding: '2px 5px', borderRadius: '4px', marginLeft: '5px', verticalAlign: 'middle'}}>BARANG</span>
                                            }
                                        </div>
                                        <div>
                                            <div className="pos-product-price">{formatRp(p.harga_jual)}</div>
                                            {(!p.kd_tipe_brg || parseInt(p.kd_tipe_brg) === 1) ? (
                                                <div className="pos-product-stock">Sisa Stok: {parseFloat(p.jml_sat_kcl)} {p.satuan_kecil}</div>
                                            ) : (
                                                <div className="pos-product-stock" style={{visibility: 'hidden'}}>Sisa Stok: -</div>
                                            )}
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div style={{textAlign: 'center', width: '100%', padding: '20px'}}>Tidak ada barang (stok habis / tidak ditemukan)</div>
                            )}
                        </div>
                        
                        {/* Pagination Controls (Frozen at bottom) */}
                        {lastPage > 1 && (
                            <div style={{display: 'flex', justifyContent: 'center', alignItems: 'center', gap: '15px', padding: '10px 0', borderTop: '1px solid rgba(255,255,255,0.1)'}}>
                                <button 
                                    className="dash-btn secondary" 
                                    onClick={() => fetchProducts(keyword, currentPage - 1)}
                                    disabled={currentPage <= 1 || loading}
                                    style={{padding: '8px 15px'}}
                                >
                                    &laquo; Sebelumnya
                                </button>
                                <span style={{fontWeight: 'bold', fontSize: '0.9rem', color: 'var(--text-color, #e5e7eb)'}}>
                                    Halaman {currentPage} dari {lastPage}
                                </span>
                                <button 
                                    className="dash-btn secondary" 
                                    onClick={() => fetchProducts(keyword, currentPage + 1)}
                                    disabled={currentPage >= lastPage || loading}
                                    style={{padding: '8px 15px'}}
                                >
                                    Selanjutnya &raquo;
                                </button>
                            </div>
                        )}
                    </div>

                    {/* Right Panel - Cart */}
                    <div className="pos-right glass-panel pos-cart-panel">
                        
                        {/* AI Recommendation Panel */}
                        {recommendations.length > 0 && (
                            <div className="ai-recommendation-panel">
                                <div className="ai-recommendation-header">
                                    <Sparkles size={16} /> Pelanggan Lain Juga Membeli
                                </div>
                                <div className="ai-recommendation-list">
                                    {recommendations.map(item => (
                                        <div key={item.kode_brg} className="ai-item-card" onClick={() => addToCart({...item, jml_sat_kcl: item.jml_sat_kcl || 999, satuan_kecil: item.satuan_kecil || 'PCS'})}>
                                            <div className="ai-item-name">{item.nama_brg}</div>
                                            <div style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginTop: '10px'}}>
                                                <div className="ai-item-price">{formatRp(item.harga_jual)}</div>
                                                <button className="ai-item-btn" onClick={(e) => { e.stopPropagation(); addToCart({...item, jml_sat_kcl: item.jml_sat_kcl || 999, satuan_kecil: item.satuan_kecil || 'PCS'}); }}><Plus size={14} /> Tambah</button>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        )}

                        <h3 className="pos-cart-header">Keranjang Belanja</h3>

                        <div className="pos-cart-items">
                            {cart.length === 0 && <div style={{textAlign: 'center', color: '#888', marginTop: 20}}>Keranjang masih kosong</div>}
                            {cart.map((item) => (
                                <div key={item.kode_brg} className="pos-cart-item">
                                    <div className="pos-cart-item-info">
                                        <div className="pos-cart-item-name">
                                            {item.nama_brg}
                                            {parseInt(item.kd_tipe_brg) === 2 && <span style={{fontSize: '0.65rem', background: '#10b981', color: 'white', padding: '1px 4px', borderRadius: '4px', marginLeft: '5px'}}>JASA</span>}
                                        </div>
                                        <div className="pos-cart-item-price">{formatRp(item.harga_jual)} x {item.qty}</div>
                                    </div>
                                    <div className="pos-cart-item-qty">
                                        <button className="pos-qty-btn" onClick={() => updateQty(item.kode_brg, -1)}><Minus size={14}/></button>
                                        <span>{item.qty}</span>
                                        <button className="pos-qty-btn" onClick={() => updateQty(item.kode_brg, 1)}><Plus size={14}/></button>
                                        <button className="pos-qty-btn" style={{background: 'var(--danger-color, #ef4444)'}} onClick={() => removeFromCart(item.kode_brg)}>
                                            <Trash2 size={14} />
                                        </button>
                                    </div>
                                </div>
                            ))}
                        </div>

                        <div className="pos-summary">
                            <div className="pos-payment-methods">
                                <button className={`pos-pay-method ${paymentMethod === 'tunai' ? 'active' : ''}`} onClick={() => setPaymentMethod('tunai')}>
                                    <Banknote size={16} /> Tunai
                                </button>
                                <button className={`pos-pay-method ${paymentMethod === 'debet' ? 'active' : ''}`} onClick={() => setPaymentMethod('debet')}>
                                    <Wallet size={16} /> Debit
                                </button>
                                <button className={`pos-pay-method ${paymentMethod === 'kredit' ? 'active' : ''}`} onClick={() => setPaymentMethod('kredit')}>
                                    <CreditCard size={16} /> Kredit
                                </button>
                            </div>

                            <div className="pos-input-group" style={{flexDirection: 'row', gap: 10}}>
                                <div style={{flex: 1}}>
                                    <label className="form-label">Diskon (Rp)</label>
                                    <input type="number" value={discountManual} onChange={(e) => setDiscountManual(e.target.value)} min="0" />
                                </div>
                                <div style={{flex: 1}}>
                                    <label className="form-label">Diskon (%)</label>
                                    <input type="number" value={discountPers} onChange={(e) => setDiscountPers(e.target.value)} min="0" max="100" />
                                </div>
                            </div>

                            {paymentMethod === 'kredit' && (
                                <div className="pos-input-group">
                                    <label className="form-label">Biaya Admin CC (Rp)</label>
                                    <input type="number" value={admCc} onChange={(e) => setAdmCc(e.target.value)} min="0" />
                                </div>
                            )}

                            <div className="pos-summary-row" style={{marginTop: 10}}>
                                <span>Subtotal</span>
                                <span>{formatRp(subtotal)}</span>
                            </div>

                            {totalDiscount > 0 && (
                                <div className="pos-summary-row" style={{color: 'var(--danger-color, #ef4444)'}}>
                                    <span>Diskon</span>
                                    <span>-{formatRp(totalDiscount)}</span>
                                </div>
                            )}

                            {paymentMethod === 'kredit' && parseFloat(admCc) > 0 && (
                                <div className="pos-summary-row" style={{color: 'var(--warning-color, #f59e0b)'}}>
                                    <span>Admin CC</span>
                                    <span>+{formatRp(admCc)}</span>
                                </div>
                            )}

                            <div className="pos-summary-row total">
                                <span>Total Tagihan</span>
                                <span>{formatRp(totalBill)}</span>
                            </div>

                            {paymentMethod === 'tunai' && (
                                <>
                                    <div className="pos-input-group" style={{marginTop: 15}}>
                                        <label className="form-label">Nominal Pembayaran (Tunai)</label>
                                        <input
                                            type="number"
                                            value={uangDiterima}
                                            onChange={(e) => setUangDiterima(e.target.value)}
                                            min="0"
                                            style={{fontSize: '1.2rem', padding: '10px'}}
                                        />
                                    </div>
                                    <div className="pos-summary-row total" style={{marginTop: 10, background: 'var(--success-color, #10b981)', color: 'white', padding: '10px', borderRadius: '8px'}}>
                                        <span>Kembalian</span>
                                        <span>{formatRp(Math.max(0, parseFloat(uangDiterima || 0) - totalBill))}</span>
                                    </div>
                                </>
                            )}

                            <button
                                className="pos-checkout-btn"
                                onClick={handleCheckout}
                                disabled={cart.length === 0}
                            >
                                Proses Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
                ) : (
                    <div className="glass-panel table-wrap">
                        <div className="pos-header" style={{marginBottom: 20}}>
                            <h2 style={{margin: 0}}><History size={20} style={{display: 'inline', marginRight: 10}}/> Riwayat Transaksi Hari Ini</h2>
                        </div>

                        <div className="dash-table">
                            <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Waktu</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {loadingRiwayat ? (
                                        <tr><td colSpan="5" style={{textAlign: 'center'}}>Memuat riwayat...</td></tr>
                                    ) : riwayat.length > 0 ? (
                                        riwayat.map((r, i) => {
                                            const isBatal = parseInt(r.status_batal) === 1;
                                            return (
                                                <tr key={i} style={{opacity: isBatal ? 0.6 : 1}}>
                                                    <td style={{ padding: '12px 10px', verticalAlign: 'middle' }}>{r.no_registrasi}</td>
                                                    <td style={{ padding: '12px 10px', verticalAlign: 'middle' }}>{r.tgl_jam ? new Date(r.tgl_jam).toLocaleString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute:'2-digit' }) : '-'}</td>
                                                    <td style={{ padding: '12px 10px', verticalAlign: 'middle' }}>{new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(parseFloat(r.bill || 0))}</td>
                                                    <td style={{ padding: '12px 10px', verticalAlign: 'middle' }}>
                                                        {isBatal ? (
                                                            <span style={{color: 'var(--danger-color, #ef4444)', fontWeight: 'bold'}}>
                                                                <XCircle size={14} style={{verticalAlign:'middle'}}/> Batal
                                                            </span>
                                                        ) : (
                                                            <span style={{color: 'var(--success-color, #10b981)', fontWeight: 'bold'}}>Sukses</span>
                                                        )}
                                                    </td>
                                                    <td style={{ padding: '12px 10px', verticalAlign: 'middle' }}>
                                                        <button
                                                            className="dash-btn primary"
                                                            onClick={() => window.open(`/kasir/struk/${r.no_registrasi}`, '_blank')}
                                                            style={{ padding: '0.35rem 0.6rem', fontSize: '0.8rem', marginRight: '8px' }}
                                                            title="Cetak Ulang"
                                                        >
                                                            <Printer size={14} />
                                                        </button>

                                                        {!isBatal && (
                                                            <>
                                                                <button
                                                                    className="dash-btn secondary"
                                                                    onClick={() => handleReturParsialClick(r.no_registrasi)}
                                                                    style={{ padding: '0.35rem 0.6rem', fontSize: '0.8rem', color: '#f59e0b', marginRight: '8px', borderColor: '#f59e0b' }}
                                                                    title="Retur Sebagian"
                                                                >
                                                                    <Undo2 size={14} />
                                                                </button>
                                                                <button
                                                                    className="dash-btn secondary"
                                                                    onClick={() => handleBatal(r.no_registrasi)}
                                                                    style={{ padding: '0.35rem 0.6rem', fontSize: '0.8rem', color: '#ef4444' }}
                                                                    title="Batalkan Seluruh Transaksi (Batal Total)"
                                                                >
                                                                    <Trash2 size={14} />
                                                                </button>
                                                            </>
                                                        )}
                                                    </td>
                                                </tr>
                                            );
                                        })
                                    ) : (
                                        <tr>
                                            <td colSpan="5">
                                                <div className="empty-state">
                                                    <History className="empty-icon" />
                                                    <p>Tidak ada transaksi hari ini.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                )}
            </div>

            {/* Modal Retur Parsial */}
            {showReturModal && (
                <div style={{
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
                    backgroundColor: 'rgba(0,0,0,0.5)', zIndex: 9999,
                    display: 'flex', alignItems: 'center', justifyContent: 'center'
                }}>
                    <div className="glass-panel" style={{ width: '600px', maxWidth: '90%', padding: '20px', borderRadius: '10px' }}>
                        <h3 style={{ marginTop: 0, marginBottom: '20px', display: 'flex', alignItems: 'center', gap: '10px' }}>
                            <Undo2 size={24} /> Retur Sebagian (Parsial) - {returNoReg}
                        </h3>

                        <div className="dash-table" style={{ maxHeight: '300px', overflowY: 'auto', marginBottom: '20px' }}>
                            <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Qty Beli</th>
                                        <th>Sdh Retur</th>
                                        <th>Hrg/Item</th>
                                        <th style={{width: '100px'}}>Qty Retur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {returItems.map((item, idx) => {
                                        const maxRetur = parseFloat(item.qty) - parseFloat(item.qty_retur || 0);
                                        return (
                                            <tr key={idx}>
                                                <td>{item.nama_brg}</td>
                                                <td>{parseFloat(item.qty)}</td>
                                                <td>{parseFloat(item.qty_retur || 0)}</td>
                                                <td>{formatRp(item.harga_jual)}</td>
                                                <td>
                                                    <input
                                                        type="number"
                                                        min="0"
                                                        max={maxRetur}
                                                        value={item.qty_retur_input}
                                                        onChange={(e) => {
                                                            let val = parseFloat(e.target.value) || 0;
                                                            if (val < 0) val = 0;
                                                            if (val > maxRetur) val = maxRetur;
                                                            const newItems = [...returItems];
                                                            newItems[idx].qty_retur_input = val;
                                                            setReturItems(newItems);
                                                        }}
                                                        style={{ width: '100%', padding: '5px', borderRadius: '5px', border: '1px solid #ccc', background: 'transparent', color: 'inherit' }}
                                                    />
                                                </td>
                                            </tr>
                                        );
                                    })}
                                </tbody>
                            </table>
                        </div>

                        <div style={{ marginBottom: '20px' }}>
                            <label style={{ display: 'block', marginBottom: '5px' }}>Alasan Retur (Wajib)</label>
                            <input
                                type="text"
                                className="search-input"
                                style={{ width: '100%' }}
                                placeholder="Contoh: Pasien salah beli dosis obat..."
                                value={returAlasan}
                                onChange={(e) => setReturAlasan(e.target.value)}
                            />
                        </div>

                        <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '10px' }}>
                            <button className="dash-btn secondary" onClick={() => setShowReturModal(false)}>Batal</button>
                            <button className="dash-btn primary" onClick={submitReturParsial}>Proses Retur</button>
                        </div>
                    </div>
                </div>
            )}

            {/* Frozen Footer */}
            <div className="kasir-footer" style={{
                height: '40px',
                background: 'rgba(255, 255, 255, 0.05)',
                backdropFilter: 'blur(10px)',
                borderTop: '1px solid rgba(255, 255, 255, 0.1)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                fontSize: '0.85rem',
                color: 'var(--text-muted, #9ca3af)',
                zIndex: 40
            }}>
                &copy; {new Date().getFullYear()} Sistem ERP - Modul Kasir Terpadu
            </div>
        </DashboardLayout>
    );
}
