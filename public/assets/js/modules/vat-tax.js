/**
 * Thai VAT 7% & Withholding Tax (WHT) Calculator
 */

function calculateVatAndTax(amount, vatMode, whtRate) {
    const num = parseFloat(amount) || 0;
    const wht = parseFloat(whtRate) || 0;

    let baseAmount = 0;
    let vatAmount = 0;
    let grossTotal = 0;

    if (vatMode === 'include') {
        // Amount includes 7% VAT
        baseAmount = (num * 100) / 107;
        vatAmount = (num * 7) / 107;
        grossTotal = num;
    } else if (vatMode === 'exclude') {
        // Amount excludes VAT
        baseAmount = num;
        vatAmount = num * 0.07;
        grossTotal = num + vatAmount;
    } else {
        // No VAT
        baseAmount = num;
        vatAmount = 0;
        grossTotal = num;
    }

    // Withholding tax is calculated on the base amount before VAT
    const whtAmount = (baseAmount * wht) / 100;
    const netPayable = grossTotal - whtAmount;

    return {
        baseAmount: Math.round(baseAmount * 100) / 100,
        vatAmount: Math.round(vatAmount * 100) / 100,
        grossTotal: Math.round(grossTotal * 100) / 100,
        whtRate: wht,
        whtAmount: Math.round(whtAmount * 100) / 100,
        netPayable: Math.round(netPayable * 100) / 100
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const amountInput = document.getElementById('tax-amount-input');
    const vatModeSelect = document.getElementById('tax-vat-mode');
    const whtRateSelect = document.getElementById('tax-wht-rate');

    const resBase = document.getElementById('res-tax-base');
    const resVat = document.getElementById('res-tax-vat');
    const resGross = document.getElementById('res-tax-gross');
    const resWht = document.getElementById('res-tax-wht');
    const resNet = document.getElementById('res-tax-net');

    function updateCalculations() {
        if (!amountInput) return;
        const raw = amountInput.value.replace(/,/g, '');
        const vatMode = vatModeSelect.value;
        const whtRate = whtRateSelect.value;

        const res = calculateVatAndTax(raw, vatMode, whtRate);

        if (resBase) resBase.textContent = res.baseAmount.toLocaleString('th-TH', { minimumFractionDigits: 2 }) + ' บาท';
        if (resVat) resVat.textContent = res.vatAmount.toLocaleString('th-TH', { minimumFractionDigits: 2 }) + ' บาท';
        if (resGross) resGross.textContent = res.grossTotal.toLocaleString('th-TH', { minimumFractionDigits: 2 }) + ' บาท';
        if (resWht) resWht.textContent = res.whtAmount.toLocaleString('th-TH', { minimumFractionDigits: 2 }) + ' บาท';
        if (resNet) resNet.textContent = res.netPayable.toLocaleString('th-TH', { minimumFractionDigits: 2 }) + ' บาท';
    }

    if (amountInput) {
        amountInput.addEventListener('input', updateCalculations);
        vatModeSelect.addEventListener('change', updateCalculations);
        whtRateSelect.addEventListener('change', updateCalculations);

        // Preset buttons
        document.querySelectorAll('.btn-preset-tax').forEach(btn => {
            btn.addEventListener('click', () => {
                amountInput.value = btn.getAttribute('data-amount');
                updateCalculations();
            });
        });

        // Initialize default: 10,000 THB
        amountInput.value = '10000';
        updateCalculations();
    }
});
