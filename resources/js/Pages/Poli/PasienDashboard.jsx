import React from 'react';
import { Head, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { User, Activity, FileText, Pill, Stethoscope, RefreshCcw, Settings, Calendar } from 'lucide-react';


export default function PasienDashboard({ patient, activeTab, children }) {
    const tabs = [
        { id: 'data_umum', label: 'Data Umum', icon: User, url: '#' },
        { id: 'riwayat_medis', label: 'Riwayat Medis', icon: Activity, url: '#' },
        { id: 'tindakan', label: 'Tindakan', icon: Stethoscope, url: `/poli/pasien/${patient.kode_poli}/tindakan` },
        { id: 'obat_ruangan', label: 'Obat Ruangan', icon: Calendar, url: '#' },
        { id: 'input_resep', label: 'Input Resep', icon: FileText, url: `/poli/pasien/${patient.kode_poli}/farmasi` },
        { id: 'penunjang_medis', label: 'Penunjang Medis', icon: Activity, url: '#' },
        { id: 'edit_nasabah', label: 'Edit Nasabah', icon: User, url: '#' },
    ];

    return (
        <DashboardLayout>
            <Head title={`Pasien Poli - ${patient.nama_pasien}`} />
            
            <div className="pl-container" style={{ padding: '20px', display: 'flex', flexDirection: 'column', gap: '20px' }}>
                
                {/* Header Pasien (Identity) */}
                <div className="pl-header glass-panel" style={{ display: 'flex', flexDirection: 'column', padding: '20px' }}>
                    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '15px' }}>
                        <div>
                            <h2 style={{ margin: 0, color: '#1e293b', fontSize: '1.5rem', fontWeight: 'bold', display: 'flex', alignItems: 'center', gap: '10px' }}>
                                <User style={{ color: '#3b82f6', width: '28px', height: '28px' }} />
                                {patient.nama_pasien}
                            </h2>
                            <p style={{ margin: '5px 0 0', color: '#64748b', fontSize: '1rem' }}>
                                Poli {patient.nm_poli} &bull; {patient.nama_dokter}
                            </p>
                        </div>
                        <div style={{ textAlign: 'right' }}>
                            <div style={{ fontSize: '1.1rem', fontWeight: 'bold', color: '#334155' }}>
                                MR: {patient.no_mr}
                            </div>
                            <div style={{ fontSize: '0.95rem', color: '#10b981', fontWeight: 'bold' }}>
                                Reg: {patient.no_registrasi}
                            </div>
                        </div>
                    </div>

                    <div style={{ display: 'flex', gap: '20px', padding: '15px', backgroundColor: 'rgba(241, 245, 249, 0.7)', borderRadius: '8px', flexWrap: 'wrap' }}>
                        <div style={{ flex: 1, minWidth: '150px' }}>
                            <span style={{ fontSize: '0.85rem', color: '#64748b', display: 'block' }}>Jenis Kelamin</span>
                            <strong style={{ color: '#334155' }}>{patient.jen_kelamin}</strong>
                        </div>
                        <div style={{ flex: 1, minWidth: '150px' }}>
                            <span style={{ fontSize: '0.85rem', color: '#64748b', display: 'block' }}>Umur</span>
                            <strong style={{ color: '#334155' }}>{patient.umur} Tahun</strong>
                        </div>
                        <div style={{ flex: 1, minWidth: '150px' }}>
                            <span style={{ fontSize: '0.85rem', color: '#64748b', display: 'block' }}>Golongan Darah</span>
                            <strong style={{ color: '#334155' }}>{patient.gol_darah || '-'}</strong>
                        </div>
                        <div style={{ flex: 2, minWidth: '250px' }}>
                            <span style={{ fontSize: '0.85rem', color: '#64748b', display: 'block' }}>Nasabah / Penanggung</span>
                            <strong style={{ color: '#334155' }}>{patient.nm_nasabah}</strong>
                        </div>
                    </div>
                </div>

                {/* Tabs Navigation */}
                <div className="glass-panel" style={{ padding: '0', overflow: 'hidden' }}>
                    <div style={{ display: 'flex', borderBottom: '1px solid #e2e8f0', overflowX: 'auto', backgroundColor: '#f8fafc' }}>
                        {tabs.map((tab) => {
                            const isActive = activeTab === tab.id;
                            const Icon = tab.icon;
                            return (
                                <Link
                                    key={tab.id}
                                    href={tab.url}
                                    style={{
                                        display: 'flex',
                                        alignItems: 'center',
                                        gap: '8px',
                                        padding: '16px 20px',
                                        color: isActive ? '#3b82f6' : '#64748b',
                                        borderBottom: isActive ? '3px solid #3b82f6' : '3px solid transparent',
                                        backgroundColor: isActive ? '#ffffff' : 'transparent',
                                        fontWeight: isActive ? '600' : '500',
                                        textDecoration: 'none',
                                        whiteSpace: 'nowrap',
                                        transition: 'all 0.2s',
                                        cursor: tab.url === '#' ? 'not-allowed' : 'pointer'
                                    }}
                                    onClick={(e) => {
                                        if (tab.url === '#') {
                                            e.preventDefault();
                                            alert('Modul ini sedang dalam tahap migrasi ke React.');
                                        }
                                    }}
                                >
                                    <Icon style={{ width: '18px', height: '18px' }} />
                                    {tab.label}
                                </Link>
                            );
                        })}
                    </div>
                </div>

                {/* Main Content Area */}
                <div style={{ flex: 1, display: 'flex', flexDirection: 'column', minHeight: 0 }}>
                    {children}
                </div>

            </div>
        </DashboardLayout>
    );
}
