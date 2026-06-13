import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, Users, Plus } from 'lucide-react';
import '../../../css/pasien-lama.css';

export default function DaftarPerjanjian({ daftar, filters }) {
    const [topik, setTopik] = useState(filters.topik || 'nama');
    const [filterVal, setFilterVal] = useState(filters.filter || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/daftar-perjanjian', { topik, filter: filterVal }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setFilterVal('');
        router.get('/registrasi/daftar-perjanjian', { topik });
    };

    return (
        <>
            <Head title="Daftar Pesanan Perjanjian" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Daftar Pesanan Perjanjian</h1>
                        <p>Pilih pasien untuk membuat perjanjian baru</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="btn btn-secondary">
                            <ArrowLeft size={16} />
                            Kembali
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
                            <option value="nasabah">Nasabah</option>
                            <option value="alamat">Alamat</option>
                            <option value="ktp">KTP</option>
                            <option value="telpon">Telp</option>
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
                                    <th style={{ width: '50px' }}>Aksi</th>
                                    <th>No. MR</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>Nasabah</th>
                                </tr>
                            </thead>
                            <tbody>
                                {daftar.data.length > 0 ? (
                                    daftar.data.map((patient) => (
                                        <tr key={patient.no_mr}>
                                            <td>
                                                {patient.status_meninggal !== 1 && (
                                                    <button className="btn btn-primary" style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem', display: 'flex', gap: '0.25rem', alignItems: 'center' }}>
                                                        <Plus size={14} /> Pesan
                                                    </button>
                                                )}
                                            </td>
                                            <td><strong>{patient.no_mr}</strong></td>
                                            <td>
                                                {patient.nama_pasien} {patient.status_meninggal === 1 && '( Meninggal )'}
                                            </td>
                                            <td>{patient.almt_ttp_pasien}</td>
                                            <td>
                                                {patient.kode_kelompok !== '3' ? patient.nasabah : (patient.perusahaan || patient.nasabah)}
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="5">
                                            <div className="empty-state">
                                                <Users className="empty-icon" />
                                                <p>Tidak ada data pasien ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {daftar.links && daftar.links.length > 3 && (
                    <div className="pagination">
                        {daftar.links.map((link, index) => {
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
