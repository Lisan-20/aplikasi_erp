import React, { useState, useEffect, useCallback } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { User, Edit, FileText, CheckSquare } from 'lucide-react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function DaftarCariPasien({ pasien, filters }) {
    const [topik, setTopik] = useState(filters.topik || 'nama');
    const [filterVal, setFilterVal] = useState(filters.filter || '');
    const type = filters.type || 'poli';

    // Type mapping untuk UI
    const getTypeConfig = (t) => {
        switch (t) {
            case 'poli': return { title: 'Daftar Pasien Untuk POLI', linkBase: '/registrasi/rawat-jalan/form' };
            case 'igd': return { title: 'Daftar Pasien Untuk Instalasi Gawat Darurat', linkBase: '/registrasi/igd/form' };
            case 'pm': return { title: 'Daftar Pasien Untuk Penunjang Medis', linkBase: '/registrasi/penunjang-medis/form' };
            case 'ri': return { title: 'Daftar Pasien Untuk Rawat Inap', linkBase: '/registrasi/rawat-inap/form' };
            case 'mcu': return { title: 'Daftar Pasien Untuk Medical Check Up', linkBase: '/registrasi/mcu/form' };
            case 'paket-poli': return { title: 'Daftar Pasien Untuk Paket Poliklinik', linkBase: '/registrasi/paket-poli/form' };
            default: return { title: 'Daftar Pasien', linkBase: `/registrasi/${t}/form` };
        }
    };

    const config = getTypeConfig(type);

    const handleSearch = useCallback(() => {
        router.get('/registrasi/cari-pasien', { type, topik, filter: filterVal }, { preserveState: true, replace: true });
    }, [filterVal, topik, type]);

    // Auto search timer (debounce)
    useEffect(() => {
        const timer = setTimeout(() => {
            if (filterVal !== filters.filter || topik !== filters.topik) {
                handleSearch();
            }
        }, 800); // 800ms debounce
        return () => clearTimeout(timer);
    }, [filterVal, filters.filter, filters.topik, handleSearch, topik]);

    const handleTopikChange = (e) => {
        setTopik(e.target.value);
        if (e.target.value === 'tgl_lahir') {
            setFilterVal(''); // Reset filter when changing to date
        }
    };

    const handleKeyPress = (e) => {
        if (e.key === 'Enter') {
            handleSearch();
        }
    };

    return (
        <DashboardLayout>
            <Head title={`${config.title} - Medilink RS`} />

            <div style={{ flex: 1, minHeight: 0, padding: '1rem', display: 'grid', gap: '1rem', gridTemplateRows: 'auto 1fr auto', color: 'var(--text-main)', overflow: 'hidden' }}>
                <div className="glass-card overflow-hidden" style={{ borderColor: 'var(--glass-border)' }}>
                    <div className="p-3 border-b flex flex-col sm:flex-row justify-between items-center" style={{ borderColor: 'var(--glass-border)', background: 'rgba(0,0,0,0.05)' }}>
                        <h1 className="text-xl font-bold mb-3 sm:mb-0">{config.title}</h1>

                        {/* Right side buttons mapping logic like legacy */}
                        <div className="flex flex-wrap gap-2">
                            {type === 'ri' && (
                                <>
                                    {/*<Link href="/registrasi/cari-pasien?type=igd" className="btn btn-secondary text-sm py-1">IGD</Link>
                                    <Link href="/registrasi/cari-pasien?type=poli" className="btn btn-secondary text-sm py-1">Poliklinik</Link>*/}
                                </>
                            )}
                            {type === 'igd' && (
                                <>
                                    {/*<Link href="/registrasi/cari-pasien?type=ri" className="btn btn-secondary text-sm py-1">Rawat Inap</Link>
                                    <Link href="/registrasi/cari-pasien?type=poli" className="btn btn-secondary text-sm py-1">Poliklinik</Link>*/}
                                </>
                            )}
                            {type === 'poli' && (
                                <>
                                    {/*<Link href="/registrasi/cari-pasien?type=ri" className="btn btn-secondary text-sm py-1">Rawat Inap</Link>
                                    <Link href="/registrasi/cari-pasien?type=igd" className="btn btn-secondary text-sm py-1">IGD</Link>*/}
                                </>
                            )}
                            {/*<Link href="/registrasi/pasien-baru" className="btn btn-primary text-sm py-1 flex items-center gap-1">
                                <UserPlus size={14} /> Pasien Baru
                            </Link>*/}
                            {/*<Link href="/modul/101/enter" className="btn btn-secondary text-sm py-1 flex items-center gap-1">
                                <ArrowLeft size={14} /> Kembali
                            </Link>*/}
                        </div>
                    </div>

                    {/* Search Filters directly inside Header */}
                    <div className="p-4 flex flex-wrap items-center gap-4 bg-white/5 rounded-b-xl">
                        <div className="flex flex-wrap items-center gap-3">
                            <span className="text-sm font-medium whitespace-nowrap">Cari Berdasarkan : </span>
                            <select
                                className="form-input text-sm py-1.5 px-3 w-36"
                                value={topik}
                                onChange={handleTopikChange}
                            >
                                <option value="nama">Nama</option>
                                <option value="no_mr">No. MR</option>
                                <option value="nik">NIK</option>
                                <option value="alamat">Alamat</option>
                                <option value="tgl_lahir">Tanggal Lahir</option>
                            </select>

                            {topik === 'tgl_lahir' ? (
                                <input
                                    type="date"
                                    className="form-input text-sm py-1.5 px-3 w-48"
                                    value={filterVal}
                                    onChange={(e) => setFilterVal(e.target.value)}
                                    onKeyPress={handleKeyPress}
                                />
                            ) : (
                                <input
                                    type="text"
                                    className="form-input text-sm py-1.5 px-3 w-48"
                                    placeholder={`Masukkan ${topik}...`}
                                    value={filterVal}
                                    onChange={(e) => setFilterVal(e.target.value)}
                                    onKeyPress={handleKeyPress}
                                />
                            )}

                            <button
                              className="btn btn-primary whitespace-nowrap text-xs"
                              style={{
                                  width: '90px',       /* Memaksa lebar tepat 100 pixel */
                                  height: '25px',       /* Memaksa tinggi tepat 35 pixel */
                                  borderRadius: '6px'
                              }}
                              onClick={handleSearch}
                          >
                              Cari !
                          </button>
                        </div>
                    </div>
                </div>

                {/* Table Component */}
                <div style={{ borderColor: 'var(--glass-border)', borderRadius: '16px', border: '1px solid var(--glass-border)', background: 'var(--glass-bg)', backdropFilter: 'blur(12px)', overflow: 'hidden', minHeight: 0, display: 'flex', flexDirection: 'column' }}>
                    <div style={{ flex: 1, minHeight: 0, overflow: 'auto' }}>
                        <table className="w-full min-w-max text-left text-sm whitespace-nowrap border-collapse" style={{ color: 'var(--text-main)' }}>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>GC RI</th>
                                    <th>GC RJ</th>
                                    <th>Edit</th>
                                    <th>No. MR</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tgl Lahir</th>
                                    <th>Nama Keluarga</th>
                                    <th>Alamat</th>
                                    <th>Nasabah</th>
                                    <th>NIK</th>
                                    <th>Catatan Khusus</th>
                                </tr>
                            </thead>
                            <tbody>
                                {pasien.data.length > 0 ? (
                                    pasien.data.map((p, index) => (
                                        <tr key={p.id_mt_master_pasien || index} className="transition-colors hover-bg-glass">
                                            <td className="text-center px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }}>
                                                {pasien.from + index}.
                                            </td>
                                            <td>
                                                <button
                                                    className="p-1.5 rounded-md transition-colors action-btn"
                                                    style={{ color: '#10b981' }}
                                                    title="General Consent RI"
                                                    onClick={() => window.open(`/mod_registrasi/general_concent.php?no_mr=${p.no_mr}`, '_blank', 'width=800,height=600')}
                                                >
                                                    <CheckSquare className="w-4 h-4" />
                                                </button>
                                            </td>
                                            <td>
                                                <button
                                                    className="p-1.5 rounded-md transition-colors action-btn"
                                                    style={{ color: '#3b82f6' }}
                                                    title="General Consent RJ"
                                                    onClick={() => window.open(`/mod_registrasi/gc_rj.php?no_mr=${p.no_mr}`, '_blank', 'width=800,height=600')}
                                                >
                                                    <FileText className="w-4 h-4" />
                                                </button>
                                            </td>
                                            <td>
                                                <button
                                                    className="p-1.5 rounded-md transition-colors action-btn"
                                                    style={{ color: '#f59e0b' }}
                                                    title="Edit Nasabah"
                                                    onClick={() => window.open(`/mod_registrasi/edit_nasabah.php?no_mr=${p.no_mr}`, '_blank', 'width=600,height=400')}
                                                >
                                                    <Edit className="w-4 h-4" />
                                                </button>
                                            </td>
                                            <td>
                                                {p.no_mr}
                                            </td>
                                            <td>
                                                {p.status_meninggal == 1 ? (
                                                    <span className="font-bold text-red-500">{p.nama_pasien} (Meninggal)</span>
                                                ) : p.status_aktif === 'N' ? (
                                                    <span className="font-bold text-red-500">{p.nama_pasien} (Non Aktif)</span>
                                                ) : p.blacklist == '1' ? (
                                                    <span className="font-bold text-red-500">{p.nama_pasien} (Diblokir)</span>
                                                ) : (
                                                    <Link href={`${config.linkBase}/${p.no_mr}`} style={{ color: 'var(--primary)' }} className="font-bold underline decoration-2 underline-offset-2 transition-all opacity-90 hover:opacity-100">
                                                        {p.nama_pasien}
                                                    </Link>
                                                )}
                                            </td>
                                            <td className="px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }}>{p.tgl_lhr?.split(' ')[0]}</td>
                                            <td className="px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }}>{p.nama_kel_pasien}</td>
                                            <td className="truncate max-w-[200px] px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }} title={p.almt_ttp_pasien}>{p.almt_ttp_pasien}</td>
                                            <td className="px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }}>{p.perusahaan || p.nasabah}</td>
                                            <td className="px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }}>{p.nik}</td>
                                            <td className="px-4 py-3 border" style={{ color: 'var(--text-muted)', borderColor: 'var(--glass-border)' }}>{p.memo}</td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="11" className="p-8 text-center" style={{ color: 'var(--text-muted)' }}>
                                            <User className="w-12 h-12 mx-auto mb-3 opacity-40" />
                                            Tidak ada data pasien yang ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination Footer */}
                <div className="p-4 flex justify-between items-center glass-card shadow-sm" style={{ borderColor: 'var(--glass-border)', background: 'var(--bg-dark)' }}>
                        <div className="text-sm" style={{ color: 'var(--text-muted)' }}>
                            Menampilkan <span className="font-medium" style={{ color: 'var(--text-main)' }}>{pasien.from}</span> - <span className="font-medium" style={{ color: 'var(--text-main)' }}>{pasien.to}</span> dari <span className="font-medium" style={{ color: 'var(--text-main)' }}>{pasien.total}</span> data
                        </div>
                        <div className="flex gap-2 justify-end mt-2 sm:mt-0">
                            {pasien.links
                                .filter(link => link.label.includes('Previous') || link.label.includes('Next'))
                                .map((link, i) => {
                                    let label = link.label;
                                    if (label.includes('Previous')) label = '&laquo; Previous';
                                    if (label.includes('Next')) label = 'Next &raquo;';

                                    return (
                                        <Link
                                            key={i}
                                            href={link.url || '#'}
                                            className={`px-4 py-2 text-sm rounded transition-colors ${
                                                !link.url ? 'opacity-50 cursor-not-allowed' : 'hover-page hover:bg-white/10'
                                            }`}
                                            style={{
                                                background: 'rgba(0,0,0,0.2)',
                                                color: 'var(--text-main)',
                                                border: '1px solid var(--glass-border)'
                                            }}
                                            dangerouslySetInnerHTML={{ __html: label }}
                                            preserveState
                                        />
                                    );
                            })}
                        </div>
                    </div>

                <style>{`
                    .hover-bg-glass:hover {
                        background: rgba(120, 120, 120, 0.1);
                    }
                    .action-btn:hover {
                        background: rgba(120, 120, 120, 0.15);
                    }
                    .data-table {
                        border-collapse: collapse;
                        width: 100%;
                    }
                    .data-table th, .data-table td {
                        border: 1px solid var(--glass-border);
                        padding: 12px;
                    }
                `}</style>
            </div>
        </DashboardLayout>
    );
}
