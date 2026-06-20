<?php
$lines = file('routes/web.php');
// lines 115 to 168 (1-indexed) are array indices 114 to 167
$new_lines = [];
foreach($lines as $i => $line) {
    if ($i >= 114 && $i <= 167) {
        continue;
    }
    $new_lines[] = $line;
}
file_put_contents('routes/web.php', implode("", $new_lines));
