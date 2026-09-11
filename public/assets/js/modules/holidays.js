/**
 * Thai Public Holidays & Government Working Days Calculator
 */

const THAI_HOLIDAYS_DEFAULT = [
    { date: '01-01', name: 'วันขึ้นปีใหม่' },
    { date: '01-02', name: 'วันหยุดชดเชยวันสิ้นปี/วันขึ้นปีใหม่' },
    { date: '02-24', name: 'วันมาฆบูชา' },
    { date: '04-06', name: 'วันจักรี' },
    { date: '04-13', name: 'วันสงกรานต์' },
    { date: '04-14', name: 'วันสงกรานต์' },
    { date: '04-15', name: 'วันสงกรานต์' },
    { date: '05-01', name: 'วันแรงงานแห่งชาติ' },
    { date: '05-04', name: 'วันฉัตรมงคล' },
    { date: '05-22', name: 'วันวิสาขบูชา' },
    { date: '06-03', name: 'วันเฉลิมพระชนมพรรษาสมเด็จพระนางเจ้าฯ พระบรมราชินี' },
    { date: '07-20', name: 'วันอาสาฬหบูชา' },
    { date: '07-21', name: 'วันเข้าพรรษา' },
    { date: '07-28', name: 'วันเฉลิมพระชนมพรรษาพระบาทสมเด็จพระเจ้าอยู่หัว' },
    { date: '08-12', name: 'วันแม่แห่งชาติ (วันเฉลิมพระชนมพรรษาสมเด็จพระบรมราชชนนีพันปีหลวง)' },
    { date: '10-13', name: 'วันนวมินทรมหาราช (วันคล้ายวันสวรรคต ร.9)' },
    { date: '10-23', name: 'วันปิยมหาราช' },
    { date: '12-05', name: 'วันพ่อแห่งชาติ (วันคล้ายวันพระบรมราชสมภพ ร.9)' },
    { date: '12-10', name: 'วันรัฐธรรมนูญ' },
    { date: '12-31', name: 'วันสิ้นปี' }
];

function isHoliday(dateObj) {
    const month = String(dateObj.getMonth() + 1).padStart(2, '0');
    const day = String(dateObj.getDate()).padStart(2, '0');
    const key = `${month}-${day}`;
    return THAI_HOLIDAYS_DEFAULT.find(h => h.date === key);
}

function calculateWorkingDays(startDate, endDate) {
    let d1 = new Date(startDate);
    let d2 = new Date(endDate);
    if (d1 > d2) {
        const t = d1; d1 = d2; d2 = t;
    }

    let totalDays = 0;
    let weekendDays = 0;
    let holidayDays = 0;
    let workingDays = 0;
    const holidaysFound = [];

    let cur = new Date(d1);
    while (cur <= d2) {
        totalDays++;
        const dayOfWeek = cur.getDay(); // 0 = Sun, 6 = Sat
        const hol = isHoliday(cur);

        if (dayOfWeek === 0 || dayOfWeek === 6) {
            weekendDays++;
        } else if (hol) {
            holidayDays++;
            holidaysFound.push(`${cur.toISOString().split('T')[0]}: ${hol.name}`);
        } else {
            workingDays++;
        }
        cur.setDate(cur.getDate() + 1);
    }

    return {
        totalDays,
        workingDays,
        weekendDays,
        holidayDays,
        holidaysFound
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputStart = document.getElementById('workday-start-date');
    const inputEnd = document.getElementById('workday-end-date');

    const resWorking = document.getElementById('res-working-days');
    const resTotal = document.getElementById('res-total-calendar-days');
    const resWeekend = document.getElementById('res-weekend-days');
    const resHolidays = document.getElementById('res-holiday-days');
    const listHolidays = document.getElementById('list-holidays-in-range');

    function update() {
        if (!inputStart || !inputEnd || !inputStart.value || !inputEnd.value) return;
        const res = calculateWorkingDays(inputStart.value, inputEnd.value);

        if (resWorking) resWorking.textContent = `${res.workingDays} วันทำการ`;
        if (resTotal) resTotal.textContent = `${res.totalDays} วัน`;
        if (resWeekend) resWeekend.textContent = `${res.weekendDays} วัน`;
        if (resHolidays) resHolidays.textContent = `${res.holidayDays} วัน`;

        if (listHolidays) {
            if (res.holidaysFound.length === 0) {
                listHolidays.innerHTML = '<span class="form-hint">ไม่มีวันหยุดราชการในช่วงเวลาที่เลือก</span>';
            } else {
                listHolidays.innerHTML = res.holidaysFound.map(h => `<div style="padding: 0.35rem 0; border-bottom: 1px solid var(--border-color); font-size: 0.8rem;">• ${h}</div>`).join('');
            }
        }
    }

    if (inputStart && inputEnd) {
        const today = new Date();
        const nextMonth = new Date(today);
        nextMonth.setDate(today.getDate() + 30);

        inputStart.value = today.toISOString().split('T')[0];
        inputEnd.value = nextMonth.toISOString().split('T')[0];

        inputStart.addEventListener('change', update);
        inputEnd.addEventListener('change', update);
        update();
    }
});
