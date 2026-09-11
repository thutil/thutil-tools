/**
 * Thai Word & Character Counter
 * Uses browser native Intl.Segmenter for accurate Thai word segmentation
 */

function countThaiText(text) {
    if (!text) {
        return {
            words: 0,
            charsWithSpaces: 0,
            charsNoSpaces: 0,
            consonants: 0,
            vowelsTones: 0,
            lines: 0,
            readingTimeMinutes: 0
        };
    }

    const charsWithSpaces = text.length;
    const charsNoSpaces = text.replace(/\s/g, '').length;
    const lines = text.split(/\r\n|\r|\n/).length;

    // Count Thai consonants (ก-ฮ: 0x0E01 - 0x0E2E)
    let consonants = 0;
    let vowelsTones = 0;

    for (let i = 0; i < text.length; i++) {
        const code = text.charCodeAt(i);
        if (code >= 0x0E01 && code <= 0x0E2E) {
            consonants++;
        } else if ((code >= 0x0E30 && code <= 0x0E3A) || (code >= 0x0E47 && code <= 0x0E4E)) {
            vowelsTones++;
        }
    }

    // Word Count with Intl.Segmenter (Thai word break dictionary)
    let words = 0;
    if (typeof Intl !== 'undefined' && Intl.Segmenter) {
        const segmenter = new Intl.Segmenter('th', { granularity: 'word' });
        const segments = segmenter.segment(text);
        for (const seg of segments) {
            if (seg.isWordLike) {
                words++;
            }
        }
    } else {
        // Fallback simple regex count
        words = text.trim().split(/\s+/).length;
    }

    // Average reading speed in Thai: ~200 words per minute
    const readingTimeMinutes = Math.max(1, Math.ceil(words / 200));

    return {
        words,
        charsWithSpaces,
        charsNoSpaces,
        consonants,
        vowelsTones,
        lines,
        readingTimeMinutes
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputContent = document.getElementById('word-count-input');
    const resWords = document.getElementById('res-count-words');
    const resCharsWithSpace = document.getElementById('res-count-chars-space');
    const resCharsNoSpace = document.getElementById('res-count-chars-nospace');
    const resConsonants = document.getElementById('res-count-consonants');
    const resVowels = document.getElementById('res-count-vowels');
    const resLines = document.getElementById('res-count-lines');
    const resReadTime = document.getElementById('res-count-read-time');

    function update() {
        if (!inputContent) return;
        const res = countThaiText(inputContent.value);

        if (resWords) resWords.textContent = res.words.toLocaleString('th-TH');
        if (resCharsWithSpace) resCharsWithSpace.textContent = res.charsWithSpaces.toLocaleString('th-TH');
        if (resCharsNoSpace) resCharsNoSpace.textContent = res.charsNoSpaces.toLocaleString('th-TH');
        if (resConsonants) resConsonants.textContent = res.consonants.toLocaleString('th-TH');
        if (resVowels) resVowels.textContent = res.vowelsTones.toLocaleString('th-TH');
        if (resLines) resLines.textContent = res.lines.toLocaleString('th-TH');
        if (resReadTime) resReadTime.textContent = `~ ${res.readingTimeMinutes} นาที`;
    }

    if (inputContent) {
        inputContent.addEventListener('input', update);
        // Default text
        inputContent.value = 'thutil คือศูนย์รวมเครื่องมือและโปรเจกต์โอเพนซอร์สสำหรับคนไทย พัฒนาขึ้นเพื่อช่วยอำนวยความสะดวกในการใช้งานประจำวัน';
        update();
    }
});
