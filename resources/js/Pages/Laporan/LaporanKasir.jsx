import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head } from '@inertiajs/react';
import { Activity, Printer, FileSpreadsheet } from 'lucide-react';

export default function LaporanKasir({ auth, users }) {
    const today = new Date().toISOString().split('T')[0];
    const [activeTab, setActiveTab] = useState('rekap');

    // State for Tab 1 (Rekap & Detail Kasir)
    const [tglAwal, setTglAwal] = useState(today);
    const [tglAkhir, setTglAkhir] = useState(today);
    const [petugas, setPetugas] = useState('all');
    const [shift, setShift] = useState('all');
    const [loket, setLoket] = useState('all');

    const handleCetak = (e) => {
        e.preventDefault();
        const params = new URLSearchParams({
            tgl_awal: tglAwal,
            tgl_akhir: tglAkhir,
            petugas: petugas,
            shift: shift,
            loket: loket
        });
        window.open(`/laporan/kasir/print?${params.toString()}`, '_blank');
    };

    const handleExportCSV = (e) => {
        e.preventDefault();
        const params = new URLSearchParams({
            tgl_awal: tglAwal,
            tgl_akhir: tglAkhir,
            petugas: petugas,
            shift: shift,
            loket: loket
        });
        window.location.href = `/laporan/kasir/export-csv?${params.toString()}`;
    };

    return (
        <DashboardLayout user={auth?.user}>
            <Head title="Laporan Tutup Kasir" />

            <div className="pl-container" style={{ display: 'flex', flexDirection: 'column', height: '100%', gap: '16px' }}>
                {/* Header Panel */}
                <div className="glass-panel" style={{ padding: '16px', display: 'flex', alignItems: 'center', gap: '12px' }}>
                    <div style={{
                        width: '40px', height: '40px', borderRadius: '10px',
                        background: 'linear-gradient(135deg, rgba(16,185,129,0.2) 0%, rgba(16,185,129,0.05) 100%)',
                        display: 'flex', alignItems: 'center', justifyContent: 'center',
                        border: '1px solid rgba(16,185,129,0.2)'
                    }}>
                        <Activity style={{ width: '20px', height: '20px', color: '#10b981' }} />
                    </div>
                    <div>
                        <h1 style={{ margin: 0, fontSize: '1.25rem', fontWeight: 600, color: '#f8fafc' }}>
                            Laporan Kasir
                        </h1>
                        <p style={{ margin: 0, fontSize: '0.875rem', color: '#94a3b8' }}>
                            Pilih dan cetak rekapitulasi serta detail transaksi kasir (End of Day)
                        </p>
                    </div>
                </div>

                {/* Main Content Area */}
                <div style={{ display: 'flex', gap: '16px', flex: 1, minHeight: 0 }}>
                    {/* Sidebar Tabs */}
                    <div className="glass-panel" style={{ width: '280px', padding: '12px', display: 'flex', flexDirection: 'column', gap: '8px' }}>
                        <button
                            onClick={() => setActiveTab('rekap')}
                            style={{
                                display: 'flex', alignItems: 'center', gap: '12px', width: '100%', padding: '12px 16px',
                                borderRadius: '8px', border: 'none', cursor: 'pointer', textAlign: 'left',
                                backgroundColor: activeTab === 'rekap' ? 'rgba(16,185,129,0.1)' : 'transparent',
                                borderLeft: activeTab === 'rekap' ? '3px solid #10b981' : '3px solid transparent',
                                color: activeTab === 'rekap' ? '#10b981' : '#cbd5e1',
                                fontWeight: activeTab === 'rekap' ? 600 : 400,
                                transition: 'all 0.2s'
                            }}
                        >
                            <Activity style={{ width: '18px', height: '18px' }} />
                            Rekap & Detail Kasir
                        </button>
                    </div>

                    {/* Form Container with scrollable content and frozen bottom */}
                    <div className="glass-panel" style={{ flex: 1, display: 'flex', flexDirection: 'column', minHeight: 0 }}>
                        {activeTab === 'rekap' && (
                            <form style={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
                                {/* Scrollable area */}
                                <div style={{ padding: '24px', flexGrow: 1, overflowY: 'auto' }}>
                                    <h2 style={{ fontSize: '1.1rem', color: '#f8fafc', marginBottom: '20px', paddingBottom: '10px', borderBottom: '1px solid rgba(255,255,255,0.1)' }}>
                                        Parameter Laporan Kasir
                                    </h2>
                                    <div className="grid-2-cols">
                                        <div className="form-group">
                                            <label className="form-label">Tanggal Mulai</label>
                                            <input type="date" className="form-input" required value={tglAwal} onChange={e => setTglAwal(e.target.value)} />
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Tanggal Akhir</label>
                                            <input type="date" className="form-input" required value={tglAkhir} onChange={e => setTglAkhir(e.target.value)} />
                                        </div>
                                        <div className="form-group" style={{ gridColumn: '1 / -1' }}>
                                            <label className="form-label">Nama Petugas</label>
                                            <select className="form-input" value={petugas} onChange={e => setPetugas(e.target.value)}>
                                                <option value="all">--- Semua Petugas ---</option>
                                                {users && users.map(u => (
                                                    <option key={u.id_dd_user} value={u.id_dd_user}>{u.nama_lengkap || u.username}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Shift</label>
                                            <select className="form-input" value={shift} onChange={e => setShift(e.target.value)}>
                                                <option value="all">--- Semua Shift ---</option>
                                                <option value="1">Shift Pagi</option>
                                                <option value="2">Shift Siang</option>
                                                <option value="3">Shift Malam</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label className="form-label">Loket</label>
                                            <select className="form-input" value={loket} onChange={e => setLoket(e.target.value)}>
                                                <option value="all">--- Semua Loket ---</option>
                                                <option value="1">Loket 1</option>
                                                <option value="2">Loket 2</option>
                                                <option value="3">Loket Poli</option>
                                                <option value="4">Loket IGD</option>
                                                <option value="5">Loket Rawat Inap</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {/* Frozen footer */}
                                <div style={{ padding: '16px 24px', borderTop: '1px solid rgba(255,255,255,0.1)', background: 'rgba(15,23,42,0.6)', display: 'flex', justifyContent: 'flex-end', gap: '12px' }}>
                                    <button type="button" onClick={handleExportCSV} className="dash-btn primary" style={{ display: 'flex', alignItems: 'center', gap: '8px', padding: '8px 16px', borderRadius: '8px', border: 'none', cursor: 'pointer', fontWeight: 500 }}>
                                        <FileSpreadsheet style={{ width: '18px', height: '18px' }} />
                                        Export Excel (CSV)
                                    </button>
                                    <button type="button" onClick={handleCetak} className="dash-btn primary" style={{ display: 'flex', alignItems: 'center', gap: '8px', padding: '8px 16px', borderRadius: '8px', border: 'none', cursor: 'pointer', fontWeight: 500 }}>
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
