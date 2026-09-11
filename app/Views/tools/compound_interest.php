<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมคำนวณดอกเบี้ยทบต้น & ออมเงิน DCA วางแผนเกษียณ",
            "url": "<?= current_url() ?>",
            "description": "คำนวณดอกเบี้ยทบต้น (Compound Interest) วางแผนออมเงินรายเดือนแบบ DCA คำนวณเงินสะสมในอนาคต สัดส่วนดอกเบี้ย และตารางการเติบโตรายปี",
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
                    "name": "ดอกเบี้ยทบต้นคืออะไร และทำไมถึงเรียกว่าสิ่งมหัศจรรย์อันดับ 8 ของโลก?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "ดอกเบี้ยทบต้น (Compound Interest) คือ การนำดอกเบี้ยหรือผลตอบแทนที่ได้รับในแต่ละงวด ไปรวมกับเงินต้นเดิมเพื่อให้เกิดผลตอบแทนในงวดถัดไป ทำให้ยอดเงินลงทุนขยายตัวแบบก้าวกระโดด (Exponential Growth) ยิ่งมีระยะเวลาในการลงทุนนานเท่าไหร่ สัดส่วนของดอกเบี้ยจะเพิ่มขึ้นแซงหน้าเงินต้นอย่างมหาศาล จน อัลเบิร์ต ไอน์สไตน์ ได้กล่าวยกย่องว่าเป็นสิ่งมหัศจรรย์อันดับ 8 ของโลก"
                    }
                },
                {
                    "@type": "Question",
                    "name": "ออมเงิน DCA เดือนละ 5,000 บาท 20 ปี ผลตอบแทน 8% จะได้เงินกี่ล้าน?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "การออมเงินหรือลงทุนแบบ DCA สม่ำเสมอเดือนละ 5,000 บาท เป็นเวลา 20 ปี เงินต้นที่คุณควักกระเป๋าจ่ายจริงคือ 1,200,000 บาท แต่ด้วยพลังของดอกเบี้ยทบต้นที่ผลตอบแทนเฉลี่ย 8% ต่อปี ยอดเงินรวมจะกลายเป็นประมาณ 2,960,000 บาท โดยเป็นผลตอบแทนทบต้นถึง 1,760,000 บาท (มากกว่าเงินต้นกว่า 1.4 เท่า)"
                    }
                },
                {
                    "@type": "Question",
                    "name": "กฎ 72 (Rule of 72) คืออะไร?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "กฎ 72 เป็นวิธีคำนวณคร่าวๆ ว่าต้องใช้เวลากี่ปีเงินลงทุนจึงจะเติบโตขึ้นเป็น 2 เท่าตัว โดยนำ 72 หารด้วยอัตราผลตอบแทนต่อปี เช่น หากลงทุนได้ผลตอบแทนเฉลี่ย 8% ต่อปี จะใช้เวลาประมาณ 72 / 8 = 9 ปี เงินต้นของคุณจึงจะเพิ่มเป็น 2 เท่าตัว"
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
        <span class="workspace-category">การเงิน การลงทุน & วางแผนเกษียณ</span>
        <h1 class="workspace-title">คำนวณดอกเบี้ยทบต้น & ออมเงิน DCA วางแผนเกษียณ</h1>
        <p class="workspace-subtitle">
            คำนวณมูลค่าเงินออมในอนาคตด้วยพลังของดอกเบี้ยทบต้น (Compound Interest) พร้อมออมเงินสมทบรายเดือน แสดงสัดส่วนเงินต้นและกำไรสะสมอย่างชัดเจน
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <!-- Input Panel -->
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กำหนดเป้าหมายเงินออม & ผลตอบแทน</h2>
            <span class="tag-badge">DCA ทบต้นรายเดือน</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="ci-initial-input">เงินต้นเริ่มต้น (บาท)</label>
            <input type="number" id="ci-initial-input" class="form-control" style="font-size: 1.15rem; font-weight: 700;" value="50000" placeholder="เช่น 50000">
        </div>

        <div class="form-group">
            <label class="form-label" for="ci-monthly-input">เงินออมสมทบทุกเดือน DCA (บาท/เดือน)</label>
            <input type="number" id="ci-monthly-input" class="form-control" style="font-size: 1.15rem; font-weight: 700;" value="5000" placeholder="เช่น 5000">
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="ci-rate-input">ผลตอบแทนคาดหวัง (% ต่อปี)</label>
                <input type="number" step="0.1" id="ci-rate-input" class="form-control" value="8" placeholder="เช่น 8">
            </div>
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="ci-years-input">ระยะเวลาออม (ปี)</label>
                <input type="number" id="ci-years-input" class="form-control" value="15" min="1" max="50">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="ci-freq-select">ความถี่ในการทบต้น</label>
            <select id="ci-freq-select" class="form-control">
                <option value="12" selected>ทบต้นทุกเดือน (Monthly Compound - แนะนำสำหรับ DCA)</option>
                <option value="1">ทบต้นรายปี (Annually Compound)</option>
            </select>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างเป้าหมายยอดนิยม:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-ci" data-init="10000" data-monthly="3000" data-rate="7" data-years="10">คนเริ่มทำงาน (3k/ด 10ปี)</button>
                <button type="button" class="btn-copy btn-preset-ci" data-init="50000" data-monthly="10000" data-rate="8" data-years="20">วัยกลางคน (10k/ด 20ปี)</button>
                <button type="button" class="btn-copy btn-preset-ci" data-init="200000" data-monthly="20000" data-rate="10" data-years="25">พอร์ตเกษียณ 10 ล้าน</button>
            </div>
        </div>
    </div>

    <!-- Result Panel -->
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">มูลค่าเงินในอนาคต</h2>
            <span class="tag-badge">ผลตอบแทนทบต้น</span>
        </div>

        <!-- Total Wealth Box -->
        <div class="result-box" style="margin-top: 0; margin-bottom: 1.25rem;">
            <div class="result-header">
                <span class="result-label">มูลค่าเงินรวมเมื่อครบกำหนด</span>
            </div>
            <div id="res-ci-total" class="result-text" style="font-size: 2.25rem; font-weight: 700; color: #10b981;">
                -
            </div>
            <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem;">
                เติบโตขึ้นเป็น <span id="res-ci-multiplier" style="color: var(--text-primary); font-weight: 600;">-</span> ของเงินต้นทั้งหมด
            </div>

            <!-- Visual Bar: Principal vs Interest -->
            <div style="margin-top: 1rem;">
                <div style="display: flex; height: 12px; border-radius: 6px; overflow: hidden; background: var(--border-color);">
                    <div id="ci-bar-principal" style="background: #3b82f6; width: 50%; transition: width 0.3s ease;"></div>
                    <div id="ci-bar-interest" style="background: #10b981; width: 50%; transition: width 0.3s ease;"></div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 0.75rem; margin-top: 0.4rem;">
                    <span style="color: #3b82f6;">● เงินต้นสะสม (<span id="ci-pct-principal">-</span>)</span>
                    <span style="color: #10b981;">● กำไรดอกเบี้ยทบต้น (<span id="ci-pct-interest">-</span>)</span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">เงินต้นที่ควักกระเป๋าจ่ายจริง</div>
                <div id="res-ci-principal" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">ผลตอบแทน/ดอกเบี้ยที่งอกเงย</div>
                <div id="res-ci-interest" class="stat-value" style="color: #10b981;">-</div>
            </div>
        </div>

        <!-- Yearly Growth Table Preview -->
        <div style="margin-top: 1.25rem;">
            <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-primary);">
                การเติบโตของพอร์ตสะสมรายปี:
            </div>
            <div style="max-height: 180px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 8px;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.8rem; text-align: left;">
                    <thead>
                        <tr style="background: var(--bg-secondary); border-bottom: 1px solid var(--border-color); color: var(--text-muted);">
                            <th style="padding: 0.5rem;">ปี</th>
                            <th style="padding: 0.5rem;">เงินต้นสะสม</th>
                            <th style="padding: 0.5rem;">ดอกเบี้ยสะสม</th>
                            <th style="padding: 0.5rem;">ยอดเงินรวม</th>
                        </tr>
                    </thead>
                    <tbody id="ci-yearly-table-body">
                        <!-- Injected by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Knowledge & Guide Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">หลักการดอกเบี้ยทบต้น & กฎ 72 สำหรับการวางแผนเกษียณ</h2>
        <span class="tag-badge">ความรู้การเงิน</span>
    </div>

    <div style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.75;">
        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.5rem;">
            ทำไมต้องเริ่มออมเงินเร็ว? (พลังของเวลาในดอกเบี้ยทบต้น)
        </h3>
        <p style="margin-bottom: 1rem;">
            ในสูตรดอกเบี้ยทบต้น ตัวแปรที่มีอิทธิพลต่อผลลัพธ์สุดท้ายมากที่สุดไม่ใช่ "จำนวนเงิน" แต่คือ <strong>"เวลา (t)"</strong> ซึ่งทำหน้าที่เป็นเลขชี้กำลัง ยิ่งคุณเริ่มต้นลงทุนตั้งแต่อายุน้อย เงินที่ลงไปจะสร้างผลตอบแทนทบต้นต่อยอดไปเรื่อยๆ จนดอกเบี้ยในแต่ละปีสูงกว่าเงินต้นที่คุณใส่เข้าไปในทั้งปีเสียอีก
        </p>

        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.5rem;">
            ผลตอบแทนเฉลี่ยในสินทรัพย์ต่างๆ ของไทย
        </h3>
        <ul style="padding-left: 1.25rem; margin-bottom: 1rem;">
            <li><strong>เงินฝากประจำ / ดิจิทัล:</strong> ประมาณ 1.5% - 2.0% ต่อปี (ความเสี่ยงต่ำมาก)</li>
            <li><strong>กองทุนรวมตราสารหนี้:</strong> ประมาณ 2.0% - 3.5% ต่อปี</li>
            <li><strong>กองทุนรวมอสังหาริมทรัพย์ / REIT:</strong> ประมาณ 5.0% - 7.0% ต่อปี</li>
            <li><strong>ดัชนีหุ้นไทย (SET Total Return Index):</strong> ผลตอบแทนระยะยาวเฉลี่ย 7% - 9% ต่อปี (รวมเงินปันผล)</li>
            <li><strong>ดัชนีหุ้นโลก / S&amp;P 500:</strong> ผลตอบแทนย้อนหลังเฉลี่ย 8% - 10% ต่อปี</li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/compound_interest.js') ?>"></script>
<?= $this->endSection() ?>
