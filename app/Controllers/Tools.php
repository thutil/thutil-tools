<?php

namespace App\Controllers;

class Tools extends BaseController
{
    /**
     * Car Loan Installment Calculator (คำนวณค่างวดรถ)
     */
    public function carLoan(): string
    {
        return view('tools/car_loan', [
            'title' => 'คำนวณค่างวดรถ ตารางผ่อนรถยนต์ มอเตอร์ไซค์ ดอกเบี้ยแท้จริง (Flat Rate & VAT 7%) - thutil',
            'metaDesc' => 'โปรแกรมคำนวณค่างวดรถยนต์และมอเตอร์ไซค์ฟรี คำนวณเงินดาวน์ ยอดจัดไฟแนนซ์ ดอกเบี้ยคงที่ (Flat Rate) ภาษีมูลค่าเพิ่ม 7% และค่างวดต่อเดือนอย่างแม่นยำ',
            'keywords' => 'คำนวณค่างวดรถ, ตารางผ่อนรถ, ผ่อนรถเดือนละเท่าไหร่, ดอกเบี้ยรถยนต์, ค่างวดรถ vat 7%, ไฟแนนซ์รถยนต์',
            'toolName' => 'คำนวณค่างวดรถยนต์ & มอเตอร์ไซค์',
            'activeNav' => 'car-loan'
        ]);
    }

    /**
     * Mortgage Loan & Prepayment Calculator (คำนวณผ่อนบ้าน & โปะบ้าน)
     */
    public function homeLoan(): string
    {
        return view('tools/home_loan', [
            'title' => 'คำนวณผ่อนบ้าน โปะบ้านลดต้นลดดอก ประหยัดดอกเบี้ยและระยะเวลากี่ปี - thutil',
            'metaDesc' => 'เครื่องมือคำนวณสินเชื่อบ้านและเงินโปะบ้านแบบลดต้นลดดอก (Effective Rate) คำนวณว่าการโปะบ้านช่วยประหยัดดอกเบี้ยได้กี่บาท และผ่อนบ้านหมดเร็วขึ้นกี่ปี',
            'keywords' => 'คำนวณผ่อนบ้าน, คำนวณสินเชื่อบ้าน, โปะบ้านลดต้นลดดอก, รีไฟแนนซ์บ้าน, ตารางผ่อนบ้าน, ดอกเบี้ยบ้าน',
            'toolName' => 'คำนวณสินเชื่อบ้าน & เงินโปะบ้าน',
            'activeNav' => 'home-loan'
        ]);
    }

    /**
     * Thai Lucky Phone Number Sum (ทำนายผลรวมเบอร์มงคล)
     */
    public function luckyPhone(): string
    {
        return view('tools/lucky_phone', [
            'title' => 'ทำนายผลรวมเบอร์มงคล ตรวจสอบคู่เลขและความหมายเบอร์โทรศัพท์ - thutil',
            'metaDesc' => 'ตรวจผลรวมเบอร์มงคล 10 หลักฟรี วิเคราะห์ความหมายคู่เลข ผลรวมมงคล เสริมดวงการเงิน การงาน ความรัก และโชคลาภตามศาสตร์ตัวเลขไทย',
            'keywords' => 'ผลรวมเบอร์มงคล, ตรวจเบอร์โทรศัพท์, ทำนายเบอร์มือถือ, ดูดวงเบอร์โทร, คู่เลขมงคล, ความหมายผลรวมเบอร์',
            'toolName' => 'ทำนายผลรวมเบอร์มงคล & คู่เลข',
            'activeNav' => 'lucky-phone'
        ]);
    }

    /**
     * Thai-English Keyboard Typo Fixer (แก้พิมพ์ผิดภาษา ลืมเปลี่ยนภาษา)
     */
    public function keyboardFix(): string
    {
        return view('tools/keyboard_fix', [
            'title' => 'แก้ปัญหาลืมเปลี่ยนภาษา แปลงพิมพ์ผิดภาษา ไทย <-> อังกฤษ (Kedmanee) - thutil',
            'toolName' => 'แก้ลืมเปลี่ยนภาษา (ไทย <-> EN)',
            'metaDesc' => 'เครื่องมือแก้ปัญหาลืมเปลี่ยนภาษาบนคีย์บอร์ด แปลงข้อความพิมพ์ผิดแป้นพิมพ์เกษมณีเป็นภาษาไทยหรืออังกฤษทันที เช่น g-hk เป็น สวัสดี หรือ 9y;o เป็น hello',
            'keywords' => 'ลืมเปลี่ยนภาษา, แก้พิมพ์ผิดภาษา, แปลง th เป็น en, แปลง en เป็น th, แก้ภาษาไทยเป็นอังกฤษ, kedmanee layout',
            'activeNav' => 'keyboard-fix'
        ]);
    }

    /**
     * Thai Word & Character Counter (นับจำนวนคำและตัวอักษรภาษาไทย)
     */
    public function wordCounter(): string
    {
        return view('tools/word_counter', [
            'title' => 'นับจำนวนคำภาษาไทย นับตัวอักษร ไม่รวมสระวรรณยุกต์ สำหรับนักเขียนและ SEO - thutil',
            'toolName' => 'นับจำนวนคำ & ตัวอักษรไทย',
            'metaDesc' => 'เครื่องมือนับจำนวนคำภาษาไทย นับตัวอักษร นับพยางค์ นับวรรค และวิเคราะห์สระ-วรรณยุกต์ไทย สำหรับนักเขียน บทความ SEO โพสต์ Facebook และเอกสารรายงาน',
            'keywords' => 'นับคำภาษาไทย, นับจำนวนคำ, นับตัวอักษรไทย, นับสระวรรณยุกต์, word counter thai, ตัวนับคำออนไลน์',
            'activeNav' => 'word-counter'
        ]);
    }

    public function age(): string
    {
        return view('tools/age', [
            'title' => 'คำนวณอายุ & เปรียบเทียบวันเวลา (พ.ศ. / ค.ศ.) - thutil',
            'metaDesc' => 'คำนวณอายุจากปีเกิด พ.ศ. หรือ ค.ศ. บอกจำนวนปี เดือน วัน ชั่วโมง วันเกิดครั้งถัดไป และเปรียบเทียบระยะห่างระหว่าง 2 วันเดือนปี',
            'toolName' => 'คำนวณอายุ & เปรียบเทียบวันเวลา',
            'activeNav' => 'age'
        ]);
    }

    public function era(): string
    {
        return view('tools/era', [
            'title' => 'แปลงศักราชไทย พ.ศ. <-> ค.ศ. <-> ร.ศ. <-> จ.ศ. - thutil',
            'metaDesc' => 'แปลงปีศักราชไทย พุทธศักราช คริสต์ศักราช รัตนโกสินทรศก จุลศักราช มหาศักราช และตรวจสอบปีอธิกสุรทิน (Leap Year)',
            'toolName' => 'แปลงศักราชไทย (พ.ศ. / ค.ศ. / ร.ศ. / จ.ศ.)',
            'activeNav' => 'era'
        ]);
    }

    public function holidays(): string
    {
        return view('tools/holidays', [
            'title' => 'ปฏิทินวันหยุดราชการไทย & คำนวณวันทำการ - thutil',
            'metaDesc' => 'ปฏิทินวันหยุดนักขัตฤกษ์ไทยประจำปี และคำนวณจำนวนวันทำการราชการระหว่างสองช่วงเวลา ตัดวันเสาร์-อาทิตย์และวันหยุดอัตโนมัติ',
            'toolName' => 'วันหยุดราชการ & วันทำการ',
            'activeNav' => 'holidays'
        ]);
    }

    public function gis(): string
    {
        return view('tools/gis', [
            'title' => 'เครื่องมือภูมิสารสนเทศ GIS & แปลงหน่วยที่ดินไทย (ไร่-งาน-วา) - thutil',
            'metaDesc' => 'แปลงพิกัด WGS84 Lat/Lon เป็น UTM Zone 47N/48N และ Indian 1975 พร้อมแปลงหน่วยที่ดินไทย ไร่-งาน-ตารางวา เป็น ตารางเมตร และเฮกตาร์',
            'toolName' => 'เครื่องมือภูมิสารสนเทศ GIS',
            'activeNav' => 'gis'
        ]);
    }

    public function postcode(): string
    {
        return view('tools/postcode', [
            'title' => 'ค้นหารหัสไปรษณีย์ไทย 77 จังหวัด & ตำบล/อำเภอ - thutil',
            'metaDesc' => 'ค้นหารหัสไปรษณีย์ 5 หลัก ตำบล/แขวง อำเภอ/เขต และจังหวัดทั่วประเทศไทย รวดเร็ว พร้อมปุ่มคัดลอกทันใจ',
            'toolName' => 'ค้นหารหัสไปรษณีย์ไทย',
            'activeNav' => 'postcode'
        ]);
    }

    public function bahttext(): string
    {
        return view('tools/bahttext', [
            'title' => 'แปลงตัวเลขเป็นตัวอ่านภาษาไทย (บาทถ้วน) - thutil',
            'metaDesc' => 'แปลงตัวเลขอารบิกเป็นคำอ่านภาษาไทยทางการและจำนวนเงินบาทถ้วนตามหลักการเงินและบัญชี รองรับทศนิยมสตางค์',
            'toolName' => 'แปลงเลขเป็นตัวอ่านไทย (บาทถ้วน)',
            'activeNav' => 'bahttext'
        ]);
    }

    public function vatTax(): string
    {
        return view('tools/vat_tax', [
            'title' => 'คำนวณภาษีมูลค่าเพิ่ม (VAT 7%) และหัก ณ ที่จ่าย - thutil',
            'metaDesc' => 'คำนวณถอด VAT 7% รวมในตัว vs ไม่รวม VAT พร้อมหักภาษี ณ ที่จ่าย 1%, 2%, 3%, 5% สรุปยอดจ่ายจริงและภาษีนำส่ง',
            'toolName' => 'คำนวณ VAT 7% และหัก ณ ที่จ่าย',
            'activeNav' => 'vat-tax'
        ]);
    }

    public function salary(): string
    {
        return view('tools/salary', [
            'title' => 'คำนวณเงินเดือนสุทธิ & หักประกันสังคม ภาษีบุคคลธรรมดา - thutil',
            'metaDesc' => 'คำนวณเงินเดือนสุทธิที่ได้รับจริง (Take-Home Pay) หักเงินสมทบประกันสังคม 5% (สูงสุด 750 บาท) กองทุนสำรองเลี้ยงชีพ และภาษีบุคคลธรรมดา',
            'toolName' => 'คำนวณเงินเดือน & ประกันสังคม',
            'activeNav' => 'salary'
        ]);
    }

    public function thaiId(): string
    {
        return view('tools/thai_id', [
            'title' => 'ตรวจสอบและจัดรูปแบบเลขบัตรประชาชน 13 หลัก - thutil',
            'metaDesc' => 'ตรวจสอบความถูกต้องของเลขประจำตัวประชาชนไทยด้วยอัลกอริทึม Modulo 11 จัดรูปแบบขีดคั่นอัตโนมัติ และสุ่มเลขสำหรับทดสอบระบบ',
            'toolName' => 'ตรวจสอบเลขบัตรประชาชน 13 หลัก',
            'activeNav' => 'thai-id'
        ]);
    }

    public function qrcode(): string
    {
        return view('tools/qrcode', [
            'title' => 'สร้าง QR Code ฟรี & พร้อมเพย์ (PromptPay QR สแกนได้ 100%) - thutil',
            'metaDesc' => 'สร้าง QR Code พร้อมเพย์ตามมาตรฐาน EMVCo ธนาคารแห่งประเทศไทย สแกนจ่ายผ่าน Mobile Banking ได้ทุกธนาคาร 100% ฟรี ปลอดภัยแบบ Zero Storage',
            'toolName' => 'ตัวสร้าง QR Code & พร้อมเพย์',
            'activeNav' => 'qrcode'
        ]);
    }

    public function barcode(): string
    {
        return view('tools/barcode', [
            'title' => 'สร้างบาร์โค้ดสินค้าไทย EAN-13 (885) ฟรี - thutil',
            'metaDesc' => 'สร้างบาร์โค้ดมาตรฐานสากล EAN-13 รหัสประเทศไทย (885) พร้อมคำนวณ Check Digit อัตโนมัติ ส่งออกเป็น SVG/PNG คมชัด',
            'toolName' => 'สร้างบาร์โค้ดสินค้าไทย EAN-13',
            'activeNav' => 'barcode'
        ]);
    }

    public function mockThai(): string
    {
        return view('tools/mock_thai', [
            'title' => 'สุ่มข้อมูลจำลองคนไทย (Mock Thai Data) สำหรับนักพัฒนา - thutil',
            'metaDesc' => 'สุ่มสร้างชื่อ-นามสกุลไทย เลขบัตรประชาชนที่ถูกต้อง เบอร์มือถือ และที่อยู่ไทยจำลอง สำหรับทดสอบระบบ (Dev / QA / Mock Database)',
            'toolName' => 'สุ่มข้อมูลจำลองคนไทย (Mock Data)',
            'activeNav' => 'mock-thai'
        ]);
    }

    /**
     * Personal Income Tax Calculator (คำนวณภาษีเงินได้บุคคลธรรมดา 2567-2568)
     */
    public function tax(): string
    {
        return view('tools/tax', [
            'title' => 'คำนวณภาษีเงินได้บุคคลธรรมดา 2567 - 2568 ภ.ง.ด. 90/91 วางแผนลดหย่อนภาษี - thutil',
            'metaDesc' => 'โปรแกรมคำนวณภาษีเงินได้บุคคลธรรมดา 2567-2568 ฟรี คำนวณเงินได้สุทธิ อัตราภาษีก้าวหน้า 0-35% สิทธิ์ลดหย่อนส่วนตัว ประกันสังคม กองทุน ThaiESG ดอกเบี้ยบ้าน สรุปเงินคืนภาษีทันที',
            'keywords' => 'คำนวณภาษี 2567, คำนวณภาษี 2568, ภาษีเงินได้บุคคลธรรมดา, ภงด 91, ภงด 90, ลดหย่อนภาษี, คืนภาษี, ฐานภาษี, thaiesg ลดหย่อน',
            'toolName' => 'คำนวณภาษีบุคคลธรรมดา & หักลดหย่อน',
            'activeNav' => 'tax'
        ]);
    }

    /**
     * Electricity Bill & Appliance Power Calculator (คำนวณค่าไฟบ้าน & แอร์ เครื่องใช้ไฟฟ้า)
     */
    public function electricity(): string
    {
        return view('tools/electricity', [
            'title' => 'คำนวณค่าไฟฟ้าบ้าน MEA / PEA คำนวณเปิดแอร์กินไฟกี่บาท พร้อมค่า Ft ล่าสุด - thutil',
            'metaDesc' => 'โปรแกรมคำนวณค่าไฟฟ้าตามบิลการไฟฟ้านครหลวงและภูมิภาค อัตราก้าวหน้า ค่า Ft ล่าสุด พร้อมคำนวณเปิดแอร์ 9000-24000 BTU ตู้เย็น พัดลม ชาร์จรถ EV กินไฟกี่บาทต่อวัน/ต่อเดือน',
            'keywords' => 'คำนวณค่าไฟ, ค่าไฟกี่บาท, เปิดแอร์กินไฟกี่บาท, ค่า ft ล่าสุด, คำนวณค่าไฟการไฟฟ้า, คำนวณหน่วยไฟฟ้า kwh, ค่าไฟแอร์ inverter',
            'toolName' => 'คำนวณค่าไฟบ้าน & กินไฟแอร์',
            'activeNav' => 'electricity'
        ]);
    }

    /**
     * BMI & BMR / TDEE Health Calculator (คำนวณดัชนีมวลกายและอัตราเผาผลาญคนไทย)
     */
    public function bmiBmr(): string
    {
        return view('tools/bmi_bmr', [
            'title' => 'คำนวณ BMI & BMR TDEE เกณฑ์มาตรฐานคนไทย กรมอนามัย วางแผนลดน้ำหนัก - thutil',
            'metaDesc' => 'เครื่องมือคำนวณค่าดัชนีมวลกาย (BMI) สำหรับคนไทยและเอเชีย คำนวณอัตราการเผาผลาญพื้นฐาน (BMR) และการใช้พลังงานต่อวัน (TDEE) พร้อมปริมาณแคลอรี่แนะนำในการลดน้ำหนัก',
            'keywords' => 'คำนวณ bmi, คำนวณ bmr, คำนวณ tdee, เกณฑ์ bmi คนไทย, ดัชนีมวลกาย, ตาราง bmi, ลดน้ำหนัก นับแคล, กรมอนามัย bmi',
            'toolName' => 'คำนวณ BMI & BMR TDEE มาตรฐานคนไทย',
            'activeNav' => 'bmi-bmr'
        ]);
    }

    /**
     * Compound Interest & DCA Wealth Calculator (คำนวณดอกเบี้ยทบต้น & ออมเงินเกษียณ)
     */
    public function compoundInterest(): string
    {
        return view('tools/compound_interest', [
            'title' => 'คำนวณดอกเบี้ยทบต้น ออมเงินรายเดือน DCA วางแผนเกษียณและผลตอบแทน - thutil',
            'metaDesc' => 'โปรแกรมคำนวณดอกเบี้ยทบต้น (Compound Interest) ออมเงิน DCA รายเดือน เห็นพลังของดอกเบี้ยทบต้น กราฟิกแสดงการเติบโตของเงินต้นและผลตอบแทนสะสม วางแผนสู่อิสรภาพการเงิน',
            'keywords' => 'คำนวณดอกเบี้ยทบต้น, ดอกเบี้ยทบต้น, ออมเงิน dca, วางแผนเกษียณ, ดอกเบี้ยเงินฝาก, กองทุนรวมผลตอบแทน, คำนวณเงินออม',
            'toolName' => 'คำนวณดอกเบี้ยทบต้น & ออมเงิน DCA',
            'activeNav' => 'compound-interest'
        ]);
    }

    /**
     * Random Number & Name Picker (สุ่มตัวเลข สุ่มรายชื่อ จับฉลากออนไลน์)
     */
    public function random(): string
    {
        return view('tools/random', [
            'title' => 'สุ่มตัวเลข สุ่มรายชื่อผู้โชคดี จับฉลากออนไลน์ แบ่งกลุ่มกิจกรรมฟรี - thutil',
            'metaDesc' => 'โปรแกรมสุ่มตัวเลข สุ่มเลข 2 ตัว 3 ตัว สุ่มรายชื่อผู้โชคดี จับฉลากของขวัญปีใหม่ แบ่งกลุ่มอัตโนมัติ ใช้งานง่าย แอนิเมชันเปิดผลรางวัลสุ่มทันใจ ฟรี 100%',
            'keywords' => 'สุ่มตัวเลข, สุ่มรายชื่อ, จับฉลากออนไลน์, สุ่มเลขท้าย, สุ่มชื่อผู้โชคดี, วงล้อสุ่ม, แบ่งกลุ่มสุ่ม, random number thai',
            'toolName' => 'สุ่มตัวเลข & สุ่มรายชื่อ จับฉลาก',
            'activeNav' => 'random'
        ]);
    }

    /**
     * Client-Side Image Converter & Compressor (แปลงไฟล์รูปภาพและลดขนาดรูป)
     */
    public function imageConverter(): string
    {
        return view('tools/image_converter', [
            'title' => 'แปลงไฟล์รูปภาพ WebP JPG PNG ย่อขนาด บีบอัดรูปไม่เกิน 2MB ฟรี (Zero Storage) - thutil',
            'metaDesc' => 'แปลงไฟล์รูปภาพ WebP เป็น JPG, PNG เป็น JPG หรือ WebP บีบอัดลดขนาดภาพ ปรับขนาดกว้างยาว ทำงานบนเครื่อง 100% ปลอดภัย ไม่ส่งไฟล์ขึ้นเซิร์ฟเวอร์ เหมาะกับส่งเอกสารราชการ',
            'keywords' => 'แปลง webp เป็น jpg, แปลงรูปภาพ, ลดขนาดรูปภาพ, บีบอัดรูป, ย่อขนาดรูปภาพ, แปลงไฟล์รูปภาพฟรี, image compressor thai, รูปไม่เกิน 2mb',
            'toolName' => 'แปลงไฟล์รูป & ย่อขนาดภาพ (Zero Storage)',
            'activeNav' => 'image-converter'
        ]);
    }
}
