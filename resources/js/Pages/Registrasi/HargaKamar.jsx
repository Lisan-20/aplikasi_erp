import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, LayoutList } from 'lucide-react';
import '../../../css/pasien-lama.css';

export default function HargaKamar({ data, filters }) {
    const [filter, setFilter] = useState(filters.filter || '');
    const [tipeCari, setTipeCari] = useState(filters.tipeCari || 'nama');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/harga-kamar', { filter, tipeCari }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setFilter('');
        setTipeCari('nama');
        router.get('/registrasi/harga-kamar');
    };

    return (
        <>
            <Head title="Tarif Ruangan" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Tarif Ruangan</h1>
                        <p>Daftar harga dan tarif kamar</p>
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
                        <div className="form-group" style={{ flex: '0 0 200px' }}>
                            <select
                                className="form-input"
                                value={tipeCari}
                                onChange={(e) => setTipeCari(e.target.value)}
                            >
                                <option value="nama">Nama Bagian</option>
                                <option value="kode_ruangan">Bed</option>
                                <option value="klas">Nama Klas</option>
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
                        <button type="submit" className="btn btn-primary">
                            Cari
                        </button>
                        {filters.filter && (
                            <button type="button" onClick={handleClear} className="btn btn-secondary">
                                Reset
                            </button>
                        )}
                    </form>

                    <div className="table-responsive">
                        <table className="pl-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Bagian</th>
                                    <th>Klas</th>
                                    <th>Harga</th>
                                    <th>Jml Kamar</th>
                                    <th>Bed</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data.length > 0 ? (
                                    data.data.map((item, index) => {
                                        const k = (data.current_page - 1) * data.per_page + index + 1;
                                        
                                        // Format currency
                                        const harga = new Intl.NumberFormat('id-ID', {
                                            style: 'decimal',
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        }).format(item.harga_r || 0);

                                        return (
                                            <tr key={index}>
                                                <td>{k}.</td>
                                                <td>{item.nama_bagian || '-'}</td>
                                                <td>{item.nama_klas || '-'}</td>
                                                <td align="right">{harga}</td>
                                                <td align="right">{item.jumlah_k || '-'}</td>
                                                <td>{item.kode_ruangan} {item.no_bed}</td>
                                                <td>{item.keterangan || '\u00A0'}</td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="7">
                                            <div className="empty-state">
                                                <LayoutList className="empty-icon" />
                                                <p>Tidak ada tarif ruangan ditemukan.</p>
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
