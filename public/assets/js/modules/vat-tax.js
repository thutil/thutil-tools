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

    // Attach Report Exporter
    if (window.ReportExporter) {
        window.ReportExporter.attachDropdown('#export-dropdown-vat-tax', () => {
            const raw = amountInput ? amountInput.value.replace(/,/g, '') : '0';
            const vatMode = vatModeSelect ? vatModeSelect.value : 'exclude';
            const whtRate = whtRateSelect ? whtRateSelect.value : '3';

            const res = calculateVatAndTax(raw, vatMode, whtRate);

            let vatModeLabel = 'ไม่รวมภาษีมูลค่าเพิ่ม (Exclude VAT)';
            if (vatMode === 'include') vatModeLabel = 'ราคารวมภาษีมูลค่าเพิ่มแล้ว (Include VAT)';
            else if (vatMode === 'none') vatModeLabel = 'ไม่มีภาษีมูลค่าเพิ่ม (No VAT)';

            const summaryRows = [
                ['--- สรุปการคำนวณภาษีมูลค่าเพิ่มและภาษีหัก ณ ที่จ่าย ---', ''],
                ['ยอดเงินต้นทางที่ระบุ (บาท)', parseFloat(raw) || 0],
                ['รูปแบบภาษีมูลค่าเพิ่ม', vatModeLabel],
                ['อัตราภาษีหัก ณ ที่จ่าย (%)', `${res.whtRate}%`],
                ['มูลค่าสินค้า/บริการก่อน VAT (บาท)', res.baseAmount],
                ['ภาษีมูลค่าเพิ่ม VAT 7% (บาท)', res.vatAmount],
                ['ยอดรวมก่อนหัก ณ ที่จ่าย (บาท)', res.grossTotal],
                ['ภาษีหัก ณ ที่จ่ายที่ต้องนำส่งสรรพากร (บาท)', res.whtAmount],
                ['ยอดเงินจ่ายให้ผู้รับสุทธิ Net Payable (บาท)', res.netPayable],
                []
            ];

            // Comparative table for all standard WHT rates
            const whtTable = [
                ['--- ตารางเปรียบเทียบภาษีหัก ณ ที่จ่ายตามประเภทเงินได้ ---', '', '', ''],
                ['ประเภทรายการเงินได้', 'อัตรา (%)', 'ภาษีหัก ณ ที่จ่าย (บาท)', 'ยอดจ่ายสุทธิ Net Payable (บาท)'],
                ['ไม่มีการหัก ณ ที่จ่าย (0%)', '0%', 0, res.grossTotal],
                ['ค่าขนส่ง (1%)', '1%', Math.round(res.baseAmount * 0.01 * 100) / 100, Math.round((res.grossTotal - res.baseAmount * 0.01) * 100) / 100],
                ['ค่าโฆษณา (2%)', '2%', Math.round(res.baseAmount * 0.02 * 100) / 100, Math.round((res.grossTotal - res.baseAmount * 0.02) * 100) / 100],
                ['ค่าบริการ / จ้างทำของ / ฟรีแลนซ์ (3%)', '3%', Math.round(res.baseAmount * 0.03 * 100) / 100, Math.round((res.grossTotal - res.baseAmount * 0.03) * 100) / 100],
                ['ค่าเช่าทรัพย์สิน / รางวัล (5%)', '5%', Math.round(res.baseAmount * 0.05 * 100) / 100, Math.round((res.grossTotal - res.baseAmount * 0.05) * 100) / 100]
            ];

            const allRows = [
                ...summaryRows,
                ...whtTable
            ];

            return {
                title: 'รายงานคำนวณภาษีมูลค่าเพิ่ม (VAT 7%) และภาษีหัก ณ ที่จ่าย',
                filename: `vat-wht-report-${Date.now()}`,
                rows: allRows,
                sheets: {
                    'สรุป VAT และหัก ณ ที่จ่าย': allRows
                }
            };
        });
    }
});
