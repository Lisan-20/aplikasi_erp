import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head } from '@inertiajs/react';
import { Activity, XCircle, Send, Printer } from 'lucide-react';

export default function Kinerja({ karyawan, shift, asal_pasien }) {
    const [activeTab, setActiveTab] = useState('registrasi');

    // State for Tab 1
    const [regTglAwal, setRegTglAwal] = useState(new Date().toISOString().split('T')[0]);
    const [regTglAkhir, setRegTglAkhir] = useState(new Date().toISOString().split('T')[0]);
    const [regInstalasi, setRegInstalasi] = useState('');
    const [regPetugas, setRegPetugas] = useState('');
    const [regShift, setRegShift] = useState('');

    // State for Tab 2
    const [batKategori, setBatKategori] = useState('1');
    const [batFrekuensi, setBatFrekuensi] = useState('1');
    const [batTanggal, setBatTanggal] = useState(new Date().toISOString().split('T')[0]);

    // State for Tab 3
    const [rujAsal, setRujAsal] = useState('');
    const [rujTglAwal, setRujTglAwal] = useState(new Date().toISOString().split('T')[0]);
    const [rujTglAkhir, setRujTglAkhir] = useState(new Date().toISOString().split('T')[0]);

    const handleCetakRegistrasi = (e) => {
        e.preventDefault();
        const params = new URLSearchParams({
            tgl_awal: regTglAwal,
            tgl_akhir: regTglAkhir,
            instalasinya: regInstalasi,
            no_induk: regPetugas,
            kode_shift: regShift
        });
        window.open(`/laporan/kinerja/cetak-registrasi?${params.toString()}`, '_blank');
    };

    const handleCetakBatal = (e) => {
        e.preventDefault();
        const params = new URLSearchParams({
            kategori: batKategori,
            frekuensi: batFrekuensi,
            tanggal: batTanggal
        });
        window.open(`/laporan/kinerja/cetak-batal?${params.toString()}`, '_blank');
    };

    const handleCetakRujukan = (e) => {
        e.preventDefault();
        const params = new URLSearchParams({
            id_dc_asal_pasien: rujAsal,
            tgl_awal: rujTglAwal,
            tgl_akhir: rujTglAkhir
        });
        window.open(`/laporan/kinerja/cetak-rujukan?${params.toString()}`, '_blank');
    };

    return (
        <DashboardLayout>
            <Head title="Laporan Kinerja" />

            <div className="pl-container" style={{ display: 'flex', flexDirection: 'column', height: '100%', gap: '16px' }}>
                {/* Header Panel */}
                <div className="glass-panel" style={{ padding: '16px', display: 'flex', alignItems: 'center', gap: '12px' }}>
                    <div style={{
                        width: '40px', height: '40px', borderRadius: '10px',
                        background: 'linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.05) 100%)',
                        display: 'flex', alignItems: 'center', justifyContent: 'center',
                        border: '1px solid rgba(56,189,248,0.2)'
                    }}>
                        <Activity style={{ width: '20px', height: '20px', color: '#0ea5e9' }} />
                    </div>
                    <div>
                        <h1 style={{ margin: 0, fontSize: '1.25rem', fontWeight: 600, color: '#f8fafc' }}>
                            Laporan Kinerja
                        </h1>
                        <p style={{ margin: 0, fontSize: '0.875rem', color: '#94a3b8' }}>
                            Pilih dan cetak laporan kinerja, pasien batal, atau rujukan
                        </p>
                    </div>
                </div>

                {/* Main Content Area */}
                <div style={{ display: 'flex', gap: '16px', flex: 1, minHeight: 0 }}>
                    {/* Sidebar Tabs */}
                    <div className="glass-panel" style={{ width: '280px', padding: '12px', display: 'flex', flexDirection: 'column', gap: '8px' }}>
                        <button
                            onClick={() => setActiveTab('registrasi')}
                            style={{
                                display: 'flex', alignItems: 'center', gap: '12px', width: '100%', padding: '12px 16px',
                                borderRadius: '8px', border: 'none', cursor: 'pointer', textAlign: 'left',
                                backgroundColor: activeTab === 'registrasi' ? 'rgba(14,165,233,0.1)' : 'transparent',
                                borderLeft: activeTab === 'registrasi' ? '3px solid #0ea5e9' : '3px solid transparent',
                                color: activeTab === 'registrasi' ? '#0ea5e9' : '#cbd5e1',
                                fontWeight: activeTab === 'registrasi' ? 600 : 400,
                                transition: 'all 0.2s'
                            }}
                        >
                            <Activity style={{ width: '18px', height: '18px' }} />
                            Kinerja Registrasi
                        </button>
                        <button
                            onClick={() => setActiveTab('batal')}
                            style={{
                                display: 'flex', alignItems: 'center', gap: '12px', width: '100%', padding: '12px 16px',
                                borderRadius: '8px', border: 'none', cursor: 'pointer', textAlign: 'left',
                                backgroundColor: activeTab === 'batal' ? 'rgba(239,68,68,0.1)' : 'transparent',
                                borderLeft: activeTab === 'batal' ? '3px solid #ef4444' : '3px solid transparent',
                                color: activeTab === 'batal' ? '#ef4444' : '#cbd5e1',
                                fontWeight: activeTab === 'batal' ? 600 : 400,
                                transition: 'all 0.2s'
                            }}
                        >
                            <XCircle style={{ width: '18px', height: '18px' }} />
                            Pasien Batal
                        </button>
                        <button
                            onClick={() => setActiveTab('rujukan')}
                            style={{
                                display: 'flex', alignItems: 'center', gap: '12px', width: '100%', padding: '12px 16px',
                                borderRadius: '8px', border: 'none', cursor: 'pointer', textAlign: 'left',
                                backgroundColor: activeTab === 'rujukan' ? 'rgba(16,185,129,0.1)' : 'transparent',
                                borderLeft: activeTab === 'rujukan' ? '3px solid #10b981' : '3px solid transparent',
                                color: activeTab === 'rujukan' ? '#10b981' : '#cbd5e1',
                                fontWeight: activeTab === 'rujukan' ? 600 : 400,
                                transition: 'all 0.2s'
                            }}
                        >
                            <Send style={{ width: '18px', height: '18px' }} />
                            Rujukan Pasien
                        </button>
                    </div>

                    {/* Form Container with scrollable content and frozen bottom */}
                    <div className="glass-panel" style={{ flex: 1, display: 'flex', flexDirection: 'column', minHeight: 0 }}>
                        {activeTab === 'registrasi' && (
                            <form onSubmit={handleCetakRegistrasi} style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
                                {/* Scrollable area */}
                                <div style={{ padding: '24px', flexGrow: 1, overflowY: 'auto' }}>
                                    <h2 style={{ fontSize: '1.1rem', color: '#f8fafc', marginBottom: '20px', paddingBottom: '10px', borderBottom: '1px solid rgba(255,255,255,0.1)' }}>
                                        Laporan Harian Kinerja Petugas Registrasi
                                    </h2>
                                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px' }}>
                                        <div className="form-group">
                                            <label className="form-label">Dari Tanggal</label>
                                            <input type="date" className="form-input" required value={regTglAwal} onChange={e => setRegTglAwal(e.target.value)} />
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Sampai Tanggal</label>
                                            <input type="date" className="form-input" required value={regTglAkhir} onChange={e => setRegTglAkhir(e.target.value)} />
                                        </div>
                                        <div className="form-group" style={{ gridColumn: '1 / -1' }}>
                                            <label className="form-label">Instalasi</label>
                                            <select className="form-input" value={regInstalasi} onChange={e => setRegInstalasi(e.target.value)}>
                                                <option value="">--- Pilih Instalasi ---</option>
                                                <option value="010001">Rawat Jalan</option>
                                                <option value="030001">Rawat Inap</option>
                                                <option value="050001">Penunjang Medis</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Nama Petugas</label>
                                            <select className="form-input" value={regPetugas} onChange={e => setRegPetugas(e.target.value)}>
                                                <option value="">--- Semua Petugas ---</option>
                                                {karyawan.map(k => (
                                                    <option key={k.no_induk} value={k.no_induk}>{k.nama_pegawai}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Shift</label>
                                            <select className="form-input" value={regShift} onChange={e => setRegShift(e.target.value)}>
                                                <option value="">--- Semua Shift ---</option>
                                                {shift.map(s => (
                                                    <option key={s.kode_shift} value={s.kode_shift}>{s.nama_shift}</option>
                                                ))}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {/* Frozen footer */}
                                <div style={{ padding: '16px 24px', borderTop: '1px solid rgba(255,255,255,0.1)', background: 'rgba(15,23,42,0.6)', display: 'flex', justifyContent: 'flex-end' }}>
                                    <button type="submit" className="btn-primary" style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                        <Printer style={{ width: '18px', height: '18px' }} />
                                        Cetak Laporan
                                    </button>
                                </div>
                            </form>
                        )}

                        {activeTab === 'batal' && (
                            <form onSubmit={handleCetakBatal} style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
                                {/* Scrollable area */}
                                <div style={{ padding: '24px', flexGrow: 1, overflowY: 'auto' }}>
                                    <h2 style={{ fontSize: '1.1rem', color: '#f8fafc', marginBottom: '20px', paddingBottom: '10px', borderBottom: '1px solid rgba(255,255,255,0.1)' }}>
                                        Laporan Kunjungan Pasien Batal
                                    </h2>
                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                                        <div className="form-group">
                                            <label className="form-label">Kategori</label>
                                            <select className="form-input" value={batKategori} onChange={e => setBatKategori(e.target.value)}>
                                                <option value="1">Semua</option>
                                                <option value="2">Rawat Jalan</option>
                                                <option value="3">Perawatan Lt 2</option>
                                                <option value="4">Perawatan Lt 3</option>
                                                <option value="5">PERINA</option>
                                                <option value="6">ICU</option>
                                                <option value="7">Nifas</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Frekuensi</label>
                                            <select className="form-input" value={batFrekuensi} onChange={e => setBatFrekuensi(e.target.value)}>
                                                <option value="1">Harian</option>
                                                <option value="2">Bulanan</option>
                                                <option value="3">Tahunan</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Pilih Tanggal Acuan (Sesuai Frekuensi)</label>
                                            <input type="date" className="form-input" required value={batTanggal} onChange={e => setBatTanggal(e.target.value)} />
                                            <small style={{ color: '#94a3b8', marginTop: '6px', display: 'block' }}>
                                                Jika bulanan, akan mengambil 1 bulan penuh di bulan tersebut. Jika tahunan, 1 tahun penuh.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                {/* Frozen footer */}
                                <div style={{ padding: '16px 24px', borderTop: '1px solid rgba(255,255,255,0.1)', background: 'rgba(15,23,42,0.6)', display: 'flex', justifyContent: 'flex-end' }}>
                                    <button type="submit" className="btn-primary" style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                        <Printer style={{ width: '18px', height: '18px' }} />
                                        Cetak Laporan
                                    </button>
                                </div>
                            </form>
                        )}

                        {activeTab === 'rujukan' && (
                            <form onSubmit={handleCetakRujukan} style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
                                {/* Scrollable area */}
                                <div style={{ padding: '24px', flexGrow: 1, overflowY: 'auto' }}>
                                    <h2 style={{ fontSize: '1.1rem', color: '#f8fafc', marginBottom: '20px', paddingBottom: '10px', borderBottom: '1px solid rgba(255,255,255,0.1)' }}>
                                        Laporan Rujukan/Kiriman Pasien
                                    </h2>
                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                                        <div className="form-group">
                                            <label className="form-label">Asal Pasien</label>
                                            <select className="form-input" value={rujAsal} onChange={e => setRujAsal(e.target.value)}>
                                                <option value="">-- Semua (Selain Datang Sendiri) --</option>
                                                {asal_pasien.map(a => (
                                                    <option key={a.id_dc_asal_pasien} value={a.id_dc_asal_pasien}>{a.asal_pasien}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px' }}>
                                            <div className="form-group">
                                                <label className="form-label">Dari Tanggal</label>
                                                <input type="date" className="form-input" required value={rujTglAwal} onChange={e => setRujTglAwal(e.target.value)} />
                                            </div>
                                            <div className="form-group">
                                                <label className="form-label">Sampai Tanggal</label>
                                                <input type="date" className="form-input" required value={rujTglAkhir} onChange={e => setRujTglAkhir(e.target.value)} />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/* Frozen footer */}
                                <div style={{ padding: '16px 24px', borderTop: '1px solid rgba(255,255,255,0.1)', background: 'rgba(15,23,42,0.6)', display: 'flex', justifyContent: 'flex-end' }}>
                                    <button type="submit" className="btn-primary" style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                        <Printer style={{ width: '18px', height: '18px' }} />
                                        Cetak Laporan
                                    </button>
                                </div>
                            </form>
                        )}
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
