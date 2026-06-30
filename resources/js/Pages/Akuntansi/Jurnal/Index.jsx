import React, { useState, useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, router } from '@inertiajs/react';
import { Search, Plus, Edit2, Trash2, FileText, ChevronDown, ChevronUp } from 'lucide-react';
import Swal from 'sweetalert2';

export default function Index({ jurnals, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters?.search || '');
    const [expandedRow, setExpandedRow] = useState(null);

    useEffect(() => {
        const timeout = setTimeout(() => {
            if (searchTerm !== (filters?.search || '')) {
                router.get(
                    route('akuntansi.jurnal'),
                    { search: searchTerm },
                    { preserveState: true, replace: true }
                );
            }
        }, 500);
        return () => clearTimeout(timeout);
    }, [searchTerm]);

    const handleDelete = (id) => {
        Swal.fire({
            title: 'Hapus Jurnal?',
            text: "Data jurnal yang dihapus tidak dapat dikembalikan!",
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
                router.delete(route('akuntansi.jurnal.destroy', id));
            }
        });
    };

    const toggleRow = (id) => {
        if (expandedRow === id) {
            setExpandedRow(null);
        } else {
            setExpandedRow(id);
        }
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    };

    return (
        <DashboardLayout>
            <Head title="Jurnal Umum" />

            <div className="pl-container">
                <div className="glass-panel pl-header">
                    <div className="pl-title">
                        <h2>Jurnal Umum</h2>
                        <p>Kelola data jurnal transaksi keuangan</p>
                    </div>
                    <div className="pl-actions">
                        <Link href={route('akuntansi.jurnal.create')} className="dash-btn primary">
                            <Plus size={18} />
                            <span>Tambah Jurnal</span>
                        </Link>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <div className="search-bar">
                        <div className="search-input-wrapper">
                            <Search size={18} />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari No Jurnal atau Keterangan..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="overflow-auto w-full flex-1">
                        <table className="pl-table">
                            <thead>
                                <tr>
                                    <th className="w-10"></th>
                                    <th>No Jurnal</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Referensi</th>
                                    <th className="text-right">Total Debit</th>
                                    <th className="text-right">Total Kredit</th>
                                    <th className="text-right w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {jurnals.data.map((jurnal) => (
                                    <React.Fragment key={jurnal.id}>
                                        <tr className={expandedRow === jurnal.id ? 'bg-slate-50 dark:bg-slate-800/50' : ''}>
                                            <td className="text-center">
                                                <button onClick={() => toggleRow(jurnal.id)} className="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                                                    {expandedRow === jurnal.id ? <ChevronUp size={20} /> : <ChevronDown size={20} />}
                                                </button>
                                            </td>
                                            <td className="font-medium text-blue-600 dark:text-blue-400">{jurnal.no_jurnal}</td>
                                            <td>{jurnal.tgl_jurnal}</td>
                                            <td>{jurnal.keterangan}</td>
                                            <td>{jurnal.referensi || '-'}</td>
                                            <td className="text-right font-medium text-slate-700 dark:text-slate-300">{formatCurrency(jurnal.total_debit)}</td>
                                            <td className="text-right font-medium text-slate-700 dark:text-slate-300">{formatCurrency(jurnal.total_kredit)}</td>
                                            <td>
                                                <div className="flex justify-end gap-2">
                                                    <Link href={route('akuntansi.jurnal.edit', jurnal.id)} className="dash-icon-btn edit">
                                                        <Edit2 size={16} />
                                                    </Link>
                                                    <button onClick={() => handleDelete(jurnal.id)} className="dash-icon-btn delete">
                                                        <Trash2 size={16} />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        {expandedRow === jurnal.id && (
                                            <tr>
                                                <td colSpan="8" className="p-0 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                                                    <div className="p-4 pl-12 border-l-4 border-blue-500">
                                                        <h4 className="text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-2">
                                                            <FileText size={16} /> Detail Jurnal
                                                        </h4>
                                                        <table className="w-full text-sm">
                                                            <thead className="text-slate-500 dark:text-slate-400 text-left border-b border-slate-200 dark:border-slate-700">
                                                                <tr>
                                                                    <th className="py-2 font-medium">Kode Akun</th>
                                                                    <th className="py-2 font-medium">Nama Akun</th>
                                                                    <th className="py-2 font-medium">Keterangan</th>
                                                                    <th className="py-2 font-medium text-right">Debit</th>
                                                                    <th className="py-2 font-medium text-right">Kredit</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody className="divide-y divide-slate-100 dark:divide-slate-700/50">
                                                                {jurnal.details.map((detail) => (
                                                                    <tr key={detail.id}>
                                                                        <td className="py-2 text-slate-600 dark:text-slate-300 font-mono text-xs">{detail.coa?.kode_akun}</td>
                                                                        <td className="py-2 text-slate-700 dark:text-slate-200">{detail.coa?.nama_akun}</td>
                                                                        <td className="py-2 text-slate-500 dark:text-slate-400 italic text-xs">{detail.keterangan_detail || '-'}</td>
                                                                        <td className="py-2 text-right text-emerald-600 dark:text-emerald-400">{formatCurrency(detail.debit)}</td>
                                                                        <td className="py-2 text-right text-rose-600 dark:text-rose-400">{formatCurrency(detail.kredit)}</td>
                                                                    </tr>
                                                                ))}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        )}
                                    </React.Fragment>
                                ))}
                                {jurnals.data.length === 0 && (
                                    <tr>
                                        <td colSpan="8" className="text-center py-8 text-slate-500">
                                            Tidak ada data jurnal yang ditemukan.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {jurnals.last_page > 1 && (
                    <div className="pagination mt-4">
                        {jurnals.links.map((link, idx) => (
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
        </DashboardLayout>
    );
}
