/**
 * Age Calculator & Date Difference Tool
 * Supports Thai Buddhist Era (B.E. พ.ศ.), Life Stages, Education Levels & Thai Legal Milestones
 */

const THAI_ZODIAC = [
    'กุน (หมู)', 'ชวด (หนู)', 'ฉลู (วัว)', 'ขาล (เสือ)',
    'เถาะ (กระต่าย)', 'มะโรง (งูใหญ่)', 'มะเส็ง (งูเล็ก)',
    'มะเมีย (ม้า)', 'มะแม (แพะ)', 'วอก (ลิง)', 'ระกา (ไก่)', 'จอ (หมา)'
];

const THAI_MONTHS = [
    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
    'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
];

const THAI_DAYS = ['วันอาทิตย์', 'วันจันทร์', 'วันอังคาร', 'วันพุธ', 'วันพฤหัสบดี', 'วันศุกร์', 'วันเสาร์'];

function beToCe(beYear) {
    return beYear - 543;
}

function ceToBe(ceYear) {
    return ceYear + 543;
}

function getThaiZodiac(ceYear) {
    const index = (ceYear - 3) % 12;
    return THAI_ZODIAC[index < 0 ? index + 12 : index];
}

// 1. Thai Life Stages (ช่วงวัย)
function getThaiLifeStage(years, months) {
    if (years < 1) return { stage: 'วัยทารกแรกเกิด', desc: 'ช่วงวัยเริ่มต้นของชีวิต ต้องการการดูแลด้านโภชนาการและพัฒนาการอย่างใกล้ชิด' };
    if (years < 3) return { stage: 'วัยเตาะแตะ (ปฐมวัยตอนต้น)', desc: 'ช่วงวัยแห่งการเริ่มสำรวจโลก เริ่มเดิน พูด และมีปฏิสัมพันธ์กับสิ่งแวดล้อม' };
    if (years < 6) return { stage: 'วัยเด็กเล็ก (ปฐมวัย)', desc: 'วัยเตรียมความพร้อมสู่วัยเรียน เสริมสร้างจินตนาการและทักษะทางสังคม' };
    if (years < 12) return { stage: 'วัยเด็กประถม (เด็กตอนปลาย)', desc: 'วัยแห่งการเรียนรู้พื้นฐานทางวิชาการและทักษะการใช้ชีวิตร่วมกับผู้อื่น' };
    if (years < 18) return { stage: 'วัยรุ่น (มัธยมศึกษา)', desc: 'ช่วงวัยแห่งการค้นหาตัวตน การเปลี่ยนแปลงทางร่างกาย และวางแผนเส้นทางอนาคต' };
    if (years < 23) return { stage: 'วัยผู้ใหญ่ตอนต้น (อุดมศึกษา / จบใหม่)', desc: 'วัยเรียนระดับมหาวิทยาลัย ก้าวข้ามสู่การเป็นผู้ใหญ่ และเตรียมพร้อมเข้าสู่โลกการทำงาน' };
    if (years < 35) return { stage: 'วัยทำงาน (Young Professional)', desc: 'วัยสร้างความมั่นคงในอาชีพ การวางแผนการเงิน และการสร้างครอบครัว' };
    if (years < 45) return { stage: 'วัยผู้ใหญ่ตอนกลาง (Mid-Career)', desc: 'วัยแห่งความมั่นคงในหน้าที่การงาน ความรับผิดชอบสูง และการบริหารจัดการชีวิตรอบด้าน' };
    if (years < 60) return { stage: 'วัยเตรียมเกษียณ (Pre-Retirement)', desc: 'ช่วงวัยสั่งสมประสบการณ์ ความเชี่ยวชาญ และวางแผนการเงินหลังเกษียณ' };
    return { stage: 'วัยเกษียณ / ผู้สูงวัย (Golden Age)', desc: 'วัยแห่งการพักผ่อน ใช้ชีวิตอย่างมีคุณภาพ และดูแลสุขภาพกายใจ' };
}

// 2. Thai Education Grades (ระดับชั้นการศึกษาตามเกณฑ์ไทย)
function getThaiEducationGrade(years, months) {
    if (years < 2) return 'ยังไม่ถึงเกณฑ์เข้าเรียน (ศูนย์พัฒนาเด็กเล็กก่อนวัยเรียน)';
    if (years === 2) return 'เตรียมอนุบาล / เนิร์สเซอรี่ (Nursery)';
    if (years === 3) return 'ชั้นอนุบาล 1 (อ.1 / KG 1)';
    if (years === 4) return 'ชั้นอนุบาล 2 (อ.2 / KG 2)';
    if (years === 5) return 'ชั้นอนุบาล 3 (อ.3 / KG 3)';
    if (years === 6) return 'ประถมศึกษาปีที่ 1 (ป.1)';
    if (years === 7) return 'ประถมศึกษาปีที่ 2 (ป.2)';
    if (years === 8) return 'ประถมศึกษาปีที่ 3 (ป.3)';
    if (years === 9) return 'ประถมศึกษาปีที่ 4 (ป.4)';
    if (years === 10) return 'ประถมศึกษาปีที่ 5 (ป.5)';
    if (years === 11) return 'ประถมศึกษาปีที่ 6 (ป.6)';
    if (years === 12) return 'มัธยมศึกษาปีที่ 1 (ม.1)';
    if (years === 13) return 'มัธยมศึกษาปีที่ 2 (ม.2)';
    if (years === 14) return 'มัธยมศึกษาปีที่ 3 (ม.3)';
    if (years === 15) return 'มัธยมศึกษาปีที่ 4 (ม.4) หรือ ปวช. 1';
    if (years === 16) return 'มัธยมศึกษาปีที่ 5 (ม.5) หรือ ปวช. 2';
    if (years === 17) return 'มัธยมศึกษาปีที่ 6 (ม.6) หรือ ปวช. 3';
    if (years === 18) return 'มหาวิทยาลัย ชั้นปีที่ 1 (Freshman) หรือ ปวส. 1';
    if (years === 19) return 'มหาวิทยาลัย ชั้นปีที่ 2 (Sophomore) หรือ ปวส. 2';
    if (years === 20) return 'มหาวิทยาลัย ชั้นปีที่ 3 (Junior)';
    if (years === 21) return 'มหาวิทยาลัย ชั้นปีที่ 4 (Senior) / ว่าที่บัณฑิต';
    return 'สำเร็จการศึกษาระดับอุดมศึกษา / วัยทำงานเต็มตัว';
}

// 3. Thai Legal & Civil Milestones (สิทธิประโยชน์และกฎหมายไทย)
function getThaiLegalMilestones(years) {
    const list = [
        { age: 7, title: 'ทำบัตรประจำตัวประชาชนใบแรก', desc: 'กฎหมายกำหนดให้ต้องทำบัตรประชาชนภายใน 60 วันนับแต่วันที่มีอายุครบ 7 ปีบริบูรณ์' },
        { age: 15, title: 'เปลี่ยนคำนำหน้านาม & ขับขี่ จยย. 110cc', desc: 'เปลี่ยนคำนำหน้านามเป็น นาย/นางสาว และมีสิทธิทำใบขับขี่รถจักรยานยนต์ส่วนบุคคลชั่วคราว (ไม่เกิน 110cc)' },
        { age: 18, title: 'สิทธิเลือกตั้ง & ขับขี่รถยนต์ส่วนบุคคล', desc: 'มีสิทธิออกเสียงเลือกตั้งตามรัฐธรรมนูญ และมีสิทธิทำใบขับขี่รถยนต์ส่วนบุคคล' },
        { age: 20, title: 'บรรลุนิติภาวะสมบูรณ์ & ขึ้นทะเบียนทหาร (สด.9)', desc: 'ทำนิติกรรมสัญญา นิติกรรมการเงินได้เองโดยสมบูรณ์ และชายไทยต้องแสดงตนขึ้นทะเบียนทหารกองเกิน' },
        { age: 21, title: 'ตรวจเลือกทหารกองประจำการ (เกณฑ์ทหาร สด.43)', desc: 'ชายไทยต้องเข้ารับการตรวจเลือกเป็นทหารกองประจำการ' },
        { age: 25, title: 'วัยเบญจเพส (จุดเปลี่ยนผ่านสำคัญ)', desc: 'ช่วงวัยหัวเลี้ยวหัวต่อตามความเชื่อและสุขภาพ และเป็นก้าวสำคัญของการสร้างความมั่นคง' },
        { age: 55, title: 'สิทธิรับเงินชราภาพประกันสังคม', desc: 'มีสิทธิยื่นขอรับเงินบำเหน็จหรือบำนาญชราภาพจากกองทุนประกันสังคม (ม.33 / ม.39) เมื่อสิ้นสุดความเป็นผู้ประกันตน' },
        { age: 60, title: 'วัยเกษียณอายุ & สิทธิรับเบี้ยยังชีพผู้สูงอายุ', desc: 'ถึงเกณฑ์เกษียณอายุการทำงาน และมีสิทธิลงทะเบียนรับเบี้ยยังชีพผู้สูงอายุจาก อปท. (600 - 1,000 บาท/เดือน)' }
    ];

    return list.map(m => ({
        ...m,
        passed: years >= m.age,
        remainingYears: m.age - years
    }));
}

function calculateDetailedAge(birthDate, targetDate = new Date()) {
    if (birthDate > targetDate) {
        return null;
    }

    let years = targetDate.getFullYear() - birthDate.getFullYear();
    let months = targetDate.getMonth() - birthDate.getMonth();
    let days = targetDate.getDate() - birthDate.getDate();

    if (days < 0) {
        months--;
        const prevMonth = new Date(targetDate.getFullYear(), targetDate.getMonth(), 0);
        days += prevMonth.getDate();
    }

    if (months < 0) {
        years--;
        months += 12;
    }

    const diffMs = targetDate.getTime() - birthDate.getTime();
    const totalDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const totalHours = Math.floor(diffMs / (1000 * 60 * 60));
    const totalWeeks = Math.floor(totalDays / 7);

    // Next birthday calculation
    const currentYear = targetDate.getFullYear();
    let nextBday = new Date(currentYear, birthDate.getMonth(), birthDate.getDate());
    if (nextBday < targetDate) {
        nextBday = new Date(currentYear + 1, birthDate.getMonth(), birthDate.getDate());
    }
    const daysToNextBday = Math.ceil((nextBday - targetDate) / (1000 * 60 * 60 * 24));
    const nextBdayDayOfWeek = THAI_DAYS[nextBday.getDay()];

    const lifeStage = getThaiLifeStage(years, months);
    const education = getThaiEducationGrade(years, months);
    const milestones = getThaiLegalMilestones(years);

    return {
        years,
        months,
        days,
        totalDays,
        totalWeeks,
        totalHours,
        daysToNextBday,
        nextBdayDayOfWeek,
        zodiac: getThaiZodiac(birthDate.getFullYear()),
        beYear: ceToBe(birthDate.getFullYear()),
        ceYear: birthDate.getFullYear(),
        birthDayOfWeek: THAI_DAYS[birthDate.getDay()],
        lifeStage,
        education,
        milestones
    };
}

function calculateDateDifference(startDate, endDate) {
    let d1 = new Date(startDate);
    let d2 = new Date(endDate);
    let isNegative = false;

    if (d1 > d2) {
        const temp = d1;
        d1 = d2;
        d2 = temp;
        isNegative = true;
    }

    let years = d2.getFullYear() - d1.getFullYear();
    let months = d2.getMonth() - d1.getMonth();
    let days = d2.getDate() - d1.getDate();

    if (days < 0) {
        months--;
        const prevMonth = new Date(d2.getFullYear(), d2.getMonth(), 0);
        days += prevMonth.getDate();
    }

    if (months < 0) {
        years--;
        months += 12;
    }

    const diffMs = Math.abs(d2 - d1);
    const totalDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const totalWeeks = Math.floor(totalDays / 7);
    const remainingDays = totalDays % 7;

    let businessDays = 0;
    let cur = new Date(d1);
    while (cur <= d2) {
        const dayOfWeek = cur.getDay();
        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
            businessDays++;
        }
        cur.setDate(cur.getDate() + 1);
    }

    return {
        years,
        months,
        days,
        totalDays,
        totalWeeks,
        remainingDays,
        businessDays,
        isNegative
    };
}

// UI Event Handlers
document.addEventListener('DOMContentLoaded', () => {
    // Tab switching
    const tabBtns = document.querySelectorAll('.tab-btn[data-tab]');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const targetId = btn.getAttribute('data-tab');
            document.querySelectorAll('.tab-content').forEach(pane => {
                pane.style.display = 'none';
            });
            const targetPane = document.getElementById(targetId);
            if (targetPane) targetPane.style.display = 'block';
        });
    });

    // Year-only quick calculator
    const quickYearInput = document.getElementById('quick-year-input');
    const quickYearType = document.getElementById('quick-year-type');
    const quickYearResult = document.getElementById('quick-year-result');

    function runQuickYear() {
        if (!quickYearInput) return;
        const val = parseInt(quickYearInput.value, 10);
        if (!val || isNaN(val) || val <= 0) {
            if (quickYearResult) quickYearResult.textContent = 'กรุณากรอกปีที่ถูกต้อง';
            return;
        }

        const currentYearCe = new Date().getFullYear();
        let birthCe = val;
        if (quickYearType.value === 'be') {
            birthCe = beToCe(val);
        }

        const age = currentYearCe - birthCe;
        if (age < 0) {
            quickYearResult.innerHTML = `ยังไม่ถึงปีเกิด (อีก ${Math.abs(age)} ปีข้างหน้า)`;
        } else {
            const beYear = quickYearType.value === 'be' ? val : ceToBe(val);
            const ceYear = quickYearType.value === 'be' ? beToCe(val) : val;
            const zodiac = getThaiZodiac(birthCe);
            const lifeStage = getThaiLifeStage(age, 0);
            const edu = getThaiEducationGrade(age, 0);

            quickYearResult.innerHTML = `
                <div style="font-size: 1.15rem; font-weight: 700; color: var(--green-primary); margin-bottom: 0.35rem;">
                    อายุย่างเข้า: ${age} ปี (ปี พ.ศ. ${beYear} / ค.ศ. ${ceYear})
                </div>
                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 0.6rem;">
                    <span class="tag-badge" style="background: var(--green-tint); color: var(--green-primary); font-weight: 700;">
                        ช่วงวัย: ${lifeStage.stage}
                    </span>
                    <span class="tag-badge" style="background: rgba(59, 130, 246, 0.1); color: #2563eb; font-weight: 700;">
                        เกณฑ์การศึกษา: ${edu}
                    </span>
                    <span class="tag-badge">
                        ปีนักษัตร: ${zodiac}
                    </span>
                </div>
                <div style="font-size: 0.85rem; color: var(--text-muted);">
                    ${lifeStage.desc}
                </div>
            `;
        }
    }

    if (quickYearInput) {
        quickYearInput.addEventListener('input', runQuickYear);
        quickYearType.addEventListener('change', runQuickYear);
        runQuickYear();
    }

    // Detailed Birth Date Calculator
    const birthDateInput = document.getElementById('birth-date-input');
    const bdayResultBox = document.getElementById('bday-result');
    const milestonesCard = document.getElementById('age-milestones-card');

    function runDetailedAge() {
        if (!birthDateInput || !birthDateInput.value) return;
        const bdate = new Date(birthDateInput.value);
        if (isNaN(bdate.getTime())) return;

        const res = calculateDetailedAge(bdate);
        if (!res) {
            bdayResultBox.innerHTML = '<p class="form-hint" style="color: #ef4444;">วันเกิดต้องไม่เป็นวันที่ในอนาคต</p>';
            if (milestonesCard) milestonesCard.style.display = 'none';
            return;
        }

        // Render Basic Stats
        bdayResultBox.innerHTML = `
            <div class="result-text" style="font-size: 1.65rem; font-weight: 800; color: var(--green-primary); margin-bottom: 0.75rem;">
                ${res.years} ปี ${res.months} เดือน ${res.days} วัน
            </div>
            <div class="result-stats-grid">
                <div class="stat-item">
                    <div class="stat-title">ปีเกิด พ.ศ. / ค.ศ.</div>
                    <div class="stat-value">${res.beYear} / ${res.ceYear}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">วันเกิด / ปีนักษัตร</div>
                    <div class="stat-value">${res.birthDayOfWeek} (${res.zodiac})</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">รวมวันที่ใช้ชีวิตมาแล้ว</div>
                    <div class="stat-value">${res.totalDays.toLocaleString('th-TH')} วัน (${res.totalHours.toLocaleString('th-TH')} ชม.)</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">วันเกิดถัดไป</div>
                    <div class="stat-value">อีก ${res.daysToNextBday} วัน (${res.nextBdayDayOfWeek})</div>
                </div>
            </div>
        `;

        // Render Detailed Life Stages, Education Grade & Thai Milestones
        if (milestonesCard) {
            milestonesCard.style.display = 'block';
            milestonesCard.innerHTML = `
                <div class="card-title-bar" style="margin-bottom: 1.25rem;">
                    <div>
                        <h3 class="card-title" style="font-size: 1.2rem;">รายละเอียดช่วงวัย การศึกษา และหลักไมล์ชีวิตไทย</h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">วิเคราะห์ระดับชั้นการศึกษา ช่วงชีวิต และสิทธิประโยชน์ตามกฎหมายไทย</p>
                    </div>
                    <span class="tag-badge" style="background: var(--green-tint); color: var(--green-primary); font-weight: 700;">
                        ${res.years} ปีบริบูรณ์
                    </span>
                </div>

                <!-- Life Stage & Education Highlights -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="background: var(--bg-card); border: 1.5px solid var(--border-color); border-radius: 10px; padding: 1.15rem;">
                        <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.35rem;">
                            ช่วงวัยปัจจุบัน (Life Stage)
                        </div>
                        <div style="font-size: 1.25rem; font-weight: 800; color: var(--green-primary); margin-bottom: 0.35rem;">
                            ${res.lifeStage.stage}
                        </div>
                        <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.5;">
                            ${res.lifeStage.desc}
                        </div>
                    </div>

                    <div style="background: var(--bg-card); border: 1.5px solid var(--border-color); border-radius: 10px; padding: 1.15rem;">
                        <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.35rem;">
                            เกณฑ์ระดับการศึกษาไทย (Education Level)
                        </div>
                        <div style="font-size: 1.25rem; font-weight: 800; color: #2563eb; margin-bottom: 0.35rem;">
                            ${res.education}
                        </div>
                        <div style="font-size: 0.85rem; color: var(--text-secondary); line-height: 1.5;">
                            ประเมินตามเกณฑ์อายุเทียบมาตรฐานการศึกษาไทย (อนุบาล ประถม มัธยม อุดมศึกษา)
                        </div>
                    </div>
                </div>

                <!-- Thai Legal & Civil Milestones Timeline -->
                <div style="border-top: 1px solid var(--border-color); padding-top: 1.25rem;">
                    <div style="font-weight: 700; font-size: 1rem; color: var(--text-primary); margin-bottom: 0.75rem;">
                        สิทธิประโยชน์และกฎหมายสำคัญตามเกณฑ์อายุไทย
                    </div>
                    <div class="milestone-timeline">
                        ${res.milestones.map(m => `
                            <div class="timeline-item ${m.passed ? 'passed' : 'upcoming'}">
                                <div class="timeline-icon-box">
                                    ${m.passed ? `
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    ` : `
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg>
                                    `}
                                </div>
                                <div style="flex: 1;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.2rem; flex-wrap: wrap; gap: 0.4rem;">
                                        <strong style="font-size: 0.95rem; color: var(--text-primary);">
                                            อายุ ${m.age} ปี: ${m.title}
                                        </strong>
                                        <span class="tag-badge" style="${m.passed ? 'background: var(--green-tint); color: var(--green-primary);' : 'background: var(--bg-subtle); color: var(--text-muted);'} font-size: 0.75rem;">
                                            ${m.passed ? 'ผ่านเกณฑ์แล้ว' : `อีก ${m.remainingYears} ปี`}
                                        </span>
                                    </div>
                                    <div style="font-size: 0.825rem; color: var(--text-secondary); line-height: 1.5;">
                                        ${m.desc}
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }
    }

    if (birthDateInput) {
        birthDateInput.value = '1998-01-01';
        birthDateInput.addEventListener('change', runDetailedAge);
        runDetailedAge();
    }

    // Date Difference comparison
    const diffDate1 = document.getElementById('diff-date-1');
    const diffDate2 = document.getElementById('diff-date-2');
    const diffResultBox = document.getElementById('diff-result-box');

    function runDateDiff() {
        if (!diffDate1 || !diffDate2 || !diffDate1.value || !diffDate2.value) return;
        const res = calculateDateDifference(diffDate1.value, diffDate2.value);

        diffResultBox.innerHTML = `
            <div class="result-text" style="margin-bottom: 0.75rem;">
                ห่างกัน ${res.years} ปี ${res.months} เดือน ${res.days} วัน
            </div>
            <div class="result-stats-grid">
                <div class="stat-item">
                    <div class="stat-title">คิดเป็นจำนวนวันทั้งหมด</div>
                    <div class="stat-value">${res.totalDays.toLocaleString('th-TH')} วัน</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">คิดเป็นจำนวนสัปดาห์</div>
                    <div class="stat-value">${res.totalWeeks} สัปดาห์ ${res.remainingDays} วัน</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">วันทำการ (จันทร์-ศุกร์)</div>
                    <div class="stat-value">${res.businessDays.toLocaleString('th-TH')} วัน</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">ประมาณการเดือน</div>
                    <div class="stat-value">${(res.years * 12 + res.months)} เดือน</div>
                </div>
            </div>
        `;
    }

    if (diffDate1 && diffDate2) {
        const today = new Date();
        const past = new Date(1998, 0, 1);
        diffDate1.value = past.toISOString().split('T')[0];
        diffDate2.value = today.toISOString().split('T')[0];
        diffDate1.addEventListener('change', runDateDiff);
        diffDate2.addEventListener('change', runDateDiff);
        runDateDiff();
    }
});
