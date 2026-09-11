<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเงิน & บัญชีไทย</span>
        <h1 class="workspace-title">คำนวณภาษีมูลค่าเพิ่ม (VAT 7%) และหัก ณ ที่จ่าย</h1>
        <p class="workspace-subtitle">
            คำนวณถอดภาษีมูลค่าเพิ่ม 7% (รวม VAT / ก่อน VAT) พร้อมคำนวณภาษีหัก ณ ที่จ่าย 1%, 2%, 3%, 5% สรุปยอดจ่ายจริงและภาษีที่ต้องนำส่ง
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กำหนดจำนวนเงินและประเภทภาษี</h2>
            <span class="tag-badge">คำนวณอัตโนมัติ</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="tax-amount-input">จำนวนเงิน (บาท)</label>
            <input type="number" step="0.01" id="tax-amount-input" class="form-control" style="font-size: 1.25rem; font-weight: 600;" value="10000" placeholder="เช่น 10000">
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="tax-vat-mode">ภาษีมูลค่าเพิ่ม (VAT)</label>
                <select id="tax-vat-mode" class="form-control">
                    <option value="include">รวม VAT 7% แล้ว (แยกภาษีในตัว)</option>
                    <option value="exclude" selected>ยังไม่รวม VAT (คิด VAT เพิ่ม 7%)</option>
                    <option value="none">ไม่มี VAT / ยกเว้นภาษี</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="tax-wht-rate">ภาษีหัก ณ ที่จ่าย (Withholding Tax)</label>
                <select id="tax-wht-rate" class="form-control">
                    <option value="0">0% (ไม่หัก)</option>
                    <option value="1">1% (ค่าขนส่ง)</option>
                    <option value="2">2% (ค่าโฆษณา)</option>
                    <option value="3" selected>3% (ค่าบริการ / จ้างทำของ / ฟรีแลนซ์)</option>
                    <option value="5">5% (ค่าเช่าทรัพย์สิน / รางวัล)</option>
                </select>
            </div>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างยอดเงิน:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-tax" data-amount="1000">1,000</button>
                <button type="button" class="btn-copy btn-preset-tax" data-amount="5000">5,000</button>
                <button type="button" class="btn-copy btn-preset-tax" data-amount="10000">10,000</button>
                <button type="button" class="btn-copy btn-preset-tax" data-amount="50000">50,000</button>
                <button type="button" class="btn-copy btn-preset-tax" data-amount="107000">107,000 (ยอดรวม VAT)</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">สรุปยอดเงินและภาษีที่เกี่ยวข้อง</h2>
            <span class="tag-badge">ผลลัพธ์สุทธิ</span>
        </div>

        <!-- Net Payable Big Card -->
        <div class="result-box" style="margin-top: 0; margin-bottom: 1rem;">
            <div class="result-header">
                <span class="result-label">ยอดที่ต้องจ่ายเงินให้ผู้รับสุทธิ (Net Payable)</span>
            </div>
            <div id="res-tax-net" class="result-text" style="font-size: 1.65rem;">
                -
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">มูลค่าสินค้า/บริการ (ก่อน VAT)</div>
                <div id="res-tax-base" class="stat-value" style="font-size: 1rem;">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ภาษีมูลค่าเพิ่ม (VAT 7%)</div>
                <div id="res-tax-vat" class="stat-value" style="font-size: 1rem;">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ยอดรวมก่อนหัก ณ ที่จ่าย</div>
                <div id="res-tax-gross" class="stat-value" style="font-size: 1rem;">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ภาษีหัก ณ ที่จ่าย (ต้องนำส่งสรรพากร)</div>
                <div id="res-tax-wht" class="stat-value" style="font-size: 1rem;">-</div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/vat-tax.js') ?>"></script>
<?= $this->endSection() ?>
