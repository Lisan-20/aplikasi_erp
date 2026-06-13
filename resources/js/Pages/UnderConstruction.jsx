import React from 'react';
import { Head } from '@inertiajs/react';
import Dashboard from './Dashboard';
import { Settings, Hammer } from 'lucide-react';

export default function UnderConstruction({ module_name, menus }) {
    return (
        <Dashboard module_name={module_name} menus={menus}>
            <Head title="Dalam Perbaikan - Medilink RS" />
            
            <div className="dash-welcome glass-panel flex flex-col items-center justify-center text-center py-20" style={{ minHeight: '60vh' }}>
                <div className="relative mb-6">
                    <Settings size={80} className="text-blue-500 opacity-20 animate-spin" style={{ animationDuration: '4s' }} />
                    <Hammer size={40} className="text-blue-400 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" />
                </div>
                
                <h1 className="text-3xl font-bold mb-4" style={{ background: 'linear-gradient(135deg, #fff, #3b82f6)', WebkitBackgroundClip: 'text', WebkitTextFillColor: 'transparent' }}>
                    Menu Dalam Tahap Migrasi
                </h1>
                
                <p className="text-gray-400 max-w-lg mb-8 text-lg">
                    Menu ini sedang dibangun ulang oleh tim pengembang kami ke dalam teknologi antarmuka Glassmorphism yang baru.
                    Silakan gunakan menu lain yang telah tersedia.
                </p>
                
                <div className="flex gap-4">
                    <div className="px-4 py-2 rounded-lg bg-blue-500/10 border border-blue-500/30 text-blue-300 flex items-center gap-2">
                        <span className="relative flex h-3 w-3">
                            <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span className="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                        </span>
                        Tahap Pengembangan
                    </div>
                </div>
            </div>
        </Dashboard>
    );
}
