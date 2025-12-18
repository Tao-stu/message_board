<?php
session_start();
require_once 'control.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = '请输入用户名和密码';
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit;
            } else {
                $error = '密码错误';
            }
        } else {
            $error = '用户不存在';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录 - 留言板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>留言板</h1>
            <nav>
                <a href="index.php" class="btn">返回首页</a>
                <a href="register.php" class="btn">注册</a>
            </nav>
        </header>
        
        <div class="form-container">
            <h2>用户登录</h2>
            
            <?php if ($error): ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="username">用户名：</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn">登录</button>
            </form>
            
            <p class="link">还没有账号？<a href="register.php">立即注册</a></p>
        </div>
        
        <footer>
            <p>&copy; 2025 Tao-stu. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>