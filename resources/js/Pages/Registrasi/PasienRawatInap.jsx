import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, ArrowLeft, Activity, Printer, XCircle, FileText, FileSignature, Edit } from 'lucide-react';

export default function PasienRawatInap({ data, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const [searchBy, setSearchBy] = useState(filters.search_by || 'nama');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/pasien-rawat-inap', { search, search_by: searchBy }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setSearch('');
        setSearchBy('nama');
        router.get('/registrasi/pasien-rawat-inap');
    };

    return (
        <>
            <Head title="Pasien Rawat Inap" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Daftar Pasien Rawat Inap</h1>
                        <p>Daftar pasien yang sedang dirawat inap</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="dash-btn secondary">
                            <ArrowLeft size={16} />
                            Kembali
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <form onSubmit={handleSearch} className="search-bar" style={{ display: 'flex', gap: '10px' }}>
                        <select 
                            value={searchBy} 
                            onChange={(e) => setSearchBy(e.target.value)}
                            className="search-input"
                            style={{ width: '150px' }}
                        >
                            <option value="mr">No. MR</option>
                            <option value="nama">Nama</option>
                            <option value="kode_bagian">Ruangan</option>
                            <option value="alamat">Alamat</option>
                            <option value="no_registrasi">No Registrasi</option>
                            <option value="nasabah">Jenis Nasabah</option>
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
                        <table className="dash-table" style={{ fontSize: '0.85rem' }}>
                            <thead>
                                <tr>
                                    <th>Aksi Print</th>
                                    <th>GC/Titipan</th>
                                    <th>No. MR</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>Nasabah</th>
                                    <th>Ruangan</th>
                                    <th>Kelas</th>
                                    <th>Kamar</th>
                                    <th>Tgl Masuk RI</th>
                                    <th>Diagnosa Awal</th>
                                    <th>DPJP</th>
                                    <th>Batal</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data.length > 0 ? (
                                    data.data.map((item) => (
                                        <tr key={item.no_registrasi}>
                                            <td style={{ whiteSpace: 'nowrap' }}>
                                                <button className="dash-btn secondary" style={{ padding: '0.25rem', marginRight: '2px' }} title="Cetak Label">
                                                    <Printer size={14} />
                                                </button>
                                                <button className="dash-btn secondary" style={{ padding: '0.25rem', marginRight: '2px' }} title="Cetak Kartu Masuk">
                                                    <FileText size={14} />
                                                </button>
                                                <button className="dash-btn secondary" style={{ padding: '0.25rem', marginRight: '2px' }} title="Cetak Visite">
                                                    <Edit size={14} />
                                                </button>
                                                {item.noSep && (
                                                    <button className="dash-btn secondary" style={{ padding: '0.25rem' }} title="Cetak SEP">
                                                        <Printer size={14} color="blue" />
                                                    </button>
                                                )}
                                            </td>
                                            <td style={{ whiteSpace: 'nowrap', textAlign: 'center' }}>
                                                {item.ttd_ri ? (
                                                    <Printer size={14} title="Cetak GC" style={{ display: 'inline', marginRight: '5px' }} />
                                                ) : (
                                                    <FileSignature size={14} title="Tambah GC" style={{ display: 'inline', marginRight: '5px', color: 'green' }} />
                                                )}
                                                {item.ttd_sk_pasien ? (
                                                    <Printer size={14} title="Cetak Titipan" style={{ display: 'inline' }} />
                                                ) : (
                                                    <FileSignature size={14} title="Tambah Titipan" style={{ display: 'inline', color: 'green' }} />
                                                )}
                                            </td>
                                            <td><strong>{item.no_mr}</strong></td>
                                            <td>{item.nama_pasien}</td>
                                            <td style={{ maxWidth: '150px', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }} title={item.alamat}>
                                                {item.alamat}
                                            </td>
                                            <td>{item.nasabah || '-'}</td>
                                            <td>{item.ruangan}</td>
                                            <td>{item.kelas}</td>
                                            <td>
                                                {item.kamar}<br/>
                                                <small>{item.bed}</small>
                                            </td>
                                            <td>
                                                {item.tgl_masuk ? new Date(item.tgl_masuk).toLocaleDateString('id-ID') : '-'}<br/>
                                                <small>{item.tgl_masuk ? new Date(item.tgl_masuk).toLocaleTimeString('id-ID') : ''}</small>
                                            </td>
                                            <td>{item.diagnosa_awal}</td>
                                            <td>{item.dpjp}</td>
                                            <td style={{ textAlign: 'center' }}>
                                                {item.can_batal ? (
                                                    <button className="dash-btn danger" style={{ padding: '0.25rem' }} title="Batal Registrasi">
                                                        <XCircle size={14} />
                                                    </button>
                                                ) : null}
                                            </td>
                                            <td style={{ color: 'red', maxWidth: '150px' }}>{item.catatan_khusus || '-'}</td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="14">
                                            <div className="empty-state">
                                                <Activity className="empty-icon" />
                                                <p>Tidak ada pasien rawat inap ditemukan.</p>
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
