import React, { useState, useEffect } from 'react';
import { usePage, router, Head, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit2, Trash2, Save, X, Check } from 'lucide-react';


export default function ModularIndex() {
    const { modulars, filters } = usePage().props;
    const [search, setSearch] = useState(filters?.search || '');
    const [isFormOpen, setIsFormOpen] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({
        nama_modular: '',
        kd_modular: '',
        no_urut_modular: ''
    });
    
    const [sortItems, setSortItems] = useState(modulars.data || []);
    const [isSorting, setIsSorting] = useState(false);

    useEffect(() => {
        setSortItems(modulars.data || []);
    }, [modulars]);

    const handleSearch = (e) => {
        const val = e.target.value;
        setSearch(val);
        router.get('/admin/modular', { search: val }, { preserveState: true, replace: true });
    };

    const handleEdit = (item) => {
        setEditingId(item.id_dc_modular);
        setFormData({
            nama_modular: item.nama_modular || '',
            kd_modular: item.kd_modular || '',
            no_urut_modular: item.no_urut_modular || ''
        });
        setIsFormOpen(true);
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus kelompok modul ini?')) {
            router.delete(`/admin/modular/${id}`);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editingId) {
            router.put(`/admin/modular/${editingId}`, formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                    setEditingId(null);
                }
            });
        } else {
            router.post('/admin/modular', formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                }
            });
        }
    };

    const resetForm = () => {
        setEditingId(null);
        setFormData({
            nama_modular: '',
            kd_modular: '',
            no_urut_modular: ''
        });
        setIsFormOpen(false);
    };

    const handleSortChange = (idx, value) => {
        const newItems = [...sortItems];
        newItems[idx].no_urut_modular = value;
        setSortItems(newItems);
        setIsSorting(true);
    };

    const saveSort = () => {
        const payload = sortItems.map(item => ({
            id: item.id_dc_modular,
            no_urut: item.no_urut_modular || 0
        }));

        router.post('/admin/modular/sort', { items: payload }, {
            onSuccess: () => setIsSorting(false)
        });
    };

    return (
        <DashboardLayout>
            <Head title="Konfigurasi Kelompok Modul" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Konfigurasi Kelompok Modul (Modular)</h1>
                        <p>Kelola master data kelompok modul aplikasi</p>
                    </div>
                    <div className="pl-actions flex gap-2">
                        {isSorting && (
                            <button className="dash-btn primary" onClick={saveSort}>
                                <Save size={18} />
                                <span>Simpan Urutan</span>
                            </button>
                        )}
                        <button className="dash-btn primary" onClick={() => { resetForm(); setIsFormOpen(true); }}>
                            <Plus size={18} />
                            <span>Tambah Kelompok</span>
                        </button>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ marginBottom: '1rem' }}>
                        <div className="search-input-wrapper flex-1 max-w-md">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                placeholder="Cari nama / kode..."
                                value={search}
                                onChange={handleSearch}
                                className="search-input"
                            />
                        </div>
                    </div>

                    <div className="dash-table">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                    <th style={{ width: '100px', textAlign: 'center' }}>No. Urut</th>
                                    <th>Nama Kelompok Modul</th>
                                    <th>Kode Modular</th>
                                    <th style={{ width: '120px', textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {sortItems.length > 0 ? sortItems.map((item, index) => (
                                    <tr key={item.id_dc_modular}>
                                        <td style={{ textAlign: 'center' }}>
                                            {(modulars.current_page - 1) * modulars.per_page + index + 1}
                                        </td>
                                        <td style={{ textAlign: 'center' }}>
                                            <input 
                                                type="number" 
                                                className="premium-input"
                                                style={{ width: '80px', textAlign: 'center', padding: '4px' }}
                                                value={item.no_urut_modular || ''} 
                                                onChange={(e) => handleSortChange(index, e.target.value)} 
                                            />
                                        </td>
                                        <td>
                                            <strong>{item.nama_modular}</strong>
                                        </td>
                                        <td>{item.kd_modular || '-'}</td>
                                        <td style={{ textAlign: 'center', whiteSpace: 'nowrap' }}>
                                            <div style={{ display: 'flex', gap: '8px', justifyContent: 'center' }}>
                                                <button
                                                    onClick={() => handleEdit(item)}
                                                    className="dash-btn secondary"
                                                    title="Edit"
                                                >
                                                    <Edit2 size={16} />
                                                </button>
                                                <button
                                                    onClick={() => handleDelete(item.id_dc_modular)}
                                                    className="dash-btn danger"
                                                    title="Hapus"
                                                >
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                )) : (
                                    <tr>
                                        <td colSpan="5" style={{ textAlign: 'center', padding: '2rem' }}>
                                            Data kelompok modul tidak ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {modulars.links && modulars.links.length > 3 && (
                    <div className="pagination">
                        {modulars.links.map((link, index) => {
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
            </div>

            {/* Modal Form */}
            {isFormOpen && (
                <div className="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex justify-center items-center">
                    <div className="glass-panel w-full max-w-lg p-6">
                        <div className="flex justify-between items-center mb-5">
                            <h3 className="text-lg font-semibold text-gray-800">
                                {editingId ? 'Edit Kelompok Modul' : 'Tambah Kelompok Modul'}
                            </h3>
                            <button onClick={resetForm} className="dash-icon-btn">
                                <X size={24} />
                            </button>
                        </div>
                        <form onSubmit={handleSubmit}>
                            <div className="grid-form">
                                <div>
                                    <label className="form-label">
                                        Nama Kelompok Modul <span className="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        required 
                                        value={formData.nama_modular}
                                        onChange={(e) => setFormData({...formData, nama_modular: e.target.value})}
                                    />
                                </div>
                                <div>
                                    <label className="form-label">
                                        Kode Modular (Opsional)
                                    </label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        value={formData.kd_modular}
                                        onChange={(e) => setFormData({...formData, kd_modular: e.target.value})}
                                    />
                                </div>
                                <div>
                                    <label className="form-label">
                                        No. Urut (Opsional)
                                    </label>
                                    <input 
                                        type="number" 
                                        className="premium-input" 
                                        value={formData.no_urut_modular}
                                        onChange={(e) => setFormData({...formData, no_urut_modular: e.target.value})}
                                    />
                                </div>
                            </div>
                            
                            <div className="flex justify-end gap-2 mt-5">
                                <button type="button" onClick={resetForm} className="dash-btn secondary">
                                    Batal
                                </button>
                                <button type="submit" className="dash-btn primary flex items-center gap-2">
                                    <Check size={18} /> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
