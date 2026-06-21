<?php
require 'config/database.php';

$stmt = $pdo->query("SELECT * FROM submissions ORDER BY created_at DESC");
$brochures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BrochoMaker — Gallery</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 30px;
        }
        .gallery-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s;
            text-align: center;
        }
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .gallery-card img {
            max-height: 60px;
            max-width: 120px;
            margin-bottom: 10px;
        }
        .gallery-card h3 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #10B981;
        }
        .gallery-card p {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }
        .gallery-card .date {
            font-size: 11px;
            color: #999;
        }
        .gallery-card .model-badge {
            display: inline-block;
            background: #10B981;
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            margin-top: 8px;
        }
        .preview-btn {
            display: inline-block;
            margin-top: 10px;
            background: #064E3B;
            color: white;
            padding: 6px 16px;
            border-radius: 5px;
            font-size: 13px;
            text-decoration: none;
        }
        .preview-btn:hover {
            background: #10B981;
            text-decoration: none;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            width: 80%;
            height: 85%;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        .modal-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            background: #10B981;
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            z-index: 1001;
        }
        .modal-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 700px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="container">
            <div class="logo">BrochoMaker</div>
            <div class="nav">
                <a href="index.html">Home</a>
                <a href="test.html">Create Yours</a>
                <a href="gallery.php" class="btn-small">Gallery</a>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h2>Your Brochures</h2>
            <p style="color:#666; margin-top:5px;">Click on any brochure to preview it</p>

            <?php if (empty($brochures)): ?>
                <p style="text-align:center; margin-top:50px; color:#999;">
                    No brochures yet. <a href="test.html">Create your first one!</a>
                </p>
            <?php else: ?>
            <div class="gallery-grid">
                <?php foreach ($brochures as $b): ?>
                <div class="gallery-card" onclick="previewBrochure(<?= $b['id'] ?>)">
                    <?php if ($b['logo_path']): ?>
                        <img src="<?= htmlspecialchars($b['logo_path']) ?>" alt="logo">
                    <?php else: ?>
                        <div style="height:60px; display:flex; align-items:center; justify-content:center; background:#f0f0f0; border-radius:5px; margin-bottom:10px;">
                            <span style="color:#999; font-size:12px;">No Logo</span>
                        </div>
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($b['company_name']) ?></h3>
                    <p><?= htmlspecialchars($b['tagline']) ?></p>
                    <span class="model-badge"><?= htmlspecialchars($b['model']) ?></span>
                    <p class="date"><?= $b['created_at'] ?></p>
                    <a class="preview-btn">👁 Preview</a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="modal" id="previewModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">✕</button>
            <iframe class="modal-iframe" id="previewFrame" src=""></iframe>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <p>&copy; 2026 The Alchemist. All rights reserved.</p>
        </div>
    </div>

    <script>
        function previewBrochure(id) {
            document.getElementById('previewFrame').src = 'preview.php?id=' + id;
            document.getElementById('previewModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('previewModal').classList.remove('active');
            document.getElementById('previewFrame').src = '';
        }

        document.getElementById('previewModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</body>
</html>