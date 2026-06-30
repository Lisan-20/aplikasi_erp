import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import Select from 'react-select';

export default function Create({ perusahaan, barang, nextFaktur }) {
    const { data, setData, post, processing, errors } = useForm({
        no_faktur: nextFaktur,
        tgl_faktur: new Date().toISOString().split('T')[0],
        tgl_jatuh_tempo: '',
        kode_perusahaan: '',
        keterangan: '',
        items: [] // { kode_brg, nama_brg, qty, harga, subtotal }
    });

    const [selectedBarang, setSelectedBarang] = useState(null);
    const [qty, setQty] = useState(1);
    const [harga, setHarga] = useState(0);

    const isDarkMode = document.documentElement.classList.contains('dark');

    const selectStyles = {
        menuPortal: base => ({ ...base, zIndex: 9999 }),
        control: (base) => ({
            ...base,
            backgroundColor: isDarkMode ? 'rgba(55, 65, 81, 0.5)' : 'rgba(255, 255, 255, 0.5)',
            borderColor: isDarkMode ? '#4B5563' : '#D1D5DB',
            color: isDarkMode ? 'white' : 'black',
        }),
        singleValue: (base) => ({ ...base, color: isDarkMode ? 'white' : 'black' }),
        menu: (base) => ({ ...base, backgroundColor: isDarkMode ? '#1F2937' : 'white' }),
        option: (base, state) => ({
            ...base,
            backgroundColor: state.isFocused ? (isDarkMode ? '#374151' : '#F3F4F6') : 'transparent',
            color: isDarkMode ? 'white' : 'black',
        }),
    };

    const formatRupiah = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(num || 0);

    const handleAddBarang = () => {
        if (!selectedBarang || qty <= 0 || harga < 0) return;
        
        const brg = barang.find(b => b.kode_brg === selectedBarang);
        if (qty > brg.stok) {
            alert(`Stok tidak mencukupi! Sisa stok: ${brg.stok}`);
            return;
        }

        const newItem = {
            kode_brg: brg.kode_brg,
            nama_brg: brg.nama_brg,
            qty: parseInt(qty),
            harga: parseFloat(harga),
            subtotal: qty * harga
        };

        setData('items', [...data.items, newItem]);
        setSelectedBarang(null);
        setQty(1);
        setHarga(0);
    };

    const handleRemoveItem = (index) => {
        const newItems = [...data.items];
        newItems.splice(index, 1);
        setData('items', newItems);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (data.items.length === 0) {
            alert("Pilih minimal 1 barang.");
            return;
        }
        post(route('kasir.faktur.store'));
    };

    const totalTagihan = data.items.reduce((sum, item) => sum + item.subtotal, 0);

    return (
        <DashboardLayout>
            <Head title="Buat Faktur Penjualan" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <h2 className="text-2xl font-bold text-gray-800 dark:text-white mb-2">Buat Faktur Penjualan (B2B)</h2>
                    <p className="text-sm text-gray-600 dark:text-gray-300">Catat transaksi penjualan tempo/piutang ke perusahaan.</p>
                </div>

                <form onSubmit={handleSubmit}>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No Faktur</label>
                            <input
                                type="text"
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-gray-100 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                                value={data.no_faktur}
                                readOnly
                            />
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Perusahaan / Pelanggan</label>
                            <Select
                                options={perusahaan.map(p => ({ value: p.kode_perusahaan, label: p.nama_perusahaan }))}
                                styles={selectStyles}
                                menuPortalTarget={document.body}
                                menuPosition="fixed"
                                placeholder="Pilih Perusahaan..."
                                onChange={(opt) => setData('kode_perusahaan', opt ? opt.value : '')}
                            />
                            {errors.kode_perusahaan && <span className="text-red-500 text-xs">{errors.kode_perusahaan}</span>}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Faktur</label>
                            <input
                                type="date"
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                                value={data.tgl_faktur}
                                onChange={e => setData('tgl_faktur', e.target.value)}
                            />
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tgl Jatuh Tempo</label>
                            <input
                                type="date"
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                                value={data.tgl_jatuh_tempo}
                                onChange={e => setData('tgl_jatuh_tempo', e.target.value)}
                            />
                            {errors.tgl_jatuh_tempo && <span className="text-red-500 text-xs">{errors.tgl_jatuh_tempo}</span>}
                        </div>
                        <div className="md:col-span-2">
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keterangan Tambahan</label>
                            <input
                                type="text"
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                                value={data.keterangan}
                                onChange={e => setData('keterangan', e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="mb-6 p-4 border border-indigo-200 dark:border-indigo-800 rounded-xl bg-indigo-50/30 dark:bg-indigo-900/10">
                        <h3 className="text-lg font-bold text-indigo-800 dark:text-indigo-300 mb-4">Tambahkan Barang</h3>
                        <div className="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div className="md:col-span-2">
                                <label className="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Barang</label>
                                <Select
                                    options={barang.map(b => ({ value: b.kode_brg, label: `${b.nama_brg} (Stok: ${b.stok})`, price: b.harga_jual }))}
                                    styles={selectStyles}
                                    menuPortalTarget={document.body}
                                    menuPosition="fixed"
                                    placeholder="Ketik nama barang..."
                                    value={selectedBarang ? { value: selectedBarang, label: barang.find(b => b.kode_brg === selectedBarang).nama_brg } : null}
                                    onChange={(opt) => {
                                        setSelectedBarang(opt ? opt.value : null);
                                        setHarga(opt ? opt.price : 0);
                                    }}
                                />
                            </div>
                            <div>
                                <label className="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Qty</label>
                                <input type="number" min="1" className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white bg-white/50 dark:bg-gray-700/50" value={qty} onChange={e => setQty(e.target.value)} />
                            </div>
                            <div>
                                <label className="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Satuan</label>
                                <input type="number" className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white bg-white/50 dark:bg-gray-700/50" value={harga} onChange={e => setHarga(e.target.value)} />
                            </div>
                        </div>
                        <div className="mt-4 flex justify-end">
                            <button type="button" onClick={handleAddBarang} className="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg shadow-sm">
                                + Masukkan ke Keranjang
                            </button>
                        </div>
                    </div>

                    <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-6">
                        <table className="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-100/50 dark:bg-gray-800/50 dark:text-gray-300">
                                <tr>
                                    <th className="px-6 py-3">Kode Brg</th>
                                    <th className="px-6 py-3">Nama Barang</th>
                                    <th className="px-6 py-3 text-right">Harga Satuan</th>
                                    <th className="px-6 py-3 text-center">Qty</th>
                                    <th className="px-6 py-3 text-right">Subtotal</th>
                                    <th className="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data.items.length > 0 ? data.items.map((it, idx) => (
                                    <tr key={idx} className="border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50">
                                        <td className="px-6 py-3">{it.kode_brg}</td>
                                        <td className="px-6 py-3 font-medium">{it.nama_brg}</td>
                                        <td className="px-6 py-3 text-right">{formatRupiah(it.harga)}</td>
                                        <td className="px-6 py-3 text-center">{it.qty}</td>
                                        <td className="px-6 py-3 text-right font-semibold text-gray-900 dark:text-gray-100">{formatRupiah(it.subtotal)}</td>
                                        <td className="px-6 py-3 text-center">
                                            <button type="button" onClick={() => handleRemoveItem(idx)} className="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                        </td>
                                    </tr>
                                )) : (
                                    <tr>
                                        <td colSpan="6" className="px-6 py-8 text-center text-gray-400">Keranjang masih kosong.</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>

                    <div className="flex flex-col md:flex-row justify-between items-center bg-gray-50 dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="text-2xl font-black text-gray-800 dark:text-gray-200">
                            TOTAL: <span className="text-indigo-600 dark:text-indigo-400">{formatRupiah(totalTagihan)}</span>
                        </div>
                        <div className="mt-4 md:mt-0 flex space-x-3">
                            <Link href={route('kasir.faktur.index')} className="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-xl transition-all">
                                Batal
                            </Link>
                            <button type="submit" disabled={processing || data.items.length === 0} className="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 text-white font-bold rounded-xl shadow-lg transition-all">
                                Simpan Faktur & Buat Jurnal
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </DashboardLayout>
    );
}
