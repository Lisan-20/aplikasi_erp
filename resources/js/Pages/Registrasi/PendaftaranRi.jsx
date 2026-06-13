import React from 'react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

export default function PendaftaranRi({ auth, patients }) {
    const user = auth?.user || { username: 'Admin', role: 'Registrasi' };
    
    // Inertia form
    const { data, setData, post, processing, errors, reset } = useForm({
        no_mr: '',
        txt_kode_kelompok: '',
        txt_kode_perusahaan: '',
        kode_milik: '',
        txt_no_jaminan: '',
        txt_tanggal_masuk: new Date().toISOString().slice(0, 16),
        id_dc_asal_pasien: '',
        id_dc_sub_asal_pasien: '',
        obstetri: 'no',
        icd_diagnosa: '',
        kode_ruangan: '',
        flag_titipan: '',
        txt_jth_kelas: '',
        kode_dokter: '',
        txt_pasien: 'Baru',
        flag_daftar: '0',
        txt_nama_kel: ''
    });

    const { flash } = usePage().props;

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/registrasi/pendaftaran-ri', {
            onSuccess: () => {
                reset();
            },
        });
    };

    return (
        <div className="dashboard-layout">
            <Head title="Pendaftaran Rawat Inap - Medilink RS" />
            
            <div className="bg-glow bg-glow-primary" style={{ background: 'radial-gradient(circle at top right, rgba(16, 185, 129, 0.15) 0%, transparent 60%)' }}></div>
            <div className="bg-glow bg-glow-secondary" style={{ background: 'radial-gradient(circle at bottom left, rgba(5, 150, 105, 0.1) 0%, transparent 50%)' }}></div>
            
            <header className="dashboard-navbar glass-card border-b border-emerald-500/20">
                <div className="navbar-brand">
                    <div className="logo-badge" style={{ background: 'linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.1) 100%)', borderColor: 'rgba(16, 185, 129, 0.3)' }}>
                        <svg className="logo-svg text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2.5} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h2>MEDILINK RI</h2>
                        <span className="navbar-tag bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Rawat Inap</span>
                    </div>
                </div>
                
                <div className="navbar-actions">
                    <Link href="/dashboard/2" className="btn-icon">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        <span>Kembali</span>
                    </Link>
                    <div className="user-profile">
                        <div className="user-avatar border-emerald-500/30 text-emerald-300">
                            {user.username.substring(0, 2).toUpperCase()}
                        </div>
                        <div className="user-info">
                            <span className="user-name">{user.username}</span>
                            <span className="user-role">{user.role}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main className="dashboard-main">
                <div className="content-container">
                    <div className="content-header">
                        <div>
                            <h1 className="content-title text-emerald-50">Pendaftaran Rawat Inap</h1>
                            <p className="content-subtitle text-emerald-200/60">Registrasi pasien untuk fasilitas rawat inap</p>
                        </div>
                    </div>

                    {flash?.success && (
                        <div className="alert-success glass-card mb-6 p-4 border-l-4 border-green-500">
                            <div className="flex items-center">
                                <svg className="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>{flash.success}</span>
                            </div>
                        </div>
                    )}

                    <div className="glass-card form-card border border-emerald-500/10">
                        <div className="card-header border-b border-emerald-500/10">
                            <h3 className="text-emerald-100">Form Pendaftaran RI</h3>
                        </div>
                        
                        <div className="card-body">
                            <form onSubmit={handleSubmit}>
                                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <div className="space-y-4">
                                        <h4 className="text-sm font-semibold text-emerald-300 uppercase tracking-wider mb-2">Data Pasien</h4>
                                        
                                        <div className="form-group">
                                            <label>Pilih Pasien <span className="text-red-400">*</span></label>
                                            <select 
                                                className={`form-control ${errors.no_mr ? 'is-invalid' : ''}`}
                                                value={data.no_mr}
                                                onChange={e => setData('no_mr', e.target.value)}
                                            >
                                                <option value="">-- Pilih Pasien --</option>
                                                {patients.map(p => (
                                                    <option key={p.id} value={p.mr_number}>{p.mr_number} - {p.name}</option>
                                                ))}
                                            </select>
                                            {errors.no_mr && <div className="invalid-feedback">{errors.no_mr}</div>}
                                        </div>

                                        <div className="form-group">
                                            <label>Status Pasien</label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_pasien}
                                                onChange={e => setData('txt_pasien', e.target.value)}
                                            >
                                                <option value="Baru">Baru</option>
                                                <option value="Lama">Lama</option>
                                            </select>
                                        </div>
                                        
                                        <div className="form-group">
                                            <label>Nama Keluarga Terdekat <span className="text-red-400">*</span></label>
                                            <input 
                                                type="text" 
                                                className={`form-control ${errors.txt_nama_kel ? 'is-invalid' : ''}`}
                                                value={data.txt_nama_kel}
                                                onChange={e => setData('txt_nama_kel', e.target.value)}
                                            />
                                        </div>
                                    </div>

                                    <div className="space-y-4">
                                        <h4 className="text-sm font-semibold text-emerald-300 uppercase tracking-wider mb-2">Data Asuransi / Penjamin</h4>
                                        
                                        <div className="form-group">
                                            <label>Nasabah</label>
                                            <select 
                                                className="form-control"
                                                value={data.txt_kode_kelompok}
                                                onChange={e => setData('txt_kode_kelompok', e.target.value)}
                                            >
                                                <option value="">-- Pilih Nasabah --</option>
                                                <option value="1">Umum</option>
                                                <option value="3">Asuransi</option>
                                                <option value="5">Perusahaan</option>
                                                <option value="9">BPJS</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Kepemilikan</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.kode_milik}
                                                onChange={e => setData('kode_milik', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>No. Jaminan</label>
                                            <input 
                                                type="text" 
                                                className="form-control"
                                                value={data.txt_no_jaminan}
                                                onChange={e => setData('txt_no_jaminan', e.target.value)}
                                            />
                                        </div>
                                    </div>

                                    <div className="space-y-4">
                                        <h4 className="text-sm font-semibold text-emerald-300 uppercase tracking-wider mb-2">Data Masuk</h4>
                                        
                                        <div className="form-group">
                                            <label>Tgl Masuk</label>
                                            <input 
                                                type="datetime-local" 
                                                className="form-control"
                                                value={data.txt_tanggal_masuk}
                                                onChange={e => setData('txt_tanggal_masuk', e.target.value)}
                                            />
                                        </div>

                                        <div className="form-group">
                                            <label>Bed (Kamar) <span className="text-red-400">*</span></label>
                                            <select 
                                                className={`form-control ${errors.kode_ruangan ? 'is-invalid' : ''}`}
                                                value={data.kode_ruangan}
                                                onChange={e => setData('kode_ruangan', e.target.value)}
                                            >
                                                <option value="">-- Pilih Bed --</option>
                                                <option value="R01">Kamar 101 - Bed 1</option>
                                                <option value="R02">Kamar 101 - Bed 2</option>
                                                <option value="R03">Kamar 102 - Bed 1</option>
                                            </select>
                                        </div>

                                        <div className="form-group">
                                            <label>Dokter Merawat <span className="text-red-400">*</span></label>
                                            <select 
                                                className={`form-control ${errors.kode_dokter ? 'is-invalid' : ''}`}
                                                value={data.kode_dokter}
                                                onChange={e => setData('kode_dokter', e.target.value)}
                                            >
                                                <option value="">-- Pilih Dokter --</option>
                                                <option value="DR01">Dr. Andi</option>
                                                <option value="DR02">Dr. Budi</option>
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
                                    </div>
                                </div>

                                <div className="form-actions mt-8 pt-6 border-t border-emerald-500/20 flex justify-end space-x-3">
                                    <button 
                                        type="button" 
                                        className="btn bg-white/5 hover:bg-white/10 text-white border-white/10"
                                        onClick={() => reset()}
                                    >
                                        Reset
                                    </button>
                                    <button 
                                        type="submit" 
                                        className="btn bg-emerald-600 hover:bg-emerald-500 text-white border-none shadow-[0_0_15px_rgba(16,185,129,0.5)]"
                                        disabled={processing}
                                    >
                                        {processing ? 'Menyimpan...' : 'Simpan Pendaftaran RI'}
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
