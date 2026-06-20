import React, { useState } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit2, Trash2, X, Check, ArrowLeft } from 'lucide-react';


export default function PrivilegesIndex({ groups, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.filter || '');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalMode, setModalMode] = useState('add'); // 'add' or 'edit'

    const { data, setData, post, put, delete: destroy, processing, reset, errors } = useForm({
        id_dd_user_group: '',
        nama_group: '',
        keterangan: '',
    });

    const handleSearch = (e) => {
        setSearchTerm(e.target.value);
        router.get('/admin/privileges', { filter: e.target.value }, {
            preserveState: true,
            replace: true,
        });
    };

    const openAddModal = () => {
        setModalMode('add');
        reset();
        setIsModalOpen(true);
    };

    const openEditModal = (group) => {
        setModalMode('edit');
        setData({
            id_dd_user_group: group.id_dd_user_group,
            nama_group: group.nama_group,
            keterangan: group.keterangan || '',
        });
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        reset();
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (modalMode === 'add') {
            post('/admin/privileges', {
                onSuccess: () => closeModal(),
            });
        } else {
            put(`/admin/privileges/${data.id_dd_user_group}`, {
                onSuccess: () => closeModal(),
            });
        }
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus Group User ini?')) {
            destroy(`/admin/privileges/${id}`);
        }
    };

    return (
        <DashboardLayout>
            <Head title="Admin - Group User" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Group User & Privileges</h1>
                        <p>Manajemen hak akses untuk setiap group pengguna</p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        <Link href="/admin/privileges" className="dash-btn primary">
                            Group User
                        </Link>
                        <Link href="/admin/privileges/matrix" className="dash-btn secondary">
                            Group Privileges
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ marginBottom: '1rem' }}>
                        <div className="search-input-wrapper flex-1 max-w-md">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                placeholder="Cari Group User..."
                                value={searchTerm}
                                onChange={handleSearch}
                                className="search-input"
                            />
                        </div>
                        <button
                            onClick={openAddModal}
                            className="dash-btn primary"
                        >
                            <Plus size={18} />
                            <span>Tambah Group User</span>
                        </button>
                    </div>

                    <div className="dash-table">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                    <th>Nama Group</th>
                                    <th>Keterangan</th>
                                    <th style={{ width: '120px', textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {groups.data.length > 0 ? (
                                    groups.data.map((group, index) => (
                                        <tr key={group.id_dd_user_group}>
                                            <td style={{ textAlign: 'center' }}>
                                                {groups.from + index}
                                            </td>
                                            <td>
                                                <strong>{group.nama_group}</strong>
                                            </td>
                                            <td>
                                                {group.keterangan || '-'}
                                            </td>
                                            <td style={{ textAlign: 'center', whiteSpace: 'nowrap' }}>
                                                <button
                                                    onClick={() => openEditModal(group)}
                                                    className="dash-btn secondary"
                                                    style={{ padding: '0.35rem 0.5rem', marginRight: '4px' }}
                                                    title="Edit"
                                                >
                                                    <Edit2 size={14} />
                                                </button>
                                                <button
                                                    onClick={() => handleDelete(group.id_dd_user_group)}
                                                    className="dash-btn secondary"
                                                    style={{ padding: '0.35rem 0.5rem', color: '#ef4444', borderColor: '#fee2e2' }}
                                                    title="Hapus"
                                                >
                                                    <Trash2 size={14} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="4" style={{ textAlign: 'center', padding: '2rem' }}>
                                            Tidak ada data group user ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {groups.links && groups.links.length > 3 && (
                    <div className="pagination">
                        {groups.links.map((link, index) => {
                            let label = link.label;
                            if (label.includes('Previous')) label = '«';
                            if (label.includes('Next')) label = '»';
                            
                            return link.url ? (
                                <Link
                                    key={index}
                                    href={link.url}
                                    className={`page-link ${link.active ? 'active' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: label }}
                                />
                            ) : (
                                <span
                                    key={index}
                                    className="page-link disabled"
                                    dangerouslySetInnerHTML={{ __html: label }}
                                />
                            );
                        })}
                    </div>
                )}

                {/* Modal */}
                {isModalOpen && (
                    <div style={{
                        position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
                        backgroundColor: 'rgba(0,0,0,0.5)', zIndex: 9999,
                        display: 'flex', justifyContent: 'center', alignItems: 'center'
                    }}>
                        <div className="glass-panel" style={{
                            width: '100%', maxWidth: '500px', 
                            borderRadius: '12px', padding: '20px', boxShadow: '0 10px 25px rgba(0,0,0,0.2)'
                        }}>
                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
                                <h3 style={{ margin: 0, color: 'var(--text-color)' }}>
                                    {modalMode === 'add' ? 'Tambah Group User' : 'Edit Group User'}
                                </h3>
                                <button onClick={closeModal} style={{ background: 'none', border: 'none', cursor: 'pointer', color: 'var(--text-muted)' }}>
                                    <X size={24} />
                                </button>
                            </div>
                            <form onSubmit={handleSubmit}>
                                <div style={{ marginBottom: '15px' }}>
                                    <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>
                                        Nama Group <span style={{color: '#ef4444'}}>*</span>
                                    </label>
                                    <input
                                        type="text"
                                        value={data.nama_group}
                                        onChange={e => setData('nama_group', e.target.value)}
                                        className="premium-input"
                                        required
                                    />
                                    {errors.nama_group && <div style={{ color: '#ef4444', fontSize: '0.8rem', marginTop: '5px' }}>{errors.nama_group}</div>}
                                </div>
                                <div style={{ marginBottom: '20px' }}>
                                    <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>
                                        Keterangan
                                    </label>
                                    <textarea
                                        value={data.keterangan}
                                        onChange={e => setData('keterangan', e.target.value)}
                                        rows="3"
                                        className="premium-input"
                                    />
                                    {errors.keterangan && <div style={{ color: '#ef4444', fontSize: '0.8rem', marginTop: '5px' }}>{errors.keterangan}</div>}
                                </div>
                                <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '10px' }}>
                                    <button
                                        type="button"
                                        onClick={closeModal}
                                        className="dash-btn secondary"
                                        disabled={processing}
                                    >
                                        Batal
                                    </button>
                                    <button
                                        type="submit"
                                        className="dash-btn primary"
                                        style={{ display: 'flex', alignItems: 'center', gap: '8px' }}
                                        disabled={processing}
                                    >
                                        <Check size={16} />
                                        {processing ? 'Menyimpan...' : 'Simpan'}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                )}

            </div>
        </DashboardLayout>
    );
}
