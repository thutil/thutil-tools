<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">ภูมิสารสนเทศ GIS</span>
        <h1 class="workspace-title">ชุดเครื่องมือภูมิสารสนเทศ GIS & ที่ดินไทย</h1>
        <p class="workspace-subtitle">
            แปลงพิกัด WGS84 Lat/Lon <-> UTM Zone 47N/48N และ Indian 1975, คำนวณแปลงหน่วยที่ดินไทย ไร่-งาน-วา เป็น ตร.ม./เฮกตาร์ พร้อมแผนที่พรีวิว
        </p>
    </div>
</div>

<!-- Section 1: Coordinate Converter -->
<div class="panel-card" style="margin-bottom: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">1. เครื่องมือแปลงพิกัดภูมิศาสตร์ (Coordinate Converter)</h2>
        <span class="tag-badge">WGS84 & Indian 1975</span>
    </div>

    <div class="form-row" style="margin-bottom: 1.25rem;">
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="gis-input-lat">ละติจูด (Latitude - องศาทศนิยม)</label>
            <input type="number" step="0.000001" id="gis-input-lat" class="form-control" value="13.764958" placeholder="เช่น 13.764958">
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="gis-input-lon">ลองจิจูด (Longitude - องศาทศนิยม)</label>
            <input type="number" step="0.000001" id="gis-input-lon" class="form-control" value="100.538316" placeholder="เช่น 100.538316">
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <label class="form-label" for="gis-select-datum">พื้นหลักฐาน (Datum)</label>
            <select id="gis-select-datum" class="form-control">
                <option value="wgs84" selected>WGS84 (GPS / สากล)</option>
                <option value="indian1975">Indian 1975 (กรมที่ดิน / แผนที่ทหาร)</option>
            </select>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-label">พิกัด UTM Zone 47N (ภาคกลาง / เหนือ / ใต้)</div>
            <div id="res-utm-47" class="stat-value" style="font-size: 0.95rem;">-</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">พิกัด UTM Zone 48N (ภาคตะวันออกเฉียงเหนือ / อีสาน)</div>
            <div id="res-utm-48" class="stat-value" style="font-size: 0.95rem;">-</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">ละติจูด องศา-ลิปดา-ฟิลิปดา (DMS)</div>
            <div id="res-dms-lat" class="stat-value" style="font-size: 0.95rem;">-</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">ลองจิจูด องศา-ลิปดา-ฟิลิปดา (DMS)</div>
            <div id="res-dms-lon" class="stat-value" style="font-size: 0.95rem;">-</div>
        </div>
    </div>

    <div style="margin-top: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
            <span class="form-label" style="margin-bottom: 0;">แผนที่ตรวจสอบพิกัด (คลิกเลือกพิกัดบนแผนที่ได้)</span>
            <span class="form-hint">CartoDB Positron Monochrome Tiles</span>
        </div>
        <div id="gis-map"></div>
    </div>
</div>

<!-- Section 2: Thai Land Area Converter -->
<div class="panel-card" style="margin-bottom: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">2. เครื่องมือแปลงหน่วยพื้นที่แบบไทย (ไร่ - งาน - ตารางวา)</h2>
        <span class="tag-badge">มาตราส่วนที่ดินไทย</span>
    </div>

    <div class="tool-grid-2">
        <div>
            <label class="form-label">กรอกพื้นที่หน่วยไทย</label>
            <div class="form-row" style="margin-bottom: 1rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-hint" for="area-input-rai">ไร่</label>
                    <input type="number" id="area-input-rai" class="form-control" value="1" min="0">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-hint" for="area-input-ngan">งาน</label>
                    <input type="number" id="area-input-ngan" class="form-control" value="2" min="0" max="3">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-hint" for="area-input-wa">ตารางวา</label>
                    <input type="number" step="0.1" id="area-input-wa" class="form-control" value="50" min="0" max="99.9">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="area-input-sqm">หรือ กรอกตารางเมตร (ตร.ม.)</label>
                <input type="number" step="0.1" id="area-input-sqm" class="form-control" value="2600" placeholder="เช่น 2600">
            </div>

            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <span class="form-hint" style="width: 100%;">ตัวอย่างยอดนิยม:</span>
                <button type="button" class="btn-copy btn-preset-area" data-rai="1" data-ngan="0" data-wa="0">1 ไร่ (1,600 ตร.ม.)</button>
                <button type="button" class="btn-copy btn-preset-area" data-rai="0" data-ngan="1" data-wa="0">1 งาน (400 ตร.ม.)</button>
                <button type="button" class="btn-copy btn-preset-area" data-rai="0" data-ngan="0" data-wa="100">100 ตร.วา (1 งาน)</button>
                <button type="button" class="btn-copy btn-preset-area" data-rai="6" data-ngan="1" data-wa="0">1 เฮกตาร์ (6.25 ไร่)</button>
            </div>
        </div>

        <div>
            <label class="form-label">ผลลัพธ์การคำนวณเปรียบเทียบ</label>
            <div class="result-box">
                <div class="result-header">
                    <span class="result-label">สรุปหน่วยไทย</span>
                </div>
                <div id="res-area-summary" class="result-text" style="font-size: 1.15rem; margin-bottom: 0.85rem;">
                    1 ไร่ 2 งาน 50 ตร.วา
                </div>

                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-label">ตารางเมตร (ตร.ม.)</div>
                        <div id="res-area-sqm" class="stat-value" style="font-size: 1rem;">2,600 ตร.ม.</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">เฮกตาร์ (Hectare)</div>
                        <div id="res-area-hectare" class="stat-value" style="font-size: 1rem;">0.26 เฮกตาร์</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">ตารางกิโลเมตร (ตร.กม.)</div>
                        <div id="res-area-sqkm" class="stat-value" style="font-size: 1rem;">0.0026 ตร.กม.</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">มาตราส่วนไทย</div>
                        <div class="stat-value" style="font-size: 0.8rem; font-weight: normal; color: var(--text-secondary);">
                            1 ไร่ = 4 งาน = 400 ตร.วา
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section 3: GeoJSON Viewer -->
<div class="panel-card">
    <div class="card-title-bar">
        <h2 class="card-title">3. เครื่องมือพรีวิว GeoJSON บนแผนที่</h2>
        <span class="tag-badge">GeoJSON Preview</span>
    </div>
    <div class="form-group">
        <label class="form-label" for="geojson-input-text">ข้อมูล GeoJSON</label>
        <textarea id="geojson-input-text" class="form-control" rows="3" placeholder='{"type": "Point", "coordinates": [100.5383, 13.7649]}'></textarea>
    </div>
    <div style="display: flex; gap: 0.85rem; align-items: center;">
        <button type="button" id="btn-load-geojson" class="btn-primary">พล็อตลงบนแผนที่</button>
        <span id="geojson-stat-output" class="form-hint"></span>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/gis-tools.js') ?>"></script>
<?= $this->endSection() ?>
