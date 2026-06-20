import React, { useState } from 'react';
import { Head, useForm, router } from '@inertiajs/react';
import PasienDashboard from '../PasienDashboard';
import { Pill, Trash2, Plus, FileText } from 'lucide-react';
import Select from 'react-select';

export default function FarmasiTab({ patient, obatList, takaranList, penggunaanList, resepList, errors, transaksiFar }) {
    
    // Format options for react-select
    const obatOptions = obatList.map(item => ({
        value: item.kode_brg,
        label: `${item.nama_brg} (Stok: ${item.jml_sat_kcl} ${item.satuan_kecil})`,
        satuan: item.satuan_kecil
    }));

    const [selectedObat, setSelectedObat] = useState(null);

    const { data, setData, post, processing, reset, clearErrors } = useForm({
        kode_brg: '',
        jumlah: 1,
        jml_pakai: '',
        jml_takar: '',
        id_takaran: '',
        id_penggunaan: '',
        txt_instruksi: '-'
    });

    const formatCurrency = (value) => {
        return new Intl.NumberFormat('id-ID').format(value);
    };

    const handleObatChange = (selectedOption) => {
        setSelectedObat(selectedOption);
        setData('kode_brg', selectedOption ? selectedOption.value : '');
        clearErrors('kode_brg');
    };

    const submitResep = (e) => {
        e.preventDefault();
        if (!selectedObat) return alert("Pilih obat terlebih dahulu");

        post(`/poli/pasien/${patient.kode_poli}/farmasi`, {
            preserveScroll: true,
            onSuccess: () => {
                reset();
                setSelectedObat(null);
            }
        });
    };

    const deleteResep = (kd_tr_resep) => {
        if (confirm('Yakin ingin menghapus obat ini dari resep?')) {
            router.delete(`/poli/pasien/${patient.kode_poli}/farmasi/${kd_tr_resep}`, { preserveScroll: true });
        }
    };

    const handleSelesai = () => {
        if (!confirm('Apakah pasien sudah selesai diperiksa?')) return;
        router.post(`/poli/pasien/${patient.kode_poli}/selesai`, {}, {
            onError: (err) => {
                console.error(err);
                alert("Gagal memproses pasien selesai.");
            }
        });
    };

    const handleResepSelesai = () => {
        if (!confirm('Apakah entri resep ini sudah selesai dan siap dikirim ke Apotek?')) return;
        router.post(`/poli/pasien/${patient.kode_poli}/farmasi/selesai`, {}, {
            onError: (err) => {
                console.error(err);
                alert("Gagal memproses resep selesai.");
            }
        });
    };

    const handleRujukRI = () => {
        if (!confirm('Apakah pasien akan dirujuk ke Rawat Inap?')) return;
        router.post(`/poli/pasien/${patient.kode_poli}/rujuk`, {}, {
            onError: (err) => {
                console.error(err);
                alert("Gagal memproses rujuk pasien.");
            }
        });
    };

    // Calculate total
    const totalBiaya = resepList.reduce((acc, curr) => acc + parseFloat(curr.biaya_tebus) + parseFloat(curr.harga_r), 0);

    return (
        <PasienDashboard patient={patient} activeTab="input_resep">
            <Head title={`Input Resep - ${patient.nama_pasien}`} />

            {/* Wrapper for scrollable area */}
            <div style={{ flex: 1, minHeight: 0, overflowY: 'auto', display: 'flex', flexDirection: 'column', paddingRight: '5px' }}>
                
                {/* Data Transaksi & Form Section Layout */}
                <div style={{ display: 'flex', gap: '20px', marginBottom: '20px', flexShrink: 0, flexWrap: 'wrap' }}>
                    
                    {/* Form Section */}
                    <div className="glass-panel" style={{ flex: '1 1 60%', padding: '20px' }}>
                        <h3 style={{ margin: '0 0 15px', color: '#1e293b', display: 'flex', alignItems: 'center', gap: '8px' }}>
                            <Pill style={{ width: '20px', height: '20px', color: '#10b981' }} />
                            Entri Resep Obat
                        </h3>

                        {errors.error && (
                            <div style={{ marginBottom: '15px', padding: '10px', backgroundColor: '#fef2f2', border: '1px solid #fecaca', borderRadius: '6px', color: '#b91c1c' }}>
                                {errors.error}
                            </div>
                        )}

                        <form onSubmit={submitResep} style={{ display: 'flex', gap: '15px', alignItems: 'flex-start', flexWrap: 'wrap' }}>
                            
                            {/* Pilih Obat */}
                            <div style={{ flex: '1 1 300px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>
                                    Pilih Obat <span style={{ color: '#ef4444' }}>*</span>
                                </label>
                                <Select 
                                    options={obatOptions}
                                    value={selectedObat}
                                    onChange={handleObatChange}
                                    placeholder="Ketik nama obat..."
                                    isClearable
                                    menuPortalTarget={document.body}
                                    styles={{
                                        control: (base) => ({
                                            ...base,
                                            borderRadius: '8px',
                                            borderColor: '#cbd5e1',
                                            padding: '2px',
                                            boxShadow: 'none',
                                            '&:hover': { borderColor: '#94a3b8' }
                                        }),
                                        menuPortal: base => ({ ...base, zIndex: 9999 }),
                                        menu: base => ({ ...base, zIndex: 9999 }),
                                        option: (base, state) => ({
                                            ...base,
                                            color: '#0f172a',
                                            backgroundColor: state.isFocused ? '#f1f5f9' : 'white',
                                            cursor: 'pointer'
                                        }),
                                        singleValue: (base) => ({
                                            ...base,
                                            color: '#0f172a'
                                        })
                                    }}
                                />
                                {errors.kode_brg && <p style={{ color: '#ef4444', fontSize: '0.875rem', marginTop: '5px' }}>{errors.kode_brg}</p>}
                            </div>

                            {/* Jumlah */}
                            <div style={{ width: '100px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Jumlah</label>
                                <div style={{ position: 'relative' }}>
                                    <input 
                                        type="number" 
                                        min="1"
                                        style={{ width: '100%', padding: '10px 12px', paddingRight: '40px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                                        value={data.jumlah}
                                        onChange={e => setData('jumlah', e.target.value)}
                                        required
                                    />
                                    <div style={{ position: 'absolute', right: '10px', top: '50%', transform: 'translateY(-50%)', fontSize: '0.875rem', color: '#94a3b8' }}>
                                        {selectedObat ? selectedObat.satuan : ''}
                                    </div>
                                </div>
                            </div>

                            {/* Signa */}
                            <div style={{ flex: '1 1 300px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Signa (Aturan Pakai)</label>
                                <div style={{ display: 'flex', gap: '10px', alignItems: 'center' }}>
                                    <input 
                                        type="text" 
                                        style={{ width: '60px', padding: '10px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none', textAlign: 'center' }}
                                        placeholder="X"
                                        value={data.jml_pakai}
                                        onChange={e => setData('jml_pakai', e.target.value)}
                                    />
                                    <span style={{ color: '#64748b' }}>sehari</span>
                                    <input 
                                        type="text" 
                                        style={{ width: '60px', padding: '10px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none', textAlign: 'center' }}
                                        placeholder="Y"
                                        value={data.jml_takar}
                                        onChange={e => setData('jml_takar', e.target.value)}
                                    />
                                    <select 
                                        style={{ flex: 1, padding: '10px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                                        value={data.id_takaran}
                                        onChange={e => setData('id_takaran', e.target.value)}
                                    >
                                        <option value="">-- Takaran --</option>
                                        {takaranList.map(t => (
                                            <option key={t.id_takaran} value={t.id_takaran}>{t.takaran}</option>
                                        ))}
                                    </select>
                                </div>
                            </div>

                            {/* Penggunaan */}
                            <div style={{ flex: '1 1 200px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Penggunaan</label>
                                <select 
                                    style={{ width: '100%', padding: '10px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                                    value={data.id_penggunaan}
                                    onChange={e => setData('id_penggunaan', e.target.value)}
                                >
                                    <option value="">-- Waktu Penggunaan --</option>
                                    {penggunaanList.map(p => (
                                        <option key={p.id} value={p.id}>{p.penggunaan}</option>
                                    ))}
                                </select>
                            </div>

                            {/* Instruksi Khusus */}
                            <div style={{ flex: '1 1 250px' }}>
                                <label style={{ display: 'block', marginBottom: '8px', fontWeight: 'bold', color: '#334155' }}>Instruksi Khusus</label>
                                <input 
                                    type="text" 
                                    style={{ width: '100%', padding: '10px', borderRadius: '8px', border: '1px solid #cbd5e1', outline: 'none' }}
                                    value={data.txt_instruksi}
                                    onChange={e => setData('txt_instruksi', e.target.value)}
                                />
                            </div>

                            <div style={{ width: '100%', display: 'flex', justifyContent: 'flex-end', marginTop: '10px' }}>
                                <button 
                                    type="submit" 
                                    className="dash-btn primary" 
                                    style={{ padding: '10px 20px', display: 'flex', alignItems: 'center', gap: '8px' }}
                                    disabled={processing}
                                >
                                    <Plus style={{ width: '18px', height: '18px' }} />
                                    Tambah Obat
                                </button>
                            </div>
                        </form>
                    </div>

                    {/* Data Transaksi Details Box */}
                    <div className="glass-panel" style={{ flex: '1 1 35%', padding: '20px', minWidth: '300px' }}>
                        <h3 style={{ margin: '0 0 15px', color: '#1e293b', display: 'flex', alignItems: 'center', gap: '8px', borderBottom: '1px solid #e2e8f0', paddingBottom: '10px' }}>
                            <FileText style={{ width: '20px', height: '20px', color: '#3b82f6' }} />
                            Data Transaksi
                        </h3>
                        <table style={{ width: '100%', fontSize: '0.9rem' }}>
                            <tbody>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b', width: '120px' }}>No MR / Nama</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{patient.no_mr} / {patient.nama_pasien}</td>
                                </tr>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b' }}>No Transaksi</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{transaksiFar?.kode_trans_far || '-'}</td>
                                </tr>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b' }}>Asal Pasien</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{patient.nama_bagian}</td>
                                </tr>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b' }}>No Resep</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{transaksiFar?.no_resep || '-'}</td>
                                </tr>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b' }}>Tgl Transaksi</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{transaksiFar?.tgl_trans || new Date().toISOString().slice(0, 19).replace('T', ' ')}</td>
                                </tr>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b' }}>Nama Dokter</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{patient.nama_dokter}</td>
                                </tr>
                                <tr>
                                    <td style={{ padding: '6px 0', color: '#64748b' }}>Nasabah</td>
                                    <td style={{ padding: '6px 0', fontWeight: 'bold', color: '#334155' }}>{patient.nm_nasabah}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {/* Table Section */}
                <div className="glass-panel table-wrap" style={{ padding: '20px', flex: 1, minHeight: '300px', flexShrink: 0 }}>
                    <h3 style={{ margin: '0 0 15px', color: '#1e293b', display: 'flex', alignItems: 'center', gap: '8px' }}>
                        <FileText style={{ width: '20px', height: '20px', color: '#64748b' }} />
                        Daftar Obat (Resep) Pasien
                    </h3>
                    
                    <div className="dash-table">
                        <table className="dash-table" style={{ width: '100%' }}>
                            <thead>
                                <tr>
                                    <th style={{ width: '50px', textAlign: 'center', color: '#1e293b' }}>No</th>
                                    <th style={{ color: '#1e293b' }}>Nama Obat</th>
                                    <th style={{ width: '80px', textAlign: 'center', color: '#1e293b' }}>Satuan</th>
                                    <th style={{ width: '80px', textAlign: 'center', color: '#1e293b' }}>Jml</th>
                                    <th style={{ color: '#1e293b' }}>Signa</th>
                                    <th style={{ textAlign: 'right', color: '#1e293b' }}>Harga Sat.</th>
                                    <th style={{ textAlign: 'right', color: '#1e293b' }}>Total (Rp)</th>
                                    <th style={{ width: '80px', textAlign: 'center', color: '#1e293b' }}>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {resepList.length > 0 ? (
                                    resepList.map((resep, i) => (
                                        <tr key={resep.kd_tr_resep}>
                                            <td style={{ textAlign: 'center' }}>{i + 1}.</td>
                                            <td>{resep.nama_brg}</td>
                                            <td style={{ textAlign: 'center', color: '#64748b' }}>{resep.satuan_kecil}</td>
                                            <td style={{ textAlign: 'center', fontWeight: 'bold' }}>{resep.jumlah_pesan}</td>
                                            <td>
                                                {resep.jml_pakai} x {resep.jml_takar} {resep.nama_takaran} 
                                                <div style={{ fontSize: '0.8rem', color: '#64748b', marginTop: '4px' }}>
                                                    {resep.nama_penggunaan}
                                                    {resep.instruksi && resep.instruksi !== '-' && ` (${resep.instruksi})`}
                                                </div>
                                            </td>
                                            <td style={{ textAlign: 'right' }}>
                                                {formatCurrency(resep.harga_jual)}
                                            </td>
                                            <td style={{ textAlign: 'right', fontWeight: 'bold' }}>
                                                {formatCurrency(parseFloat(resep.biaya_tebus) + parseFloat(resep.harga_r))}
                                            </td>
                                            <td style={{ textAlign: 'center' }}>
                                                <button 
                                                    className="dash-btn secondary"
                                                    style={{ padding: '4px 8px', color: '#ef4444' }}
                                                    title="Hapus Obat"
                                                    onClick={() => deleteResep(resep.kd_tr_resep)}
                                                >
                                                    <Trash2 style={{ width: '14px', height: '14px' }} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="8" style={{ textAlign: 'center', padding: '30px', color: '#64748b' }}>
                                            Belum ada resep obat.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                            {resepList.length > 0 && (
                                <tfoot>
                                    <tr>
                                        <td colSpan="6" style={{ textAlign: 'right', fontWeight: 'bold', padding: '15px' }}>
                                            Total Biaya:
                                        </td>
                                        <td style={{ textAlign: 'right', fontWeight: 'bold', color: '#10b981', padding: '15px' }}>
                                            Rp {formatCurrency(totalBiaya)}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            )}
                        </table>
                    </div>
                </div>

            </div>

            {/* Frozen Bottom Buttons */}
            <div className="glass-panel" style={{ padding: '15px 20px', display: 'flex', justifyContent: 'flex-end', gap: '15px', marginTop: '15px', flexShrink: 0 }}>
                <button className="dash-btn secondary" style={{ padding: '10px 20px', fontWeight: 'bold' }} onClick={handleRujukRI}>
                    Rujuk Rawat Inap
                </button>
                <button className="dash-btn primary" style={{ padding: '10px 20px', fontWeight: 'bold', backgroundColor: '#1e293b', color: 'white', border: 'none' }} onClick={handleSelesai}>
                    Pasien Selesai
                </button>
            </div>

        </PasienDashboard>
    );
}
