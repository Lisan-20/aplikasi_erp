import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, router } from '@inertiajs/react';

export default function LabaRugi({ pendapatan, hpp, beban, total_pendapatan, total_hpp, total_beban, laba_kotor, laba_bersih, filters }) {
    const [startDate, setStartDate] = useState(filters.start_date || '');
    const [endDate, setEndDate] = useState(filters.end_date || '');

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    const handleFilter = (e) => {
        e.preventDefault();
        router.get(route('akuntansi.laporan.laba-rugi'), {
            start_date: startDate,
            end_date: endDate
        }, { preserveState: true });
    };

    return (
        <DashboardLayout>
            <Head title="Laba / Rugi (Income Statement)" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="flex flex-col md:flex-row justify-between items-center mb-8 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <div className="mb-4 md:mb-0 text-center md:text-left w-full">
                        <h2 className="text-3xl font-bold text-gray-800 dark:text-white mb-2 uppercase tracking-wide">Laporan Laba / Rugi</h2>
                        <p className="text-gray-600 dark:text-gray-300">
                            Periode: <span className="font-semibold text-indigo-600 dark:text-indigo-400">{startDate}</span> s/d <span className="font-semibold text-indigo-600 dark:text-indigo-400">{endDate}</span>
                        </p>
                    </div>
                    
                    <form onSubmit={handleFilter} className="flex space-x-2 w-full md:w-auto mt-4 md:mt-0">
                        <input
                            type="date"
                            className="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                        />
                        <span className="self-center text-gray-500">s/d</span>
                        <input
                            type="date"
                            className="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                            value={endDate}
                            onChange={(e) => setEndDate(e.target.value)}
                        />
                        <button type="submit" className="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                            Filter
                        </button>
                    </form>
                </div>

                <div className="max-w-4xl mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    
                    {/* Header PENDAPATAN */}
                    <div className="bg-emerald-50 dark:bg-emerald-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 className="text-xl font-bold text-emerald-800 dark:text-emerald-400">PENDAPATAN (REVENUE)</h3>
                    </div>
                    <div className="px-6 py-2">
                        {pendapatan.map((item, idx) => (
                            <div key={idx} className="flex justify-between py-2 border-b border-dashed border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                                <div>{item.kode_akun} - {item.nama_akun}</div>
                                <div className="font-medium">{formatRupiah(item.nilai)}</div>
                            </div>
                        ))}
                        <div className="flex justify-between py-3 font-bold text-emerald-700 dark:text-emerald-500 text-lg mt-2">
                            <div>Total Pendapatan</div>
                            <div>{formatRupiah(total_pendapatan)}</div>
                        </div>
                    </div>

                    {/* Header HPP */}
                    <div className="bg-orange-50 dark:bg-orange-900/20 px-6 py-4 border-y border-gray-200 dark:border-gray-700 mt-4">
                        <h3 className="text-xl font-bold text-orange-800 dark:text-orange-400">HARGA POKOK PENJUALAN (HPP)</h3>
                    </div>
                    <div className="px-6 py-2">
                        {hpp.map((item, idx) => (
                            <div key={idx} className="flex justify-between py-2 border-b border-dashed border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                                <div>{item.kode_akun} - {item.nama_akun}</div>
                                <div className="font-medium text-red-600 dark:text-red-400">({formatRupiah(item.nilai)})</div>
                            </div>
                        ))}
                        <div className="flex justify-between py-3 font-bold text-orange-700 dark:text-orange-500 text-lg mt-2 border-b border-gray-300 dark:border-gray-600">
                            <div>Total HPP</div>
                            <div className="text-red-600 dark:text-red-400">({formatRupiah(total_hpp)})</div>
                        </div>
                        <div className="flex justify-between py-4 font-black text-xl text-indigo-700 dark:text-indigo-400">
                            <div>LABA KOTOR (GROSS PROFIT)</div>
                            <div>{formatRupiah(laba_kotor)}</div>
                        </div>
                    </div>

                    {/* Header BEBAN */}
                    <div className="bg-red-50 dark:bg-red-900/20 px-6 py-4 border-y border-gray-200 dark:border-gray-700 mt-4">
                        <h3 className="text-xl font-bold text-red-800 dark:text-red-400">BIAYA OPERASIONAL & LAINNYA</h3>
                    </div>
                    <div className="px-6 py-2">
                        {beban.map((item, idx) => (
                            <div key={idx} className="flex justify-between py-2 border-b border-dashed border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">
                                <div>{item.kode_akun} - {item.nama_akun}</div>
                                <div className="font-medium text-red-600 dark:text-red-400">({formatRupiah(item.nilai)})</div>
                            </div>
                        ))}
                        <div className="flex justify-between py-3 font-bold text-red-700 dark:text-red-500 text-lg mt-2">
                            <div>Total Biaya</div>
                            <div className="text-red-600 dark:text-red-400">({formatRupiah(total_beban)})</div>
                        </div>
                    </div>

                    {/* LABA BERSIH */}
                    <div className={`px-6 py-8 border-t-4 ${laba_bersih >= 0 ? 'border-emerald-500 bg-emerald-100/50 dark:bg-emerald-900/30' : 'border-red-500 bg-red-100/50 dark:bg-red-900/30'}`}>
                        <div className="flex flex-col md:flex-row justify-between items-center">
                            <h3 className={`text-2xl font-black ${laba_bersih >= 0 ? 'text-emerald-800 dark:text-emerald-400' : 'text-red-800 dark:text-red-400'}`}>
                                LABA (RUGI) BERSIH
                            </h3>
                            <div className={`text-4xl font-black mt-2 md:mt-0 ${laba_bersih >= 0 ? 'text-emerald-600 dark:text-emerald-500' : 'text-red-600 dark:text-red-500'}`}>
                                {formatRupiah(laba_bersih)}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </DashboardLayout>
    );
}
