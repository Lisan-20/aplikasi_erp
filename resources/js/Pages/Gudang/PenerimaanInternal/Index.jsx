import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { PackageOpen, Clock, CheckCircle2, Search, Package } from 'lucide-react';
import dayjs from 'dayjs';
import Swal from 'sweetalert2';

export default function PenerimaanInternalIndex({ penerimaan, filters, kode_bagian }) {
    const [statusFilter, setStatusFilter] = useState(filters.status || 'pending');
    const [isDetailOpen, setIsDetailOpen] = useState(false);
    const [selectedPenerimaan, setSelectedPenerimaan] = useState(null);

    const handleFilterChange = (newStatus) => {
        setStatusFilter(newStatus);
        router.get('/gudang/penerimaan-internal', { status: newStatus }, { preserveState: true });
    };

    const openDetail = async (id) => {
        try {
            const res = await fetch(`/gudang/penerimaan-internal/${id}`);
            const data = await res.json();
            setSelectedPenerimaan(data);
            setIsDetailOpen(true);
        } catch (err) {
            console.error("Gagal mengambil detail:", err);
            Swal.fire('Error', 'Gagal memuat detail penerimaan', 'error');
        }
    };

    const handleTerima = (id) => {
        Swal.fire({
            title: 'Terima Barang?',
            text: "Stok akan otomatis ditambahkan ke bagian Anda.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Terima!'
        }).then((result) => {
            if (result.isConfirmed) {
                router.post(`/gudang/penerimaan-internal/${id}/terima`, {}, {
                    preserveScroll: true
                });
            }
        });
    };

    return (
        <DashboardLayout title="Penerimaan Internal">
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <PackageOpen className="w-8 h-8 text-blue-600 dark:text-blue-400" />
                        <div>
                            <h1 className="text-xl font-bold text-gray-800 dark:text-white">Penerimaan Internal</h1>
                            <p className="text-sm text-gray-500">Konfirmasi penerimaan barang dari unit lain (Tujuan: {kode_bagian})</p>
                        </div>
                    </div>
                    <div className="pl-actions">
                        <div className="flex bg-gray-100 dark:bg-gray-800 p-1 rounded-lg">
                            <button
                                onClick={() => handleFilterChange('pending')}
                                className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                                    statusFilter === 'pending' 
                                        ? 'bg-white dark:bg-gray-700 text-blue-600 dark:text-blue-400 shadow-sm' 
                                        : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'
                                }`}
                            >
                                Menunggu Konfirmasi
                            </button>
                            <button
                                onClick={() => handleFilterChange('selesai')}
                                className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                                    statusFilter === 'selesai' 
                                        ? 'bg-white dark:bg-gray-700 text-green-600 dark:text-green-400 shadow-sm' 
                                        : 'text-gray-500 hover:text-gray-700 dark:text-gray-400'
                                }`}
                            >
                                Selesai
                            </button>
                        </div>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="overflow-x-auto w-full">
                        <table className="pl-table w-full">
                            <thead>
                                <tr>
                                    <th className="text-center w-16">No</th>
                                    <th>No. Dokumen</th>
                                    <th>Tgl Dikirim</th>
                                    <th>Asal Pengirim</th>
                                    <th>Petugas Pengirim</th>
                                    <th className="text-center">Status</th>
                                    {statusFilter === 'pending' && <th className="text-center">Aksi</th>}
                                </tr>
                            </thead>
                            <tbody>
                                {penerimaan.data && penerimaan.data.length > 0 ? (
                                    penerimaan.data.map((item, index) => (
                                        <tr key={index} className="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td className="text-center">{penerimaan.from + index}</td>
                                            <td className="font-medium text-blue-600 dark:text-blue-400">
                                                <button 
                                                    onClick={() => openDetail(item.id_tc_permintaan_inst)}
                                                    className="hover:underline text-left"
                                                    title="Lihat Detail"
                                                >
                                                    {item.nomor_permintaan}
                                                </button>
                                            </td>
                                            <td>{dayjs(item.tgl_permintaan).format('DD/MM/YYYY HH:mm')}</td>
                                            <td className="font-bold">{item.asal_bagian || item.kode_bagian_kirim}</td>
                                            <td>{item.pengirim || item.id_dd_user}</td>
                                            <td className="text-center">
                                                {statusFilter === 'pending' ? (
                                                    <span className="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium inline-flex items-center gap-1">
                                                        <Clock className="w-3 h-3" /> In Transit
                                                    </span>
                                                ) : (
                                                    <span className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium inline-flex items-center gap-1">
                                                        <CheckCircle2 className="w-3 h-3" /> Diterima
                                                    </span>
                                                )}
                                            </td>
                                            {statusFilter === 'pending' && (
                                                <td className="text-center">
                                                    <button 
                                                        onClick={() => handleTerima(item.id_tc_permintaan_inst)}
                                                        className="dash-btn primary btn-sm py-1 px-3 text-xs"
                                                    >
                                                        Terima
                                                    </button>
                                                </td>
                                            )}
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan={statusFilter === 'pending' ? 7 : 6} className="text-center py-12 text-gray-500">
                                            {statusFilter === 'pending' ? 'Tidak ada kiriman barang yang menunggu.' : 'Belum ada riwayat penerimaan selesai.'}
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {penerimaan && penerimaan.links && penerimaan.links.length > 3 && (
                    <div className="pagination">
                        {penerimaan.links.map((link, i) => (
                            <button
                                key={i}
                                onClick={() => link.url && router.get(link.url)}
                                disabled={!link.url}
                                className={`page-link ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                )}
            </div>

            {/* Modal Detail */}
            {isDetailOpen && selectedPenerimaan && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                    <div className="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden flex flex-col max-h-[90vh]">
                        
                        <div className="p-6 border-b dark:border-gray-800 flex justify-between items-start bg-gray-50 dark:bg-gray-800/50">
                            <div>
                                <div className="flex items-center gap-2 text-blue-600 dark:text-blue-400 mb-1">
                                    <Package className="w-5 h-5" />
                                    <h3 className="font-bold">Detail Pengiriman Internal</h3>
                                </div>
                                <h2 className="text-2xl font-bold text-gray-800 dark:text-white">{selectedPenerimaan.penerimaan.nomor_permintaan}</h2>
                            </div>
                            <div className="text-right">
                                {selectedPenerimaan.penerimaan.tgl_input_terima ? (
                                    <span className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider inline-flex items-center gap-1">
                                        <CheckCircle2 className="w-4 h-4" /> Telah Diterima
                                    </span>
                                ) : (
                                    <span className="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold uppercase tracking-wider inline-flex items-center gap-1">
                                        <Clock className="w-4 h-4" /> In Transit
                                    </span>
                                )}
                            </div>
                        </div>

                        <div className="p-6 overflow-y-auto">
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div className="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                                    <p className="text-xs text-gray-500 mb-1">Tanggal Dikirim</p>
                                    <p className="font-bold text-gray-800 dark:text-white">{dayjs(selectedPenerimaan.penerimaan.tgl_permintaan).format('DD/MM/YYYY HH:mm')}</p>
                                </div>
                                <div className="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                                    <p className="text-xs text-gray-500 mb-1">Asal Pengirim</p>
                                    <p className="font-bold text-gray-800 dark:text-white">{selectedPenerimaan.penerimaan.asal_bagian || selectedPenerimaan.penerimaan.kode_bagian_kirim}</p>
                                </div>
                                <div className="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                                    <p className="text-xs text-gray-500 mb-1">Petugas Pengirim</p>
                                    <p className="font-bold text-gray-800 dark:text-white">{selectedPenerimaan.penerimaan.pengirim || selectedPenerimaan.penerimaan.id_dd_user}</p>
                                </div>
                                <div className="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl">
                                    <p className="text-xs text-gray-500 mb-1">Penerima</p>
                                    <p className="font-bold text-gray-800 dark:text-white">
                                        {selectedPenerimaan.penerimaan.penerima || selectedPenerimaan.penerimaan.id_dd_user_terima || '-'}
                                    </p>
                                </div>
                            </div>
                            
                            <h4 className="font-bold text-gray-800 dark:text-white mb-3">Daftar Barang</h4>
                            <div className="border dark:border-gray-700 rounded-xl overflow-hidden">
                                <table className="w-full text-sm text-left">
                                    <thead className="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                                        <tr>
                                            <th className="px-4 py-3 font-medium">No</th>
                                            <th className="px-4 py-3 font-medium">Kode Barang</th>
                                            <th className="px-4 py-3 font-medium">Nama Barang</th>
                                            <th className="px-4 py-3 font-medium text-right">Jumlah</th>
                                            <th className="px-4 py-3 font-medium">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-gray-200 dark:divide-gray-700">
                                        {selectedPenerimaan.details.map((det, i) => (
                                            <tr key={i} className="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                                <td className="px-4 py-3">{i + 1}</td>
                                                <td className="px-4 py-3 font-mono text-xs">{det.kode_brg}</td>
                                                <td className="px-4 py-3 font-medium text-gray-800 dark:text-white">{det.nama_brg}</td>
                                                <td className="px-4 py-3 text-right font-bold text-blue-600 dark:text-blue-400">{Number(det.jumlah_permintaan).toLocaleString('id-ID')}</td>
                                                <td className="px-4 py-3 text-gray-500">{det.satuan_kecil}</td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div className="p-6 border-t dark:border-gray-800 flex justify-end gap-3 bg-gray-50 dark:bg-gray-800/50">
                            <button 
                                type="button"
                                className="dash-btn secondary"
                                onClick={() => setIsDetailOpen(false)}
                            >
                                Tutup
                            </button>
                            {!selectedPenerimaan.penerimaan.tgl_input_terima && (
                                <button 
                                    type="button"
                                    className="dash-btn primary"
                                    onClick={() => {
                                        setIsDetailOpen(false);
                                        handleTerima(selectedPenerimaan.penerimaan.id_tc_permintaan_inst);
                                    }}
                                >
                                    Konfirmasi Terima Barang
                                </button>
                            )}
                        </div>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
