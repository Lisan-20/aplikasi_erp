import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, Users, Trash2, Calendar } from 'lucide-react';

export default function PerjanjianPasien({ perjanjian, filters }) {
    const [topik, setTopik] = useState(filters.topik || 'nama');
    const [filterVal, setFilterVal] = useState(filters.filter || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/perjanjian-pasien', { topik, filter: filterVal }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setFilterVal('');
        router.get('/registrasi/perjanjian-pasien', { topik });
    };

    const formatJam = (jam) => {
        if (!jam) return '-';
        // Assuming jam is a datetime or time string
        return jam.substring(11, 16) || jam;
    };

    const getKeterangan = (pagi_sore) => {
        if (pagi_sore == 1) return 'Pagi';
        if (pagi_sore == 2) return 'Sore';
        return 'Malam';
    };

    return (
        <>
            <Head title="Perjanjian Pasien" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Perjanjian</h1>
                        <p>Daftar pasien yang memiliki perjanjian</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="dash-btn secondary">
                            <ArrowLeft size={16} />
                            Kembali
                        </Link>
                        <Link href="/registrasi/daftar-perjanjian" className="dash-btn primary">
                            <Calendar size={16} />
                            Daftar Perjanjian
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <form onSubmit={handleSearch} className="search-bar" style={{ display: 'flex', gap: '1rem', alignItems: 'center', marginBottom: '1.5rem' }}>
                        <select 
                            value={topik} 
                            onChange={(e) => setTopik(e.target.value)}
                            className="search-input"
                            style={{ width: '150px' }}
                        >
                            <option value="nama">Nama</option>
                            <option value="mr">MR</option>
                            <option value="bagian">Bagian</option>
                            <option value="dokter">Dokter</option>
                        </select>
                        <div className="search-input-wrapper" style={{ flex: 1, margin: 0 }}>
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari..."
                                value={filterVal}
                                onChange={(e) => setFilterVal(e.target.value)}
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
                                    <th style={{ width: '50px' }}>Aksi</th>
                                    <th>No Mr</th>
                                    <th>Nama</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Jam</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {perjanjian.data.length > 0 ? (
                                    perjanjian.data.map((item) => (
                                        <tr key={item.id_tc_pesanan}>
                                            <td>
                                                <button className="dash-btn secondary" style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem', color: '#ef4444', borderColor: '#fca5a5' }} title="Hapus">
                                                    <Trash2 size={14} />
                                                </button>
                                            </td>
                                            <td><strong>{item.no_mr}</strong></td>
                                            <td>
                                                <a href={`/registrasi/rawat-jalan?no_mr=${item.no_mr}&kode_bagian=${item.kode_bagian}&kode_dokter=${item.kode_dokter}&id_tc_pesanan=${item.id_tc_pesanan}`} style={{ color: 'var(--primary)', textDecoration: 'none', fontWeight: '500' }}>
                                                    {item.nama}
                                                </a>
                                            </td>
                                            <td>{item.nama_bagian}</td>
                                            <td>{item.nama_pegawai}</td>
                                            <td>{formatJam(item.jam_pesanan)}</td>
                                            <td>
                                                <span className={`badge ${item.pagi_sore == 1 ? 'badge-blue' : item.pagi_sore == 2 ? 'badge-pink' : 'badge-gray'}`}>
                                                    {getKeterangan(item.pagi_sore)}
                                                </span>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="7">
                                            <div className="empty-state">
                                                <Users className="empty-icon" />
                                                <p>Tidak ada perjanjian pasien ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {perjanjian.links && perjanjian.links.length > 3 && (
                    <div className="pagination">
                        {perjanjian.links.map((link, index) => {
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
