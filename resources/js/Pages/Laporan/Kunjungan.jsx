import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Printer, Calendar, Users, Activity, FileText, Map, Navigation, Baby, MapPin } from 'lucide-react';


export default function Kunjungan() {
    const [activeTab, setActiveTab] = useState('umum');

    // State for common form fields
    const [tglAwal, setTglAwal] = useState(new Date().toISOString().split('T')[0]);
    const [tglAkhir, setTglAkhir] = useState(new Date().toISOString().split('T')[0]);
    const [bulan, setBulan] = useState(new Date().getMonth() + 1);
    const [tahun, setTahun] = useState(new Date().getFullYear());
    const [kategori, setKategori] = useState('1');
    const [frekuensi, setFrekuensi] = useState('1'); // 1: Harian, 2: Bulanan, 3: Tahunan
    const [opsiCetak, setOpsiCetak] = useState('1'); // 1: Biasa, 2: Excel

    const tabs = [
        { id: 'umum', label: 'Kunjungan Umum', icon: <Users size={18} /> },
        { id: 'harian', label: 'Kunjungan Harian', icon: <Calendar size={18} /> },
        { id: 'pm', label: 'Kunjungan PM', icon: <Activity size={18} /> },
        { id: 'ranap', label: 'Kunjungan Rawat Inap', icon: <Users size={18} /> },
        { id: 'perina', label: 'Kunjungan Perinatologi', icon: <Baby size={18} /> },
        { id: 'ri_nasabah', label: 'Kunj. RI Per Nasabah', icon: <FileText size={18} /> },
        { id: 'agama', label: 'Sensus Agama', icon: <Users size={18} /> },
        { id: 'wilayah', label: 'Sensus Wilayah', icon: <Map size={18} /> },
        { id: 'dusun', label: 'Sensus Dusun', icon: <Navigation size={18} /> },
        { id: 'umur', label: 'Sensus Umur', icon: <MapPin size={18} /> }
    ];

    const currentYear = new Date().getFullYear();
    const years = Array.from({ length: 10 }, (_, i) => currentYear - i);

    const handlePrint = (e, url) => {
        e.preventDefault();

        let targetUrl = `${url}?opsi_cetak=${opsiCetak}`;

        if (frekuensi === '1' || activeTab === 'harian') {
            targetUrl += `&tgl_awal=${tglAwal}&tgl_akhir=${tglAkhir}`;
        } else if (frekuensi === '2') {
            targetUrl += `&bulan=${bulan}&tahun=${tahun}`;
        } else {
            targetUrl += `&tahun=${tahun}`;
        }

        if (activeTab === 'umum') {
            targetUrl += `&kategori=${kategori}&frekuensi=${frekuensi}`;
        }

        window.open(targetUrl, '_blank', 'noopener,noreferrer');
    };

    return (
        <DashboardLayout>
            <Head title="Laporan Kunjungan" />

            <div className="pl-container" style={{ padding: '20px', display: 'flex', flexDirection: 'column', gap: '20px', height: '100%' }}>
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Laporan Kunjungan & Sensus</h1>
                        <p>Menu sentralisasi cetak rekapitulasi data kunjungan pasien dan sensus Sistem ERP</p>
                    </div>
                </div>

                <div style={{ display: 'flex', gap: '20px', flex: 1, minHeight: 0 }}>
                    {/* Vertical Sidebar Tabs */}
                    <div className="glass-panel" style={{ width: '250px', padding: '10px 0', display: 'flex', flexDirection: 'column', overflowY: 'auto' }}>
                        {tabs.map((tab) => (
                            <button
                                key={tab.id}
                                onClick={() => setActiveTab(tab.id)}
                                style={{
                                    display: 'flex',
                                    alignItems: 'center',
                                    gap: '12px',
                                    padding: '12px 20px',
                                    border: 'none',
                                    background: activeTab === tab.id ? 'rgba(59, 130, 246, 0.1)' : 'transparent',
                                    color: activeTab === tab.id ? '#3b82f6' : '#475569',
                                    fontWeight: activeTab === tab.id ? '600' : '500',
                                    borderRight: activeTab === tab.id ? '3px solid #3b82f6' : '3px solid transparent',
                                    cursor: 'pointer',
                                    textAlign: 'left',
                                    transition: 'all 0.2s',
                                    fontSize: '0.9rem'
                                }}
                            >
                                {tab.icon}
                                {tab.label}
                            </button>
                        ))}
                    </div>

                    {/* Content Area */}
                    <div className="glass-panel table-wrap" style={{ flex: 1, padding: '30px', display: 'flex', flexDirection: 'column' }}>
                        <h2 style={{ fontSize: '1.25rem', fontWeight: 'bold', color: '#1e293b', marginBottom: '20px', borderBottom: '1px solid #e2e8f0', paddingBottom: '10px' }}>
                            {tabs.find(t => t.id === activeTab)?.label}
                        </h2>

                        <div style={{ maxWidth: '600px' }}>
                            <form className="pl-form">
                                {/* Form Kunjungan Umum Khusus */}
                                {activeTab === 'umum' && (
                                    <>
                                        <div className="form-group" style={{ marginBottom: '15px' }}>
                                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Kategori</label>
                                            <select className="search-input" value={kategori} onChange={(e) => setKategori(e.target.value)} style={{ width: '100%', padding: '8px' }}>
                                                <option value="1">Semua</option>
                                                <option value="2">Rawat Jalan</option>
                                                <option value="3">Rawat Inap</option>
                                                <option value="5">PERINA</option>
                                                <option value="6">ICU</option>
                                                <option value="7">Nifas</option>
                                            </select>
                                        </div>
                                        <div className="form-group" style={{ marginBottom: '15px' }}>
                                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Frekuensi</label>
                                            <select className="search-input" value={frekuensi} onChange={(e) => setFrekuensi(e.target.value)} style={{ width: '100%', padding: '8px' }}>
                                                <option value="1">Harian</option>
                                                <option value="2">Bulanan</option>
                                                <option value="3">Tahunan</option>
                                            </select>
                                        </div>
                                    </>
                                )}

                                {/* Filter Tanggal Harian */}
                                {(frekuensi === '1' || activeTab === 'harian') && (
                                    <div style={{ display: 'flex', gap: '15px', marginBottom: '15px' }}>
                                        <div className="form-group" style={{ flex: 1 }}>
                                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Tanggal Awal</label>
                                            <input type="date" className="search-input" value={tglAwal} onChange={(e) => setTglAwal(e.target.value)} style={{ width: '100%', padding: '8px' }} />
                                        </div>
                                        <div className="form-group" style={{ flex: 1 }}>
                                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Tanggal Akhir</label>
                                            <input type="date" className="search-input" value={tglAkhir} onChange={(e) => setTglAkhir(e.target.value)} style={{ width: '100%', padding: '8px' }} />
                                        </div>
                                    </div>
                                )}

                                {/* Filter Bulan Tahun */}
                                {frekuensi === '2' && activeTab !== 'harian' && (
                                    <div style={{ display: 'flex', gap: '15px', marginBottom: '15px' }}>
                                        <div className="form-group" style={{ flex: 1 }}>
                                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Bulan</label>
                                            <select className="search-input" value={bulan} onChange={(e) => setBulan(e.target.value)} style={{ width: '100%', padding: '8px' }}>
                                                {[1,2,3,4,5,6,7,8,9,10,11,12].map(m => (
                                                    <option key={m} value={m}>{new Date(2000, m - 1).toLocaleString('id-ID', { month: 'long' })}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div className="form-group" style={{ flex: 1 }}>
                                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Tahun</label>
                                            <select className="search-input" value={tahun} onChange={(e) => setTahun(e.target.value)} style={{ width: '100%', padding: '8px' }}>
                                                {years.map(y => <option key={y} value={y}>{y}</option>)}
                                            </select>
                                        </div>
                                    </div>
                                )}

                                {/* Filter Tahunan */}
                                {frekuensi === '3' && activeTab !== 'harian' && (
                                    <div className="form-group" style={{ marginBottom: '15px' }}>
                                        <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Tahun</label>
                                        <select className="search-input" value={tahun} onChange={(e) => setTahun(e.target.value)} style={{ width: '100%', padding: '8px' }}>
                                            {years.map(y => <option key={y} value={y}>{y}</option>)}
                                        </select>
                                    </div>
                                )}

                                {/* Opsi Cetak */}
                                <div className="form-group" style={{ marginBottom: '25px', display: 'flex', gap: '20px', alignItems: 'center' }}>
                                    <label style={{ fontWeight: '500' }}>Opsi Cetak:</label>
                                    <label style={{ display: 'flex', alignItems: 'center', gap: '5px', cursor: 'pointer' }}>
                                        <input type="radio" name="opsi" value="1" checked={opsiCetak === '1'} onChange={(e) => setOpsiCetak(e.target.value)} /> Biasa (HTML)
                                    </label>
                                    <label style={{ display: 'flex', alignItems: 'center', gap: '5px', cursor: 'pointer' }}>
                                        <input type="radio" name="opsi" value="2" checked={opsiCetak === '2'} onChange={(e) => setOpsiCetak(e.target.value)} /> Excel
                                    </label>
                                </div>

                                <button
                                    className="dash-btn primary"
                                    style={{ width: '100%', padding: '12px', fontSize: '1rem', display: 'flex', justifyContent: 'center', gap: '8px' }}
                                    onClick={(e) => {
                                        const urls = {
                                            'umum': '/laporan/registrasi/kunjungan/cetak-umum',
                                            'harian': '/laporan/registrasi/kunjungan/cetak-harian',
                                            'pm': '/laporan/registrasi/kunjungan/cetak-pm',
                                            'ranap': '/laporan/registrasi/kunjungan/cetak-ranap',
                                            'perina': '/laporan/registrasi/kunjungan/cetak-perina',
                                            'ri_nasabah': '/laporan/registrasi/kunjungan/cetak-ri-nasabah',
                                            'agama': '/laporan/registrasi/kunjungan/cetak-sensus-agama',
                                            'wilayah': '/laporan/registrasi/kunjungan/cetak-sensus-wilayah',
                                            'dusun': '/laporan/registrasi/kunjungan/cetak-sensus-dusun',
                                            'umur': '/laporan/registrasi/kunjungan/cetak-sensus-umur'
                                        };
                                        handlePrint(e, urls[activeTab]);
                                    }}
                                >
                                    <Printer size={18} />
                                    Cetak Laporan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
