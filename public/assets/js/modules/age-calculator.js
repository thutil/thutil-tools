/**
 * Age Calculator & Date Difference Tool
 * Supports Thai Buddhist Era (B.E. พ.ศ.) and Common Era (C.E. ค.ศ.)
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

function beToCe(beYear) {
    return beYear - 543;
}

function ceToBe(ceYear) {
    return ceYear + 543;
}

function getThaiZodiac(ceYear) {
    // Year 1900 was Rat (ชวด) or index based on (year - 3) % 12
    const index = (ceYear - 3) % 12;
    return THAI_ZODIAC[index < 0 ? index + 12 : index];
}

function calculateDetailedAge(birthDate, targetDate = new Date()) {
    if (birthDate > targetDate) {
        return null; // Birth date cannot be in future
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

    return {
        years,
        months,
        days,
        totalDays,
        totalWeeks,
        totalHours,
        daysToNextBday,
        zodiac: getThaiZodiac(birthDate.getFullYear()),
        beYear: ceToBe(birthDate.getFullYear()),
        ceYear: birthDate.getFullYear()
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

    // Working days (Monday to Friday)
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
    // Tab switching (Age Mode vs Diff Mode)
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
            quickYearResult.innerHTML = `
                เกิดปี พ.ศ. <strong>${beYear}</strong> (ค.ศ. ${ceYear})<br>
                อายุย่างเข้า: <strong>${age}</strong> ปี | ปีนักษัตร: <strong>${zodiac}</strong>
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

    function runDetailedAge() {
        if (!birthDateInput || !birthDateInput.value) return;
        const bdate = new Date(birthDateInput.value);
        if (isNaN(bdate.getTime())) return;

        const res = calculateDetailedAge(bdate);
        if (!res) {
            bdayResultBox.innerHTML = '<p class="form-hint" style="color: #ef4444;">วันเกิดต้องไม่เป็นวันที่ในอนาคต</p>';
            return;
        }

        bdayResultBox.innerHTML = `
            <div class="result-text" style="margin-bottom: 0.75rem;">
                ${res.years} ปี ${res.months} เดือน ${res.days} วัน
            </div>
            <div class="result-stats-grid">
                <div class="stat-item">
                    <div class="stat-title">ปีเกิด พ.ศ. / ค.ศ.</div>
                    <div class="stat-value">${res.beYear} / ${res.ceYear}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">ปีนักษัตร</div>
                    <div class="stat-value">${res.zodiac}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">รวมวันที่ใช้ชีวิต</div>
                    <div class="stat-value">${res.totalDays.toLocaleString('th-TH')} วัน</div>
                </div>
                <div class="stat-item">
                    <div class="stat-title">วันเกิดครั้งถัดไปในอีก</div>
                    <div class="stat-value">${res.daysToNextBday} วัน</div>
                </div>
            </div>
        `;
    }

    if (birthDateInput) {
        // Set default to 1998-01-01 (พ.ศ. 2541)
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
