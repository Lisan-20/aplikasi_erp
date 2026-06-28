import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import dayjs from 'dayjs';

export default function StokGudangRiwayat({ riwayat, filters }) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/stok-gudang/riwayat', { search }, { preserveState: true });
    };

    return (
        <DashboardLayout title="Riwayat Stok Opname">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header & Search */}
                <div className="pl-header glass-panel p-4 flex flex-col md:flex-row justify-between items-center gap-4 rounded-xl">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 dark:text-white">Riwayat Stok Opname</h1>
                        <p className="text-sm text-gray-500 dark:text-gray-400">Daftar riwayat penyesuaian fisik barang</p>
                    </div>
                    <div className="flex gap-2 w-full md:w-auto">
                        <form onSubmit={handleSearch} className="flex gap-2 w-full">
                            <input 
                                type="text" 
                                placeholder="Cari barang atau no. induk..." 
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
                        onClick={() => router.get('/gudang/stok-gudang')}
                        className="px-6 py-3 font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 border-b-2 border-transparent"
                    >
                        Daftar Barang (Opname)
                    </button>
                    <button 
                        className="px-6 py-3 font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400"
                    >
                        Riwayat Opname
                    </button>
                </div>

                {/* Table */}
                <div className="flex-1 glass-panel p-4 rounded-xl overflow-hidden flex flex-col">
                    <div className="overflow-x-auto w-full">
                        <table className="premium-table w-full">
                            <thead>
                                <tr>
                                    <th className="w-16">No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th className="text-right">Stok Sebelum</th>
                                    <th className="text-right">Stok Sesudah</th>
                                    <th className="text-right">Selisih</th>
                                    <th>Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                {riwayat.data.length > 0 ? (
                                    riwayat.data.map((item, index) => {
                                        const selisih = item.stok_sekarang - item.stok_sebelum;
                                        return (
                                            <tr key={index} className="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                                <td className="text-center">{riwayat.from + index}</td>
                                                <td>{dayjs(item.tgl_stok_opname).format('DD/MM/YYYY HH:mm')}</td>
                                                <td className="font-medium">{item.kode_brg}</td>
                                                <td>{item.nama_brg}</td>
                                                <td className="text-right text-gray-600">{Number(item.stok_sebelum).toLocaleString('id-ID')}</td>
                                                <td className="text-right font-bold">{Number(item.stok_sekarang).toLocaleString('id-ID')}</td>
                                                <td className={`text-right font-bold ${selisih > 0 ? 'text-green-600' : selisih < 0 ? 'text-red-600' : 'text-gray-500'}`}>
                                                    {selisih > 0 ? '+' : ''}{Number(selisih).toLocaleString('id-ID')}
                                                </td>
                                                <td>
                                                    <div className="font-medium text-gray-800 dark:text-gray-200">{item.nama_pegawai || '-'}</div>
                                                    <div className="text-xs text-gray-500">{item.no_induk}</div>
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td colSpan="8" className="text-center py-8 text-gray-500">
                                            Tidak ada data riwayat opname ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                    
                    {/* Pagination */}
                    {riwayat.links && riwayat.links.length > 3 && (
                        <div className="mt-4 flex justify-center gap-1 flex-wrap">
                            {riwayat.links.map((link, i) => (
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
        </DashboardLayout>
    );
}
