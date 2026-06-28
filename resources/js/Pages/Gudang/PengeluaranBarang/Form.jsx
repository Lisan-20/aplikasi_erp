import React, { useState } from 'react';
import { Head, Link, router, useForm } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { ArrowLeft, Save, Plus, Trash2, Search, PackageOpen } from 'lucide-react';
import Swal from 'sweetalert2';

export default function PengeluaranBarangForm({ bagian }) {
    const { data, setData, post, processing, errors } = useForm({
        kode_bagian_minta: '',
        tgl_permintaan: new Date().toISOString().split('T')[0],
        keterangan_kirim: '',
        items: []
    });

    const [searchQ, setSearchQ] = useState('');
    const [searchResults, setSearchResults] = useState([]);
    const [isSearching, setIsSearching] = useState(false);

    const searchBarang = async (e) => {
        e.preventDefault();
        if (!searchQ) return;
        
        setIsSearching(true);
        try {
            const res = await fetch(`/gudang/api/search-barang-stok?q=${searchQ}`);
            const result = await res.json();
            setSearchResults(result);
            if (result.length === 0) {
                Swal.fire('Info', 'Barang tidak ditemukan atau stok kosong di gudang.', 'info');
            }
        } catch (error) {
            console.error(error);
        } finally {
            setIsSearching(false);
        }
    };

    const addItem = (brg) => {
        const exist = data.items.find(i => i.kode_brg === brg.kode_brg);
        if (exist) {
            Swal.fire('Info', 'Barang sudah ada di daftar pengeluaran', 'info');
            return;
        }

        setData('items', [
            ...data.items, 
            { 
                ...brg, 
                jumlah: 1 
            }
        ]);
        
        // Bersihkan pencarian
        setSearchResults([]);
        setSearchQ('');
    };

    const updateItemQty = (index, value) => {
        const newItems = [...data.items];
        // Pastikan tidak melebihi stok gudang
        const maxStok = Number(newItems[index].stok);
        let val = Number(value);
        
        if (val > maxStok) {
            Swal.fire('Peringatan', `Stok gudang hanya tersisa ${maxStok}`, 'warning');
            val = maxStok;
        }
        
        newItems[index].jumlah = val;
        setData('items', newItems);
    };

    const removeItem = (index) => {
        const newItems = [...data.items];
        newItems.splice(index, 1);
        setData('items', newItems);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        
        if (data.items.length === 0) {
            Swal.fire('Error', 'Tambahkan minimal 1 barang untuk dikeluarkan', 'error');
            return;
        }
        
        Swal.fire({
            title: 'Konfirmasi Pengeluaran',
            text: 'Pastikan barang dan jumlah sudah benar. Stok akan otomatis berkurang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Keluarkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                post('/gudang/pengeluaran-barang');
            }
        });
    };

    return (
        <DashboardLayout title="Buat Pengeluaran Barang">
            <div className="p-4 w-full h-full flex flex-col gap-4">
                
                {/* Header */}
                <div className="pl-header glass-panel p-4 flex justify-between items-center rounded-xl">
                    <div className="flex items-center gap-4">
                        <Link href="/gudang/pengeluaran-barang" className="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                            <ArrowLeft className="w-6 h-6 text-gray-600 dark:text-gray-300" />
                        </Link>
                        <div>
                            <h1 className="text-xl font-bold text-gray-800 dark:text-white">Buat Pengeluaran Langsung</h1>
                            <p className="text-sm text-gray-500">Distribusi stok gudang ke unit (Internal Issue)</p>
                        </div>
                    </div>
                </div>

                <div className="flex flex-col lg:flex-row gap-4">
                    {/* Panel Kiri - Form & Pencarian */}
                    <div className="w-full lg:w-1/3 flex flex-col gap-4">
                        <div className="glass-panel p-5 rounded-xl">
                            <h3 className="font-bold text-gray-800 dark:text-white mb-4 border-b dark:border-gray-700 pb-2">Informasi Distribusi</h3>
                            
                            <div className="flex flex-col gap-4">
                                <div>
                                    <label className="block text-sm text-gray-600 dark:text-gray-400 mb-1">Tanggal</label>
                                    <input 
                                        type="date" 
                                        className="premium-input w-full"
                                        value={data.tgl_permintaan}
                                        onChange={e => setData('tgl_permintaan', e.target.value)}
                                        required
                                    />
                                    {errors.tgl_permintaan && <span className="text-red-500 text-xs">{errors.tgl_permintaan}</span>}
                                </div>
                                
                                <div>
                                    <label className="block text-sm text-gray-600 dark:text-gray-400 mb-1">Unit Tujuan (Bagian)</label>
                                    <select 
                                        className="premium-input w-full"
                                        value={data.kode_bagian_minta}
                                        onChange={e => setData('kode_bagian_minta', e.target.value)}
                                        required
                                    >
                                        <option value="">-- Pilih Tujuan --</option>
                                        {bagian.map(b => (
                                            <option key={b.kode_bagian} value={b.kode_bagian}>{b.nama_bagian}</option>
                                        ))}
                                    </select>
                                    {errors.kode_bagian_minta && <span className="text-red-500 text-xs">{errors.kode_bagian_minta}</span>}
                                </div>
                                
                                <div>
                                    <label className="block text-sm text-gray-600 dark:text-gray-400 mb-1">Keterangan / Catatan</label>
                                    <textarea 
                                        className="premium-input w-full h-24"
                                        placeholder="Tujuan penggunaan barang..."
                                        value={data.keterangan_kirim}
                                        onChange={e => setData('keterangan_kirim', e.target.value)}
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        {/* Search Box */}
                        <div className="glass-panel p-5 rounded-xl">
                            <h3 className="font-bold text-gray-800 dark:text-white mb-4 border-b dark:border-gray-700 pb-2">Cari Barang (Stok Gudang)</h3>
                            <form onSubmit={searchBarang} className="flex gap-2">
                                <input 
                                    type="text" 
                                    className="premium-input w-full"
                                    placeholder="Ketik nama barang..."
                                    value={searchQ}
                                    onChange={e => setSearchQ(e.target.value)}
                                />
                                <button type="submit" disabled={isSearching} className="btn-secondary p-2 rounded-lg">
                                    <Search className="w-5 h-5" />
                                </button>
                            </form>
                            
                            {searchResults.length > 0 && (
                                <div className="mt-4 flex flex-col gap-2 max-h-[300px] overflow-y-auto">
                                    {searchResults.map((brg, i) => (
                                        <div key={i} className="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                            <div>
                                                <div className="font-bold text-sm dark:text-white">{brg.nama_brg}</div>
                                                <div className="text-xs text-gray-500 flex gap-2">
                                                    <span>{brg.kode_brg}</span>
                                                    <span>•</span>
                                                    <span className="text-blue-600 font-medium">Stok: {brg.stok}</span>
                                                </div>
                                            </div>
                                            <button 
                                                type="button" 
                                                onClick={() => addItem(brg)}
                                                className="p-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200"
                                            >
                                                <Plus className="w-4 h-4" />
                                            </button>
                                        </div>
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Panel Kanan - Keranjang Pengeluaran */}
                    <div className="w-full lg:w-2/3 glass-panel p-0 rounded-xl overflow-hidden flex flex-col">
                        <div className="p-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-between items-center">
                            <h3 className="font-bold text-gray-800 dark:text-white">Daftar Barang yang Dikeluarkan</h3>
                            <span className="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-bold">
                                {data.items.length} Item
                            </span>
                        </div>
                        
                        <div className="flex-1 overflow-x-auto w-full p-0">
                            <table className="premium-table w-full">
                                <thead>
                                    <tr>
                                        <th className="w-12">No</th>
                                        <th>Nama Barang</th>
                                        <th className="text-center w-24">Stok Asal</th>
                                        <th className="text-center w-32">Qty Keluar</th>
                                        <th className="text-center w-16">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.items.length > 0 ? (
                                        data.items.map((item, index) => (
                                            <tr key={index}>
                                                <td className="text-center">{index + 1}</td>
                                                <td>
                                                    <div className="font-medium text-gray-800 dark:text-gray-200">{item.nama_brg}</div>
                                                    <div className="text-xs text-gray-500">{item.kode_brg}</div>
                                                </td>
                                                <td className="text-center">
                                                    <span className="font-bold text-blue-600">{item.stok}</span>
                                                </td>
                                                <td className="text-center">
                                                    <div className="flex items-center gap-2">
                                                        <input 
                                                            type="number" 
                                                            min="0.1"
                                                            step="0.1"
                                                            className="premium-input w-20 text-center !py-1 !px-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                                                            value={item.jumlah}
                                                            onChange={e => updateItemQty(index, e.target.value)}
                                                        />
                                                        <span className="text-xs text-gray-500">{item.satuan_kecil}</span>
                                                    </div>
                                                </td>
                                                <td className="text-center">
                                                    <button 
                                                        type="button" 
                                                        onClick={() => removeItem(index)}
                                                        className="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors"
                                                    >
                                                        <Trash2 className="w-4 h-4" />
                                                    </button>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="5" className="text-center py-12">
                                                <div className="flex flex-col items-center justify-center text-gray-400">
                                                    <PackageOpen className="w-12 h-12 mb-3 opacity-20" />
                                                    <p>Belum ada barang di daftar pengeluaran.</p>
                                                    <p className="text-sm">Gunakan pencarian di samping kiri untuk menambahkan barang.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>

                        <div className="p-5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 flex justify-end">
                            <button 
                                type="button" 
                                onClick={handleSubmit}
                                disabled={processing || data.items.length === 0}
                                className="btn-primary px-8 py-3 rounded-xl flex items-center gap-2 text-lg disabled:opacity-50"
                            >
                                <Save className="w-5 h-5" />
                                {processing ? 'Memproses...' : 'Proses Pengeluaran'}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
