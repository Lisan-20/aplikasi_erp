import React, { useState, useEffect } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Save } from 'lucide-react';
import Swal from 'sweetalert2';


export default function PrivilegesMatrix({ userGroups, accessGroups, hakAksesMenu, subMenus, tipeCari }) {
    // State to hold checkbox selections: { [id_dc_sub_menu]: selected_access_value }
    const [selections, setSelections] = useState(hakAksesMenu || {});
    const [isSaving, setIsSaving] = useState(false);

    // Update selections when hakAksesMenu prop changes from backend
    useEffect(() => {
        setSelections(hakAksesMenu || {});
    }, [hakAksesMenu]);

    const handleGroupChange = (e) => {
        router.get('/admin/privileges/matrix', { tipeCari: e.target.value }, {
            preserveScroll: true,
            replace: true,
        });
    };

    const handleCheckboxChange = (subMenuId, accessValue) => {
        setSelections(prev => ({
            ...prev,
            [subMenuId]: accessValue
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        if (!tipeCari) return;

        setIsSaving(true);
        router.post('/admin/privileges/matrix', {
            id_dd_user_group: tipeCari,
            oid: selections
        }, {
            preserveScroll: true,
            onSuccess: (page) => {
                if (page.props.flash && page.props.flash.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: page.props.flash.success,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: 'Hak Akses berhasil diperbarui.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            onError: (errors) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menyimpan hak akses.',
                });
            },
            onFinish: () => setIsSaving(false)
        });
    };

    return (
        <DashboardLayout>
            <Head title="Admin - Group Privileges" />

            <div className="pl-container">
                <div className="pl-header glass-panel">
                    <div className="pl-title">
                        <h1>Konfigurasi Hak Group User</h1>
                        <p>Atur izin matriks untuk setiap menu per group pengguna</p>
                    </div>
                    <div className="pl-actions flex gap-2 items-center">
                        <Link href="/admin/privileges" className="dash-btn secondary">
                            Group User
                        </Link>
                        <Link href="/admin/privileges/matrix" className="dash-btn primary">
                            Group Privileges
                        </Link>
                        
                        <div style={{ borderLeft: '1px solid #ccc', height: '30px', margin: '0 8px' }}></div>
                        
                        <select 
                            className="search-input"
                            value={tipeCari}
                            onChange={handleGroupChange}
                            style={{ minWidth: '200px' }}
                        >
                            <option value="">-- Pilih Group User --</option>
                            {userGroups.map(group => (
                                <option key={group.id_dd_user_group} value={group.id_dd_user_group}>
                                    {group.nama_group}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>

                <div className="glass-panel table-wrap">
                    <form onSubmit={handleSubmit} style={{ position: 'relative', display: 'flex', flexDirection: 'column', height: '100%' }}>
                        <div className="dash-table" style={{ maxHeight: 'calc(100vh - 250px)', overflowY: 'auto' }}>
                            <table className="dash-table" style={{ position: 'relative' }}>
                                <thead>
                                    <tr>
                                        <th style={{ width: '50px', textAlign: 'center' }}>No.</th>
                                        <th>Nama Modul</th>
                                        <th>Nama Menu</th>
                                        <th>Nama Sub Menu</th>
                                        
                                        {accessGroups.map(access => (
                                            <th key={access.id_dd_group} style={{ textAlign: 'center', width: '80px', fontWeight: 'normal' }} title={access.keterangan_group}>
                                                {access.nama_group}
                                            </th>
                                        ))}
                                        <th style={{ textAlign: 'center', width: '80px', fontWeight: 'normal' }}>
                                            No Priv.
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {tipeCari ? (
                                        subMenus.map((sub, index) => {
                                            const subId = sub.id_dc_sub_menu;
                                            // Fallback to 'no_access' if nothing selected for this row. Cast to String for safe comparison.
                                            const currentSelection = String(selections[subId] || 'no_access');
                                            
                                            // Handle unique module/menu grouping visually (like old tidak_berulang)
                                            const showModul = index === 0 || subMenus[index - 1].nama_modul !== sub.nama_modul;
                                            const showMenu = showModul || subMenus[index - 1].nama_menu !== sub.nama_menu;

                                            return (
                                                <tr key={subId}>
                                                    <td style={{ textAlign: 'center' }}>
                                                        {index + 1}.
                                                    </td>
                                                    <td>
                                                        {showModul ? <strong>{sub.nama_modul}</strong> : ''}
                                                    </td>
                                                    <td>
                                                        {showMenu ? sub.nama_menu : ''}
                                                    </td>
                                                    <td style={{ color: '#0ea5e9' }}>
                                                        {sub.nama_sub_menu}
                                                    </td>
                                                    
                                                    {/* Access Level Checkboxes */}
                                                    {accessGroups.map(access => {
                                                        const accessId = access.id_dd_group.toString();
                                                        return (
                                                            <td key={accessId} style={{ textAlign: 'center' }}>
                                                                <input 
                                                                    type="checkbox" 
                                                                    style={{ transform: 'scale(1.2)' }}
                                                                    checked={currentSelection === accessId}
                                                                    onChange={() => handleCheckboxChange(subId, accessId)}
                                                                    title={access.nama_group}
                                                                />
                                                            </td>
                                                        );
                                                    })}
                                                    
                                                    {/* No Priv. Checkbox */}
                                                    <td style={{ textAlign: 'center' }}>
                                                        <input 
                                                            type="checkbox" 
                                                            style={{ transform: 'scale(1.2)' }}
                                                            checked={currentSelection === 'no_access'}
                                                            onChange={() => handleCheckboxChange(subId, 'no_access')}
                                                            title="No Privileges"
                                                        />
                                                    </td>
                                                </tr>
                                            );
                                        })
                                    ) : (
                                        <tr>
                                            <td colSpan={5 + accessGroups.length} className="p-8 text-center text-slate-500">
                                                <p className="text-lg mb-2">Pilih Group User terlebih dahulu</p>
                                                <p className="text-sm">Silakan pilih dari dropdown di kanan atas untuk mengonfigurasi hak akses.</p>
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                        
                        {tipeCari && (
                            <div style={{ 
                                position: 'sticky', 
                                bottom: 0, 
                                zIndex: 20,
                                padding: '1rem', 
                                borderTop: '1px solid #e2e8f0', 
                                display: 'flex', 
                                justifyContent: 'flex-end', 
                                backgroundColor: '#f8fafc',
                                boxShadow: '0 -4px 6px -1px rgba(0, 0, 0, 0.05)'
                            }}>
                                <button 
                                    type="submit" 
                                    className="dash-btn primary"
                                    disabled={isSaving}
                                >
                                    <Save size={18} />
                                    <span>{isSaving ? 'Menyimpan...' : 'Simpan Hak Akses'}</span>
                                </button>
                            </div>
                        )}
                    </form>
                </div>
            </div>
        </DashboardLayout>
    );
}
