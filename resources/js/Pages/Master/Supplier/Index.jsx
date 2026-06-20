import React, { useState } from 'react';
import { useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function SupplierIndex({ suppliers, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isEdit, setIsEdit] = useState(false);
    const [editId, setEditId] = useState(null);

    const { data, setData, post, put, delete: destroy, processing, errors, reset, clearErrors } = useForm({
        kodesupplier: '',
        namasupplier: '',
        alamat: '',
        telpon1: '',
        kontakperson: '',
    });

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/master/supplier', { search }, { preserveState: true });
    };

    const openModal = (supplier = null) => {
        clearErrors();
        if (supplier) {
            setIsEdit(true);
            setEditId(supplier.id_mt_supplier);
            setData({
                kodesupplier: supplier.kodesupplier || '',
                namasupplier: supplier.namasupplier || '',
                alamat: supplier.alamat || '',
                telpon1: supplier.telpon1 || '',
                kontakperson: supplier.kontakperson || '',
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
            put(`/master/supplier/${editId}`, {
                onSuccess: () => closeModal(),
            });
        } else {
            post('/master/supplier', {
                onSuccess: () => closeModal(),
            });
        }
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menonaktifkan supplier ini?')) {
            destroy(`/master/supplier/${id}`);
        }
    };

    return (
        <DashboardLayout title="Master Supplier">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header & Search */}
                <div className="pl-header glass-panel p-4 flex flex-col md:flex-row justify-between items-center gap-4 rounded-xl">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 dark:text-white">Master Supplier</h1>
                        <p className="text-sm text-gray-500 dark:text-gray-400">Kelola data vendor dan pemasok barang</p>
                    </div>
                    <div className="flex gap-2 w-full md:w-auto">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full">
                            <input 
                                type="text" 
                                placeholder="Cari nama, kode, kontak..." 
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
                    <div className="dash-table">
                        <table className="dash-table">
                            <thead>
                                <tr>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Kode</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Nama Supplier</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Kontak Person</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Telepon</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {suppliers.data.map((item) => (
                                    <tr key={item.id_mt_supplier} className="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td className="p-3 text-sm text-gray-800 dark:text-gray-200">{item.kodesupplier}</td>
                                        <td className="p-3 text-sm font-medium text-gray-900 dark:text-white">{item.namasupplier}</td>
                                        <td className="p-3 text-sm text-gray-600 dark:text-gray-400">{item.kontakperson || '-'}</td>
                                        <td className="p-3 text-sm text-gray-600 dark:text-gray-400">{item.telpon1 || '-'}</td>
                                        <td className="p-3 text-sm">
                                            {item.status_aktif == 1 ? (
                                                <span className="px-2 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full text-xs">Aktif</span>
                                            ) : (
                                                <span className="px-2 py-1 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 rounded-full text-xs">Nonaktif</span>
                                            )}
                                        </td>
                                        <td className="p-3 text-sm text-center">
                                            <button onClick={() => openModal(item)} className="text-blue-500 hover:text-blue-700 mr-3">Edit</button>
                                            <button onClick={() => handleDelete(item.id_mt_supplier)} className="text-red-500 hover:text-red-700">Hapus</button>
                                        </td>
                                    </tr>
                                ))}
                                {suppliers.data.length === 0 && (
                                    <tr>
                                        <td colSpan="6" className="p-8 text-center text-gray-500">Data tidak ditemukan.</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                    {/* Pagination */}
                    <div className="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                        <span className="text-sm text-gray-600 dark:text-gray-400">
                            Menampilkan {suppliers.from || 0} - {suppliers.to || 0} dari {suppliers.total} data
                        </span>
                        <div className="flex gap-1">
                            {suppliers.links.map((link, idx) => (
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
                    <div className="glass-panel w-full max-w-lg p-6 rounded-2xl shadow-2xl m-4 relative overflow-y-auto max-h-[90vh]">
                        <h2 className="text-xl font-bold mb-4 text-gray-800 dark:text-white">
                            {isEdit ? 'Edit Supplier' : 'Tambah Supplier Baru'}
                        </h2>
                        
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Supplier</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full" 
                                    value={data.kodesupplier} 
                                    onChange={e => setData('kodesupplier', e.target.value)} 
                                    required 
                                />
                                {errors.kodesupplier && <p className="text-red-500 text-xs mt-1">{errors.kodesupplier}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Supplier</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full" 
                                    value={data.namasupplier} 
                                    onChange={e => setData('namasupplier', e.target.value)} 
                                    required 
                                />
                                {errors.namasupplier && <p className="text-red-500 text-xs mt-1">{errors.namasupplier}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kontak Person</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full" 
                                    value={data.kontakperson} 
                                    onChange={e => setData('kontakperson', e.target.value)} 
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor Telepon</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full" 
                                    value={data.telpon1} 
                                    onChange={e => setData('telpon1', e.target.value)} 
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Lengkap</label>
                                <textarea 
                                    className="premium-input w-full" 
                                    rows="3"
                                    value={data.alamat} 
                                    onChange={e => setData('alamat', e.target.value)} 
                                ></textarea>
                            </div>

                            <div className="flex justify-end gap-3 mt-4">
                                <button type="button" onClick={closeModal} className="btn-secondary px-4 py-2 rounded-lg">Batal</button>
                                <button type="submit" disabled={processing} className="btn-primary px-4 py-2 rounded-lg flex items-center">
                                    {processing ? 'Menyimpan...' : 'Simpan Data'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
