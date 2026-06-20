import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, Save, Upload, FileText } from 'lucide-react';
import Swal from 'sweetalert2';

export default function PemLuarForm({ pasien, existing }) {
    const [kesimpulan, setKesimpulan] = useState(existing?.kesimpulan || '');
    const [foto, setFoto] = useState(null);
    const [previewUrl, setPreviewUrl] = useState(existing?.nama_file ? `/storage/hasil_luar/${existing.nama_file}` : null);
    const [isSubmitting, setIsSubmitting] = useState(false);

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setFoto(file);
            setPreviewUrl(URL.createObjectURL(file));
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        
        const formData = new FormData();
        formData.append('no_kunjungan', pasien.no_kunjungan);
        formData.append('no_registrasi', pasien.no_registrasi);
        formData.append('no_mr', pasien.no_mr);
        formData.append('kesimpulan', kesimpulan);
        if (foto) {
            formData.append('foto', foto);
        }

        router.post('/poli/asesmen/pem-luar/store', formData, {
            forceFormData: true,
            onSuccess: () => {
                setIsSubmitting(false);
                Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Pemeriksaan Luar berhasil disimpan', confirmButtonColor: '#3b82f6' }).then(() => {
                    if (typeof window !== 'undefined' && window.location.search.includes('popup=1')) {
                        if (window.opener) {
                            window.opener.location.reload();
                        }
                        window.close();
                    }
                });
            },
            onError: () => {
                setIsSubmitting(false);
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Gagal menyimpan data!' });
            }
        });
    };

    return (
        <DashboardLayout>
            <Head title={`Pemeriksaan Luar - ${pasien.nama_pasien}`} />
            <div className="pl-container" style={{ overflowY: 'auto', paddingBottom: '100px' }}>
                <div className="pl-header">
                    <div>
                        <h1 className="pl-title d-flex align-items-center">
                            <ArrowLeft className="mr-3 cursor-pointer" onClick={() => window.history.back()} />
                            Hasil Pemeriksaan Luar
                        </h1>
                        <p className="pl-subtitle">Unggah Berkas Pemeriksaan Luar Pasien</p>
                    </div>
                </div>

                <div className="glass-panel mb-4" style={{ padding: '20px' }}>
                    <div className="row">
                        <div className="col-md-6">
                            <table className="dash-table">
                                <tbody>
                                    <tr><td style={{width: '120px', color: '#64748b'}}>Nama Pasien</td><td style={{fontWeight: 'bold'}}>: {pasien.nama_pasien}</td></tr>
                                    <tr><td style={{color: '#64748b'}}>No. MR</td><td style={{fontWeight: 'bold'}}>: {pasien.no_mr}</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="col-md-6">
                            <table className="dash-table">
                                <tbody>
                                    <tr><td style={{width: '120px', color: '#64748b'}}>Umur / Sex</td><td style={{fontWeight: 'bold'}}>: {pasien.umur} Th / {pasien.jen_kelamin}</td></tr>
                                    <tr><td style={{color: '#64748b'}}>Nasabah</td><td style={{fontWeight: 'bold'}}>: {pasien.nm_nasabah || 'UMUM'}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <form onSubmit={handleSubmit}>
                    <div className="glass-panel mb-4" style={{ padding: '20px' }}>
                        
                        <div className="form-group mb-4">
                            <label className="font-weight-bold mb-2">Unggah Foto Hasil</label>
                            <div className="d-flex flex-column gap-3">
                                <input type="file" className="premium-input" accept="image/*" onChange={handleFileChange} />
                                
                                {previewUrl ? (
                                    <div style={{ maxWidth: '300px', border: '1px solid #e2e8f0', borderRadius: '8px', padding: '5px' }}>
                                        <img src={previewUrl} alt="Preview Hasil Luar" style={{ width: '100%', borderRadius: '4px' }} />
                                    </div>
                                ) : (
                                    <div style={{ maxWidth: '300px', height: '150px', border: '2px dashed #cbd5e1', borderRadius: '8px', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#94a3b8', flexDirection: 'column' }}>
                                        <FileText size={32} className="mb-2" />
                                        <span>Belum ada foto</span>
                                    </div>
                                )}
                            </div>
                        </div>

                        <div className="form-group mb-4">
                            <label className="font-weight-bold mb-2">Catatan / Kesimpulan</label>
                            <textarea 
                                className="premium-input" 
                                rows="4" 
                                value={kesimpulan} 
                                onChange={(e) => setKesimpulan(e.target.value)}
                                placeholder="Masukkan kesimpulan dari hasil pemeriksaan luar..."
                            />
                        </div>

                    </div>

                    <div className="d-flex justify-content-end mb-5">
                        <button type="button" className="btn btn-secondary mr-2" style={{ borderRadius: '10px' }} onClick={() => window.history.back()} disabled={isSubmitting}>Batal</button>
                        <button type="submit" className="btn btn-primary d-flex align-items-center" style={{ borderRadius: '10px', padding: '10px 24px' }} disabled={isSubmitting}>
                            <Upload className="mr-2" style={{ width: '18px', height: '18px' }} />
                            {isSubmitting ? 'Menyimpan...' : 'Simpan Pemeriksaan Luar'}
                        </button>
                    </div>
                </form>
            </div>
        </DashboardLayout>
    );
}
