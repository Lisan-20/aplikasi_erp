import React, { useState, useEffect } from 'react';
import { Head, Link, router, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Plus, Search, FileText, CheckCircle, Truck, XCircle, Printer, ShoppingCart, Edit2, Trash2, Eye } from 'lucide-react';
import dayjs from 'dayjs';
import Swal from 'sweetalert2';

export default function PoIndex(props) {
    const { pos, filters, activeTab } = props;
    const { flash, errors } = usePage().props;
    const [searchTerm, setSearchTerm] = useState(filters.search || '');

    useEffect(() => {
        if (flash?.success) {
            Swal.fire('Berhasil', flash.success, 'success');
        }
        if (errors?.error) {
            Swal.fire('Error', errors.error, 'error');
        }
    }, [flash, errors]);

    useEffect(() => {
        const delayDebounceFn = setTimeout(() => {
            if (searchTerm !== (filters.search || '')) {
                router.get('/pengadaan/po', { search: searchTerm, tab: activeTab }, { preserveState: true, replace: true });
            }
        }, 500);

        return () => clearTimeout(delayDebounceFn);
    }, [searchTerm]);

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/pengadaan/po', { search: searchTerm, tab: activeTab }, { preserveState: true, replace: true });
    };

    const changeTab = (tab) => {
        router.get('/pengadaan/po', { search: searchTerm, tab: tab }, { preserveState: true, replace: true });
    };

    const handleDelete = (id) => {
        Swal.fire({
            title: 'Hapus PO?',
            text: "Purchase Order akan dihapus dan PR akan dikembalikan ke status Diajukan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4b5563',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(`/pengadaan/po/${id}`);
            }
        });
    };

    const getStatusBadge = (status) => {
        switch (parseInt(status)) {
            case 0:
                return <span className="status-badge" style={{ background: 'rgba(245, 158, 11, 0.15)', color: '#f59e0b', border: '1px solid rgba(245, 158, 11, 0.3)' }}>Penerbitan (Draft)</span>;
            case 1:
                return <span className="status-badge" style={{ background: 'rgba(59, 130, 246, 0.15)', color: '#3b82f6', border: '1px solid rgba(59, 130, 246, 0.3)' }}>Menunggu Penerimaan</span>;
            case 2:
                return <span className="status-badge" style={{ background: 'rgba(239, 68, 68, 0.15)', color: '#ef4444', border: '1px solid rgba(239, 68, 68, 0.3)' }}>Revisi</span>;
            case 3:
                return <span className="status-badge" style={{ background: 'rgba(107, 114, 128, 0.15)', color: '#9ca3af', border: '1px solid rgba(107, 114, 128, 0.3)' }}>Batal</span>;
            case 4:
                return <span className="status-badge" style={{ background: 'rgba(16, 185, 129, 0.15)', color: '#10b981', border: '1px solid rgba(16, 185, 129, 0.3)' }}>Selesai</span>;
            default:
                return <span className="status-badge" style={{ background: 'rgba(255, 255, 255, 0.1)', color: 'var(--text-muted)' }}>Unknown</span>;
        }
    };

    return (
        <DashboardLayout title="Daftar Purchase Order">
            <Head title="Purchase Order" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Purchase Order (PO)</h1>
                        <p>Daftar pesanan pembelian kepada supplier</p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        <Link
                            href="/pengadaan/po/create"
                            className="dash-btn primary"
                        >
                            <Plus size={18} />
                            <span>Buat PO Baru</span>
                        </Link>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: 0, overflow: 'hidden' }}>
                    {/* Tabs */}
                    <div style={{ display: 'flex', borderBottom: '1px solid rgba(255,255,255,0.1)', background: 'rgba(0,0,0,0.2)' }}>
                        <button 
                            onClick={() => changeTab('penerbitan')}
                            style={{ 
                                flex: 1, padding: '15px 20px', cursor: 'pointer', fontWeight: 'bold', display: 'flex', justifyContent: 'center', alignItems: 'center', gap: '8px', transition: 'all 0.3s',
                                borderBottom: activeTab === 'penerbitan' ? '3px solid #3b82f6' : '3px solid transparent',
                                color: activeTab === 'penerbitan' ? '#3b82f6' : 'var(--text-muted)',
                                background: activeTab === 'penerbitan' ? 'rgba(59, 130, 246, 0.1)' : 'transparent'
                            }}
                        >
                            <ShoppingCart size={18} /> Penerbitan PO
                        </button>
                        <button 
                            onClick={() => changeTab('revisi')}
                            style={{ 
                                flex: 1, padding: '15px 20px', cursor: 'pointer', fontWeight: 'bold', display: 'flex', justifyContent: 'center', alignItems: 'center', gap: '8px', transition: 'all 0.3s',
                                borderBottom: activeTab === 'revisi' ? '3px solid #ef4444' : '3px solid transparent',
                                color: activeTab === 'revisi' ? '#ef4444' : 'var(--text-muted)',
                                background: activeTab === 'revisi' ? 'rgba(239, 68, 68, 0.1)' : 'transparent'
                            }}
                        >
                            <Edit2 size={18} /> Revisi PO
                        </button>
                        <button 
                            onClick={() => changeTab('history')}
                            style={{ 
                                flex: 1, padding: '15px 20px', cursor: 'pointer', fontWeight: 'bold', display: 'flex', justifyContent: 'center', alignItems: 'center', gap: '8px', transition: 'all 0.3s',
                                borderBottom: activeTab === 'history' ? '3px solid #10b981' : '3px solid transparent',
                                color: activeTab === 'history' ? '#10b981' : 'var(--text-muted)',
                                background: activeTab === 'history' ? 'rgba(16, 185, 129, 0.1)' : 'transparent'
                            }}
                        >
                            <CheckCircle size={18} /> History PO
                        </button>
                    </div>

                    <div style={{ padding: '20px' }}>
                        <div className="search-bar" style={{ marginBottom: '1rem' }}>
                            <div className="search-input-wrapper flex-1 max-w-md">
                                <Search className="search-icon" />
                                <input
                                    type="text"
                                    placeholder="Cari No PO atau Supplier..."
                                    className="search-input"
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                />
                            </div>
                        </div>

                        <div className="overflow-x-auto w-full dash-table-wrap">
                            <table className="dash-table">
                                <thead>
                                    <tr>
                                        <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                        <th>No PO</th>
                                        <th>Tanggal PO</th>
                                        <th>Supplier</th>
                                        <th>Total Nilai (Rp)</th>
                                        <th>Status</th>
                                        <th style={{ textAlign: 'center', width: '120px' }}>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {pos.data.length > 0 ? (
                                        pos.data.map((item, index) => (
                                            <tr key={index}>
                                                <td style={{ textAlign: 'center' }}>
                                                    {(pos.current_page - 1) * pos.per_page + index + 1}
                                                </td>
                                                <td style={{ fontWeight: '500', color: 'var(--text-main)' }}>{item.no_po}</td>
                                                <td>{dayjs(item.tgl_po).format('DD MMM YYYY HH:mm')}</td>
                                                <td>{item.supplier?.nama_supplier || '-'}</td>
                                                <td style={{ fontWeight: '600' }}>
                                                    Rp {parseInt(item.total_stl_ppn || 0).toLocaleString('id-ID')}
                                                </td>
                                                <td>{getStatusBadge(item.status)}</td>
                                                <td style={{ textAlign: 'center' }}>
                                                    <div style={{ display: 'flex', gap: '8px', justifyContent: 'center' }}>
                                                        {activeTab === 'revisi' && (
                                                            <Link 
                                                                href={`/pengadaan/po/${item.id}/edit`}
                                                                className="btn-icon" 
                                                                title="Edit / Revisi PO"
                                                                style={{ color: '#60a5fa', background: 'rgba(96, 165, 250, 0.1)' }}
                                                            >
                                                                <Edit2 size={16} />
                                                            </Link>
                                                        )}
                                                        {(activeTab === 'penerbitan' || activeTab === 'revisi') && (
                                                                <button 
                                                                    type="button"
                                                                    onClick={() => handleDelete(item.id)}
                                                                    className="btn-icon" 
                                                                    title="Hapus PO"
                                                                    style={{ color: '#ef4444', background: 'rgba(239, 68, 68, 0.1)' }}
                                                                >
                                                                    <Trash2 size={16} />
                                                                </button>
                                                        )}
                                                        {activeTab === 'history' && (
                                                            <Link 
                                                                href={`/pengadaan/po/${item.id}`}
                                                                className="btn-icon" 
                                                                title="Lihat Detail PO"
                                                                style={{ color: '#8b5cf6', background: 'rgba(139, 92, 246, 0.1)' }}
                                                            >
                                                                <Eye size={16} />
                                                            </Link>
                                                        )}
                                                    </div>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="7" className="empty-state-td">
                                                <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: '10px' }}>
                                                    <ShoppingCart size={40} style={{ opacity: 0.3 }} />
                                                    <p style={{ margin: 0 }}>Tidak ada data purchase order yang ditemukan.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>

                        {/* Pagination */}
                        {pos.links && pos.links.length > 3 && (
                            <div className="pagination" style={{ marginTop: '20px' }}>
                                {pos.links.map((link, i) => {
                                    let label = link.label;
                                    if (label.includes('Previous')) label = '«';
                                    if (label.includes('Next')) label = '»';
                                    
                                    return link.url ? (
                                        <Link
                                            key={i}
                                            href={link.url}
                                            className={`page-link ${link.active ? 'active' : ''}`}
                                            dangerouslySetInnerHTML={{ __html: label }}
                                        />
                                    ) : (
                                        <span
                                            key={i}
                                            className="page-link disabled"
                                            dangerouslySetInnerHTML={{ __html: label }}
                                        />
                                    );
                                })}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
