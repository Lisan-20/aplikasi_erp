import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { RefreshCw, Server, Users } from 'lucide-react';

export default function BelajarApi() {
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    // Fungsi ini akan dieksekusi secara rahasia di latar belakang
    const fetchUsersFromNode = async () => {
        setLoading(true);
        setError(null);
        try {
            // Kita langsung "menembak" ke Node.js di port 3000
            const response = await fetch('http://localhost:3000/api/users');
            
            if (!response.ok) {
                throw new Error(`Server Node.js menolak: ${response.status}`);
            }
            
            const result = await response.json();
            setUsers(result.data); // Menyimpan data JSON ke memori React
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    // useEffect dengan array kosong [] berarti ini otomatis berjalan saat halaman dibuka
    useEffect(() => {
        fetchUsersFromNode();
    }, []);

    return (
        <DashboardLayout title="Eksperimen API">
            <Head title="Belajar REST API Node.js" />
            
            <div className="pl-header glass-panel">
                <h2 className="pl-title">
                    <Server className="pl-title-icon" />
                    Latihan Konsumsi REST API
                </h2>
                <p className="pl-subtitle">Halaman ini menarik data dari server Node.js secara independen (Bypass Laravel Controller)</p>
            </div>

            <div className="glass-panel" style={{ padding: '20px', marginTop: '20px' }}>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
                    <h3 style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
                        <Users size={20}/>
                        Data Pengguna (Dari Node.js Port 3000)
                    </h3>
                    
                    <button 
                        onClick={fetchUsersFromNode}
                        disabled={loading}
                        className="btn-primary"
                        style={{ display: 'flex', gap: '8px', alignItems: 'center' }}
                    >
                        <RefreshCw size={16} className={loading ? "spin" : ""} />
                        Muat Ulang API
                    </button>
                </div>

                {error && (
                    <div style={{ padding: '15px', background: 'rgba(239, 68, 68, 0.2)', color: '#f87171', borderRadius: '8px', marginBottom: '20px' }}>
                        <strong>Gagal Mengambil API:</strong> {error}
                        <br/>(Pastikan server Node.js Anda berjalan di terminal lain dengan perintah `npm run dev`)
                    </div>
                )}

                <div className="table-wrap">
                    <table className="pl-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            {loading && users.length === 0 ? (
                                <tr>
                                    <td colSpan="3" style={{ textAlign: 'center', padding: '20px' }}>Sedang mengambil data dari Node.js...</td>
                                </tr>
                            ) : users.length === 0 ? (
                                <tr>
                                    <td colSpan="3" style={{ textAlign: 'center', padding: '20px' }}>Tidak ada data</td>
                                </tr>
                            ) : (
                                users.map((user) => (
                                    <tr key={user.id_dd_user}>
                                        <td>{user.id_dd_user}</td>
                                        <td>{user.nama_lengkap}</td>
                                        <td><span className="badge badge-secondary">{user.username}</span></td>
                                    </tr>
                                ))
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
            
            {/* CSS tambahan untuk animasi loading */}
            <style dangerouslySetInnerHTML={{__html: `
                @keyframes spin { 100% { transform: rotate(360deg); } }
                .spin { animation: spin 1s linear infinite; }
            `}} />
        </DashboardLayout>
    );
}
