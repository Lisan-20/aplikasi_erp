import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Plus, Search, FileText, CheckCircle, Truck, XCircle, Printer, ShoppingCart } from 'lucide-react';
import dayjs from 'dayjs';


export default function PoIndex({ pos, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');

    useEffect(() => {
        const delayDebounceFn = setTimeout(() => {
            if (searchTerm !== (filters.search || '')) {
                router.get('/pengadaan/po', { search: searchTerm }, { preserveState: true, replace: true });
            }
        }, 500);

        return () => clearTimeout(delayDebounceFn);
    }, [searchTerm]);

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/pengadaan/po', { search: searchTerm }, { preserveState: true, replace: true });
    };

    const getStatusBadge = (statusKirim) => {
        switch (parseInt(statusKirim)) {
            case 0:
                return <span className="status-badge" style={{ background: 'rgba(245, 158, 11, 0.15)', color: '#f59e0b', border: '1px solid rgba(245, 158, 11, 0.3)' }}>Belum Dikirim</span>;
            case 1:
                return <span className="status-badge" style={{ background: 'rgba(59, 130, 246, 0.15)', color: '#3b82f6', border: '1px solid rgba(59, 130, 246, 0.3)' }}>Kirim Parsial</span>;
            case 2:
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

                <div className="glass-panel table-wrap">
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

                    <div className="dash-table">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                    <th>No PO</th>
                                    <th>Tanggal PO</th>
                                    <th>Supplier</th>
                                    <th style={{ textAlign: 'center' }}>Jml Item</th>
                                    <th>Total Nilai (Rp)</th>
                                    <th>Tgl ACC</th>
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
                                            <td>{item.nama_supplier || '-'}</td>
                                            <td style={{ textAlign: 'center' }}>
                                                <span style={{ background: 'rgba(255,255,255,0.1)', padding: '4px 10px', borderRadius: '6px', fontWeight: 'bold' }}>
                                                    {item.jml_brg}
                                                </span>
                                            </td>
                                            <td style={{ fontWeight: '600' }}>
                                                Rp {parseInt(item.total_nilai || 0).toLocaleString('id-ID')}
                                            </td>
                                            <td style={{ color: 'var(--text-muted)' }}>
                                                {item.tgl_acc ? dayjs(item.tgl_acc).format('DD MMM YYYY HH:mm') : '-'}
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
                </div>

                {/* Pagination */}
                {pos.links && pos.links.length > 3 && (
                    <div className="pagination">
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
        </DashboardLayout>
    );
}
