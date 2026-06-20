import React, { useState } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';

export default function PaketMelahirkan({ data, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.filter || '');
    const [searchType, setSearchType] = useState(filters.tipeCari || 'tindakan');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/paket-melahirkan', { filter: searchTerm, tipeCari: searchType }, { preserveState: true });
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount || 0);
    };

    return (
        <div className="app-container">
            <Head title="Paket Melahirkan" />

            <nav className="glass-sidebar">
                <div className="sidebar-header">
                    <h2>Paket Melahirkan</h2>
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
                        <h1>Paket Melahirkan</h1>
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
                                <option value="tindakan">Tindakan</option>
                                <option value="klas">Klas</option>
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
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>Jenis Paket</th>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>Tindakan</th>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'left' }}>Klas</th>
                                    <th colSpan="3" style={{ padding: '10px', borderBottom: '1px solid rgba(255,255,255,0.1)', textAlign: 'center' }}>Tarif</th>
                                    <th rowSpan="2" style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>Total</th>
                                </tr>
                                <tr>
                                    <th style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>Bill Dr 1</th>
                                    <th style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>Bill Dr 2</th>
                                    <th style={{ padding: '10px', borderBottom: '2px solid rgba(255,255,255,0.1)', textAlign: 'right' }}>Bill RS</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.data && data.data.length > 0 ? (
                                    data.data.map((item, index) => {
                                        return (
                                            <tr key={index} style={{ borderBottom: '1px solid rgba(255,255,255,0.05)' }}>
                                                <td style={{ padding: '10px' }}>{index + 1}.</td>
                                                <td style={{ padding: '10px' }}>{item.jenis_paket}</td>
                                                <td style={{ padding: '10px' }}>{item.tindakan}</td>
                                                <td style={{ padding: '10px' }}>{item.klas}</td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {formatCurrency(item.bill_dr1)}
                                                </td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {formatCurrency(item.bill_dr2)}
                                                </td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {formatCurrency(item.bill_rs)}
                                                </td>
                                                <td style={{ padding: '10px', textAlign: 'right' }}>
                                                    {formatCurrency(item.total)}
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="8" style={{ padding: '20px', textAlign: 'center', color: 'rgba(255,255,255,0.5)' }}>
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
