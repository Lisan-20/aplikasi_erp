import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, BedDouble, Printer } from 'lucide-react';

export default function PermintaanRi({ data, filters }) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/permintaan-ri', { search }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setSearch('');
        router.get('/registrasi/permintaan-ri');
    };

    return (
        <>
            <Head title="Permintaan Rawat Inap" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Permintaan Ruangan Rawat Inap</h1>
                        <p>Daftar pasien yang memerlukan kamar rawat inap</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="dash-btn secondary">
                            <ArrowLeft size={16} />
                            Kembali
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <form onSubmit={handleSearch} className="search-bar">
                        <div className="search-input-wrapper">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari No. MR atau Nama Pasien..."
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                        </div>
                        <button type="submit" className="dash-btn primary">
                            Cari
                        </button>
                        {filters.search && (
                            <button type="button" onClick={handleClear} className="dash-btn secondary">
                                Reset
                            </button>
                        )}
                    </form>

                    <div className="table-responsive">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No. MR</th>
                                    <th>Nama Pasien</th>
                                    <th>Nasabah</th>
                                    <th>Dirujuk Dari</th>
                                    <th>Tgl Permintaan</th>
                                    <th>Nama Bagian</th>
                                    <th>Nama Dokter</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data.length > 0 ? (
                                    data.data.map((item, index) => (
                                        <tr key={item.no_registrasi}>
                                            <td>
                                                <button className="dash-btn secondary" style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem' }} title="Cetak Permintaan RI">
                                                    <Printer size={14} /> Cetak
                                                </button>
                                            </td>
                                            <td><strong>{item.no_mr}</strong></td>
                                            <td>{item.nama_pasien}</td>
                                            <td>{item.nasabah || '-'}</td>
                                            <td>{item.dirujuk_dari}</td>
                                            <td>{item.tgl_permintaan ? new Date(item.tgl_permintaan).toLocaleString('id-ID') : '-'}</td>
                                            <td>{item.nama_bagian}</td>
                                            <td>{item.nama_dokter}</td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="8">
                                            <div className="empty-state">
                                                <BedDouble className="empty-icon" />
                                                <p>Tidak ada permintaan rawat inap ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                </div>

                {/* Pagination */}
                {data.links && data.links.length > 3 && (
                    <div className="pagination">
                        {data.links.map((link, index) => {
                            let label = link.label;
                            if (label.includes('Previous')) label = '«';
                            if (label.includes('Next')) label = '»';
                            
                            return link.url ? (
                                <Link
                                    key={index}
                                    href={link.url}
                                    className={`page-link ${link.active ? 'active' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: label }}
                                />
                            ) : (
                                <span
                                    key={index}
                                    className="page-link disabled"
                                    dangerouslySetInnerHTML={{ __html: label }}
                                />
                            );
                        })}
                    </div>
                )}
            </div>
        </>
    );
}
