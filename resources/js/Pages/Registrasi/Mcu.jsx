import React, { useState } from 'react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

export default function Mcu({ auth, patient, bagian, dokter }) {
    const user = auth?.user || { username: 'Admin', role: 'Registrasi' };
    
    // Inertia form
    const { data, setData, post, get, processing, errors, reset } = useForm({
        no_mr: patient?.no_mr || '',
        kode_bagian: '',
        kode_dokter: '',
        tgl_masuk: new Date().toISOString().slice(0, 16),
        stat_pasien: patient ? 'Lama' : 'Baru',
        prioritas: 'Biasa',
        no_jaminan: '',
        keterangan: '',
    });

    const { flash } = usePage().props;
    const [searchMr, setSearchMr] = useState(patient?.no_mr || '');

    const handleSearch = (e) => {
        e.preventDefault();
        get(`/registrasi/mcu?no_mr=${searchMr}`, {
            preserveState: true,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/registrasi/mcu', {
            onSuccess: () => {
                reset('kode_bagian', 'kode_dokter', 'prioritas', 'keterangan');
            },
        });
    };

    return (
        <div className="dashboard-layout">
            <Head title="Pendaftaran Medical Check Up - Medilink RS" />
            
            {/* Background Glows */}
            <div className="bg-glow bg-glow-primary"></div>
            <div className="bg-glow bg-glow-secondary"></div>
            
            {/* Top Navbar */}
            <header className="dashboard-navbar glass-card">
                <div className="navbar-brand">
                    <div className="logo-badge">
                        <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h1 className="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">
                            Medilink RS
                        </h1>
                        <p className="text-xs text-blue-300/70">Pendaftaran Medical Check Up</p>
                    </div>
                </div>
                
                <div className="navbar-actions">
                    <Link href="/dashboard/2" className="btn btn-secondary">
                        <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Menu
                    </Link>
                </div>
            </header>

            {/* Main Content */}
            <main className="dashboard-main p-6 space-y-6">
                {flash?.success && (
                    <div className="glass-card bg-green-500/10 border-green-500/30 text-green-400 p-4 rounded-xl flex items-center">
                        <svg className="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {flash.success}
                    </div>
                )}
                {errors?.error && (
                    <div className="glass-card bg-red-500/10 border-red-500/30 text-red-400 p-4 rounded-xl flex items-center">
                        <svg className="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {errors.error}
                    </div>
                )}

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {/* Patient Search */}
                    <div className="lg:col-span-1 space-y-6">
                        <div className="glass-card p-6">
                            <h2 className="text-lg font-semibold text-white mb-4 flex items-center">
                                <svg className="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Cari Pasien
                            </h2>
                            <form onSubmit={handleSearch} className="space-y-4">
                                <div className="form-group">
                                    <label>No. Medical Record</label>
                                    <div className="flex space-x-2">
                                        <input 
                                            type="text" 
                                            className="form-control flex-1"
                                            value={searchMr}
                                            onChange={e => setSearchMr(e.target.value)}
                                            placeholder="Masukkan No MR"
                                        />
                                        <button type="submit" className="btn btn-primary px-4">Cari</button>
                                    </div>
                                </div>
                            </form>
                            
                            {patient && (
                                <div className="mt-6 pt-6 border-t border-white/10">
                                    <h3 className="text-md font-medium text-white mb-3">Info Pasien</h3>
                                    <div className="space-y-2 text-sm">
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">Nama:</span>
                                            <span className="text-white font-medium">{patient.nama_pasien}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">No MR:</span>
                                            <span className="text-white font-medium">{patient.no_mr}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">Kelamin:</span>
                                            <span className="text-white">{patient.jen_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">Tgl Lahir:</span>
                                            <span className="text-white">{patient.tgl_lhr}</span>
                                        </div>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Registration Form */}
                    <div className="lg:col-span-2 space-y-6">
                        <div className="glass-card p-6">
                            <h2 className="text-lg font-semibold text-white mb-6 flex items-center">
                                <svg className="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Form Pendaftaran Medical Check Up
                            </h2>
                            
                            <form onSubmit={handleSubmit}>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div className="space-y-5">
                                        <div className="form-group">
                                            <label>Poliklinik Tujuan <span className="text-red-400">*</span></label>
                                            <select 
                                                className={`form-control ${errors.kode_bagian ? 'is-invalid' : ''}`}
                                                value={data.kode_bagian}
                                                onChange={e => setData('kode_bagian', e.target.value)}
                                            >
                                                <option value="">-- Pilih MCU --</option>
                                                {bagian.map((b) => (
                                                    <option key={b.kode_bagian} value={b.kode_bagian}>{b.nama_bagian}</option>
                                                ))}
                                            </select>
                                            {errors.kode_bagian && <div className="invalid-feedback">{errors.kode_bagian}</div>}
                                        </div>

                                        <div className="form-group">
                                            <label>Dokter Pemeriksa <span className="text-red-400">*</span></label>
                                            <select 
                                                className={`form-control ${errors.kode_dokter ? 'is-invalid' : ''}`}
                                                value={data.kode_dokter}
                                                onChange={e => setData('kode_dokter', e.target.value)}
                                            >
                                                <option value="">-- Pilih Dokter --</option>
                                                {dokter.map((d) => (
                                                    <option key={d.kode_dokter} value={d.kode_dokter}>{d.nama_pegawai}</option>
                                                ))}
                                            </select>
                                            {errors.kode_dokter && <div className="invalid-feedback">{errors.kode_dokter}</div>}
                                        </div>
                                        
                                        <div className="form-group">
                                            <label>Tanggal & Jam Masuk <span className="text-red-400">*</span></label>
                                            <input 
                                                type="datetime-local" 
                                                className={`form-control ${errors.tgl_masuk ? 'is-invalid' : ''}`}
                                                value={data.tgl_masuk}
                                                onChange={e => setData('tgl_masuk', e.target.value)}
                                            />
                                            {errors.tgl_masuk && <div className="invalid-feedback">{errors.tgl_masuk}</div>}
                                        </div>
                                    </div>

                                    <div className="space-y-5">
                                        <div className="form-group">
                                            <label>Status Pasien</label>
                                            <select 
                                                className="form-control"
                                                value={data.stat_pasien}
                                                onChange={e => setData('stat_pasien', e.target.value)}
                                            >
                                                <option value="Lama">Lama</option>
                                                <option value="Baru">Baru</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Prioritas</label>
                                            <select 
                                                className="form-control"
                                                value={data.prioritas}
                                                onChange={e => setData('prioritas', e.target.value)}
                                            >
                                                <option value="Biasa">Biasa</option>
                                                <option value="Cito">Cito</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>No Jaminan / Asuransi / BPJS</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.no_jaminan}
                                                onChange={e => setData('no_jaminan', e.target.value)}
                                                placeholder="Kosongkan jika Umum"
                                            />
                                        </div>
                                        
                                        <div className="form-group">
                                            <label>Keterangan</label>
                                            <textarea 
                                                className="form-control"
                                                rows="3"
                                                value={data.keterangan}
                                                onChange={e => setData('keterangan', e.target.value)}
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div className="form-actions mt-8 flex justify-end space-x-3">
                                    <button 
                                        type="button" 
                                        className="btn btn-secondary"
                                        onClick={() => reset()}
                                    >
                                        Reset
                                    </button>
                                    <button 
                                        type="submit" 
                                        className="btn btn-primary"
                                        disabled={processing || !data.no_mr}
                                    >
                                        {processing ? 'Menyimpan...' : 'Daftarkan Pasien'}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
}
