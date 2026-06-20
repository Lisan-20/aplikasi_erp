<?php
$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript.jsonl');
$last_content = "";
$last_time = "";
foreach($log as $l) {
    $d = json_decode($l, true);
    if($d && isset($d['created_at']) && $d['created_at'] <= '2026-06-20T15:30:00Z') {
        if($d['type'] == 'VIEW_FILE' && strpos($d['content'] ?? '', 'routes/web.php') !== false) {
             $last_content = $d['content'];
             $last_time = $d['created_at'];
        }
    }
}
file_put_contents(__DIR__.'/extracted_web.txt', $last_time . "\n" . $last_content);
echo "Extracted from: " . $last_time . "\n";
