import React from 'react';
import { AreaChart, Area, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, PieChart, Pie, Cell } from 'recharts';
import { Users, UserPlus, CalendarCheck, Clock } from 'lucide-react';

export default function DashboardRegistrasi() {
    // Dummy Data Registrasi ERP
    const customerVisits = [
        { time: '08:00', total: 15 },
        { time: '10:00', total: 35 },
        { time: '12:00', total: 42 },
        { time: '14:00', total: 28 },
        { time: '16:00', total: 45 },
        { time: '18:00', total: 55 },
        { time: '20:00', total: 30 },
    ];

    const customerTypes = [
        { name: 'Pelanggan Baru', value: 35 },
        { name: 'Pelanggan Lama', value: 65 },
    ];

    const COLORS = ['#10b981', '#3b82f6'];

    return (
        <div style={{ display: 'flex', flexDirection: 'column', gap: '24px' }}>
            
            {/* Top Metrics Cards */}
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(240px, 1fr))', gap: '20px' }}>
                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(59, 130, 246, 0.2)', padding: '15px', borderRadius: '12px', color: '#3b82f6' }}>
                        <Users size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Total Kunjungan Toko</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>250 Pelanggan</div>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(16, 185, 129, 0.2)', padding: '15px', borderRadius: '12px', color: '#10b981' }}>
                        <UserPlus size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Membership Baru</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>35 Orang</div>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(139, 92, 246, 0.2)', padding: '15px', borderRadius: '12px', color: '#8b5cf6' }}>
                        <CalendarCheck size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Reservasi / Order</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>84 Transaksi</div>
                    </div>
                </div>

                <div className="glass-panel" style={{ padding: '20px', borderRadius: '8px', display: 'flex', alignItems: 'center', gap: '15px' }}>
                    <div style={{ background: 'rgba(239, 68, 68, 0.2)', padding: '15px', borderRadius: '12px', color: '#ef4444' }}>
                        <Clock size={28} />
                    </div>
                    <div>
                        <div style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Antrian Layanan</div>
                        <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: 'var(--text-main)' }}>12 Antrian</div>
                    </div>
                </div>
            </div>

            {/* Charts Area */}
            <div style={{ display: 'grid', gridTemplateColumns: '2fr 1fr', gap: '24px' }}>
                
                {/* Area Chart: Tren Kunjungan */}
                <div className="glass-panel" style={{ padding: '24px', borderRadius: '8px' }}>
                    <h3 style={{ fontSize: '1.1rem', marginBottom: '20px', color: 'var(--text-main)' }}>Tren Kunjungan Hari Ini (Per Jam)</h3>
                    <div style={{ width: '100%', height: '300px' }}>
                        <ResponsiveContainer>
                            <AreaChart data={customerVisits} margin={{ top: 10, right: 30, left: 0, bottom: 0 }}>
                                <defs>
                                    <linearGradient id="colorTotal" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="5%" stopColor="#8b5cf6" stopOpacity={0.8}/>
                                    <stop offset="95%" stopColor="#8b5cf6" stopOpacity={0}/>
                                    </linearGradient>
                                </defs>
                                <XAxis dataKey="time" stroke="var(--text-muted)" />
                                <YAxis stroke="var(--text-muted)" />
                                <CartesianGrid strokeDasharray="3 3" stroke="rgba(255,255,255,0.1)" />
                                <Tooltip 
                                    contentStyle={{ backgroundColor: '#1e293b', border: 'none', borderRadius: '8px', color: '#fff' }}
                                    formatter={(value) => [`${value} Orang`, 'Jumlah Kunjungan']}
                                />
                                <Area type="monotone" dataKey="total" stroke="#8b5cf6" fillOpacity={1} fill="url(#colorTotal)" />
                            </AreaChart>
                        </ResponsiveContainer>
                    </div>
                </div>

                {/* Pie Chart: Pasien Baru vs Lama */}
                <div className="glass-panel" style={{ padding: '24px', borderRadius: '8px' }}>
                    <h3 style={{ fontSize: '1.1rem', marginBottom: '20px', color: 'var(--text-main)' }}>Rasio Pelanggan</h3>
                    <div style={{ width: '100%', height: '300px', position: 'relative' }}>
                        <ResponsiveContainer>
                            <PieChart>
                                <Pie
                                    data={customerTypes}
                                    cx="50%"
                                    cy="50%"
                                    innerRadius={60}
                                    outerRadius={90}
                                    paddingAngle={5}
                                    dataKey="value"
                                >
                                    {customerTypes.map((entry, index) => (
                                        <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                                    ))}
                                </Pie>
                                <Tooltip 
                                    contentStyle={{ backgroundColor: '#1e293b', border: 'none', borderRadius: '8px', color: '#fff' }}
                                    formatter={(value) => [`${value}%`, 'Rasio']}
                                />
                            </PieChart>
                        </ResponsiveContainer>
                        {/* Custom Legend */}
                        <div style={{ display: 'flex', justifyContent: 'center', gap: '20px', marginTop: '-20px' }}>
                            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <div style={{ width: '12px', height: '12px', borderRadius: '50%', background: COLORS[0] }}></div>
                                <span style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Baru</span>
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <div style={{ width: '12px', height: '12px', borderRadius: '50%', background: COLORS[1] }}></div>
                                <span style={{ fontSize: '0.9rem', color: 'var(--text-muted)' }}>Lama / Member</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    );
}
