import json

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'
with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if 'dashboard.css' in line:
            data = json.loads(line)
            if data.get('type') in ['PLANNER_RESPONSE', 'CODE_ACTION', 'TOOL_RESPONSE']:
                print(f"Step {data.get('step_index')}: {data.get('type')} - {line[:200]}")
