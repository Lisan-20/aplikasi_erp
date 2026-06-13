import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { Search, UserPlus, ArrowLeft, Users, FileText, ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight } from 'lucide-react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import '../../../css/pasien-lama.css';

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
            
            <div style={{ flex: 1, minHeight: 0, padding: '1rem', display: 'grid', gap: '1rem', gridTemplateRows: 'auto auto 1fr', color: 'var(--text-main)', overflow: 'hidden' }}>
                <div className="pl-header glass-panel shrink-0" style={{ minWidth: 0 }}>
                    <div className="pl-title">
                        <h1>Data Pasien Lama</h1>
                        <p>Pencarian data master pasien berdasarkan No. MR atau Nama Pasien</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/modul/101/enter" className="btn btn-secondary">
                            <ArrowLeft size={16} />
                            Kembali
                        </Link>
                        <Link href="/registrasi/pasien-baru" className="btn btn-primary">
                            <UserPlus size={16} />
                            Daftar Pasien Baru
                        </Link>
                    </div>
                </div>

                <div className="glass-panel flex flex-col shrink-0 p-3" style={{ minWidth: 0 }}>
                    <form onSubmit={handleSearch} className="search-bar w-full">
                        <div className="search-input-wrapper flex-1">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari No. MR atau Nama Pasien..."
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
                </div>

                <div className="glass-panel" style={{ minWidth: 0, padding: 0, minHeight: 0, display: 'flex', flexDirection: 'column', overflow: 'hidden' }}>
                    <div style={{ flex: 1, minHeight: 0, overflow: 'auto' }}>
                            <table className="pl-table whitespace-nowrap min-w-max w-full border-collapse">
                                <thead style={{ position: 'sticky', top: 0, zIndex: 10, background: 'var(--bg-color)', boxShadow: '0 2px 4px rgba(0,0,0,0.1)' }}>
                                <tr>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>No. MR</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>Nama Pasien</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>No. KTP</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>Jenis Kelamin</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>Tanggal Lahir</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>Alamat</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>No. Telepon</th>
                                    <th className="px-4 py-4 text-left border" style={{ borderColor: 'var(--glass-border)' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {patients.data.length > 0 ? (
                                    patients.data.map((patient) => (
                                        <tr key={patient.no_mr}>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}><strong>{patient.no_mr}</strong></td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>{patient.nama_pasien}</td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>{patient.no_ktp || '-'}</td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>
                                                <span className={`badge ${patient.jen_kelamin === 'L' ? 'badge-blue' : 'badge-pink'}`}>
                                                    {patient.jen_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                                                </span>
                                            </td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>{patient.tgl_lhr ? new Date(patient.tgl_lhr).toLocaleDateString('id-ID') : '-'}</td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>{patient.almt_ttp_pasien}</td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>{patient.tlp_almt_ttp || '-'}</td>
                                            <td className="px-4 py-3 border" style={{ borderColor: 'var(--glass-border)' }}>
                                                <Link 
                                                    href={`/registrasi/edit-data?mr_number=${patient.no_mr}`}
                                                    className="btn btn-secondary" 
                                                    style={{ padding: '0.25rem 0.5rem', fontSize: '0.75rem' }}
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
                            {patients.links
                                .filter(link => link.label.includes('Previous') || link.label.includes('Next'))
                                .map((link, index) => {
                                    let label = link.label;
                                    if (label.includes('Previous')) label = '&laquo; Previous';
                                    if (label.includes('Next')) label = 'Next &raquo;';
                                    
                                    return link.url ? (
                                        <Link
                                            key={index}
                                            href={link.url}
                                            className="page-link"
                                            style={{ padding: '0.5rem 1rem' }}
                                            dangerouslySetInnerHTML={{ __html: label }}
                                        />
                                    ) : (
                                        <span
                                            key={index}
                                            className="page-link disabled"
                                            style={{ padding: '0.5rem 1rem' }}
                                            dangerouslySetInnerHTML={{ __html: label }}
                                        />
                                    );
                            })}
                        </div>
                    )}
            </div>
        </DashboardLayout>
    );
}
