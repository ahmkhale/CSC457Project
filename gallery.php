<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM places ORDER BY id ASC');
$places = $stmt->fetchAll();

$categoryStmt = $pdo->query('SELECT DISTINCT category FROM places ORDER BY category ASC');
$categories = $categoryStmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معرض المناطق</title>
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
            <h1>معرض المناطق</h1>
            <p>ابحث أو صف النتائج، ثم اضغط على أي منطقة للانتقال إلى صفحة التفاصيل.</p>
        </div>
    </section>


    <section class="search-section">
        <input type="text" id="searchInput" placeholder="ابحث عن منطقة...">

        <div>
            <select id="categoryFilter">
                <option value="all">كل المناطق</option>

                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['category']); ?>">
                        <?php echo htmlspecialchars($category['category']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <p>عدد النتائج: <span id="resultsCount"><?php echo count($places); ?></span></p>
    </section>

    <section class="gallery">
        <?php foreach ($places as $place): ?>
            <div class="card" data-category="<?php echo htmlspecialchars($place['category']); ?>">
                <img src="public/images/<?php echo htmlspecialchars($place['image']); ?>"
                    alt="<?php echo htmlspecialchars($place['name']); ?>">

                <p>
                    <?php echo htmlspecialchars($place['category']); ?>
                </p>

                <h3>
                    <?php echo htmlspecialchars($place['name']); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars($place['short_description']); ?>
                </p>

                <a href="details.php?id=<?php echo $place['id']; ?>" class="btn">
                    اكتشف المزيد
                </a>
            </div>
        <?php endforeach ?>
    </section>


    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>
    <script src="public/js/main.js"></script>
</body>

</html>