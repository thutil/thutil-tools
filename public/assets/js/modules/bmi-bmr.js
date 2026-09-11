/**
 * Thai Body Mass Index (BMI) & Basal Metabolic Rate (BMR / TDEE) Calculator
 * Asia-Pacific Criteria (Department of Health Thailand / WHO Asia)
 * Mifflin-St Jeor BMR Equation
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inputs
    const genderMale = document.getElementById('bmi-gender-male');
    const genderFemale = document.getElementById('bmi-gender-female');
    const ageInput = document.getElementById('bmi-age-input');
    const heightInput = document.getElementById('bmi-height-input');
    const weightInput = document.getElementById('bmi-weight-input');
    const activitySelect = document.getElementById('bmi-activity-select');

    // Outputs
    const resBmiVal = document.getElementById('res-bmi-val');
    const resBmiStatus = document.getElementById('res-bmi-status');
    const resBmiBar = document.getElementById('res-bmi-bar-pointer');
    const resIdealWeight = document.getElementById('res-ideal-weight');
    const resBmr = document.getElementById('res-bmr-val');
    const resTdee = document.getElementById('res-tdee-val');
    const resCalLose = document.getElementById('res-cal-lose');
    const resCalMaintain = document.getElementById('res-cal-maintain');
    const resCalGain = document.getElementById('res-cal-gain');

    function calculateHealth() {
        const isMale = genderMale ? genderMale.checked : true;
        const age = parseFloat(ageInput?.value) || 28;
        const height = parseFloat(heightInput?.value) || 170; // cm
        const weight = parseFloat(weightInput?.value) || 65; // kg
        const activityMultiplier = parseFloat(activitySelect?.value) || 1.2;

        if (height <= 0 || weight <= 0) return;

        // BMI
        const heightM = height / 100;
        const bmi = weight / (heightM * heightM);

        // Ideal weight for Thai (18.5 - 22.9)
        const idealMin = 18.5 * (heightM * heightM);
        const idealMax = 22.9 * (heightM * heightM);

        // BMI category
        let statusText = '';
        let statusColor = '';
        let pointerPercent = 50;

        if (bmi < 18.5) {
            statusText = 'ผอม / น้ำหนักน้อยกว่าเกณฑ์';
            statusColor = '#3b82f6'; // Blue
            pointerPercent = Math.max(5, (bmi / 18.5) * 20);
        } else if (bmi <= 22.9) {
            statusText = 'ปกติ / สมส่วน (สุขภาพดี)';
            statusColor = '#10b981'; // Green
            pointerPercent = 20 + ((bmi - 18.5) / (22.9 - 18.5)) * 30;
        } else if (bmi <= 24.9) {
            statusText = 'ท้วม / น้ำหนักเกิน (เริ่มเสี่ยง)';
            statusColor = '#f59e0b'; // Amber
            pointerPercent = 50 + ((bmi - 23.0) / (24.9 - 23.0)) * 15;
        } else if (bmi <= 29.9) {
            statusText = 'อ้วนระดับ 1 (เสี่ยงโรค)';
            statusColor = '#f97316'; // Orange
            pointerPercent = 65 + ((bmi - 25.0) / (29.9 - 25.0)) * 20;
        } else {
            statusText = 'อ้วนระดับ 2 (อันตรายมาก)';
            statusColor = '#ef4444'; // Red
            pointerPercent = Math.min(95, 85 + ((bmi - 30.0) / 10) * 15);
        }

        // BMR (Mifflin-St Jeor)
        let bmr = 0;
        if (isMale) {
            bmr = (10 * weight) + (6.25 * height) - (5 * age) + 5;
        } else {
            bmr = (10 * weight) + (6.25 * height) - (5 * age) - 161;
        }

        // TDEE
        const tdee = bmr * activityMultiplier;

        // Calorie suggestions
        const calLose = Math.max(1200, Math.round(tdee - 500));
        const calMaintain = Math.round(tdee);
        const calGain = Math.round(tdee + 500);

        // Update UI
        if (resBmiVal) resBmiVal.textContent = bmi.toFixed(1);
        if (resBmiStatus) {
            resBmiStatus.textContent = statusText;
            resBmiStatus.style.color = statusColor;
        }
        if (resBmiBar) {
            resBmiBar.style.left = `${pointerPercent}%`;
            resBmiBar.style.backgroundColor = statusColor;
        }
        if (resIdealWeight) {
            resIdealWeight.textContent = `${idealMin.toFixed(1)} - ${idealMax.toFixed(1)} กก.`;
        }
        if (resBmr) resBmr.textContent = Math.round(bmr).toLocaleString('th-TH') + ' kcal/วัน';
        if (resTdee) resTdee.textContent = Math.round(tdee).toLocaleString('th-TH') + ' kcal/วัน';
        if (resCalLose) resCalLose.textContent = calLose.toLocaleString('th-TH') + ' kcal';
        if (resCalMaintain) resCalMaintain.textContent = calMaintain.toLocaleString('th-TH') + ' kcal';
        if (resCalGain) resCalGain.textContent = calGain.toLocaleString('th-TH') + ' kcal';
    }

    // Event listeners
    [genderMale, genderFemale, ageInput, heightInput, weightInput, activitySelect].forEach(el => {
        if (el) {
            el.addEventListener('input', calculateHealth);
            el.addEventListener('change', calculateHealth);
        }
    });

    // Preset buttons
    document.querySelectorAll('.btn-preset-bmi').forEach(btn => {
        btn.addEventListener('click', () => {
            const h = btn.dataset.h;
            const w = btn.dataset.w;
            const a = btn.dataset.a;
            const g = btn.dataset.g;

            if (heightInput) heightInput.value = h;
            if (weightInput) weightInput.value = w;
            if (ageInput) ageInput.value = a;
            if (g === 'f' && genderFemale) genderFemale.checked = true;
            if (g === 'm' && genderMale) genderMale.checked = true;

            calculateHealth();
        });
    });

    calculateHealth();
});
