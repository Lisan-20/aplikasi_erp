import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, BarChart, Bar } from 'recharts';
import { DollarSign, CreditCard, TrendingUp, Loader2 } from 'lucide-react';

export default function DashboardKasir() {
    const [metrics, setMetrics] = useState({
        header: null,
        revenueTrend: [],
        paymentMethods: []
    });
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        // Panggil endpoint API yang mengeksekusi Stored Procedure
        axios.get('/api/dashboard/kasir')
            .then(res => {
                const responseData = res.data.data;
                setMetrics({
                    header: responseData.header,
                    revenueTrend: responseData.revenueTrend,
                    paymentMethods: responseData.paymentMethods
                });
                
                if (res.data.status === 'error') {
                    console.warn("Using Fallback Data:", res.data.message);
                }
            })
            .catch(err => {
                console.error("Gagal mengambil metrik dashboard", err);
                setError('Gagal memuat data dari server.');
            })
            .finally(() => {
                setLoading(false);
            });
    }, []);

    if (loading) {
        return (
            <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', minHeight: '400px', color: 'var(--text-muted)' }}>
                <Loader2 size={40} className="animate-spin" style={{ marginBottom: '16px', color: 'var(--accent-color)' }} />
                <p>Mengambil Data Metrik dari Stored Procedure...</p>
            </div>
        );
    }

    if (error) {
        return (
            <div className="status-badge istirahat" style={{ display: 'block', padding: '15px', textAlign: 'center' }}>
                {error}
            </div>
        );
    }

    const { header, revenueTrend, paymentMethods } = metrics;

    // Helper untuk memformat Rupiah
    const formatRp = (angka) => {
        if (!angka) return 'Rp 0';
        return `Rp ${parseInt(angka).toLocaleString('id-ID')}`;
    };

    return (
        <div style={{ display: 'flex', flexDirection: 'column', gap: '24px' }}>
            
            {/* Top Metrics Cards */}
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(240px, 1fr))', gap: '20px' }}>
                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(16, 185, 129, 0.2)', padding: '15px', borderRadius: '12px', color: '#10b981' }}>
                        <DollarSign size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Pendapatan Hari Ini</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>{formatRp(header?.TotalPendapatanHariIni)}</div>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(59, 130, 246, 0.2)', padding: '15px', borderRadius: '12px', color: '#3b82f6' }}>
                        <CreditCard size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Total Transaksi POS</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>{header?.TotalTransaksiHariIni || 0} Struk</div>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(245, 158, 11, 0.2)', padding: '15px', borderRadius: '12px', color: '#f59e0b' }}>
                        <TrendingUp size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Piutang / Tempo</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>{formatRp(header?.TotalPiutangHariIni)}</div>
                    </div>
                </div>
            </div>

            {/* Charts Area */}
            <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr', gap: '24px' }}>
                
                {/* Line Chart: Tren Pendapatan */}
                <div className="glass-panel" style={{ padding: '24px', borderRadius: '8px' }}>
                    <h3 style={{ fontSize: '1.1rem', marginBottom: '20px', color: 'var(--text-main)' }}>Tren Penjualan POS (7 Hari Terakhir)</h3>
                    <div style={{ width: '100%', height: '300px' }}>
                        <ResponsiveContainer>
                            <LineChart data={revenueTrend} margin={{ top: 5, right: 20, bottom: 5, left: 20 }}>
                                <CartesianGrid strokeDasharray="3 3" stroke="rgba(255,255,255,0.1)" />
                                <XAxis dataKey="name" stroke="var(--text-muted)" />
                                <YAxis stroke="var(--text-muted)" tickFormatter={(val) => `Rp ${val / 1000000}M`} />
                                <Tooltip 
                                    contentStyle={{ backgroundColor: '#1e293b', border: 'none', borderRadius: '8px', color: '#fff' }}
                                    formatter={(value) => [formatRp(value), 'Penjualan']}
                                />
                                <Line type="monotone" dataKey="revenue" stroke="#10b981" strokeWidth={3} dot={{ r: 4, fill: '#10b981' }} activeDot={{ r: 6 }} />
                            </LineChart>
                        </ResponsiveContainer>
                    </div>
                </div>

                {/* Bar Chart: Metode Pembayaran */}
                <div className="glass-panel" style={{ padding: '24px', borderRadius: '8px' }}>
                    <h3 style={{ fontSize: '1.1rem', marginBottom: '20px', color: 'var(--text-main)' }}>Metode Pembayaran (%)</h3>
                    <div style={{ width: '100%', height: '300px' }}>
                        <ResponsiveContainer>
                            <BarChart data={paymentMethods} layout="vertical" margin={{ top: 5, right: 30, left: 20, bottom: 5 }}>
                                <CartesianGrid strokeDasharray="3 3" stroke="rgba(255,255,255,0.1)" horizontal={false} />
                                <XAxis type="number" stroke="var(--text-muted)" />
                                <YAxis dataKey="name" type="category" stroke="var(--text-muted)" width={80} />
                                <Tooltip 
                                    contentStyle={{ backgroundColor: '#1e293b', border: 'none', borderRadius: '8px', color: '#fff' }}
                                    formatter={(value) => [`${value}%`, 'Persentase']}
                                />
                                <Bar dataKey="value" fill="#3b82f6" radius={[0, 4, 4, 0]} />
                            </BarChart>
                        </ResponsiveContainer>
                    </div>
                </div>

            </div>

        </div>
    );
}
