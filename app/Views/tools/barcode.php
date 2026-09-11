<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">รหัสสินค้า & บาร์โค้ด</span>
        <h1 class="workspace-title">สร้างบาร์โค้ดสินค้าไทย EAN-13 (885)</h1>
        <p class="workspace-subtitle">
            สร้างบาร์โค้ดมาตรฐานสากล EAN-13 รหัสประเทศไทย (885) พร้อมคำนวณ Check Digit ตัวสุดท้ายอัตโนมัติ ส่งออกเป็น SVG/PNG คมชัด
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กรอกตัวเลขรหัสสินค้า (12 หลัก)</h2>
            <span class="tag-badge">รหัสไทย 885</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="barcode-input-number">ตัวเลขรหัสบาร์โค้ด (12 หลักแรก)</label>
            <input type="text" id="barcode-input-number" class="form-control" style="font-size: 1.25rem; font-weight: 600; font-family: 'JetBrains Mono', monospace;" value="885123456789" maxlength="12">
            <p class="form-hint">สินค้าไทยขึ้นต้นด้วยเลข <strong>885</strong> ตามมาตรฐาน GS1 Thailand (ระบบจะคำนวณหลักที่ 13 ให้เอง)</p>
        </div>

        <div class="result-box">
            <div class="result-header">
                <span class="result-label">การตรวจสอบ Check Digit</span>
            </div>
            <div id="barcode-checksum-display" class="result-text" style="font-size: 1.05rem;">
                -
            </div>
        </div>
    </div>

    <div class="panel-card" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <div class="card-title-bar" style="width: 100%;">
            <h2 class="card-title">ภาพตัวอย่างบาร์โค้ด EAN-13</h2>
            <span class="tag-badge">SVG Vector</span>
        </div>

        <div style="background: #ffffff; padding: 1.5rem; border-radius: var(--radius-md); box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4); max-width: 360px; width: 100%;">
            <svg id="barcode-svg" style="width: 100%; height: auto; display: block;"></svg>
        </div>

        <div style="margin-top: 1.5rem; width: 100%; display: flex; justify-content: center;">
            <button type="button" id="btn-download-barcode-svg" class="btn-primary" style="width: 100%; max-width: 360px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                <span>ดาวน์โหลดบาร์โค้ด (SVG คมชัดสูง)</span>
            </button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/barcode.js') ?>"></script>
<?= $this->endSection() ?>
