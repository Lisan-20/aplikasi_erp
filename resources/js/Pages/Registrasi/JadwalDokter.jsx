import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, Calendar } from 'lucide-react';

export default function JadwalDokter({ jadwal, filters }) {
    const [filter, setFilter] = useState(filters.filter || '');
    const [tipeCari, setTipeCari] = useState(filters.tipeCari || 'nama');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/jadwal-dokter', { filter, tipeCari }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setFilter('');
        setTipeCari('nama');
        router.get('/registrasi/jadwal-dokter');
    };

    return (
        <>
            <Head title="Jadwal Dokter" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Jadwal Dokter</h1>
                        <p>Daftar jadwal praktek dokter</p>
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
                        <div className="form-group" style={{ flex: '0 0 200px' }}>
                            <select
                                className="form-input"
                                value={tipeCari}
                                onChange={(e) => setTipeCari(e.target.value)}
                            >
                                <option value="nama">Nama Dokter</option>
                                <option value="bagian">Bagian</option>
                                <option value="spesialis">Spesialisasi</option>
                                <option value="hari">Hari</option>
                            </select>
                        </div>
                        <div className="search-input-wrapper">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari..."
                                value={filter}
                                onChange={(e) => setFilter(e.target.value)}
                            />
                        </div>
                        <button type="submit" className="dash-btn primary">
                            Cari
                        </button>
                        {filters.filter && (
                            <button type="button" onClick={handleClear} className="dash-btn secondary">
                                Reset
                            </button>
                        )}
                    </form>

                    <div className="table-responsive">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Dokter</th>
                                    <th>Bagian</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Ket.</th>
                                </tr>
                            </thead>
                            <tbody>
                                {jadwal.data.length > 0 ? (
                                    jadwal.data.map((item, index) => {
                                        const k = (jadwal.current_page - 1) * jadwal.per_page + index + 1;
                                        return (
                                            <tr key={item.id_mt_jadwal_dokter || k}>
                                                <td>{k}.</td>
                                                <td>{item.nama_pegawai}</td>
                                                <td>{item.nama_bagian}</td>
                                                <td align="center">{item.range_hari}</td>
                                                <td align="center">{item.jam_mulai} s/d {item.jam_akhir}</td>
                                                <td>{item.status_dr === 1 ? 'CUTI' : 'ADA'}</td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="6">
                                            <div className="empty-state">
                                                <Calendar className="empty-icon" />
                                                <p>Tidak ada jadwal dokter ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                </div>

                {/* Pagination */}
                {jadwal.links && jadwal.links.length > 3 && (
                    <div className="pagination">
                        {jadwal.links.map((link, index) => {
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
