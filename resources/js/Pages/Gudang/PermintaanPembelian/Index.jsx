import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, FileText, CheckCircle2, Clock } from 'lucide-react';
import dayjs from 'dayjs';


export default function PermintaanPembelianIndex({ prs, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');

    useEffect(() => {
        const delayDebounceFn = setTimeout(() => {
            if (searchTerm !== (filters.search || '')) {
                router.get('/gudang/permintaan-pembelian', { search: searchTerm }, { preserveState: true, replace: true });
            }
        }, 500);

        return () => clearTimeout(delayDebounceFn);
    }, [searchTerm]);

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/permintaan-pembelian', { search: searchTerm }, { preserveState: true, replace: true });
    };

    const getStatusBadge = (no_acc) => {
        if (no_acc) {
            return (
                <span className="status-badge" style={{ background: 'rgba(16, 185, 129, 0.15)', color: '#10b981', border: '1px solid rgba(16, 185, 129, 0.3)' }}>
                    Di-ACC
                </span>
            );
        }
        return (
            <span className="status-badge" style={{ background: 'rgba(245, 158, 11, 0.15)', color: '#f59e0b', border: '1px solid rgba(245, 158, 11, 0.3)' }}>
                Menunggu ACC
            </span>
        );
    };

    return (
        <DashboardLayout>
            <Head title="Permintaan Pembelian - Gudang" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Permintaan Pembelian (PR)</h1>
                        <p>Daftar permintaan pembelian dari unit ke purchasing</p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        <Link
                            href="/gudang/permintaan-pembelian/create"
                            className="dash-btn primary"
                        >
                            <Plus size={18} />
                            <span>Buat PR Baru</span>
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ marginBottom: '1rem' }}>
                        <div className="search-input-wrapper flex-1 max-w-md">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                placeholder="Cari Kode PR atau Supplier..."
                                className="search-input"
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="overflow-x-auto w-full">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                    <th>Kode PR</th>
                                    <th>Tgl Permintaan</th>
                                    <th>Supplier Tujuan</th>
                                    <th style={{ textAlign: 'center' }}>Jml Item</th>
                                    <th>Status</th>
                                    <th>Tgl ACC</th>
                                </tr>
                            </thead>
                            <tbody>
                                {prs.data.length > 0 ? (
                                    prs.data.map((item, index) => (
                                        <tr key={index}>
                                            <td style={{ textAlign: 'center' }}>
                                                {(prs.current_page - 1) * prs.per_page + index + 1}
                                            </td>
                                            <td style={{ fontWeight: '500', color: 'var(--text-main)' }}>{item.kode_permohonan}</td>
                                            <td>{dayjs(item.tgl_permohonan).format('DD MMM YYYY HH:mm')}</td>
                                            <td>{item.nama_supplier || '-'}</td>
                                            <td style={{ textAlign: 'center' }}>
                                                <span style={{ background: 'rgba(255,255,255,0.1)', padding: '4px 10px', borderRadius: '6px', fontWeight: 'bold' }}>
                                                    {item.jml_brg}
                                                </span>
                                            </td>
                                            <td>{getStatusBadge(item.no_acc)}</td>
                                            <td style={{ color: 'var(--text-muted)' }}>
                                                {item.tgl_acc ? dayjs(item.tgl_acc).format('DD MMM YYYY HH:mm') : '-'}
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="7" className="empty-state-td">
                                            <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: '10px' }}>
                                                <FileText size={40} style={{ opacity: 0.3 }} />
                                                <p style={{ margin: 0 }}>Tidak ada data permintaan pembelian yang ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {prs.links && prs.links.length > 3 && (
                    <div className="pagination">
                        {prs.links.map((link, i) => {
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
