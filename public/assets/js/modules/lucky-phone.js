/**
 * Thai Lucky Phone Number Sum & Pair Analysis
 */

const LUCKY_SUM_DATABASE = {
    36: { grade: 'มงคลดีมาก (A+)', desc: 'เลขมหาเสน่ห์และโชคลาภ มีคนอุปถัมภ์ค้ำชู ค้าขายร่ำรวย เจรจาการงานสำเร็จราบรื่น เป็นที่รักของผู้ใหญ่' },
    41: { grade: 'มงคลดีมาก (A+)', desc: 'เลขคู่ปัญญานำโชค สมองปราดเปรียว มีไหวพริบ ความจำยอดเยี่ยม มีชื่อเสียงเด่นในการสอบและการศึกษา' },
    42: { grade: 'มงคลดีมาก (A+)', desc: 'เลขคู่มิตรเสน่ห์แรง ได้รับความไว้วางใจจากทุกคน เจรจาค้าขายดีเยี่ยม มีโชคลาภจากการติดต่อสื่อสาร' },
    45: { grade: 'มงคลยอดเยี่ยม (A++)', desc: 'เลขดาวพฤหัสบดีคู่ดาวพุธ เป็นยอดแห่งความสำเร็จ มั่งคั่ง มีคุณธรรม ผู้ใหญ่เอ็นดู การงานก้าวหน้ารวดเร็ว' },
    50: { grade: 'มงคลดีมาก (A+)', desc: 'เลขปัญญาสากล ชอบการเดินทาง ติดต่อต่างประเทศ ค้าขายออนไลน์ ประสบความสำเร็จในยุคดิจิทัล' },
    51: { grade: 'มงคลดีมาก (A+)', desc: 'เลขคู่ผู้บริหาร อำนาจบารมีและเสน่ห์เมตตา ทำสิ่งใดมักประสบความสำเร็จ ได้รับเกียรติยศชื่อเสียง' },
    54: { grade: 'มงคลยอดเยี่ยม (A++)', desc: 'เลขแห่งความสุขสมบูรณ์ มงคลรอบด้าน สุขภาพแข็งแรง ทรัพย์สินมั่นคง มีสิ่งศักดิ์สิทธิ์คุ้มครอง' },
    55: { grade: 'มงคลดีมาก (A+)', desc: 'เลขแห่งความเจริญก้าวหน้า มีคุณธรรม จิตใจสงบ ชีวิตราบรื่น มีผู้หลักผู้ใหญ่อุปถัมภ์ตลอดเวลา' },
    56: { grade: 'มงคลยอดเยี่ยม (A++)', desc: 'เลขขุมทรัพย์แห่งความสุข มั่งคั่งร่ำรวย ทั้งเรื่องการเงิน ความรัก และครอบครัว ไม่มีวันอับจน' },
    59: { grade: 'มงคลยอดเยี่ยม (A++)', desc: 'เลขสิ่งศักดิ์สิทธิ์คุ้มครอง มีสัมผัสพิเศษ โชคลาภลอย ปลอดภัยจากภยันตราย มีบารมีสูง' },
    63: { grade: 'มงคลดีมาก (A+)', desc: 'เลขเสน่ห์ดึงดูดทรัพย์ มีเงินทองไหลมาเทมา คนรักคนเมตตา เหมาะกับงานบริการ ศิลปะ และค้าขาย' },
    65: { grade: 'มงคลยอดเยี่ยม (A++)', desc: 'เลขคู่ทรัพย์คู่โชค ร่ำรวยมั่งคั่ง สติปัญญาเฉียบแหลม มักมีลาภลอยและการเงินหมุนเวียนคล่องตัว' }
};

const PAIR_MEANINGS = {
    '15': 'ผู้ใหญ่อุปถัมภ์ การงานก้าวหน้า',
    '24': 'เมตตามหานิยม เสน่ห์วาจา',
    '36': 'การเงินคล่อง มีโชคเรื่องความรัก',
    '42': 'เจรจาสำเร็จ ค้าขายร่ำรวย',
    '45': 'สติปัญญาเป็นเลิศ ประสบความสำเร็จสูง',
    '56': 'การเงินมั่นคง มีความสุขสมบูรณ์',
    '59': 'สิ่งศักดิ์สิทธิ์คุ้มครอง แคล้วคลาด',
    '78': 'อำนาจบารมี ดึงดูดเงินก้อนโต',
    '89': 'บารมีสูง โชคลาภไม่คาดฝัน'
};

function analyzePhoneNumber(phoneStr) {
    const digits = phoneStr.replace(/[^0-9]/g, '');
    if (digits.length !== 10) return null;

    let sum = 0;
    for (let i = 0; i < digits.length; i++) {
        sum += parseInt(digits[i], 10);
    }

    const sumData = LUCKY_SUM_DATABASE[sum] || {
        grade: sum % 2 === 0 ? 'มงคลระดับปานกลาง (B)' : 'มงคลส่งเสริมดวงชะตา (B+)',
        desc: `ผลรวมเลข ${sum} มีพลังขับเคลื่อนด้านความมุ่งมั่นและความคิดสร้างสรรค์ ส่งเสริมให้ชีวิตก้าวไปข้างหน้า`
    };

    // Analyze internal pairs (last 7 digits are most influential)
    const pairs = [];
    for (let i = 3; i < digits.length - 1; i++) {
        const pair = digits.substring(i, i + 2);
        const meaning = PAIR_MEANINGS[pair] || 'คู่เลขพลังงานหมุนเวียน';
        pairs.push({ pair, meaning });
    }

    return {
        phone: `${digits.substring(0, 3)}-${digits.substring(3, 6)}-${digits.substring(6)}`,
        sum,
        grade: sumData.grade,
        description: sumData.desc,
        pairs
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputPhone = document.getElementById('lucky-phone-input');
    const resSum = document.getElementById('res-lucky-sum');
    const resGrade = document.getElementById('res-lucky-grade');
    const resDesc = document.getElementById('res-lucky-desc');
    const pairsContainer = document.getElementById('res-lucky-pairs');

    function update() {
        if (!inputPhone) return;
        const res = analyzePhoneNumber(inputPhone.value);
        if (!res) return;

        if (resSum) resSum.textContent = res.sum;
        if (resGrade) resGrade.textContent = res.grade;
        if (resDesc) resDesc.textContent = res.description;

        if (pairsContainer) {
            pairsContainer.innerHTML = res.pairs.map(p => `
                <div class="stat-box" style="padding: 0.65rem 0.85rem;">
                    <div style="font-family: 'JetBrains Mono', monospace; font-size: 1.1rem; font-weight: 700; color: #10b981;">
                        ${p.pair}
                    </div>
                    <div style="font-size: 0.775rem; color: var(--text-secondary); margin-top: 0.15rem;">
                        ${p.meaning}
                    </div>
                </div>
            `).join('');
        }
    }

    if (inputPhone) {
        inputPhone.addEventListener('input', (e) => {
            const raw = e.target.value.replace(/[^0-9]/g, '').substring(0, 10);
            e.target.value = raw;
            update();
        });

        document.querySelectorAll('.btn-preset-phone').forEach(btn => {
            btn.addEventListener('click', () => {
                inputPhone.value = btn.getAttribute('data-phone');
                update();
            });
        });

        // Default: 0895556656 (Sum = 55)
        inputPhone.value = '0895556656';
        update();
    }
});
