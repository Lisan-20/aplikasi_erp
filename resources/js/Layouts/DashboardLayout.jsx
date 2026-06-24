import React, { useState, useEffect } from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import {
    Menu, X, ChevronDown,
    Users, Settings, Briefcase,
    FileText, LogOut, LayoutDashboard,
    Sun, Moon, Boxes, Database, Layers, Activity
} from 'lucide-react';
import Swal from 'sweetalert2';

export default function DashboardLayout({ children }) {
    const page = usePage();
    const { auth, dashboard } = page.props;
    const activeUrl = page.url;
    const user = auth?.user || { username: 'User', role: 'Administrator' };
    const module_name = dashboard?.module_name || 'Dashboard';
    const menus = dashboard?.menus || [];

    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const [openMenus, setOpenMenus] = useState({});

    const { flash } = usePage().props;

    useEffect(() => {
        if (flash?.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: flash.success,
                timer: 2000,
                showConfirmButton: false
            });
        }
        if (flash?.error) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: flash.error,
            });
        }
    }, [flash]); // Akan tertrigger setiap kali "flash" berubah
    // Close dropdowns when clicking outside
    useEffect(() => {
        const handleClickOutside = (e) => {
            if (!e.target.closest('.dash-nav-item-container')) {
                setOpenMenus({});
            }
        };
        document.addEventListener('click', handleClickOutside);
        return () => document.removeEventListener('click', handleClickOutside);
    }, []);

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
        document.documentElement.setAttribute('data-theme', newTheme);
        if (newTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    };

    const toggleMobileMenu = () => setIsMobileMenuOpen(!isMobileMenuOpen);

    const toggleMenu = (menuId, e) => {
        if (e) e.stopPropagation();
        setOpenMenus(prev => {
            if (prev[menuId]) return {};
            return { [menuId]: true };
        });
    };

    const isPopup = typeof window !== 'undefined' && window.location.search.includes('popup=1');

    if (isPopup) {
        return (
            <div className="dash-layout popup-mode" data-theme={theme} style={{ display: 'block', height: 'auto', overflow: 'auto' }}>
                <Head title={`${module_name || 'Dashboard'} - ERP`} />
                <div className="dash-body" style={{ height: 'auto', overflow: 'visible', padding: '20px' }}>
                    <main className="dash-content" style={{ width: '100%', maxWidth: '100%', margin: 0, padding: 0 }}>
                        {children}
                    </main>
                </div>
            </div>
        );
    }

    return (
        <div className="dash-layout" data-theme={theme}>
            <Head title={`${module_name || 'Dashboard'} - ERP`} />

            {/* Top Navbar (Header) */}
            <header className="dash-navbar dash-glass-panel">
                <div className="dash-nav-left">
                    <button onClick={toggleMobileMenu} className="dash-icon-btn mobile-menu-btn">
                        {isMobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
                    </button>
                    <div className="dash-brand">
                        <Boxes size={28} className="dash-brand-icon" />
                        <div>
                            <h2>SISTEM ERP</h2>
                            <span className="dash-tag">{module_name || 'Enterprise Edition'}</span>
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

            {/* Top Navigation Menu (Horizontal) */}
            <nav className={`dash-top-nav dash-glass-panel ${isMobileMenuOpen ? 'mobile-open' : ''}`}>
                <div className="dash-nav-container">
                    <ul className="dash-nav-list">
                        {/* App Switcher / Back to Modules */}
                        <li className="dash-nav-item-container">
                            <Link href="/modul" className="dash-nav-item app-switcher-btn">
                                <LayoutDashboard size={18} />
                                <span>Ganti Modul</span>
                            </Link>
                        </li>

                        <div className="dash-nav-divider"></div>

                        {menus.map((menu, idx) => {
                            const menuId = menu.id_menu || menu.id || idx;
                            const submenus = menu.sub_menus || menu.submenus || menu.children || [];
                            const isOpen = openMenus[menuId];
                            const menuName = menu.nama_menu || menu.name || 'Menu';

                            return (
                                <li key={menuId} className="dash-nav-item-container">
                                    <button
                                        className={`dash-nav-item ${isOpen ? 'active' : ''}`}
                                        onClick={(e) => toggleMenu(menuId, e)}
                                    >
                                        <span className="dash-nav-text">{menuName}</span>
                                        {submenus.length > 0 && (
                                            <ChevronDown size={14} className={`dash-nav-arrow ${isOpen ? 'rotate' : ''}`} />
                                        )}
                                    </button>

                                    {/* Dropdown Menu */}
                                    {submenus.length > 0 && (
                                        <div className={`dash-dropdown-menu ${isOpen ? 'show' : ''}`}>
                                            <ul className="dash-dropdown-list">
                                                {submenus.map((sub, sIdx) => {
                                                    const subUrl  = sub.url_sub_menu_baru || null;
                                                    const subName = sub.nama_sub_menu || sub.name || 'Submenu';
                                                    const isActive = subUrl && (activeUrl === subUrl || activeUrl.startsWith(subUrl + '?'));

                                                    return (
                                                        <li key={sub.id_dc_sub_menu || sub.id || sIdx}>
                                                            {subUrl ? (
                                                                <Link href={subUrl} className={`dash-dropdown-item ${isActive ? 'active' : ''}`}>
                                                                    {subName}
                                                                </Link>
                                                            ) : (
                                                                <span className="dash-dropdown-item disabled" title="URL belum dikonfigurasi">
                                                                    {subName}
                                                                </span>
                                                            )}
                                                        </li>
                                                    );
                                                })}
                                            </ul>
                                        </div>
                                    )}
                                </li>
                            );
                        })}
                    </ul>
                </div>
            </nav>

            <div className="dash-body">
                {/* Main Content Area */}
                <main className="dash-content">
                    {children ? children : (
                        <>
                            <div className="dash-welcome dash-glass-panel">
                                <h1>Selamat Datang di {module_name || 'Modul Sistem'}</h1>
                                <p>Silakan gunakan menu navigasi di atas untuk mengakses fitur yang tersedia dalam modul ini.</p>
                            </div>

                            <div className="dash-widgets">
                                <div className="dash-widget dash-glass-panel">
                                    <Activity size={32} className="widget-icon primary" />
                                    <h3>Status Sistem</h3>
                                    <p>Sistem berjalan optimal. Semua layanan terhubung.</p>
                                </div>
                                <div className="dash-widget dash-glass-panel">
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
                /* Inline CSS for ERP Style Dashboard */
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

                :root {
                    /* Main background */
                    --bg-dark: #0b0f19;

                    /* Glass Panels */
                    --glass-bg: rgba(17, 24, 39, 0.7);
                    --glass-border: rgba(255, 255, 255, 0.06);
                    --glass-hover: rgba(31, 41, 55, 0.8);
                    --glass-dropdown: rgba(17, 24, 39, 0.95);

                    /* Primary brand color */
                    --primary: #3b82f6;
                    --primary-glow: rgba(59, 130, 246, 0.15);
                    --primary-hover: #2563eb;

                    /* Text colors */
                    --text-main: #f3f4f6;
                    --text-muted: #9ca3af;

                    /* Layout */
                    --top-nav-height: 54px;

                    /* Shadows */
                    --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                    --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                    --shadow-dropdown: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
                }

                .dash-layout[data-theme="light"] {
                    --bg-dark: #f3f4f6;
                    --glass-bg: #ffffff;
                    --glass-border: #e5e7eb;
                    --glass-hover: #f9fafb;
                    --glass-dropdown: #ffffff;
                    --primary: #2563eb;
                    --text-main: #111827;
                    --text-muted: #4b5563;
                }

                .dash-layout[data-theme="dark"] {
                    --bg-dark: #111827;
                    --glass-bg: #1f2937;
                    --glass-border: #374151;
                    --glass-hover: #374151;
                    --glass-dropdown: #1f2937;
                    --primary: #3b82f6;
                    --text-main: #f9fafb;
                    --text-muted: #9ca3af;
                }

                .dash-layout, .dash-layout *, .dash-layout *::before, .dash-layout *::after {
                    box-sizing: border-box;
                }

                .dash-layout {
                    height: 100vh;
                    background-color: var(--bg-dark);
                    color: var(--text-main);
                    font-family: 'Inter', system-ui, -apple-system, sans-serif;
                    display: flex;
                    flex-direction: column;
                    overflow: hidden;
                    position: relative;
                }

                /* Glass Panel */
                .dash-glass-panel {
                    background: var(--glass-bg);
                    backdrop-filter: blur(16px);
                    -webkit-backdrop-filter: blur(16px);
                    border: 1px solid var(--glass-border);
                    box-shadow: var(--shadow-md);
                    border-radius: 12px;
                    z-index: 1;
                }

                /* Navbar Header */
                .dash-navbar {
                    height: 64px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0 24px;
                    border-bottom: 1px solid var(--glass-border);
                    border-radius: 0;
                    box-shadow: none;
                    z-index: 20;
                    flex-shrink: 0;
                }

                .dash-nav-left { display: flex; align-items: center; gap: 20px; }
                .mobile-menu-btn { display: none; } /* Hidden on desktop */

                .dash-icon-btn {
                    background: transparent;
                    border: none;
                    color: var(--text-muted);
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 8px;
                    border-radius: 6px;
                    transition: all 0.2s;
                }
                .dash-icon-btn:hover { background: var(--glass-hover); color: var(--text-main); }

                .dash-brand { display: flex; align-items: center; gap: 12px; }
                .dash-brand-icon { color: var(--primary); }
                .dash-brand h2 { margin: 0; font-size: 1.25rem; font-weight: 700; letter-spacing: 0.5px; color: var(--text-main); }
                .dash-tag { font-size: 0.75rem; color: var(--primary); background: var(--primary-glow); padding: 2px 8px; border-radius: 4px; font-weight: 600; }

                .dash-nav-right { display: flex; align-items: center; gap: 24px; }
                .dash-clock { font-size: 0.85rem; color: var(--text-muted); font-weight: 500; }
                .dash-user { display: flex; align-items: center; gap: 12px; }
                .dash-user-info { display: flex; flex-direction: column; align-items: flex-end; }
                .dash-user-name { font-weight: 600; font-size: 0.85rem; color: var(--text-main); }
                .dash-user-role { font-size: 0.75rem; color: var(--text-muted); }
                .dash-avatar { width: 34px; height: 34px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; }
                .dash-logout-btn { color: var(--text-muted); transition: color 0.2s; margin-left: 8px; }
                .dash-logout-btn:hover { color: #ef4444; }

                /* Top Navigation (Horizontal) */
                .dash-top-nav {
                    border-radius: 0;
                    border-bottom: 1px solid var(--glass-border);
                    border-top: none;
                    border-left: none;
                    border-right: none;
                    z-index: 15;
                    flex-shrink: 0;
                }

                .dash-nav-container {
                    padding: 0 24px;
                }

                .dash-nav-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    align-items: center;
                    min-height: var(--top-nav-height);
                    gap: 4px;
                    flex-wrap: wrap;
                }

                .dash-nav-divider {
                    width: 1px;
                    height: 24px;
                    background: var(--glass-border);
                    margin: 0 8px;
                }

                .dash-nav-item-container {
                    position: relative;
                    display: flex;
                    align-items: center;
                    height: 100%;
                }

                .dash-nav-item {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    height: 38px;
                    padding: 0 14px;
                    border-radius: 6px;
                    border: none;
                    background: transparent;
                    color: var(--text-muted);
                    font-size: 0.9rem;
                    font-weight: 500;
                    cursor: pointer;
                    text-decoration: none;
                    transition: all 0.2s;
                    white-space: nowrap;
                }

                .dash-nav-item.app-switcher-btn {
                    color: var(--primary);
                    font-weight: 600;
                    background: var(--primary-glow);
                }

                .dash-nav-item:hover, .dash-nav-item.active {
                    color: var(--text-main);
                    background: var(--glass-hover);
                }
                .dash-nav-item.active {
                    font-weight: 600;
                }

                .dash-nav-arrow {
                    transition: transform 0.2s ease;
                }
                .dash-nav-arrow.rotate {
                    transform: rotate(-180deg);
                }

                /* Dropdown Menu */
                .dash-dropdown-menu {
                    position: absolute;
                    top: calc(100% - 4px);
                    left: 0;
                    min-width: 220px;
                    background: var(--glass-dropdown);
                    backdrop-filter: blur(16px);
                    border: 1px solid var(--glass-border);
                    border-radius: 8px;
                    box-shadow: var(--shadow-dropdown);
                    opacity: 0;
                    visibility: hidden;
                    transform: translateY(10px);
                    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
                    z-index: 100;
                    padding: 8px;
                }

                .dash-dropdown-menu.show {
                    opacity: 1;
                    visibility: visible;
                    transform: translateY(0);
                }

                .dash-dropdown-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 2px;
                }

                .dash-dropdown-item {
                    display: block;
                    padding: 10px 14px;
                    color: var(--text-muted);
                    text-decoration: none;
                    font-size: 0.85rem;
                    border-radius: 6px;
                    transition: all 0.2s;
                    font-weight: 500;
                }

                .dash-dropdown-item:hover {
                    color: var(--text-main);
                    background: var(--glass-hover);
                }

                .dash-dropdown-item.active {
                    color: var(--primary);
                    background: var(--primary-glow);
                    font-weight: 600;
                }

                .dash-dropdown-item.disabled {
                    opacity: 0.4;
                    cursor: not-allowed;
                    pointer-events: none;
                    font-style: italic;
                }

                /* Body Layout */
                .dash-body {
                    display: flex;
                    flex: 1;
                    overflow: hidden;
                    min-height: 0;
                    position: relative;
                }

                /* Main Content Area */
                .dash-content {
                    flex: 1;
                    overflow: auto;
                    position: relative;
                    z-index: 1;
                    min-width: 0;
                    min-height: 0;
                    display: flex;
                    flex-direction: column;
                    padding: 24px;
                }

                .dash-welcome {
                    padding: 30px;
                    border-radius: 8px;
                    margin-bottom: 24px;
                    border-left: 4px solid var(--primary);
                    background: var(--glass-bg);
                }
                .dash-welcome h1 { margin-top: 0; font-size: 1.5rem; margin-bottom: 8px; color: var(--text-main); }
                .dash-welcome p { color: var(--text-muted); margin: 0; font-size: 0.95rem; }

                .dash-widgets {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 20px;
                }

                .dash-widget {
                    padding: 24px;
                    border-radius: 8px;
                    transition: box-shadow 0.2s;
                }
                .dash-widget:hover { box-shadow: var(--shadow-md); }
                .widget-icon { margin-bottom: 16px; }
                .widget-icon.primary { color: var(--primary); }
                .widget-icon.success { color: #10b981; }
                .dash-widget h3 { margin: 0 0 8px 0; font-size: 1.1rem; color: var(--text-main); }
                .dash-widget p { margin: 0; color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; }

                /* Odoo Views Extracted to Generic Usage */
                .odoo-control-panel {
                    padding: 10px 0;
                    margin-bottom: 15px;
                    border-bottom: 1px solid var(--glass-border);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    min-height: 50px;
                }

                /* Responsive Mobile */
                @media (max-width: 768px) {
                    .mobile-menu-btn { display: flex; }
                    .dash-nav-right .dash-clock, .dash-nav-right .dash-user-info { display: none; }
                    .dash-brand h2 { font-size: 1.1rem; }
                    .dash-tag { display: none; }

                    .dash-navbar { padding: 0 16px; }
                    .dash-content { padding: 16px; }

                    /* Mobile Top Nav Overlay (Turns into Sidebar basically, or full drop down) */
                    .dash-top-nav {
                        position: absolute;
                        top: 64px;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: var(--glass-dropdown);
                        z-index: 30;
                        border-radius: 0;
                        border: none;
                        flex-direction: column;
                        overflow-y: auto;
                        transform: translateX(-100%);
                        transition: transform 0.3s ease;
                        height: calc(100vh - 64px);
                    }

                    .dash-top-nav.mobile-open {
                        transform: translateX(0);
                    }

                    .dash-nav-container { padding: 16px; }

                    .dash-nav-list {
                        flex-direction: column;
                        align-items: flex-start;
                        height: auto;
                        gap: 8px;
                    }

                    .dash-nav-item-container {
                        width: 100%;
                        flex-direction: column;
                        align-items: flex-start;
                        height: auto;
                    }

                    .dash-nav-item {
                        width: 100%;
                        justify-content: space-between;
                        padding: 12px 16px;
                    }

                    .dash-nav-divider {
                        width: 100%;
                        height: 1px;
                        margin: 12px 0;
                    }

                    .dash-dropdown-menu {
                        position: static;
                        width: 100%;
                        box-shadow: none;
                        background: transparent;
                        border: none;
                        padding: 0;
                        display: none;
                        transform: none;
                        opacity: 1;
                        visibility: visible;
                    }

                    .dash-dropdown-menu.show {
                        display: block;
                        margin-top: 4px;
                        padding-left: 16px;
                    }

                    .dash-dropdown-item {
                        padding: 10px 16px;
                    }
                }
            `}</style>
        </div>
    );
}
