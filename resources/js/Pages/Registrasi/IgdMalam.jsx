import React, { useState } from 'react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

export default function IgdMalam({ pasien, dokterList }) {
    // Inertia form
    const { data, setData, post, get, processing, reset } = useForm({
        no_mr: pasien?.no_mr || '',
        txt_pasien: pasien ? 'Lama' : 'Baru',
        txt_tanggal_masuk: new Date().toISOString().slice(0, 16),
        jns_celaka: '',
        tgl_celaka: '',
        tmpt_kecelakaan: '',
        dikirim_oleh: '',
        dibawa_oleh: '',
        dibawa_dgn: '',
        status_diterima: 'Hidup',
        kasus_polisi: '',
        kode_dokter: '',
        nama_org_dekat: '',
        alamat_org_dekat: pasien?.almt_ttp_pasien || '',
        telp_org_dekat: ''
    });

    const { flash } = usePage().props;
    const [searchMr, setSearchMr] = useState(pasien?.no_mr || '');

    const handleSearch = (e) => {
        e.preventDefault();
        get(`/registrasi/igd-malam?no_mr=${searchMr}`, {
            preserveState: true,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/registrasi/igd-malam', {
            onSuccess: () => {
                reset('jns_celaka', 'tgl_celaka', 'tmpt_kecelakaan', 'dikirim_oleh', 'dibawa_oleh', 'dibawa_dgn', 'kasus_polisi', 'kode_dokter', 'nama_org_dekat', 'telp_org_dekat');
            },
        });
    };

    return (
        <div className="dashboard-layout">
            <Head title="Pendaftaran IGD Malam - Medilink RS" />
            
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
                        <p className="text-xs text-blue-300/70">Pendaftaran IGD Malam</p>
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
                                Form Pendaftaran IGD Malam
                            </h2>
                            
                            <form onSubmit={handleSubmit}>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div className="space-y-5">
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
                                            <label>Tanggal Daftar</label>
                                            <input 
                                                type="datetime-local" 
                                                className="form-control"
                                                value={data.txt_tanggal_masuk}
                                                onChange={e => setData('txt_tanggal_masuk', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Jenis Kejadian <span className="text-red-400">*</span></label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.jns_celaka}
                                                onChange={e => setData('jns_celaka', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Tanggal Kejadian</label>
                                            <input 
                                                type="date" 
                                                className="form-control"
                                                value={data.tgl_celaka}
                                                onChange={e => setData('tgl_celaka', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Tempat Kejadian</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.tmpt_kecelakaan}
                                                onChange={e => setData('tmpt_kecelakaan', e.target.value)}
                                            />
                                        </div>
                                        
                                        <div className="form-group">
                                            <label>Kasus Polisi</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.kasus_polisi}
                                                onChange={e => setData('kasus_polisi', e.target.value)}
                                            />
                                        </div>
                                    </div>

                                    <div className="space-y-5">
                                        <div className="form-group">
                                            <label>Dikirim Oleh</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.dikirim_oleh}
                                                onChange={e => setData('dikirim_oleh', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Diantar Oleh</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.dibawa_oleh}
                                                onChange={e => setData('dibawa_oleh', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Dibawa RS Dengan</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.dibawa_dgn}
                                                onChange={e => setData('dibawa_dgn', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Status Diterima</label>
                                            <select 
                                                className="form-control"
                                                value={data.status_diterima}
                                                onChange={e => setData('status_diterima', e.target.value)}
                                            >
                                                <option value="Hidup">Hidup</option>
                                                <option value="Meninggal">Meninggal</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Dokter Jaga <span className="text-red-400">*</span></label>
                                            <select 
                                                className="form-control"
                                                value={data.kode_dokter}
                                                onChange={e => setData('kode_dokter', e.target.value)}
                                            >
                                                <option value="">-- Pilih Dokter --</option>
                                                {dokterList.map((d) => (
                                                    <option key={d.kode_dokter} value={d.kode_dokter}>{d.nama_pegawai}</option>
                                                ))}
                                            </select>
                                        </div>
                                        
                                        <div className="mt-4 pt-4 border-t border-white/10">
                                            <h3 className="text-sm font-medium text-white mb-3">Keluarga Terdekat</h3>
                                            <div className="space-y-4">
                                                <div className="form-group">
                                                    <label>Nama</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.nama_org_dekat}
                                                        onChange={e => setData('nama_org_dekat', e.target.value)}
                                                    />
                                                </div>
                                                <div className="form-group">
                                                    <label>Telepon</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.telp_org_dekat}
                                                        onChange={e => setData('telp_org_dekat', e.target.value)}
                                                    />
                                                </div>
                                                <div className="form-group">
                                                    <label>Alamat</label>
                                                    <textarea 
                                                        className="form-control"
                                                        rows="2"
                                                        value={data.alamat_org_dekat}
                                                        onChange={e => setData('alamat_org_dekat', e.target.value)}
                                                    ></textarea>
                                                </div>
                                            </div>
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
