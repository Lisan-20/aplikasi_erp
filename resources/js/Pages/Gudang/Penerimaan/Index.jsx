import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Plus, Search, FileCheck, PackageOpen, X, Loader } from 'lucide-react';
import dayjs from 'dayjs';

export default function PenerimaanIndex({ penerimaan, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [showModal, setShowModal] = useState(false);
    const [selectedDetails, setSelectedDetails] = useState([]);
    const [loadingDetails, setLoadingDetails] = useState(false);
    const [selectedLpb, setSelectedLpb] = useState('');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/penerimaan', { search: searchTerm }, { preserveState: true });
    };

    const openDetails = async (item) => {
        setSelectedLpb(item.kode_penerimaan + ' (PO: ' + item.no_po + ')');
        setShowModal(true);
        setLoadingDetails(true);
        try {
            const res = await fetch(`/gudang/api/penerimaan/${item.kode_penerimaan}/details`);
            const data = await res.json();
            setSelectedDetails(data);
        } catch (error) {
            console.error(error);
        } finally {
            setLoadingDetails(false);
        }
    };

    return (
        <DashboardLayout title="Daftar Penerimaan Barang">
            <Head title="Penerimaan Barang" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1 style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                            <PackageOpen size={24} style={{ color: 'var(--color-success)' }} />
                            Penerimaan Barang (Goods Receipt)
                        </h1>
                        <p>Daftar faktur penerimaan dari supplier</p>
                    </div>

                    <div className="pl-actions">
                        <Link href="/gudang/penerimaan/create" className="dash-btn primary">
                            <Plus size={18} />
                            <span>Terima Barang Baru</span>
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ padding: '20px 20px 0' }}>
                        <form onSubmit={handleSearch} className="search-input-wrapper" style={{ margin: 0 }}>
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari Kode Terima / No PO / No Faktur..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
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
                                    <th>Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                {penerimaan.data.length > 0 ? (
                                    penerimaan.data.map((item) => (
                                        <tr key={item.id_tc_penerimaan_brg_nm}>
                                            <td style={{ fontWeight: '500' }}>{item.kode_penerimaan}</td>
                                            <td>{dayjs(item.tgl_penerimaan).format('DD MMM YYYY')}</td>
                                            <td>
                                                <button 
                                                    onClick={() => openDetails(item)}
                                                    style={{ color: 'var(--color-primary)', fontWeight: '600', textDecoration: 'underline', background: 'none', border: 'none', cursor: 'pointer', padding: 0 }}
                                                >
                                                    {item.no_po}
                                                </button>
                                            </td>
                                            <td>{item.no_faktur}</td>
                                            <td>{item.namasupplier || '-'}</td>
                                            <td>{item.petugas}</td>
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
                        {penerimaan.links.map((link, k) => {
                            let url = link.url;
                            if (url && searchTerm) {
                                const separator = url.includes('?') ? '&' : '?';
                                url = `${url}${separator}search=${encodeURIComponent(searchTerm)}`;
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
            </div>

            {/* Modal Detail Penerimaan */}
            {showModal && (
                <div className="modal-overlay" style={{ position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, backgroundColor: 'rgba(0,0,0,0.5)', zIndex: 1000, display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                    <div className="modal-content glass-panel" style={{ width: '90%', maxWidth: '800px', maxHeight: '90vh', overflow: 'auto', padding: '20px' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px', borderBottom: '1px solid rgba(255,255,255,0.1)', paddingBottom: '10px' }}>
                            <h2 style={{ fontSize: '1.25rem', fontWeight: '600', margin: 0 }}>Rincian {selectedLpb}</h2>
                            <button onClick={() => setShowModal(false)} style={{ background: 'none', border: 'none', color: 'var(--text-secondary)', cursor: 'pointer' }}>
                                <X size={24} />
                            </button>
                        </div>
                        
                        {loadingDetails ? (
                            <div style={{ display: 'flex', justifyContent: 'center', padding: '40px' }}>
                                <Loader className="spin" size={32} style={{ color: 'var(--color-primary)' }} />
                            </div>
                        ) : (
                            <div className="overflow-x-auto">
                                <table className="dash-table">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th style={{ textAlign: 'right' }}>Qty Diterima</th>
                                            <th>Satuan</th>
                                            <th style={{ textAlign: 'right' }}>Harga Satuan</th>
                                            <th style={{ textAlign: 'right' }}>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {selectedDetails.length > 0 ? (
                                            selectedDetails.map((det, i) => (
                                                <tr key={i}>
                                                    <td>{det.kode_brg}</td>
                                                    <td style={{ fontWeight: '500' }}>{det.nama_brg}</td>
                                                    <td style={{ textAlign: 'right', fontWeight: '600', color: 'var(--color-success)' }}>{Number(det.qty_terima).toLocaleString('id-ID')}</td>
                                                    <td>{det.satuan}</td>
                                                    <td style={{ textAlign: 'right' }}>Rp {Number(det.harga_satuan).toLocaleString('id-ID')}</td>
                                                    <td style={{ textAlign: 'right', fontWeight: '600' }}>Rp {Number(det.harga_total).toLocaleString('id-ID')}</td>
                                                </tr>
                                            ))
                                        ) : (
                                            <tr>
                                                <td colSpan="6" style={{ textAlign: 'center', padding: '20px' }}>Tidak ada rincian barang.</td>
                                            </tr>
                                        )}
                                        {selectedDetails.length > 0 && (
                                            <tr style={{ background: 'rgba(255,255,255,0.05)' }}>
                                                <td colSpan="5" style={{ textAlign: 'right', fontWeight: 'bold' }}>Total Penerimaan:</td>
                                                <td style={{ textAlign: 'right', fontWeight: 'bold', color: 'var(--color-primary)' }}>
                                                    Rp {selectedDetails.reduce((sum, det) => sum + Number(det.harga_total), 0).toLocaleString('id-ID')}
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
