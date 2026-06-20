const fs = require('fs');
let content = fs.readFileSync('resources/js/Pages/Poli/AntrianPoli.jsx', 'utf8');

content = content.replace(/route\('poli\.asesmen\.anc\.print',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/anc/${item.no_kunjungan}/print`");
content = content.replace(/route\('poli\.asesmen\.anc\.create',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/anc/${item.no_kunjungan}`");
content = content.replace(/route\('poli\.asesmen\.awal\.print',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/awal/${item.no_kunjungan}/print`");
content = content.replace(/route\('poli\.asesmen\.awal\.create',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/awal/${item.no_kunjungan}`");
content = content.replace(/route\('poli\.asesmen\.pnc\.print',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/pnc/${item.no_kunjungan}/print`");
content = content.replace(/route\('poli\.asesmen\.pnc\.create',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/pnc/${item.no_kunjungan}`");
content = content.replace(/route\('poli\.asesmen\.lanjutan\.print',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/lanjutan/${item.no_kunjungan}/print`");
content = content.replace(/route\('poli\.asesmen\.lanjutan\.create',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/lanjutan/${item.no_kunjungan}`");
content = content.replace(/route\('poli\.asesmen\.riwayat-hamil\.print',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/riwayat-hamil/${item.no_kunjungan}/print`");
content = content.replace(/route\('poli\.asesmen\.riwayat-hamil\.create',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/riwayat-hamil/${item.no_kunjungan}`");
content = content.replace(/route\('poli\.asesmen\.pem-luar\.print',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/pem-luar/${item.no_kunjungan}/print`");
content = content.replace(/route\('poli\.asesmen\.pem-luar\.create',\s*item\.no_kunjungan\)/g, "`/poli/asesmen/pem-luar/${item.no_kunjungan}`");

fs.writeFileSync('resources/js/Pages/Poli/AntrianPoli.jsx', content);
console.log('Done');
