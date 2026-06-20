import React, { useState, useEffect } from 'react';
import { useForm } from '@inertiajs/react';
import Swal from 'sweetalert2';
import { X } from 'lucide-react';
import AsyncSelect from 'react-select/async';

export default function FormModal({ isOpen, onClose, user, groups }) {
    const isEdit = !!user;

    const { data, setData, post, put, processing, errors, reset, clearErrors } = useForm({
        no_induk: '',
        nama_pegawai: '',
        nama_bagian: '',
        username: '',
        password: '',
        id_dd_user_group: '',
        status: '0'
    });

    useEffect(() => {
        if (isOpen) {
            clearErrors();
            if (isEdit) {
                setData({
                    no_induk: user.no_induk || '',
                    nama_pegawai: user.nama_pegawai || '',
                    nama_bagian: user.nama_bagian || '',
                    username: user.username || '',
                    password: '',
                    id_dd_user_group: user.id_dd_user_group || '',
                    status: user.status != null ? String(user.status) : '0'
                });
            } else {
                reset();
            }
        }
    }, [isOpen, user]);

    if (!isOpen) return null;

    const handleSubmit = (e) => {
        e.preventDefault();

        if (isEdit) {
            put(`/admin/user/${user.id_dd_user}`, {
                onSuccess: () => {
                    Swal.fire('Berhasil!', 'Data pengguna diperbarui.', 'success');
                    onClose();
                }
            });
        } else {
            post('/admin/user', {
                onSuccess: () => {
                    Swal.fire('Berhasil!', 'Pengguna baru ditambahkan.', 'success');
                    onClose();
                }
            });
        }
    };

    // React-Select Async function to fetch pegawai
    const loadOptions = async (inputValue) => {
        if (!inputValue) return [];
        try {
            const res = await fetch(`/admin/user/search-pegawai?q=${inputValue}`);
            const data = await res.json();
            return data.map(item => ({
                value: item.no_induk,
                label: `${item.no_induk} - ${item.nama_pegawai}`,
                ...item
            }));
        } catch (error) {
            console.error("Error fetching pegawai:", error);
            return [];
        }
    };

    const handlePegawaiSelect = (selectedOption) => {
        if (selectedOption) {
            setData({
                ...data,
                no_induk: selectedOption.no_induk,
                nama_pegawai: selectedOption.nama_pegawai,
                nama_bagian: selectedOption.nama_bagian
            });
        } else {
            setData({
                ...data,
                no_induk: '',
                nama_pegawai: '',
                nama_bagian: ''
            });
        }
    };

    return (
        <div style={{
            position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
            backgroundColor: 'rgba(0,0,0,0.5)', zIndex: 9999,
            display: 'flex', justifyContent: 'center', alignItems: 'center'
        }}>
            <div className="glass-panel" style={{
                width: '100%', maxWidth: '500px', 
                borderRadius: '12px', padding: '20px', boxShadow: '0 10px 25px rgba(0,0,0,0.2)'
            }}>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '20px' }}>
                    <h3 style={{ margin: 0, color: 'var(--text-color)' }}>{isEdit ? 'Edit Pengguna' : 'Tambah Pengguna Baru'}</h3>
                    <button onClick={onClose} style={{ background: 'none', border: 'none', cursor: 'pointer', color: 'var(--text-muted)' }}>
                        <X size={24} />
                    </button>
                </div>

                <form onSubmit={handleSubmit}>
                    {!isEdit ? (
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500' }}>Cari Pegawai <span style={{color: 'red'}}>*</span></label>
                            <AsyncSelect
                                cacheOptions
                                defaultOptions
                                loadOptions={loadOptions}
                                onChange={handlePegawaiSelect}
                                placeholder="Ketik nama atau No Induk..."
                                styles={{
                                    control: (base) => ({
                                        ...base,
                                        borderRadius: '8px',
                                        borderColor: errors.no_induk ? '#ef4444' : 'rgba(255,255,255,0.2)',
                                        backgroundColor: 'rgba(0,0,0,0.2)',
                                        color: '#fff',
                                        minHeight: '42px'
                                    }),
                                    singleValue: (base) => ({
                                        ...base,
                                        color: '#fff'
                                    }),
                                    input: (base) => ({
                                        ...base,
                                        color: '#fff'
                                    }),
                                    placeholder: (base) => ({
                                        ...base,
                                        color: 'rgba(255,255,255,0.6)'
                                    }),
                                    menu: (base) => ({
                                        ...base,
                                        backgroundColor: '#1f2937', // Solid background to prevent overlap
                                        color: '#fff',
                                        zIndex: 9999,
                                        boxShadow: '0 10px 25px rgba(0,0,0,0.5)'
                                    }),
                                    option: (base, state) => ({
                                        ...base,
                                        backgroundColor: state.isFocused ? '#3b82f6' : 'transparent',
                                        color: '#fff',
                                        cursor: 'pointer',
                                        padding: '10px 15px'
                                    })
                                }}
                            />
                            {errors.no_induk && <span style={{ color: 'red', fontSize: '0.8rem' }}>{errors.no_induk}</span>}
                        </div>
                    ) : (
                        <>
                            <div style={{ marginBottom: '15px' }}>
                                <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>Nama Pegawai</label>
                                <input type="text" className="premium-input" value={data.nama_pegawai} readOnly />
                            </div>
                        </>
                    )}

                    <div style={{ marginBottom: '15px' }}>
                        <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>Bagian</label>
                        <input type="text" className="premium-input" value={data.nama_bagian} readOnly placeholder={!isEdit ? 'Otomatis terisi saat pegawai dipilih' : ''} />
                    </div>

                    <div style={{ marginBottom: '15px' }}>
                        <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>User ID (Username) <span style={{color: '#ef4444'}}>*</span></label>
                        <input 
                            type="text" 
                            className={`premium-input ${errors.username ? 'is-invalid' : ''}`}
                            value={data.username} 
                            onChange={e => setData('username', e.target.value)} 
                            placeholder="Contoh: agus123"
                        />
                        {errors.username && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.username}</span>}
                    </div>

                    <div style={{ marginBottom: '15px' }}>
                        <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>Password {isEdit && <span style={{fontSize: '0.8rem', color: 'var(--text-muted)'}}>(Kosongkan jika tidak diubah)</span>} {!isEdit && <span style={{color: '#ef4444'}}>*</span>}</label>
                        <input 
                            type="password" 
                            className={`premium-input ${errors.password ? 'is-invalid' : ''}`}
                            value={data.password} 
                            onChange={e => setData('password', e.target.value)} 
                            placeholder="Masukkan password"
                        />
                        {errors.password && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.password}</span>}
                    </div>

                    <div style={{ marginBottom: '15px' }}>
                        <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>Group User <span style={{color: '#ef4444'}}>*</span></label>
                        <select 
                            className={`premium-input ${errors.id_dd_user_group ? 'is-invalid' : ''}`}
                            value={data.id_dd_user_group} 
                            onChange={e => setData('id_dd_user_group', e.target.value)}
                        >
                            <option value="">-- Pilih Group User --</option>
                            {groups.map(group => (
                                <option key={group.id_dd_user_group} value={group.id_dd_user_group}>
                                    {group.nama_group}
                                </option>
                            ))}
                        </select>
                        {errors.id_dd_user_group && <span style={{ color: '#ef4444', fontSize: '0.8rem' }}>{errors.id_dd_user_group}</span>}
                    </div>

                    <div style={{ marginBottom: '20px' }}>
                        <label style={{ display: 'block', marginBottom: '5px', fontWeight: '500', color: 'var(--text-color)' }}>Status Aktif</label>
                        <div style={{ display: 'flex', gap: '15px', color: 'var(--text-color)' }}>
                            <label style={{ display: 'flex', alignItems: 'center', gap: '5px', cursor: 'pointer' }}>
                                <input type="radio" name="status" value="0" checked={data.status === '0'} onChange={e => setData('status', e.target.value)} />
                                Aktif
                            </label>
                            <label style={{ display: 'flex', alignItems: 'center', gap: '5px', cursor: 'pointer' }}>
                                <input type="radio" name="status" value="1" checked={data.status === '1'} onChange={e => setData('status', e.target.value)} />
                                Tidak Aktif
                            </label>
                        </div>
                    </div>

                    <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '10px' }}>
                        <button type="button" onClick={onClose} className="dash-btn secondary">
                            Batal
                        </button>
                        <button type="submit" disabled={processing} className="dash-btn primary" style={{ minWidth: '100px' }}>
                            {processing ? 'Menyimpan...' : 'Simpan'}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}
