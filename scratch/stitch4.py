import json

log_path = r'C:\Users\lsidq\.gemini\antigravity\brain\066a488e-bb8e-4e91-8110-6f31bb7fc2ca\.system_generated\logs\transcript_full.jsonl'
lines_dict = {}

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if 'TOOL_RESPONSE' in line and 'Showing lines' in line and 'DashboardLayout.jsx' in line:
            data = json.loads(line)
            content = data.get('content', '')
            for l in content.split('\n'):
                # match number: content
                import re
                m = re.match(r'^(\d+):\s(.*)$', l.strip())
                if m:
                    lines_dict[int(m.group(1))] = m.group(2)
                else:
                    m = re.match(r'^(\d+):(.*)$', l.strip())
                    if m:
                        lines_dict[int(m.group(1))] = m.group(2)

if lines_dict:
    with open('resources/js/Layouts/DashboardLayout.jsx', 'w', encoding='utf-8') as out:
        for i in range(1, max(lines_dict.keys()) + 1):
            out.write(lines_dict.get(i, '') + '\n')
    print(f"Stitched {len(lines_dict)} lines.")
else:
    print("Failed")
