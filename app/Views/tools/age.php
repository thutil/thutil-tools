<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">วันเวลา & อายุ</span>
        <h1 class="workspace-title">คำนวณอายุ & เปรียบเทียบวันเวลา</h1>
        <p class="workspace-subtitle">
            คำนวณอายุจากปีเกิด พ.ศ./ค.ศ. แจกแจงปี เดือน วัน ชั่วโมง วันเกิดครั้งถัดไป และเปรียบเทียบระยะห่างระหว่าง 2 วันเดือนปี
        </p>
    </div>
</div>

<!-- Quick Year Calculation Panel -->
<div class="panel-card" style="margin-bottom: 1.5rem;">
    <div class="card-title-bar">
        <h2 class="card-title">คำนวณอายุแบบด่วนจากปีเกิด (เช่น เกิดปี 2541)</h2>
        <span class="tag-badge">คำนวณทันที</span>
    </div>
    <div class="form-row" style="align-items: flex-end;">
        <div class="form-group" style="flex: 2; margin-bottom: 0;">
            <label class="form-label" for="quick-year-input">กรอกปีเกิด</label>
            <input type="number" id="quick-year-input" class="form-control" value="2541" placeholder="เช่น 2541 หรือ 1998">
        </div>
        <div class="form-group" style="flex: 1; margin-bottom: 0;">
            <label class="form-label" for="quick-year-type">ระบบปี</label>
            <select id="quick-year-type" class="form-control">
                <option value="be" selected>พ.ศ. (พุทธศักราช)</option>
                <option value="ce">ค.ศ. (คริสต์ศักราช)</option>
            </select>
        </div>
    </div>
    <div class="result-box" style="margin-top: 1rem;">
        <div class="result-header">
            <span class="result-label">ผลการคำนวณแบบรวดเร็ว</span>
        </div>
        <div id="quick-year-result" class="result-text" style="font-size: 1.05rem; line-height: 1.6;">
            กำลังคำนวณ...
        </div>
    </div>
</div>

<!-- Tab Group for Detailed Calculations (Segmented Control) -->
<div class="tab-bar">
    <button type="button" class="tab-btn active" data-tab="tab-detailed-age">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        <span>คำนวณอายุแบบระบุวันเกิด (ละเอียด)</span>
    </button>
    <button type="button" class="tab-btn" data-tab="tab-date-diff">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <span>เปรียบเทียบระยะห่างระหว่าง 2 วันที่ (ห่างกันกี่ปี)</span>
    </button>
</div>

<!-- Tab 1: Detailed Age -->
<div id="tab-detailed-age" class="tab-content">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h3 class="card-title">ระบุวันเดือนปีเกิด</h3>
            </div>
            <div class="form-group">
                <label class="form-label" for="birth-date-input">เลือกวันเดือนปีเกิด (ค.ศ.)</label>
                <input type="date" id="birth-date-input" class="form-control" value="1998-01-01">
                <p class="form-hint">เลือกวันที่เกิดเพื่อคำนวณอายุที่แท้จริง ณ เวลาปัจจุบัน</p>
            </div>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h3 class="card-title">รายละเอียดอายุและสถิติ</h3>
            </div>
            <div id="bday-result" class="result-box">
                <!-- Populated by JS -->
            </div>
        </div>
    </div>

    <!-- Detailed Life Stage, Education Level & Milestones -->
    <div id="age-milestones-card" class="milestone-card" style="margin-top: 1.5rem; display: none;">
        <!-- Populated by JS -->
    </div>
</div>

<!-- Tab 2: Date Difference -->
<div id="tab-date-diff" class="tab-content" style="display: none;">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h3 class="card-title">เลือกช่วงวันที่ต้องการเปรียบเทียบ</h3>
            </div>
            <div class="form-group">
                <label class="form-label" for="diff-date-1">วันที่เริ่มต้น (Start Date)</label>
                <input type="date" id="diff-date-1" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="diff-date-2">วันที่สิ้นสุด (End Date)</label>
                <input type="date" id="diff-date-2" class="form-control">
            </div>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h3 class="card-title">ระยะห่างระหว่างสองวัน</h3>
            </div>
            <div id="diff-result-box" class="result-box">
                <!-- Populated by JS -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/age-calculator.js?v=' . (file_exists(FCPATH . 'assets/js/modules/age-calculator.js') ? filemtime(FCPATH . 'assets/js/modules/age-calculator.js') : '2.2')) ?>"></script>
<?= $this->endSection() ?>
