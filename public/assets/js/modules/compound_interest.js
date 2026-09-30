/**
 * Compound Interest & Monthly DCA Investment Calculator
 * Calculate future wealth, cumulative deposits, and compound interest gains
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inputs
    const initialInput = document.getElementById('ci-initial-input');
    const monthlyInput = document.getElementById('ci-monthly-input');
    const rateInput = document.getElementById('ci-rate-input');
    const yearsInput = document.getElementById('ci-years-input');
    const freqSelect = document.getElementById('ci-freq-select');

    // Outputs
    const resTotalWealth = document.getElementById('res-ci-total');
    const resPrincipal = document.getElementById('res-ci-principal');
    const resInterest = document.getElementById('res-ci-interest');
    const resMultiplier = document.getElementById('res-ci-multiplier');
    const barPrincipal = document.getElementById('ci-bar-principal');
    const barInterest = document.getElementById('ci-bar-interest');
    const pctPrincipal = document.getElementById('ci-pct-principal');
    const pctInterest = document.getElementById('ci-pct-interest');
    const yearlyTableBody = document.getElementById('ci-yearly-table-body');

    function formatNumber(num) {
        return Math.round(num).toLocaleString('th-TH');
    }

    function calculateCompound() {
        const initial = Math.max(0, parseFloat(initialInput?.value) || 0);
        const monthly = Math.max(0, parseFloat(monthlyInput?.value) || 0);
        const annualRate = (parseFloat(rateInput?.value) || 0) / 100;
        const years = Math.max(1, parseInt(yearsInput?.value) || 10);
        const freq = parseInt(freqSelect?.value) || 12; // 12 times a year

        // Year by year progression
        let currentBalance = initial;
        let currentPrincipal = initial;
        let yearlyRows = '';

        const r = annualRate / 12; // monthly rate

        for (let y = 1; y <= years; y++) {
            const startYearBalance = currentBalance;
            const yearDeposit = monthly * 12;
            currentPrincipal += yearDeposit;

            // Monthly compound compounding 12 times in the year
            for (let m = 1; m <= 12; m++) {
                currentBalance = (currentBalance + monthly) * (1 + r);
            }

            const interestEarnedThisYear = currentBalance - startYearBalance - yearDeposit;
            const totalGainsSoFar = currentBalance - currentPrincipal;

            if (y <= 5 || y % 5 === 0 || y === years) {
                yearlyRows += `
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 0.5rem; font-weight: 600;">ปีที่ ${y}</td>
                        <td style="padding: 0.5rem;">${formatNumber(currentPrincipal)} บ.</td>
                        <td style="padding: 0.5rem; color: #10b981;">+${formatNumber(totalGainsSoFar)} บ.</td>
                        <td style="padding: 0.5rem; font-weight: 700; color: var(--text-primary);">${formatNumber(currentBalance)} บ.</td>
                    </tr>
                `;
            }
        }

        const totalWealth = currentBalance;
        const totalPrincipal = currentPrincipal;
        const totalInterest = Math.max(0, totalWealth - totalPrincipal);
        const multiplier = totalPrincipal > 0 ? (totalWealth / totalPrincipal) : 1;

        const principalPct = totalWealth > 0 ? ((totalPrincipal / totalWealth) * 100).toFixed(1) : 100;
        const interestPct = totalWealth > 0 ? ((totalInterest / totalWealth) * 100).toFixed(1) : 0;

        // Update UI
        if (resTotalWealth) resTotalWealth.textContent = formatNumber(totalWealth) + ' บาท';
        if (resPrincipal) resPrincipal.textContent = formatNumber(totalPrincipal) + ' บาท';
        if (resInterest) resInterest.textContent = formatNumber(totalInterest) + ' บาท';
        if (resMultiplier) resMultiplier.textContent = multiplier.toFixed(2) + ' เท่า';

        if (barPrincipal) barPrincipal.style.width = `${principalPct}%`;
        if (barInterest) barInterest.style.width = `${interestPct}%`;
        if (pctPrincipal) pctPrincipal.textContent = `${principalPct}%`;
        if (pctInterest) pctInterest.textContent = `${interestPct}%`;

        if (yearlyTableBody) yearlyTableBody.innerHTML = yearlyRows;
    }

    [initialInput, monthlyInput, rateInput, yearsInput, freqSelect].forEach(el => {
        if (el) {
            el.addEventListener('input', calculateCompound);
            el.addEventListener('change', calculateCompound);
        }
    });

    // Preset buttons
    document.querySelectorAll('.btn-preset-ci').forEach(btn => {
        btn.addEventListener('click', () => {
            const init = btn.dataset.init;
            const monthly = btn.dataset.monthly;
            const rate = btn.dataset.rate;
            const years = btn.dataset.years;

            if (initialInput) initialInput.value = init;
            if (monthlyInput) monthlyInput.value = monthly;
            if (rateInput) rateInput.value = rate;
            if (yearsInput) yearsInput.value = years;

            calculateCompound();
        });
    });

    calculateCompound();

    // Attach Report Exporter
    if (window.ReportExporter) {
        window.ReportExporter.attachDropdown('#export-dropdown-compound-interest', () => {
            const initial = Math.max(0, parseFloat(initialInput?.value) || 0);
            const monthly = Math.max(0, parseFloat(monthlyInput?.value) || 0);
            const annualRatePercent = parseFloat(rateInput?.value) || 0;
            const annualRate = annualRatePercent / 100;
            const years = Math.max(1, parseInt(yearsInput?.value) || 10);
            const freq = parseInt(freqSelect?.value) || 12;

            let currentBalance = initial;
            let currentPrincipal = initial;
            const r = annualRate / 12;

            const scheduleRows = [];
            for (let y = 1; y <= years; y++) {
                const startYearBalance = currentBalance;
                const yearDeposit = monthly * 12;
                currentPrincipal += yearDeposit;

                for (let m = 1; m <= 12; m++) {
                    currentBalance = (currentBalance + monthly) * (1 + r);
                }

                const interestEarnedThisYear = currentBalance - startYearBalance - yearDeposit;
                const totalGainsSoFar = currentBalance - currentPrincipal;

                scheduleRows.push([
                    y,
                    Math.round(currentPrincipal),
                    Math.round(yearDeposit),
                    Math.round(interestEarnedThisYear),
                    Math.round(totalGainsSoFar),
                    Math.round(currentBalance)
                ]);
            }

            const totalWealth = Math.round(currentBalance);
            const totalPrincipal = Math.round(currentPrincipal);
            const totalInterest = Math.max(0, totalWealth - totalPrincipal);
            const multiplier = totalPrincipal > 0 ? (totalWealth / totalPrincipal).toFixed(2) : 1;

            const summaryRows = [
                ['--- ข้อมูลการวางแผนและผลลัพธ์สรุป ---', ''],
                ['เงินต้นตั้งต้น (บาท)', initial],
                ['เงินออมสมทบทุกเดือน DCA (บาท)', monthly],
                ['ผลตอบแทนคาดหวัง (% ต่อปี)', `${annualRatePercent}%`],
                ['ระยะเวลาลงทุน (ปี)', `${years} ปี`],
                ['ความถี่ในการทบต้น', freq === 12 ? 'ทบต้นรายเดือน (Monthly)' : 'ทบต้นรายปี (Annually)'],
                ['เงินต้นที่จ่ายจริงรวม (บาท)', totalPrincipal],
                ['กำไร/ดอกเบี้ยทบต้นสะสมทั้งหมด (บาท)', totalInterest],
                ['มูลค่าเงินรวมในอนาคต (บาท)', totalWealth],
                ['เติบโตเป็นจำนวนเท่าของเงินต้น', `${multiplier} เท่า`],
                ['สัดส่วนเงินต้น (%)', `${((totalPrincipal / totalWealth) * 100).toFixed(1)}%`],
                ['สัดส่วนกำไรดอกเบี้ย (%)', `${((totalInterest / totalWealth) * 100).toFixed(1)}%`],
                []
            ];

            const scheduleHeader = [
                ['--- ตารางแจกแจงการเติบโตของพอร์ตสะสมรายปี ---', '', '', '', '', ''],
                ['ปีที่', 'เงินต้นสะสม (บาท)', 'เงินออมเพิ่มปีนี้ (บาท)', 'ดอกเบี้ยที่งอกเงยปีนี้ (บาท)', 'กำไรดอกเบี้ยสะสมรวม (บาท)', 'มูลค่าพอร์ตสิ้นปี (บาท)']
            ];

            const allRows = [
                ...summaryRows,
                ...scheduleHeader,
                ...scheduleRows
            ];

            return {
                title: 'รายงานการคำนวณดอกเบี้ยทบต้น & ออมเงิน DCA วางแผนเกษียณ',
                filename: `compound-interest-report-${Date.now()}`,
                rows: allRows,
                sheets: {
                    'สรุปผลและตารางเติบโต': allRows
                }
            };
        });
    }
});
