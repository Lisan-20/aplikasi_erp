import json

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if 'app.css' in line and ('replace_file_content' in line or 'multi_replace_file_content' in line):
            print(line[:500])
