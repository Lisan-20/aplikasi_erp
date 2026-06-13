import React from 'react';
import { Head, Link, router, usePage } from '@inertiajs/react';
import {
    Activity, Users, Settings, Database, HeartPulse, Building,
    Stethoscope, ArrowRight, Shield, FileText, PlusCircle,
    Search, Heart
} from 'lucide-react';
import '../../css/module-selection.css';

// Helper to map module names to specific icons based on keywords
const getModuleIcon = (name) => {
    const lower = name.toLowerCase();
    if (lower.includes('admin') || lower.includes('setting')) return <Settings size={24} />;
    if (lower.includes('pasien') || lower.includes('pendaftaran')) return <Users size={24} />;
    if (lower.includes('rekam medis') || lower.includes('rm')) return <FileText size={24} />;
    if (lower.includes('apotek') || lower.includes('farmasi')) return <PlusCircle size={24} />;
    if (lower.includes('lab')) return <Search size={24} />;
    if (lower.includes('ugd') || lower.includes('igd') || lower.includes('darurat')) return <Activity size={24} />;
    if (lower.includes('poli') || lower.includes('klinik')) return <Stethoscope size={24} />;
    if (lower.includes('rawat inap') || lower.includes('bangsal')) return <Building size={24} />;
    if (lower.includes('kasir') || lower.includes('keuangan') || lower.includes('billing')) return <Database size={24} />;
    if (lower.includes('asuransi') || lower.includes('bpjs')) return <Shield size={24} />;
    if (lower.includes('icu') || lower.includes('operasi')) return <Heart size={24} />;

    // Default fallback
    return <HeartPulse size={24} />;
};

export default function ModuleSelection({ modulars = [] }) {
    const { auth } = usePage().props;
    // Fallback if auth is not available
    const user = auth?.user || { name: 'User' };

    const handleModuleClick = (id_dc_modul) => {
        router.post(`/modul/${id_dc_modul}/enter`);
    };

    return (
        <div className="ms-container">
            <Head title="Pilih Modul - Medilink RS" />

            {/* ===== FIXED HEADER - tidak bergerak saat scroll ===== */}
            <div style={{
                position: 'fixed',
                top: 0,
                left: 0,
                right: 0,
                zIndex: 999,
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'space-between',
                padding: '12px 32px',
                background: 'rgba(15, 23, 42, 0.85)',
                backdropFilter: 'blur(12px)',
                borderBottom: '1px solid rgba(255,255,255,0.08)',
                boxShadow: '0 4px 24px rgba(0,0,0,0.3)'
            }}>
                <div>
                    <h2 style={{ margin: 0, fontSize: '1.2rem', fontWeight: 700, color: '#fff' }}>
                        Selamat Datang, {user.username || user.name || 'User'}
                    </h2>
                    <p style={{ margin: 0, fontSize: '0.8rem', color: 'rgba(255,255,255,0.5)' }}>
                        Silakan pilih modul aplikasi yang ingin Anda akses
                    </p>
                </div>
                <a href="/logout" style={{
                    display: 'flex',
                    alignItems: 'center',
                    gap: '8px',
                    padding: '8px 20px',
                    background: 'linear-gradient(to right, #dc2626, #ef4444)',
                    color: '#fff',
                    borderRadius: '10px',
                    fontWeight: 600,
                    fontSize: '0.875rem',
                    textDecoration: 'none',
                    boxShadow: '0 4px 14px rgba(220,38,38,0.35)',
                    transition: 'all 0.2s'
                }}>
                    <svg style={{ width: '16px', height: '16px', flexShrink: 0 }} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </a>
            </div>

            <div className="ms-glow ms-glow-1"></div>
            <div className="ms-glow ms-glow-2"></div>

            <div className="ms-content" style={{ paddingTop: '80px' }}>

                {modulars.map((modular, mIdx) => (
                    <div
                        key={modular.id_dc_modular}
                        className="ms-modular-section"
                        style={{ animationDelay: `${mIdx * 0.15}s` }}
                    >
                        <h2 className="ms-modular-title">
                            <Activity size={20} className="text-primary" />
                            {modular.nama_modular}
                        </h2>

                        <div className="ms-grid">
                            {modular.modules.map((mod, idx) => (
                                <div
                                    key={mod.id_dc_modul}
                                    className="ms-card"
                                    onClick={() => handleModuleClick(mod.id_dc_modul)}
                                >
                                    <div className="ms-card-icon">
                                        {getModuleIcon(mod.nama_modul)}
                                    </div>
                                    <h3 className="ms-card-title">{mod.nama_modul}</h3>
                                    <div className="ms-card-footer">
                                        <span>Akses Modul</span>
                                        <ArrowRight size={18} className="ms-card-arrow" />
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                ))}

                {modulars.length === 0 && (
                    <div className="text-center text-gray-400 mt-10">
                        <p>Tidak ada modul yang tersedia atau Anda tidak memiliki akses.</p>
                        <Link href="/login" className="text-blue-400 hover:underline mt-4 inline-block">Kembali ke Login</Link>
                    </div>
                )}
            </div>
        </div>
    );
}
