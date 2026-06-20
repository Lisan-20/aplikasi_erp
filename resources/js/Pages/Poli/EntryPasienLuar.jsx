import React, { useState } from 'react';
import { Head, useForm, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function EntryPasienLuar({ auth, nasabah, asuransi, asuransiCob, pt, penunjang }) {
    const user = auth?.user || { username: 'Admin', role: 'Registrasi' };

    const { data, setData, post, processing, errors, reset } = useForm({
        nama_pasien: '',
        tgl_lahir: '',
        tempat_lahir: '',
        alamat_pasien: '',
        jen_kelamin: '',
        kode_kelompok: '',
        kode_perusahaan: '',
        kode_bagian: '',
        dokter_pengirim: ''
    });

    const { flash } = usePage().props;

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('poli.pasien-luar.store'), {
            onSuccess: () => reset(),
        });
    };

    // Derived states based on logic in ceknasabah()
    // 3: Asuransi, 4: Pribadi, 5: PT, 1: Umum, 11: Asuransi COB
    const showAsuransi = data.kode_kelompok === '3';
    const showAsuransiCob = data.kode_kelompok === '11';
    const showPT = data.kode_kelompok === '5';

    return (
        <DashboardLayout>
            <Head title="Pendaftaran Pasien Luar - Sistem ERP" />

            <div className="dashboard-container" style={{ padding: '20px' }}>
                <main className="dashboard-content" style={{ maxWidth: '900px', margin: '0 auto', width: '100%' }}>
                    
                    <div className="panel-card glass-card">
                        <div className="panel-header" style={{ marginBottom: '20px', borderBottom: '1px solid var(--border-color)', paddingBottom: '15px' }}>
                            <h3 style={{ fontSize: '1.5rem', fontWeight: 'bold' }}>Pendaftaran Pasien Luar</h3>
                            <p style={{ color: 'var(--text-muted)', fontSize: '0.9rem', marginTop: '5px' }}>Pendaftaran untuk pasien khusus Penunjang Medis (Lab/Rad) tanpa periksa dokter.</p>
                        </div>

                        {flash?.success && (
                            <div className="status-badge on-duty" style={{ display: 'block', padding: '15px', marginBottom: '20px', fontSize: '1rem', textAlign: 'center' }}>
                                {flash.success}
                            </div>
                        )}

                        {flash?.error && (
                            <div className="status-badge istirahat" style={{ display: 'block', padding: '15px', marginBottom: '20px', fontSize: '1rem', textAlign: 'center' }}>
                                {flash.error}
                            </div>
                        )}

                        <form onSubmit={handleSubmit} style={{ display: 'grid', gap: '20px' }}>
                            
                            <div className="form-group">
                                <label className="form-label">Nama Pasien <span style={{ color: 'red' }}>*</span></label>
                                <input 
                                    type="text" 
                                    className="premium-input" 
                                   
                                    value={data.nama_pasien} 
                                    onChange={e => setData('nama_pasien', e.target.value)} 
                                    placeholder="Nama Lengkap Pasien"
                                    required 
                                />
                                {errors.nama_pasien && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.nama_pasien}</span>}
                            </div>
                            
                            <div className="grid-2-cols">
                                <div className="form-group">
                                    <label className="form-label">Tempat Lahir</label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                       
                                        value={data.tempat_lahir} 
                                        onChange={e => setData('tempat_lahir', e.target.value)} 
                                        placeholder="Kota Kelahiran"
                                    />
                                </div>
                                
                                <div className="form-group">
                                    <label className="form-label">Tanggal Lahir <span style={{ color: 'red' }}>*</span></label>
                                    <input 
                                        type="date" 
                                        className="premium-input" 
                                       
                                        value={data.tgl_lahir} 
                                        onChange={e => setData('tgl_lahir', e.target.value)} 
                                        required 
                                    />
                                    {errors.tgl_lahir && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.tgl_lahir}</span>}
                                </div>
                            </div>

                            <div className="form-group">
                                <label className="form-label">Jenis Kelamin <span style={{ color: 'red' }}>*</span></label>
                                <select 
                                    className="premium-input" 
                                   
                                    value={data.jen_kelamin} 
                                    onChange={e => setData('jen_kelamin', e.target.value)} 
                                    required
                                >
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                {errors.jen_kelamin && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.jen_kelamin}</span>}
                            </div>

                            <div className="form-group">
                                <label className="form-label">Alamat Pasien</label>
                                <textarea 
                                    className="premium-input" 
                                   
                                    value={data.alamat_pasien} 
                                    onChange={e => setData('alamat_pasien', e.target.value)} 
                                    placeholder="Alamat lengkap"
                                ></textarea>
                            </div>

                            <div className="form-group">
                                <label className="form-label">Nasabah <span style={{ color: 'red' }}>*</span></label>
                                <select 
                                    className="premium-input" 
                                   
                                    value={data.kode_kelompok} 
                                    onChange={e => {
                                        setData('kode_kelompok', e.target.value);
                                        // Reset kode_perusahaan when nasabah changes
                                        setData('kode_perusahaan', '');
                                    }} 
                                    required
                                >
                                    <option value="">-- Pilih Nasabah --</option>
                                    {nasabah.map(n => (
                                        <option key={n.kode_kelompok} value={n.kode_kelompok}>{n.nama_kelompok}</option>
                                    ))}
                                </select>
                                {errors.kode_kelompok && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.kode_kelompok}</span>}
                            </div>

                            {showAsuransi && (
                                <div className="form-group">
                                    <label className="form-label">Asuransi <span style={{ color: 'red' }}>*</span></label>
                                    <select 
                                        className="premium-input" 
                                       
                                        value={data.kode_perusahaan} 
                                        onChange={e => setData('kode_perusahaan', e.target.value)} 
                                        required={showAsuransi}
                                    >
                                        <option value="">-- Pilih Asuransi --</option>
                                        {asuransi.map(n => (
                                            <option key={n.kode_perusahaan} value={n.kode_perusahaan}>{n.nama_perusahaan}</option>
                                        ))}
                                    </select>
                                </div>
                            )}

                            {showAsuransiCob && (
                                <div className="form-group">
                                    <label className="form-label">Asuransi COB <span style={{ color: 'red' }}>*</span></label>
                                    <select 
                                        className="premium-input" 
                                       
                                        value={data.kode_perusahaan} 
                                        onChange={e => setData('kode_perusahaan', e.target.value)} 
                                        required={showAsuransiCob}
                                    >
                                        <option value="">-- Pilih Asuransi COB --</option>
                                        {asuransiCob.map(n => (
                                            <option key={n.kode_perusahaan} value={n.kode_perusahaan}>{n.nama_perusahaan}</option>
                                        ))}
                                    </select>
                                </div>
                            )}

                            {showPT && (
                                <div className="form-group">
                                    <label className="form-label">PT <span style={{ color: 'red' }}>*</span></label>
                                    <select 
                                        className="premium-input" 
                                       
                                        value={data.kode_perusahaan} 
                                        onChange={e => setData('kode_perusahaan', e.target.value)} 
                                        required={showPT}
                                    >
                                        <option value="">-- Pilih PT --</option>
                                        {pt.map(n => (
                                            <option key={n.kode_perusahaan} value={n.kode_perusahaan}>{n.nama_perusahaan}</option>
                                        ))}
                                    </select>
                                </div>
                            )}

                            <div className="form-group">
                                <label className="form-label">Penunjang <span style={{ color: 'red' }}>*</span></label>
                                <select 
                                    className="premium-input" 
                                   
                                    value={data.kode_bagian} 
                                    onChange={e => setData('kode_bagian', e.target.value)} 
                                    required
                                >
                                    <option value="">-- Pilih Penunjang --</option>
                                    {penunjang.map(n => (
                                        <option key={n.kode_bagian} value={n.kode_bagian}>{n.nama_bagian}</option>
                                    ))}
                                </select>
                                {errors.kode_bagian && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.kode_bagian}</span>}
                            </div>

                            <div className="form-group">
                                <label className="form-label">Dokter Pengirim</label>
                                <input 
                                    type="text" 
                                    className="premium-input" 
                                   
                                    value={data.dokter_pengirim} 
                                    onChange={e => setData('dokter_pengirim', e.target.value)} 
                                />
                                {errors.dokter_pengirim && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.dokter_pengirim}</span>}
                            </div>

                            <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '15px', marginTop: '20px' }}>
                                <button 
                                    type="button" 
                                    onClick={() => reset()}
                                    className="dash-btn secondary"
                                    style={{ background: 'rgba(255,255,255,0.1)', border: '1px solid var(--border-color)' }}
                                >
                                    Reset Form
                                </button>
                                <button 
                                    type="submit" 
                                    className="dash-btn primary"
                                    disabled={processing}
                                >
                                    {processing ? 'Menyimpan...' : 'Simpan Pendaftaran'}
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </DashboardLayout>
    );
}
