<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมคำนวณค่าไฟฟ้าบ้าน MEA / PEA & คำนวณแอร์กินไฟกี่บาท",
            "url": "<?= current_url() ?>",
            "description": "คำนวณค่าไฟบ้านตามบิลการไฟฟ้านครหลวงและการไฟฟ้าส่วนภูมิภาค อัตราก้าวหน้า ค่า Ft ล่าสุด และคำนวณเปิดแอร์ ตู้เย็น พัดลม ชาร์จรถ EV กินไฟกี่บาทต่อวัน/ต่อเดือน",
            "applicationCategory": "UtilitiesApplication",
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
                    "name": "เปิดแอร์ 12000 BTU Inverter วันละ 8 ชั่วโมง กินไฟเดือนละกี่บาท?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "แอร์ 12,000 BTU ระบบ Inverter จะใช้กำลังไฟฟ้าเฉลี่ยประมาณ 800 - 900 วัตต์ เมื่อคอมเพรสเซอร์ทำงานสลับตัดต่อ (กินไฟเฉลี่ยชั่วโมงละประมาณ 0.6 - 0.7 หน่วย) หากเปิดวันละ 8 ชั่วโมง จะใช้ไฟประมาณ 5 - 5.6 หน่วยต่อวัน หรือประมาณ 150 - 168 หน่วยต่อเดือน คิดเป็นค่าไฟประมาณ 700 - 800 บาทต่อเดือน (ขึ้นอยู่กับค่า Ft และอัตราค่าไฟเฉลี่ย 4.70 บาทต่อหน่วย)"
                    }
                },
                {
                    "@type": "Question",
                    "name": "ค่า Ft ในบิลค่าไฟคืออะไร และคิดอย่างไร?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "ค่า Ft (Fuel Adjustment Charge) คือ ค่าไฟฟ้าผันแปรที่สะท้อนต้นทุนเชื้อเพลิงในการผลิตกระแสไฟฟ้า (เช่น ก๊าซธรรมชาติ น้ำมัน ถ่านหิน) และค่าซื้อไฟฟ้าจากเอกชนที่เปลี่ยนแปลงไปจากค่าไฟฟ้าฐาน โดยคณะกรรมการกำกับกิจการพลังงาน (กกพ.) จะทบทวนทุก 4 เดือน โดยคำนวณจาก: จำนวนหน่วยไฟฟ้าที่ใช้ (kWh) x อัตราค่า Ft (บาทต่อหน่วย)"
                    }
                },
                {
                    "@type": "Question",
                    "name": "ค่าไฟฟ้าบ้านอยู่อาศัยประเภท 1.1 กับ 1.2 ต่างกันอย่างไร?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "ประเภท 1.1 สำหรับบ้านที่ติดตั้งมิเตอร์ขนาดไม่เกิน 5 แอมป์ และใช้ไฟฟ้าไม่เกิน 150 หน่วยต่อเดือน มีอัตราค่าบริการรายเดือน 8.19 บาท ส่วนประเภท 1.2 สำหรับบ้านที่ติดตั้งมิเตอร์เกิน 5 แอมป์ หรือใช้ไฟฟ้าเกิน 150 หน่วยต่อเดือนติดต่อกัน อัตราค่าบริการรายเดือน 24.62 บาท (กฟน.) หรือ 38.22 บาท (กฟภ.) และมีขั้นบันไดอัตราค่าไฟฟ้าที่แตกต่างกัน"
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
        <span class="workspace-category">สาธารณูปโภค พลังงาน & ค่าใช้จ่าย</span>
        <h1 class="workspace-title">คำนวณค่าไฟฟ้าบ้าน & เปิดแอร์กินไฟกี่บาท (MEA & PEA)</h1>
        <p class="workspace-subtitle">
            คำนวณค่าไฟอัตราก้าวหน้าตามบิลการไฟฟ้าจริง รวมค่าบริการ ค่า Ft ปัจจุบัน และ VAT 7% พร้อมโหมดคำนวณการกินไฟของแอร์ ตู้เย็น พัดลม และชาร์จรถยนต์ไฟฟ้า EV
        </p>
    </div>
</div>

<!-- Tabs to Switch Mode -->
<div class="category-chips-bar" style="margin-bottom: 1.25rem;">
    <button type="button" id="tab-mode-bill" class="chip-btn active">คำนวณจากบิลค่าไฟ (จำนวนหน่วย)</button>
    <button type="button" id="tab-mode-appliance" class="chip-btn">คำนวณกินไฟเครื่องใช้ไฟฟ้า (เปิดแอร์กี่บาท)</button>
</div>

<!-- Mode 1: Bill Units Calculator -->
<div id="panel-mode-bill">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ระบุหน่วยไฟฟ้าที่ใช้ (kWh)</h2>
                <span class="tag-badge">การไฟฟ้า นครหลวง / ภูมิภาค</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="elec-units-input">จำนวนหน่วยไฟฟ้าที่ใช้ในรอบบิล (หน่วย / kWh)</label>
                <input type="number" id="elec-units-input" class="form-control" style="font-size: 1.25rem; font-weight: 700;" value="350" placeholder="เช่น 350">
            </div>

            <div class="form-row" style="margin-bottom: 1.25rem;">
                <div class="form-group" style="flex: 2; margin-bottom: 0;">
                    <label class="form-label" for="elec-tariff-type">ประเภทผู้ใช้ไฟฟ้า</label>
                    <select id="elec-tariff-type" class="form-control">
                        <option value="1.2" selected>ประเภท 1.2: บ้านอยู่อาศัย (ใช้เกิน 150 หน่วย)</option>
                        <option value="1.1">ประเภท 1.1: บ้านอยู่อาศัย (ใช้ไม่เกิน 150 หน่วย)</option>
                    </select>
                </div>
                <div class="form-group" style="flex: 1; margin-bottom: 0;">
                    <label class="form-label" for="elec-ft-rate">ค่า Ft (บาท/หน่วย)</label>
                    <input type="number" step="0.0001" id="elec-ft-rate" class="form-control" value="0.3972" placeholder="0.3972">
                </div>
            </div>

            <div>
                <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างจำนวนหน่วยยอดนิยม:</span>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button type="button" class="btn-copy btn-preset-elec" data-units="120">ห้องเช่า/คอนโด (120 หน่วย)</button>
                    <button type="button" class="btn-copy btn-preset-elec" data-units="350">ทาวน์โฮม (350 หน่วย)</button>
                    <button type="button" class="btn-copy btn-preset-elec" data-units="650">บ้านเดี่ยวเปิดแอร์ (650 หน่วย)</button>
                    <button type="button" class="btn-copy btn-preset-elec" data-units="1200">บ้านมีรถ EV (1,200 หน่วย)</button>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">สรุปยอดค่าไฟฟ้าที่ต้องชำระ</h2>
                <span class="tag-badge">รวม VAT 7% แล้ว</span>
            </div>

            <div class="result-box" style="margin-top: 0; margin-bottom: 1.25rem;">
                <div class="result-header">
                    <span class="result-label">ค่าไฟฟ้าสุทธิในบิล (บาท)</span>
                </div>
                <div id="res-elec-total-bill" class="result-text" style="font-size: 2rem; font-weight: 700; color: #10b981;">
                    -
                </div>
                <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem;">
                    เฉลี่ยประมาณ <span id="res-elec-avg-cost" style="color: var(--text-primary); font-weight: 600;">-</span>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-label">1. ค่าพลังงานไฟฟ้าฐาน</div>
                    <div id="res-elec-energy-charge" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">2. ค่าบริการรายเดือน</div>
                    <div id="res-elec-service-fee" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">3. ค่าไฟฟ้าผันแปร (Ft)</div>
                    <div id="res-elec-ft-charge" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">4. ภาษีมูลค่าเพิ่ม (VAT 7%)</div>
                    <div id="res-elec-vat" class="stat-value">-</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mode 2: Appliance Power Calculator -->
<div id="panel-mode-appliance" style="display: none;">
    <div class="tool-grid-2">
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">เลือกเครื่องใช้ไฟฟ้า & ระยะเวลาเปิด</h2>
                <span class="tag-badge">ประมาณการกินไฟ</span>
            </div>

            <div class="form-group">
                <label class="form-label" for="app-select-type">ประเภทเครื่องใช้ไฟฟ้า</label>
                <select id="app-select-type" class="form-control" style="font-size: 1rem; font-weight: 600;">
                    <option value="650">แอร์ 9,000 BTU Inverter (~650W)</option>
                    <option value="900" selected>แอร์ 12,000 BTU Inverter (~900W)</option>
                    <option value="1400">แอร์ 18,000 BTU Inverter (~1,400W)</option>
                    <option value="1900">แอร์ 24,000 BTU Inverter (~1,900W)</option>
                    <option value="1200">แอร์ 12,000 BTU ธรรมดา Non-Inverter (~1,200W)</option>
                    <option value="55">พัดลมตั้งโต๊ะ / พัดลมเพดาน (~55W)</option>
                    <option value="120">ตู้เย็น 2 ประตู (~120W)</option>
                    <option value="250">คอมพิวเตอร์ Desktop PC (~250W)</option>
                    <option value="60">Smart TV 55 นิ้ว (~60W)</option>
                    <option value="3500">เครื่องทำน้ำอุ่น (~3,500W)</option>
                    <option value="7400">ชาร์จรถยนต์ไฟฟ้า EV Wallbox (~7,400W)</option>
                    <option value="custom">กำหนดกำลังไฟเอง (วัตต์)</option>
                </select>
            </div>

            <div class="form-row" style="margin-bottom: 1.25rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="app-watts-input">กำลังไฟฟ้า (วัตต์ / Watts)</label>
                    <input type="number" id="app-watts-input" class="form-control" value="900">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="app-count-input">จำนวนเครื่อง</label>
                    <input type="number" id="app-count-input" class="form-control" value="1" min="1" max="20">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="app-hours-input">เปิดใช้งานเฉลี่ยต่อวัน (ชั่วโมง / วัน)</label>
                <input type="number" id="app-hours-input" class="form-control" value="8" min="0.5" max="24" step="0.5">
            </div>
        </div>

        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ประมาณการค่าไฟของอุปกรณ์นี้</h2>
                <span class="tag-badge">คิดที่อัตรา ~4.70 บ./หน่วย</span>
            </div>

            <div class="result-box" style="margin-top: 0; margin-bottom: 1.25rem;">
                <div class="result-header">
                    <span class="result-label">ค่าไฟต่อเดือน (30 วัน)</span>
                </div>
                <div id="res-app-monthly-cost" class="result-text" style="font-size: 2rem; font-weight: 700; color: #10b981;">
                    -
                </div>
                <div style="font-size: 0.8rem; color: var(--text-secondary); margin-top: 0.25rem;">
                    คิดเป็นค่าไฟวันละประมาณ <span id="res-app-daily-cost" style="color: var(--text-primary); font-weight: 600;">-</span>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-label">จำนวนหน่วยกินไฟต่อวัน</div>
                    <div id="res-app-daily-kwh" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">จำนวนหน่วยกินไฟต่อเดือน</div>
                    <div id="res-app-monthly-kwh" class="stat-value">-</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SEO & Knowledge Guide Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">ความรู้เรื่องค่าไฟฟ้า อัตราก้าวหน้า และเคล็ดลับประหยัดไฟบ้าน</h2>
        <span class="tag-badge">สูตรคำนวณมาตรฐาน</span>
    </div>

    <div style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.75;">
        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.5rem;">
            ตารางอัตราค่าไฟฟ้าประเภท 1.2 (บ้านพักอาศัยที่ใช้ไฟฟ้าเกิน 150 หน่วยต่อเดือน)
        </h3>
        <p style="margin-bottom: 1rem;">
            โครงสร้างอัตราค่าไฟฟ้าของไทยคิดแบบอัตราก้าวหน้า (Progressive Tariff) ยิ่งใช้หน่วยไฟมาก อัตราค่าไฟต่อหน่วยยิ่งแพงขึ้น:
        </p>

        <div style="overflow-x: auto; margin-bottom: 1.25rem;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-primary);">
                        <th style="padding: 0.5rem;">ช่วงหน่วยไฟฟ้า (หน่วย / kWh)</th>
                        <th style="padding: 0.5rem;">ค่าพลังงานไฟฟ้าฐาน (บาท/หน่วย)</th>
                        <th style="padding: 0.5rem;">หมายเหตุ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">1 - 150 หน่วยแรก</td>
                        <td style="padding: 0.5rem; font-weight: 600; color: #10b981;">3.2484 บาท</td>
                        <td style="padding: 0.5rem;">ขั้นต่ำสุด</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem;">151 - 400 หน่วยต่อไป</td>
                        <td style="padding: 0.5rem; font-weight: 600; color: #3b82f6;">4.2218 บาท</td>
                        <td style="padding: 0.5rem;">ช่วงการใช้งานปานกลาง</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem;">เกิน 400 หน่วยขึ้นไป</td>
                        <td style="padding: 0.5rem; font-weight: 600; color: #ef4444;">4.4217 บาท</td>
                        <td style="padding: 0.5rem;">อัตราสูงสุด</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-top: 1.25rem; margin-bottom: 0.5rem;">
            สูตรคำนวณการกินไฟของเครื่องใช้ไฟฟ้า
        </h3>
        <p style="margin-bottom: 0.5rem;">
            <strong>จำนวนหน่วย (kWh) = (กำลังไฟฟ้าวัตต์ x ชั่วโมงใช้งาน x จำนวนเครื่อง) / 1,000</strong><br>
            <strong>ค่าไฟ (บาท) = จำนวนหน่วย x ค่าไฟเฉลี่ยต่อหน่วย (ประมาณ 4.70 บาท รวม Ft + VAT)</strong>
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/electricity.js') ?>"></script>
<?= $this->endSection() ?>
