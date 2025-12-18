<?php
session_start();
require_once 'control.php';

// 获取所有留言
$messages = [];
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言板</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>留言板</h1>
            <nav>
                <?php if (isset($_SESSION['username'])): ?>
                    <span>欢迎，<?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="btn">退出登录</a>
                <?php else: ?>
                    <a href="login.php" class="btn">登录</a>
                    <a href="register.php" class="btn">注册</a>
                <?php endif; ?>
            </nav>
        </header>

        <main>

            <div class="messages-list">
                <div class="messages-header">
                    <h3>留言列表</h3>
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="write_message.php" class="btn">写留言</a>
                    <?php else: ?>
                        <a href="login.php" class="btn">写留言</a>
                    <?php endif; ?>
                </div>
                <?php if (empty($messages)): ?>
                    <p class="no-messages">暂无留言</p>
                <?php else: ?>
                    <?php foreach ($messages as $message): ?>
                        <div class="message-item">
                            <div class="message-header">
                                <span class="username"><?php echo htmlspecialchars($message['username']); ?></span>
                                <span class="time"><?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></span>
                            </div>
                            <div class="message-content">
                                <?php echo nl2br(htmlspecialchars($message['content'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </main>

        <footer>
            <p>&copy; 2025 Tao-stu. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>