import React, { useState } from 'react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import DataUmum from './DataUmum';
import Riwayat from './Riwayat';

export default function RawatJalan({ 
    patient, 
    bagian = [], 
    dokter = [],
    nasabah = [],
    perusahaan = [],
    milik = [],
    asal_pasien = [],
    jadwal_dokter = []
}) {
    const [activeTab, setActiveTab] = useState('pendaftaran_umum');

    const hitungUmur = (tglLahir) => {
        if (!tglLahir) return '-';
        const today = new Date();
        const birthDate = new Date(tglLahir);
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return `${age} Tahun`;
    };

    // Get current local time for datetime-local input
    const getLocalDatetime = () => {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    };

    // Inertia form
    const { data, setData, post, processing, errors, reset } = useForm({
        no_mr: patient?.no_mr || '',
        kode_kelompok: '',
        kode_perusahaan: '',
        kode_penanggung: '',
        kode_milik: '',
        no_jaminan: '',
        no_peserta: '',
        no_polis: '',
        noSep: '',
        no_rjk: '',
        no_ktp: patient?.no_ktp || '',
        tlp_almt_ttp: patient?.tlp_almt_ttp || patient?.no_telp || '',
        tgl_masuk: getLocalDatetime(),
        stat_pasien: patient ? 'Lama' : 'Baru',
        id_dc_asal_pasien: '',
        kode_bagian: '',
        kode_dokter: '',
        kode_jadwal: '',
        txt_memo: '',
        keterangan: '',
        prioritas: 'Biasa',
        txt_no_jkn: '',
    });

    const { flash } = usePage().props;

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/registrasi/rawat-jalan/form/${data.no_mr}`, {
            onSuccess: () => {
                reset('kode_bagian', 'kode_dokter', 'prioritas', 'keterangan', 'txt_memo');
            },
        });
    };

    const renderNasabahFields = () => {
        const kel = data.kode_kelompok?.toString();

        if (kel === '5') {
            return (
                <>
                    <div className="form-group">
                        <label>Perusahaan</label>
                        <select className="premium-input" value={data.kode_perusahaan} onChange={e => setData('kode_perusahaan', e.target.value)}>
                            <option value="">-- Pilih Perusahaan --</option>
                            {perusahaan.map(p => (
                                <option key={p.kode_perusahaan} value={p.kode_perusahaan}>{p.nama_perusahaan}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>Kepemilikan</label>
                        <select className="premium-input" value={data.kode_milik} onChange={e => setData('kode_milik', e.target.value)}>
                            <option value="">-- Pilih Kepemilikan --</option>
                            {milik.map(m => (
                                <option key={m.kode_milik} value={m.kode_milik}>{m.nama_milik}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>N I K / No. Kartu</label>
                        <input type="text" className="premium-input" value={data.no_jaminan} onChange={e => setData('no_jaminan', e.target.value)} />
                    </div>
                </>
            );
        }

        if (['3', '11'].includes(kel)) {
            return (
                <>
                    <div className="form-group">
                        <label>Asuransi</label>
                        <select className="premium-input" value={data.kode_perusahaan} onChange={e => setData('kode_perusahaan', e.target.value)}>
                            <option value="">-- Pilih Asuransi --</option>
                            {perusahaan.map(p => (
                                <option key={p.kode_perusahaan} value={p.kode_perusahaan}>{p.nama_perusahaan}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>Perusahaan Penanggung</label>
                        <select className="premium-input" value={data.kode_penanggung} onChange={e => setData('kode_penanggung', e.target.value)}>
                            <option value="">-- Pilih Perusahaan --</option>
                            {perusahaan.map(p => (
                                <option key={p.kode_perusahaan} value={p.kode_perusahaan}>{p.nama_perusahaan}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>Kepemilikan</label>
                        <select className="premium-input" value={data.kode_milik} onChange={e => setData('kode_milik', e.target.value)}>
                            <option value="">-- Pilih Kepemilikan --</option>
                            {milik.map(m => (
                                <option key={m.kode_milik} value={m.kode_milik}>{m.nama_milik}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>No. Kartu</label>
                        <input type="text" className="premium-input" value={data.no_jaminan} onChange={e => setData('no_jaminan', e.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>No. Peserta</label>
                        <input type="text" className="premium-input" value={data.no_peserta} onChange={e => setData('no_peserta', e.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>No. Polis</label>
                        <input type="text" className="premium-input" value={data.no_polis} onChange={e => setData('no_polis', e.target.value)} />
                    </div>
                </>
            );
        }

        if (['8', '9', '12'].includes(kel)) {
            return (
                <>
                    <div className="form-group">
                        <label>Perusahaan</label>
                        <select className="premium-input" value={data.kode_perusahaan} onChange={e => setData('kode_perusahaan', e.target.value)}>
                            <option value="">-- Pilih Perusahaan --</option>
                            {perusahaan.map(p => (
                                <option key={p.kode_perusahaan} value={p.kode_perusahaan}>{p.nama_perusahaan}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>Kepemilikan</label>
                        <select className="premium-input" value={data.kode_milik} onChange={e => setData('kode_milik', e.target.value)}>
                            <option value="">-- Pilih Kepemilikan --</option>
                            {milik.map(m => (
                                <option key={m.kode_milik} value={m.kode_milik}>{m.nama_milik}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>No. Jaminan</label>
                        <input type="text" className="premium-input" value={data.no_jaminan} onChange={e => setData('no_jaminan', e.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>No. SEP</label>
                        <input type="text" className="premium-input" value={data.noSep} onChange={e => setData('noSep', e.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>No. Rujukan/No SRK</label>
                        <input type="text" className="premium-input" value={data.no_rjk} onChange={e => setData('no_rjk', e.target.value)} />
                    </div>
                </>
            );
        }

        if (kel === '10') {
            return (
                <>
                    <div className="form-group">
                        <label>Kepemilikan</label>
                        <select className="premium-input" value={data.kode_milik} onChange={e => setData('kode_milik', e.target.value)}>
                            <option value="">-- Pilih Kepemilikan --</option>
                            {milik.map(m => (
                                <option key={m.kode_milik} value={m.kode_milik}>{m.nama_milik}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label>No. SJP</label>
                        <input type="text" className="premium-input" value={data.txt_no_jkn} onChange={e => setData('txt_no_jkn', e.target.value)} />
                    </div>
                    <div className="form-group">
                        <label>No. Kartu Jamkesda</label>
                        <input type="text" className="premium-input" value={data.no_jaminan} onChange={e => setData('no_jaminan', e.target.value)} />
                    </div>
                </>
            );
        }

        return null;
    };

    return (
        <DashboardLayout>
            <Head title="Pendaftaran Rawat Jalan - Medilink RS" />

            <div className="p-4">
                <div className="content-container">
                    <div className="content-header">
                        <div>
                            <h1 className="content-title">Pendaftaran Poliklinik (Rawat Jalan)</h1>
                            {/*<p className="content-subtitle">Registrasi kunjungan pasien ke poliklinik</p>*/}
                        </div>
                    </div>

                    {flash?.success ? (
                        <div className="glass-card" style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', minHeight: '60vh', padding: '3rem', textAlign: 'center', borderRadius: '1rem' }}>
                            <div style={{ backgroundColor: 'rgba(34, 197, 94, 0.1)', padding: '1.5rem', borderRadius: '50%', marginBottom: '1.5rem' }}>
                                <svg style={{ width: '80px', height: '80px', color: '#22c55e' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h2 style={{ fontSize: '1.875rem', fontWeight: 700, color: 'white', marginBottom: '1rem' }}>{flash.success}</h2>
                            <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: '1.125rem', marginBottom: '2.5rem', maxWidth: '500px' }}>
                                Data pendaftaran pasien telah berhasil dicatat ke dalam sistem pendaftaran rumah sakit.
                            </p>
                            <div style={{ display: 'flex', gap: '1rem', flexWrap: 'wrap', justifyContent: 'center' }}>
                                <Link href="/registrasi/cari-pasien" className="btn btn-secondary" style={{ padding: '0.75rem 2rem', backgroundColor: 'rgba(255,255,255,0.1)', border: '1px solid rgba(255,255,255,0.2)', borderRadius: '0.75rem', color: 'white', textDecoration: 'none', fontWeight: 600, display: 'inline-flex', alignItems: 'center', gap: '0.5rem' }}>
                                    <svg style={{ width: '20px', height: '20px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                    Kembali Cari Pasien
                                </Link>
                                <button type="button" onClick={() => window.location.reload()} className="btn btn-primary" style={{ padding: '0.75rem 2rem', backgroundColor: '#3b82f6', border: 'none', borderRadius: '0.75rem', color: 'white', fontWeight: 600, display: 'inline-flex', alignItems: 'center', gap: '0.5rem', cursor: 'pointer' }}>
                                    <svg style={{ width: '20px', height: '20px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"></path></svg>
                                    Daftarkan Pasien Ini Lagi
                                </button>
                            </div>
                        </div>
                    ) : (
                        <>
                            {flash?.error && (
                                <div className="glass-card mb-6 p-4" style={{ borderLeft: '4px solid #ef4444', backgroundColor: 'rgba(239, 68, 68, 0.1)', color: '#ef4444', borderRadius: '0.5rem' }}>
                                    <div style={{ display: 'flex', alignItems: 'center' }}>
                                        <svg style={{ width: '24px', height: '24px', marginRight: '0.75rem', flexShrink: 0 }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        <span>{flash.error}</span>
                                    </div>
                                </div>
                            )}

                            <div className="max-w-4xl mx-auto space-y-6">
                        {patient && (
                            <div className="glass-card p-6 bg-white/5 border border-white/20 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] relative overflow-hidden">
                                {/* Background Accent */}
                                <div className="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
                                <div className="absolute bottom-0 left-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl -ml-5 -mb-5 pointer-events-none"></div>

                                <div className="relative z-10 flex flex-col md:flex-row justify-between md:items-center gap-4">
                                    <div>
                                        <h2 className="text-3xl font-extrabold text-white mb-3 tracking-tight">{patient.nama_pasien}</h2>
                                        <div className="flex flex-wrap items-center gap-3 text-sm text-white/80">
                                            <div className="flex items-center gap-1.5 bg-black/20 px-3 py-1.5 rounded-lg border border-white/5">
                                                <svg className="text-cyan-400 shrink-0" style={{ width: '16px', height: '16px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                                <span className="font-mono text-cyan-100 font-medium">{patient.no_mr}</span>
                                            </div>
                                            <div className="flex items-center gap-1.5 bg-black/20 px-3 py-1.5 rounded-lg border border-white/5">
                                                <svg className="text-pink-400 shrink-0" style={{ width: '16px', height: '16px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                <span className="font-medium">{patient.jen_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}</span>
                                            </div>
                                            <div className="flex items-center gap-1.5 bg-black/20 px-3 py-1.5 rounded-lg border border-white/5">
                                                <svg className="text-yellow-400 shrink-0" style={{ width: '16px', height: '16px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                <span className="font-medium">{hitungUmur(patient.tgl_lhr)}</span>
                                            </div>
                                            <div className="flex items-center gap-1.5 bg-black/20 px-3 py-1.5 rounded-lg border border-white/5">
                                                <svg className="text-green-400 shrink-0" style={{ width: '16px', height: '16px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" /><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                <span className="font-medium">{patient.almt_ttp_pasien || '-'}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )}

                        {/* Tab Navigation */}
                        <div className="glass-card p-1.5 rounded-xl flex gap-1 overflow-x-auto border border-white/10 hide-scrollbar">
                            {[
                                { id: 'data_umum', label: 'Data Umum', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' },
                                { id: 'pendaftaran_umum', label: 'Pendaftaran Umum', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2' },
                                { id: 'riwayat', label: 'Riwayat', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { id: 'pendaftaran_bpjs', label: 'Pendaftaran BPJS', icon: 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z' }
                            ].map(tab => (
                                <button
                                    key={tab.id}
                                    type="button"
                                    onClick={() => setActiveTab(tab.id)}
                                    className={`flex items-center gap-2 px-5 py-2.5 rounded-lg font-medium transition-all duration-300 whitespace-nowrap ${
                                        activeTab === tab.id
                                        ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 shadow-[0_0_15px_rgba(6,182,212,0.15)]'
                                        : 'text-white/60 hover:text-white hover:bg-white/5 border border-transparent'
                                    }`}
                                >
                                    <svg className="shrink-0" style={{ width: '20px', height: '20px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d={tab.icon}></path>
                                    </svg>
                                    {tab.label}
                                </button>
                            ))}
                        </div>

                        {activeTab === 'pendaftaran_umum' ? (
                            <div className="glass-card form-card animate-fadeIn" style={{ display: 'flex', flexDirection: 'column', height: 'calc(100vh - 280px)', minHeight: '400px' }}>
                                <div className="card-body" style={{ display: 'flex', flexDirection: 'column', height: '100%', padding: '0' }}>
                                    <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
                                        <div style={{ flex: 1, overflowY: 'auto', padding: '1.5rem', scrollbarWidth: 'thin' }}>
                                            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '2rem' }}>
                                                {/* Left Column - Informasi Pasien & Asuransi */}
                                                <div style={{ display: 'flex', flexDirection: 'column', gap: '1.25rem' }}>
                                                    <h3 style={{ fontSize: '1.125rem', fontWeight: 600, color: 'rgba(255,255,255,0.9)', borderBottom: '1px solid rgba(255,255,255,0.1)', paddingBottom: '0.5rem', marginBottom: '1rem', position: 'sticky', top: '-24px', backgroundColor: '#0f172a', zIndex: 10, paddingTop: '0.5rem' }}>Informasi Pasien & Jaminan</h3>
                                                    
                                                    <div className="form-group">
                                                        <label>Nasabah <span style={{ color: '#f87171' }}>*</span></label>
                                                        <select
                                                            className={`premium-input ${errors.kode_kelompok ? 'is-invalid' : ''}`}
                                                            value={data.kode_kelompok}
                                                            onChange={e => setData('kode_kelompok', e.target.value)}
                                                        >
                                                            <option value="">-- Pilih Nasabah --</option>
                                                            {nasabah.map((n) => (
                                                                <option key={n.kode_kelompok} value={n.kode_kelompok}>{n.nama_kelompok}</option>
                                                            ))}
                                                        </select>
                                                        {errors.kode_kelompok && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.kode_kelompok}</div>}
                                                    </div>

                                                    {renderNasabahFields()}

                                                    <div className="form-group">
                                                        <label>NIK KTP <span style={{ color: '#f87171' }}>*</span></label>
                                                        <input
                                                            type="text"
                                                            className={`premium-input ${errors.no_ktp ? 'is-invalid' : ''}`}
                                                            value={data.no_ktp}
                                                            onChange={e => setData('no_ktp', e.target.value)}
                                                        />
                                                        {errors.no_ktp && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.no_ktp}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label>No. Telp <span style={{ color: '#f87171' }}>*</span></label>
                                                        <input
                                                            type="text"
                                                            className={`premium-input ${errors.tlp_almt_ttp ? 'is-invalid' : ''}`}
                                                            value={data.tlp_almt_ttp}
                                                            onChange={e => setData('tlp_almt_ttp', e.target.value)}
                                                        />
                                                        {errors.tlp_almt_ttp && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.tlp_almt_ttp}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Status Pasien <span style={{ color: '#f87171' }}>*</span></label>
                                                        <select
                                                            className="premium-input"
                                                            value={data.stat_pasien}
                                                            onChange={e => setData('stat_pasien', e.target.value)}
                                                        >
                                                            <option value="Lama">Lama</option>
                                                            <option value="Baru">Baru</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {/* Right Column - Informasi Kunjungan */}
                                                <div style={{ display: 'flex', flexDirection: 'column', gap: '1.25rem' }}>
                                                    <h3 style={{ fontSize: '1.125rem', fontWeight: 600, color: 'rgba(255,255,255,0.9)', borderBottom: '1px solid rgba(255,255,255,0.1)', paddingBottom: '0.5rem', marginBottom: '1rem', position: 'sticky', top: '-24px', backgroundColor: '#0f172a', zIndex: 10, paddingTop: '0.5rem' }}>Informasi Kunjungan</h3>

                                                    <div className="form-group">
                                                        <label>Asal Pasien</label>
                                                        <select
                                                            className="premium-input"
                                                            value={data.id_dc_asal_pasien}
                                                            onChange={e => setData('id_dc_asal_pasien', e.target.value)}
                                                        >
                                                            <option value="">-- Pilih Asal Pasien --</option>
                                                            {asal_pasien.map((a) => (
                                                                <option key={a.id_dc_asal_pasien} value={a.id_dc_asal_pasien}>{a.asal_pasien}</option>
                                                            ))}
                                                        </select>
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Poliklinik Tujuan <span style={{ color: '#f87171' }}>*</span></label>
                                                        <select
                                                            className={`premium-input ${errors.kode_bagian ? 'is-invalid' : ''}`}
                                                            value={data.kode_bagian}
                                                            onChange={e => setData('kode_bagian', e.target.value)}
                                                        >
                                                            <option value="">-- Pilih Poliklinik --</option>
                                                            {bagian.map((b) => (
                                                                <option key={b.kode_bagian} value={b.kode_bagian}>{b.nama_bagian}</option>
                                                            ))}
                                                        </select>
                                                        {errors.kode_bagian && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.kode_bagian}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Dokter Pemeriksa <span style={{ color: '#f87171' }}>*</span></label>
                                                        <select
                                                            className={`premium-input ${errors.kode_dokter ? 'is-invalid' : ''}`}
                                                            value={data.kode_dokter}
                                                            onChange={e => setData('kode_dokter', e.target.value)}
                                                        >
                                                            <option value="">-- Pilih Dokter --</option>
                                                            {dokter.map((d) => (
                                                                <option key={d.kode_dokter} value={d.kode_dokter}>{d.nama_pegawai}</option>
                                                            ))}
                                                        </select>
                                                        {errors.kode_dokter && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.kode_dokter}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Jadwal Praktek <span style={{ color: '#f87171' }}>*</span></label>
                                                        <select
                                                            className={`premium-input ${errors.kode_jadwal ? 'is-invalid' : ''}`}
                                                            value={data.kode_jadwal}
                                                            onChange={e => setData('kode_jadwal', e.target.value)}
                                                        >
                                                            <option value="">-- Pilih Jadwal --</option>
                                                            {jadwal_dokter.map((j) => (
                                                                <option key={j.kode_jadwal} value={j.kode_jadwal}>{j.jadwal_dokter}</option>
                                                            ))}
                                                        </select>
                                                        {errors.kode_jadwal && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.kode_jadwal}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Tanggal & Jam Masuk <span style={{ color: '#f87171' }}>*</span></label>
                                                        <input
                                                            type="datetime-local"
                                                            className={`premium-input ${errors.tgl_masuk ? 'is-invalid' : ''}`}
                                                            value={data.tgl_masuk}
                                                            onChange={e => setData('tgl_masuk', e.target.value)}
                                                        />
                                                        {errors.tgl_masuk && <div style={{ color: '#f87171', fontSize: '0.875rem' }}>{errors.tgl_masuk}</div>}
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Prioritas</label>
                                                        <select
                                                            className="premium-input"
                                                            value={data.prioritas}
                                                            onChange={e => setData('prioritas', e.target.value)}
                                                        >
                                                            <option value="Biasa">Biasa</option>
                                                            <option value="Cito">Cito</option>
                                                        </select>
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Memo</label>
                                                        <textarea
                                                            className="premium-input"
                                                            rows="2"
                                                            value={data.txt_memo}
                                                            onChange={e => setData('txt_memo', e.target.value)}
                                                        ></textarea>
                                                    </div>

                                                    <div className="form-group">
                                                        <label>Keterangan</label>
                                                        <textarea
                                                            className="premium-input"
                                                            rows="3"
                                                            value={data.keterangan}
                                                            onChange={e => setData('keterangan', e.target.value)}
                                                        ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style={{ flex: 'none', padding: '1rem', display: 'flex', justifyContent: 'flex-end', gap: '0.75rem', borderTop: '1px solid rgba(255,255,255,0.1)', backgroundColor: 'var(--bg-dark, #0f172a)', borderBottomLeftRadius: '16px', borderBottomRightRadius: '16px' }}>
                                            <button
                                                type="button"
                                                className="btn btn-secondary"
                                                style={{ padding: '0.5rem 1.5rem', backgroundColor: 'rgba(255,255,255,0.1)', border: '1px solid rgba(255,255,255,0.2)', borderRadius: '0.5rem', cursor: 'pointer', color: 'white' }}
                                                onClick={() => reset()}
                                            >
                                                Reset
                                            </button>
                                            <button
                                                type="submit"
                                                className="btn btn-primary"
                                                style={{ padding: '0.5rem 1.5rem', backgroundColor: '#3b82f6', border: 'none', borderRadius: '0.5rem', cursor: 'pointer', color: 'white', fontWeight: 600 }}
                                                disabled={processing || !data.no_mr}
                                            >
                                                {processing ? 'Memproses...' : 'Daftarkan Pasien'}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        ) : activeTab === 'data_umum' ? (
                            <DataUmum patient={patient} />
                        ) : activeTab === 'riwayat' ? (
                            <Riwayat patient={patient} />
                        ) : (
                            <div className="glass-card p-16 flex flex-col items-center justify-center text-center border border-white/10 rounded-2xl animate-fadeIn shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                                <div className="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mb-6 shadow-inner border border-white/10 relative">
                                    <div className="absolute inset-0 bg-cyan-500/20 rounded-full blur-xl"></div>
                                    <svg className="w-12 h-12 text-cyan-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h2 className="text-2xl font-bold text-white mb-3">Fitur Masih Dalam Pengembangan</h2>
                                <p className="text-white/60 max-w-md leading-relaxed">
                                    Kami sedang bekerja keras untuk menghadirkan fitur ini. Silakan gunakan tab <strong className="text-white">Pendaftaran Umum</strong> untuk sementara waktu.
                                </p>
                            </div>
                        )}
                    </div>
                        </>
                    )}
                </div>
                <style>{`
                    @keyframes fadeIn {
                        from { opacity: 0; transform: translateY(10px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .animate-fadeIn {
                        animation: fadeIn 0.4s ease-out forwards;
                    }
                    .hide-scrollbar::-webkit-scrollbar {
                        display: none;
                    }
                    .hide-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
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
