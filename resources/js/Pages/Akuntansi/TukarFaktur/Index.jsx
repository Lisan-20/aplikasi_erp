import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, useForm, router } from '@inertiajs/react';

export default function Index({ penerimaans, filters }) {
    const [search, setSearch] = useState(filters.search || '');
    const { data, setData, post, processing, errors } = useForm({
        penerimaan_ids: []
    });

    const handleSearch = (e) => {
        e.preventDefault();
        router.get(route('akuntansi.tukar-faktur'), { search }, { preserveState: true });
    };

    const handleCheck = (id) => {
        if (data.penerimaan_ids.includes(id)) {
            setData('penerimaan_ids', data.penerimaan_ids.filter(i => i !== id));
        } else {
            setData('penerimaan_ids', [...data.penerimaan_ids, id]);
        }
    };

    const handleCheckAll = (e) => {
        if (e.target.checked) {
            setData('penerimaan_ids', penerimaans.data.map(p => p.id));
        } else {
            setData('penerimaan_ids', []);
        }
    };

    const handleProses = () => {
        if (data.penerimaan_ids.length === 0) {
            alert('Pilih minimal satu faktur untuk diproses!');
            return;
        }

        if (confirm(`Anda yakin akan memproses tukar faktur untuk ${data.penerimaan_ids.length} dokumen ini? Ini akan men-generate Jurnal Hutang secara otomatis.`)) {
            post(route('akuntansi.tukar-faktur.proses'), {
                onSuccess: () => {
                    setData('penerimaan_ids', []);
                }
            });
        }
    };

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    return (
        <DashboardLayout>
            <Head title="Tukar Faktur (Verifikasi Hutang)" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="flex justify-between items-center mb-6">
                    <div>
                        <h2 className="text-2xl font-bold text-gray-800 dark:text-white mb-2">Tukar Faktur</h2>
                        <p className="text-sm text-gray-600 dark:text-gray-300">
                            Verifikasi penerimaan fisik gudang (LPB) menjadi pengakuan Hutang Dagang di Akuntansi.
                        </p>
                    </div>
                </div>

                <div className="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-3 sm:space-y-0">
                    <form onSubmit={handleSearch} className="w-full sm:w-1/3">
                        <div className="relative">
                            <input
                                type="text"
                                placeholder="Cari No LPB / Faktur / Supplier..."
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

                    <button
                        onClick={handleProses}
                        disabled={processing || data.penerimaan_ids.length === 0}
                        className="w-full sm:w-auto px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        {processing ? 'Memproses...' : `Proses Jurnal Hutang (${data.penerimaan_ids.length})`}
                    </button>
                </div>

                {errors.error && (
                    <div className="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-400 rounded-lg">
                        {errors.error}
                    </div>
                )}

                <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <table className="w-full text-sm text-left">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50/80 dark:bg-gray-700/80 dark:text-gray-300 backdrop-blur-sm">
                            <tr>
                                <th scope="col" className="px-6 py-4">
                                    <input 
                                        type="checkbox" 
                                        className="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        onChange={handleCheckAll}
                                        checked={penerimaans.data.length > 0 && data.penerimaan_ids.length === penerimaans.data.length}
                                    />
                                </th>
                                <th scope="col" className="px-6 py-4">Tgl Terima</th>
                                <th scope="col" className="px-6 py-4">No. Penerimaan (LPB)</th>
                                <th scope="col" className="px-6 py-4">Supplier</th>
                                <th scope="col" className="px-6 py-4">No. Faktur</th>
                                <th scope="col" className="px-6 py-4 text-right">Nilai Hutang (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            {penerimaans.data.length > 0 ? (
                                penerimaans.data.map((item) => (
                                    <tr key={item.id} className="bg-white/40 dark:bg-gray-800/40 border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td className="px-6 py-4">
                                            <input 
                                                type="checkbox" 
                                                className="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                checked={data.penerimaan_ids.includes(item.id)}
                                                onChange={() => handleCheck(item.id)}
                                            />
                                        </td>
                                        <td className="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {item.tgl_terima ? item.tgl_terima.substring(0,10) : '-'}
                                        </td>
                                        <td className="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                            {item.no_penerimaan}
                                        </td>
                                        <td className="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {item.nama_supplier || '-'}
                                        </td>
                                        <td className="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {item.no_faktur_supplier || '-'}
                                        </td>
                                        <td className="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-100">
                                            {formatRupiah(item.total_hutang)}
                                            {item.ppn > 0 && (
                                                <div className="text-xs text-emerald-600 dark:text-emerald-400 font-normal">
                                                    (+PPN)
                                                </div>
                                            )}
                                        </td>
                                    </tr>
                                ))
                            ) : (
                                <tr>
                                    <td colSpan="6" className="px-6 py-8 text-center text-gray-500 dark:text-gray-400 bg-white/40 dark:bg-gray-800/40">
                                        Tidak ada dokumen penerimaan yang menunggu tukar faktur.
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>

                {/* Pagination */}
                {penerimaans.links && penerimaans.links.length > 3 && (
                    <div className="flex flex-wrap justify-center gap-1 mt-6">
                        {penerimaans.links.map((link, index) => (
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
