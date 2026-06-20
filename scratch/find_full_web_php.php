<?php
$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript_full.jsonl');
$last_content = "";
$last_time = "";
foreach($log as $l) {
    $d = json_decode($l, true);
    if($d && isset($d['created_at']) && $d['created_at'] <= '2026-06-20T15:30:00Z') {
        if($d['type'] == 'VIEW_FILE' && strpos($d['content'] ?? '', 'File Path: `file:///d:/001_Aplikasi/aplikasi_erp_laravel/routes/web.php`') !== false) {
            if(strpos($d['content'], 'The above content does NOT show the entire file') === false) {
                $last_content = $d['content'];
                $last_time = $d['created_at'];
            }
        }
    }
}
file_put_contents(__DIR__.'/extracted_full_web.txt', $last_time . "\n" . $last_content);
echo "Extracted from full transcript at: " . $last_time . "\n";
