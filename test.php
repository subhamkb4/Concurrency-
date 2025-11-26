<!DOCTYPE html>
<html>
<head>
    <title>Test Proxy Handler</title>
</head>
<body>
    <h1>Testing Proxy Handler</h1>
    <button onclick="testAPI()">Test Without Proxy</button>
    <button onclick="testAPIWithProxy()">Test With Proxy</button>
    <pre id="result"></pre>

    <script>
        async function testAPI() {
            const result = document.getElementById('result');
            result.textContent = 'Testing...';
            
            try {
                const response = await fetch('proxy_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        card: '5210120098658645|05|27|173',
                        proxy: ''
                    })
                });
                
                const data = await response.json();
                result.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                result.textContent = 'Error: ' + error.message;
            }
        }

        async function testAPIWithProxy() {
            const result = document.getElementById('result');
            result.textContent = 'Testing with proxy...';
            
            try {
                const response = await fetch('proxy_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        card: '5210120098658645|05|27|173',
                        proxy: '127.0.0.1:8080'
                    })
                });
                
                const data = await response.json();
                result.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                result.textContent = 'Error: ' + error.message;
            }
        }
    </script>
</body>
</html>
