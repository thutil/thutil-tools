/**
 * Thai Eras Converter (พ.ศ. / ค.ศ. / ร.ศ. / จ.ศ. / ม.ศ. / ฮ.ศ.)
 */

function convertEras(year, fromSystem = 'be') {
    const val = parseInt(year, 10);
    if (isNaN(val)) return null;

    let ce = 0; // Base: Common Era (ค.ศ.)

    switch (fromSystem) {
        case 'be': // พุทธศักราช
            ce = val - 543;
            break;
        case 'ce': // คริสต์ศักราช
            ce = val;
            break;
        case 'rs': // รัตนโกสินทรศก (เริ่ม พ.ศ. 2325 = ร.ศ. 1)
            ce = val + 1781;
            break;
        case 'cs': // จุลศักราช (เริ่ม พ.ศ. 1182 = จ.ศ. 1)
            ce = val + 638;
            break;
        case 'ms': // มหาศักราช (เริ่ม พ.ศ. 622 = ม.ศ. 1)
            ce = val + 78;
            break;
    }

    const be = ce + 543;
    const rs = ce - 1781;
    const cs = ce - 638;
    const ms = ce - 78;

    // Leap year check (Common Era)
    const isLeap = (ce % 4 === 0 && ce % 100 !== 0) || (ce % 400 === 0);

    return {
        ce: ce,
        be: be,
        rs: rs > 0 ? rs : `ก่อน ร.ศ. ${Math.abs(rs) + 1}`,
        cs: cs > 0 ? cs : `ก่อน จ.ศ. ${Math.abs(cs) + 1}`,
        ms: ms > 0 ? ms : `ก่อน ม.ศ. ${Math.abs(ms) + 1}`,
        isLeap: isLeap ? 'ปีอธิกสุรทิน (มี 366 วัน, ก.พ. มี 29 วัน)' : 'ปีปกติสุรทิน (มี 365 วัน, ก.พ. มี 28 วัน)'
    };
}

document.addEventListener('DOMContentLoaded', () => {
    const inputYear = document.getElementById('era-input-year');
    const selectSystem = document.getElementById('era-select-system');

    const resBe = document.getElementById('res-era-be');
    const resCe = document.getElementById('res-era-ce');
    const resRs = document.getElementById('res-era-rs');
    const resCs = document.getElementById('res-era-cs');
    const resMs = document.getElementById('res-era-ms');
    const resLeap = document.getElementById('res-era-leap');

    function update() {
        if (!inputYear) return;
        const res = convertEras(inputYear.value, selectSystem.value);
        if (!res) return;

        if (resBe) resBe.textContent = res.be;
        if (resCe) resCe.textContent = res.ce;
        if (resRs) resRs.textContent = res.rs;
        if (resCs) resCs.textContent = res.cs;
        if (resMs) resMs.textContent = res.ms;
        if (resLeap) resLeap.textContent = res.isLeap;
    }

    if (inputYear) {
        inputYear.addEventListener('input', update);
        selectSystem.addEventListener('change', update);

        // Preset quick chips
        document.querySelectorAll('.btn-preset-era').forEach(btn => {
            btn.addEventListener('click', () => {
                inputYear.value = btn.getAttribute('data-year');
                selectSystem.value = btn.getAttribute('data-system');
                update();
            });
        });

        // Default: 2541
        inputYear.value = '2541';
        update();
    }
});
