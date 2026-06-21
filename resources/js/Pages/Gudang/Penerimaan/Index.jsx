import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Plus, Search, FileCheck, PackageOpen } from 'lucide-react';
import dayjs from 'dayjs';

export default function PenerimaanIndex({ penerimaan, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/penerimaan', { search: searchTerm }, { preserveState: true });
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
                                            <td style={{ color: 'var(--color-primary)', fontWeight: '500' }}>{item.no_po}</td>
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
        </DashboardLayout>
    );
}
