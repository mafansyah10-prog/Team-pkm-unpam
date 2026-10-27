<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Department;
use App\Models\GalleryItem;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\CompanySetting;
use App\Models\PackagingGroup;
use App\Models\PackagingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function about()
    {
        $teamMembers = TeamMember::orderBy('sort_order')->take(4)->get();
        $galleryItems = GalleryItem::orderBy('sort_order')->take(6)->get();
        return view('pages.about', compact('teamMembers', 'galleryItems'));
    }

    public function team()
    {
        $departments = Department::with(['members' => function ($query) {
            $query->orderBy('sort_order');
        }])->orderBy('sort_order')->get();

        $teamMembers = TeamMember::with('departmentModel')->orderBy('sort_order')->get();
        return view('pages.team', compact('teamMembers', 'departments'));
    }

    public function gallery(Request $request)
    {
        $category = $request->get('category');
        $query = GalleryItem::orderBy('sort_order');
        if ($category) {
            $query->where('category', $category);
        }
        $galleryItems = $query->get();
        $categories = GalleryItem::select('category')->distinct()->pluck('category');

        return view('pages.gallery', compact('galleryItems', 'categories', 'category'));
    }

    public function portfolio()
    {
        $portfolios = Portfolio::orderBy('sort_order')->get();
        return view('pages.portfolio', compact('portfolios'));
    }

    public function portfolioDetail($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        $otherPortfolios = Portfolio::where('id', '!=', $portfolio->id)->take(3)->get();
        return view('pages.portfolio-detail', compact('portfolio', 'otherPortfolios'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::all();
        return view('pages.testimonials', compact('testimonials'));
    }

    public function packagingGuide()
    {
        $packagingGroups = [];

        try {
            // Auto-run migration if tables are missing on production
            if (!Schema::hasTable('packaging_groups') || !Schema::hasTable('packaging_items')) {
                Artisan::call('migrate', ['--force' => true]);
            }

            $groups = PackagingGroup::with('activeItems')->orderBy('sort_order')->get();

            if ($groups->isEmpty()) {
                Artisan::call('migrate', ['--force' => true]);
                $groups = PackagingGroup::with('activeItems')->orderBy('sort_order')->get();
            }

            $packagingGroups = $groups->map(function ($group) {
                return [
                    'id'    => $group->slug,
                    'title' => $group->title,
                    'icon'  => $group->icon ?: 'fa-box',
                    'desc'  => $group->desc ?: '',
                    'cards' => $group->activeItems->map(fn($item) => $item->toCard())->values()->toArray(),
                ];
            })->filter(fn($g) => count($g['cards']) > 0)->values()->toArray();
        } catch (\Throwable $e) {
            Log::warning('Packaging guide dynamic load fallback: ' . $e->getMessage());
        }

        if (empty($packagingGroups)) {
            $packagingGroups = self::defaultPackagingGroups();
        }

        return view('pages.packaging-guide', compact('packagingGroups'));
    }

    public static function defaultPackagingGroups(): array
    {
        return [
            [
                'id'    => 'karton',
                'title' => 'Karton & Kotak',
                'icon'  => 'fa-box-open',
                'desc'  => 'Kemasan berbahan kertas karton, kardus, dan kotak kayu/logam',
                'cards' => [
                    [
                        'id'      => 1,
                        'code'    => 'CT',
                        'ceisa'   => 'Carton',
                        'title'   => 'Karton (Carton)',
                        'desc'    => 'Kotak karton bergelombang (corrugated cardboard) — kemasan ekspor paling umum. Digunakan untuk elektronik, makanan olahan, pakaian, dan barang konsumen. Wajib diberi penguatan sudut (corner board) untuk pengiriman LCL.',
                        'example' => '200 CT',
                        'image'   => 'images/packaging/ct.jpg',
                        'tips'    => 'Pastikan kekuatan tepi (ECT) minimal 32 lbs/inch untuk LCL. Segel setiap ujung dengan tape minimal 2 lapis.',
                    ],
                    [
                        'id'      => 2,
                        'code'    => 'BX',
                        'ceisa'   => 'Box',
                        'title'   => 'Box (Kotak)',
                        'desc'    => 'Kotak berbahan apapun tanpa spesifikasi material — mencakup kotak plastik, logam, atau kayu ringan. Lebih umum dan fleksibel dari CT. Sering digunakan untuk spare part, alat industri, dan produk campuran.',
                        'example' => '50 BX',
                        'image'   => 'images/packaging/bx.jpg',
                        'tips'    => 'Gunakan BX jika material kotak bukan karton. Jika kardus bergelombang, lebih tepat menggunakan CT.',
                    ],
                    [
                        'id'      => 3,
                        'code'    => 'CS',
                        'ceisa'   => 'Case',
                        'title'   => 'Case (Peti Kayu)',
                        'desc'    => 'Peti kayu solid (kayu alam/plywood) berdinding penuh tanpa celah — lebih kuat dari CR/Crate. Ideal untuk mesin berat, peralatan sensitif getaran, dan barang senilai tinggi. Wajib cap IPPC ISPM-15 untuk ekspor.',
                        'example' => '10 CS',
                        'image'   => 'images/packaging/cs.jpg',
                        'tips'    => 'Wajib sertifikasi kayu ISPM-15 (cap gandum IPPC) untuk ekspor internasional. Gunakan bantalan kayu di dalam untuk barang berat.',
                    ],
                    [
                        'id'      => 4,
                        'code'    => 'EE',
                        'ceisa'   => 'Case, wooden, pallet base',
                        'title'   => 'Peti Kayu + Alas Palet (EE)',
                        'desc'    => 'Peti kayu yang dasarnya sudah menyatu dengan palet — solusi all-in-one untuk kargo berat dan fragile. Memudahkan handling forklift tanpa perlu palet terpisah. Umum untuk mesin industri dan peralatan lab.',
                        'example' => '5 EE',
                        'image'   => 'images/packaging/ee.jpg',
                        'tips'    => 'Pilihan terbaik untuk mesin dan equipment berat. Alas palet terintegrasi mempermudah handling forklift di pelabuhan.',
                    ],
                ],
            ],
            [
                'id'    => 'palet',
                'title' => 'Palet & Platform',
                'icon'  => 'fa-pallet',
                'desc'  => 'Alas kayu/plastik untuk menumpuk dan memindahkan kargo dengan forklift',
                'cards' => [
                    [
                        'id'      => 5,
                        'code'    => 'PX',
                        'ceisa'   => 'Pallet',
                        'title'   => 'Palet (Pallet)',
                        'desc'    => 'Alas palet kayu standar — unit kemasan terluar yang paling sering dilaporkan dalam dokumen B/L dan manifes. Jika 200 karton diletakkan di atas 10 palet, yang dilaporkan adalah 10 PX (bukan 200 CT). Wajib sertifikasi ISPM-15.',
                        'example' => '10 PX',
                        'image'   => 'images/packaging/px.jpg',
                        'tips'    => 'Ini adalah kode PALING PENTING. Selalu laporkan jumlah palet terluar, bukan jumlah karton di atasnya. Palet kayu wajib sertifikat IPPC ISPM-15 untuk ekspor.',
                    ],
                    [
                        'id'      => 6,
                        'code'    => 'SI',
                        'ceisa'   => 'Skid',
                        'title'   => 'Skid (Landasan Papan)',
                        'desc'    => 'Platform kayu datar tanpa celah bagian bawah (tidak seperti palet yang berlubang). Digunakan sebagai alas barang berat atau mesin yang langsung dilas/dibaut ke landasan. Tidak bisa diangkat forklift dari bawah.',
                        'example' => '3 SI',
                        'image'   => 'images/packaging/si.jpg',
                        'tips'    => 'Berbeda dari palet: skid tidak memiliki celah bawah untuk garpu forklift. Dipindahkan dengan crane atau sling.',
                    ],
                ],
            ],
            [
                'id'    => 'karung',
                'title' => 'Karung & Kantong',
                'icon'  => 'fa-sack',
                'desc'  => 'Kemasan fleksibel — karung, sak, bag, dan kantong untuk curah & granular',
                'cards' => [
                    [
                        'id'      => 7,
                        'code'    => 'SA',
                        'ceisa'   => 'Sack',
                        'title'   => 'Sak / Karung (Sack)',
                        'desc'    => 'Karung besar (woven polypropylene / goni / kertas kraft) untuk komoditas curah seperti beras, kopi, biji kedelai, tepung, dan pupuk. Umumnya berukuran 25–50 kg per unit. Kode resmi CEISA untuk "karung" umum.',
                        'example' => '500 SA',
                        'image'   => 'images/packaging/sa.jpg',
                        'tips'    => 'Untuk pupuk dan bahan kimia, pastikan karung inner liner plastik agar tahan kelembaban laut. Ikat dengan jahit ganda di mulut karung.',
                    ],
                    [
                        'id'      => 8,
                        'code'    => 'BG',
                        'ceisa'   => 'Bag',
                        'title'   => 'Bag (Kantong)',
                        'desc'    => 'Kantong fleksibel berukuran kecil-sedang dari plastik, kertas, atau kain. Digunakan untuk produk ritel (snack, kopi sachet, herbal), bahan kimia serbuk, atau komponen kecil. Berbeda dari SA yang lebih besar dan industrial.',
                        'example' => '1000 BG',
                        'image'   => 'images/packaging/bg.jpg',
                        'tips'    => 'Untuk produk makanan, pastikan kantong food-grade dan disegel heat-seal. Untuk pengiriman LCL, masukkan ke dalam master carton (CT) terlebih dahulu.',
                    ],
                    [
                        'id'      => 9,
                        'code'    => 'JB',
                        'ceisa'   => 'Bag, jumbo',
                        'title'   => 'Jumbo Bag / FIBC (JB)',
                        'desc'    => 'Big bag / FIBC (Flexible Intermediate Bulk Container) berkapasitas 500–2000 kg — dipakai untuk bahan kimia curah, pasir silika, granul plastik, dan mineral. Dilengkapi loop pengangkat di empat sudut. Sangat efisien untuk kargo curah berat.',
                        'example' => '20 JB',
                        'image'   => 'images/packaging/jb.jpg',
                        'tips'    => 'Pastikan loop pengangkat (lifting loops) dalam kondisi baik. Untuk B3/DG, gunakan FIBC berstandar UN approved. Simpan di tempat kering dan hindari paparan UV langsung.',
                    ],
                    [
                        'id'      => 10,
                        'code'    => 'BL',
                        'ceisa'   => 'Bale, compressed',
                        'title'   => 'Bal / Bale (BL)',
                        'desc'    => 'Kemasan berbentuk bal (balutan keras) dari bahan yang dikompresi — kain, kapas, kertas daur ulang, atau tembakau. Diikat dengan kawat baja atau strapping band. Umum dalam industri tekstil dan daur ulang.',
                        'example' => '80 BL',
                        'image'   => 'images/packaging/bl.jpg',
                        'tips'    => 'Pastikan ikatan kawat/strapping kencang dan tidak berkarat. Bungkus plastik luar (LLDPE stretch film) untuk perlindungan dari kelembaban.',
                    ],
                ],
            ],
            [
                'id'    => 'drum',
                'title' => 'Drum & Tangki',
                'icon'  => 'fa-oil-can',
                'desc'  => 'Kemasan silinder untuk cairan, gas, dan bahan kimia B3/DG',
                'cards' => [
                    [
                        'id'      => 11,
                        'code'    => 'DR',
                        'ceisa'   => 'Drum',
                        'title'   => 'Drum',
                        'desc'    => 'Drum silinder (besi/plastik/fiber) untuk cairan kimia, minyak, cat, dan bahan berbahaya. Ukuran standar 200L (55 gallon). Drum untuk Dangerous Goods wajib memiliki UN Approval Number dan label bahaya IMDG Code yang tahan air.',
                        'example' => '50 DR',
                        'image'   => 'images/packaging/dr.jpg',
                        'tips'    => 'Untuk DG: wajib UN Packaging Spec (misal: UN1A1/Y1.4/150). Label IMDG harus laminated dan tahan air laut. Sertakan MSDS/SDS dalam dokumen.',
                    ],
                    [
                        'id'      => 12,
                        'code'    => 'WA',
                        'ceisa'   => 'Intermediate bulk container',
                        'title'   => 'IBC / Intermediate Bulk Container (WA)',
                        'desc'    => 'Tangki IBC berkapasitas 1000–1250 liter — paling efisien untuk cairan kimia curah (solvent, asam lemah, bahan makanan cair). Rangka baja dengan inner bladder HDPE. Dapat distacking 2–3 unit di kontainer untuk memaksimalkan ruang.',
                        'example' => '10 WA',
                        'image'   => 'images/packaging/wa.jpg',
                        'tips'    => 'IBC dapat di-stack 2 tingkat di kontainer 20\'. Setelah digunakan, lakukan triple-rinse sebelum recertifikasi. Untuk DG cair, wajib UN approved IBC.',
                    ],
                    [
                        'id'      => 13,
                        'code'    => 'CY',
                        'ceisa'   => 'Cylinder',
                        'title'   => 'Silinder Gas (CY)',
                        'desc'    => 'Tabung silinder bertekanan tinggi untuk gas industri (oksigen, nitrogen, LPG, asetilen). Kargo DG kelas 2 yang memerlukan penanganan khusus — wajib tutup pelindung katup, diklem ke dinding kontainer, dan dipisah dari material mudah terbakar.',
                        'example' => '100 CY',
                        'image'   => 'images/packaging/cy.jpg',
                        'tips'    => 'WAJIB pisahkan dari barang mudah terbakar di kontainer. Pasang pelindung katup (valve cap). Simpan tegak dan diikat ke dinding kontainer. Label kelas 2 IMDG di setiap silinder.',
                    ],
                    [
                        'id'      => 14,
                        'code'    => 'TG',
                        'ceisa'   => 'Tank container, generic',
                        'title'   => 'Tank Container (TG)',
                        'desc'    => 'Tangki ISO baja berkapasitas 17.500–26.000 liter — digunakan sebagai unit pengiriman mandiri untuk cairan curah (minyak, bahan kimia, makanan cair). Ukuran eksterior sama dengan kontainer 20" sehingga bisa dimuat ke kapal, kereta, dan truk.',
                        'example' => '2 TG',
                        'image'   => 'images/packaging/tg.jpg',
                        'tips'    => 'Tank container harus memenuhi standar IMO T1–T22 sesuai jenis muatan. Inspeksi 2.5 tahun (interim) dan 5 tahun (periodic) wajib dilakukan. Minta Approval Certificate sebelum pemuatan.',
                    ],
                ],
            ],
            [
                'id'    => 'gulungan',
                'title' => 'Gulungan & Kumparan',
                'icon'  => 'fa-circle-notch',
                'desc'  => 'Kemasan untuk kabel, kawat, benang, dan material berbentuk gulungan',
                'cards' => [
                    [
                        'id'      => 15,
                        'code'    => 'RL',
                        'ceisa'   => 'Reel',
                        'title'   => 'Reel (Kumparan)',
                        'desc'    => 'Kumparan dengan flanges (piringan di kedua sisi) untuk kabel listrik, kawat las, serat optik, dan benang industri. Ukuran diameter mulai dari 30 cm hingga lebih dari 1 meter. Biasanya dari kayu lapis atau logam.',
                        'example' => '30 RL',
                        'image'   => 'images/packaging/rl.jpg',
                        'tips'    => 'Lindungi flanges dari benturan dengan packing kardus atau styrofoam. Segel ujung kabel ke flanges agar tidak terurai selama transit.',
                    ],
                    [
                        'id'      => 16,
                        'code'    => 'RO',
                        'ceisa'   => 'Roll',
                        'title'   => 'Roll (Gulungan)',
                        'desc'    => 'Gulungan tanpa flanges — untuk kain, plastik lembaran, geomembrane, karpet, dan kertas. Panjang roll bervariasi dari beberapa meter hingga ratusan meter. Sering diletakkan horizontal di kontainer dengan bantalan kayu.',
                        'example' => '50 RO',
                        'image'   => 'images/packaging/ro.jpg',
                        'tips'    => 'Bungkus setiap roll dengan stretch film dan label ujung. Gunakan bantalan kayu (timber block) di bawah roll untuk mencegah rolling di kontainer.',
                    ],
                    [
                        'id'      => 17,
                        'code'    => 'CL',
                        'ceisa'   => 'Coil',
                        'title'   => 'Coil (Koil / Lingkaran)',
                        'desc'    => 'Gulungan cincin datar tanpa inti — untuk kawat baja, kawat tembaga, pipa fleksibel, dan rantai. Bisa dibungkus plastik atau dalam karung goni. Berbeda dari RL/RO yang punya inti mandrel atau flanges.',
                        'example' => '100 CL',
                        'image'   => 'images/packaging/cl.jpg',
                        'tips'    => 'Ikat coil dengan 3–4 ikatan agar tidak mengembang. Bungkus dengan HDPE film untuk mencegah karat (untuk kawat baja). Bisa di-stack horizontal di kontainer.',
                    ],
                ],
            ],
            [
                'id'    => 'krat',
                'title' => 'Krat & Kemasan Khusus',
                'icon'  => 'fa-toolbox',
                'desc'  => 'Krat kayu terbuka, kendaraan, dan kemasan industri khusus',
                'cards' => [
                    [
                        'id'      => 18,
                        'code'    => 'CR',
                        'ceisa'   => 'Crate',
                        'title'   => 'Krat (Crate)',
                        'desc'    => 'Struktur kayu terbuka (ada celah/grid) — dipakai untuk mesin berat, spare part berukuran besar, dan peralatan konstruksi. Ringan namun kuat. Celah terbuka memungkinkan inspeksi visual isi tanpa membuka kemasan. Wajib ISPM-15.',
                        'example' => '8 CR',
                        'image'   => 'images/packaging/cr.jpg',
                        'tips'    => 'Krat terbuka perlu pelindung dalam (inner wrap plastik) untuk kargo sensitif debu. Lebih hemat biaya kayu vs. case/CS yang berdinding penuh. Wajib sertifikasi ISPM-15 untuk ekspor.',
                    ],
                    [
                        'id'      => 19,
                        'code'    => 'PK',
                        'ceisa'   => 'Package',
                        'title'   => 'Package (Paket Umum)',
                        'desc'    => 'Kode generik untuk paket yang tidak masuk kategori spesifik lain. Digunakan ketika bentuk kemasan campuran atau sulit diklasifikasikan (misal: barang bekas campuran, sparepart bundled). Hindari penggunaan berlebihan — selalu pilih kode yang lebih spesifik jika tersedia.',
                        'example' => '15 PK',
                        'image'   => 'images/packaging/pk.jpg',
                        'tips'    => 'Gunakan PK hanya jika tidak ada kode yang lebih spesifik. Bea cukai mungkin meminta klarifikasi jika PK digunakan untuk kargo bernilai tinggi.',
                    ],
                    [
                        'id'      => 20,
                        'code'    => 'VN',
                        'ceisa'   => 'Vehicle',
                        'title'   => 'Kendaraan (Vehicle)',
                        'desc'    => 'Kendaraan sebagai unit muatan mandiri — mobil, motor, alat berat, dan kendaraan industri yang dimuat langsung (ro-ro) atau dalam kontainer. Tidak memiliki kemasan pembungkus; kendaraan itu sendiri adalah "kemasan"-nya.',
                        'example' => '2 VN',
                        'image'   => 'images/packaging/vn.jpg',
                        'tips'    => 'Untuk kendaraan dalam kontainer: kosongkan bahan bakar <1/4 tangki, kunci stir, dan amankan dengan lashing ke dinding kontainer. Sertakan dokumen BPKB/STNK dan invoice kendaraan.',
                    ],
                ],
            ],
        ];
    }
}
