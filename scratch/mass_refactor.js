const fs = require('fs');
const path = require('path');

const baseDir = path.join(process.cwd(), 'resources', 'js', 'Pages');
const targetDirs = [
    'Kasir', 
    'Gudang', 
    'Pengadaan', 
    'Master', 
    'Admin', 
    'Auth', 
    'Laporan', 
    'Manajemen', 
    'InformasiMedis3'
];

function processFile(filePath) {
    if (filePath.endsWith('.jsx')) {
        let content = fs.readFileSync(filePath, 'utf8');
        let originalContent = content;

        // 1. Table Replacements
        content = content.replace(/className="pl-table[^"]*"/g, 'className="dash-table"');
        content = content.replace(/className="table-auto[^"]*"/g, 'className="dash-table"');
        content = content.replace(/className="table[^"]*"/g, 'className="dash-table"');
        content = content.replace(/<thead[^>]*>/g, '<thead>');
        content = content.replace(/<th className="[^"]*" style={{ borderColor: 'var\(--glass-border\)' }}>/g, '<th>');
        content = content.replace(/<td className="[^"]*" style={{ borderColor: 'var\(--glass-border\)' }}>/g, '<td>');
        
        // 2. Button Replacements
        content = content.replace(/className="btn btn-primary"/g, 'className="dash-btn primary"');
        content = content.replace(/className="btn btn-secondary"/g, 'className="dash-btn secondary"');
        content = content.replace(/className="btn btn-danger"/g, 'className="dash-btn danger"');
        content = content.replace(/className="btn btn-success[^"]*"/g, 'className="dash-btn primary"');
        content = content.replace(/className={`btn \${([^}]+)}`}/g, 'className={`dash-btn ${$1}`}');
        content = content.replace(/'btn-primary'/g, "'primary'");
        content = content.replace(/'btn-secondary'/g, "'secondary'");
        content = content.replace(/btn-action primary-action/g, 'dash-btn primary');
        content = content.replace(/btn-action danger-action/g, 'dash-btn danger');
        content = content.replace(/btn-action secondary-action/g, 'dash-btn secondary');
        content = content.replace(/className="btn-action"/g, 'className="dash-btn secondary"');
        content = content.replace(/className="btn-action primary"/g, 'className="dash-btn primary"');

        // 2.1 Form Control Replacements
        content = content.replace(/className="form-control[^"]*"/g, 'className="premium-input"');

        // 3. Grid Replacements
        content = content.replace(/<div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px' }}>/g, '<div className="grid-2-cols">');
        content = content.replace(/<div style={{ display: 'grid', gridTemplateColumns: 'repeat\(2, 1fr\)', gap: '1\.5rem' }}>/g, '<div className="grid-2-cols">');
        content = content.replace(/<div style={{ display: 'grid', gap: '20px' }}>/g, '<div className="grid-form">');
        content = content.replace(/<div style={{ display: 'grid', gap: '1\.5rem' }}>/g, '<div className="grid-form">');

        // 4. Form Labels
        content = content.replace(/<label style={{ display: 'block', marginBottom: '8px', color: 'var\(--text-secondary\)' }}>/g, '<label className="form-label">');
        content = content.replace(/<label>/g, '<label className="form-label">');

        // 5. Common inline style removals for inputs (clean up if previous script missed)
        const inlineInputStyles = [
            ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white' }}`,
            ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', colorScheme: 'dark' }}`,
            ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', backgroundColor: '#1e293b' }}`,
            ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', minHeight: '80px', resize: 'vertical' }}`
        ];
        for (const style of inlineInputStyles) {
            content = content.split(style).join('');
        }

        // Fix potential label replacements that were already form-label
        content = content.replace(/<label className="form-label" className="form-label">/g, '<label className="form-label">');

        if (content !== originalContent) {
            fs.writeFileSync(filePath, content, 'utf8');
            console.log('Refactored:', filePath);
        }
    }
}

function walkDir(currentPath) {
    if (!fs.existsSync(currentPath)) return;
    const files = fs.readdirSync(currentPath);
    for (const file of files) {
        const fullPath = path.join(currentPath, file);
        const stat = fs.statSync(fullPath);
        if (stat.isDirectory()) {
            walkDir(fullPath);
        } else {
            processFile(fullPath);
        }
    }
}

console.log('Starting mass refactor Phase 3...');
for (const d of targetDirs) {
    const fullPath = path.join(baseDir, d);
    walkDir(fullPath);
}
console.log('Mass refactor Phase 3 completed.');
