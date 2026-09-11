<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebSite",
            "name": "thutil - ระบบเครื่องมือ Utility สำหรับคนไทย",
            "url": "<?= base_url('/') ?>",
            "description": "ศูนย์รวมเครื่องมือ Utility ออนไลน์สำหรับคนไทยฟรี คำนวณภาษีบุคคลธรรมดา 2567-2568 คำนวณค่างวดรถ ผ่อนบ้านโปะบ้าน ค่าไฟบ้าน MEA/PEA ดัชนีมวลกาย BMI ดอกเบี้ยทบต้น DCA ผลรวมเบอร์มงคล แก้พิมพ์ผิดภาษา พร้อมเพย์ QR ตรวจเลขบัตรประชาชน และ GIS ที่ดินไทย 100% Zero Storage ปลอดภัย ไม่เก็บข้อมูล",
            "inLanguage": "th-TH"
        },
        {
            "@type": "WebApplication",
            "name": "thutil Utility Hub",
            "url": "<?= base_url('/') ?>",
            "applicationCategory": "UtilitiesApplication",
            "operatingSystem": "All",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "THB"
            }
        }
    ]
}
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- E-Filing Inspired Portal Hero -->
<section class="efiling-hero">
    <h1 class="efiling-hero-title">ศูนย์รวมเครื่องมือคำนวณและบริการออนไลน์สำหรับคนไทย</h1>
    <p class="efiling-hero-desc">
        ออกแบบด้วยโทนสีเขียวสะอาดตา เรียบง่าย ใช้งานสะดวกรวดเร็วตามแบบฉบับบริการสาธารณะยุคใหม่ ปลอดภัยสูงสุดด้วยนโยบาย Zero Storage ไร้การบันทึกข้อมูลส่วนบุคคลลงเซิร์ฟเวอร์
    </p>
    <div class="efiling-hero-actions">
        <a href="<?= base_url('tools/tax') ?>" class="btn-primary btn-lg">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="12" y1="18" x2="12" y2="12"></line>
                <line x1="9" y1="15" x2="15" y2="15"></line>
            </svg>
            <span>คำนวณภาษีเงินได้ 2567-2568</span>
        </a>
        <a href="<?= base_url('tools/car-loan') ?>" class="btn-outline btn-lg">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                <circle cx="7" cy="17" r="2"></circle>
                <path d="M9 17h6"></path>
                <circle cx="17" cy="17" r="2"></circle>
            </svg>
            <span>คำนวณค่างวดรถยนต์ (VAT 7%)</span>
        </a>
    </div>
    <div class="efiling-hero-meta">
        <span>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
            ความปลอดภัยสูง ไร้การบันทึกข้อมูลส่วนบุคคล (Zero Storage)
        </span>
        <span>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 14 14"></polyline>
            </svg>
            คำนวณทันทีบนเครื่อง ไม่ส่งข้อมูลออกนอกเบราว์เซอร์
        </span>
        <span>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            23 เครื่องมือครอบคลุมทุกด้าน
        </span>
    </div>
</section>

<!-- Featured Spotlight Cards (RD Prep & RD Payroll Reference Style) -->
<div class="spotlight-grid">
    <div class="spotlight-card">
        <div>
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                <h2 class="spotlight-card-title">โปรแกรมคำนวณภาษีเงินได้บุคคลธรรมดา ภ.ง.ด. 90/91</h2>
                <span class="tag-badge">ปีภาษี 2567/2568</span>
            </div>
            <p class="spotlight-card-desc">
                รองรับการคำนวณเงินได้พึงประเมิน หักค่าใช้จ่าย 50% สูงสุด 1 แสนบาท สิทธิลดหย่อนกองทุน ThaiESG 300,000 บาท ดอกเบี้ยบ้าน ประกันสังคม ประกันชีวิต และสรุปยอดขอคืนภาษีอัตโนมัติ
            </p>
        </div>
        <div class="spotlight-card-footer">
            <span style="font-size: 0.8rem; color: var(--text-muted);">อัตราก้าวหน้า 0-35% ตามเกณฑ์สรรพากร</span>
            <a href="<?= base_url('tools/tax') ?>" class="btn-primary" style="padding: 0.45rem 1rem; font-size: 0.85rem;">
                คำนวณภาษีทันที
            </a>
        </div>
    </div>

    <div class="spotlight-card">
        <div>
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                <h2 class="spotlight-card-title">คำนวณค่างวดรถยนต์ & ผ่อนบ้านโปะบ้านลดดอกเบี้ย</h2>
                <span class="tag-badge">สินเชื่อยอดนิยม</span>
            </div>
            <p class="spotlight-card-desc">
                คำนวณค่างวดเช่าซื้อรถยนต์ ดอกเบี้ยคงที่ (Flat Rate) บวก VAT 7% พร้อมตารางผ่อนบ้านแบบลดต้นลดดอก คำนวณเงินโปะที่ช่วยประหยัดดอกเบี้ยได้หลักแสนบาทและหมดหนี้เร็วขึ้นหลายปี
            </p>
        </div>
        <div class="spotlight-card-footer">
            <span style="font-size: 0.8rem; color: var(--text-muted);">สูตรไฟแนนซ์ & ธนาคารมาตรฐาน</span>
            <div style="display: flex; gap: 0.5rem;">
                <a href="<?= base_url('tools/car-loan') ?>" class="btn-primary" style="padding: 0.45rem 0.85rem; font-size: 0.85rem;">ค่างวดรถ</a>
                <a href="<?= base_url('tools/home-loan') ?>" class="btn-outline" style="padding: 0.45rem 0.85rem; font-size: 0.85rem;">ผ่อน/โปะบ้าน</a>
            </div>
        </div>
    </div>
</div>

<!-- Recommended Services Section Header (แนะนำบริการ) -->
<div class="service-section-banner">
    <h2 class="service-section-title">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--green-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="7" height="7" x="3" y="3" rx="1"></rect>
            <rect width="7" height="7" x="14" y="3" rx="1"></rect>
            <rect width="7" height="7" x="14" y="14" rx="1"></rect>
            <rect width="7" height="7" x="3" y="14" rx="1"></rect>
        </svg>
        แนะนำบริการ & ศูนย์รวมเครื่องมือทั้งหมด
    </h2>
    <div class="service-section-ribbon"></div>
</div>

<!-- Category Chips Bar (Quick Filters) -->
<div class="category-chips-bar">
    <button class="chip-btn active" data-category="all">ทั้งหมด (23 เครื่องมือ)</button>
    <button class="chip-btn" data-category="finance">การเงิน & ภาษี</button>
    <button class="chip-btn" data-category="utility">สาธารณูปโภค & สุขภาพ</button>
    <button class="chip-btn" data-category="lifestyle">ไลฟ์สไตล์ & ปฏิทิน</button>
    <button class="chip-btn" data-category="gis">ภูมิสารสนเทศ & แผนที่</button>
    <button class="chip-btn" data-category="identity">รหัส & นักพัฒนา</button>
</div>

<!-- Tools Overview Grid (23 Tools) -->
<div class="overview-grid">
    <!-- 1. Tax Calculator (Top Search) -->
    <a href="<?= base_url('tools/tax') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </div>
                <span class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">2567-2568</span>
            </div>
            <h3 class="overview-card-title">คำนวณภาษีเงินได้บุคคลธรรมดา (ภ.ง.ด. 90/91)</h3>
            <p class="overview-card-desc">
                คำนวณเงินได้สุทธิ อัตราภาษีก้าวหน้า 0-35% สิทธิลดหย่อน ThaiESG 3 แสน ประกันสังคม ดอกเบี้ยบ้าน สรุปยอดเงินคืนภาษีทันที
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 2. Electricity Bill & AC Calculator -->
    <a href="<?= base_url('tools/electricity') ?>" class="overview-card" data-category="utility">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </div>
                <span class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">MEA / PEA</span>
            </div>
            <h3 class="overview-card-title">คำนวณค่าไฟบ้าน & แอร์กินไฟกี่บาท</h3>
            <p class="overview-card-desc">
                คำนวณค่าไฟอัตราก้าวหน้า ค่าบริการ ค่า Ft ปัจจุบัน VAT 7% พร้อมโหมดคำนวณเปิดแอร์ 9000-24000 BTU ตู้เย็น พัดลม ชาร์จรถ EV
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 3. BMI & BMR TDEE Calculator -->
    <a href="<?= base_url('tools/bmi-bmr') ?>" class="overview-card" data-category="utility">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <span class="tag-badge">เกณฑ์คนไทย</span>
            </div>
            <h3 class="overview-card-title">คำนวณ BMI & BMR TDEE (กรมอนามัย)</h3>
            <p class="overview-card-desc">
                คำนวณดัชนีมวลกายเกณฑ์เอเชียแปซิฟิก ประเมินความอ้วน อัตราเผาผลาญพื้นฐาน และแคลอรี่แนะนำต่อวันเพื่อลดน้ำหนักอย่างถูกวิธี
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 4. Compound Interest & DCA Calculator -->
    <a href="<?= base_url('tools/compound-interest') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <span class="tag-badge">วางแผนเกษียณ</span>
            </div>
            <h3 class="overview-card-title">คำนวณดอกเบี้ยทบต้น & ออม DCA</h3>
            <p class="overview-card-desc">
                คำนวณพลังของดอกเบี้ยทบต้น ออมเงินสมทบรายเดือน แสดงสัดส่วนเงินต้นและกำไรสะสม พร้อมตารางการเติบโตรายปี
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 5. Random Numbers & Lucky Draw Names -->
    <a href="<?= base_url('tools/random') ?>" class="overview-card" data-category="utility">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                        <path d="M8 8h.01M16 8h.01M12 12h.01M8 16h.01M16 16h.01"></path>
                    </svg>
                </div>
                <span class="tag-badge">สุ่มรางวัล</span>
            </div>
            <h3 class="overview-card-title">สุ่มตัวเลข & สุ่มรายชื่อ จับฉลาก</h3>
            <p class="overview-card-desc">
                สุ่มตัวเลขกำหนดช่วง สุ่มเลข 2 ตัว 3 ตัว สุ่มจับฉลากของขวัญปีใหม่ สุ่มรายชื่อผู้โชคดี และแบ่งกลุ่มสุ่มอัตโนมัติ
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 6. Image Converter & Compressor -->
    <a href="<?= base_url('tools/image-converter') ?>" class="overview-card" data-category="utility">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                        <circle cx="9" cy="9" r="2"></circle>
                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                    </svg>
                </div>
                <span class="tag-badge">Zero Storage</span>
            </div>
            <h3 class="overview-card-title">แปลงไฟล์รูป & ย่อขนาดภาพ</h3>
            <p class="overview-card-desc">
                แปลง WebP เป็น JPG, PNG เป็น JPG บีบอัดลดขนาดภาพไม่เกิน 500KB หรือ 2MB สำหรับสมัครงานและส่งเอกสารราชการไทย
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 7. Car Loan Calculator -->
    <a href="<?= base_url('tools/car-loan') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C1.4 11.2 1 12 1 12.8V16c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <span class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">Flat Rate + VAT 7%</span>
            </div>
            <h3 class="overview-card-title">คำนวณค่างวดรถ (ตารางผ่อนรถ)</h3>
            <p class="overview-card-desc">
                คำนวณค่างวดรถยนต์และมอเตอร์ไซค์ตามสูตรไฟแนนซ์ไทย ดอกเบี้ยคงที่ รวมภาษีมูลค่าเพิ่ม 7% และเทียบดอกเบี้ยแท้จริง
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 8. Home Loan & Prepayment -->
    <a href="<?= base_url('tools/home-loan') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <span class="tag-badge">ลดต้นลดดอก</span>
            </div>
            <h3 class="overview-card-title">คำนวณผ่อนบ้าน & โปะบ้านลดดอกเบี้ย</h3>
            <p class="overview-card-desc">
                คำนวณสินเชื่อบ้านแบบลดต้นลดดอก (Effective Rate) คำนวณเงินโปะบ้านช่วยประหยัดดอกเบี้ยกี่บาท และผ่อนหมดเร็วขึ้นกี่ปี
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 9. Lucky Phone Number Prediction -->
    <a href="<?= base_url('tools/lucky-phone') ?>" class="overview-card" data-category="lifestyle">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                    </svg>
                </div>
                <span class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">สายมูยอดฮิต</span>
            </div>
            <h3 class="overview-card-title">ทำนายผลรวมเบอร์มงคล 10 หลัก</h3>
            <p class="overview-card-desc">
                ตรวจผลรวมเบอร์มือถือ วิเคราะห์คู่เลขความหมายดี/ร้าย เสริมดวงการเงิน การงาน ความรักตามตำราเลขศาสตร์ไทย
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 10. Keyboard Fixer (Thai-English Typo) -->
    <a href="<?= base_url('tools/keyboard-fix') ?>" class="overview-card" data-category="lifestyle">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="M6 8h.01M10 8h.01M14 8h.01M18 8h.01M8 12h.01M12 12h.01M16 12h.01M7 16h10"></path>
                    </svg>
                </div>
                <span class="tag-badge">แป้นเกษมณี</span>
            </div>
            <h3 class="overview-card-title">แก้ลืมเปลี่ยนภาษา (ไทย &lt;-&gt; EN)</h3>
            <p class="overview-card-desc">
                แปลงข้อความพิมพ์ผิดภาษาทันที เช่น 'g-hk' เป็น 'สวัสดี' หรือ '9y;o' เป็น 'hello' สลับภาษาได้สองทางอัตโนมัติ
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 11. QR Code & PromptPay -->
    <a href="<?= base_url('tools/qrcode') ?>" class="overview-card" data-category="identity">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                        <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                        <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                        <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                    </svg>
                </div>
                <span class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">สแกนได้จริง 100%</span>
            </div>
            <h3 class="overview-card-title">สร้าง QR Code ฟรี & พร้อมเพย์</h3>
            <p class="overview-card-desc">
                สร้าง QR พร้อมเพย์มาตรฐาน ธปท. (EMVCo) ระบุยอดเงินได้ สแกนจ่ายผ่านแอปธนาคารไทยได้ 100% ปลอดภัยแบบ Zero Storage
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 12. Thai National ID 13 Digits -->
    <a href="<?= base_url('tools/thai-id') ?>" class="overview-card" data-category="identity">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="14" x="3" y="5" rx="2"></rect>
                        <path d="M7 15h4M15 15h2M7 11h2M13 11h4"></path>
                    </svg>
                </div>
                <span class="tag-badge">Modulo 11</span>
            </div>
            <h3 class="overview-card-title">ตรวจเลขบัตรประชาชน 13 หลัก</h3>
            <p class="overview-card-desc">
                ตรวจสอบความถูกต้องของเลขประจำตัวประชาชนไทยด้วยอัลกอริทึม Modulo 11 จัดรูปแบบขีดคั่น และสุ่มเลขสำหรับทดสอบระบบ
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 13. Thai Baht Text -->
    <a href="<?= base_url('tools/bahttext') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="2" x2="12" y2="22"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <span class="tag-badge">บาทถ้วน</span>
            </div>
            <h3 class="overview-card-title">แปลงเลขเป็นตัวอ่านไทย (BAHTTEXT)</h3>
            <p class="overview-card-desc">
                แปลงตัวเลขอารบิกเป็นตัวหนังสือภาษาไทย ทั้งรูปแบบจำนวนเงินบาท (สตางค์) สำหรับพิมพ์เช็ค/ใบเสร็จ และการอ่านตัวเลขทั่วไป
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 14. Net Salary & Social Security -->
    <a href="<?= base_url('tools/salary') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                        <line x1="2" y1="10" x2="22" y2="10"></line>
                    </svg>
                </div>
                <span class="tag-badge">มนุษย์เงินเดือน</span>
            </div>
            <h3 class="overview-card-title">คำนวณเงินเดือนสุทธิ & ประกันสังคม</h3>
            <p class="overview-card-desc">
                คำนวณเงินเดือนสุทธิที่ได้รับจริง (Take-Home Pay) หักประกันสังคม 5% (สูงสุด 750 บาท) กองทุนสำรองเลี้ยงชีพ และภาษี
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 15. VAT 7% & Withholding Tax -->
    <a href="<?= base_url('tools/vat-tax') ?>" class="overview-card" data-category="finance">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1-2-1Z"></path>
                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path>
                    </svg>
                </div>
                <span class="tag-badge">ภาษีมูลค่าเพิ่ม</span>
            </div>
            <h3 class="overview-card-title">คำนวณ VAT 7% & หัก ณ ที่จ่าย</h3>
            <p class="overview-card-desc">
                คำนวณภาษีมูลค่าเพิ่ม 7% แบบรวมใน (Inclusive) และแยกนอก (Exclusive) พร้อมหัก ณ ที่จ่าย 1%, 2%, 3%, 5% ออกใบแจ้งหนี้
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 16. Age & Date Difference -->
    <a href="<?= base_url('tools/age') ?>" class="overview-card" data-category="lifestyle">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                        <line x1="16" y1="2" y2="6"></line>
                        <line x1="8" y1="2" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <span class="tag-badge">พ.ศ./ค.ศ.</span>
            </div>
            <h3 class="overview-card-title">คำนวณอายุ & เปรียบเทียบวันเวลา</h3>
            <p class="overview-card-desc">
                คำนวณอายุจากปีเกิด พ.ศ. หรือ ค.ศ. บอกจำนวนปี เดือน วัน ชั่วโมง วันเกิดถัดไป และเทียบระยะห่างระหว่าง 2 วันที่
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 17. Thai Word Counter -->
    <a href="<?= base_url('tools/word-counter') ?>" class="overview-card" data-category="lifestyle">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <span class="tag-badge">SEO</span>
            </div>
            <h3 class="overview-card-title">นับจำนวนคำ & ตัวอักษรไทย</h3>
            <p class="overview-card-desc">
                นับจำนวนคำภาษาไทยด้วย Intl.Segmenter ตัดคำถูกต้อง ไม่รวมสระบน-ล่าง/วรรณยุกต์ซ้ำซ้อน เหมาะสำหรับนักเขียนบทความ SEO
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 18. Thai GIS & Land Converter -->
    <a href="<?= base_url('tools/gis') ?>" class="overview-card" data-category="gis">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon>
                        <line x1="9" x2="9" y1="3" y2="18"></line>
                        <line x1="15" x2="15" y1="6" y2="21"></line>
                    </svg>
                </div>
                <span class="tag-badge">UTM / ไร่-งาน-วา</span>
            </div>
            <h3 class="overview-card-title">เครื่องมือ GIS & แปลงหน่วยที่ดินไทย</h3>
            <p class="overview-card-desc">
                แปลงพิกัด WGS84 Lat/Lon เป็น UTM 47N/48N, Indian 1975, แปลงหน่วยที่ดินไทย (ไร่-งาน-ตารางวา) เป็น ตร.ม./เฮกตาร์ พร้อมแผนที่ Leaflet
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 19. Thai Postcode Lookup -->
    <a href="<?= base_url('tools/postcode') ?>" class="overview-card" data-category="gis">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <span class="tag-badge">77 จังหวัด</span>
            </div>
            <h3 class="overview-card-title">ค้นหารหัสไปรษณีย์ไทย 77 จังหวัด</h3>
            <p class="overview-card-desc">
                ค้นหารหัสไปรษณีย์ไทย ค้นหาจากชื่อตำบล อำเภอ หรือจังหวัด แสดงข้อมูลแม่นยำ พร้อมคัดลอกรหัสทันที
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 20. Thai Era Converter -->
    <a href="<?= base_url('tools/era') ?>" class="overview-card" data-category="lifestyle">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <span class="tag-badge">ศักราชไทย</span>
            </div>
            <h3 class="overview-card-title">แปลงศักราชไทย (พ.ศ./ร.ศ./จ.ศ.)</h3>
            <p class="overview-card-desc">
                แปลงปีพุทธศักราช คริสต์ศักราช รัตนโกสินทรศก จุลศักราช มหาศักราช และตรวจสอบปีอธิกสุรทิน (Leap Year)
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 21. Thai Holidays & Business Days -->
    <a href="<?= base_url('tools/holidays') ?>" class="overview-card" data-category="lifestyle">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"></path>
                    </svg>
                </div>
                <span class="tag-badge">ปฏิทินไทย</span>
            </div>
            <h3 class="overview-card-title">วันหยุดราชการ & วันทำการ</h3>
            <p class="overview-card-desc">
                ปฏิทินวันหยุดนักขัตฤกษ์ไทย และคำนวณจำนวนวันทำการราชการระหว่าง 2 วัน (ตัดวันหยุดและเสาร์-อาทิตย์)
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 22. Thai Barcode EAN-13 -->
    <a href="<?= base_url('tools/barcode') ?>" class="overview-card" data-category="identity">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 5v14M7 5v14M11 5v14M15 5v14M19 5v14M21 5v14"></path>
                    </svg>
                </div>
                <span class="tag-badge">บาร์โค้ด 885</span>
            </div>
            <h3 class="overview-card-title">สร้างบาร์โค้ดสินค้าไทย (885)</h3>
            <p class="overview-card-desc">
                สร้างบาร์โค้ดมาตรฐานสากล EAN-13 รหัสประเทศไทย 885 คำนวณ Check Digit อัตโนมัติ ดาวน์โหลดเป็น SVG คมชัด
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>

    <!-- 23. Mock Thai Data Generator -->
    <a href="<?= base_url('tools/mock-thai') ?>" class="overview-card" data-category="identity">
        <div>
            <div class="overview-card-header">
                <div class="overview-icon-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                </div>
                <span class="tag-badge">นักพัฒนา</span>
            </div>
            <h3 class="overview-card-title">สุ่มข้อมูลคนไทย (Mock Thai Data)</h3>
            <p class="overview-card-desc">
                สุ่มชื่อ-นามสกุลไทย เลขบัตรประชาชน เบอร์โทร ที่อยู่ไทย ส่งออก JSON สำหรับทดสอบระบบ (QA / Test / Mock Database)
            </p>
        </div>
        <div class="overview-card-footer">
            <span>เข้าสู่เครื่องมือ</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </a>
</div>
<?= $this->endSection() ?>
