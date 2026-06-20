<?php
$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript.jsonl');
$last_content = "";
foreach($log as $l) {
    $d = json_decode($l, true);
    if($d && isset($d['created_at']) && $d['created_at'] <= '2026-06-20T15:30:00Z') {
        if(isset($d['tool_calls'][0]['args']) && strpos(json_encode($d['tool_calls'][0]['args']), 'web.php') !== false) {
            $tool = $d['tool_calls'][0]['name'];
            if($tool == 'write_to_file' || $tool == 'replace_file_content' || $tool == 'multi_replace_file_content') {
                $last_content = "MODIFIED at " . $d['created_at'] . " via " . $tool;
            }
        }
        if($d['type'] == 'VIEW_FILE' && strpos($d['content'] ?? '', 'web.php') !== false) {
             $last_content = "VIEWED at " . $d['created_at'];
        }
    }
}
echo "Last state before 15:30Z: " . $last_content . "\n";
