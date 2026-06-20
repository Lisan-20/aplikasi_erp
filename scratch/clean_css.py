import re

with open('resources/css/dashboard-layout.css', 'r', encoding='utf-8') as f:
    text = f.read()

cleaned = []
for line in text.split('\n'):
    m = re.match(r'^(\d+):\s(.*)$', line)
    if m:
        cleaned.append(m.group(2))
    else:
        m2 = re.match(r'^(\d+):(.*)$', line)
        if m2:
            cleaned.append(m2.group(2))
        else:
            cleaned.append(line)

with open('resources/css/dashboard-layout.css', 'w', encoding='utf-8') as out:
    out.write('\n'.join(cleaned))
