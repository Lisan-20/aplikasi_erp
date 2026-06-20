import React, { useState, useEffect } from 'react';
import { usePage, router, Head, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit2, Trash2, Save, X, Check } from 'lucide-react';
import Select from 'react-select';


export default function SubMenuIndex() {
    const { submenus, moduls, menus, filters } = usePage().props;
    const [search, setSearch] = useState(filters?.search || '');
    const [filterModul, setFilterModul] = useState(filters?.id_dc_modul || '');
    const [filterMenu, setFilterMenu] = useState(filters?.id_dc_menu || '');
    
    const [isFormOpen, setIsFormOpen] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({
        id_dc_menu: '',
        nama_sub_menu: '',
        url_sub_menu: '',
        url_sub_menu_baru: '',
        keterangan: '',
        summary: '',
        no_urut: '',
        status_sub_menu: '1'
    });
    
    const [sortItems, setSortItems] = useState(submenus.data || []);
    const [isSorting, setIsSorting] = useState(false);

    useEffect(() => {
        setSortItems(submenus.data || []);
    }, [submenus]);

    const modulOptions = moduls.map(m => ({
        value: m.id_dc_modul,
        label: m.nama_modul
    }));

    const menuOptions = menus
        .filter(m => !filterModul || filterModul === '' || m.id_dc_modul == filterModul)
        .map(m => ({
            value: m.id_dc_menu,
            label: m.nama_menu
        }));

    const formMenuOptions = menus.map(m => {
        const modul = moduls.find(mod => mod.id_dc_modul === m.id_dc_modul);
        return {
            value: m.id_dc_menu,
            label: `${modul?.nama_modul || 'Unknown'} - ${m.nama_menu}`
        }
    });

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
        router.get('/admin/submenu', { search: val, id_dc_modul: filterModul, id_dc_menu: filterMenu }, { preserveState: true, replace: true });
    };

    const handleFilterModulChange = (opt) => {
        const val = opt ? opt.value : '';
        setFilterModul(val);
        setFilterMenu('');
        router.get('/admin/submenu', { search, id_dc_modul: val, id_dc_menu: '' }, { preserveState: true, replace: true });
    };

    const handleFilterMenuChange = (opt) => {
        const val = opt ? opt.value : '';
        setFilterMenu(val);
        router.get('/admin/submenu', { search, id_dc_modul: filterModul, id_dc_menu: val }, { preserveState: true, replace: true });
    };

    const handleEdit = (item) => {
        setEditingId(item.id_dc_sub_menu);
        setFormData({
            id_dc_menu: item.id_dc_menu || '',
            nama_sub_menu: item.nama_sub_menu || '',
            url_sub_menu: item.url_sub_menu || '',
            url_sub_menu_baru: item.url_sub_menu_baru || '',
            keterangan: item.keterangan || '',
            summary: item.summary || '',
            no_urut: item.no_urut || '',
            status_sub_menu: item.status_sub_menu || '1'
        });
        setIsFormOpen(true);
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus sub menu ini?')) {
            router.delete(`/admin/submenu/${id}`);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editingId) {
            router.put(`/admin/submenu/${editingId}`, formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                    setEditingId(null);
                }
            });
        } else {
            router.post('/admin/submenu', formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                }
            });
        }
    };

    const resetForm = () => {
        setEditingId(null);
        setFormData({
            id_dc_menu: '',
            nama_sub_menu: '',
            url_sub_menu: '',
            url_sub_menu_baru: '',
            keterangan: '',
            summary: '',
            no_urut: '',
            status_sub_menu: '1'
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
            id: item.id_dc_sub_menu,
            no_urut: item.no_urut || 0
        }));

        router.post('/admin/submenu/sort', { items: payload }, {
            onSuccess: () => setIsSorting(false)
        });
    };

    return (
        <DashboardLayout>
            <Head title="Konfigurasi Sub Menu" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Konfigurasi Sub Menu</h1>
                        <p>Kelola master data sub menu navigasi sistem</p>
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
                            <span>Tambah Sub Menu</span>
                        </button>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ marginBottom: '1rem', flexWrap: 'wrap', gap: '10px' }}>
                        <div className="search-input-wrapper flex-1 max-w-md">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                placeholder="Cari nama sub menu..."
                                value={search}
                                onChange={handleSearch}
                                className="search-input"
                            />
                        </div>
                        <div style={{ width: '200px' }}>
                            <Select
                                options={modulOptions}
                                styles={customSelectStyles}
                                placeholder="Semua Modul..."
                                value={modulOptions.find(opt => opt.value == filterModul)}
                                onChange={handleFilterModulChange}
                                isClearable
                            />
                        </div>
                        <div style={{ width: '200px' }}>
                            <Select
                                options={menuOptions}
                                styles={customSelectStyles}
                                placeholder="Semua Menu..."
                                value={menuOptions.find(opt => opt.value == filterMenu)}
                                onChange={handleFilterMenuChange}
                                isClearable
                            />
                        </div>
                    </div>

                    <div className="dash-table">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                    <th style={{ width: '100px', textAlign: 'center' }}>No. Urut</th>
                                    <th>Hirarki</th>
                                    <th>Sub Menu</th>
                                    <th>URL Lama (PHP)</th>
                                    <th>URL Baru (React)</th>
                                    <th>Keterangan</th>
                                    <th style={{ width: '120px', textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {sortItems.length > 0 ? sortItems.map((item, index) => (
                                    <tr key={item.id_dc_sub_menu}>
                                        <td style={{ textAlign: 'center' }}>
                                            {(submenus.current_page - 1) * submenus.per_page + index + 1}
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
                                            <div><span className="badge bg-primary mb-1">{item.menu?.modul?.nama_modul}</span></div>
                                            <div><span className="badge bg-secondary">{item.menu?.nama_menu}</span></div>
                                        </td>
                                        <td><strong>{item.nama_sub_menu}</strong></td>
                                        <td className="text-muted" style={{maxWidth: '150px', wordBreak: 'break-all'}}><small>{item.url_sub_menu || '-'}</small></td>
                                        <td className="text-success" style={{maxWidth: '150px', wordBreak: 'break-all'}}><small className="font-bold">{item.url_sub_menu_baru || '-'}</small></td>
                                        <td><small>{item.summary || item.keterangan || '-'}</small></td>
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
                                                    onClick={() => handleDelete(item.id_dc_sub_menu)}
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
                                        <td colSpan="8" style={{ textAlign: 'center', padding: '2rem' }}>
                                            Data sub menu tidak ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {submenus.links && submenus.links.length > 3 && (
                    <div className="pagination">
                        {submenus.links.map((link, index) => {
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
                                {editingId ? 'Edit Sub Menu' : 'Tambah Sub Menu'}
                            </h3>
                            <button onClick={resetForm} className="dash-icon-btn">
                                <X size={24} />
                            </button>
                        </div>
                        <form onSubmit={handleSubmit}>
                            <div className="grid-form">
                                <div>
                                    <label className="form-label">
                                        Menu Induk <span className="text-red-500">*</span>
                                    </label>
                                    <Select
                                        options={formMenuOptions}
                                        styles={customSelectStyles}
                                        placeholder="Pilih Menu Induk..."
                                        value={formMenuOptions.find(opt => opt.value === formData.id_dc_menu)}
                                        onChange={(opt) => setFormData({...formData, id_dc_menu: opt ? opt.value : ''})}
                                        isClearable
                                    />
                                </div>

                                <div className="grid-2-cols">
                                    <div>
                                        <label className="form-label">
                                            Nama Sub Menu <span className="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            className="premium-input" 
                                            required 
                                            value={formData.nama_sub_menu}
                                            onChange={(e) => setFormData({...formData, nama_sub_menu: e.target.value})}
                                        />
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
                                
                                <div className="p-4 rounded-lg bg-orange-500/10 border border-orange-500/30">
                                    <h6 className="text-orange-500 font-semibold mb-3">Konfigurasi URL / Navigasi</h6>
                                    
                                    <div className="mb-3">
                                        <label className="form-label">URL Baru (React/Inertia)</label>
                                        <input 
                                            type="text" 
                                            className="premium-input border-green-500/50 text-green-600 dark:text-green-400" 
                                            value={formData.url_sub_menu_baru}
                                            onChange={(e) => setFormData({...formData, url_sub_menu_baru: e.target.value})}
                                            placeholder="e.g., /admin/user atau /registrasi/pasien-baru"
                                        />
                                        <span className="text-xs text-slate-500 mt-1 block">
                                            Gunakan URL relatif (dengan awalan slash `/`). URL ini diprioritaskan oleh sistem baru.
                                        </span>
                                    </div>

                                    <div>
                                        <label className="form-label">URL Lama (PHP Legacy)</label>
                                        <input 
                                            type="text" 
                                            className="premium-input" 
                                            value={formData.url_sub_menu}
                                            onChange={(e) => setFormData({...formData, url_sub_menu: e.target.value})}
                                            placeholder="e.g., ../mod_kasir/pendaftaran.php"
                                        />
                                        <span className="text-xs text-slate-500 mt-1 block">
                                            Hanya digunakan jika URL Baru kosong. Sistem akan membukanya melalui iFrame.
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label className="form-label">Keterangan / Deskripsi</label>
                                    <textarea 
                                        className="premium-input" 
                                        rows="2"
                                        value={formData.summary}
                                        onChange={(e) => setFormData({...formData, summary: e.target.value})}
                                        placeholder="Penjelasan singkat mengenai fitur sub menu ini..."
                                    />
                                </div>
                            </div>

                            <div className="flex justify-end gap-2 mt-5">
                                <button type="button" onClick={resetForm} className="dash-btn secondary">
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    disabled={!formData.id_dc_menu || !formData.nama_sub_menu}
                                    className="dash-btn primary flex items-center gap-2"
                                >
                                    <Check size={18} /> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
