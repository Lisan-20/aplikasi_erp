import React from 'react';
import { Head, useForm, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function PasienBaru() {
    // Inertia form
    const { data, setData, post, processing, errors, reset } = useForm({
        nama_pasien: '',
        no_ktp: '',
        tempat_lahir: '',
        tgl_lhr: '',
        jen_kelamin: '',
        kode_agama: '',
        tlp_almt_ttp: '',
        almt_ttp_pasien: '',
        nama_ibu: '',
        nama_ayah: '',
    });

    const { flash } = usePage().props;

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('registrasi.pasien-baru.store'), {
            onSuccess: () => reset(),
        });
    };

    return (
        <DashboardLayout>
            <Head title="Entry Pasien Baru - Medilink RS" />

            <div className="dashboard-container" style={{ padding: '20px' }}>
                <main className="dashboard-content" style={{ maxWidth: '900px', margin: '0 auto', width: '100%' }}>
                    
                    <div className="panel-card glass-card">
                        <div className="panel-header" style={{ marginBottom: '20px', borderBottom: '1px solid var(--border-color)', paddingBottom: '15px' }}>
                            <h3>Entry Pasien Baru</h3>
                            <p>Lengkapi formulir di bawah ini untuk mendaftarkan pasien baru ke sistem.</p>
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

                        <form onSubmit={handleSubmit} className="grid-form">
                            
                            {/* Baris 1: Nama & KTP */}
                            <div className="grid-2-cols">
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
                                
                                <div className="form-group">
                                    <label className="form-label">Nomor KTP / NIK</label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        value={data.no_ktp} 
                                        onChange={e => setData('no_ktp', e.target.value)} 
                                        placeholder="16 Digit NIK"
                                    />
                                    {errors.no_ktp && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.no_ktp}</span>}
                                </div>
                            </div>

                            {/* Baris 2: Tempat & Tanggal Lahir */}
                            <div className="grid-2-cols">
                                <div className="form-group">
                                    <label className="form-label">Tempat Lahir <span style={{ color: 'red' }}>*</span></label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        value={data.tempat_lahir} 
                                        onChange={e => setData('tempat_lahir', e.target.value)} 
                                        placeholder="Kota Kelahiran"
                                        required 
                                    />
                                    {errors.tempat_lahir && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.tempat_lahir}</span>}
                                </div>
                                
                                <div className="form-group">
                                    <label className="form-label">Tanggal Lahir <span style={{ color: 'red' }}>*</span></label>
                                    <input 
                                        type="date" 
                                        className="premium-input" 
                                        value={data.tgl_lhr} 
                                        onChange={e => setData('tgl_lhr', e.target.value)} 
                                        required 
                                    />
                                    {errors.tgl_lhr && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.tgl_lhr}</span>}
                                </div>
                            </div>

                            {/* Baris 3: Jenis Kelamin & Agama */}
                            <div className="grid-2-cols">
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
                                    <label className="form-label">Agama</label>
                                    <select 
                                        className="premium-input" 
                                        value={data.kode_agama} 
                                        onChange={e => setData('kode_agama', e.target.value)} 
                                    >
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="1">Islam</option>
                                        <option value="2">Protestan</option>
                                        <option value="3">Katolik</option>
                                        <option value="4">Hindu</option>
                                        <option value="5">Buddha</option>
                                        <option value="6">Konghucu</option>
                                    </select>
                                    {errors.kode_agama && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.kode_agama}</span>}
                                </div>
                            </div>

                            {/* Baris 4: Telepon */}
                            <div className="form-group">
                                <label className="form-label">Nomor Telepon / HP</label>
                                <input 
                                    type="text" 
                                    className="premium-input" 
                                    value={data.tlp_almt_ttp} 
                                    onChange={e => setData('tlp_almt_ttp', e.target.value)} 
                                    placeholder="Contoh: 081234567890"
                                />
                                {errors.tlp_almt_ttp && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.tlp_almt_ttp}</span>}
                            </div>

                            {/* Baris 5: Alamat Lengkap */}
                            <div className="form-group">
                                <label className="form-label">Alamat Tetap <span style={{ color: 'red' }}>*</span></label>
                                <textarea 
                                    className="premium-input" 
                                    value={data.almt_ttp_pasien} 
                                    onChange={e => setData('almt_ttp_pasien', e.target.value)} 
                                    placeholder="Alamat lengkap sesuai KTP"
                                    required 
                                ></textarea>
                                {errors.almt_ttp_pasien && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.almt_ttp_pasien}</span>}
                            </div>

                            {/* Baris 6: Nama Ibu & Ayah */}
                            <div className="grid-2-cols">
                                <div className="form-group">
                                    <label className="form-label">Nama Ibu Kandung</label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        value={data.nama_ibu} 
                                        onChange={e => setData('nama_ibu', e.target.value)} 
                                        placeholder="Nama Ibu Kandung"
                                    />
                                    {errors.nama_ibu && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.nama_ibu}</span>}
                                </div>
                                
                                <div className="form-group">
                                    <label className="form-label">Nama Ayah Kandung</label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        value={data.nama_ayah} 
                                        onChange={e => setData('nama_ayah', e.target.value)} 
                                        placeholder="Nama Ayah Kandung"
                                    />
                                    {errors.nama_ayah && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.nama_ayah}</span>}
                                </div>
                            </div>

                            <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '15px', marginTop: '20px' }}>
                                <button 
                                    type="button" 
                                    onClick={() => reset()}
                                    className="dash-btn danger"
                                >
                                    Reset Form
                                </button>
                                <button 
                                    type="submit" 
                                    className="dash-btn primary"
                                    disabled={processing}
                                >
                                    {processing ? 'Menyimpan...' : 'Simpan Data Pasien'}
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </DashboardLayout>
    );
}
