<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('produk')->delete();
        
        \DB::table('produk')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kategori_id' => 2,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'combro SEDAP',
                'detail' => '<p>Combro adalah makanan khas Jawa Barat yang terbuat dari parutan singkong yang dibentuk bulat lonjong dan diisi dengan sambal oncom. Rasanya gurih dengan sensasi pedas dari oncom yang difermentasi, membuat combro menjadi camilan favorit saat sore hari ditemani teh hangat.</p>',
                'harga' => '10000.00',
                'stok' => 9003,
                'berat' => 0.5,
                'foto' => '20250502061411_681400432f125.jpeg',
                'created_at' => '2025-05-02 06:14:11',
                'updated_at' => '2025-05-02 07:03:41',
            ),
            1 => 
            array (
                'id' => 7,
                'kategori_id' => 2,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Combro pak Rey',
                'detail' => '<p>Nikmati kelezatan Combro Pedas Buatan Mak Ina! Dibuat dari singkong pilihan dan isian oncom rempah khas keluarga, combro kami renyah di luar dan lembut pedas di dalam. Cocok untuk teman ngopi, oleh-oleh, atau ide jualan Anda!</p>',
                'harga' => '20000.00',
                'stok' => 488,
                'berat' => 0.5,
                'foto' => '20250502070501_68140c2d19fd5.jpg',
                'created_at' => '2025-05-02 07:05:01',
                'updated_at' => '2025-05-02 07:06:04',
            ),
            2 => 
            array (
                'id' => 8,
                'kategori_id' => 2,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Combro Maknyusss',
                'detail' => '<p>Combro itu kayak temen kita yang pendiam tapi ternyata ‘nampol’—luarnya singkong polos, dalemnya oncom pedes banget! Jangan tertipu tampang kalemnya, sekali gigit bisa bikin kamu nyari air minum buru-buru.</p>',
                'harga' => '7000.00',
                'stok' => 4322,
                'berat' => 0.3,
                'foto' => '20250502070549_68140c5dcf4de.jpg',
                'created_at' => '2025-05-02 07:05:49',
                'updated_at' => '2025-05-02 07:05:59',
            ),
            3 => 
            array (
                'id' => 9,
                'kategori_id' => 1,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'brownis TOP',
                'detail' => '<p>Nikmati perpaduan sempurna antara kelembutan dan rasa cokelat pekat dalam setiap gigitan brownies klasik kami. Dibuat dari cokelat premium yang meleleh di mulut, cocok untuk teman ngopi atau pencuci mulut favorit keluarga.</p>',
                'harga' => '120000.00',
                'stok' => 982,
                'berat' => 0.9,
                'foto' => '20250502070654_68140c9e03e1b.jpg',
                'created_at' => '2025-05-02 07:06:54',
                'updated_at' => '2025-05-02 07:10:24',
            ),
            4 => 
            array (
                'id' => 10,
                'kategori_id' => 1,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Brownies Lumerrrr',
                'detail' => '<p>Varian unik brownies kukus dengan lapisan susu, keju creamy di tengahnya. Teksturnya lembut dan lembap, dengan rasa gurih-manis yang bikin ketagihan. Cocok untuk pencinta keju dan cokelat dalam satu hidangan spesial.</p>',
                'harga' => '130000.00',
                'stok' => 762,
                'berat' => 0.4,
                'foto' => '20250502070805_68140ce5226b4.png',
                'created_at' => '2025-05-02 07:08:05',
                'updated_at' => '2025-05-02 07:10:14',
            ),
            5 => 
            array (
                'id' => 11,
                'kategori_id' => 1,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Brownies Chocolate',
                'detail' => '<p>Lelehkan harimu dengan brownies super cokelat yang lembut dan mewah ini! Dibuat dari perpaduan dark chocolate asli dan cokelat bubuk premium, brownies ini punya tekstur fudgy di dalam dan permukaan shiny crust yang menggoda. Setiap gigitan dipenuhi sensasi cokelat lumer yang langsung meleleh di mulut. Cocok dinikmati hangat atau disajikan dengan es krim untuk pengalaman manis yang sempurna. Pilihan tepat untuk pencinta cokelat sejati!</p>',
                'harga' => '128000.00',
                'stok' => 52,
                'berat' => 0.9,
                'foto' => '20250502071001_68140d592075d.jpg',
                'created_at' => '2025-05-02 07:10:01',
                'updated_at' => '2025-05-02 07:10:07',
            ),
            6 => 
            array (
                'id' => 12,
                'kategori_id' => 3,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Dawet Ayu',
                'detail' => '<p>Es Dawet Ayu adalah minuman khas dari Banjarnegara yang memadukan kesegaran santan kental, manisnya gula merah cair, dan kenyalnya cendol hijau dari tepung beras. Disajikan dingin dengan es batu, minuman ini bukan hanya pelepas dahaga, tapi juga membawa nuansa tradisional yang autentik. Aroma wangi pandan dan cita rasa gurih-manisnya cocok dinikmati di segala suasana, terutama di tengah cuaca panas.</p>',
                'harga' => '7000.00',
                'stok' => 476,
                'berat' => 0.4,
                'foto' => '20250502071210_68140ddad5099.jpg',
                'created_at' => '2025-05-02 07:12:10',
                'updated_at' => '2025-05-02 07:14:39',
            ),
            7 => 
            array (
                'id' => 13,
                'kategori_id' => 3,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Dawet Alam surga',
                'detail' => '<p>Rasakan sensasi segar dan nikmat dari <i>Dawet Alam Surga</i>, perpaduan sempurna antara cendol pandan kenyal, santan segar alami, dan gula merah murni yang kental dan harum. Dilengkapi dengan es serut dingin, setiap tegukan menghadirkan kesejukan seperti berada di tengah alam pegunungan yang damai. Minuman tradisional ini cocok untuk dinikmati kapan saja, memberikan rasa manis yang tidak hanya menyegarkan tubuh, tapi juga menenangkan jiwa.</p>',
                'harga' => '10000.00',
                'stok' => 321,
                'berat' => 0.5,
                'foto' => '20250502071330_68140e2aa1ab0.jpg',
                'created_at' => '2025-05-02 07:13:30',
                'updated_at' => '2025-05-02 07:14:33',
            ),
            8 => 
            array (
                'id' => 14,
                'kategori_id' => 3,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'dawet mungil',
                'detail' => '<p>Dawet Munggul adalah sajian tradisional dengan cita rasa khas yang menggugah selera. Dibuat dari bahan alami seperti cendol pandan lembut, santan segar, dan gula aren asli yang legit, Dawet Munggul menghadirkan rasa otentik dari warisan kuliner Nusantara. Setiap gelasnya disajikan dengan es batu yang menyegarkan, sempurna untuk menemani hari-harimu yang panas atau sekadar melepas rindu pada minuman khas daerah.</p>',
                'harga' => '5000.00',
                'stok' => 900,
                'berat' => 0.2,
                'foto' => '20250502071420_68140e5c16768.jpg',
                'created_at' => '2025-05-02 07:14:20',
                'updated_at' => '2025-05-02 07:14:26',
            ),
            9 => 
            array (
                'id' => 15,
                'kategori_id' => 4,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Mochi Hanabira',
            'detail' => '<p><strong>Hanabira Mochi</strong> adalah kue mochi tradisional Jepang yang biasanya disajikan saat Tahun Baru. Kue ini memiliki bentuk menyerupai kelopak bunga (hanabira) dengan tampilan unik: mochi putih tipis yang dibungkus melengkung dan sedikit transparan, memperlihatkan isian berwarna merah muda di dalamnya.</p><p><strong>Tekstur &amp; Rasa</strong>: Lembut, manis ringan, dan sedikit gurih dari akar burdock.</p>',
                'harga' => '45000.00',
                'stok' => 345,
                'berat' => 0.3,
                'foto' => '20250502073429_681413155e9cc.png',
                'created_at' => '2025-05-02 07:34:30',
                'updated_at' => '2025-05-02 07:35:53',
            ),
            10 => 
            array (
                'id' => 16,
                'kategori_id' => 4,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Mochi YummY!!',
                'detail' => '<p><strong>Mochi Yummy</strong> adalah camilan mochi kekinian dengan tekstur kenyal, lembut, dan isian manis yang menggoda selera. Dibuat dari tepung ketan pilihan, Mochi Yummy hadir dalam berbagai rasa dan warna menarik seperti cokelat, stroberi, matcha, dan keju, cocok dinikmati kapan saja sebagai teman santai atau oleh-oleh.</p>',
                'harga' => '80000.00',
                'stok' => 90,
                'berat' => 0.3,
                'foto' => '20250502073715_681413bbb1eea.png',
                'created_at' => '2025-05-02 07:37:16',
                'updated_at' => '2025-05-02 07:38:37',
            ),
            11 => 
            array (
                'id' => 17,
                'kategori_id' => 4,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'mochi buatan Emak',
                'detail' => '<p><strong>Mochi Buatan Emak</strong> adalah mochi rumahan yang dibuat dengan penuh cinta, menggunakan resep tradisional dan bahan pilihan. Teksturnya kenyal, rasanya manis pas, dan hadir dengan isian klasik seperti kacang, cokelat, atau kelapa, memberikan cita rasa nostalgia yang hangat dan otentik — persis seperti buatan tangan ibu di rumah.</p>',
                'harga' => '30000.00',
                'stok' => 456,
                'berat' => 0.3,
                'foto' => '20250502073824_681414002e4d8.jpg',
                'created_at' => '2025-05-02 07:38:24',
                'updated_at' => '2025-05-02 07:38:31',
            ),
            12 => 
            array (
                'id' => 18,
                'kategori_id' => 5,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'wingko  lamongan',
                'detail' => '<p><strong>Wingko Klasik</strong>, camilan khas Babat, Lamongan yang terbuat dari kelapa parut, tepung ketan, dan gula, dipanggang hingga harum dan legit. Teksturnya padat namun lembut, dengan rasa manis gurih yang membangkitkan kenangan masa kecil di kampung halaman.</p>',
                'harga' => '25000.00',
                'stok' => 76,
                'berat' => 0.8,
                'foto' => '20250502074033_681414816ad20.jpeg',
                'created_at' => '2025-05-02 07:40:33',
                'updated_at' => '2025-05-02 07:42:26',
            ),
            13 => 
            array (
                'id' => 19,
                'kategori_id' => 5,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Wingko khas Babat',
                'detail' => '<p><strong>Wingko Rasa Baru</strong>, inovasi dari jajanan tradisional yang tetap mempertahankan cita rasa asli, namun dikemas lebih modern. Tersedia dalam varian original, pandan, dan keju, cocok jadi teman ngopi atau oleh-oleh khas yang tak lekang oleh zaman.</p>',
                'harga' => '15000.00',
                'stok' => 488,
                'berat' => 0.6,
                'foto' => '20250502074126_681414b663420.jpg',
                'created_at' => '2025-05-02 07:41:26',
                'updated_at' => '2025-05-03 12:12:18',
            ),
            14 => 
            array (
                'id' => 20,
                'kategori_id' => 5,
                'user_id' => 1,
                'status' => 1,
                'nama_produk' => 'Wingko Babat',
                'detail' => '<p>Wingko adalah kue kelapa berbahan dasar tepung ketan dan parutan kelapa, dipanggang hingga kecokelatan. Rasanya manis gurih, pas untuk camilan sore atau suguhan keluarga.</p>',
                'harga' => '25000.00',
                'stok' => 56,
                'berat' => 0.7,
                'foto' => '20250502074208_681414e0bccf1.jpg',
                'created_at' => '2025-05-02 07:42:08',
                'updated_at' => '2025-05-02 07:42:14',
            ),
        ));
        
        
    }
}