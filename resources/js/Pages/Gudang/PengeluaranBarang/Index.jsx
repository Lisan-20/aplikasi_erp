import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Plus, Search, PackageOpen, Eye, X } from 'lucide-react';
import dayjs from 'dayjs';

export default function PengeluaranBarangIndex({ pengeluaran, filters, flash }) {
    const [search, setSearch] = useState(filters.search || '');
    const [detailModalOpen, setDetailModalOpen] = useState(false);
    const [selectedPengeluaran, setSelectedPengeluaran] = useState(null);
    const [loadingDetail, setLoadingDetail] = useState(false);

    const openDetail = async (id) => {
        setDetailModalOpen(true);
        setLoadingDetail(true);
        try {
            const res = await fetch(`/gudang/pengeluaran-barang/${id}`);
            const data = await res.json();
            setSelectedPengeluaran(data);
        } catch (error) {
            console.error("Failed to load detail", error);
        } finally {
            setLoadingDetail(false);
        }
    };

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/pengeluaran-barang', { search }, { preserveState: true });
    };

    return (
        <DashboardLayout title="Pengeluaran Barang Internal">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header & Actions */}
                <div className="pl-header glass-panel p-4 flex flex-col md:flex-row justify-between items-center gap-4 rounded-xl">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            <PackageOpen className="w-7 h-7 text-blue-600" />
                            Pengeluaran Internal
                        </h1>
                        <p className="text-sm text-gray-500 dark:text-gray-400">Distribusi stok gudang ke unit / bagian lain</p>
                    </div>
                    <div className="flex gap-2 w-full md:w-auto">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full">
                            <input 
                                type="text" 
                                placeholder="Cari No. Dokumen / Tujuan..." 
                                className="premium-input w-full md:w-64"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                            <button type="submit" className="btn-secondary px-4 py-2 rounded-lg">
                                <Search className="w-5 h-5" />
                            </button>
                        </form>
                        <Link href="/gudang/pengeluaran-barang/create" className="btn-primary px-4 py-2 rounded-lg flex items-center gap-2 whitespace-nowrap">
                            <Plus className="w-5 h-5" /> Buat Pengeluaran
                        </Link>
                    </div>
                </div>

                {/* Flash Messages */}
                {flash?.success && (
                    <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {flash.success}
                    </div>
                )}

                {/* Table */}
                <div className="flex-1 glass-panel p-4 rounded-xl overflow-hidden flex flex-col">
                    <div className="overflow-x-auto w-full">
                        <table className="premium-table w-full">
                            <thead>
                                <tr>
                                    <th className="w-16">No</th>
                                    <th>No. Pengeluaran</th>
                                    <th>Tanggal</th>
                                    <th>Tujuan (Bagian)</th>
                                    <th>Keterangan</th>
                                    <th>Petugas</th>
                                    <th className="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {pengeluaran.data.length > 0 ? (
                                    pengeluaran.data.map((item, index) => (
                                        <tr key={index} className="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td className="text-center">{pengeluaran.from + index}</td>
                                            <td className="font-medium text-blue-600 dark:text-blue-400">
                                                <button 
                                                    onClick={() => openDetail(item.id_tc_permintaan_inst)}
                                                    className="hover:underline text-left"
                                                    title="Lihat Detail"
                                                >
                                                    {item.nomor_permintaan}
                                                </button>
                                            </td>
                                            <td>{dayjs(item.tgl_permintaan).format('DD/MM/YYYY')}</td>
                                            <td className="font-bold">{item.nama_bagian || item.kode_bagian_minta}</td>
                                            <td className="text-gray-500">{item.keterangan_kirim || '-'}</td>
                                            <td>{item.nama_pegawai || item.id_dd_user}</td>
                                            <td className="text-center">
                                                <span className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Selesai</span>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="8" className="text-center py-8 text-gray-500">
                                            Belum ada data pengeluaran internal.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                    
                    {/* Pagination */}
                    {pengeluaran.links && pengeluaran.links.length > 3 && (
                        <div className="mt-4 flex justify-center gap-1 flex-wrap">
                            {pengeluaran.links.map((link, i) => (
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

            {/* Modal Detail Pengeluaran */}
            {detailModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                    <div className="bg-white dark:bg-gray-900 rounded-xl shadow-2xl w-full max-w-3xl overflow-hidden flex flex-col max-h-[90vh]">
                        <div className="p-4 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                            <h2 className="font-bold text-lg text-gray-800 dark:text-white flex items-center gap-2">
                                <PackageOpen className="w-5 h-5 text-blue-600" />
                                Detail Pengeluaran Internal
                            </h2>
                            <button onClick={() => setDetailModalOpen(false)} className="p-1 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg text-gray-500">
                                <X className="w-5 h-5" />
                            </button>
                        </div>
                        
                        <div className="p-6 overflow-y-auto flex-1">
                            {loadingDetail ? (
                                <div className="flex justify-center items-center py-12">
                                    <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                                </div>
                            ) : selectedPengeluaran ? (
                                <div className="space-y-6">
                                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800/50">
                                        <div>
                                            <p className="text-xs text-gray-500 mb-1">No. Dokumen</p>
                                            <p className="font-bold text-gray-800 dark:text-white">{selectedPengeluaran.pengeluaran.nomor_permintaan}</p>
                                        </div>
                                        <div>
                                            <p className="text-xs text-gray-500 mb-1">Tanggal</p>
                                            <p className="font-bold text-gray-800 dark:text-white">{dayjs(selectedPengeluaran.pengeluaran.tgl_permintaan).format('DD/MM/YYYY')}</p>
                                        </div>
                                        <div>
                                            <p className="text-xs text-gray-500 mb-1">Tujuan</p>
                                            <p className="font-bold text-gray-800 dark:text-white">{selectedPengeluaran.pengeluaran.nama_bagian}</p>
                                        </div>
                                        <div>
                                            <p className="text-xs text-gray-500 mb-1">Petugas</p>
                                            <p className="font-bold text-gray-800 dark:text-white">{selectedPengeluaran.pengeluaran.nama_pegawai || selectedPengeluaran.pengeluaran.id_dd_user}</p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h3 className="font-bold text-gray-800 dark:text-white mb-3">Daftar Barang yang Dikeluarkan</h3>
                                        <div className="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-xl">
                                            <table className="w-full text-left text-sm">
                                                <thead className="bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                                                    <tr>
                                                        <th className="p-3 font-medium border-b border-gray-200 dark:border-gray-700">Kode</th>
                                                        <th className="p-3 font-medium border-b border-gray-200 dark:border-gray-700">Nama Barang</th>
                                                        <th className="p-3 font-medium border-b border-gray-200 dark:border-gray-700 text-right">Jumlah</th>
                                                        <th className="p-3 font-medium border-b border-gray-200 dark:border-gray-700">Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody className="divide-y divide-gray-100 dark:divide-gray-800">
                                                    {selectedPengeluaran.items.map((item, idx) => (
                                                        <tr key={idx} className="hover:bg-gray-50/50 dark:hover:bg-gray-800/30">
                                                            <td className="p-3 font-medium text-blue-600">{item.kode_brg}</td>
                                                            <td className="p-3">{item.nama_brg}</td>
                                                            <td className="p-3 text-right font-bold">{item.jumlah_permintaan}</td>
                                                            <td className="p-3 text-gray-500">{item.satuan}</td>
                                                        </tr>
                                                    ))}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    {selectedPengeluaran.pengeluaran.keterangan_kirim && (
                                        <div>
                                            <p className="text-xs text-gray-500 mb-1">Keterangan / Catatan</p>
                                            <p className="text-sm p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">{selectedPengeluaran.pengeluaran.keterangan_kirim}</p>
                                        </div>
                                    )}
                                </div>
                            ) : (
                                <div className="text-center py-12 text-gray-500">Data tidak ditemukan</div>
                            )}
                        </div>
                        
                        <div className="p-4 border-t border-gray-200 dark:border-gray-800 flex justify-end">
                            <button onClick={() => setDetailModalOpen(false)} className="btn-secondary px-6 py-2 rounded-lg">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
