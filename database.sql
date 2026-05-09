CREATE DATABASE IF NOT EXISTS discoverSaudi
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE discoverSaudi;

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE places (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  region VARCHAR(100) NOT NULL,
  category VARCHAR(100) NOT NULL,
  short_description TEXT NOT NULL,
  full_description TEXT NOT NULL,
  landmarks TEXT NOT NULL,
  image VARCHAR(255) NOT NULL,
  image_2 VARCHAR(255),
  image_3 VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password)
VALUES ('admin', '12345');

INSERT INTO places 
(name, region, category, short_description, full_description, landmarks, image, image_2, image_3)
VALUES
('الرياض', 'منطقة الرياض', 'مدينة', 'عاصمة المملكة العربية السعودية.', 'تعد الرياض من أهم مدن المملكة، وتجمع بين التاريخ والتطور الحديث.', 'المصمك، برج المملكة، الدرعية التاريخية', 'riyadh.jpg', 'riyadh_2.jpg', 'riyadh_3.jpg'),
('مكة المكرمة', 'منطقة مكة المكرمة', 'مدينة مقدسة', 'أقدس مدينة في الإسلام.', 'تضم مكة المكرمة المسجد الحرام والكعبة المشرفة ويقصدها المسلمون للحج والعمرة.', 'المسجد الحرام، الكعبة، جبل النور', 'makkah.jpg', 'makkah_2.jpg', 'makkah_3.jpg'),
('العلا', 'منطقة المدينة المنورة', 'موقع تاريخي', 'منطقة تاريخية مشهورة بالآثار.', 'تتميز العلا بتكويناتها الصخرية ومواقعها الأثرية مثل مدائن صالح.', 'مدائن صالح، جبل الفيل، البلدة القديمة', 'alula.jpg', 'alula_2.jpg', 'alula_3.jpg');
('تبوك', 'منطقة تبوك', 'موقع تاريخي', 'منطقة تاريخية مشهورة بالآثار.', 'تتميز العلا بتكويناتها الصخرية ومواقعها الأثرية مثل مدائن صالح.', 'مدائن صالح، جبل الفيل، البلدة القديمة', 'alula.jpg', 'alula_2.jpg', 'alula_3.jpg');
