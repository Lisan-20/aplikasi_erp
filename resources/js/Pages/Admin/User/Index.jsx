import React, { useState } from 'react';
import { Head, router, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit, Trash2 } from 'lucide-react';
import Swal from 'sweetalert2';
import FormModal from './FormModal';

export default function Index({ users, groups, filters }) {
    const [searchType, setSearchType] = useState(filters?.tipeCari || 'nama');
    const [searchQuery, setSearchQuery] = useState(filters?.filter || '');

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [selectedUser, setSelectedUser] = useState(null);

    const handleSearch = (e) => {
        e.preventDefault();
        router.get(
            '/admin/user',
            { tipeCari: searchType, filter: searchQuery },
            { preserveState: true }
        );
    };

    const handleDelete = (user) => {
        Swal.fire({
            title: 'Hapus Pengguna?',
            text: `Yakin ingin menghapus ${user.username}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(`/admin/user/${user.id_dd_user}`, {
                    onSuccess: () => {
                        Swal.fire('Terhapus!', 'Pengguna berhasil dihapus.', 'success');
                    }
                });
            }
        });
    };

    const openAddModal = () => {
        setSelectedUser(null);
        setIsModalOpen(true);
    };

    const openEditModal = (user) => {
        setSelectedUser(user);
        setIsModalOpen(true);
    };

    return (
        <DashboardLayout>
            <Head title="Manajemen Pengguna" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel" style={{ marginBottom: '20px', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                    <div className="pl-title">
                        <h1 style={{ margin: 0, fontSize: '1.5rem', fontWeight: 'bold' }}>Manajemen Pengguna</h1>
                        <p style={{ margin: 0, color: 'var(--text-muted)' }}>Kelola data pengguna, grup, dan akses sistem</p>
                    </div>
                    <button className="dash-btn primary" onClick={openAddModal} style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                        <Plus size={18} /> Tambah User
                    </button>
                </div>

                <div className="glass-panel table-wrap">
                    <form onSubmit={handleSearch} className="search-bar" style={{ display: 'flex', gap: '15px', alignItems: 'flex-end', marginBottom: '20px' }}>
                        <div style={{ flex: '1' }}>
                            <label style={{ display: 'block', marginBottom: '8px', color: 'var(--text-muted)' }}>Cari Berdasarkan</label>
                            <select 
                                className="premium-input" 
                                value={searchType} 
                                onChange={(e) => setSearchType(e.target.value)}
                                style={{ width: '100%', padding: '10px', borderRadius: '8px', border: '1px solid rgba(0,0,0,0.1)' }}
                            >
                                <option value="nama">Nama Pegawai</option>
                                <option value="nama_group">Grup User</option>
                                <option value="id">User ID</option>
                            </select>
                        </div>
                        <div style={{ flex: '2' }}>
                            <label style={{ display: 'block', marginBottom: '8px', color: 'var(--text-muted)' }}>Kata Kunci</label>
                            <div className="search-input-wrapper" style={{ margin: 0, display: 'flex', width: '100%', position: 'relative' }}>
                                <Search size={18} style={{ position: 'absolute', left: '10px', top: '50%', transform: 'translateY(-50%)', color: 'var(--text-muted)' }} />
                                <input 
                                    type="text" 
                                    className="premium-input" 
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                    placeholder="Ketik kata kunci pencarian..."
                                    style={{ width: '100%', padding: '10px 10px 10px 35px', borderRadius: '8px', border: '1px solid rgba(0,0,0,0.1)' }}
                                />
                            </div>
                        </div>
                        <button type="submit" className="dash-btn primary" style={{ padding: '10px 20px', display: 'flex', alignItems: 'center', gap: '8px', height: '42px' }}>
                            Cari
                        </button>
                    </form>

                    <div className="dash-table">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User ID</th>
                                    <th>Nama Pegawai</th>
                                    <th>Bagian</th>
                                    <th>Group User</th>
                                    <th>Status</th>
                                    <th style={{ textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {users.data.map((user, index) => (
                                    <tr key={user.id_dd_user}>
                                        <td>{users.from + index}</td>
                                        <td><strong>{user.username}</strong></td>
                                        <td>{user.nama_pegawai}</td>
                                        <td>{user.nama_bagian}</td>
                                        <td>{user.nama_group}</td>
                                        <td>
                                            <span style={{ 
                                                padding: '4px 8px', 
                                                borderRadius: '4px', 
                                                fontSize: '0.85rem',
                                                background: user.status == 0 ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)',
                                                color: user.status == 0 ? '#10b981' : '#ef4444'
                                            }}>
                                                {user.status == 0 ? 'Aktif' : 'Tidak Aktif'}
                                            </span>
                                        </td>
                                        <td style={{ textAlign: 'center' }}>
                                            <div style={{ display: 'flex', gap: '8px', justifyContent: 'center' }}>
                                                <button onClick={() => openEditModal(user)} className="dash-btn secondary" style={{ padding: '6px', border: 'none', color: '#3b82f6' }} title="Edit">
                                                    <Edit size={16} />
                                                </button>
                                                <button onClick={() => handleDelete(user)} className="dash-btn secondary" style={{ padding: '6px', border: 'none', color: '#ef4444' }} title="Hapus">
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                                {users.data.length === 0 && (
                                    <tr>
                                        <td colSpan="7" style={{ textAlign: 'center', padding: '20px' }}>Data pengguna tidak ditemukan.</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {users.links && users.links.length > 3 && (
                    <div className="pagination" style={{ marginTop: '20px', display: 'flex', gap: '5px', justifyContent: 'center' }}>
                        {users.links.map((link, idx) => (
                            <Link
                                key={idx}
                                href={link.url || '#'}
                                className={`dash-btn ${link.active ? 'primary' : 'secondary'}`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                                style={{
                                    opacity: link.url ? 1 : 0.5,
                                    pointerEvents: link.url ? 'auto' : 'none',
                                    padding: '5px 12px'
                                }}
                            />
                        ))}
                    </div>
                )}
            </div>

            <FormModal 
                isOpen={isModalOpen} 
                onClose={() => setIsModalOpen(false)} 
                user={selectedUser} 
                groups={groups}
            />
        </DashboardLayout>
    );
}
