import React, { useState } from 'react';
import { Head, router, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, Save } from 'lucide-react';
import Swal from 'sweetalert2';

export default function AsesmenPNCForm({ pasien, psikososial, pnc, jatuh, gizi, asuhan, discharge, skalaNyeri }) {
    const initializeAnswers = () => {
        let initial = {};
        [...psikososial, ...pnc, ...jatuh, ...gizi, ...asuhan, ...discharge, ...skalaNyeri].forEach(q => {
            initial[q.kd_periksa] = {
                kd_periksa: q.kd_periksa,
                id_mt_kd: q.id_mt_kd,
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
    const [radiogroup, setRadiogroup] = useState('1'); 
    const filteredSkalaNyeri = skalaNyeri.filter(q => {
        const kd = parseInt(q.kd_periksa);
        if (radiogroup === '1') return kd >= 36000 && kd <= 36999; // Wong Baker Faces
        if (radiogroup === '2') return kd >= 38000 && kd <= 38999; // Numeric Rating Scale
        if (radiogroup === '3') return kd >= 13000 && kd <= 13999; // FLACC
        if (radiogroup === '4') return kd >= 14000 && kd <= 14999; // CPOT
        if (radiogroup === '5') return kd >= 12000 && kd <= 12999; // NIPS
        return false;
    });

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
        
        const answersArray = Object.values(answers).filter(ans => {
            const kd = parseInt(ans.kd_periksa);
            const isWongBaker = kd >= 36000 && kd <= 36999;
            const isNRS = kd >= 38000 && kd <= 38999;
            const isFLACC = kd >= 13000 && kd <= 13999;
            const isCPOT = kd >= 14000 && kd <= 14999;
            const isNIPS = kd >= 12000 && kd <= 12999;
            const isSkalaNyeri = isWongBaker || isNRS || isFLACC || isCPOT || isNIPS;

            if (isSkalaNyeri) {
                if (radiogroup === '1' && !isWongBaker) return false;
                if (radiogroup === '2' && !isNRS) return false;
                if (radiogroup === '3' && !isFLACC) return false;
                if (radiogroup === '4' && !isCPOT) return false;
                if (radiogroup === '5' && !isNIPS) return false;
            }
            return true;
        });

        router.post('/poli/asesmen/pnc/store', {
            no_kunjungan: pasien.no_kunjungan,
            no_registrasi: pasien.no_registrasi,
            no_mr: pasien.no_mr,
            kode_bagian: pasien.kode_bagian || '010101', 
            radiogroup: radiogroup,
            answers: answersArray
        }, {
            onSuccess: () => {
                setIsSubmitting(false);
                Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Asesmen PNC berhasil disimpan', confirmButtonColor: '#3b82f6' }).then(() => {
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
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Gagal menyimpan data asesmen!' });
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
            <Head title={`Asesmen PNC - ${pasien.nama_pasien}`} />
            <div className="pl-container" style={{ overflowY: 'auto', paddingBottom: '100px' }}>
                <div className="pl-header">
                    <div>
                        <h1 className="pl-title d-flex align-items-center">
                            <ArrowLeft className="mr-3 cursor-pointer" onClick={() => window.history.back()} />
                            Asesmen Awal Poli Kandungan (PNC)
                        </h1>
                        <p className="pl-subtitle">Pengkajian Awal Kandungan & Asuhan Keperawatan PNC</p>
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
                                <thead><tr><th style={{width: '50px', textAlign: 'center'}}>#</th><th style={{width: '40%', verticalAlign: 'middle'}}>Psikososial & Budaya</th><th>Hasil</th></tr></thead>
                                <tbody>{renderQuestionRows(psikososial, 0)}</tbody>
                            </table>
                        </div>
                    </div>

                    <div className="glass-panel mb-4">
                        <div className="dash-table">
                            <table className="dash-table">
                                <thead><tr><th style={{width: '50px', textAlign: 'center'}}>#</th><th style={{width: '40%', verticalAlign: 'middle'}}>Pengkajian PNC</th><th>Hasil</th></tr></thead>
                                <tbody>{renderQuestionRows(pnc, 0)}</tbody>
                            </table>
                        </div>
                    </div>

                    <div className="glass-panel mb-4" style={{ padding: '20px' }}>
                        <h5 className="mb-3" style={{ color: '#1e293b', fontWeight: 'bold', fontSize: '1rem' }}>Pilih Skala Nyeri Yang Digunakan</h5>
                        <div className="d-flex flex-wrap gap-4">
                            {[
                                {val:'1', label:'Wong Baker Faces'},
                                {val:'2', label:'Numeric Rating Scale'},
                                {val:'3', label:'FLACC'},
                                {val:'4', label:'CPOT'},
                                {val:'5', label:'NIPS'}
                            ].map(o => (
                                <label key={o.val} className="d-flex align-items-center gap-2 cursor-pointer">
                                    <input type="radio" name="radiogroup" value={o.val} checked={radiogroup === o.val} onChange={(e) => setRadiogroup(e.target.value)} />
                                    {o.label}
                                </label>
                            ))}
                        </div>

                        {/* Image Nyeri */}
                        {radiogroup && (
                            <div className="text-center my-4">
                                <img 
                                    src={radiogroup === '2' ? '/_images/icons_ten/skala_nyeri_2.jpg' : '/_images/icons_ten/skala_nyeri.jpg'} 
                                    alt="Skala Nyeri" 
                                    className="img-fluid rounded border" 
                                    style={{ maxHeight: '250px' }} 
                                />
                            </div>
                        )}

                        {filteredSkalaNyeri.length > 0 ? (
                            <div className="dash-table">
                                <table className="dash-table">
                                    <thead>
                                        <tr>
                                            <th style={{width: '50px', textAlign: 'center'}}>#</th>
                                            <th style={{width: '40%'}}>Parameter Nyeri</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {renderQuestionRows(filteredSkalaNyeri, 0)}
                                    </tbody>
                                </table>
                            </div>
                        ) : (
                            <div className="alert alert-warning mt-4 text-center border-warning bg-warning bg-opacity-10 text-warning">
                                <i className="fas fa-exclamation-circle me-2"></i> Form/parameter pertanyaan untuk Skala Nyeri ini belum tersedia di database.
                            </div>
                        )}
                    </div>

                    <div className="glass-panel mb-4">
                        <div className="dash-table">
                            <table className="dash-table">
                                <thead><tr><th style={{width: '50px', textAlign: 'center'}}>#</th><th style={{width: '40%', verticalAlign: 'middle'}}>Risiko Jatuh & Gizi</th><th>Hasil</th></tr></thead>
                                <tbody>
                                    {renderQuestionRows(jatuh, 0)}
                                    {renderQuestionRows(gizi, jatuh.filter(q => q.kd_type && q.kd_type != '0').length)}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div className="glass-panel mb-4">
                        <div className="dash-table">
                            <table className="dash-table">
                                <thead><tr><th style={{width: '50px', textAlign: 'center'}}>#</th><th style={{width: '40%', verticalAlign: 'middle'}}>Asuhan Keperawatan PNC</th><th>Hasil</th></tr></thead>
                                <tbody>{renderQuestionRows(asuhan, 0)}</tbody>
                            </table>
                        </div>
                    </div>

                    <div className="glass-panel mb-4">
                        <div className="dash-table">
                            <table className="dash-table">
                                <thead><tr><th style={{width: '50px', textAlign: 'center'}}>#</th><th style={{width: '40%', verticalAlign: 'middle'}}>Discharge Planning</th><th>Hasil</th></tr></thead>
                                <tbody>{renderQuestionRows(discharge, 0)}</tbody>
                            </table>
                        </div>
                    </div>

                    <div className="d-flex justify-content-end mb-5">
                        <button type="button" className="btn btn-secondary mr-2" style={{ borderRadius: '10px' }} onClick={() => window.history.back()} disabled={isSubmitting}>Batal</button>
                        <button type="submit" className="btn btn-primary d-flex align-items-center" style={{ borderRadius: '10px', padding: '10px 24px' }} disabled={isSubmitting}>
                            <Save className="mr-2" style={{ width: '18px', height: '18px' }} />
                            {isSubmitting ? 'Menyimpan...' : 'Simpan Asesmen PNC'}
                        </button>
                    </div>

                </form>

            </div>
        </DashboardLayout>
    );
}
