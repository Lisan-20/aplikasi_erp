import React, { useState } from 'react';
import { Head, router, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, Save } from 'lucide-react';
import Swal from 'sweetalert2';

export default function RiwayatHamilForm({ pasien, riwayat }) {
    const initializeAnswers = () => {
        let initial = {};
        riwayat.forEach(q => {
            initial[q.kd_periksa] = {
                kd_periksa: q.kd_periksa,
                nama_pemeriksaan: q.nama_pemeriksaan,
                kd_lev: q.kd_lev,
                kd_type: q.kd_type,
                ket: q.ket,
                answer: q.answer || '',
                answer2: q.answer2 || ''
            };
        });
        return initial;
    };

    const [answers, setAnswers] = useState(initializeAnswers());
    const [isSubmitting, setIsSubmitting] = useState(false);

    const handleAnswerChange = (kd_periksa, field, value) => {
        setAnswers(prev => ({
            ...prev,
            [kd_periksa]: {
                ...prev[kd_periksa],
                [field]: value
            }
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        
        const answersArray = Object.values(answers);

        router.post('/poli/asesmen/riwayat-hamil/store', {
            no_kunjungan: pasien.no_kunjungan,
            no_registrasi: pasien.no_registrasi,
            no_mr: pasien.no_mr,
            kode_bagian: pasien.kode_bagian || '010101', 
            answers: answersArray
        }, {
            onSuccess: () => {
                setIsSubmitting(false);
                Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Riwayat Kehamilan berhasil disimpan', confirmButtonColor: '#3b82f6' }).then(() => {
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
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Gagal menyimpan data riwayat!' });
            }
        });
    };

    const renderField = (q) => {
        const value = answers[q.kd_periksa]?.answer || '';
        const value2 = answers[q.kd_periksa]?.answer2 || '';

        if (q.kd_type == '1') {
            return (
                <textarea className="premium-input" rows="2" value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} />
            );
        }
        
        if (q.kd_type == '2') {
            return (
                <div className="d-flex gap-2 align-items-center flex-wrap">
                    {q.kd_kk == '1' ? (
                        <>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kanan</span>
                                <select className="premium-input" value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} style={{maxWidth: '200px'}}>
                                    <option value="">-- Pilih --</option>
                                    {q.options?.map((opt, idx) => (
                                        <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                                    ))}
                                </select>
                            </div>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kiri</span>
                                <select className="premium-input" value={value2} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer2', e.target.value)} style={{maxWidth: '200px'}}>
                                    <option value="">-- Pilih --</option>
                                    {q.options?.map((opt, idx) => (
                                        <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                                    ))}
                                </select>
                            </div>
                        </>
                    ) : (
                        <select className="premium-input" value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} style={{maxWidth: '300px'}}>
                            <option value="">-- Pilih --</option>
                            {q.options?.map((opt, idx) => (
                                <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                            ))}
                        </select>
                    )}
                </div>
            );
        }

        if (q.kd_type == '3' || q.kd_type == '4') {
            return (
                <div className="d-flex gap-2 align-items-center flex-wrap">
                    {q.kd_kk == '1' ? (
                        <>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kanan</span>
                                <input type="text" className="premium-input" style={{width: '150px'}} value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} />
                                {q.ket && <span className="input-group-text">{q.ket}</span>}
                            </div>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kiri</span>
                                <input type="text" className="premium-input" style={{width: '150px'}} value={value2} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer2', e.target.value)} />
                                {q.ket && <span className="input-group-text">{q.ket}</span>}
                            </div>
                        </>
                    ) : (
                        <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                            <input type="text" className="premium-input" style={{width: '250px'}} value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} />
                            {q.ket && <span className="input-group-text">{q.ket}</span>}
                        </div>
                    )}
                </div>
            );
        }

        if (q.kd_type == '5') {
            return (
                <div className="input-group input-group-sm" style={{width: 'max-content', flexWrap: 'nowrap'}}>
                    <select className="premium-input" style={{maxWidth: '200px'}} value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)}>
                        <option value="">-- Pilih --</option>
                        {q.options?.map((opt, idx) => (
                            <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                        ))}
                    </select>
                    <input type="text" className="premium-input" style={{width: '150px'}} value={value2} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer2', e.target.value)} />
                    {q.ket && <span className="input-group-text">{q.ket}</span>}
                </div>
            );
        }

        return null;
    };

    const renderQuestionRows = (questions, startIndex = 0) => {
        let currentIdx = startIndex;
        return questions.map((q) => {
            const paddingLeft = (q.kd_lev == '2' || q.kd_lev == '3') ? ((q.kd_lev - 1) * 20) + 'px' : '0px';
            const isHeader = !q.kd_type || q.kd_type == '0' || q.kd_type == '';
            if (!isHeader) currentIdx++;

            return (
                <tr key={q.kd_periksa}>
                    <td style={{width: '50px', textAlign: 'center', color: '#64748b', verticalAlign: 'middle'}}>{!isHeader ? `${currentIdx}.` : ''}</td>
                    <td style={{ paddingLeft: paddingLeft, fontWeight: isHeader ? 'bold' : 'normal', color: isHeader ? '#1e293b' : '#334155', width: '40%', verticalAlign: 'middle' }}>
                        {q.nama_pemeriksaan}
                    </td>
                    <td style={{ verticalAlign: 'middle' }}>
                        {!isHeader && renderField(q)}
                    </td>
                </tr>
            );
        });
    };

    return (
        <DashboardLayout>
            <Head title={`Riwayat Kehamilan - ${pasien.nama_pasien}`} />
            <div className="pl-container" style={{ overflowY: 'auto', paddingBottom: '100px' }}>
                <div className="pl-header">
                    <div>
                        <h1 className="pl-title d-flex align-items-center">
                            <ArrowLeft className="mr-3 cursor-pointer" onClick={() => window.history.back()} />
                            Riwayat Kehamilan Pasien
                        </h1>
                        <p className="pl-subtitle">Riwayat Kehamilan, Persalinan, dan Nifas</p>
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
                    <div className="glass-panel mb-4">
                        <div className="dash-table">
                            <table className="dash-table">
                                <thead><tr><th style={{width: '50px', textAlign: 'center'}}>#</th><th style={{width: '40%', verticalAlign: 'middle'}}>Pemeriksaan</th><th>Hasil</th></tr></thead>
                                <tbody>{renderQuestionRows(riwayat, 0)}</tbody>
                            </table>
                        </div>
                    </div>

                    <div className="d-flex justify-content-end mb-5">
                        <button type="button" className="btn btn-secondary mr-2" style={{ borderRadius: '10px' }} onClick={() => window.history.back()} disabled={isSubmitting}>Batal</button>
                        <button type="submit" className="btn btn-primary d-flex align-items-center" style={{ borderRadius: '10px', padding: '10px 24px' }} disabled={isSubmitting}>
                            <Save className="mr-2" style={{ width: '18px', height: '18px' }} />
                            {isSubmitting ? 'Menyimpan...' : 'Simpan Riwayat'}
                        </button>
                    </div>
                </form>
            </div>
        </DashboardLayout>
    );
}
