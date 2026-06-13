import React, { useState, useEffect } from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import { 
    Menu, X, ChevronDown, ChevronRight, 
    Users, Activity, Settings, 
    FileText, HeartPulse, LogOut, LayoutDashboard,
    Sun, Moon 
} from 'lucide-react';

// A mapping function to guess an icon based on menu name
const getMenuIcon = (name) => {
    const n = name?.toLowerCase() || '';
    if (n.includes('pasien') || n.includes('user')) return <Users size={20} />;
    if (n.includes('rekam') || n.includes('laporan')) return <FileText size={20} />;
    if (n.includes('setting') || n.includes('pengaturan')) return <Settings size={20} />;
    if (n.includes('medis') || n.includes('klinik')) return <HeartPulse size={20} />;
    if (n.includes('antrean') || n.includes('queue')) return <Activity size={20} />;
    return <LayoutDashboard size={20} />;
};

export default function DashboardLayout({ children }) {
    const page = usePage();
    const { auth, dashboard } = page.props;
    const activeUrl = page.url;
    const user = auth?.user || { username: 'User', role: 'Administrator' };
    const module_name = dashboard?.module_name || 'Dashboard';
    const menus = dashboard?.menus || [];

    const [isSidebarOpen, setSidebarOpen] = useState(true);
    
    // Simpan status menu yang terbuka ke sessionStorage agar tidak tertutup saat ganti halaman
    const [openMenus, setOpenMenus] = useState(() => {
        try {
            const saved = sessionStorage.getItem('medilink_open_menus');
            return saved ? JSON.parse(saved) : {};
        } catch {
            return {};
        }
    });

    useEffect(() => {
        sessionStorage.setItem('medilink_open_menus', JSON.stringify(openMenus));
    }, [openMenus]);

    const [currentTime, setCurrentTime] = useState(new Date());
    const [theme, setTheme] = useState('dark');

    useEffect(() => {
        const savedTheme = localStorage.getItem('medilink-theme');
        if (savedTheme) {
            setTheme(savedTheme);
        } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
            setTheme('light');
        }
        
        const timer = setInterval(() => setCurrentTime(new Date()), 1000);
        return () => clearInterval(timer);
    }, []);

    const toggleTheme = () => {
        const newTheme = theme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
        localStorage.setItem('medilink-theme', newTheme);
    };

    const toggleSidebar = () => setSidebarOpen(!isSidebarOpen);

    const toggleMenu = (menuId) => {
        setOpenMenus(prev => ({
            ...prev,
            [menuId]: !prev[menuId]
        }));
    };

    return (
        <div className="dash-layout" data-theme={theme}>
            <Head title={`${module_name || 'Dashboard'} - Medilink RS`} />
            
            {/* Background Glows */}
            <div className="dash-glow dash-glow-1"></div>
            <div className="dash-glow dash-glow-2"></div>
            
            {/* Top Navbar */}
            <header className="dash-navbar glass-panel">
                <div className="dash-nav-left">
                    <button onClick={toggleSidebar} className="dash-icon-btn">
                        {isSidebarOpen ? <X size={24} /> : <Menu size={24} />}
                    </button>
                    <div className="dash-brand">
                        <HeartPulse size={28} className="dash-brand-icon" />
                        <div>
                            <h2>MEDILINK</h2>
                            <span className="dash-tag">{module_name || 'Smart Hospital'}</span>
                        </div>
                    </div>
                </div>

                <div className="dash-nav-right">
                    <div className="dash-clock">
                        {currentTime.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })} WIB
                    </div>
                    
                    <button onClick={toggleTheme} className="dash-icon-btn theme-toggle" title="Ubah Tema">
                        {theme === 'dark' ? <Sun size={20} className="text-yellow-400" /> : <Moon size={20} className="text-blue-600" />}
                    </button>
                    
                    <div className="dash-user">
                        <div className="dash-user-info">
                            <span className="dash-user-name">{user.username || user.name}</span>
                            <span className="dash-user-role">{user.role || 'Staff'}</span>
                        </div>
                        <div className="dash-avatar">
                            {(user.username || user.name || 'U').charAt(0).toUpperCase()}
                        </div>
                        <Link href="/logout" className="dash-logout-btn" title="Keluar">
                            <LogOut size={20} />
                        </Link>
                    </div>
                </div>
            </header>

            <div className="dash-body">
                {/* Sidebar */}
                <aside className={`dash-sidebar glass-panel ${isSidebarOpen ? 'open' : 'closed'}`}>
                    <div className="dash-sidebar-inner">
                        <div className="dash-menu-section">
                            <span className="dash-menu-label">Main Menu</span>
                            <ul className="dash-menu-list">
                                {menus.map((menu, idx) => {
                                    const menuId = menu.id_menu || menu.id || idx;
                                    const submenus = menu.sub_menus || menu.submenus || menu.children || [];
                                    const isOpen = openMenus[menuId];
                                    const menuName = menu.nama_menu || menu.name || 'Menu';

                                    return (
                                        <li key={menuId} className="dash-menu-group">
                                            <button 
                                                className={`dash-menu-item ${isOpen ? 'active' : ''}`}
                                                onClick={() => toggleMenu(menuId)}
                                            >
                                                {getMenuIcon(menuName)}
                                                <span className="dash-menu-text">{menuName}</span>
                                                {submenus.length > 0 && (
                                                    isOpen ? <ChevronDown size={16} className="dash-menu-arrow" /> : <ChevronRight size={16} className="dash-menu-arrow" />
                                                )}
                                            </button>
                                            
                                            {submenus.length > 0 && (
                                                <ul className={`dash-submenu-list ${isOpen ? 'open' : ''}`}>
                                                    {submenus.map((sub, sIdx) => {
                                                        const subId = sub.id_dc_sub_menu || sub.id_sub_menu || sub.id;
                                                        let subUrlRaw = sub.url_sub_menu || sub.url || '#';
                                                        
                                                        // NATIVE MIGRATION OVERRIDES (Tahap 1 & 2)
                                                        if (subId == 9) subUrlRaw = '/registrasi/cari-pasien?type=poli';
                                                        if (subId == 11) subUrlRaw = '/registrasi/cari-pasien?type=igd';
                                                        if (subId == 10) subUrlRaw = '/registrasi/cari-pasien?type=pm';
                                                        if (subId == 12) subUrlRaw = '/registrasi/cari-pasien?type=ri';
                                                        if (subId == 668) subUrlRaw = '/registrasi/cari-pasien?type=igd-malam';
                                                        if (subId == 807) subUrlRaw = '/registrasi/cari-pasien?type=paket-poli';
                                                        if (subId == 609) subUrlRaw = '/registrasi/cari-pasien?type=mcu';
                                                        
                                                        // Other existing menus
                                                        if (subId == 13) subUrlRaw = '/registrasi/pasien-baru';
                                                        if (subId == 433) subUrlRaw = '/registrasi/pasien-lama';
                                                        if (subId == 1246) subUrlRaw = '/registrasi/listing-poli';
                                                        if (subId == 1829 || subId == 2267) subUrlRaw = '/registrasi/permintaan-ri';
                                                        if (subId == 743) subUrlRaw = '/registrasi/pasien-rawat-inap';
                                                        if (subId == 14) subUrlRaw = '/registrasi/edit-data'; // Phase 2
                                                        // Phase 3 Mappings
                                                        if (subId == 15) subUrlRaw = '/registrasi/jadwal-dokter';
                                                        if (subId == 16) subUrlRaw = '/registrasi/riwayat-pasien';
                                                        if (subId == 28) subUrlRaw = '/registrasi/info-ruangan';
                                                        if (subId == 2349) subUrlRaw = '/registrasi/info-ruangan-2';
                                                        if (subId == 1211) subUrlRaw = '/registrasi/harga-kamar';
                                                        if (subId == 1374) subUrlRaw = '/registrasi/info-tarif-umum';
                                                        if (subId == 19) subUrlRaw = '/registrasi/paket-bedah';
                                                        if (subId == 20) subUrlRaw = '/registrasi/paket-melahirkan';
                                                        // Phase 4 Mappings
                                                        if (subId == 434) subUrlRaw = '/registrasi/perjanjian-pasien';
                                                        if (subId == 435) subUrlRaw = '/registrasi/daftar-perjanjian';
                                                        if (subId == 1736 || subId == 1737) subUrlRaw = '/registrasi/listing-online';
                                                        if (subId == 1773) subUrlRaw = '/registrasi/listing-jkn';
                                                        // Laporan Mappings (defined here, overrides set below at line 226)
                                                        // (mapping handled at line 226)
                                                        
                                                        // Poli Mappings
                                                        if (subUrlRaw.includes('mod_poli/antrian.php') || subUrlRaw.includes('mod_poli/antrian_pasien.php')) {
                                                            subUrlRaw = '/poli/antrian-poli';
                                                        }

                                                        // Phase 5 Mappings - remaining legacy submenus via LegacyView
                                                        if (subId == 2192) subUrlRaw = '/registrasi/listing-poli'; // Listing Pasien His → same page
                                                        // PENDAFTARAN group legacy
                                                        if (subId == 1087) subUrlRaw = '/mod_registrasi/his_registrasi.php';
                                                        if (subId == 673) subUrlRaw = '/mod_secsio/reg_pasien_paket.php';
                                                        if (subId == 1811) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.3:8081/mod_registrasi/vclaim_monitoring_peserta_view.php') + '&title=Monitoring';
                                                        // V CLAIM group - external URLs via legacy-ext
                                                        if (subId == 1808) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.4:8081/mod_registrasi/vclaim_cek_peserta_view.php') + '&title=Data+Peserta';
                                                        if (subId == 1804) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.4:8081/mod_registrasi/vclaim_data_peserta_view.php') + '&title=Update+SEP';
                                                        if (subId == 1810) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.4:8081/mod_registrasi/vclaim_kontrol_view.php') + '&title=Rencana+Kontrol';
                                                        if (subId == 1806) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.4:8081/mod_registrasi/vclaim_rujukan_view.php') + '&title=Rujukan';
                                                        if (subId == 1812) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.4:8081/mod_registrasi/vclaim_monitoring_peserta_view.php') + '&title=Monitoring+VClaim';
                                                        // LISTING PASIEN group legacy
                                                        if (subId == 662) subUrlRaw = '/mod_igd/batal_pasien_igd_view.php';
                                                        // (subId == 437 mapped above for antrian_pasien.php)
                                                        if (subId == 1151) subUrlRaw = '/mod_pm/listing_pasien_lab_v.php';
                                                        if (subId == 1152) subUrlRaw = '/mod_pm/listing_pasien_rad_v.php';
                                                        if (subId == 1154) subUrlRaw = '/mod_pm/list_pasien_fisio.php';
                                                        if (subId == 1155) subUrlRaw = '/mod_pm/list_pasien_hd.php';
                                                        if (subId == 1153) subUrlRaw = '/mod_mcu/list_pasien_mcu_v.php';
                                                        if (subId == 1615) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.8/mod_registrasi/pasien_ri_his.php') + '&title=History+Pasien+RI';
                                                        // INFORMASI group legacy
                                                        if (subId == 1437) subUrlRaw = '/mod_registrasi/data_perusahaan_view.php';
                                                        if (subId == 21) subUrlRaw = '/mod_registrasi/pasien_ri_view.php';
                                                        if (subId == 22) subUrlRaw = '/mod_registrasi/informasi_medik_view.php';
                                                        if (subId == 2347) subUrlRaw = '/mod_registrasi/list_pasien_prb_tab.php';
                                                        if (subId == 1213) subUrlRaw = '/mod_registrasi/lap_operan.php';
                                                        if (subId == 2363) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.3/mod_poli/rencana_kontrol_view.php') + '&title=WA+Blast+Rencana+Kontrol';
                                                        // PERMINTAAN BRG group
                                                        if (subId == 1294) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.8/mod_gudang_non_medik/permintaan_unit_tab.php?kode_bagian=300001') + '&title=Permintaan+Non+Medis';
                                                        if (subId == 1824) subUrlRaw = '/mod_IPRS/stok_aset_view.php?kode_bagian=300001';
                                                        if (subId == 1826) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.8/mod_pm/stok_nm_unit_view.php?kode_bagian=300001') + '&title=Barang+Non+Medis';
                                                        // HRD group
                                                        if (subId == 1744) subUrlRaw = '/mod_payroll/adm_personalia_unit.php';
                                                        if (subId == 2214) subUrlRaw = '/mod_payroll/ver_kanit_lembur_view.php';
                                                        // STOK DEPO
                                                        if (subId == 2168) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.8/mod_pm/stok_NM_depo_view.php') + '&title=Stok+Non+Medis';
                                                        // KUITANSI BATAL
                                                        if (subId == 767) subUrlRaw = '/mod_kasir/kuitansi_batal_view.php';
                                                        // LAPORAN group
                                                        if (subId == 30) subUrlRaw = '/laporan/kinerja';
                                                        if (subId == 29) subUrlRaw = '/mod_laporan/lap_kunjungan.php';
                                                        if (subId == 2000) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.8/mod_laporan/lap_kinerja.php') + '&title=Kinerja+HIS';
                                                        if (subId == 1999) subUrlRaw = '/registrasi/legacy-ext?url=' + encodeURIComponent('http://192.168.0.8/mod_laporan/lap_kunjungan.php') + '&title=Kunjungan+HIS';
                                                        
                                                        let subUrl = subUrlRaw.trim();
                                                        
                                                        // Convert relative legacy paths to root-absolute
                                                        if (subUrl.startsWith('../')) {
                                                            subUrl = '/' + subUrl.substring(3);
                                                        } else if (!subUrl.startsWith('/') && !subUrl.startsWith('http') && subUrl !== '#') {
                                                            subUrl = '/' + subUrl;
                                                        }

                                                        // External http:// URLs that are NOT already routed via /registrasi/legacy-ext
                                                        // should open in new tab (e.g. accidental unhandled http:// links)
                                                        const isUnhandledExternal = subUrl.startsWith('http');
                                                        const subName = sub.nama_sub_menu || sub.name || 'Submenu';
                                                        
                                                        const isActive = activeUrl === subUrl || activeUrl.startsWith(subUrl + '?');

                                                        return (
                                                            <li key={sub.id_sub_menu || sub.id || sIdx}>
                                                                {isUnhandledExternal ? (
                                                                    <a href={subUrl} className={`dash-submenu-item ${isActive ? 'active' : ''}`} target="_blank" rel="noreferrer">
                                                                        {subName}
                                                                    </a>
                                                                ) : (
                                                                    <Link href={subUrl} className={`dash-submenu-item ${isActive ? 'active' : ''}`}>
                                                                        {subName}
                                                                    </Link>
                                                                )}
                                                            </li>
                                                        );
                                                    })}
                                                </ul>
                                            )}
                                        </li>
                                    );
                                })}
                            </ul>
                        </div>
                    </div>
                    
                    <div className="dash-sidebar-footer">
                        <Link href="/modul" className="dash-back-btn">
                            &larr; <span className="dash-menu-text">Ganti Modul</span>
                        </Link>
                    </div>
                </aside>

                {/* Main Content Area */}
                <main className="dash-content">
                    {children ? children : (
                        <>
                            <div className="dash-welcome glass-panel">
                                <h1>Selamat Datang di {module_name || 'Modul Sistem'}</h1>
                                <p>Silakan gunakan menu navigasi di sebelah kiri untuk mengakses fitur yang tersedia dalam modul ini.</p>
                            </div>

                            <div className="dash-widgets">
                                <div className="dash-widget glass-panel">
                                    <Activity size={32} className="widget-icon primary" />
                                    <h3>Status Sistem</h3>
                                    <p>Sistem berjalan optimal. Semua layanan terhubung.</p>
                                </div>
                                <div className="dash-widget glass-panel">
                                    <Users size={32} className="widget-icon success" />
                                    <h3>Sesi Pengguna</h3>
                                    <p>Anda login sebagai <strong>{user.username || user.name}</strong> dengan hak akses modul saat ini.</p>
                                </div>
                            </div>
                        </>
                    )}
                </main>
            </div>
            
            <style>{`
                /* Inline CSS for Dashboard Shell Glassmorphism */
                @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

                :root {
                    --bg-dark: #070b14;
                    --glass-bg: rgba(15, 23, 42, 0.7);
                    --glass-border: rgba(14, 165, 233, 0.15);
                    --glass-hover: rgba(30, 41, 59, 0.85);
                    --primary: #0ea5e9;
                    --primary-glow: rgba(14, 165, 233, 0.3);
                    --text-main: #f8fafc;
                    --text-muted: #94a3b8;
                    --sidebar-width: 270px;
                    --sidebar-collapsed: 76px;
                    --shadow-sm: 0 4px 10px -1px rgba(0, 0, 0, 0.3);
                    --shadow-md: 0 10px 25px -3px rgba(0, 0, 0, 0.4);
                }
                
                .dash-layout[data-theme="light"] {
                    --bg-dark: #f0f4f8;
                    --glass-bg: rgba(255, 255, 255, 0.85);
                    --glass-border: rgba(99, 102, 241, 0.15);
                    --glass-hover: rgba(248, 250, 252, 1);
                    --primary: #4f46e5;
                    --primary-glow: rgba(79, 70, 229, 0.2);
                    --text-main: #0f172a;
                    --text-muted: #475569;
                    --shadow-sm: 0 4px 12px -1px rgba(15, 23, 42, 0.05);
                    --shadow-md: 0 12px 30px -3px rgba(15, 23, 42, 0.08);
                }

                .dash-layout, .dash-layout *, .dash-layout *::before, .dash-layout *::after {
                    box-sizing: border-box;
                }

                .dash-layout {
                    height: 100vh;
                    background-color: var(--bg-dark);
                    color: var(--text-main);
                    font-family: 'Outfit', sans-serif;
                    display: flex;
                    flex-direction: column;
                    overflow: hidden;
                    position: relative;
                }

                .dash-glow {
                    position: absolute;
                    width: 500px;
                    height: 500px;
                    border-radius: 50%;
                    filter: blur(100px);
                    z-index: 0;
                    opacity: 0.4;
                    pointer-events: none;
                }
                .dash-glow-1 { top: -200px; left: -100px; background: radial-gradient(circle, var(--primary), transparent 60%); }
                .dash-glow-2 { bottom: -200px; right: -100px; background: radial-gradient(circle, #8b5cf6, transparent 60%); }

                .glass-panel {
                    background: var(--glass-bg);
                    backdrop-filter: blur(12px);
                    -webkit-backdrop-filter: blur(12px);
                    border: 1px solid var(--glass-border);
                    position: relative;
                    z-index: 1;
                }

                /* Navbar */
                .dash-navbar {
                    height: 70px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0 20px;
                    border-bottom: 1px solid var(--glass-border);
                }

                .dash-nav-left {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                }

                .dash-icon-btn {
                    background: transparent;
                    border: none;
                    color: var(--text-main);
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 8px;
                    border-radius: 8px;
                    transition: background 0.2s;
                }
                .dash-icon-btn:hover { background: rgba(255,255,255,0.1); }

                .dash-brand {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }
                .dash-brand-icon { color: var(--primary); }
                .dash-brand h2 { margin: 0; font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; }
                .dash-tag { font-size: 0.75rem; color: var(--text-muted); background: rgba(59,130,246,0.1); padding: 2px 6px; border-radius: 4px; border: 1px solid rgba(59,130,246,0.2); }

                .dash-nav-right {
                    display: flex;
                    align-items: center;
                    gap: 24px;
                }
                .dash-clock { font-size: 0.9rem; color: var(--text-muted); font-weight: 500; }
                .dash-user { display: flex; align-items: center; gap: 12px; }
                .dash-user-info { display: flex; flex-direction: column; align-items: flex-end; }
                .dash-user-name { font-weight: 600; font-size: 0.9rem; }
                .dash-user-role { font-size: 0.75rem; color: var(--text-muted); }
                .dash-avatar { width: 36px; height: 36px; background: linear-gradient(135deg, var(--primary), #8b5cf6); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
                .dash-logout-btn { color: var(--text-muted); transition: color 0.2s; margin-left: 8px; }
                .dash-logout-btn:hover { color: #ef4444; }

                /* Body Layout */
                .dash-body {
                    display: flex;
                    flex: 1;
                    overflow: hidden;
                    min-height: 0;
                }

                /* Sidebar */
                .dash-sidebar {
                    width: var(--sidebar-width);
                    border-right: 1px solid var(--glass-border);
                    display: flex;
                    flex-direction: column;
                    transition: width 0.3s ease;
                    overflow-x: hidden;
                    min-height: 0;
                }
                .dash-sidebar.closed {
                    width: var(--sidebar-collapsed);
                }
                .dash-sidebar.closed .dash-menu-text,
                .dash-sidebar.closed .dash-menu-arrow,
                .dash-sidebar.closed .dash-menu-label {
                    display: none;
                }

                .dash-sidebar-inner {
                    flex: 1;
                    overflow-y: auto;
                    padding: 20px 10px;
                    min-height: 0;
                }
                
                .dash-sidebar-inner::-webkit-scrollbar { width: 4px; }
                .dash-sidebar-inner::-webkit-scrollbar-track { background: transparent; }
                .dash-sidebar-inner::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

                .dash-menu-label {
                    font-size: 0.7rem;
                    text-transform: uppercase;
                    color: var(--text-muted);
                    font-weight: 700;
                    letter-spacing: 1px;
                    margin-left: 12px;
                    margin-bottom: 10px;
                    display: block;
                }

                .dash-menu-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 4px;
                }

                .dash-menu-item {
                    display: flex;
                    align-items: center;
                    width: 100%;
                    padding: 10px 12px;
                    border-radius: 8px;
                    border: none;
                    background: transparent;
                    color: var(--text-muted);
                    font-size: 0.95rem;
                    cursor: pointer;
                    text-decoration: none;
                    transition: all 0.2s;
                }
                .dash-menu-item:hover {
                    background: rgba(255,255,255,0.05);
                    color: var(--text-main);
                }
                .dash-menu-item.active {
                    background: linear-gradient(90deg, var(--primary-glow) 0%, transparent 100%);
                    color: var(--primary);
                    font-weight: 600;
                    border-left: 3px solid var(--primary);
                }

                .dash-menu-icon { min-width: 20px; margin-right: 12px; }
                .dash-sidebar.closed .dash-menu-icon { margin-right: 0; margin-left: 4px; }
                .dash-menu-text { flex: 1; text-align: left; white-space: nowrap; }
                .dash-menu-arrow { margin-left: auto; transition: transform 0.2s; }

                .dash-submenu-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.3s ease;
                }
                .dash-submenu-list.open {
                    max-height: 500px; /* arbitrary large max height */
                    margin-top: 4px;
                }
                .dash-submenu-item {
                    display: block;
                    padding: 8px 12px 8px 44px;
                    color: var(--text-muted);
                    text-decoration: none;
                    font-size: 0.85rem;
                    border-radius: 8px;
                    transition: all 0.2s;
                    white-space: nowrap;
                    position: relative;
                }
                .dash-submenu-item:hover {
                    background: rgba(255,255,255,0.03);
                    color: var(--text-main);
                    transform: translateX(4px);
                }
                .dash-submenu-item.active {
                    color: var(--primary);
                    font-weight: 600;
                    background: rgba(14, 165, 233, 0.1);
                }
                .dash-submenu-item.active::before {
                    content: '';
                    position: absolute;
                    left: 20px;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 6px;
                    height: 6px;
                    border-radius: 50%;
                    background: var(--primary);
                    box-shadow: 0 0 8px var(--primary);
                }

                .dash-sidebar-footer {
                    padding: 15px;
                    border-top: 1px solid var(--glass-border);
                }
                .dash-back-btn {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    color: var(--text-muted);
                    text-decoration: none;
                    font-size: 0.9rem;
                    padding: 8px;
                    border-radius: 8px;
                    transition: all 0.2s;
                    justify-content: center;
                }
                .dash-back-btn:hover { background: rgba(255,255,255,0.05); color: var(--text-main); }
                .dash-sidebar.closed .dash-back-btn { padding: 8px 0; }

                /* Main Content Area */
                .dash-content {
                    flex: 1;
                    overflow: hidden;
                    position: relative;
                    z-index: 1;
                    min-width: 0;
                    min-height: 0;
                    display: flex;
                    flex-direction: column;
                }
                
                .dash-content-inner {
                    flex: 1;
                    padding: 30px;
                    overflow: hidden;
                    min-height: 0;
                    display: flex;
                    flex-direction: column;
                    position: relative;
                }
                
                .dash-welcome {
                    padding: 30px;
                    border-radius: 16px;
                    margin-bottom: 30px;
                    animation: slideUp 0.5s ease-out forwards;
                }
                .dash-welcome h1 { margin-top: 0; font-size: 2rem; margin-bottom: 10px; background: linear-gradient(135deg, #fff, var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
                .dash-welcome p { color: var(--text-muted); margin: 0; font-size: 1.05rem; }

                .dash-widgets {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 20px;
                    animation: slideUp 0.6s ease-out forwards;
                }

                .dash-widget {
                    padding: 24px;
                    border-radius: 16px;
                    transition: transform 0.3s;
                }
                .dash-widget:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
                .widget-icon { margin-bottom: 16px; }
                .widget-icon.primary { color: var(--primary); }
                .widget-icon.success { color: #10b981; }
                .dash-widget h3 { margin: 0 0 8px 0; font-size: 1.2rem; }
                .dash-widget p { margin: 0; color: var(--text-muted); font-size: 0.9rem; line-height: 1.5; }

                @keyframes slideUp {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                /* Responsive */
                @media (max-width: 768px) {
                    .dash-sidebar { position: absolute; height: 100%; z-index: 10; background: var(--bg-dark); }
                    .dash-sidebar.closed { transform: translateX(-100%); width: var(--sidebar-width); }
                    .dash-content-inner { padding: 15px; }
                    .dash-nav-right .dash-clock, .dash-nav-right .dash-user-info { display: none; }
                }
            `}</style>
        </div>
    );
}
