<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CITADEL // Citizen Records</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'JetBrains Mono', monospace;
            min-height: 100vh;
            background: linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 50%, #0f0f1a 100%);
            color: #e0e0e0;
            position: relative;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                repeating-linear-gradient(
                    0deg,
                    transparent,
                    transparent 2px,
                    rgba(0, 255, 136, 0.03) 2px,
                    rgba(0, 255, 136, 0.03) 4px
                );
            pointer-events: none;
            z-index: 1000;
        }
        .rain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.1;
            background: linear-gradient(transparent 0%, rgba(0, 255, 136, 0.1) 50%, transparent 100%);
            animation: rain 0.5s linear infinite;
        }
        @keyframes rain {
            0% { background-position: 0 0; }
            100% { background-position: 0 20px; }
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(0, 255, 136, 0.2);
        }
        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            color: #00ff88;
            text-shadow: 0 0 20px rgba(0, 255, 136, 0.5), 0 0 40px rgba(0, 255, 136, 0.3);
            letter-spacing: 8px;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            font-size: 0.85rem;
            letter-spacing: 4px;
            text-transform: uppercase;
        }
        .terminal-box {
            background: rgba(10, 10, 15, 0.9);
            border: 1px solid rgba(0, 255, 136, 0.3);
            border-radius: 4px;
            padding: 25px;
            margin-bottom: 25px;
            position: relative;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5), inset 0 0 30px rgba(0, 255, 136, 0.02);
        }
        .terminal-box::before {
            content: '■ ■ ■';
            position: absolute;
            top: -12px;
            left: 20px;
            background: #0a0a0f;
            padding: 0 10px;
            color: #00ff88;
            font-size: 8px;
            letter-spacing: 4px;
        }
        .story-text {
            color: #888;
            font-size: 0.9rem;
            line-height: 1.8;
            font-style: italic;
        }
        .story-text .highlight {
            color: #00ff88;
            font-style: normal;
        }
        .system-status {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px 0;
            border-bottom: 1px dashed rgba(0, 255, 136, 0.2);
            font-size: 0.75rem;
            color: #555;
        }
        .status-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #00ff88;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        .search-form {
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }
        .form-group {
            flex: 1;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #00ff88;
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(0, 255, 136, 0.3);
            border-radius: 3px;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-group input:focus {
            outline: none;
            border-color: #00ff88;
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.2);
        }
        .form-group input::placeholder {
            color: #444;
        }
        .btn-search {
            padding: 12px 30px;
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 255, 136, 0.1) 100%);
            border: 1px solid #00ff88;
            color: #00ff88;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        .btn-search:hover {
            background: #00ff88;
            color: #0a0a0f;
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.4);
        }
        .citizen-card {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.05) 0%, rgba(0, 0, 0, 0.3) 100%);
            border: 1px solid rgba(0, 255, 136, 0.2);
            border-left: 3px solid #00ff88;
            padding: 25px;
            margin-top: 25px;
            position: relative;
        }
        .citizen-card::before {
            content: 'RECORD FOUND';
            position: absolute;
            top: -10px;
            right: 20px;
            background: #0a0a0f;
            padding: 0 10px;
            color: #00ff88;
            font-size: 0.65rem;
            letter-spacing: 2px;
        }
        .citizen-info {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 10px;
            margin: 12px 0;
            font-size: 0.95rem;
        }
        .label {
            color: #555;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }
        .value {
            color: #fff;
        }
        .error {
            color: #ff4444;
            padding: 20px;
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            border-radius: 3px;
            margin-top: 20px;
        }
        .error::before {
            content: '⚠ ';
        }
        .footer-hint {
            margin-top: 40px;
            padding: 20px;
            background: rgba(255, 200, 0, 0.05);
            border: 1px dashed rgba(255, 200, 0, 0.3);
            color: #998800;
            font-size: 0.8rem;
            text-align: center;
        }
        .glitch {
            animation: glitch 0.3s infinite;
        }
        @keyframes glitch {
            0%, 100% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, -2px); }
            80% { transform: translate(2px, 2px); }
        }
        .classified {
            color: #ff4444;
            font-size: 0.7rem;
            letter-spacing: 3px;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="rain"></div>
    <div class="container">
        <header class="header">
            <div class="logo">CITADEL</div>
            <div class="subtitle">City Integrated Tracking & Data Evaluation Layer</div>
        </header>

        <div class="terminal-box">
            <div class="story-text">
                The city never really slept. Its lights pulsed in predictable patterns, just like the code that kept it alive. 
                <span class="highlight">Sherlock</span> was asked to audit this system—clean architecture, perfect integrations, 
                <span class="highlight">flawless behavior</span>. Too flawless. The truth wouldn't be found in one file, 
                but in the system as a whole. <span class="highlight">Line by line. Clue by clue.</span>
            </div>
        </div>

        <div class="terminal-box">
            <div class="system-status">
                <div class="status-item">
                    <div class="status-dot"></div>
                    <span>SYSTEM ACTIVE</span>
                </div>
                <div class="status-item">
                    <span>SECTOR 7-G</span>
                </div>
                <div class="status-item">
                    <span class="classified">CLEARANCE: AUDITOR</span>
                </div>
            </div>
            
            <form method="GET" action="" class="search-form">
                <div class="form-group">
                    <label for="id">Citizen Record ID</label>
                    <input type="text" id="id" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '1'; ?>" placeholder="Enter citizen ID...">
                </div>
                <button type="submit" class="btn-search">Query</button>
            </form>

        <?php
        $host = 'db';
        $dbname = 'ctf_challenge';
        $username = 'root';
        $password = 'root';

        try {
            $conn = new mysqli($host, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("<div class='error'>Database connection failed: " . htmlspecialchars($conn->connect_error) . "</div>");
            }

            $id = isset($_GET['id']) ? $_GET['id'] : '1';

            $query = "SELECT name, sector, status, compliance FROM citizens WHERE id = " . $id;
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='citizen-card'>";
                echo "<div class='citizen-info'><span class='label'>Name:</span> <span class='value'>" . htmlspecialchars($row['name']) . "</span></div>";
                echo "<div class='citizen-info'><span class='label'>Sector:</span> <span class='value'>" . htmlspecialchars($row['sector']) . "</span></div>";
                echo "<div class='citizen-info'><span class='label'>Status:</span> <span class='value'>" . htmlspecialchars($row['status']) . "</span></div>";
                echo "<div class='citizen-info'><span class='label'>Compliance:</span> <span class='value'>" . htmlspecialchars($row['compliance']) . "</span></div>";
                echo "</div>";
            } else {
                echo "<div class='error'>No citizen record found with ID: " . htmlspecialchars($id) . "</div>";
            }

            $conn->close();
        } catch (Exception $e) {
            echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        ?>

        <div class="footer-hint">
            「 The most dangerous mind wasn't hiding in the shadows... It was written in code. 」
        </div>
        </div>
    </div>
</body>
</html>
