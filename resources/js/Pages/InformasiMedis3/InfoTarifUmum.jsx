import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';

export default function InfoTarifUmum({ data, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.filter || '');
    const [searchType, setSearchType] = useState(filters.typeCari || '2');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/info-tarif-umum', { filter: searchTerm, typeCari: searchType }, { preserveState: true });
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount || 0);
    };

    return (
        <div className="app-container">
            <Head title="Info Tarif Umum" />

            <nav className="glass-sidebar">
                <div className="sidebar-header">
                    <h2>Info Tarif Umum</h2>
                </div>
                <div className="sidebar-menu">
                    <Link href="/dashboard/2" className="menu-item">
                        <span className="menu-icon">←</span>
                        <span>Kembali</span>
                    </Link>
                </div>
            </nav>

            <div className="main-content">
                <header className="glass-header">
                    <div className="header-title">
                        <h1>Master Tarif Umum</h1>
                    </div>
                </header>

                <main style={{ padding: '20px' }}>
                    <div className="glass-panel" style={{ padding: '20px', marginBottom: '20px' }}>
                        <form onSubmit={handleSearch} style={{ display: 'flex', gap: '15px', alignItems: 'center' }}>
                            <label style={{ color: 'var(--text-secondary)' }}>Cari :</label>
                            <select 
                                className="premium-input" 
                                style={{ width: '150px', padding: '10px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', backgroundColor: '#1e293b' }}
                                value={searchType}
                                onChange={(e) => setSearchType(e.target.value)}
                            >
                                <option value="2">Nama Tarif</option>
                                <option value="1">Kode Tindakan</option>
                            </select>
                            <input 
                                type="text" 
                                className="premium-input"
                                style={{ flex: 1, padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white' }}
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                                placeholder="Masukkan kata kunci pencarian..."
                            />
                            <button type="submit" className="dash-btn primary">Cari</button>
                        </form>
                    </div>

                    <div className="glass-panel" style={{ padding: '20px', overflowX: 'auto' }}>
                        <table style={{ width: '100%', borderCollapse: 'collapse', color: 'white' }}>
                            <thead>
                                <tr>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>No.</th>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>Nama Tarif</th>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>Nama Bagian</th>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>Kelas</th>
                                    <th colSpan="3" style={{ padding: '10px', borderBottom: '1px solid rgba(255,255,255,0.1)', textAlign: 'center' }}>Tarif</th>
                                </tr>
                                <tr>
                                    <th style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>Dokter</th>
                                    <th style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>RS</th>
                                    <th style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data && data.data.length > 0 ? (
                                    data.data.map((item, index) => {
                                        const totalUmum = (item.bill_rs || 0) + (item.bill_dr1 || 0) + (item.bill_dr2 || 0);
                                        
                                        let textColor = 'white';
                                        let fontWeight = 'normal';
                                        
                                        if (item.tingkatan == 1) {
                                            textColor = '#60a5fa'; // blue
                                            fontWeight = 'bold';
                                        } else if (item.tingkatan == 2) {
                                            textColor = '#f87171'; // red
                                            fontWeight = 'bold';
                                        } else if (item.tingkatan == 3) {
                                            textColor = '#fbbf24'; // yellow/gold
                                            fontWeight = 'bold';
                                        } else if (item.tingkatan == 4) {
                                            textColor = '#4ade80'; // green
                                            fontWeight = 'bold';
                                        }
                                        
                                        return (
                                            <tr key={index} style={{ borderBottom: '1px solid rgba(255,255,255,0.05)' }}>
                                                <td style={{ padding: '10px' }}>{data.from + index}.</td>
                                                <td style={{ padding: '10px', color: textColor, fontWeight: fontWeight }}>
                                                    {item.nama_tarif}
                                                </td>
                                                <td style={{ padding: '10px' }}>{item.nama_bagian}</td>
                                                <td style={{ padding: '10px' }}>{item.nama_klas}</td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {item.tingkatan == 5 ? formatCurrency(item.bill_dr1) : ''}
                                                </td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {item.tingkatan == 5 ? formatCurrency(item.bill_rs) : ''}
                                                </td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {item.tingkatan == 5 ? formatCurrency(totalUmum) : ''}
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="7" style={{ padding: '20px', textAlign: 'center', color: 'rgba(255,255,255,0.5)' }}>
                                            Tidak ada data ditemukan
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                        
                        {/* Pagination Component */}
                        {data.links && data.links.length > 3 && (
                            <div style={{ display: 'flex', justifyContent: 'center', gap: '5px', marginTop: '20px' }}>
                                {data.links.map((link, idx) => (
                                    <Link
                                        key={idx}
                                        href={link.url}
                                        className="dash-btn secondary"
                                        style={{
                                            padding: '8px 12px',
                                            background: link.active ? 'var(--accent-color)' : 'rgba(255,255,255,0.05)',
                                            color: 'white',
                                            textDecoration: 'none',
                                            borderRadius: '5px',
                                            opacity: link.url ? 1 : 0.5,
                                            pointerEvents: link.url ? 'auto' : 'none'
                                        }}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                            </div>
                        )}
                    </div>
                </main>
            </div>
        </div>
    );
}
