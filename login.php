<?php
session_start();
require 'db.php';

$error = "";

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "الرجاء إدخال اسم المستخدم وكلمة المرور";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $admin = $stmt->fetch();

        if ($admin) {
            $_SESSION['admin'] = $admin['username'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php" class="navLogo">
                    <p>اكتشف السعودية</p>
                </a></li>
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href="gallery.php">معرض المناطق</a></li>
            <li><a href="login.php">دخول المشرف</a></li>
            <li>
                <button type="button" class="theme-toggle" onclick="changeTheme()">الوضع الداكن</button>
            </li>
        </ul>
    </nav>

    <?php if (isset($_GET['message']) && $_GET['message'] == "logout"): ?>
        <p class="success-message">تم تسجيل الخروج بنجاح</p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <section class="login-section">
        <form method="POST" action="login.php">
            <h1>تسجيل دخول المشرف</h1>

            <div class="input-field">
                <label>اسم المستخدم</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-field">
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">دخول</button>
        </form>
    </section>

    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>

    <script src="public/js/main.js"></script>
</body>

</html>