<?php

$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript_full.jsonl');
$web_php = '';

foreach ($log as $l) {
    $d = json_decode($l, true);
    if ($d && isset($d['created_at']) && $d['created_at'] <= '2026-06-20T15:30:00Z') {
        if (isset($d['tool_calls']) && isset($d['tool_calls'][0]['args'])) {
            $args = $d['tool_calls'][0]['args'];
            $tool = $d['tool_calls'][0]['name'];
            $target = $args['TargetFile'] ?? $args['AbsolutePath'] ?? '';

            if (strpos($target, 'web.php') !== false && strpos($target, 'routes') !== false) {
                if ($tool == 'write_to_file') {
                    $web_php = $args['CodeContent'];
                } elseif ($tool == 'replace_file_content') {
                    $web_php = str_replace($args['TargetContent'], $args['ReplacementContent'], $web_php);
                } elseif ($tool == 'multi_replace_file_content') {
                    $chunks = $args['ReplacementChunks'];
                    foreach ($chunks as $chunk) {
                        $web_php = str_replace($chunk['TargetContent'], $chunk['ReplacementContent'], $web_php);
                    }
                }
            }
        }
    }
}

file_put_contents(__DIR__.'/exact_web_php.txt', $web_php);
echo 'Done reconstructing web.php up to 15:30Z. Size: '.strlen($web_php)."\n";
