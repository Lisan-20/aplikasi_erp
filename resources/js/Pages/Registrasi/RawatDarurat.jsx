import React from 'react';
import { Head, useForm, usePage } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function RawatDarurat({ patient, dokter }) {
    // Inertia form
    const { data, setData, post, processing, errors, reset } = useForm({
        no_mr: patient?.no_mr || '',
        kode_dokter: '',
        tgl_masuk: new Date().toISOString().slice(0, 16),
        stat_pasien: patient ? 'Lama' : 'Baru',
        prioritas: 'Cito',
        no_jaminan: '',
        keterangan: '',
        jns_celaka: '',
        tgl_kecelakaan: '',
        tmpt_kecelakaan: '',
        dibawa_oleh: '',
        dibawa_dgn: '',
        dikirim_oleh: '',
        kasus_polisi: '',
        nama_org_dekat: '',
        telp_org_dekat: '',
        alamat_org_dekat: '',
        status_diterima: ''
    });

    const { flash } = usePage().props;

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/registrasi/igd/form/${data.no_mr}`, {
            onSuccess: () => {
                reset('kode_dokter', 'keterangan', 'jns_celaka', 'tgl_kecelakaan', 'tmpt_kecelakaan', 'dibawa_oleh', 'dibawa_dgn', 'dikirim_oleh', 'kasus_polisi', 'nama_org_dekat', 'telp_org_dekat', 'alamat_org_dekat', 'status_diterima');
            },
        });
    };

    return (
        <DashboardLayout>
            <Head title="Pendaftaran IGD - Medilink RS" />
            
            <div className="p-4">
                <div className="content-container">
                    <div className="content-header">
                        <div>
                            <h1 className="content-title text-red-50">Pendaftaran Gawat Darurat (IGD)</h1>
                            <p className="content-subtitle text-red-200/60">Registrasi pasien prioritas tinggi dan kecelakaan</p>
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
                    
                    {flash?.error && (
                        <div className="alert-error glass-card mb-6 p-4 border-l-4 border-red-500">
                            <div className="flex items-center">
                                <svg className="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                <span>{flash.error}</span>
                            </div>
                        </div>
                    )}

                    <div className="max-w-6xl mx-auto space-y-6">
                        {patient && (
                            <div className="glass-card p-5 bg-white/5 border border-red-500/20 rounded-xl">
                                <h3 className="text-lg font-bold text-red-100 mb-4 border-b border-red-500/10 pb-2 flex justify-between items-center">
                                    <span>Data Pasien</span>
                                    <span className="text-red-300 font-mono bg-red-500/10 px-3 py-1 rounded-full text-sm">{patient.no_mr}</span>
                                </h3>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div className="flex justify-between md:justify-start md:gap-4">
                                        <span className="text-white/60 w-24">Nama</span>
                                        <span className="text-white font-medium">{patient.nama_pasien}</span>
                                    </div>
                                    <div className="flex justify-between md:justify-start md:gap-4">
                                        <span className="text-white/60 w-24">Tgl. Lahir</span>
                                        <span className="text-white font-medium">{patient.tgl_lhr?.split(' ')[0]}</span>
                                    </div>
                                    <div className="flex justify-between md:justify-start md:gap-4">
                                        <span className="text-white/60 w-24">JK</span>
                                        <span className="text-white font-medium">{patient.jen_kelamin == 1 ? 'Laki-laki' : 'Perempuan'}</span>
                                    </div>
                                    <div className="flex justify-between md:justify-start md:gap-4">
                                        <span className="text-white/60 w-24">Alamat</span>
                                        <span className="text-white font-medium">{patient.almt_ttp_pasien}</span>
                                    </div>
                                </div>
                            </div>
                        )}

                        {/* Pendaftaran Form */}
                            <div className="glass-card form-card border border-red-500/10">
                                <div className="card-header border-b border-red-500/10">
                                    <h3 className="text-red-100">Form Pendaftaran IGD</h3>
                                </div>
                                
                                <div className="card-body">
                                    <form onSubmit={handleSubmit}>
                                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            {/* Data Masuk */}
                                            <div className="space-y-4">
                                                <h4 className="text-sm font-semibold text-red-300 uppercase tracking-wider mb-2">Data Kunjungan</h4>
                                                
                                                <div className="form-group">
                                                    <label className="form-label">No. MR <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        className={`form-control ${errors.no_mr ? 'is-invalid' : ''}`}
                                                        value={data.no_mr}
                                                        onChange={e => setData('no_mr', e.target.value)}
                                                        readOnly
                                                        placeholder="Pilih pasien terlebih dahulu"
                                                    />
                                                    {errors.no_mr && <div className="invalid-feedback">{errors.no_mr}</div>}
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Dokter Jaga <span className="text-red-400">*</span></label>
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
                                                    <label className="form-label">Tanggal & Jam Masuk <span className="text-red-400">*</span></label>
                                                    <input 
                                                        type="datetime-local" 
                                                        className={`form-control ${errors.tgl_masuk ? 'is-invalid' : ''}`}
                                                        value={data.tgl_masuk}
                                                        onChange={e => setData('tgl_masuk', e.target.value)}
                                                    />
                                                    {errors.tgl_masuk && <div className="invalid-feedback">{errors.tgl_masuk}</div>}
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Status Pasien</label>
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
                                                    <label className="form-label">Prioritas</label>
                                                    <select 
                                                        className="form-control"
                                                        value={data.prioritas}
                                                        onChange={e => setData('prioritas', e.target.value)}
                                                    >
                                                        <option value="Cito">Cito (Darurat)</option>
                                                        <option value="Biasa">Biasa</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {/* Data Pengantar */}
                                            <div className="space-y-4">
                                                <h4 className="text-sm font-semibold text-red-300 uppercase tracking-wider mb-2">Informasi Pengantar</h4>
                                                
                                                <div className="form-group">
                                                    <label className="form-label">Dibawa Oleh</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.dibawa_oleh}
                                                        onChange={e => setData('dibawa_oleh', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Dibawa Dengan (Kendaraan)</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.dibawa_dgn}
                                                        onChange={e => setData('dibawa_dgn', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Nama Orang Dekat / Keluarga</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.nama_org_dekat}
                                                        onChange={e => setData('nama_org_dekat', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Telp. Orang Dekat</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.telp_org_dekat}
                                                        onChange={e => setData('telp_org_dekat', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Alamat Orang Dekat</label>
                                                    <textarea 
                                                        className="form-control"
                                                        rows="2"
                                                        value={data.alamat_org_dekat}
                                                        onChange={e => setData('alamat_org_dekat', e.target.value)}
                                                    ></textarea>
                                                </div>
                                            </div>

                                            {/* Data Kecelakaan */}
                                            <div className="space-y-4">
                                                <h4 className="text-sm font-semibold text-red-300 uppercase tracking-wider mb-2">Data Kecelakaan (Jika Ada)</h4>
                                                
                                                <div className="form-group">
                                                    <label className="form-label">Jenis Kecelakaan</label>
                                                    <select 
                                                        className="form-control"
                                                        value={data.jns_celaka}
                                                        onChange={e => setData('jns_celaka', e.target.value)}
                                                    >
                                                        <option value="">-- Bukan Kecelakaan --</option>
                                                        <option value="Lalu Lintas">Lalu Lintas</option>
                                                        <option value="Kerja">Kecelakaan Kerja</option>
                                                        <option value="Rumah Tangga">Rumah Tangga</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Kasus Polisi</label>
                                                    <select 
                                                        className="form-control"
                                                        value={data.kasus_polisi}
                                                        onChange={e => setData('kasus_polisi', e.target.value)}
                                                    >
                                                        <option value="0">Tidak</option>
                                                        <option value="1">Ya</option>
                                                    </select>
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Tanggal Kecelakaan</label>
                                                    <input 
                                                        type="date" 
                                                        className="form-control"
                                                        value={data.tgl_kecelakaan}
                                                        onChange={e => setData('tgl_kecelakaan', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Tempat Kecelakaan</label>
                                                    <input 
                                                        type="text" 
                                                        className="form-control"
                                                        value={data.tmpt_kecelakaan}
                                                        onChange={e => setData('tmpt_kecelakaan', e.target.value)}
                                                    />
                                                </div>

                                                <div className="form-group">
                                                    <label className="form-label">Keluhan / Keterangan</label>
                                                    <textarea 
                                                        className="form-control"
                                                        rows="2"
                                                        value={data.keterangan}
                                                        onChange={e => setData('keterangan', e.target.value)}
                                                    ></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="form-actions mt-8 pt-6 border-t border-red-500/20 flex justify-end space-x-3">
                                            <button 
                                                type="button" 
                                                className="btn bg-white/5 hover:bg-white/10 text-white border-white/10"
                                                onClick={() => reset()}
                                            >
                                                Reset
                                            </button>
                                            <button 
                                                type="submit" 
                                                className="btn bg-red-600 hover:bg-red-500 text-white border-none shadow-[0_0_15px_rgba(220,38,38,0.5)]"
                                                disabled={processing || !data.no_mr}
                                            >
                                                {processing ? (
                                                    <span className="flex items-center">
                                                        <svg className="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        Menyimpan...
                                                    </span>
                                                ) : 'Daftarkan Pasien IGD'}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
