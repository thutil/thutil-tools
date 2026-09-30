/**
 * Thai Mortgage Loan & Extra Prepayment Calculator (โปะบ้านลดต้นลดดอก)
 */

function calculateHomeLoan(principal, annualRatePercent, termYears, extraMonthly = 0) {
    const P = parseFloat(principal) || 0;
    const annualRate = parseFloat(annualRatePercent) || 0;
    const r = (annualRate / 100) / 12; // Monthly interest rate
    const totalMonths = (parseInt(termYears, 10) || 30) * 12;
    const extra = parseFloat(extraMonthly) || 0;

    if (P <= 0 || r <= 0 || totalMonths <= 0) {
        return null;
    }

    // Standard monthly payment (PMT formula)
    const standardPayment = (P * r * Math.pow(1 + r, totalMonths)) / (Math.pow(1 + r, totalMonths) - 1);

    // Scenario 1: Standard amortization without extra
    let balanceStd = P;
    let totalInterestStd = 0;
    for (let m = 1; m <= totalMonths; m++) {
        const interest = balanceStd * r;
        const principalPaid = standardPayment - interest;
        totalInterestStd += interest;
        balanceStd -= principalPaid;
        if (balanceStd <= 0) break;
    }

    // Scenario 2: With extra prepayment (เงินโปะ)
    let balanceExtra = P;
    let totalInterestExtra = 0;
    let actualMonthsWithExtra = 0;

    for (let m = 1; m <= totalMonths; m++) {
        actualMonthsWithExtra++;
        const interest = balanceExtra * r;
        const principalPaid = (standardPayment - interest) + extra;
        totalInterestExtra += interest;
        balanceExtra -= principalPaid;

        if (balanceExtra <= 0) {
            break;
        }
    }

    const interestSaved = Math.max(0, totalInterestStd - totalInterestExtra);
    const monthsSaved = Math.max(0, totalMonths - actualMonthsWithExtra);
    const yearsSaved = Math.floor(monthsSaved / 12);
    const remMonthsSaved = monthsSaved % 12;

    return {
        principal: P,
        standardPayment: Math.round(standardPayment),
        actualMonthlyPay: Math.round(standardPayment + extra),
        totalInterestStd: Math.round(totalInterestStd),
        totalInterestExtra: Math.round(totalInterestExtra),
        interestSaved: Math.round(interestSaved),
        monthsSaved,
        yearsSaved,
        remMonthsSaved,
        totalPayableStd: Math.round(P + totalInterestStd),
        totalPayableExtra: Math.round(P + totalInterestExtra),
        finishedYears: Math.round((actualMonthsWithExtra / 12) * 10) / 10
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputLoan = document.getElementById('home-loan-input');
    const inputRate = document.getElementById('home-rate-input');
    const inputYears = document.getElementById('home-years-input');
    const inputExtra = document.getElementById('home-extra-input');

    const resStdPayment = document.getElementById('res-home-std-payment');
    const resInterestSaved = document.getElementById('res-home-interest-saved');
    const resTimeSaved = document.getElementById('res-home-time-saved');
    const resTotalInterest = document.getElementById('res-home-total-interest');
    const resFinishTime = document.getElementById('res-home-finish-time');

    function update() {
        if (!inputLoan || !inputRate || !inputYears) return;

        const res = calculateHomeLoan(
            inputLoan.value,
            inputRate.value,
            inputYears.value,
            inputExtra ? inputExtra.value : 0
        );

        if (!res) return;

        if (resStdPayment) resStdPayment.textContent = `${res.standardPayment.toLocaleString('th-TH')} บาท/เดือน`;
        if (resInterestSaved) resInterestSaved.textContent = `ประหยัดได้ ${res.interestSaved.toLocaleString('th-TH')} บาท`;
        if (resTimeSaved) resTimeSaved.textContent = `ผ่อนหมดเร็วขึ้น ${res.yearsSaved} ปี ${res.remMonthsSaved} เดือน`;
        if (resTotalInterest) resTotalInterest.textContent = `${res.totalInterestExtra.toLocaleString('th-TH')} บาท`;
        if (resFinishTime) resFinishTime.textContent = `ผ่อนหมดใน ${res.finishedYears} ปี (จาก ${inputYears.value} ปี)`;
    }

    [inputLoan, inputRate, inputYears, inputExtra].forEach(el => {
        if (el) el.addEventListener('input', update);
    });

    // Preset chips
    document.querySelectorAll('.btn-preset-home').forEach(btn => {
        btn.addEventListener('click', () => {
            inputLoan.value = btn.getAttribute('data-loan');
            inputRate.value = btn.getAttribute('data-rate');
            inputYears.value = btn.getAttribute('data-years');
            if (inputExtra) inputExtra.value = btn.getAttribute('data-extra');
            update();
        });
    });

    // Default: 3,000,000 THB, Rate 4.5%, 30 years, Extra 3,000 THB
    if (inputLoan) {
        inputLoan.value = '3000000';
        inputRate.value = '4.25';
        inputYears.value = '30';
        if (inputExtra) inputExtra.value = '3000';
        update();
    }

    // Attach Report Exporter
    if (window.ReportExporter) {
        window.ReportExporter.attachDropdown('#export-dropdown-home-loan', () => {
            const P = parseFloat(inputLoan.value) || 0;
            const annualRate = parseFloat(inputRate.value) || 0;
            const termYears = parseInt(inputYears.value, 10) || 30;
            const extra = parseFloat(inputExtra ? inputExtra.value : 0) || 0;

            const res = calculateHomeLoan(P, annualRate, termYears, extra);
            if (!res) return null;

            // Summary Section
            const summaryRows = [
                ['--- ข้อมูลการคำนวณและผลลัพธ์สรุป ---', ''],
                ['วงเงินกู้ซื้อบ้านเริ่มต้น (บาท)', res.principal],
                ['อัตราดอกเบี้ยเฉลี่ย (% ต่อปี)', `${annualRate}%`],
                ['ระยะเวลาผ่อนตามสัญญา (ปี)', `${termYears} ปี (${termYears * 12} งวด)`],
                ['ค่างวดปกติต่อเดือน (บาท)', res.standardPayment],
                ['เงินโปะเพิ่มต่อเดือน (บาท)', extra],
                ['ยอดจ่ายต่อเดือนเมื่อรวมเงินโปะ (บาท)', res.actualMonthlyPay],
                ['ดอกเบี้ยรวมกรณีผ่อนปกติ (บาท)', res.totalInterestStd],
                ['ดอกเบี้ยรวมกรณีมีเงินโปะ (บาท)', res.totalInterestExtra],
                ['ประหยัดดอกเบี้ยได้สุทธิ (บาท)', res.interestSaved],
                ['ระยะเวลาที่ผ่อนหมดเร็วขึ้น', `${res.yearsSaved} ปี ${res.remMonthsSaved} เดือน (${res.monthsSaved} งวด)`],
                ['ระยะเวลาผ่อนจริงเมื่อมีเงินโปะ (ปี)', `${res.finishedYears} ปี`],
                ['ยอดชำระรวมทั้งหมด แผนปกติ (บาท)', res.totalPayableStd],
                ['ยอดชำระรวมทั้งหมด แผนโปะเพิ่ม (บาท)', res.totalPayableExtra],
                []
            ];

            // Detailed Amortization Comparison Table
            const totalMonths = termYears * 12;
            const r = (annualRate / 100) / 12;

            const scheduleHeader = [
                ['--- ตารางเปรียบเทียบการตัดเงินต้นและดอกเบี้ยรายงวด (Amortization Comparison) ---', '', '', '', '', '', '', ''],
                [
                    'งวดที่',
                    'แผนปกติ: ค่างวด (บาท)',
                    'แผนปกติ: ดอกเบี้ย (บาท)',
                    'แผนปกติ: ตัดต้น (บาท)',
                    'แผนปกติ: หนี้คงเหลือ (บาท)',
                    'แผนโปะ: ค่างวดรวมโปะ (บาท)',
                    'แผนโปะ: ดอกเบี้ย (บาท)',
                    'แผนโปะ: ตัดต้น (บาท)',
                    'แผนโปะ: หนี้คงเหลือ (บาท)'
                ]
            ];

            const scheduleRows = [];
            let balStd = P;
            let balExt = P;
            let extFinished = false;

            for (let m = 1; m <= totalMonths; m++) {
                // Std calculation
                let intStd = 0;
                let prinStd = 0;
                if (balStd > 0) {
                    intStd = balStd * r;
                    prinStd = Math.min(balStd, res.standardPayment - intStd);
                    balStd = Math.max(0, balStd - prinStd);
                }

                // Extra calculation
                let payExt = 0;
                let intExt = 0;
                let prinExt = 0;
                if (balExt > 0) {
                    intExt = balExt * r;
                    const desiredPay = res.standardPayment + extra;
                    prinExt = Math.min(balExt, desiredPay - intExt);
                    payExt = prinExt + intExt;
                    balExt = Math.max(0, balExt - prinExt);
                } else if (!extFinished) {
                    extFinished = true;
                }

                // If both are finished, break
                if (balStd <= 0 && balExt <= 0 && m > 1) {
                    scheduleRows.push([
                        m,
                        Math.round(res.standardPayment),
                        Math.round(intStd),
                        Math.round(prinStd),
                        Math.round(balStd),
                        Math.round(payExt),
                        Math.round(intExt),
                        Math.round(prinExt),
                        Math.round(balExt)
                    ]);
                    break;
                }

                scheduleRows.push([
                    m,
                    Math.round(res.standardPayment),
                    Math.round(intStd),
                    Math.round(prinStd),
                    Math.round(balStd),
                    Math.round(payExt),
                    Math.round(intExt),
                    Math.round(prinExt),
                    Math.round(balExt)
                ]);
            }

            const allRows = [
                ...summaryRows,
                ...scheduleHeader,
                ...scheduleRows
            ];

            return {
                title: 'รายงานคำนวณสินเชื่อบ้านและเปรียบเทียบการโปะบ้านลดต้นลดดอก',
                filename: `home-loan-report-${Date.now()}`,
                rows: allRows,
                sheets: {
                    'สรุปผลและตารางโปะบ้าน': allRows
                }
            };
        });
    }
});
