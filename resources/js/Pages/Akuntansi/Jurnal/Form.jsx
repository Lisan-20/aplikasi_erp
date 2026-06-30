import React, { useState, useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { Save, ArrowLeft, Plus, Trash2, AlertCircle } from 'lucide-react';
import Select from 'react-select';

export default function Form({ jurnal, coas }) {
    const isEdit = !!jurnal;
    
    // Konversi COA list ke format react-select
    const coaOptions = coas.map(coa => ({
        value: coa.id,
        label: `${coa.kode_akun} - ${coa.nama_akun}`
    }));

    const { data, setData, post, put, processing, errors } = useForm({
        no_jurnal: isEdit ? jurnal.no_jurnal : `JU-${new Date().toISOString().slice(0,10).replace(/-/g,'')}-${Math.floor(Math.random()*1000)}`,
        tgl_jurnal: isEdit ? jurnal.tgl_jurnal : new Date().toISOString().slice(0,10),
        keterangan: isEdit ? jurnal.keterangan : '',
        referensi: isEdit ? (jurnal.referensi || '') : '',
        details: isEdit ? jurnal.details.map(d => ({
            id: d.id,
            id_coa: d.id_coa,
            debit: d.debit,
            kredit: d.kredit,
            keterangan_detail: d.keterangan_detail || ''
        })) : [
            { id_coa: '', debit: 0, kredit: 0, keterangan_detail: '' },
            { id_coa: '', debit: 0, kredit: 0, keterangan_detail: '' }
        ]
    });

    const [totalDebit, setTotalDebit] = useState(0);
    const [totalKredit, setTotalKredit] = useState(0);

    useEffect(() => {
        const d = data.details.reduce((sum, item) => sum + (parseFloat(item.debit) || 0), 0);
        const k = data.details.reduce((sum, item) => sum + (parseFloat(item.kredit) || 0), 0);
        setTotalDebit(d);
        setTotalKredit(k);
    }, [data.details]);

    const handleDetailChange = (index, field, value) => {
        const newDetails = [...data.details];
        newDetails[index][field] = value;
        setData('details', newDetails);
    };

    const addRow = () => {
        setData('details', [...data.details, { id_coa: '', debit: 0, kredit: 0, keterangan_detail: '' }]);
    };

    const removeRow = (index) => {
        if (data.details.length <= 2) return; // minimal 2 row
        const newDetails = [...data.details];
        newDetails.splice(index, 1);
        setData('details', newDetails);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (isEdit) {
            put(route('akuntansi.jurnal.update', jurnal.id));
        } else {
            post(route('akuntansi.jurnal.store'));
        }
    };

    const formatCurrency = (amount) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    };

    const isBalanced = Math.abs(totalDebit - totalKredit) < 0.01;

    // Kustomisasi tema react-select untuk dark/light mode dan z-index
    const isDark = typeof document !== 'undefined' && document.documentElement.classList.contains('dark');
    
    const selectStyles = {
        control: (styles, { isFocused }) => ({ 
            ...styles, 
            backgroundColor: isDark ? '#1e293b' : '#fff',
            borderColor: isFocused ? '#3b82f6' : (isDark ? '#334155' : '#e2e8f0'),
            borderRadius: '0.5rem',
            padding: '0.125rem',
            boxShadow: isFocused ? '0 0 0 1px #3b82f6' : 'none',
            '&:hover': {
                borderColor: isFocused ? '#3b82f6' : (isDark ? '#475569' : '#cbd5e1')
            }
        }),
        menu: (styles) => ({
            ...styles,
            backgroundColor: isDark ? '#1e293b' : '#fff',
            zIndex: 9999,
            border: `1px solid ${isDark ? '#334155' : '#e2e8f0'}`
        }),
        menuPortal: base => ({ ...base, zIndex: 9999 }),
        option: (styles, { isFocused, isSelected }) => ({
            ...styles,
            backgroundColor: isSelected 
                ? '#3b82f6' 
                : isFocused 
                    ? (isDark ? '#334155' : '#f1f5f9') 
                    : 'transparent',
            color: isSelected 
                ? '#fff' 
                : (isDark ? '#f8fafc' : '#1e293b'),
            cursor: 'pointer'
        }),
        singleValue: (styles) => ({
            ...styles,
            color: isDark ? '#f8fafc' : '#1e293b'
        }),
        input: (styles) => ({
            ...styles,
            color: isDark ? '#f8fafc' : '#1e293b'
        }),
        placeholder: (styles) => ({
            ...styles,
            color: isDark ? '#94a3b8' : '#9ca3af'
        })
    };

    return (
        <DashboardLayout>
            <Head title={isEdit ? "Edit Jurnal" : "Tambah Jurnal"} />

            <div className="pl-container max-w-6xl mx-auto">
                <div className="pl-header dash-glass-panel mb-6">
                    <div className="pl-title">
                        <h2>{isEdit ? 'Edit Jurnal' : 'Tambah Jurnal Baru'}</h2>
                        <p>{isEdit ? 'Perbarui data jurnal' : 'Buat pencatatan jurnal umum baru'}</p>
                    </div>
                    <div className="pl-actions">
                        <Link href={route('akuntansi.jurnal')} className="dash-btn secondary">
                            <ArrowLeft size={18} />
                            <span>Kembali</span>
                        </Link>
                    </div>
                </div>

                {errors.balance && (
                    <div className="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-900/50 flex items-start gap-3">
                        <AlertCircle className="text-red-500 mt-0.5" size={20} />
                        <div>
                            <h4 className="text-sm font-semibold text-red-800 dark:text-red-300">Jurnal Tidak Balance!</h4>
                            <p className="text-sm text-red-600 dark:text-red-400 mt-1">{errors.balance}</p>
                        </div>
                    </div>
                )}
                {errors.error && (
                    <div className="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-900/50">
                        <p className="text-sm text-red-600 dark:text-red-400">{errors.error}</p>
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    {/* Header Jurnal */}
                    <div className="dash-glass-panel p-6 mb-6">
                        <h3 className="text-lg font-semibold text-slate-800 dark:text-white border-b border-slate-200 dark:border-slate-700 pb-3 mb-4">Informasi Jurnal</h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div className="space-y-1">
                                <label className="text-sm font-medium text-slate-700 dark:text-slate-300">No Jurnal *</label>
                                <input
                                    type="text"
                                    className={`premium-input ${errors.no_jurnal ? 'border-red-500' : ''}`}
                                    value={data.no_jurnal}
                                    onChange={e => setData('no_jurnal', e.target.value)}
                                />
                                {errors.no_jurnal && <p className="text-red-500 text-xs mt-1">{errors.no_jurnal}</p>}
                            </div>
                            <div className="space-y-1">
                                <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Tanggal *</label>
                                <input
                                    type="date"
                                    className={`premium-input ${errors.tgl_jurnal ? 'border-red-500' : ''}`}
                                    value={data.tgl_jurnal}
                                    onChange={e => setData('tgl_jurnal', e.target.value)}
                                />
                                {errors.tgl_jurnal && <p className="text-red-500 text-xs mt-1">{errors.tgl_jurnal}</p>}
                            </div>
                            <div className="space-y-1 lg:col-span-2">
                                <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Keterangan *</label>
                                <input
                                    type="text"
                                    className={`premium-input ${errors.keterangan ? 'border-red-500' : ''}`}
                                    value={data.keterangan}
                                    onChange={e => setData('keterangan', e.target.value)}
                                    placeholder="Penjelasan ringkas jurnal..."
                                />
                                {errors.keterangan && <p className="text-red-500 text-xs mt-1">{errors.keterangan}</p>}
                            </div>
                            <div className="space-y-1">
                                <label className="text-sm font-medium text-slate-700 dark:text-slate-300">Referensi</label>
                                <input
                                    type="text"
                                    className="premium-input"
                                    value={data.referensi}
                                    onChange={e => setData('referensi', e.target.value)}
                                    placeholder="No Dokumen/Faktur"
                                />
                            </div>
                        </div>
                    </div>

                    {/* Detail Jurnal */}
                    <div className="dash-glass-panel p-6 mb-6">
                        <div className="flex items-center justify-between border-b border-slate-200 dark:border-slate-700 pb-3 mb-4">
                            <h3 className="text-lg font-semibold text-slate-800 dark:text-white">Detail Transaksi</h3>
                            <button type="button" onClick={addRow} className="dash-btn secondary text-xs py-1.5">
                                <Plus size={16} /> Tambah Baris
                            </button>
                        </div>

                        <div className="overflow-x-auto">
                            <table className="w-full">
                                <thead>
                                    <tr className="text-left text-sm text-slate-600 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                                        <th className="pb-3 w-1/3">Akun (COA) *</th>
                                        <th className="pb-3 w-1/4">Keterangan Baris</th>
                                        <th className="pb-3 w-40 text-right">Debit *</th>
                                        <th className="pb-3 w-40 text-right">Kredit *</th>
                                        <th className="pb-3 w-12 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.details.map((detail, index) => (
                                        <tr key={index} className="border-b border-slate-100 dark:border-slate-800/50">
                                            <td className="py-3 pr-2" style={{"--input-bg": "transparent", "--text-color": "inherit"}}>
                                                <Select
                                                    options={coaOptions}
                                                    value={coaOptions.find(opt => opt.value === detail.id_coa) || null}
                                                    onChange={(opt) => handleDetailChange(index, 'id_coa', opt ? opt.value : '')}
                                                    placeholder="Pilih Akun..."
                                                    styles={selectStyles}
                                                    className="text-sm"
                                                    menuPortalTarget={document.body}
                                                    menuPosition="fixed"
                                                />
                                                {errors[`details.${index}.id_coa`] && <p className="text-red-500 text-xs mt-1">Harus diisi</p>}
                                            </td>
                                            <td className="py-3 px-2">
                                                <input
                                                    type="text"
                                                    className="premium-input text-sm"
                                                    value={detail.keterangan_detail}
                                                    onChange={e => handleDetailChange(index, 'keterangan_detail', e.target.value)}
                                                    placeholder="Catatan..."
                                                />
                                            </td>
                                            <td className="py-3 px-2">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    className={`premium-input text-sm text-right ${errors[`details.${index}.debit`] ? 'border-red-500' : ''}`}
                                                    value={detail.debit === 0 ? '' : detail.debit}
                                                    onChange={e => {
                                                        handleDetailChange(index, 'debit', e.target.value === '' ? 0 : parseFloat(e.target.value));
                                                        if(parseFloat(e.target.value) > 0) handleDetailChange(index, 'kredit', 0);
                                                    }}
                                                    placeholder="0"
                                                />
                                            </td>
                                            <td className="py-3 px-2">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    className={`premium-input text-sm text-right ${errors[`details.${index}.kredit`] ? 'border-red-500' : ''}`}
                                                    value={detail.kredit === 0 ? '' : detail.kredit}
                                                    onChange={e => {
                                                        handleDetailChange(index, 'kredit', e.target.value === '' ? 0 : parseFloat(e.target.value));
                                                        if(parseFloat(e.target.value) > 0) handleDetailChange(index, 'debit', 0);
                                                    }}
                                                    placeholder="0"
                                                />
                                            </td>
                                            <td className="py-3 text-center">
                                                <button
                                                    type="button"
                                                    onClick={() => removeRow(index)}
                                                    disabled={data.details.length <= 2}
                                                    className={`p-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors ${data.details.length <= 2 ? 'opacity-50 cursor-not-allowed' : ''}`}
                                                >
                                                    <Trash2 size={18} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                                <tfoot>
                                    <tr className="bg-slate-50 dark:bg-slate-800/50 font-semibold text-slate-800 dark:text-slate-200">
                                        <td colSpan="2" className="py-4 text-right px-4">TOTAL</td>
                                        <td className="py-4 px-2 text-right text-emerald-600 dark:text-emerald-400">
                                            {formatCurrency(totalDebit)}
                                        </td>
                                        <td className="py-4 px-2 text-right text-rose-600 dark:text-rose-400">
                                            {formatCurrency(totalKredit)}
                                        </td>
                                        <td></td>
                                    </tr>
                                    {!isBalanced && (
                                        <tr>
                                            <td colSpan="5" className="py-2 text-center text-red-500 text-sm italic font-medium bg-red-50 dark:bg-red-900/10">
                                                * Total Debit dan Kredit belum seimbang (Selisih: {formatCurrency(Math.abs(totalDebit - totalKredit))})
                                            </td>
                                        </tr>
                                    )}
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div className="flex justify-end gap-3">
                        <Link href={route('akuntansi.jurnal')} className="dash-btn secondary">
                            Batal
                        </Link>
                        <button type="submit" disabled={processing || !isBalanced} className="dash-btn primary shadow-blue-500/30 shadow-lg">
                            <Save size={18} />
                            <span>{processing ? 'Menyimpan...' : 'Simpan Jurnal'}</span>
                        </button>
                    </div>
                </form>
            </div>
        </DashboardLayout>
    );
}
