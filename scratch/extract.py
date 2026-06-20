import json
import re

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'
dashboard_content = None
app_css_content = None
dashboard_step = -1
app_css_step = -1

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if 'DashboardLayout.jsx' in line or 'app.css' in line:
            try:
                data = json.loads(line)
                if data.get('type') == 'VIEW_FILE':
                    content = data.get('content', '')
                    if 'File Path: ile:///d:/001_Aplikasi/aplikasi_erp_laravel/resources/js/Layouts/DashboardLayout.jsx' in content:
                        dashboard_content = content
                        dashboard_step = data.get('step_index')
                    if 'File Path: ile:///d:/001_Aplikasi/aplikasi_erp_laravel/resources/css/app.css' in content:
                        app_css_content = content
                        app_css_step = data.get('step_index')
            except Exception:
                pass

def extract(content, path):
    match = re.search(r'Showing lines .*?\n([\s\S]+?)\nThe above content', content)
    if match:
        text = match.group(1)
        text = re.sub(r'(?m)^\d+: ', '', text)
        with open(path, 'w', encoding='utf-8') as out:
            out.write(text)

if dashboard_content:
    print(f'Found DashboardLayout at step {dashboard_step}')
    extract(dashboard_content, 'resources/js/Layouts/DashboardLayout.jsx')

if app_css_content:
    print(f'Found app.css at step {app_css_step}')
    extract(app_css_content, 'resources/css/app.css')

