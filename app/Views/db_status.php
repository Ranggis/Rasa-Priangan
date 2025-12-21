<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0d0805;
            --accent: #c0a080;
            --success: #00ff7f;
            --error: #ff4d4d;
        }
        body {
            background: var(--bg);
            color: #f4ece2;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(192, 160, 128, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            backdrop-filter: blur(10px);
        }
        .icon { font-size: 50px; margin-bottom: 20px; }
        .status-tag {
            display: inline-block;
            padding: 5px 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 20px;
            border: 1px solid;
        }
        .success { color: var(--success); border-color: var(--success); }
        .error { color: var(--error); border-color: var(--error); }
        h2 { color: var(--accent); margin-bottom: 10px; }
        p { opacity: 0.7; font-size: 14px; line-height: 1.6; }
        .db-name { color: var(--accent); font-weight: bold; }
        .btn-back {
            display: inline-block;
            margin-top: 30px;
            color: var(--accent);
            text-decoration: none;
            font-size: 12px;
            border-bottom: 1px solid var(--accent);
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="icon"><?= $status ? '☕' : '⚠️' ?></div>
        
        <div class="status-tag <?= $status ? 'success' : 'error' ?>">
            <?= $status ? 'Connected' : 'Disconnected' ?>
        </div>

        <h2>System Check</h2>
        <p><?= $message ?></p>
        
        <?php if($status): ?>
            <p>Database: <span class="db-name"><?= $dbName ?></span></p>
        <?php endif; ?>

        <a href="<?= base_url('/') ?>" class="btn-back">KEMBALI KE BERANDA</a>
    </div>

</body>
</html>