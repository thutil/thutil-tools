<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การพิมพ์ & เครื่องมือทำงาน</span>
        <h1 class="workspace-title">แก้ปัญหาลืมเปลี่ยนภาษา (ไทย <-> อังกฤษ Kedmanee)</h1>
        <p class="workspace-subtitle">
            แปลงข้อความที่พิมพ์ผิดเพราะลืมสลับภาษาบนแป้นพิมพ์เกษมณี เช่น "g-hk" เป็น "สวัสดี" หรือ "9y;o" เป็น "hello" ทันที ไม่ต้องลบพิมพ์ใหม่
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">วางข้อความที่พิมพ์ผิด</h2>
            <span id="typo-direction-badge" class="tag-badge">ตรวจจับอัตโนมัติ</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="typo-input-text">ข้อความที่ต้องการแปลง</label>
            <textarea id="typo-input-text" class="form-control" rows="5" placeholder="วางข้อความที่พิมพ์ผิด เช่น g-hk (สวัสดี) หรือ 9y;o (hello)"></textarea>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างทดสอบ:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-typo" data-text="g-hk">g-hk (สวัสดี)</button>
                <button type="button" class="btn-copy btn-preset-typo" data-text="dkiNvudkiN">dkiNvudkiN (การ์ตูน)</button>
                <button type="button" class="btn-copy btn-preset-typo" data-text="0Noxk,">0Noxk, (ขอบคุณ)</button>
                <button type="button" class="btn-copy btn-preset-typo" data-text="9y;o">9y;o (hello)</button>
                <button type="button" class="btn-copy btn-preset-typo" data-text="c[[sovow,j">c[[sovow,j (แบบนี้ไหม)</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ข้อความที่แปลงถูกต้อง</h2>
            <button type="button" id="btn-copy-typo" class="btn-copy">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                </svg>
                <span>คัดลอกข้อความ</span>
            </button>
        </div>

        <div class="result-box" style="min-height: 140px;">
            <div id="typo-output-text" class="result-text" style="font-size: 1.15rem; white-space: pre-wrap; word-break: break-all;">
                ข้อความที่แปลงจะปรากฏที่นี่...
            </div>
        </div>
    </div>
</div>

<!-- SEO & FAQ Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">คำถามที่พบบ่อยเกี่ยวกับการแก้ปัญหาลืมเปลี่ยนภาษา (FAQ)</h2>
        <span class="tag-badge">แป้นพิมพ์เกษมณี</span>
    </div>
    <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: แป้นพิมพ์ที่รองรับการแปลงคือเลย์เอาต์ใด?</h3>
        <p style="margin-bottom: 1rem;">
            A: เครื่องมือนี้รองรับแป้นพิมพ์ภาษาไทยแบบเกษมณี (Kedmanee Layout) ซึ่งเป็นแป้นพิมพ์มาตรฐานที่ใช้บน Windows, macOS, iOS และ Android ในประเทศไทย โดยแมปปุ่มทั้งแบบธรรมดาและกด Shift (ตัวพิมพ์ใหญ่) อย่างแม่นยำ
        </p>
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ข้อมูลข้อความที่พิมพ์จะถูกส่งไปเก็บที่ไหนหรือไม่?</h3>
        <p>
            A: ไม่มีการส่งข้อมูลใด ๆ ออกจากเครื่องของคุณ การแปลงอักขระเกิดขึ้นบนเว็บเบราว์เซอร์ 100% แบบ Zero Storage ปลอดภัยสำหรับข้อความสำคัญและรหัสผ่าน
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/keyboard-fix.js') ?>"></script>
<?= $this->endSection() ?>
