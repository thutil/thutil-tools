/**
 * Thai AI Horoscope & Dream Interpretation Tool
 * Powered by Groq LLM (Zero Storage / Ephemeral Processing Guarantee)
 * Strictly zero emojis, SVG vector icons only.
 */

document.addEventListener('DOMContentLoaded', () => {
    const STORAGE_KEY = 'thutil_groq_custom_key';

    // 1. Tab Switching
    const tabBtns = document.querySelectorAll('.tab-bar .tab-btn[data-tab]');
    const tabPanes = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const target = btn.getAttribute('data-tab');
            tabPanes.forEach(pane => {
                pane.style.display = pane.id === target ? 'block' : 'none';
            });
        });
    });

    // 2. Groq Custom API Key Management
    const customKeyInput = document.getElementById('custom-groq-key');
    const keyStatusBadge = document.getElementById('key-status-badge');
    const btnSaveKey = document.getElementById('btn-save-key');
    const btnClearKey = document.getElementById('btn-clear-key');

    function updateKeyStatus() {
        const savedKey = localStorage.getItem(STORAGE_KEY);
        if (customKeyInput) {
            customKeyInput.value = savedKey ? savedKey : '';
        }
        if (keyStatusBadge) {
            if (savedKey) {
                keyStatusBadge.textContent = 'สถานะ: ใช้ Custom Key ในเครื่อง';
                keyStatusBadge.style.background = 'var(--green-tint)';
                keyStatusBadge.style.color = 'var(--green-primary)';
                keyStatusBadge.style.borderColor = 'var(--green-tint-border)';
            } else {
                keyStatusBadge.textContent = 'สถานะ: เซิร์ฟเวอร์เริ่มต้น / ไม่ได้บันทึกคีย์';
                keyStatusBadge.style.background = 'var(--bg-subtle)';
                keyStatusBadge.style.color = 'var(--text-muted)';
                keyStatusBadge.style.borderColor = 'var(--border-color)';
            }
        }
    }

    if (btnSaveKey) {
        btnSaveKey.addEventListener('click', () => {
            const val = customKeyInput ? customKeyInput.value.trim() : '';
            if (!val) {
                if (window.ThutilToast) {
                    window.ThutilToast.show('กรุณากรอก Groq API Key ก่อนกดบันทึก', 'info');
                } else {
                    alert('กรุณากรอก Groq API Key ก่อนกดบันทึก');
                }
                return;
            }
            if (!val.startsWith('gsk_')) {
                if (window.ThutilToast) {
                    window.ThutilToast.show('Groq API Key ปกติจะขึ้นต้นด้วย gsk_', 'info');
                }
            }
            localStorage.setItem(STORAGE_KEY, val);
            updateKeyStatus();
            if (window.ThutilToast) {
                window.ThutilToast.show('บันทึก Groq API Key ลงในเบราว์เซอร์เรียบร้อยแล้ว (Zero Storage)', 'success');
            } else {
                alert('บันทึก Groq API Key ลงในเบราว์เซอร์เรียบร้อยแล้ว');
            }
        });
    }

    if (btnClearKey) {
        btnClearKey.addEventListener('click', () => {
            localStorage.removeItem(STORAGE_KEY);
            if (customKeyInput) customKeyInput.value = '';
            updateKeyStatus();
            if (window.ThutilToast) {
                window.ThutilToast.show('ลบ Groq API Key ออกจากเบราว์เซอร์แล้ว', 'info');
            } else {
                alert('ลบ Groq API Key ออกจากเบราว์เซอร์แล้ว');
            }
        });
    }

    updateKeyStatus();

    // 3. Preset Dream Buttons
    const presetBtns = document.querySelectorAll('.btn-preset-dream');
    const dreamInput = document.getElementById('dream-input');
    const dreamDaySelect = document.getElementById('dream-day');

    presetBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const dreamText = btn.getAttribute('data-dream') || '';
            const dayText = btn.getAttribute('data-day') || '';

            if (dreamInput) dreamInput.value = dreamText;
            if (dreamDaySelect && dayText) {
                for (let i = 0; i < dreamDaySelect.options.length; i++) {
                    if (dreamDaySelect.options[i].value.includes(dayText)) {
                        dreamDaySelect.selectedIndex = i;
                        break;
                    }
                }
            }
        });
    });

    // 4. Markdown Formatter Helper
    function formatMarkdown(text) {
        if (!text) return '';
        let escaped = text
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

        // Headings
        escaped = escaped.replace(/^### (.*$)/gim, '<h4 style="font-size: 1.05rem; font-weight: 700; color: var(--green-primary); margin-top: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;"><span style="width: 4px; height: 16px; background: var(--green-primary); border-radius: 2px; display: inline-block;"></span>$1</h4>');
        escaped = escaped.replace(/^## (.*$)/gim, '<h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-primary); margin-top: 1.5rem; margin-bottom: 0.65rem;">$1</h3>');

        // Bold
        escaped = escaped.replace(/\*\*(.*?)\*\*/gim, '<strong style="color: var(--text-primary); font-weight: 700;">$1</strong>');

        // Lists
        escaped = escaped.replace(/^\s*[-*]\s+(.*$)/gim, '<li style="margin-bottom: 0.35rem; line-height: 1.6; color: var(--text-secondary);">$1</li>');
        escaped = escaped.replace(/(<li.*<\/li>)/s, '<ul style="padding-left: 1.25rem; margin-bottom: 0.75rem;">$1</ul>');

        // Paragraphs
        const lines = escaped.split('\n');
        const formatted = lines.map(line => {
            line = line.trim();
            if (!line) return '';
            if (line.startsWith('<h') || line.startsWith('<ul') || line.startsWith('<li') || line.startsWith('</ul')) {
                return line;
            }
            return `<p style="margin-bottom: 0.75rem; line-height: 1.65; color: var(--text-secondary);">${line}</p>`;
        }).join('');

        return formatted;
    }

    // Helper to extract lucky numbers from text
    function extractLuckyNumbers(text) {
        const numbers = {
            twoDigits: [],
            threeDigits: []
        };
        if (!text) return numbers;

        // Match 2-digit patterns (e.g. 48, 89)
        const twoMatches = text.match(/\b\d{2}\b/g);
        if (twoMatches) {
            numbers.twoDigits = [...new Set(twoMatches)].slice(0, 5);
        }

        // Match 3-digit patterns (e.g. 348, 789)
        const threeMatches = text.match(/\b\d{3}\b/g);
        if (threeMatches) {
            numbers.threeDigits = [...new Set(threeMatches)].slice(0, 4);
        }

        return numbers;
    }

    function renderLuckyBalls(numbers) {
        if (!numbers.twoDigits.length && !numbers.threeDigits.length) return '';

        let html = `
            <div style="background: var(--bg-card); border: 1.5px solid var(--green-tint-border); border-radius: 10px; padding: 1.15rem; margin-top: 1.25rem; margin-bottom: 1.25rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.85rem;">
                    <div style="font-weight: 700; color: var(--green-primary); font-size: 0.95rem; display: flex; align-items: center; gap: 0.4rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
                        <span>ชุดตัวเลขมงคลเด่นตามนิมิต</span>
                    </div>
                    <span class="tag-badge" style="background: var(--green-tint); color: var(--green-primary); font-size: 0.75rem;">ถอดรหัสตำราโบราณ</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        `;

        if (numbers.twoDigits.length) {
            html += `
                <div style="display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;">
                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); min-width: 80px;">เลขท้าย 2 ตัว:</span>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        ${numbers.twoDigits.map(num => `
                            <span class="lucky-ball" style="display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 50%; background: var(--green-primary); color: #ffffff; font-weight: 800; font-size: 1.05rem; box-shadow: 0 2px 6px rgba(22, 163, 74, 0.3); letter-spacing: 0.5px;">${num}</span>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        if (numbers.threeDigits.length) {
            html += `
                <div style="display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;">
                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted); min-width: 80px;">เลขท้าย 3 ตัว:</span>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        ${numbers.threeDigits.map(num => `
                            <span class="lucky-pill" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.35rem 0.95rem; border-radius: 20px; background: rgba(37, 99, 235, 0.1); border: 1px solid rgba(37, 99, 235, 0.25); color: #1d4ed8; font-weight: 800; font-size: 1.05rem; letter-spacing: 1px;">${num}</span>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        html += `
                </div>
            </div>
        `;
        return html;
    }

    // 5. Submit Dream Interpretation
    const btnSubmitDream = document.getElementById('btn-submit-dream');
    const dreamResultBox = document.getElementById('dream-result-box');
    const btnCopyDream = document.getElementById('btn-copy-dream-result');
    let latestDreamText = '';

    if (btnSubmitDream && dreamInput && dreamResultBox) {
        btnSubmitDream.addEventListener('click', async () => {
            const text = dreamInput.value.trim();
            if (!text) {
                if (window.ThutilToast) {
                    window.ThutilToast.show('กรุณาพิมพ์รายละเอียดความฝันก่อนเริ่มทำนาย', 'info');
                } else {
                    alert('กรุณาพิมพ์รายละเอียดความฝันก่อนเริ่มทำนาย');
                }
                dreamInput.focus();
                return;
            }

            const dayVal = dreamDaySelect ? dreamDaySelect.value : 'ไม่ระบุ';
            const customKey = localStorage.getItem(STORAGE_KEY) || '';

            // Loading state
            btnSubmitDream.disabled = true;
            btnSubmitDream.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="spin">
                    <line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line>
                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                    <line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line>
                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                </svg>
                <span>กำลังประมวลผลด้วย Groq AI...</span>
            `;

            dreamResultBox.innerHTML = `
                <div style="padding: 2.5rem 1.5rem; text-align: center;">
                    <div style="width: 44px; height: 44px; border-radius: 50%; border: 3px solid var(--border-color); border-top-color: var(--green-primary); animation: spin 0.8s linear infinite; margin: 0 auto 1rem;"></div>
                    <div style="font-weight: 700; color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.35rem;">
                        กำลังพิจารณานิมิตความฝันและถอดรหัสเลขเด็ด...
                    </div>
                    <div style="font-size: 0.85rem; color: var(--text-muted);">
                        วิเคราะห์ตามตำราพยากรณ์ไทยโบราณผสานจิตวิทยา (ความเร็วสูงผ่าน Groq LLM)
                    </div>
                </div>
            `;
            if (btnCopyDream) btnCopyDream.style.display = 'none';

            try {
                const response = await fetch('/tools/api/horoscope', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'dream',
                        userInput: text,
                        dreamDay: dayVal,
                        customApiKey: customKey
                    })
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    if (data.needs_key) {
                        dreamResultBox.innerHTML = `
                            <div style="padding: 1.5rem; text-align: center; background: #fffbeb; border: 1.5px solid #fef3c7; border-radius: 8px;">
                                <div style="font-weight: 700; color: #b45309; font-size: 1rem; margin-bottom: 0.5rem;">จำเป็นต้องใช้ Groq API Key</div>
                                <p style="font-size: 0.875rem; color: #92400e; line-height: 1.5; margin-bottom: 1rem;">
                                    ${data.message || 'กรุณาระบุ Groq API Key ส่วนตัวเพื่อเริ่มใช้งาน (รับฟรีที่ console.groq.com)'}
                                </p>
                                <button type="button" class="btn-primary" onclick="document.querySelector('.tab-btn[data-tab=\\'tab-settings\\']').click()">
                                    <span>ไปที่หน้าตั้งค่า API Key</span>
                                </button>
                            </div>
                        `;
                    } else {
                        dreamResultBox.innerHTML = `
                            <div style="padding: 1.5rem; color: #dc2626; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px;">
                                <strong>เกิดข้อผิดพลาด:</strong> ${data.message || 'ไม่สามารถติดต่อ AI ได้ในขณะนี้'}
                            </div>
                        `;
                    }
                    return;
                }

                const reading = data.data.reading || '';
                latestDreamText = reading;

                const luckyNumbers = extractLuckyNumbers(reading);
                const ballsHtml = renderLuckyBalls(luckyNumbers);
                const formattedHtml = formatMarkdown(reading);

                dreamResultBox.innerHTML = `
                    <div class="result-header" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border-color); margin-bottom: 1rem;">
                        <span class="result-label" style="display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <span>ผลการทำนายฝัน (Zero Storage)</span>
                        </span>
                        <span class="tag-badge" style="background: var(--green-tint); color: var(--green-primary); font-size: 0.72rem;">
                            โมเดล: ${data.data.model || 'Groq Llama 3.3'}
                        </span>
                    </div>
                    ${ballsHtml}
                    <div class="reading-content" style="font-size: 0.95rem;">
                        ${formattedHtml}
                    </div>
                `;

                if (btnCopyDream) btnCopyDream.style.display = 'inline-flex';

                if (window.ThutilToast) {
                    window.ThutilToast.show('ถอดรหัสความฝันและเลขเด็ดเรียบร้อยแล้ว (ไม่บันทึกข้อมูล)', 'success');
                }

            } catch (err) {
                dreamResultBox.innerHTML = `
                    <div style="padding: 1.5rem; color: #dc2626; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px;">
                        <strong>เกิดข้อผิดพลาดในการเชื่อมต่อ:</strong> ${err.message || 'กรุณาลองใหม่อีกครั้ง'}
                    </div>
                `;
            } finally {
                btnSubmitDream.disabled = false;
                btnSubmitDream.innerHTML = `
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                    <span>เริ่มทำนายฝัน & ถอดรหัสเลขเด็ด AI</span>
                `;
            }
        });
    }

    if (btnCopyDream) {
        btnCopyDream.addEventListener('click', () => {
            if (!latestDreamText) return;
            navigator.clipboard.writeText(latestDreamText).then(() => {
                if (window.ThutilToast) {
                    window.ThutilToast.show('คัดลอกผลทำนายฝันเรียบร้อยแล้ว', 'success');
                } else {
                    alert('คัดลอกผลทำนายฝันเรียบร้อยแล้ว');
                }
            }).catch(() => {
                alert('ไม่สามารถคัดลอกข้อความได้');
            });
        });
    }

    // 6. Submit Birthday Horoscope
    const btnSubmitHoro = document.getElementById('btn-submit-horo');
    const horoResultBox = document.getElementById('horo-result-box');
    const horoBirthDate = document.getElementById('horo-birth-date');
    const horoBirthTime = document.getElementById('horo-birth-time');
    const horoTopic = document.getElementById('horo-topic');
    const horoQuestion = document.getElementById('horo-question');
    const btnCopyHoro = document.getElementById('btn-copy-horo-result');
    let latestHoroText = '';

    if (btnSubmitHoro && horoBirthDate && horoResultBox) {
        btnSubmitHoro.addEventListener('click', async () => {
            const bdate = horoBirthDate.value;
            if (!bdate) {
                if (window.ThutilToast) {
                    window.ThutilToast.show('กรุณาเลือกวันเดือนปีเกิด', 'info');
                } else {
                    alert('กรุณาเลือกวันเดือนปีเกิด');
                }
                horoBirthDate.focus();
                return;
            }

            const btime = horoBirthTime ? horoBirthTime.value : '';
            const topic = horoTopic ? horoTopic.value : 'ภาพรวมชีวิต';
            const question = horoQuestion ? horoQuestion.value.trim() : '';
            const customKey = localStorage.getItem(STORAGE_KEY) || '';

            btnSubmitHoro.disabled = true;
            btnSubmitHoro.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="spin">
                    <line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line>
                </svg>
                <span>กำลังผูกดวงชะตาด้วย Groq AI...</span>
            `;

            horoResultBox.innerHTML = `
                <div style="padding: 2.5rem 1.5rem; text-align: center;">
                    <div style="width: 44px; height: 44px; border-radius: 50%; border: 3px solid var(--border-color); border-top-color: var(--green-primary); animation: spin 0.8s linear infinite; margin: 0 auto 1rem;"></div>
                    <div style="font-weight: 700; color: var(--text-primary); font-size: 1.05rem; margin-bottom: 0.35rem;">
                        กำลังคำนวณตำแหน่งดวงดาวและชะตาวันเกิด...
                    </div>
                    <div style="font-size: 0.85rem; color: var(--text-muted);">
                        ผูกดวงตามโหราศาสตร์ไทยโบราณ วิเคราะห์สิ่งมงคลและคำถามของคุณ
                    </div>
                </div>
            `;
            if (btnCopyHoro) btnCopyHoro.style.display = 'none';

            try {
                const response = await fetch('/tools/api/horoscope', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'birth',
                        birthDate: bdate,
                        birthTime: btime,
                        targetTopic: topic,
                        userInput: question,
                        customApiKey: customKey
                    })
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    if (data.needs_key) {
                        horoResultBox.innerHTML = `
                            <div style="padding: 1.5rem; text-align: center; background: #fffbeb; border: 1.5px solid #fef3c7; border-radius: 8px;">
                                <div style="font-weight: 700; color: #b45309; font-size: 1rem; margin-bottom: 0.5rem;">จำเป็นต้องใช้ Groq API Key</div>
                                <p style="font-size: 0.875rem; color: #92400e; line-height: 1.5; margin-bottom: 1rem;">
                                    ${data.message || 'กรุณาระบุ Groq API Key ส่วนตัวเพื่อเริ่มใช้งาน (รับฟรีที่ console.groq.com)'}
                                </p>
                                <button type="button" class="btn-primary" onclick="document.querySelector('.tab-btn[data-tab=\\'tab-settings\\']').click()">
                                    <span>ไปที่หน้าตั้งค่า API Key</span>
                                </button>
                            </div>
                        `;
                    } else {
                        horoResultBox.innerHTML = `
                            <div style="padding: 1.5rem; color: #dc2626; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px;">
                                <strong>เกิดข้อผิดพลาด:</strong> ${data.message || 'ไม่สามารถติดต่อ AI ได้ในขณะนี้'}
                            </div>
                        `;
                    }
                    return;
                }

                const reading = data.data.reading || '';
                latestHoroText = reading;
                const formattedHtml = formatMarkdown(reading);

                horoResultBox.innerHTML = `
                    <div class="result-header" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border-color); margin-bottom: 1rem;">
                        <span class="result-label" style="display: flex; align-items: center; gap: 0.4rem;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            <span>ผลพยากรณ์ดวงชะตา (Zero Storage)</span>
                        </span>
                        <span class="tag-badge" style="background: var(--green-tint); color: var(--green-primary); font-size: 0.72rem;">
                            โมเดล: ${data.data.model || 'Groq Llama 3.3'}
                        </span>
                    </div>
                    <div class="reading-content" style="font-size: 0.95rem;">
                        ${formattedHtml}
                    </div>
                `;

                if (btnCopyHoro) btnCopyHoro.style.display = 'inline-flex';

                if (window.ThutilToast) {
                    window.ThutilToast.show('พยากรณ์ดวงชะตาเรียบร้อยแล้ว (ไม่บันทึกข้อมูล)', 'success');
                }

            } catch (err) {
                horoResultBox.innerHTML = `
                    <div style="padding: 1.5rem; color: #dc2626; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px;">
                        <strong>เกิดข้อผิดพลาดในการเชื่อมต่อ:</strong> ${err.message || 'กรุณาลองใหม่อีกครั้ง'}
                    </div>
                `;
            } finally {
                btnSubmitHoro.disabled = false;
                btnSubmitHoro.innerHTML = `
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span>ดูดวงชะตา & วิเคราะห์ดวงดาวด้วย AI</span>
                `;
            }
        });
    }

    if (btnCopyHoro) {
        btnCopyHoro.addEventListener('click', () => {
            if (!latestHoroText) return;
            navigator.clipboard.writeText(latestHoroText).then(() => {
                if (window.ThutilToast) {
                    window.ThutilToast.show('คัดลอกผลทำนายดวงชะตาเรียบร้อยแล้ว', 'success');
                } else {
                    alert('คัดลอกผลทำนายดวงชะตาเรียบร้อยแล้ว');
                }
            }).catch(() => {
                alert('ไม่สามารถคัดลอกข้อความได้');
            });
        });
    }
});
