import re

lines_dict = {}
with open('scratch/dump.txt', 'r', encoding='utf-8') as f:
    text = f.read()

for match in re.finditer(r'(?m)^(\d+):\s(.*)$', text):
    lines_dict[int(match.group(1))] = match.group(2)

print(f"Extracted {len(lines_dict)} lines")
if len(lines_dict) > 0:
    with open('resources/js/Layouts/DashboardLayout.jsx', 'w', encoding='utf-8') as out:
        for i in range(1, max(lines_dict.keys()) + 1):
            out.write(lines_dict.get(i, '') + '\n')
