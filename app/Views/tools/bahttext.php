<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเงิน & ภาษาไทย</span>
        <h1 class="workspace-title">แปลงเลขเป็นตัวอ่านไทย (บาทถ้วน)</h1>
        <p class="workspace-subtitle">
            แปลงตัวเลขอารบิกเป็นคำอ่านภาษาไทยทางการและจำนวนเงินบาทถ้วนตามหลักการเงินและบัญชี
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กรอกตัวเลขที่ต้องการแปลง</h2>
            <span class="tag-badge">รองรับทศนิยม</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="bahttext-number-input">จำนวนเงินหรือตัวเลข</label>
            <input type="text" id="bahttext-number-input" class="form-control" style="font-size: 1.25rem; font-weight: 600;" value="1200" placeholder="เช่น 1200 หรือ 1,500,000.50">
            <p class="form-hint">สามารถใส่เครื่องหมายจุลภาค (,) หรือพิมพ์เป็นตัวเลขต่อเนื่องได้ทันที</p>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <span class="form-label">ตัวเลขที่จัดรูปแบบ:</span>
            <div id="formatted-number-display" style="font-family: 'JetBrains Mono', monospace; font-size: 1.2rem; font-weight: 600; color: var(--text-primary);">
                1,200
            </div>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.5rem;">ตัวอย่างที่ใช้บ่อย:</span>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-number" data-val="1200">1,200</button>
                <button type="button" class="btn-copy btn-preset-number" data-val="1000000">1,000,000</button>
                <button type="button" class="btn-copy btn-preset-number" data-val="250.75">250.75</button>
                <button type="button" class="btn-copy btn-preset-number" data-val="15420999.50">15,420,999.50</button>
                <button type="button" class="btn-copy btn-preset-number" data-val="101">101 (เอ็ด)</button>
                <button type="button" class="btn-copy btn-preset-number" data-val="21">21 (ยี่สิบเอ็ด)</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ผลลัพธ์คำอ่านภาษาไทย</h2>
            <span class="tag-badge">คัดลอกได้ทันที</span>
        </div>

        <!-- Currency Output -->
        <div class="result-box">
            <div class="result-header">
                <span class="result-label">จำนวนเงินบาท (สกุลเงิน / บัญชี)</span>
                <button type="button" class="btn-copy" data-target="output-currency-text">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                    </svg>
                    <span>คัดลอก</span>
                </button>
            </div>
            <div id="output-currency-text" class="result-text">
                หนึ่งพันสองร้อยบาทถ้วน
            </div>
        </div>

        <!-- General Number Reading Output -->
        <div class="result-box" style="margin-top: 1.25rem;">
            <div class="result-header">
                <span class="result-label">คำอ่านตัวเลขทั่วไป (จำนวนนับ)</span>
                <button type="button" class="btn-copy" data-target="output-general-text">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                    </svg>
                    <span>คัดลอก</span>
                </button>
            </div>
            <div id="output-general-text" class="result-text" style="font-size: 1.1rem;">
                หนึ่งพันสองร้อย
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/bahttext.js') ?>"></script>
<?= $this->endSection() ?>
