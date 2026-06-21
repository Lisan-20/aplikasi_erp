import React from 'react';
import { useForm, Head } from '@inertiajs/react';
import { LogIn, User, Lock, ArrowRight, ShieldCheck, Building2, MapPin, Phone, Printer } from 'lucide-react';

export default function Login({ config }) {
    const { data, setData, post, processing, errors } = useForm({
        txt_name: '',
        txt_pass: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/login');
    };

    const appConfig = {
        nama_aplikasi: config?.nama_aplikasi || 'Enterprise Resource Planning',
        nama_perusahaan: config?.nama_perusahaan || 'Perusahaan Anda',
        alamat: config?.alamat || '-',
        kota: config?.kota || '-',
        kode_pos: config?.kode_pos || '-',
        telpon: config?.telpon || '-',
        fax: config?.fax || '-',
        logo: config?.logo || '-',
        html_title: config?.html_title || 'Sistem ERP',
    };

    return (
        <div className="min-h-screen bg-slate-900 text-slate-100 flex flex-col items-center justify-center relative overflow-hidden font-sans p-4 sm:p-8">
            <Head title={`${appConfig.html_title} - Sign In`} />

            {/* Glowing Orbs for Premium Background */}
            <div className="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[120px] pointer-events-none animate-pulse" style={{ animationDuration: '8s' }}></div>
            <div className="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-emerald-600/20 rounded-full blur-[120px] pointer-events-none animate-pulse" style={{ animationDuration: '12s' }}></div>

            {/* Main Glass Card */}
            <div className="relative z-10 w-full max-w-5xl bg-slate-800/60 backdrop-blur-2xl border border-slate-700/50 rounded-[2rem] shadow-2xl flex flex-col md:flex-row overflow-hidden animate-[fadeInUp_0.8s_ease-out_forwards]">
                
                {/* Left Pane: Login Form */}
                <div className="w-full md:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
                    <div className="mb-10 text-center md:text-left">
                        <div className="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-500/10 text-blue-400 mb-6 border border-blue-500/20 shadow-inner">
                            <ShieldCheck size={32} />
                        </div>
                        <h1 className="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-2">Selamat Datang</h1>
                        <p className="text-slate-400 text-sm">Masuk ke akun Anda untuk mengakses pusat komando sistem</p>
                    </div>

                    <form onSubmit={handleSubmit} className="flex flex-col gap-6">
                        {/* General Errors */}
                        {errors.message && (
                            <div className="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl flex items-center gap-3 text-sm animate-pulse">
                                <ShieldCheck size={20} className="text-red-500 flex-shrink-0" />
                                <span>{errors.message}</span>
                            </div>
                        )}

                        {/* Username Field */}
                        <div className="flex flex-col gap-2">
                            <label htmlFor="txt_name" className="text-sm font-medium text-slate-300">User ID</label>
                            <div className="relative group">
                                <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors">
                                    <User size={20} />
                                </div>
                                <input
                                    id="txt_name"
                                    type="text"
                                    name="txt_name"
                                    value={data.txt_name}
                                    className={`w-full pl-12 pr-4 py-3 bg-slate-900/50 border ${errors.txt_name ? 'border-red-500/50 focus:border-red-500 focus:ring-red-500/20' : 'border-slate-700 focus:border-blue-500 focus:ring-blue-500/20'} rounded-xl text-slate-100 placeholder-slate-500 outline-none focus:ring-4 transition-all`}
                                    placeholder="Masukkan User ID"
                                    onChange={e => setData('txt_name', e.target.value)}
                                    required
                                    autoComplete="username"
                                    autoFocus
                                />
                            </div>
                            {errors.txt_name && <span className="text-red-400 text-xs mt-1">{errors.txt_name}</span>}
                        </div>

                        {/* Password Field */}
                        <div className="flex flex-col gap-2">
                            <label htmlFor="txt_pass" className="text-sm font-medium text-slate-300">Password</label>
                            <div className="relative group">
                                <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors">
                                    <Lock size={20} />
                                </div>
                                <input
                                    id="txt_pass"
                                    type="password"
                                    name="txt_pass"
                                    value={data.txt_pass}
                                    className={`w-full pl-12 pr-4 py-3 bg-slate-900/50 border ${errors.txt_pass ? 'border-red-500/50 focus:border-red-500 focus:ring-red-500/20' : 'border-slate-700 focus:border-blue-500 focus:ring-blue-500/20'} rounded-xl text-slate-100 placeholder-slate-500 outline-none focus:ring-4 transition-all`}
                                    placeholder="••••••••"
                                    onChange={e => setData('txt_pass', e.target.value)}
                                    required
                                    autoComplete="current-password"
                                />
                            </div>
                            {errors.txt_pass && <span className="text-red-400 text-xs mt-1">{errors.txt_pass}</span>}
                        </div>

                        {/* Options */}
                        <div className="flex items-center justify-between mt-2">
                            <label className="flex items-center gap-2 cursor-pointer group">
                                <div className="relative flex items-center justify-center w-5 h-5 border border-slate-600 rounded bg-slate-900/50 group-hover:border-blue-400 transition-colors">
                                    <input type="checkbox" className="opacity-0 absolute inset-0 cursor-pointer peer" />
                                    <svg className="w-3 h-3 text-blue-400 opacity-0 peer-checked:opacity-100 transition-opacity" viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                                    </svg>
                                </div>
                                <span className="text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Ingat saya</span>
                            </label>
                            <a href="#" className="text-sm text-blue-400 hover:text-blue-300 hover:underline transition-colors">Lupa Password?</a>
                        </div>

                        {/* Submit Buttons */}
                        <div className="flex items-center gap-4 mt-4">
                            <button
                                type="button"
                                className="px-6 py-3 rounded-xl font-medium text-slate-300 bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-slate-600 transition-all focus:ring-4 focus:ring-slate-700/50 outline-none"
                                onClick={() => setData({ txt_name: '', txt_pass: '' })}
                            >
                                Reset
                            </button>
                            <button
                                type="submit"
                                disabled={processing}
                                className="flex-1 flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-semibold text-white bg-blue-600 hover:bg-blue-500 border border-blue-500/50 shadow-lg shadow-blue-500/20 transition-all focus:ring-4 focus:ring-blue-500/30 outline-none disabled:opacity-70 disabled:cursor-not-allowed group"
                            >
                                {processing ? (
                                    <>
                                        <svg className="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Memproses...</span>
                                    </>
                                ) : (
                                    <>
                                        <span>Masuk Sekarang</span>
                                        <ArrowRight size={20} className="group-hover:translate-x-1 transition-transform" />
                                    </>
                                )}
                            </button>
                        </div>
                    </form>

                    {/* Footer */}
                    <div className="mt-12 text-center md:text-left text-xs text-slate-500">
                        <p>&copy; {new Date().getFullYear()} {appConfig.nama_perusahaan}. All rights reserved.</p>
                    </div>
                </div>

                {/* Right Pane: Brand Showcase */}
                <div className="w-full md:w-1/2 relative flex flex-col justify-center p-8 sm:p-12 lg:p-16 border-t md:border-t-0 md:border-l border-slate-700/50 bg-gradient-to-br from-slate-800/80 to-slate-900/80 overflow-hidden">
                    {/* Abstract Decoration */}
                    <div className="absolute top-0 right-0 w-full h-full bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-500/10 via-transparent to-transparent pointer-events-none"></div>
                    <div className="absolute bottom-0 left-0 w-full h-full bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-emerald-500/10 via-transparent to-transparent pointer-events-none"></div>

                    <div className="relative z-10 flex flex-col items-center md:items-start text-center md:text-left">
                        <span className="px-3 py-1 text-xs font-semibold tracking-wider text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 rounded-full mb-6 uppercase">
                            Sistem Utama
                        </span>
                        
                        <h2 className="text-3xl lg:text-4xl font-extrabold text-white mb-2 tracking-tight">
                            {appConfig.nama_aplikasi}
                        </h2>
                        <h3 className="text-xl text-blue-300 font-medium mb-12">
                            {appConfig.nama_perusahaan}
                        </h3>

                        <div className="flex flex-col gap-6 w-full max-w-sm">
                            <div className="flex items-start gap-4">
                                <div className="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 text-slate-400 flex-shrink-0">
                                    <MapPin size={20} />
                                </div>
                                <div className="flex flex-col pt-0.5">
                                    <span className="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Kantor Pusat</span>
                                    <span className="text-sm text-slate-300">{appConfig.alamat}</span>
                                    <span className="text-sm text-slate-300">{appConfig.kota}{appConfig.kode_pos ? ` - ${appConfig.kode_pos}` : ''}</span>
                                </div>
                            </div>

                            <div className="flex items-start gap-4">
                                <div className="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 text-slate-400 flex-shrink-0">
                                    <Phone size={20} />
                                </div>
                                <div className="flex flex-col pt-0.5">
                                    <span className="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Telepon</span>
                                    <span className="text-sm text-slate-300">{appConfig.telpon}</span>
                                </div>
                            </div>

                            {appConfig.fax && appConfig.fax !== '-' && (
                                <div className="flex items-start gap-4">
                                    <div className="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-800 border border-slate-700 text-slate-400 flex-shrink-0">
                                        <Printer size={20} />
                                    </div>
                                    <div className="flex flex-col pt-0.5">
                                        <span className="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Fax</span>
                                        <span className="text-sm text-slate-300">{appConfig.fax}</span>
                                    </div>
                                </div>
                            )}
                        </div>

                        <div className="mt-16 pt-8 border-t border-slate-700/50 w-full text-center md:text-left">
                            <p className="text-xs text-slate-500 tracking-widest uppercase font-semibold">
                                Enterprise Resource Planning System
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <style>{`
                @keyframes fadeInUp {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            `}</style>
        </div>
    );
}
