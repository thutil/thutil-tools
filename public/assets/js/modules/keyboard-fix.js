/**
 * Thai-English Keyboard Typo Fixer (Kedmanee Layout)
 * แก้ปัญหาลืมเปลี่ยนภาษา เช่น g-hk -> สวัสดี
 */

const EN_KEYS = "`1234567890-=~!@#$%^&*()_+qwertyuiop[]\\QWERTYUIOP{}|asdfghjkl;'ASDFGHJKL:\"zxcvbnm,./ZXCVBNM<>?";
const TH_KEYS = "_ๅ/-ภถุึคตจขช%+๑๒๓๔ู฿๕๖๗๘๙ๆไำพะัีรนยบลฃ๐\"ฤฆฏโฌ็เ้ฮศซ)ฟหกดเ้่าสวงผปแอรนยบลฦฟหกดเ้่าสวงผปแอรนยบล?ผปแอร์มใฝ()ฉฮฺ์?ฒฬฦ";

// Full Kedmanee Mapping
const MAP_EN_TO_TH = {
    '`': '_', '~': '%',
    '1': 'ๅ', '!': '+',
    '2': '/', '@': '๑',
    '3': '-', '#': '๒',
    '4': 'ภ', '$': '๓',
    '5': 'ถ', '%': '๔',
    '6': 'ุ', '^': 'ู',
    '7': 'ึ', '&': '฿',
    '8': 'ค', '*': '๕',
    '9': 'ต', '(': '๖',
    '0': 'จ', ')': '๗',
    '-': 'ข', '_': '๘',
    '=': 'ช', '+': '๙',
    'q': 'ๆ', 'Q': '๐',
    'w': 'ไ', 'W': '"',
    'e': 'ำ', 'E': 'ฎ',
    'r': 'พ', 'R': 'ฑ',
    't': 'ะ', 'T': 'ธ',
    'y': 'ั', 'Y': 'ํ',
    'u': 'ี', 'U': '๊',
    'i': 'ร', 'I': 'ณ',
    'o': 'น', 'O': 'ฯ',
    'p': 'ย', 'P': 'ญ',
    '[': 'บ', '{': 'ฐ',
    ']': 'ล', '}': ',',
    '\\': 'ฃ', '|': 'ฅ',
    'a': 'ฟ', 'A': 'ฤ',
    's': 'ห', 'S': 'ฆ',
    'd': 'ก', 'D': 'ฏ',
    'f': 'ด', 'F': 'โ',
    'g': 'เ', 'G': 'ฌ',
    'h': '้', 'H': '็',
    'j': '่', 'J': '๋',
    'k': 'า', 'K': 'ษ',
    'l': 'ส', 'L': 'ศ',
    ';': 'ว', ':': 'ซ',
    "'": 'ง', '"': '.',
    'z': 'ผ', 'Z': '(',
    'x': 'ป', 'X': ')',
    'c': 'แ', 'C': 'ฉ',
    'v': 'อ', 'V': 'ฮ',
    'b': 'ิ', 'B': 'ฺ',
    'n': 'ื', 'N': '์',
    'm': 'ท', 'M': '?',
    ',': 'ม', '<': 'ฒ',
    '.': 'ใ', '>': 'ฬ',
    '/': 'ฝ', '?': 'ฦ'
};

// Invert mapping for TH to EN
const MAP_TH_TO_EN = {};
for (const [en, th] of Object.entries(MAP_EN_TO_TH)) {
    MAP_TH_TO_EN[th] = en;
}

function convertTypoText(text, direction = 'auto') {
    if (!text) return '';

    // Auto detect: check if text has more Thai or English characters
    let thCount = 0;
    let enCount = 0;
    for (let i = 0; i < text.length; i++) {
        const code = text.charCodeAt(i);
        if (code >= 0x0E00 && code <= 0x0E7F) {
            thCount++;
        } else if ((code >= 65 && code <= 90) || (code >= 97 && code <= 122)) {
            enCount++;
        }
    }

    const mode = direction !== 'auto' ? direction : (thCount >= enCount ? 'th2en' : 'en2th');
    const mapping = mode === 'en2th' ? MAP_EN_TO_TH : MAP_TH_TO_EN;

    let res = '';
    for (let i = 0; i < text.length; i++) {
        const ch = text[i];
        res += mapping[ch] !== undefined ? mapping[ch] : ch;
    }

    return {
        converted: res,
        detectedMode: mode === 'en2th' ? 'อังกฤษ -> ไทย' : 'ไทย -> อังกฤษ'
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputTypo = document.getElementById('typo-input-text');
    const outputTypo = document.getElementById('typo-output-text');
    const badgeDirection = document.getElementById('typo-direction-badge');
    const btnCopy = document.getElementById('btn-copy-typo');

    function update() {
        if (!inputTypo || !outputTypo) return;
        const raw = inputTypo.value;
        if (!raw) {
            outputTypo.textContent = 'ข้อความที่แปลงจะปรากฏที่นี่...';
            if (badgeDirection) badgeDirection.textContent = 'ตรวจจับอัตโนมัติ';
            return;
        }

        const res = convertTypoText(raw, 'auto');
        outputTypo.textContent = res.converted;
        if (badgeDirection) badgeDirection.textContent = res.detectedMode;
    }

    if (inputTypo) {
        inputTypo.addEventListener('input', update);

        document.querySelectorAll('.btn-preset-typo').forEach(btn => {
            btn.addEventListener('click', () => {
                inputTypo.value = btn.getAttribute('data-text');
                update();
            });
        });

        // Default sample: g-hk (สวัสดี)
        inputTypo.value = 'g-hk9nvd';
        update();
    }

    if (btnCopy && outputTypo) {
        btnCopy.addEventListener('click', () => {
            const text = outputTypo.textContent.trim();
            if (text && text !== 'ข้อความที่แปลงจะปรากฏที่นี่...') {
                navigator.clipboard.writeText(text).then(() => {
                    const orig = btnCopy.innerHTML;
                    btnCopy.innerHTML = '✓ คัดลอกแล้ว';
                    setTimeout(() => { btnCopy.innerHTML = orig; }, 1800);
                });
            }
        });
    }
});
