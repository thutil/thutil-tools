/**
 * Gamified Thai Randomizer: Lucky Spin Wheel, 3-Reel Slot Machine, Crypto Numbers, Names & Fireworks
 * 100% Client-Side with Web Audio API Synthesizer & Canvas Particle Engine
 */

document.addEventListener('DOMContentLoaded', () => {
    // =========================================================================
    // 1. WEB AUDIO API SYNTHESIZER (ZERO EXTERNAL MP3s)
    // =========================================================================
    const AudioCtxClass = window.AudioContext || window.webkitAudioContext;
    let audioCtx = null;
    let isSoundOn = localStorage.getItem('thutil_random_sound') !== 'false';

    const btnToggleSound = document.getElementById('btn-toggle-sound');
    const soundIcon = document.getElementById('sound-icon');
    const soundLabel = document.getElementById('sound-label');

    function updateSoundBtnUI() {
        if (soundIcon) soundIcon.textContent = isSoundOn ? '🔊' : '🔇';
        if (soundLabel) soundLabel.textContent = isSoundOn ? 'เสียง: เปิด' : 'เสียง: ปิด';
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

    // Ticking sound when wheel passes a slice or slot rolls
    function playTickSound() {
        if (!isSoundOn) return;
        try {
            initAudio();
            if (!audioCtx) return;
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'triangle';
            osc.frequency.setValueAtTime(800, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(120, audioCtx.currentTime + 0.035);
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
                    isSpark: true,
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

        // Update rockets
        for (let i = rockets.length - 1; i >= 0; i--) {
            const r = rockets[i];
            r.update();
            if (!r.exploded) {
                r.draw(celebCtx);
            } else {
                rockets.splice(i, 1);
            }
        }

        // Update particles
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

    function triggerCelebration(durationMs = 4500) {
        if (!celebCanvas || !celebCtx) return;
        celebCanvas.style.display = 'block';
        resizeCelebCanvas();

        // Confetti burst from center & sides
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

        // Launch 4-6 fireworks rockets staggered
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
        btnFireworksTest.addEventListener('click', () => triggerCelebration(4500));
    }

    // =========================================================================
    // 3. WINNER CELEBRATION POPUP MODAL
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
            triggerWheelSpin();
        });
    }

    // =========================================================================
    // 4. TAB NAVIGATION
    // =========================================================================
    const tabWheel = document.getElementById('tab-rand-wheel');
    const tabSlot = document.getElementById('tab-rand-slot');
    const tabNames = document.getElementById('tab-rand-names');
    const tabNumbers = document.getElementById('tab-rand-numbers');
    const tabTeams = document.getElementById('tab-rand-teams');

    const panelWheel = document.getElementById('panel-rand-wheel');
    const panelSlot = document.getElementById('panel-rand-slot');
    const panelNames = document.getElementById('panel-rand-names');
    const panelNumbers = document.getElementById('panel-rand-numbers');
    const panelTeams = document.getElementById('panel-rand-teams');

    const allTabs = [tabWheel, tabSlot, tabNames, tabNumbers, tabTeams];
    const allPanels = [panelWheel, panelSlot, panelNames, panelNumbers, panelTeams];

    function switchMode(targetTab, targetPanel) {
        allTabs.forEach(t => t?.classList.remove('active'));
        allPanels.forEach(p => { if (p) p.style.display = 'none'; });

        targetTab?.classList.add('active');
        if (targetPanel) targetPanel.style.display = 'block';
    }

    if (tabWheel) tabWheel.addEventListener('click', () => switchMode(tabWheel, panelWheel));
    if (tabSlot) tabSlot.addEventListener('click', () => switchMode(tabSlot, panelSlot));
    if (tabNames) tabNames.addEventListener('click', () => switchMode(tabNames, panelNames));
    if (tabNumbers) tabNumbers.addEventListener('click', () => switchMode(tabNumbers, panelNumbers));
    if (tabTeams) tabTeams.addEventListener('click', () => switchMode(tabTeams, panelTeams));

    // =========================================================================
    // 5. INTERACTIVE LUCKY SPIN WHEEL
    // =========================================================================
    const wheelCanvas = document.getElementById('wheel-canvas');
    const wheelCtx = wheelCanvas ? wheelCanvas.getContext('2d') : null;
    const wheelItemsInput = document.getElementById('wheel-items-input');
    const btnUpdateWheel = document.getElementById('btn-update-wheel');
    const btnSpinWheel = document.getElementById('btn-spin-wheel');
    const wheelCenterBtn = document.getElementById('wheel-center-btn');
    const wheelPointer = document.getElementById('wheel-pointer');
    const wheelItemsCountBadge = document.getElementById('wheel-items-count-badge');
    const wheelAutoRemoveCheck = document.getElementById('wheel-remove-winner-auto');

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
        const radius = cx - 18; // Leave margin for outer rim
        const sliceCount = wheelItems.length;
        const sliceAngle = (Math.PI * 2) / sliceCount;

        wheelCtx.clearRect(0, 0, width, height);

        // Draw Outer Gold Ring with Pegs
        wheelCtx.save();
        wheelCtx.beginPath();
        wheelCtx.arc(cx, cy, radius + 8, 0, Math.PI * 2);
        wheelCtx.fillStyle = '#b45309';
        wheelCtx.fill();
        wheelCtx.restore();

        // Draw Slices
        wheelCtx.save();
        wheelCtx.translate(cx, cy);
        wheelCtx.rotate(wheelAngle);

        for (let i = 0; i < sliceCount; i++) {
            const startAngle = i * sliceAngle;
            const endAngle = startAngle + sliceAngle;

            // Wedge
            wheelCtx.beginPath();
            wheelCtx.moveTo(0, 0);
            wheelCtx.arc(0, 0, radius, startAngle, endAngle);
            wheelCtx.closePath();

            const color = WHEEL_COLORS[i % WHEEL_COLORS.length];
            wheelCtx.fillStyle = color;
            wheelCtx.fill();

            // Border
            wheelCtx.lineWidth = 2;
            wheelCtx.strokeStyle = 'rgba(255, 255, 255, 0.4)';
            wheelCtx.stroke();

            // Text label
            wheelCtx.save();
            wheelCtx.rotate(startAngle + sliceAngle / 2);
            wheelCtx.textAlign = 'right';
            wheelCtx.textBaseline = 'middle';
            wheelCtx.fillStyle = '#ffffff';
            wheelCtx.shadowColor = 'rgba(0, 0, 0, 0.7)';
            wheelCtx.shadowBlur = 4;
            wheelCtx.font = `bold ${sliceCount > 12 ? '13px' : '15px'} 'Sarabun', sans-serif`;

            let label = wheelItems[i];
            if (label.length > 18) label = label.substring(0, 16) + '...';
            wheelCtx.fillText(label, radius - 20, 0);
            wheelCtx.restore();
        }

        // Draw Gold Pegs around the wheel rim
        for (let i = 0; i < sliceCount; i++) {
            const pegAngle = i * sliceAngle;
            const px = Math.cos(pegAngle) * (radius + 2);
            const py = Math.sin(pegAngle) * (radius + 2);
            wheelCtx.beginPath();
            wheelCtx.arc(px, py, 4, 0, Math.PI * 2);
            wheelCtx.fillStyle = '#fde047';
            wheelCtx.strokeStyle = '#78350f';
            wheelCtx.lineWidth = 1;
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

        // Choose winner index using Cryptographic secure random
        const array = new Uint32Array(1);
        window.crypto.getRandomValues(array);
        const winnerIndex = array[0] % count;

        // Pointer is at TOP of wheel (-Math.PI / 2 or 270 deg)
        // Center of slice i is: (i + 0.5) * sliceAngle
        // When rotated by wheelAngle, needle points at slice:
        // ((2 * Math.PI - (wheelAngle % (2 * Math.PI))) - Math.PI / 2)
        const targetSliceCenter = (winnerIndex + 0.5) * sliceAngle;
        const currentNormalizedAngle = wheelAngle % (Math.PI * 2);
        const fullSpins = Math.floor(Math.random() * 3) + 7; // 7 to 9 full spins
        const desiredFinalAngle = (fullSpins * Math.PI * 2) + (Math.PI * 1.5 - targetSliceCenter);
        const totalAngleDelta = desiredFinalAngle - currentNormalizedAngle;

        const startTime = performance.now();
        const duration = 4800; // 4.8 seconds of exciting suspense
        const initialAngle = wheelAngle;

        // Ease Out Cubic function
        function easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        function animateWheel(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const ease = easeOutCubic(progress);

            wheelAngle = initialAngle + totalAngleDelta * ease;

            // Needle ticking calculation
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

                // Announce winner
                showWinnerPopup(winner, (removedItem) => {
                    removeWheelItem(removedItem);
                });

                // Auto remove if option is checked
                if (wheelAutoRemoveCheck && wheelAutoRemoveCheck.checked) {
                    removeWheelItem(winner);
                }

                addFocusHistory(`🎡 ${winner}`);
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
    if (btnSpinWheel) btnSpinWheel.addEventListener('click', triggerWheelSpin);
    if (wheelCenterBtn) wheelCenterBtn.addEventListener('click', triggerWheelSpin);

    // Wheel Presets
    const WHEEL_PRESETS = {
        food: [
            'กะเพราไข่ดาว', 'ส้มตำไก่ย่าง', 'ก๋วยเตี๋ยวเรือ', 'ข้าวมันไก่',
            'ชาบูปิ้งย่าง', 'อาหารญี่ปุ่น', 'ผัดซีอิ๊ว', 'ข้าวไข่เจียวทรงเครื่อง'
        ],
        prizes: [
            'รางวัลที่ 1 (ทองคำ 1 สลึง)', 'รางวัลที่ 2 (พัดลมตั้งโต๊ะ)',
            'รางวัลที่ 3 (แก้วเก็บความเย็น)', 'รางวัลที่ 4 (บัตรกำนัล 500 บ.)',
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
    // 6. LUCKY 3-REEL SLOT MACHINE
    // =========================================================================
    const slotReel1 = document.getElementById('slot-reel-1');
    const slotReel2 = document.getElementById('slot-reel-2');
    const slotReel3 = document.getElementById('slot-reel-3');
    const btnPullSlot = document.getElementById('btn-pull-slot');
    let isSlotSpinning = false;

    function triggerSlotMachine() {
        if (isSlotSpinning) return;
        isSlotSpinning = true;
        initAudio();

        const slotType = document.querySelector('input[name="slot-type"]:checked')?.value || 'numbers';
        const namesInput = document.getElementById('rand-names-input');
        const namesList = namesInput ? namesInput.value.split('\n').map(s => s.trim()).filter(s => s.length > 0) : [];

        let candidates = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        if (slotType === 'names' && namesList.length > 0) {
            candidates = namesList;
        }

        // Pick 3 final winners
        const finalResults = [
            candidates[Math.floor(Math.random() * candidates.length)],
            candidates[Math.floor(Math.random() * candidates.length)],
            candidates[Math.floor(Math.random() * candidates.length)]
        ];

        let speed1 = 40;
        let speed2 = 40;
        let speed3 = 40;

        const interval1 = setInterval(() => {
            if (slotReel1) slotReel1.textContent = candidates[Math.floor(Math.random() * candidates.length)];
            playTickSound();
        }, speed1);

        const interval2 = setInterval(() => {
            if (slotReel2) slotReel2.textContent = candidates[Math.floor(Math.random() * candidates.length)];
        }, speed2);

        const interval3 = setInterval(() => {
            if (slotReel3) slotReel3.textContent = candidates[Math.floor(Math.random() * candidates.length)];
        }, speed3);

        // Stop reel 1 at 1.4s
        setTimeout(() => {
            clearInterval(interval1);
            if (slotReel1) slotReel1.textContent = finalResults[0];
            playPopSound();
        }, 1400);

        // Stop reel 2 at 2.2s
        setTimeout(() => {
            clearInterval(interval2);
            if (slotReel2) slotReel2.textContent = finalResults[1];
            playPopSound();
        }, 2200);

        // Stop reel 3 at 3.0s & Celebrate!
        setTimeout(() => {
            clearInterval(interval3);
            if (slotReel3) slotReel3.textContent = finalResults[2];
            isSlotSpinning = false;

            const resText = finalResults.join(' - ');
            showWinnerPopup(resText);
            addFocusHistory(`🎰 ${resText}`);
        }, 3000);
    }

    if (btnPullSlot) btnPullSlot.addEventListener('click', triggerSlotMachine);

    // =========================================================================
    // 7. NUMBERS GENERATOR & PRESETS
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

        addFocusHistory(`🔢 ${results.join(' • ')}`);
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
    // 8. NAME PICKER & TEAM SHUFFLER
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
                    🎉 รายชื่อผู้โชคดีที่ได้รับรางวัล (${winners.length} คน)
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
        winners.forEach(w => addFocusHistory(`🎁 ${w}`));
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

        triggerCelebration(3000);
    }

    if (btnShuffleTeams) btnShuffleTeams.addEventListener('click', shuffleTeams);

    // =========================================================================
    // 9. FULLSCREEN FOCUS PRESENTER VIEW (STAGE/PROJECTOR)
    // =========================================================================
    const modal = document.getElementById('focus-presenter-modal');
    const btnOpenFocus = document.getElementById('btn-open-focus-mode');
    const btnCloseFocus = document.getElementById('btn-close-focus');
    const btnFocusRoll = document.getElementById('btn-focus-roll');

    const focusTabWheel = document.getElementById('focus-tab-wheel');
    const focusTabNames = document.getElementById('focus-tab-names');
    const focusTabNumbers = document.getElementById('focus-tab-numbers');

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

    function openFocusMode() {
        if (!modal) return;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeFocusMode() {
        if (!modal) return;
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    if (btnOpenFocus) btnOpenFocus.addEventListener('click', openFocusMode);
    if (btnCloseFocus) btnCloseFocus.addEventListener('click', closeFocusMode);

    function triggerFocusRoll() {
        if (focusMode === 'wheel') {
            if (wheelItems.length === 0) parseWheelItems();
            const winner = wheelItems[Math.floor(Math.random() * wheelItems.length)];
            if (focusMainResult) focusMainResult.textContent = winner;
            if (focusSubTitle) focusSubTitle.textContent = '🎡 ผลสุ่มวงล้อผู้โชคดี!';
            if (focusMetaText) focusMetaText.textContent = `สุ่มสำเร็จเมื่อเวลา ${new Date().toLocaleTimeString('th-TH')}`;
            addFocusHistory(`🎡 ${winner}`);
            triggerCelebration(5000);
        } else if (focusMode === 'names') {
            const rawText = namesTextarea?.value || '';
            const names = rawText.split('\n').map(s => s.trim()).filter(s => s.length > 0);
            if (names.length === 0) {
                alert('ยังไม่มีรายชื่อผู้ร่วมจับฉลาก กรุณากรอกรายชื่อก่อน');
                return;
            }
            const winner = names[Math.floor(Math.random() * names.length)];
            if (focusMainResult) focusMainResult.textContent = winner;
            if (focusSubTitle) focusSubTitle.textContent = '🎁 ผู้ได้รับรางวัลจับฉลาก!';
            if (focusMetaText) focusMetaText.textContent = `ขอแสดงความยินดีด้วยครับ! (เวลา ${new Date().toLocaleTimeString('th-TH')})`;
            addFocusHistory(`🎁 ${winner}`);
            triggerCelebration(5000);
        } else {
            const min = parseInt(minInput?.value) || 1;
            const max = parseInt(maxInput?.value) || 100;
            const num = getSecureRandomInt(min, max);
            if (focusMainResult) focusMainResult.textContent = num;
            if (focusSubTitle) focusSubTitle.textContent = `🔢 ตัวเลขนำโชค (${min} - ${max})`;
            if (focusMetaText) focusMetaText.textContent = `สุ่มสำเร็จเมื่อเวลา ${new Date().toLocaleTimeString('th-TH')}`;
            addFocusHistory(`🔢 ${num}`);
            triggerCelebration(4000);
        }
    }

    if (btnFocusRoll) btnFocusRoll.addEventListener('click', triggerFocusRoll);

    if (focusTabWheel) {
        focusTabWheel.addEventListener('click', () => {
            focusMode = 'wheel';
            [focusTabWheel, focusTabNames, focusTabNumbers].forEach(t => t?.classList.remove('active'));
            focusTabWheel.classList.add('active');
            if (focusConfigWheel) focusConfigWheel.style.display = 'flex';
            if (focusConfigNames) focusConfigNames.style.display = 'none';
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'none';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดวงล้อหมุนเสี่ยงทาย (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = 'SPIN';
        });
    }

    if (focusTabNames) {
        focusTabNames.addEventListener('click', () => {
            focusMode = 'names';
            [focusTabWheel, focusTabNames, focusTabNumbers].forEach(t => t?.classList.remove('active'));
            focusTabNames.classList.add('active');
            if (focusConfigWheel) focusConfigWheel.style.display = 'none';
            if (focusConfigNames) focusConfigNames.style.display = 'flex';
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'none';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดจับฉลากรายชื่อ (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = 'LUCKY';
        });
    }

    if (focusTabNumbers) {
        focusTabNumbers.addEventListener('click', () => {
            focusMode = 'numbers';
            [focusTabWheel, focusTabNames, focusTabNumbers].forEach(t => t?.classList.remove('active'));
            focusTabNumbers.classList.add('active');
            if (focusConfigWheel) focusConfigWheel.style.display = 'none';
            if (focusConfigNames) focusConfigNames.style.display = 'none';
            if (focusConfigNumbers) focusConfigNumbers.style.display = 'flex';
            if (focusSubTitle) focusSubTitle.textContent = 'โหมดสุ่มตัวเลข (พร้อมสุ่ม)';
            if (focusMainResult) focusMainResult.textContent = '777';
        });
    }

    // Keyboard Shortcuts (Spacebar to spin/roll, Esc to close)
    document.addEventListener('keydown', (e) => {
        // If typing in input or textarea, don't trigger spacebar spin
        if (e.target && (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA')) {
            return;
        }

        if (modal && modal.style.display === 'flex') {
            if (e.key === 'Escape') {
                closeFocusMode();
            } else if (e.code === 'Space' || e.key === 'Enter') {
                e.preventDefault();
                triggerFocusRoll();
            }
            return;
        }

        if (winnerModal && winnerModal.style.display === 'flex') {
            if (e.key === 'Escape') closeWinnerPopup();
            return;
        }

        if (e.code === 'Space') {
            const activeTabId = document.querySelector('.category-chips-bar .chip-btn.active')?.id;
            if (activeTabId === 'tab-rand-wheel') {
                e.preventDefault();
                triggerWheelSpin();
            } else if (activeTabId === 'tab-rand-slot') {
                e.preventDefault();
                triggerSlotMachine();
            }
        }
    });

    // Initial roll
    rollNumbers();
});
