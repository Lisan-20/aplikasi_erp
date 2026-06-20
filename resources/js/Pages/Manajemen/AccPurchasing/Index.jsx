import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, CheckCircle2, Clock, XCircle, FileCheck, Eye } from 'lucide-react';
import dayjs from 'dayjs';
import Swal from 'sweetalert2';

export default function AccPurchasingIndex({ prs, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [statusFilter, setStatusFilter] = useState(filters.status || 'belum');
    const [selectedPr, setSelectedPr] = useState(null);

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/manajemen/acc-purchasing', { search: searchTerm, status: statusFilter }, { preserveState: true });
    };

    const handleStatusFilter = (val) => {
        setStatusFilter(val);
        router.get('/manajemen/acc-purchasing', { search: searchTerm, status: val }, { preserveState: true });
    };

    const handleApprove = (id, kode) => {
        Swal.fire({
            title: 'Setujui PR?',
            text: `Anda akan menyetujui Permintaan Pembelian: ${kode}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                router.post(`/manajemen/acc-purchasing/${id}/approve`, {}, {
                    onSuccess: () => {
                        setSelectedPr(null);
                    }
                });
            }
        });
    };

    return (
        <DashboardLayout>
            <Head title="ACC Purchasing - Manajemen" />

            <div className="p-6 h-full flex flex-col gap-6">
                <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-800 flex items-center gap-2">
                            <FileCheck className="w-7 h-7 text-emerald-600" />
                            ACC Purchasing (PO Umum)
                        </h1>
                        <p className="text-gray-500 mt-1">Verifikasi dan persetujuan permintaan pembelian</p>
                    </div>
                </div>

                <div className="bg-white rounded-2xl shadow-sm border border-gray-100 flex-1 flex flex-col overflow-hidden">
                    <div className="p-4 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row justify-between gap-4">
                        <div className="flex bg-white border border-gray-200 rounded-lg p-1 w-full md:w-auto">
                            <button
                                onClick={() => handleStatusFilter('belum')}
                                className={`flex-1 md:flex-none px-4 py-2 rounded-md text-sm font-medium transition-colors ${statusFilter === 'belum' ? 'bg-emerald-50 text-emerald-700' : 'text-gray-500 hover:text-gray-700'}`}
                            >
                                Menunggu ACC
                            </button>
                            <button
                                onClick={() => handleStatusFilter('sudah')}
                                className={`flex-1 md:flex-none px-4 py-2 rounded-md text-sm font-medium transition-colors ${statusFilter === 'sudah' ? 'bg-blue-50 text-blue-700' : 'text-gray-500 hover:text-gray-700'}`}
                            >
                                Sudah ACC
                            </button>
                        </div>

                        <form onSubmit={handleSearch} className="relative w-full md:w-80">
                            <input
                                type="text"
                                placeholder="Cari Kode PR atau Supplier..."
                                className="w-full pl-11 pr-4 py-2 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all bg-white"
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                            <Search className="w-5 h-5 text-gray-400 absolute left-3.5 top-2.5" />
                            <button type="submit" className="hidden">Search</button>
                        </form>
                    </div>

                    <div className="flex-1 flex overflow-hidden">
                        {/* List PR */}
                        <div className={`w-full ${selectedPr ? 'hidden md:block md:w-1/2 lg:w-2/3 border-r border-gray-100' : ''} overflow-y-auto`}>
                            <table className="w-full text-left text-sm">
                                <thead>
                                    <tr>
                                        <th className="px-6 py-4 font-semibold">Kode PR</th>
                                        <th className="px-6 py-4 font-semibold">Supplier</th>
                                        <th className="px-6 py-4 font-semibold text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100">
                                    {prs.data.map((item, index) => (
                                        <tr 
                                            key={index} 
                                            className={`transition-colors cursor-pointer ${selectedPr?.id_tc_permohonan === item.id_tc_permohonan ? 'bg-emerald-50' : 'hover:bg-gray-50'}`}
                                            onClick={() => setSelectedPr(item)}
                                        >
                                            <td className="px-6 py-4">
                                                <div className="font-medium text-gray-800">{item.kode_permohonan}</div>
                                                <div className="text-xs text-gray-500 mt-1">{dayjs(item.tgl_permohonan).format('DD MMM YYYY')}</div>
                                            </td>
                                            <td className="px-6 py-4">
                                                <div className="text-gray-700">{item.nama_supplier || '-'}</div>
                                                <div className="text-xs text-gray-500 mt-1">{item.jml_brg} items</div>
                                            </td>
                                            <td className="px-6 py-4 text-center">
                                                {!item.no_acc ? (
                                                    <button 
                                                        onClick={(e) => { e.stopPropagation(); handleApprove(item.id_tc_permohonan, item.kode_permohonan); }}
                                                        className="px-3 py-1.5 bg-emerald-100 text-emerald-700 hover:bg-emerald-200 rounded-lg text-xs font-semibold transition-colors"
                                                    >
                                                        ACC Sekarang
                                                    </button>
                                                ) : (
                                                    <span className="text-emerald-600 font-medium text-xs flex items-center justify-center gap-1">
                                                        <CheckCircle2 className="w-4 h-4" /> Di-ACC
                                                    </span>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                    {prs.data.length === 0 && (
                                        <tr>
                                            <td colSpan="3" className="px-6 py-12 text-center text-gray-500">
                                                <div className="flex flex-col items-center justify-center">
                                                    <FileCheck className="w-12 h-12 text-gray-300 mb-3" />
                                                    <p>Tidak ada data PR yang ditemukan.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                            
                            {/* Pagination */}
                            {prs.links && prs.links.length > 3 && (
                                <div className="p-4 border-t border-gray-100 flex items-center justify-center bg-white">
                                    <div className="flex gap-1">
                                        {prs.links.map((link, i) => (
                                            <Link
                                                key={i}
                                                href={link.url || '#'}
                                                className={`px-3 py-1 rounded-lg text-xs font-medium transition-colors ${
                                                    link.active ? 'bg-emerald-600 text-white' : link.url ? 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' : 'bg-transparent text-gray-400 cursor-not-allowed'
                                                }`}
                                                dangerouslySetInnerHTML={{ __html: link.label }}
                                            />
                                        ))}
                                    </div>
                                </div>
                            )}
                        </div>

                        {/* PR Detail Panel */}
                        {selectedPr && (
                            <div className="w-full md:w-1/2 lg:w-1/3 bg-gray-50/50 flex flex-col h-full overflow-hidden border-l border-gray-100">
                                <div className="p-4 bg-white border-b border-gray-100 flex justify-between items-center shadow-sm z-10">
                                    <h3 className="font-semibold text-gray-800">Detail Permintaan</h3>
                                    <button onClick={() => setSelectedPr(null)} className="text-gray-400 hover:text-gray-600 md:hidden p-1">
                                        <XCircle className="w-5 h-5" />
                                    </button>
                                </div>
                                <div className="p-4 overflow-y-auto flex-1">
                                    <div className="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-4">
                                        <div className="grid grid-cols-2 gap-y-3 text-sm">
                                            <div className="text-gray-500">Kode PR</div>
                                            <div className="font-medium text-gray-800 text-right">{selectedPr.kode_permohonan}</div>
                                            <div className="text-gray-500">Tanggal</div>
                                            <div className="font-medium text-gray-800 text-right">{dayjs(selectedPr.tgl_permohonan).format('DD MMM YYYY HH:mm')}</div>
                                            <div className="text-gray-500">Supplier</div>
                                            <div className="font-medium text-gray-800 text-right">{selectedPr.nama_supplier}</div>
                                            <div className="text-gray-500">Status</div>
                                            <div className="text-right">
                                                {selectedPr.no_acc ? (
                                                    <span className="text-emerald-600 font-medium">Sudah di-ACC</span>
                                                ) : (
                                                    <span className="text-amber-600 font-medium">Menunggu ACC</span>
                                                )}
                                            </div>
                                            {selectedPr.no_acc && (
                                                <>
                                                    <div className="text-gray-500">No. ACC</div>
                                                    <div className="font-medium text-gray-800 text-right">{selectedPr.no_acc}</div>
                                                </>
                                            )}
                                        </div>
                                    </div>

                                    <h4 className="font-medium text-gray-700 mb-3 text-sm flex justify-between items-end">
                                        Daftar Barang
                                        <span className="text-xs text-gray-500 font-normal">{selectedPr.items?.length || 0} item</span>
                                    </h4>
                                    
                                    <div className="space-y-2">
                                        {selectedPr.items && selectedPr.items.map((item, idx) => (
                                            <div key={idx} className="bg-white p-3 rounded-lg border border-gray-100 shadow-sm flex justify-between items-center">
                                                <div>
                                                    <div className="text-sm font-medium text-gray-800">{item.nama_brg}</div>
                                                    <div className="text-xs text-gray-500 mt-0.5">Kode: {item.kode_brg}</div>
                                                </div>
                                                <div className="text-right">
                                                    <div className="text-sm font-bold text-gray-700">{item.jumlah_besar}</div>
                                                    <div className="text-xs text-gray-500">{item.satuan}</div>
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                                
                                {!selectedPr.no_acc && (
                                    <div className="p-4 bg-white border-t border-gray-100">
                                        <button 
                                            onClick={() => handleApprove(selectedPr.id_tc_permohonan, selectedPr.kode_permohonan)}
                                            className="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold shadow-sm transition-colors flex justify-center items-center gap-2"
                                        >
                                            <CheckCircle2 className="w-5 h-5" />
                                            Setujui Permintaan Ini
                                        </button>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </DashboardLayout>
    );
}
