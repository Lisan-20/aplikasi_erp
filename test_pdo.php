<?php
$serverName = "host.docker.internal,1433";
$database = "rs_fikri_live";
$uid = "sa";
$pwd = "bismillah";

try {
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $uid, $pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id_dc_sub_menu, nama_sub_menu, url_sub_menu, url_sub_menu_baru 
            FROM dc_sub_menu 
            WHERE nama_sub_menu LIKE '%Kasir%' OR nama_sub_menu LIKE '%User%'";
    
    $stmt = $conn->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    print_r($results);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
