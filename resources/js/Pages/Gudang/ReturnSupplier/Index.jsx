import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, FileCheck, PackageMinus, RefreshCcw, X, Info } from 'lucide-react';
import dayjs from 'dayjs';

export default function ReturnSupplierIndex({ lpb, rb, filters }) {
    const [activeTab, setActiveTab] = useState('lpb');
    const [searchLpb, setSearchLpb] = useState(filters.search_lpb || '');
    const [searchRb, setSearchRb] = useState(filters.search_rb || '');

    // Modal state
    const [selectedRb, setSelectedRb] = useState(null);
    const [rbDetails, setRbDetails] = useState([]);
    const [loadingDetails, setLoadingDetails] = useState(false);

    const handleSearchLpb = (e) => {
        e.preventDefault();
        router.get('/gudang/return-supplier', { search_lpb: searchLpb, search_rb: filters.search_rb }, { preserveState: true });
    };

    const handleSearchRb = (e) => {
        e.preventDefault();
        router.get('/gudang/return-supplier', { search_lpb: filters.search_lpb, search_rb: searchRb }, { preserveState: true });
    };

    const handleShowRbDetails = async (rb) => {
        setSelectedRb(rb);
        setLoadingDetails(true);
        try {
            const response = await fetch(`/gudang/api/return-supplier/${rb.kode_return}/details`);
            if (response.ok) {
                const data = await response.json();
                setRbDetails(data);
            } else {
                console.error("Gagal mengambil detail retur");
                setRbDetails([]);
            }
        } catch (error) {
            console.error("Error fetching RB details:", error);
            setRbDetails([]);
        } finally {
            setLoadingDetails(false);
        }
    };

    return (
        <DashboardLayout title="Return ke Supplier">
            <Head title="Return Supplier" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1 style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                            <PackageMinus size={24} style={{ color: 'var(--color-danger)' }} />
                            Retur Barang (Return to Supplier)
                        </h1>
                        <p>Kelola pengembalian barang dan faktur</p>
                    </div>
                </div>

                {/* Tabs */}
                <div className="glass-panel" style={{ padding: '0', marginBottom: '20px' }}>
                    <div style={{ display: 'flex', borderBottom: '1px solid rgba(255,255,255,0.1)' }}>
                        <button 
                            className={`tab-btn ${activeTab === 'lpb' ? 'active' : ''}`}
                            onClick={() => setActiveTab('lpb')}
                            style={{ padding: '15px 30px', background: 'none', border: 'none', color: activeTab === 'lpb' ? 'var(--color-primary)' : 'var(--text-secondary)', fontWeight: activeTab === 'lpb' ? '600' : '400', borderBottom: activeTab === 'lpb' ? '2px solid var(--color-primary)' : 'none', cursor: 'pointer', flex: 1 }}
                        >
                            Daftar Penerimaan (Siap Retur)
                        </button>
                        <button 
                            className={`tab-btn ${activeTab === 'rb' ? 'active' : ''}`}
                            onClick={() => setActiveTab('rb')}
                            style={{ padding: '15px 30px', background: 'none', border: 'none', color: activeTab === 'rb' ? 'var(--color-primary)' : 'var(--text-secondary)', fontWeight: activeTab === 'rb' ? '600' : '400', borderBottom: activeTab === 'rb' ? '2px solid var(--color-primary)' : 'none', cursor: 'pointer', flex: 1 }}
                        >
                            Riwayat Retur (History)
                        </button>
                    </div>
                </div>

                {activeTab === 'lpb' && (
                    <div className="glass-panel table-wrap fade-in">
                        <div className="search-bar" style={{ padding: '20px 20px 0' }}>
                            <form onSubmit={handleSearchLpb} className="search-input-wrapper" style={{ margin: 0 }}>
                                <Search className="search-icon" />
                                <input
                                    type="text"
                                    className="search-input"
                                    placeholder="Cari Kode Terima / No PO / No Faktur..."
                                    value={searchLpb}
                                    onChange={(e) => setSearchLpb(e.target.value)}
                                />
                            </form>
                        </div>

                        <div className="overflow-x-auto w-full">
                            <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th>Kode Penerimaan</th>
                                        <th>Tanggal</th>
                                        <th>No PO</th>
                                        <th>No Faktur</th>
                                        <th>Supplier</th>
                                        <th style={{ textAlign: 'center' }}>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {lpb.data.length > 0 ? (
                                        lpb.data.map((item) => (
                                            <tr key={item.id_tc_penerimaan_brg_nm}>
                                                <td style={{ fontWeight: '500' }}>{item.kode_penerimaan}</td>
                                                <td>{dayjs(item.tgl_penerimaan).format('DD MMM YYYY')}</td>
                                                <td>{item.no_po}</td>
                                                <td>{item.no_faktur}</td>
                                                <td>{item.namasupplier || '-'}</td>
                                                <td style={{ textAlign: 'center' }}>
                                                    <Link 
                                                        href={`/gudang/return-supplier/create/${item.id_tc_penerimaan_brg_nm}`} 
                                                        className="dash-btn warning" 
                                                        style={{ padding: '6px 12px', fontSize: '0.85rem' }}
                                                    >
                                                        <RefreshCcw size={14} />
                                                        <span>Proses Retur</span>
                                                    </Link>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="6" className="empty-state">
                                                <FileCheck className="empty-icon" />
                                                <p>Tidak ada data Penerimaan Barang.</p>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                        
                        <div className="pagination">
                            {lpb.links.map((link, k) => {
                                let url = link.url;
                                if (url && (searchLpb || searchRb)) {
                                    const separator = url.includes('?') ? '&' : '?';
                                    url = `${url}${separator}search_lpb=${encodeURIComponent(searchLpb)}&search_rb=${encodeURIComponent(searchRb)}`;
                                }
                                return (
                                    <Link
                                        key={k}
                                        href={url || '#'}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                        className={`page-link ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}`}
                                    />
                                );
                            })}
                        </div>
                    </div>
                )}

                {activeTab === 'rb' && (
                    <div className="glass-panel table-wrap fade-in">
                        <div className="search-bar" style={{ padding: '20px 20px 0' }}>
                            <form onSubmit={handleSearchRb} className="search-input-wrapper" style={{ margin: 0 }}>
                                <Search className="search-icon" />
                                <input
                                    type="text"
                                    className="search-input"
                                    placeholder="Cari Kode Retur / LPB..."
                                    value={searchRb}
                                    onChange={(e) => setSearchRb(e.target.value)}
                                />
                            </form>
                        </div>

                        <div className="overflow-x-auto w-full">
                            <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th>Kode Retur (RB)</th>
                                        <th>Tanggal Retur</th>
                                        <th>No LPB Asal</th>
                                        <th>No PO Asal</th>
                                        <th style={{ textAlign: 'right' }}>Total Qty Diretur</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {rb.data.length > 0 ? (
                                        rb.data.map((item) => (
                                            <tr key={item.kode_return}>
                                                <td 
                                                    style={{ fontWeight: '500', color: 'var(--color-primary)', cursor: 'pointer', textDecoration: 'underline' }}
                                                    onClick={() => handleShowRbDetails(item)}
                                                >
                                                    {item.kode_return}
                                                </td>
                                                <td>{dayjs(item.tgl_return).format('DD MMM YYYY HH:mm')}</td>
                                                <td style={{ fontWeight: '500' }}>{item.no_lpb}</td>
                                                <td>{item.no_po}</td>
                                                <td style={{ textAlign: 'right', fontWeight: '600' }}>{Number(item.total_qty_return).toLocaleString('id-ID')}</td>
                                                <td>{item.petugas}</td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="6" className="empty-state">
                                                <FileCheck className="empty-icon" />
                                                <p>Tidak ada data Riwayat Retur.</p>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                        
                        <div className="pagination">
                            {rb.links.map((link, k) => {
                                let url = link.url;
                                if (url && (searchLpb || searchRb)) {
                                    const separator = url.includes('?') ? '&' : '?';
                                    url = `${url}${separator}search_lpb=${encodeURIComponent(searchLpb)}&search_rb=${encodeURIComponent(searchRb)}`;
                                }
                                return (
                                    <Link
                                        key={k}
                                        href={url || '#'}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                        className={`page-link ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}`}
                                    />
                                );
                            })}
                        </div>
                    </div>
                )}
            </div>

            {/* Modal Detail RB */}
            {selectedRb && (
                <div className="modal-backdrop" onClick={() => setSelectedRb(null)}>
                    <div className="modal-content glass-panel" onClick={e => e.stopPropagation()} style={{ maxWidth: '700px', width: '90%' }}>
                        <div className="modal-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px', borderBottom: '1px solid rgba(255,255,255,0.1)', paddingBottom: '15px' }}>
                            <h3 style={{ margin: 0, display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <Info size={20} style={{ color: 'var(--color-primary)' }}/>
                                Rincian {selectedRb.kode_return}
                            </h3>
                            <button onClick={() => setSelectedRb(null)} style={{ background: 'none', border: 'none', color: 'var(--text-secondary)', cursor: 'pointer' }}>
                                <X size={20} />
                            </button>
                        </div>
                        
                        <div className="modal-body">
                            <div style={{ marginBottom: '15px', display: 'flex', gap: '20px', fontSize: '0.9rem', color: 'var(--text-secondary)' }}>
                                <div><strong>No LPB:</strong> {selectedRb.no_lpb}</div>
                                <div><strong>No PO:</strong> {selectedRb.no_po}</div>
                                <div><strong>Petugas:</strong> {selectedRb.petugas}</div>
                            </div>

                            {loadingDetails ? (
                                <div style={{ textAlign: 'center', padding: '30px' }}>Loading...</div>
                            ) : (
                                <div className="overflow-x-auto">
                                    <table className="dash-table">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th style={{ textAlign: 'right' }}>Qty Diretur</th>
                                                <th>Alasan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {rbDetails.length > 0 ? rbDetails.map((det, idx) => (
                                                <tr key={idx}>
                                                    <td>{det.kode_brg}</td>
                                                    <td>{det.nama_brg}</td>
                                                    <td style={{ textAlign: 'right', fontWeight: 'bold' }}>{Number(det.qty_retur).toLocaleString('id-ID')}</td>
                                                    <td>{det.alasan}</td>
                                                </tr>
                                            )) : (
                                                <tr>
                                                    <td colSpan="4" style={{ textAlign: 'center', padding: '20px' }}>Tidak ada rincian barang.</td>
                                                </tr>
                                            )}
                                        </tbody>
                                    </table>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
