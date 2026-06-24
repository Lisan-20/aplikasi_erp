import React, { useState } from 'react';
import { useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function BagianIndex({ bagian, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isEdit, setIsEdit] = useState(false);
    const [editId, setEditId] = useState(null);

    const { data, setData, post, put, delete: destroy, processing, errors, reset, clearErrors } = useForm({
        kode_bagian: '',
        nama_bagian: '',
        group_bag: 'Detail',
        status_aktif: '1',
    });

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/admin/bagian', { search }, { preserveState: true });
    };

    const openModal = (item = null) => {
        clearErrors();
        if (item) {
            setIsEdit(true);
            setEditId(item.kode_bagian);
            setData({
                kode_bagian: item.kode_bagian || '',
                nama_bagian: item.nama_bagian || '',
                group_bag: item.group_bag || 'Detail',
                status_aktif: item.status_aktif?.toString() || '1',
            });
        } else {
            setIsEdit(false);
            setEditId(null);
            reset();
        }
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        reset();
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (isEdit) {
            put(`/admin/bagian/${editId}`, {
                onSuccess: () => closeModal(),
            });
        } else {
            post('/admin/bagian', {
                onSuccess: () => closeModal(),
            });
        }
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menonaktifkan bagian ini?')) {
            destroy(`/admin/bagian/${id}`);
        }
    };

    return (
        <DashboardLayout title="Master Bagian">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header & Search */}
                <div className="pl-header glass-panel p-4 flex flex-col md:flex-row justify-between items-center gap-4 rounded-xl">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 dark:text-white">Master Bagian</h1>
                        <p className="text-sm text-gray-500 dark:text-gray-400">Kelola daftar departemen dan unit kerja</p>
                    </div>
                    <div className="flex gap-2 w-full md:w-auto">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full">
                            <input 
                                type="text" 
                                placeholder="Cari nama atau kode..." 
                                className="premium-input w-full md:w-64"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                            <button type="submit" className="btn-secondary px-4 py-2 rounded-lg">Cari</button>
                        </form>
                        <button 
                            onClick={() => openModal()} 
                            className="btn-primary px-4 py-2 rounded-lg whitespace-nowrap"
                        >
                            + Tambah
                        </button>
                    </div>
                </div>

                {/* Table Data */}
                <div className="glass-panel table-wrap flex-1 overflow-hidden rounded-xl flex flex-col">
                    <div className="overflow-x-auto w-full">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Kode</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Nama Bagian</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Grup / Tipe</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-center">Status</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {bagian.data.map((item) => (
                                    <tr key={item.kode_bagian} className="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td className="p-3 text-sm text-gray-800 dark:text-gray-200">{item.kode_bagian}</td>
                                        <td className="p-3 text-sm font-medium text-gray-900 dark:text-white">{item.nama_bagian}</td>
                                        <td className="p-3 text-sm text-gray-600 dark:text-gray-400">{item.group_bag}</td>
                                        <td className="p-3 text-sm text-center">
                                            {item.status_aktif == 1 ? (
                                                <span className="px-2 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full text-xs">Aktif</span>
                                            ) : (
                                                <span className="px-2 py-1 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 rounded-full text-xs">Nonaktif</span>
                                            )}
                                        </td>
                                        <td className="p-3 text-sm text-center whitespace-nowrap">
                                            <button onClick={() => openModal(item)} className="text-blue-500 hover:text-blue-700 mr-3">Edit</button>
                                            <button onClick={() => handleDelete(item.kode_bagian)} className="text-red-500 hover:text-red-700">Nonaktifkan</button>
                                        </td>
                                    </tr>
                                ))}
                                {bagian.data.length === 0 && (
                                    <tr>
                                        <td colSpan="5" className="p-8 text-center text-gray-500">Data tidak ditemukan.</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                    {/* Pagination */}
                    <div className="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                        <span className="text-sm text-gray-600 dark:text-gray-400">
                            Menampilkan {bagian.from || 0} - {bagian.to || 0} dari {bagian.total} data
                        </span>
                        <div className="flex gap-1">
                            {bagian.links.map((link, idx) => (
                                <button
                                    key={idx}
                                    onClick={() => link.url && router.get(link.url)}
                                    disabled={!link.url}
                                    className={`px-3 py-1 text-sm rounded ${link.active ? 'bg-blue-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600'} disabled:opacity-50`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                </div>

            </div>

            {/* Modal Input */}
            {isModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                    <div className="glass-panel w-full max-w-md p-6 rounded-2xl shadow-2xl m-4 relative overflow-y-auto max-h-[90vh]">
                        <h2 className="text-xl font-bold mb-4 text-gray-800 dark:text-white">
                            {isEdit ? 'Edit Bagian' : 'Tambah Bagian Baru'}
                        </h2>
                        
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Bagian</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full" 
                                    value={data.kode_bagian} 
                                    onChange={e => setData('kode_bagian', e.target.value)} 
                                    disabled={isEdit}
                                    placeholder="e.g., 010101"
                                />
                                {errors.kode_bagian && <p className="text-red-500 text-xs mt-1">{errors.kode_bagian}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Bagian</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full" 
                                    value={data.nama_bagian} 
                                    onChange={e => setData('nama_bagian', e.target.value)} 
                                    placeholder="e.g., Keuangan, HRD, dll"
                                />
                                {errors.nama_bagian && <p className="text-red-500 text-xs mt-1">{errors.nama_bagian}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grup / Tipe</label>
                                <select 
                                    className="premium-input w-full" 
                                    value={data.group_bag} 
                                    onChange={e => setData('group_bag', e.target.value)}
                                >
                                    <option value="Group">Group</option>
                                    <option value="Detail">Detail</option>
                                </select>
                                {errors.group_bag && <p className="text-red-500 text-xs mt-1">{errors.group_bag}</p>}
                            </div>

                            {isEdit && (
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                    <select 
                                        className="premium-input w-full" 
                                        value={data.status_aktif} 
                                        onChange={e => setData('status_aktif', e.target.value)}
                                    >
                                        <option value="1">Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                    {errors.status_aktif && <p className="text-red-500 text-xs mt-1">{errors.status_aktif}</p>}
                                </div>
                            )}

                            <div className="flex justify-end gap-2 mt-4">
                                <button 
                                    type="button" 
                                    onClick={closeModal} 
                                    className="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg transition-colors"
                                >
                                    Batal
                                </button>
                                <button 
                                    type="submit" 
                                    disabled={processing}
                                    className="btn-primary px-4 py-2 text-sm font-medium rounded-lg disabled:opacity-50"
                                >
                                    {processing ? 'Menyimpan...' : 'Simpan'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
