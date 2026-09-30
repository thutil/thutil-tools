<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมคำนวณภาษีเงินได้บุคคลธรรมดา 2567 - 2568 (ภ.ง.ด. 90/91)",
            "url": "<?= current_url() ?>",
            "description": "คำนวณภาษีเงินได้บุคคลธรรมดาและวางแผนลดหย่อนภาษี 2567-2568 ฟรี คำนวณเงินได้สุทธิ อัตราภาษีก้าวหน้า 0-35% กองทุน ThaiESG สิทธิลดหย่อนครบถ้วน สรุปยอดเงินคืนภาษีทันที",
            "applicationCategory": "FinanceApplication",
            "operatingSystem": "All",
            "inLanguage": "th-TH",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "THB"
            }
        },
        {
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "เงินเดือนเท่าไหร่ถึงเริ่มต้องเสียภาษีเงินได้บุคคลธรรมดา?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "สำหรับพนักงานเงินเดือนโสดที่ไม่มีลดหย่อนอื่นนอกจากสิทธิส่วนตัว (60,000 บาท) ค่าใช้จ่าย 50% สูงสุด 100,000 บาท และประกันสังคม (9,000 บาท) หากมีเงินได้สุทธิไม่เกิน 150,000 บาทแรกจะได้รับยกเว้นภาษี ซึ่งเทียบเท่ากับมีเงินเดือนประมาณ 26,583 บาท หรือ 319,000 บาทต่อปี หากเงินเดือนต่ำกว่านี้จะไม่ต้องเสียภาษี แต่ยังมีหน้าที่ยื่นแบบแสดงรายการภาษีหากรายได้เกิน 120,000 บาทต่อปี"
                    }
                },
                {
                    "@type": "Question",
                    "name": "กองทุน ThaiESG ปี 2567 หักลดหย่อนได้สูงสุดเท่าไหร่และต้องถือครองกี่ปี?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "เกณฑ์ใหม่ของกองทุน ThaiESG (Thailand ESG Fund) ปี 2567 สามารถนำมาหักลดหย่อนภาษีได้สูงสุดถึง 30% ของเงินได้พึงประเมิน แต่ไม่เกิน 300,000 บาท (เพิ่มขึ้นจากเดิม 100,000 บาท) และลดระยะเวลาถือครองเหลือเพียง 5 ปีเต็ม (นับจากวันที่ซื้อแบบวันชนวัน) โดยวงเงินนี้แยกต่างหากจากวงเงินเกษียณ 500,000 บาทของ RMF/SSF/PVD"
                    }
                },
                {
                    "@type": "Question",
                    "name": "สูตรคำนวณภาษีเงินได้บุคคลธรรมดาคิดอย่างไร?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "สูตรคำนวณคือ: (เงินได้พึงประเมิน - ค่าใช้จ่ายตามกฎหมาย - ค่าลดหย่อนทั้งหมด - เงินบริจาค) = เงินได้สุทธิ จากนั้นนำเงินได้สุทธิไปคูณกับอัตราภาษีแบบขั้นบันไดก้าวหน้า 5% ถึง 35% จะได้ภาษีที่ต้องชำระ แล้วนำไปหักลบกับภาษีหัก ณ ที่จ่ายที่จ่ายล่วงหน้าไปแล้วเพื่อทราบว่าต้องจ่ายเพิ่มหรือได้รับเงินคืนภาษี"
                    }
                },
                {
                    "@type": "Question",
                    "name": "ดอกเบี้ยเงินกู้บ้านนำมาหักลดหย่อนภาษีได้เท่าไหร่?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "ดอกเบี้ยเงินกู้ยืมเพื่อซื้อ เช่าซื้อ หรือสร้างอาคารที่อยู่อาศัย สามารถนำมาหักลดหย่อนภาษีได้ตามที่จ่ายจริง แต่สูงสุดไม่เกิน 100,000 บาท โดยสามารถขอหนังสือรับรองดอกเบี้ยเงินกู้ยืมจากธนาคารเพื่อนำมาแนบยื่นภาษีได้"
                    }
                }
            ]
        }
    ]
}
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">การเงิน ภาษี & วางแผนความมั่งคั่ง</span>
        <h1 class="workspace-title">คำนวณภาษีเงินได้บุคคลธรรมดา 2567 - 2568 (ภ.ง.ด. 90/91)</h1>
        <p class="workspace-subtitle">
            คำนวณภาษีเงินได้สุทธิ อัตราก้าวหน้า 0-35% รวมสิทธิลดหย่อนภาษีใหม่ล่าสุด ThaiESG 3 แสน ประกันสังคม และดอกเบี้ยบ้าน สรุปยอดเงินคืนภาษีหรือยอดชำระเพิ่มทันที
        </p>
    </div>
</div>

<form id="tax-calculator-form" onsubmit="return false;">
    <div class="tool-grid-2">
        <!-- Input Panel -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">1. รายได้ทั้งปี (เงินได้พึงประเมิน)</h2>
                <span class="tag-badge">ปีภาษี 2567/2568</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="tax-income-salary">เงินเดือนรวมทั้งปี (บาท)</label>
                <input type="number" id="tax-income-salary" class="form-control" style="font-size: 1.15rem; font-weight: 600;" value="420000" placeholder="เช่น 420000 (เดือนละ 35,000)">
            </div>

            <div class="form-row" style="margin-bottom: 1rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="tax-income-bonus">โบนัสทั้งปี (บาท)</label>
                    <input type="number" id="tax-income-bonus" class="form-control" value="70000" placeholder="เช่น 70000">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="tax-income-other">รายได้อื่นๆ / ฟรีแลนซ์ (บาท)</label>
                    <input type="number" id="tax-income-other" class="form-control" value="0" placeholder="เช่น 50000">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="tax-withholding">ภาษีหัก ณ ที่จ่ายสะสมที่จ่ายไปแล้ว (ตามใบ 50 ทวิ)</label>
                <input type="number" id="tax-withholding" class="form-control" value="6500" placeholder="เช่น 6500">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างรายได้ยอดนิยม:</span>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button type="button" class="btn-copy btn-preset-tax" data-salary="300000" data-bonus="25000" data-wht="0">เงินเดือน 25k (300k/ปี)</button>
                    <button type="button" class="btn-copy btn-preset-tax" data-salary="480000" data-bonus="80000" data-wht="9500">เงินเดือน 40k (480k/ปี)</button>
                    <button type="button" class="btn-copy btn-preset-tax" data-salary="840000" data-bonus="140000" data-wht="38000">เงินเดือน 70k (840k/ปี)</button>
                </div>
            </div>

            <!-- Deductions Accordion / Sections -->
            <div class="card-title-bar" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
                <h2 class="card-title">2. ค่าลดหย่อนภาษี (Deductions)</h2>
                <span class="tag-badge">สิทธิประโยชน์</span>
            </div>

            <div style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 0.75rem;">
                • ลดหย่อนผู้มีเงินได้ส่วนตัว: <strong>60,000 บาท</strong> (คำนวณให้อัตโนมัติ)<br>
                • ค่าใช้จ่ายตามกฎหมาย 50%: <strong>สูงสุด 100,000 บาท</strong> (คำนวณให้อัตโนมัติ)
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                <!-- Spouse & Kids -->
                <div style="background: var(--bg-secondary); padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border-color);">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-primary);">ครอบครัว</div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <input type="checkbox" id="ded-spouse" style="accent-color: #10b981; width: 16px; height: 16px;">
                        <label for="ded-spouse" style="font-size: 0.85rem; cursor: pointer;">มีคู่สมรสไม่มีเงินได้ (ลดหย่อน 60,000 บ.)</label>
                    </div>
                    <div class="form-row" style="margin-bottom: 0;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">จำนวนบุตร (คนละ 30,000)</label>
                            <input type="number" id="ded-children" class="form-control" style="padding: 0.4rem;" min="0" max="10" value="0">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">บิดา-มารดา อายุ 60+ (คนละ 30,000)</label>
                            <input type="number" id="ded-parents" class="form-control" style="padding: 0.4rem;" min="0" max="4" value="0">
                        </div>
                    </div>
                </div>

                <!-- Social & Insurance -->
                <div style="background: var(--bg-secondary); padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border-color);">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-primary);">ประกัน & การออม</div>
                    <div class="form-row" style="margin-bottom: 0.5rem;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">ประกันสังคม (สูงสุด 9,000)</label>
                            <input type="number" id="ded-social" class="form-control" style="padding: 0.4rem;" value="9000">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">เบี้ยประกันชีวิตทั่วไป (สูงสุด 100k)</label>
                            <input type="number" id="ded-life-ins" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                    </div>
                    <div class="form-row" style="margin-bottom: 0;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">เบี้ยประกันสุขภาพ (สูงสุด 25k)</label>
                            <input type="number" id="ded-health-ins" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">กองทุนสำรองเลี้ยงชีพ/กบข.</label>
                            <input type="number" id="ded-pvd" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                    </div>
                </div>

                <!-- Tax Saving Funds: ThaiESG & RMF/SSF -->
                <div style="background: var(--bg-secondary); padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border-color);">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
                        <div style="font-weight: 600; font-size: 0.85rem; color: var(--text-primary);">กองทุนประหยัดภาษี (เกณฑ์ 2567)</div>
                        <span class="tag-badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">ThaiESG เกณฑ์ใหม่</span>
                    </div>
                    <div class="form-group" style="margin-bottom: 0.5rem;">
                        <label class="form-label" style="font-size: 0.78rem;">ThaiESG (สูงสุด 30% ไม่เกิน 300,000 บ. ถือ 5 ปี)</label>
                        <input type="number" id="ded-thaiesg" class="form-control" style="padding: 0.4rem;" value="0" placeholder="0">
                    </div>
                    <div class="form-row" style="margin-bottom: 0;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">RMF (สูงสุด 30% ไม่เกิน 500k)</label>
                            <input type="number" id="ded-rmf" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">SSF (สูงสุด 30% ไม่เกิน 200k)</label>
                            <input type="number" id="ded-ssf" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                    </div>
                </div>

                <!-- Housing & Donations -->
                <div style="background: var(--bg-secondary); padding: 0.75rem; border-radius: 8px; border: 1px solid var(--border-color);">
                    <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-primary);">อสังหาฯ & เงินบริจาค</div>
                    <div class="form-row" style="margin-bottom: 0.5rem;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">ดอกเบี้ยกู้ซื้อบ้าน (สูงสุด 100,000)</label>
                            <input type="number" id="ded-home-loan" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">Easy E-Receipt (สูงสุด 50,000)</label>
                            <input type="number" id="ded-easy-ereceipt" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                    </div>
                    <div class="form-row" style="margin-bottom: 0;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">บริจาคการศึกษา/รพ.รัฐ (ลดหย่อน 2 เท่า)</label>
                            <input type="number" id="ded-donation-edu" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label" style="font-size: 0.78rem;">บริจาคทั่วไป (ตามจ่ายจริง)</label>
                            <input type="number" id="ded-donation-general" class="form-control" style="padding: 0.4rem;" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Result Summary Panel -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">สรุปผลการคำนวณภาษี & เงินคืน</h2>
                <span class="tag-badge">แม่นยำ 100%</span>
            </div>

            <!-- Big Status Box -->
            <div class="result-box" style="margin-top: 0; margin-bottom: 1.25rem;">
                <div class="result-header">
                    <span id="res-tax-status-text" class="result-label" style="font-weight: 600;">ยอดที่ได้รับเงินคืนภาษี (ขอคืนได้)</span>
                </div>
                <div id="res-tax-final-amount" class="result-text" style="font-size: 2rem; font-weight: 700; color: #10b981;">
                    0 บาท
                </div>
                <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem;">
                    เปรียบเทียบจากภาษีสุทธิที่คำนวณได้กับภาษีหัก ณ ที่จ่ายที่จ่ายล่วงหน้าไปแล้ว
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-label">รายได้รวมทั้งปี</div>
                    <div id="res-total-income" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">หักค่าใช้จ่าย 50%</div>
                    <div id="res-total-expense" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">หักค่าลดหย่อนรวม</div>
                    <div id="res-total-deduction" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">เงินได้สุทธิ (ฐานภาษี)</div>
                    <div id="res-net-income" class="stat-value" style="font-weight: 700; color: var(--text-primary);">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">ภาษีที่คำนวณได้จริง</div>
                    <div id="res-tax-calculated" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">ภาษีหัก ณ ที่จ่ายไปแล้ว</div>
                    <div id="res-tax-withholding" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">อัตราภาษีสูงสุดที่เสีย</div>
                    <div id="res-bracket-rate" class="stat-value" style="color: #3b82f6;">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">แบบยื่นภาษีที่ใช้</div>
                    <div class="stat-value" style="font-size: 0.85rem; font-weight: 600;">ภ.ง.ด. 91 / 90</div>
                </div>
            </div>

            <!-- Progressive Bracket Breakdown -->
            <div style="margin-top: 1.25rem;">
                <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-primary);">
                    แจกแจงภาษีตามขั้นบันไดอัตราก้าวหน้า:
                </div>
                <div id="tax-bracket-breakdown" style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <!-- Injected by JS -->
                </div>
            </div>

            <!-- Report Export Bar -->
            <div class="report-export-box">
                <div class="report-export-desc">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    <span>ส่งออกรายงานสรุปภาษีและรายการหักลดหย่อน</span>
                </div>
                <div class="report-export-dropdown" id="export-dropdown-tax">
                    <button type="button" class="btn-export-trigger" aria-expanded="false" title="ส่งออกรายงานภาษีเงินได้บุคคลธรรมดา">
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
                                <small>สรุปภาษี + รายการลดหย่อน + ขั้นบันได</small>
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
</form>

<!-- Comprehensive SEO & AI Crawler Guide Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">ความรู้ภาษีและตารางอัตราภาษีเงินได้บุคคลธรรมดา 2567 - 2568</h2>
        <span class="tag-badge">เกณฑ์กรมสรรพากร</span>
    </div>
    
    <div style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.75;">
        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.5rem;">
            ตารางอัตราภาษีเงินได้บุคคลธรรมดาแบบขั้นบันไดก้าวหน้า
        </h3>
        <p style="margin-bottom: 1rem;">
            ประเทศไทยจัดเก็บภาษีเงินได้บุคคลธรรมดาด้วยอัตราภาษีแบบก้าวหน้า (Progressive Tax Rate) ยิ่งมีเงินได้สุทธิมาก ยิ่งเสียภาษีในอัตราส่วนที่สูงขึ้นตามขั้นบันไดดังต่อไปนี้:
        </p>

        <div style="overflow-x: auto; margin-bottom: 1.25rem;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-primary);">
                        <th style="padding: 0.5rem;">เงินได้สุทธิต่อปี (บาท)</th>
                        <th style="padding: 0.5rem;">อัตราภาษี</th>
                        <th style="padding: 0.5rem;">ภาษีสูงสุดในแต่ละขั้น</th>
                        <th style="padding: 0.5rem;">ภาษีสะสมสูงสุด</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">0 - 150,000</td>
                        <td style="padding: 0.5rem; color: #10b981; font-weight: 600;">ได้รับการยกเว้น (0%)</td>
                        <td style="padding: 0.5rem;">0 บาท</td>
                        <td style="padding: 0.5rem;">0 บาท</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">150,001 - 300,000</td>
                        <td style="padding: 0.5rem; font-weight: 600;">5%</td>
                        <td style="padding: 0.5rem;">7,500 บาท</td>
                        <td style="padding: 0.5rem;">7,500 บาท</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">300,001 - 500,000</td>
                        <td style="padding: 0.5rem; font-weight: 600;">10%</td>
                        <td style="padding: 0.5rem;">20,000 บาท</td>
                        <td style="padding: 0.5rem;">27,500 บาท</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">500,001 - 750,000</td>
                        <td style="padding: 0.5rem; font-weight: 600;">15%</td>
                        <td style="padding: 0.5rem;">37,500 บาท</td>
                        <td style="padding: 0.5rem;">65,000 บาท</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">750,001 - 1,000,000</td>
                        <td style="padding: 0.5rem; font-weight: 600;">20%</td>
                        <td style="padding: 0.5rem;">50,000 บาท</td>
                        <td style="padding: 0.5rem;">115,000 บาท</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">1,000,001 - 2,000,000</td>
                        <td style="padding: 0.5rem; font-weight: 600;">25%</td>
                        <td style="padding: 0.5rem;">250,000 บาท</td>
                        <td style="padding: 0.5rem;">365,000 บาท</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">2,000,001 - 5,000,000</td>
                        <td style="padding: 0.5rem; font-weight: 600;">30%</td>
                        <td style="padding: 0.5rem;">900,000 บาท</td>
                        <td style="padding: 0.5rem;">1,265,000 บาท</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem;">มากกว่า 5,000,000 ขึ้นไป</td>
                        <td style="padding: 0.5rem; color: #ef4444; font-weight: 600;">35%</td>
                        <td style="padding: 0.5rem;">ตามจริง</td>
                        <td style="padding: 0.5rem;">-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- FAQ Section -->
        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-top: 1.5rem; margin-bottom: 0.75rem;">
            คำถามที่พบบ่อยเกี่ยวกับการยื่นภาษีและเงินคืนภาษี (FAQ)
        </h3>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div>
                <h4 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.25rem;">Q: ได้รับเงินคืนภาษีได้อย่างไร และเงินเข้าทางไหน?</h4>
                <p>
                    A: หากภาษีหัก ณ ที่จ่ายสะสมที่นายจ้างหักไว้สูงกว่าภาษีจริงที่ต้องเสีย เมื่อยื่นแบบ ภ.ง.ด. 91 หรือ 90 ทางอินเทอร์เน็ตของกรมสรรพากร คุณสามารถเลือก "ขอคืนภาษี" ได้ โดยกรมสรรพากรจะโอนเงินภาษีคืนเข้าบัญชีธนาคารที่ผูกพร้อมเพย์ด้วยเลขบัตรประชาชน 13 หลักอย่างรวดเร็ว (มักใช้เวลาเพียง 3 - 7 วันทำการ)
                </p>
            </div>
            <div>
                <h4 style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 0.25rem;">Q: กองทุน ThaiESG ซื้อได้เท่าไหร่ และดีกว่า RMF/SSF อย่างไร?</h4>
                <p>
                    A: กองทุนรวมไทยเพื่อความยั่งยืน (ThaiESG) ในปี 2567 ได้รับการปรับเงื่อนไขใหม่ สามารถลดหย่อนได้สูงสุดถึง 30% ของเงินได้ แต่ไม่เกิน 300,000 บาท โดยมีระยะเวลาถือครองสั้นลงเหลือเพียง 5 ปีเต็ม (เทียบกับ SSF 10 ปี และ RMF ที่ต้องถือถึงอายุ 55 ปี) และสำคัญที่สุดคือ วงเงิน ThaiESG 300,000 บาทนี้ ไม่นับรวมในเพดาน 500,000 บาทของกลุ่มเกษียณเดิม ทำให้ลดหย่อนภาษีได้เพิ่มขึ้นอย่างมาก
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/export-report.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/tax.js') ?>"></script>
<?= $this->endSection() ?>
