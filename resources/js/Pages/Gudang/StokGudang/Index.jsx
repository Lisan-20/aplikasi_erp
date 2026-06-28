import React, { useState } from 'react';
import { useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function StokGudangIndex({ barang, filters, flash }) {
    const [search, setSearch] = useState(filters.search || '');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [selectedItem, setSelectedItem] = useState(null);

    const { data, setData, post, processing, errors, reset, clearErrors } = useForm({
        kode_brg: '',
        stok_aktual: '',
    });

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/stok-gudang', { search }, { preserveState: true });
    };

    const openModal = (item) => {
        clearErrors();
        setSelectedItem(item);
        setData({
            kode_brg: item.kode_brg,
            stok_aktual: item.stok || 0,
        });
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        reset();
        setSelectedItem(null);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/gudang/stok-gudang', {
            onSuccess: () => closeModal(),
        });
    };

    return (
        <DashboardLayout title="Stok Gudang (Opname)">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header & Search */}
                <div className="pl-header glass-panel p-4 flex flex-col md:flex-row justify-between items-center gap-4 rounded-xl">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 dark:text-white">Stok Gudang</h1>
                        <p className="text-sm text-gray-500 dark:text-gray-400">Penyesuaian (Opname) Stok di Depo Gudang Sementara (070101)</p>
                    </div>
                    <div className="flex gap-2 w-full md:w-auto">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full">
                            <input 
                                type="text" 
                                placeholder="Cari kode atau nama barang..." 
                                className="premium-input w-full md:w-64"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                            <button type="submit" className="btn-secondary px-4 py-2 rounded-lg">Cari</button>
                        </form>
                    </div>
                </div>

                {/* Tabs */}
                <div className="flex border-b border-gray-200 dark:border-gray-700">
                    <button 
                        className="px-6 py-3 font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400"
                    >
                        Daftar Barang (Opname)
                    </button>
                    <button 
                        onClick={() => router.get('/gudang/stok-gudang/riwayat')}
                        className="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 border-b-2 border-transparent"
                    >
                        Riwayat Opname
                    </button>
                </div>

                {/* Flash Messages */}
                {flash?.success && (
                    <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {flash.success}
                    </div>
                )}
                {flash?.error && (
                    <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {flash.error}
                    </div>
                )}

                {/* Table */}
                <div className="flex-1 glass-panel p-4 rounded-xl overflow-hidden flex flex-col">
                    <div className="overflow-x-auto">
                        <table className="premium-table w-full">
                            <thead>
                                <tr>
                                    <th className="w-16">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th className="text-right">Stok Gudang</th>
                                    <th className="text-center w-32">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {barang.data.length > 0 ? (
                                    barang.data.map((item, index) => (
                                        <tr key={index} className="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td className="text-center">{barang.from + index}</td>
                                            <td className="font-medium">{item.kode_brg}</td>
                                            <td>{item.nama_brg}</td>
                                            <td>{item.satuan_kecil || '-'}</td>
                                            <td className="text-right font-bold text-blue-600 dark:text-blue-400">
                                                {Number(item.stok).toLocaleString('id-ID')}
                                            </td>
                                            <td className="text-center">
                                                <button 
                                                    onClick={() => openModal(item)}
                                                    className="px-3 py-1 bg-amber-100 text-amber-700 hover:bg-amber-200 rounded-lg text-sm font-medium transition-colors"
                                                >
                                                    Opname
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="6" className="text-center py-8 text-gray-500">
                                            Tidak ada data barang ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                    
                    {/* Pagination */}
                    {barang.links && barang.links.length > 3 && (
                        <div className="mt-4 flex justify-center gap-1 flex-wrap">
                            {barang.links.map((link, i) => (
                                <button
                                    key={i}
                                    onClick={() => link.url && router.get(link.url)}
                                    disabled={!link.url}
                                    className={`px-3 py-1 rounded border text-sm ${
                                        link.active 
                                            ? 'bg-blue-600 text-white border-blue-600' 
                                            : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 disabled:opacity-50'
                                    }`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    )}
                </div>
            </div>

            {/* Modal Opname */}
            {isModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                    <div className="bg-white dark:bg-slate-900 w-full max-w-md rounded-2xl shadow-xl overflow-hidden transform transition-all">
                        <div className="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                            <h3 className="text-xl font-bold text-gray-800 dark:text-white">Opname Stok Gudang</h3>
                            <button onClick={closeModal} className="text-gray-400 hover:text-gray-600">
                                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <form onSubmit={handleSubmit} className="p-6 flex flex-col gap-4">
                            <div className="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
                                <p className="text-sm text-blue-600 dark:text-blue-400 font-medium mb-1">Barang Terpilih:</p>
                                <p className="text-lg font-bold text-gray-800 dark:text-white">{selectedItem?.nama_brg}</p>
                                <p className="text-sm text-gray-500">{selectedItem?.kode_brg}</p>
                            </div>

                            <div className="form-group">
                                <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok Aktual / Fisik (Sekarang)</label>
                                <div className="relative">
                                    <input 
                                        type="number" 
                                        className="premium-input w-full text-xl py-3"
                                        placeholder="0"
                                        min="0"
                                        value={data.stok_aktual}
                                        onChange={e => setData('stok_aktual', e.target.value)}
                                        required
                                    />
                                    <span className="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">
                                        {selectedItem?.satuan_kecil}
                                    </span>
                                </div>
                                {errors.stok_aktual && <span className="text-red-500 text-sm mt-1 block">{errors.stok_aktual}</span>}
                                
                                <p className="text-xs text-gray-500 mt-2">
                                    Stok sebelumnya di sistem: <strong className="text-gray-700 dark:text-gray-300">{Number(selectedItem?.stok).toLocaleString('id-ID')}</strong> {selectedItem?.satuan_kecil}
                                </p>
                            </div>

                            <div className="flex gap-3 justify-end mt-4">
                                <button type="button" onClick={closeModal} className="btn-secondary px-6 py-2 rounded-xl">Batal</button>
                                <button type="submit" disabled={processing} className="btn-primary px-6 py-2 rounded-xl flex items-center gap-2">
                                    {processing ? 'Menyimpan...' : 'Simpan Opname'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
