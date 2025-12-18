<?php
session_start();
require_once 'control.php';

// 处理留言发布
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    
    $content = trim($_POST['content']);
    if (!empty($content)) {
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        
        $stmt = $conn->prepare("INSERT INTO messages (user_id, username, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $username, $content);
        $stmt->execute();
        $stmt->close();
        
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>发布留言</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>发布留言</h1>
            <nav>
                <span>欢迎，<?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="btn">退出登录</a>
            </nav>
        </header>

        <main>
            <div class="message-form">
                <div class="messages-header">
                    <h3>发布新留言</h3>
                    <a href="index.php" class="btn">返回首页</a>
                </div>
                <form method="POST">
                    <textarea name="content" rows="6" placeholder="请输入您的留言..." maxlength="500" required></textarea>
                    <div class="char-count">
                        <span id="charCount">0</span>/500
                    </div>
                    <button type="submit" class="btn">发布留言</button>
                </form>
            </div>
        </main>
        
        <footer>
            <p>&copy; 2025 Tao-stu. All rights reserved.</p>
        </footer>
    </div>
    
    <script>
        // 字符计数功能
        const textarea = document.querySelector('textarea[name="content"]');
        const charCount = document.getElementById('charCount');
        
        if (textarea && charCount) {
            textarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;
                
                if (length > 450) {
                    charCount.style.color = '#ff6b6b';
                } else if (length > 400) {
                    charCount.style.color = '#ffaa00';
                } else {
                    charCount.style.color = '#00ffcc';
                }
            });
        }
    </script>
</body>
</html>