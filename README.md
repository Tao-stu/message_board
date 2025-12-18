# 留言板系统

一个现代化的PHP留言板系统，具有用户注册、登录、发布留言等功能，采用深蓝色科技风格设计。

## 🚀 功能特性

### 核心功能
- ✅ 用户注册与登录
- ✅ 发布留言功能
- ✅ 留言展示与时间显示
- ✅ 用户会话管理
- ✅ 安全的密码存储

### 设计特性
- 🎨 现代化深蓝色科技风格UI
- 📱 响应式设计，支持移动端
- ✨ 优雅的动画效果与渐变背景
- 🔒 安全的输入验证与过滤
- 💫 动态交互反馈

## 📁 项目结构

```
留言板/
├── index.php          # 首页 - 留言列表展示
├── login.php          # 用户登录页面
├── register.php       # 用户注册页面
├── write_message.php  # 发布留言页面
├── logout.php         # 用户退出登录
├── control.php        # 数据库连接与控制
├── style.css          # 样式文件
├── README.md          # 项目文档
└── database.sql       # 数据库结构（需手动创建）
```

## 🛠️ 技术栈

### 后端
- **PHP 7.4+** - 主要开发语言
- **MySQL** - 数据库存储
- **PDO** - 数据库操作
- **Session** - 用户状态管理

### 前端
- **HTML5** - 页面结构
- **CSS3** - 样式设计，包含渐变、动画
- **JavaScript** - 交互功能
- **响应式设计** - 移动端适配

## 📋 系统要求

- PHP 7.4 或更高版本
- MySQL 5.7 或更高版本
- Web服务器（Apache/Nginx）
- 支持PDO的PHP环境

## 🚀 安装部署

### 1. 环境准备
确保您的服务器支持PHP和MySQL，并已启用以下PHP扩展：
- PDO
- PDO_MySQL
- mbstring

### 2. 数据库设置
创建数据库并执行以下SQL语句：

```sql
-- 创建数据库
CREATE DATABASE message_board CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 使用数据库
USE message_board;

-- 创建用户表
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 创建留言表
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 3. 配置数据库连接
编辑 `control.php` 文件，修改数据库连接信息：

```php
$host = 'localhost';
$dbname = 'message_board';  // 您的数据库名
$username = 'root';         // 数据库用户名
$password = '';             // 数据库密码
```

### 4. 部署文件
将所有文件上传到您的Web服务器目录中。

### 5. 设置权限
确保Web服务器对以下文件有写入权限（如果需要日志文件等）。

## 📖 使用说明

### 用户注册
1. 访问 `register.php`
2. 填写用户名、邮箱和密码
3. 点击注册按钮
4. 注册成功后跳转到登录页面

### 用户登录
1. 访问 `login.php`
2. 输入用户名和密码
3. 点击登录按钮
4. 登录成功后跳转到首页

### 发布留言
1. 登录后在首页点击"写留言"按钮
2. 在弹出的页面中输入留言内容（最多500字）
3. 点击发布留言
4. 发布成功后自动返回首页查看

### 浏览留言
- 访问首页即可查看所有留言
- 留言按时间倒序显示（最新留言在前）
- 显示发布者用户名和发布时间

## 🎨 设计特色

### 视觉效果
- **深蓝色科技风格**：采用渐变背景和发光效果
- **响应式布局**：完美适配桌面和移动设备
- **动画效果**：按钮悬停、过渡动画等微交互
- **统一设计语言**：所有页面保持一致的视觉风格

### 用户体验
- **直观导航**：清晰的页面结构和导航
- **实时反馈**：表单验证、操作提示等
- **安全防护**：XSS防护、密码加密等安全措施

## 🔒 安全特性

- **密码加密**：使用 `password_hash()` 进行密码加密
- **SQL注入防护**：使用PDO预处理语句
- **XSS防护**：输出时使用 `htmlspecialchars()` 过滤
- **会话管理**：安全的用户会话控制

## 📱 响应式设计

系统采用移动优先的响应式设计：

- **桌面端**：最佳显示效果，完整功能
- **平板端**：自适应布局调整
- **移动端**：优化触控体验，简化界面

## 🐛 故障排除

### 常见问题

1. **数据库连接失败**
   - 检查数据库配置信息
   - 确认数据库服务是否启动
   - 验证用户名和密码

2. **注册失败**
   - 检查用户名或邮箱是否已存在
   - 确认密码长度是否符合要求（至少6位）

3. **页面显示异常**
   - 检查CSS文件是否正确加载
   - 确认PHP错误报告设置

## 🤝 贡献指南

欢迎提交Issue和Pull Request来改进项目：

1. Fork 本项目
2. 创建特性分支
3. 提交更改
4. 推送到分支
5. 创建Pull Request

## 📄 许可证

本项目版权归作者所有，保留所有权利。

## 👨‍💻 作者

**Tao-stu** - 项目创建者与主要开发者

---

**© 2025 Tao-stu. All rights reserved.**

如有问题或建议，请联系项目作者。