import React, { useState, useEffect, useCallback } from 'react';
import { Head, useForm, router, Link } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Search, Plus, Edit2, Trash2, X, Factory } from 'lucide-react';
import Swal from 'sweetalert2';

export default function SupplierIndex({ suppliers, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters?.search || '');
    const [showModal, setShowModal] = useState(false);
    const [isEdit, setIsEdit] = useState(false);

    const { data, setData, post, put, reset, errors, clearErrors } = useForm({
        id: '',
        kode_supplier: '',
        nama_supplier: '',
        alamat: '',
        provinsi_id: '',
        kota_id: '',
        kota: '',
        provinsi: '',
        kodepos: '',
        telepon_1: '',
        telepon_2: '',
        kontak_person: '',
        npwp: '',
        izin_usaha: '',
        nama_bank: ''
    });

    const [provinsis, setProvinsis] = useState([]);
    const [kotas, setKotas] = useState([]);
    const [loadingWilayah, setLoadingWilayah] = useState(false);

    useEffect(() => {
        const timer = setTimeout(() => {
            if (searchTerm !== (filters?.search || '')) {
                router.get('/master/supplier', { search: searchTerm }, {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true
                });
            }
        }, 500);

        return () => clearTimeout(timer);
    }, [searchTerm, filters?.search]);

    // Fetch Provinsi list when modal opens
    useEffect(() => {
        if (showModal && provinsis.length === 0) {
            import('axios').then(({ default: axios }) => {
                axios.get('/admin/wilayah/api/provinsi', { params: { per_page: 100 } })
                    .then(res => setProvinsis(res.data.data || []))
                    .catch(console.error);
            });
        }
    }, [showModal]);

    // Fetch Kota list when provinsi_id changes
    useEffect(() => {
        if (data.provinsi_id) {
            setLoadingWilayah(true);
            import('axios').then(({ default: axios }) => {
                axios.get('/admin/wilayah/api/kota', { params: { provinsi_id: data.provinsi_id, per_page: 500 } })
                    .then(res => setKotas(res.data.data || []))
                    .catch(console.error)
                    .finally(() => setLoadingWilayah(false));
            });
        } else {
            setKotas([]);
        }
    }, [data.provinsi_id]);

    const handleAdd = () => {
        setIsEdit(false);
        reset();
        clearErrors();
        setShowModal(true);
    };

    const handleEdit = (supplier) => {
        setIsEdit(true);
        setData({
            id: supplier.id,
            kode_supplier: supplier.kode_supplier || '',
            nama_supplier: supplier.nama_supplier || '',
            alamat: supplier.alamat || '',
            provinsi_id: supplier.provinsi_id || '',
            kota_id: supplier.kota_id || '',
            kota: supplier.kota || '',
            provinsi: supplier.provinsi || '',
            kodepos: supplier.kodepos || '',
            telepon_1: supplier.telepon_1 || '',
            telepon_2: supplier.telepon_2 || '',
            kontak_person: supplier.kontak_person || '',
            npwp: supplier.npwp || '',
            izin_usaha: supplier.izin_usaha || '',
            nama_bank: supplier.nama_bank || ''
        });
        clearErrors();
        setShowModal(true);
    };

    const handleDelete = (id) => {
        Swal.fire({
            title: 'Hapus Supplier?',
            text: "Data akan dinonaktifkan dari sistem ERP.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete('/master/supplier/' + id, {
                    preserveScroll: true,
                    onSuccess: () => Swal.fire('Terhapus!', 'Supplier berhasil dihapus.', 'success')
                });
            }
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (isEdit) {
            put('/master/supplier/' + data.id, {
                onSuccess: () => {
                    setShowModal(false);
                    Swal.fire('Berhasil!', 'Data supplier diperbarui.', 'success');
                }
            });
        } else {
            post('/master/supplier', {
                onSuccess: () => {
                    setShowModal(false);
                    Swal.fire('Berhasil!', 'Supplier baru ditambahkan.', 'success');
                }
            });
        }
    };

    return (
        <DashboardLayout>
            <Head title="Master Supplier - ERP" />

            <div className="pl-container">
                {/* Header Area */}
                <div className="pl-header glass-panel mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div className="flex items-center gap-3">
                        <div className="p-3 bg-indigo-500/20 text-indigo-400 rounded-xl">
                            <Factory size={24} />
                        </div>
                        <div>
                            <h1 className="pl-title text-2xl font-bold text-slate-800 dark:text-white">Master Supplier</h1>
                            <p className="text-sm text-slate-500 dark:text-slate-400">Kelola data vendor dan pemasok (ERP)</p>
                        </div>
                    </div>

                    <div className="pl-actions flex gap-3 w-full md:w-auto">
                        <button onClick={handleAdd} className="dash-btn primary flex items-center justify-center gap-2 w-full md:w-auto">
                            <Plus size={18} />
                            <span>Tambah Supplier</span>
                        </button>
                    </div>
                </div>

                {/* Table Area */}
                <div className="glass-panel table-wrap p-6 rounded-2xl">
                    <div className="search-bar mb-6">
                        <div className="search-input-wrapper relative max-w-md">
                            <Search className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" size={20} />
                            <input
                                type="text"
                                className="search-input premium-input w-full pl-10 pr-4 py-2"
                                placeholder="Cari kode, nama, atau alamat..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="overflow-x-auto w-full">
                        <table className="pl-table w-full text-left border-collapse">
                            <thead>
                                <tr className="border-b border-slate-200 dark:border-slate-700/50 text-slate-500 dark:text-slate-400 text-sm">
                                    <th className="py-3 px-4 font-semibold">No</th>
                                    <th className="py-3 px-4 font-semibold">Kode</th>
                                    <th className="py-3 px-4 font-semibold">Nama Supplier</th>
                                    <th className="py-3 px-4 font-semibold">Kontak Person</th>
                                    <th className="py-3 px-4 font-semibold">Telepon</th>
                                    <th className="py-3 px-4 font-semibold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {suppliers.data.length > 0 ? (
                                    suppliers.data.map((item, index) => (
                                        <tr key={item.id} className="border-b border-slate-100 dark:border-slate-800/50 hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                            <td className="py-3 px-4">{(suppliers.current_page - 1) * suppliers.per_page + index + 1}</td>
                                            <td className="py-3 px-4 font-mono text-sm">{item.kode_supplier}</td>
                                            <td className="py-3 px-4">
                                                <div className="font-semibold text-slate-800 dark:text-slate-200">{item.nama_supplier}</div>
                                                <div className="text-xs text-slate-500 dark:text-slate-400 truncate max-w-xs">{item.alamat} {item.kota}</div>
                                            </td>
                                            <td className="py-3 px-4">{item.kontak_person || '-'}</td>
                                            <td className="py-3 px-4">{item.telepon_1 || '-'}</td>
                                            <td className="py-3 px-4 text-right">
                                                <div className="flex justify-end gap-2">
                                                    <button onClick={() => handleEdit(item)} className="dash-icon-btn text-blue-500 hover:bg-blue-500/10" title="Edit">
                                                        <Edit2 size={18} />
                                                    </button>
                                                    <button onClick={() => handleDelete(item.id)} className="dash-icon-btn text-red-500 hover:bg-red-500/10" title="Hapus">
                                                        <Trash2 size={18} />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="6" className="py-8 text-center text-slate-500 dark:text-slate-400">
                                            Tidak ada data supplier ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {suppliers.links && suppliers.links.length > 3 && (
                    <div className="pagination flex flex-wrap justify-center gap-1 mt-6">
                        {suppliers.links.map((link, key) => (
                            <Link
                                key={key}
                                href={link.url || '#'}
                                className={`px-4 py-2 text-sm rounded-lg border transition-all ${
                                    link.active 
                                        ? 'bg-blue-600 border-blue-600 text-white' 
                                        : !link.url 
                                            ? 'border-slate-200 dark:border-slate-700 text-slate-400 cursor-not-allowed opacity-50'
                                            : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-blue-500 dark:hover:border-blue-500'
                                }`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                                preserveScroll
                                preserveState
                            />
                        ))}
                    </div>
                )}
            </div>

            {/* Modal Add/Edit */}
            {showModal && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all">
                    <div className="bg-white dark:bg-slate-900 rounded-2xl w-full max-w-2xl shadow-2xl border border-slate-200 dark:border-slate-700/60 overflow-hidden flex flex-col max-h-[90vh]">
                        
                        <div className="flex justify-between items-center p-5 border-b border-slate-100 dark:border-slate-800">
                            <h3 className="text-xl font-bold text-slate-800 dark:text-white">
                                {isEdit ? 'Edit Supplier' : 'Tambah Supplier Baru'}
                            </h3>
                            <button onClick={() => setShowModal(false)} className="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                                <X size={24} />
                            </button>
                        </div>

                        <div className="p-5 overflow-y-auto custom-scrollbar">
                            <form id="supplierForm" onSubmit={handleSubmit} className="space-y-4">
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kode Supplier *</label>
                                        <input type="text" className="premium-input w-full" value={data.kode_supplier} onChange={e => setData('kode_supplier', e.target.value)} required />
                                        {errors.kode_supplier && <div className="text-red-500 text-xs mt-1">{errors.kode_supplier}</div>}
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Supplier *</label>
                                        <input type="text" className="premium-input w-full" value={data.nama_supplier} onChange={e => setData('nama_supplier', e.target.value)} required />
                                        {errors.nama_supplier && <div className="text-red-500 text-xs mt-1">{errors.nama_supplier}</div>}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Alamat</label>
                                    <textarea className="premium-input w-full min-h-[80px]" value={data.alamat} onChange={e => setData('alamat', e.target.value)}></textarea>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Provinsi</label>
                                        <select 
                                            className="premium-input w-full" 
                                            value={data.provinsi_id} 
                                            onChange={e => {
                                                const provId = e.target.value;
                                                const provName = provinsis.find(p => p.id == provId)?.nama_provinsi || '';
                                                setData(d => ({ ...d, provinsi_id: provId, provinsi: provName, kota_id: '', kota: '' }));
                                            }}
                                        >
                                            <option value="">-- Pilih Provinsi --</option>
                                            {provinsis.map(p => (
                                                <option key={p.id} value={p.id}>{p.nama_provinsi}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                            Kota {loadingWilayah && <span className="animate-pulse text-indigo-500">...</span>}
                                        </label>
                                        <select 
                                            className="premium-input w-full" 
                                            value={data.kota_id} 
                                            onChange={e => {
                                                const kotaId = e.target.value;
                                                const kotaName = kotas.find(k => k.id == kotaId)?.nama_kota || '';
                                                setData(d => ({ ...d, kota_id: kotaId, kota: kotaName }));
                                            }}
                                            disabled={!data.provinsi_id || loadingWilayah}
                                        >
                                            <option value="">-- Pilih Kota --</option>
                                            {kotas.map(k => (
                                                <option key={k.id} value={k.id}>{k.nama_kota}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kode Pos</label>
                                        <input type="text" className="premium-input w-full" value={data.kodepos} onChange={e => setData('kodepos', e.target.value)} />
                                    </div>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Telepon 1</label>
                                        <input type="text" className="premium-input w-full" value={data.telepon_1} onChange={e => setData('telepon_1', e.target.value)} />
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kontak Person</label>
                                        <input type="text" className="premium-input w-full" value={data.kontak_person} onChange={e => setData('kontak_person', e.target.value)} />
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NPWP</label>
                                        <input type="text" className="premium-input w-full" value={data.npwp} onChange={e => setData('npwp', e.target.value)} />
                                    </div>
                                </div>
                                
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Izin Usaha</label>
                                        <input type="text" className="premium-input w-full" placeholder="NIB / SIUP / dll" value={data.izin_usaha} onChange={e => setData('izin_usaha', e.target.value)} />
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bank</label>
                                        <input type="text" className="premium-input w-full" value={data.nama_bank} onChange={e => setData('nama_bank', e.target.value)} />
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div className="p-5 border-t border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/30 flex justify-end gap-3">
                            <button type="button" onClick={() => setShowModal(false)} className="dash-btn secondary">Batal</button>
                            <button type="submit" form="supplierForm" className="dash-btn primary">Simpan Data</button>
                        </div>
                        
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
