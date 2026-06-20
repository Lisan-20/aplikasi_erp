const fs = require('fs');
const path = require('path');

const dir = path.join(process.cwd(), 'resources', 'js', 'Pages', 'Registrasi');

const stylesToRemove = [
    ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white' }}`,
    ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', colorScheme: 'dark' }}`,
    ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', backgroundColor: '#1e293b' }}`,
    ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', minHeight: '80px', resize: 'vertical' }}`,
    ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', cursor: 'not-allowed', opacity: 0.7 }}`,
    ` style={{ width: '100%', padding: '10px 15px', borderRadius: '8px', background: 'rgba(255,255,255,0.05)', border: '1px solid var(--border-color)', color: 'white', minHeight: '60px', resize: 'vertical' }}`,
    ` style={{ display: 'block', marginBottom: '8px', color: 'var(--text-secondary)' }}`,
    ` style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px' }}`,
    ` style={{ display: 'grid', gap: '20px' }}`,
    ` style={{ fontSize: '1.5rem', fontWeight: 'bold' }}`,
    ` style={{ color: 'var(--text-muted)', fontSize: '0.9rem', marginTop: '5px' }}`,
];

function processFile(filePath) {
    if (filePath.endsWith('.jsx')) {
        let content = fs.readFileSync(filePath, 'utf8');
        let originalContent = content;
        
        for (const style of stylesToRemove) {
            content = content.split(style).join('');
        }

        // Add standard classes if they don't exist yet but we removed their inline styles
        // Wait, for labels, we removed the style. Let's add className="form-label" instead.
        // Regex to replace <label> that had the specific inline style.
        // Actually, let's do more targeted regex replacements.
        
        // 1. Labels
        content = content.replace(/<label style={{ display: 'block', marginBottom: '8px', color: 'var\(--text-secondary\)' }}>/g, '<label className="form-label">');
        
        // 2. Grids
        content = content.replace(/<div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px' }}>/g, '<div className="grid-2-cols">');
        content = content.replace(/<div style={{ display: 'grid', gap: '20px' }}>/g, '<div className="grid-form">');

        // 3. Remove inline styles from inputs that already have premium-input
        content = content.replace(/className="premium-input" style={{[^}]+}}/g, 'className="premium-input"');
        
        // 4. Update the save button
        content = content.replace(/<button type="submit" style={{ padding: '12px 20px', background: 'var\(--primary\)', color: 'white', border: 'none', borderRadius: '8px', cursor: 'pointer', fontWeight: '600', display: 'flex', alignItems: 'center', gap: '8px' }} disabled={processing}>/g, '<button type="submit" className="dash-btn primary" disabled={processing}>');
        
        if (content !== originalContent) {
            fs.writeFileSync(filePath, content, 'utf8');
            console.log('Cleaned:', filePath);
        }
    }
}

function walkDir(currentPath) {
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

walkDir(dir);
console.log('Cleanup script finished.');
