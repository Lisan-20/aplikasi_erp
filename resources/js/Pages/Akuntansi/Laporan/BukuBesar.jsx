import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, router } from '@inertiajs/react';
import Select from 'react-select';

export default function BukuBesar({ coas, filters, selected_coa, saldo_awal, transaksi }) {
    const [idCoa, setIdCoa] = useState(filters.id_coa || null);
    const [startDate, setStartDate] = useState(filters.start_date || '');
    const [endDate, setEndDate] = useState(filters.end_date || '');

    const isDarkMode = document.documentElement.classList.contains('dark');

    const selectStyles = {
        menuPortal: base => ({ ...base, zIndex: 9999 }),
        control: (base) => ({
            ...base,
            backgroundColor: isDarkMode ? 'rgba(55, 65, 81, 0.5)' : 'rgba(255, 255, 255, 0.5)',
            borderColor: isDarkMode ? '#4B5563' : '#D1D5DB',
            color: isDarkMode ? 'white' : 'black',
        }),
        singleValue: (base) => ({
            ...base,
            color: isDarkMode ? 'white' : 'black',
        }),
        menu: (base) => ({
            ...base,
            backgroundColor: isDarkMode ? '#1F2937' : 'white',
        }),
        option: (base, state) => ({
            ...base,
            backgroundColor: state.isFocused ? (isDarkMode ? '#374151' : '#F3F4F6') : 'transparent',
            color: isDarkMode ? 'white' : 'black',
        }),
    };

    const coaOptions = coas.map(c => ({
        value: c.id,
        label: `${c.kode_akun} - ${c.nama_akun}`
    }));

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    const handleFilter = (e) => {
        e.preventDefault();
        router.get(route('akuntansi.laporan.buku-besar'), {
            id_coa: idCoa,
            start_date: startDate,
            end_date: endDate
        }, { preserveState: true });
    };

    const getNormalBalance = (kode) => {
        const prefix = kode.substring(0, 1);
        if (['1', '5', '6', '7'].includes(prefix)) return 'D';
        return 'K';
    };

    let runningBalance = parseFloat(saldo_awal || 0);
    const isD = selected_coa ? getNormalBalance(selected_coa.kode_akun) === 'D' : true;

    return (
        <DashboardLayout>
            <Head title="Buku Besar (General Ledger)" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <h2 className="text-2xl font-bold text-gray-800 dark:text-white mb-2">Buku Besar (General Ledger)</h2>
                    <p className="text-sm text-gray-600 dark:text-gray-300">
                        Laporan perincian mutasi transaksi per Akun (COA).
                    </p>
                </div>

                <form onSubmit={handleFilter} className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div className="md:col-span-2">
                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Akun (COA)</label>
                        <Select
                            options={coaOptions}
                            styles={selectStyles}
                            menuPortalTarget={document.body}
                            menuPosition="fixed"
                            placeholder="Ketik/Pilih COA..."
                            value={coaOptions.find(o => o.value === idCoa) || null}
                            onChange={(opt) => setIdCoa(opt ? opt.value : null)}
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai</label>
                        <input
                            type="date"
                            className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                        />
                    </div>
                    <div className="flex items-end">
                        <div className="w-full">
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Akhir</label>
                            <input
                                type="date"
                                className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
                                value={endDate}
                                onChange={(e) => setEndDate(e.target.value)}
                            />
                        </div>
                        <button type="submit" className="ml-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors h-[42px]">
                            Tampilkan
                        </button>
                    </div>
                </form>

                {selected_coa && (
                    <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm bg-white/30 dark:bg-gray-900/30">
                        <div className="p-4 bg-gray-50/80 dark:bg-gray-700/80 border-b dark:border-gray-700 flex justify-between items-center">
                            <div>
                                <h3 className="font-bold text-gray-800 dark:text-white">{selected_coa.kode_akun} - {selected_coa.nama_akun}</h3>
                                <p className="text-xs text-gray-500 dark:text-gray-400">Normal Balance: {isD ? 'Debit' : 'Kredit'}</p>
                            </div>
                        </div>
                        <table className="w-full text-sm text-left">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-100/50 dark:bg-gray-800/50 dark:text-gray-300">
                                <tr>
                                    <th className="px-6 py-4">Tanggal</th>
                                    <th className="px-6 py-4">No Jurnal</th>
                                    <th className="px-6 py-4">Keterangan</th>
                                    <th className="px-6 py-4 text-right text-emerald-600 dark:text-emerald-400">Debit (Rp)</th>
                                    <th className="px-6 py-4 text-right text-red-600 dark:text-red-400">Kredit (Rp)</th>
                                    <th className="px-6 py-4 text-right text-indigo-600 dark:text-indigo-400">Saldo (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr className="bg-gray-50/50 dark:bg-gray-800/50 border-b dark:border-gray-700 font-semibold">
                                    <td colSpan="3" className="px-6 py-4 text-right">Saldo Awal per {startDate}</td>
                                    <td className="px-6 py-4"></td>
                                    <td className="px-6 py-4"></td>
                                    <td className="px-6 py-4 text-right text-indigo-600 dark:text-indigo-400">{formatRupiah(runningBalance)}</td>
                                </tr>
                                {transaksi && transaksi.map((t, idx) => {
                                    const deb = parseFloat(t.debit);
                                    const kre = parseFloat(t.kredit);
                                    if (isD) {
                                        runningBalance += deb - kre;
                                    } else {
                                        runningBalance += kre - deb;
                                    }
                                    return (
                                        <tr key={idx} className="border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td className="px-6 py-4 text-gray-900 dark:text-gray-100">{t.tgl_jurnal.substring(0,10)}</td>
                                            <td className="px-6 py-4 text-gray-900 dark:text-gray-100">{t.no_jurnal}</td>
                                            <td className="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                <div>{t.keterangan_detail}</div>
                                                <div className="text-xs text-gray-500">{t.keterangan_jurnal}</div>
                                            </td>
                                            <td className="px-6 py-4 text-right text-emerald-600 dark:text-emerald-400">{deb > 0 ? formatRupiah(deb) : '-'}</td>
                                            <td className="px-6 py-4 text-right text-red-600 dark:text-red-400">{kre > 0 ? formatRupiah(kre) : '-'}</td>
                                            <td className="px-6 py-4 text-right text-indigo-600 dark:text-indigo-400 font-medium">{formatRupiah(runningBalance)}</td>
                                        </tr>
                                    );
                                })}
                                <tr className="bg-indigo-50/50 dark:bg-indigo-900/20 border-t-2 border-indigo-200 dark:border-indigo-700 font-bold">
                                    <td colSpan="3" className="px-6 py-4 text-right text-indigo-900 dark:text-indigo-100">Saldo Akhir per {endDate}</td>
                                    <td className="px-6 py-4"></td>
                                    <td className="px-6 py-4"></td>
                                    <td className="px-6 py-4 text-right text-indigo-700 dark:text-indigo-300">{formatRupiah(runningBalance)}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                )}

                {!selected_coa && (
                    <div className="text-center py-12 text-gray-500 dark:text-gray-400">
                        Silakan pilih Akun (COA) untuk menampilkan Buku Besar.
                    </div>
                )}
            </div>
        </DashboardLayout>
    );
}
