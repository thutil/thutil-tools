/**
 * Thai Personal Income Tax Calculator (ภ.ง.ด. 90/91)
 * Updated for Tax Years 2567 - 2568 (New ThaiESG rules, Easy E-Receipt, etc.)
 * 100% Client-side calculation (Zero Storage)
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inputs
    const incomeSalary = document.getElementById('tax-income-salary');
    const incomeBonus = document.getElementById('tax-income-bonus');
    const incomeOther = document.getElementById('tax-income-other');
    const withholdingTax = document.getElementById('tax-withholding');

    // Deductions: Personal & Family
    const dedPersonal = 60000; // Fixed
    const dedSpouseCheck = document.getElementById('ded-spouse');
    const dedChildren = document.getElementById('ded-children');
    const dedParents = document.getElementById('ded-parents');

    // Deductions: Insurance & Investments
    const dedSocial = document.getElementById('ded-social');
    const dedLifeIns = document.getElementById('ded-life-ins');
    const dedHealthIns = document.getElementById('ded-health-ins');
    const dedPvd = document.getElementById('ded-pvd');
    const dedRmf = document.getElementById('ded-rmf');
    const dedSsf = document.getElementById('ded-ssf');
    const dedThaiesg = document.getElementById('ded-thaiesg');

    // Deductions: Housing & Stimulus
    const dedHomeLoan = document.getElementById('ded-home-loan');
    const dedEasyEreceipt = document.getElementById('ded-easy-ereceipt');

    // Deductions: Donations
    const dedDonationEdu = document.getElementById('ded-donation-edu');
    const dedDonationGeneral = document.getElementById('ded-donation-general');

    // Outputs
    const resTotalIncome = document.getElementById('res-total-income');
    const resTotalExpense = document.getElementById('res-total-expense');
    const resTotalDeduction = document.getElementById('res-total-deduction');
    const resNetIncome = document.getElementById('res-net-income');
    const resTaxCalculated = document.getElementById('res-tax-calculated');
    const resTaxWithholding = document.getElementById('res-tax-withholding');
    const resTaxStatusText = document.getElementById('res-tax-status-text');
    const resTaxFinalAmount = document.getElementById('res-tax-final-amount');
    const resBracketRate = document.getElementById('res-bracket-rate');
    const taxBracketBreakdown = document.getElementById('tax-bracket-breakdown');

    // Tax Brackets definition
    const BRACKETS = [
        { min: 0, max: 150000, rate: 0, label: '0 - 150,000 (ยกเว้น)' },
        { min: 150000, max: 300000, rate: 0.05, label: '150,001 - 300,000 (5%)' },
        { min: 300000, max: 500000, rate: 0.10, label: '300,001 - 500,000 (10%)' },
        { min: 500000, max: 750000, rate: 0.15, label: '500,001 - 750,000 (15%)' },
        { min: 750000, max: 1000000, rate: 0.20, label: '750,001 - 1,000,000 (20%)' },
        { min: 1000000, max: 2000000, rate: 0.25, label: '1,000,001 - 2,000,000 (25%)' },
        { min: 2000000, max: 5000000, rate: 0.30, label: '2,000,001 - 5,000,000 (30%)' },
        { min: 5000000, max: Infinity, rate: 0.35, label: 'เกิน 5,000,000 (35%)' }
    ];

    function formatNumber(num) {
        return Math.round(num).toLocaleString('th-TH');
    }

    function calculateTax() {
        const salary = parseFloat(incomeSalary?.value) || 0;
        const bonus = parseFloat(incomeBonus?.value) || 0;
        const other = parseFloat(incomeOther?.value) || 0;
        const wht = parseFloat(withholdingTax?.value) || 0;

        const totalIncome = salary + bonus + other;

        // Standard 50% max 100,000 THB deduction for employment income
        const standardExpense = Math.min(totalIncome * 0.50, 100000);

        // Deductions calculation
        let familyDeductions = dedPersonal;
        if (dedSpouseCheck && dedSpouseCheck.checked) {
            familyDeductions += 60000;
        }
        const childCount = parseInt(dedChildren?.value) || 0;
        familyDeductions += childCount * 30000;

        const parentCount = parseInt(dedParents?.value) || 0;
        familyDeductions += Math.min(parentCount, 4) * 30000;

        // Social Security: max 9,000 THB
        const socialVal = Math.min(parseFloat(dedSocial?.value) || 0, 9000);

        // Life & Health: Combined max 100,000, Health max 25,000
        const healthVal = Math.min(parseFloat(dedHealthIns?.value) || 0, 25000);
        const lifeVal = Math.min(parseFloat(dedLifeIns?.value) || 0, 100000);
        const lifeHealthCombined = Math.min(healthVal + lifeVal, 100000);

        // Retirement funds: PVD + RMF + SSF combined max 500,000 THB
        const pvdVal = Math.min(parseFloat(dedPvd?.value) || 0, totalIncome * 0.15, 500000);
        const rmfVal = Math.min(parseFloat(dedRmf?.value) || 0, totalIncome * 0.30, 500000);
        const ssfVal = Math.min(parseFloat(dedSsf?.value) || 0, totalIncome * 0.30, 200000);
        const retirementCombined = Math.min(pvdVal + rmfVal + ssfVal, 500000);

        // ThaiESG: Up to 30% of income, max 300,000 THB (new 2567 rule!)
        const thaiesgVal = Math.min(parseFloat(dedThaiesg?.value) || 0, totalIncome * 0.30, 300000);

        // Housing Loan Interest: max 100,000 THB
        const homeLoanVal = Math.min(parseFloat(dedHomeLoan?.value) || 0, 100000);

        // Easy E-Receipt: max 50,000 THB
        const easyEreceiptVal = Math.min(parseFloat(dedEasyEreceipt?.value) || 0, 50000);

        const subTotalDeductions = familyDeductions + socialVal + lifeHealthCombined +
                                  retirementCombined + thaiesgVal + homeLoanVal + easyEreceiptVal;

        // Income before donations
        const incomeBeforeDonations = Math.max(0, totalIncome - standardExpense - subTotalDeductions);

        // Donations: Education 2x (max 10% of remaining income)
        const rawEduDonation = parseFloat(dedDonationEdu?.value) || 0;
        const maxDonationLimit = incomeBeforeDonations * 0.10;
        const eduDonationDeductible = Math.min(rawEduDonation * 2, maxDonationLimit);

        // General donation: max remaining of 10% limit
        const remainingDonationCap = Math.max(0, maxDonationLimit - eduDonationDeductible);
        const rawGenDonation = parseFloat(dedDonationGeneral?.value) || 0;
        const genDonationDeductible = Math.min(rawGenDonation, remainingDonationCap);

        const totalDonations = eduDonationDeductible + genDonationDeductible;
        const totalAllDeductions = subTotalDeductions + totalDonations;

        // Net Taxable Income
        const netIncome = Math.max(0, incomeBeforeDonations - totalDonations);

        // Calculate Progressive Tax
        let totalTax = 0;
        let highestRate = 0;
        let breakdownHtml = '';

        BRACKETS.forEach(bracket => {
            if (netIncome > bracket.min) {
                const taxableInBracket = Math.min(netIncome, bracket.max) - bracket.min;
                const taxForBracket = taxableInBracket * bracket.rate;
                totalTax += taxForBracket;
                if (taxableInBracket > 0 && bracket.rate > highestRate) {
                    highestRate = bracket.rate;
                }

                if (taxableInBracket > 0) {
                    breakdownHtml += `
                        <div class="stat-box" style="padding: 0.5rem 0.75rem; font-size: 0.8rem;">
                            <div style="display:flex; justify-content:space-between; color: var(--text-secondary);">
                                <span>${bracket.label}</span>
                                <span style="color: var(--text-primary); font-weight: 600;">${formatNumber(taxForBracket)} บ.</span>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted);">
                                ฐานเงินได้ช่วงนี้: ${formatNumber(taxableInBracket)} บ.
                            </div>
                        </div>
                    `;
                }
            }
        });

        // Update UI
        if (resTotalIncome) resTotalIncome.textContent = formatNumber(totalIncome) + ' บาท';
        if (resTotalExpense) resTotalExpense.textContent = '-' + formatNumber(standardExpense) + ' บาท';
        if (resTotalDeduction) resTotalDeduction.textContent = '-' + formatNumber(totalAllDeductions) + ' บาท';
        if (resNetIncome) resNetIncome.textContent = formatNumber(netIncome) + ' บาท';
        if (resTaxCalculated) resTaxCalculated.textContent = formatNumber(totalTax) + ' บาท';
        if (resTaxWithholding) resTaxWithholding.textContent = formatNumber(wht) + ' บาท';
        if (resBracketRate) resBracketRate.textContent = (highestRate * 100) + '%';
        if (taxBracketBreakdown) {
            taxBracketBreakdown.innerHTML = breakdownHtml || '<div style="color:var(--text-muted); font-size:0.85rem;">ได้รับยกเว้นภาษี (เงินได้สุทธิไม่เกิน 150,000 บาท)</div>';
        }

        // Final Refund or Owe
        const difference = totalTax - wht;
        if (difference > 0) {
            if (resTaxStatusText) resTaxStatusText.textContent = 'ต้องชำระภาษีเพิ่มเติม';
            if (resTaxFinalAmount) {
                resTaxFinalAmount.textContent = formatNumber(difference) + ' บาท';
                resTaxFinalAmount.style.color = '#ef4444'; // Red
            }
        } else if (difference < 0) {
            if (resTaxStatusText) resTaxStatusText.textContent = 'ยอดที่ได้รับเงินคืนภาษี (ขอคืนได้)';
            if (resTaxFinalAmount) {
                resTaxFinalAmount.textContent = formatNumber(Math.abs(difference)) + ' บาท';
                resTaxFinalAmount.style.color = '#10b981'; // Green
            }
        } else {
            if (resTaxStatusText) resTaxStatusText.textContent = 'ไม่ต้องชำระเพิ่มและไม่มีเงินคืน';
            if (resTaxFinalAmount) {
                resTaxFinalAmount.textContent = '0 บาท';
                resTaxFinalAmount.style.color = 'var(--text-primary)';
            }
        }
    }

    // Attach event listeners
    const allInputs = document.querySelectorAll('#tax-calculator-form input');
    allInputs.forEach(input => {
        input.addEventListener('input', calculateTax);
        input.addEventListener('change', calculateTax);
    });

    // Preset buttons
    document.querySelectorAll('.btn-preset-tax').forEach(btn => {
        btn.addEventListener('click', () => {
            const salary = btn.dataset.salary || 0;
            const bonus = btn.dataset.bonus || 0;
            const wht = btn.dataset.wht || 0;

            if (incomeSalary) incomeSalary.value = salary;
            if (incomeBonus) incomeBonus.value = bonus;
            if (withholdingTax) withholdingTax.value = wht;
            calculateTax();
        });
    });

    // Initial run
    calculateTax();
});
