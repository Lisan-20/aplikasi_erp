import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, History } from 'lucide-react';
import '../../../css/pasien-lama.css';

export default function RiwayatPasien({ pasien, filters }) {
    const [filter, setFilter] = useState(filters.filter || '');
    const [topik, setTopik] = useState(filters.topik || 'nama');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/riwayat-pasien', { filter, topik }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setFilter('');
        setTopik('nama');
        router.get('/registrasi/riwayat-pasien');
    };

    return (
        <>
            <Head title="Riwayat Pasien" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Riwayat Pasien</h1>
                        <p>Penelusuran riwayat medis pasien</p>
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
                                value={topik}
                                onChange={(e) => setTopik(e.target.value)}
                            >
                                <option value="mr">MR</option>
                                <option value="nama">Nama</option>
                                <option value="nasabah">Nasabah</option>
                                <option value="alamat">Alamat</option>
                                <option value="tgl_lahir">Lahir Tgl</option>
                                <option value="ktp">KTP</option>
                                <option value="telpon">Telp</option>
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
                                    <th>No. MR</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Nasabah</th>
                                </tr>
                            </thead>
                            <tbody>
                                {pasien.data.length > 0 ? (
                                    pasien.data.map((item, index) => {
                                        const k = (pasien.current_page - 1) * pasien.per_page + index + 1;
                                        return (
                                            <tr key={item.no_mr || k}>
                                                <td>{k}.</td>
                                                <td align="center">{item.no_mr}</td>
                                                <td>
                                                    <a href={`/registrasi/riwayat-pasien-data?no_mr=${item.no_mr}`}>
                                                        {item.status_meninggal === 1 ? (
                                                            <>&nbsp; ( Meninggal ) <b>{item.nama_pasien?.replace(/\\/g, '')}</b></>
                                                        ) : (
                                                            <b>{item.nama_pasien?.replace(/\\/g, '')}</b>
                                                        )}
                                                    </a>
                                                </td>
                                                <td align="center">{item.tgl_lhr ? new Date(item.tgl_lhr).toLocaleDateString('id-ID') : '-'}</td>
                                                <td>{item.almt_ttp_pasien}</td>
                                                <td>{item.kode_kelompok !== '3' ? item.nasabah : item.perusahaan}</td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="6">
                                            <div className="empty-state">
                                                <History className="empty-icon" />
                                                <p>Tidak ada riwayat pasien ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {pasien.links && pasien.links.length > 3 && (
                    <div className="pagination">
                        {pasien.links.map((link, index) => {
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
