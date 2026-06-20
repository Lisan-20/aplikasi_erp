const fs = require('fs');
const path = require('path');

const forms = [
    'AsesmenAwalForm.jsx',
    'AsesmenLanjutanForm.jsx',
    'AsesmenANCForm.jsx',
    'AsesmenPNCForm.jsx',
    'RiwayatHamilForm.jsx'
];

const basePath = 'resources/js/Pages/Poli/Asesmen/';

const renderFieldReplacement = `
    const renderField = (q) => {
        const value = answers[q.kd_periksa]?.answer || '';
        const value2 = answers[q.kd_periksa]?.answer2 || '';

        if (q.kd_type == '1') {
            return (
                <textarea className="form-control form-control-sm" rows="2" value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} />
            );
        }
        
        if (q.kd_type == '2') {
            return (
                <div className="d-flex gap-2 align-items-center flex-wrap">
                    {q.kd_kk == '1' ? (
                        <>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kanan</span>
                                <select className="form-control" value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} style={{maxWidth: '200px'}}>
                                    <option value="">-- Pilih --</option>
                                    {q.options?.map((opt, idx) => (
                                        <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                                    ))}
                                </select>
                            </div>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kiri</span>
                                <select className="form-control" value={value2} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer2', e.target.value)} style={{maxWidth: '200px'}}>
                                    <option value="">-- Pilih --</option>
                                    {q.options?.map((opt, idx) => (
                                        <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                                    ))}
                                </select>
                            </div>
                        </>
                    ) : (
                        <select className="form-control form-control-sm" value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} style={{maxWidth: '300px'}}>
                            <option value="">-- Pilih --</option>
                            {q.options?.map((opt, idx) => (
                                <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                            ))}
                        </select>
                    )}
                </div>
            );
        }

        if (q.kd_type == '3' || q.kd_type == '4') {
            return (
                <div className="d-flex gap-2 align-items-center flex-wrap">
                    {q.kd_kk == '1' ? (
                        <>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kanan</span>
                                <input type="text" className="form-control" style={{width: '150px'}} value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} />
                                {q.ket && <span className="input-group-text">{q.ket}</span>}
                            </div>
                            <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                                <span className="input-group-text">Kiri</span>
                                <input type="text" className="form-control" style={{width: '150px'}} value={value2} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer2', e.target.value)} />
                                {q.ket && <span className="input-group-text">{q.ket}</span>}
                            </div>
                        </>
                    ) : (
                        <div className="input-group input-group-sm" style={{width: 'max-content'}}>
                            <input type="text" className="form-control" style={{width: '250px'}} value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)} />
                            {q.ket && <span className="input-group-text">{q.ket}</span>}
                        </div>
                    )}
                </div>
            );
        }

        if (q.kd_type == '5') {
            return (
                <div className="input-group input-group-sm" style={{width: 'max-content', flexWrap: 'nowrap'}}>
                    <select className="form-control" style={{maxWidth: '200px'}} value={value} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer', e.target.value)}>
                        <option value="">-- Pilih --</option>
                        {q.options?.map((opt, idx) => (
                            <option key={idx} value={opt.value || opt.nama_pemeriksaan_det}>{opt.nama_pemeriksaan_det}</option>
                        ))}
                    </select>
                    <input type="text" className="form-control" style={{width: '150px'}} value={value2} onChange={(e) => handleAnswerChange(q.kd_periksa, 'answer2', e.target.value)} />
                    {q.ket && <span className="input-group-text">{q.ket}</span>}
                </div>
            );
        }

        return null;
    };`;

for (const form of forms) {
    const fullPath = path.join(basePath, form);
    if (!fs.existsSync(fullPath)) continue;
    let content = fs.readFileSync(fullPath, 'utf8');

    // Add overflowY to pl-container
    content = content.replace(/<div className="pl-container">/g, '<div className="pl-container" style={{ overflowY: \'auto\', paddingBottom: \'100px\' }}>');
    
    // Replace renderField
    // We will extract from `const renderField = (q) => {` to `return null;\n    };`
    const rfStart = content.indexOf('const renderField = (q) => {');
    const rfEnd = content.indexOf('return null;\n    };', rfStart) + 'return null;\n    };'.length;
    
    if (rfStart !== -1 && rfEnd !== -1) {
        content = content.substring(0, rfStart) + renderFieldReplacement.trim() + content.substring(rfEnd);
    }
    
    // In renderQuestionRows, fix td styles
    content = content.replace(/<td style={{width: '50px', textAlign: 'center', color: '#64748b'}}>/g, '<td style={{width: \'50px\', textAlign: \'center\', color: \'#64748b\', verticalAlign: \'middle\'}}>');
    
    content = content.replace(/width: '350px'/g, 'width: \'40%\', verticalAlign: \'middle\'');
    content = content.replace(/<td>\s*{\!isHeader && renderField\(q\)}\s*<\/td>/g, '<td style={{ verticalAlign: \'middle\' }}>\n                        {!isHeader && renderField(q)}\n                    </td>');

    fs.writeFileSync(fullPath, content);
}

// PemLuarForm is slightly different (no renderField), just add overflowY
const pemLuarPath = path.join(basePath, 'PemLuarForm.jsx');
if (fs.existsSync(pemLuarPath)) {
    let content = fs.readFileSync(pemLuarPath, 'utf8');
    content = content.replace(/<div className="pl-container">/g, '<div className="pl-container" style={{ overflowY: \'auto\', paddingBottom: \'100px\' }}>');
    fs.writeFileSync(pemLuarPath, content);
}

console.log("Forms updated");
