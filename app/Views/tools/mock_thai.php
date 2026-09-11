<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">เครื่องมือสำหรับนักพัฒนา</span>
        <h1 class="workspace-title">สุ่มข้อมูลจำลองคนไทย (Mock Thai Data)</h1>
        <p class="workspace-subtitle">
            สุ่มสร้างชื่อ-นามสกุลไทย เลขบัตรประชาชนที่ถูกต้อง เบอร์มือถือ และที่อยู่ไทยจำลอง สำหรับทดสอบระบบ (Dev / QA / Mock Database)
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ตั้งค่าการสุ่มข้อมูล</h2>
            <span class="tag-badge">สุ่มทันใจ</span>
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="mock-gender-select">เพศ</label>
                <select id="mock-gender-select" class="form-control">
                    <option value="any" selected>สุ่มคละเพศ</option>
                    <option value="male">ชาย</option>
                    <option value="female">หญิง</option>
                </select>
            </div>
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="mock-count-input">จำนวนรายการ (1 - 50)</label>
                <input type="number" id="mock-count-input" class="form-control" value="5" min="1" max="50">
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem;">
            <button type="button" id="btn-generate-mock" class="btn-primary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                    <path d="M3 3v5h5"></path>
                    <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path>
                    <path d="M16 21h5v-5"></path>
                </svg>
                <span>สร้างข้อมูลสุ่มชุดใหม่</span>
            </button>
            <button type="button" id="btn-copy-mock-json" class="btn-outline">
                <span>คัดลอก JSON</span>
            </button>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างการแสดงผล:</span>
            <div id="mock-preview-cards">
                <!-- Populated by JS -->
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ผลลัพธ์รูปแบบ JSON</h2>
            <span class="tag-badge">JSON Format</span>
        </div>

        <div class="result-box" style="padding: 0.85rem;">
            <pre id="mock-json-output" style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; line-height: 1.5; max-height: 520px; overflow-y: auto; color: var(--text-primary); white-space: pre-wrap; word-break: break-all;">
                กำลังสร้างข้อมูล...
            </pre>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/thai-id.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/mock-thai.js') ?>"></script>
<?= $this->endSection() ?>
