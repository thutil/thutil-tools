<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมสุ่มตัวเลข สุ่มรายชื่อผู้โชคดี จับฉลากออนไลน์",
            "url": "<?= current_url() ?>",
            "description": "โปรแกรมสุ่มตัวเลข สุ่มเลข 2 ตัว 3 ตัว สุ่มจับฉลากของขวัญ สุ่มรายชื่อผู้โชคดี และแบ่งกลุ่มสุ่มอัตโนมัติ ยุติธรรมด้วยระบบสุ่มเข้ารหัส Crypto ปลอดภัย 100%",
            "applicationCategory": "UtilitiesApplication",
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
                    "name": "โปรแกรมสุ่มตัวเลขนี้มีความยุติธรรมและโปร่งใสแค่ไหน?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "thutil ใช้ Web Cryptography API (window.crypto.getRandomValues) ซึ่งเป็นอัลกอริทึมการสุ่มระดับการเข้ารหัสความปลอดภัยสูง (Cryptographically Secure Pseudo-Random Number Generator - CSPRNG) ไม่สามารถคาดเดาหรือล็อกผลลัพธ์ล่วงหน้าได้ และทำงานบนเบราว์เซอร์ของคุณ 100% จึงมั่นใจได้ในความยุติธรรมและโปร่งใส"
                    }
                },
                {
                    "@type": "Question",
                    "name": "สามารถสุ่มรายชื่อผู้โชคดีโดยไม่ให้ซ้ำคนเดิมได้หรือไม่?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "สามารถทำได้ โดยในแท็บ 'สุ่มรายชื่อ / จับฉลาก' คุณสามารถติ๊กเลือก 'นำรายชื่อผู้ที่ได้รางวัลแล้วออกจากรายการครั้งถัดไป' เพื่อให้การจับฉลากในรอบถัดไปไม่ซ้ำกับผู้ที่ได้รับรางวัลไปแล้ว"
                    }
                }
            ]
        }
    ]
}
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">เครื่องมือประจำวัน & กิจกรรม</span>
        <h1 class="workspace-title">สุ่มตัวเลข สุ่มรายชื่อผู้โชคดี & จับฉลากออนไลน์</h1>
        <p class="workspace-subtitle">
            สุ่มตัวเลขกำหนดช่วง สุ่มเลข 2 ตัว 3 ตัว สุ่มจับฉลากของขวัญปีใหม่ สุ่มรายชื่อผู้โชคดี และสุ่มแบ่งกลุ่มทีม ยุติธรรม 100% ด้วย Cryptographic Random
        </p>
    </div>
</div>

<!-- Tabs to Switch Mode -->
<div class="category-chips-bar" style="margin-bottom: 1.25rem;">
    <button type="button" id="tab-rand-numbers" class="chip-btn active">สุ่มตัวเลข (Number Generator)</button>
    <button type="button" id="tab-rand-names" class="chip-btn">สุ่มรายชื่อ / จับฉลาก (Name Picker)</button>
    <button type="button" id="tab-rand-teams" class="chip-btn">สุ่มแบ่งกลุ่มทีม (Team Shuffler)</button>
</div>

<!-- Mode 1: Number Generator -->
<div id="panel-rand-numbers">
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

<!-- Mode 2: Name Picker / Lucky Draw -->
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
กิตติศักดิ์ พูลผล</textarea>
            </div>

            <div class="form-row" style="margin-bottom: 1.25rem;">
                <div class="form-group" style="flex: 1; margin-bottom: 0;">
                    <label class="form-label" for="rand-winners-count">จำนวนผู้โชคดี</label>
                    <input type="number" id="rand-winners-count" class="form-control" value="1" min="1" max="50">
                </div>
                <div class="form-group" style="flex: 1; margin-bottom: 0; display: flex; align-items: flex-end;">
                    <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.85rem; padding-bottom: 0.6rem;">
                        <input type="checkbox" id="rand-remove-winners" style="accent-color: #10b981;"> ตัดชื่อคนที่ได้รางวัลออก
                    </label>
                </div>
            </div>

            <button type="button" id="btn-pick-names" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem;">
                จับฉลากหาผู้โชคดี
            </button>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">รายชื่อผู้ได้รับรางวัล</h2>
                <span class="tag-badge">Lucky Winners</span>
            </div>

            <div id="res-names-display" style="min-height: 200px; padding: 1rem; background: var(--bg-primary); border: 1px dashed var(--border-color); border-radius: 12px;">
                <div style="text-align: center; color: var(--text-muted); font-size: 0.9rem; padding-top: 3rem;">
                    กดปุ่ม "จับฉลากหาผู้โชคดี" เพื่อเปิดผลรางวัล
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mode 3: Team Shuffler -->
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/random.js') ?>"></script>
<?= $this->endSection() ?>
