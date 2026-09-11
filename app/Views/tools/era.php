<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">ประวัติศาสตร์ & ศักราชไทย</span>
        <h1 class="workspace-title">แปลงศักราชไทย (พ.ศ. / ค.ศ. / ร.ศ. / จ.ศ. / ม.ศ.)</h1>
        <p class="workspace-subtitle">
            แปลงปีศักราชที่ใช้ในประวัติศาสตร์ เอกสารราชการ และสากล พร้อมบอกสถานะปีอธิกสุรทิน (Leap Year)
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กรอกปีศักราชที่ต้องการแปลง</h2>
            <span class="tag-badge">เทียบเท่าทันที</span>
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="flex: 2; margin-bottom: 0;">
                <label class="form-label" for="era-input-year">ตัวเลขปี</label>
                <input type="number" id="era-input-year" class="form-control" style="font-size: 1.25rem; font-weight: 600;" value="2541">
            </div>
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="era-select-system">ระบบศักราช</label>
                <select id="era-select-system" class="form-control">
                    <option value="be" selected>พ.ศ. (พุทธศักราช)</option>
                    <option value="ce">ค.ศ. (คริสต์ศักราช)</option>
                    <option value="rs">ร.ศ. (รัตนโกสินทรศก)</option>
                    <option value="cs">จ.ศ. (จุลศักราช)</option>
                    <option value="ms">ม.ศ. (มหาศักราช)</option>
                </select>
            </div>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">หมุดหมายสำคัญในประวัติศาสตร์:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-era" data-year="2541" data-system="be">พ.ศ. 2541</button>
                <button type="button" class="btn-copy btn-preset-era" data-year="2000" data-system="ce">ค.ศ. 2000 (Y2K)</button>
                <button type="button" class="btn-copy btn-preset-era" data-year="112" data-system="rs">ร.ศ. 112 (วิกฤตการณ์ ร.ศ. 112)</button>
                <button type="button" class="btn-copy btn-preset-era" data-year="2475" data-system="be">พ.ศ. 2475 (เปลี่ยนแปลงการปกครอง)</button>
                <button type="button" class="btn-copy btn-preset-era" data-year="2325" data-system="be">พ.ศ. 2325 (สถาปนากรุงเทพฯ / ร.ศ. 1)</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ผลการเทียบศักราช</h2>
            <span class="tag-badge">ทุกระบบ</span>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">พุทธศักราช (พ.ศ.)</div>
                <div id="res-era-be" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">คริสต์ศักราช (ค.ศ. / AD)</div>
                <div id="res-era-ce" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">รัตนโกสินทรศก (ร.ศ.)</div>
                <div id="res-era-rs" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">จุลศักราช (จ.ศ.)</div>
                <div id="res-era-cs" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">มหาศักราช (ม.ศ.)</div>
                <div id="res-era-ms" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ปฏิทินสุริยคติ</div>
                <div id="res-era-leap" class="stat-value" style="font-size: 0.825rem; font-weight: 500;">-</div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/era-converter.js') ?>"></script>
<?= $this->endSection() ?>
