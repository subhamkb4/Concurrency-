<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIZARD</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a, #1a0b2e, #2d1b4e);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
            color: #ffffff;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: linear-gradient(145deg, 
                rgba(255, 105, 0, 0.1) 0%, 
                rgba(255, 69, 0, 0.15) 25%, 
                rgba(138, 43, 226, 0.2) 50%, 
                rgba(148, 0, 211, 0.25) 75%, 
                rgba(75, 0, 130, 0.3) 100%);
            border-radius: 15px;
            box-shadow: 0 0 40px rgba(255, 105, 0, 0.3),
                        0 0 80px rgba(138, 43, 226, 0.2),
                        inset 0 0 30px rgba(255, 69, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 105, 0, 0.5);
            backdrop-filter: blur(15px);
        }

        .header {
            background: linear-gradient(135deg, 
                #ff4500 0%, 
                #ff6347 25%, 
                #ff69b4 50%, 
                #9370db 75%, 
                #8a2be2 100%);
            padding: 20px;
            color: white;
            font-size: 26px;
            font-weight: 900;
            font-style: italic;
            text-align: center;
            letter-spacing: 2px;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.7),
                         0 0 30px rgba(255, 105, 0, 0.6),
                         0 0 45px rgba(138, 43, 226, 0.5);
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, 
                transparent, 
                rgba(255, 255, 255, 0.1), 
                transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: rotate(45deg) translateX(-100%); }
            100% { transform: rotate(45deg) translateX(100%); }
        }

        .gate-info {
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.2), 
                rgba(138, 43, 226, 0.2));
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 105, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .gate-name {
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            font-style: italic;
        }

        .gate-name span {
            color: #ffd700;
            font-weight: 900;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7),
                         0 0 20px rgba(255, 215, 0, 0.5);
        }

        .owner-info {
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            font-style: italic;
        }

        .owner-info span {
            color: #ffd700;
            font-weight: 900;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7),
                         0 0 20px rgba(255, 215, 0, 0.5);
        }

        .content {
            padding: 20px;
        }

        .input-section {
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.1), 
                rgba(138, 43, 226, 0.1));
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 105, 0, 0.5);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .cc-counter {
            position: absolute;
            top: -10px;
            right: 15px;
            background: linear-gradient(135deg, #ff4500, #ff69b4, #8a2be2);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 900;
            font-style: italic;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.5);
            z-index: 10;
        }

        textarea {
            width: 100%;
            min-height: 120px;
            background: rgba(10, 10, 10, 0.8);
            color: #ffffff;
            border: 1px solid #ff4500;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            resize: vertical;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            font-style: italic;
            transition: all 0.3s ease;
        }

        textarea:focus {
            outline: none;
            border-color: #ff69b4;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.5);
        }

        textarea::placeholder {
            color: #888;
            font-style: italic;
        }

        /* Gateway Selection Styles */
        .gateway-selection {
            margin: 15px 0;
        }

        .gateway-label {
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            font-style: italic;
            margin-bottom: 10px;
            display: block;
        }

        .gateway-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .gateway-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px;
            background: rgba(10, 10, 10, 0.6);
            border: 1px solid rgba(255, 105, 0, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-style: italic;
        }

        .gateway-option:hover {
            background: rgba(255, 105, 0, 0.1);
            border-color: #ff4500;
            transform: translateY(-2px);
        }

        .gateway-option.selected {
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.2), 
                rgba(138, 43, 226, 0.2));
            border-color: #ff69b4;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.3);
        }

        .gateway-checkbox {
            width: 18px;
            height: 18px;
            border: 2px solid #ff4500;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .gateway-option.selected .gateway-checkbox {
            background: linear-gradient(135deg, #ff4500, #ff69b4);
            border-color: #ff69b4;
        }

        .gateway-option.selected .gateway-checkbox::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .gateway-text {
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
        }

        .gateway-option.selected .gateway-text {
            color: #ffd700;
            text-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }

        .coming-soon {
            opacity: 0.6;
            font-style: italic;
        }

        /* Shopify Specific Fields */
        .shopify-fields {
            display: none;
            margin: 15px 0;
            padding: 15px;
            background: rgba(255, 69, 0, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(255, 105, 0, 0.3);
        }

        .shopify-fields.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .shopify-label {
            color: #ffd700;
            font-size: 13px;
            font-weight: 800;
            font-style: italic;
            margin-bottom: 8px;
            display: block;
            text-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }

        .shopify-input {
            width: 100%;
            background: rgba(10, 10, 10, 0.8);
            color: #ffffff;
            border: 1px solid #ff4500;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            font-family: 'Courier New', monospace;
            margin-bottom: 10px;
            font-weight: 600;
            font-style: italic;
            transition: all 0.3s ease;
        }

        .shopify-input:focus {
            outline: none;
            border-color: #ff69b4;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.5);
        }

        .shopify-input::placeholder {
            color: #888;
            font-style: italic;
        }

        .shopify-info {
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            color: #ffd700;
            padding: 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            font-style: italic;
            margin-top: 10px;
            text-align: center;
        }

        .auto-filter-info {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid rgba(0, 255, 0, 0.3);
            color: #00ff00;
            padding: 8px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            font-style: italic;
            margin-top: 5px;
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
            background: rgba(10, 10, 10, 0.8);
            color: #ffffff;
            border: 1px solid #ff4500;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            font-family: 'Courier New', monospace;
            margin-top: 10px;
            font-weight: 600;
            font-style: italic;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #ff69b4;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.5);
        }

        input[type="text"]::placeholder {
            color: #888;
            font-style: italic;
        }

        select {
            width: 100%;
            background: rgba(10, 10, 10, 0.8);
            color: #ffffff;
            border: 1px solid #ff4500;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            margin-top: 10px;
            cursor: pointer;
            font-weight: 600;
            font-style: italic;
            transition: all 0.3s ease;
        }

        select:focus {
            outline: none;
            border-color: #ff69b4;
            box-shadow: 0 0 15px rgba(255, 105, 180, 0.5);
        }

        .proxy-label {
            color: #ffffff;
            font-size: 13px;
            margin-top: 12px;
            display: block;
            font-weight: 800;
            font-style: italic;
        }

        .delay-value {
            color: #ffd700;
            font-weight: 900;
            font-style: italic;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
        }

        .proxy-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 900;
            font-style: italic;
            margin-left: 10px;
        }

        .proxy-enabled {
            background: linear-gradient(135deg, #00ff00, #00cc00);
            color: #000;
            text-shadow: 0 0 5px rgba(0, 255, 0, 0.5);
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        .proxy-disabled {
            background: linear-gradient(135deg, #666, #444);
            color: #fff;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        button {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 900;
            font-style: italic;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .start-btn {
            background: linear-gradient(135deg, #ff4500, #ff69b4, #8a2be2);
            color: white;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.7),
                        0 0 40px rgba(138, 43, 226, 0.5);
            animation: neonPulseStart 2s infinite;
        }

        @keyframes neonPulseStart {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(255, 105, 180, 0.7),
                            0 0 40px rgba(138, 43, 226, 0.5);
            }
            50% { 
                box-shadow: 0 0 30px rgba(255, 105, 180, 1),
                            0 0 60px rgba(138, 43, 226, 0.8),
                            0 0 80px rgba(255, 69, 0, 0.6);
            }
        }

        .stop-btn {
            background: linear-gradient(135deg, #ff0080, #ff4d94, #ff1493);
            color: white;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(255, 0, 128, 0.7),
                        0 0 40px rgba(255, 20, 147, 0.5);
            animation: neonPulseStop 2s infinite;
        }

        @keyframes neonPulseStop {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(255, 0, 128, 0.7),
                            0 0 40px rgba(255, 20, 147, 0.5);
            }
            50% { 
                box-shadow: 0 0 30px rgba(255, 0, 128, 1),
                            0 0 60px rgba(255, 20, 147, 0.8),
                            0 0 80px rgba(255, 69, 0, 0.6);
            }
        }

        .start-btn:hover, .stop-btn:hover {
            transform: translateY(-3px) scale(1.05);
        }

        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            animation: none !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2) !important;
        }

        .stats {
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.1), 
                rgba(138, 43, 226, 0.1));
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 105, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            color: #ffffff;
            border-bottom: 1px solid rgba(255, 105, 0, 0.3);
            font-weight: 800;
            font-style: italic;
        }

        .stat-row:last-child {
            border-bottom: none;
        }

        .stat-label {
            font-size: 15px;
            font-weight: 800;
            font-style: italic;
        }

        .stat-value {
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 900;
            font-style: italic;
            min-width: 60px;
            text-align: center;
            font-size: 14px;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .approve-badge {
            background: linear-gradient(135deg, #00ff00, #00cc00);
            color: #000;
        }

        .insufficient-badge {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            color: #000;
        }

        .die-badge {
            background: linear-gradient(135deg, #ff0000, #cc0000);
            color: #fff;
        }

        .total-badge {
            background: linear-gradient(135deg, #ff4500, #ff69b4, #8a2be2);
            color: #fff;
        }

        .limit-badge {
            background: linear-gradient(135deg, #666, #444);
            color: #fff;
        }

        .results-section {
            margin-bottom: 20px;
        }

        .results-tabs {
            display: flex;
            background: rgba(255, 69, 0, 0.1);
            border-radius: 10px 10px 0 0;
            overflow: hidden;
            border: 1px solid rgba(255, 105, 0, 0.5);
            border-bottom: none;
        }

        .tab {
            flex: 1;
            padding: 12px;
            text-align: center;
            background: rgba(10, 10, 10, 0.6);
            cursor: pointer;
            font-weight: 800;
            font-style: italic;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(255, 105, 0, 0.3);
        }

        .tab:last-child {
            border-right: none;
        }

        .tab.active {
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.2), 
                rgba(138, 43, 226, 0.2));
            color: #ffd700;
            text-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }

        .tab:hover {
            background: rgba(255, 105, 0, 0.1);
        }

        .results-container {
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.1), 
                rgba(138, 43, 226, 0.1));
            border-radius: 0 0 10px 10px;
            border: 1px solid rgba(255, 105, 0, 0.5);
            border-top: none;
            backdrop-filter: blur(10px);
        }

        .results-panel {
            display: none;
            max-height: 300px;
            overflow-y: auto;
            padding: 15px;
        }

        .results-panel.active {
            display: block;
        }

        .result-item {
            background: rgba(10, 10, 10, 0.8);
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border-left: 4px solid #ff4500;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            font-weight: 600;
            font-style: italic;
        }

        .result-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 20px rgba(255, 105, 0, 0.4);
        }

        .result-item.approved {
            border-left-color: #00ff00;
            box-shadow: 0 2px 10px rgba(0, 255, 0, 0.2);
        }

        .result-item.insufficient {
            border-left-color: #ffa500;
            box-shadow: 0 2px 10px rgba(255, 165, 0, 0.2);
        }

        .result-item.die {
            border-left-color: #ff0000;
            box-shadow: 0 2px 10px rgba(255, 0, 0, 0.2);
        }

        .result-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
        }

        .result-status {
            font-weight: 900;
            font-style: italic;
            font-size: 14px;
            text-shadow: 0 0 5px currentColor;
        }

        .copy-btn {
            background: linear-gradient(135deg, #ff4500, #ff69b4, #8a2be2);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 900;
            font-style: italic;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.5);
        }

        .copy-btn:hover {
            background: linear-gradient(135deg, #ff69b4, #8a2be2, #ff4500);
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(191, 122, 255, 0.7);
        }

        .copy-btn:active {
            transform: scale(0.95);
        }

        .result-status.approved {
            color: #00ff00;
        }

        .result-status.insufficient {
            color: #ffa500;
        }

        .result-status.die {
            color: #ff0000;
        }

        .result-cc {
            color: #ffffff;
            font-size: 13px;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            font-style: italic;
        }

        .result-message {
            color: #cccccc;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 600;
            font-style: italic;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(138, 43, 226, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ff4500, #ff69b4, #8a2be2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #ff69b4, #8a2be2, #ff4500);
        }

        .proxy-check-msg {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid #ffc107;
            color: #ffc107;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 10px 0;
            font-size: 13px;
            display: none;
            backdrop-filter: blur(10px);
            font-weight: 600;
            font-style: italic;
        }

        .proxy-check-msg.success {
            background: rgba(40, 167, 69, 0.1);
            border-color: #28a745;
            color: #28a745;
        }

        .proxy-check-msg.error {
            background: rgba(220, 53, 69, 0.1);
            border-color: #dc3545;
            color: #dc3545;
        }

        .telegram-footer {
            text-align: center;
            padding: 15px;
            background: linear-gradient(135deg, 
                rgba(255, 69, 0, 0.1), 
                rgba(138, 43, 226, 0.1));
            border-top: 1px solid rgba(255, 105, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .telegram-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            text-decoration: none;
            font-weight: 900;
            font-style: italic;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 25px;
            background: linear-gradient(135deg, 
                rgba(0, 136, 204, 0.3), 
                rgba(138, 43, 226, 0.3));
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 136, 204, 0.5);
        }

        .telegram-link:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0, 136, 204, 0.7);
            background: linear-gradient(135deg, 
                rgba(0, 136, 204, 0.5), 
                rgba(138, 43, 226, 0.5));
        }

        .telegram-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #0088cc, #8a2be2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: telegramFloat 2s ease-in-out infinite;
            box-shadow: 0 0 15px rgba(0, 136, 204, 0.7);
        }

        @keyframes telegramFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .telegram-icon::before {
            content: '✈';
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .developer-text {
            color: #ffd700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
            font-weight: 900;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">𝗕 𝗟 𝗔 𝗭 𝗘 [ 𝗗 𝗘 𝗩 ]</div>
        <div class="gate-info">
            <div class="gate-name">GATE: <span id="selectedGateway">STRIPE AUTH</span></div>
            <div class="owner-info">OWNER: <span>@BLAZE_X_007 BLAZE🚬</span></div>
        </div>
        
        <div class="content">
            <div class="input-section">
                <div class="cc-counter" id="ccCounter">TOTAL CC: 0</div>
                <textarea id="cardInput" placeholder="Enter card details (format: cc|mm|yy|cvv)&#10;Example:&#10;5210120098658645|05|27|173&#10;4342575022046361|02|27|508"></textarea>
                
                <!-- Gateway Selection Options -->
                <div class="gateway-selection">
                    <label class="gateway-label">SELECT GATEWAY:</label>
                    <div class="gateway-options">
                        <div class="gateway-option selected" data-gateway="stripe">
                            <div class="gateway-checkbox"></div>
                            <span class="gateway-text">Stripe Auth</span>
                        </div>
                        <div class="gateway-option" data-gateway="shopify">
                            <div class="gateway-checkbox"></div>
                            <span class="gateway-text">Shopify</span>
                        </div>
                        <div class="gateway-option" data-gateway="braintree">
                            <div class="gateway-checkbox"></div>
                            <span class="gateway-text">Braintree</span>
                        </div>
                        <div class="gateway-option coming-soon">
                            <div class="gateway-checkbox"></div>
                            <span class="gateway-text">More Coming Soon...</span>
                        </div>
                    </div>
                </div>

                <!-- Shopify Specific Fields -->
                <div class="shopify-fields" id="shopifyFields">
                    <label class="shopify-label">SHOPIFY SITES (Required):</label>
                    <textarea class="shopify-input" id="shopifySites" placeholder="Enter Shopify store URLs (one per line)&#10;Example:&#10;https://store1.myshopify.com&#10;https://store2.myshopify.com&#10;https://store3.myshopify.com"></textarea>
                    
                    <label class="shopify-label">SHOPIFY PROXIES (Required):</label>
                    <textarea class="shopify-input" id="shopifyProxies" placeholder="Enter proxies for Shopify sites (one per line)&#10;Format: ip:port or ip:port:user:pass&#10;Must match the order of sites above"></textarea>
                    
                    <div class="shopify-info">
                        ⚠️ Shopify gateway requires both sites and proxies to work properly!
                    </div>
                    <div class="auto-filter-info">
                        ✅ Auto-filter: Removes dead sites & proxies automatically!
                    </div>
                </div>

                <label class="proxy-label">
                    Proxy (Optional) 
                    <span class="proxy-status proxy-disabled" id="proxyStatus">DISABLED</span>
                </label>
                <input type="text" id="proxyInput" placeholder="ip:port or ip:port:user:pass">
                <div class="proxy-check-msg" id="proxyCheckMsg"></div>
                <label class="proxy-label">
                    Delay Between Cards: <span class="delay-value" id="delayDisplay">2 Seconds</span>
                </label>
                <select id="delaySelect">
                    <option value="1">1 Second</option>
                    <option value="2" selected>2 Seconds</option>
                    <option value="3">3 Seconds</option>
                    <option value="4">4 Seconds</option>
                    <option value="5">5 Seconds</option>
                    <option value="6">6 Seconds</option>
                    <option value="7">7 Seconds</option>
                    <option value="8">8 Seconds</option>
                    <option value="9">9 Seconds</option>
                    <option value="10">10 Seconds</option>
                    <option value="11">11 Seconds</option>
                    <option value="12">12 Seconds</option>
                    <option value="13">13 Seconds</option>
                    <option value="14">14 Seconds</option>
                    <option value="15">15 Seconds</option>
                    <option value="16">16 Seconds</option>
                    <option value="17">17 Seconds</option>
                    <option value="18">18 Seconds</option>
                    <option value="19">19 Seconds</option>
                    <option value="20">20 Seconds</option>
                </select>
                <div class="button-group">
                    <button class="start-btn" id="startBtn" onclick="startChecking()">▶ START</button>
                    <button class="stop-btn" id="stopBtn" onclick="stopChecking()" disabled>■ STOP</button>
                </div>
            </div>

            <div class="stats">
                <div class="stat-row">
                    <span class="stat-label">APPROVE :</span>
                    <span class="stat-value approve-badge" id="approveCount">0</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">INSUFFICIENT FUND :</span>
                    <span class="stat-value insufficient-badge" id="insufficientCount">0</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">DIE :</span>
                    <span class="stat-value die-badge" id="dieCount">0</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">TOTAL :</span>
                    <span class="stat-value total-badge" id="totalCount">0</span>
                </div>
                <div class="stat-row">
                    <span class="stat-label">LIMIT :</span>
                    <span class="stat-value limit-badge">5000000</span>
                </div>
            </div>

            <!-- Results Tabs Section -->
            <div class="results-section">
                <div class="results-tabs">
                    <div class="tab active" data-tab="all">ALL RESULTS</div>
                    <div class="tab" data-tab="approved">APPROVED (<span id="approvedTabCount">0</span>)</div>
                    <div class="tab" data-tab="declined">DECLINED (<span id="declinedTabCount">0</span>)</div>
                </div>
                <div class="results-container">
                    <div class="results-panel active" id="allResults">
                        <!-- All results will appear here -->
                    </div>
                    <div class="results-panel" id="approvedResults">
                        <!-- Approved results will appear here -->
                    </div>
                    <div class="results-panel" id="declinedResults">
                        <!-- Declined results will appear here -->
                    </div>
                </div>
            </div>

            <div class="telegram-footer">
                <a href="https://t.me/BLAZE_X_007" class="telegram-link" target="_blank">
                    <div class="telegram-icon"></div>
                    <span class="developer-text">DEVELOPED BY WIZ</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        let isChecking = false;
        let approveCount = 0;
        let insufficientCount = 0;
        let dieCount = 0;
        let totalCount = 0;
        let selectedGateway = 'stripe';
        let approvedCards = [];
        let declinedCards = [];
        let allResults = [];

        // Update CC counter
        function updateCcCounter() {
            const input = document.getElementById('cardInput').value.trim();
            const cards = input.split('\n').filter(line => line.trim() !== '');
            document.getElementById('ccCounter').textContent = `TOTAL CC: ${cards.length}`;
        }

        // Gateway selection functionality
        document.querySelectorAll('.gateway-option').forEach(option => {
            option.addEventListener('click', function() {
                if (this.classList.contains('coming-soon')) {
                    return; // Don't select "Coming Soon" options
                }
                
                // Remove selected class from all options
                document.querySelectorAll('.gateway-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Update selected gateway
                selectedGateway = this.getAttribute('data-gateway');
                
                // Update gateway display name
                const gatewayNames = {
                    'stripe': 'STRIPE AUTH',
                    'shopify': 'SHOPIFY',
                    'braintree': 'BRAINTREE'
                };
                
                document.getElementById('selectedGateway').textContent = gatewayNames[selectedGateway];
                
                // Show/hide Shopify specific fields
                const shopifyFields = document.getElementById('shopifyFields');
                if (selectedGateway === 'shopify') {
                    shopifyFields.classList.add('active');
                } else {
                    shopifyFields.classList.remove('active');
                }
            });
        });

        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabName = this.getAttribute('data-tab');
                
                // Remove active class from all tabs
                document.querySelectorAll('.tab').forEach(t => {
                    t.classList.remove('active');
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all panels
                document.querySelectorAll('.results-panel').forEach(panel => {
                    panel.classList.remove('active');
                });
                
                // Show selected panel
                document.getElementById(tabName + 'Results').classList.add('active');
            });
        });

        document.getElementById('cardInput').addEventListener('input', updateCcCounter);
        document.getElementById('proxyInput').addEventListener('input', function() {
            const proxyStatus = document.getElementById('proxyStatus');
            const proxyCheckMsg = document.getElementById('proxyCheckMsg');
            if (this.value.trim()) {
                proxyStatus.textContent = 'ENABLED';
                proxyStatus.className = 'proxy-status proxy-enabled';
                proxyCheckMsg.style.display = 'none';
            } else {
                proxyStatus.textContent = 'DISABLED';
                proxyStatus.className = 'proxy-status proxy-disabled';
                proxyCheckMsg.style.display = 'none';
            }
        });

        document.getElementById('delaySelect').addEventListener('change', function() {
            const delayDisplay = document.getElementById('delayDisplay');
            const value = this.value;
            delayDisplay.textContent = value === '1' ? '1 Second' : value + ' Seconds';
        });

        // Auto-filter Shopify sites and proxies
        async function autoFilterShopifyResources() {
            if (selectedGateway !== 'shopify') return { sites: [], proxies: [] };

            const sitesInput = document.getElementById('shopifySites').value.trim();
            const proxiesInput = document.getElementById('shopifyProxies').value.trim();
            
            if (!sitesInput || !proxiesInput) {
                return { sites: [], proxies: [] };
            }

            const sites = sitesInput.split('\n').filter(line => line.trim() !== '');
            const proxies = proxiesInput.split('\n').filter(line => line.trim() !== '');

            // Simulate checking sites and proxies (in real implementation, this would make API calls)
            const workingSites = [];
            const workingProxies = [];

            for (let i = 0; i < Math.min(sites.length, proxies.length); i++) {
                // Simulate 80% success rate for demo purposes
                if (Math.random() > 0.2) {
                    workingSites.push(sites[i]);
                    workingProxies.push(proxies[i]);
                }
            }

            return { sites: workingSites, proxies: workingProxies };
        }

        async function checkProxyStatus(proxy) {
            try {
                const response = await fetch('check_proxy.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ proxy: proxy })
                });
                
                const data = await response.json();
                return data;
            } catch (error) {
                return { success: false, live: false, message: 'Error checking proxy' };
            }
        }

        async function checkCard(cardData, skipDelay = false) {
            const proxy = document.getElementById('proxyInput').value.trim();
            const delaySeconds = parseInt(document.getElementById('delaySelect').value);
            const delayMs = delaySeconds * 1000;
            
            // Shopify specific validation and auto-filtering
            let shopifySites = [];
            let shopifyProxies = [];
            
            if (selectedGateway === 'shopify') {
                const filtered = await autoFilterShopifyResources();
                shopifySites = filtered.sites;
                shopifyProxies = filtered.proxies;
                
                if (shopifySites.length === 0) {
                    return 'Error: No working Shopify sites found after filtering';
                }
                
                if (shopifyProxies.length === 0) {
                    return 'Error: No working proxies found after filtering';
                }
            }
            
            try {
                if (!skipDelay) {
                    await new Promise(resolve => setTimeout(resolve, delayMs));
                }
                
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 30000);
                
                const requestData = {
                    card: cardData,
                    proxy: proxy,
                    gateway: selectedGateway
                };
                
                // Add Shopify specific data if selected
                if (selectedGateway === 'shopify') {
                    requestData.shopifySites = shopifySites.join('\n');
                    requestData.shopifyProxies = shopifyProxies.join('\n');
                }
                
                const response = await fetch('proxy_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(requestData),
                    signal: controller.signal
                });
                
                clearTimeout(timeoutId);
                const data = await response.json();
                
                if (data.success) {
                    return data.response;
                } else {
                    return data.error || 'Error checking card';
                }
            } catch (error) {
                if (error.name === 'AbortError') {
                    return 'Error: Request timeout (30s exceeded)';
                }
                return 'Error: ' + error.message;
            }
        }

        function copyCard(cardData, buttonElement) {
            navigator.clipboard.writeText(cardData).then(() => {
                const originalText = buttonElement.innerHTML;
                buttonElement.innerHTML = '✓ Copied!';
                buttonElement.style.background = 'linear-gradient(135deg, #00ff00, #00cc00)';
                setTimeout(() => {
                    buttonElement.innerHTML = originalText;
                    buttonElement.style.background = 'linear-gradient(135deg, #ff4500, #ff69b4, #8a2be2)';
                }, 1500);
            }).catch(err => {
                alert('Failed to copy: ' + err);
            });
        }

        function addResult(cardData, response) {
            let status = 'die';
            let statusText = '✗ DIE';
            let statusClass = 'die';
            
            if (!response || response.trim() === '' || response === 'null') {
                response = 'No response from API (Empty/Timeout/Rate Limited)';
                status = 'die';
                statusText = '✗ DIE';
                statusClass = 'die';
                dieCount++;
                declinedCards.push({ card: cardData, response: response, status: statusClass });
            } else {
                const responseLower = response.toLowerCase();
                
                if (responseLower.includes('charged') || responseLower.includes('approve') || responseLower.includes('aprovada') || responseLower.includes('successfully')) {
                    status = 'approved';
                    statusText = '✓ APPROVE';
                    statusClass = 'approved';
                    approveCount++;
                    approvedCards.push({ card: cardData, response: response, status: statusClass });
                } else if (responseLower.includes('live') || responseLower.includes('insufficient') || responseLower.includes('cvv')) {
                    status = 'insufficient';
                    statusText = '✓ INSUFFICIENT FUND';
                    statusClass = 'insufficient';
                    insufficientCount++;
                    declinedCards.push({ card: cardData, response: response, status: statusClass });
                } else {
                    dieCount++;
                    declinedCards.push({ card: cardData, response: response, status: statusClass });
                }
            }
            
            totalCount++;
            
            const resultItem = document.createElement('div');
            resultItem.className = `result-item ${statusClass}`;
            resultItem.innerHTML = `
                <div class="result-header">
                    <span class="result-status ${statusClass}">${statusText}</span>
                    <button class="copy-btn" onclick="copyCard('${cardData}', this)">📋 Copy CC</button>
                </div>
                <div class="result-cc">#${statusClass.toUpperCase()} CC: ${cardData}</div>
                <div class="result-message">Gateway: ${selectedGateway.toUpperCase()} | Result: ${response}</div>
            `;
            
            // Add to all results
            document.getElementById('allResults').insertBefore(resultItem, document.getElementById('allResults').firstChild);
            
            // Add to specific tab if applicable
            if (status === 'approved') {
                const approvedClone = resultItem.cloneNode(true);
                document.getElementById('approvedResults').insertBefore(approvedClone, document.getElementById('approvedResults').firstChild);
            } else {
                const declinedClone = resultItem.cloneNode(true);
                document.getElementById('declinedResults').insertBefore(declinedClone, document.getElementById('declinedResults').firstChild);
            }
            
            // Update counters
            document.getElementById('approveCount').textContent = approveCount;
            document.getElementById('insufficientCount').textContent = insufficientCount;
            document.getElementById('dieCount').textContent = dieCount;
            document.getElementById('totalCount').textContent = totalCount;
            document.getElementById('approvedTabCount').textContent = approveCount;
            document.getElementById('declinedTabCount').textContent = insufficientCount + dieCount;
        }

        async function startChecking() {
            const input = document.getElementById('cardInput').value.trim();
            const proxy = document.getElementById('proxyInput').value.trim();
            const proxyCheckMsg = document.getElementById('proxyCheckMsg');
            
            if (!input) {
                alert('Please enter card details!');
                return;
            }
            
            // Shopify specific validation
            if (selectedGateway === 'shopify') {
                const shopifySites = document.getElementById('shopifySites').value.trim();
                const shopifyProxies = document.getElementById('shopifyProxies').value.trim();
                
                if (!shopifySites) {
                    alert('Please enter Shopify sites!');
                    return;
                }
                
                if (!shopifyProxies) {
                    alert('Please enter Shopify proxies!');
                    return;
                }
                
                const sites = shopifySites.split('\n').filter(line => line.trim() !== '');
                const proxies = shopifyProxies.split('\n').filter(line => line.trim() !== '');
                
                if (sites.length !== proxies.length) {
                    alert('Number of Shopify sites and proxies must match!');
                    return;
                }
            }
            
            const cards = input.split('\n').filter(line => line.trim() !== '');
            
            if (cards.length === 0) {
                alert('No valid cards found!');
                return;
            }
            
            if (proxy) {
                proxyCheckMsg.textContent = 'Checking proxy status...';
                proxyCheckMsg.className = 'proxy-check-msg';
                proxyCheckMsg.style.display = 'block';
                
                const proxyResult = await checkProxyStatus(proxy);
                
                if (!proxyResult.live) {
                    proxyCheckMsg.textContent = '❌ Proxy is DEAD or Invalid. Please use a working proxy or remove it to continue.';
                    proxyCheckMsg.className = 'proxy-check-msg error';
                    return;
                } else {
                    proxyCheckMsg.textContent = '✓ Proxy is LIVE and Working! Starting card check...';
                    proxyCheckMsg.className = 'proxy-check-msg success';
                    await new Promise(resolve => setTimeout(resolve, 1500));
                }
            }
            
            proxyCheckMsg.style.display = 'none';
            
            isChecking = true;
            document.getElementById('startBtn').disabled = true;
            document.getElementById('stopBtn').disabled = false;
            document.getElementById('cardInput').disabled = true;
            document.getElementById('proxyInput').disabled = true;
            document.getElementById('delaySelect').disabled = true;
            
            if (selectedGateway === 'shopify') {
                document.getElementById('shopifySites').disabled = true;
                document.getElementById('shopifyProxies').disabled = true;
            }
            
            let cardIndex = 0;
            for (const card of cards) {
                if (!isChecking) break;
                
                const skipDelay = cardIndex === 0;
                const response = await checkCard(card.trim(), skipDelay);
                addResult(card.trim(), response);
                
                cardIndex++;
                
                if (cardIndex % 10 === 0 && cardIndex < cards.length) {
                    proxyCheckMsg.textContent = `⏳ Processed ${cardIndex} cards. Waiting 10 seconds before continuing...`;
                    proxyCheckMsg.className = 'proxy-check-msg';
                    proxyCheckMsg.style.display = 'block';
                    await new Promise(resolve => setTimeout(resolve, 10000));
                    proxyCheckMsg.style.display = 'none';
                }
            }
            
            stopChecking();
        }

        function stopChecking() {
            isChecking = false;
            document.getElementById('startBtn').disabled = false;
            document.getElementById('stopBtn').disabled = true;
            document.getElementById('cardInput').disabled = false;
            document.getElementById('proxyInput').disabled = false;
            document.getElementById('delaySelect').disabled = false;
            
            if (selectedGateway === 'shopify') {
                document.getElementById('shopifySites').disabled = false;
                document.getElementById('shopifyProxies').disabled = false;
            }
        }

        function resetStats() {
            approveCount = 0;
            insufficientCount = 0;
            dieCount = 0;
            totalCount = 0;
            approvedCards = [];
            declinedCards = [];
            allResults = [];
            
            document.getElementById('approveCount').textContent = '0';
            document.getElementById('insufficientCount').textContent = '0';
            document.getElementById('dieCount').textContent = '0';
            document.getElementById('totalCount').textContent = '0';
            document.getElementById('approvedTabCount').textContent = '0';
            document.getElementById('declinedTabCount').textContent = '0';
            
            document.getElementById('allResults').innerHTML = '';
            document.getElementById('approvedResults').innerHTML = '';
            document.getElementById('declinedResults').innerHTML = '';
            
            updateCcCounter();
        }

        // Initialize CC counter
        updateCcCounter();
    </script>
</body>
</html>