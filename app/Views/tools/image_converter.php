<?= $this->extend('layouts/main') ?>

<?= $this->section('json_ld') ?>
<!-- Schema.org Structured Data for Google & AI Search Crawlers -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebApplication",
            "name": "แปลงไฟล์รูปภาพ WebP JPG PNG บีบอัดลดขนาดภาพไม่เกิน 2MB ฟรี (Zero Storage)",
            "url": "<?= current_url() ?>",
            "description": "โปรแกรมแปลงไฟล์รูปภาพออนไลน์ฟรี แปลง WebP เป็น JPG, PNG เป็น JPG ลดขนาดภาพ ย่อขนาดรูปภาพสำหรับอัปโหลดส่งงานหรือสมัครงานราชการ ปลอดภัยแบบ 100% Client-side",
            "applicationCategory": "MultimediaApplication",
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
                    "name": "การแปลงไฟล์และบีบอัดรูปภาพที่นี่มีความปลอดภัยต่อข้อมูลส่วนตัวหรือไม่?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "ปลอดภัยสูงสุด 100% เนื่องจาก thutil ใช้เทคโนโลยี HTML5 Canvas ประมวลผลบนเครื่องและเบราว์เซอร์ของคุณโดยตรง (Zero Storage) รูปภาพ เอกสารสำคัญ หรือบัตรประชาชนของคุณจะไม่ถูกอัปโหลดส่งไปยังเซิร์ฟเวอร์ใดๆ ทั้งสิ้น ข้อมูลจึงไม่เสี่ยงต่อการรั่วไหล"
                    }
                },
                {
                    "@type": "Question",
                    "name": "ทำไมรูปภาพที่ถ่ายจาก iPhone ถึงแปลงเป็น JPG แล้วขนาดเล็กลงมาก?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "กล้องสมาร์ตโฟนยุคใหม่ถ่ายภาพความละเอียดสูงมาก (12 - 48 ล้านพิกเซล) ทำให้มีขนาดไฟล์ 5 - 10 MB ซึ่งเกินโควตาเว็บไซต์สมัครงานหรือระบบราชการไทยที่จำกัดไม่เกิน 500KB หรือ 2MB การปรับลดขนาด Resolution และคุณภาพบีบอัดให้อยู่ที่ 80% จะลดขนาดไฟล์ลงได้ถึง 70-90% โดยที่สายตามนุษย์แทบไม่เห็นความแตกต่าง"
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
        <span class="workspace-category">เครื่องมือรูปภาพ & จัดการไฟล์</span>
        <h1 class="workspace-title">แปลงไฟล์รูปภาพ & ย่อขนาดภาพ ลดขนาดไฟล์ฟรี (Zero Storage)</h1>
        <p class="workspace-subtitle">
            แปลงไฟล์ WebP เป็น JPG, PNG เป็น JPG บีบอัดลดขนาดภาพไม่เกิน 500KB หรือ 2MB สำหรับสมัครงานและส่งเอกสารราชการ ปลอดภัย 100% ทำงานบนเครื่องของคุณ
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <!-- Upload & Controls Panel -->
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">เลือกรูปภาพ & ปรับแต่งการแปลงไฟล์</h2>
            <span class="tag-badge">100% Client-Side</span>
        </div>

        <!-- Drag & Drop Zone -->
        <div id="img-drop-zone" style="border: 2px dashed var(--border-color); border-radius: 12px; padding: 2rem 1rem; text-align: center; cursor: pointer; background: var(--bg-primary); transition: border-color 0.2s ease; margin-bottom: 1.25rem;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--text-muted); margin-bottom: 0.5rem;">
                <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                <circle cx="9" cy="9" r="2"></circle>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
            </svg>
            <div style="font-weight: 600; color: var(--text-primary); margin-bottom: 0.25rem;">คลิกเพื่อเลือกไฟล์รูปภาพ หรือลากไฟล์มาวางที่นี่</div>
            <div style="font-size: 0.75rem; color: var(--text-muted);">รองรับ WebP, JPG, PNG, GIF (ไม่มีการอัปโหลดขึ้นเซิร์ฟเวอร์)</div>
            <input type="file" id="img-file-input" accept="image/*" style="display: none;">
        </div>

        <button type="button" onclick="document.getElementById('img-file-input').click()" class="btn-copy" style="width: 100%; margin-bottom: 1.25rem;">
            เลือกไฟล์จากอุปกรณ์
        </button>

        <!-- Format & Quality Options -->
        <div class="form-group">
            <label class="form-label" for="img-format-select">แปลงเป็นสกุลไฟล์</label>
            <select id="img-format-select" class="form-control" style="font-weight: 600;">
                <option value="image/jpeg" selected>JPEG / JPG (เหมาะกับรูปถ่ายทั่วไป &amp; ส่งเอกสารราชการ)</option>
                <option value="image/webp">WebP (ขนาดไฟล์เล็กที่สุด โหลดไวสำหรับเว็บไซต์)</option>
                <option value="image/png">PNG (คมชัดสูงสุด เหมาะกับโลโก้/กราฟิก)</option>
            </select>
        </div>

        <div class="form-group">
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.4rem;">
                <label class="form-label" for="img-quality-slider" style="margin-bottom: 0;">คุณภาพการบีบอัด (Quality)</label>
                <span id="img-quality-val" style="font-weight: 700; color: #10b981;">80%</span>
            </div>
            <input type="range" id="img-quality-slider" min="10" max="100" value="80" style="width: 100%; accent-color: #10b981;">
            <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: var(--text-muted); margin-top: 0.25rem;">
                <span>ไฟล์เล็กมาก (10%)</span>
                <span>แนะนำ (80%)</span>
                <span>ความชัดสูงสุด (100%)</span>
            </div>
        </div>

        <div class="form-row" style="margin-bottom: 1rem;">
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="img-width-input">ความกว้าง (Width px)</label>
                <input type="number" id="img-width-input" class="form-control" placeholder="เช่น 1920">
            </div>
            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                <label class="form-label" for="img-height-input">ความสูง (Height px)</label>
                <input type="number" id="img-height-input" class="form-control" placeholder="เช่น 1080">
            </div>
        </div>

        <div style="display: flex; align-items: center; gap: 0.4rem; margin-bottom: 1rem;">
            <input type="checkbox" id="img-lock-ratio" checked style="accent-color: #10b981;">
            <label for="img-lock-ratio" style="font-size: 0.85rem; cursor: pointer;">คงอัตราส่วนภาพเดิมไว้ (Lock Aspect Ratio)</label>
        </div>
    </div>

    <!-- Preview & Comparison Panel -->
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">เปรียบเทียบขนาดไฟล์ & ดาวน์โหลด</h2>
            <span class="tag-badge">ผลลัพธ์</span>
        </div>

        <div id="img-preview-container" style="display: none;">
            <!-- Comparison Box -->
            <div class="stats-grid" style="margin-bottom: 1.25rem;">
                <div class="stat-box">
                    <div class="stat-label">ขนาดไฟล์ต้นฉบับ</div>
                    <div id="img-orig-size" class="stat-value">-</div>
                </div>
                <div class="stat-box">
                    <div class="stat-label">ขนาดไฟล์หลังบีบอัด</div>
                    <div id="img-comp-size" class="stat-value" style="color: #10b981;">-</div>
                </div>
            </div>

            <div style="margin-bottom: 1rem; text-align: center;">
                <span id="img-saved-pct" class="tag-badge" style="font-size: 0.9rem; padding: 0.35rem 0.75rem; background: rgba(16, 185, 129, 0.15); color: #10b981;">
                    กำลังประมวลผล...
                </span>
            </div>

            <!-- Preview Canvas/Image -->
            <div style="text-align: center; background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.5rem; max-height: 250px; overflow: hidden; margin-bottom: 1.25rem;">
                <img id="img-preview" src="" alt="พรีวิวรูปภาพหลังบีบอัด" style="max-width: 100%; max-height: 230px; object-fit: contain; border-radius: 4px;">
            </div>

            <!-- Download Button -->
            <button type="button" id="img-btn-download" class="btn-primary" style="width: 100%; font-size: 1.05rem; padding: 0.75rem;" disabled>
                ดาวน์โหลดรูปภาพที่แปลงแล้ว
            </button>
        </div>

        <div id="img-empty-state" style="padding: 3rem 1rem; text-align: center; color: var(--text-muted); font-size: 0.9rem;">
            เลือกไฟล์รูปภาพทางด้านซ้ายเพื่อดูตัวอย่างและเปรียบเทียบขนาดไฟล์
        </div>
    </div>
</div>

<!-- SEO & Knowledge Guide Section -->
<div class="panel-card" style="margin-top: 1.75rem;">
    <div class="card-title-bar">
        <h2 class="card-title">ความรู้เรื่องการย่อขนาดไฟล์รูปภาพสำหรับระบบราชการและการใช้งานทั่วไป</h2>
        <span class="tag-badge">คู่มือการใช้งาน</span>
    </div>

    <div style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.75;">
        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.5rem;">
            ทำไมระบบราชการและระบบสมัครงานไทยถึงบังคับขนาดไฟล์ไม่เกิน 500KB หรือ 2MB?
        </h3>
        <p style="margin-bottom: 1rem;">
            เว็บไซต์หน่วยงานภาครัฐ เช่น ก.พ., มหาวิทยาลัย, กสพท, หรือระบบต่ออายุใบขับขี่ มักมีผู้ใช้งานพร้อมกันจำนวนหลายหมื่นคน การจำกัดขนาดไฟล์รูปภาพไม่ให้เกิน 500KB หรือ 2MB จะช่วยให้เซิร์ฟเวอร์ไม่ล่ม ประหยัดพื้นที่จัดเก็บ และป้องกันไม่ให้ผู้สมัครส่งไฟล์ภาพขนาดใหญ่เกินความจำเป็น
        </p>

        <h3 style="color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.5rem;">
            เลือกสกุลไฟล์ไหนดีระหว่าง JPG, PNG และ WebP?
        </h3>
        <ul style="padding-left: 1.25rem;">
            <li><strong>JPG / JPEG:</strong> เหมาะที่สุดสำหรับรูปถ่ายคน เอกสาร บัตรประชาชน และการอัปโหลดส่งระบบราชการไทย เพราะทุกระบบรองรับ 100%</li>
            <li><strong>WebP:</strong> ไฟล์ยุคใหม่ที่ Google พัฒนาขึ้น บีบอัดได้เล็กกว่า JPG ถึง 30% โดยที่ภาพยังคมชัด เหมาะสำหรับเว็บมาสเตอร์และนักพัฒนาเว็บ</li>
            <li><strong>PNG:</strong> เหมาะสำหรับภาพที่มีพื้นหลังโปร่งใส (Transparent) หรือภาพกราฟิก โลโก้ และไอคอน</li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/image-converter.js') ?>"></script>
<?= $this->endSection() ?>
