<?php

$log = file('C:/Users/lsidq/.gemini/antigravity/brain/066a488e-bb8e-4e91-8110-6f31bb7fc2ca/.system_generated/logs/transcript_full.jsonl');
$dc_content = '';
$dl_content = '';

foreach ($log as $l) {
    $d = json_decode($l, true);
    if ($d && isset($d['created_at']) && $d['created_at'] <= '2026-06-20T15:30:00Z') {
        if (isset($d['tool_calls']) && isset($d['tool_calls'][0]['args'])) {
            $args = $d['tool_calls'][0]['args'];
            $tool = $d['tool_calls'][0]['name'];
            $target = $args['TargetFile'] ?? $args['AbsolutePath'] ?? '';

            // EXACT MATCH on filename at the end of the path
            if (basename(str_replace('\\', '/', $target)) === 'DashboardController.php') {
                if ($tool == 'write_to_file') {
                    $dc_content = $args['CodeContent'];
                } elseif ($tool == 'replace_file_content') {
                    $dc_content = str_replace($args['TargetContent'], $args['ReplacementContent'], $dc_content);
                } elseif ($tool == 'multi_replace_file_content') {
                    $chunks = $args['ReplacementChunks'];
                    foreach ($chunks as $chunk) {
                        $dc_content = str_replace($chunk['TargetContent'], $chunk['ReplacementContent'], $dc_content);
                    }
                }
            }
            if (basename(str_replace('\\', '/', $target)) === 'DashboardLayout.jsx') {
                if ($tool == 'write_to_file') {
                    $dl_content = $args['CodeContent'];
                } elseif ($tool == 'replace_file_content') {
                    $dl_content = str_replace($args['TargetContent'], $args['ReplacementContent'], $dl_content);
                } elseif ($tool == 'multi_replace_file_content') {
                    $chunks = $args['ReplacementChunks'];
                    foreach ($chunks as $chunk) {
                        $dl_content = str_replace($chunk['TargetContent'], $chunk['ReplacementContent'], $dl_content);
                    }
                }
            }
        }

        // Also look at VIEW_FILE
        if ($d['type'] == 'VIEW_FILE') {
            if (strpos($d['content'] ?? '', 'File Path: `file:///d:/001_Aplikasi/aplikasi_erp_laravel/app/Http/Controllers/DashboardController.php`') !== false && strpos($d['content'], 'The above content does NOT show the entire file') === false) {
                $dc_content = $d['content'];
            }
            if (strpos($d['content'] ?? '', 'File Path: `file:///d:/001_Aplikasi/aplikasi_erp_laravel/resources/js/Layouts/DashboardLayout.jsx`') !== false && strpos($d['content'], 'The above content does NOT show the entire file') === false) {
                $dl_content = $d['content'];
            }
        }
    }
}
file_put_contents('scratch/old_DashboardController.php', $dc_content);
file_put_contents('scratch/old_DashboardLayout.jsx', $dl_content);
echo 'Extracted DashboardController.php size: '.strlen($dc_content)."\n";
echo 'Extracted DashboardLayout.jsx size: '.strlen($dl_content)."\n";
