<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM places ORDER BY id ASC");
$places = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
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
        <h1>إدارة الأماكن</h1>

        <?php if (isset($_GET['message']) && $_GET['message'] == "added"): ?>
            <p class="success-message">تمت إضافة المكان بنجاح</p>
        <?php endif; ?>

        <?php if (isset($_GET['message']) && $_GET['message'] == "updated"): ?>
            <p class="success-message">تم تحديث المكان بنجاح</p>
        <?php endif; ?>

        <?php if (isset($_GET['message']) && $_GET['message'] == "deleted"): ?>
            <p class="success-message">تم حذف المكان بنجاح</p>
        <?php endif; ?>

        <a href="addContent.php" class="btn">إضافة مكان جديد</a>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>الاسم</th>
                    <th>المنطقة</th>
                    <th>التصنيف</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($places as $place): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($place['id']); ?></td>
                        <td><?php echo htmlspecialchars($place['name']); ?></td>
                        <td><?php echo htmlspecialchars($place['region']); ?></td>
                        <td><?php echo htmlspecialchars($place['category']); ?></td>
                        <td>
                            <a href="updateContent.php?id=<?php echo $place['id']; ?>" class="btn">
                                تعديل
                            </a>

                            <a href="deleteContent.php?id=<?php echo $place['id']; ?>" class="btn delete-btn"
                                onclick="return confirm('هل أنت متأكد من حذف هذا المكان')">
                                حذف
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>اكتشف السعودية - جامعة الملك سعود</p>
    </footer>

</body>

</html>