import React from 'react';
import { Head } from '@inertiajs/react';
import { Activity, Users } from 'lucide-react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function Dashboard() {
    return (
        <DashboardLayout>
            <Head title="Dashboard - Medilink RS" />
            
            <div className="dash-welcome glass-panel">
                <h1>Selamat Datang di Modul Sistem</h1>
                <p>Silakan gunakan menu navigasi di sebelah kiri untuk mengakses fitur yang tersedia dalam modul ini.</p>
            </div>

            <div className="dash-widgets">
                <div className="dash-widget glass-panel">
                    <Activity size={32} className="widget-icon primary" />
                    <h3>Status Sistem</h3>
                    <p>Sistem berjalan optimal. Semua layanan terhubung.</p>
                </div>
                <div className="dash-widget glass-panel">
                    <Users size={32} className="widget-icon success" />
                    <h3>Sesi Pengguna</h3>
                    <p>Anda login dengan hak akses modul saat ini.</p>
                </div>
            </div>
        </DashboardLayout>
    );
}

