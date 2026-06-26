import React, { useState } from 'react';
import { Head, Link, router, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, CheckCircle2, FileCheck, Eye, X, Receipt } from 'lucide-react';
import dayjs from 'dayjs';
import Swal from 'sweetalert2';
import { useEffect } from 'react';

export default function AccPurchasingIndex({ pos, filters }) {
    const { flash, errors } = usePage().props;
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [statusFilter, setStatusFilter] = useState(filters.status || 'belum');
    const [selectedPo, setSelectedPo] = useState(null);

    useEffect(() => {
        if (flash?.success) {
            Swal.fire('Berhasil', flash.success, 'success');
        }
        if (errors?.error) {
            Swal.fire('Gagal', errors.error, 'error');
        } else if (Object.keys(errors).length > 0) {
            Swal.fire('Gagal', Object.values(errors)[0], 'error');
        }
    }, [flash, errors]);

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/manajemen/acc-purchasing', { search: searchTerm, status: statusFilter }, { preserveState: true });
    };

    const handleStatusFilter = (val) => {
        setStatusFilter(val);
        router.get('/manajemen/acc-purchasing', { search: searchTerm, status: val }, { preserveState: true });
    };

    const handleApprove = (id, kode) => {
        Swal.fire({
            title: 'Setujui PO?',
            text: `Anda akan menyetujui Purchase Order: ${kode}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                router.post(`/manajemen/acc-purchasing/${id}/approve`, {}, {
                    onSuccess: () => {
                        setSelectedPo(null);
                    }
                });
            }
        });
    };

    const handleReject = (id, kode) => {
        Swal.fire({
            title: 'Tolak / Revisi PO?',
            text: `Masukkan alasan penolakan/revisi untuk PO: ${kode}`,
            input: 'textarea',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Tolak & Kembalikan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                router.post(`/manajemen/acc-purchasing/${id}/reject`, { alasan: result.value }, {
                    onSuccess: () => {
                        setSelectedPo(null);
                    }
                });
            } else if (result.isConfirmed && !result.value) {
                Swal.fire('Gagal', 'Alasan penolakan harus diisi!', 'error');
            }
        });
    };

    return (
        <DashboardLayout title="ACC PO - Manajemen">
            <Head title="ACC PO - Manajemen" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>ACC Purchase Order (PO)</h1>
                        <p>Verifikasi dan persetujuan pesanan pembelian ke supplier</p>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: 0, overflow: 'hidden', display: 'flex', flexDirection: 'column' }}>
                    <div style={{ padding: '20px', borderBottom: '1px solid rgba(255,255,255,0.1)', display: 'flex', gap: '20px', alignItems: 'center', flexWrap: 'wrap' }}>
                        <div style={{ display: 'flex', gap: '10px', background: 'rgba(0,0,0,0.2)', padding: '5px', borderRadius: '8px' }}>
                            <button
                                onClick={() => handleStatusFilter('belum')}
                                className={`dash-btn ${statusFilter === 'belum' ? 'primary' : 'secondary'}`}
                                style={{ border: 'none' }}
                            >
                                Menunggu ACC
                            </button>
                            <button
                                onClick={() => handleStatusFilter('sudah')}
                                className={`dash-btn ${statusFilter === 'sudah' ? 'primary' : 'secondary'}`}
                                style={{ border: 'none' }}
                            >
                                Sudah ACC
                            </button>
                        </div>

                        <form onSubmit={handleSearch} style={{ flex: 1, minWidth: '250px' }}>
                            <div className="search-input-wrapper">
                                <Search className="search-icon" />
                                <input
                                    type="text"
                                    placeholder="Cari No PO atau Supplier..."
                                    className="search-input"
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                />
                            </div>
                        </form>
                    </div>

                    <div style={{ display: 'flex', flex: 1 }}>
                        {/* List PO */}
                        <div style={{ flex: selectedPo ? 1 : 1, transition: 'all 0.3s', borderRight: selectedPo ? '1px solid rgba(255,255,255,0.1)' : 'none' }} className="dash-table-wrap">
                            <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th>No PO</th>
                                        <th>Tanggal PO</th>
                                        <th>Supplier</th>
                                        <th>Total Nilai</th>
                                        <th style={{ textAlign: 'center' }}>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {pos.data.length > 0 ? pos.data.map((item, i) => (
                                        <tr key={i} className={selectedPo?.id === item.id ? 'active-row' : ''}>
                                            <td style={{ fontWeight: '500', color: 'var(--text-main)' }}>{item.no_po}</td>
                                            <td>{dayjs(item.tgl_po).format('DD MMM YYYY')}</td>
                                            <td>{item.supplier?.nama_supplier || '-'}</td>
                                            <td>Rp {parseInt(item.total_stl_ppn || 0).toLocaleString('id-ID')}</td>
                                            <td style={{ textAlign: 'center' }}>
                                                <button
                                                    onClick={() => setSelectedPo(item)}
                                                    className="btn-icon"
                                                    title="Lihat Detail"
                                                    style={{ color: '#60a5fa', background: 'rgba(96, 165, 250, 0.1)' }}
                                                >
                                                    <Eye size={16} />
                                                </button>
                                            </td>
                                        </tr>
                                    )) : (
                                        <tr>
                                            <td colSpan="5" className="empty-state-td">
                                                <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: '10px' }}>
                                                    <Receipt size={40} style={{ opacity: 0.3 }} />
                                                    <p style={{ margin: 0 }}>Tidak ada data PO yang ditemukan.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                            {/* Pagination */}
                            {pos.links && pos.links.length > 3 && (
                                <div className="pagination" style={{ padding: '20px' }}>
                                    {pos.links.map((link, i) => {
                                        let label = link.label;
                                        if (label.includes('Previous')) label = '«';
                                        if (label.includes('Next')) label = '»';
                                        return link.url ? (
                                            <Link key={i} href={link.url} className={`page-link ${link.active ? 'active' : ''}`} dangerouslySetInnerHTML={{ __html: label }} />
                                        ) : (
                                            <span key={i} className="page-link disabled" dangerouslySetInnerHTML={{ __html: label }} />
                                        );
                                    })}
                                </div>
                            )}
                        </div>

                        {/* Detail PO Panel */}
                        {selectedPo && (
                            <div style={{ width: '40%', minWidth: '350px', background: 'rgba(0,0,0,0.1)', padding: '20px', display: 'flex', flexDirection: 'column' }}>
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
                                    <h3 style={{ margin: 0, fontWeight: 'bold' }}>Detail PO</h3>
                                    <button onClick={() => setSelectedPo(null)} className="btn-icon" style={{ color: 'var(--text-muted)' }}>
                                        <X size={20} />
                                    </button>
                                </div>

                                <div style={{ background: 'rgba(255,255,255,0.05)', padding: '15px', borderRadius: '8px', marginBottom: '20px' }}>
                                    <div style={{ display: 'grid', gridTemplateColumns: '100px 1fr', gap: '10px', fontSize: '0.9rem' }}>
                                        <div style={{ color: 'var(--text-muted)' }}>No PO</div>
                                        <div style={{ fontWeight: '500' }}>{selectedPo.no_po}</div>
                                        
                                        <div style={{ color: 'var(--text-muted)' }}>Supplier</div>
                                        <div>{selectedPo.supplier?.nama_supplier || '-'}</div>

                                        <div style={{ color: 'var(--text-muted)' }}>Tanggal PO</div>
                                        <div>{dayjs(selectedPo.tgl_po).format('DD MMM YYYY')}</div>

                                        <div style={{ color: 'var(--text-muted)' }}>Status</div>
                                        <div>
                                            {parseInt(selectedPo.status) === 0 ? <span style={{ color: '#f59e0b' }}>Menunggu ACC</span> : 
                                             parseInt(selectedPo.status) === 1 ? <span style={{ color: '#10b981' }}>Telah di-ACC</span> : 
                                             parseInt(selectedPo.status) === 2 ? <span style={{ color: '#ef4444' }}>Direvisi</span> : 
                                             <span>Status {selectedPo.status}</span>}
                                        </div>
                                    </div>
                                </div>

                                <div style={{ flex: 1, overflowY: 'auto', marginBottom: '20px' }}>
                                    <h4 style={{ fontSize: '0.95rem', fontWeight: 'bold', marginBottom: '10px' }}>Item Pesanan ({selectedPo.jml_brg})</h4>
                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '10px' }}>
                                        {selectedPo.details && selectedPo.details.map((item, idx) => (
                                            <div key={idx} style={{ background: 'rgba(255,255,255,0.03)', padding: '12px', borderRadius: '8px', border: '1px solid rgba(255,255,255,0.05)' }}>
                                                <div style={{ fontWeight: '500', marginBottom: '2px' }}>{item.nama_brg || item.kode_brg}</div>
                                                <div style={{ display: 'flex', justifyContent: 'space-between', fontSize: '0.85rem', color: 'var(--text-muted)' }}>
                                                    <span>{item.kode_brg} | {item.qty_pesan} x Rp {parseInt(item.harga_satuan).toLocaleString('id-ID')}</span>
                                                    <span style={{ fontWeight: '600', color: 'var(--text-main)' }}>Rp {parseInt(item.subtotal).toLocaleString('id-ID')}</span>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                <div style={{ background: 'rgba(255,255,255,0.05)', padding: '15px', borderRadius: '8px', marginBottom: '20px' }}>
                                    <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '5px', fontSize: '0.9rem' }}>
                                        <span style={{ color: 'var(--text-muted)' }}>Subtotal</span>
                                        <span>Rp {parseInt(selectedPo.total_sbl_ppn || 0).toLocaleString('id-ID')}</span>
                                    </div>
                                    <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '10px', fontSize: '0.9rem' }}>
                                        <span style={{ color: 'var(--text-muted)' }}>PPN ({selectedPo.ppn_persen}%)</span>
                                        <span>Rp {parseInt(selectedPo.ppn_nominal || 0).toLocaleString('id-ID')}</span>
                                    </div>
                                    <div style={{ display: 'flex', justifyContent: 'space-between', fontWeight: 'bold', borderTop: '1px solid rgba(255,255,255,0.1)', paddingTop: '10px' }}>
                                        <span>Total Tagihan</span>
                                        <span style={{ color: '#10b981' }}>Rp {parseInt(selectedPo.total_stl_ppn || 0).toLocaleString('id-ID')}</span>
                                    </div>
                                </div>

                                {parseInt(selectedPo.status) === 0 && (
                                    <div style={{ display: 'flex', gap: '10px' }}>
                                        <button
                                            onClick={() => handleReject(selectedPo.id, selectedPo.no_po)}
                                            className="dash-btn secondary"
                                            style={{ flex: 1, justifyContent: 'center', padding: '12px', color: '#ef4444', borderColor: 'rgba(239, 68, 68, 0.3)' }}
                                        >
                                            <X size={20} />
                                            <span>Tolak / Revisi</span>
                                        </button>
                                        <button
                                            onClick={() => handleApprove(selectedPo.id, selectedPo.no_po)}
                                            className="dash-btn primary"
                                            style={{ flex: 1, justifyContent: 'center', padding: '12px' }}
                                        >
                                            <CheckCircle2 size={20} />
                                            <span>Setujui PO</span>
                                        </button>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
