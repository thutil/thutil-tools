<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเงิน & อสังหาริมทรัพย์</span>
        <h1 class="workspace-title">คำนวณผ่อนบ้าน & โปะบ้านลดต้นลดดอก</h1>
        <p class="workspace-subtitle">
            คำนวณค่างวดสินเชื่อบ้าน และวิเคราะห์ว่าการจ่ายเงินโปะเพิ่มในแต่ละเดือนช่วยประหยัดดอกเบี้ยได้กี่บาท และผ่อนหมดเร็วขึ้นกี่ปี
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กำหนดวงเงินกู้และเงินโปะ</h2>
            <span class="tag-badge">ลดต้นลดดอก</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="home-loan-input">วงเงินกู้ซื้อบ้าน / คอนโด (บาท)</label>
            <input type="number" id="home-loan-input" class="form-control" style="font-size: 1.25rem; font-weight: 700;" value="3000000" placeholder="เช่น 3000000">
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="home-rate-input">อัตราดอกเบี้ยเฉลี่ย (% ต่อปี)</label>
                <input type="number" step="0.01" id="home-rate-input" class="form-control" value="4.25" placeholder="เช่น 4.25">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="home-years-input">ระยะเวลากู้ (ปี)</label>
                <input type="number" id="home-years-input" class="form-control" value="30" placeholder="เช่น 30">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="home-extra-input">เงินโปะเพิ่มต่อเดือน (บาท)</label>
            <input type="number" id="home-extra-input" class="form-control" value="3000" placeholder="เช่น 3000 หรือ 5000">
            <p class="form-hint">เงินส่วนนี้จะถูกนำไปหักเงินต้นโดยตรง 100% ทำให้ลดดอกเบี้ยในงวดถัดไป</p>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างราคาบ้าน:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-home" data-loan="2000000" data-rate="3.99" data-years="30" data-extra="2000">คอนโด 2 ล้าน</button>
                <button type="button" class="btn-copy btn-preset-home" data-loan="3500000" data-rate="4.25" data-years="30" data-extra="3500">ทาวน์โฮม 3.5 ล้าน</button>
                <button type="button" class="btn-copy btn-preset-home" data-loan="5000000" data-rate="4.50" data-years="30" data-extra="5000">บ้านเดี่ยว 5 ล้าน</button>
            </div>
        </div>
    </div>

    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">พลังของการโปะบ้าน (ลดต้นลดดอก)</h2>
            <span class="tag-badge">ผลลัพธ์ที่ประหยัดได้</span>
        </div>

        <div class="result-box" style="margin-top: 0; margin-bottom: 1rem; border-color: rgba(16, 185, 129, 0.4);">
            <div class="result-header">
                <span class="result-label" style="color: #10b981;">ประหยัดดอกเบี้ยได้ทั้งหมด</span>
            </div>
            <div id="res-home-interest-saved" class="result-text" style="font-size: 1.85rem; color: #10b981;">
                -
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">ค่างวดปกติต่อเดือน (ไม่โปะ)</div>
                <div id="res-home-std-payment" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ระยะเวลาที่ผ่อนหมดเร็วขึ้น</div>
                <div id="res-home-time-saved" class="stat-value" style="color: #10b981;">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ระยะเวลาผ่อนจริงเมื่อมีเงินโปะ</div>
                <div id="res-home-finish-time" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ดอกเบี้ยรวมหลังโปะ</div>
                <div id="res-home-total-interest" class="stat-value">-</div>
            </div>
        </div>

        <!-- Report Export Bar -->
        <div class="report-export-box">
            <div class="report-export-desc">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <span>ส่งออกรายงานเปรียบเทียบและตารางตัดหนี้บ้าน</span>
            </div>
            <div class="report-export-dropdown" id="export-dropdown-home-loan">
                <button type="button" class="btn-export-trigger" aria-expanded="false" title="ส่งออกรายงานคำนวณสินเชื่อบ้าน">
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
                            <small>สรุปผล + ตาราง Amortization เปรียบเทียบ</small>
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

<!-- SEO & FAQ Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">เทคนิคการผ่อนบ้านให้หมดไวและประหยัดดอกเบี้ย (FAQ)</h2>
        <span class="tag-badge">การเงินส่วนบุคคล</span>
    </div>
    <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.7;">
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ทำไมการโปะเงินเพิ่มเพียงเล็กน้อยถึงช่วยประหยัดดอกเบี้ยได้เป็นล้าน?</h3>
        <p style="margin-bottom: 1rem;">
            A: สินเชื่อบ้านคิดดอกเบี้ยแบบลดต้นลดดอก (Effective Rate) โดยดอกเบี้ยรายวันคำนวณจากเงินต้นคงเหลือ เงินโปะที่จ่ายเพิ่มจะตัดยอดเงินต้นทันที ทำให้เงินต้นลดลง ดอกเบี้ยในงวดถัดไปจึงลดลงตาม ส่งผลให้เงินค่างวดปกติไปตัดเงินต้นได้มากขึ้นเป็นลูกโซ่
        </p>
        <h3 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.35rem;">Q: ควรโปะบ้านวันไหนของเดือนเพื่อให้ตัดต้นได้ดีที่สุด?</h3>
        <p>
            A: ควรจ่ายเงินโปะในวันเดียวกันกับวันที่ระบบตัดค่างวด หรือวันถัดไปทันที เพื่อให้ไม่มีดอกเบี้ยค้างสะสมรายวัน เงินโปะจึงเข้าตัดเงินต้นได้เต็มเม็ดเต็มหน่วย 100%
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/export-report.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/home-loan.js') ?>"></script>
<?= $this->endSection() ?>
