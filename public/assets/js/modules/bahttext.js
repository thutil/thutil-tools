/**
 * Thai Baht Text & Number to Words Converter
 * Converts numeric values into official Thai words (Baht currency & standard numeric reading)
 */

const THAI_DIGITS = ['ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
const THAI_POSITIONS = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];

/**
 * Converts integer string of up to 7 digits into Thai words
 */
function convertGroupOfSix(numberStr) {
    const len = numberStr.length;
    let text = '';

    for (let i = 0; i < len; i++) {
        const digit = parseInt(numberStr.charAt(i), 10);
        const pos = len - i - 1;

        if (digit === 0) continue;

        if (pos === 1) { // หลักสิบ
            if (digit === 1) {
                text += 'สิบ';
            } else if (digit === 2) {
                text += 'ยี่สิบ';
            } else {
                text += THAI_DIGITS[digit] + 'สิบ';
            }
        } else if (pos === 0) { // หลักหน่วย
            if (digit === 1 && len > 1 && parseInt(numberStr.charAt(len - 2), 10) !== 0) {
                text += 'เอ็ด';
            } else {
                text += THAI_DIGITS[digit];
            }
        } else {
            text += THAI_DIGITS[digit] + THAI_POSITIONS[pos];
        }
    }

    return text;
}

/**
 * Converts any positive integer string into Thai words (handles multi-millions)
 */
function convertIntegerToThaiWords(intStr) {
    if (!intStr || intStr === '0') return 'ศูนย์';

    // Split into groups of 6 digits from right to left
    let result = '';
    let remaining = intStr;
    let groupIndex = 0;

    while (remaining.length > 0) {
        const chunkLen = remaining.length % 6 || 6;
        const chunk = remaining.substring(0, chunkLen);
        remaining = remaining.substring(chunkLen);

        const groupWords = convertGroupOfSix(chunk);
        if (groupWords.length > 0) {
            result += groupWords;
            if (remaining.length > 0) {
                result += 'ล้าน';
            }
        }
    }

    return result || 'ศูนย์';
}

/**
 * Converts a number to official Thai Baht text (เช่น "หนึ่งพันสองร้อยบาทถ้วน")
 */
function toBahtText(val) {
    if (val === null || val === undefined || val === '') return '';

    // Clean input string
    let cleanVal = String(val).replace(/,/g, '').trim();
    if (isNaN(Number(cleanVal))) return 'รูปแบบตัวเลขไม่ถูกต้อง';

    const isNegative = cleanVal.startsWith('-');
    if (isNegative) cleanVal = cleanVal.substring(1);

    // Split integer and decimal parts
    const parts = cleanVal.split('.');
    let intPart = parts[0] || '0';
    let decPart = parts.length > 1 ? parts[1].substring(0, 2) : '';

    // Pad decimal to 2 places
    if (decPart.length === 1) decPart += '0';

    // Rounding check if more than 2 decimal digits
    if (parts.length > 1 && parts[1].length > 2) {
        const roundNum = Math.round(Number('0.' + parts[1]) * 100);
        if (roundNum === 100) {
            intPart = (BigInt(intPart) + 1n).toString();
            decPart = '00';
        } else {
            decPart = String(roundNum).padStart(2, '0');
        }
    }

    let result = '';
    const intNum = BigInt(intPart || '0');
    const satangNum = decPart ? parseInt(decPart, 10) : 0;

    if (intNum === 0n && satangNum === 0) {
        return 'ศูนย์บาทถ้วน';
    }

    if (intNum > 0n) {
        result += convertIntegerToThaiWords(intPart) + 'บาท';
    }

    if (satangNum > 0) {
        result += convertGroupOfSix(String(satangNum)) + 'สตางค์';
    } else {
        result += 'ถ้วน';
    }

    if (isNegative) {
        result = 'ลบ' + result;
    }

    return result;
}

/**
 * Converts a number to standard spoken Thai words (เช่น 1200 -> "หนึ่งพันสองร้อย")
 */
function toNumberWords(val) {
    if (val === null || val === undefined || val === '') return '';
    let cleanVal = String(val).replace(/,/g, '').trim();
    if (isNaN(Number(cleanVal))) return 'รูปแบบตัวเลขไม่ถูกต้อง';

    const isNegative = cleanVal.startsWith('-');
    if (isNegative) cleanVal = cleanVal.substring(1);

    const parts = cleanVal.split('.');
    const intPart = parts[0] || '0';
    let result = convertIntegerToThaiWords(intPart);

    if (parts.length > 1 && parts[1].length > 0) {
        result += 'จุด';
        for (let i = 0; i < parts[1].length; i++) {
            const digit = parseInt(parts[1].charAt(i), 10);
            result += THAI_DIGITS[digit];
        }
    }

    if (isNegative) {
        result = 'ลบ' + result;
    }

    return result;
}

// UI Initialization
document.addEventListener('DOMContentLoaded', () => {
    const numInput = document.getElementById('bahttext-number-input');
    const outputCurrency = document.getElementById('output-currency-text');
    const outputGeneral = document.getElementById('output-general-text');
    const formattedDisplay = document.getElementById('formatted-number-display');

    function updateOutputs() {
        if (!numInput) return;
        const raw = numInput.value;
        if (!raw || raw.trim() === '') {
            if (outputCurrency) outputCurrency.textContent = '-';
            if (outputGeneral) outputGeneral.textContent = '-';
            if (formattedDisplay) formattedDisplay.textContent = '-';
            return;
        }

        const bahtResult = toBahtText(raw);
        const generalResult = toNumberWords(raw);

        if (outputCurrency) outputCurrency.textContent = bahtResult;
        if (outputGeneral) outputGeneral.textContent = generalResult;

        // Formatted display with commas
        const clean = raw.replace(/,/g, '').trim();
        if (!isNaN(Number(clean))) {
            const parts = clean.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            if (formattedDisplay) formattedDisplay.textContent = parts.join('.');
        }
    }

    if (numInput) {
        numInput.addEventListener('input', updateOutputs);
        // Default example: 1200
        numInput.value = '1200';
        updateOutputs();
    }

    // Copy buttons
    document.querySelectorAll('.btn-copy[data-target]').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const targetElem = document.getElementById(targetId);
            if (!targetElem) return;

            const textToCopy = targetElem.textContent.trim();
            if (textToCopy && textToCopy !== '-') {
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const origText = btn.innerHTML;
                    btn.innerHTML = '✓ คัดลอกแล้ว';
                    setTimeout(() => {
                        btn.innerHTML = origText;
                    }, 1800);
                });
            }
        });
    });

    // Preset quick buttons
    document.querySelectorAll('.btn-preset-number').forEach(btn => {
        btn.addEventListener('click', () => {
            if (numInput) {
                numInput.value = btn.getAttribute('data-val');
                updateOutputs();
            }
        });
    });
});
