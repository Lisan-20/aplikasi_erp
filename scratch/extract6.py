import json
import re

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if '"step_index":14403' in line:
            data = json.loads(line)
            content = data.get('content', '')
            match = re.search(r'Showing lines .*?\n([\s\S]+?)\nThe above content', content)
            if match:
                text = match.group(1)
                text = re.sub(r'(?m)^\d+: ', '', text)
                with open('resources/css/app.css', 'w', encoding='utf-8') as out:
                    out.write(text)
                print("Extracted app.css")
