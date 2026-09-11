/**
 * Thai National Citizen ID Validator & Formatter
 * Standard 13-digit checksum algorithm: Modulo 11
 */

function validateThaiId(idStr) {
    const cleanId = String(idStr).replace(/[^0-9]/g, '');
    if (cleanId.length !== 13) {
        return { valid: false, message: 'เลขประจำตัวประชาชนต้องมี 13 หลัก' };
    }

    // First digit cannot be 0
    if (cleanId.charAt(0) === '0') {
        return { valid: false, message: 'หลักแรกต้องไม่เป็นเลข 0' };
    }

    let sum = 0;
    for (let i = 0; i < 12; i++) {
        sum += parseInt(cleanId.charAt(i), 10) * (13 - i);
    }

    const checkDigit = (11 - (sum % 11)) % 10;
    const lastDigit = parseInt(cleanId.charAt(12), 10);

    if (checkDigit === lastDigit) {
        return {
            valid: true,
            message: 'เลขบัตรประชาชนถูกต้องตามหลักคณิตศาสตร์ตรวจสอบ (Checksum Passed)',
            cleanId: cleanId,
            formatted: formatThaiId(cleanId)
        };
    } else {
        return {
            valid: false,
            message: `เลขตรวจสอบตัวสุดท้ายไม่ถูกต้อง (คำนวณได้ ${checkDigit} แต่กรอก ${lastDigit})`,
            cleanId: cleanId,
            expectedCheckDigit: checkDigit
        };
    }
}

function formatThaiId(raw) {
    const clean = String(raw).replace(/[^0-9]/g, '');
    let res = '';
    if (clean.length > 0) res += clean.substring(0, 1);
    if (clean.length > 1) res += '-' + clean.substring(1, 5);
    if (clean.length > 5) res += '-' + clean.substring(5, 10);
    if (clean.length > 10) res += '-' + clean.substring(10, 12);
    if (clean.length > 12) res += '-' + clean.substring(12, 13);
    return res;
}

/**
 * Generates a valid Thai citizen ID for testing purposes
 */
function generateRandomValidThaiId() {
    // Random first 12 digits (first digit 1-8)
    const firstDigit = Math.floor(Math.random() * 8) + 1;
    let id = String(firstDigit);
    for (let i = 0; i < 11; i++) {
        id += Math.floor(Math.random() * 10);
    }

    let sum = 0;
    for (let i = 0; i < 12; i++) {
        sum += parseInt(id.charAt(i), 10) * (13 - i);
    }

    const checkDigit = (11 - (sum % 11)) % 10;
    id += String(checkDigit);
    return id;
}

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('thai-id-input');
    const resultBox = document.getElementById('thai-id-result');
    const statusBadge = document.getElementById('thai-id-status-badge');
    const formattedDisplay = document.getElementById('thai-id-formatted-display');
    const btnGenerate = document.getElementById('btn-generate-thai-id');
    const btnCopy = document.getElementById('btn-copy-thai-id');

    function checkCurrentId() {
        if (!input) return;
        const val = input.value.trim();
        if (!val) {
            if (resultBox) resultBox.textContent = 'กรุณากรอกเลขบัตรประชาชน 13 หลัก';
            if (statusBadge) {
                statusBadge.textContent = 'รอการกรอก';
                statusBadge.style.backgroundColor = 'var(--bg-subtle)';
                statusBadge.style.color = 'var(--text-muted)';
            }
            if (formattedDisplay) formattedDisplay.textContent = '-';
            return;
        }

        const res = validateThaiId(val);
        if (formattedDisplay) {
            formattedDisplay.textContent = formatThaiId(val);
        }

        if (res.valid) {
            if (resultBox) {
                resultBox.innerHTML = `<strong>ถูกต้อง</strong>: ${res.message}`;
            }
            if (statusBadge) {
                statusBadge.textContent = '✓ ถูกต้อง';
                statusBadge.style.backgroundColor = 'var(--accent-black)';
                statusBadge.style.color = 'var(--bg-surface)';
            }
        } else {
            if (resultBox) {
                resultBox.innerHTML = `<strong>ไม่ถูกต้อง</strong>: ${res.message}`;
            }
            if (statusBadge) {
                statusBadge.textContent = '✕ ไม่ถูกต้อง';
                statusBadge.style.backgroundColor = 'var(--bg-subtle)';
                statusBadge.style.color = 'var(--text-primary)';
            }
        }
    }

    if (input) {
        input.addEventListener('input', (e) => {
            // Auto format visually while typing
            const raw = e.target.value.replace(/[^0-9]/g, '').substring(0, 13);
            e.target.value = formatThaiId(raw);
            checkCurrentId();
        });

        // Set sample default
        input.value = formatThaiId('1100400000000');
        checkCurrentId();
    }

    if (btnGenerate && input) {
        btnGenerate.addEventListener('click', () => {
            const randomId = generateRandomValidThaiId();
            input.value = formatThaiId(randomId);
            checkCurrentId();
        });
    }

    if (btnCopy && input) {
        btnCopy.addEventListener('click', () => {
            const clean = input.value.replace(/[^0-9]/g, '');
            if (clean) {
                navigator.clipboard.writeText(clean).then(() => {
                    const orig = btnCopy.innerHTML;
                    btnCopy.innerHTML = '✓ คัดลอกแล้ว';
                    setTimeout(() => { btnCopy.innerHTML = orig; }, 1800);
                });
            }
        });
    }
});
