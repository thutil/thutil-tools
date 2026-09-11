<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเขียน & วิเคราะห์ข้อความ</span>
        <h1 class="workspace-title">นับจำนวนคำภาษาไทย & ตัวอักษร (Word Counter)</h1>
        <p class="workspace-subtitle">
            นับจำนวนคำภาษาไทยแม่นยำด้วยเอนจินตัดคำ นับพยางค์ นับตัวอักษรไม่รวมสระวรรณยุกต์ และคำนวณเวลาที่ใช้ในการอ่าน เหมาะสำหรับนักเขียนและ SEO
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">วางข้อความหรือบทความที่ต้องการนับ</h2>
            <span class="tag-badge">นับทันทีขณะพิมพ์</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="word-count-input">เนื้อหาข้อความ</label>
            <textarea id="word-count-input" class="form-control" rows="10" placeholder="พิมพ์หรือวางข้อความภาษาไทยที่นี่..."></textarea>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">สถิติการวิเคราะห์ข้อความ</h2>
            <span class="tag-badge">Intl.Segmenter</span>
        </div>

        <div class="result-box" style="margin-top: 0; margin-bottom: 1rem;">
            <div class="result-header">
                <span class="result-label">จำนวนคำทั้งหมด (Word Count)</span>
            </div>
            <div id="res-count-words" class="result-text" style="font-size: 2.2rem; color: #10b981;">
                0
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">ตัวอักษรทั้งหมด (รวมเว้นวรรค)</div>
                <div id="res-count-chars-space" class="stat-value">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ตัวอักษร (ไม่รวมเว้นวรรค)</div>
                <div id="res-count-chars-nospace" class="stat-value">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">พยัญชนะไทย (ก-ฮ)</div>
                <div id="res-count-consonants" class="stat-value">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">สระและวรรณยุกต์บน-ล่าง</div>
                <div id="res-count-vowels" class="stat-value">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">จำนวนบรรทัด / ย่อหน้า</div>
                <div id="res-count-lines" class="stat-value">0</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">เวลาที่ใช้ในการอ่านโดยประมาณ</div>
                <div id="res-count-read-time" class="stat-value" style="font-size: 0.95rem;">-</div>
            </div>
        </div>
    </div>
</div>

<!-- SEO & FAQ Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">ทำไมนับคำภาษาไทยถึงยากกว่าภาษาอังกฤษ? (FAQ)</h2>
        <span class="tag-badge">ภาษาศาสตร์และ SEO</span>
    </div>
    <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ทำไมการนับคำภาษาไทยถึงไม่สามารถนับจากช่องว่าง (Space) ได้?</h3>
        <p style="margin-bottom: 1rem;">
            A: ภาษาไทยเขียนคำติดกันโดยไม่มีการเว้นวรรคคั่นระหว่างคำเหมือนภาษาอังกฤษ การนับคำภาษาไทยจึงต้องใช้พจนานุกรมและการตัดคำ (Word Segmentation) ตามมาตรฐานสากล ซึ่งเครื่องมือนี้ใช้เอนจิน Intl.Segmenter ในเบราว์เซอร์ จึงตัดคำได้อย่างแม่นยำและรวดเร็ว
        </p>
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: จำนวนคำที่เหมาะสมสำหรับบทความ SEO และโพสต์โซเชียลมีเดียคือเท่าใด?</h3>
        <p>
            A: สำหรับบทความ SEO บน Google ควรมีความยาวอย่างน้อย 800 - 1,500 คำขึ้นไป ส่วนแคปชันโพสต์ Facebook หรือ Instagram ควรอยู่ที่ 50 - 150 คำเพื่อให้อ่านกระชับบนหน้าจอมือถือ
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/word-counter.js') ?>"></script>
<?= $this->endSection() ?>
