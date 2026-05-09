/*CREATE DATABASE IF NOT EXISTS discover_saudi
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE discover_saudi;
*/
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

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
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO admins (username, password)
VALUES ('admin', '12345');

INSERT INTO places 
(name, region, category, short_description, full_description, landmarks, image, image_2, image_3)
VALUES
(
  'الرياض',
  'منطقة الرياض',
  'وسطى',
  'عاصمة المملكة العربية السعودية.',
  'تعد الرياض من أهم مدن المملكة، وتجمع بين التاريخ والتطور الحديث، وتضم العديد من المعالم الثقافية والاقتصادية.',
  'المصمك، برج المملكة، الدرعية التاريخية',
  'riyadh.jpg',
  'riyadh_2.jpg',
  'riyadh_3.jpg'
),
(
  'مكة المكرمة',
  'منطقة مكة المكرمة',
  'غربية',
  'أقدس مدينة في الإسلام.',
  'تضم مكة المكرمة المسجد الحرام والكعبة المشرفة، ويقصدها المسلمون من مختلف أنحاء العالم لأداء الحج والعمرة.',
  'المسجد الحرام، الكعبة، جبل النور',
  'makkah.jpg',
  'makkah_2.jpg',
  'makkah_3.jpg'
),
(
  'العلا',
  'منطقة المدينة المنورة',
  'غربية',
  'منطقة تاريخية مشهورة بالآثار والتكوينات الصخرية.',
  'تتميز العلا بتاريخها العريق وطبيعتها الفريدة، وتضم مواقع أثرية مهمة مثل مدائن صالح والبلدة القديمة.',
  'مدائن صالح، جبل الفيل، البلدة القديمة',
  'alula.jpg',
  'alula_2.jpg',
  'alula_3.jpg'
),
(
  'تبوك',
  'منطقة تبوك',
  'شمالية',
  'مدينة تقع في شمال غرب المملكة وتتميز بموقعها التاريخي والطبيعي.',
  'تعد تبوك من المناطق المهمة في شمال المملكة، وتتميز بتنوع طبيعتها بين الجبال والسواحل والمواقع التاريخية.',
  'قلعة تبوك، وادي الديسة، شاطئ حقل',
  'tabuk.jpg',
  'tabuk_2.jpg',
  'tabuk_3.jpg'
),
(
  'أبها',
  'منطقة عسير',
  'جنوبية',
  'مدينة سياحية تقع في جنوب المملكة وتتميز بأجوائها المعتدلة.',
  'تعد أبها من أبرز الوجهات السياحية في المملكة، وتشتهر بطبيعتها الجبلية وتراثها العمراني والثقافي.',
  'جبل السودة، قرية رجال ألمع، منتزه عسير الوطني',
  'abha.jpg',
  'abha_2.jpg',
  'abha_3.jpg'
),
(
  'الخبر',
  'المنطقة الشرقية',
  'شرقية',
  'مدينة ساحلية حديثة تقع على الخليج العربي.',
  'تعد الخبر من المدن الحيوية في المنطقة الشرقية، وتشتهر بكورنيشها الجميل وأسواقها وموقعها القريب من الدمام والظهران.',
  'كورنيش الخبر، جسر الملك فهد، الواجهة البحرية',
  'khobar.jpg',
  'khobar_2.jpg',
  'khobar_3.jpg'
);