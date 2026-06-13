import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, Activity, Printer } from 'lucide-react';
import '../../../css/pasien-lama.css';

export default function ListingPoli({ data, filters }) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/listing-poli', { search }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setSearch('');
        router.get('/registrasi/listing-poli');
    };

    return (
        <>
            <Head title="Listing Pasien Poli" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Listing Pasien Poli</h1>
                        <p>Daftar pasien yang mendaftar ke poliklinik</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="btn btn-secondary">
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
                                placeholder="Cari No. MR, Nama, No. SEP, dll..."
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                        </div>
                        <button type="submit" className="btn btn-primary">
                            Cari
                        </button>
                        {filters.search && (
                            <button type="button" onClick={handleClear} className="btn btn-secondary">
                                Reset
                            </button>
                        )}
                    </form>

                    <div className="table-responsive">
                        <table className="pl-table">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Tanggal</th>
                                    <th>No. MR</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama Keluarga</th>
                                    <th>Nasabah</th>
                                    <th>Ruangan/Bagian</th>
                                    <th>Dokter</th>
                                    <th>Catatan Khusus</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data.length > 0 ? (
                                    data.data.map((item) => (
                                        <tr key={item.no_registrasi}>
                                            <td style={{ whiteSpace: 'nowrap' }}>
                                                <button className="btn btn-secondary" style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem', marginRight: '4px' }} title="Cetak GC">
                                                    <Printer size={14} />
                                                </button>
                                                <button className="btn btn-secondary" style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem' }} title="Cetak Slip">
                                                    <Printer size={14} />
                                                </button>
                                            </td>
                                            <td>{item.tanggal ? new Date(item.tanggal).toLocaleString('id-ID') : '-'}</td>
                                            <td><strong>{item.no_mr}</strong></td>
                                            <td>{item.nama_pasien}</td>
                                            <td>{item.nama_keluarga}</td>
                                            <td>{item.nasabah || '-'}</td>
                                            <td>{item.ruangan}</td>
                                            <td>{item.dokter}</td>
                                            <td style={{ color: 'red', fontSize: '0.85rem' }}>{item.catatan_khusus || '-'}</td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="9">
                                            <div className="empty-state">
                                                <Activity className="empty-icon" />
                                                <p>Tidak ada listing pasien poli ditemukan.</p>
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
