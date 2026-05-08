<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="navLogo">
            <p>اكتشف السعودية</p>
        </a>
        <ul>
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
            <h1>أهلاً بكم في السعودية</h1>
            <p>ابدأ رحلتك لاكتشاف مناطق المملكة</p>
            <a href="gallery.php" class="btn">اكتشف المزيد</a>
        </div>
    </section>

    <section class="info">
        <div class="info-box">
            <h2>الهدف</h2>
            <p>الاطلاع على جمال معالم المملكة</p>
        </div>
        <div class="info-box">
            <h2>المناطق المعروضة</h2>
            <p>الرياض، جدة، الدمام</p>
        </div>
        <div class="info-box">
            <h2>التفاصيل</h2>
            <p>عرض صور ومعلومات عن المناطق</p>
        </div>
    </section>

    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>
    <script src="public/js/main.js"></script>
</body>

</html>