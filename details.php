<?php
require 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("404 صفحة غير موجودة");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM places WHERE id = ?");
$stmt->execute([$id]);
$place = $stmt->fetch();

if (!$place) {
    die("منطقة غير موجودة.");
}

$landmarks = explode('،', $place['landmarks']);


?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>التفاصيل</title>
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


    <section class="details-section-card">
        <img src="public/images/<?php echo htmlspecialchars($place['image']); ?>"
            alt="<?php echo htmlspecialchars($place['name']); ?>" class="details-main-image">

        <div class="details-section-card-content">
            <h1><?php echo htmlspecialchars($place['name']); ?></h1>
            <p><?php echo htmlspecialchars($place['region']); ?></p>
            <p><?php echo htmlspecialchars($place['category']); ?></p>

            <div class="details-info">
                <h2>نبذة عن المنطقة</h2>
                <p><?php echo htmlspecialchars($place['full_description']); ?></p>
            </div>

            <div class="details-info">
                <h2>أبرز المعالم</h2>
                <ul>
                        <?php foreach ($landmarks as $landmark): ?>
                        <li><?php echo htmlspecialchars(trim($landmark)); ?></li>
                        <?php endforeach; ?>
                </ul>
            </div>

            <div class="details-info">
                <h2>معرض الصور</h2>
                <div class="details-images">
                        <?php if (!empty($place['image_2'])): ?>
                        <img src="public/images/<?php echo htmlspecialchars($place['image_2']); ?>" alt="">
                        <?php endif; ?>

                        <?php if (!empty($place['image_3'])): ?>
                        <img src="public/images/<?php echo htmlspecialchars($place['image_3']); ?>" alt="">
                        <?php endif; ?>
                </div>
            </div>

            <a href="gallery.php" class="btn">العودة للمعرض</a>
        </div>
    </section>



    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>
    <script src="public/js/main.js"></script>
</body>

</html>