import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, XCircle, FileText } from 'lucide-react';
import '../../../css/pasien-lama.css';

export default function AntrianPoli({ data, poliklinik, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const [topik, setTopik] = useState(filters.topik || 'no_mr');
    const [kodeBagian, setKodeBagian] = useState(filters.kode_bagian || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/poli/antrian-poli', { search, topik, kode_bagian: kodeBagian }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setSearch('');
        setKodeBagian('');
        setTopik('no_mr');
        router.get('/poli/antrian-poli');
    };

    return (
        <DashboardLayout>
            <Head title="Antrian Pasien Poliklinik" />
            
            <div className="pl-container" style={{ padding: '20px', display: 'flex', flexDirection: 'column', gap: '20px' }}>
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Antrian Pasien Poliklinik</h1>
                        <p>Daftar antrian pasien yang mendaftar ke poliklinik</p>
                    </div>
                </div>

                <div className="glass-panel table-wrap" style={{ flex: 1, padding: '20px', display: 'flex', flexDirection: 'column' }}>
                    <form onSubmit={handleSearch} className="search-bar" style={{ display: 'flex', gap: '10px', marginBottom: '20px' }}>
                        <div style={{ display: 'flex', gap: '10px', flex: 1 }}>
                            <select 
                                className="search-input" 
                                style={{ width: '200px' }}
                                value={kodeBagian}
                                onChange={(e) => setKodeBagian(e.target.value)}
                            >
                                <option value="">-- Pilih Poliklinik --</option>
                                <option value="semua">Semua Poliklinik</option>
                                {poliklinik.map(p => (
                                    <option key={p.kode_bagian} value={p.kode_bagian}>{p.nama_bagian}</option>
                                ))}
                            </select>

                            <select 
                                className="search-input" 
                                style={{ width: '150px' }}
                                value={topik}
                                onChange={(e) => setTopik(e.target.value)}
                            >
                                <option value="no_mr">MR</option>
                                <option value="nama_pasien">Nama Pasien</option>
                                <option value="kode_dokter">Dokter</option>
                                <option value="nasabah">Nasabah</option>
                            </select>

                            <div className="search-input-wrapper" style={{ flex: 1, display: 'flex', position: 'relative' }}>
                                <Search className="search-icon" style={{ position: 'absolute', left: '10px', top: '50%', transform: 'translateY(-50%)', width: '16px', height: '16px', color: '#94a3b8' }} />
                                <input
                                    type="text"
                                    className="search-input"
                                    style={{ paddingLeft: '35px', width: '100%' }}
                                    placeholder="Masukkan kata kunci pencarian..."
                                    value={search}
                                    onChange={(e) => setSearch(e.target.value)}
                                />
                            </div>
                        </div>

                        <button type="submit" className="btn btn-primary" style={{ padding: '8px 16px' }}>
                            Cari
                        </button>
                        {(filters.search || filters.kode_bagian) && (
                            <button type="button" onClick={handleClear} className="btn btn-secondary" style={{ padding: '8px 16px' }}>
                                Reset
                            </button>
                        )}
                    </form>

                    <div className="table-responsive" style={{ flex: 1, overflowY: 'auto' }}>
                        <table className="pl-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. MR</th>
                                    <th>No. Registrasi</th>
                                    <th>Nama Lengkap</th>
                                    <th>Status Pasien</th>
                                    <th>Nasabah</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>No. Antrian</th>
                                    <th>Praktek</th>
                                    <th>Tgl Masuk</th>
                                    <th>Catatan Khusus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data.length > 0 ? (
                                    data.data.map((item, index) => (
                                        <tr key={item.no_registrasi}>
                                            <td>{data.from + index}.</td>
                                            <td><strong>{item.no_mr}</strong></td>
                                            <td style={{ color: '#22c55e', fontWeight: 'bold' }}>{item.no_registrasi}</td>
                                            <td>{item.nama_pasien}</td>
                                            <td style={{ color: item.status_pasien === 'Baru' ? '#ef4444' : 'inherit' }}>
                                                {item.status_pasien}
                                            </td>
                                            <td>{item.nasabah}</td>
                                            <td>{item.nama_poli}</td>
                                            <td>{item.nama_dokter}</td>
                                            <td style={{ textAlign: 'center', fontWeight: 'bold' }}>{item.no_antrian}</td>
                                            <td>{item.jadwal_praktek}</td>
                                            <td>
                                                <div>{new Date(item.tgl_jam_poli).toLocaleDateString('id-ID')}</div>
                                                <div style={{ color: '#94a3b8', fontSize: '0.85em' }}>{new Date(item.tgl_jam_poli).toLocaleTimeString('id-ID')}</div>
                                            </td>
                                            <td style={{ color: '#ef4444', fontSize: '0.85rem' }}>{item.catatan_khusus || '-'}</td>
                                            <td style={{ whiteSpace: 'nowrap' }}>
                                                <button className="btn btn-secondary" style={{ padding: '4px 8px', marginRight: '4px' }} title="Catatan Pasien">
                                                    <FileText style={{ width: '14px', height: '14px' }} />
                                                </button>
                                                <button className="btn btn-secondary" style={{ padding: '4px 8px', color: '#ef4444' }} title="Batal Registrasi">
                                                    <XCircle style={{ width: '14px', height: '14px' }} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="13" style={{ textAlign: 'center', padding: '40px' }}>
                                            Tidak ada data antrian pasien ditemukan
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {data.last_page > 1 && (
                        <div className="pagination" style={{ display: 'flex', justifyContent: 'center', gap: '8px', marginTop: '20px' }}>
                            {data.links.map((link, i) => (
                                <button
                                    key={i}
                                    onClick={() => link.url && router.get(link.url)}
                                    disabled={!link.url}
                                    className={`btn ${link.active ? 'btn-primary' : 'btn-secondary'}`}
                                    style={{
                                        padding: '8px 12px',
                                        opacity: link.url ? 1 : 0.5,
                                        cursor: link.url ? 'pointer' : 'not-allowed'
                                    }}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </DashboardLayout>
    );
}
