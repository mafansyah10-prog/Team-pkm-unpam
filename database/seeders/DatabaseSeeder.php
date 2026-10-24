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
        // 1. Admin Users
        User::updateOrCreate(
            ['email' => 'm.afansyah10@gmail.com'],
            [
                'name' => 'Admin Consoltainer',
                'password' => Hash::make('admin1234'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'admin@consoltainer.com'],
            [
                'name' => 'Admin Consoltainer (Default)',
                'password' => Hash::make('Admin123'),
            ]
        );

        // 2. Company Settings (Extracted exactly from Official Company Profile PDF)
        $settings = [
            'company_name' => 'PT. Consoltainer Transport Logistics',
            'company_short' => 'CTL Line',
            'tagline' => 'PPJK, Export-Import Service, Land Transportation, Customs Brokerage, Warehousing & Distribution',
            'holding_tagline' => 'Bagian dari Pan Groups · Freight Forwarding & Logistics Solutions',
            'holding_name' => 'Pan Groups',
            'holding_subsidiaries' => 'PT. Pan Ekspres International, PT. IP Logistics Indonesia, dan PT. NCL Inter Logistic Indonesia',
            'holding_description' => 'PT. Consoltainer Transport Logistics (CTL) adalah anak perusahaan di bawah naungan Pan Groups, sebuah holding yang juga membawahi PT. Pan Ekspres International, PT. IP Logistics Indonesia, dan PT. NCL Inter Logistic Indonesia. Seluruhnya bergerak di bidang freight forwarding services, logistics & transportation solution.',
            
            // Contacts & Offices
            'phone' => '(+62 21) 4607279-8',
            'phone_marketing' => '(+62 21) 4607279-8, 46802174-7',
            'fax_marketing' => '(+62 21) 46823886',
            'phone_pans' => '+62-21 2928 6681 705 (25 lines)',
            'fax_pans' => '+62-21 2928 6680',
            'address_pans' => 'Jl. Raya Sultan Agung No. 425 Medan Satria, Bekasi, Indonesia',
            'phone_semarang' => '+62-24 7692 8588, 77',
            'address_semarang' => 'Ruko Galaxi No. 2, Jl. Soekarno-Hatta No. 8, Semarang',
            'whatsapp' => '+62 812 9988 7766',
            'email' => 'ctl.gm@ctl-indonesia.net',
            'website' => 'ctl-indonesia.net',
            'address' => 'Jl. Sultan Hamengkubuwono IX Ruko Inkopau Blok J No. 8, Ujung Menteng, Cakung, Jakarta Timur 13960',
            'hours' => 'Senin - Jumat: 08:30 - 17:30 WIB | Sabtu: 08:30 - 13:00 WIB',
            'working_days' => 'Senin - Jumat',
            'open_time' => '08:30 WIB',
            'close_time' => '17:30 WIB',
            'weekend_hours' => '08:30 - 13:00 WIB',
            'holiday_note' => 'Minggu & Hari Libur Nasional: Tutup',

            // Key Indicators
            'kurs_usd' => '15,850',
            'total_teus' => '120,000+',
            'total_ports' => '450+',
            'experience_years' => '18',

            // Vision & Mission (Page 4)
            'vision' => 'Menjadi mitra bisnis yang berkesinambungan dan sinergi, dengan integritas dan komitmen.',
            'vision_en' => 'Becoming sustainable and synergy business partners with integrity and commitment.',
            'mission' => 'Menyediakan layanan transportasi laut dan udara ke seluruh dunia dengan solusi paling inovatif dan hemat biaya sesuai kebutuhan pelanggan.',
            'mission_en' => 'Committed to providing worldwide ocean and air transportation with the most innovative and cost-effective solutions to customers\' needs.',

            // Profile & Story (Pages 2-3)
            'about_title' => 'Latar Belakang & Profil PT. Consoltainer Transport Logistics',
            'about_story_1' => 'PT. Consoltainer Transport Logistics (CTL) adalah anak perusahaan di bawah naungan Pan Groups, sebuah holding yang juga membawahi PT. Pan Ekspres International, PT. IP Logistics Indonesia, dan PT. NCL Inter Logistic Indonesia. Seluruhnya bergerak di bidang freight forwarding services, logistics & transportation solution.',
            'about_story_2' => 'Persaingan di industri forwarder terus meningkat, dan setiap perusahaan dituntut memenuhi harapan pelanggan untuk mencapai kualitas layanan (service quality) yang diinginkan. Kualitas layanan dibentuk dari perbandingan antara layanan nyata yang diterima pelanggan dengan layanan yang mereka harapkan. Bila kenyataan melebihi harapan, layanan dinilai bermutu; bila kurang dari harapan, layanan dinilai tidak bermutu; dan bila sama dengan harapan, layanan dinilai memuaskan. Dengan memadukan keahlian kepabeanan, jaringan global terpercaya, dan armada mandiri dengan pemantauan real-time, kami menghadirkan efisiensi dan transparansi di setiap tahap pengiriman.',
            'intro_text' => 'Persaingan di industri forwarder terus meningkat, dan setiap perusahaan dituntut memenuhi harapan pelanggan untuk mencapai kualitas layanan (service quality) yang diinginkan. Layanan dinilai bermutu bila kenyataan melebihi harapan. Kondisi ini mengharuskan perusahaan forwarder untuk terus menganalisis kualitas layanan produknya agar tetap bersaing di pasar global dengan produk utama ekspor, impor, ocean freight, air freight, land transportation, customs clearance, dan logistik.',

            // Legality (Page 11)
            'nib' => '8120118272272 (ditetapkan 27 Desember 2018)',
            'npwp' => '02.182.557.5-006.000',
            'kpp' => 'KPP Pratama Jakarta Cakung (terdaftar 8 September 2006)',
            'kbli' => '52291 - Jasa Pengurusan Transportasi (JPT)',
            'api_type' => 'API-U (Angka Pengenal Importir Umum)',
            'investment_status' => 'PMDN',
            'legal_address' => 'Jl. Sultan Hamengkubuwono IX Ruko Inkopau Blok J No. 8, Ujung Menteng, Cakung, Jakarta Timur 13960',

            // Hero Section Settings
            'hero_title' => 'PT. Consoltainer Transport Logistics',
            'hero_subtitle' => 'Bagian dari Pan Groups · PPJK, Export-Import Service, Land Transportation, Customs Brokerage, Warehousing & Distribution terpercaya dengan solusi paling inovatif dan hemat biaya.',
        ];

        foreach ($settings as $key => $value) {
            CompanySetting::set($key, $value);
        }

        // 3. Official Services (Pages 6 - 10)
        Service::query()->delete();
        $services = [
            [
                'title' => 'Export & Import (Ocean Freight)',
                'slug' => 'export-import',
                'icon' => 'ship',
                'short_description' => 'Solusi ekspor dan impor kargo laut FCL dan LCL ke seluruh dunia dengan efisiensi biaya, kepatuhan regulasi, dan transparansi proses.',
                'description' => 'Ingin mengekspor atau mengimpor barang dari berbagai negara? Ingin mengirim dengan biaya terjangkau, atau mengirim barang urgent dalam waktu singkat? PT. Consoltainer Transport Logistics siap memberikan solusi Export & Import yang sesuai kebutuhan bisnis Anda, baik melalui laut maupun udara, dalam kuantitas kecil maupun besar. Kami memahami rumitnya proses ekspor-impor, mulai dari pengaturan moda transportasi hingga pemenuhan persyaratan bea cukai dan dokumen. Dengan pengalaman dan jaringan global terpercaya, kami merancang metode pengiriman yang efisien, memastikan kepatuhan regulasi, memantau barang secara akurat, dan menjamin informasi yang transparan atas setiap proses dan biaya.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'features' => [
                    'FCL Cargo Flow: Pengiriman kontainer penuh door delivery dengan segel aman dari shipper hingga consignee',
                    'LCL Cargo Flow: Konsolidasi kargo gabungan di gudang CFS dengan devanning dan delivery terjadwal',
                    'Clearance di kedua pelabuhan asal dan pelabuhan tujuan secara tertata',
                    'Kemitraan pelayaran global terpercaya untuk rute pelayaran reguler'
                ],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Air Freight & Incoterms',
                'slug' => 'air-freight-incoterms',
                'icon' => 'plane',
                'short_description' => 'Layanan kargo udara ekspres ke seluruh dunia dengan alur kargo terstruktur dan panduan komprehensif Shipping Incoterms 2020.',
                'description' => 'Menyediakan layanan transportasi udara ke seluruh dunia dengan solusi paling inovatif dan hemat waktu. Meliputi alur kargo udara lengkap mulai dari Shipper & Origin Forwarder (Invoice, packing list, COO, letter of instruction, DG declaration), Export Customs, Origin GHA (MAWB, HAWB, House Manifest), Carrier (Flight Manifest), Destination GHA, Import Customs, Destination Forwarder, hingga Consignee. Dilengkapi konsultasi matriks tanggung jawab jual beli internasional Shipping Incoterms 2020 (EXW, FCA, FAS, FOB, CFR, CIF, CPT, CIP, DPU, DAP, DDP).',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80',
                'features' => [
                    'Air Freight Cargo Flow 8-tahap terpadu dari asal hingga tujuan',
                    'Pengurusan dokumen ekspor-impor udara (MAWB, HAWB, DG Declaration)',
                    'Handling cepat di bandara internasional (Origin & Destination GHA)',
                    'Konsultasi aturan pembagian risiko & biaya Shipping Incoterms 2020'
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Customs Clearance Brokerage & PPJK',
                'slug' => 'customs-clearance-ppjk',
                'icon' => 'file-contract',
                'short_description' => 'Memadukan keahlian peraturan Bea Cukai dunia dengan pengetahuan lokal untuk kelancaran arus pengiriman kargo Anda.',
                'description' => 'PT. Consoltainer Transport Logistics memadukan keahlian peraturan Bea Cukai dunia dengan pengetahuan lokal untuk memastikan kelancaran arus pengiriman Anda. Penyelesaian barang di kantor Bea dan Cukai merupakan bagian penting dari setiap perdagangan dan transportasi internasional. Keterlambatan proses dapat membuat pengiriman tidak tepat waktu dan mengganggu reputasi perusahaan Anda, begitu pula manajemen yang tidak efisien. Kami berpengalaman penuh dalam penyelesaian kepabeanan di setiap pasar tempat kami beroperasi. Prosedur yang tertata dan hubungan baik dengan instansi kepabeanan memastikan barang Anda dipercepat dalam perjalanan, apa pun tujuannya.',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'features' => [
                    'Tim ahli kepabeanan bersertifikasi resmi PPJK Bea Cukai',
                    'Berbagai pengaturan kepabeanan (jalur hijau, kuning, merah, fasilitas)',
                    'Saran spesialis klasifikasi pos tarif HS Code & kepatuhan lartas',
                    'Dukungan on-site pendampingan langsung di instansi kepabeanan'
                ],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Land Transportation',
                'slug' => 'land-transportation',
                'icon' => 'truck',
                'short_description' => 'Solusi transportasi darat yang andal dan efisien dengan armada sendiri, mitra terpercaya, dan pemantauan posisi GPS Real-Time.',
                'description' => 'Kami memprioritaskan solusi transportasi darat yang andal dan efisien. Menyadari pentingnya pengiriman tepat waktu dan keamanan barang, kami menjamin layanan melalui armada kendaraan sendiri, jaringan mitra pengangkut terpercaya, serta tim driver yang andal dan berpengalaman. Kami merencanakan rute terbaik yang meminimalkan waktu tempuh dan aman untuk segala kondisi barang. Seluruh armada dalam proses pengiriman dipantau secara real-time melalui vehicle tracker yang terpasang di setiap armada, dan lokasinya dapat dibagikan kepada customer.',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=800&q=80',
                'features' => [
                    'Armada sendiri: Kendaraan milik perusahaan untuk kontrol penuh mutu',
                    'Mitra pengangkut: Jaringan mitra terpercaya untuk fleksibilitas kapasitas',
                    'Driver berpengalaman: Tim driver andal untuk segala jenis kondisi muatan',
                    'Vehicle tracker: Pelacakan real-time armada yang dapat dipantau customer'
                ],
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Warehousing & Distribution',
                'slug' => 'warehousing-distribution',
                'icon' => 'warehouse',
                'short_description' => 'Penyediaan lahan pergudangan dan distribution center dengan jaminan keamanan, penataan optimal, dan pemantauan stok.',
                'description' => 'Sebagai komitmen menyediakan solusi lengkap kebutuhan logistik dan supply chain, kami memiliki lahan bangunan yang dapat digunakan sebagai pergudangan dan distribution center sesuai kebutuhan customer. Kami menjamin barang yang dititipkan terjaga dengan baik, terlindungi dari kerusakan dan pencurian.',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=800&q=80',
                'features' => [
                    'Pengaturan dan optimalisasi ruang penyimpanan pergudangan modern',
                    'Pengaturan inventaris dan pemantauan stok secara berkelanjutan',
                    'Pengemasan barang (packaging, labeling, dan palletizing)',
                    'Distribusi barang terintegrasi ke alamat lokasi tujuan customer'
                ],
                'is_featured' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // 4. Products
        $products = [
            [
                'title' => 'Full Container Load (FCL) Shipment',
                'slug' => 'full-container-load-fcl',
                'category' => 'Ocean Freight',
                'short_description' => 'Pengiriman kontainer penuh door-to-door dengan segel aman dari lokasi shipper hingga tiba di pintu customer.',
                'description' => 'Solusi pengiriman muatan penuh dalam satu kontainer (20ft, 40ft, 40ft HC). Barang dimuat dan disegel langsung di lokasi supplier tanpa dibuka di tengah perjalanan, melewati proses clearance kepabeanan di kedua pelabuhan, dan diantar langsung ke gudang penerima.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'Kapasitas Kontainer' => '20ft GP, 40ft GP, 40ft High Cube',
                    'Alur Muat' => 'Door-to-Door / Port-to-Port',
                    'Segel Kargo' => 'Sealed Container hingga tujuan',
                    'Clearance' => 'Penanganan Bea Cukai Pelabuhan Asal & Tujuan'
                ],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Less than Container Load (LCL) Consolidation',
                'slug' => 'less-than-container-load-lcl',
                'category' => 'Consolidation',
                'short_description' => 'Konsolidasi kargo gabungan di gudang CFS dengan alur 9-tahap terstandar mulai dari pick-up hingga devanning.',
                'description' => 'Solusi hemat biaya untuk pengiriman kargo dalam kuantitas kecil hingga menengah. Kargo dijemput dari pabrik, dikonsolidasi di gudang CFS (Container Freight Station), diangkut ke pelabuhan, dimuat ke kapal, hingga proses devanning di CFS tujuan dan delivery ke penerima akhir.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'Minimum Volume' => '1 CBM / 1,000 KG',
                    'Fasilitas Depot' => 'CFS Berizin & Pengawasan Ketat',
                    'Alur Proses' => '9-Tahap Terpadu (Pick up s/d Devanning)',
                    'Tracking' => 'Pemantauan Akurat & Transparan'
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'International Air Cargo Express',
                'slug' => 'international-air-cargo-express',
                'category' => 'Air Freight',
                'short_description' => 'Pengiriman kargo udara prioritas tinggi dengan kepatuhan penerbangan internasional dan koordinasi GHA lengkap.',
                'description' => 'Pengiriman barang bernilai tinggi dan barang urgent melalui udara dengan jaringan airline terpercaya. Didukung pengurusan dokumen MAWB, HAWB, DG Declaration, dan koordinasi cepat di Origin & Destination Ground Handling Agent (GHA).',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'Moda Angkut' => 'Kargo Udara Komersial & Freighter',
                    'Dokumen' => 'MAWB, HAWB, Flight Manifest, DG Declaration',
                    'Kecepatan' => 'Express Lead Time Internasional',
                    'Kepatuhan' => 'Regulasi IATA & Bea Cukai Bandara'
                ],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Jasa Pengurusan Transportasi & PPJK (KBLI 52291)',
                'slug' => 'jasa-ppjk-kbli-52291',
                'category' => 'Customs & Legality',
                'short_description' => 'Layanan resmi PPJK dengan NIB 8120118272272 dan API-U untuk seluruh kebutuhan kepabeanan ekspor-impor.',
                'description' => 'Penanganan dokumen kepabeanan impor dan ekspor secara legal, cepat, dan akurat dengan nomor izin resmi PPJK dan NIB 8120118272272 terdaftar pada KPP Pratama Jakarta Cakung.',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
                'specifications' => [
                    'NIB' => '8120118272272',
                    'KBLI' => '52291 - Jasa Pengurusan Transportasi (JPT)',
                    'Jenis API' => 'API-U (Angka Pengenal Importir Umum)',
                    'Status' => 'PMDN Resmi'
                ],
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        Product::query()->delete();
        foreach ($products as $product) {
            Product::create($product);
        }

        // 5. Official Team Members & Structure (Page 5: Struktur Organisasi)
        TeamMember::query()->delete();
        $team = [
            // Dewan Direksi / Executive Management
            [
                'name' => 'Supangat',
                'position' => 'Direktur Utama',
                'department' => 'Executive Management',
                'bio' => 'Memimpin seluruh arah strategis perusahaan, memastikan kepatuhan tata kelola, dan mewujudkan visi PT. Consoltainer Transport Logistics sebagai mitra bisnis yang berkesinambungan dan sinergi.',
                'email' => 'supangat@ctl-indonesia.net',
                'sort_order' => 1,
            ],
            [
                'name' => 'Thoriah',
                'position' => 'Wakil Direktur',
                'department' => 'Executive Management',
                'bio' => 'Mendukung kepemimpinan operasional dan manajerial, memperkuat sinergi antar divisi, serta menjaga mutu layanan forwarding dan logistik.',
                'email' => 'thoriah@ctl-indonesia.net',
                'sort_order' => 2,
            ],

            // Divisi Import
            [
                'name' => 'Amajida Almas',
                'position' => 'Manager of Import',
                'department' => 'Import Division',
                'bio' => 'Memimpin divisi kargo impor, mengawasi kepatuhan prosedur kepabeanan, koordinasi pengiriman laut dan udara, serta efisiensi waktu dwelling kargo impor.',
                'email' => 'amajida.import@ctl-indonesia.net',
                'sort_order' => 3,
            ],
            [
                'name' => 'Fadilah Ahmad',
                'position' => 'Import Staff',
                'department' => 'Import Division',
                'bio' => 'Bertanggung jawab atas administrasi kargo impor, monitoring status manifes, dan koordinasi dokumen impor.',
                'email' => 'fadilah.import@ctl-indonesia.net',
                'sort_order' => 4,
            ],
            [
                'name' => 'M. Faris Al-Fatih',
                'position' => 'Import Staff',
                'department' => 'Import Division',
                'bio' => 'Penanganan operasional impor, tracking kontainer, dan komunikasi dengan mitra pelayaran internasional.',
                'email' => 'faris.import@ctl-indonesia.net',
                'sort_order' => 5,
            ],
            [
                'name' => 'Ahmad Hudiro',
                'position' => 'Import Staff',
                'department' => 'Import Division',
                'bio' => 'Spesialis verifikasi data impor, kelengkapan dokumen pengiriman, dan pendampingan kepabeanan.',
                'email' => 'hudiro.import@ctl-indonesia.net',
                'sort_order' => 6,
            ],
            [
                'name' => 'Indriyani',
                'position' => 'Import Staff',
                'department' => 'Import Division',
                'bio' => 'Pengelolaan data pelanggan impor, konfirmasi DO (Delivery Order), dan administrasi kargo laut.',
                'email' => 'indriyani.import@ctl-indonesia.net',
                'sort_order' => 7,
            ],
            [
                'name' => 'Kurniasih Putri',
                'position' => 'Import Staff',
                'department' => 'Import Division',
                'bio' => 'Pelayanan informasi status impor pelanggan, update timeline kedatangan kargo, dan arsip dokumen.',
                'email' => 'kurniasih.import@ctl-indonesia.net',
                'sort_order' => 8,
            ],
            [
                'name' => 'Raihan Fajri',
                'position' => 'Import Staff',
                'department' => 'Import Division',
                'bio' => 'Penanganan operasional lapangan impor, verifikasi fisik kargo, dan sinkronisasi dengan tim kepelabuhanan.',
                'email' => 'raihan.import@ctl-indonesia.net',
                'sort_order' => 9,
            ],

            // Divisi EMKL (Ekspedisi Muatan Kapal Laut)
            [
                'name' => 'Meliza Delvia',
                'position' => 'Manager of EMKL',
                'department' => 'EMKL Division',
                'bio' => 'Memimpin seluruh operasional kepelabuhanan EMKL, handling bongkar muat kontainer, trucking darat, dan koordinasi operasional pelabuhan utama.',
                'email' => 'meliza.emkl@ctl-indonesia.net',
                'sort_order' => 10,
            ],
            [
                'name' => 'Triono',
                'position' => 'EMKL Staff',
                'department' => 'EMKL Division',
                'bio' => 'Koordinasi trucking pelabuhan, pengawasan muatan di container yard, dan pengelolaan surat jalan.',
                'email' => 'triono.emkl@ctl-indonesia.net',
                'sort_order' => 11,
            ],
            [
                'name' => 'Khoirunnisa',
                'position' => 'EMKL Staff',
                'department' => 'EMKL Division',
                'bio' => 'Administrasi operasional EMKL, penerbitan dokumen jalan, dan pencatatan muatan masuk/keluar pelabuhan.',
                'email' => 'khoirunnisa.emkl@ctl-indonesia.net',
                'sort_order' => 12,
            ],
            [
                'name' => 'Ade Fahmi',
                'position' => 'EMKL Staff',
                'department' => 'EMKL Division',
                'bio' => 'Pengawasan lapangan kontainer di terminal pelabuhan dan verifikasi segel muatan FCL/LCL.',
                'email' => 'ade.emkl@ctl-indonesia.net',
                'sort_order' => 13,
            ],
            [
                'name' => 'Suhandi',
                'position' => 'EMKL Staff',
                'department' => 'EMKL Division',
                'bio' => 'Manajemen operasional armada angkutan darat pelabuhan dan koordinasi penjemputan kontainer.',
                'email' => 'suhandi.emkl@ctl-indonesia.net',
                'sort_order' => 14,
            ],
            [
                'name' => 'Sipa Alawiyah',
                'position' => 'EMKL Staff',
                'department' => 'EMKL Division',
                'bio' => 'Dukungan administrasi kepelabuhanan EMKL, invoicing operasional kapal laut, dan relasi mitra.',
                'email' => 'sipa.emkl@ctl-indonesia.net',
                'sort_order' => 15,
            ],
            [
                'name' => 'Riski',
                'position' => 'EMKL Staff',
                'department' => 'EMKL Division',
                'bio' => 'Petugas operasional lapangan dermaga, inspeksi kontainer, dan kelancaran alur trucking pelabuhan.',
                'email' => 'riski.emkl@ctl-indonesia.net',
                'sort_order' => 16,
            ],

            // Divisi Export
            [
                'name' => 'Yashir Mustaqim',
                'position' => 'Manager of Export',
                'department' => 'Export Division',
                'bio' => 'Memimpin divisi ekspor, merancang rute pengiriman laut dan udara ke berbagai destinasi global, serta memastikan kepatuhan regulasi negara tujuan.',
                'email' => 'yashir.export@ctl-indonesia.net',
                'sort_order' => 17,
            ],
            [
                'name' => 'Ni Wayan Hariyani',
                'position' => 'Export Staff',
                'department' => 'Export Division',
                'bio' => 'Pengurusan dokumen ekspor (PEB, COO, Bill of Lading, Air Waybill) dan monitoring jadwal keberangkatan kapal.',
                'email' => 'wayan.export@ctl-indonesia.net',
                'sort_order' => 18,
            ],

            // Divisi Accounting & Finance
            [
                'name' => 'Nur Ikasari',
                'position' => 'Manager of Accounting',
                'department' => 'Accounting Division',
                'bio' => 'Memimpin tata kelola keuangan, audit biaya freight & logistik, penagihan transparan, dan kepatuhan perpajakan perusahaan.',
                'email' => 'ikasari.acc@ctl-indonesia.net',
                'sort_order' => 19,
            ],
            [
                'name' => 'Ririh Yuntia',
                'position' => 'Accounting Staff',
                'department' => 'Accounting Division',
                'bio' => 'Penanganan faktur operasional logistik, verifikasi invoice customer, dan rekonsiliasi pembayaran.',
                'email' => 'ririh.acc@ctl-indonesia.net',
                'sort_order' => 20,
            ],
            [
                'name' => 'Nadiyah Mawadah',
                'position' => 'Accounting Staff',
                'department' => 'Accounting Division',
                'bio' => 'Pencatatan kas operasional, administrasi perpajakan bea cukai, dan pelaporan keuangan berkala.',
                'email' => 'nadiyah.acc@ctl-indonesia.net',
                'sort_order' => 21,
            ],
            [
                'name' => 'Eki',
                'position' => 'Accounting Staff',
                'department' => 'Accounting Division',
                'bio' => 'Administrasi penagihan biaya jasa pelayanan logistik dan verifikasi biaya transportasi pelabuhan/gudang.',
                'email' => 'eki.acc@ctl-indonesia.net',
                'sort_order' => 22,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::create($member);
        }

        // 6. Gallery Items
        GalleryItem::query()->delete();
        $gallery = [
            [
                'title' => 'Stuffing & Konsolidasi Kargo di CFS Gudang Berizin',
                'category' => 'Depot Operations',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'description' => 'Proses konsolidasi kargo LCL dengan penanganan hati-hati dan lashing standar keselamatan internasional.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Bongkar Muat Kontainer FCL di Pelabuhan',
                'category' => 'Vessel Operations',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'description' => 'Pengangkutan dan pemuatan kontainer ekspor-impor ke atas kapal kargo samudra.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Armada Truk Ekspedisi Darat dengan Vehicle Tracker Real-Time',
                'category' => 'Fleet & Inland Transport',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=800&q=80',
                'description' => 'Armada darat mandiri siap menjamin ketepatan waktu pengiriman door-to-door dengan GPS live tracking.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Fasilitas Pergudangan & Distribution Center Modern',
                'category' => 'Warehousing',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=800&q=80',
                'description' => 'Optimalisasi ruang penyimpanan, pengemasan, dan pemantauan inventaris terpadu.',
                'sort_order' => 4,
            ],
            [
                'title' => 'Container Yard Penumpukan Kontainer Resmi',
                'category' => 'Depot Operations',
                'image' => 'https://images.unsplash.com/photo-1512418490979-92798cec1380?auto=format&fit=crop&w=800&q=80',
                'description' => 'Area penumpukan kontainer terorganisir untuk kelancaran mobilitas logistik.',
                'sort_order' => 5,
            ],
        ];

        foreach ($gallery as $item) {
            GalleryItem::create($item);
        }

        // 7. Portfolios
        Portfolio::query()->delete();
        $portfolios = [
            [
                'title' => 'Konsolidasi Ekspor LCL Tekstil & Garmen ke Asia Tenggara',
                'slug' => 'konsolidasi-ekspor-lcl-tekstil-asia',
                'client' => 'Mitra Manufaktur Tekstil Nasional',
                'route' => 'Jakarta (IDTPP) -> Singapore (SGSIN) -> Port Klang (MYPKG)',
                'cargo_type' => 'LCL Textile & Garment Cargo',
                'description' => 'Pengiriman kargo gabungan LCL tepat waktu dengan penanganan packing aman dan penyelesaian dokumen ekspor PEB jalur hijau.',
                'image' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'completion_date' => '2026-03-15',
                'sort_order' => 1,
            ],
            [
                'title' => 'Pengiriman Kontainer Penuh (FCL) Komponen Mesin Industri',
                'slug' => 'pengiriman-fcl-komponen-mesin-industri',
                'client' => 'PT Manufaktur Presisi Indonesia',
                'route' => 'Yokohama (JPYOK) -> Tanjung Priok, Jakarta (IDTPP)',
                'cargo_type' => 'Full Container Load (FCL) High Cube',
                'description' => 'Solusi import FCL menyeluruh dengan customs clearance PPJK cepat dan trucking langsung ke fasilitas pabrik pelanggan.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80',
                'completion_date' => '2026-02-28',
                'sort_order' => 2,
            ],
            [
                'title' => 'Air Freight Express Spareparts Otomotif Bersertifikat DG',
                'slug' => 'air-freight-express-spareparts',
                'client' => 'Distributor Otomotif Terkemuka',
                'route' => 'Soekarno-Hatta (CGK) -> Changi (SIN)',
                'cargo_type' => 'Air Freight Express Cargo',
                'description' => 'Pengurusan cepat dokumen AWB dan penanganan kepabeanan bandara dengan waktu transit prioritas dalam 24 jam.',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80',
                'completion_date' => '2026-01-20',
                'sort_order' => 3,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }

        // 8. Testimonials
        Testimonial::query()->delete();
        $testimonials = [
            [
                'name' => 'Irwan Wijaya',
                'company' => 'PT Mitra Ekspor Nusantara',
                'position' => 'Logistics Director',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'content' => 'Pelayanan ekspor-impor dari PT. Consoltainer Transport Logistics sangat profesional. Biaya transparan sesuai komitmen dan koordinasi kepabeanan PPJK berjalan tanpa kendala.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'Clarissa Tan',
                'company' => 'Global Freight Forwarding Partner',
                'position' => 'Supply Chain Manager',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'content' => 'Sebagai bagian dari Pan Groups, reputasi CTL dalam penanganan kargo laut dan darat sangat andal. Pemantauan vehicle tracker real-time memudahkan kami menginformasikan posisi muatan kepada customer.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'name' => 'H. Achmad Subagyo',
                'company' => 'CV Makmur Sentosa Abadi',
                'position' => 'Managing Director',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                'content' => 'Tim operasionalnya sangat responsif dan sigap menyelesaikan prosedur dokumentasi ekspor. Jadwal pelayaran teratur dan aman hingga sampai ke tujuan.',
                'rating' => 5,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
