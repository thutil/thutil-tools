<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเงิน & สินเชื่อรถยนต์</span>
        <h1 class="workspace-title">คำนวณค่างวดรถยนต์ & มอเตอร์ไซค์ (ตารางผ่อนรถ)</h1>
        <p class="workspace-subtitle">
            คำนวณค่างวดรถแม่นยำตามสูตรไฟแนนซ์ไทย ดอกเบี้ยคงที่ (Flat Rate) รวมภาษีมูลค่าเพิ่ม 7% พร้อมเทียบดอกเบี้ยแท้จริง (Effective Rate)
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กำหนดราคารถและเงื่อนไขไฟแนนซ์</h2>
            <span class="tag-badge">Flat Rate + VAT 7%</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="car-price-input">ราคารถยนต์ / มอเตอร์ไซค์ (บาท)</label>
            <input type="number" id="car-price-input" class="form-control" style="font-size: 1.25rem; font-weight: 700;" value="800000" placeholder="เช่น 800000">
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="flex: 2; margin-bottom: 0;">
                <label class="form-label" for="car-down-input">เงินดาวน์</label>
                <input type="number" id="car-down-input" class="form-control" value="20" placeholder="เช่น 20 หรือ 150000">
            </div>
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="car-down-type">หน่วยเงินดาวน์</label>
                <select id="car-down-type" class="form-control">
                    <option value="percent" selected>% (เปอร์เซ็นต์)</option>
                    <option value="baht">บาท</option>
                </select>
            </div>
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="car-rate-input">อัตราดอกเบี้ยคงที่ (% ต่อปี)</label>
                <input type="number" step="0.01" id="car-rate-input" class="form-control" value="2.49" placeholder="เช่น 2.49">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="car-term-months">ระยะเวลาผ่อน (งวด/เดือน)</label>
                <select id="car-term-months" class="form-control">
                    <option value="12">12 งวด (1 ปี)</option>
                    <option value="24">24 งวด (2 ปี)</option>
                    <option value="36">36 งวด (3 ปี)</option>
                    <option value="48">48 งวด (4 ปี)</option>
                    <option value="60" selected>60 งวด (5 ปี)</option>
                    <option value="72">72 งวด (6 ปี)</option>
                    <option value="84">84 งวด (7 ปี)</option>
                </select>
            </div>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างยอดนิยม:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-car" data-price="650000" data-down="20" data-rate="2.59" data-months="60">Eco Car (650k)</button>
                <button type="button" class="btn-copy btn-preset-car" data-price="950000" data-down="25" data-rate="2.39" data-months="48">Sedan (950k)</button>
                <button type="button" class="btn-copy btn-preset-car" data-price="1200000" data-down="20" data-rate="2.49" data-months="72">SUV/EV (1.2M)</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ผลลัพธ์ค่างวดที่ต้องชำระจริง</h2>
            <span class="tag-badge">รวม VAT 7% แล้ว</span>
        </div>

        <div class="result-box" style="margin-top: 0; margin-bottom: 1rem;">
            <div class="result-header">
                <span class="result-label">ค่างวดต่อเดือน (ที่ต้องจ่ายจริง)</span>
            </div>
            <div id="res-car-monthly" class="result-text" style="font-size: 1.85rem; color: #10b981;">
                -
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">ยอดจัดไฟแนนซ์ (ยอดกู้)</div>
                <div id="res-car-loan" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">เงินดาวน์</div>
                <div id="res-car-down" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ดอกเบี้ยรวมตลอดสัญญา</div>
                <div id="res-car-interest" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">VAT 7% ของค่างวด</div>
                <div id="res-car-vat-monthly" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">อัตราดอกเบี้ยที่แท้จริง (Effective)</div>
                <div id="res-car-effective-rate" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">สูตรการคิดดอกเบี้ย</div>
                <div class="stat-value" style="font-size: 0.825rem; font-weight: 500; color: var(--text-secondary);">
                    Flat Rate (ดอกเบี้ยคงที่)
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SEO & FAQ Section for Google / AI Crawlers -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">คำถามที่พบบ่อยเกี่ยวกับการคำนวณค่างวดรถ (FAQ)</h2>
        <span class="tag-badge">ความรู้สินเชื่อ</span>
    </div>
    <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ทำไมค่างวดรถต้องบวก VAT 7% เพิ่มเติม?</h3>
        <p style="margin-bottom: 1rem;">
            A: ตามประมวลรัษฎากรไทย สัญญาเช่าซื้อรถยนต์ (Hire-Purchase) ถือเป็นการให้บริการเช่าซื้อ จึงมีภาษีมูลค่าเพิ่ม (VAT 7%) คิดจากค่างวดในแต่ละเดือน สถาบันการเงินส่วนใหญ่จึงคำนวณค่างวดก่อน VAT แล้วจึงบวก VAT 7% เข้าไปเป็นยอดค่างวดที่ต้องชำระจริง
        </p>
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ดอกเบี้ยคงที่ (Flat Rate) กับ ดอกเบี้ยลดต้นลดดอก (Effective Rate) ต่างกันอย่างไร?</h3>
        <p>
            A: สินเชื่อรถยนต์ใช้ดอกเบี้ยคงที่ (Flat Rate) ซึ่งคำนวณดอกเบี้ยจากยอดจัดก้อนแรกตลอดอายุสัญญา ดอกเบี้ยแบบคงที่ 2.5% จะเทียบเท่ากับดอกเบี้ยลดต้นลดดอกประมาณ 4.5% - 4.8% ต่อปี
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/car-loan.js') ?>"></script>
<?= $this->endSection() ?>
