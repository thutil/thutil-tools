/**
 * Thai Mock Data Generator for Developers
 */

const THAI_FIRSTNAMES_MALE = [
    'สมชาย', 'กิตติพงษ์', 'ธนากร', 'ธีรภัทร', 'วรวุฒิ', 'ศุภชัย', 'อนุชา',
    'ปิยะ', 'ณัฐวุฒิ', 'ชัชชัย', 'ธนพล', 'ภาณุพงศ์', 'อภิสิทธิ์', 'กิตติศักดิ์'
];

const THAI_FIRSTNAMES_FEMALE = [
    'ศศิธร', 'กัญญาณัฐ', 'พรทิพย์', 'พิมพ์ชนก', 'กนกวรรณ', 'ชลธิชา', 'วรรณภา',
    'นภัสสร', 'จิราภรณ์', 'สุภาพร', 'รัตนาภรณ์', 'อัจฉรา', 'ปรียานุช', 'ดวงใจ'
];

const THAI_LASTNAMES = [
    'สุขสมบูรณ์', 'เจริญสุข', 'รุ่งเรือง', 'รัตนวิชัย', 'ทองแท้', 'พงษ์พาณิชย์',
    'วงศ์สว่าง', 'ศิริวัฒน์', 'ชัยชนะ', 'มั่นคง', 'สมบัติบริบูรณ์', 'อินทร์จันทร์',
    'บุญมี', 'วัฒนพาณิชย์', 'เกษมสุข'
];

const THAI_ADDRESSES = [
    { subdistrict: 'บางรัก', district: 'บางรัก', province: 'กรุงเทพมหานคร', postcode: '10500' },
    { subdistrict: 'คลองตัน', district: 'คลองเตย', province: 'กรุงเทพมหานคร', postcode: '10110' },
    { subdistrict: 'ตลาดขวัญ', district: 'เมืองนนทบุรี', province: 'นนทบุรี', postcode: '11000' },
    { subdistrict: 'บางแก้ว', district: 'บางพลี', province: 'สมุทรปราการ', postcode: '10540' },
    { subdistrict: 'ช้างเผือก', district: 'เมืองเชียงใหม่', province: 'เชียงใหม่', postcode: '50300' },
    { subdistrict: 'ในเมือง', district: 'เมืองขอนแก่น', province: 'ขอนแก่น', postcode: '40000' },
    { subdistrict: 'หาดใหญ่', district: 'หาดใหญ่', province: 'สงขลา', postcode: '90110' }
];

function randomChoice(arr) {
    return arr[Math.floor(Math.random() * arr.length)];
}

function generateThaiMockRecord(gender = 'any') {
    let chosenGender = gender;
    if (gender === 'any') {
        chosenGender = Math.random() > 0.5 ? 'male' : 'female';
    }

    const firstName = chosenGender === 'male' 
        ? randomChoice(THAI_FIRSTNAMES_MALE) 
        : randomChoice(THAI_FIRSTNAMES_FEMALE);

    const lastName = randomChoice(THAI_LASTNAMES);
    const id = generateRandomValidThaiId();
    const formattedId = formatThaiId(id);

    // Thai Mobile Phone
    const prefixes = ['08', '09', '06'];
    const phone = randomChoice(prefixes) + Math.floor(10000000 + Math.random() * 90000000);
    const formattedPhone = `${phone.substring(0, 3)}-${phone.substring(3, 6)}-${phone.substring(6, 10)}`;

    const addr = randomChoice(THAI_ADDRESSES);
    const houseNo = `${Math.floor(Math.random() * 200) + 1}/${Math.floor(Math.random() * 20) + 1}`;
    const fullAddress = `เลขที่ ${houseNo} ต.${addr.subdistrict} อ.${addr.district} จ.${addr.province} ${addr.postcode}`;

    return {
        gender: chosenGender === 'male' ? 'ชาย' : 'หญิง',
        name: `${firstName} ${lastName}`,
        firstName: firstName,
        lastName: lastName,
        citizenId: id,
        formattedId: formattedId,
        phone: formattedPhone,
        address: fullAddress,
        province: addr.province,
        postcode: addr.postcode
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const btnGenerate = document.getElementById('btn-generate-mock');
    const genderSelect = document.getElementById('mock-gender-select');
    const countInput = document.getElementById('mock-count-input');
    const resultOutput = document.getElementById('mock-json-output');
    const previewCards = document.getElementById('mock-preview-cards');

    function runGeneration() {
        if (!countInput) return;
        const count = Math.min(Math.max(parseInt(countInput.value, 10) || 1, 1), 50);
        const gender = genderSelect ? genderSelect.value : 'any';

        const list = [];
        for (let i = 0; i < count; i++) {
            list.push(generateThaiMockRecord(gender));
        }

        if (resultOutput) {
            resultOutput.textContent = JSON.stringify(list, null, 2);
        }

        if (previewCards) {
            previewCards.innerHTML = '';
            list.slice(0, 4).forEach((item, idx) => {
                const card = document.createElement('div');
                card.className = 'panel-card';
                card.style.padding = '1rem';
                card.style.marginBottom = '0.75rem';
                card.innerHTML = `
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.4rem;">
                        <strong style="font-size: 1.05rem;">${item.name}</strong>
                        <span class="tag-badge">${item.gender}</span>
                    </div>
                    <div style="font-size: 0.825rem; color: var(--text-secondary); line-height: 1.6;">
                        <div>เลขประจำตัว: <code>${item.formattedId}</code></div>
                        <div>เบอร์โทร: <code>${item.phone}</code></div>
                        <div>ที่อยู่: ${item.address}</div>
                    </div>
                `;
                previewCards.appendChild(card);
            });
        }
    }

    if (btnGenerate) {
        btnGenerate.addEventListener('click', runGeneration);
        runGeneration();
    }

    const btnCopyJson = document.getElementById('btn-copy-mock-json');
    if (btnCopyJson && resultOutput) {
        btnCopyJson.addEventListener('click', () => {
            navigator.clipboard.writeText(resultOutput.textContent).then(() => {
                const orig = btnCopyJson.innerHTML;
                btnCopyJson.innerHTML = '✓ คัดลอกแล้ว';
                setTimeout(() => { btnCopyJson.innerHTML = orig; }, 1800);
            });
        });
    }
});
