import js from '@eslint/js';
import react from 'eslint-plugin-react';
import reactHooks from 'eslint-plugin-react-hooks';

export default [
    js.configs.recommended,
    {
        // TODO: fix existing lint issues in these files and remove them
        // from this ignore list (tracked separately from this change).
        ignores: [
            'resources/js/Layouts/DashboardLayout.jsx',
            'resources/js/Pages/InformasiMedis3/InfoTarifUmum.jsx',
            'resources/js/Pages/InformasiMedis3/PaketBedah.jsx',
            'resources/js/Pages/InformasiMedis3/PaketMelahirkan.jsx',
            'resources/js/Pages/ModuleSelection.jsx',
            'resources/js/Pages/Registrasi/DaftarCariPasien.jsx',
            'resources/js/Pages/Registrasi/DaftarPerjanjian.jsx',
            'resources/js/Pages/Registrasi/EditDataUmum.jsx',
            'resources/js/Pages/Registrasi/IgdMalam.jsx',
            'resources/js/Pages/Registrasi/ListingJkn.jsx',
            'resources/js/Pages/Registrasi/ListingPoli.jsx',
            'resources/js/Pages/Registrasi/Mcu.jsx',
            'resources/js/Pages/Registrasi/PaketPoli.jsx',
            'resources/js/Pages/Registrasi/PasienBaru.jsx',
            'resources/js/Pages/Registrasi/PasienLama.jsx',
            'resources/js/Pages/Registrasi/PasienRawatInap.jsx',
            'resources/js/Pages/Registrasi/PendaftaranRi.jsx',
            'resources/js/Pages/Registrasi/PenunjangMedis.jsx',
            'resources/js/Pages/Registrasi/PermintaanRi.jsx',
            'resources/js/Pages/Registrasi/RawatDarurat.jsx',
            'resources/js/Pages/Registrasi/RawatJalan.jsx',
        ],
    },
    {
        files: ['resources/js/**/*.{js,jsx}'],
        plugins: {
            react,
            'react-hooks': reactHooks,
        },
        languageOptions: {
            ecmaVersion: 2022,
            sourceType: 'module',
            parserOptions: {
                ecmaFeatures: { jsx: true },
            },
            globals: {
                window: 'readonly',
                document: 'readonly',
                console: 'readonly',
                route: 'readonly',
                setTimeout: 'readonly',
                clearTimeout: 'readonly',
                setInterval: 'readonly',
                clearInterval: 'readonly',
                fetch: 'readonly',
                localStorage: 'readonly',
                sessionStorage: 'readonly',
                navigator: 'readonly',
                FormData: 'readonly',
                URLSearchParams: 'readonly',
            },
        },
        settings: {
            react: { version: 'detect' },
        },
        rules: {
            ...react.configs.recommended.rules,
            'react-hooks/rules-of-hooks': 'error',
            'react-hooks/exhaustive-deps': 'warn',
            'react/react-in-jsx-scope': 'off',
            'react/prop-types': 'off',
        },
    },
];
