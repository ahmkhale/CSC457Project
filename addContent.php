<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$error = "";

function uploadImage($inputName, $prefix = "")
{
    if (empty($_FILES[$inputName]['name'])) {
        return "";
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $extension = strtolower(pathinfo($_FILES[$inputName]['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowed)) {
        return false;
    }

    $uploadDir = "public/images/";
    $fileName = $prefix . uniqid() . "." . $extension;
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $filePath)) {
        return $fileName;
    }

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $region = trim($_POST['region']);
    $category = trim($_POST['category']);
    $short_description = trim($_POST['short_description']);
    $full_description = trim($_POST['full_description']);
    $landmarks = trim($_POST['landmarks']);

    if (
        empty($name) ||
        empty($region) ||
        empty($category) ||
        empty($short_description) ||
        empty($full_description) ||
        empty($landmarks)
    ) {
        $error = "توجد حقول فارغة.";
    } else {
        $image = uploadImage("image");

        if ($image === "") {
            $error = "الرجاء رفع الصورة الرئيسية.";
        } elseif ($image === false) {
            $error = "نوع الصورة غير مسموح أو حدث خطأ أثناء الرفع.";
        } else {
            $image_2 = uploadImage("image_2", "2_");
            $image_3 = uploadImage("image_3", "3_");

            if ($image_2 === false || $image_3 === false) {
                $error = "نوع إحدى الصور غير مسموح أو حدث خطأ أثناء الرفع.";
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
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة مكان</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>

    <nav class="navbar">
        <ul>
            <a href="dashboard.php" class="navLogo">
                <p>لوحة التحكم</p>
            </a>
            <li><a href="dashboard.php">الرئيسية</a></li>
            <li><a href="addContent.php">إضافة مكان</a></li>
            <li><a href="logout.php" class="btn logout-btn">تسجيل الخروج</a></li>
        </ul>
    </nav>

    <section class="admin-section">
        <h1>إضافة مكان جديد</h1>

        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="addContent.php" enctype="multipart/form-data" class="admin-form">

            <div class="input-field">
                <label>اسم المنطقة أو المدينة *</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            </div>

            <div class="input-field">
                <label>الصورة الرئيسية *</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <div class="input-field">
                <label>المنطقة *</label>
                <input type="text" name="region" required
                    value="<?php echo htmlspecialchars($_POST['region'] ?? ''); ?>">
            </div>

            <div class="input-field">
                <label>التصنيف *</label>
                <select name="category" required>
                    <option value="">اختر التصنيف</option>
                    <option value="شمالية" <?php if (($_POST['category'] ?? '') == 'شمالية')
                        echo 'selected'; ?>>شمالية
                    </option>
                    <option value="شرقية" <?php if (($_POST['category'] ?? '') == 'شرقية')
                        echo 'selected'; ?>>شرقية
                    </option>
                    <option value="وسطى" <?php if (($_POST['category'] ?? '') == 'وسطى')
                        echo 'selected'; ?>>وسطى</option>
                    <option value="غربية" <?php if (($_POST['category'] ?? '') == 'غربية')
                        echo 'selected'; ?>>غربية
                    </option>
                    <option value="جنوبية" <?php if (($_POST['category'] ?? '') == 'جنوبية')
                        echo 'selected'; ?>>جنوبية
                    </option>
                </select>
            </div>

            <div class="input-field">
                <label>وصف مختصر *</label>
                <textarea name="short_description" required
                    cols="64"><?php echo htmlspecialchars($_POST['short_description'] ?? ''); ?></textarea>
            </div>

            <div class="input-field">
                <label>وصف تفصيلي *</label>
                <textarea name="full_description" required
                    cols="64"><?php echo htmlspecialchars($_POST['full_description'] ?? ''); ?></textarea>
            </div>

            <div class="input-field">
                <label>أبرز المعالم *</label>
                <textarea name="landmarks" placeholder="مثال: المصمك، الدرعية، برج المملكة" required
                    cols="64"><?php echo htmlspecialchars($_POST['landmarks'] ?? ''); ?></textarea>
            </div>

            <div class="input-field">
                <label>الصورة الثانية</label>
                <input type="file" name="image_2" accept="image/*">
            </div>

            <div class="input-field">
                <label>الصورة الثالثة</label>
                <input type="file" name="image_3" accept="image/*">
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