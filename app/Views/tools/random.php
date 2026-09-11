<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมสุ่มวงล้อหมุน ตู้สล็อต สุ่มตัวเลข และจับฉลากออนไลน์",
            "url": "<?= current_url() ?>",
            "description": "โปรแกรมสุ่มวงล้อหมุนเสี่ยงทาย (Lucky Spin Wheel) ตู้สล็อตสุ่มรางวัล สุ่มตัวเลข สุ่มรายชื่อผู้โชคดี จับฉลากปีใหม่ มีเอฟเฟกต์พลุและเสียงปุ้งป้างเร้าใจ ยุติธรรม 100% ด้วย Cryptographic Random",
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
                        "text": "สามารถทำได้ โดยกดปุ่ม 'โหมด Focus นำเสนอขึ้นจอ (Presenter View)' ระบบจะขยายเต็มหน้าจอ พร้อมเอฟเฟกต์พลุไฟและเสียงยินดีเมื่อมีผู้ชนะ สามารถกดปุ่ม Spacebar เพื่อหมุนสุ่มได้ทันที"
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

<!-- Winner Celebration Modal Popup -->
<div id="winner-popup-modal" class="winner-popup-modal">
    <div class="winner-popup-card">
        <div class="winner-badge-crown">👑</div>
        <div class="winner-title-label">🎉 ขอแสดงความยินดีกับผู้โชคดี! 🎉</div>
        <div id="winner-name-display" class="winner-name-display">รางวัลที่ 1</div>
        <div class="winner-actions">
            <button type="button" id="btn-spin-again" class="btn-winner-primary">🎡 สุ่มใหม่อีกครั้ง</button>
            <button type="button" id="btn-remove-winner" class="btn-winner-secondary">✂️ นำรายการนี้ออก</button>
            <button type="button" id="btn-close-winner-modal" class="btn-winner-secondary">ปิด</button>
        </div>
    </div>
</div>

<div class="workspace-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
    <div class="workspace-title-group" style="flex: 1; min-width: 280px;">
        <span class="workspace-category" style="background: linear-gradient(90deg, rgba(245,158,11,0.15), rgba(236,72,153,0.15)); color: #d97706; border-color: #fde68a;">
            🎡 กิจกรรม บันเทิง & สุ่มจับฉลาก
        </span>
        <h1 class="workspace-title" style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
            <span>สุ่มวงล้อหมุน ตู้สล็อต & จับฉลากออนไลน์</span>
            <span class="tag-badge" style="background: #fef3c7; color: #b45309; border-color: #fcd34d;">มีพลุ & เอฟเฟกต์ 🎆</span>
        </h1>
        <p class="workspace-subtitle">
            วงล้อหมุนเสี่ยงทาย (Lucky Wheel) ตู้สล็อตสุ่มผู้โชคดี สุ่มจับฉลากของขวัญปีใหม่ สุ่มตัวเลข และสุ่มแบ่งกลุ่มทีม พร้อมเสียงเอฟเฟกต์และพลุปุ้งป้างสมจริง!
        </p>
    </div>
    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
        <button type="button" id="btn-toggle-sound" class="btn-outline" style="padding: 0.55rem 0.95rem; font-size: 0.9rem; gap: 0.4rem;" title="เปิด/ปิด เสียงประกอบ">
            <span id="sound-icon">🔊</span>
            <span id="sound-label">เสียง: เปิด</span>
        </button>
        <button type="button" id="btn-fireworks-test" class="btn-outline" style="padding: 0.55rem 0.95rem; font-size: 0.9rem; gap: 0.4rem;" title="ทดสอบยิงพลุฉลอง">
            <span>🎆</span>
            <span>ยิงพลุ</span>
        </button>
        <button type="button" id="btn-open-focus-mode" class="btn-primary" style="padding: 0.55rem 1.15rem; font-size: 0.9rem; gap: 0.5rem; white-space: nowrap; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
            </svg>
            <span>โหมด Focus ขึ้นจอ (Presenter View)</span>
        </button>
    </div>
</div>

<!-- Tabs to Switch Mode -->
<div class="category-chips-bar" style="margin-bottom: 1.5rem;">
    <button type="button" id="tab-rand-wheel" class="chip-btn active" style="font-weight: 700;">🎡 วงล้อหมุนเสี่ยงทาย (Lucky Wheel)</button>
    <button type="button" id="tab-rand-slot" class="chip-btn" style="font-weight: 700;">🎰 ตู้สล็อต Lucky Draw (Slot Machine)</button>
    <button type="button" id="tab-rand-names" class="chip-btn">🎁 สุ่มรายชื่อ / จับฉลาก (Name Picker)</button>
    <button type="button" id="tab-rand-numbers" class="chip-btn">🔢 สุ่มตัวเลข (Number Generator)</button>
    <button type="button" id="tab-rand-teams" class="chip-btn">👥 สุ่มแบ่งกลุ่มทีม (Team Shuffler)</button>
</div>

<!-- Mode 1: Lucky Spin Wheel (Featured Wow!) -->
<div id="panel-rand-wheel">
    <div class="tool-grid-2">
        <!-- Wheel Visual Stage -->
        <div class="wheel-card">
            <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; margin-bottom: 0.5rem;">
                <span class="tag-badge" style="background: rgba(245,158,11,0.2); color: #f59e0b; border-color: #f59e0b;">Physics Spin Wheel</span>
                <span style="font-size: 0.85rem; color: #94a3b8;" id="wheel-items-count-badge">8 ตัวเลือก</span>
            </div>

            <div class="wheel-stage">
                <!-- Pointer Needle pointing down at top of wheel -->
                <svg id="wheel-pointer" class="wheel-pointer" viewBox="0 0 40 50">
                    <polygon points="20,48 5,8 35,8" fill="#ef4444" stroke="#ffffff" stroke-width="3"/>
                    <circle cx="20" cy="12" r="6" fill="#facc15" stroke="#ffffff" stroke-width="2"/>
                </svg>

                <!-- HTML5 Canvas for Wheel -->
                <canvas id="wheel-canvas" width="440" height="440" class="wheel-canvas"></canvas>

                <!-- Center Golden Spin Knob Button -->
                <button type="button" id="wheel-center-btn" class="wheel-center-btn" title="คลิกเพื่อหมุน!">
                    <span>หมุน!</span>
                    <span style="font-size: 0.65rem; font-weight: 700; opacity: 0.85;">SPIN</span>
                </button>
            </div>

            <button type="button" id="btn-spin-wheel" class="btn-wheel-spin">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
                </svg>
                <span>หมุนวงล้อเสี่ยงโชค (Spacebar)</span>
            </button>
        </div>

        <!-- Wheel Settings & Items List -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">รายการในวงล้อหมุน</h2>
                <span class="tag-badge">ใส่ได้ไม่จำกัด</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="wheel-items-input">ตัวเลือก / รางวัล / รายชื่อ (บรรทัดละ 1 ข้อความ)</label>
                <textarea id="wheel-items-input" class="form-control" rows="8" placeholder="รางวัลที่ 1&#10;รางวัลที่ 2&#10;รางวัลที่ 3...">รางวัลที่ 1 (ทองคำ 1 สลึง)
รางวัลที่ 2 (พัดลมตั้งโต๊ะ)
รางวัลที่ 3 (แก้วเก็บความเย็น)
รางวัลที่ 4 (บัตรกำนัล 500 บ.)
รางวัลที่ 5 (กาแฟฟรี 1 สัปดาห์)
ข้าวมันไก่พิเศษใส่ไข่
รางวัลปลอบใจ (ขนมปี๊บ)
โชคดีรอบหน้า (สู้ๆ นะ)</textarea>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <span class="form-label" style="margin-bottom: 0.45rem;">แม่แบบยอดนิยม (คลิกเพื่อเปลี่ยนชุดคำ):</span>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="food">🍜 เที่ยงนี้กินอะไรดี</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="prizes">🎁 จับฉลากของขวัญ</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="yesno">🎯 ใช่ หรือ ไม่ (Yes/No)</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="numbers">🎲 ตัวเลข 1 ถึง 10</button>
                    <button type="button" class="btn-copy btn-preset-wheel" data-preset="party">🍻 ใครจ่ายรอบนี้</button>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.85rem;">
                    <input type="checkbox" id="wheel-remove-winner-auto" style="accent-color: #10b981;"> ตัดรายการที่ชนะออกจากวงล้ออัตโนมัติ
                </label>
                <button type="button" id="btn-update-wheel" class="btn-outline" style="padding: 0.35rem 0.75rem; font-size: 0.85rem;">
                    อัปเดตวงล้อ
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Mode 2: Lucky Slot Machine -->
<div id="panel-rand-slot" style="display: none;">
    <div class="slot-machine-card">
        <div style="display: flex; justify-content: space-between; align-items: center; max-width: 620px; margin: 0 auto;">
            <span class="tag-badge" style="background: rgba(236,72,153,0.25); color: #f472b6; border-color: #ec4899;">LUCKY 777 REEL</span>
            <span style="font-size: 0.85rem; color: #cbd5e1;">ตู้สล็อตสุ่มตัวเลข & รางวัล</span>
        </div>

        <div class="slot-frame">
            <div id="slot-reel-1" class="slot-reel">7</div>
            <div id="slot-reel-2" class="slot-reel">7</div>
            <div id="slot-reel-3" class="slot-reel">7</div>
        </div>

        <div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
            <button type="button" id="btn-pull-slot" class="btn-slot-pull">
                <span>🎰</span>
                <span>โยกคันโยก / สุ่มสล็อต (Spacebar)</span>
            </button>
        </div>

        <div style="max-width: 500px; margin: 0 auto; display: flex; gap: 1rem; justify-content: center; background: rgba(0,0,0,0.3); padding: 0.75rem 1.25rem; border-radius: 12px;">
            <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.9rem; color: #f1f5f9;">
                <input type="radio" name="slot-type" value="numbers" checked style="accent-color: #f59e0b;"> สุ่มตัวเลขนำโชค (0-9)
            </label>
            <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.9rem; color: #f1f5f9;">
                <input type="radio" name="slot-type" value="names" style="accent-color: #f59e0b;"> สุ่มตามรายชื่อจับฉลาก
            </label>
        </div>
    </div>
</div>

<!-- Mode 3: Name Picker / Lucky Draw -->
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

            <button type="button" id="btn-pick-names" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                🎁 จับฉลากหาผู้โชคดี (พร้อมยิงพลุ!)
            </button>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">รายชื่อผู้ได้รับรางวัล</h2>
                <span class="tag-badge">Lucky Winners</span>
            </div>

            <div id="res-names-display" style="min-height: 200px; padding: 1rem; background: var(--bg-primary); border: 1px dashed var(--border-color); border-radius: 12px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div style="text-align: center; color: var(--text-muted); font-size: 0.9rem;">
                    กดปุ่ม "จับฉลากหาผู้โชคดี" เพื่อเปิดผลรางวัลพร้อมพลุฉลอง
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mode 4: Number Generator -->
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

            <button type="button" id="btn-roll-numbers" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem;">
                สุ่มตัวเลขทันที
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

<!-- Mode 5: Team Shuffler -->
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

            <button type="button" id="btn-shuffle-teams" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem;">
                สุ่มแบ่งกลุ่มทีมทันที
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

<!-- Fullscreen Focus Presenter Modal (Stage Presentation) -->
<div id="focus-presenter-modal" class="focus-presenter-modal" style="display: none;">
    <div class="focus-presenter-header">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <span class="logo-badge" style="width: 32px; height: 32px; font-size: 0.95rem; background: #f59e0b;">🎡</span>
            <div style="text-align: left;">
                <div style="font-weight: 800; font-size: 1.1rem; color: var(--text-primary); line-height: 1.2;">
                    โหมด Focus นำเสนอขึ้นจอ (Presenter View)
                </div>
                <div style="font-size: 0.78rem; color: var(--text-muted);">
                    ฉายขึ้นโปรเจกเตอร์ ทีวี งานปีใหม่ งานเลี้ยงบริษัท สตรีมมิ่ง หรือจับฉลากสด
                </div>
            </div>
        </div>
        
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div class="category-chips-bar" style="margin-bottom: 0;">
                <button type="button" id="focus-tab-wheel" class="chip-btn active" style="padding: 0.35rem 0.85rem; font-size: 0.85rem;">วงล้อหมุน 🎡</button>
                <button type="button" id="focus-tab-names" class="chip-btn" style="padding: 0.35rem 0.85rem; font-size: 0.85rem;">จับฉลากรายชื่อ 🎁</button>
                <button type="button" id="focus-tab-numbers" class="chip-btn" style="padding: 0.35rem 0.85rem; font-size: 0.85rem;">สุ่มตัวเลข 🔢</button>
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
        <!-- Stage Hero Display -->
        <div class="focus-hero-display" style="background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%); border-color: #f59e0b;">
            <div id="focus-sub-title" class="focus-hero-label" style="color: #fde047;">🎉 ผู้โชคดี / ผลลัพธ์ล่าสุด</div>
            <div id="focus-main-result" class="focus-hero-number" style="color: #ffffff; text-shadow: 0 0 30px rgba(251, 191, 36, 0.7);">
                READY
            </div>
            <div id="focus-meta-text" class="focus-hero-meta" style="color: #cbd5e1;">
                กดปุ่มด้านล่าง หรือกดปุ่ม Spacebar / Enter บนแป้นพิมพ์เพื่อสุ่มพร้อมเอฟเฟกต์พลุ
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

        <div class="focus-bottom-panel">
            <div class="focus-quick-config" id="focus-config-wheel">
                <span>วงล้อ: มี <strong id="focus-lbl-wheel-count">8</strong> รายการในระบบ</span>
                <span class="tag-badge">กด Spacebar สุ่มด่วน</span>
            </div>
            <div class="focus-quick-config" id="focus-config-names" style="display: none;">
                <span>การตั้งค่า: รายชื่อผู้ร่วมลุ้นรางวัล <strong id="focus-lbl-names-count">0</strong> คน</span>
                <span class="tag-badge">กด Spacebar สุ่มด่วน</span>
            </div>
            <div class="focus-quick-config" id="focus-config-numbers" style="display: none;">
                <span>การตั้งค่า: ช่วง Min <strong id="focus-lbl-min">1</strong> ถึง Max <strong id="focus-lbl-max">100</strong></span>
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
