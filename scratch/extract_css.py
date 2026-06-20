import json
import re

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if '"step_index":3085' in line:
            data = json.loads(line)
            content = data.get('content', '')
            match = re.search(r'<style>([\s\S]+?)</style>', content)
            if match:
                css = match.group(1)
                with open('resources/css/dashboard-layout.css', 'w', encoding='utf-8') as out:
                    out.write(css)
                print("Extracted CSS!")
                break
