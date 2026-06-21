import React from 'react';
import { Head, Link, router, usePage } from '@inertiajs/react';
import {
    Activity, Users, Settings, Database, HeartPulse, Building,
    Stethoscope, ArrowRight, Shield, FileText, PlusCircle,
    Search, Heart, LogOut
} from 'lucide-react';

// Helper to map module names to specific icons based on keywords
const getModuleIcon = (name) => {
    const lower = name.toLowerCase();
    if (lower.includes('admin') || lower.includes('setting')) return <Settings size={28} />;
    if (lower.includes('pasien') || lower.includes('pendaftaran')) return <Users size={28} />;
    if (lower.includes('rekam medis') || lower.includes('rm')) return <FileText size={28} />;
    if (lower.includes('apotek') || lower.includes('farmasi')) return <PlusCircle size={28} />;
    if (lower.includes('lab')) return <Search size={28} />;
    if (lower.includes('ugd') || lower.includes('igd') || lower.includes('darurat')) return <Activity size={28} />;
    if (lower.includes('poli') || lower.includes('klinik')) return <Stethoscope size={28} />;
    if (lower.includes('rawat inap') || lower.includes('bangsal')) return <Building size={28} />;
    if (lower.includes('kasir') || lower.includes('keuangan') || lower.includes('billing')) return <Database size={28} />;
    if (lower.includes('asuransi') || lower.includes('bpjs')) return <Shield size={28} />;
    if (lower.includes('icu') || lower.includes('operasi')) return <Heart size={28} />;

    // Default fallback
    return <HeartPulse size={28} />;
};

export default function ModuleSelection({ modulars = [] }) {
    const { auth } = usePage().props;
    // Fallback if auth is not available
    const user = auth?.user || { name: 'User' };

    const handleModuleClick = (id_dc_modul) => {
        router.post(`/modul/${id_dc_modul}/enter`);
    };

    return (
        <div className="min-h-screen bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 flex flex-col relative overflow-hidden font-sans">
            <Head title="Pilih Modul - Sistem ERP" />

            {/* Glowing Orbs for Premium Background */}
            <div className="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] pointer-events-none animate-pulse" style={{ animationDuration: '10s' }}></div>
            <div className="absolute bottom-[-10%] right-[-5%] w-[600px] h-[600px] bg-emerald-600/20 rounded-full blur-[100px] pointer-events-none animate-pulse" style={{ animationDuration: '12s' }}></div>

            {/* Floating Glass Header */}
            <div className="fixed top-0 left-0 right-0 z-50 px-4 py-4 md:px-8 lg:px-12 lg:py-6">
                <div className="max-w-7xl mx-auto bg-white/80 dark:bg-slate-800/60 backdrop-blur-xl border border-slate-200 dark:border-slate-700/50 rounded-2xl shadow-2xl flex flex-col sm:flex-row items-center justify-between p-4 px-6 transition-all duration-300 gap-4 sm:gap-0">
                    <div className="flex flex-col text-center sm:text-left">
                        <h2 className="m-0 text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-emerald-600 dark:from-blue-400 dark:to-emerald-400">
                            Selamat Datang, {user.username || user.name || 'User'}
                        </h2>
                        <p className="m-0 text-sm text-slate-500 dark:text-slate-500 dark:text-slate-400 mt-1">
                            Pusat Komando Sistem Enterprise Anda
                        </p>
                    </div>
                    <a href="/logout" className="group flex items-center gap-2 px-6 py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl font-semibold text-sm transition-all duration-300 border border-red-500/20 hover:border-red-500 shadow-lg hover:shadow-red-500/30">
                        <LogOut size={18} className="group-hover:-translate-y-0.5 transition-transform" />
                        Keluar
                    </a>
                </div>
            </div>

            {/* Main Content */}
            <div className="relative z-10 flex-1 max-w-7xl mx-auto w-full px-6 pt-44 sm:pt-40 pb-20">
                {modulars.map((modular, mIdx) => (
                    <div key={modular.id_dc_modular} className="mb-12 animate-[fadeInUp_0.8s_ease-out_forwards]" style={{ animationDelay: `${mIdx * 0.15}s` }}>
                        <h2 className="text-2xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3 border-b border-slate-200 dark:border-slate-700/50 pb-3">
                            <Activity size={24} className="text-blue-500" />
                            {modular.nama_modular}
                        </h2>

                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            {modular.modules.map((mod) => (
                                <div
                                    key={mod.id_dc_modul}
                                    onClick={() => handleModuleClick(mod.id_dc_modul)}
                                    className="group cursor-pointer bg-white/60 dark:bg-slate-800/40 backdrop-blur-md border border-slate-200 dark:border-slate-700/60 rounded-2xl p-6 hover:-translate-y-1.5 hover:border-blue-500/50 hover:shadow-[0_10px_30px_-10px_rgba(59,130,246,0.3)] transition-all duration-300 flex flex-col gap-4 relative overflow-hidden"
                                >
                                    {/* Subtle shine effect on hover */}
                                    <div className="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/5 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                                    <div className="bg-blue-500/10 text-blue-400 p-4 rounded-xl w-fit group-hover:scale-110 group-hover:bg-blue-500/20 transition-all duration-300 shadow-inner">
                                        {getModuleIcon(mod.nama_modul)}
                                    </div>
                                    <h3 className="text-lg font-semibold text-slate-900 dark:text-slate-100 m-0 group-hover:text-blue-600 dark:group-hover:text-white transition-colors line-clamp-2 leading-snug">
                                        {mod.nama_modul}
                                    </h3>
                                    <div className="mt-auto flex items-center justify-between text-slate-500 dark:text-slate-400 text-sm font-medium pt-3 border-t border-slate-200 dark:border-slate-700/30">
                                        <span className="group-hover:text-blue-400 transition-colors">Akses Modul</span>
                                        <ArrowRight size={18} className="text-slate-500 group-hover:text-blue-400 group-hover:translate-x-1 transition-all duration-300" />
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                ))}

                {modulars.length === 0 && (
                    <div className="flex flex-col items-center justify-center py-20 text-center bg-white/50 dark:bg-slate-800/30 border border-slate-200 dark:border-slate-700/50 rounded-3xl backdrop-blur-md">
                        <Shield size={64} className="text-slate-400 dark:text-slate-600 mb-6" />
                        <h3 className="text-2xl font-bold text-slate-700 dark:text-slate-300 mb-2">Akses Terbatas</h3>
                        <p className="text-slate-500 dark:text-slate-400 max-w-md mx-auto">Anda belum memiliki hak akses ke modul apa pun. Silakan hubungi administrator sistem untuk meminta izin akses.</p>
                        <Link href="/login" className="mt-8 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl transition-colors shadow-lg shadow-blue-500/20">
                            Kembali ke Halaman Login
                        </Link>
                    </div>
                )}
            </div>

            <style>{`
                @keyframes fadeInUp {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            `}</style>
        </div>
    );
}
