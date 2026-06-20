import React, { useState } from 'react';
import { router } from '@inertiajs/react';
import PasienDashboard from '../PasienDashboard';
import { Search, Plus, Trash2, Save, Stethoscope } from 'lucide-react';
import axios from 'axios';

export default function TindakanTab({ patient, tindakanList, tarifList, riwayat, paramedisList }) {
    const [selectedTarif, setSelectedTarif] = useState('');
    const [selectedParamedis, setSelectedParamedis] = useState('');
    const [jumlah, setJumlah] = useState(1);
    const [searchTerm, setSearchTerm] = useState('');

    const filteredTarif = tarifList.filter(t =>
        t.nama_tarif.toLowerCase().includes(searchTerm.toLowerCase())
    ).slice(0, 50); // limit to 50 for performance

    const handleAddTindakan = (e) => {
        e.preventDefault();
        if (!selectedTarif) return alert("Pilih tindakan/tarif terlebih dahulu");

        router.post(`/poli/pasien/${patient.kode_poli}/tindakan`, {
            kode_tarif: selectedTarif,
            kode_paramedis: selectedParamedis,
            jumlah: jumlah
        }, {
            preserveScroll: true,
            onSuccess: () => {
                setSelectedTarif('');
                setSelectedParamedis('');
                setJumlah(1);
                setSearchTerm('');
            },
            onError: (err) => {
                console.error(err);
                alert("Gagal menambahkan tindakan.");
            }
        });
    };

    const handleDeleteTindakan = (kode_trans) => {
        if (!confirm('Hapus tindakan ini?')) return;
        router.delete(`/poli/pasien/${patient.kode_poli}/tindakan/${kode_trans}`, {
            preserveScroll: true,
            onError: (err) => {
                console.error(err);
                alert("Gagal menghapus tindakan.");
            }
        });
    };

    const handleSelesai = () => {
        if (!confirm('Apakah pasien sudah selesai ditindak?')) return;
        router.post(`/poli/pasien/${patient.kode_poli}/selesai`, {}, {
            onError: (err) => {
                console.error(err);
                alert("Gagal memproses pasien selesai.");
            }
        });
    };

    const handleRujukRI = () => {
        if (!confirm('Apakah pasien akan dirujuk ke Rawat Inap?')) return;
        router.post(`/poli/pasien/${patient.kode_poli}/rujuk-ri`, {}, {
            onError: (err) => {
                console.error(err);
                alert("Gagal memproses rujuk pasien.");
            }
        });
    };

    return (
        <PasienDashboard patient={patient} activeTab="tindakan">

            {/* Wrapper for scrollable area */}
            <div style={{ flex: 1, minHeight: 0, overflowY: 'auto', display: 'flex', flexDirection: 'column', paddingRight: '5px' }}>
                {/* Riwayat / Diagnosa Panel */}
                <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px', flexShrink: 0 }}>
                    <h3 style={{ margin: '0 0 15px', color: '#1e293b', display: 'flex', alignItems: 'center', gap: '8px' }}>
                        <Stethoscope style={{ width: '20px', height: '20px', color: '#3b82f6' }} />
                        Diagnosa & Riwayat Pemeriksaan Terakhir
                    </h3>
                    <div className="grid-2-cols">
                        <div>
                            <strong style={{ color: '#475569', fontSize: '0.9rem' }}>Diagnosa Akhir:</strong>
                            <p style={{ margin: '5px 0 0', padding: '10px', backgroundColor: '#f8fafc', borderRadius: '6px', minHeight: '60px' }}>
                                {riwayat?.diagnosa_akhir || 'Belum ada diagnosa'}
                            </p>
                        </div>
                        <div>
                            <strong style={{ color: '#475569', fontSize: '0.9rem' }}>Pengobatan:</strong>
                            <p style={{ margin: '5px 0 0', padding: '10px', backgroundColor: '#f8fafc', borderRadius: '6px', minHeight: '60px' }}>
                                {riwayat?.pengobatan || 'Belum ada pengobatan'}
                            </p>
                        </div>
                    </div>
                </div>

                {/* Form Input Tindakan */}
                <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px', flexShrink: 0 }}>
                    <h3 style={{ margin: '0 0 15px', color: '#1e293b' }}>Tambah Tindakan Poli</h3>
                    <form onSubmit={handleAddTindakan} style={{ display: 'flex', gap: '15px', alignItems: 'flex-end', flexWrap: 'wrap' }}>

                        <div style={{ flex: 1, minWidth: '300px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Cari Tindakan / Tarif</label>
                            <input
                                type="text"
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                placeholder="Ketik nama tindakan..."
                                style={{ width: '100%', padding: '10px 12px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none', marginBottom: '10px' }}
                            />
                            <select
                                value={selectedTarif}
                                onChange={(e) => setSelectedTarif(e.target.value)}
                                style={{ width: '100%', padding: '10px 12px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                                required
                            >
                                <option value="">-- Pilih Tindakan --</option>
                                {filteredTarif.map((t, idx) => (
                                    <option key={idx} value={t.kode_tarif}>{t.nama_tarif} (Rp {new Intl.NumberFormat('id-ID').format(t.total || 0)})</option>
                                ))}
                            </select>
                        </div>

                        <div style={{ flex: 1, minWidth: '200px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Paramedis (Opsional)</label>
                            <select
                                value={selectedParamedis}
                                onChange={(e) => setSelectedParamedis(e.target.value)}
                                style={{ width: '100%', padding: '10px 12px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                            >
                                <option value="">-- Pilih --</option>
                                {paramedisList?.map((p, idx) => (
                                    <option key={idx} value={p.kode_paramedis}>{p.nama_pegawai}</option>
                                ))}
                            </select>
                        </div>

                        <div style={{ width: '100px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Jumlah</label>
                            <input
                                type="number"
                                min="1"
                                value={jumlah}
                                onChange={(e) => setJumlah(parseInt(e.target.value))}
                                style={{ width: '100%', padding: '10px 12px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                            />
                        </div>

                        <div style={{ paddingBottom: '2px' }}>
                            <button type="submit" className="dash-btn primary" style={{ padding: '10px 20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '8px', height: '42px' }}>
                                <Plus style={{ width: '18px', height: '18px' }} />
                                Tambah
                            </button>
                        </div>

                    </form>
                </div>

                {/* Tabel Daftar Tindakan */}
                <div className="glass-panel table-wrap" style={{ padding: '20px', flex: 1, minHeight: '300px', flexShrink: 0 }}>
                    <h3 style={{ margin: '0 0 15px', color: '#1e293b' }}>Daftar Tindakan Pasien</h3>
                    <div className="dash-table">
                        <table className="dash-table" style={{ width: '100%' }}>
                            <thead>
                                <tr>
                                    <th style={{ width: '50px', textAlign: 'center' }}>No</th>
                                    <th>Tindakan</th>
                                    <th style={{ textAlign: 'center' }}>Jml</th>
                                    <th style={{ textAlign: 'right' }}>Tarif ERP (Rp)</th>
                                    <th style={{ textAlign: 'right' }}>Tarif dr (Rp)</th>
                                    <th style={{ textAlign: 'right' }}>Total (Rp)</th>
                                    <th style={{ width: '80px', textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {tindakanList.length > 0 ? (
                                    tindakanList.map((item, index) => {
                                        const dr1 = parseFloat(item.bill_dr1 || 0);
                                        const dr2 = parseFloat(item.bill_dr2 || 0);
                                        const drTotal = dr1 + dr2;
                                        const rsTotal = parseFloat(item.bill_rs || 0);
                                        const subtotal = (rsTotal + drTotal) * parseFloat(item.jumlah || 1);

                                        return (
                                        <tr key={index}>
                                            <td style={{ textAlign: 'center' }}>{index + 1}.</td>
                                            <td>{item.nama_tindakan || item.jenis_tindakan}</td>
                                            <td style={{ textAlign: 'center' }}>{parseFloat(item.jumlah || 1)}</td>
                                            <td style={{ textAlign: 'right' }}>{new Intl.NumberFormat('id-ID').format(rsTotal)}</td>
                                            <td style={{ textAlign: 'right' }}>{new Intl.NumberFormat('id-ID').format(drTotal)}</td>
                                            <td style={{ textAlign: 'right' }}>{new Intl.NumberFormat('id-ID').format(subtotal)}</td>
                                            <td style={{ textAlign: 'center' }}>
                                                <button
                                                    className="dash-btn secondary"
                                                    style={{ padding: '4px 8px', color: '#ef4444' }}
                                                    title="Hapus Tindakan"
                                                    onClick={() => handleDeleteTindakan(item.kode_trans_pelayanan)}
                                                >
                                                    <Trash2 style={{ width: '14px', height: '14px' }} />
                                                </button>
                                            </td>
                                        </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="7" style={{ textAlign: 'center', padding: '30px', color: '#64748b' }}>
                                            Belum ada tindakan yang diinputkan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {/* Frozen Bottom Buttons */}
            <div className="glass-panel" style={{ padding: '15px 20px', display: 'flex', justifyContent: 'flex-end', gap: '15px', marginTop: '15px', flexShrink: 0 }}>
                <button className="dash-btn secondary" style={{ padding: '10px 20px', fontWeight: 'bold' }} onClick={handleRujukRI}>
                    Rujuk Rawat Inap
                </button>
                <button className="dash-btn primary" style={{ padding: '10px 20px', fontWeight: 'bold', backgroundColor: '#10b981' }} onClick={handleSelesai}>
                    Pasien Selesai
                </button>
            </div>

        </PasienDashboard>
    );
}
