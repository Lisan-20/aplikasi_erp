import React from 'react';
import { Head } from '@inertiajs/react';
import DashboardLayout from '@/Layouts/DashboardLayout';

export default function LegacyView({ legacyPath, module_name, menus }) {
    // Construct the legacy URL. We assume the legacy app is hosted at /aplikasi_rs/ or similar.
    // If it's an absolute URL, we use it directly.
    const baseUrl = import.meta.env.VITE_LEGACY_BASE_URL || 'http://localhost/aplikasi_rs/';
    const iframeSrc = legacyPath.startsWith('http') ? legacyPath : `${baseUrl}${legacyPath}`;

    return (
        <DashboardLayout module_name={module_name} menus={menus}>
            <Head title="Legacy Module" />
            <div style={{ flex: 1, minHeight: 0, display: 'flex', flexDirection: 'column', overflow: 'hidden', margin: '1rem', borderRadius: '12px', border: '1px solid var(--glass-border)' }}>
                <iframe 
                    src={iframeSrc}
                    style={{ width: '100%', flex: 1, border: 'none' }}
                    title="Legacy View"
                />
            </div>
        </DashboardLayout>
    );
}
