import React, { useState, useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, useForm, router } from '@inertiajs/react';
import { Search, Plus, Edit2, Trash2, X, Save } from 'lucide-react';
import Swal from 'sweetalert2';

export default function Index({ coas, parentCoas, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters?.search || '');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalTitle, setModalTitle] = useState('Tambah Akun');
    const [editId, setEditId] = useState(null);

    const { data, setData, post, put, processing, errors, reset, clearErrors } = useForm({
        kode_akun: '',
        nama_akun: '',
        level: 1,
        parent_id: '',
        tipe_akun: '',
        kategori: '',
        is_kas_bank: false,
        is_active: true
    });

    useEffect(() => {
        const timeout = setTimeout(() => {
            if (searchTerm !== (filters?.search || '')) {
                router.get(
                    route('akuntansi.coa'),
                    { search: searchTerm },
                    { preserveState: true, replace: true }
                );
            }
        }, 500);
        return () => clearTimeout(timeout);
    }, [searchTerm]);

    const openModal = (coa = null) => {
        clearErrors();
        if (coa) {
            setModalTitle('Edit Akun');
            setEditId(coa.id);
            setData({
                kode_akun: coa.kode_akun || '',
                nama_akun: coa.nama_akun || '',
                level: coa.level || 1,
                parent_id: coa.parent_id || '',
                tipe_akun: coa.tipe_akun || '',
                kategori: coa.kategori || '',
                is_kas_bank: coa.is_kas_bank ? true : false,
                is_active: coa.is_active ? true : false
            });
        } else {
            setModalTitle('Tambah Akun');
            setEditId(null);
            reset();
        }
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        reset();
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editId) {
            put(route('akuntansi.coa.update', editId), {
                onSuccess: () => closeModal()
            });
        } else {
            post(route('akuntansi.coa.store'), {
                onSuccess: () => closeModal()
            });
        }
    };

    const handleDelete = (id) => {
        Swal.fire({
            title: 'Hapus Akun?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#fff' : '#1e293b'
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('akuntansi.coa.destroy', id));
            }
        });
    };

    return (
        <DashboardLayout>
            <Head title="Chart of Accounts" />

            <div className="pl-container">
                <div className="glass-panel pl-header">
                    <div className="pl-title">
                        <h2>Master Chart of Accounts (COA)</h2>
                        <p>Kelola daftar akun buku besar perusahaan</p>
                    </div>
                    <div className="pl-actions">
                        <button onClick={() => openModal()} className="dash-btn primary">
                            <Plus size={18} />
                            <span>Tambah Akun</span>
                        </button>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar">
                        <div className="search-input-wrapper">
                            <Search size={18} />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari Kode atau Nama Akun..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="overflow-auto w-full flex-1">
                        <table className="pl-table">
                            <thead>
                                <tr>
                                    <th className="w-16">No</th>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Level</th>
                                    <th>Tipe Akun</th>
                                    <th>Kategori</th>
                                    <th className="text-center">Kas/Bank</th>
                                    <th className="text-center">Status</th>
                                    <th className="text-right w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {coas.data.map((coa, index) => (
                                    <tr key={coa.id}>
                                        <td>{(coas.current_page - 1) * coas.per_page + index + 1}</td>
                                        <td className="font-medium text-blue-600 dark:text-blue-400">{coa.kode_akun}</td>
                                        <td>{coa.nama_akun}</td>
                                        <td>Level {coa.level}</td>
                                        <td>{coa.tipe_akun || '-'}</td>
                                        <td>{coa.kategori || '-'}</td>
                                        <td className="text-center">
                                            {coa.is_kas_bank ? (
                                                <span className="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full">Ya</span>
                                            ) : (
                                                <span className="px-2 py-1 text-xs bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 rounded-full">Tidak</span>
                                            )}
                                        </td>
                                        <td className="text-center">
                                            {coa.is_active ? (
                                                <span className="px-2 py-1 text-xs bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-full">Aktif</span>
                                            ) : (
                                                <span className="px-2 py-1 text-xs bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 rounded-full">Nonaktif</span>
                                            )}
                                        </td>
                                        <td>
                                            <div className="flex justify-end gap-2">
                                                <button onClick={() => openModal(coa)} className="dash-icon-btn edit">
                                                    <Edit2 size={16} />
                                                </button>
                                                <button onClick={() => handleDelete(coa.id)} className="dash-icon-btn delete">
                                                    <Trash2 size={16} />
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                                {coas.data.length === 0 && (
                                    <tr>
                                        <td colSpan="9" className="text-center py-8 text-slate-500">
                                            Tidak ada data akun yang ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {coas.last_page > 1 && (
                    <div className="pagination">
                        {coas.links.map((link, idx) => (
                            <Link
                                key={idx}
                                href={link.url || '#'}
                                className={`page-link ${link.active ? 'active' : ''} ${!link.url ? 'disabled' : ''}`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                )}
            </div>

            {/* Modal Tambah/Edit */}
            {isModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
                    <div className="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
                        <div className="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-700">
                            <h3 className="text-lg font-semibold text-slate-900 dark:text-white">{modalTitle}</h3>
                            <button onClick={closeModal} className="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300">
                                <X size={20} />
                            </button>
                        </div>
                        <form onSubmit={handleSubmit} className="p-4 space-y-4">
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div className="space-y-1">
                                    <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Kode Akun *</label>
                                    <input
                                        type="text"
                                        className={`premium-input ${errors.kode_akun ? 'border-red-500' : ''}`}
                                        value={data.kode_akun}
                                        onChange={e => setData('kode_akun', e.target.value)}
                                        placeholder="Misal: 1101"
                                    />
                                    {errors.kode_akun && <p className="text-red-500 text-xs mt-1">{errors.kode_akun}</p>}
                                </div>
                                <div className="space-y-1">
                                    <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Nama Akun *</label>
                                    <input
                                        type="text"
                                        className={`premium-input ${errors.nama_akun ? 'border-red-500' : ''}`}
                                        value={data.nama_akun}
                                        onChange={e => setData('nama_akun', e.target.value)}
                                        placeholder="Misal: Kas Tunai"
                                    />
                                    {errors.nama_akun && <p className="text-red-500 text-xs mt-1">{errors.nama_akun}</p>}
                                </div>

                                <div className="space-y-1">
                                    <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Level</label>
                                    <select
                                        className="premium-input"
                                        value={data.level}
                                        onChange={e => setData('level', parseInt(e.target.value))}
                                    >
                                        {[1, 2, 3, 4, 5].map(lvl => (
                                            <option key={lvl} value={lvl}>Level {lvl}</option>
                                        ))}
                                    </select>
                                </div>

                                <div className="space-y-1">
                                    <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Tipe Akun</label>
                                    <select
                                        className="premium-input"
                                        value={data.tipe_akun}
                                        onChange={e => setData('tipe_akun', e.target.value)}
                                    >
                                        <option value="">Pilih Tipe</option>
                                        <option value="Aktiva Lancar">Aktiva Lancar</option>
                                        <option value="Aktiva Tetap">Aktiva Tetap</option>
                                        <option value="Kewajiban">Kewajiban / Hutang</option>
                                        <option value="Ekuitas">Ekuitas / Modal</option>
                                        <option value="Pendapatan">Pendapatan</option>
                                        <option value="HPP">Harga Pokok Penjualan (HPP)</option>
                                        <option value="Beban">Beban / Biaya</option>
                                    </select>
                                </div>

                                <div className="space-y-1">
                                    <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Induk Akun (Parent)</label>
                                    <select
                                        className="premium-input"
                                        value={data.parent_id}
                                        onChange={e => setData('parent_id', e.target.value)}
                                    >
                                        <option value="">-- Tidak Ada Induk --</option>
                                        {parentCoas.map(p => (
                                            <option key={p.id} value={p.id}>{p.kode_akun} - {p.nama_akun}</option>
                                        ))}
                                    </select>
                                </div>
                                
                                <div className="space-y-1">
                                    <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Kategori</label>
                                    <input
                                        type="text"
                                        className="premium-input"
                                        value={data.kategori}
                                        onChange={e => setData('kategori', e.target.value)}
                                        placeholder="Opsional (Misal: Header / Detail)"
                                    />
                                </div>
                            </div>
                            
                            <div className="flex gap-6 pt-2">
                                <label className="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        className="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                        checked={data.is_kas_bank}
                                        onChange={e => setData('is_kas_bank', e.target.checked)}
                                    />
                                    <span className="text-sm text-slate-700 dark:text-slate-300">Apakah ini Akun Kas / Bank?</span>
                                </label>

                                <label className="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        className="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                        checked={data.is_active}
                                        onChange={e => setData('is_active', e.target.checked)}
                                    />
                                    <span className="text-sm text-slate-700 dark:text-slate-300">Status Aktif</span>
                                </label>
                            </div>

                            <div className="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700 mt-4">
                                <button type="button" onClick={closeModal} className="dash-btn secondary">
                                    Batal
                                </button>
                                <button type="submit" disabled={processing} className="dash-btn primary">
                                    <Save size={18} />
                                    <span>{processing ? 'Menyimpan...' : 'Simpan'}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
