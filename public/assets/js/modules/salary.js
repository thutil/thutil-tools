/**
 * Thai Salary, Social Security (ประกันสังคม) & Tax Calculator
 */

function calculateSalary(grossSalary, pvdPercent = 0) {
    const salary = parseFloat(grossSalary) || 0;
    const pvdRate = parseFloat(pvdPercent) || 0;

    // Social Security: 5% of base salary, capped at 15,000 THB wage base => max 750 THB/month
    const ssfWageBase = Math.min(salary, 15000);
    const ssfMonthly = Math.round(ssfWageBase * 0.05);

    // Provident Fund (PVD)
    const pvdMonthly = Math.round((salary * pvdRate) / 100);

    // Net cash before tax
    const netBeforeTax = salary - ssfMonthly - pvdMonthly;

    // Approximate Annual Tax (ภ.ง.ด. 91)
    const annualGross = salary * 12;
    const standardExpense = Math.min(annualGross * 0.5, 100000); // 50% max 100,000
    const personalDeduction = 60000; // 60,000
    const ssfAnnual = ssfMonthly * 12;
    const pvdAnnual = pvdMonthly * 12;

    const netTaxableIncome = Math.max(0, annualGross - standardExpense - personalDeduction - ssfAnnual - pvdAnnual);

    // Thai Progressive Tax Brackets
    // 0 - 150,000: 0%
    // 150,001 - 300,000: 5%
    // 300,001 - 500,000: 10%
    // 500,001 - 750,000: 15%
    // 750,001 - 1,000,000: 20%
    let annualTax = 0;
    if (netTaxableIncome > 150000) {
        if (netTaxableIncome <= 300000) {
            annualTax += (netTaxableIncome - 150000) * 0.05;
        } else if (netTaxableIncome <= 500000) {
            annualTax += (150000 * 0.05) + (netTaxableIncome - 300000) * 0.10;
        } else if (netTaxableIncome <= 750000) {
            annualTax += (150000 * 0.05) + (200000 * 0.10) + (netTaxableIncome - 500000) * 0.15;
        } else if (netTaxableIncome <= 1000000) {
            annualTax += (150000 * 0.05) + (200000 * 0.10) + (250000 * 0.15) + (netTaxableIncome - 750000) * 0.20;
        } else {
            annualTax += (150000 * 0.05) + (200000 * 0.10) + (250000 * 0.15) + (250000 * 0.20) + (netTaxableIncome - 1000000) * 0.25;
        }
    }

    const monthlyTax = Math.round(annualTax / 12);
    const netTakeHome = netBeforeTax - monthlyTax;

    return {
        grossSalary: salary,
        ssfMonthly,
        pvdMonthly,
        monthlyTax,
        netTakeHome,
        annualGross,
        netTaxableIncome,
        annualTax
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputSalary = document.getElementById('salary-input-amount');
    const inputPvd = document.getElementById('salary-input-pvd');

    const resNetTakeHome = document.getElementById('res-salary-take-home');
    const resSsf = document.getElementById('res-salary-ssf');
    const resPvd = document.getElementById('res-salary-pvd');
    const resTax = document.getElementById('res-salary-tax');
    const resAnnualTax = document.getElementById('res-salary-annual-tax');

    function update() {
        if (!inputSalary) return;
        const res = calculateSalary(inputSalary.value, inputPvd ? inputPvd.value : 0);

        if (resNetTakeHome) resNetTakeHome.textContent = `${res.netTakeHome.toLocaleString('th-TH')} บาท/เดือน`;
        if (resSsf) resSsf.textContent = `${res.ssfMonthly.toLocaleString('th-TH')} บาท`;
        if (resPvd) resPvd.textContent = `${res.pvdMonthly.toLocaleString('th-TH')} บาท`;
        if (resTax) resTax.textContent = `${res.monthlyTax.toLocaleString('th-TH')} บาท`;
        if (resAnnualTax) resAnnualTax.textContent = `${res.annualTax.toLocaleString('th-TH')} บาท/ปี`;
    }

    if (inputSalary) {
        inputSalary.addEventListener('input', update);
        if (inputPvd) inputPvd.addEventListener('change', update);

        document.querySelectorAll('.btn-preset-salary').forEach(btn => {
            btn.addEventListener('click', () => {
                inputSalary.value = btn.getAttribute('data-val');
                update();
            });
        });

        // Default: 35,000 THB
        inputSalary.value = '35000';
        update();
    }
});
