<!DOCTYPE html>
<html lang="th" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= esc($title ?? 'thutil - ระบบเครื่องมือ Utility สำหรับคนไทย รวมเครื่องมือคำนวณออนไลน์') ?></title>
    <meta name="description" content="<?= esc($metaDesc ?? 'ศูนย์รวมเครื่องมือ Utility ออนไลน์สำหรับคนไทยฟรี คำนวณค่างวดรถ ผ่อนบ้านโปะบ้าน ผลรวมเบอร์มงคล แก้พิมพ์ผิดภาษา พร้อมเพย์ QR ตรวจเลขบัตรประชาชน และ GIS ที่ดินไทย 100% Zero Storage') ?>">
    <meta name="keywords" content="<?= esc($keywords ?? 'คำนวณค่างวดรถ, ผ่อนบ้าน, โปะบ้าน, ผลรวมเบอร์มงคล, ลืมเปลี่ยนภาษา, พร้อมเพย์ qr, เลขบัตรประชาชน 13 หลัก, แปลงเลขเป็นตัวอ่าน, bahttext, gis ที่ดินไทย') ?>">
    <link rel="canonical" href="<?= current_url() ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <!-- Open Graph & Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="th_TH">
    <meta property="og:site_name" content="thutil - เครื่องมือ Utility สำหรับคนไทย">
    <meta property="og:title" content="<?= esc($title ?? 'thutil - เครื่องมือ Utility สำหรับคนไทย') ?>">
    <meta property="og:description" content="<?= esc($metaDesc ?? 'ศูนย์รวมเครื่องมือ Utility ออนไลน์สำหรับคนไทยฟรี 100% Zero Storage ปลอดภัย ไม่เก็บข้อมูล') ?>">
    <meta property="og:url" content="<?= current_url() ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($title ?? 'thutil') ?>">
    <meta name="twitter:description" content="<?= esc($metaDesc ?? 'เครื่องมือ Utility สำหรับคนไทย') ?>">

    <!-- JSON-LD Structured Data Schema for Google & AI Search Crawlers -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "thutil",
        "url": "<?= current_url() ?>",
        "description": "<?= esc($metaDesc ?? 'ศูนย์รวมเครื่องมือ Utility ออนไลน์สำหรับคนไทยฟรี') ?>",
        "applicationCategory": "UtilitiesApplication",
        "operatingSystem": "All",
        "inLanguage": "th-TH",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "THB"
        }
    }
    </script>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>th</text></svg>">
    
    <!-- Design System CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    
    <!-- Leaflet CSS for GIS Mapping -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Page Specific Schema.org Structured Data (FAQPage, HowTo, SoftwareApplication) -->
    <?= $this->renderSection('json_ld') ?>
</head>
<body>
    <!-- App Header -->
    <header class="app-header">
        <div class="header-left">
            <button id="sidebar-toggle-btn" class="sidebar-toggle-btn" aria-label="Toggle Navigation">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <a href="<?= base_url('/') ?>" class="brand-logo">
                <span class="logo-badge">th</span>
                <span>thutil</span>
            </a>
            
            <nav class="header-nav">
                <a href="<?= base_url('/') ?>" class="nav-link <?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>">หน้าหลัก</a>
                <a href="<?= base_url('tools/tax') ?>" class="nav-link <?= ($activeNav ?? '') === 'tax' ? 'active' : '' ?>">คำนวณภาษี</a>
                <a href="<?= base_url('tools/car-loan') ?>" class="nav-link <?= ($activeNav ?? '') === 'car_loan' ? 'active' : '' ?>">ค่างวดรถ</a>
                <a href="<?= base_url('tools/gis') ?>" class="nav-link <?= ($activeNav ?? '') === 'gis' ? 'active' : '' ?>">GIS ที่ดินไทย</a>
            </nav>
        </div>

        <div class="header-center">
            <div class="search-box">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="global-search-input" placeholder="ค้นหา เช่น ค่างวดรถ, ผ่อนบ้าน, เบอร์มงคล, ลืมเปลี่ยนภาษา, พร้อมเพย์...">
                <span class="search-shortcut">⌘K</span>
            </div>
        </div>

        <div class="header-right">
            <a href="<?= base_url('terms') ?>" class="btn-terms <?= ($activeNav ?? '') === 'terms' ? 'active' : '' ?>" title="เงื่อนไขการใช้งาน">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <span>เงื่อนไขการใช้งาน</span>
            </a>
            <button class="btn-icon" onclick="toggleTheme()" title="สลับธีม สว่าง/มืด" aria-label="Toggle Theme">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="4"></circle>
                    <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"></path>
                </svg>
            </button>
        </div>
    </header>

    <!-- App Container -->
    <div class="app-container">
        <!-- Backdrop for mobile drawer -->
        <div id="sidebar-backdrop" class="sidebar-backdrop"></div>

        <!-- Sidebar Navigation -->
        <aside id="app-sidebar" class="app-sidebar">
            <!-- Dynamic Pinned Favorites Section -->
            <div id="sidebar-favorites-section" class="sidebar-section" style="display: none; border-bottom: 1px solid var(--border-color); padding-bottom: 0.65rem;">
                <div class="sidebar-title" style="color: #d97706; display: flex; align-items: center; gap: 0.35rem;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <span>เครื่องมือโปรด (Favorites)</span>
                </div>
                <ul class="tool-nav-list" id="sidebar-favorites-list">
                    <!-- Injected by JS -->
                </ul>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-title">เมนูหลัก</div>
                <ul class="tool-nav-list">
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>">
                        <a href="<?= base_url('/') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                                    <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                                    <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                                    <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                                </svg>
                            </span>
                            <span>ศูนย์รวมเครื่องมือ (Overview)</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Category: Financial Loans & Tax (High Search) -->
            <div class="sidebar-section">
                <div class="sidebar-title">การเงิน ภาษี & สินเชื่อ (ยอดฮิต)</div>
                <ul class="tool-nav-list">
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'tax' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/tax') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="12" y1="18" x2="12" y2="12"></line>
                                    <line x1="9" y1="15" x2="15" y2="15"></line>
                                </svg>
                            </span>
                            <span>คำนวณภาษีบุคคลธรรมดา</span>
                            <span class="tool-nav-badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border-color: transparent;">2567-2568</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'car-loan' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/car-loan') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.2 1 12 1 12.8V16c0 .6.4 1 1 1h2"></path>
                                    <circle cx="7" cy="17" r="2"></circle>
                                    <circle cx="17" cy="17" r="2"></circle>
                                </svg>
                            </span>
                            <span>คำนวณค่างวดรถ (VAT 7%)</span>
                            <span class="tool-nav-badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border-color: transparent;">ยอดนิยม</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'home-loan' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/home-loan') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </span>
                            <span>คำนวณผ่อนบ้าน & โปะบ้าน</span>
                            <span class="tool-nav-badge">ลดต้นดอก</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'compound-interest' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/compound-interest') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </span>
                            <span>คำนวณดอกเบี้ยทบต้น & ออม DCA</span>
                            <span class="tool-nav-badge">เกษียณ</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'salary' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/salary') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                    <line x1="2" y1="10" x2="22" y2="10"></line>
                                </svg>
                            </span>
                            <span>คำนวณเงินเดือน & ประกันสังคม</span>
                            <span class="tool-nav-badge">750 บ.</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'vat-tax' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/vat-tax') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1-2-1Z"></path>
                                    <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path>
                                </svg>
                            </span>
                            <span>คำนวณ VAT 7% & หัก ณ ที่จ่าย</span>
                            <span class="tool-nav-badge">ภาษี</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'bahttext' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/bahttext') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="2" x2="12" y2="22"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </span>
                            <span>แปลงเลขเป็นตัวอ่านไทย</span>
                            <span class="tool-nav-badge">บาทถ้วน</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Category: Utilities, Health & Daily Life -->
            <div class="sidebar-section">
                <div class="sidebar-title">สาธารณูปโภค สุขภาพ & ประจำวัน</div>
                <ul class="tool-nav-list">
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'electricity' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/electricity') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                            </span>
                            <span>คำนวณค่าไฟบ้าน & แอร์</span>
                            <span class="tool-nav-badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border-color: transparent;">MEA/PEA</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'bmi-bmr' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/bmi-bmr') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </span>
                            <span>คำนวณ BMI & BMR TDEE</span>
                            <span class="tool-nav-badge">สุขภาพไทย</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'random' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/random') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                                    <path d="M8 8h.01M16 8h.01M12 12h.01M8 16h.01M16 16h.01"></path>
                                </svg>
                            </span>
                            <span>สุ่มตัวเลข & สุ่มรายชื่อ จับฉลาก</span>
                            <span class="tool-nav-badge">สุ่มรางวัล</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'image-converter' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/image-converter') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                                    <circle cx="9" cy="9" r="2"></circle>
                                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                </svg>
                            </span>
                            <span>แปลงไฟล์รูป & ย่อขนาดภาพ</span>
                            <span class="tool-nav-badge">WebP/JPG</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'lucky-phone' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/lucky-phone') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                </svg>
                            </span>
                            <span>ทำนายผลรวมเบอร์มงคล 10 หลัก</span>
                            <span class="tool-nav-badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981; border-color: transparent;">สายมู</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'keyboard-fix' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/keyboard-fix') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="M6 8h.01M10 8h.01M14 8h.01M18 8h.01M8 12h.01M12 12h.01M16 12h.01M7 16h10"></path>
                                </svg>
                            </span>
                            <span>แก้ลืมเปลี่ยนภาษา (ไทย <-> EN)</span>
                            <span class="tool-nav-badge">แป้นพิมพ์</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'word-counter' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/word-counter') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </span>
                            <span>นับจำนวนคำ & ตัวอักษรไทย</span>
                            <span class="tool-nav-badge">SEO</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'age' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/age') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <line x1="16" y1="2" y2="6"></line>
                                    <line x1="8" y1="2" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </span>
                            <span>คำนวณอายุ & เทียบวันเวลา</span>
                            <span class="tool-nav-badge">พ.ศ./ค.ศ.</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'era' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/era') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </span>
                            <span>แปลงศักราชไทย (พ.ศ./ร.ศ./จ.ศ.)</span>
                            <span class="tool-nav-badge">ศักราช</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'holidays' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/holidays') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"></path>
                                </svg>
                            </span>
                            <span>วันหยุดราชการ & วันทำการ</span>
                            <span class="tool-nav-badge">ปฏิทิน</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Category: GIS & Postcode -->
            <div class="sidebar-section">
                <div class="sidebar-title">ภูมิสารสนเทศ & แผนที่</div>
                <ul class="tool-nav-list">
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'gis' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/gis') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon>
                                    <line x1="9" x2="9" y1="3" y2="18"></line>
                                    <line x1="15" x2="15" y1="6" y2="21"></line>
                                </svg>
                            </span>
                            <span>เครื่องมือ GIS & ที่ดินไทย</span>
                            <span class="tool-nav-badge">UTM/ไร่-วา</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'postcode' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/postcode') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </span>
                            <span>ค้นหารหัสไปรษณีย์ไทย 77 จว.</span>
                            <span class="tool-nav-badge">ไปรษณีย์</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Category: Identity & Codes -->
            <div class="sidebar-section">
                <div class="sidebar-title">รหัส ตัวตน & นักพัฒนา</div>
                <ul class="tool-nav-list">
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'thai-id' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/thai-id') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="14" x="3" y="5" rx="2"></rect>
                                    <path d="M7 15h4M15 15h2M7 11h2M13 11h4"></path>
                                </svg>
                            </span>
                            <span>ตรวจเลขบัตรประชาชน 13 หลัก</span>
                            <span class="tool-nav-badge">Modulo 11</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'qrcode' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/qrcode') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                                    <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                                    <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                                    <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                                </svg>
                            </span>
                            <span>สร้าง QR Code ฟรี & พร้อมเพย์</span>
                            <span class="tool-nav-badge">EMVCo</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'barcode' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/barcode') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 5v14M7 5v14M11 5v14M15 5v14M19 5v14M21 5v14"></path>
                                </svg>
                            </span>
                            <span>สร้างบาร์โค้ดสินค้าไทย (885)</span>
                            <span class="tool-nav-badge">EAN-13</span>
                        </a>
                    </li>
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'mock-thai' ? 'active' : '' ?>">
                        <a href="<?= base_url('tools/mock-thai') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            <span>สุ่มข้อมูลคนไทย (Mock Data)</span>
                            <span class="tool-nav-badge">Dev/QA</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Terms / Policy -->
            <div class="sidebar-section" style="border-top: 1px solid var(--border-color); padding-top: 0.6rem; padding-bottom: 0.6rem;">
                <ul class="tool-nav-list">
                    <li class="tool-nav-item <?= ($activeNav ?? '') === 'terms' ? 'active' : '' ?>">
                        <a href="<?= base_url('terms') ?>">
                            <span class="tool-nav-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                </svg>
                            </span>
                            <span>เงื่อนไขการใช้งาน (Terms)</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <div style="display: flex; align-items: center; gap: 0.35rem;">
                    <button id="btn-sidebar-collapse" class="btn-icon" style="width: 28px; height: 28px;" title="หุบแถบเมนูด้านข้าง (ขยายจอทำงาน)">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="11 17 6 12 11 7"></polyline>
                            <polyline points="18 17 13 12 18 7"></polyline>
                        </svg>
                    </button>
                    <button id="btn-sidebar-wide" class="btn-icon" style="width: 28px; height: 28px;" title="ขยายแถบเมนูด้านข้างกว้างขึ้น">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                    </button>
                </div>
                <span class="tag-badge">23 เครื่องมือ</span>
            </div>
        </aside>

        <!-- Main Workspace View -->
        <main class="app-content">
            <!-- Default Landing Tool Redirect Banner -->
            <div id="default-tool-banner" class="default-tool-banner" style="display: none;">
                <div style="display: flex; align-items: center; gap: 0.6rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>เข้าสู่หน้านี้อัตโนมัติตามที่คุณตั้งค่าเป็นเครื่องมือเริ่มต้นไว้ (บันทึกในอุปกรณ์ผ่าน localStorage)</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <a href="<?= base_url('/?stay=1') ?>" style="font-weight: 700; text-decoration: underline; color: inherit;">ไปยังหน้าแรก (ศูนย์รวมเครื่องมือ)</a>
                    <button type="button" id="btn-banner-clear-default" class="btn-pref" style="background: rgba(0,0,0,0.06); padding: 0.2rem 0.6rem;">ยกเลิกหน้าเริ่มต้น</button>
                </div>
            </div>

            <?php if (($activeNav ?? '') !== 'home' && ($activeNav ?? '') !== 'terms'): ?>
            <!-- Tool Quick Preferences Bar (Favorites & Default Landing Tool) -->
            <div class="tool-pref-bar" id="tool-pref-bar" data-tool-slug="<?= esc($activeNav ?? '') ?>" data-tool-title="<?= esc($title ?? '') ?>" data-tool-url="<?= current_url() ?>">
                <button type="button" id="btn-toggle-fav" class="btn-pref" title="ติดดาวเครื่องมือโปรด">
                    <svg class="pref-star-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span id="fav-label">เพิ่มในรายการโปรด</span>
                </button>
                <button type="button" id="btn-toggle-default-tool" class="btn-pref btn-pref-default" title="ตั้งเป็นหน้าเริ่มต้นเมื่อเปิดเว็บ">
                    <svg class="pref-pin-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="17" x2="12" y2="22"></line>
                        <path d="M5 17h14v-1.76a2 2 0 0 0-1.11-1.79l-1.78-.9A2 2 0 0 1 15 10.76V6h1a1 1 0 0 0 0-2H8a1 1 0 0 0 0 2h1v4.76a2 2 0 0 1-1.11 1.79l-1.78.9A2 2 0 0 0 5 15.24Z"></path>
                    </svg>
                    <span id="default-tool-label">ตั้งเป็นหน้าเริ่มต้น (เปิดเว็บแล้วเจอเลย)</span>
                </button>
            </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>

            <!-- Formal Footer for Gen Y & Public -->
            <footer class="formal-footer" style="margin-top: 3.5rem; padding: 1.5rem 0 1rem; border-top: 1px solid var(--border-color); font-size: 0.85rem; color: var(--text-muted); display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
                <div>
                    <strong style="color: var(--text-primary);">thutil</strong> — ศูนย์รวมเครื่องมือ Utility ออนไลน์สำหรับคนไทย (100% Zero Storage ไร้การบันทึกข้อมูลส่วนบุคคล)
                </div>
                <div style="display: flex; gap: 1.5rem; align-items: center;">
                    <a href="<?= base_url('terms') ?>" style="color: var(--green-primary); font-weight: 600; text-decoration: underline;">
                        เงื่อนไขการใช้งาน & ข้อจำกัดความรับผิดชอบ
                    </a>
                    <span>© <?= date('Y') ?> thutil</span>
                </div>
            </footer>
        </main>
    </div>

    <!-- Mobile Bottom Navigation Bar (Floating Pill) -->
    <nav class="mobile-bottom-nav">
        <a href="<?= base_url('/') ?>" class="mobile-nav-item <?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>หน้าแรก</span>
        </a>
        <button id="mobile-btn-menu" class="mobile-nav-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                <rect width="7" height="7" x="3" y="14" rx="1"></rect>
            </svg>
            <span>เครื่องมือ</span>
        </button>
        <button id="mobile-btn-search" class="mobile-nav-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <span>ค้นหา</span>
        </button>
        <button onclick="toggleTheme()" class="mobile-nav-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"></path>
            </svg>
            <span>สลับธีม</span>
        </button>
    </nav>

    <!-- Core Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="<?= base_url('assets/js/webapp.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
