import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, UserPlus, ArrowLeft, Users, FileText } from 'lucide-react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function PasienLama({ patients, filters }) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/registrasi/pasien-lama', { search }, { preserveState: true, preserveScroll: true });
    };

    const handleClear = () => {
        setSearch('');
        router.get('/registrasi/pasien-lama');
    };

    return (
        <DashboardLayout>
            <Head title="Data Pasien Lama" />
            
            <div className="dashboard-container" style={{ padding: '20px' }}>
                <main className="dashboard-content" style={{ width: '100%', maxWidth: '100%' }}>
                    
                    <div className="panel-card glass-card" style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                        <div className="panel-header" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', borderBottom: '1px solid var(--border-color)', paddingBottom: '15px' }}>
                            <div>
                                <h3 style={{ fontSize: '1.5rem', fontWeight: 'bold' }}>Data Pasien Lama</h3>
                                <p style={{ color: 'var(--text-muted)', fontSize: '0.9rem', marginTop: '5px' }}>Pencarian data master pasien berdasarkan No. MR atau Nama Pasien</p>
                            </div>
                            <div style={{ display: 'flex', gap: '10px' }}>
                                <Link href="/modul/101/enter" className="dash-btn danger">
                                    <ArrowLeft size={16} />
                                    Kembali
                                </Link>
                                <Link href="/registrasi/pasien-baru" className="dash-btn primary">
                                    <UserPlus size={16} />
                                    Daftar Pasien Baru
                                </Link>
                            </div>
                        </div>

                        <div className="search-filter-container" style={{ display: 'flex', gap: '10px' }}>
                            <form onSubmit={handleSearch} style={{ display: 'flex', gap: '10px', width: '100%' }}>
                                <div style={{ flex: 1, position: 'relative' }}>
                                    <Search size={18} style={{ position: 'absolute', left: '15px', top: '50%', transform: 'translateY(-50%)', color: 'var(--text-muted)' }} />
                                    <input
                                        type="text"
                                        className="premium-input"
                                        style={{ width: '100%', paddingLeft: '45px' }}
                                        placeholder="Cari No. MR atau Nama Pasien..."
                                        value={search}
                                        onChange={(e) => setSearch(e.target.value)}
                                    />
                                </div>
                                <button type="submit" className="dash-btn primary">
                                    Cari
                                </button>
                                {filters.search && (
                                    <button type="button" onClick={handleClear} className="dash-btn danger">
                                        Reset
                                    </button>
                                )}
                            </form>
                        </div>

                        <div className="table-responsive">
                            <table className="dash-table">
                                <thead>
                                <tr>
                                    <th>No. MR</th>
                                    <th>Nama Pasien</th>
                                    <th>No. KTP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {patients.data.length > 0 ? (
                                    patients.data.map((patient) => (
                                        <tr key={patient.no_mr}>
                                            <td><strong>{patient.no_mr}</strong></td>
                                            <td>{patient.nama_pasien}</td>
                                            <td>{patient.no_ktp || '-'}</td>
                                            <td>
                                                <span className={`status-badge ${patient.jen_kelamin === 'L' ? 'on-duty' : 'cuti'}`}>
                                                    {patient.jen_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                                                </span>
                                            </td>
                                            <td>{patient.tgl_lhr ? new Date(patient.tgl_lhr).toLocaleDateString('id-ID') : '-'}</td>
                                            <td>{patient.almt_ttp_pasien}</td>
                                            <td>{patient.tlp_almt_ttp || '-'}</td>
                                            <td>
                                                <Link 
                                                    href={`/registrasi/edit-data?mr_number=${patient.no_mr}`}
                                                    className="dash-btn primary" 
                                                    style={{ padding: '5px 10px', fontSize: '0.8rem' }}
                                                >
                                                    <FileText size={14} /> Pilih
                                                </Link>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="8">
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
                    {patients.links && patients.links.length > 3 && (
                        <div className="pagination shrink-0 p-3 glass-panel" style={{ display: 'flex', justifyContent: 'flex-end', gap: '0.5rem', minWidth: 0, marginTop: 0 }}>
                            {patients.links.map((link, index) => (
                                link.url ? (
                                    <Link
                                        key={index}
                                        href={link.url}
                                        className={`dash-btn ${link.active ? 'primary' : 'secondary'}`}
                                        style={{ padding: '0.25rem 0.5rem', fontSize: '0.875rem' }}
                                        preserveState
                                        preserveScroll
                                    >
                                        <span dangerouslySetInnerHTML={{ __html: link.label }} />
                                    </Link>
                                ) : (
                                    <span
                                        key={index}
                                        className="dash-btn secondary disabled"
                                        style={{ padding: '0.25rem 0.5rem', fontSize: '0.875rem', opacity: 0.5 }}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                )
                            ))}
                        </div>
                    )}
                </main>
            </div>
        </DashboardLayout>
    );
}
