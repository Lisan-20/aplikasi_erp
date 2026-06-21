import React, { useState, useEffect } from 'react';
import { Head, usePage } from '@inertiajs/react';
import { Activity, Users, DollarSign, CreditCard, TrendingUp, Plus, FileText, ShoppingCart, ArrowRight } from 'lucide-react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import axios from 'axios';
import {
    BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer,
    PieChart, Pie, Cell, Legend
} from 'recharts';

const COLORS = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];

export default function Dashboard() {
    const { dashboard } = usePage().props;
    const modulId = dashboard?.modul_id;
    const moduleName = dashboard?.module_name || 'Modul Sistem';

    const [metrics, setMetrics] = useState(null);
    const [loading, setLoading] = useState(false);
    const [errorMsg, setErrorMsg] = useState(null);

    useEffect(() => {
        if (modulId == 10) {
            setLoading(true);
            axios.get('/api/dashboard/kasir')
                .then(res => {
                    if (res.data && res.data.data) {
                        setMetrics(res.data.data);
                    } else {
                        setErrorMsg('Format response tidak sesuai: ' + JSON.stringify(res.data).substring(0, 100));
                    }
                })
                .catch(err => {
                    console.error(err);
                    setErrorMsg(err.message + (err.response ? ' - ' + err.response.status : ''));
                })
                .finally(() => setLoading(false));
        }
    }, [modulId]);

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    return (
        <DashboardLayout>
            <Head title={`${moduleName} - Sistem ERP`} />
            
            <div className="bg-slate-800/80 backdrop-blur-xl border border-slate-700/60 p-8 rounded-3xl shadow-2xl mb-8 relative overflow-hidden">
                <div className="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div className="absolute bottom-0 left-0 -mb-10 -ml-10 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl"></div>
                
                <div className="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 className="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-emerald-400 mb-3 tracking-tight">
                            Selamat Datang di {moduleName}
                        </h1>
                        <p className="text-slate-400 text-lg">Kelola operasional dan pantau performa bisnis Anda dalam satu layar interaktif.</p>
                    </div>
                    <div className="flex flex-wrap gap-3">
                        <button className="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                            <Plus size={18} /> Transaksi Baru
                        </button>
                        <button className="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-xl transition-all flex items-center gap-2">
                            <FileText size={18} /> Laporan
                        </button>
                    </div>
                </div>
            </div>

            {modulId == 10 && loading && (
                <div className="bg-white/5 border border-white/10 text-white p-5 rounded-xl animate-pulse">
                    Sedang memuat data metrik...
                </div>
            )}

            {modulId == 10 && errorMsg && (
                <div className="bg-red-500/10 border border-red-500/30 text-red-400 p-5 rounded-xl">
                    <strong className="font-bold">Gagal Memuat Metrik:</strong> {errorMsg}
                </div>
            )}

            {modulId == 10 && !loading && !errorMsg && !metrics && (
                <div className="bg-amber-500/10 border border-amber-500/30 text-amber-400 p-5 rounded-xl">
                    Data metrik kosong.
                </div>
            )}

            {modulId == 10 && metrics && (
                <>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        {/* Widget 1 */}
                        <div className="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:border-slate-600 group">
                            <div className="bg-blue-500/20 text-blue-500 p-3 rounded-xl w-fit mb-4 group-hover:scale-110 transition-transform">
                                <DollarSign size={28} />
                            </div>
                            <h3 className="text-slate-400 font-medium text-sm mb-1">Pendapatan Hari Ini</h3>
                            <p className="text-2xl font-bold text-white">
                                {formatRupiah(metrics.header.TotalPendapatanHariIni)}
                            </p>
                        </div>
                        
                        {/* Widget 2 */}
                        <div className="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:border-slate-600 group">
                            <div className="bg-emerald-500/20 text-emerald-500 p-3 rounded-xl w-fit mb-4 group-hover:scale-110 transition-transform">
                                <TrendingUp size={28} />
                            </div>
                            <h3 className="text-slate-400 font-medium text-sm mb-1">Total Transaksi</h3>
                            <p className="text-2xl font-bold text-white">
                                {metrics.header.TotalTransaksiHariIni}
                            </p>
                        </div>
                        
                        {/* Widget 3 */}
                        <div className="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:border-slate-600 group">
                            <div className="bg-amber-500/20 text-amber-500 p-3 rounded-xl w-fit mb-4 group-hover:scale-110 transition-transform">
                                <CreditCard size={28} />
                            </div>
                            <h3 className="text-slate-400 font-medium text-sm mb-1">Piutang Hari Ini</h3>
                            <p className="text-2xl font-bold text-white">
                                {formatRupiah(metrics.header.TotalPiutangHariIni)}
                            </p>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <div className="bg-slate-800/60 backdrop-blur-md border border-slate-700/50 p-6 rounded-3xl shadow-xl hover:shadow-2xl transition-shadow">
                            <h3 className="text-lg font-bold text-slate-100 mb-6 flex items-center gap-2">
                                <div className="w-2 h-6 bg-blue-500 rounded-full"></div>
                                Tren Penjualan (7 Hari Terakhir)
                            </h3>
                            <div className="h-[300px] w-full">
                                <ResponsiveContainer width="100%" height="100%">
                                    <BarChart data={metrics.revenueTrend} margin={{ top: 10, right: 30, left: 20, bottom: 5 }}>
                                        <CartesianGrid strokeDasharray="3 3" stroke="rgba(255,255,255,0.05)" vertical={false} />
                                        <XAxis dataKey="name" stroke="#64748b" tickLine={false} axisLine={false} />
                                        <YAxis stroke="#64748b" tickFormatter={(value) => `Rp${value/1000000}M`} tickLine={false} axisLine={false} />
                                        <Tooltip 
                                            contentStyle={{ backgroundColor: 'rgba(15, 23, 42, 0.95)', border: '1px solid rgba(255,255,255,0.1)', borderRadius: '12px', color: '#fff', boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.5)' }}
                                            itemStyle={{ color: '#fff' }}
                                            formatter={(value) => formatRupiah(value)}
                                            cursor={{fill: 'rgba(255,255,255,0.05)'}}
                                        />
                                        <Bar dataKey="revenue" fill="#3b82f6" radius={[6, 6, 0, 0]} maxBarSize={50} />
                                    </BarChart>
                                </ResponsiveContainer>
                            </div>
                        </div>

                        <div className="bg-slate-800/60 backdrop-blur-md border border-slate-700/50 p-6 rounded-3xl shadow-xl hover:shadow-2xl transition-shadow">
                            <h3 className="text-lg font-bold text-slate-100 mb-6 flex items-center gap-2">
                                <div className="w-2 h-6 bg-emerald-500 rounded-full"></div>
                                Metode Pembayaran
                            </h3>
                            <div className="h-[300px] w-full">
                                <ResponsiveContainer width="100%" height="100%">
                                    <PieChart>
                                        <Pie
                                            data={metrics.paymentMethods}
                                            cx="50%"
                                            cy="50%"
                                            innerRadius={70}
                                            outerRadius={100}
                                            paddingAngle={5}
                                            dataKey="value"
                                            nameKey="name"
                                            stroke="none"
                                        >
                                            {metrics.paymentMethods.map((entry, index) => (
                                                <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                                            ))}
                                        </Pie>
                                        <Tooltip 
                                            contentStyle={{ backgroundColor: 'rgba(15, 23, 42, 0.95)', border: '1px solid rgba(255,255,255,0.1)', borderRadius: '12px', color: '#fff', boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.5)' }}
                                            itemStyle={{ color: '#fff' }}
                                        />
                                        <Legend verticalAlign="bottom" height={36} iconType="circle" />
                                    </PieChart>
                                </ResponsiveContainer>
                            </div>
                        </div>
                    </div>

                    {/* ERP Data Table Section */}
                    <div className="bg-slate-800/80 backdrop-blur-xl border border-slate-700/60 rounded-3xl shadow-xl overflow-hidden mt-2">
                        <div className="p-6 border-b border-slate-700/60 flex justify-between items-center bg-slate-800/50">
                            <h3 className="text-lg font-bold text-slate-100 flex items-center gap-2">
                                <Activity className="text-indigo-400" size={20}/>
                                Aktivitas Transaksi Terbaru
                            </h3>
                            <button className="text-sm font-medium text-blue-400 hover:text-blue-300 flex items-center gap-1 transition-colors">
                                Lihat Semua <ArrowRight size={16} />
                            </button>
                        </div>
                        <div className="overflow-x-auto">
                            <table className="w-full text-left text-sm text-slate-400">
                                <thead className="text-xs uppercase bg-slate-900/50 text-slate-300 font-semibold">
                                    <tr>
                                        <th scope="col" className="px-6 py-4">No. Transaksi</th>
                                        <th scope="col" className="px-6 py-4">Pelanggan/Pasien</th>
                                        <th scope="col" className="px-6 py-4">Metode</th>
                                        <th scope="col" className="px-6 py-4">Status</th>
                                        <th scope="col" className="px-6 py-4 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-slate-700/50">
                                    <tr className="hover:bg-slate-700/30 transition-colors">
                                        <td className="px-6 py-4 font-medium text-slate-200">TRX-20260621-001</td>
                                        <td className="px-6 py-4">Budi Santoso</td>
                                        <td className="px-6 py-4">
                                            <span className="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-full text-xs font-semibold">Transfer</span>
                                        </td>
                                        <td className="px-6 py-4">
                                            <span className="flex items-center gap-1.5 text-emerald-400"><div className="w-2 h-2 rounded-full bg-emerald-400"></div> Selesai</span>
                                        </td>
                                        <td className="px-6 py-4 text-right font-bold text-white">Rp 2.500.000</td>
                                    </tr>
                                    <tr className="hover:bg-slate-700/30 transition-colors">
                                        <td className="px-6 py-4 font-medium text-slate-200">TRX-20260621-002</td>
                                        <td className="px-6 py-4">PT. Sumber Makmur</td>
                                        <td className="px-6 py-4">
                                            <span className="px-3 py-1 bg-amber-500/10 text-amber-400 rounded-full text-xs font-semibold">Kredit</span>
                                        </td>
                                        <td className="px-6 py-4">
                                            <span className="flex items-center gap-1.5 text-amber-400"><div className="w-2 h-2 rounded-full bg-amber-400"></div> Pending</span>
                                        </td>
                                        <td className="px-6 py-4 text-right font-bold text-white">Rp 14.250.000</td>
                                    </tr>
                                    <tr className="hover:bg-slate-700/30 transition-colors">
                                        <td className="px-6 py-4 font-medium text-slate-200">TRX-20260621-003</td>
                                        <td className="px-6 py-4">Siti Aminah</td>
                                        <td className="px-6 py-4">
                                            <span className="px-3 py-1 bg-emerald-500/10 text-emerald-400 rounded-full text-xs font-semibold">Tunai</span>
                                        </td>
                                        <td className="px-6 py-4">
                                            <span className="flex items-center gap-1.5 text-emerald-400"><div className="w-2 h-2 rounded-full bg-emerald-400"></div> Selesai</span>
                                        </td>
                                        <td className="px-6 py-4 text-right font-bold text-white">Rp 850.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </>
            )}

            {modulId != 10 && (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div className="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg flex items-start space-x-4">
                        <div className="bg-blue-500/20 text-blue-500 p-3 rounded-xl shrink-0">
                            <Activity size={24} />
                        </div>
                        <div>
                            <h3 className="text-white font-semibold mb-1">Status Sistem</h3>
                            <p className="text-slate-400 text-sm">Sistem berjalan optimal. Semua layanan terhubung.</p>
                        </div>
                    </div>
                    
                    <div className="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg flex items-start space-x-4">
                        <div className="bg-emerald-500/20 text-emerald-500 p-3 rounded-xl shrink-0">
                            <Users size={24} />
                        </div>
                        <div>
                            <h3 className="text-white font-semibold mb-1">Sesi Pengguna</h3>
                            <p className="text-slate-400 text-sm">Anda login dengan hak akses modul saat ini.</p>
                        </div>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
