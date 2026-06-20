import json
import re

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if 'DashboardLayout.jsx' in line and '"type":"VIEW_FILE"' in line:
            try:
                data = json.loads(line)
                content = data.get('content', '')
                match = re.search(r'Showing lines .*?\n([\s\S]+?)\nThe above content', content)
                if match:
                    text = match.group(1).split('\n')
                    print(f"Step {data['step_index']}: {text[0]} {text[1] if len(text)>1 else ''}")
            except:
                pass
