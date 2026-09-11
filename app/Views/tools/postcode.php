<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">ที่อยู่ & แผนที่ไทย</span>
        <h1 class="workspace-title">ค้นหารหัสไปรษณีย์ไทย 77 จังหวัด & ตำบล/อำเภอ</h1>
        <p class="workspace-subtitle">
            ค้นหารหัสไปรษณีย์ 5 หลัก ตำบล/แขวง อำเภอ/เขต และจังหวัดทั่วประเทศไทย พร้อมปุ่มคัดลอกทันใจ
        </p>
    </div>
</div>

<div class="tool-grid-1">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">พิมพ์รหัสไปรษณีย์ หรือ ชื่อตำบล / อำเภอ / จังหวัด</h2>
            <span id="postcode-result-count" class="tag-badge">กำลังโหลด</span>
        </div>

        <div class="form-group">
            <input type="text" id="postcode-input-query" class="form-control" style="font-size: 1.15rem; padding: 0.75rem 1rem;" placeholder="พิมพ์ค้นหา เช่น 10500 หรือ บางรัก, คลองเตย, เชียงใหม่, พัทยา...">
        </div>

        <div id="postcode-results-list" style="margin-top: 1.25rem;">
            <!-- Populated by JS -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/postcode.js') ?>"></script>
<?= $this->endSection() ?>
