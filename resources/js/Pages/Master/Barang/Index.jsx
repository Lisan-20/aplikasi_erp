import React, { useState } from 'react';
import { useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function BarangIndex({ barang, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isEdit, setIsEdit] = useState(false);
    const [editId, setEditId] = useState(null);

    const { data, setData, post, put, delete: destroy, processing, errors, reset, clearErrors } = useForm({
        kode_brg: '',
        nama_brg: '',
        satuan_besar: '',
        satuan_kecil: '',
        harga_beli: '',
        harga_jual: '',
    });

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/master/barang', { search }, { preserveState: true });
    };

    const openModal = (item = null) => {
        clearErrors();
        if (item) {
            setIsEdit(true);
            setEditId(item.kode_brg); // kode_brg adalah ID
            setData({
                kode_brg: item.kode_brg || '',
                nama_brg: item.nama_brg || '',
                satuan_besar: item.satuan_besar || '',
                satuan_kecil: item.satuan_kecil || '',
                harga_beli: item.harga_beli || '',
                harga_jual: item.harga_jual || '',
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
            put(`/master/barang/${editId}`, {
                onSuccess: () => closeModal(),
            });
        } else {
            post('/master/barang', {
                onSuccess: () => closeModal(),
            });
        }
    };

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menonaktifkan barang ini?')) {
            destroy(`/master/barang/${id}`);
        }
    };

    // Format Rupiah
    const formatRp = (angka) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka || 0);
    };

    return (
        <DashboardLayout title="Master Barang">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header & Search */}
                <div className="pl-header glass-panel p-4 flex flex-col md:flex-row justify-between items-center gap-4 rounded-xl">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 dark:text-white">Master Barang</h1>
                        <p className="text-sm text-gray-500 dark:text-gray-400">Kelola inventaris dan harga barang non-medis</p>
                    </div>
                    <div className="flex gap-2 w-full md:w-auto">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full">
                            <input 
                                type="text" 
                                placeholder="Cari nama atau kode barang..." 
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
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Nama Barang</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300">Satuan (B/K)</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-right">Harga Beli</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-right">Harga Jual</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-center">Stok</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-center">Status</th>
                                    <th className="p-3 text-sm font-semibold text-gray-600 dark:text-gray-300 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {barang.data.map((item) => (
                                    <tr key={item.kode_brg} className="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td className="p-3 text-sm text-gray-800 dark:text-gray-200">{item.kode_brg}</td>
                                        <td className="p-3 text-sm font-medium text-gray-900 dark:text-white">{item.nama_brg}</td>
                                        <td className="p-3 text-sm text-gray-600 dark:text-gray-400">
                                            {item.satuan_besar || '-'} / {item.satuan_kecil || '-'}
                                        </td>
                                        <td className="p-3 text-sm text-right text-gray-600 dark:text-gray-400">{formatRp(item.harga_beli)}</td>
                                        <td className="p-3 text-sm text-right font-semibold text-blue-600 dark:text-blue-400">{formatRp(item.harga_jual)}</td>
                                        <td className="p-3 text-sm text-center font-bold text-gray-800 dark:text-gray-200">
                                            {item.jml_stok_brg > 0 ? (
                                                <span className="text-emerald-600 dark:text-emerald-400">{Number(item.jml_stok_brg)}</span>
                                            ) : (
                                                <span className="text-red-500">0</span>
                                            )}
                                        </td>
                                        <td className="p-3 text-sm text-center">
                                            {item.status == 1 ? (
                                                <span className="px-2 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full text-xs">Aktif</span>
                                            ) : (
                                                <span className="px-2 py-1 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 rounded-full text-xs">Nonaktif</span>
                                            )}
                                        </td>
                                        <td className="p-3 text-sm text-center whitespace-nowrap">
                                            <button onClick={() => openModal(item)} className="text-blue-500 hover:text-blue-700 mr-3">Edit</button>
                                            <button onClick={() => handleDelete(item.kode_brg)} className="text-red-500 hover:text-red-700">Hapus</button>
                                        </td>
                                    </tr>
                                ))}
                                {barang.data.length === 0 && (
                                    <tr>
                                        <td colSpan="8" className="p-8 text-center text-gray-500">Data tidak ditemukan.</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                    {/* Pagination */}
                    <div className="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                        <span className="text-sm text-gray-600 dark:text-gray-400">
                            Menampilkan {barang.from || 0} - {barang.to || 0} dari {barang.total} data
                        </span>
                        <div className="flex gap-1">
                            {barang.links.map((link, idx) => (
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
                    <div className="glass-panel w-full max-w-2xl p-6 rounded-2xl shadow-2xl m-4 relative overflow-y-auto max-h-[90vh]">
                        <h2 className="text-xl font-bold mb-4 text-gray-800 dark:text-white">
                            {isEdit ? 'Edit Barang' : 'Tambah Barang Baru'}
                        </h2>
                        
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Barang</label>
                                    <input 
                                        type="text" 
                                        className="premium-input w-full" 
                                        value={data.kode_brg} 
                                        onChange={e => setData('kode_brg', e.target.value)} 
                                        required 
                                        disabled={isEdit} // Tidak boleh ganti kode saat edit
                                        title={isEdit ? "Kode barang tidak dapat diubah" : ""}
                                    />
                                    {errors.kode_brg && <p className="text-red-500 text-xs mt-1">{errors.kode_brg}</p>}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Barang</label>
                                    <input 
                                        type="text" 
                                        className="premium-input w-full" 
                                        value={data.nama_brg} 
                                        onChange={e => setData('nama_brg', e.target.value)} 
                                        required 
                                    />
                                    {errors.nama_brg && <p className="text-red-500 text-xs mt-1">{errors.nama_brg}</p>}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Satuan Besar (cth: DUS)</label>
                                    <input 
                                        type="text" 
                                        className="premium-input w-full" 
                                        value={data.satuan_besar} 
                                        onChange={e => setData('satuan_besar', e.target.value)} 
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Satuan Kecil (cth: PCS)</label>
                                    <input 
                                        type="text" 
                                        className="premium-input w-full" 
                                        value={data.satuan_kecil} 
                                        onChange={e => setData('satuan_kecil', e.target.value)} 
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Beli (Modal)</label>
                                    <input 
                                        type="number" 
                                        className="premium-input w-full" 
                                        value={data.harga_beli} 
                                        onChange={e => setData('harga_beli', e.target.value)} 
                                        min="0"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Jual (Retail)</label>
                                    <input 
                                        type="number" 
                                        className="premium-input w-full" 
                                        value={data.harga_jual} 
                                        onChange={e => setData('harga_jual', e.target.value)} 
                                        min="0"
                                    />
                                </div>
                            </div>

                            <div className="flex justify-end gap-3 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
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
