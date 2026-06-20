import React, { useState } from 'react';
import { Head, Link, useForm, usePage } from '@inertiajs/react';

export default function EditDataUmum({ auth, patient }) {
    const user = auth?.user || { username: 'Admin', role: 'Registrasi' };
    
    // Fallback if no patient
    const p = patient || {};
    
    // Inertia form
    const { data, setData, post, processing, errors, reset } = useForm({
        no_mr: p.mr_number || '',
        nama_pasien: p.name || '',
        no_ktp: p.id_card_number || '',
        nama_ibu: '',
        nama_kel_pasien: '',
        tempat_lahir: p.birth_place || '',
        txt_tgl_lahir: p.birth_date ? p.birth_date.split('-')[2] : '',
        txt_bln_lahir: p.birth_date ? p.birth_date.split('-')[1] : '',
        txt_thn_lahir: p.birth_date ? p.birth_date.split('-')[0] : '',
        almt_ttp_pasien: p.address || '',
        id_dc_kota: '',
        id_dc_kecamatan: '',
        id_dc_kelurahan: '',
        jen_kelamin: p.gender || 'L',
        kode_agama: '',
        tlp_almt_ttp: p.phone || '',
        kode_kelompok: '',
        txt_nama_karyawan: '',
        txt_nik: '',
        jth_kelas: '',
        txt_milik: '',
        flag_daftar: '0'
    });

    const { flash } = usePage().props;

    const [searchMr, setSearchMr] = useState(data.no_mr);

    const handleSearch = (e) => {
        e.preventDefault();
        window.location.href = `/registrasi/edit-data?mr_number=${searchMr}`;
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/registrasi/edit-data', {
            onSuccess: () => {
                // Success handled by flash
            },
        });
    };

    return (
        <div className="dashboard-layout">
            <Head title="Edit Data Umum - Medilink RS" />
            
            <div className="bg-glow bg-glow-primary" style={{ background: 'radial-gradient(circle at top right, rgba(59, 130, 246, 0.15) 0%, transparent 60%)' }}></div>
            <div className="bg-glow bg-glow-secondary" style={{ background: 'radial-gradient(circle at bottom left, rgba(37, 99, 235, 0.1) 0%, transparent 50%)' }}></div>
            
            <header className="dashboard-navbar glass-card border-b border-blue-500/20">
                <div className="navbar-brand">
                    <div className="logo-badge" style={{ background: 'linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.1) 100%)', borderColor: 'rgba(59, 130, 246, 0.3)' }}>
                        <svg className="logo-svg text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2.5} d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2>MEDILINK</h2>
                        <span className="navbar-tag bg-blue-500/20 text-blue-300 border border-blue-500/30">Edit Pasien</span>
                    </div>
                </div>
                
                <div className="navbar-actions">
                    <Link href="/dashboard/2" className="btn-icon">
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        <span>Kembali</span>
                    </Link>
                    <div className="user-profile">
                        <div className="user-avatar border-blue-500/30 text-blue-300">
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
                            <h1 className="content-title text-blue-50">Edit Data Umum Pasien</h1>
                            <p className="content-subtitle text-blue-200/60">Perbarui data rekam medis dan informasi umum pasien</p>
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

                    <div className="grid grid-cols-1 xl:grid-cols-4 gap-6">
                        {/* Search Pasien Column */}
                        <div className="xl:col-span-1 space-y-6">
                            <div className="glass-card form-card border border-blue-500/10">
                                <div className="card-header border-b border-blue-500/10">
                                    <h3 className="text-blue-100">Cari Pasien</h3>
                                </div>
                                <div className="card-body">
                                    <form onSubmit={handleSearch}>
                                        <div className="form-group">
                                            <label className="form-label">No. Rekam Medis</label>
                                            <div className="flex space-x-2">
                                                <input 
                                                    type="text" 
                                                    className="form-control" 
                                                    value={searchMr}
                                                    onChange={e => setSearchMr(e.target.value)}
                                                    placeholder="Masukkan No MR..."
                                                />
                                                <button type="submit" className="btn bg-blue-600 hover:bg-blue-500 text-white whitespace-nowrap border-none">
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {/* Pendaftaran Column */}
                        <div className="xl:col-span-3">
                            <div className="glass-card form-card border border-blue-500/10">
                                <div className="card-header border-b border-blue-500/10">
                                    <h3 className="text-blue-100">Form Edit Data Umum</h3>
                                </div>
                                
                                <div className="card-body">
                                    <form onSubmit={handleSubmit}>
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            {/* Data Masuk */}
                                            <div className="space-y-4">
                                                <h4 className="text-sm font-semibold text-blue-300 uppercase tracking-wider mb-2">Identitas Utama</h4>
                                                
                                                <div className="form-group">
                                                    <label className="form-label">No. MR <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        className={`form-control bg-white/5 ${errors.no_mr ? 'is-invalid' : ''}`}
                                                        value={data.no_mr}
                                                        onChange={e => setData('no_mr', e.target.value)}
                                                        readOnly
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Nama Pasien <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        className={`form-control ${errors.nama_pasien ? 'is-invalid' : ''}`}
                                                        value={data.nama_pasien}
                                                        onChange={e => setData('nama_pasien', e.target.value)}
                                                    />
                                                </div>
                                                
                                                <div className="form-group">
                                                    <label className="form-label">No KTP <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        className={`form-control ${errors.no_ktp ? 'is-invalid' : ''}`}
                                                        value={data.no_ktp}
                                                        onChange={e => setData('no_ktp', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Nama Ibu Kandung <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        className={`form-control ${errors.nama_ibu ? 'is-invalid' : ''}`}
                                                        value={data.nama_ibu}
                                                        onChange={e => setData('nama_ibu', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Nama Kepala Keluarga</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.nama_kel_pasien}
                                                        onChange={e => setData('nama_kel_pasien', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Tempat Lahir</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.tempat_lahir}
                                                        onChange={e => setData('tempat_lahir', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Tanggal Lahir <span className="text-red-400">*</span></label>
                                                    <div className="flex space-x-2">
                                                        <input type="text" className="form-control w-1/4" placeholder="DD" value={data.txt_tgl_lahir} onChange={e => setData('txt_tgl_lahir', e.target.value)} />
                                                        <input type="text" className="form-control w-1/4" placeholder="MM" value={data.txt_bln_lahir} onChange={e => setData('txt_bln_lahir', e.target.value)} />
                                                        <input type="text" className="form-control w-2/4" placeholder="YYYY" value={data.txt_thn_lahir} onChange={e => setData('txt_thn_lahir', e.target.value)} />
                                                    </div>
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Jenis Kelamin</label>
                                                    <select 
                                                        className="form-control"
                                                        value={data.jen_kelamin}
                                                        onChange={e => setData('jen_kelamin', e.target.value)}
                                                    >
                                                        <option value="L">Laki-laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {/* Data Alamat & Info */}
                                            <div className="space-y-4">
                                                <h4 className="text-sm font-semibold text-blue-300 uppercase tracking-wider mb-2">Kontak & Asuransi</h4>
                                                
                                                <div className="form-group">
                                                    <label className="form-label">Alamat Tetap</label>
                                                    <textarea 
                                                        className="form-control"
                                                        rows="3"
                                                        value={data.almt_ttp_pasien}
                                                        onChange={e => setData('almt_ttp_pasien', e.target.value)}
                                                    ></textarea>
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Telepon</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.tlp_almt_ttp}
                                                        onChange={e => setData('tlp_almt_ttp', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Nasabah / Penjamin <span className="text-red-400">*</span></label>
                                                    <select 
                                                        className="form-control"
                                                        value={data.kode_kelompok}
                                                        onChange={e => setData('kode_kelompok', e.target.value)}
                                                    >
                                                        <option value="">-- Pilih --</option>
                                                        <option value="1">UMUM</option>
                                                        <option value="3">ASURANSI</option>
                                                        <option value="5">PERUSAHAAN</option>
                                                        <option value="9">BPJS</option>
                                                    </select>
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">No Kartu / Surat Jaminan / NIK <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.txt_nik}
                                                        onChange={e => setData('txt_nik', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Jatah Kelas</label>
                                                    <select 
                                                        className="form-control"
                                                        value={data.jth_kelas}
                                                        onChange={e => setData('jth_kelas', e.target.value)}
                                                    >
                                                        <option value="">-- Pilih --</option>
                                                        <option value="1">Kelas I</option>
                                                        <option value="2">Kelas II</option>
                                                        <option value="3">Kelas III</option>
                                                        <option value="4">VIP</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div className="form-actions mt-8 pt-6 border-t border-blue-500/20 flex justify-end space-x-3">
                                            <button 
                                                type="submit" 
                                                className="btn bg-blue-600 hover:bg-blue-500 text-white border-none shadow-[0_0_15px_rgba(37,99,235,0.5)]"
                                                disabled={processing}
                                            >
                                                {processing ? 'Menyimpan...' : 'Update Data Umum'}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
}
