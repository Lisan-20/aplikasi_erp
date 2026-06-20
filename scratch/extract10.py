import json

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if ('svg {' in line or 'svg' in line) and ('width' in line or 'height' in line) and '"type":"CODE_ACTION"' in line:
            print(line[:500])
