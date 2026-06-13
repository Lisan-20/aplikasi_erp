import React, { useState } from 'react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

export default function PenunjangMedis({ pasien, nasabahList, perusahaanList, bagianList, dokterList }) {
    // Inertia form
    const { data, setData, post, get, processing, reset } = useForm({
        no_mr: pasien?.no_mr || '',
        txt_kode_kelompok: '',
        txt_kode_perusahaan: '',
        kode_milik: '',
        txt_no_jaminan: '',
        txt_bagian: '',
        kode_dokter_hd: '',
        txt_tanggal_masuk: new Date().toISOString().slice(0, 16),
        txt_cito: '0',
        txt_pasien: pasien ? 'Lama' : 'Baru',
        flag_daftar: '0',
        dokter_pengirim: ''
    });

    const { flash } = usePage().props;
    const [searchMr, setSearchMr] = useState(pasien?.no_mr || '');

    const handleSearch = (e) => {
        e.preventDefault();
        get(`/registrasi/penunjang-medis?no_mr=${searchMr}`, {
            preserveState: true,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/registrasi/penunjang-medis', {
            onSuccess: () => {
                reset('txt_kode_kelompok', 'txt_kode_perusahaan', 'txt_bagian', 'kode_dokter_hd');
            },
        });
    };

    return (
        <div className="dashboard-layout">
            <Head title="Pendaftaran Penunjang Medis - Medilink RS" />
            
            <div className="bg-glow bg-glow-primary"></div>
            <div className="bg-glow bg-glow-secondary"></div>
            
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
                        <p className="text-xs text-blue-300/70">Pendaftaran Penunjang Medis</p>
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

            <main className="dashboard-main p-6 space-y-6">
                {flash?.success && (
                    <div className="glass-card bg-green-500/10 border-green-500/30 text-green-400 p-4 rounded-xl flex items-center">
                        <svg className="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {flash.success}
                    </div>
                )}
                
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
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
                            
                            {pasien && (
                                <div className="mt-6 pt-6 border-t border-white/10">
                                    <h3 className="text-md font-medium text-white mb-3">Info Pasien</h3>
                                    <div className="space-y-2 text-sm">
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">Nama:</span>
                                            <span className="text-white font-medium">{pasien.nama_pasien}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">No MR:</span>
                                            <span className="text-white font-medium">{pasien.no_mr}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span className="text-slate-400">Kelamin:</span>
                                            <span className="text-white">{pasien.jen_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}</span>
                                        </div>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>

                    <div className="lg:col-span-2 space-y-6">
                        <div className="glass-card p-6">
                            <h2 className="text-lg font-semibold text-white mb-6 flex items-center">
                                Form Pendaftaran Penunjang Medis
                            </h2>
                            
                            <form onSubmit={handleSubmit}>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div className="space-y-5">
                                        <div className="form-group">
                                            <label>Nasabah <span className="text-red-400">*</span></label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_kode_kelompok}
                                                onChange={e => setData('txt_kode_kelompok', e.target.value)}
                                            >
                                                <option value="">-- Pilih Nasabah --</option>
                                                {nasabahList.map((n) => (
                                                    <option key={n.kode_kelompok} value={n.kode_kelompok}>{n.nama_kelompok}</option>
                                                ))}
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Perusahaan</label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_kode_perusahaan}
                                                onChange={e => setData('txt_kode_perusahaan', e.target.value)}
                                            >
                                                <option value="">-- Pilih Perusahaan --</option>
                                                {perusahaanList.map((p) => (
                                                    <option key={p.kode_perusahaan} value={p.kode_perusahaan}>{p.nama_perusahaan}</option>
                                                ))}
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Penunjang Medis <span className="text-red-400">*</span></label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_bagian}
                                                onChange={e => setData('txt_bagian', e.target.value)}
                                            >
                                                <option value="">-- Pilih Penunjang Medis --</option>
                                                {bagianList.map((b) => (
                                                    <option key={b.kode_bagian} value={b.kode_bagian}>{b.nama_bagian}</option>
                                                ))}
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Dokter HD</label>
                                            <select 
                                                className="form-control"
                                                value={data.kode_dokter_hd}
                                                onChange={e => setData('kode_dokter_hd', e.target.value)}
                                            >
                                                <option value="">-- Pilih Dokter HD --</option>
                                                {dokterList.map((d) => (
                                                    <option key={d.kode_dokter} value={d.kode_dokter}>{d.nama_pegawai}</option>
                                                ))}
                                            </select>
                                        </div>
                                    </div>

                                    <div className="space-y-5">
                                        <div className="form-group">
                                            <label>Tanggal Daftar <span className="text-red-400">*</span></label>
                                            <input 
                                                type="datetime-local" 
                                                className="form-control"
                                                value={data.txt_tanggal_masuk}
                                                onChange={e => setData('txt_tanggal_masuk', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Jenis Layanan <span className="text-red-400">*</span></label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_cito}
                                                onChange={e => setData('txt_cito', e.target.value)}
                                            >
                                                <option value="">-- Pilih Layanan --</option>
                                                <option value="1">CITO</option>
                                                <option value="0">BIASA</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Status Pasien</label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_pasien}
                                                onChange={e => setData('txt_pasien', e.target.value)}
                                            >
                                                <option value="Lama">Lama</option>
                                                <option value="Baru">Baru</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Cara Daftar</label>
                                            <select 
                                                className="form-control"
                                                value={data.flag_daftar}
                                                onChange={e => setData('flag_daftar', e.target.value)}
                                            >
                                                <option value="0">Datang Langsung</option>
                                                <option value="1">Via Telpon</option>
                                            </select>
                                        </div>
                                        
                                        <div className="form-group">
                                            <label>Dokter Pengirim</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.dokter_pengirim}
                                                onChange={e => setData('dokter_pengirim', e.target.value)}
                                            />
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
                                        {processing ? 'Menyimpan...' : 'Submit'}
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
