import React, { useState } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Head, router, useForm } from '@inertiajs/react';
import Select from 'react-select';

export default function Index({ piutangs, riwayat, coa_tujuan, filters }) {
    const [activeTab, setActiveTab] = useState('daftar');
    const { data, setData, post, processing, reset } = useForm({
        no_faktur: '',
        nominal_bayar: '',
        id_coa_tujuan: ''
    });

    const [modalOpen, setModalOpen] = useState(false);
    const [selectedFaktur, setSelectedFaktur] = useState(null);
    const [sisaPiutang, setSisaPiutang] = useState(0);

    const isDarkMode = document.documentElement.classList.contains('dark');

    const selectStyles = {
        menuPortal: base => ({ ...base, zIndex: 9999 }),
        control: (base) => ({
            ...base,
            backgroundColor: isDarkMode ? 'rgba(55, 65, 81, 0.5)' : 'rgba(255, 255, 255, 0.5)',
            borderColor: isDarkMode ? '#4B5563' : '#D1D5DB',
            color: isDarkMode ? 'white' : 'black',
        }),
        singleValue: (base) => ({ ...base, color: isDarkMode ? 'white' : 'black' }),
        menu: (base) => ({ ...base, backgroundColor: isDarkMode ? '#1F2937' : 'white' }),
        option: (base, state) => ({
            ...base,
            backgroundColor: state.isFocused ? (isDarkMode ? '#374151' : '#F3F4F6') : 'transparent',
            color: isDarkMode ? 'white' : 'black',
        }),
    };

    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number || 0);
    };

    const handleSearch = (e) => {
        e.preventDefault();
        const search = e.target.search.value;
        router.get(route('keuangan.penerimaan-piutang'), { search }, { preserveState: true });
    };

    const openModal = (faktur) => {
        setSelectedFaktur(faktur);
        const sisa = faktur.total_tagihan - faktur.total_dibayar;
        setSisaPiutang(sisa);
        setData({
            no_faktur: faktur.no_faktur,
            nominal_bayar: sisa,
            id_coa_tujuan: ''
        });
        setModalOpen(true);
    };

    const closeModal = () => {
        setModalOpen(false);
        setSelectedFaktur(null);
        reset();
    };

    const submitPembayaran = (e) => {
        e.preventDefault();
        if (confirm(`Proses penerimaan kas senilai ${formatRupiah(data.nominal_bayar)}?`)) {
            post(route('keuangan.penerimaan-piutang.proses'), {
                onSuccess: () => closeModal()
            });
        }
    };

    return (
        <DashboardLayout>
            <Head title="Penerimaan Piutang" />

            <div className="p-4 sm:p-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/30">
                <div className="flex flex-col md:flex-row justify-between items-center mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <div>
                        <h2 className="text-2xl font-bold text-gray-800 dark:text-white">Penerimaan Piutang B2B</h2>
                        <p className="text-sm text-gray-600 dark:text-gray-300">Catat penerimaan pembayaran dari pelanggan (Piutang Usaha).</p>
                    </div>
                </div>

                <div className="flex border-b border-gray-200 dark:border-gray-700 mb-6">
                    <button
                        onClick={() => setActiveTab('daftar')}
                        className={`py-3 px-6 text-sm font-medium border-b-2 transition-colors ${activeTab === 'daftar' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'}`}
                    >
                        Daftar Piutang B2B
                    </button>
                    <button
                        onClick={() => setActiveTab('riwayat')}
                        className={`py-3 px-6 text-sm font-medium border-b-2 transition-colors ${activeTab === 'riwayat' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'}`}
                    >
                        Riwayat Penerimaan
                    </button>
                </div>

                {activeTab === 'daftar' && (
                    <>
                        <form onSubmit={handleSearch} className="mb-6">
                            <input
                                type="text"
                                name="search"
                                defaultValue={filters.search}
                                placeholder="Cari No Faktur atau Perusahaan..."
                                className="w-full md:w-1/3 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white shadow-sm"
                            />
                        </form>

                <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm bg-white/30 dark:bg-gray-900/30">
                    <table className="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-100/50 dark:bg-gray-800/50 dark:text-gray-300">
                            <tr>
                                <th className="px-6 py-4">Faktur / Perusahaan</th>
                                <th className="px-6 py-4">Tgl. / Jatuh Tempo</th>
                                <th className="px-6 py-4 text-right">Total Tagihan</th>
                                <th className="px-6 py-4 text-right">Sisa Piutang</th>
                                <th className="px-6 py-4 text-center">Status</th>
                                <th className="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {piutangs.data.length > 0 ? piutangs.data.map((f, idx) => {
                                const sisa = f.total_tagihan - f.total_dibayar;
                                return (
                                    <tr key={idx} className="border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td className="px-6 py-4">
                                            <div className="font-bold text-indigo-600 dark:text-indigo-400">{f.no_faktur}</div>
                                            <div className="text-xs">{f.nama_perusahaan}</div>
                                        </td>
                                        <td className="px-6 py-4">
                                            <div>{f.tgl_faktur}</div>
                                            <div className="text-xs text-red-500 font-medium">JT: {f.tgl_jatuh_tempo}</div>
                                        </td>
                                        <td className="px-6 py-4 text-right font-medium text-gray-900 dark:text-gray-100">{formatRupiah(f.total_tagihan)}</td>
                                        <td className="px-6 py-4 text-right font-bold text-red-600 dark:text-red-400">{formatRupiah(sisa)}</td>
                                        <td className="px-6 py-4 text-center">
                                            <span className={`px-3 py-1 rounded-full text-xs font-bold ${
                                                f.status_pembayaran === 'Parsial' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800'
                                            }`}>
                                                {f.status_pembayaran}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 text-center">
                                            <button onClick={() => openModal(f)} className="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow-sm transition-colors text-xs">
                                                Terima Dana
                                            </button>
                                        </td>
                                    </tr>
                                );
                            }) : (
                                <tr>
                                    <td colSpan="6" className="px-6 py-8 text-center text-gray-500">Semua piutang telah lunas / tidak ada data.</td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
                </>
                )}

                {activeTab === 'riwayat' && (
                    <div className="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm bg-white/30 dark:bg-gray-900/30">
                        <table className="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-100/50 dark:bg-gray-800/50 dark:text-gray-300">
                                <tr>
                                    <th className="px-6 py-4">Tgl. Bayar</th>
                                    <th className="px-6 py-4">Faktur / Perusahaan</th>
                                    <th className="px-6 py-4 text-right">Nominal Diterima</th>
                                    <th className="px-6 py-4">Masuk Ke Kas/Bank</th>
                                    <th className="px-6 py-4">Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                {riwayat && riwayat.length > 0 ? riwayat.map((r, idx) => (
                                    <tr key={idx} className="border-b dark:border-gray-700 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td className="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{r.tgl_bayar}</td>
                                        <td className="px-6 py-4">
                                            <div className="font-bold text-indigo-600 dark:text-indigo-400">{r.no_faktur}</div>
                                            <div className="text-xs">{r.nama_perusahaan}</div>
                                        </td>
                                        <td className="px-6 py-4 text-right font-bold text-emerald-600 dark:text-emerald-400">{formatRupiah(r.nominal_bayar)}</td>
                                        <td className="px-6 py-4">
                                            <span className="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold dark:bg-blue-900/30 dark:text-blue-300">
                                                {r.nama_bank}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4">{r.petugas}</td>
                                    </tr>
                                )) : (
                                    <tr>
                                        <td colSpan="5" className="px-6 py-8 text-center text-gray-500">Belum ada riwayat penerimaan piutang.</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                )}
            </div>

            {/* Modal Pembayaran */}
            {modalOpen && selectedFaktur && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
                    <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md border border-gray-200 dark:border-gray-700 overflow-hidden transform transition-all">
                        <div className="px-6 py-4 bg-emerald-600">
                            <h3 className="text-xl font-bold text-white">Terima Dana Piutang</h3>
                        </div>
                        <div className="p-6">
                            <form onSubmit={submitPembayaran}>
                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No Faktur</label>
                                    <input type="text" value={selectedFaktur.no_faktur} readOnly className="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-lg border border-gray-300 dark:border-gray-600" />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Perusahaan</label>
                                    <input type="text" value={selectedFaktur.nama_perusahaan} readOnly className="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-lg border border-gray-300 dark:border-gray-600" />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sisa Piutang Saat Ini</label>
                                    <input type="text" value={formatRupiah(sisaPiutang)} readOnly className="w-full px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 font-bold rounded-lg border border-red-200 dark:border-red-800" />
                                </div>
                                
                                <hr className="my-6 border-gray-200 dark:border-gray-700" />

                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Uang Masuk ke Akun (Debit Kas/Bank)</label>
                                    <Select
                                        options={coa_tujuan.map(c => ({ value: c.id, label: `${c.kode_akun} - ${c.nama_akun}` }))}
                                        styles={selectStyles}
                                        menuPortalTarget={document.body}
                                        menuPosition="fixed"
                                        placeholder="Pilih Rekening Penerima..."
                                        onChange={(opt) => setData('id_coa_tujuan', opt ? opt.value : '')}
                                    />
                                </div>

                                <div className="mb-6">
                                    <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nominal Diterima (Rp)</label>
                                    <input
                                        type="number"
                                        className="w-full px-4 py-3 text-lg font-bold border border-emerald-300 dark:border-emerald-600 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/20 text-emerald-900 dark:text-emerald-100"
                                        value={data.nominal_bayar}
                                        max={sisaPiutang}
                                        onChange={(e) => setData('nominal_bayar', e.target.value)}
                                        required
                                    />
                                    <p className="text-xs text-gray-500 mt-1">Bisa diisi kurang dari tagihan untuk cicilan.</p>
                                </div>

                                <div className="flex justify-end space-x-3">
                                    <button type="button" onClick={closeModal} className="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-xl transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit" disabled={processing || !data.id_coa_tujuan} className="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg transition-colors disabled:opacity-50">
                                        Proses Jurnal & Terima Kas
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            )}
        </DashboardLayout>
    );
}
