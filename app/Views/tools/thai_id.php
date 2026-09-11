<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การยืนยันตัวตน & ตรวจสอบ</span>
        <h1 class="workspace-title">ตรวจสอบและจัดรูปแบบเลขบัตรประชาชน 13 หลัก</h1>
        <p class="workspace-subtitle">
            ตรวจสอบความถูกต้องของเลขประจำตัวประชาชนไทยด้วยอัลกอริทึม Modulo 11 จัดรูปแบบขีดคั่นอัตโนมัติ และสุ่มเลขสำหรับทดสอบระบบ
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กรอกเลขบัตรประชาชน</h2>
            <span id="thai-id-status-badge" class="tag-badge">รอการกรอก</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="thai-id-input">เลขบัตรประชาชน (13 หลัก)</label>
            <input type="text" id="thai-id-input" class="form-control" style="font-size: 1.25rem; font-weight: 600; letter-spacing: 0.05em;" placeholder="x-xxxx-xxxxx-xx-x" maxlength="17">
            <p class="form-hint">ระบบจะจัดรูปแบบเครื่องหมายขีด (-) ให้โดยอัตโนมัติขณะพิมพ์</p>
        </div>

        <div style="display: flex; gap: 0.65rem; flex-wrap: wrap; margin-bottom: 1.25rem;">
            <button type="button" id="btn-copy-thai-id" class="btn-copy">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                </svg>
                <span>คัดลอกเลข 13 หลัก</span>
            </button>
            <button type="button" id="btn-generate-thai-id" class="btn-primary" style="min-height: 34px; padding: 0.35rem 0.85rem; font-size: 0.8rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                    <path d="M3 3v5h5"></path>
                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path>
                    <path d="M16 21h5v-5"></path>
                </svg>
                <span>สุ่มเลขที่ถูกต้อง (สำหรับ Dev/Test)</span>
            </button>
        </div>

        <div class="result-box">
            <div class="result-header">
                <span class="result-label">ผลการตรวจสอบ</span>
            </div>
            <div id="thai-id-result" class="result-text" style="font-size: 1rem; line-height: 1.5;">
                กำลังตรวจสอบ...
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ข้อมูลและหลักการตรวจสอบ</h2>
            <span class="tag-badge">ความรู้</span>
        </div>

        <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
            <p style="margin-bottom: 0.85rem;">
                <strong>โครงสร้างเลข 13 หลัก:</strong><br>
                • <strong>หลักที่ 1:</strong> ประเภทบุคคล (เช่น 1 = เกิดและสัญชาติไทย, 3 = บุคคลมีชื่อในทะเบียนบ้าน)<br>
                • <strong>หลักที่ 2-5:</strong> รหัสสำนักทะเบียน (จังหวัด/อำเภอ/เทศบาล)<br>
                • <strong>หลักที่ 6-10:</strong> เล่มที่ของสูติบัตร<br>
                • <strong>หลักที่ 11-12:</strong> ใบที่ของสูติบัตรในเล่มนั้น<br>
                • <strong>หลักที่ 13:</strong> ตัวเลขตรวจสอบความถูกต้อง (Check Digit) ด้วย Modulo 11
            </p>
            <p>
                <em>หมายเหตุ: การตรวจสอบทำงานบนเครื่องของคุณ (Client-side) ไม่มีการส่งเลขบัตรไปยังเซิร์ฟเวอร์ใด ๆ ทั้งสิ้น 100%</em>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/thai-id.js') ?>"></script>
<?= $this->endSection() ?>
