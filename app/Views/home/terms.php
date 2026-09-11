<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="workspace-header">
    <div class="workspace-category">ข้อตกลงและนโยบาย</div>
    <h1 class="workspace-title">ข้อกำหนดและเงื่อนไขการใช้งาน (Terms of Use)</h1>
    <p class="workspace-subtitle">
        กรุณาอ่านข้อกำหนดและเงื่อนไขการใช้งานนี้โดยละเอียดก่อนเข้าใช้งานเว็บไซต์ thutil การเข้าใช้งานระบบถือว่าท่านได้ยอมรับและยินยอมที่จะปฏิบัติตามข้อกำหนดเหล่านี้ทุกประการ
    </p>
</div>

<div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 960px;">
    <!-- Section 1 -->
    <div class="tool-card">
        <div class="card-title-bar">
            <h2 class="card-title">1. บททั่วไปและการยอมรับข้อตกลง</h2>
            <span class="tag-badge">ข้อกำหนดพื้นฐาน</span>
        </div>
        <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 0.75rem;">
            เว็บไซต์ <strong>thutil</strong> พัฒนาขึ้นเพื่อให้บริการเครื่องมือสาธารณูปโภคออนไลน์ (Web Utilities) สำหรับการคำนวณ การตรวจสอบ การแปลงค่าข้อมูล และอำนวยความสะดวกในชีวิตประจำวันของคนไทย 
            การใช้งานบริการนี้ไม่มีค่าใช้จ่าย และผู้ใช้งานตกลงที่จะใช้บริการเพื่อวัตถุประสงค์ที่ชอบด้วยกฎหมายเท่านั้น
        </p>
    </div>

    <!-- Section 2: Disclaimer -->
    <div class="tool-card">
        <div class="card-title-bar">
            <h2 class="card-title">2. ข้อจำกัดความรับผิดชอบและการประเมินผล (Disclaimer)</h2>
            <span class="tag-badge" style="background: rgba(234, 179, 8, 0.15); color: #ca8a04; border-color: #fde047;">ข้อควรระวัง</span>
        </div>
        <ul style="color: var(--text-secondary); line-height: 1.75; padding-left: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem;">
            <li>
                <strong>ผลลัพธ์เพื่อการประมาณการเบื้องต้น:</strong> เครื่องมือคำนวณทั้งหมดบนเว็บไซต์ เช่น โปรแกรมคำนวณภาษีเงินได้บุคคลธรรมดา (ภ.ง.ด. 90/91), ค่างวดสินเชื่อรถยนต์, เงินกู้ซื้อบ้าน, อัตราดอกเบี้ยทบต้น, ค่าไฟฟ้า, ภาษีมูลค่าเพิ่ม (VAT 7%) และการแปลงพื้นที่ดิน GIS ถูกพัฒนาขึ้นโดยอ้างอิงตามสูตรมาตรฐาน ข้อกำหนดทั่วไป และอัตราภาษีหรืออัตราดอกเบี้ย ณ ขณะพัฒนา
            </li>
            <li>
                <strong>ไม่สามารถใช้เป็นเอกสารอ้างอิงทางกฎหมาย:</strong> ผลการคำนวณมีไว้เพื่อเป็นแนวทางวางแผนเบื้องต้นเท่านั้น ไม่ถือเป็นคำแนะนำทางการเงิน การลงทุน บัญชี หรือกฎหมายอย่างเป็นทางการ และไม่สามารถใช้เป็นหลักฐานยืนยันสิทธิทางกฎหมายกับหน่วยงานราชการหรือสถาบันการเงินได้
            </li>
            <li>
                <strong>การตรวจสอบกับหน่วยงานต้นสังกัด:</strong> ผู้ใช้งานควรตรวจสอบยอดเงิน ผลการคำนวณ และเงื่อนไขล่าสุดกับหน่วยงานที่เกี่ยวข้องโดยตรง เช่น กรมสรรพากร, ธนาคารพาณิชย์, การไฟฟ้านครหลวง/ส่วนภูมิภาค หรือสำนักงานที่ดิน ก่อนทำนิติกรรมหรือการยื่นแบบใด ๆ
            </li>
            <li>
                <strong>การปฏิเสธความรับผิด:</strong> thutil และผู้พัฒนาไม่รับผิดชอบต่อความเสียหาย ความคลาดเคลื่อน การสูญเสียทางการเงิน หรือผลกระทบใด ๆ ไม่ว่าทางตรงหรือทางอ้อมที่อาจเกิดขึ้นจากการนำผลลัพธ์หรือข้อมูลบนเว็บไซต์ไปใช้งาน
            </li>
        </ul>
    </div>

    <!-- Section 3: Privacy & Zero Storage -->
    <div class="tool-card">
        <div class="card-title-bar">
            <h2 class="card-title">3. นโยบายความเป็นส่วนตัวและความปลอดภัย (Zero Storage Privacy)</h2>
            <span class="tag-badge">ความปลอดภัย 100%</span>
        </div>
        <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 0.75rem;">
            thutil ยึดมั่นในความเป็นส่วนตัวสูงสุดของผู้ใช้งาน:
        </p>
        <ul style="color: var(--text-secondary); line-height: 1.75; padding-left: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem;">
            <li>
                <strong>ประมวลผลบนเบราว์เซอร์ของผู้ใช้ (Client-Side Only):</strong> ข้อมูลทั้งหมดที่ท่านกรอก เช่น เงินเดือน, รายได้, เบอร์โทรศัพท์, เลขบัตรประจำตัวประชาชน, รูปภาพ หรือข้อความส่วนบุคคล จะถูกประมวลผลด้วย JavaScript ภายในอุปกรณ์ของท่านเอง
            </li>
            <li>
                <strong>ไม่มีการบันทึกข้อมูลส่วนบุคคล:</strong> เซิร์ฟเวอร์ของ thutil ไม่มีการบันทึก ไม่มีการส่งต่อ และไม่มีฐานข้อมูลจัดเก็บข้อมูลส่วนตัวใด ๆ ของผู้ใช้งานทั้งสิ้น (Zero Storage Policy)
            </li>
            <li>
                <strong>การทำงานแบบออฟไลน์:</strong> เครื่องมือส่วนใหญ่สามารถทำงานได้โดยสมบูรณ์แม้ไม่มีการเชื่อมต่อเครือข่ายอินเทอร์เน็ตหลังจากโหลดหน้าเว็บเรียบร้อยแล้ว
            </li>
        </ul>
    </div>

    <!-- Section 4: Fair Use -->
    <div class="tool-card">
        <div class="card-title-bar">
            <h2 class="card-title">4. การใช้งานอย่างเหมาะสมและการแก้ไขปรับปรุง</h2>
            <span class="tag-badge">การบริการ</span>
        </div>
        <p style="color: var(--text-secondary); line-height: 1.7; margin-bottom: 0.75rem;">
            ผู้ใช้งานตกลงที่จะไม่กระทำการใด ๆ ที่เป็นการรบกวน เจาะระบบ หรือทำให้ระบบการทำงานของเว็บไซต์เสียหาย และ thutil ขอสงวนสิทธิ์ในการปรับปรุง เปลี่ยนแปลง หรือยุติการให้บริการเครื่องมือใด ๆ โดยมิต้องแจ้งให้ทราบล่วงหน้า
        </p>
        <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 1rem; border-top: 1px solid var(--border-color); padding-top: 0.75rem;">
            ข้อกำหนดและเงื่อนไขนี้มีผลบังคับใช้ตั้งแต่วันที่ 1 มกราคม 2568 เป็นต้นไป
        </p>
    </div>
</div>
<?= $this->endSection() ?>
