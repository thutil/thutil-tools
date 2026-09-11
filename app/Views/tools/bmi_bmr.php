<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "โปรแกรมคำนวณ BMI & BMR TDEE เกณฑ์มาตรฐานคนไทย (กรมอนามัย)",
            "url": "<?= current_url() ?>",
            "description": "คำนวณค่าดัชนีมวลกาย (BMI) สำหรับคนไทยและเอเชีย คำนวณอัตราเผาผลาญพลังงานพื้นฐาน (BMR) และพลังงานรวมต่อวัน (TDEE) พร้อมปริมาณแคลอรี่แนะนำในการลดน้ำหนัก",
            "applicationCategory": "HealthApplication",
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
                    "name": "เกณฑ์ค่า BMI คนไทยและคนเอเชียต่างจากเกณฑ์สากล (ฝรั่ง) อย่างไร?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "คนเอเชียและคนไทยมีสัดส่วนไขมันสะสมในช่องท้อง (Visceral Fat) สูงกว่าชาวยุโรปแม้จะมีค่าดัชนีมวลกายเท่ากัน องค์การอนามัยโลก (WHO) และกรมอนามัย กระทรวงสาธารณสุข จึงปรับเกณฑ์ BMI สำหรับคนเอเชียให้เหมาะสม: เกณฑ์ปกติคนไทยคือ 18.5 - 22.9 (ขณะที่สากลคือ 18.5 - 24.9) และคนไทยที่ BMI ตั้งแต่ 23.0 ขึ้นไปจะถือว่าเริ่มมีภาวะน้ำหนักเกินและเสี่ยงต่อโรคเบาหวานความดัน"
                    }
                },
                {
                    "@type": "Question",
                    "name": "BMR กับ TDEE แตกต่างกันอย่างไร?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "BMR (Basal Metabolic Rate) คือ พลังงานขั้นต่ำสุดที่ร่างกายต้องการเพื่อใช้ในการหายใจ การสูบฉีดเลือด และการทำงานของอวัยวะขณะนอนพักเฉยๆ ส่วน TDEE (Total Daily Energy Expenditure) คือ พลังงานทั้งหมดที่ร่างกายเผาผลาญในแต่ละวัน โดยนำ BMR มาคูณกับระดับกิจกรรมทางกาย การทำงาน และการออกกำลังกาย"
                    }
                },
                {
                    "@type": "Question",
                    "name": "ถ้าต้องการลดน้ำหนัก ต้องกินวันละกี่แคลอรี่?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "การลดน้ำหนักอย่างยั่งยืนและปลอดภัย แนะนำให้จำกัดพลังงานให้น้อยกว่าค่า TDEE ประมาณ 500 กิโลแคลอรี่ต่อวัน (Calorie Deficit) ซึ่งจะช่วยให้น้ำหนักลดลงประมาณ 0.5 กิโลกรัมต่อสัปดาห์ (หรือประมาณ 2 กิโลกรัมต่อเดือน) โดยไม่ควรรับประทานต่ำกว่าค่า BMR หรือต่ำกว่า 1,200 กิโลแคลอรี่ต่อวันเพื่อป้องกันระบบเผาผลาญพัง"
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
        <span class="workspace-category">สุขภาพ โภชนาการ & ลดน้ำหนัก</span>
        <h1 class="workspace-title">คำนวณ BMI & BMR TDEE เกณฑ์คนไทย (กรมอนามัย)</h1>
        <p class="workspace-subtitle">
            คำนวณดัชนีมวลกายเกณฑ์เอเชียแปซิฟิก ประเมินระดับความอ้วน อัตราการเผาผลาญพื้นฐาน และพลังงานที่ต้องใช้ต่อวันเพื่อวางแผนลดน้ำหนักอย่างถูกต้อง
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <!-- Inputs -->
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ข้อมูลส่วนบุคคล</h2>
            <span class="tag-badge">เกณฑ์เอเชีย / ไทย</span>
        </div>

        <div class="form-group">
            <label class="form-label">เพศสภาพ</label>
            <div style="display: flex; gap: 1rem;">
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.9rem;">
                    <input type="radio" name="gender" id="bmi-gender-male" value="male" checked style="accent-color: #10b981;"> ชาย
                </label>
                <label style="display: flex; align-items: center; gap: 0.4rem; cursor: pointer; font-size: 0.9rem;">
                    <input type="radio" name="gender" id="bmi-gender-female" value="female" style="accent-color: #10b981;"> หญิง
                </label>
            </div>
        </div>

        <div class="form-row" style="margin-bottom: 1.25rem;">
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="bmi-age-input">อายุ (ปี)</label>
                <input type="number" id="bmi-age-input" class="form-control" value="28" min="10" max="120">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="bmi-height-input">ส่วนสูง (ซม.)</label>
                <input type="number" id="bmi-height-input" class="form-control" value="170" min="50" max="250">
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" for="bmi-weight-input">น้ำหนัก (กก.)</label>
                <input type="number" id="bmi-weight-input" class="form-control" value="68" min="20" max="300" step="0.5">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="bmi-activity-select">ระดับกิจกรรมในแต่ละวัน (เพื่อหา TDEE)</label>
            <select id="bmi-activity-select" class="form-control" style="font-size: 0.9rem;">
                <option value="1.2" selected>ไม่ออกกำลังกาย / นั่งทำงานออฟฟิศ (Sedentary)</option>
                <option value="1.375">ออกกำลังกายเบาๆ 1 - 3 วัน / สัปดาห์ (Lightly Active)</option>
                <option value="1.55">ออกกำลังกายปานกลาง 3 - 5 วัน / สัปดาห์ (Moderately Active)</option>
                <option value="1.725">ออกกำลังกายหนัก 6 - 7 วัน / สัปดาห์ (Very Active)</option>
                <option value="1.9">ออกกำลังกายหนักมาก / ทำงานใช้แรงงานหนัก (Extra Active)</option>
            </select>
        </div>

        <div>
            <span class="form-label" style="margin-bottom: 0.4rem;">ตัวอย่างทดสอบ:</span>
            <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                <button type="button" class="btn-copy btn-preset-bmi" data-g="m" data-a="28" data-h="175" data-w="68">ชาย สมส่วน (175cm / 68kg)</button>
                <button type="button" class="btn-copy btn-preset-bmi" data-g="f" data-a="25" data-h="160" data-w="52">หญิง หุ่นดี (160cm / 52kg)</button>
                <button type="button" class="btn-copy btn-preset-bmi" data-g="m" data-a="35" data-h="170" data-w="85">ชาย น้ำหนักเกิน (170cm / 85kg)</button>
            </div>
        </div>
    </div>

    <!-- Outputs -->
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">ผลการวิเคราะห์ดัชนีมวลกาย & พลังงาน</h2>
            <span class="tag-badge">ผลลัพธ์สุขภาพ</span>
        </div>

        <!-- BMI Hero Box -->
        <div class="result-box" style="margin-top: 0; margin-bottom: 1.25rem;">
            <div class="result-header">
                <span class="result-label">ค่าดัชนีมวลกาย (BMI)</span>
            </div>
            <div style="display: flex; align-items: baseline; gap: 0.75rem;">
                <span id="res-bmi-val" class="result-text" style="font-size: 2.25rem; font-weight: 700; color: var(--text-primary);">-</span>
                <span id="res-bmi-status" style="font-size: 1.1rem; font-weight: 600;">-</span>
            </div>

            <!-- Visual BMI Scale Bar -->
            <div style="margin-top: 1rem; position: relative;">
                <div style="height: 10px; border-radius: 5px; background: linear-gradient(to right, #3b82f6 0%, #10b981 25%, #f59e0b 55%, #f97316 75%, #ef4444 100%); width: 100%;"></div>
                <div id="res-bmi-bar-pointer" style="position: absolute; top: -4px; left: 50%; transform: translateX(-50%); width: 18px; height: 18px; border-radius: 50%; border: 3px solid #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.3); transition: left 0.3s ease;"></div>
                <div style="display: flex; justify-content: space-between; font-size: 0.7rem; color: var(--text-muted); margin-top: 0.5rem;">
                    <span>ผอม (&lt;18.5)</span>
                    <span>สมส่วน (18.5-22.9)</span>
                    <span>ท้วม (23-24.9)</span>
                    <span>อ้วน (≥25)</span>
                </div>
            </div>
        </div>

        <!-- Energy Stats -->
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-label">น้ำหนักตัวที่เหมาะสม (Ideal)</div>
                <div id="res-ideal-weight" class="stat-value" style="color: #10b981;">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">BMR (เผาผลาญพื้นฐาน)</div>
                <div id="res-bmr-val" class="stat-value">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">TDEE (เผาผลาญรวมต่อวัน)</div>
                <div id="res-tdee-val" class="stat-value" style="font-weight: 700; color: #3b82f6;">-</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">เกณฑ์มาตรฐาน</div>
                <div class="stat-value" style="font-size: 0.825rem;">กรมอนามัย สธ.</div>
            </div>
        </div>

        <!-- Calorie Goals Recommendation -->
        <div style="margin-top: 1.25rem; background: var(--bg-secondary); padding: 0.85rem; border-radius: 8px; border: 1px solid var(--border-color);">
            <div style="font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: var(--text-primary);">
                เป้าหมายแคลอรี่แนะนำต่อวัน:
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; text-align: center;">
                <div style="background: var(--bg-primary); padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border-color);">
                    <div style="font-size: 0.75rem; color: #10b981; font-weight: 600;">ลดน้ำหนัก (-500)</div>
                    <div id="res-cal-lose" style="font-size: 1rem; font-weight: 700; margin-top: 0.2rem;">-</div>
                </div>
                <div style="background: var(--bg-primary); padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border-color);">
                    <div style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 600;">รักษาน้ำหนัก</div>
                    <div id="res-cal-maintain" style="font-size: 1rem; font-weight: 700; margin-top: 0.2rem;">-</div>
                </div>
                <div style="background: var(--bg-primary); padding: 0.5rem; border-radius: 6px; border: 1px solid var(--border-color);">
                    <div style="font-size: 0.75rem; color: #3b82f6; font-weight: 600;">เพิ่มกล้าม (+500)</div>
                    <div id="res-cal-gain" style="font-size: 1rem; font-weight: 700; margin-top: 0.2rem;">-</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SEO & Knowledge Guide Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">เกณฑ์ดัชนีมวลกายคนไทยและเอเชีย (Asia-Pacific Criteria)</h2>
        <span class="tag-badge">กระทรวงสาธารณสุข</span>
    </div>

    <div style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.75;">
        <p style="margin-bottom: 1rem;">
            กรมอนามัย กระทรวงสาธารณสุข และองค์การอนามัยโลก (WHO) ได้กำหนดเกณฑ์ประเมินภาวะโภชนาการสำหรับประชากรแถบเอเชียไว้ดังนี้:
        </p>

        <div style="overflow-x: auto; margin-bottom: 1.25rem;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border-color); color: var(--text-primary);">
                        <th style="padding: 0.5rem;">ค่า BMI (kg/m²)</th>
                        <th style="padding: 0.5rem;">การแปลผล</th>
                        <th style="padding: 0.5rem;">ความเสี่ยงต่อโรค</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem; font-weight: 600; color: #3b82f6;">น้อยกว่า 18.5</td>
                        <td style="padding: 0.5rem;">ผอม / น้ำหนักน้อยกว่าเกณฑ์</td>
                        <td style="padding: 0.5rem;">เสี่ยงขาดสารอาหาร และภูมิคุ้มกันต่ำ</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem; font-weight: 600; color: #10b981;">18.5 - 22.9</td>
                        <td style="padding: 0.5rem;">ปกติ / สมส่วน (สุขภาพดี)</td>
                        <td style="padding: 0.5rem;">เท่ากับคนทั่วไป (ความเสี่ยงต่ำสุด)</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem; font-weight: 600; color: #f59e0b;">23.0 - 24.9</td>
                        <td style="padding: 0.5rem;">ท้วม / น้ำหนักเกิน (เริ่มเสี่ยง)</td>
                        <td style="padding: 0.5rem;">เริ่มมีความเสี่ยงต่อเบาหวานและไขมันในเลือด</td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem; font-weight: 600; color: #f97316;">25.0 - 29.9</td>
                        <td style="padding: 0.5rem;">อ้วนระดับ 1</td>
                        <td style="padding: 0.5rem;">เสี่ยงปานกลางต่อโรคหัวใจ หลอดเลือด และความดัน</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem; font-weight: 600; color: #ef4444;">30.0 ขึ้นไป</td>
                        <td style="padding: 0.5rem;">อ้วนระดับ 2 (อ้วนอันตราย)</td>
                        <td style="padding: 0.5rem;">เสี่ยงสูงมาก จำเป็นต้องได้รับการดูแลจากแพทย์</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/bmi-bmr.js') ?>"></script>
<?= $this->endSection() ?>
