import React, { useState, useEffect } from 'react';
import { Head, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { FileText, Search, Download, Printer } from 'lucide-react';
import dayjs from 'dayjs';

export default function LaporanStokIndex({ laporan, filters, totalItems }) {
    const [startDate, setStartDate] = useState(filters.start_date || dayjs().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState(filters.end_date || dayjs().format('YYYY-MM-DD'));
    const [kodeBrg, setKodeBrg] = useState(filters.kode_brg || '');
    
    const [searchBrgQ, setSearchBrgQ] = useState('');
    const [searchResults, setSearchResults] = useState([]);
    const [isSearching, setIsSearching] = useState(false);
    const [selectedBarang, setSelectedBarang] = useState(null);

    // Filter type 1 = Terima, 2 = Retur, 4 = Opname, 5 = Pengeluaran Internal, 6 = Kasir dsb.
    const jenisTransaksiMap = {
        1: 'Penerimaan',
        2: 'Retur ke Supplier',
        4: 'Stok Opname',
        5: 'Pengeluaran Internal',
        6: 'Penjualan (Kasir)'
    };

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/gudang/laporan-stok', { 
            start_date: startDate,
            end_date: endDate,
            kode_brg: kodeBrg
        }, { preserveState: true });
    };

    useEffect(() => {
        const timer = setTimeout(async () => {
            if (searchBrgQ.length > 2) {
                setIsSearching(true);
                try {
                    const res = await fetch(`/api/search-barang-master?q=${searchBrgQ}`);
                    const result = await res.json();
                    setSearchResults(result);
                } catch (err) {
                    console.error(err);
                } finally {
                    setIsSearching(false);
                }
            } else {
                setSearchResults([]);
            }
        }, 500);
        return () => clearTimeout(timer);
    }, [searchBrgQ]);

    const selectBarang = (brg) => {
        setKodeBrg(brg.kode_brg);
        setSelectedBarang(brg);
        setSearchBrgQ('');
        setSearchResults([]);
    };

    return (
        <DashboardLayout title="Laporan Saldo Persediaan (Kartu Stok)">
            <div className="p-4 w-full h-full flex flex-col lg:flex-row gap-4">
                
                {/* Sidebar Filter */}
                <div className="w-full lg:w-1/4 flex flex-col gap-4">
                    <div className="glass-panel p-5 rounded-xl h-full flex flex-col">
                        <div className="flex items-center gap-2 mb-6 border-b dark:border-gray-700 pb-3">
                            <FileText className="w-6 h-6 text-blue-600" />
                            <h2 className="text-lg font-bold text-gray-800 dark:text-white">Filter Laporan</h2>
                        </div>
                        
                        <form onSubmit={handleSearch} className="flex flex-col gap-4 flex-1">
                            <div>
                                <label className="block text-sm text-gray-600 dark:text-gray-400 mb-1">Mulai Tanggal</label>
                                <input 
                                    type="date" 
                                    className="premium-input w-full"
                                    value={startDate}
                                    onChange={e => setStartDate(e.target.value)}
                                    required
                                />
                            </div>
                            
                            <div>
                                <label className="block text-sm text-gray-600 dark:text-gray-400 mb-1">Sampai Tanggal</label>
                                <input 
                                    type="date" 
                                    className="premium-input w-full"
                                    value={endDate}
                                    onChange={e => setEndDate(e.target.value)}
                                    required
                                />
                            </div>

                            <div className="relative">
                                <label className="block text-sm text-gray-600 dark:text-gray-400 mb-1">Pilih Barang (Opsional)</label>
                                <input 
                                    type="text" 
                                    className="premium-input w-full"
                                    placeholder="Ketik untuk mencari..."
                                    value={searchBrgQ}
                                    onChange={e => setSearchBrgQ(e.target.value)}
                                />
                                {isSearching && <span className="absolute right-3 top-8 text-xs text-blue-500">Mencari...</span>}
                                
                                {searchResults.length > 0 && (
                                    <div className="absolute z-10 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                                        {searchResults.map((brg, i) => (
                                            <div 
                                                key={i} 
                                                className="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer border-b last:border-b-0 dark:border-gray-700"
                                                onClick={() => selectBarang(brg)}
                                            >
                                                <div className="font-medium text-sm dark:text-white">{brg.nama_brg}</div>
                                                <div className="text-xs text-gray-500">{brg.kode_brg}</div>
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </div>

                            {(kodeBrg || selectedBarang) && (
                                <div className="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg border border-blue-100 dark:border-blue-800 flex justify-between items-center">
                                    <div className="text-sm">
                                        <div className="font-bold text-blue-800 dark:text-blue-300">{selectedBarang?.nama_brg || kodeBrg}</div>
                                        <div className="text-xs text-blue-600 dark:text-blue-400">{kodeBrg}</div>
                                    </div>
                                    <button 
                                        type="button" 
                                        className="text-gray-400 hover:text-red-500"
                                        onClick={() => {
                                            setKodeBrg('');
                                            setSelectedBarang(null);
                                        }}
                                    >
                                        &times;
                                    </button>
                                </div>
                            )}

                            <div className="mt-4 pt-4 border-t dark:border-gray-700">
                                <button type="submit" className="btn-primary w-full py-2 rounded-lg flex justify-center items-center gap-2">
                                    <Search className="w-5 h-5" /> Tampilkan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {/* Main Content Area */}
                <div className="w-full lg:w-3/4 flex flex-col gap-4">
                    <div className="glass-panel p-4 rounded-xl flex-1 overflow-hidden flex flex-col">
                        <div className="flex justify-between items-center mb-4">
                            <div>
                                <h2 className="text-lg font-bold text-gray-800 dark:text-white">Kartu Stok (Mutasi Barang)</h2>
                                {laporan && laporan.data ? (
                                    <p className="text-sm text-gray-500">Ditemukan {totalItems} mutasi pada periode ini.</p>
                                ) : (
                                    <p className="text-sm text-gray-500">Silakan gunakan filter di samping untuk memuat data.</p>
                                )}
                            </div>
                            
                            {laporan && laporan.data && laporan.data.length > 0 && (
                                <div className="flex gap-2">
                                    <a 
                                        href={`/gudang/laporan-stok/cetak?start_date=${startDate}&end_date=${endDate}${kodeBrg ? '&kode_brg='+kodeBrg : ''}`}
                                        target="_blank"
                                        className="btn-secondary px-3 py-2 rounded-lg flex items-center gap-2 text-sm"
                                    >
                                        <Printer className="w-4 h-4" /> Cetak
                                    </a>
                                    <a 
                                        href={`/gudang/laporan-stok/export?start_date=${startDate}&end_date=${endDate}${kodeBrg ? '&kode_brg='+kodeBrg : ''}`}
                                        className="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg flex items-center gap-2 text-sm transition-colors"
                                    >
                                        <Download className="w-4 h-4" /> Export CSV
                                    </a>
                                </div>
                            )}
                        </div>

                        <div className="flex-1 overflow-x-auto w-full">
                            {laporan && laporan.data ? (
                                <table className="premium-table w-full">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th className="text-right">Stok Awal</th>
                                            <th className="text-right text-green-600">Masuk</th>
                                            <th className="text-right text-red-600">Keluar</th>
                                            <th className="text-right">Saldo Akhir</th>
                                            <th>Jenis / Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {laporan.data.length > 0 ? (
                                            laporan.data.map((item, index) => (
                                                <tr key={index} className="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                                    <td className="whitespace-nowrap">{dayjs(item.tgl_input).format('DD/MM/YYYY HH:mm')}</td>
                                                    <td className="font-medium text-xs">{item.kode_brg}</td>
                                                    <td className="text-sm">
                                                        {item.nama_brg}
                                                    </td>
                                                    <td className="text-right text-gray-500">{Number(item.stok_awal).toLocaleString('id-ID')}</td>
                                                    <td className="text-right text-green-600 font-medium">
                                                        {item.pemasukan > 0 ? `+${Number(item.pemasukan).toLocaleString('id-ID')}` : '-'}
                                                    </td>
                                                    <td className="text-right text-red-600 font-medium">
                                                        {item.pengeluaran > 0 ? `-${Number(item.pengeluaran).toLocaleString('id-ID')}` : '-'}
                                                    </td>
                                                    <td className="text-right font-bold text-blue-600 dark:text-blue-400">
                                                        {Number(item.stok_akhir).toLocaleString('id-ID')}
                                                    </td>
                                                    <td>
                                                        <div className="text-xs font-bold text-gray-800 dark:text-gray-200">
                                                            {jenisTransaksiMap[item.jenis_transaksi] || 'Transaksi Lain'}
                                                        </div>
                                                        <div className="text-xs text-gray-500 truncate max-w-xs" title={item.keterangan}>
                                                            {item.keterangan || '-'}
                                                        </div>
                                                    </td>
                                                </tr>
                                            ))
                                        ) : (
                                            <tr>
                                                <td colSpan="8" className="text-center py-12 text-gray-500">
                                                    Tidak ada mutasi stok ditemukan pada periode ini.
                                                </td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            ) : (
                                <div className="h-full flex flex-col items-center justify-center text-gray-400">
                                    <FileText className="w-16 h-16 mb-4 opacity-20" />
                                    <p>Pilih kriteria laporan dan klik Tampilkan Data</p>
                                </div>
                            )}
                        </div>

                        {/* Pagination */}
                        {laporan && laporan.links && laporan.links.length > 3 && (
                            <div className="mt-4 flex justify-center gap-1 flex-wrap border-t dark:border-gray-700 pt-4">
                                {laporan.links.map((link, i) => (
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
            </div>
        </DashboardLayout>
    );
}
