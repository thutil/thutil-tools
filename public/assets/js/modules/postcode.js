/**
 * Thai Postcode & Administrative Boundary Lookup
 */

const THAI_POSTCODES_DB = [
    { postcode: '10100', subdistrict: 'ป้อมปราบ, วัดเทพศิรินทร์', district: 'ป้อมปราบศัตรูพ่าย', province: 'กรุงเทพมหานคร' },
    { postcode: '10110', subdistrict: 'คลองตัน, คลองเตย, พระโขนง', district: 'คลองเตย', province: 'กรุงเทพมหานคร' },
    { postcode: '10120', subdistrict: 'บางโคล่, บางคอแหลม, ยานนาวา', district: 'บางคอแหลม / สาทร', province: 'กรุงเทพมหานคร' },
    { postcode: '10200', subdistrict: 'พระบรมมหาราชวัง, ศาลเจ้าพ่อเสือ', district: 'พระนคร', province: 'กรุงเทพมหานคร' },
    { postcode: '10310', subdistrict: 'วังทองหลาง, สะพานสอง', district: 'วังทองหลาง', province: 'กรุงเทพมหานคร' },
    { postcode: '10330', subdistrict: 'ปทุมวัน, รองเมือง, ลุมพินี', district: 'ปทุมวัน', province: 'กรุงเทพมหานคร' },
    { postcode: '10400', subdistrict: 'พญาไท, สามเสนใน, มักกะสัน', district: 'พญาไท / ราชเทวี', province: 'กรุงเทพมหานคร' },
    { postcode: '10500', subdistrict: 'สี่พระยา, บางรัก, สีลม, สุริยวงศ์', district: 'บางรัก', province: 'กรุงเทพมหานคร' },
    { postcode: '10900', subdistrict: 'ลาดยาว, เสนานิคม, จันทรเกษม', district: 'จตุจักร', province: 'กรุงเทพมหานคร' },
    { postcode: '11000', subdistrict: 'ตลาดขวัญ, ท่าทราย, บางเขน', district: 'เมืองนนทบุรี', province: 'นนทบุรี' },
    { postcode: '11120', subdistrict: 'ปากเกร็ด, บางพูด, คลองเกลือ', district: 'ปากเกร็ด', province: 'นนทบุรี' },
    { postcode: '12000', subdistrict: 'บางปรอก, บ้านกลาง, บ้านใหม่', district: 'เมืองปทุมธานี', province: 'ปทุมธานี' },
    { postcode: '12120', subdistrict: 'คลองหนึ่ง, คลองสอง (รังสิต)', district: 'คลองหลวง', province: 'ปทุมธานี' },
    { postcode: '10540', subdistrict: 'บางพลีใหญ่, บางแก้ว, ราชาเทวะ', district: 'บางพลี', province: 'สมุทรปราการ' },
    { postcode: '10270', subdistrict: 'ปากน้ำ, สำโรงเหนือ, บางเมือง', district: 'เมืองสมุทรปราการ', province: 'สมุทรปราการ' },
    { postcode: '20000', subdistrict: 'บางปลาสร้อย, บ้านสวน, แสนสุข (บางแสน)', district: 'เมืองชลบุรี', province: 'ชลบุรี' },
    { postcode: '20150', subdistrict: 'หนองปรือ, นาเกลือ (พัทยา)', district: 'บางละมุง', province: 'ชลบุรี' },
    { postcode: '50000', subdistrict: 'ศรีภูมิ, พระสิงห์, ช้างม่อย', district: 'เมืองเชียงใหม่', province: 'เชียงใหม่' },
    { postcode: '50200', subdistrict: 'สุเทพ, ช้างเผือก, แม่เหียะ', district: 'เมืองเชียงใหม่', province: 'เชียงใหม่' },
    { postcode: '40000', subdistrict: 'ในเมือง, ศิลา, บ้านเป็ด', district: 'เมืองขอนแก่น', province: 'ขอนแก่น' },
    { postcode: '30000', subdistrict: 'ในเมือง, โพธิ์กลาง, หนองจะบก', district: 'เมืองนครราชสีมา', province: 'นครราชสีมา' },
    { postcode: '90110', subdistrict: 'หาดใหญ่, คอหงส์, คลองแห', district: 'หาดใหญ่', province: 'สงขลา' },
    { postcode: '83000', subdistrict: 'ตลาดใหญ่, ตลาดเหนือ, เกาะแก้ว', district: 'เมืองภูเก็ต', province: 'ภูเก็ต' },
    { postcode: '83150', subdistrict: 'ป่าตอง, กะทู้, กมลา', district: 'กะทู้', province: 'ภูเก็ต' }
];

document.addEventListener('DOMContentLoaded', () => {
    const inputSearch = document.getElementById('postcode-input-query');
    const resultList = document.getElementById('postcode-results-list');
    const resultCount = document.getElementById('postcode-result-count');

    function searchPostcode() {
        if (!inputSearch || !resultList) return;
        const q = inputSearch.value.trim().toLowerCase();

        const filtered = THAI_POSTCODES_DB.filter(item => {
            return item.postcode.includes(q) ||
                   item.subdistrict.toLowerCase().includes(q) ||
                   item.district.toLowerCase().includes(q) ||
                   item.province.toLowerCase().includes(q);
        });

        if (resultCount) {
            resultCount.textContent = `พบ ${filtered.length} รายการ`;
        }

        if (filtered.length === 0) {
            resultList.innerHTML = '<div style="padding: 1.5rem; text-align: center; color: var(--text-muted);">ไม่พบข้อมูลที่ค้นหา ลองกรอกรหัสไปรษณีย์ 5 หลัก หรือชื่อตำบล/อำเภอ</div>';
            return;
        }

        resultList.innerHTML = filtered.map(item => `
            <div class="stat-box" style="margin-bottom: 0.75rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
                <div>
                    <div style="font-weight: 700; font-size: 1.15rem; color: var(--text-primary); font-family: 'JetBrains Mono', monospace;">
                        ${item.postcode}
                    </div>
                    <div style="font-size: 0.85rem; color: var(--text-secondary); margin-top: 0.2rem;">
                        ต.${item.subdistrict} อ.${item.district} จ.${item.province}
                    </div>
                </div>
                <button type="button" class="btn-copy" onclick="navigator.clipboard.writeText('${item.postcode}').then(() => alert('คัดลอกรหัส ${item.postcode} แล้ว'))">
                    คัดลอกรหัส
                </button>
            </div>
        `).join('');
    }

    if (inputSearch) {
        inputSearch.addEventListener('input', searchPostcode);
        searchPostcode();
    }
});
