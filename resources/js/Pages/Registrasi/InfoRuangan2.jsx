import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, LayoutList } from 'lucide-react';

export default function InfoRuangan2({ data, filters }) {
    const [filter, setFilter] = useState(filters.filter || '');
    const [tipeCari, setTipeCari] = useState(filters.tipeCari || 'nama');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/info-ruangan-2', { filter, tipeCari }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setFilter('');
        setTipeCari('nama');
        router.get('/registrasi/info-ruangan-2');
    };

    return (
        <>
            <Head title="Informasi Ruangan v2" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Informasi Ruangan</h1>
                        <p>Daftar informasi ruangan dengan data pasien</p>
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
                                <option value="nama">Nama Bagian</option>
                                <option value="klas">Nama Klas</option>
                                <option value="kamar">No Kamar</option>
                                <option value="status">Status</option>
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
                                    <th>Ruangan</th>
                                    <th>Kelas</th>
                                    <th>No Bed</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Pasien</th>
                                    <th>Jaminan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data.length > 0 ? (
                                    data.data.map((item, index) => {
                                        const k = (data.current_page - 1) * data.per_page + index + 1;
                                        
                                        // Equivalent to PHP conditional background
                                        const isEmpty = !item.status;
                                        const rowStyle = isEmpty ? { backgroundColor: 'rgba(220, 20, 60, 0.7)', color: '#fff' } : {};
                                        
                                        return (
                                            <tr key={index}>
                                                <td>{k}.</td>
                                                <td>{item.no_kamar || '-'}</td>
                                                <td>{item.nama_klas || '-'}</td>
                                                <td>{item.no_bed || '-'}</td>
                                                <td style={rowStyle}>{item.tgl_masuk || '\u00A0'}</td>
                                                <td style={rowStyle}>{item.nama_pasien || '\u00A0'}</td>
                                                <td style={rowStyle}>
                                                    {item.status ? (
                                                        item.nama_perusahaan 
                                                            ? `${item.nama_kelompok} / ${item.nama_perusahaan}` 
                                                            : item.nama_kelompok
                                                    ) : '\u00A0'}
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="7">
                                            <div className="empty-state">
                                                <LayoutList className="empty-icon" />
                                                <p>Tidak ada ruangan ditemukan.</p>
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
                            if (label.includes('Previous')) label = '&laquo;';
                            if (label.includes('Next')) label = '&raquo;';
                            
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
