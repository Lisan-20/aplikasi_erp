import React, { useState, useEffect, useCallback } from 'react';
import { Head, Link } from '@inertiajs/react';
import { Search, ArrowLeft, CheckCircle, XCircle, Clock, Trash2, Edit } from 'lucide-react';
import axios from 'axios';
import '../../../css/pasien-lama.css';

export default function ListingJkn() {
    const [tab, setTab] = useState('baru');
    const [search, setSearch] = useState('');
    const [filterBy, setFilterBy] = useState('nomorkartu');
    const [data, setData] = useState({ data: [], current_page: 1, last_page: 1, total: 0 });
    const [loading, setLoading] = useState(false);
    const [page, setPage] = useState(1);

    const fetchData = useCallback(async () => {
        setLoading(true);
        try {
            const response = await axios.get('/registrasi/listing-jkn/data', {
                params: {
                    tab,
                    search,
                    filterBy,
                    page
                }
            });
            setData(response.data);
        } catch (error) {
            console.error('Error fetching data:', error);
        } finally {
            setLoading(false);
        }
    }, [tab, search, filterBy, page]);

    useEffect(() => {
        fetchData();
    }, [fetchData]);

    const handleSearch = (e) => {
        e.preventDefault();
        setPage(1);
        fetchData();
    };

    const handleTabChange = (newTab) => {
        setTab(newTab);
        setPage(1);
        setSearch('');
    };

    return (
        <>
            <Head title="Verifikasi Pendaftaran JKN Mobile" />
            
            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Verifikasi Pendaftaran JKN Mobile</h1>
                        <p>Listing pasien baru dari JKN Mobile</p>
                    </div>
                    <div className="pl-actions">
                        <Link href="/dashboard/2" className="btn btn-secondary">
                            <ArrowLeft size={16} />
                            Kembali
                        </Link>
                    </div>
                </div>

                {/* Tabs */}
                <div className="flex space-x-2 mb-4">
                    <button 
                        className={`px-4 py-2 rounded-lg font-medium transition-colors ${tab === 'baru' ? 'bg-blue-500 text-white shadow-lg' : 'bg-white/10 text-slate-700 hover:bg-white/20'}`}
                        onClick={() => handleTabChange('baru')}
                    >
                        Verifikasi Pasien Baru
                    </button>
                    <button 
                        className={`px-4 py-2 rounded-lg font-medium transition-colors ${tab === 'terverifikasi' ? 'bg-blue-500 text-white shadow-lg' : 'bg-white/10 text-slate-700 hover:bg-white/20'}`}
                        onClick={() => handleTabChange('terverifikasi')}
                    >
                        Hasil Terverifikasi
                    </button>
                    <button 
                        className={`px-4 py-2 rounded-lg font-medium transition-colors ${tab === 'reject' ? 'bg-blue-500 text-white shadow-lg' : 'bg-white/10 text-slate-700 hover:bg-white/20'}`}
                        onClick={() => handleTabChange('reject')}
                    >
                        Reject
                    </button>
                </div>

                <div className="glass-panel mb-4">
                    <form onSubmit={handleSearch} className="search-bar flex items-center space-x-2">
                        <select 
                            value={filterBy}
                            onChange={(e) => setFilterBy(e.target.value)}
                            className="bg-white/5 border border-white/20 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                            <option value="nomorkartu">Nomor Kartu</option>
                            <option value="ktp">KTP</option>
                            <option value="telpon">Telpon</option>
                            <option value="mr">No MR</option>
                            <option value="nama">Nama</option>
                            <option value="nasabah">Nasabah</option>
                        </select>

                        <div className="search-input-wrapper flex-1">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder={`Cari berdasarkan ${filterBy}...`}
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                        </div>
                        <button type="submit" className="btn btn-primary">
                            Cari
                        </button>
                    </form>
                </div>

                <div className="glass-panel table-wrap">
                    {loading ? (
                        <div className="flex justify-center p-8">
                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                        </div>
                    ) : (
                        <div className="table-responsive">
                            <table className="pl-table w-full text-left">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Entry</th>
                                        <th>Nomor Kartu</th>
                                        <th>KTP</th>
                                        <th>No. Telp</th>
                                        <th>Nasabah</th>
                                        <th>Poli</th>
                                        <th>No Rujukan</th>
                                        <th>Tgl Periksa</th>
                                        <th>Keluhan</th>
                                        {tab === 'baru' && <th>Aksi</th>}
                                    </tr>
                                </thead>
                                <tbody>
                                    {data.data && data.data.length > 0 ? (
                                        data.data.map((item, index) => (
                                            <tr key={index}>
                                                <td>{(data.current_page - 1) * 20 + index + 1}</td>
                                                <td>{item.tgl_input ? new Date(item.tgl_input).toLocaleDateString('id-ID') : '-'}</td>
                                                <td>
                                                    {tab === 'baru' ? (
                                                        <a href={`/legacy/mod_registrasi/edit_data_umum_jkn.php?id_pasien_jkn=${item.id_pasien_jkn}&rubah=1`} className="text-blue-500 font-bold hover:underline">
                                                            {item.nomorkartu?.replace(/\\/g, '') || '-'}
                                                        </a>
                                                    ) : (
                                                        <span className="font-bold">{item.nomorkartu?.replace(/\\/g, '') || '-'}</span>
                                                    )}
                                                </td>
                                                <td>{item.ktp || '-'}</td>
                                                <td className="text-green-600">{item.notlp || '-'}</td>
                                                <td className="text-green-600">BPJS</td>
                                                <td>{item.nama_bagian || '-'}</td>
                                                <td>{item.nomorreferensi || '-'}</td>
                                                <td>{item.tgl_R_periksa ? new Date(item.tgl_R_periksa).toLocaleDateString('id-ID') : '-'}</td>
                                                <td>{item.keluhan || '-'}</td>
                                                {tab === 'baru' && (
                                                    <td>
                                                        <button 
                                                            onClick={() => window.open(`/legacy/mod_registrasi/batal_daftar_jkn.php?id_pasien_jkn=${item.id_pasien_jkn}`, 'Batal', 'width=500,height=300')}
                                                            className="text-red-500 hover:text-red-700 transition-colors"
                                                            title="Batal Daftar"
                                                        >
                                                            <Trash2 size={16} />
                                                        </button>
                                                    </td>
                                                )}
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan={tab === 'baru' ? 11 : 10} className="text-center py-4 text-slate-500">
                                                Tidak ada data ditemukan.
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>

                {!loading && data.last_page > 1 && (
                    <div className="flex justify-between items-center mt-4">
                        <span className="text-sm text-slate-600">
                            Menampilkan {data.data.length} dari {data.total} data
                        </span>
                        <div className="flex space-x-1">
                            <button
                                onClick={() => setPage(p => Math.max(1, p - 1))}
                                disabled={page === 1}
                                className="px-3 py-1 rounded bg-white/5 border border-white/20 disabled:opacity-50"
                            >
                                Prev
                            </button>
                            <span className="px-3 py-1 bg-blue-500/10 text-blue-700 rounded border border-blue-200">
                                {page} / {data.last_page}
                            </span>
                            <button
                                onClick={() => setPage(p => Math.min(data.last_page, p + 1))}
                                disabled={page === data.last_page}
                                className="px-3 py-1 rounded bg-white/5 border border-white/20 disabled:opacity-50"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                )}
            </div>
        </>
    );
}
