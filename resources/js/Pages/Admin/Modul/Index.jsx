import React, { useState, useEffect } from 'react';
import { usePage, router, Head, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit2, Trash2, Save, X, Check } from 'lucide-react';
import Select from 'react-select';


export default function ModulIndex() {
    const { moduls, modulars, filters } = usePage().props;
    const [search, setSearch] = useState(filters?.search || '');
    const [isFormOpen, setIsFormOpen] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({
        id_dc_modular: '',
        nama_modul: '',
        folder: '',
        logo: '',
        kode_bagian: '',
        no_urut: '',
        status_modul: '1'
    });
    
    const [sortItems, setSortItems] = useState(moduls.data || []);
    const [isSorting, setIsSorting] = useState(false);

    useEffect(() => {
        setSortItems(moduls.data || []);
    }, [moduls]);

    const modularOptions = modulars.map(m => ({
        value: m.id_dc_modular,
        label: m.nama_modular
    }));

    const customSelectStyles = {
        control: (base) => ({
            ...base,
            backgroundColor: 'rgba(255, 255, 255, 0.05)',
            borderColor: 'rgba(255, 255, 255, 0.2)',
            color: 'white',
        }),
        singleValue: (base) => ({ ...base, color: 'white' }),
        menu: (base) => ({
            ...base,
            backgroundColor: '#1f2937',
            zIndex: 9999
        }),
        option: (base, state) => ({
            ...base,
            backgroundColor: state.isFocused ? '#374151' : 'transparent',
            color: 'white',
            '&:hover': {
                backgroundColor: '#374151'
            }
        })
    };

    const handleSearch = (e) => {
        const val = e.target.value;
        setSearch(val);
        router.get('/admin/modul', { search: val }, { preserveState: true, replace: true });
    };

    const handleEdit = (item) => {
        setEditingId(item.id_dc_modul);
        setFormData({
            id_dc_modular: item.id_dc_modular || '',
            nama_modul: item.nama_modul || '',
            folder: item.folder || '',
            logo: item.logo || '',
            kode_bagian: item.kode_bagian || '',
            no_urut: item.no_urut || '',
            status_modul: item.status_modul || '1'
        });
        setIsFormOpen(true);
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus modul ini?')) {
            router.delete(`/admin/modul/${id}`);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editingId) {
            router.put(`/admin/modul/${editingId}`, formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                    setEditingId(null);
                }
            });
        } else {
            router.post('/admin/modul', formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                }
            });
        }
    };

    const resetForm = () => {
        setEditingId(null);
        setFormData({
            id_dc_modular: '',
            nama_modul: '',
            folder: '',
            logo: '',
            kode_bagian: '',
            no_urut: '',
            status_modul: '1'
        });
        setIsFormOpen(false);
    };

    const handleSortChange = (idx, value) => {
        const newItems = [...sortItems];
        newItems[idx].no_urut = value;
        setSortItems(newItems);
        setIsSorting(true);
    };

    const saveSort = () => {
        const payload = sortItems.map(item => ({
            id: item.id_dc_modul,
            no_urut: item.no_urut || 0
        }));

        router.post('/admin/modul/sort', { items: payload }, {
            onSuccess: () => setIsSorting(false)
        });
    };

    return (
        <DashboardLayout>
            <Head title="Konfigurasi Modul" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Konfigurasi Modul</h1>
                        <p>Kelola master data modul aplikasi</p>
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
                            <span>Tambah Modul</span>
                        </button>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ marginBottom: '1rem' }}>
                        <div className="search-input-wrapper flex-1 max-w-md">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                placeholder="Cari nama modul / folder..."
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
                                    <th>Kelompok Modul</th>
                                    <th>Nama Modul</th>
                                    <th>Folder</th>
                                    <th>Icon (Logo)</th>
                                    <th style={{ width: '120px', textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {sortItems.length > 0 ? sortItems.map((item, index) => (
                                    <tr key={item.id_dc_modul}>
                                        <td style={{ textAlign: 'center' }}>
                                            {(moduls.current_page - 1) * moduls.per_page + index + 1}
                                        </td>
                                        <td style={{ textAlign: 'center' }}>
                                            <input 
                                                type="number" 
                                                className="premium-input"
                                                style={{ width: '80px', textAlign: 'center', padding: '4px' }}
                                                value={item.no_urut || ''} 
                                                onChange={(e) => handleSortChange(index, e.target.value)} 
                                            />
                                        </td>
                                        <td>
                                            <span className="badge bg-secondary">{item.modular?.nama_modular}</span>
                                        </td>
                                        <td>
                                            <strong>{item.nama_modul}</strong>
                                        </td>
                                        <td>{item.folder}</td>
                                        <td>{item.logo}</td>
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
                                                    onClick={() => handleDelete(item.id_dc_modul)}
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
                                        <td colSpan="7" style={{ textAlign: 'center', padding: '2rem' }}>
                                            Data modul tidak ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {moduls.links && moduls.links.length > 3 && (
                    <div className="pagination">
                        {moduls.links.map((link, index) => {
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
                    <div className="glass-panel w-full max-w-2xl p-6 max-h-[90vh] overflow-y-auto">
                        <div className="flex justify-between items-center mb-5">
                            <h3 className="text-lg font-semibold text-gray-800">
                                {editingId ? 'Edit Modul' : 'Tambah Modul'}
                            </h3>
                            <button onClick={resetForm} className="dash-icon-btn">
                                <X size={24} />
                            </button>
                        </div>
                        <form onSubmit={handleSubmit}>
                            <div className="grid-form">
                                <div>
                                    <label className="form-label">
                                        Kelompok Modul <span className="text-red-500">*</span>
                                    </label>
                                    <Select
                                        options={modularOptions}
                                        styles={customSelectStyles}
                                        placeholder="Pilih Kelompok Modul..."
                                        value={modularOptions.find(opt => opt.value === formData.id_dc_modular)}
                                        onChange={(opt) => setFormData({...formData, id_dc_modular: opt ? opt.value : ''})}
                                        isClearable
                                    />
                                </div>

                                <div>
                                    <label className="form-label">
                                        Nama Modul <span className="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        className="premium-input" 
                                        required 
                                        value={formData.nama_modul}
                                        onChange={(e) => setFormData({...formData, nama_modul: e.target.value})}
                                    />
                                </div>
                                    
                                <div className="grid-2-cols">
                                    <div>
                                        <label className="form-label">Folder / Path URL</label>
                                        <input 
                                            type="text" 
                                            className="premium-input" 
                                            value={formData.folder}
                                            onChange={(e) => setFormData({...formData, folder: e.target.value})}
                                            placeholder="e.g., ../mod_kasir/"
                                        />
                                    </div>
                                    <div>
                                        <label className="form-label">URL Icon (Gambar)</label>
                                        <input 
                                            type="text" 
                                            className="premium-input" 
                                            value={formData.logo}
                                            onChange={(e) => setFormData({...formData, logo: e.target.value})}
                                            placeholder="e.g., /assets/icon.png"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label className="form-label">No. Urut</label>
                                    <input 
                                        type="number" 
                                        className="premium-input" 
                                        value={formData.no_urut}
                                        onChange={(e) => setFormData({...formData, no_urut: e.target.value})}
                                    />
                                </div>
                            </div>

                            <div className="flex justify-end gap-2 mt-5">
                                <button type="button" onClick={resetForm} className="dash-btn secondary">
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    disabled={!formData.id_dc_modular || !formData.nama_modul}
                                    className="dash-btn primary flex items-center gap-2"
                                >
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
