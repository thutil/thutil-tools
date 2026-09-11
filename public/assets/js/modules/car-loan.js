/**
 * Thai Car & Motorcycle Loan Installment Calculator
 * Flat Rate Interest & VAT 7%
 */

function calculateCarLoan(price, downVal, isDownPercent, flatRateAnnual, months) {
    const carPrice = parseFloat(price) || 0;
    const rate = parseFloat(flatRateAnnual) || 0;
    const termMonths = parseInt(months, 10) || 48;

    let downAmount = 0;
    if (isDownPercent) {
        downAmount = (carPrice * parseFloat(downVal)) / 100;
    } else {
        downAmount = parseFloat(downVal) || 0;
    }

    const loanAmount = Math.max(0, carPrice - downAmount);
    const years = termMonths / 12;

    // Total interest = Loan * (Rate / 100) * Years
    const totalInterest = loanAmount * (rate / 100) * years;
    const totalDebt = loanAmount + totalInterest;

    // Monthly installment before VAT
    const monthlyExVat = termMonths > 0 ? totalDebt / termMonths : 0;
    const vatMonthly = monthlyExVat * 0.07;
    const monthlyIncVat = monthlyExVat + vatMonthly;

    // Total contract amount (including VAT)
    const totalVat = vatMonthly * termMonths;
    const totalPayableContract = totalDebt + totalVat;

    // Approximate Effective Interest Rate (ลดต้นลดดอก ~ Flat rate * 1.8)
    const effectiveRate = rate * 1.82;

    return {
        carPrice,
        downAmount,
        downPercent: carPrice > 0 ? Math.round((downAmount / carPrice) * 100) : 0,
        loanAmount,
        totalInterest,
        monthlyExVat: Math.round(monthlyExVat * 100) / 100,
        vatMonthly: Math.round(vatMonthly * 100) / 100,
        monthlyIncVat: Math.round(monthlyIncVat * 100) / 100,
        totalPayableContract: Math.round(totalPayableContract * 100) / 100,
        effectiveRate: Math.round(effectiveRate * 100) / 100
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputPrice = document.getElementById('car-price-input');
    const inputDown = document.getElementById('car-down-input');
    const selectDownType = document.getElementById('car-down-type');
    const inputRate = document.getElementById('car-rate-input');
    const selectMonths = document.getElementById('car-term-months');

    const resMonthly = document.getElementById('res-car-monthly');
    const resLoan = document.getElementById('res-car-loan');
    const resDown = document.getElementById('res-car-down');
    const resInterest = document.getElementById('res-car-interest');
    const resVatMonthly = document.getElementById('res-car-vat-monthly');
    const resEffective = document.getElementById('res-car-effective-rate');

    function update() {
        if (!inputPrice || !inputDown || !inputRate || !selectMonths) return;

        const res = calculateCarLoan(
            inputPrice.value,
            inputDown.value,
            selectDownType.value === 'percent',
            inputRate.value,
            selectMonths.value
        );

        if (resMonthly) resMonthly.textContent = `${res.monthlyIncVat.toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท/เดือน`;
        if (resLoan) resLoan.textContent = `${res.loanAmount.toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท`;
        if (resDown) resDown.textContent = `${res.downAmount.toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท (${res.downPercent}%)`;
        if (resInterest) resInterest.textContent = `${res.totalInterest.toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท`;
        if (resVatMonthly) resVatMonthly.textContent = `${res.vatMonthly.toLocaleString('th-TH', { minimumFractionDigits: 2 })} บาท/เดือน`;
        if (resEffective) resEffective.textContent = `~ ${res.effectiveRate}% ต่อปี`;
    }

    [inputPrice, inputDown, inputRate].forEach(el => {
        if (el) el.addEventListener('input', update);
    });
    if (selectDownType) selectDownType.addEventListener('change', update);
    if (selectMonths) selectMonths.addEventListener('change', update);

    // Preset chips
    document.querySelectorAll('.btn-preset-car').forEach(btn => {
        btn.addEventListener('click', () => {
            inputPrice.value = btn.getAttribute('data-price');
            inputDown.value = btn.getAttribute('data-down');
            selectDownType.value = 'percent';
            inputRate.value = btn.getAttribute('data-rate');
            selectMonths.value = btn.getAttribute('data-months');
            update();
        });
    });

    // Default: Price 800,000, Down 20%, Rate 2.5%, 60 months
    if (inputPrice) {
        inputPrice.value = '800000';
        inputDown.value = '20';
        inputRate.value = '2.49';
        if (selectMonths) selectMonths.value = '60';
        update();
    }
});
