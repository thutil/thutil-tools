<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-title-group">
        <span class="workspace-category">รหัส & บาร์โค้ด</span>
        <h1 class="workspace-title">ตัวสร้าง QR Code ฟรี & พร้อมเพย์ (PromptPay QR)</h1>
        <p class="workspace-subtitle">
            สร้าง QR Code พร้อมเพย์ตามมาตรฐาน EMVCo ธนาคารแห่งประเทศไทย สแกนจ่ายผ่านแอปธนาคารไทยได้ 100% (K PLUS, SCB, Krungthai, BBL, TTb)
        </p>
    </div>
</div>

<div class="tool-grid-2">
    <div class="panel-card">
        <div class="card-title-bar">
            <h2 class="card-title">กำหนดข้อมูล QR Code</h2>
            <span class="tag-badge">สแกนจ่ายได้จริง</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="qr-type-select">ประเภท QR Code</label>
            <select id="qr-type-select" class="form-control">
                <option value="promptpay" selected>พร้อมเพย์ (PromptPay QR ระบุยอดเงินได้ - มาตรฐาน ธปท.)</option>
                <option value="url">URL / เว็บไซต์ หรือ ข้อความทั่วไป</option>
                <option value="wifi">รหัสไวไฟ (Wi-Fi Network)</option>
            </select>
        </div>

        <!-- Type: PromptPay -->
        <div id="qr-form-promptpay">
            <div class="form-group">
                <label class="form-label" for="qr-pp-target">เบอร์โทรศัพท์ (10 หลัก) หรือ เลขบัตรประชาชน (13 หลัก)</label>
                <input type="text" id="qr-pp-target" class="form-control" placeholder="เช่น 0812345678 หรือ 1100400000000" value="0812345678">
                <p class="form-hint">กรอกเบอร์โทร 10 หลัก หรือเลขบัตรประชาชน 13 หลักที่ผูกพร้อมเพย์ไว้</p>
            </div>
            <div class="form-group">
                <label class="form-label" for="qr-pp-amount">จำนวนเงิน (บาท) - ปล่อยว่างได้ถ้าไม่ต้องการระบุ</label>
                <input type="number" step="0.01" id="qr-pp-amount" class="form-control" placeholder="เช่น 100.00">
            </div>
        </div>

        <!-- Type: URL -->
        <div id="qr-form-url" style="display: none;">
            <div class="form-group">
                <label class="form-label" for="qr-input-url">ลิงก์ URL หรือ ข้อความ</label>
                <textarea id="qr-input-url" class="form-control" rows="3" placeholder="https://example.com">https://thutil.org</textarea>
            </div>
        </div>

        <!-- Type: WiFi -->
        <div id="qr-form-wifi" style="display: none;">
            <div class="form-group">
                <label class="form-label" for="qr-wifi-ssid">ชื่อ Wi-Fi (SSID)</label>
                <input type="text" id="qr-wifi-ssid" class="form-control" placeholder="ชื่อสัญญาณ Wi-Fi">
            </div>
            <div class="form-group">
                <label class="form-label" for="qr-wifi-pass">รหัสผ่าน (Password)</label>
                <input type="password" id="qr-wifi-pass" class="form-control" placeholder="รหัสผ่าน Wi-Fi">
            </div>
            <div class="form-group">
                <label class="form-label" for="qr-wifi-auth">ประเภทการเข้ารหัส</label>
                <select id="qr-wifi-auth" class="form-control">
                    <option value="WPA">WPA / WPA2 / WPA3</option>
                    <option value="WEP">WEP</option>
                    <option value="nopass">ไม่มีรหัสผ่าน (Open)</option>
                </select>
            </div>
        </div>

        <div class="result-box">
            <div class="result-header">
                <span class="result-label">EMVCo Payload (โค้ดมาตรฐาน)</span>
            </div>
            <div id="qr-payload-preview" style="font-family: 'JetBrains Mono', monospace; font-size: 0.725rem; word-break: break-all; color: var(--text-secondary); line-height: 1.45;">
                -
            </div>
        </div>
    </div>

    <div class="panel-card" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <div class="card-title-bar" style="width: 100%;">
            <h2 class="card-title">QR Code สำหรับสแกน</h2>
            <span class="tag-badge">ธปท. EMVCo</span>
        </div>

        <!-- Authentic PromptPay Card Header & Visual Container -->
        <div style="background: #ffffff; border-radius: var(--radius-md); padding: 1.25rem; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4); text-align: center; max-width: 320px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div id="promptpay-card-info" style="margin-bottom: 0.85rem; border-bottom: 2px solid #002d62; padding-bottom: 0.65rem;">
                <div style="color: #002d62; font-weight: 800; font-size: 1.15rem; letter-spacing: -0.02em;">
                    พร้อมเพย์ | PromptPay
                </div>
                <div id="pp-display-target" style="font-size: 0.875rem; font-weight: 600; color: #333333; margin-top: 0.25rem;">
                    081-234-5678
                </div>
                <div id="pp-display-amount" style="font-size: 0.825rem; font-weight: 700; color: #002d62; margin-top: 0.25rem;">
                    ไม่ระบุจำนวนเงิน
                </div>
            </div>

            <!-- Canvas Container -->
            <div id="qrcode-canvas-container" style="display: flex; justify-content: center; align-items: center; min-height: 256px;">
                <!-- QR Code renders here -->
            </div>

            <div style="margin-top: 0.65rem; font-size: 0.725rem; color: #666666;">
                สแกนจ่ายผ่าน Mobile Banking ได้ทุกธนาคาร
            </div>
        </div>

        <div style="margin-top: 1.5rem; width: 100%; display: flex; justify-content: center;">
            <button type="button" id="btn-download-qr-png" class="btn-primary" style="padding: 0.65rem 1.5rem; width: 100%; max-width: 320px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                <span>บันทึกรูปภาพ QR Code (PNG)</span>
            </button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/libs/qrcode.min.js') ?>"></script>
<script src="<?= base_url('assets/js/modules/qrcode-generator.js') ?>"></script>
<?= $this->endSection() ?>
