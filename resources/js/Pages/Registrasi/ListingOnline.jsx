import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, Activity, Trash2 } from 'lucide-react';
import '../../../css/pasien-lama.css';

export default function ListingOnline({ dataPasien, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const [topic, setTopic] = useState(filters.topic || 'nama');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/listing-online', { tab: filters.tab, search, topic }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setSearch('');
        router.get('/registrasi/listing-online', { tab: filters.tab });
    };

    const changeTab = (newTab) => {
        router.get('/registrasi/listing-online', { tab: newTab, search, topic }, { preserveState: true, preserveScroll: true });
    };

    return (
        <>
            <Head title="Verifikasi Registrasi Online" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Verifikasi Pendaftaran Pasien Baru (Android)</h1>
                        <p>Daftar pasien yang mendaftar secara online</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="btn btn-secondary">
                            <ArrowLeft size={16} />
                            Kembali
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div style={{ display: 'flex', gap: '10px', marginBottom: '20px', flexWrap: 'wrap' }}>
                        <button 
                            className={`btn ${filters.tab === 'baru' ? 'btn-primary' : 'btn-secondary'}`} 
                            onClick={() => changeTab('baru')}
                        >
                            VER. PASIEN BARU
                        </button>
                        <button 
                            className={`btn ${filters.tab === 'verifikasi' ? 'btn-primary' : 'btn-secondary'}`} 
                            onClick={() => changeTab('verifikasi')}
                        >
                            HASIL TERVERIFIKASI
                        </button>
                        <button 
                            className={`btn ${filters.tab === 'reject' ? 'btn-primary' : 'btn-secondary'}`} 
                            onClick={() => changeTab('reject')}
                        >
                            REJECT
                        </button>
                    </div>

                    <form onSubmit={handleSearch} className="search-bar" style={{ display: 'flex', gap: '10px', marginBottom: '20px', flexWrap: 'wrap' }}>
                        <select 
                            className="search-input" 
                            style={{ width: '150px', flex: 'none' }}
                            value={topic}
                            onChange={(e) => setTopic(e.target.value)}
                        >
                            <option value="mr">MR</option>
                            <option value="nama">Nama</option>
                            <option value="nasabah">Nasabah</option>
                            <option value="alamat">Alamat</option>
                            <option value="ktp">KTP</option>
                            <option value="telpon">Telp</option>
                        </select>

                        <div className="search-input-wrapper" style={{ flex: 1 }}>
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari..."
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
                                    <th>No. Daftar</th>
                                    {filters.tab === 'verifikasi' && <th>No. MR</th>}
                                    {filters.tab === 'baru' && <th>Tgl Entry</th>}
                                    <th>Nama Lengkap</th>
                                    {filters.tab === 'baru' && <th>NIK</th>}
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Nasabah</th>
                                    <th>Email</th>
                                    {filters.tab === 'reject' && <th>Alasan Batal</th>}
                                    {filters.tab === 'baru' && <th>Aksi</th>}
                                </tr>
                            </thead>
                            <tbody>
                                {dataPasien.data.length > 0 ? (
                                    dataPasien.data.map((item, index) => (
                                        <tr key={index}>
                                            <td style={{ whiteSpace: 'nowrap', textAlign: 'center' }}><strong>{item.no_mr}</strong></td>
                                            {filters.tab === 'verifikasi' && <td style={{ textAlign: 'center' }}>{item.no_mr_int}</td>}
                                            {filters.tab === 'baru' && <td style={{ textAlign: 'center' }}>{item.tgl_input ? new Date(item.tgl_input).toLocaleString('id-ID') : '-'}</td>}
                                            
                                            <td>
                                                <div style={{ fontWeight: '600' }}>
                                                    {item.nama_pasien}
                                                    {item.status_meninggal == 1 ? ' ( Meninggal )' : ''}
                                                </div>
                                            </td>

                                            {filters.tab === 'baru' && <td>{item.no_ktp || '-'}</td>}
                                            
                                            <td>{item.almt_ttp_pasien}</td>
                                            <td style={{ color: '#10b981' }}>{item.tlp_almt_ttp}</td>
                                            
                                            <td>{item.nasabah || item.perusahaan || '-'}</td>
                                            
                                            <td>{item.email || '-'}</td>

                                            {filters.tab === 'reject' && <td>{item.alasan_batal || '-'}</td>}

                                            {filters.tab === 'baru' && (
                                                <td style={{ whiteSpace: 'nowrap' }}>
                                                    <button className="btn btn-secondary" style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem', color: '#ef4444' }} title="Batal/Reject">
                                                        <Trash2 size={14} />
                                                    </button>
                                                </td>
                                            )}
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan={filters.tab === 'baru' ? 9 : (filters.tab === 'verifikasi' ? 7 : 7)}>
                                            <div className="empty-state">
                                                <Activity className="empty-icon" />
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
                {dataPasien.links && dataPasien.links.length > 3 && (
                    <div className="pagination">
                        {dataPasien.links.map((link, index) => {
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
