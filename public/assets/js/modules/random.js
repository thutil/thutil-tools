/**
 * Thai Random Generator: Lucky Spin Wheel in Focus Mode, Cryptographic Numbers, Names & Fireworks
 * 100% Client-Side with Web Audio API Synthesizer & Canvas Particle Engine
 * Strict Rule: Pure SVG Icons, Zero Emojis
 */

document.addEventListener('DOMContentLoaded', () => {
    // =========================================================================
    // 1. WEB AUDIO API SYNTHESIZER (ZERO EXTERNAL MP3s)
    // =========================================================================
    const AudioCtxClass = window.AudioContext || window.webkitAudioContext;
    let audioCtx = null;
    let isSoundOn = localStorage.getItem('thutil_random_sound') !== 'false';

    const btnToggleSound = document.getElementById('btn-toggle-sound');
    const soundIconContainer = document.getElementById('sound-icon-container');
    const soundLabel = document.getElementById('sound-label');

    const SVG_SOUND_ON = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path>
        </svg>
    `;
    const SVG_SOUND_OFF = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
            <line x1="23" y1="9" x2="17" y2="15"></line>
            <line x1="17" y1="9" x2="23" y2="15"></line>
        </svg>
    `;

    function updateSoundBtnUI() {
        if (soundIconContainer) {
            soundIconContainer.innerHTML = isSoundOn ? SVG_SOUND_ON : SVG_SOUND_OFF;
        }
        if (soundLabel) {
            soundLabel.textContent = isSoundOn ? 'เสียง: เปิด' : 'เสียง: ปิด';
        }
    }
    updateSoundBtnUI();

    if (btnToggleSound) {
        btnToggleSound.addEventListener('click', () => {
            isSoundOn = !isSoundOn;
            localStorage.setItem('thutil_random_sound', isSoundOn ? 'true' : 'false');
            updateSoundBtnUI();
            if (isSoundOn) playTickSound();
        });
    }

    function initAudio() {
        if (!audioCtx && AudioCtxClass) {
            audioCtx = new AudioCtxClass();
        }
        if (audioCtx && audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
    }

    // Ticking sound when wheel passes a slice
    function playTickSound() {
        if (!isSoundOn) return;
        try {
            initAudio();
            if (!audioCtx) return;
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'triangle';
            osc.frequency.setValueAtTime(820, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(140, audioCtx.currentTime + 0.035);
            gain.gain.setValueAtTime(0.18, audioCtx.currentTime);
            gain.gain.linearRampToValueAtTime(0.001, audioCtx.currentTime + 0.035);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.035);
        } catch (e) {}
    }

    // Victory Fanfare Chords when winner is revealed
    function playFanfareSound() {
        if (!isSoundOn) return;
        try {
            initAudio();
            if (!audioCtx) return;
            const notes = [523.25, 659.25, 783.99, 1046.50]; // C5, E5, G5, C6
            notes.forEach((freq, idx) => {
                const startTime = audioCtx.currentTime + (idx * 0.12);
                const duration = 0.55;
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(freq, startTime);
                gain.gain.setValueAtTime(0.22, startTime);
                gain.gain.exponentialRampToValueAtTime(0.001, startTime + duration);
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.start(startTime);
                osc.stop(startTime + duration);
            });
        } catch (e) {}
    }

    // Fireworks Pop Explosions
    function playPopSound() {
        if (!isSoundOn) return;
        try {
            initAudio();
            if (!audioCtx) return;
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(180, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(45, audioCtx.currentTime + 0.18);
            gain.gain.setValueAtTime(0.25, audioCtx.currentTime);
            gain.gain.linearRampToValueAtTime(0.001, audioCtx.currentTime + 0.18);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + 0.18);
        } catch (e) {}
    }

    // =========================================================================
    // 2. CELEBRATION FIREWORKS & CONFETTI PARTICLE ENGINE
    // =========================================================================
    const celebCanvas = document.getElementById('celebration-canvas');
    let celebCtx = celebCanvas ? celebCanvas.getContext('2d') : null;
    let celebAnimId = null;
    let particles = [];
    let rockets = [];
    const PALETTE = ['#f59e0b', '#ef4444', '#10b981', '#3b82f6', '#ec4899', '#8b5cf6', '#facc15', '#06b6d4', '#ffffff'];

    function resizeCelebCanvas() {
        if (!celebCanvas) return;
        celebCanvas.width = window.innerWidth;
        celebCanvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCelebCanvas);
    resizeCelebCanvas();

    class ConfettiParticle {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.color = PALETTE[Math.floor(Math.random() * PALETTE.length)];
            this.size = Math.random() * 8 + 6;
            this.vx = (Math.random() - 0.5) * 14;
            this.vy = Math.random() * -12 - 4;
            this.gravity = 0.28;
            this.rot = Math.random() * 360;
            this.vrot = (Math.random() - 0.5) * 12;
            this.alpha = 1;
            this.decay = Math.random() * 0.008 + 0.006;
        }
        update() {
            this.x += this.vx;
            this.y += this.vy;
            this.vy += this.gravity;
            this.vx *= 0.98;
            this.rot += this.vrot;
            this.alpha -= this.decay;
        }
        draw(ctx) {
            ctx.save();
            ctx.globalAlpha = Math.max(0, this.alpha);
            ctx.translate(this.x, this.y);
            ctx.rotate((this.rot * Math.PI) / 180);
            ctx.fillStyle = this.color;
            ctx.fillRect(-this.size / 2, -this.size / 4, this.size, this.size / 2);
            ctx.restore();
        }
    }

    class FireworkRocket {
        constructor() {
            this.x = Math.random() * (window.innerWidth * 0.7) + (window.innerWidth * 0.15);
            this.y = window.innerHeight;
            this.targetY = Math.random() * (window.innerHeight * 0.45) + (window.innerHeight * 0.1);
            this.vy = Math.random() * -4 - 11;
            this.color = PALETTE[Math.floor(Math.random() * PALETTE.length)];
            this.exploded = false;
        }
        update() {
            this.y += this.vy;
            if (this.y <= this.targetY || this.vy >= 0) {
                this.explode();
            }
        }
        explode() {
            this.exploded = true;
            playPopSound();
            const sparkCount = Math.floor(Math.random() * 35) + 40;
            for (let i = 0; i < sparkCount; i++) {
                const angle = (Math.PI * 2 * i) / sparkCount;
                const speed = Math.random() * 7 + 2;
                particles.push({
                    x: this.x,
                    y: this.y,
                    vx: Math.cos(angle) * speed,
                    vy: Math.sin(angle) * speed,
                    gravity: 0.15,
                    color: this.color,
                    alpha: 1,
                    decay: Math.random() * 0.02 + 0.015,
                    size: Math.random() * 3 + 2,
                    update() {
                        this.x += this.vx;
                        this.y += this.vy;
                        this.vy += this.gravity;
                        this.vx *= 0.96;
                        this.alpha -= this.decay;
                    },
                    draw(ctx) {
                        ctx.save();
                        ctx.globalAlpha = Math.max(0, this.alpha);
                        ctx.fillStyle = this.color;
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                        ctx.fill();
                        ctx.restore();
                    }
                });
            }
        }
        draw(ctx) {
            ctx.save();
            ctx.strokeStyle = this.color;
            ctx.lineWidth = 3;
            ctx.beginPath();
            ctx.moveTo(this.x, this.y);
            ctx.lineTo(this.x, this.y - this.vy * 2);
            ctx.stroke();
            ctx.restore();
        }
    }

    function loopCelebration() {
        if (!celebCtx) return;
        celebCtx.clearRect(0, 0, celebCanvas.width, celebCanvas.height);

        for (let i = rockets.length - 1; i >= 0; i--) {
            const r = rockets[i];
            r.update();
            if (!r.exploded) {
                r.draw(celebCtx);
            } else {
                rockets.splice(i, 1);
            }
        }

        for (let i = particles.length - 1; i >= 0; i--) {
            const p = particles[i];
            p.update();
            if (p.alpha > 0) {
                p.draw(celebCtx);
            } else {
                particles.splice(i, 1);
            }
        }

        if (rockets.length > 0 || particles.length > 0) {
            celebAnimId = requestAnimationFrame(loopCelebration);
        } else {
            celebCanvas.style.display = 'none';
            cancelAnimationFrame(celebAnimId);
            celebAnimId = null;
        }
    }

    function triggerCelebration() {
        if (!celebCanvas || !celebCtx) return;
        celebCanvas.style.display = 'block';
        resizeCelebCanvas();

        const origins = [
            { x: window.innerWidth * 0.2, y: window.innerHeight * 0.4 },
            { x: window.innerWidth * 0.5, y: window.innerHeight * 0.35 },
            { x: window.innerWidth * 0.8, y: window.innerHeight * 0.4 }
        ];

        origins.forEach(orig => {
            for (let i = 0; i < 45; i++) {
                particles.push(new ConfettiParticle(orig.x, orig.y));
            }
        });

        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                rockets.push(new FireworkRocket());
            }, i * 380);
        }

        playFanfareSound();

        if (!celebAnimId) {
            celebAnimId = requestAnimationFrame(loopCelebration);
        }
    }

    const btnFireworksTest = document.getElementById('btn-fireworks-test');
    if (btnFireworksTest) {
        btnFireworksTest.addEventListener('click', triggerCelebration);
    }

    // =========================================================================
    // 3. WINNER POPUP MODAL
    // =========================================================================
    const winnerModal = document.getElementById('winner-popup-modal');
    const winnerNameDisplay = document.getElementById('winner-name-display');
    const btnSpinAgain = document.getElementById('btn-spin-again');
    const btnRemoveWinner = document.getElementById('btn-remove-winner');
    const btnCloseWinnerModal = document.getElementById('btn-close-winner-modal');
    let lastWinnerItem = '';

    function showWinnerPopup(wName, onRemoveCallback) {
        lastWinnerItem = wName;
        if (winnerNameDisplay) winnerNameDisplay.textContent = wName;
        if (winnerModal) winnerModal.style.display = 'flex';
        triggerCelebration();

        if (btnRemoveWinner) {
            btnRemoveWinner.onclick = () => {
                if (onRemoveCallback) onRemoveCallback(lastWinnerItem);
                closeWinnerPopup();
            };
        }
    }

    function closeWinnerPopup() {
        if (winnerModal) winnerModal.style.display = 'none';
    }

    if (btnCloseWinnerModal) btnCloseWinnerModal.addEventListener('click', closeWinnerPopup);
    if (btnSpinAgain) {
        btnSpinAgain.addEventListener('click', () => {
            closeWinnerPopup();
            if (focusMode === 'wheel') {
                triggerWheelSpin();
            } else {
                triggerFocusRoll();
            }
        });
    }

    // =========================================================================
    // 4. MAIN PAGE TABS (SETUP ONLY)
    // =========================================================================
    const tabWheel = document.getElementById('tab-rand-wheel');
    const tabNames = document.getElementById('tab-rand-names');
    const tabNumbers = document.getElementById('tab-rand-numbers');
    const tabTeams = document.getElementById('tab-rand-teams');

    const panelWheel = document.getElementById('panel-rand-wheel');
    const panelNames = document.getElementById('panel-rand-names');
    const panelNumbers = document.getElementById('panel-rand-numbers');
    const panelTeams = document.getElementById('panel-rand-teams');

    const allTabs = [tabWheel, tabNames, tabNumbers, tabTeams];
    const allPanels = [panelWheel, panelNames, panelNumbers, panelTeams];

    function switchMainTab(targetTab, targetPanel) {
        allTabs.forEach(t => t?.classList.remove('active'));
        allPanels.forEach(p => { if (p) p.style.display = 'none'; });

        targetTab?.classList.add('active');
        if (targetPanel) targetPanel.style.display = 'block';
    }

    if (tabWheel) tabWheel.addEventListener('click', () => switchMainTab(tabWheel, panelWheel));
    if (tabNames) tabNames.addEventListener('click', () => switchMainTab(tabNames, panelNames));
    if (tabNumbers) tabNumbers.addEventListener('click', () => switchMainTab(tabNumbers, panelNumbers));
    if (tabTeams) tabTeams.addEventListener('click', () => switchMainTab(tabTeams, panelTeams));

    // =========================================================================
    // 5. GORGEOUS LUCKY SPIN WHEEL (RENDERED IN FOCUS MODE)
    // =========================================================================
    const wheelCanvas = document.getElementById('wheel-canvas');
    const wheelCtx = wheelCanvas ? wheelCanvas.getContext('2d') : null;
    const wheelItemsInput = document.getElementById('wheel-items-input');
    const btnUpdateWheel = document.getElementById('btn-update-wheel');
    const btnFocusSpinWheel = document.getElementById('btn-focus-spin-wheel');
    const wheelCenterBtn = document.getElementById('wheel-center-btn');
    const wheelPointer = document.getElementById('wheel-pointer');
    const wheelItemsCountBadge = document.getElementById('wheel-items-count-badge');
    const wheelAutoRemoveCheck = document.getElementById('wheel-remove-winner-auto');
    const btnLaunchWheelFocus = document.getElementById('btn-launch-wheel-focus');

    const WHEEL_COLORS = [
        '#ef4444', '#f59e0b', '#10b981', '#06b6d4',
        '#6366f1', '#8b5cf6', '#ec4899', '#f97316',
        '#14b8a6', '#3b82f6', '#eab308', '#d946ef'
    ];

    let wheelItems = [];
    let wheelAngle = 0; // in radians
    let isSpinning = false;
    let lastTickSlice = -1;

    function parseWheelItems() {
        const raw = wheelItemsInput ? wheelItemsInput.value : '';
        wheelItems = raw.split('\n').map(s => s.trim()).filter(s => s.length > 0);
        if (wheelItems.length === 0) {
            wheelItems = ['ตัวเลือก 1', 'ตัวเลือก 2', 'ตัวเลือก 3', 'ตัวเลือก 4'];
        }
        if (wheelItemsCountBadge) {
            wheelItemsCountBadge.textContent = `${wheelItems.length} ตัวเลือก`;
        }
        const focusWheelCount = document.getElementById('focus-lbl-wheel-count');
        if (focusWheelCount) focusWheelCount.textContent = wheelItems.length;
        drawWheel();
    }

    function drawWheel() {
        if (!wheelCtx || !wheelCanvas) return;
        const width = wheelCanvas.width;
        const height = wheelCanvas.height;
        const cx = width / 2;
        const cy = height / 2;
        const radius = cx - 24;
        const sliceCount = wheelItems.length;
        const sliceAngle = (Math.PI * 2) / sliceCount;

        wheelCtx.clearRect(0, 0, width, height);

        // Outer Metallic Gold Ring with shadow
        wheelCtx.save();
        wheelCtx.beginPath();
        wheelCtx.arc(cx, cy, radius + 12, 0, Math.PI * 2);
        wheelCtx.fillStyle = '#b45309';
        wheelCtx.shadowColor = 'rgba(245, 158, 11, 0.5)';
        wheelCtx.shadowBlur = 18;
        wheelCtx.fill();
        wheelCtx.restore();

        // Inner wheel segments
        wheelCtx.save();
        wheelCtx.translate(cx, cy);
        wheelCtx.rotate(wheelAngle);

        for (let i = 0; i < sliceCount; i++) {
            const startAngle = i * sliceAngle;
            const endAngle = startAngle + sliceAngle;

            wheelCtx.beginPath();
            wheelCtx.moveTo(0, 0);
            wheelCtx.arc(0, 0, radius, startAngle, endAngle);
            wheelCtx.closePath();

            const color = WHEEL_COLORS[i % WHEEL_COLORS.length];
            wheelCtx.fillStyle = color;
            wheelCtx.fill();

            // Inner slice border
            wheelCtx.lineWidth = 2.5;
            wheelCtx.strokeStyle = 'rgba(255, 255, 255, 0.45)';
            wheelCtx.stroke();

            // Segment Label Typography
            wheelCtx.save();
            wheelCtx.rotate(startAngle + sliceAngle / 2);
            wheelCtx.textAlign = 'right';
            wheelCtx.textBaseline = 'middle';
            wheelCtx.fillStyle = '#ffffff';
            wheelCtx.shadowColor = 'rgba(0, 0, 0, 0.85)';
            wheelCtx.shadowBlur = 5;
            wheelCtx.font = `bold ${sliceCount > 14 ? '14px' : sliceCount > 8 ? '16px' : '18px'} 'Sarabun', sans-serif`;

            let label = wheelItems[i];
            if (label.length > 20) label = label.substring(0, 18) + '...';
            wheelCtx.fillText(label, radius - 24, 0);
            wheelCtx.restore();
        }

        // Gold Pegs around the outer rim
        for (let i = 0; i < sliceCount; i++) {
            const pegAngle = i * sliceAngle;
            const px = Math.cos(pegAngle) * (radius + 4);
            const py = Math.sin(pegAngle) * (radius + 4);
            wheelCtx.beginPath();
            wheelCtx.arc(px, py, 4.5, 0, Math.PI * 2);
            wheelCtx.fillStyle = '#fde047';
            wheelCtx.strokeStyle = '#78350f';
            wheelCtx.lineWidth = 1.5;
            wheelCtx.fill();
            wheelCtx.stroke();
        }

        wheelCtx.restore();
    }

    function triggerWheelSpin() {
        if (isSpinning || wheelItems.length === 0) return;
        isSpinning = true;
        initAudio();

        const count = wheelItems.length;
        const sliceAngle = (Math.PI * 2) / count;

        // Secure Random Winning Index
        const array = new Uint32Array(1);
        window.crypto.getRandomValues(array);
        const winnerIndex = array[0] % count;

        // Needle points at top: -Math.PI / 2
        const targetSliceCenter = (winnerIndex + 0.5) * sliceAngle;
        const currentNormalizedAngle = wheelAngle % (Math.PI * 2);
        const fullSpins = Math.floor(Math.random() * 3) + 7;
        const desiredFinalAngle = (fullSpins * Math.PI * 2) + (Math.PI * 1.5 - targetSliceCenter);
        const totalAngleDelta = desiredFinalAngle - currentNormalizedAngle;

        const startTime = performance.now();
        const duration = 4800;
        const initialAngle = wheelAngle;

        function easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        function animateWheel(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const ease = easeOutCubic(progress);

            wheelAngle = initialAngle + totalAngleDelta * ease;

            const currentSlice = Math.floor(((Math.PI * 1.5 - (wheelAngle % (Math.PI * 2)) + Math.PI * 2) % (Math.PI * 2)) / sliceAngle);
            if (currentSlice !== lastTickSlice) {
                lastTickSlice = currentSlice;
                playTickSound();
                if (wheelPointer) {
                    wheelPointer.classList.add('tick');
                    setTimeout(() => wheelPointer.classList.remove('tick'), 50);
                }
            }

            drawWheel();

            if (progress < 1) {
                requestAnimationFrame(animateWheel);
            } else {
                isSpinning = false;
                const winner = wheelItems[winnerIndex];

                showWinnerPopup(winner, (removedItem) => {
                    removeWheelItem(removedItem);
                });

                if (wheelAutoRemoveCheck && wheelAutoRemoveCheck.checked) {
                    removeWheelItem(winner);
                }

                addFocusHistory(winner);
            }
        }

        requestAnimationFrame(animateWheel);
    }

    function removeWheelItem(itemText) {
        if (!wheelItemsInput) return;
        const current = wheelItemsInput.value.split('\n').map(s => s.trim()).filter(s => s.length > 0);
        const idx = current.indexOf(itemText);
        if (idx !== -1) {
            current.splice(idx, 1);
            wheelItemsInput.value = current.join('\n');
            parseWheelItems();
        }
    }

    if (btnUpdateWheel) btnUpdateWheel.addEventListener('click', parseWheelItems);
    if (wheelItemsInput) wheelItemsInput.addEventListener('input', parseWheelItems);
    if (btnFocusSpinWheel) btnFocusSpinWheel.addEventListener('click', triggerWheelSpin);
    if (wheelCenterBtn) wheelCenterBtn.addEventListener('click', triggerWheelSpin);

    // Presets
    const WHEEL_PRESETS = {
        food: [
            'กะเพราไข่ดาว', 'ส้มตำไก่ย่าง', 'ก๋วยเตี๋ยวเรือ', 'ข้าวมันไก่',
            'ชาบูปิ้งย่าง', 'อาหารญี่ปุ่น', 'ผัดซีอิ๊ว', 'ข้าวไข่เจียวทรงเครื่อง'
        ],
        prizes: [
            'รางวัลที่ 1 (ทองคำ 1 สลึง)', 'รางวัลที่ 2 (พัดลมตั้งโต๊ะ)',
            'รางวัลที่ 3 (แก้วเก็บความเย็น)', 'รางวัลที่ 4 (บัตรกำนัล 500 บาท)',
            'รางวัลที่ 5 (กาแฟฟรี 1 สัปดาห์)', 'รางวัลปลอบใจ (ขนมปี๊บ)',
            'โชคดีรอบหน้า (สู้ๆ นะ)'
        ],
        yesno: [
            'ใช่แน่นอน 100%', 'ไม่ใช่เด็ดขาด', 'ลองใหม่อีกครั้ง',
            'มีความเป็นไปได้สูง', 'พักไว้ก่อน'
        ],
        numbers: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        party: [
            'คนซ้ายมือจ่าย', 'เจ้าของวันเกิด', 'คนที่เงินเดือนเยอะสุด',
            'หารเท่ากันทุกคน', 'เจ้ามือเลี้ยงเอง', 'คนหน้าตาดีสุดจ่าย'
        ]
    };

    document.querySelectorAll('.btn-preset-wheel').forEach(btn => {
        btn.addEventListener('click', () => {
            const key = btn.dataset.preset;
            if (WHEEL_PRESETS[key] && wheelItemsInput) {
                wheelItemsInput.value = WHEEL_PRESETS[key].join('\n');
                parseWheelItems();
            }
        });
    });

    parseWheelItems();

    // =========================================================================
    // 6. NAME PICKER & TEAM SHUFFLER
    // =========================================================================
    const namesTextarea = document.getElementById('rand-names-input');
    const winnersCountInput = document.getElementById('rand-winners-count');
    const removeWinnersCheck = document.getElementById('rand-remove-winners');
    const btnPickNames = document.getElementById('btn-pick-names');
    const resNamesDisplay = document.getElementById('res-names-display');

    function pickWinners() {
        const rawText = namesTextarea?.value || '';
        const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);

        if (names.length === 0) {
            alert('กรุณากรอกรายชื่อผู้เข้าร่วมจับฉลากอย่างน้อย 1 ชื่อ');
            return;
        }

        const count = Math.min(parseInt(winnersCountInput?.value) || 1, names.length);
        const shuffled = [...names].sort(() => Math.random() - 0.5);
        const winners = shuffled.slice(0, count);

        if (resNamesDisplay) {
            resNamesDisplay.innerHTML = `
                <div style="font-weight: 700; font-size: 1rem; color: #10b981; margin-bottom: 0.75rem;">
                    รายชื่อผู้โชคดีที่ได้รับรางวัล (${winners.length} คน)
                </div>
                <div style="display: flex; gap: 0.65rem; flex-wrap: wrap; justify-content: center; width: 100%;">
                    ${winners.map((w, idx) => `
                        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; padding: 0.65rem 1.25rem; border-radius: 10px; font-weight: 700; font-size: 1.15rem; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);">
                            ลำดับ ${idx + 1}: ${w}
                        </div>
                    `).join('')}
                </div>
            `;
        }

        if (removeWinnersCheck && removeWinnersCheck.checked && namesTextarea) {
            const remaining = names.filter(n => !winners.includes(n));
            namesTextarea.value = remaining.join('\n');
        }

        showWinnerPopup(winners.join(', '));
        winners.forEach(w => addFocusHistory(w));
    }

    if (btnPickNames) btnPickNames.addEventListener('click', pickWinners);

    // Team Shuffler
    const teamNamesInput = document.getElementById('team-names-input');
    const teamCountInput = document.getElementById('team-count-input');
    const btnShuffleTeams = document.getElementById('btn-shuffle-teams');
    const resTeamsDisplay = document.getElementById('res-teams-display');

    function shuffleTeams() {
        const rawText = teamNamesInput?.value || '';
        const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);
        const groupCount = parseInt(teamCountInput?.value) || 2;

        if (names.length === 0) {
            alert('กรุณากรอกรายชื่อสมาชิกที่ต้องการแบ่งกลุ่ม');
            return;
        }

        const shuffled = [...names].sort(() => Math.random() - 0.5);
        const teams = Array.from({ length: groupCount }, () => []);

        shuffled.forEach((name, i) => {
            teams[i % groupCount].push(name);
        });

        if (resTeamsDisplay) {
            resTeamsDisplay.innerHTML = `
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; width: 100%;">
                    ${teams.map((t, idx) => `
                        <div style="background: var(--bg-card); border: 1.5px solid var(--border-color); border-radius: 10px; padding: 1rem;">
                            <div style="font-weight: 700; font-size: 1rem; color: var(--green-primary); margin-bottom: 0.5rem; border-bottom: 1px solid var(--border-subtle); padding-bottom: 0.35rem;">
                                กลุ่มที่ ${idx + 1} (${t.length} คน)
                            </div>
                            <ol style="padding-left: 1.25rem; font-size: 0.9rem; line-height: 1.6; color: var(--text-primary); margin: 0;">
                                ${t.map(m => `<li>${m}</li>`).join('')}
                            </ol>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        triggerCelebration();
    }

    if (btnShuffleTeams) btnShuffleTeams.addEventListener('click', shuffleTeams);

    // =========================================================================
    // 7. NUMBERS GENERATOR
    // =========================================================================
    const minInput = document.getElementById('rand-num-min');
    const maxInput = document.getElementById('rand-num-max');
    const countInput = document.getElementById('rand-num-count');
    const uniqueCheck = document.getElementById('rand-num-unique');
    const sortCheck = document.getElementById('rand-num-sort');
    const btnRollNumbers = document.getElementById('btn-roll-numbers');
    const resNumbersDisplay = document.getElementById('res-numbers-display');

    function getSecureRandomInt(min, max) {
        const range = max - min + 1;
        const array = new Uint32Array(1);
        window.crypto.getRandomValues(array);
        return min + (array[0] % range);
    }

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

        if (isSort) results.sort((a, b) => a - b);

        if (resNumbersDisplay) {
            resNumbersDisplay.innerHTML = results.map(n => `
                <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; border-radius: 12px; min-width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: 800; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);">
                    ${n}
                </div>
            `).join('');
        }

        addFocusHistory(results.join(' • '));
        playPopSound();
    }

    if (btnRollNumbers) btnRollNumbers.addEventListener('click', rollNumbers);

    document.querySelectorAll('.btn-preset-rand').forEach(btn => {
        btn.addEventListener('click', () => {
            if (minInput) minInput.value = btn.dataset.min;
            if (maxInput) maxInput.value = btn.dataset.max;
            if (countInput) countInput.value = btn.dataset.count;
            rollNumbers();
        });
    });

    // =========================================================================
    // 8. FULLSCREEN FOCUS PRESENTER VIEW (THE STAGE!)
    // =========================================================================
    const modal = document.getElementById('focus-presenter-modal');
    const btnOpenFocus = document.getElementById('btn-open-focus-mode');
    const btnCloseFocus = document.getElementById('btn-close-focus');
    const btnFocusRoll = document.getElementById('btn-focus-roll');

    const focusTabWheel = document.getElementById('focus-tab-wheel');
    const focusTabNames = document.getElementById('focus-tab-names');
    const focusTabNumbers = document.getElementById('focus-tab-numbers');

    const focusStageWheel = document.getElementById('focus-stage-wheel');
    const focusStageCard = document.getElementById('focus-stage-card');

    const focusConfigWheel = document.getElementById('focus-config-wheel');
    const focusConfigNames = document.getElementById('focus-config-names');
    const focusConfigNumbers = document.getElementById('focus-config-numbers');

    const focusMainResult = document.getElementById('focus-main-result');
    const focusSubTitle = document.getElementById('focus-sub-title');
    const focusMetaText = document.getElementById('focus-meta-text');
    const focusHistoryItems = document.getElementById('focus-history-items');

    let focusMode = 'wheel';
    const focusHistory = [];

    function addFocusHistory(itemText) {
        focusHistory.unshift(itemText);
        if (focusHistory.length > 15) focusHistory.pop();
        if (focusHistoryItems) {
            focusHistoryItems.innerHTML = focusHistory.map(h => `<span class="focus-history-pill">${h}</span>`).join('');
        }
    }

    function openFocusMode(targetMode = 'wheel') {
        if (!modal) return;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        setFocusMode(targetMode);
    }

    function closeFocusMode() {
        if (!modal) return;
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function setFocusMode(mode) {
        focusMode = mode;
        [focusTabWheel, focusTabNames, focusTabNumbers].forEach(t => t?.classList.remove('active'));

        if (mode === 'wheel') {
            focusTabWheel?.classList.add('active');
            if (focusStageWheel) focusStageWheel.style.display = 'flex';
            if (focusStageCard) focusStageCard.style.display = 'none';
            if (focusConfigWheel) focusConfigWheel.style.display = 'flex';
            if (focusConfigNames) focusConfigNames.style.display = 'none';
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'none';
            parseWheelItems();
        } else if (mode === 'names') {
            focusTabNames?.classList.add('active');
            if (focusStageWheel) focusStageWheel.style.display = 'none';
            if (focusStageCard) focusStageCard.style.display = 'block';
            if (focusConfigWheel) focusConfigWheel.style.display = 'none';
            if (focusConfigNames) focusConfigNames.style.display = 'flex';
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'none';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดจับฉลากรายชื่อ (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = 'READY';

            const rawText = namesTextarea?.value || '';
            const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);
            const lblNames = document.getElementById('focus-lbl-names-count');
            if (lblNames) lblNames.textContent = names.length;
        } else {
            focusTabNumbers?.classList.add('active');
            if (focusStageWheel) focusStageWheel.style.display = 'none';
            if (focusStageCard) focusStageCard.style.display = 'block';
            if (focusConfigWheel) focusConfigWheel.style.display = 'none';
            if (focusConfigNames) focusConfigNames.style.display = 'none';
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'flex';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดสุ่มตัวเลข (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = 'READY';

            const lblMin = document.getElementById('focus-lbl-min');
            const lblMax = document.getElementById('focus-lbl-max');
            if (lblMin) lblMin.textContent = minInput?.value || '1';
            if (lblMax) lblMax.textContent = maxInput?.value || '100';
        }
    }

    if (btnOpenFocus) btnOpenFocus.addEventListener('click', () => openFocusMode('wheel'));
    if (btnLaunchWheelFocus) btnLaunchWheelFocus.addEventListener('click', () => openFocusMode('wheel'));
    if (btnCloseFocus) btnCloseFocus.addEventListener('click', closeFocusMode);

    if (focusTabWheel) focusTabWheel.addEventListener('click', () => setFocusMode('wheel'));
    if (focusTabNames) focusTabNames.addEventListener('click', () => setFocusMode('names'));
    if (focusTabNumbers) focusTabNumbers.addEventListener('click', () => setFocusMode('numbers'));

    function triggerFocusRoll() {
        if (focusMode === 'wheel') {
            triggerWheelSpin();
        } else if (focusMode === 'names') {
            const rawText = namesTextarea?.value || '';
            const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);
            if (names.length === 0) {
                alert('ยังไม่มีรายชื่อผู้ร่วมจับฉลาก กรุณาปิดหน้านี้แล้วกรอกรายชื่อก่อน');
                return;
            }
            const winner = names[Math.floor(Math.random() * names.length)];
            if (focusMainResult) focusMainResult.textContent = winner;
            if (focusSubTitle) focusSubTitle.textContent = 'ผู้ได้รับรางวัลจับฉลาก!';
            if (focusMetaText) focusMetaText.textContent = `ขอแสดงความยินดีด้วยครับ! (เวลา ${new Date().toLocaleTimeString('th-TH')})`;
            addFocusHistory(winner);
            triggerCelebration();
        } else {
            const min = parseInt(minInput?.value) || 1;
            const max = parseInt(maxInput?.value) || 100;
            const num = getSecureRandomInt(min, max);
            if (focusMainResult) focusMainResult.textContent = num;
            if (focusSubTitle) focusSubTitle.textContent = `ตัวเลขนำโชค (${min} - ${max})`;
            if (focusMetaText) focusMetaText.textContent = `สุ่มสำเร็จเมื่อเวลา ${new Date().toLocaleTimeString('th-TH')}`;
            addFocusHistory(num);
            triggerCelebration();
        }
    }

    if (btnFocusRoll) btnFocusRoll.addEventListener('click', triggerFocusRoll);

    // Keyboard Shortcuts (Spacebar to spin/roll, Esc to close)
    document.addEventListener('keydown', (e) => {
        if (e.target && (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA')) {
            return;
        }

        if (modal && modal.style.display === 'flex') {
            if (e.key === 'Escape') {
                closeFocusMode();
            } else if (e.code === 'Space' || e.key === 'Enter') {
                e.preventDefault();
                if (focusMode === 'wheel') {
                    triggerWheelSpin();
                } else {
                    triggerFocusRoll();
                }
            }
            return;
        }

        if (winnerModal && winnerModal.style.display === 'flex') {
            if (e.key === 'Escape') closeWinnerPopup();
            return;
        }
    });

    // Initial roll for number panel
    rollNumbers();
});
