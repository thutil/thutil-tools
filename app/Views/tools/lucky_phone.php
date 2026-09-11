<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">ไลฟ์สไตล์ & ศาสตร์ตัวเลขไทย</span>
        <h1 class="workspace-title">ทำนายผลรวมเบอร์มงคล & วิเคราะห์คู่เลขมือถือ</h1>
        <p class="workspace-subtitle">
            ตรวจผลรวมตัวเลข 10 หลัก วิเคราะห์พลังงานคู่เลขมงคล เสริมดวงการเงิน การงาน เสน่ห์ และโชคลาภตามตำราเลขศาสตร์ไทย
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กรอกหมายเลขโทรศัพท์ 10 หลัก</h2>
            <span class="tag-badge">ทำนายทันที</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="lucky-phone-input">เบอร์โทรศัพท์มือถือ</label>
            <input type="text" id="lucky-phone-input" class="form-control" style="font-size: 1.35rem; font-weight: 700; letter-spacing: 0.1em; font-family: 'JetBrains Mono', monospace;" value="0895556656" maxlength="10" placeholder="เช่น 0891234567">
            <p class="form-hint">สามารถกรอกเบอร์มือถือเพื่อคำนวณผลรวมและจับคู่ตัวเลขมงคล</p>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างเบอร์ผลรวมมงคลยอดนิยม:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-phone" data-phone="0895556656">ผลรวม 55 (เจริญก้าวหน้า)</button>
                <button type="button" class="btn-copy btn-preset-phone" data-phone="0984566556">ผลรวม 54 (สุขสมบูรณ์)</button>
                <button type="button" class="btn-copy btn-preset-phone" data-phone="0654245642">ผลรวม 42 (เมตตามหานิยม)</button>
                <button type="button" class="btn-copy btn-preset-phone" data-phone="0914562456">ผลรวม 45 (ยอดปัญญา)</button>
            </div>
        </div>

        <div class="result-box" style="margin-top: 1.5rem;">
            <div class="result-header">
                <span class="result-label">ผลรวมตัวเลข (Sum)</span>
                <span id="res-lucky-grade" class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border-color: #10b981;">
                    -
                </span>
            </div>
            <div id="res-lucky-sum" class="result-text" style="font-size: 2.2rem; color: var(--text-primary);">
                -
            </div>
            <p id="res-lucky-desc" style="font-size: 0.85rem; color: var(--text-secondary); margin-top: 0.5rem; line-height: 1.6;">
                -
            </p>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">การวิเคราะห์คู่เลขภายในเบอร์</h2>
            <span class="tag-badge">คู่เลขเสริมดวง</span>
        </div>

        <div id="res-lucky-pairs" class="stats-grid" style="margin-top: 0;">
            <!-- Populated by JS -->
        </div>
    </div>
</div>

<!-- SEO & FAQ Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">ความรู้เกี่ยวกับผลรวมเบอร์มงคลและเลขศาสตร์ (FAQ)</h2>
        <span class="tag-badge">เลขศาสตร์ไทย</span>
    </div>
    <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ผลรวมเบอร์มงคลที่ดีที่สุดคือเลขใดบ้าง?</h3>
        <p style="margin-bottom: 1rem;">
            A: ตามหลักเลขศาสตร์ไทย ผลรวมระดับ A++ ที่ได้รับความนิยมสูงสุด ได้แก่ เลข 42, 45, 54, 55, 56, 59, และ 65 ซึ่งเชื่อว่าเป็นกลุ่มตัวเลขที่ช่วยเสริมทั้งด้านการงาน การเงิน ความมั่งคั่ง สติปัญญา และเมตตามหานิยมรอบด้าน
        </p>
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ผลรวมกับคู่เลขภายในเบอร์ สิ่งใดสำคัญกว่ากัน?</h3>
        <p>
            A: ผู้เชี่ยวชาญด้านตัวเลขมองว่า คู่เลขภายในเบอร์ 7 ตัวหลัง (ตัวเลขตำแหน่งที่ 4 ถึง 10) มีอิทธิพลต่อชีวิตประจำวันโดยตรง ส่วนผลรวมทั้ง 10 หลักจะช่วยเสริมภาพรวมและพลังบวกหนุนดวงชะตา
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/lucky-phone.js') ?>"></script>
<?= $this->endSection() ?>
