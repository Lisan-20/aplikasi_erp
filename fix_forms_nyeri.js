const fs = require('fs');
const path = require('path');

const forms = ['AsesmenAwalForm.jsx', 'AsesmenLanjutanForm.jsx'];
const basePath = 'resources/js/Pages/Poli/Asesmen/';

for (const form of forms) {
    const fullPath = path.join(basePath, form);
    if (!fs.existsSync(fullPath)) continue;
    
    let content = fs.readFileSync(fullPath, 'utf8');

    // Add skalaNyeri and radiogroup_val to props
    if (form === 'AsesmenAwalForm.jsx') {
        content = content.replace(
            /export default function AsesmenAwalForm\(\{\s*pasien,\s*psikososial,\s*fisik,\s*mode\s*\}\)\s*\{/,
            'export default function AsesmenAwalForm({ pasien, psikososial, fisik, skalaNyeri = [], radiogroup_val, mode }) {'
        );
        content = content.replace(
            /\[\.\.\.psikososial, \.\.\.fisik\]\.forEach/,
            '[...psikososial, ...fisik, ...skalaNyeri].forEach'
        );
    } else if (form === 'AsesmenLanjutanForm.jsx') {
        content = content.replace(
            /export default function AsesmenLanjutanForm\(\{\s*pasien,\s*lanjut1,\s*asuhan,\s*discharge,\s*mode\s*\}\)\s*\{/,
            'export default function AsesmenLanjutanForm({ pasien, lanjut1, asuhan, discharge, skalaNyeri = [], radiogroup_val, mode }) {'
        );
        content = content.replace(
            /\[\.\.\.lanjut1, \.\.\.asuhan, \.\.\.discharge\]\.forEach/,
            '[...lanjut1, ...asuhan, ...discharge, ...skalaNyeri].forEach'
        );
    }

    // Set initial radiogroup
    content = content.replace(
        /const \[radiogroup, setRadiogroup\] = useState\('1'\);/,
        'const [radiogroup, setRadiogroup] = useState(radiogroup_val || \'1\');\n\n    const filteredSkalaNyeri = skalaNyeri.filter(q => {\n        if (radiogroup === \'1\') return q.kd_periksa >= 95600 && q.kd_periksa <= 95699;\n        if (radiogroup === \'2\') return q.kd_periksa >= 95700 && q.kd_periksa <= 95799;\n        if (radiogroup === \'3\') return q.kd_periksa >= 95800 && q.kd_periksa <= 95899;\n        if (radiogroup === \'4\') return q.kd_periksa >= 95900 && q.kd_periksa <= 95999;\n        if (radiogroup === \'5\') return q.kd_periksa >= 96000 && q.kd_periksa <= 96099;\n        return false;\n    });'
    );
    
    // Convert Answers into Array (include skalaNyeri)
    // Wait, answersArray in submit is just Object.values(answers), it will automatically include any modified states, but when inserting we insert all.
    // However, we only want to submit the answers for the selected radiogroup!
    // But since AsesmenPerawatController deletes and inserts, it's fine. Wait, AsesmenPerawatController delete for Skala Nyeri:
    // It doesn't delete Skala Nyeri in storeAwal. Wait, it only does updateOrInsert! If they change radiogroup, the old answers remain in DB!
    // Actually, in AsesmenPerawatController storeAwal, it deletes 'tc_emr_form' but doesn't delete old 'tc_pemeriksaan_erm' for 95600-96099.
    // It's safer to only submit answers that belong to the active radiogroup + physical + psychosocial.
    // I'll update handleSubmit to filter.
    const submitFilterStr = `
        const answersArray = Object.values(answers).filter(ans => {
            if (ans.kd_periksa >= 95600 && ans.kd_periksa <= 96099) {
                if (radiogroup === '1' && (ans.kd_periksa < 95600 || ans.kd_periksa > 95699)) return false;
                if (radiogroup === '2' && (ans.kd_periksa < 95700 || ans.kd_periksa > 95799)) return false;
                if (radiogroup === '3' && (ans.kd_periksa < 95800 || ans.kd_periksa > 95899)) return false;
                if (radiogroup === '4' && (ans.kd_periksa < 95900 || ans.kd_periksa > 95999)) return false;
                if (radiogroup === '5' && (ans.kd_periksa < 96000 || ans.kd_periksa > 96099)) return false;
            }
            return true;
        });
`;
    content = content.replace(
        /const answersArray = Object.values\(answers\);/,
        submitFilterStr
    );

    // Render the Skala Nyeri Table below the radiogroup labels.
    const renderTableStr = `
                        </div>
                        
                        {filteredSkalaNyeri.length > 0 && (
                            <div className="table-responsive mt-4">
                                <table className="table pl-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style={{width: '50px', textAlign: 'center'}}>#</th>
                                            <th style={{width: '40%'}}>Parameter Nyeri</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {renderQuestionRows(filteredSkalaNyeri, 0)}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </div>`;

    // Replace the end of the radiogroup div
    content = content.replace(
        /<\/div>\s*<\/div>\s*\{\/\* Pengkajian Fisik/g,
        renderTableStr + '\n\n                    {/* Pengkajian Fisik'
    );
    // for Lanjutan:
    content = content.replace(
        /<\/div>\s*<\/div>\s*\{\/\* Asuhan Keperawatan/g,
        renderTableStr + '\n\n                    {/* Asuhan Keperawatan'
    );


    fs.writeFileSync(fullPath, content);
}

// Ensure the controller also deletes old skala nyeri tc_pemeriksaan_erm so we don't pile up garbage if they switch groups
let controllerContent = fs.readFileSync('app/Http/Controllers/AsesmenPerawatController.php', 'utf8');

// storeAwal
controllerContent = controllerContent.replace(
    /DB::table\('tc_emr_form'\)->where\('no_kunjungan', \$no_kunjungan\)->whereIn\('kode_rm', \[64, 66, 53, 54, 52\]\)->delete\(\);/,
    "DB::table('tc_emr_form')->where('no_kunjungan', $no_kunjungan)->whereIn('kode_rm', [64, 66, 53, 54, 52])->delete();\n            DB::table('tc_pemeriksaan_erm')->where('no_kunjungan', $no_kunjungan)->whereBetween('kode_pemeriksaan', [95600, 96099])->delete();"
);

fs.writeFileSync('app/Http/Controllers/AsesmenPerawatController.php', controllerContent);

console.log("Nyeri updated");
