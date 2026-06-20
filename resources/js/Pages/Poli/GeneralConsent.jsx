import React from 'react';
import { Head } from '@inertiajs/react';

const GeneralConsent = ({ type, pasien, current_date }) => {

    const handlePrint = () => {
        window.print();
    };

    const calculateAge = (dob) => {
        if (!dob) return '';
        const diffMs = Date.now() - new Date(dob).getTime();
        const ageDt = new Date(diffMs);
        return Math.abs(ageDt.getUTCFullYear() - 1970);
    };

    const renderHubungan = (hub_kel) => {
        switch (hub_kel?.toString()) {
            case '1': return 'Diri Sendiri';
            case '2': return 'Suami';
            case '3': return 'Istri';
            case '4': return 'Anak';
            case '5': return 'Orang Tua';
            case '6': return 'Keluarga';
            default: return 'Keluarga';
        }
    };

    const formatDate = (dateString) => {
        if (!dateString) return '';
        const d = new Date(dateString);
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
    };

    const formatDateTime = (dateString) => {
        if (!dateString) return '';
        const d = new Date(dateString);
        return {
            date: d.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }),
            time: d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
        };
    };

    const currentDT = formatDateTime(current_date);
    
    // Determine the active checkbox based on type parameter
    const isIcu = type === 'icu';
    const isUmum = type === 'umum' || type === 'general';
    const isRj = type === 'rj';

    return (
        <div className="min-h-screen bg-gray-100 py-8 print:py-0 print:bg-white text-gray-800">
            <Head title={`General Consent - ${pasien.nama_pasien}`} />
            
            <div className="max-w-4xl mx-auto mb-4 print:hidden flex justify-end">
                <button 
                    onClick={handlePrint}
                    className="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm transition-colors"
                >
                    <span className="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Print Document
                    </span>
                </button>
            </div>

            <div className="max-w-4xl mx-auto bg-white p-10 md:p-14 shadow-lg print:shadow-none print:p-0 print:max-w-none print:w-full font-serif text-[11pt] leading-[1.6]">
                <div className="text-center mb-8 border-b pb-4">
                    <h1 className="text-2xl font-bold uppercase tracking-wide">Persetujuan Umum / General Consent</h1>
                </div>

                <div className="mb-6">
                    <h2 className="font-bold mb-3 border-l-4 border-gray-800 pl-2 uppercase tracking-wide bg-gray-50 py-1">Identitas Pasien</h2>
                    <table className="w-full">
                        <tbody>
                            <tr>
                                <td className="w-48 py-1 font-medium">Nama Pasien</td>
                                <td className="w-4 py-1">:</td>
                                <td className="py-1">{pasien.nama_pasien || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 font-medium">Nomor Rekam Medis</td>
                                <td className="py-1">:</td>
                                <td className="py-1 font-bold tracking-wider">{pasien.no_mr || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 font-medium">Tanggal Lahir</td>
                                <td className="py-1">:</td>
                                <td className="py-1">{formatDate(pasien.tgl_lhr)}</td>
                            </tr>
                            <tr>
                                <td className="py-1 font-medium">Alamat</td>
                                <td className="py-1">:</td>
                                <td className="py-1">{pasien.almt_ttp_pasien || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 font-medium">No. Telp</td>
                                <td className="py-1">:</td>
                                <td className="py-1">{pasien.tlp_almt_ttp || '-'}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div className="mb-6">
                    <p className="font-bold uppercase mb-4 text-sm text-justify bg-gray-100 p-2 border border-gray-300">
                        PASIEN DAN/ATAU WALI HUKUM HARUS MEMBACA, MEMAHAMI DAN MENGISI INFORMASI BERIKUT :
                    </p>
                    
                    <p className="mb-3 font-medium">Yang bertanda tangan di bawah ini :</p>
                    <table className="w-full mb-6 bg-gray-50 p-4 border border-gray-200">
                        <tbody>
                            <tr>
                                <td className="w-48 py-1 pl-4 font-medium">Nama</td>
                                <td className="w-4 py-1">:</td>
                                <td className="py-1 pr-4">{pasien.nama_kel_ter || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 pl-4 font-medium">Alamat</td>
                                <td className="py-1">:</td>
                                <td className="py-1 pr-4">{pasien.nama_almt_kel || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 pl-4 font-medium">No. Telp</td>
                                <td className="py-1">:</td>
                                <td className="py-1 pr-4">{pasien.tlp_kel || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 pl-4 pb-2 font-medium">Hubungan dengan Pasien</td>
                                <td className="py-1 pb-2">:</td>
                                <td className="py-1 pb-2 font-semibold text-blue-800">{renderHubungan(pasien.hubungan_kel)}</td>
                            </tr>
                        </tbody>
                    </table>

                    <p className="mb-4 text-justify">
                        Bahwa penyakit yang diderita pasien, dengan ini menyatakan sesungguhnya telah memberikan <span className="font-bold underline">PERSETUJUAN</span> untuk dilakukan perawatan di Ruang Rawat:
                    </p>

                    <div className="mb-6 pl-4 space-y-2 border-l-2 border-gray-300 ml-2">
                        <div className="flex items-center">
                            <div className="w-5 h-5 border-2 border-black mr-3 flex-shrink-0 flex items-center justify-center font-bold text-lg">
                                {isIcu ? '✓' : ''}
                            </div>
                            <div>
                                <span className="font-semibold">Khusus :</span> Intensive Care Unit (ICU), High Care Unit (HCU), Perinatologi, Isolasi*
                            </div>
                        </div>
                        <div className="flex items-center">
                            <div className="w-5 h-5 border-2 border-black mr-3 flex-shrink-0 flex items-center justify-center font-bold text-lg">
                                {isUmum ? '✓' : ''}
                            </div>
                            <div>
                                <span className="font-semibold">Umum :</span> Kelas 3 / Kelas 2 / Kelas 1 / Kelas VIP
                            </div>
                        </div>
                        <div className="flex items-center">
                            <div className="w-5 h-5 border-2 border-black mr-3 flex-shrink-0 flex items-center justify-center font-bold text-lg">
                                {isRj ? '✓' : ''}
                            </div>
                            <div>
                                <span className="font-semibold">Bedah / Rawat Jalan :</span> Perawat/One Day Care (Non Perawatan)*
                            </div>
                        </div>
                    </div>

                    <p className="mb-2 font-medium">Terhadap :</p>
                    <table className="w-full mb-6">
                        <tbody>
                            <tr>
                                <td className="w-48 py-1 font-medium">Nama</td>
                                <td className="w-4 py-1">:</td>
                                <td className="py-1">{pasien.nama_pasien || '-'} ({pasien.jen_kelamin || '-'})* Umur : {calculateAge(pasien.tgl_lhr)} Tahun</td>
                            </tr>
                            <tr>
                                <td className="py-1 font-medium">No. RM</td>
                                <td className="py-1">:</td>
                                <td className="py-1 font-bold">{pasien.no_mr || '-'}</td>
                            </tr>
                            <tr>
                                <td className="py-1 font-medium">Alamat</td>
                                <td className="py-1">:</td>
                                <td className="py-1">{pasien.almt_ttp_pasien || '-'} <span className="ml-4 font-medium">Telepon :</span> {pasien.tlp_almt_ttp || '-'}</td>
                            </tr>
                        </tbody>
                    </table>

                    <p className="mb-4 text-justify">
                        Selaku pasien/wali hukum pasien <span className="font-bold border-b border-black">{pasien.nama_kel_ter || '-'}</span> dengan ini menyatakan persetujuan :
                    </p>

                    <ol className="list-decimal pl-6 space-y-4 text-justify">
                        <li>
                            <span className="font-bold tracking-wide">Persetujuan untuk perawatan dan pengobatan</span>
                            <ol className="list-[lower-alpha] pl-5 mt-2 space-y-1">
                                <li>Saya menyetujui untuk perawatan di Sistem ERP sebagai pasien <span className="font-semibold">{isRj ? 'Rawat Jalan' : 'Rawat Inap'}</span>* tergantung kepada kebutuhan medis.</li>
                                <li>Pengobatan dapat meliputi pemeriksaan x-ray/radiologi, tes darah, perawatan rutin dan prosedur seperti cairan infus atau suntikan dan evaluasi (contohnya wawancara dan pemeriksaan fisik).</li>
                                <li>Persetujuan yang saya berikan tidak termasuk persetujuan untuk prosedur/tindakan invasive (misal, operasi) atau tindakan yang mempunyai resiko tinggi.</li>
                                <li>Jika saya memutuskan untuk menghentikan perawatan medis untuk diri saya sendiri, Saya memahami dan menyadari bahwa Sistem ERP atau dokter tidak bertanggung jawab atas hasil yang merugikan saya.</li>
                            </ol>
                        </li>
                        <li>
                            <span className="font-bold tracking-wide">Persetujuan pelepasan informasi</span>
                            <ol className="list-[lower-alpha] pl-5 mt-2 space-y-1">
                                <li>Saya memahami informasi yang ada di dalam diri saya, termasuk diagnosis, hasil laboratorium dan hasil tes diagnostik yang akan digunakan untuk perawatan medis, Sistem ERP akan menjamin kerahasiannya.</li>
                                <li>Saya memberi wewenang kepada Sistem ERP untuk memberi informasi tentang diagnosis, hasil pelayanan dan pengobatan bila diperlukan untuk memproses klaim asuransi/perusahaan dan atau lembaga pemerintah.</li>
                                <li>Saya memberi wewenang kepada Sistem ERP untuk memberikan informasi tentang diagnosis, hasil pelayanan dan pengobatan saya kepada anggota keluarga saya.</li>
                            </ol>
                        </li>
                        <li>
                            <span className="font-bold tracking-wide">Hak dan kewajiban pasien</span>
                            <ol className="list-[lower-alpha] pl-5 mt-2 space-y-1">
                                <li>Saya memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam hal perawatan medis dan rencana pengobatan.</li>
                                <li>Saya telah mendapat informasi tentang “hak dan kewajiban pasien” di Sistem ERP melalui leaflet dan banner yang diedukasi oleh petugas.</li>
                                <li>Saya memahami bahwa Sistem ERP tidak bertanggung jawab atas kehilangan barang-barang pribadi dan barang berharga yang dibawa ke Sistem ERP.</li>
                            </ol>
                        </li>
                        <li>
                            <span className="font-bold tracking-wide">Tata tertib rawat inap</span>
                            <ol className="list-[lower-alpha] pl-5 mt-2 space-y-1">
                                <li>Saya tidak diperkenankan untuk membawa barang-barang berharga ke ruang rawat inap.</li>
                                <li>Saya telah memahami bahwa Sistem ERP tidak bertanggung jawab atas semua kehilangan barang-barang milik saya.</li>
                                <li>Saya telah menerima informasi tentang peraturan yang berlaku di Sistem ERP dan saya beserta keluarga bersedia untuk mematuhinya.</li>
                                <li>Anggota keluarga yang menunggu saya, bersedia untuk selalu memakai tanda pengenal khusus.</li>
                            </ol>
                        </li>
                        <li>
                            <span className="font-bold tracking-wide">Privasi</span>
                            <p className="mt-2 text-justify">
                                "Saya <span className="underline font-semibold">mengijinkan</span>/tidak mengijinkan" (coret salah satu) Sistem ERP memberi akses bagi keluarga dan kerabat serta orang-orang yang akan menengok saya.
                            </p>
                        </li>
                        <li>
                            <span className="font-bold tracking-wide">Informasi biaya</span>
                            <p className="mt-2 text-justify">
                                Saya memahami tentang informasi tarif ruangan, biaya pengobatan atau biaya tindakan yang dijelaskan oleh petugas Sistem ERP. Dengan ini saya bertanggung jawab atas pembayaran biaya tersebut.
                            </p>
                        </li>
                    </ol>

                    <div className="mt-10 pt-4 border-t-2 border-gray-300">
                        <p className="font-bold text-center mb-6 tracking-widest uppercase">Tanda Tangan</p>
                        <p className="text-justify mb-6 italic">
                            Dengan tanda tangan saya di bawah ini, saya menyatakan bahwa saya telah membaca dan memahami item pada persetujuan Umum/General Consent.
                        </p>

                        <div className="flex justify-end mb-8">
                            <div className="text-center font-medium">
                                <p>Karawang, {currentDT.date}</p>
                                <p>Pkl : {currentDT.time} WIB</p>
                            </div>
                        </div>

                        <div className="flex justify-between items-end mt-12 px-4">
                            <div className="text-center w-1/3">
                                <p className="mb-24 font-semibold">Saksi ERP</p>
                                <p>(.............................................)</p>
                            </div>
                            <div className="text-center w-1/3">
                                <p className="mb-24 font-semibold">Saksi Pasien</p>
                                <p>(.............................................)</p>
                            </div>
                            <div className="text-center w-1/3">
                                <p className="mb-24 font-semibold">Yang menyatakan</p>
                                <p className="font-bold uppercase border-b-2 border-black inline-block px-4 pb-1">
                                    {pasien.nama_kel_ter || pasien.nama_pasien}
                                </p>
                                <p className="text-xs mt-2 text-gray-600">(Tanda tangan wali jika pasien {'<'} 18 tahun)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style dangerouslySetInnerHTML={{__html: `
                @media print {
                    @page { size: A4; margin: 15mm; }
                    body { background: white; -webkit-print-color-adjust: exact; }
                }
            `}} />
        </div>
    );
};

export default GeneralConsent;
