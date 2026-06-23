import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import axios from 'axios';
import { Plus, Edit2, Trash2, X } from 'lucide-react';
import Swal from 'sweetalert2';

// Reusable Pane Component
const WilayahPane = ({ 
    title, 
    data, 
    loading, 
    onSearch, 
    onSelect, 
    selectedItem, 
    pagination, 
    onPageChange,
    displayKey,
    idKey,
    onAdd,
    onEdit,
    onDelete
}) => {
    return (
        <div className="snap-center flex-1 min-w-[85vw] sm:min-w-[300px] max-w-full md:max-w-[400px] bg-white/40 dark:bg-gray-800/40 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 shadow-xl rounded-2xl flex flex-col h-[600px] overflow-hidden transition-all duration-300">
            {/* Header */}
            <div className="p-4 border-b border-gray-200/50 dark:border-gray-700/50 bg-white/30 dark:bg-gray-800/30">
                <div className="flex justify-between items-center mb-3">
                    <h3 className="text-lg font-bold text-gray-800 dark:text-gray-100">{title}</h3>
                    {onAdd && (
                        <button onClick={onAdd} className="p-1.5 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg transition-colors shadow-sm" title={`Tambah ${title}`}>
                            <Plus size={16} />
                        </button>
                    )}
                </div>
                <div className="relative">
                    <input 
                        type="text" 
                        placeholder={`Cari ${title}...`}
                        onChange={(e) => onSearch(e.target.value)}
                        className="w-full bg-white/50 dark:bg-gray-900/50 border-0 rounded-xl px-4 py-2 text-sm text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 placeholder-gray-400"
                    />
                    {loading && (
                        <div className="absolute right-3 top-2.5">
                            <div className="animate-spin h-4 w-4 border-2 border-indigo-500 border-t-transparent rounded-full"></div>
                        </div>
                    )}
                </div>
            </div>

            {/* List */}
            <div className="flex-1 overflow-y-auto p-2 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600">
                {!loading && data.length === 0 ? (
                    <div className="p-4 text-center text-sm text-gray-500 italic">Data tidak ditemukan</div>
                ) : (
                    <ul className="space-y-1">
                        {data.map(item => {
                            const isSelected = selectedItem && selectedItem[idKey] === item[idKey];
                            return (
                                <li key={item[idKey]} className="relative group">
                                    <button
                                        onClick={() => onSelect(item)}
                                        className={`w-full text-left px-4 py-3 pr-16 rounded-xl text-sm font-medium transition-all duration-200 ${
                                            isSelected
                                                ? 'bg-indigo-500 text-white shadow-md'
                                                : 'text-gray-700 dark:text-gray-300 hover:bg-white/60 dark:hover:bg-gray-700/60'
                                        }`}
                                    >
                                        {item[displayKey]}
                                    </button>
                                    
                                    {/* Actions Hover (Only show if onEdit/onDelete exists) */}
                                    {onEdit && onDelete && (
                                        <div className="absolute right-2 top-1/2 -translate-y-1/2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button 
                                                onClick={(e) => { e.stopPropagation(); onEdit(item); }} 
                                                className={`p-1.5 rounded-md transition-colors ${isSelected ? 'text-white hover:bg-indigo-600' : 'text-indigo-500 hover:text-white hover:bg-indigo-500'}`}
                                            >
                                                <Edit2 size={14} />
                                            </button>
                                            <button 
                                                onClick={(e) => { e.stopPropagation(); onDelete(item); }} 
                                                className={`p-1.5 rounded-md transition-colors ${isSelected ? 'text-white hover:bg-red-600' : 'text-red-500 hover:text-white hover:bg-red-500'}`}
                                            >
                                                <Trash2 size={14} />
                                            </button>
                                        </div>
                                    )}
                                </li>
                            );
                        })}
                    </ul>
                )}
            </div>

            {/* Pagination */}
            {pagination && pagination.last_page > 1 && (
                <div className="p-3 border-t border-gray-200/50 dark:border-gray-700/50 bg-white/30 dark:bg-gray-800/30 flex justify-between items-center text-xs">
                    <button 
                        onClick={() => onPageChange(pagination.current_page - 1)}
                        disabled={pagination.current_page === 1}
                        className="px-3 py-1.5 rounded-lg bg-gray-200/50 dark:bg-gray-700/50 disabled:opacity-50 hover:bg-gray-300/50 dark:hover:bg-gray-600/50 transition-colors"
                    >
                        Prev
                    </button>
                    <span className="text-gray-600 dark:text-gray-400 font-medium">
                        {pagination.current_page} / {pagination.last_page}
                    </span>
                    <button 
                        onClick={() => onPageChange(pagination.current_page + 1)}
                        disabled={pagination.current_page === pagination.last_page}
                        className="px-3 py-1.5 rounded-lg bg-gray-200/50 dark:bg-gray-700/50 disabled:opacity-50 hover:bg-gray-300/50 dark:hover:bg-gray-600/50 transition-colors"
                    >
                        Next
                    </button>
                </div>
            )}
        </div>
    );
};

export default function Index({ auth, negaras }) {
    // 1. Negara
    const [selectedNegara, setSelectedNegara] = useState(null);

    // Refresh Tokens
    const [refreshProvinsi, setRefreshProvinsi] = useState(0);
    const [refreshKota, setRefreshKota] = useState(0);
    const [refreshKecamatan, setRefreshKecamatan] = useState(0);
    const [refreshKelurahan, setRefreshKelurahan] = useState(0);

    // 2. Provinsi
    const [provinsis, setProvinsis] = useState([]);
    const [provinsiLoading, setProvinsiLoading] = useState(false);
    const [provinsiPage, setProvinsiPage] = useState(1);
    const [provinsiSearch, setProvinsiSearch] = useState('');
    const [provinsiPagination, setProvinsiPagination] = useState(null);
    const [selectedProvinsi, setSelectedProvinsi] = useState(null);

    // 3. Kota
    const [kotas, setKotas] = useState([]);
    const [kotaLoading, setKotaLoading] = useState(false);
    const [kotaPage, setKotaPage] = useState(1);
    const [kotaSearch, setKotaSearch] = useState('');
    const [kotaPagination, setKotaPagination] = useState(null);
    const [selectedKota, setSelectedKota] = useState(null);

    // 4. Kecamatan
    const [kecamatans, setKecamatans] = useState([]);
    const [kecamatanLoading, setKecamatanLoading] = useState(false);
    const [kecamatanPage, setKecamatanPage] = useState(1);
    const [kecamatanSearch, setKecamatanSearch] = useState('');
    const [kecamatanPagination, setKecamatanPagination] = useState(null);
    const [selectedKecamatan, setSelectedKecamatan] = useState(null);

    // 5. Kelurahan
    const [kelurahans, setKelurahans] = useState([]);
    const [kelurahanLoading, setKelurahanLoading] = useState(false);
    const [kelurahanPage, setKelurahanPage] = useState(1);
    const [kelurahanSearch, setKelurahanSearch] = useState('');
    const [kelurahanPagination, setKelurahanPagination] = useState(null);
    const [selectedKelurahan, setSelectedKelurahan] = useState(null);

    // --- Modal State ---
    const [modalOpen, setModalOpen] = useState(false);
    const [modalMode, setModalMode] = useState('add'); // 'add' | 'edit'
    const [modalEntity, setModalEntity] = useState(''); // 'Provinsi', 'Kota', 'Kecamatan', 'Kelurahan'
    const [formData, setFormData] = useState({});
    const [isSaving, setIsSaving] = useState(false);

    // Config Entity untuk CRUD dinamis
    const entityConfig = {
        Provinsi: { url: '/admin/wilayah/api/provinsi', parentKey: 'negara_id', getParentId: () => selectedNegara?.id, codeKey: 'kode_provinsi', nameKey: 'nama_provinsi', hasKodepos: false, refresh: () => setRefreshProvinsi(prev => prev + 1) },
        Kota: { url: '/admin/wilayah/api/kota', parentKey: 'provinsi_id', getParentId: () => selectedProvinsi?.id, codeKey: 'kode_kota', nameKey: 'nama_kota', hasKodepos: false, refresh: () => setRefreshKota(prev => prev + 1) },
        Kecamatan: { url: '/admin/wilayah/api/kecamatan', parentKey: 'kota_id', getParentId: () => selectedKota?.id, codeKey: 'kode_kecamatan', nameKey: 'nama_kecamatan', hasKodepos: false, refresh: () => setRefreshKecamatan(prev => prev + 1) },
        Kelurahan: { url: '/admin/wilayah/api/kelurahan', parentKey: 'kecamatan_id', getParentId: () => selectedKecamatan?.id, codeKey: 'kode_kelurahan', nameKey: 'nama_kelurahan', hasKodepos: true, refresh: () => setRefreshKelurahan(prev => prev + 1) },
    };

    // Fetch Provinsis
    useEffect(() => {
        if (!selectedNegara) return;
        const fetchProvinsis = async () => {
            setProvinsiLoading(true);
            try {
                const res = await axios.get('/admin/wilayah/api/provinsi', {
                    params: { negara_id: selectedNegara.id, search: provinsiSearch, page: provinsiPage }
                });
                setProvinsis(res.data.data);
                setProvinsiPagination(res.data);
            } catch (e) { console.error(e); }
            setProvinsiLoading(false);
        };
        const timer = setTimeout(fetchProvinsis, 300); // Debounce
        return () => clearTimeout(timer);
    }, [selectedNegara, provinsiSearch, provinsiPage, refreshProvinsi]);

    // Fetch Kotas
    useEffect(() => {
        if (!selectedProvinsi) return;
        const fetchKotas = async () => {
            setKotaLoading(true);
            try {
                const res = await axios.get('/admin/wilayah/api/kota', {
                    params: { provinsi_id: selectedProvinsi.id, search: kotaSearch, page: kotaPage }
                });
                setKotas(res.data.data);
                setKotaPagination(res.data);
            } catch (e) { console.error(e); }
            setKotaLoading(false);
        };
        const timer = setTimeout(fetchKotas, 300);
        return () => clearTimeout(timer);
    }, [selectedProvinsi, kotaSearch, kotaPage, refreshKota]);

    // Fetch Kecamatans
    useEffect(() => {
        if (!selectedKota) return;
        const fetchKecamatans = async () => {
            setKecamatanLoading(true);
            try {
                const res = await axios.get('/admin/wilayah/api/kecamatan', {
                    params: { kota_id: selectedKota.id, search: kecamatanSearch, page: kecamatanPage }
                });
                setKecamatans(res.data.data);
                setKecamatanPagination(res.data);
            } catch (e) { console.error(e); }
            setKecamatanLoading(false);
        };
        const timer = setTimeout(fetchKecamatans, 300);
        return () => clearTimeout(timer);
    }, [selectedKota, kecamatanSearch, kecamatanPage, refreshKecamatan]);

    // Fetch Kelurahans
    useEffect(() => {
        if (!selectedKecamatan) return;
        const fetchKelurahans = async () => {
            setKelurahanLoading(true);
            try {
                const res = await axios.get('/admin/wilayah/api/kelurahan', {
                    params: { kecamatan_id: selectedKecamatan.id, search: kelurahanSearch, page: kelurahanPage }
                });
                setKelurahans(res.data.data);
                setKelurahanPagination(res.data);
            } catch (e) { console.error(e); }
            setKelurahanLoading(false);
        };
        const timer = setTimeout(fetchKelurahans, 300);
        return () => clearTimeout(timer);
    }, [selectedKecamatan, kelurahanSearch, kelurahanPage, refreshKelurahan]);


    // Handlers
    const handleNegaraSelect = (negara) => {
        setSelectedNegara(negara);
        setSelectedProvinsi(null);
        setSelectedKota(null);
        setSelectedKecamatan(null);
        setSelectedKelurahan(null);
        setProvinsiPage(1);
    };

    const handleProvinsiSelect = (prov) => {
        setSelectedProvinsi(prov);
        setSelectedKota(null);
        setSelectedKecamatan(null);
        setSelectedKelurahan(null);
        setKotaPage(1);
    };

    const handleKotaSelect = (kota) => {
        setSelectedKota(kota);
        setSelectedKecamatan(null);
        setSelectedKelurahan(null);
        setKecamatanPage(1);
    };

    const handleKecamatanSelect = (kec) => {
        setSelectedKecamatan(kec);
        setSelectedKelurahan(null);
        setKelurahanPage(1);
    };

    const handleKelurahanSelect = (kel) => {
        setSelectedKelurahan(kel);
    };

    // CRUD Handlers
    const openAddModal = (entity) => {
        setModalEntity(entity);
        setModalMode('add');
        setFormData({ is_active: true });
        setModalOpen(true);
    };

    const openEditModal = (entity, item) => {
        setModalEntity(entity);
        setModalMode('edit');
        setFormData({ ...item });
        setModalOpen(true);
    };

    const handleSave = async (e) => {
        e.preventDefault();
        const conf = entityConfig[modalEntity];
        const payload = { ...formData };
        
        if (modalMode === 'add') {
            payload[conf.parentKey] = conf.getParentId();
        }

        setIsSaving(true);
        try {
            if (modalMode === 'add') {
                await axios.post(conf.url, payload);
                Swal.fire({ icon: 'success', title: 'Berhasil', text: `${modalEntity} berhasil ditambahkan!`, timer: 1500, showConfirmButton: false });
            } else {
                await axios.put(`${conf.url}/${payload.id}`, payload);
                Swal.fire({ icon: 'success', title: 'Berhasil', text: `${modalEntity} berhasil diubah!`, timer: 1500, showConfirmButton: false });
            }
            conf.refresh();
            setModalOpen(false);
        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: error.response?.data?.message || 'Terjadi kesalahan sistem' });
        }
        setIsSaving(false);
    };

    const handleDelete = (entity, item) => {
        const conf = entityConfig[entity];
        Swal.fire({
            title: `Hapus ${entity}?`,
            text: `Anda yakin ingin menghapus ${item[conf.nameKey]}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    await axios.delete(`${conf.url}/${item.id}`);
                    Swal.fire({ icon: 'success', title: 'Terhapus', text: 'Data berhasil dihapus', timer: 1500, showConfirmButton: false });
                    conf.refresh();
                    
                    // Clear selection if deleting selected item
                    if (entity === 'Provinsi' && selectedProvinsi?.id === item.id) setSelectedProvinsi(null);
                    if (entity === 'Kota' && selectedKota?.id === item.id) setSelectedKota(null);
                    if (entity === 'Kecamatan' && selectedKecamatan?.id === item.id) setSelectedKecamatan(null);
                    if (entity === 'Kelurahan' && selectedKelurahan?.id === item.id) setSelectedKelurahan(null);
                    
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: error.response?.data?.message || 'Gagal menghapus data' });
                }
            }
        });
    };

    return (
        <DashboardLayout
            user={auth.user}
            header={<h2 className="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Master Data Wilayah</h2>}
        >
            <Head title="Master Wilayah" />

            <div className="py-8 h-[calc(100vh-80px)] relative">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full flex flex-col">
                    
                    {/* Top Alert / Instructions */}
                    <div className="mb-6 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border border-indigo-500/20 rounded-2xl p-4 shadow-sm backdrop-blur-md">
                        <div className="flex items-center">
                            <span className="text-2xl mr-3">🗺️</span>
                            <div>
                                <h3 className="text-lg font-bold text-indigo-700 dark:text-indigo-300">Penjelajah Wilayah (Cascading View)</h3>
                                <p className="text-sm text-indigo-600/80 dark:text-indigo-400/80">Silakan klik salah satu data untuk menampilkan turunan wilayah di kolom sebelahnya. Terdapat 80.000+ data yang telah diindeks untuk pencarian super cepat.</p>
                            </div>
                        </div>
                    </div>

                    {/* Horizontal Scroller for Panes */}
                    <div className="flex-1 overflow-x-auto overflow-y-hidden pb-4 scrollbar-thin scrollbar-thumb-indigo-500/50 scrollbar-track-transparent flex gap-4 md:gap-6 snap-x snap-mandatory px-1">
                        
                        {/* 1. Negara Pane (No CRUD for Negara in this module) */}
                        <WilayahPane 
                            title="Negara"
                            data={negaras}
                            loading={false}
                            onSearch={() => {}}
                            onSelect={handleNegaraSelect}
                            selectedItem={selectedNegara}
                            displayKey="nama_negara"
                            idKey="id"
                            pagination={null}
                        />

                        {/* 2. Provinsi Pane */}
                        {selectedNegara && (
                            <WilayahPane 
                                title="Provinsi"
                                data={provinsis}
                                loading={provinsiLoading}
                                onSearch={(val) => { setProvinsiSearch(val); setProvinsiPage(1); }}
                                onSelect={handleProvinsiSelect}
                                selectedItem={selectedProvinsi}
                                displayKey="nama_provinsi"
                                idKey="id"
                                pagination={provinsiPagination}
                                onPageChange={setProvinsiPage}
                                onAdd={() => openAddModal('Provinsi')}
                                onEdit={(item) => openEditModal('Provinsi', item)}
                                onDelete={(item) => handleDelete('Provinsi', item)}
                            />
                        )}

                        {/* 3. Kota Pane */}
                        {selectedProvinsi && (
                            <WilayahPane 
                                title="Kota/Kabupaten"
                                data={kotas}
                                loading={kotaLoading}
                                onSearch={(val) => { setKotaSearch(val); setKotaPage(1); }}
                                onSelect={handleKotaSelect}
                                selectedItem={selectedKota}
                                displayKey="nama_kota"
                                idKey="id"
                                pagination={kotaPagination}
                                onPageChange={setKotaPage}
                                onAdd={() => openAddModal('Kota')}
                                onEdit={(item) => openEditModal('Kota', item)}
                                onDelete={(item) => handleDelete('Kota', item)}
                            />
                        )}

                        {/* 4. Kecamatan Pane */}
                        {selectedKota && (
                            <WilayahPane 
                                title="Kecamatan"
                                data={kecamatans}
                                loading={kecamatanLoading}
                                onSearch={(val) => { setKecamatanSearch(val); setKecamatanPage(1); }}
                                onSelect={handleKecamatanSelect}
                                selectedItem={selectedKecamatan}
                                displayKey="nama_kecamatan"
                                idKey="id"
                                pagination={kecamatanPagination}
                                onPageChange={setKecamatanPage}
                                onAdd={() => openAddModal('Kecamatan')}
                                onEdit={(item) => openEditModal('Kecamatan', item)}
                                onDelete={(item) => handleDelete('Kecamatan', item)}
                            />
                        )}

                        {/* 5. Kelurahan Pane */}
                        {selectedKecamatan && (
                            <WilayahPane 
                                title="Kelurahan/Desa"
                                data={kelurahans}
                                loading={kelurahanLoading}
                                onSearch={(val) => { setKelurahanSearch(val); setKelurahanPage(1); }}
                                onSelect={handleKelurahanSelect}
                                selectedItem={selectedKelurahan}
                                displayKey="nama_kelurahan"
                                idKey="id"
                                pagination={kelurahanPagination}
                                onPageChange={setKelurahanPage}
                                onAdd={() => openAddModal('Kelurahan')}
                                onEdit={(item) => openEditModal('Kelurahan', item)}
                                onDelete={(item) => handleDelete('Kelurahan', item)}
                            />
                        )}

                    </div>

                </div>

                {/* --- MODAL FORM --- */}
                {modalOpen && (
                    <div className="absolute inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
                        <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-white/20 dark:border-gray-700/50">
                            <div className="flex justify-between items-center p-4 border-b border-gray-100 dark:border-gray-700">
                                <h3 className="text-lg font-bold text-gray-800 dark:text-gray-100">
                                    {modalMode === 'add' ? 'Tambah' : 'Ubah'} {modalEntity}
                                </h3>
                                <button onClick={() => setModalOpen(false)} className="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                                    <X size={20} />
                                </button>
                            </div>
                            
                            <form onSubmit={handleSave} className="p-4 space-y-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Kode {modalEntity}
                                    </label>
                                    <input 
                                        type="text" 
                                        required
                                        value={formData[entityConfig[modalEntity]?.codeKey] || ''}
                                        onChange={(e) => setFormData({...formData, [entityConfig[modalEntity]?.codeKey]: e.target.value})}
                                        className="w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 text-sm text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500"
                                        placeholder={`Masukkan Kode...`}
                                    />
                                </div>
                                
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Nama {modalEntity}
                                    </label>
                                    <input 
                                        type="text" 
                                        required
                                        value={formData[entityConfig[modalEntity]?.nameKey] || ''}
                                        onChange={(e) => setFormData({...formData, [entityConfig[modalEntity]?.nameKey]: e.target.value})}
                                        className="w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 text-sm text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500"
                                        placeholder={`Masukkan Nama...`}
                                    />
                                </div>

                                {entityConfig[modalEntity]?.hasKodepos && (
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Kodepos
                                        </label>
                                        <input 
                                            type="text" 
                                            value={formData.kodepos || ''}
                                            onChange={(e) => setFormData({...formData, kodepos: e.target.value})}
                                            className="w-full bg-gray-50 dark:bg-gray-900/50 border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2 text-sm text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500"
                                            placeholder={`Masukkan Kodepos...`}
                                        />
                                    </div>
                                )}

                                <div className="flex items-center mt-2">
                                    <input 
                                        type="checkbox" 
                                        id="is_active"
                                        checked={formData.is_active || false}
                                        onChange={(e) => setFormData({...formData, is_active: e.target.checked})}
                                        className="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    />
                                    <label htmlFor="is_active" className="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        Aktif
                                    </label>
                                </div>

                                <div className="pt-4 flex justify-end gap-2">
                                    <button 
                                        type="button" 
                                        onClick={() => setModalOpen(false)}
                                        className="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-xl transition-colors"
                                    >
                                        Batal
                                    </button>
                                    <button 
                                        type="submit" 
                                        disabled={isSaving}
                                        className="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-colors disabled:opacity-50 flex items-center"
                                    >
                                        {isSaving ? 'Menyimpan...' : 'Simpan'}
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
