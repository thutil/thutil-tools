<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">วันเวลา & ปฏิทินไทย</span>
        <h1 class="workspace-title">ปฏิทินวันหยุดราชการไทย & คำนวณวันทำการ</h1>
        <p class="workspace-subtitle">
            คำนวณจำนวนวันทำการราชการระหว่าง 2 วัน (ตัดวันเสาร์-อาทิตย์ และวันหยุดนักขัตฤกษ์ไทย) เหมาะสำหรับวางแผนส่งงานและราชการ
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">เลือกช่วงวันที่ต้องการคำนวณ</h2>
            <span class="tag-badge">วันทำการราชการ</span>
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="workday-start-date">วันที่เริ่มต้น (Start Date)</label>
                <input type="date" id="workday-start-date" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="workday-end-date">วันที่สิ้นสุด (End Date)</label>
                <input type="date" id="workday-end-date" class="form-control">
            </div>
        </div>

        <div class="result-box">
            <div class="result-header">
                <span class="result-label">จำนวนวันทำการจริง (ไม่รวมวันหยุด)</span>
            </div>
            <div id="res-working-days" class="result-text" style="font-size: 1.85rem; color: #10b981;">
                -
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">จำนวนวันตามปฏิทินทั้งหมด</div>
                <div id="res-total-calendar-days" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">วันหยุดเสาร์ - อาทิตย์</div>
                <div id="res-weekend-days" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">วันหยุดนักขัตฤกษ์ราชการ (จ.-ศ.)</div>
                <div id="res-holiday-days" class="stat-value">-</div>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">วันหยุดราชการที่ตรงกับช่วงเวลานี้</h2>
            <span class="tag-badge">ปฏิทินไทย</span>
        </div>

        <div id="list-holidays-in-range" style="max-height: 380px; overflow-y: auto;">
            <!-- Populated by JS -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/holidays.js') ?>"></script>
<?= $this->endSection() ?>
