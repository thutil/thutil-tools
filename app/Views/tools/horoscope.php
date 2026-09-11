<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">ไลฟ์สไตล์ & ความเชื่อไทย</span>
        <h1 class="workspace-title">ดูดวง & ทำนายฝัน AI (Groq LLM)</h1>
        <p class="workspace-subtitle">
            ทำนายฝันแม่นยำตามตำราโบราณผสานจิตวิทยา ถอดรหัสเลขเด็ดนำโชค 2 ตัว 3 ตัว และดูดวงชะตาวันเกิดด้วย AI อัจฉริยะความเร็วสูง
        </p>
    </div>
</div>

<!-- Zero-Storage & Ephemeral Processing Privacy Guarantee Banner -->
<div class="privacy-guarantee-banner" style="background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: var(--radius-md); padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: 0.85rem;">
    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--green-primary); color: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
    </div>
    <div style="flex: 1;">
        <div style="font-weight: 700; color: #166534; font-size: 0.95rem; margin-bottom: 0.2rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
            <span>นโยบายประมวลผลชั่วคราว (Zero-Storage Guarantee)</span>
            <span class="tag-badge" style="background: #dcfce7; color: #15803d; border-color: #86efac; font-size: 0.72rem;">ไม่เก็บข้อมูล 100%</span>
        </div>
        <p style="font-size: 0.825rem; color: #15803d; line-height: 1.5; margin: 0;">
            เรื่องราวความฝัน วันเดือนปีเกิด และคำถามของคุณจะถูกส่งไปประมวลผลผ่าน AI แบบเรียลไทม์เพื่อสร้างคำทำนายเท่านั้น 
            <strong>ไม่มีการบันทึกลงในฐานข้อมูล เซิร์ฟเวอร์ หรือประวัติการใช้งานใดๆ ทั้งสิ้น</strong> ปลอดภัยและเคารพความเป็นส่วนตัวสูงสุด
        </p>
    </div>
</div>

<!-- Segmented Control Tabs -->
<div class="tab-bar" style="margin-bottom: 1.5rem;">
    <button type="button" class="tab-btn active" data-tab="tab-dream">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
        <span>ทำนายฝัน & เลขเด็ดมงคล</span>
    </button>
    <button type="button" class="tab-btn" data-tab="tab-horoscope">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
        </svg>
        <span>ดูดวงวันเกิด & ชะตาชีวิต</span>
    </button>
    <button type="button" class="tab-btn" data-tab="tab-settings">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"></circle>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
        </svg>
        <span>ตั้งค่า Groq AI</span>
    </button>
</div>

<!-- ==========================================================================
     TAB 1: DREAM INTERPRETATION (ทำนายฝัน & เลขเด็ด)
     ========================================================================== -->
<div id="tab-dream" class="tab-content">
    <div class="tool-grid-2">
        <!-- Input Form -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">เล่าเรื่องความฝันของคุณ</h2>
                <span class="tag-badge">AI วิเคราะห์ตำราไทย</span>
            </div>

            <!-- Preset Dream Buttons -->
            <div class="form-group">
                <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted);">ตัวอย่างความฝันยอดนิยม</label>
                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    <button type="button" class="btn-copy btn-preset-dream" data-dream="ฝันเห็นงูใหญ่รัดตัว สีดำมะเมื่อม รู้สึกตกใจกลัวแต่ไม่โดนกัด" data-day="คืนวันพุธ">ฝันเห็นงูรัด</button>
                    <button type="button" class="btn-copy btn-preset-dream" data-dream="ฝันเห็นพญานาคสีเขียวมรกตเกล็ดประกายทอง เล่นน้ำในแม่น้ำโขงอย่างสง่างาม" data-day="คืนวันศุกร์">ฝันเห็นพญานาค</button>
                    <button type="button" class="btn-copy btn-preset-dream" data-dream="ฝันว่าฟันบนหักหลุดออกมา เลือดไม่ออก ตื่นมารู้สึกกังวลใจ" data-day="คืนวันเสาร์">ฝันว่าฟันหัก</button>
                    <button type="button" class="btn-copy btn-preset-dream" data-dream="ฝันเห็นช้างเผือกตัวใหญ่เดินเข้ามาในบ้าน ชูงวงเปล่งเสียงดัง" data-day="คืนวันจันทร์">ฝันเห็นช้างเผือก</button>
                    <button type="button" class="btn-copy btn-preset-dream" data-dream="ฝันว่าได้จับปลาช่อนตัวใหญ่หลายตัวในสระน้ำ จับใส่ข้องได้เต็ม" data-day="คืนวันพฤหัสบดี">ฝันว่าจับปลาได้เยอะ</button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="dream-input">รายละเอียดความฝัน <span style="color: #dc2626;">*</span></label>
                <textarea id="dream-input" class="form-control" rows="5" placeholder="พิมพ์เล่าความฝัน เช่น ฝันเห็นอะไร เกิดอะไรขึ้น บรรยากาศเป็นอย่างไร และคุณรู้สึกอย่างไรในฝัน..."></textarea>
                <p class="form-hint">ยิ่งเล่ารายละเอียดชัดเจน AI ยิ่งสามารถถอดรหัสความหมายและตัวเลขได้แม่นยำขึ้น</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="dream-day">วันที่ฝัน (ตามตำราโบราณ)</label>
                <select id="dream-day" class="form-control">
                    <option value="ไม่ระบุ">ไม่ระบุวันที่ฝัน</option>
                    <option value="คืนวันอาทิตย์ (ผลตกแก่คนทั่วไป / มิตรสหาย)">คืนวันอาทิตย์ (ผลตกแก่มิตรสหาย)</option>
                    <option value="คืนวันจันทร์ (ผลตกแก่ญาติมิตร บุตรหลาน)">คืนวันจันทร์ (ผลตกแก่ญาติมิตร)</option>
                    <option value="คืนวันอังคาร (ผลตกแก่บิดามารดา ผู้ใหญ่)">คืนวันอังคาร (ผลตกแก่บิดามารดา)</option>
                    <option value="คืนวันพุธ (ผลตกแก่ภรรยา สามี หรือบุตร)">คืนวันพุธ (ผลตกแก่คู่ครอง/บุตร)</option>
                    <option value="คืนวันพฤหัสบดี (ผลตกแก่ครูบาอาจารย์ ผู้มีพระคุณ)">คืนวันพฤหัสบดี (ผลตกแก่ครูบาอาจารย์)</option>
                    <option value="คืนวันศุกร์ (ผลตกแก่สัตว์เลี้ยง ข้าวของ ทรัพย์สิน)">คืนวันศุกร์ (ผลตกแก่สัตว์เลี้ยง/ทรัพย์สิน)</option>
                    <option value="คืนวันเสาร์ (ผลตกแก่ตนเองโดยตรง)">คืนวันเสาร์ (ผลตกแก่ตนเองโดยตรง)</option>
                </select>
            </div>

            <button type="button" id="btn-submit-dream" class="btn-primary" style="width: 100%; font-size: 1rem; padding: 0.75rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
                <span>เริ่มทำนายฝัน & ถอดรหัสเลขเด็ด AI</span>
            </button>
        </div>

        <!-- Result Box -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h3 class="card-title">ผลการทำนายฝัน & เลขเด็ดมงคล</h3>
                <button type="button" id="btn-copy-dream-result" class="btn-copy" style="display: none;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    <span>คัดลอกผลทำนาย</span>
                </button>
            </div>

            <div id="dream-result-box" class="result-box" style="min-height: 280px;">
                <div class="empty-state" style="text-align: center; padding: 2.5rem 1rem; color: var(--text-muted);">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 0.75rem; opacity: 0.4;">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <div style="font-weight: 600; font-size: 1rem; margin-bottom: 0.35rem;">ยังไม่มีผลการทำนาย</div>
                    <p style="font-size: 0.85rem; max-width: 320px; margin: 0 auto;">
                        พิมพ์เรื่องราวความฝันทางด้านซ้าย แล้วกดปุ่มเพื่อเริ่มประมวลผลด้วย AI
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 2: HOROSCOPE & ASTROLOGY (ดูดวงวันเกิด & ชะตาชีวิต)
     ========================================================================== -->
<div id="tab-horoscope" class="tab-content" style="display: none;">
    <div class="tool-grid-2">
        <!-- Input Form -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h2 class="card-title">ข้อมูลดวงชะตา & สิ่งที่อยากปรึกษา</h2>
                <span class="tag-badge">โหราศาสตร์ไทย</span>
            </div>

            <div class="form-row">
                <div class="form-group" style="flex: 2;">
                    <label class="form-label" for="horo-birth-date">วันเดือนปีเกิด (ค.ศ.) <span style="color: #dc2626;">*</span></label>
                    <input type="date" id="horo-birth-date" class="form-control" value="1998-05-15">
                </div>
                <div class="form-group" style="flex: 1;">
                    <label class="form-label" for="horo-birth-time">เวลาเกิด (ตกฟาก)</label>
                    <input type="time" id="horo-birth-time" class="form-control" value="09:30">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="horo-topic">เรื่องที่ต้องการเน้นเป็นพิเศษ</label>
                <select id="horo-topic" class="form-control">
                    <option value="ภาพรวมดวงชะตาและวาสนาชีวิต" selected>ภาพรวมดวงชะตาและวาสนาชีวิต</option>
                    <option value="การงาน หน้าที่ และทิศทางอาชีพ">การงาน หน้าที่ และทิศทางอาชีพ</option>
                    <option value="การเงิน โชคลาภ และหนี้สิน">การเงิน โชคลาภ และหนี้สิน</option>
                    <option value="ความรัก คู่ครอง และความสัมพันธ์">ความรัก คู่ครอง และความสัมพันธ์</option>
                    <option value="สุขภาพ อารมณ์ และอุบัติเหตุ">สุขภาพ อารมณ์ และอุบัติเหตุ</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="horo-question">คำถามเฉพาะเจาะจง (ถ้ามี)</label>
                <textarea id="horo-question" class="form-control" rows="3" placeholder="เช่น ช่วงนี้กำลังจะเปลี่ยนงานดีไหม? มีเกณฑ์เดินทางไกลไหม? หรือควรลงทุนธุรกิจช่วงนี้อย่างไร?"></textarea>
                <p class="form-hint">ระบุคำถามให้ชัดเจนเพื่อให้คำพยากรณ์ตรงจุดที่สุด</p>
            </div>

            <button type="button" id="btn-submit-horo" class="btn-primary" style="width: 100%; font-size: 1rem; padding: 0.75rem;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <span>ดูดวงชะตา & วิเคราะห์ดวงดาวด้วย AI</span>
            </button>
        </div>

        <!-- Result Box -->
        <div class="panel-card">
            <div class="card-title-bar">
                <h3 class="card-title">ผลพยากรณ์ดวงชะตา & สิ่งมงคล</h3>
                <button type="button" id="btn-copy-horo-result" class="btn-copy" style="display: none;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    <span>คัดลอกผลทำนาย</span>
                </button>
            </div>

            <div id="horo-result-box" class="result-box" style="min-height: 280px;">
                <div class="empty-state" style="text-align: center; padding: 2.5rem 1rem; color: var(--text-muted);">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 0.75rem; opacity: 0.4;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 2a10 10 0 0 1 10 10"></path>
                    </svg>
                    <div style="font-weight: 600; font-size: 1rem; margin-bottom: 0.35rem;">ยังไม่มีผลการดูดวง</div>
                    <p style="font-size: 0.85rem; max-width: 320px; margin: 0 auto;">
                        เลือกวันเดือนปีเกิดและหัวข้อที่ต้องการปรึกษาทางด้านซ้าย แล้วกดปุ่มเพื่อเริ่มดูดวง
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     TAB 3: GROQ AI SETTINGS (การตั้งค่า Groq API Key)
     ========================================================================== -->
<div id="tab-settings" class="tab-content" style="display: none;">
    <div class="panel-card" style="max-width: 680px; margin: 0 auto;">
        <div class="card-title-bar">
            <h2 class="card-title">ตั้งค่า Groq API Key ส่วนตัว</h2>
            <span id="key-status-badge" class="tag-badge" style="background: var(--green-tint); color: var(--green-primary); border-color: var(--green-tint-border);">
                สถานะ: พร้อมใช้งาน
            </span>
        </div>

        <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
            ระบบนี้ขับเคลื่อนด้วยโมเดล <strong>Llama 3.3 70B Versatile</strong> บนโครงสร้างพื้นฐานของ Groq Cloud ที่ขึ้นชื่อเรื่องความเร็วระดับเสี้ยววินาที 
            คุณสามารถใช้ API Key ของเซิร์ฟเวอร์ หรือกรอก API Key ส่วนตัวของคุณเองเพื่อใช้งานได้ไม่จำกัด
        </p>

        <div class="form-group">
            <label class="form-label" for="custom-groq-key">Groq API Key ส่วนตัว (ขึ้นต้นด้วย gsk_...)</label>
            <input type="password" id="custom-groq-key" class="form-control" placeholder="gsk_xxxxxxxxxxxxxxxxxxxxxxxxxxxx">
            <p class="form-hint">
                สามารถรับ API Key ฟรีได้จาก <a href="https://console.groq.com/keys" target="_blank" rel="noopener noreferrer" style="color: var(--green-primary); font-weight: 600; text-decoration: underline;">Groq Console (คลิกที่นี่)</a> สมัครและสร้างคีย์ได้ฟรี
            </p>
        </div>

        <div style="background: var(--bg-subtle); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 0.85rem 1rem; margin-bottom: 1.25rem; font-size: 0.825rem; color: var(--text-secondary); line-height: 1.5;">
            <strong>การจัดเก็บคีย์:</strong> Groq API Key ที่คุณระบุจะถูกบันทึกลงในหน่วยความจำเครื่องของคุณ (Browser LocalStorage) เท่านั้น ไม่มีการส่งไปจัดเก็บหรือบันทึกลงฐานข้อมูลใดๆ ของเว็บไซต์ thutil
        </div>

        <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
            <button type="button" id="btn-save-key" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                <span>บันทึกคีย์ลงเบราว์เซอร์</span>
            </button>
            <button type="button" id="btn-clear-key" class="btn-outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                <span>ล้างคีย์ที่บันทึกไว้</span>
            </button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/modules/horoscope.js?v=' . (file_exists(FCPATH . 'assets/js/modules/horoscope.js') ? filemtime(FCPATH . 'assets/js/modules/horoscope.js') : '1.0')) ?>"></script>
<?= $this->endSection() ?>
