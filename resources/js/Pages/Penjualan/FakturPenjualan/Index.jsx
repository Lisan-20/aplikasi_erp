import React from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, router } from '@inertiajs/react';

export default function Index({ fakturs, filters }) {
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    const handleSearch = (e) => {
        e.preventDefault();
        const search = e.target.search.value;
        router.get(route('kasir.faktur.index'), { search }, { preserveState: true });
    };

    return (
        <DashboardLayout>
            <Head title="Faktur Penjualan (B2B)" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="flex flex-col md:flex-row justify-between items-center mb-6">
                    <div>
                        <h2 className="text-2xl font-bold text-gray-800 dark:text-white">Faktur Penjualan (B2B)</h2>
                        <p className="text-sm text-gray-600 dark:text-gray-300">Kelola tagihan piutang pelanggan / perusahaan.</p>
                    </div>
                    <Link href={route('kasir.faktur.create')} className="mt-4 md:mt-0 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg transition-all duration-200">
                        + Buat Faktur Baru
                    </Link>
                </div>

                <form onSubmit={handleSearch} className="mb-6">
                    <input
                        type="text"
                        name="search"
                        defaultValue={filters.search}
                        placeholder="Cari No Faktur atau Nama Perusahaan..."
                        className="w-full md:w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                    />
                </form>

                <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm bg-white/30 dark:bg-gray-900/30">
                    <table className="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-100/50 dark:bg-gray-800/50 dark:text-gray-300">
                            <tr>
                                <th className="px-6 py-4">No Faktur</th>
                                <th className="px-6 py-4">Tanggal</th>
                                <th className="px-6 py-4">Jatuh Tempo</th>
                                <th className="px-6 py-4">Perusahaan</th>
                                <th className="px-6 py-4 text-right">Total Tagihan</th>
                                <th className="px-6 py-4 text-right">Sudah Dibayar</th>
                                <th className="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {fakturs.data.length > 0 ? fakturs.data.map((f, idx) => (
                                <tr key={idx} className="border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td className="px-6 py-4 font-semibold text-indigo-600 dark:text-indigo-400">{f.no_faktur}</td>
                                    <td className="px-6 py-4">{f.tgl_faktur}</td>
                                    <td className="px-6 py-4 text-red-500">{f.tgl_jatuh_tempo}</td>
                                    <td className="px-6 py-4">{f.nama_perusahaan}</td>
                                    <td className="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-100">{formatRupiah(f.total_tagihan)}</td>
                                    <td className="px-6 py-4 text-right text-emerald-600">{formatRupiah(f.total_dibayar)}</td>
                                    <td className="px-6 py-4 text-center">
                                        <span className={`px-3 py-1 rounded-full text-xs font-bold ${
                                            f.status_pembayaran === 'Lunas' ? 'bg-emerald-100 text-emerald-800' :
                                            f.status_pembayaran === 'Parsial' ? 'bg-orange-100 text-orange-800' :
                                            'bg-red-100 text-red-800'
                                        }`}>
                                            {f.status_pembayaran}
                                        </span>
                                    </td>
                                </tr>
                            )) : (
                                <tr>
                                    <td colSpan="7" className="px-6 py-8 text-center text-gray-500">Belum ada data Faktur Penjualan.</td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
        </DashboardLayout>
    );
}
