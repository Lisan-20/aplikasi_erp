import React from 'react';
import { useForm, Head } from '@inertiajs/react';

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
        nama_aplikasi: config?.nama_aplikasi || 'Sistem Informasi Manajemen Rumah Sakit',
        nama_perusahaan: config?.nama_perusahaan || '-',
        alamat: config?.alamat || '-',
        kota: config?.kota || '-',
        kode_pos: config?.kode_pos || '-',
        telpon: config?.telpon || '-',
        fax: config?.fax || '-',
        logo: config?.logo || '-',
        html_title: config?.html_title || 'SIMRS',
    };

    return (
        <div className="login-container">
            <Head title={`${appConfig.html_title} - Sign In`} />

            {/* Background Decorative Elements */}
            <div className="bg-glow bg-glow-blue"></div>
            <div className="bg-glow bg-glow-emerald"></div>
            <div className="grid-overlay"></div>

            <div className="login-card glass-card animate-fade-in split-layout">
                {/* Left Pane: Login Form */}
                <div className="login-form-pane">
                    <div className="login-header">
                        <div className="logo-container">
                            <svg className="logo-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div className="pulse-ring"></div>
                        </div>
                        <h1>Sign In</h1>
                        <p className="subtitle">Masuk ke akun Anda untuk mengakses dashboard layanan</p>
                    </div>

                    <form onSubmit={handleSubmit} className="login-form">
                        {/* General Errors */}
                        {errors.message && (
                            <div className="error-alert">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" className="alert-icon">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>{errors.message}</span>
                            </div>
                        )}

                        {/* Username Field */}
                        <div className="form-group">
                            <label htmlFor="txt_name">User ID</label>
                            <div className="input-wrapper">
                                <svg className="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <input
                                    id="txt_name"
                                    type="text"
                                    name="txt_name"
                                    value={data.txt_name}
                                    className={`premium-input ${errors.txt_name ? 'input-error' : ''}`}
                                    placeholder="User ID"
                                    onChange={e => setData('txt_name', e.target.value)}
                                    required
                                    autoComplete="username"
                                    autoFocus
                                />
                            </div>
                            {errors.txt_name && <span className="field-error">{errors.txt_name}</span>}
                        </div>

                        {/* Password Field */}
                        <div className="form-group">
                            <label htmlFor="txt_pass">Password</label>
                            <div className="input-wrapper">
                                <svg className="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <input
                                    id="txt_pass"
                                    type="password"
                                    name="txt_pass"
                                    value={data.txt_pass}
                                    className={`premium-input ${errors.txt_pass ? 'input-error' : ''}`}
                                    placeholder="••••••••"
                                    onChange={e => setData('txt_pass', e.target.value)}
                                    required
                                    autoComplete="current-password"
                                />
                            </div>
                            {errors.txt_pass && <span className="field-error">{errors.txt_pass}</span>}
                        </div>

                        {/* Options */}
                        <div className="form-options">
                            <label className="checkbox-container">
                                <input type="checkbox" />
                                <span className="checkmark"></span>
                                Ingat saya
                            </label>
                            <a href="#" className="forgot-link">Lupa Password?</a>
                        </div>

                        {/* Submit Buttons */}
                        <div className="form-buttons">
                            <button
                                type="button"
                                className="btn-secondary reset-btn"
                                onClick={() => setData({ txt_name: '', txt_pass: '' })}
                            >
                                Reset
                            </button>
                            <button
                                type="submit"
                                disabled={processing}
                                className="btn-primary login-btn"
                            >
                                {processing ? (
                                    <>
                                        <svg className="spinner-icon" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                                        </svg>
                                        <span>Memproses...</span>
                                    </>
                                ) : (
                                    <>
                                        <span>Submit</span>
                                        <svg className="btn-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </>
                                )}
                            </button>
                        </div>
                    </form>

                    {/* Footer */}
                    <div className="login-footer">
                        <p>&copy; {new Date().getFullYear()} {appConfig.nama_perusahaan}. All rights reserved.</p>
                    </div>
                </div>

                {/* Right Pane: Config Info / Brand Showcase */}
                <div className="login-info-pane">
                    <div className="info-pane-bg" style={{ backgroundImage: `url(${appConfig.logo})` }}></div>
                    <div className="info-pane-overlay"></div>
                    <div className="info-pane-content">
                        <div className="brand-title">
                            <span className="badge-tech">PORTAL SYSTEM</span>
                            <h2 className="app-name-display">{appConfig.nama_aplikasi}</h2>
                            <h3 className="company-name-display">{appConfig.nama_perusahaan}</h3>
                        </div>

                        <div className="hospital-details">
                            <div className="detail-item">
                                <svg className="detail-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div className="detail-text">
                                    <p className="detail-label">Alamat</p>
                                    <p className="detail-value">{appConfig.alamat}</p>
                                    <p className="detail-value">{appConfig.kota}{appConfig.kode_pos ? ` - ${appConfig.kode_pos}` : ''}</p>
                                </div>
                            </div>

                            <div className="detail-item">
                                <svg className="detail-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div className="detail-text">
                                    <p className="detail-label">Telepon</p>
                                    <p className="detail-value">{appConfig.telpon}</p>
                                </div>
                            </div>

                            {appConfig.fax && appConfig.fax !== '-' && (
                                <div className="detail-item">
                                    <svg className="detail-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    <div className="detail-text">
                                        <p className="detail-label">Fax</p>
                                        <p className="detail-value">{appConfig.fax}</p>
                                    </div>
                                </div>
                            )}
                        </div>

                        <div className="info-pane-footer">
                            <p className="system-tagline">Integrated Hospital Information System</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
