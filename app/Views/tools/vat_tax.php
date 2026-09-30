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

        <!-- Report Export Bar -->
        <div class="report-export-box">
            <div class="report-export-desc">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <span>ส่งออกรายงานคำนวณ VAT และภาษีหัก ณ ที่จ่าย</span>
            </div>
            <div class="report-export-dropdown" id="export-dropdown-vat-tax">
                <button type="button" class="btn-export-trigger" aria-expanded="false" title="ส่งออกรายงาน VAT & หัก ณ ที่จ่าย">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>ดาวน์โหลดรายงาน</span>
                    <svg class="dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="export-menu">
                    <button type="button" class="export-menu-item" data-format="xlsx">
                        <span class="export-badge xlsx">XLSX</span>
                        <div class="export-item-text">
                            <strong>Excel (.xlsx)</strong>
                            <small>สรุปภาษีมูลค่าเพิ่ม & หัก ณ ที่จ่าย</small>
                        </div>
                    </button>
                    <button type="button" class="export-menu-item" data-format="csv">
                        <span class="export-badge csv">CSV</span>
                        <div class="export-item-text">
                            <strong>CSV (.csv)</strong>
                            <small>UTF-8 ภาษาไทยเปิดได้ทันที</small>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/export-report.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/vat-tax.js') ?>"></script>
<?= $this->endSection() ?>
