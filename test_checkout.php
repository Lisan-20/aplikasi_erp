<?php
$data = [
    'items' => [
        ['kode_brg' => 'K02003034', 'qty' => 1, 'harga_jual' => 10000]
    ],
    'tunai' => 10000,
    'kredit' => 0,
    'debet' => 0,
    'adm_cc' => 0,
    'diskon' => 0,
    'diskon_pers' => 0,
    'bill' => 10000
];

$ch = curl_init('http://localhost:8000/kasir/checkout');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpcode\n";
echo "Response: $response\n";
