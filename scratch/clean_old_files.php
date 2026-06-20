<?php
function clean_file($path) {
    $content = file_get_contents($path);
    // Remove "Created At: ... The following code has been modified..." header
    $lines = explode("\n", $content);
    $new_lines = [];
    $started = false;
    foreach ($lines as $line) {
        if (!$started) {
            if (preg_match('/^[0-9]+: /', $line) || strpos($line, '<?php') !== false || strpos($line, 'import ') !== false) {
                $started = true;
            } else {
                continue;
            }
        }
        if ($started) {
            // Remove line number "123: "
            $clean_line = preg_replace('/^[0-9]+: /', '', $line);
            $new_lines[] = $clean_line;
        }
    }
    file_put_contents($path . '.clean', implode("\n", $new_lines));
}
clean_file('scratch/old_DashboardController.php');
clean_file('scratch/old_DashboardLayout.jsx');
