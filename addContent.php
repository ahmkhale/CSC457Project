<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $region = trim($_POST['region']);
    $category = trim($_POST['category']);
    $short_description = trim($_POST['short_description']);
    $full_description = trim($_POST['full_description']);
    $landmarks = trim($_POST['landmarks']);
    $image = trim($_POST['image']);
    $image_2 = trim($_POST['image_2']);
    $image_3 = trim($_POST['image_3']);

    if (
        empty($name) ||
        empty($region) ||
        empty($category) ||
        empty($short_description) ||
        empty($full_description) ||
        empty($landmarks) ||
        empty($image)
    ) {
        $error = "الرجاء تعبئة جميع الحقول المطلوبة";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO places 
            (name, region, category, short_description, full_description, landmarks, image, image_2, image_3)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $name,
            $region,
            $category,
            $short_description,
            $full_description,
            $landmarks,
            $image,
            $image_2,
            $image_3
        ]);

        header("Location: dashboard.php?message=added");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة محتوى</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <nav class="navbar">
        <a href="dashboard.php" class="navLogo">
            <p>لوحة التحكم</p>
        </a>
        <ul>
            <li><a href="dashboard.php">الرئيسية</a></li>
            <li><a href="addContent.php">إضافة محتوى</a></li>
            <li><a href="logout.php">تسجيل الخروج</a></li>
        </ul>
    </nav>

    <section class="admin-section">
        <h1>إضافة محتوى جديد</h1>

        <?php if (!empty($error)): ?>
            <p class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="addContent.php" class="admin-form">
            <div class="input-field">
                <label>اسم المنطقة أو المدينة *</label>
                <input type="text" name="name" required>
            </div>

            <div class="input-field">
                <label>المنطقة *</label>
                <input type="text" name="region" required>
            </div>

            <div class="input-field">
                <label>التصنيف *</label>
                <input type="text" name="category" required>
            </div>

            <div class="input-field">
                <label>وصف مختصر *</label>
                <textarea name="short_description" required></textarea>
            </div>

            <div class="input-field">
                <label>وصف تفصيلي *</label>
                <textarea name="full_description" required></textarea>
            </div>

            <div class="input-field">
                <label>أبرز المعالم *</label>
                <textarea name="landmarks" placeholder="مثال: المصمك، برج المملكة، الدرعية التاريخية"
                    required></textarea>
            </div>

            <div class="input-field">
                <label>اسم الصورة الرئيسية *</label>
                <input type="text" name="image" placeholder="example.jpg" required>
            </div>

            <div class="input-field">
                <label>اسم الصورة الثانية</label>
                <input type="text" name="image_2" placeholder="example_2.jpg">
            </div>

            <div class="input-field">
                <label>اسم الصورة الثالثة</label>
                <input type="text" name="image_3" placeholder="example_3.jpg">
            </div>

            <div class="button-group">
                <button type="submit" class="btn">إضافة</button>
                <a href="dashboard.php" class="btn">إلغاء</a>
            </div>
        </form>
    </section>

    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>

</body>

</html>