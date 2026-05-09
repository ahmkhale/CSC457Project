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


    <section class="details-section-card">
        <img src="public/images/<?php echo htmlspecialchars($place['image']); ?>"
            alt="<?php echo htmlspecialchars($place['name']); ?>" class="details-main-image">

        <div class="details-section-card-content">
            <h2><?php echo htmlspecialchars($place['name']); ?></h2>

            <p><?php echo htmlspecialchars($place['region']); ?></p>
            <p><?php echo htmlspecialchars($place['category']); ?></p>

            <p><?php echo htmlspecialchars($place['short_description']); ?></p>

            <h2>نبذة تفصيلية</h2>
            <p><?php echo htmlspecialchars($place['full_description']); ?></p>

            <h2>أبرز المعالم</h2>
            <ul>
                <?php foreach ($landmarks as $landmark): ?>
                    <li><?php echo htmlspecialchars(trim($landmark)); ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>معرض الصور</h3>
            <div class="details-images">
                <?php if (!empty($place['image_2'])): ?>
                    <img src="public/images/<?php echo htmlspecialchars($place['image_2']); ?>"
                        alt="<?php echo htmlspecialchars($place['image_2']); ?>">
                <?php endif; ?>

                <?php if (!empty($place['image_3'])): ?>
                    <img src="public/images/<?php echo htmlspecialchars($place['image_3']); ?>"
                        alt="<?php echo htmlspecialchars($place['image_3']); ?>">
                <?php endif; ?>

                <?php if (empty($place['image_2']) && empty($place['image_3'])): ?>
                    <p>لا توجد صور الآن</p>
                <?php endif; ?>
            </div>
        </div>

    </section>



    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>
    <script src="public/js/main.js"></script>
</body>

</html>