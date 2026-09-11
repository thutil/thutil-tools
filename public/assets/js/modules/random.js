/**
 * Thai Random Generator: Numbers, Lucky Draw Names & Team Shuffler
 * 100% Client-side cryptographic random (window.crypto)
 */

document.addEventListener('DOMContentLoaded', () => {
    // Mode tabs
    const tabNumbers = document.getElementById('tab-rand-numbers');
    const tabNames = document.getElementById('tab-rand-names');
    const tabTeams = document.getElementById('tab-rand-teams');

    const panelNumbers = document.getElementById('panel-rand-numbers');
    const panelNames = document.getElementById('panel-rand-names');
    const panelTeams = document.getElementById('panel-rand-teams');

    function switchTab(activeTab, activePanel) {
        [tabNumbers, tabNames, tabTeams].forEach(t => t?.classList.remove('active'));
        [panelNumbers, panelNames, panelTeams].forEach(p => { if (p) p.style.display = 'none'; });

        activeTab?.classList.add('active');
        if (activePanel) activePanel.style.display = 'block';
    }

    if (tabNumbers) tabNumbers.addEventListener('click', () => switchTab(tabNumbers, panelNumbers));
    if (tabNames) tabNames.addEventListener('click', () => switchTab(tabNames, panelNames));
    if (tabTeams) tabTeams.addEventListener('click', () => switchTab(tabTeams, panelTeams));

    // Crypto Secure Random Int
    function getSecureRandomInt(min, max) {
        const range = max - min + 1;
        const array = new Uint32Array(1);
        window.crypto.getRandomValues(array);
        return min + (array[0] % range);
    }

    // --- Mode 1: Number Generator ---
    const minInput = document.getElementById('rand-num-min');
    const maxInput = document.getElementById('rand-num-max');
    const countInput = document.getElementById('rand-num-count');
    const uniqueCheck = document.getElementById('rand-num-unique');
    const sortCheck = document.getElementById('rand-num-sort');
    const btnRollNumbers = document.getElementById('btn-roll-numbers');
    const resNumbersDisplay = document.getElementById('res-numbers-display');

    function rollNumbers() {
        const min = parseInt(minInput?.value) || 1;
        const max = parseInt(maxInput?.value) || 100;
        let count = parseInt(countInput?.value) || 1;
        const isUnique = uniqueCheck ? uniqueCheck.checked : true;
        const isSort = sortCheck ? sortCheck.checked : false;

        if (min > max) {
            alert('ค่าต่ำสุดต้องไม่มากกว่าค่าสูงสุด');
            return;
        }

        const totalPossible = max - min + 1;
        if (isUnique && count > totalPossible) {
            count = totalPossible;
            if (countInput) countInput.value = count;
        }

        const results = [];
        const seen = new Set();

        while (results.length < count) {
            const num = getSecureRandomInt(min, max);
            if (isUnique) {
                if (!seen.has(num)) {
                    seen.add(num);
                    results.push(num);
                }
            } else {
                results.push(num);
            }
        }

        if (isSort) {
            results.sort((a, b) => a - b);
        }

        // Render results immediately (Zero Animation, Maximum Speed)
        renderNumbers(results);
    }

    function renderNumbers(arr) {
        if (!resNumbersDisplay) return;
        resNumbersDisplay.innerHTML = arr.map(n => `
            <div style="background: var(--bg-secondary); border: 2px solid var(--border-color); border-radius: 12px; min-width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: 700; color: #10b981; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                ${n}
            </div>
        `).join('');
    }

    if (btnRollNumbers) btnRollNumbers.addEventListener('click', rollNumbers);

    // Number Presets
    document.querySelectorAll('.btn-preset-rand').forEach(btn => {
        btn.addEventListener('click', () => {
            if (minInput) minInput.value = btn.dataset.min;
            if (maxInput) maxInput.value = btn.dataset.max;
            if (countInput) countInput.value = btn.dataset.count;
            rollNumbers();
        });
    });

    // --- Mode 2: Name Picker / Lucky Draw ---
    const namesTextarea = document.getElementById('rand-names-input');
    const winnersCountInput = document.getElementById('rand-winners-count');
    const removeWinnersCheck = document.getElementById('rand-remove-winners');
    const btnPickNames = document.getElementById('btn-pick-names');
    const resNamesDisplay = document.getElementById('res-names-display');

    function pickWinners() {
        const rawText = namesTextarea?.value || '';
        const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);

        if (names.length === 0) {
            alert('กรุณากรอกรายชื่ออย่างน้อย 1 ชื่อ (บรรทัดละ 1 ชื่อ)');
            return;
        }

        const count = Math.min(parseInt(winnersCountInput?.value) || 1, names.length);
        const shuffled = [...names].sort(() => Math.random() - 0.5);
        const winners = shuffled.slice(0, count);

        if (resNamesDisplay) {
            resNamesDisplay.innerHTML = winners.map((w, idx) => `
                <div style="background: var(--bg-secondary); border: 1px solid #10b981; border-radius: 8px; padding: 0.75rem 1rem; display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem; animation: fadeIn 0.3s ease;">
                    <span style="font-weight: 600; color: var(--text-primary);">ผู้โชคดีคนที่ ${idx + 1}: <strong style="color: #10b981; font-size: 1.1rem;">${w}</strong></span>
                    <span class="tag-badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">ได้รับรางวัล</span>
                </div>
            `).join('');
        }

        // If remove winners is checked
        if (removeWinnersCheck && removeWinnersCheck.checked && namesTextarea) {
            const remaining = names.filter(n => !winners.includes(n));
            namesTextarea.value = remaining.join('\n');
        }
    }

    if (btnPickNames) btnPickNames.addEventListener('click', pickWinners);

    // --- Mode 3: Team Shuffler ---
    const teamNamesInput = document.getElementById('team-names-input');
    const teamCountInput = document.getElementById('team-count-input');
    const btnShuffleTeams = document.getElementById('btn-shuffle-teams');
    const resTeamsDisplay = document.getElementById('res-teams-display');

    function shuffleTeams() {
        const rawText = teamNamesInput?.value || '';
        const members = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);

        if (members.length === 0) {
            alert('กรุณากรอกรายชื่อสมาชิกอย่างน้อย 2 คน');
            return;
        }

        const numTeams = Math.max(2, parseInt(teamCountInput?.value) || 2);
        const shuffled = [...members].sort(() => Math.random() - 0.5);

        const teams = Array.from({ length: numTeams }, () => []);
        shuffled.forEach((member, index) => {
            teams[index % numTeams].push(member);
        });

        if (resTeamsDisplay) {
            resTeamsDisplay.innerHTML = teams.map((team, idx) => `
                <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.85rem; margin-bottom: 0.75rem;">
                    <div style="font-weight: 700; color: #3b82f6; margin-bottom: 0.4rem;">กลุ่มที่ ${idx + 1} (${team.length} คน)</div>
                    <div style="font-size: 0.875rem; color: var(--text-primary); line-height: 1.5;">
                        ${team.join(', ')}
                    </div>
                </div>
            `).join('');
        }
    }

    if (btnShuffleTeams) btnShuffleTeams.addEventListener('click', shuffleTeams);

    // --- Focus Presenter Mode ---
    const modal = document.getElementById('focus-presenter-modal');
    const btnOpenFocus = document.getElementById('btn-open-focus-mode');
    const btnCloseFocus = document.getElementById('btn-close-focus');
    const btnFocusRoll = document.getElementById('btn-focus-roll');
    const focusMainResult = document.getElementById('focus-main-result');
    const focusSubTitle = document.getElementById('focus-sub-title');
    const focusMetaText = document.getElementById('focus-meta-text');
    const focusTabNumbers = document.getElementById('focus-tab-numbers');
    const focusTabNames = document.getElementById('focus-tab-names');
    const focusConfigNumbers = document.getElementById('focus-config-numbers');
    const focusConfigNames = document.getElementById('focus-config-names');
    const focusHistoryItems = document.getElementById('focus-history-items');
    const focusLblMin = document.getElementById('focus-lbl-min');
    const focusLblMax = document.getElementById('focus-lbl-max');
    const focusLblCount = document.getElementById('focus-lbl-count');
    const focusLblNamesCount = document.getElementById('focus-lbl-names-count');

    let focusMode = 'numbers';
    const focusHistory = [];

    function updateFocusConfigLabels() {
        if (focusLblMin) focusLblMin.textContent = minInput?.value || '1';
        if (focusLblMax) focusLblMax.textContent = maxInput?.value || '100';
        if (focusLblCount) focusLblCount.textContent = countInput?.value || '1';
        
        const rawText = namesTextarea?.value || '';
        const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);
        if (focusLblNamesCount) focusLblNamesCount.textContent = names.length;
    }

    function openFocusMode() {
        if (!modal) return;
        modal.style.display = 'flex';
        updateFocusConfigLabels();
        document.body.style.overflow = 'hidden';
    }

    function closeFocusMode() {
        if (!modal) return;
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function addFocusHistory(itemText) {
        focusHistory.unshift(itemText);
        if (focusHistory.length > 12) focusHistory.pop();
        if (focusHistoryItems) {
            focusHistoryItems.innerHTML = focusHistory.map(h => `<span class="focus-history-pill">${h}</span>`).join('');
        }
    }

    function triggerFocusRoll() {
        if (focusMode === 'numbers') {
            const min = parseInt(minInput?.value) || 1;
            const max = parseInt(maxInput?.value) || 100;
            const count = parseInt(countInput?.value) || 1;
            const isUnique = uniqueCheck ? uniqueCheck.checked : true;
            const isSort = sortCheck ? sortCheck.checked : false;

            if (min > max) {
                alert('ค่าต่ำสุดต้องไม่มากกว่าค่าสูงสุด');
                return;
            }

            const results = [];
            const seen = new Set();
            const totalPossible = max - min + 1;
            const actualCount = isUnique ? Math.min(count, totalPossible) : count;

            while (results.length < actualCount) {
                const num = getSecureRandomInt(min, max);
                if (isUnique) {
                    if (!seen.has(num)) {
                        seen.add(num);
                        results.push(num);
                    }
                } else {
                    results.push(num);
                }
            }

            if (isSort) results.sort((a, b) => a - b);

            const resultText = results.join(' • ');
            if (focusMainResult) {
                focusMainResult.textContent = resultText;
            }
            if (focusSubTitle) focusSubTitle.textContent = `ตัวเลขที่สุ่มได้ (ช่วง ${min} - ${max})`;
            if (focusMetaText) focusMetaText.textContent = `สุ่มสำเร็จเมื่อเวลา ${new Date().toLocaleTimeString('th-TH')}`;
            addFocusHistory(resultText);

            renderNumbers(results);
        } else {
            const rawText = namesTextarea?.value || '';
            const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);

            if (names.length === 0) {
                alert('ยังไม่มีรายชื่อผู้เข้าร่วมจับฉลาก กรุณาปิดหน้านี้แล้วกรอกรายชื่อก่อน');
                return;
            }

            const count = Math.min(parseInt(winnersCountInput?.value) || 1, names.length);
            const shuffled = [...names].sort(() => Math.random() - 0.5);
            const winners = shuffled.slice(0, count);

            const resultText = winners.join(', ');
            if (focusMainResult) {
                focusMainResult.textContent = resultText;
            }
            if (focusSubTitle) focusSubTitle.textContent = `🎉 ผู้ได้รับรางวัล (${winners.length} คน)`;
            if (focusMetaText) focusMetaText.textContent = `ขอแสดงความยินดีด้วยครับ! (เวลา ${new Date().toLocaleTimeString('th-TH')})`;
            winners.forEach(w => addFocusHistory(w));

            pickWinners();
            updateFocusConfigLabels();
        }
    }

    if (btnOpenFocus) btnOpenFocus.addEventListener('click', openFocusMode);
    if (btnCloseFocus) btnCloseFocus.addEventListener('click', closeFocusMode);
    if (btnFocusRoll) btnFocusRoll.addEventListener('click', triggerFocusRoll);

    if (focusTabNumbers) {
        focusTabNumbers.addEventListener('click', () => {
            focusMode = 'numbers';
            focusTabNumbers.classList.add('active');
            if (focusTabNames) focusTabNames.classList.remove('active');
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'flex';
            if (focusConfigNames) focusConfigNames.style.display = 'none';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดสุ่มตัวเลข (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = 'READY';
        });
    }

    if (focusTabNames) {
        focusTabNames.addEventListener('click', () => {
            focusMode = 'names';
            focusTabNames.classList.add('active');
            if (focusTabNumbers) focusTabNumbers.classList.remove('active');
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'none';
            if (focusConfigNames) focusConfigNames.style.display = 'flex';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดสุ่มรายชื่อผู้โชคดี (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = 'READY';
            updateFocusConfigLabels();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (modal && modal.style.display === 'flex') {
            if (e.key === 'Escape') {
                closeFocusMode();
            } else if (e.code === 'Space' || e.key === 'Enter') {
                e.preventDefault();
                triggerFocusRoll();
            }
        }
    });

    // Initial roll
    rollNumbers();
});
