<?php

$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript.jsonl');
$changed_files = [];
foreach ($log as $l) {
    $d = json_decode($l, true);
    if ($d && isset($d['created_at']) && $d['created_at'] > '2026-06-20T15:30:00Z') {
        if (isset($d['tool_calls'][0]['args'])) {
            $args = $d['tool_calls'][0]['args'];
            $tool = $d['tool_calls'][0]['name'];
            $target = $args['TargetFile'] ?? '';
            if ($target && in_array($tool, ['write_to_file', 'replace_file_content', 'multi_replace_file_content'])) {
                if (strpos($target, 'scratch/') === false) {
                    $changed_files[$target] = true;
                }
            }
        }
    }
}
print_r(array_keys($changed_files));
