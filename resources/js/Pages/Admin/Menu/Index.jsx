import React, { useState, useEffect } from 'react';
import { usePage, router, Head, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit2, Trash2, Save, X, Check } from 'lucide-react';
import Select from 'react-select';


export default function MenuIndex() {
    const { menus, moduls, filters } = usePage().props;
    const [search, setSearch] = useState(filters?.search || '');
    const [filterModul, setFilterModul] = useState(filters?.id_dc_modul || '');
    
    const [isFormOpen, setIsFormOpen] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [formData, setFormData] = useState({
        id_dc_modul: '',
        nama_menu: '',
        url: '',
        no_urut: '',
        status_menu: '1',
        flag_not: ''
    });
    
    const [sortItems, setSortItems] = useState(menus.data || []);
    const [isSorting, setIsSorting] = useState(false);

    useEffect(() => {
        setSortItems(menus.data || []);
    }, [menus]);

    const modulOptions = moduls.map(m => ({
        value: m.id_dc_modul,
        label: m.nama_modul
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
        router.get('/admin/menu', { search: val, id_dc_modul: filterModul }, { preserveState: true, replace: true });
    };

    const handleFilterModulChange = (opt) => {
        const val = opt ? opt.value : '';
        setFilterModul(val);
        router.get('/admin/menu', { search, id_dc_modul: val }, { preserveState: true, replace: true });
    };

    const handleEdit = (item) => {
        setEditingId(item.id_dc_menu);
        setFormData({
            id_dc_modul: item.id_dc_modul || '',
            nama_menu: item.nama_menu || '',
            url: item.url || '',
            no_urut: item.no_urut || '',
            status_menu: item.status_menu || '1',
            flag_not: item.flag_not || ''
        });
        setIsFormOpen(true);
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus menu ini? (Pastikan tidak ada sub menu di dalamnya)')) {
            router.delete(`/admin/menu/${id}`);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editingId) {
            router.put(`/admin/menu/${editingId}`, formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                    setEditingId(null);
                }
            });
        } else {
            router.post('/admin/menu', formData, {
                onSuccess: () => {
                    setIsFormOpen(false);
                }
            });
        }
    };

    const resetForm = () => {
        setEditingId(null);
        setFormData({
            id_dc_modul: '',
            nama_menu: '',
            url: '',
            no_urut: '',
            status_menu: '1',
            flag_not: ''
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
            id: item.id_dc_menu,
            no_urut: item.no_urut || 0
        }));

        router.post('/admin/menu/sort', { items: payload }, {
            onSuccess: () => setIsSorting(false)
        });
    };

    return (
        <DashboardLayout>
            <Head title="Konfigurasi Menu" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Konfigurasi Menu</h1>
                        <p>Kelola master data menu utama aplikasi</p>
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
                            <span>Tambah Menu</span>
                        </button>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar" style={{ marginBottom: '1rem', flexWrap: 'wrap', gap: '10px' }}>
                        <div className="search-input-wrapper flex-1 max-w-md">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                placeholder="Cari nama menu..."
                                value={search}
                                onChange={handleSearch}
                                className="search-input"
                            />
                        </div>
                        <div style={{ width: '250px' }}>
                            <Select
                                options={modulOptions}
                                styles={customSelectStyles}
                                placeholder="Filter Modul..."
                                value={modulOptions.find(opt => opt.value == filterModul)}
                                onChange={handleFilterModulChange}
                                isClearable
                            />
                        </div>
                    </div>

                    <div className="overflow-x-auto w-full">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '60px', textAlign: 'center' }}>No</th>
                                    <th style={{ width: '100px', textAlign: 'center' }}>No. Urut</th>
                                    <th>Modul</th>
                                    <th>Nama Menu</th>
                                    <th style={{ width: '120px', textAlign: 'center' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {sortItems.length > 0 ? sortItems.map((item, index) => (
                                    <tr key={item.id_dc_menu}>
                                        <td style={{ textAlign: 'center' }}>
                                            {(menus.current_page - 1) * menus.per_page + index + 1}
                                        </td>
                                        <td style={{ textAlign: 'center' }}>
                                            <input 
                                                type="number" 
                                                className="w-16 px-2 py-1 text-center border border-slate-300 dark:border-slate-700 rounded-md bg-white dark:bg-slate-800 text-slate-900 dark:text-white"
                                                value={item.no_urut || ''} 
                                                onChange={(e) => handleSortChange(index, e.target.value)} 
                                            />
                                        </td>
                                        <td><span className="badge bg-primary">{item.modul?.nama_modul}</span></td>
                                        <td><strong>{item.nama_menu}</strong></td>
                                        <td style={{ textAlign: 'center', whiteSpace: 'nowrap' }}>
                                            <div style={{ display: 'flex', gap: '8px', justifyContent: 'center' }}>
                                                <button
                                                    onClick={() => handleEdit(item)}
                                                    className="dash-btn secondary"
                                                    style={{ padding: '6px', border: 'none', color: '#3b82f6' }}
                                                    title="Edit"
                                                >
                                                    <Edit2 size={16} />
                                                </button>
                                                <button
                                                    onClick={() => handleDelete(item.id_dc_menu)}
                                                    className="dash-btn secondary"
                                                    style={{ padding: '6px', border: 'none', color: '#ef4444' }}
                                                    title="Hapus"
                                                >
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                )) : (
                                    <tr>
                                        <td colSpan="6" style={{ textAlign: 'center', padding: '2rem' }}>
                                            Data menu tidak ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {menus.links && menus.links.length > 3 && (
                    <div className="pagination">
                        {menus.links.map((link, index) => {
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
                <div style={{
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
                    backgroundColor: 'rgba(0,0,0,0.5)', zIndex: 9999,
                    display: 'flex', justifyContent: 'center', alignItems: 'center'
                }}>
                    <div className="glass-panel" style={{
                        width: '100%', maxWidth: '600px', 
                        borderRadius: '12px', padding: '20px', boxShadow: '0 10px 25px rgba(0,0,0,0.2)'
                    }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
                            <h3 style={{ margin: 0, color: 'var(--text-color)' }}>
                                {editingId ? 'Edit Menu' : 'Tambah Menu'}
                            </h3>
                            <button onClick={resetForm} style={{ background: 'none', border: 'none', cursor: 'pointer', color: 'var(--text-muted)' }}>
                                <X size={24} />
                            </button>
                        </div>
                        <form onSubmit={handleSubmit} style={{ overflowY: 'auto' }}>
                            <div style={{ marginBottom: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>
                                    Modul <span style={{color: '#ef4444'}}>*</span>
                                </label>
                                <Select
                                    options={modulOptions}
                                    styles={customSelectStyles}
                                    placeholder="Pilih Modul..."
                                    value={modulOptions.find(opt => opt.value === formData.id_dc_modul)}
                                    onChange={(opt) => setFormData({...formData, id_dc_modul: opt ? opt.value : ''})}
                                    isClearable
                                />
                            </div>

                            <div style={{ marginBottom: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>
                                    Nama Menu <span style={{color: '#ef4444'}}>*</span>
                                </label>
                                <input 
                                    type="text" 
                                    className="premium-input" 
                                    required 
                                    value={formData.nama_menu}
                                    onChange={(e) => setFormData({...formData, nama_menu: e.target.value})}
                                />
                            </div>
                                
                            <div style={{ marginBottom: '20px' }}>
                                <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>
                                    No. Urut
                                </label>
                                <input 
                                    type="number" 
                                    className="premium-input" 
                                    value={formData.no_urut}
                                    onChange={(e) => setFormData({...formData, no_urut: e.target.value})}
                                />
                            </div>

                            <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '10px' }}>
                                <button
                                    type="button"
                                    onClick={resetForm}
                                    className="dash-btn secondary"
                                >
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    disabled={!formData.id_dc_modul || !formData.nama_menu}
                                    className="dash-btn primary"
                                    style={{ display: 'flex', alignItems: 'center', gap: '8px' }}
                                >
                                    <Check size={16} />
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
