import React, { useState, useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, useForm, router } from '@inertiajs/react';
import Select from 'react-select';

export default function Index({ hutangs, coa_sumber, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const { data, setData, post, processing, errors } = useForm({
        id_coa_sumber: null,
        pembayaran: [] // Array of { id, nominal_bayar }
    });

    const isDarkMode = document.documentElement.classList.contains('dark');

    const selectStyles = {
        menuPortal: base => ({ ...base, zIndex: 9999 }),
        control: (base) => ({
            ...base,
            backgroundColor: isDarkMode ? 'rgba(55, 65, 81, 0.5)' : 'rgba(255, 255, 255, 0.5)',
            borderColor: isDarkMode ? '#4B5563' : '#D1D5DB',
            color: isDarkMode ? 'white' : 'black',
            backdropFilter: 'blur(8px)',
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
            backgroundColor: state.isFocused 
                ? (isDarkMode ? '#374151' : '#F3F4F6') 
                : 'transparent',
            color: isDarkMode ? 'white' : 'black',
        }),
    };

    const coaOptions = coa_sumber.map(c => ({
        value: c.id,
        label: `${c.kode_akun} - ${c.nama_akun}`
    }));

    const handleSearch = (e) => {
        e.preventDefault();
        router.get(route('keuangan.pembayaran-hutang'), { search }, { preserveState: true });
    };

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    const getSisaHutang = (item) => {
        return parseFloat(item.total_hutang) - parseFloat(item.total_bayar || 0);
    };

    const handleCheck = (item) => {
        const sisa = getSisaHutang(item);
        const exists = data.pembayaran.find(p => p.id === item.id);
        
        if (exists) {
            setData('pembayaran', data.pembayaran.filter(p => p.id !== item.id));
        } else {
            setData('pembayaran', [...data.pembayaran, { id: item.id, nominal_bayar: sisa }]);
        }
    };

    const handleNominalChange = (id, value) => {
        const val = parseFloat(value) || 0;
        setData('pembayaran', data.pembayaran.map(p => 
            p.id === id ? { ...p, nominal_bayar: val } : p
        ));
    };

    const totalDibayar = data.pembayaran.reduce((sum, item) => sum + item.nominal_bayar, 0);

    const handleProses = () => {
        if (!data.id_coa_sumber) {
            alert('Pilih Akun Sumber Pembayaran (Kas/Bank) terlebih dahulu!');
            return;
        }
        if (data.pembayaran.length === 0) {
            alert('Pilih minimal satu hutang yang akan dibayar!');
            return;
        }

        if (confirm(`Proses pembayaran senilai ${formatRupiah(totalDibayar)} dari Akun tersebut?`)) {
            post(route('keuangan.pembayaran-hutang.proses'), {
                onSuccess: () => {
                    setData('pembayaran', []);
                }
            });
        }
    };

    return (
        <DashboardLayout>
            <Head title="Pembayaran Hutang" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                    <div className="mb-4 sm:mb-0">
                        <h2 className="text-2xl font-bold text-gray-800 dark:text-white mb-2">Pembayaran Hutang Supplier</h2>
                        <p className="text-sm text-gray-600 dark:text-gray-300">
                            Pilih tagihan yang ingin dibayar. Anda dapat membayar lunas atau melakukan cicilan secara parsial.
                        </p>
                    </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <form onSubmit={handleSearch}>
                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pencarian</label>
                        <div className="relative">
                            <input
                                type="text"
                                placeholder="Cari No Bukti / Faktur / Supplier..."
                                className="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 backdrop-blur-sm transition-all"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                            <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg className="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sumber Dana (Kas / Bank)</label>
                        <Select
                            options={coaOptions}
                            styles={selectStyles}
                            menuPortalTarget={document.body}
                            menuPosition="fixed"
                            placeholder="Pilih Akun Kas/Bank..."
                            onChange={(opt) => setData('id_coa_sumber', opt ? opt.value : null)}
                        />
                    </div>
                </div>

                {errors.error && (
                    <div className="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-400 rounded-lg">
                        {errors.error}
                    </div>
                )}
                
                {Object.keys(errors).length > 0 && !errors.error && (
                    <div className="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-400 rounded-lg">
                        Ada kesalahan pada input pembayaran Anda. Pastikan nominal bayar valid.
                    </div>
                )}

                <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm mb-4">
                    <table className="w-full text-sm text-left">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50/80 dark:bg-gray-700/80 dark:text-gray-300 backdrop-blur-sm">
                            <tr>
                                <th scope="col" className="px-6 py-4">Pilih</th>
                                <th scope="col" className="px-6 py-4">No. Bukti / Faktur</th>
                                <th scope="col" className="px-6 py-4">Supplier</th>
                                <th scope="col" className="px-6 py-4">Tgl Jatuh Tempo</th>
                                <th scope="col" className="px-6 py-4 text-right">Total Hutang</th>
                                <th scope="col" className="px-6 py-4 text-right">Sisa Hutang</th>
                                <th scope="col" className="px-6 py-4 text-right">Nominal Bayar (Input)</th>
                            </tr>
                        </thead>
                        <tbody>
                            {hutangs.data.length > 0 ? (
                                hutangs.data.map((item) => {
                                    const sisa = getSisaHutang(item);
                                    const paymentObj = data.pembayaran.find(p => p.id === item.id);
                                    const isChecked = !!paymentObj;

                                    return (
                                        <tr key={item.id} className={`${isChecked ? 'bg-indigo-50/50 dark:bg-indigo-900/20' : 'bg-white/40 dark:bg-gray-800/40'} border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors`}>
                                            <td className="px-6 py-4">
                                                <input 
                                                    type="checkbox" 
                                                    className="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                    checked={isChecked}
                                                    onChange={() => handleCheck(item)}
                                                />
                                            </td>
                                            <td className="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                                <div>{item.no_bukti}</div>
                                                <div className="text-xs text-gray-500">{item.no_faktur || '-'}</div>
                                            </td>
                                            <td className="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                {item.nama_supplier}
                                            </td>
                                            <td className="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                {item.tgl_tempo ? item.tgl_tempo.substring(0, 10) : '-'}
                                            </td>
                                            <td className="px-6 py-4 text-right text-gray-600 dark:text-gray-300">
                                                {formatRupiah(item.total_hutang)}
                                            </td>
                                            <td className="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-100">
                                                {formatRupiah(sisa)}
                                            </td>
                                            <td className="px-6 py-4 text-right">
                                                {isChecked ? (
                                                    <input
                                                        type="number"
                                                        max={sisa}
                                                        min={1}
                                                        className="w-32 text-right p-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                                        value={paymentObj.nominal_bayar}
                                                        onChange={(e) => handleNominalChange(item.id, e.target.value)}
                                                    />
                                                ) : (
                                                    <span className="text-gray-400">-</span>
                                                )}
                                            </td>
                                        </tr>
                                    );
                                })
                            ) : (
                                <tr>
                                    <td colSpan="7" className="px-6 py-8 text-center text-gray-500 dark:text-gray-400 bg-white/40 dark:bg-gray-800/40">
                                        Tidak ada hutang supplier yang perlu dibayar.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>

                <div className="flex flex-col sm:flex-row justify-between items-center p-4 bg-gray-50/50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div className="mb-4 sm:mb-0">
                        <span className="text-gray-600 dark:text-gray-400">Total Akan Dibayar:</span>
                        <div className="text-2xl font-bold text-gray-900 dark:text-white">
                            {formatRupiah(totalDibayar)}
                        </div>
                    </div>
                    <button
                        onClick={handleProses}
                        disabled={processing || data.pembayaran.length === 0}
                        className="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed text-lg"
                    >
                        {processing ? 'Memproses...' : 'Proses Pembayaran'}
                    </button>
                </div>

                {/* Pagination */}
                {hutangs.links && hutangs.links.length > 3 && (
                    <div className="flex flex-wrap justify-center gap-1 mt-6">
                        {hutangs.links.map((link, index) => (
                            <Link
                                key={index}
                                href={link.url || '#'}
                                className={`px-4 py-2 text-sm rounded-lg transition-all ${
                                    link.active 
                                        ? 'bg-indigo-600 text-white shadow-md' 
                                        : link.url 
                                            ? 'bg-white/50 dark:bg-gray-700/50 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 hover:shadow' 
                                            : 'bg-transparent text-gray-400 cursor-not-allowed'
                                }`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                )}
            </div>
        </DashboardLayout>
    );
}
