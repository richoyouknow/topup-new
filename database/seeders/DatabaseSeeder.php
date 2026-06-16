<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin ChampionStore',
                'email' => 'admin@championstore.id',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Seed Default Settings
        $settings = [
            'whatsapp_number' => '628123456789',
            'instagram_link' => 'https://instagram.com/championstore.id',
            'bank_details' => "BCA: 1234567890 a/n ChampionStore\nMandiri: 0987654321 a/n ChampionStore",
            'qris_image' => '',
            'website_logo' => '',
            'website_banner' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 3. Seed Categories
        $categories = [
            [
                'name' => 'Top Up Koin',
                'slug' => 'top-up-koin',
                'description' => 'Top up coin cepat, aman, dan harga terbaik.',
                'image_path' => '/storage/assets/katalog/topup-koin/topup.webp',
            ],
            [
                'name' => 'Joki Live',
                'slug' => 'joki-live',
                'description' => 'Jasa push win dan peningkatan statistik akun.',
                'image_path' => '/storage/assets/katalog/joki-live/joki live hero.webp',
            ],
            [
                'name' => 'Pool Pass',
                'slug' => 'pool-pass',
                'description' => 'Pool Pass dan Elite Pool Pass dengan proses cepat.',
                'image_path' => '/storage/assets/katalog/pollpas/pollpass.webp',
            ],
            [
                'name' => 'Joki Ring',
                'slug' => 'joki-ring',
                'description' => 'Jasa peningkatan rank ring secara aman.',
                'image_path' => '/storage/assets/katalog/joki-ring/joki ring hero.webp',
            ],
            [
                'name' => 'Stik Level Max',
                'slug' => 'stik-level-max',
                'description' => 'Upgrade cue hingga level maksimal.',
                'image_path' => '/storage/assets/katalog/stik-level-maks/stik max.webp',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        // 4. Seed FAQs
        $faqs = [
            [
                'question' => 'Apakah pembelian item di sini aman dari resiko banned?',
                'answer' => 'Ya, 100% aman. Kami menggunakan metode transfer koin teraman dan legal via Google Play untuk Cash. Kami juga memberikan garansi penuh untuk setiap transaksi Anda.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Berapa lama waktu proses setelah pengiriman data?',
                'answer' => 'Rata-rata waktu proses kami berkisar antara 5 sampai 15 menit setelah data pemesanan diterima admin kami di WhatsApp. Untuk paket cash sultan paling lambat adalah 30 menit.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Apakah saya perlu memberikan login akun 8 Ball Pool saya?',
                'answer' => 'Untuk koin (transfer koin), kami HANYA membutuhkan ID Unik (UID) akun Anda. Sedangkan untuk Top Up Cash atau suntik pieces tertentu, terkadang dibutuhkan detail login akun (Miniclip/Facebook/Google) demi kelancaran proses inject.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Metode pembayaran apa saja yang didukung?',
                'answer' => 'Pembayaran dilakukan dengan cara transfer manual yang akan dikonfirmasi langsung oleh admin via WhatsApp. Kami mendukung transfer Bank lokal (BCA, Mandiri, BRI, BNI), QRIS, Gopay, OVO, Dana, dan ShopeePay.',
                'sort_order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], $faq);
        }

        // 4. Seed Testimonials
        $testimonials = [
            [
                'name' => 'Muhammad Richo',
                'game_product' => '1 Billion Coins',
                'review' => 'Beli 1 Miliar Koin prosesnya super cepat, cuma nunggu 10 menit koin langsung masuk akun. Pelayanannya ramah banget, recommended seller!',
                'rating' => 5,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'game_product' => 'Archangel Pieces',
                'review' => 'Awalnya ragu beli Archangel Cue pieces di sini. Ternyata transaksinya sangat aman dan dipandu admin step-by-step. Keren store ini!',
                'rating' => 5,
            ],
            [
                'name' => 'Christian Wijaya',
                'game_product' => '5.000 Cash',
                'review' => 'Top up 5.000 cash sukses masuk akun tanpa kendala. Buka legendary boxes langsung unlock 2 cue baru. Terima kasih ChampionStore!',
                'rating' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'game_product' => $testimonial['game_product']],
                $testimonial
            );
        }

        // 5. Seed Products (8 Ball Pool coins, cash, cues, etc.)
        $products = [
            // Pool Pass
            [
                'name' => 'POOL PASS',
                'slug' => 'pool-pass',
                'description' => 'Aktivasi Pool Pass musim aktif untuk hadiah eksklusif.',
                'price' => 81900,
                'original_price' => 120000,
                'image_path' => '/storage/uploads/products/pool-pass.png',
                'status' => 'available',
                'category' => 'pool-pass',
            ],
            [
                'name' => 'ELITE POOL PASS',
                'slug' => 'elite-pool-pass',
                'description' => 'Aktivasi Elite Pool Pass dengan bonus langsung.',
                'price' => 157500,
                'original_price' => 220000,
                'image_path' => '/storage/uploads/products/elite-pool-pass.png',
                'status' => 'available',
                'category' => 'pool-pass',
            ],

            // Top Up Koin
            [
                'name' => '250 M Coin',
                'slug' => '250-m-coin',
                'description' => 'Koin 8 Ball Pool 250 Juta. Proses cepat via table transfer.',
                'price' => 25000,
                'original_price' => 40000,
                'image_path' => '/storage/uploads/products/250-m-coin.png',
                'status' => 'available',
                'category' => 'top-up-koin',
            ],
            [
                'name' => '550 M Coin',
                'slug' => '550-m-coin',
                'description' => 'Koin 8 Ball Pool 550 Juta. Proses aman dan legal.',
                'price' => 50000,
                'original_price' => 80000,
                'image_path' => '/storage/uploads/products/550-m-coin.png',
                'status' => 'available',
                'category' => 'top-up-koin',
            ],
            [
                'name' => '850 M Coin',
                'slug' => '850-m-coin',
                'description' => 'Koin 8 Ball Pool 850 Juta. Terpercaya dan bergaransi.',
                'price' => 70000,
                'original_price' => 110000,
                'image_path' => '/storage/uploads/products/850-m-coin.png',
                'status' => 'available',
                'category' => 'top-up-koin',
            ],
            [
                'name' => '1200 M Coin',
                'slug' => '1200-m-coin',
                'description' => 'Koin 8 Ball Pool 1.2 Miliar. Terlaris dan paling dicari.',
                'price' => 90000,
                'original_price' => 150000,
                'image_path' => '/storage/uploads/products/1200-m-coin.png',
                'status' => 'available',
                'category' => 'top-up-koin',
            ],
            [
                'name' => '3500 M Coin',
                'slug' => '3500-m-coin',
                'description' => 'Koin 8 Ball Pool 3.5 Miliar. Paket koin sultan terlengkap.',
                'price' => 250000,
                'original_price' => 380000,
                'image_path' => '/storage/uploads/products/3500-m-coin.png',
                'status' => 'available',
                'category' => 'top-up-koin',
            ],

            // Joki Ring
            [
                'name' => 'Silver Ring',
                'slug' => 'silver-ring',
                'description' => 'Mendapatkan Silver Ring di profil akun Anda.',
                'price' => 30000,
                'original_price' => 50000,
                'image_path' => '/storage/uploads/products/silver-ring.png',
                'status' => 'available',
                'category' => 'joki-ring',
            ],
            [
                'name' => 'Gold Ring',
                'slug' => 'gold-ring',
                'description' => 'Mendapatkan Gold Ring di profil akun Anda.',
                'price' => 60000,
                'original_price' => 90000,
                'image_path' => '/storage/uploads/products/gold-ring.png',
                'status' => 'available',
                'category' => 'joki-ring',
            ],
            [
                'name' => 'Emerald Ring',
                'slug' => 'emerald-ring',
                'description' => 'Mendapatkan Emerald Ring di profil akun Anda.',
                'price' => 90000,
                'original_price' => 130000,
                'image_path' => '/storage/uploads/products/emerald-ring.png',
                'status' => 'available',
                'category' => 'joki-ring',
            ],
            [
                'name' => 'Diamond Ring',
                'slug' => 'diamond-ring',
                'description' => 'Mendapatkan Diamond Ring di profil akun Anda.',
                'price' => 120000,
                'original_price' => 180000,
                'image_path' => '/storage/uploads/products/diamond-ring.png',
                'status' => 'available',
                'category' => 'joki-ring',
            ],
            [
                'name' => 'Legend Ring',
                'slug' => 'legend-ring',
                'description' => 'Mendapatkan Legend Ring di profil akun Anda.',
                'price' => 200000,
                'original_price' => 300000,
                'image_path' => '/storage/uploads/products/legend-ring.png',
                'status' => 'available',
                'category' => 'joki-ring',
            ],

            // Stik Level Max
            [
                'name' => 'Rising Power Level Max',
                'slug' => 'rising-power-max',
                'description' => 'Upgrade Rising Power Cue hingga level maksimal.',
                'price' => 150000,
                'original_price' => 220000,
                'image_path' => '/storage/uploads/products/rising-power-max.png',
                'status' => 'available',
                'category' => 'stik-level-max',
            ],
            [
                'name' => 'Archangel Level Max',
                'slug' => 'archangel-max',
                'description' => 'Upgrade Archangel Legendary Cue hingga level maksimal.',
                'price' => 350000,
                'original_price' => 500000,
                'image_path' => '/storage/uploads/products/archangel-max.png',
                'status' => 'available',
                'category' => 'stik-level-max',
            ],
            [
                'name' => 'Excalibur Level Max',
                'slug' => 'excalibur-max',
                'description' => 'Upgrade Excalibur Cue hingga level maksimal.',
                'price' => 250000,
                'original_price' => 380000,
                'image_path' => '/storage/uploads/products/excalibur-max.png',
                'status' => 'available',
                'category' => 'stik-level-max',
            ],
            [
                'name' => 'Firestorm Level Max',
                'slug' => 'firestorm-max',
                'description' => 'Upgrade Firestorm Cue hingga level maksimal.',
                'price' => 280000,
                'original_price' => 400000,
                'image_path' => '/storage/uploads/products/firestorm-max.png',
                'status' => 'available',
                'category' => 'stik-level-max',
            ],

            // Joki Live
            [
                'name' => '10 Win',
                'slug' => '10-win',
                'description' => 'Jasa joki 10 kemenangan berturut-turut.',
                'price' => 20000,
                'original_price' => 35000,
                'image_path' => '/storage/uploads/products/10-win.png',
                'status' => 'available',
                'category' => 'joki-live',
            ],
            [
                'name' => '25 Win',
                'slug' => '25-win',
                'description' => 'Jasa joki 25 kemenangan berturut-turut.',
                'price' => 45000,
                'original_price' => 70000,
                'image_path' => '/storage/uploads/products/25-win.png',
                'status' => 'available',
                'category' => 'joki-live',
            ],
            [
                'name' => '50 Win',
                'slug' => '50-win',
                'description' => 'Jasa joki 50 kemenangan berturut-turut.',
                'price' => 80000,
                'original_price' => 120000,
                'image_path' => '/storage/uploads/products/50-win.png',
                'status' => 'available',
                'category' => 'joki-live',
            ],
            [
                'name' => '100 Win',
                'slug' => '100-win',
                'description' => 'Jasa joki 100 kemenangan berturut-turut.',
                'price' => 150000,
                'original_price' => 220000,
                'image_path' => '/storage/uploads/products/100-win.png',
                'status' => 'available',
                'category' => 'joki-live',
            ],
        ];

        foreach ($products as $product) {
            $categorySlug = $product['category'];
            unset($product['category']); // Remove the temporary category field
            
            // Get category ID from slug
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $product['category_id'] = $category->id;
            }
            
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }
    }
}
