import json
import re

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'
lines_dict = {}

# We know view_file was called on DashboardLayout.jsx in these steps
steps = [14019, 14022, 14029, 14032, 14037, 14043]

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        try:
            data = json.loads(line)
            if data.get('step_index') in steps and data.get('type') == 'TOOL_RESPONSE':
                content = data.get('content', '')
                match = re.search(r'Showing lines .*?\n([\s\S]+?)\nThe above content', content)
                if match:
                    text = match.group(1).strip()
                    for l in text.split('\n'):
                        l = l.strip()
                        m = re.match(r'^(\d+):\s*(.*)$', l)
                        if m:
                            lines_dict[int(m.group(1))] = m.group(2)
        except:
            pass

# Write the stitched file
with open('resources/js/Layouts/DashboardLayout.jsx', 'w', encoding='utf-8') as out:
    for i in range(1, max(lines_dict.keys()) + 1):
        out.write(lines_dict.get(i, '') + '\n')

print(f"Stitched DashboardLayout.jsx with {len(lines_dict)} lines.")
