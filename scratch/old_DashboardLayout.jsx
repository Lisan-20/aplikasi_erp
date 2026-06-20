Created At: 2026-06-15T19:42:28Z
Completed At: 2026-06-15T19:42:28Z
File Path: `file:///d:/001_Aplikasi/aplikasi_erp_laravel/resources/js/Layouts/DashboardLayout.jsx`
Total Lines: 705
Total Bytes: 34913
Showing lines 1 to 705
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: import React, { useState, useEffect } from 'react';
2: import { Head, Link, usePage } from '@inertiajs/react';
3: import {
4:     Menu, X, ChevronDown, ChevronRight,
5:     Home, Users, Settings, Briefcase,
6:     FileText, LogOut, LayoutDashboard,
7:     Sun, Moon, Boxes, Database, Layers
8: } from 'lucide-react';
9: 
10: // A mapping function to guess an icon based on menu name
11: const getMenuIcon = (name) => {
12:     const n = name?.toLowerCase() || '';
13:     if (n.includes('pasien') || n.includes('user') || n.includes('sdm') || n.includes('pegawai')) return <Users size={20} />;
14:     if (n.includes('rekam') || n.includes('laporan') || n.includes('dokumen')) return <FileText size={20} />;
15:     if (n.includes('setting') || n.includes('pengaturan')) return <Settings size={20} />;
16:     if (n.includes('medis') || n.includes('klinik') || n.includes('layanan') || n.includes('poli')) return <Briefcase size={20} />;
17:     if (n.includes('antrean') || n.includes('queue') || n.includes('transaksi') || n.includes('kasir')) return <Database size={20} />;
18:     if (n.includes('gudang') || n.includes('stok') || n.includes('inventori')) return <Boxes size={20} />;
19:     return <Layers size={20} />;
20: };
21: 
22: export default function DashboardLayout({ children }) {
23:     const { auth, dashboard, url: currentUrl } = usePage().props;
24:     // Alternative way to get url if it's not in props: const currentUrl = usePage().url;
25:     const activeUrl = currentUrl || usePage().url;
26:     const user = auth?.user || { username: 'User', role: 'Administrator' };
27:     const module_name = dashboard?.module_name || 'Dashboard';
28:     const menus = dashboard?.menus || [];
29: 
30:     const [isSidebarOpen, setSidebarOpen] = useState(() => {
        if (typeof window !== 'undefined') {
            const saved = localStorage.getItem('sidebarOpen');
            return saved !== null ? saved === 'true' : true;
        }
        return true;
    });

    useEffect(() => {
        if (typeof window !== 'undefined') {
            localStorage.setItem('sidebarOpen', isSidebarOpen);
        }
    }, [isSidebarOpen]);
31: 
32:     // Simpan status menu yang terbuka ke sessionStorage agar tidak tertutup saat ganti halaman
33:     const [openMenus, setOpenMenus] = useState(() => {
34:         try {
35:             const saved = sessionStorage.getItem('medilink_open_menus');
36:             return saved ? JSON.parse(saved) : {};
37:         } catch (e) {
38:             return {};
39:         }
40:     });
41: 
42:     useEffect(() => {
43:         sessionStorage.setItem('medilink_open_menus', JSON.stringify(openMenus));
44:     }, [openMenus]);
45: 
46:     const [currentTime, setCurrentTime] = useState(new Date());
47:     const [theme, setTheme] = useState('dark');
48: 
49:     useEffect(() => {
50:         const savedTheme = localStorage.getItem('medilink-theme');
51:         if (savedTheme) {
52:             setTheme(savedTheme);
53:         } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
54:             setTheme('light');
55:         }
56: 
57:         const timer = setInterval(() => setCurrentTime(new Date()), 1000);
58:         return () => clearInterval(timer);
59:     }, []);
60: 
61:     const toggleTheme = () => {
62:         const newTheme = theme === 'dark' ? 'light' : 'dark';
63:         setTheme(newTheme);
64:         localStorage.setItem('medilink-theme', newTheme);
65:     };
66: 
67:     const toggleSidebar = () => setSidebarOpen(!isSidebarOpen);
68: 
69:     const toggleMenu = (menuId) => {
70:         setOpenMenus(prev => ({
71:             ...prev,
72:             [menuId]: !prev[menuId]
73:         }));
74:     };
75: 
76:     const isPopup = typeof window !== 'undefined' && window.location.search.includes('popup=1');
77: 
78:     if (isPopup) {
79:         return (
80:             <div className="dash-layout popup-mode" data-theme={theme} style={{ display: 'block', height: 'auto', overflow: 'auto' }}>
81:                 <Head title={`${module_name || 'Dashboard'} - ERP`} />
82:                 <div className="dash-body" style={{ height: 'auto', overflow: 'visible', padding: '20px' }}>
83:                     <main className="dash-content" style={{ width: '100%', maxWidth: '100%', margin: 0, padding: 0 }}>
84:                         {children}
85:                     </main>
86:                 </div>
87:             </div>
88:         );
89:     }
90: 
91:     return (
92:         <div className="dash-layout" data-theme={theme}>
93:             <Head title={`${module_name || 'Dashboard'} - ERP`} />
94: 
95:             {/* Top Navbar */}
96:             <header className="dash-navbar dash-glass-panel">
97:                 <div className="dash-nav-left">
98:                     <button onClick={toggleSidebar} className="dash-icon-btn">
99:                         {isSidebarOpen ? <X size={24} /> : <Menu size={24} />}
100:                     </button>
101:                     <div className="dash-brand">
102:                         <Boxes size={28} className="dash-brand-icon" />
103:                         <div>
104:                             <h2>SISTEM ERP</h2>
105:                             <span className="dash-tag">{module_name || 'Enterprise Edition'}</span>
106:                         </div>
107:                     </div>
108:                 </div>
109: 
110:                 <div className="dash-nav-right">
111:                     <div className="dash-clock">
112:                         {currentTime.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })} WIB
113:                     </div>
114: 
115:                     <button onClick={toggleTheme} className="dash-icon-btn theme-toggle" title="Ubah Tema">
116:                         {theme === 'dark' ? <Sun size={20} className="text-yellow-400" /> : <Moon size={20} className="text-blue-600" />}
117:                     </button>
118: 
119:                     <div className="dash-user">
120:                         <div className="dash-user-info">
121:                             <span className="dash-user-name">{user.username || user.name}</span>
122:                             <span className="dash-user-role">{user.role || 'Staff'}</span>
123:                         </div>
124:                         <div className="dash-avatar">
125:                             {(user.username || user.name || 'U').charAt(0).toUpperCase()}
126:                         </div>
127:                         <Link href="/logout" className="dash-logout-btn" title="Keluar">
128:                             <LogOut size={20} />
129:                         </Link>
130:                     </div>
131:                 </div>
132:             </header>
133: 
134:             <div className="dash-body">
135:                 {/* Overlay Backdrop for Mobile */}
136:                 <div 
137:                     className={`dash-sidebar-overlay ${isSidebarOpen ? 'show' : ''}`} 
138:                     onClick={toggleSidebar}
139:                 ></div>
140: 
141:                 {/* Sidebar */}
142:                 <aside className={`dash-sidebar dash-glass-panel ${isSidebarOpen ? 'open' : 'closed'}`}>
143:                     <div className="dash-sidebar-inner">
144:                         <div className="dash-menu-section">
145:                             <span className="dash-menu-label">Main Menu</span>
146:                             <ul className="dash-menu-list">
147:                                 {menus.map((menu, idx) => {
148:                                     const menuId = menu.id_menu || menu.id || idx;
149:                                     const submenus = menu.sub_menus || menu.submenus || menu.children || [];
150:                                     const isOpen = openMenus[menuId];
151:                                     const menuName = menu.nama_menu || menu.name || 'Menu';
152: 
153:                                     return (
154:                                         <li key={menuId} className="dash-menu-group">
155:                                             <button
156:                                                 className={`dash-menu-item ${isOpen ? 'active' : ''}`}
157:                                                 onClick={() => toggleMenu(menuId)}
158:                                             >
159:                                                 {getMenuIcon(menuName)}
160:                                                 <span className="dash-menu-text">{menuName}</span>
161:                                                 {submenus.length > 0 && (
162:                                                     isOpen ? <ChevronDown size={16} className="dash-menu-arrow" /> : <ChevronRight size={16} className="dash-menu-arrow" />
163:                                                 )}
164:                                             </button>
165: 
166:                                             {submenus.length > 0 && (
167:                                                 <ul className={`dash-submenu-list ${isOpen ? 'open' : ''}`}>
168:                                                     {submenus.map((sub, sIdx) => {
169:                                                         const subId = sub.id_dc_sub_menu || sub.id_sub_menu || sub.id;
170:                                                         let subUrlRaw = sub.url_sub_menu || sub.url || '#';
171: 
172:                                                         // NATIVE MIGRATION OVERRIDES (Tahap 1 & 2)
173:                                                         if (subId == 7) subUrlRaw = '/admin/privileges'; // Modul Admin -> Privilleges
174:                                                         if (subId == 9) subUrlRaw = '/registrasi/cari-pasien?type=poli';
175:                                                         if (subId == 11) subUrlRaw = '/registrasi/cari-pasien?type=igd';
176:                                                         if (subId == 10) subUrlRaw = '/registrasi/cari-pasien?type=pm';
177:                                                         if (subId == 12) subUrlRaw = '/registrasi/cari-pasien?type=ri';
178:                                                         if (subId == 668) subUrlRaw = '/registrasi/cari-pasien?type=igd-malam';
179:                                                         if (subId == 807) subUrlRaw = '/registrasi/cari-pasien?type=paket-poli';
180:                                                         if (subId == 609) subUrlRaw = '/registrasi/cari-pasien?type=mcu';
181: 
182:                                                         // Other existing menus
183:                                                         if (subId == 13) subUrlRaw = '/registrasi/pasien-baru';
184:                                                         if (subId == 433) subUrlRaw = '/registrasi/pasien-lama';
185:                                                         if (subId == 1246) subUrlRaw = '/registrasi/listing-poli';
186:                                                         if (subId == 1829 || subId == 2267) subUrlRaw = '/registrasi/permintaan-ri';
187:                                                         if (subId == 743) subUrlRaw = '/registrasi/pasien-rawat-inap';
188:                                                         if (subId == 14) subUrlRaw = '/registrasi/edit-data'; // Phase 2
189:                                                         // Phase 3 Mappings
190:                                                         if (subId == 15) subUrlRaw = '/registrasi/jadwal-dokter';
191:                                                         if (subId == 16) subUrlRaw = '/registrasi/riwayat-pasien';
192:                                                         if (subId == 28) subUrlRaw = '/registrasi/info-ruangan';
193:                                                         if (subId == 2349) subUrlRaw = '/registrasi/info-ruangan-2';
194:                                                         if (subId == 1211) subUrlRaw = '/registrasi/harga-kamar';
195:                                                         if (subId == 1374) subUrlRaw = '/registrasi/info-tarif-umum';
196:                                                         if (subId == 19) subUrlRaw = '/registrasi/paket-bedah';
197:                                                         if (subId == 20) subUrlRaw = '/registrasi/paket-melahirkan';
198:                                                         // Phase 4 Mappings
199:                                                         if (subId == 434) subUrlRaw = '/registrasi/perjanjian-pasien';
200:                                                         if (subId == 435) subUrlRaw = '/registrasi/daftar-perjanjian';
201:                                                         if (subId == 1736 || subId == 1737) subUrlRaw = '/registrasi/listing-online';
202:                                                         if (subId == 1773) subUrlRaw = '/registrasi/listing-jkn';
203: 
204:                                                         // Laporan Mappings
205:                                                         if (subUrlRaw.includes('lap_kinerja.php')) {
206:                                                             subUrlRaw = '/laporan/registrasi/kinerja';
207:                                                         }
208:                                                         if (subUrlRaw.includes('lap_kunjungan.php')) {
209:                                                             subUrlRaw = '/laporan/registrasi/kunjungan';
210:                                                         }
211: 
212:                                                         // Poli Mappings
213:                                                         if (subUrlRaw.includes('antrian.php') || subUrlRaw.includes('antrian_pasien.php')) {
214:                                                             subUrlRaw = '/poli/antrian-poli';
215:                                                         }
216: 
217:                                                         // Kasir Mappings
218:                                                         if (subId == 240) subUrlRaw = '/kasir/antrian-loket';
219:                                                         let tmpSubName = sub.nama_sub_menu || sub.name || '';
220:                                                         if (tmpSubName.toLowerCase().includes('laporan kasir') || tmpSubName.toLowerCase().includes('rekap kasir')) subUrlRaw = '/laporan/kasir';
221: 
222:                                                         // Phase 5 Mappings
223:                                                         if (subId == 2192) subUrlRaw = '/registrasi/listing-poli'; // Listing Pasien His → same page
224: 
225:                                                         // Admin Mappings
226:                                                         if (subUrlRaw.includes('user_view.php')) subUrlRaw = '/admin/user';
227: 
228:                                                         // CATCH-ALL: Redirect all remaining legacy scripts to Under Construction
229:                                                         if (subUrlRaw.includes('.php') || subUrlRaw.includes('legacy-ext') || subUrlRaw.startsWith('http')) {
230:                                                             subUrlRaw = '/registrasi/under-construction';
231:                                                         }
232: 
233:                                                         let subUrl = subUrlRaw.trim();
234: 
235:                                                         // Convert relative legacy paths to root-absolute
236:                                                         if (subUrl.startsWith('../')) {
237:                                                             subUrl = '/' + subUrl.substring(3);
238:                                                         } else if (!subUrl.startsWith('/') && !subUrl.startsWith('http') && subUrl !== '#') {
239:                                                             subUrl = '/' + subUrl;
240:                                                         }
241: 
242:                                                         // External http:// URLs that are NOT already routed via /registrasi/legacy-ext
243:                                                         // should open in new tab (e.g. accidental unhandled http:// links)
244:                                                         const isUnhandledExternal = subUrl.startsWith('http');
245:                                                         const subName = sub.nama_sub_menu || sub.name || 'Submenu';
246: 
247:                                                         const isActive = activeUrl === subUrl || activeUrl.startsWith(subUrl + '?');
248: 
249:                                                         return (
250:                                                             <li key={sub.id_sub_menu || sub.id || sIdx}>
251:                                                                 {isUnhandledExternal ? (
252:                                                                     <a href={subUrl} className={`dash-submenu-item ${isActive ? 'active' : ''}`} target="_blank" rel="noreferrer">
253:                                                                         {subName}
254:                                                                     </a>
255:                                                                 ) : (
256:                                                                     <Link href={subUrl} className={`dash-submenu-item ${isActive ? 'active' : ''}`}>
257:                                                                         {subName}
258:                                                                     </Link>
259:                                                                 )}
260:                                                             </li>
261:                                                         );
262:                                                     })}
263:                                                 </ul>
264:                                             )}
265:                                         </li>
266:                                     );
267:                                 })}
268:                             </ul>
269:                         </div>
270:                     </div>
271: 
272:                     <div className="dash-sidebar-footer">
273:                         <Link href="/modul" className="dash-back-btn">
274:                             &larr; <span className="dash-menu-text">Ganti Modul</span>
275:                         </Link>
276:                     </div>
277:                 </aside>
278: 
279:                 {/* Main Content Area */}
280:                 <main className="dash-content">
281:                     {children ? children : (
282:                         <>
283:                             <div className="dash-welcome dash-glass-panel">
284:                                 <h1>Selamat Datang di {module_name || 'Modul Sistem'}</h1>
285:                                 <p>Silakan gunakan menu navigasi di sebelah kiri untuk mengakses fitur yang tersedia dalam modul ini.</p>
286:                             </div>
287: 
288:                             <div className="dash-widgets">
289:                                 <div className="dash-widget dash-glass-panel">
290:                                     <Activity size={32} className="widget-icon primary" />
291:                                     <h3>Status Sistem</h3>
292:                                     <p>Sistem berjalan optimal. Semua layanan terhubung.</p>
293:                                 </div>
294:                                 <div className="dash-widget dash-glass-panel">
295:                                     <Users size={32} className="widget-icon success" />
296:                                     <h3>Sesi Pengguna</h3>
297:                                     <p>Anda login sebagai <strong>{user.username || user.name}</strong> dengan hak akses modul saat ini.</p>
298:                                 </div>
299:                             </div>
300:                         </>
301:                     )}
302:                 </main>
303:             </div>
304: 
305:             <style>{`
306:                 /* Inline CSS for ERP Style Dashboard */
307:                 @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
308: 
309:                 :root {
310:                     /* Main background */
311:                     --bg-dark: #0b0f19;
312: 
313:                     /* Glass Panels */
314:                     --glass-bg: rgba(17, 24, 39, 0.7);
315:                     --glass-border: rgba(255, 255, 255, 0.06);
316:                     --glass-hover: rgba(31, 41, 55, 0.8);
317: 
318:                     /* Primary brand color */
319:                     --primary: #3b82f6;
320:                     --primary-glow: rgba(59, 130, 246, 0.15);
321:                     --primary-hover: #2563eb;
322: 
323:                     /* Text colors */
324:                     --text-main: #f3f4f6;
325:                     --text-muted: #9ca3af;
326: 
327:                     /* Layout */
328:                     --sidebar-width: 260px;
329:                     --sidebar-collapsed: 72px;
330: 
331:                     /* Shadows */
332:                     --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
333:                     --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
334:                 }
335: 
336:                 .dash-layout[data-theme="light"] {
337:                     --bg-dark: #f3f4f6;
338:                     --glass-bg: #ffffff;
339:                     --glass-border: #e5e7eb;
340:                     --glass-hover: #f9fafb;
341:                     --primary: #2563eb;
342:                     --text-main: #111827;
343:                     --text-muted: #4b5563;
344:                 }
345: 
346:                 /* Keep dark mode intact but make it solid instead of glass */
347:                 .dash-layout[data-theme="dark"] {
348:                     --bg-dark: #111827;
349:                     --glass-bg: #1f2937;
350:                     --glass-border: #374151;
351:                     --glass-hover: #374151;
352:                     --primary: #3b82f6;
353:                     --text-main: #f9fafb;
354:                     --text-muted: #9ca3af;
355:                 }
356: 
357:                 .dash-layout, .dash-layout *, .dash-layout *::before, .dash-layout *::after {
358:                     box-sizing: border-box;
359:                 }
360: 
361:                 .dash-layout {
362:                     height: 100vh;
363:                     background-color: var(--bg-dark);
364:                     color: var(--text-main);
365:                     font-family: 'Inter', system-ui, -apple-system, sans-serif;
366:                     display: flex;
367:                     flex-direction: column;
368:                     overflow: hidden;
369:                     position: relative;
370:                 }
371: 
372:                 /* Glass Panel for generic use */
373:                 .dash-glass-panel {
374:                     background: var(--glass-bg);
375:                     backdrop-filter: blur(16px);
376:                     -webkit-backdrop-filter: blur(16px);
377:                     border: 1px solid var(--glass-border);
378:                     box-shadow: var(--shadow-md);
379:                     border-radius: 12px;
380:                     position: relative;
381:                     z-index: 1;
382:                 }
383: 
384:                 /* Navbar */
385:                 .dash-navbar {
386:                     height: 64px;
387:                     display: flex;
388:                     align-items: center;
389:                     justify-content: space-between;
390:                     padding: 0 20px;
391:                     border-bottom: 1px solid var(--glass-border);
392:                     border-radius: 0; /* Remove radius for navbar */
393:                     box-shadow: var(--shadow-sm);
394:                     z-index: 20;
395:                 }
396: 
397:                 .dash-nav-left {
398:                     display: flex;
399:                     align-items: center;
400:                     gap: 20px;
401:                 }
402: 
403:                 .dash-icon-btn {
404:                     background: transparent;
405:                     border: none;
406:                     color: var(--text-muted);
407:                     cursor: pointer;
408:                     display: flex;
409:                     align-items: center;
410:                     justify-content: center;
411:                     padding: 8px;
412:                     border-radius: 6px;
413:                     transition: all 0.2s;
414:                 }
415:                 .dash-icon-btn:hover { background: var(--glass-hover); color: var(--text-main); }
416: 
417:                 .dash-brand {
418:                     display: flex;
419:                     align-items: center;
420:                     gap: 12px;
421:                 }
422:                 .dash-brand-icon { color: var(--primary); }
423:                 .dash-brand h2 { margin: 0; font-size: 1.25rem; font-weight: 700; letter-spacing: 0.5px; color: var(--text-main); }
424:                 .dash-tag { font-size: 0.75rem; color: var(--primary); background: var(--primary-glow); padding: 2px 8px; border-radius: 4px; font-weight: 600; }
425: 
426:                 .dash-nav-right {
427:                     display: flex;
428:                     align-items: center;
429:                     gap: 24px;
430:                 }
431:                 .dash-clock { font-size: 0.85rem; color: var(--text-muted); font-weight: 500; }
432:                 .dash-user { display: flex; align-items: center; gap: 12px; }
433:                 .dash-user-info { display: flex; flex-direction: column; align-items: flex-end; }
434:                 .dash-user-name { font-weight: 600; font-size: 0.85rem; color: var(--text-main); }
435:                 .dash-user-role { font-size: 0.75rem; color: var(--text-muted); }
436:                 .dash-avatar { width: 34px; height: 34px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem; }
437:                 .dash-logout-btn { color: var(--text-muted); transition: color 0.2s; margin-left: 8px; }
438:                 .dash-logout-btn:hover { color: #ef4444; }
439: 
440:                 /* Body Layout */
441:                 .dash-body {
442:                     display: flex;
443:                     flex: 1;
444:                     overflow: hidden;
445:                     min-height: 0;
446:                 }
447: 
448:                 /* Sidebar */
449:                 .dash-sidebar {
450:                     width: var(--sidebar-width);
451:                     border-right: 1px solid var(--glass-border);
452:                     display: flex;
453:                     flex-direction: column;
454:                     transition: width 0.3s ease;
455:                     overflow-x: hidden;
456:                     min-height: 0;
457:                     border-radius: 0;
458:                     box-shadow: none; /* Let the border do the work */
459:                 }
460:                 .dash-sidebar.closed {
461:                     width: var(--sidebar-collapsed);
462:                 }
463:                 .dash-sidebar.closed .dash-menu-text,
464:                 .dash-sidebar.closed .dash-menu-arrow,
465:                 .dash-sidebar.closed .dash-menu-label {
466:                     display: none;
467:                 }
468: 
469:                 .dash-sidebar-inner {
470:                     flex: 1;
471:                     overflow-y: auto;
472:                     padding: 20px 12px;
473:                     min-height: 0;
474:                 }
475: 
476:                 .dash-sidebar-inner::-webkit-scrollbar { width: 6px; }
477:                 .dash-sidebar-inner::-webkit-scrollbar-track { background: transparent; }
478:                 .dash-sidebar-inner::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
479:                 .dash-sidebar-inner:hover::-webkit-scrollbar-thumb { background: #9ca3af; }
480: 
481:                 .dash-menu-label {
482:                     font-size: 0.7rem;
483:                     text-transform: uppercase;
484:                     color: var(--text-muted);
485:                     font-weight: 700;
486:                     letter-spacing: 1px;
487:                     margin-left: 12px;
488:                     margin-bottom: 12px;
489:                     margin-top: 10px;
490:                     display: block;
491:                 }
492: 
493:                 .dash-menu-list {
494:                     list-style: none;
495:                     padding: 0;
496:                     margin: 0;
497:                     display: flex;
498:                     flex-direction: column;
499:                     gap: 4px;
500:                 }
501: 
502:                 .dash-menu-item {
503:                     display: flex;
504:                     align-items: center;
505:                     width: 100%;
506:                     padding: 10px 12px;
507:                     border-radius: 6px;
508:                     border: none;
509:                     background: transparent;
510:                     color: var(--text-main);
511:                     font-size: 0.9rem;
512:                     font-weight: 500;
513:                     cursor: pointer;
514:                     text-decoration: none;
515:                     transition: all 0.2s;
516:                 }
517:                 .dash-menu-item:hover {
518:                     background: var(--glass-hover);
519:                 }
520:                 .dash-menu-item.active {
521:                     background: var(--primary-glow);
522:                     color: var(--primary);
523:                     font-weight: 600;
524:                 }
525: 
526:                 .dash-menu-icon { min-width: 20px; margin-right: 12px; color: var(--text-muted); }
527:                 .dash-menu-item.active .dash-menu-icon { color: var(--primary); }
528: 
529:                 .dash-sidebar.closed .dash-menu-icon { margin-right: 0; margin-left: 4px; }
530:                 .dash-menu-text { flex: 1; text-align: left; white-space: nowrap; }
531:                 .dash-menu-arrow { margin-left: auto; transition: transform 0.2s; color: var(--text-muted); }
532: 
533:                 .dash-submenu-list {
534:                     list-style: none;
535:                     padding: 0;
536:                     margin: 0;
537:                     max-height: 0;
538:                     overflow: hidden;
539:                     transition: max-height 0.3s ease;
540:                 }
541:                 .dash-submenu-list.open {
542:                     max-height: 1000px;
543:                     margin-top: 4px;
544:                     margin-bottom: 8px;
545:                 }
546:                 .dash-submenu-item {
547:                     display: block;
548:                     padding: 8px 12px 8px 44px;
549:                     color: var(--text-muted);
550:                     text-decoration: none;
551:                     font-size: 0.85rem;
552:                     border-radius: 6px;
553:                     transition: all 0.2s;
554:                     white-space: nowrap;
555:                     position: relative;
556:                 }
557: 
558:                 /* Submenu indentation line indicator */
559:                 .dash-submenu-item::before {
560:                     content: '';
561:                     position: absolute;
562:                     left: 20px;
563:                     top: 0;
564:                     bottom: 0;
565:                     width: 1px;
566:                     background: var(--glass-border);
567:                 }
568:                 /* Dot on the line */
569:                 .dash-submenu-item::after {
570:                     content: '';
571:                     position: absolute;
572:                     left: 18.5px;
573:                     top: 50%;
574:                     transform: translateY(-50%);
575:                     width: 4px;
576:                     height: 4px;
577:                     border-radius: 50%;
578:                     background: var(--text-muted);
579:                     transition: all 0.2s;
580:                 }
581: 
582:                 .dash-submenu-item:hover {
583:                     color: var(--text-main);
584:                     background: var(--glass-hover);
585:                 }
586:                 .dash-submenu-item:hover::after {
587:                     background: var(--text-main);
588:                     transform: translateY(-50%) scale(1.5);
589:                 }
590: 
591:                 .dash-submenu-item.active {
592:                     color: var(--primary);
593:                     font-weight: 600;
594:                     background: var(--primary-glow);
595:                 }
596:                 .dash-submenu-item.active::before {
597:                     background: var(--primary);
598:                 }
599:                 .dash-submenu-item.active::after {
600:                     background: var(--primary);
601:                     transform: translateY(-50%) scale(1.5);
602:                 }
603: 
604:                 .dash-sidebar-footer {
605:                     padding: 15px;
606:                     border-top: 1px solid var(--glass-border);
607:                     background: var(--glass-bg);
608:                 }
609:                 .dash-back-btn {
610:                     display: flex;
611:                     align-items: center;
612:                     gap: 8px;
613:                     color: var(--text-muted);
614:                     text-decoration: none;
615:                     font-size: 0.85rem;
616:                     font-weight: 500;
617:                     padding: 10px;
618:                     border-radius: 6px;
619:                     transition: all 0.2s;
620:                     justify-content: center;
621:                     border: 1px solid var(--glass-border);
622:                     background: var(--bg-dark);
623:                 }
624:                 .dash-back-btn:hover { background: var(--glass-hover); color: var(--text-main); border-color: #d1d5db; }
625:                 .dash-sidebar.closed .dash-back-btn { padding: 10px 0; }
626: 
627:                 /* Main Content Area */
628:                 .dash-content {
629:                     flex: 1;
630:                     overflow: hidden;
631:                     position: relative;
632:                     z-index: 1;
633:                     min-width: 0;
634:                     min-height: 0;
635:                     display: flex;
636:                     flex-direction: column;
637:                 }
638: 
639:                 .dash-content-inner {
640:                     flex: 1;
641:                     padding: 24px;
642:                     overflow: hidden;
643:                     min-height: 0;
644:                     display: flex;
645:                     flex-direction: column;
646:                     position: relative;
647:                 }
648: 
649:                 .dash-welcome {
650:                     padding: 30px;
651:                     border-radius: 8px;
652:                     margin-bottom: 24px;
653:                     border-left: 4px solid var(--primary);
654:                     background: var(--glass-bg);
655:                 }
656:                 .dash-welcome h1 { margin-top: 0; font-size: 1.5rem; margin-bottom: 8px; color: var(--text-main); }
657:                 .dash-welcome p { color: var(--text-muted); margin: 0; font-size: 0.95rem; }
658: 
659:                 .dash-widgets {
660:                     display: grid;
661:                     grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
662:                     gap: 20px;
663:                 }
664: 
665:                 .dash-widget {
666:                     padding: 24px;
667:                     border-radius: 8px;
668:                     transition: box-shadow 0.2s;
669:                 }
670:                 .dash-widget:hover { box-shadow: var(--shadow-md); }
671:                 .widget-icon { margin-bottom: 16px; }
672:                 .widget-icon.primary { color: var(--primary); }
673:                 .widget-icon.success { color: #10b981; }
674:                 .dash-widget h3 { margin: 0 0 8px 0; font-size: 1.1rem; color: var(--text-main); }
675:                 .dash-widget p { margin: 0; color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; }
676: 
677:                 /* Mobile Sidebar Overlay */
678:                 .dash-sidebar-overlay {
679:                     display: none;
680:                     position: fixed;
681:                     top: 0;
682:                     left: 0;
683:                     right: 0;
684:                     bottom: 0;
685:                     background: rgba(0, 0, 0, 0.5);
686:                     z-index: 5;
687:                     opacity: 0;
688:                     transition: opacity 0.3s;
689:                 }
690: 
691:                 /* ODOO STYLES */
                .odoo-control-panel {
                    padding: 10px 24px;
                    border-bottom: 1px solid var(--glass-border);
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    background: var(--glass-bg);
                    min-height: 50px;
                }
                .odoo-breadcrumbs {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    font-size: 1.1rem;
                    color: var(--text-muted);
                }
                .odoo-breadcrumbs span.active {
                    color: var(--text-main);
                    font-weight: 600;
                }
                .crumb-separator {
                    color: var(--text-muted);
                    opacity: 0.5;
                }
                .odoo-smart-buttons {
                    display: flex;
                    gap: 8px;
                }
                .odoo-smart-btn {
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    padding: 6px 12px;
                    border-radius: 6px;
                    color: var(--text-main);
                    font-size: 0.85rem;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    transition: all 0.2s;
                }
                .odoo-smart-btn:hover {
                    background: var(--glass-hover);
                }

                .odoo-view-container {
                    display: flex;
                    flex: 1;
                    height: calc(100vh - 120px);
                    background: transparent;
                }

                .odoo-document-wrapper {
                    flex: 1;
                    overflow-y: auto;
                    padding: 24px;
                    display: flex;
                    justify-content: center;
                }

                .odoo-document-sheet {
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                    border-radius: 4px;
                    width: 100%;
                    max-width: 900px;
                    min-height: 800px;
                    position: relative;
                }

                .odoo-pipeline {
                    display: flex;
                    background: rgba(0,0,0,0.1);
                    border-bottom: 1px solid var(--glass-border);
                    padding: 10px 20px;
                    justify-content: flex-end;
                }

                .odoo-pipeline-status {
                    padding: 6px 16px;
                    background: var(--glass-border);
                    color: var(--text-muted);
                    font-size: 0.85rem;
                    font-weight: 600;
                    margin-left: -5px;
                    clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%, 5% 50%);
                }
                .odoo-pipeline-status.active {
                    background: var(--primary);
                    color: #fff;
                }

                .odoo-chatter {
                    width: 350px;
                    border-left: 1px solid var(--glass-border);
                    background: rgba(0,0,0,0.02);
                    display: flex;
                    flex-direction: column;
                }
                .odoo-chatter-header {
                    padding: 15px;
                    border-bottom: 1px solid var(--glass-border);
                    font-weight: 600;
                    color: var(--text-main);
                }
                .odoo-chatter-body {
                    padding: 15px;
                    flex: 1;
                    overflow-y: auto;
                    font-size: 0.85rem;
                    color: var(--text-muted);
                }
                .odoo-log-item {
                    display: flex;
                    gap: 10px;
                    margin-bottom: 15px;
                }
                .odoo-log-avatar {
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    background: var(--primary);
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                }
                .odoo-log-content {
                    flex: 1;
                }

                /* Responsive */
692:                 @media (max-width: 768px) {
693:                     .dash-sidebar { position: absolute; height: 100%; z-index: 10; background: var(--glass-bg); }
694:                     .dash-sidebar.closed { transform: translateX(-100%); width: var(--sidebar-width); }
695:                     .dash-sidebar-overlay.show { display: block; opacity: 1; }
696:                     .dash-content-inner { padding: 12px; }
697:                     .dash-nav-right .dash-clock, .dash-nav-right .dash-user-info { display: none; }
698:                     .dash-brand h2 { font-size: 1rem; }
699:                     .dash-tag { font-size: 0.65rem; }
700:                 }
701:             `}</style>
702:         </div>
703:     );
704: }
705: 
The above content shows the entire, complete file contents of the requested file.
