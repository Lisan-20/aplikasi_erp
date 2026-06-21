<?php

$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript.jsonl');
foreach ($log as $l) {
    $d = json_decode($l, true);
    if ($d && isset($d['created_at']) && $d['created_at'] >= '2026-06-20T12:00:00Z' && $d['created_at'] <= '2026-06-20T15:30:00Z') {
        if (isset($d['tool_calls'][0]['args'])) {
            $args = $d['tool_calls'][0]['args'];
            $tool = $d['tool_calls'][0]['name'];
            $target = $args['TargetFile'] ?? $args['AbsolutePath'] ?? '';
            if (strpos($target, 'web.php') !== false) {
                echo $d['created_at'].' - '.$tool.' - '.($args['toolAction'] ?? '')."\n";
            }
        }
    }
}
