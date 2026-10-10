<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use App\Models\TeamMember;
use App\Models\GalleryItem;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\CompanySetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@consoltainer.com'],
            [
                'name' => 'Admin Consoltainer',
                'password' => Hash::make('Admin123'),
            ]
        );

        // 2. Company Settings
        $settings = [
            'company_name' => 'PT. CONSOLTAINER TRANSPORT LOGISTIC',
            'tagline' => 'Moving Your Business Forward - LCL Consolidator Specialist',
            'phone' => '+62 21 4390 8888',
            'whatsapp' => '+62 812 9988 7766',
            'email' => 'info@consoltainer.co.id',
            'address' => 'Gedung Consoltainer Center Lt. 5, Jl. Yos Sudarso No. 88, Tanjung Priok, Jakarta Utara 14320',
            'hours' => 'Senin - Jumat: 08:30 - 17:30 WIB | Sabtu: 08:30 - 13:00 WIB',
            'kurs_usd' => '15,850',
            'total_teus' => '120,000+',
            'total_ports' => '450+',
            'experience_years' => '18',
            'vision' => 'Menjadi penyedia layanan LCL Consolidator dan solusi logistik terpercaya nomor 1 di Indonesia dengan jangkauan global terintegrasi.',
            'mission' => 'Memberikan efisiensi biaya pengiriman LCL, keamanan kargo, dan pelayanan pelanggan berstandar internasional.',
        ];

        foreach ($settings as $key => $value) {
            CompanySetting::set($key, $value);
        }

        // 3. Services
        $services = [
            [
                'title' => 'LCL Consolidation Specialist',
                'slug' => 'lcl-consolidation-specialist',
                'icon' => 'box',
                'short_description' => 'Layanan penggabungan muatan kurang dari satu kontainer (LCL) dengan rute langsung (Direct Call) dan transit teratur.',
                'description' => 'Consoltainer mengoperasikan rute konsolidasi ekspor dan impor LCL secara mandiri dengan stuffing langsung di CFS (Container Freight Station) milik sendiri. Menjamin keamanan barang, tarif kompetitif tanpa hidden fees, dan jadwal pasti setiap minggunya.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'features' => ['Direct LCL Route ke Port Utama Global', 'Dedicated CFS Container Yard', 'Pencegahan Damage dengan Professional Lashing', 'Jadwal Reguler Weekly Sailing'],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Full Container Load (FCL)',
                'slug' => 'full-container-load',
                'icon' => 'container',
                'short_description' => 'Pengiriman kontainer penuh (20ft, 40ft, 40ft HC) untuk muatan kapasitas besar secara internasional dan domestik.',
                'description' => 'Solusi pengiriman FCL dengan kemitraan strategis ke berbagai pelayaran internasional (Ocean Freight Shipping Lines) ternama. Kami menawarkan slot ruang terjamin bahkan pada peak season.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'features' => ['Kontrak Slot Khusus dengan Main Lines', 'Space Guarantee saat High Season', 'Pilihan Dry, High Cube, & Open Top Container', 'Customs Handling terpadu'],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Air Freight Consolidator',
                'slug' => 'air-freight-consolidator',
                'icon' => 'plane',
                'short_description' => 'Layanan kargo udara ekspres untuk pengiriman barang berprioritas tinggi dan produk bernilai tinggi.',
                'description' => 'Kargo udara terkonsolidasi dari bandara Soekarno-Hatta (CGK) dan Juanda (SUB) ke destinasi internasional utama dengan lead time singkat dan dokumen air waybill (HAWB) resmi.',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80',
                'features' => ['Layanan Express Door-to-Airport & Door-to-Door', 'Penanganan Dangerous Goods (DG Air)', 'Temperature Controlled Air Cargo', 'Daily Flight Schedules'],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Customs Clearance & Brokerage (PPJK)',
                'slug' => 'customs-clearance-ppjk',
                'icon' => 'file-text',
                'short_description' => 'Pengurusan kepabeanan ekspor & impor resmi dengan tim ahli PPJK bersertifikasi Bea Cukai.',
                'description' => 'Pengurusan dokumen PIB, PEB, jalur hijau/kuning/merah, fasilitas KITE, TPB, serta perizinan lartas (BPOM, Karantina, SNI, Kemendag) dengan proses cepat dan compliance tinggi.',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'features' => ['EDINet System Terkoneksi Bea Cukai', 'Pendampingan Pemeriksaan Fisik (Jalur Merah)', 'Pengurusan Izin Lartas & Karantina', 'Konsultasi Tarif HS Code'],
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Warehousing & CFS Depot',
                'slug' => 'warehousing-cfs-depot',
                'icon' => 'warehouse',
                'short_description' => 'Fasilitas gudang penyimpanan, bongkar muat CFS, palletizing, dan distribusi logistik terpadu.',
                'description' => 'Gudang berstandar tinggi yang dilengkapi sistem WMS (Warehouse Management System), CCTV 24/7, forklift modern, serta fasilitas de-consolidation LCL terpisah.',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=800&q=80',
                'features' => ['Sistem WMS Real-Time Storage Tracking', 'Fasilitas Cross-Docking & Repacking', '24/7 Surveillance & Guard Security', 'Bonded & Non-Bonded Warehouse Area'],
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Door-to-Door Multimodal Transport',
                'slug' => 'door-to-door-transport',
                'icon' => 'truck',
                'short_description' => 'Layanan pengambilan kargo dari alamat pengirim hingga diantar langsung ke gudang penerima.',
                'description' => 'Pengiriman multimoda menggabungkan angkutan darat (trailer/trucking), laut, dan udara dalam satu paket harga (all-in rate) transparan.',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=800&q=80',
                'features' => ['Armada Wingbox, Trailer, & Fuso Terintegrasi', 'Pelacakan GPS Armada Darat', 'Solusi All-In One Bill of Lading', 'Asuransi Kargo Terlindungi'],
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // 4. Products
        $products = [
            [
                'title' => 'Direct LCL Consolidation Package',
                'slug' => 'direct-lcl-consolidation',
                'category' => 'LCL Services',
                'short_description' => 'Konsolidasi LCL jalur langsung tanpa transhipment tambahan untuk efisiensi waktu & keamanan kargo.',
                'description' => 'Paket solusi LCL utama Consoltainer dengan rute langsung mingguan dari Pelabuhan Tanjung Priok (Jakarta) dan Tanjung Perak (Surabaya) ke Singapore, Port Klang, Shanghai, Busan, & Tokyo.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'Minimum Volume' => '1 CBM / 1,000 KG',
                    'Sailing Frequency' => 'Weekly (Jumat & Sabtu)',
                    'Transhipment' => 'Non-Transhipment (Direct)',
                    'Free Storage at CFS' => '5 Hari Pertama'
                ],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Reefer LCL Cold Chain Solution',
                'slug' => 'reefer-lcl-cold-chain',
                'category' => 'Cold Logistics',
                'short_description' => 'Konsolidasi muatan berpendingin LCL untuk produk makanan, obat-obatan, dan hasil laut.',
                'description' => 'Solusi inovatif konsolidasi suhu dingin (-18°C hingga +4°C) bagi eksportir yang tidak memenuhi volume 1 reefer container penuh.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'Temperature Range' => '-20°C to +10°C',
                    'Monitoring' => 'Data Logger Continuous Temp Record',
                    'Suitable For' => 'Frozen Seafood, Fruit, Pharmaceuticals',
                    'Certifications' => 'HACCP & Cold Chain Certified'
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Dangerous Goods (DG) LCL Handling',
                'slug' => 'dangerous-goods-dg-lcl',
                'category' => 'Special Cargo',
                'short_description' => 'Penanganan kargo bahan berbahaya kelas IMO 3, 6, 8, & 9 sesuai regulasi maritim internasional.',
                'description' => 'Layanan konsolidasi khusus barang kimia dan DG cargo lengkap dengan dokumen MSDS, UN packaging, dan sertifikasi IMO Dangerous Goods Declaration.',
                'image' => 'https://images.unsplash.com/photo-1505705694340-019e1e335916?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'DG Classes' => 'IMO Class 3, 6.1, 8, 9',
                    'Documentation' => 'IMO Declaration & MSDS Audit',
                    'Safety Standard' => 'SOLAS & IMDG Code Compliant',
                    'Packing' => 'UN Certified Drums & Pallets'
                ],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Container Sales & Leasing Solution',
                'slug' => 'container-sales-leasing',
                'category' => 'Equipment Services',
                'short_description' => 'Jual beli dan sewa kontainer bekas (used cargo worthy) serta unit kontainer baru 20ft & 40ft.',
                'description' => 'Menyediakan kontainer siap pakai kondisi Cargo Worthy (CW) dan IICL Standard untuk kebutuhan gudang portabel, pengiriman ekspor, maupun modifikasi kontainer.',
                'image' => 'https://images.unsplash.com/photo-1512418490979-92798cec1380?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'Sizes Available' => '20ft GP, 40ft GP, 40ft HC',
                    'Condition' => 'Cargo Worthy (CW) / New Build',
                    'Survey Certificate' => 'CSC Plate Valid Inspection Report',
                    'Leasing Terms' => 'Short Term & Long Term Available'
                ],
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // 5. Team Members
        $team = [
            [
                'name' => 'Bambang Soetjipto, S.E., M.M.',
                'position' => 'President Director & Founder',
                'department' => 'Executive Management',
                'bio' => 'Pengalaman lebih dari 25 tahun di industri maritim dan logistik konsolidasi LCL di Asia Tenggara.',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80',
                'email' => 'bambang@consoltainer-logistics.id',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 1,
            ],
            [
                'name' => 'Hendrik Kurniawan',
                'position' => 'Chief Operations Officer (COO)',
                'department' => 'Operations & Fleet',
                'bio' => 'Pakar operasional kontainer yard, manajemen pelayaran, dan koordinasi agen global di 30 negara.',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=600&q=80',
                'email' => 'hendrik@consoltainer-logistics.id',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 2,
            ],
            [
                'name' => 'Siti Rahmawati, S.Sos.',
                'position' => 'Head of Customer Experience & Commercial',
                'department' => 'Commercial & Sales',
                'bio' => 'Memimpin tim kepuasan pelanggan dan penanganan penawaran harga (RFQ) dengan rasio kepuasan 99%.',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80',
                'email' => 'siti.rahma@consoltainer-logistics.id',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 3,
            ],
            [
                'name' => 'Capt. Dedi Prasetyo',
                'position' => 'Head of Customs Clearance & Compliance (PPJK)',
                'department' => 'Customs & Regulatory',
                'bio' => 'Mantan inspektur maritim bersertifikat ahli kepabeanan dengan jam terbang tinggi di Tanjung Priok.',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'email' => 'dedi.ppjk@consoltainer-logistics.id',
                'linkedin' => 'https://linkedin.com',
                'sort_order' => 4,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::create($member);
        }

        // 6. Gallery Items
        $gallery = [
            [
                'title' => 'Stuffing Kontainer LCL di CFS Depot Tanjung Priok',
                'category' => 'Depot Operations',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'description' => 'Proses verifikasi dimensi CBM dan lashing aman oleh tim gudang Consoltainer.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Kegiatan Bongkar Muat Kapal Ocean Freighter',
                'category' => 'Vessel Operations',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'description' => 'Pengangkutan kontainer konsolidasi LCL ke atas kapal mother vessel.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Armada Wingbox Trucking Consoltainer',
                'category' => 'Fleet & Inland Transport',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=800&q=80',
                'description' => 'Armada truk feeder internal untuk penjemputan barang door-to-door.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Fasilitas Modern Gudang WMS Indoor',
                'category' => 'Warehousing',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sistem rak penyimpanan teratur dengan identifikasi barcode barang LCL.',
                'sort_order' => 4,
            ],
            [
                'title' => 'Tempat Penumpukan Container Yard (CY)',
                'category' => 'Depot Operations',
                'image' => 'https://images.unsplash.com/photo-1512418490979-92798cec1380?auto=format&fit=crop&w=800&q=80',
                'description' => 'Depot penumpukan kontainer kosong dan kontainer siap sailing di Jakarta.',
                'sort_order' => 5,
            ],
        ];

        foreach ($gallery as $item) {
            GalleryItem::create($item);
        }

        // 7. Portfolios
        $portfolios = [
            [
                'title' => 'Konsolidasi 120 CBM Mesin Industri Tekstil ke Singapore & Vietnam',
                'slug' => 'konsolidasi-mesin-tekstil-singapore',
                'client' => 'PT Tekstil Jaya Utama',
                'route' => 'Jakarta (IDTPP) -> Singapore (SGSIN) -> Haiphong (VNHPH)',
                'cargo_type' => 'LCL Machinery Parts (Non-Standard Size)',
                'description' => 'Sukses menangani pengiriman barang pecahan mesin berat dengan proteksi wooden crate khusus tanpa cacat pengiriman dalam waktu 4 hari transit.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'completion_date' => '2026-03-15',
                'sort_order' => 1,
            ],
            [
                'title' => 'Pengiriman LCL Cold Chain Seafood Beku ke Shanghai China',
                'slug' => 'lcl-cold-chain-seafood-shanghai',
                'client' => 'CV Bahari Nusantara Export',
                'route' => 'Surabaya (IDSUB) -> Shanghai (CNSHA)',
                'cargo_type' => 'Reefer LCL (-18°C Controlled)',
                'description' => 'Pengiriman sampel udang dan ikan beku dalam 1 reefer LCL terkonsolidasi dengan suhu terjaga stabil dari depot hingga pelabuhan penerima.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'completion_date' => '2026-02-28',
                'sort_order' => 2,
            ],
            [
                'title' => 'Clearance & Transport Fast-Track Spareparts Otomotif dari Japan',
                'slug' => 'fast-track-spareparts-japan',
                'client' => 'PT Auto Parts Indonesia',
                'route' => 'Yokohama (JPYOK) -> Jakarta (IDTPP)',
                'cargo_type' => 'Direct Impor LCL + Jalur Hijau PPJK',
                'description' => 'Pengurusan PIB impor cepat dengan waktu pengeluaran barang (dwelling time) kurang dari 24 jam dari CFS Tanjung Priok.',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=800&q=80',
                'completion_date' => '2026-01-20',
                'sort_order' => 3,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }

        // 8. Testimonials
        $testimonials = [
            [
                'name' => 'Irwan Wijaya',
                'company' => 'PT Mitra Ekspor Nusantara',
                'position' => 'Logistics Manager',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'content' => 'Layanan LCL dari Consoltainer sangat membantu usaha ekspor kami. Jadwal kapal selalu tepat waktu (Weekly Direct), dan biaya freight-nya transparan tanpa ada biaya tersembunyi saat barang tiba di pelabuhan tujuan.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'Clarissa Tan',
                'company' => 'Global Impex Singapore Pte Ltd',
                'position' => 'Import Director',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'content' => 'Customer support selalu responsif dan koordinasi dokumen ekspor impor sangat rapi. Sangat merekomendasikan Consoltainer untuk konsolidasi kargo.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'H. Achmad Subagyo',
                'company' => 'CV Furniture Mahakam',
                'position' => 'Owner & Founder',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                'content' => 'Pengurusan dokumen PPJK Bea Cukai sangat proaktif. Barang LCL furniture kami keluar jalur hijau tanpa kendala. Tim Customer Service-nya sangat cepat merespons di WhatsApp.',
                'rating' => 5,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
