<?php
require 'db.php';

$stmt = $pdo->query('SELECT name FROM places ORDER BY id ASC');
$places = $stmt->fetchAll();

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

    <section>
        <div class="hero">
            <img src="public/images/Saudiv3.jpg" alt="home">
            <h1>أهلاً بكم في السعودية</h1>
            <p>ابدأ رحلتك لاكتشاف مناطق المملكة</p>
            <a href="gallery.php" class="btn">اكتشف المزيد</a>
        </div>
    </section>

    <section class="info">
        <div class="info-box">
            <h2>الهدف</h2>
            <p>الاطلاع على جمال معالم المملكة</p>
            <a href="gallery.php" class="btn">اكتشف المزيد</a>
        </div>
        <div class="info-box">
            <h2>المناطق المعروضة</h2>
            <p>
                <?php
                $names = [];

                foreach ($places as $place) {
                    $names[] = htmlspecialchars($place['name']);
                }

                echo implode('، ', $names);
                ?>
            </p>
            <a href="gallery.php" class="btn">اكتشف المزيد</a>
        </div>
        <div class="info-box">
            <h2>التفاصيل</h2>
            <p>عرض صور ومعلومات عن المناطق</p>
            <a href="gallery.php" class="btn">اكتشف المزيد</a>
        </div>
    </section>

    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>
    <script src="public/js/main.js"></script>
</body>

</html>