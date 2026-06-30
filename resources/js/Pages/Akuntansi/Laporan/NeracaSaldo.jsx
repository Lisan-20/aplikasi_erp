import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, router } from '@inertiajs/react';

export default function NeracaSaldo({ laporan, total_debit_ns, total_kredit_ns, filters }) {
    const [startDate, setStartDate] = useState(filters.start_date || '');
    const [endDate, setEndDate] = useState(filters.end_date || '');

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    const handleFilter = (e) => {
        e.preventDefault();
        router.get(route('akuntansi.laporan.neraca-saldo'), {
            start_date: startDate,
            end_date: endDate
        }, { preserveState: true });
    };

    return (
        <DashboardLayout>
            <Head title="Neraca Saldo (Trial Balance)" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="flex flex-col md:flex-row justify-between items-center mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <div className="mb-4 md:mb-0">
                        <h2 className="text-2xl font-bold text-gray-800 dark:text-white mb-2">Neraca Saldo (Trial Balance)</h2>
                        <p className="text-sm text-gray-600 dark:text-gray-300">
                            Ringkasan saldo akhir seluruh akun (COA).
                        </p>
                    </div>
                    
                    <form onSubmit={handleFilter} className="flex space-x-2">
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

                <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm bg-white/30 dark:bg-gray-900/30">
                    <table className="w-full text-sm text-left">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-100/50 dark:bg-gray-800/50 dark:text-gray-300">
                            <tr>
                                <th rowSpan="2" className="px-6 py-4 align-middle border-b dark:border-gray-700">Kode Akun</th>
                                <th rowSpan="2" className="px-6 py-4 align-middle border-b dark:border-gray-700">Nama Akun</th>
                                <th colSpan="2" className="px-6 py-2 text-center border-b border-l dark:border-gray-700">Mutasi Periode</th>
                                <th colSpan="2" className="px-6 py-2 text-center border-b border-l dark:border-gray-700 text-indigo-700 dark:text-indigo-300">Saldo Akhir</th>
                            </tr>
                            <tr>
                                <th className="px-6 py-2 text-right border-l dark:border-gray-700 text-emerald-600">Debit</th>
                                <th className="px-6 py-2 text-right text-red-600">Kredit</th>
                                <th className="px-6 py-2 text-right border-l dark:border-gray-700 text-emerald-600">Debit</th>
                                <th className="px-6 py-2 text-right text-red-600">Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            {laporan && laporan.map((item, idx) => (
                                <tr key={idx} className={`${item.level === '1' ? 'font-bold bg-gray-50/50 dark:bg-gray-800/50' : ''} border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors`}>
                                    <td className="px-6 py-3 text-gray-900 dark:text-gray-100">{item.kode_akun}</td>
                                    <td className="px-6 py-3 text-gray-900 dark:text-gray-100">
                                        <div style={{ paddingLeft: `${(item.level - 1) * 1.5}rem` }}>
                                            {item.nama_akun}
                                        </div>
                                    </td>
                                    <td className="px-6 py-3 text-right border-l dark:border-gray-700 text-gray-600 dark:text-gray-400">{item.mutasi_debit > 0 ? formatRupiah(item.mutasi_debit) : '-'}</td>
                                    <td className="px-6 py-3 text-right text-gray-600 dark:text-gray-400">{item.mutasi_kredit > 0 ? formatRupiah(item.mutasi_kredit) : '-'}</td>
                                    <td className="px-6 py-3 text-right border-l dark:border-gray-700 text-emerald-600 dark:text-emerald-400">{item.saldo_debit > 0 ? formatRupiah(item.saldo_debit) : '-'}</td>
                                    <td className="px-6 py-3 text-right text-red-600 dark:text-red-400">{item.saldo_kredit > 0 ? formatRupiah(item.saldo_kredit) : '-'}</td>
                                </tr>
                            ))}
                            <tr className="bg-indigo-50/50 dark:bg-indigo-900/20 border-t-2 border-indigo-200 dark:border-indigo-700 font-bold text-lg">
                                <td colSpan="4" className="px-6 py-6 text-right text-indigo-900 dark:text-indigo-100">GRAND TOTAL (HARUS BALANCE)</td>
                                <td className="px-6 py-6 text-right text-emerald-700 dark:text-emerald-400">{formatRupiah(total_debit_ns)}</td>
                                <td className="px-6 py-6 text-right text-red-700 dark:text-red-400">{formatRupiah(total_kredit_ns)}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {/* Validation Indicator */}
                <div className="mt-6 flex justify-end">
                    {Math.abs(total_debit_ns - total_kredit_ns) < 0.01 ? (
                        <div className="px-6 py-3 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 rounded-lg border border-emerald-300 dark:border-emerald-700 font-bold flex items-center shadow-sm">
                            <svg className="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7"></path></svg>
                            NERACA SEIMBANG (BALANCE)
                        </div>
                    ) : (
                        <div className="px-6 py-3 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 rounded-lg border border-red-300 dark:border-red-700 font-bold flex items-center shadow-sm">
                            <svg className="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            TIDAK SEIMBANG! (Selisih: {formatRupiah(Math.abs(total_debit_ns - total_kredit_ns))})
                        </div>
                    )}
                </div>

            </div>
        </DashboardLayout>
    );
}
