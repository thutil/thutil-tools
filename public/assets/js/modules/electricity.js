/**
 * Thai Electricity Bill & Appliance Consumption Calculator
 * Tariff Type 1.1 & 1.2 (MEA & PEA) with dynamic Ft and VAT 7%
 * Zero Storage Privacy-First
 */

document.addEventListener('DOMContentLoaded', () => {
    // Mode toggle: Bill Units vs Appliance Calculator
    const tabBill = document.getElementById('tab-mode-bill');
    const tabAppliance = document.getElementById('tab-mode-appliance');
    const panelBill = document.getElementById('panel-mode-bill');
    const panelAppliance = document.getElementById('panel-mode-appliance');

    if (tabBill && tabAppliance) {
        tabBill.addEventListener('click', () => {
            tabBill.classList.add('active');
            tabAppliance.classList.remove('active');
            if (panelBill) panelBill.style.display = 'block';
            if (panelAppliance) panelAppliance.style.display = 'none';
        });

        tabAppliance.addEventListener('click', () => {
            tabAppliance.classList.add('active');
            tabBill.classList.remove('active');
            if (panelBill) panelBill.style.display = 'none';
            if (panelAppliance) panelAppliance.style.display = 'block';
        });
    }

    // Bill Mode Inputs
    const unitsInput = document.getElementById('elec-units-input');
    const tariffTypeSelect = document.getElementById('elec-tariff-type');
    const ftRateInput = document.getElementById('elec-ft-rate');

    // Outputs
    const resTotalBill = document.getElementById('res-elec-total-bill');
    const resEnergyCharge = document.getElementById('res-elec-energy-charge');
    const resServiceFee = document.getElementById('res-elec-service-fee');
    const resFtCharge = document.getElementById('res-elec-ft-charge');
    const resVat = document.getElementById('res-elec-vat');
    const resAvgUnitCost = document.getElementById('res-elec-avg-cost');

    function calculateBaseEnergyCharge(units, type) {
        let charge = 0;
        if (type === '1.1') {
            // Residential <= 150 kWh
            const tiers = [
                { limit: 15, rate: 2.3488 },
                { limit: 10, rate: 2.9882 },
                { limit: 10, rate: 3.2405 },
                { limit: 65, rate: 3.6237 },
                { limit: 50, rate: 3.7171 },
                { limit: 250, rate: 4.2218 },
                { limit: Infinity, rate: 4.4217 }
            ];
            let remaining = units;
            for (const tier of tiers) {
                if (remaining <= 0) break;
                const take = Math.min(remaining, tier.limit);
                charge += take * tier.rate;
                remaining -= take;
            }
        } else {
            // Residential > 150 kWh (Type 1.2)
            const tiers = [
                { limit: 150, rate: 3.2484 },
                { limit: 250, rate: 4.2218 },
                { limit: Infinity, rate: 4.4217 }
            ];
            let remaining = units;
            for (const tier of tiers) {
                if (remaining <= 0) break;
                const take = Math.min(remaining, tier.limit);
                charge += take * tier.rate;
                remaining -= take;
            }
        }
        return charge;
    }

    function calculateBill() {
        const units = Math.max(0, parseFloat(unitsInput?.value) || 0);
        const type = tariffTypeSelect?.value || '1.2';
        const ftRate = parseFloat(ftRateInput?.value) || 0.3972;

        const baseEnergy = calculateBaseEnergyCharge(units, type);
        const serviceFee = (type === '1.1') ? 8.19 : 24.62;
        const ftCharge = units * ftRate;
        const subtotal = baseEnergy + serviceFee + ftCharge;
        const vat = subtotal * 0.07;
        const total = subtotal + vat;
        const avgCost = units > 0 ? (total / units) : 0;

        if (resTotalBill) resTotalBill.textContent = total.toLocaleString('th-TH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' บาท';
        if (resEnergyCharge) resEnergyCharge.textContent = baseEnergy.toLocaleString('th-TH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' บาท';
        if (resServiceFee) resServiceFee.textContent = serviceFee.toFixed(2) + ' บาท';
        if (resFtCharge) resFtCharge.textContent = ftCharge.toLocaleString('th-TH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' บาท';
        if (resVat) resVat.textContent = vat.toLocaleString('th-TH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' บาท';
        if (resAvgUnitCost) resAvgUnitCost.textContent = avgCost.toFixed(2) + ' บาท/หน่วย';
    }

    // Appliance Mode Logic
    const appType = document.getElementById('app-select-type');
    const appWatts = document.getElementById('app-watts-input');
    const appHours = document.getElementById('app-hours-input');
    const appCount = document.getElementById('app-count-input');
    const resAppDailyKwh = document.getElementById('res-app-daily-kwh');
    const resAppMonthlyKwh = document.getElementById('res-app-monthly-kwh');
    const resAppDailyCost = document.getElementById('res-app-daily-cost');
    const resAppMonthlyCost = document.getElementById('res-app-monthly-cost');

    if (appType && appWatts) {
        appType.addEventListener('change', () => {
            const selectedVal = appType.value;
            if (selectedVal !== 'custom') {
                appWatts.value = selectedVal;
            }
            calculateAppliance();
        });
    }

    function calculateAppliance() {
        const watts = parseFloat(appWatts?.value) || 0;
        const hours = parseFloat(appHours?.value) || 0;
        const count = parseFloat(appCount?.value) || 1;

        // Daily kWh = (Watts * Hours * Count) / 1000
        const dailyKwh = (watts * hours * count) / 1000;
        const monthlyKwh = dailyKwh * 30;

        // Estimated average electricity rate in Thailand ~ 4.70 THB / kWh (incl. Ft + VAT)
        const avgRate = 4.70;
        const dailyCost = dailyKwh * avgRate;
        const monthlyCost = monthlyKwh * avgRate;

        if (resAppDailyKwh) resAppDailyKwh.textContent = dailyKwh.toFixed(2) + ' หน่วย (kWh)';
        if (resAppMonthlyKwh) resAppMonthlyKwh.textContent = monthlyKwh.toFixed(1) + ' หน่วย (kWh)';
        if (resAppDailyCost) resAppDailyCost.textContent = dailyCost.toFixed(2) + ' บาท/วัน';
        if (resAppMonthlyCost) resAppMonthlyCost.textContent = monthlyCost.toLocaleString('th-TH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' บาท/เดือน';
    }

    // Attach listeners
    if (unitsInput) unitsInput.addEventListener('input', calculateBill);
    if (tariffTypeSelect) tariffTypeSelect.addEventListener('change', calculateBill);
    if (ftRateInput) ftRateInput.addEventListener('input', calculateBill);

    if (appWatts) appWatts.addEventListener('input', calculateAppliance);
    if (appHours) appHours.addEventListener('input', calculateAppliance);
    if (appCount) appCount.addEventListener('input', calculateAppliance);

    // Bill preset buttons
    document.querySelectorAll('.btn-preset-elec').forEach(btn => {
        btn.addEventListener('click', () => {
            if (unitsInput) unitsInput.value = btn.dataset.units;
            calculateBill();
        });
    });

    // Initial calculations
    calculateBill();
    calculateAppliance();
});
