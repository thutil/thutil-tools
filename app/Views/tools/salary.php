<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเงิน & มนุษย์เงินเดือน</span>
        <h1 class="workspace-title">คำนวณเงินเดือนสุทธิ & ประกันสังคม ภาษีบุคคลธรรมดา</h1>
        <p class="workspace-subtitle">
            คำนวณเงินเดือนสุทธิที่ได้รับจริง (Take-Home Pay) หักเงินสมทบประกันสังคม 5% (สูงสุด 750 บาท) กองทุนสำรองเลี้ยงชีพ และประมาณการภาษีเงินได้บุคคลธรรมดา
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กรอกข้อมูลเงินเดือน</h2>
            <span class="tag-badge">อัตราภาษี 2567-2569</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="salary-input-amount">เงินเดือนประจำ (บาท/เดือน)</label>
            <input type="number" id="salary-input-amount" class="form-control" style="font-size: 1.25rem; font-weight: 600;" value="35000" placeholder="เช่น 35000">
        </div>

        <div class="form-group">
            <label class="form-label" for="salary-input-pvd">เงินสะสมกองทุนสำรองเลี้ยงชีพ (PVD)</label>
            <select id="salary-input-pvd" class="form-control">
                <option value="0" selected>ไม่มี / ไม่ได้สมัคร</option>
                <option value="2">2% ของเงินเดือน</option>
                <option value="3">3% ของเงินเดือน</option>
                <option value="5">5% ของเงินเดือน</option>
                <option value="7">7% ของเงินเดือน</option>
                <option value="10">10% ของเงินเดือน</option>
            </select>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างฐานเงินเดือน:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-salary" data-val="18000">18,000</button>
                <button type="button" class="btn-copy btn-preset-salary" data-val="25000">25,000</button>
                <button type="button" class="btn-copy btn-preset-salary" data-val="35000">35,000</button>
                <button type="button" class="btn-copy btn-preset-salary" data-val="50000">50,000</button>
                <button type="button" class="btn-copy btn-preset-salary" data-val="80000">80,000</button>
                <button type="button" class="btn-copy btn-preset-salary" data-val="120000">120,000</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">สรุปเงินเดือนสุทธิที่ได้รับจริง</h2>
            <span class="tag-badge">Take-Home</span>
        </div>

        <div class="result-box" style="margin-top: 0; margin-bottom: 1rem;">
            <div class="result-header">
                <span class="result-label">เงินเดือนสุทธิเข้าบัญชี (โดยประมาณ)</span>
            </div>
            <div id="res-salary-take-home" class="result-text" style="font-size: 1.75rem; color: #10b981;">
                -
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">หักประกันสังคม (5% สูงสุด 750 บ.)</div>
                <div id="res-salary-ssf" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">หักกองทุนสำรองเลี้ยงชีพ (PVD)</div>
                <div id="res-salary-pvd" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">หักภาษีเงินได้ ณ ที่จ่าย (เฉลี่ย/เดือน)</div>
                <div id="res-salary-tax" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ประมาณการภาษีทั้งปี (ภ.ง.ด. 91)</div>
                <div id="res-salary-annual-tax" class="stat-value">-</div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/salary.js') ?>"></script>
<?= $this->endSection() ?>
