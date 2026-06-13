<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Koneksi Database - Teman AI</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; margin: 0; }
        .card { background: white; padding: 2.5rem; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); text-align: center; width: 450px; border-top: 8px solid #3498db; }
        .status-ok { color: #27ae60; font-weight: bold; font-size: 1.3rem; margin-bottom: 1rem; }
        .status-error { color: #e74c3c; font-weight: bold; font-size: 1.3rem; }
        .stat-box { background: #f8fafb; padding: 1.5rem; border-radius: 12px; margin-top: 1.5rem; border: 1px solid #dfe6e9; }
        .highlight { font-size: 2.5rem; color: #2d3436; font-weight: 800; display: block; }
        .label { font-size: 0.9rem; color: #636e72; text-transform: uppercase; letter-spacing: 1px; }
        .footer { margin-top: 2rem; font-size: 0.8rem; color: #b2bec3; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Database Check 🤖</h1>
        <p>Testing connection to <strong>dBAmandaOffice</strong></p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 1.5rem 0;">
        
        @if($status == 'Connected')
            <div class="status-ok">✅ TERKONEKSI KE SQL SERVER!</div>
            <div class="stat-box">
                <span class="label">Total Pasien Terdeteksi</span>
                <span class="highlight">{{ $total }}</span>
            </div>
            @if($latest)
                <p style="margin-top: 1.5rem; font-size: 0.9rem; color: #2d3436;">
                    Pasien Terakhir Terdaftar:<br>
                    <strong>{{ $latest->full_name }}</strong> ({{ $latest->no_mr }})
                </p>
            @endif
        @else
            <div class="status-error">❌ GAGAL KONEKSI</div>
            <div style="background: #fff5f5; padding: 10px; border-radius: 5px; color: #c0392b; font-size: 0.8rem; margin-top: 10px; text-align: left; overflow-x: auto;">
                <code>{{ $message }}</code>
            </div>
        @endif

        <div class="footer">
            Developed by <strong>Teman AI</strong><br>PHP Native $\rightarrow$ Laravel Migration 🚀
        </div>
    </div>
</body>
</html>
