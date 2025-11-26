<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $proxy = $input['proxy'] ?? '';
    
    if (empty($proxy)) {
        echo json_encode(['success' => true, 'live' => false, 'message' => 'No proxy provided']);
        exit;
    }
    
    error_log("[" . date('Y-m-d H:i:s') . "] Checking proxy: " . $proxy);
    
    $proxyParts = explode(':', $proxy);
    $partCount = count($proxyParts);
    
    $proxyHost = '';
    $proxyUser = '';
    $proxyPass = '';
    
    if ($partCount == 2) {
        $proxyHost = $proxy;
        error_log("[" . date('Y-m-d H:i:s') . "] Proxy format: ip:port");
    } elseif ($partCount == 4) {
        $proxyHost = $proxyParts[0] . ':' . $proxyParts[1];
        $proxyUser = $proxyParts[2];
        $proxyPass = $proxyParts[3];
        error_log("[" . date('Y-m-d H:i:s') . "] Proxy format: ip:port:user:pass");
    } else {
        $proxyHost = $proxy;
        error_log("[" . date('Y-m-d H:i:s') . "] Proxy format: unknown");
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_PROXY, $proxyHost);
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    
    if (!empty($proxyUser) && !empty($proxyPass)) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyUser . ':' . $proxyPass);
        error_log("[" . date('Y-m-d H:i:s') . "] Using proxy authentication");
    }
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    error_log("[" . date('Y-m-d H:i:s') . "] Proxy check result - HTTP Code: " . $httpCode . ", Error: " . ($error ?: 'none'));
    
    if ($error || $httpCode !== 200) {
        error_log("[" . date('Y-m-d H:i:s') . "] Proxy is DEAD");
        echo json_encode([
            'success' => true,
            'live' => false,
            'message' => 'Proxy is DEAD or Invalid',
            'error' => $error
        ]);
    } else {
        error_log("[" . date('Y-m-d H:i:s') . "] Proxy is LIVE");
        echo json_encode([
            'success' => true,
            'live' => true,
            'message' => 'Proxy is LIVE and Working'
        ]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>