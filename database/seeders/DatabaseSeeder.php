<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample users
        $admin = User::create([
            'name' => 'Admin MindClash',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'class' => null,
        ]);

        $rani = User::create([
            'name' => 'Rani Safira',
            'email' => 'rani@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'class' => '7A',
        ]);

        $budi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'class' => '7A',
        ]);

        $siti = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'class' => '7A',
        ]);

        $ahmad = User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'class' => '7A',
        ]);

        $dina = User::create([
            'name' => 'Dina Wijaya',
            'email' => 'dina@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'class' => '7A',
        ]);

        // Create categories for SMP (Junior High School)
        $math = Category::create([
            'name' => 'Matematika',
            'description' => 'Aljabar, Geometri, Trigonometri, dan Statistika',
        ]);

        $science = Category::create([
            'name' => 'IPA (Sains)',
            'description' => 'Fisika, Kimia, dan Biologi',
        ]);

        $indonesian = Category::create([
            'name' => 'Bahasa Indonesia',
            'description' => 'Tata Bahasa, Sastra, dan Apresiasi Bacaan',
        ]);

        $english = Category::create([
            'name' => 'Bahasa Inggris',
            'description' => 'Grammar, Vocabulary, dan Conversation',
        ]);

        $social = Category::create([
            'name' => 'IPS (Ilmu Pengetahuan Sosial)',
            'description' => 'Sejarah, Geografi, Ekonomi, dan Sosiologi',
        ]);

        $art = Category::create([
            'name' => 'Seni & Budaya',
            'description' => 'Seni Rupa, Seni Musik, dan Tari',
        ]);

        $pe = Category::create([
            'name' => 'Pendidikan Jasmani',
            'description' => 'Olahraga dan Kesehatan',
        ]);

        $computer = Category::create([
            'name' => 'Teknologi Informasi',
            'description' => 'Komputer, Internet, dan Digital Literacy',
        ]);

        // ==================== MATEMATIKA ====================
        Question::create(['category_id' => $math->id, 'question_text' => 'Berapa hasil dari 5 + 3 × 2?', 'option_a' => '11', 'option_b' => '16', 'option_c' => '13', 'option_d' => '10', 'correct_answer' => 'A']);
        Question::create(['category_id' => $math->id, 'question_text' => 'Jika x = 5, berapa nilai dari 2x + 3?', 'option_a' => '10', 'option_b' => '13', 'option_c' => '8', 'option_d' => '15', 'correct_answer' => 'B']);
        Question::create(['category_id' => $math->id, 'question_text' => 'Luas lingkaran dengan jari-jari 7 cm adalah?', 'option_a' => '154 cm²', 'option_b' => '144 cm²', 'option_c' => '176 cm²', 'option_d' => '196 cm²', 'correct_answer' => 'A']);
        Question::create(['category_id' => $math->id, 'question_text' => 'Berapa hasil dari 12 ÷ 3 - 2?', 'option_a' => '2', 'option_b' => '6', 'option_c' => '3', 'option_d' => '4', 'correct_answer' => 'A']);
        Question::create(['category_id' => $math->id, 'question_text' => '20% dari 150 adalah?', 'option_a' => '20', 'option_b' => '30', 'option_c' => '35', 'option_d' => '40', 'correct_answer' => 'B']);
        Question::create(['category_id' => $math->id, 'question_text' => 'Keliling persegi dengan sisi 5 cm adalah?', 'option_a' => '15 cm', 'option_b' => '20 cm', 'option_c' => '25 cm', 'option_d' => '30 cm', 'correct_answer' => 'B']);
        Question::create(['category_id' => $math->id, 'question_text' => 'Berapakah √144?', 'option_a' => '10', 'option_b' => '11', 'option_c' => '12', 'option_d' => '13', 'correct_answer' => 'C']);
        Question::create(['category_id' => $math->id, 'question_text' => 'Hasil dari (2³) × (2²) adalah?', 'option_a' => '2⁵', 'option_b' => '2⁶', 'option_c' => '4⁵', 'option_d' => '4⁶', 'correct_answer' => 'A']);

        // ==================== IPA (SAINS) ====================
        Question::create(['category_id' => $science->id, 'question_text' => 'Apa simbol kimia untuk Emas?', 'option_a' => 'Au', 'option_b' => 'Ag', 'option_c' => 'Fe', 'option_d' => 'Cu', 'correct_answer' => 'A']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Planet mana yang terdekat dengan Matahari?', 'option_a' => 'Venus', 'option_b' => 'Merkurius', 'option_c' => 'Mars', 'option_d' => 'Bumi', 'correct_answer' => 'B']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Berapa jumlah tulang pada tubuh manusia dewasa?', 'option_a' => '186', 'option_b' => '206', 'option_c' => '216', 'option_d' => '196', 'correct_answer' => 'B']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Fotosintesis adalah proses yang menghasilkan?', 'option_a' => 'Protein', 'option_b' => 'Karbohidrat', 'option_c' => 'Lemak', 'option_d' => 'Mineral', 'correct_answer' => 'B']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Apa warna darah setelah oksigen dihilangkan?', 'option_a' => 'Merah gelap', 'option_b' => 'Biru', 'option_c' => 'Hitam', 'option_d' => 'Ungu', 'correct_answer' => 'A']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Satuan kecepatan dalam Sistem Internasional adalah?', 'option_a' => 'km/h', 'option_b' => 'm/s', 'option_c' => 'cm/s', 'option_d' => 'mm/h', 'correct_answer' => 'B']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Berapa pH air murni pada suhu 25°C?', 'option_a' => '6', 'option_b' => '7', 'option_c' => '8', 'option_d' => '9', 'correct_answer' => 'B']);
        Question::create(['category_id' => $science->id, 'question_text' => 'Organ yang mengedarkan darah adalah?', 'option_a' => 'Paru-paru', 'option_b' => 'Jantung', 'option_c' => 'Ginjal', 'option_d' => 'Hati', 'correct_answer' => 'B']);

        // ==================== BAHASA INDONESIA ====================
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Manakah yang merupakan kata benda?', 'option_a' => 'Lari', 'option_b' => 'Merah', 'option_c' => 'Meja', 'option_d' => 'Cepat', 'correct_answer' => 'C']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Sinonim dari kata "besar" adalah?', 'option_a' => 'Kecil', 'option_b' => 'Raksasa', 'option_c' => 'Panjang', 'option_d' => 'Lebar', 'correct_answer' => 'B']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Apa makna dari peribahasa "seperti pucuk dicinta ulam tiba"?', 'option_a' => 'Keberuntungan datang dengan tiba-tiba', 'option_b' => 'Keinginan terpenuhi dengan sempurna', 'option_c' => 'Seseorang datang tanpa diundang', 'option_d' => 'Makanan datang dengan mudah', 'correct_answer' => 'B']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Kalimat yang ditulis dengan benar adalah?', 'option_a' => 'Dia pergi ke sekolah dengan berjalan kaki', 'option_b' => 'Dia pergi ke sekolah dengan berjalan kaki dengan hati senang', 'option_c' => 'Dia pergi sekolah berjalan kaki', 'option_d' => 'Pergi ke sekolah dengan berjalan kaki dia', 'correct_answer' => 'A']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Jenis puisi modern yang terdiri dari 3 baris adalah?', 'option_a' => 'Pantun', 'option_b' => 'Haiku', 'option_c' => 'Syair', 'option_d' => 'Soneta', 'correct_answer' => 'B']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Antonim dari kata "gelap" adalah?', 'option_a' => 'Sendu', 'option_b' => 'Terang', 'option_c' => 'Sedih', 'option_d' => 'Kusam', 'correct_answer' => 'B']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Penulisan judul yang benar adalah?', 'option_a' => 'petualangan di hutan rimba', 'option_b' => 'Petualangan Di Hutan Rimba', 'option_c' => 'PETUALANGAN DI HUTAN RIMBA', 'option_d' => 'petualangan DI hutan rimba', 'correct_answer' => 'B']);
        Question::create(['category_id' => $indonesian->id, 'question_text' => 'Bagian cerita yang menggambarkan waktu dan tempat adalah?', 'option_a' => 'Exposisi', 'option_b' => 'Komplikasi', 'option_c' => 'Resolusi', 'option_d' => 'Klimaks', 'correct_answer' => 'A']);

        // ==================== BAHASA INGGRIS ====================
        Question::create(['category_id' => $english->id, 'question_text' => 'Apa arti dari kata "Benevolent"?', 'option_a' => 'Jahat', 'option_b' => 'Baik hati', 'option_c' => 'Malas', 'option_d' => 'Kaya', 'correct_answer' => 'B']);
        Question::create(['category_id' => $english->id, 'question_text' => 'Kalimat mana yang benar secara grammar?', 'option_a' => 'She go to school', 'option_b' => 'She goes to school', 'option_c' => 'She going to school', 'option_d' => 'She will goes to school', 'correct_answer' => 'B']);
        Question::create(['category_id' => $english->id, 'question_text' => 'Apa persamaan kata untuk "Big"?', 'option_a' => 'Small', 'option_b' => 'Huge', 'option_c' => 'Tiny', 'option_d' => 'Little', 'correct_answer' => 'B']);
        Question::create(['category_id' => $english->id, 'question_text' => 'Tense mana yang digunakan untuk aksi rutin?', 'option_a' => 'Present Continuous', 'option_b' => 'Present Perfect', 'option_c' => 'Present Simple', 'option_d' => 'Past Simple', 'correct_answer' => 'C']);
        Question::create(['category_id' => $english->id, 'question_text' => 'Apa bentuk past tense dari "Eat"?', 'option_a' => 'Eated', 'option_b' => 'Eating', 'option_c' => 'Ate', 'option_d' => 'Eaten', 'correct_answer' => 'C']);
        Question::create(['category_id' => $english->id, 'question_text' => '"I have been studying for 3 hours" menggunakan tense apa?', 'option_a' => 'Simple Past', 'option_b' => 'Present Perfect Continuous', 'option_c' => 'Past Perfect', 'option_d' => 'Simple Present', 'correct_answer' => 'B']);
        Question::create(['category_id' => $english->id, 'question_text' => 'Apa arti dari "Procrastinate"?', 'option_a' => 'Bekerja cepat', 'option_b' => 'Menunda pekerjaan', 'option_c' => 'Bersemangat bekerja', 'option_d' => 'Menyelesaikan pekerjaan', 'correct_answer' => 'B']);
        Question::create(['category_id' => $english->id, 'question_text' => '"If I were you, I would go there" adalah contoh dari?', 'option_a' => 'First Conditional', 'option_b' => 'Second Conditional', 'option_c' => 'Third Conditional', 'option_d' => 'Mixed Conditional', 'correct_answer' => 'B']);

        // ==================== IPS (ILMU PENGETAHUAN SOSIAL) ====================
        Question::create(['category_id' => $social->id, 'question_text' => 'Berapa luas wilayah Indonesia?', 'option_a' => '1.919.440 km²', 'option_b' => '1.500.000 km²', 'option_c' => '2.000.000 km²', 'option_d' => '1.200.000 km²', 'correct_answer' => 'A']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Ibu kota negara Indonesia adalah?', 'option_a' => 'Yogyakarta', 'option_b' => 'Jakarta', 'option_c' => 'Nusantara', 'option_d' => 'Surabaya', 'correct_answer' => 'B']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Proklamasi kemerdekaan Indonesia ditanda tangani tanggal?', 'option_a' => '17 Agustus 1944', 'option_b' => '17 Agustus 1945', 'option_c' => '1 Juni 1945', 'option_d' => '19 Agustus 1945', 'correct_answer' => 'B']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Siapa yang disebut sebagai "Bapak Pancasila"?', 'option_a' => 'Soekarno', 'option_b' => 'Soeharto', 'option_c' => 'Mohammad Hatta', 'option_d' => 'Moh. Yamin', 'correct_answer' => 'A']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Benua terbesar di dunia adalah?', 'option_a' => 'Afrika', 'option_b' => 'Amerika', 'option_c' => 'Asia', 'option_d' => 'Eropa', 'correct_answer' => 'C']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Garis bujur 0° yang dilalui Greenwich disebut?', 'option_a' => 'Garis Khatulistiwa', 'option_b' => 'Meridian Greenwich', 'option_c' => 'Garis Balik', 'option_d' => 'Meridian Bujur', 'correct_answer' => 'B']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Mata uang Indonesia adalah?', 'option_a' => 'Dolar', 'option_b' => 'Rupiah', 'option_c' => 'Yuan', 'option_d' => 'Baht', 'correct_answer' => 'B']);
        Question::create(['category_id' => $social->id, 'question_text' => 'Sistem pemerintahan Indonesia adalah?', 'option_a' => 'Kerajaan', 'option_b' => 'Monarkhi', 'option_c' => 'Republik', 'option_d' => 'Komunis', 'correct_answer' => 'C']);

        // ==================== SENI & BUDAYA ====================
        Question::create(['category_id' => $art->id, 'question_text' => 'Alat musik tradisional dari Bali adalah?', 'option_a' => 'Gamelan', 'option_b' => 'Angklung', 'option_c' => 'Wayang', 'option_d' => 'Rebana', 'correct_answer' => 'A']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Wayang kulit berasal dari?', 'option_a' => 'Jawa Barat', 'option_b' => 'Jawa Tengah', 'option_c' => 'Jawa Timur', 'option_d' => 'Sumatera', 'correct_answer' => 'B']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Apa yang dimaksud dengan seni rupa?', 'option_a' => 'Seni yang menggunakan suara', 'option_b' => 'Seni yang dapat dilihat dan diraba', 'option_c' => 'Seni yang bergerak', 'option_d' => 'Seni yang menggunakan perkataan', 'correct_answer' => 'B']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Tarian daerah dari Sumatra Utara adalah?', 'option_a' => 'Tari Legong', 'option_b' => 'Tari Saman', 'option_c' => 'Tari Topeng', 'option_d' => 'Tari Keraton', 'correct_answer' => 'B']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Batik adalah warisan budaya yang berasal dari?', 'option_a' => 'Indonesia', 'option_b' => 'Malaysia', 'option_c' => 'Thailand', 'option_d' => 'Filipina', 'correct_answer' => 'A']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Alat musik pukul tradisional Jawa adalah?', 'option_a' => 'Angklung', 'option_b' => 'Suling', 'option_c' => 'Gong', 'option_d' => 'Rebab', 'correct_answer' => 'C']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Arsitektur tradisional Minangkabau ditandai dengan?', 'option_a' => 'Atap segitiga', 'option_b' => 'Atap runcing yang melengkung ke atas', 'option_c' => 'Atap datar', 'option_d' => 'Atap setengah lingkaran', 'correct_answer' => 'B']);
        Question::create(['category_id' => $art->id, 'question_text' => 'Motif batik Parang Kusuma berasal dari?', 'option_a' => 'Cirebon', 'option_b' => 'Yogyakarta', 'option_c' => 'Solo', 'option_d' => 'Lasem', 'correct_answer' => 'C']);

        // ==================== PENDIDIKAN JASMANI ====================
        Question::create(['category_id' => $pe->id, 'question_text' => 'Berapa jumlah pemain dalam satu tim bola voli?', 'option_a' => '5', 'option_b' => '6', 'option_c' => '7', 'option_d' => '8', 'correct_answer' => 'B']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Panjang lapangan bola voli adalah?', 'option_a' => '18 meter', 'option_b' => '20 meter', 'option_c' => '24 meter', 'option_d' => '30 meter', 'correct_answer' => 'A']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Berapa jumlah pemain dalam satu tim sepak bola?', 'option_a' => '10', 'option_b' => '11', 'option_c' => '12', 'option_d' => '13', 'correct_answer' => 'B']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Organisasi internasional untuk olahraga adalah?', 'option_a' => 'UNESCO', 'option_b' => 'IOC', 'option_c' => 'UNICEF', 'option_d' => 'WHO', 'correct_answer' => 'B']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Olahraga senam ketika menggunakan alat adalah?', 'option_a' => 'Senam Lantai', 'option_b' => 'Senam Artistik', 'option_c' => 'Senam Ritmik', 'option_d' => 'Senam Aerobik', 'correct_answer' => 'B']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Berapa lama durasi satu babak dalam pertandingan bola basket?', 'option_a' => '10 menit', 'option_b' => '12 menit', 'option_c' => '15 menit', 'option_d' => '20 menit', 'correct_answer' => 'B']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Cabang olahraga yang menggunakan raket adalah?', 'option_a' => 'Bulu tangkis', 'option_b' => 'Tenis', 'option_c' => 'Tenis meja', 'option_d' => 'Semua benar', 'correct_answer' => 'D']);
        Question::create(['category_id' => $pe->id, 'question_text' => 'Kesehatan adalah kondisi yang?', 'option_a' => 'Hanya bebas dari penyakit', 'option_b' => 'Sejahtera secara fisik, mental, dan sosial', 'option_c' => 'Hanya kuat fisik', 'option_d' => 'Hanya sehat jiwa', 'correct_answer' => 'B']);

        // ==================== TEKNOLOGI INFORMASI ====================
        Question::create(['category_id' => $computer->id, 'question_text' => 'Apa kepanjangan dari HTML?', 'option_a' => 'Hyper Text Markup Language', 'option_b' => 'High Text Markup Language', 'option_c' => 'Home Tool Markup Language', 'option_d' => 'Hyperlinks and Text Markup Language', 'correct_answer' => 'A']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'Perangkat lunak (Software) adalah?', 'option_a' => 'Komputer', 'option_b' => 'Program dan aplikasi', 'option_c' => 'Monitor', 'option_d' => 'Keyboard', 'correct_answer' => 'B']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'Internet merupakan singkatan dari?', 'option_a' => 'Internal Network', 'option_b' => 'Inter Network', 'option_c' => 'International Network', 'option_d' => 'Internet Net', 'correct_answer' => 'B']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'Apa kepanjangan dari CPU?', 'option_a' => 'Central Processing Unit', 'option_b' => 'Computer Personal Unit', 'option_c' => 'Central Processor Unit', 'option_d' => 'Control Processing Unit', 'correct_answer' => 'A']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'Sistem operasi yang paling populer di laptop adalah?', 'option_a' => 'Android', 'option_b' => 'Windows', 'option_c' => 'iOS', 'option_d' => 'Linux', 'correct_answer' => 'B']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'RAM adalah memori yang berfungsi untuk?', 'option_a' => 'Penyimpanan data permanen', 'option_b' => 'Memproses data sementara', 'option_c' => 'Menampilkan gambar', 'option_d' => 'Mengeluarkan suara', 'correct_answer' => 'B']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'Kabel yang digunakan untuk menghubungkan komputer ke internet adalah?', 'option_a' => 'Kabel HDMI', 'option_b' => 'Kabel USB', 'option_c' => 'Kabel LAN', 'option_d' => 'Kabel VGA', 'correct_answer' => 'C']);
        Question::create(['category_id' => $computer->id, 'question_text' => 'Platform media sosial yang paling banyak pengguna adalah?', 'option_a' => 'Twitter', 'option_b' => 'Instagram', 'option_c' => 'Facebook', 'option_d' => 'Snapchat', 'correct_answer' => 'C']);

        // ==================== SAMPLE QUIZ RESULTS FOR LEADERBOARD ====================
        QuizResult::create([
            'user_id' => $rani->id,
            'category_id' => $math->id,
            'total_questions' => 8,
            'correct_answers' => 7,
            'score' => 88,
        ]);

        QuizResult::create([
            'user_id' => $rani->id,
            'category_id' => $science->id,
            'total_questions' => 8,
            'correct_answers' => 6,
            'score' => 75,
        ]);

        QuizResult::create([
            'user_id' => $budi->id,
            'category_id' => $math->id,
            'total_questions' => 8,
            'correct_answers' => 8,
            'score' => 100,
        ]);

        QuizResult::create([
            'user_id' => $budi->id,
            'category_id' => $english->id,
            'total_questions' => 8,
            'correct_answers' => 7,
            'score' => 88,
        ]);

        QuizResult::create([
            'user_id' => $siti->id,
            'category_id' => $indonesian->id,
            'total_questions' => 8,
            'correct_answers' => 8,
            'score' => 100,
        ]);

        QuizResult::create([
            'user_id' => $siti->id,
            'category_id' => $math->id,
            'total_questions' => 8,
            'correct_answers' => 6,
            'score' => 75,
        ]);

        QuizResult::create([
            'user_id' => $ahmad->id,
            'category_id' => $math->id,
            'total_questions' => 8,
            'correct_answers' => 7,
            'score' => 88,
        ]);

        QuizResult::create([
            'user_id' => $dina->id,
            'category_id' => $english->id,
            'total_questions' => 8,
            'correct_answers' => 8,
            'score' => 100,
        ]);
    }
}
