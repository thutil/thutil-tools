/**
 * Thutil Financial Reports Export Engine
 * Generates Excel (.xlsx) & CSV (UTF-8 BOM) with Zero Storage
 * Running 100% on the client's browser.
 */

window.ReportExporter = (function () {
    let sheetJsLoadingPromise = null;

    /**
     * Dynamically load SheetJS on demand
     */
    function loadSheetJS() {
        if (window.XLSX) {
            return Promise.resolve(window.XLSX);
        }
        if (sheetJsLoadingPromise) {
            return sheetJsLoadingPromise;
        }

        sheetJsLoadingPromise = new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js';
            script.onload = () => {
                resolve(window.XLSX);
            };
            script.onerror = () => {
                sheetJsLoadingPromise = null;
                reject(new Error('ไม่สามารถโหลดไลบรารีสำหรับสร้างไฟล์ Excel ได้'));
            };
            document.head.appendChild(script);
        });

        return sheetJsLoadingPromise;
    }

    /**
     * Standard Report Header
     */
    function createHeader(reportTitle) {
        const now = new Date();
        const thaiDate = now.toLocaleDateString('th-TH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const thaiTime = now.toLocaleTimeString('th-TH', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        return [
            [`รายงาน: ${reportTitle}`],
            [`จัดทำเมื่อ: ${thaiDate} เวลา ${thaiTime} น.`],
            [`สร้างโดย: tools.thutil.com (Zero Storage ไร้การบันทึกข้อมูลส่วนบุคคล ปลอดภัย 100%)`],
            []
        ];
    }

    /**
     * Download CSV with UTF-8 BOM
     */
    function downloadCsv(filename, rows) {
        const safeFilename = filename.endsWith('.csv') ? filename : `${filename}.csv`;
        
        // Escape CSV values and prefix with UTF-8 BOM (\uFEFF) so Excel displays Thai text correctly
        const csvContent = '\uFEFF' + rows.map(row => {
            if (!Array.isArray(row)) return '';
            return row.map(cell => {
                if (cell === null || cell === undefined) return '""';
                const str = String(cell).replace(/"/g, '""');
                return `"${str}"`;
            }).join(',');
        }).join('\r\n');

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = safeFilename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }

    /**
     * Download Excel (.xlsx) using SheetJS
     */
    async function downloadExcel(filename, sheetData) {
        const XLSX = await loadSheetJS();
        const wb = XLSX.utils.book_new();
        const safeFilename = filename.endsWith('.xlsx') ? filename : `${filename}.xlsx`;

        if (Array.isArray(sheetData)) {
            // Single sheet with array of rows
            const ws = XLSX.utils.aoa_to_sheet(sheetData);
            XLSX.utils.book_append_sheet(wb, ws, 'รายงานสรุป');
        } else if (typeof sheetData === 'object' && sheetData !== null) {
            // Multi-sheet object: { 'ชื่อชีต': rowsArray, ... }
            for (const [sheetName, rows] of Object.entries(sheetData)) {
                if (Array.isArray(rows)) {
                    const ws = XLSX.utils.aoa_to_sheet(rows);
                    const cleanSheetName = sheetName.replace(/[:\\/?*[\]]/g, '').substring(0, 31) || 'ชีต';
                    XLSX.utils.book_append_sheet(wb, ws, cleanSheetName);
                }
            }
        }

        XLSX.writeFile(wb, safeFilename);
    }

    /**
     * Quick toast notification
     */
    function showToast(message) {
        const existing = document.getElementById('report-export-toast');
        if (existing) existing.remove();

        const toast = document.createElement('div');
        toast.id = 'report-export-toast';
        toast.style.cssText = `
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #0f172a;
            color: #ffffff;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            z-index: 99999;
            transition: opacity 0.3s ease;
        `;
        toast.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    /**
     * Attach export dropdown behavior to a container
     * @param {string|HTMLElement} container
     * @param {Function} getDataCallback Function returning { title, filename, rows, sheets }
     */
    function attachDropdown(container, getDataCallback) {
        const el = typeof container === 'string' ? document.querySelector(container) : container;
        if (!el) return;

        const trigger = el.querySelector('.btn-export-trigger');
        const menu = el.querySelector('.export-menu');
        if (!trigger || !menu) return;

        // Toggle open/close
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = menu.classList.contains('show');
            // Close any other open export menus
            document.querySelectorAll('.export-menu.show').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.btn-export-trigger.active').forEach(b => b.classList.remove('active'));

            if (!isOpen) {
                menu.classList.add('show');
                trigger.classList.add('active');
            }
        });

        // Click outside closes menu
        document.addEventListener('click', (e) => {
            if (!el.contains(e.target)) {
                menu.classList.remove('show');
                trigger.classList.remove('active');
            }
        });

        // Item selection
        menu.querySelectorAll('.export-menu-item').forEach(item => {
            item.addEventListener('click', async (e) => {
                e.stopPropagation();
                const format = item.getAttribute('data-format');
                menu.classList.remove('show');
                trigger.classList.remove('active');

                const origHtml = trigger.innerHTML;
                trigger.innerHTML = `
                    <svg class="spin" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="2" x2="12" y2="6"></line>
                        <line x1="12" y1="18" x2="12" y2="22"></line>
                        <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                        <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                        <line x1="2" y1="12" x2="6" y2="12"></line>
                        <line x1="18" y1="12" x2="22" y2="12"></line>
                        <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                        <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                    </svg>
                    <span>กำลังสร้างไฟล์...</span>
                `;

                try {
                    const data = await getDataCallback();
                    if (!data) throw new Error('ไม่พบข้อมูลสำหรับการสร้างรายงาน');

                    const filename = data.filename || `report-${Date.now()}`;
                    const header = createHeader(data.title || 'รายงาน');

                    if (format === 'csv') {
                        // In CSV, combine header + rows
                        const allRows = [...header, ...(data.rows || [])];
                        downloadCsv(filename, allRows);
                        showToast(`ดาวน์โหลดไฟล์ CSV เรียบร้อยแล้ว`);
                    } else if (format === 'xlsx') {
                        if (data.sheets) {
                            // Prepend header to each sheet or main sheet
                            const sheetsWithHeader = {};
                            for (const [sName, sRows] of Object.entries(data.sheets)) {
                                sheetsWithHeader[sName] = [...header, ...sRows];
                            }
                            await downloadExcel(filename, sheetsWithHeader);
                        } else {
                            const allRows = [...header, ...(data.rows || [])];
                            await downloadExcel(filename, allRows);
                        }
                        showToast(`ดาวน์โหลดไฟล์ Excel (.xlsx) เรียบร้อยแล้ว`);
                    }
                } catch (err) {
                    console.error('Export error:', err);
                    alert('เกิดข้อผิดพลาดในการดาวน์โหลดรายงาน: ' + err.message);
                } finally {
                    trigger.innerHTML = origHtml;
                }
            });
        });
    }

    return {
        createHeader,
        downloadCsv,
        downloadExcel,
        attachDropdown,
        showToast
    };
})();
