/**
 * EAN-13 Thai Product Barcode Generator (Country Code 885)
 */

// EAN-13 Encoding Tables (L, G, R code patterns)
const EAN_L = ["0001101", "0011001", "0010011", "0111101", "0100011", "0110001", "0101111", "0111011", "0110111", "0001011"];
const EAN_G = ["0100111", "0110011", "0011011", "0100001", "0011101", "0111001", "0000101", "0010001", "0001001", "0010111"];
const EAN_R = ["1110010", "1100110", "1101100", "1000010", "1011100", "1001110", "1010000", "1000100", "1001000", "1110100"];

const FIRST_DIGIT_ENCODINGS = [
    "LLLLLL", "LLGLGG", "LLGGLG", "LLGGGL", "LGLLGG",
    "LGGLLG", "LGGGLL", "LGLGLG", "LGLGGL", "LGGLGL"
];

function calculateEan13Checksum(code12) {
    let sum = 0;
    for (let i = 0; i < 12; i++) {
        const digit = parseInt(code12[i], 10);
        sum += (i % 2 === 0) ? digit : digit * 3;
    }
    const rem = sum % 10;
    return rem === 0 ? 0 : 10 - rem;
}

function generateEan13Binary(code13) {
    const first = parseInt(code13[0], 10);
    const pattern = FIRST_DIGIT_ENCODINGS[first];

    let bits = "101"; // Left Guard

    // First 6 digits (indexes 1 to 6)
    for (let i = 0; i < 6; i++) {
        const digit = parseInt(code13[i + 1], 10);
        const type = pattern[i];
        bits += (type === 'L') ? EAN_L[digit] : EAN_G[digit];
    }

    bits += "01010"; // Center Guard

    // Last 6 digits (indexes 7 to 12)
    for (let i = 6; i < 12; i++) {
        const digit = parseInt(code13[i + 1], 10);
        bits += EAN_R[digit];
    }

    bits += "101"; // Right Guard
    return bits;
}

function renderBarcodeSvg(svgElem, code13) {
    const bits = generateEan13Binary(code13);
    const barWidth = 3;
    const height = 100;
    const totalWidth = bits.length * barWidth + 40;

    let rects = '';
    let x = 20;

    for (let i = 0; i < bits.length; i++) {
        if (bits[i] === '1') {
            const isGuard = (i < 3) || (i >= 45 && i < 50) || (i >= 92);
            const barH = isGuard ? height : height - 14;
            rects += `<rect x="${x}" y="10" width="${barWidth}" height="${barH}" fill="#09090b" />`;
        }
        x += barWidth;
    }

    // Numbers display below bars
    const textPart1 = code13.substring(0, 1);
    const textPart2 = code13.substring(1, 7);
    const textPart3 = code13.substring(7, 13);

    const textSvg = `
        <text x="8" y="${height + 8}" font-family="JetBrains Mono, monospace" font-size="14" fill="#09090b">${textPart1}</text>
        <text x="50" y="${height + 8}" font-family="JetBrains Mono, monospace" font-size="14" letter-spacing="3" fill="#09090b">${textPart2}</text>
        <text x="185" y="${height + 8}" font-family="JetBrains Mono, monospace" font-size="14" letter-spacing="3" fill="#09090b">${textPart3}</text>
    `;

    svgElem.setAttribute('viewBox', `0 0 ${totalWidth} ${height + 25}`);
    svgElem.innerHTML = `<rect width="100%" height="100%" fill="#ffffff" rx="8" />` + rects + textSvg;
}

document.addEventListener('DOMContentLoaded', () => {
    const inputCode = document.getElementById('barcode-input-number');
    const svgElem = document.getElementById('barcode-svg');
    const checksumDisplay = document.getElementById('barcode-checksum-display');
    const btnDownload = document.getElementById('btn-download-barcode-svg');

    function update() {
        if (!inputCode || !svgElem) return;
        const raw = inputCode.value.replace(/[^0-9]/g, '');
        if (raw.length < 12) return;

        const code12 = raw.substring(0, 12);
        const check = calculateEan13Checksum(code12);
        const full13 = code12 + check;

        if (checksumDisplay) {
            checksumDisplay.textContent = `รหัสเต็ม 13 หลัก: ${full13} (Check Digit: ${check})`;
        }

        renderBarcodeSvg(svgElem, full13);
    }

    if (inputCode) {
        inputCode.addEventListener('input', update);
        // Default sample: 885123456789 (Thai product code 885)
        inputCode.value = '885123456789';
        update();
    }

    if (btnDownload && svgElem) {
        btnDownload.addEventListener('click', () => {
            const svgData = new XMLSerializer().serializeToString(svgElem);
            const blob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `EAN13-885-barcode-${Date.now()}.svg`;
            link.click();
        });
    }
});
