import React, { useState, useEffect } from 'react';
import { Head, useForm, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Plus, Edit, Trash2, Search, Users, MapPin, Briefcase, User, Mail, Phone, Calendar } from 'lucide-react';
import FormModal from '@/Components/FormModal';
import Swal from 'sweetalert2';

export default function Index({ karyawan, bagian, filters }) {
    const [searchTerm, setSearchTerm] = useState(filters?.search || '');
    const [activeTab, setActiveTab] = useState(filters?.status || '1');
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingId, setEditingId] = useState(null);

    const { data, setData, post, put, reset, errors, clearErrors } = useForm({
        nama_pegawai: '',
        kode_bagian: '',
        no_ktp: '',
        tgl_lahir: '',
        tmp_lahir: '',
        alamat: '',
        tlp: '',
        id_sex: 1,
        id_dc_kawin: 1,
        npwp: '',
        email: '',
        provinsi_id: '',
        provinsi: '',
        kota_id: '',
        kota: '',
        kecamatan_id: '',
        kecamatan: '',
        kelurahan_id: '',
        kelurahan: '',
        status: 1
    });

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/hrd/data-pegawai', { search: searchTerm, status: activeTab }, { preserveState: true, replace: true });
    };

    const handleTabChange = (status) => {
        setActiveTab(status);
        router.get('/hrd/data-pegawai', { search: searchTerm, status: status }, { preserveState: true, replace: true });
    };

    const openModal = (karyawanData = null) => {
        clearErrors();
        if (karyawanData) {
            setEditingId(karyawanData.no_induk);
            setData({
                nama_pegawai: karyawanData.nama_pegawai || '',
                kode_bagian: karyawanData.kode_bagian || '',
                no_ktp: karyawanData.no_ktp || '',
                tgl_lahir: karyawanData.tgl_lahir ? karyawanData.tgl_lahir.split(' ')[0] : '',
                tmp_lahir: karyawanData.tmp_lahir || '',
                alamat: karyawanData.alamat || '',
                tlp: karyawanData.tlp || '',
                id_sex: karyawanData.id_sex || 1,
                id_dc_kawin: karyawanData.id_dc_kawin || 1,
                npwp: karyawanData.npwp || '',
                email: karyawanData.email || '',
                provinsi_id: karyawanData.provinsi_id || '',
                provinsi: karyawanData.provinsi || '',
                kota_id: karyawanData.kota_id || '',
                kota: karyawanData.kota || '',
                kecamatan_id: karyawanData.kecamatan_id || '',
                kecamatan: karyawanData.kecamatan || '',
                kelurahan_id: karyawanData.kelurahan_id || '',
                kelurahan: karyawanData.kelurahan || '',
                status: karyawanData.status ?? 1
            });
        } else {
            setEditingId(null);
            reset();
        }
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        reset();
        setEditingId(null);
    };

    const [provinsis, setProvinsis] = useState([]);
    const [kotas, setKotas] = useState([]);
    const [kecamatans, setKecamatans] = useState([]);
    const [kelurahans, setKelurahans] = useState([]);
    const [loadingWilayah, setLoadingWilayah] = useState(false);

    // Fetch Provinsi list when modal opens
    useEffect(() => {
        if (isModalOpen && provinsis.length === 0) {
            import('axios').then(({ default: axios }) => {
                axios.get('/admin/wilayah/api/provinsi', { params: { per_page: 100 } })
                    .then(res => setProvinsis(res.data.data || []))
                    .catch(console.error);
            });
        }
    }, [isModalOpen]);

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

    // Fetch Kecamatan list when kota_id changes
    useEffect(() => {
        if (data.kota_id) {
            setLoadingWilayah(true);
            import('axios').then(({ default: axios }) => {
                axios.get('/admin/wilayah/api/kecamatan', { params: { kota_id: data.kota_id, per_page: 500 } })
                    .then(res => setKecamatans(res.data.data || []))
                    .catch(console.error)
                    .finally(() => setLoadingWilayah(false));
            });
        } else {
            setKecamatans([]);
        }
    }, [data.kota_id]);

    // Fetch Kelurahan list when kecamatan_id changes
    useEffect(() => {
        if (data.kecamatan_id) {
            setLoadingWilayah(true);
            import('axios').then(({ default: axios }) => {
                axios.get('/admin/wilayah/api/kelurahan', { params: { kecamatan_id: data.kecamatan_id, per_page: 500 } })
                    .then(res => setKelurahans(res.data.data || []))
                    .catch(console.error)
                    .finally(() => setLoadingWilayah(false));
            });
        } else {
            setKelurahans([]);
        }
    }, [data.kecamatan_id]);

    const handleSubmit = (e) => {
        e.preventDefault();
        if (editingId) {
            put(`/hrd/data-pegawai/${editingId}`, {
                onSuccess: () => {
                    Swal.fire('Berhasil', 'Data pegawai berhasil diperbarui', 'success');
                    closeModal();
                },
                onError: (errs) => {
                    const firstError = Object.values(errs)[0];
                    Swal.fire('Gagal Menyimpan', firstError || 'Terjadi kesalahan validasi', 'error');
                }
            });
        } else {
            post('/hrd/data-pegawai', {
                onSuccess: () => {
                    Swal.fire('Berhasil', 'Pegawai baru berhasil ditambahkan', 'success');
                    closeModal();
                },
                onError: (errs) => {
                    const firstError = Object.values(errs)[0];
                    Swal.fire('Gagal Menyimpan', firstError || 'Terjadi kesalahan validasi', 'error');
                }
            });
        }
    };

    const handleDelete = (id) => {
        Swal.fire({
            title: 'Nonaktifkan Pegawai?',
            text: "Pegawai ini akan ditandai sebagai tidak aktif.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Nonaktifkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(`/hrd/data-pegawai/${id}`);
            }
        });
    };

    return (
        <DashboardLayout>
            <Head title="Data Pegawai - ERP" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <Users className="w-8 h-8 text-blue-400" />
                        <div>
                            <h1 className="text-xl font-bold text-slate-800 dark:text-white">Master Pegawai</h1>
                            <p className="text-sm text-slate-500 dark:text-slate-400">Kelola data karyawan & penempatan kerja</p>
                        </div>
                    </div>
                    <div className="pl-actions">
                        <button onClick={() => openModal()} className="dash-btn primary">
                            <Plus className="w-4 h-4 mr-2" /> Tambah Pegawai
                        </button>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    {/* Tabs */}
                    <div className="flex border-b border-slate-200 dark:border-slate-700 mb-4 px-4 pt-2">
                        <button
                            onClick={() => handleTabChange('1')}
                            className={`py-3 px-6 text-sm font-medium border-b-2 transition-colors ${
                                activeTab === '1' 
                                ? 'border-blue-500 text-blue-600 dark:text-blue-400' 
                                : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300'
                            }`}
                        >
                            Pegawai Aktif
                        </button>
                        <button
                            onClick={() => handleTabChange('0')}
                            className={`py-3 px-6 text-sm font-medium border-b-2 transition-colors ${
                                activeTab === '0' 
                                ? 'border-rose-500 text-rose-600 dark:text-rose-400' 
                                : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-slate-300'
                            }`}
                        >
                            Pegawai Nonaktif
                        </button>
                    </div>

                    <form onSubmit={handleSearch} className="search-bar px-4 pb-4">
                        <div className="search-input-wrapper">
                            <Search className="search-icon" />
                            <input
                                type="text"
                                className="search-input"
                                placeholder="Cari NIK, Nama, atau No KTP..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                        </div>
                        <button type="submit" className="dash-btn secondary">Cari</button>
                    </form>

                    <div className="overflow-x-auto w-full">
                        <table className="pl-table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA PEGAWAI</th>
                                    <th>DEPARTEMEN</th>
                                    <th>KONTAK</th>
                                    <th>STATUS</th>
                                    <th className="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                {karyawan.data.length === 0 ? (
                                    <tr>
                                        <td colSpan="6" className="text-center py-8 text-slate-500">Tidak ada data pegawai ditemukan.</td>
                                    </tr>
                                ) : (
                                    karyawan.data.map((item, index) => (
                                        <tr key={item.no_induk} className={item.status == 0 ? 'opacity-50' : ''}>
                                            <td className="w-12">{(karyawan.current_page - 1) * karyawan.per_page + index + 1}</td>
                                            <td>
                                                <div className="font-medium text-slate-800 dark:text-slate-200">
                                                    {item.nama_pegawai}
                                                </div>
                                                <div className="text-xs text-slate-500">NIK/ID: {item.no_induk}</div>
                                            </td>
                                            <td>
                                                <div className="flex items-center text-sm">
                                                    <Briefcase className="w-3 h-3 mr-1 text-slate-400" />
                                                    {item.bagian ? item.bagian.nama_bagian : '-'}
                                                </div>
                                            </td>
                                            <td>
                                                {item.tlp && (
                                                    <div className="text-xs flex items-center mb-1">
                                                        <Phone className="w-3 h-3 mr-1 text-slate-400" /> {item.tlp}
                                                    </div>
                                                )}
                                                {item.email && (
                                                    <div className="text-xs flex items-center">
                                                        <Mail className="w-3 h-3 mr-1 text-slate-400" /> {item.email}
                                                    </div>
                                                )}
                                            </td>
                                            <td>
                                                <span className={`px-2 py-1 rounded-full text-xs font-medium ${
                                                    item.status == 1 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400' : 'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400'
                                                }`}>
                                                    {item.status == 1 ? 'Aktif' : 'Nonaktif'}
                                                </span>
                                            </td>
                                            <td className="text-center">
                                                <div className="flex items-center justify-center space-x-2">
                                                    <button onClick={() => openModal(item)} className="dash-icon-btn primary" title="Edit">
                                                        <Edit className="w-4 h-4" />
                                                    </button>
                                                    {item.status != 0 && (
                                                        <button onClick={() => handleDelete(item.no_induk)} className="dash-icon-btn danger" title="Nonaktifkan">
                                                            <Trash2 className="w-4 h-4" />
                                                        </button>
                                                    )}
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Pagination */}
                {karyawan.last_page > 1 && (
                    <div className="pagination mt-4 flex justify-center space-x-2">
                        {karyawan.links.map((link, index) => (
                            link.url ? (
                                <button
                                    key={index}
                                    onClick={() => router.get(link.url, { search: searchTerm }, { preserveState: true })}
                                    className={`px-3 py-1 rounded-md text-sm ${link.active ? 'bg-blue-600 text-white' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700'}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ) : (
                                <span
                                    key={index}
                                    className="px-3 py-1 rounded-md text-sm bg-slate-100 dark:bg-slate-800/50 text-slate-400 cursor-not-allowed"
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            )
                        ))}
                    </div>
                )}
            </div>

            <FormModal
                isOpen={isModalOpen}
                onClose={closeModal}
                title={editingId ? 'Edit Pegawai' : 'Tambah Pegawai'}
                icon={<Users className="w-6 h-6 text-blue-500" />}
                onSubmit={handleSubmit}
            >
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-4">
                        <h3 className="font-semibold text-slate-700 dark:text-slate-300 border-b border-slate-200 dark:border-slate-700 pb-2 mb-3">Informasi Diri</h3>
                        
                        <div>
                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap</label>
                            <input
                                type="text"
                                className="premium-input w-full"
                                value={data.nama_pegawai}
                                onChange={(e) => setData('nama_pegawai', e.target.value)}
                                required
                            />
                            {errors.nama_pegawai && <p className="text-red-500 text-xs mt-1">{errors.nama_pegawai}</p>}
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">No. KTP</label>
                            <input
                                type="text"
                                className="premium-input w-full"
                                value={data.no_ktp}
                                onChange={(e) => setData('no_ktp', e.target.value)}
                            />
                        </div>

                        <div className="grid grid-cols-2 gap-2">
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tempat Lahir</label>
                                <input
                                    type="text"
                                    className="premium-input w-full"
                                    value={data.tmp_lahir}
                                    onChange={(e) => setData('tmp_lahir', e.target.value)}
                                />
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tgl Lahir</label>
                                <input
                                    type="date"
                                    className="premium-input w-full"
                                    value={data.tgl_lahir}
                                    onChange={(e) => setData('tgl_lahir', e.target.value)}
                                />
                            </div>
                        </div>

                        <div className="grid grid-cols-2 gap-2">
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jenis Kelamin</label>
                                <select 
                                    className="premium-input w-full"
                                    value={data.id_sex}
                                    onChange={(e) => setData('id_sex', parseInt(e.target.value))}
                                >
                                    <option value={1}>Laki-Laki</option>
                                    <option value={2}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status Kawin</label>
                                <select 
                                    className="premium-input w-full"
                                    value={data.id_dc_kawin}
                                    onChange={(e) => setData('id_dc_kawin', parseInt(e.target.value))}
                                >
                                    <option value={1}>Belum Kawin</option>
                                    <option value={2}>Kawin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div className="space-y-4">
                        <h3 className="font-semibold text-slate-700 dark:text-slate-300 border-b border-slate-200 dark:border-slate-700 pb-2 mb-3">Pekerjaan & Kontak</h3>

                        <div>
                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Departemen / Bagian</label>
                            <select 
                                className="premium-input w-full"
                                value={data.kode_bagian}
                                onChange={(e) => setData('kode_bagian', e.target.value)}
                            >
                                <option value="">-- Pilih Departemen --</option>
                                {bagian.map((b) => (
                                    <option key={b.kode_bagian} value={b.kode_bagian}>{b.nama_bagian}</option>
                                ))}
                            </select>
                        </div>

                        <div className="grid grid-cols-2 gap-2">
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">No. Telp / HP</label>
                                <input
                                    type="text"
                                    className="premium-input w-full"
                                    value={data.tlp}
                                    onChange={(e) => setData('tlp', e.target.value)}
                                />
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status Karyawan</label>
                                <select 
                                    className="premium-input w-full"
                                    value={data.status}
                                    onChange={(e) => setData('status', parseInt(e.target.value))}
                                >
                                    <option value={1}>Aktif</option>
                                    <option value={0}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                            <input
                                type="email"
                                className="premium-input w-full"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                            />
                        </div>

                        <div className="grid grid-cols-2 gap-2 mt-3">
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Provinsi</label>
                                <select
                                    className="premium-input w-full"
                                    value={data.provinsi_id}
                                    onChange={(e) => {
                                        const provId = e.target.value;
                                        const provName = provinsis.find(p => p.id == provId)?.nama_provinsi || '';
                                        setData(d => ({ 
                                            ...d, 
                                            provinsi_id: provId, 
                                            provinsi: provName, 
                                            kota_id: '', kota: '', 
                                            kecamatan_id: '', kecamatan: '', 
                                            kelurahan_id: '', kelurahan: '' 
                                        }));
                                    }}
                                >
                                    <option value="">-- Pilih Provinsi --</option>
                                    {provinsis.map(p => (
                                        <option key={p.id} value={p.id}>{p.nama_provinsi}</option>
                                    ))}
                                </select>
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kota/Kabupaten</label>
                                <select
                                    className="premium-input w-full"
                                    value={data.kota_id}
                                    onChange={(e) => {
                                        const kotaId = e.target.value;
                                        const kotaName = kotas.find(k => k.id == kotaId)?.nama_kota || '';
                                        setData(d => ({ 
                                            ...d, 
                                            kota_id: kotaId, 
                                            kota: kotaName, 
                                            kecamatan_id: '', kecamatan: '', 
                                            kelurahan_id: '', kelurahan: '' 
                                        }));
                                    }}
                                    disabled={!data.provinsi_id || loadingWilayah}
                                >
                                    <option value="">{loadingWilayah ? 'Loading...' : '-- Pilih Kota --'}</option>
                                    {kotas.map(k => (
                                        <option key={k.id} value={k.id}>{k.nama_kota}</option>
                                    ))}
                                </select>
                            </div>
                        </div>

                        <div className="grid grid-cols-2 gap-2 mt-2">
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kecamatan</label>
                                <select
                                    className="premium-input w-full"
                                    value={data.kecamatan_id}
                                    onChange={(e) => {
                                        const kecId = e.target.value;
                                        const kecName = kecamatans.find(k => k.id == kecId)?.nama_kecamatan || '';
                                        setData(d => ({ 
                                            ...d, 
                                            kecamatan_id: kecId, 
                                            kecamatan: kecName, 
                                            kelurahan_id: '', kelurahan: '' 
                                        }));
                                    }}
                                    disabled={!data.kota_id || loadingWilayah}
                                >
                                    <option value="">{loadingWilayah ? 'Loading...' : '-- Pilih Kecamatan --'}</option>
                                    {kecamatans.map(k => (
                                        <option key={k.id} value={k.id}>{k.nama_kecamatan}</option>
                                    ))}
                                </select>
                            </div>
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kelurahan</label>
                                <select
                                    className="premium-input w-full"
                                    value={data.kelurahan_id}
                                    onChange={(e) => {
                                        const kelId = e.target.value;
                                        const kelName = kelurahans.find(k => k.id == kelId)?.nama_kelurahan || '';
                                        setData(d => ({
                                            ...d,
                                            kelurahan_id: kelId,
                                            kelurahan: kelName
                                        }));
                                    }}
                                    disabled={!data.kecamatan_id || loadingWilayah}
                                >
                                    <option value="">{loadingWilayah ? 'Loading...' : '-- Pilih Kelurahan --'}</option>
                                    {kelurahans.map(k => (
                                        <option key={k.id} value={k.id}>{k.nama_kelurahan}</option>
                                    ))}
                                </select>
                            </div>
                        </div>

                        <div className="mt-2">
                            <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jalan / Alamat Lengkap</label>
                            <textarea
                                className="premium-input w-full"
                                rows="2"
                                value={data.alamat}
                                onChange={(e) => setData('alamat', e.target.value)}
                            ></textarea>
                        </div>
                    </div>
                </div>
            </FormModal>
        </DashboardLayout>
    );
}
