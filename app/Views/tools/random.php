<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมสุ่มวงล้อหมุน สุ่มตัวเลข และจับฉลากออนไลน์",
            "url": "<?= current_url() ?>",
            "description": "โปรแกรมสุ่มวงล้อหมุนเสี่ยงทาย (Lucky Spin Wheel) ในโหมด Focus นำเสนอขึ้นจอ สุ่มตัวเลข สุ่มรายชื่อผู้โชคดี จับฉลากปีใหม่ มีเอฟเฟกต์พลุและเสียงประกอบ ยุติธรรม 100% ด้วย Cryptographic Random",
            "applicationCategory": "GameApplication",
            "operatingSystem": "All",
            "inLanguage": "th-TH",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "THB"
            }
        },
        {
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "โปรแกรมสุ่มวงล้อและจับฉลากนี้มีความยุติธรรมและโปร่งใสแค่ไหน?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "thutil ใช้ Web Cryptography API (window.crypto.getRandomValues) และระบบฟิสิกส์การหมุนจริง ไม่มีการล็อกผลลัพธ์ล่วงหน้า ทำงานบนเบราว์เซอร์ของคุณ 100% ปลอดภัย ยุติธรรม และโปร่งใส"
                    }
                },
                {
                    "@type": "Question",
                    "name": "สามารถนำขึ้นจอโปรเจกเตอร์หรือทีวีในงานเลี้ยงได้หรือไม่?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "สามารถทำได้ โดยกดปุ่ม 'โหมด Focus นำเสนอขึ้นจอ (Presenter View)' วงล้อหมุนจะแสดงผลเต็มหน้าจอ พร้อมเอฟเฟกต์พลุไฟและเสียงยินดีเมื่อมีผู้ชนะ สามารถกดปุ่ม Spacebar เพื่อหมุนสุ่มได้ทันที"
                    }
                }
            ]
        }
    ]
}
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Fullscreen Celebration Fireworks & Confetti Canvas -->
<canvas id="celebration-canvas" class="celebration-canvas"></canvas>

<!-- Winner Celebration Modal Popup (No Emojis, Pure SVG Icons) -->
<div id="winner-popup-modal" class="winner-popup-modal">
    <div class="winner-popup-card">
        <div style="display: flex; justify-content: center; margin-bottom: 0.75rem;">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: rgba(245,158,11,0.2); border: 2px solid #f59e0b; display: flex; align-items: center; justify-content: center;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                    <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                    <path d="M4 22h16"></path>
                    <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                    <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                </svg>
            </div>
        </div>
        <div class="winner-title-label">ขอแสดงความยินดีกับผู้โชคดี</div>
        <div id="winner-name-display" class="winner-name-display">รางวัลที่ 1</div>
        <div class="winner-actions">
            <button type="button" id="btn-spin-again" class="btn-winner-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
                </svg>
                <span>สุ่มใหม่อีกครั้ง</span>
            </button>
            <button type="button" id="btn-remove-winner" class="btn-winner-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="6" cy="6" r="3"></circle>
                    <circle cx="6" cy="18" r="3"></circle>
                    <line x1="20" y1="4" x2="8.12" y2="15.88"></line>
                    <line x1="14.47" y1="14.48" x2="20" y2="20"></line>
                    <line x1="8.12" y1="8.12" x2="12" y2="12"></line>
                </svg>
                <span>นำรายการนี้ออก</span>
            </button>
            <button type="button" id="btn-close-winner-modal" class="btn-winner-secondary">
                <span>ปิด</span>
            </button>
        </div>
    </div>
</div>

<div class="workspace-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
    <div class="workspace-title-group" style="flex: 1; min-width: 280px;">
        <span class="workspace-category">เครื่องมือกิจกรรม & การสุ่ม</span>
        <h1 class="workspace-title">สุ่มตัวเลข สุ่มรายชื่อผู้โชคดี & วงล้อจับฉลากออนไลน์</h1>
        <p class="workspace-subtitle">
            สุ่มตัวเลขกำหนดช่วง สุ่มเลข 2 ตัว 3 ตัว วงล้อหมุนเสี่ยงทายในโหมด Focus สุ่มจับฉลากของขวัญ และแบ่งกลุ่มทีม พร้อมเสียงเอฟเฟกต์และพลุฉลอง
        </p>
    </div>
    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
        <button type="button" id="btn-toggle-sound" class="btn-outline" style="padding: 0.55rem 0.95rem; font-size: 0.9rem; gap: 0.45rem;" title="เปิด/ปิด เสียงประกอบ">
            <span id="sound-icon-container">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                </svg>
            </span>
            <span id="sound-label">เสียง: เปิด</span>
        </button>
        <button type="button" id="btn-fireworks-test" class="btn-outline" style="padding: 0.55rem 0.95rem; font-size: 0.9rem; gap: 0.45rem;" title="ทดสอบเอฟเฟกต์พลุฉลอง">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
            </svg>
            <span>ทดสอบพลุ</span>
        </button>
        <button type="button" id="btn-open-focus-mode" class="btn-primary" style="padding: 0.55rem 1.15rem; font-size: 0.9rem; gap: 0.5rem; white-space: nowrap;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
            </svg>
            <span>โหมด Focus นำเสนอขึ้นจอ (Presenter View)</span>
        </button>
    </div>
</div>

<!-- Tabs to Switch Mode -->
<div class="category-chips-bar" style="margin-bottom: 1.5rem;">
    <button type="button" id="tab-rand-wheel" class="chip-btn active" style="font-weight: 700; display: inline-flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="2" x2="12" y2="22"></line>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
        <span>วงล้อเสี่ยงทาย & จับฉลาก (Lucky Wheel)</span>
    </button>
    <button type="button" id="tab-rand-names" class="chip-btn" style="display: inline-flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 12 20 22 4 22 4 12"></polyline>
            <rect width="20" height="5" x="2" y="7"></rect>
            <line x1="12" y1="22" x2="12" y2="7"></line>
            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
        </svg>
        <span>สุ่มรายชื่อผู้โชคดี (Name Picker)</span>
    </button>
    <button type="button" id="tab-rand-numbers" class="chip-btn" style="display: inline-flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="4" y1="9" x2="20" y2="9"></line>
            <line x1="4" y1="15" x2="20" y2="15"></line>
            <line x1="10" y1="3" x2="8" y2="21"></line>
            <line x1="16" y1="3" x2="14" y2="21"></line>
        </svg>
        <span>สุ่มตัวเลข (Number Generator)</span>
    </button>
    <button type="button" id="tab-rand-teams" class="chip-btn" style="display: inline-flex; align-items: center; gap: 0.4rem;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
        <span>สุ่มแบ่งกลุ่มทีม (Team Shuffler)</span>
    </button>
</div>

<!-- Tab 1: Wheel Configuration (Clean Setup on Main page, Play exclusively in Focus Mode) -->
<div id="panel-rand-wheel">
    <div class="tool-grid-2">
        <!-- Configuration Card -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ตั้งค่ารายการในวงล้อเสี่ยงโชค</h2>
                <span class="tag-badge" id="wheel-items-count-badge">8 ตัวเลือก</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="wheel-items-input">ตัวเลือก / รางวัล / รายชื่อ (บรรทัดละ 1 ข้อความ)</label>
                <textarea id="wheel-items-input" class="form-control" rows="8" placeholder="รางวัลที่ 1&#10;รางวัลที่ 2&#10;รางวัลที่ 3...">รางวัลที่ 1 (ทองคำ 1 สลึง)
รางวัลที่ 2 (พัดลมตั้งโต๊ะ)
รางวัลที่ 3 (แก้วเก็บความเย็น)
รางวัลที่ 4 (บัตรกำนัล 500 บาท)
รางวัลที่ 5 (กาแฟฟรี 1 สัปดาห์)
ข้าวมันไก่พิเศษใส่ไข่
รางวัลปลอบใจ (ขนมปี๊บ)
โชคดีรอบหน้า (สู้ๆ นะ)</textarea>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <span class="form-label" style="margin-bottom: 0.45rem;">ชุดแม่แบบสำเร็จรูป:</span>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="food">อาหารกลางวัน</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="prizes">จับฉลากของขวัญ</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="yesno">ใช่ หรือ ไม่ (Yes/No)</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="numbers">ตัวเลข 1 ถึง 10</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="party">ใครรับผิดชอบรอบนี้</button>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.85rem;">
                    <input type="checkbox" id="wheel-remove-winner-auto" style="accent-color: #10b981;"> นำรายการที่ได้รางวัลแล้วออกจากวงล้ออัตโนมัติ
                </label>
                <button type="button" id="btn-update-wheel" class="btn-outline" style="padding: 0.35rem 0.75rem; font-size: 0.85rem;">
                    บันทึกรายการ
                </button>
            </div>
        </div>

        <!-- Call To Action Card to Launch Focus Mode -->
        <div class="panel-card" style="display: flex; flex-direction: column; justify-content: space-between; background: linear-gradient(145deg, var(--bg-surface) 0%, var(--bg-card) 100%);">
            <div>
                <div class="card-title-bar">
                    <h2 class="card-title">เวทีวงล้อเสี่ยงโชค (Presenter Stage)</h2>
                    <span class="tag-badge">โหมด Focus</span>
                </div>
                <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 1.5rem; font-size: 0.95rem;">
                    วงล้อหมุนเสี่ยงทายความละเอียดสูง รองรับการนำเสนอเต็มหน้าจอ (Fullscreen Presenter Mode) 
                    พร้อมระบบฟิสิกส์การชะลอความเร็ว เสียงติ๊กเข็มชี้ และเอฟเฟกต์พลุฉลองชัยชนะ เหมาะอย่างยิ่งสำหรับฉายจอโปรเจกเตอร์ ทีวี หรือใช้งานในงานเลี้ยง
                </p>

                <div style="background: var(--bg-subtle); border: 1.5px solid var(--border-color); border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <div style="font-weight: 700; font-size: 0.9rem; color: var(--text-primary); margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>จุดเด่นของเวทีวงล้อ Focus</span>
                    </div>
                    <ul style="color: var(--text-muted); font-size: 0.875rem; line-height: 1.65; padding-left: 1.25rem; margin: 0;">
                        <li>การหมุนแบบฟิสิกส์ลื่นไหล 60 FPS พร้อมเข็มชี้ดีดตัวสมจริง</li>
                        <li>กดหมุนได้สะดวกด้วยปุ่ม Spacebar บนคีย์บอร์ด</li>
                        <li>ยิงพลุเฉลิมฉลองและเปิดป๊อปอัปประกาศชื่อผู้ชนะโดยอัตโนมัติ</li>
                        <li>บันทึกประวัติผู้โชคดีเรียงตามลำดับแบบ Real-time</li>
                    </ul>
                </div>
            </div>

            <button type="button" id="btn-launch-wheel-focus" class="btn-primary" style="width: 100%; font-size: 1.1rem; padding: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.6rem;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="2" x2="12" y2="22"></line>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <span>เปิดเล่นวงล้อหมุนในโหมด Focus ทันที</span>
            </button>
        </div>
    </div>
</div>

<!-- Tab 2: Name Picker / Lucky Draw -->
<div id="panel-rand-names" style="display: none;">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ใส่รายชื่อผู้เข้าร่วมจับฉลาก</h2>
                <span class="tag-badge">บรรทัดละ 1 ชื่อ</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="rand-names-input">รายชื่อ (พิมพ์หรือวางรายชื่อคนละบรรทัด)</label>
                <textarea id="rand-names-input" class="form-control" rows="8" placeholder="สมชาย ใจดี&#10;สมหญิง มั่งคั่ง&#10;วิชัย รุ่งเรือง&#10;กานดา มีสุข&#10;อนุชา ก้าวหน้า">สมชาย ใจดี
สมหญิง มั่งคั่ง
วิชัย รุ่งเรือง
กานดา มีสุข
อนุชา ก้าวหน้า
กิตติศักดิ์ พูลผล
ธนวัฒน์ เจริญสุข
พิมพา บุญรักษา</textarea>
            </div>

            <div class="form-row" style="margin-bottom: 1.25rem;">
                <div class="form-group" style="flex: 1; margin-bottom: 0;">
                    <label class="form-label" for="rand-winners-count">จำนวนผู้โชคดีที่ต้องการสุ่ม</label>
                    <input type="number" id="rand-winners-count" class="form-control" value="1" min="1" max="50">
                </div>
                <div class="form-group" style="flex: 1; margin-bottom: 0; display: flex; align-items: flex-end;">
                    <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.85rem; padding-bottom: 0.6rem;">
                        <input type="checkbox" id="rand-remove-winners" style="accent-color: #10b981;"> ตัดชื่อคนที่ได้รางวัลออก
                    </label>
                </div>
            </div>

            <button type="button" id="btn-pick-names" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                    <rect width="20" height="5" x="2" y="7"></rect>
                    <line x1="12" y1="22" x2="12" y2="7"></line>
                </svg>
                <span>จับฉลากหาผู้โชคดี</span>
            </button>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">รายชื่อผู้ได้รับรางวัล</h2>
                <span class="tag-badge">ผลรางวัล</span>
            </div>

            <div id="res-names-display" style="min-height: 200px; padding: 1rem; background: var(--bg-primary); border: 1px dashed var(--border-color); border-radius: 12px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div style="text-align: center; color: var(--text-muted); font-size: 0.9rem;">
                    กดปุ่ม "จับฉลากหาผู้โชคดี" เพื่อเปิดผลรางวัลพร้อมพลุฉลอง
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tab 3: Number Generator -->
<div id="panel-rand-numbers" style="display: none;">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">กำหนดช่วงตัวเลขที่ต้องการสุ่ม</h2>
                <span class="tag-badge">Crypto Secure</span>
            </div>

            <div class="form-row" style="margin-bottom: 1.25rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="rand-num-min">ค่าต่ำสุด (Min)</label>
                    <input type="number" id="rand-num-min" class="form-control" value="1">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="rand-num-max">ค่าสูงสุด (Max)</label>
                    <input type="number" id="rand-num-max" class="form-control" value="100">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="rand-num-count">จำนวนตัวเลขที่ต้องการสุ่ม</label>
                <input type="number" id="rand-num-count" class="form-control" value="1" min="1" max="100">
            </div>

            <div style="display: flex; gap: 1.25rem; margin-bottom: 1.25rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.875rem;">
                    <input type="checkbox" id="rand-num-unique" checked style="accent-color: #10b981;"> ห้ามตัวเลขซ้ำ
                </label>
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.875rem;">
                    <input type="checkbox" id="rand-num-sort" style="accent-color: #10b981;"> เรียงลำดับจากน้อยไปมาก
                </label>
            </div>

            <button type="button" id="btn-roll-numbers" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="9" x2="20" y2="9"></line>
                    <line x1="4" y1="15" x2="20" y2="15"></line>
                </svg>
                <span>สุ่มตัวเลขทันที</span>
            </button>

            <div style="margin-top: 1.25rem;">
                <span class="form-label" style="margin-bottom: 0.4rem;">สุ่มด่วนยอดนิยม:</span>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button type="button" class="btn-copy btn-preset-rand" data-min="0" data-max="99" data-count="1">เลข 2 ตัว (00-99)</button>
                    <button type="button" class="btn-copy btn-preset-rand" data-min="0" data-max="999" data-count="1">เลข 3 ตัว (000-999)</button>
                    <button type="button" class="btn-copy btn-preset-rand" data-min="1" data-max="6" data-count="1">ทอยลูกเต๋า (1-6)</button>
                    <button type="button" class="btn-copy btn-preset-rand" data-min="1" data-max="100" data-count="5">สุ่ม 5 ตัว (1-100)</button>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ผลลัพธ์ตัวเลขที่สุ่มได้</h2>
                <span class="tag-badge">ผลลัพธ์</span>
            </div>

            <div id="res-numbers-display" style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; align-items: center; min-height: 180px; padding: 1.5rem; background: var(--bg-primary); border: 1px dashed var(--border-color); border-radius: 12px;">
                <!-- Numbers injected by JS -->
            </div>
        </div>
    </div>
</div>

<!-- Tab 4: Team Shuffler -->
<div id="panel-rand-teams" style="display: none;">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">รายชื่อสมาชิกที่ต้องการแบ่งกลุ่ม</h2>
                <span class="tag-badge">บรรทัดละ 1 ชื่อ</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="team-names-input">รายชื่อสมาชิก</label>
                <textarea id="team-names-input" class="form-control" rows="8" placeholder="สมาชิก 1&#10;สมาชิก 2...">สมชาย
สมหญิง
วิชัย
กานดา
อนุชา
กิตติศักดิ์
ธนวัฒน์
พิมพา</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="team-count-input">จำนวนกลุ่มที่ต้องการแบ่ง</label>
                <input type="number" id="team-count-input" class="form-control" value="2" min="2" max="20">
            </div>

            <button type="button" id="btn-shuffle-teams" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                </svg>
                <span>สุ่มแบ่งกลุ่มทีมทันที</span>
            </button>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ผลการจัดกลุ่มสมาชิก</h2>
                <span class="tag-badge">ผลลัพธ์</span>
            </div>

            <div id="res-teams-display" style="min-height: 200px; padding: 1rem; background: var(--bg-primary); border: 1px dashed var(--border-color); border-radius: 12px;">
                <div style="text-align: center; color: var(--text-muted); font-size: 0.9rem; padding-top: 3rem;">
                    กดปุ่ม "สุ่มแบ่งกลุ่มทีมทันที" เพื่อกระจายสมาชิก
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     FULLSCREEN FOCUS PRESENTER MODAL (WHERE THE GORGEOUS WHEEL LIVES!)
     ========================================================================= -->
<div id="focus-presenter-modal" class="focus-presenter-modal" style="display: none;">
    <div class="focus-presenter-header">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 34px; height: 34px; border-radius: 8px; background: #f59e0b; color: #ffffff; display: flex; align-items: center; justify-content: center;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="2" x2="12" y2="22"></line>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </div>
            <div style="text-align: left;">
                <div style="font-weight: 800; font-size: 1.1rem; color: var(--text-primary); line-height: 1.2;">
                    โหมด Focus นำเสนอขึ้นจอ (Presenter View)
                </div>
                <div style="font-size: 0.78rem; color: var(--text-muted);">
                    ฉายขึ้นโปรเจกเตอร์ ทีวี งานเลี้ยงบริษัท งานจับฉลาก หรือกิจกรรมสด
                </div>
            </div>
        </div>
        
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div class="category-chips-bar" style="margin-bottom: 0;">
                <button type="button" id="focus-tab-wheel" class="chip-btn active" style="padding: 0.35rem 0.85rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="2" x2="12" y2="22"></line>
                    </svg>
                    <span>วงล้อหมุน</span>
                </button>
                <button type="button" id="focus-tab-names" class="chip-btn" style="padding: 0.35rem 0.85rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12"></polyline>
                        <rect width="20" height="5" x="2" y="7"></rect>
                    </svg>
                    <span>รายชื่อจับฉลาก</span>
                </button>
                <button type="button" id="focus-tab-numbers" class="chip-btn" style="padding: 0.35rem 0.85rem; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.35rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="9" x2="20" y2="9"></line>
                        <line x1="4" y1="15" x2="20" y2="15"></line>
                    </svg>
                    <span>สุ่มตัวเลข</span>
                </button>
            </div>

            <button type="button" id="btn-close-focus" class="btn-outline" style="padding: 0.35rem 0.85rem; font-size: 0.85rem; min-height: 38px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                <span>ออก (Esc)</span>
            </button>
        </div>
    </div>

    <div class="focus-presenter-body">
        <!-- Wheel Mode Center Stage -->
        <div id="focus-stage-wheel" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
            <div class="wheel-stage" style="padding: 0.5rem 0 1.25rem;">
                <!-- Pointer Needle with Drop Shadow -->
                <svg id="wheel-pointer" class="wheel-pointer" viewBox="0 0 40 50">
                    <polygon points="20,48 5,8 35,8" fill="#ef4444" stroke="#ffffff" stroke-width="3"/>
                    <circle cx="20" cy="12" r="6" fill="#facc15" stroke="#ffffff" stroke-width="2"/>
                </svg>

                <!-- High-Resolution Wheel Canvas -->
                <canvas id="wheel-canvas" width="500" height="500" class="wheel-canvas" style="max-width: 90vw; max-height: 52vh;"></canvas>

                <!-- Center Knob Button -->
                <button type="button" id="wheel-center-btn" class="wheel-center-btn" title="คลิกเพื่อหมุน">
                    <span>หมุน</span>
                    <span style="font-size: 0.65rem; font-weight: 700; opacity: 0.85;">SPIN</span>
                </button>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <button type="button" id="btn-focus-spin-wheel" class="btn-primary" style="font-size: 1.25rem; font-weight: 800; padding: 0.9rem 2.8rem; background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%); border: 2px solid #fde68a; box-shadow: 0 8px 24px rgba(217, 119, 6, 0.4); display: inline-flex; align-items: center; gap: 0.65rem;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    <span>หมุนวงล้อเสี่ยงโชค (Spacebar / Enter)</span>
                </button>
            </div>
        </div>

        <!-- Names / Numbers Mode Stage (Hero Display) -->
        <div id="focus-stage-card" style="width: 100%; display: none;">
            <div class="focus-hero-display" style="background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%); border-color: #f59e0b;">
                <div id="focus-sub-title" class="focus-hero-label" style="color: #fde047;">ผู้โชคดี / ผลลัพธ์ล่าสุด</div>
                <div id="focus-main-result" class="focus-hero-number" style="color: #ffffff; text-shadow: 0 0 30px rgba(251, 191, 36, 0.7);">
                    READY
                </div>
                <div id="focus-meta-text" class="focus-hero-meta" style="color: #cbd5e1;">
                    กดปุ่มด้านล่าง หรือกด Spacebar / Enter บนแป้นพิมพ์เพื่อสุ่ม
                </div>
            </div>

            <div class="focus-action-bar">
                <button type="button" id="btn-focus-roll" class="btn-primary btn-focus-trigger" style="background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%); border: 2px solid #fde68a;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    <span>กดสุ่มทันที (Spacebar / Enter)</span>
                </button>
            </div>
        </div>

        <!-- Bottom Panel -->
        <div class="focus-bottom-panel">
            <div class="focus-quick-config" id="focus-config-wheel">
                <span>วงล้อ: บรรจุ <strong id="focus-lbl-wheel-count">8</strong> รายการ</span>
                <span class="tag-badge">กด Spacebar สุ่มด่วน</span>
            </div>
            <div class="focus-quick-config" id="focus-config-names" style="display: none;">
                <span>รายชื่อผู้ร่วมจับฉลาก: <strong id="focus-lbl-names-count">0</strong> คน</span>
                <span class="tag-badge">กด Spacebar สุ่มด่วน</span>
            </div>
            <div class="focus-quick-config" id="focus-config-numbers" style="display: none;">
                <span>ช่วงตัวเลข: Min <strong id="focus-lbl-min">1</strong> ถึง Max <strong id="focus-lbl-max">100</strong></span>
                <span class="tag-badge">กด Spacebar สุ่มด่วน</span>
            </div>

            <div class="focus-history-strip">
                <span style="font-weight: 700; font-size: 0.85rem; color: var(--text-primary); white-space: nowrap;">ประวัติที่สุ่มได้:</span>
                <div id="focus-history-items" class="focus-history-items">
                    <span style="color: var(--text-muted); font-size: 0.85rem;">ยังไม่มีประวัติการสุ่ม</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/random.js') ?>"></script>
<?= $this->endSection() ?>
