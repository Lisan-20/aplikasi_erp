import React from 'react';

export default function DataUmum({ patient }) {
    if (!patient) return (
        <div className="glass-card p-10 text-center animate-fadeIn">
            <h3 className="text-white/60">Data pasien belum dipilih.</h3>
        </div>
    );

    const hitungUmur = (tglLahir) => {
        if (!tglLahir) return '-';
        const today = new Date();
        const birthDate = new Date(tglLahir);
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return `${age} Tahun`;
    };

    return (
        <div className="glass-card p-6 md:p-8 animate-fadeIn border border-white/10 shadow-xl rounded-2xl">
            <h3 className="text-2xl font-bold text-white mb-6 border-b border-white/10 pb-4 flex items-center gap-3">
                <svg className="text-cyan-400 shrink-0" style={{ width: '24px', height: '24px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                Informasi Detail Pasien
            </h3>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                {/* Kolom Kiri */}
                <div className="space-y-4 bg-white/5 p-5 rounded-xl border border-white/5">
                    <DetailRow label="No. MR" value={patient.no_mr} />
                    <DetailRow label="NIK / KTP" value={patient.no_ktp} />
                    <DetailRow label="Nama Pasien" value={patient.nama_pasien} />
                    <DetailRow label="Nama Panggilan" value={patient.nama_panggilan} />
                    <DetailRow label="Tempat, Tgl Lahir" value={`${patient.tempat_lahir || '-'}, ${patient.tgl_lhr?.split(' ')[0] || '-'}`} />
                    <DetailRow label="Umur" value={hitungUmur(patient.tgl_lhr)} />
                    <DetailRow label="Jenis Kelamin" value={patient.jen_kelamin === 'L' ? 'Laki-laki' : patient.jen_kelamin === 'P' ? 'Perempuan' : patient.jen_kelamin} />
                    <DetailRow label="Gol. Darah" value={patient.gol_darah} />
                </div>

                {/* Kolom Kanan */}
                <div className="space-y-4 bg-white/5 p-5 rounded-xl border border-white/5">
                    <DetailRow label="Nama Ayah" value={patient.nama_ayah} />
                    <DetailRow label="Nama Ibu" value={patient.nama_ibu} />
                    <DetailRow label="Alamat Tetap" value={patient.almt_ttp_pasien} />
                    <DetailRow label="No. Telepon" value={patient.tlp_almt_ttp} />
                    <DetailRow label="Alamat Lokal" value={patient.alamat_lokal} />
                    {/* Menggunakan kode id untuk Suku/Agama karena butuh join tabel jika ingin nama aslinya */}
                    <DetailRow label="Kode Suku/Bangsa" value={patient.suku} />
                    <DetailRow label="Kode Agama" value={patient.kode_agama} />
                    <DetailRow label="Kode Pendidikan" value={patient.kode_pendidikan} />
                </div>
            </div>
            
            <div className="mt-8 flex justify-end space-x-3">
                <button type="button" className="btn btn-secondary flex items-center gap-2 hover:bg-white/10 transition-colors">
                    <svg className="shrink-0" style={{ width: '16px', height: '16px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Data Pasien
                </button>
                <button type="button" className="btn btn-primary flex items-center gap-2">
                    <svg className="shrink-0" style={{ width: '16px', height: '16px' }} fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Kartu
                </button>
            </div>
        </div>
    );
}

const DetailRow = ({ label, value }) => (
    <div className="flex flex-col sm:flex-row sm:justify-between border-b border-white/5 pb-2 last:border-0 last:pb-0">
        <span className="text-white/60 text-sm w-1/3">{label}</span>
        <span className="text-white font-medium text-sm w-2/3 sm:text-right">{value || '-'}</span>
    </div>
);
