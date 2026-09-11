/**
 * Zero Storage Client-side Image Converter & Compressor
 * Convert WebP, JPG, PNG with live quality slider, resizing and instant download
 */

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('img-file-input');
    const dropZone = document.getElementById('img-drop-zone');
    const previewContainer = document.getElementById('img-preview-container');
    const previewImg = document.getElementById('img-preview');

    const formatSelect = document.getElementById('img-format-select');
    const qualitySlider = document.getElementById('img-quality-slider');
    const qualityValText = document.getElementById('img-quality-val');
    const widthInput = document.getElementById('img-width-input');
    const heightInput = document.getElementById('img-height-input');
    const lockRatioCheck = document.getElementById('img-lock-ratio');

    const origSizeText = document.getElementById('img-orig-size');
    const compSizeText = document.getElementById('img-comp-size');
    const savedPctText = document.getElementById('img-saved-pct');
    const btnDownload = document.getElementById('img-btn-download');

    let originalImage = null;
    let originalFileSize = 0;
    let originalWidth = 0;
    let originalHeight = 0;
    let originalFileName = 'image';
    let compressedBlob = null;

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function handleFile(file) {
        if (!file || !file.type.startsWith('image/')) {
            alert('กรุณาเลือกไฟล์รูปภาพที่ถูกต้อง');
            return;
        }

        originalFileSize = file.size;
        originalFileName = file.name.substring(0, file.name.lastIndexOf('.')) || 'image';

        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                originalImage = img;
                originalWidth = img.naturalWidth;
                originalHeight = img.naturalHeight;

                if (widthInput) widthInput.value = originalWidth;
                if (heightInput) heightInput.value = originalHeight;
                if (origSizeText) origSizeText.textContent = formatBytes(originalFileSize);

                if (previewContainer) previewContainer.style.display = 'block';
                processImage();
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    function processImage() {
        if (!originalImage) return;

        const targetWidth = parseInt(widthInput?.value) || originalWidth;
        const targetHeight = parseInt(heightInput?.value) || originalHeight;
        const targetFormat = formatSelect?.value || 'image/jpeg';
        const targetQuality = (parseInt(qualitySlider?.value) || 80) / 100;

        const canvas = document.createElement('canvas');
        canvas.width = targetWidth;
        canvas.height = targetHeight;
        const ctx = canvas.getContext('2d');

        // Draw white background if converting to JPEG (avoids black background for transparent PNGs)
        if (targetFormat === 'image/jpeg') {
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0, 0, targetWidth, targetHeight);
        }

        ctx.drawImage(originalImage, 0, 0, targetWidth, targetHeight);

        canvas.toBlob((blob) => {
            if (!blob) return;
            compressedBlob = blob;

            if (previewImg) previewImg.src = URL.createObjectURL(blob);
            if (compSizeText) compSizeText.textContent = formatBytes(blob.size);

            if (originalFileSize > 0 && savedPctText) {
                const saved = ((originalFileSize - blob.size) / originalFileSize) * 100;
                if (saved >= 0) {
                    savedPctText.textContent = `ประหยัดพื้นที่ ${saved.toFixed(1)}%`;
                    savedPctText.style.color = '#10b981';
                } else {
                    savedPctText.textContent = `ขนาดเพิ่มขึ้น ${Math.abs(saved).toFixed(1)}%`;
                    savedPctText.style.color = '#ef4444';
                }
            }

            if (btnDownload) btnDownload.disabled = false;
        }, targetFormat, targetQuality);
    }

    // Drag & Drop
    if (dropZone) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropZone.style.borderColor = '#10b981';
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropZone.style.borderColor = 'var(--border-color)';
            });
        });

        dropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length > 0) handleFile(files[0]);
        });
    }

    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) handleFile(e.target.files[0]);
        });
    }

    // Quality slider
    if (qualitySlider && qualityValText) {
        qualitySlider.addEventListener('input', () => {
            qualityValText.textContent = qualitySlider.value + '%';
            processImage();
        });
    }

    // Format change
    if (formatSelect) {
        formatSelect.addEventListener('change', () => {
            // PNG does not support lossy quality parameter in toBlob
            if (qualitySlider) {
                qualitySlider.disabled = (formatSelect.value === 'image/png');
                if (qualityValText) {
                    qualityValText.textContent = formatSelect.value === 'image/png' ? 'Lossless' : qualitySlider.value + '%';
                }
            }
            processImage();
        });
    }

    // Resize inputs with aspect ratio lock
    if (widthInput && heightInput && lockRatioCheck) {
        widthInput.addEventListener('input', () => {
            if (lockRatioCheck.checked && originalWidth > 0) {
                const w = parseInt(widthInput.value) || originalWidth;
                heightInput.value = Math.round(w * (originalHeight / originalWidth));
            }
            processImage();
        });

        heightInput.addEventListener('input', () => {
            if (lockRatioCheck.checked && originalHeight > 0) {
                const h = parseInt(heightInput.value) || originalHeight;
                widthInput.value = Math.round(h * (originalWidth / originalHeight));
            }
            processImage();
        });
    }

    // Download button
    if (btnDownload) {
        btnDownload.addEventListener('click', () => {
            if (!compressedBlob) return;

            let ext = 'jpg';
            if (formatSelect.value === 'image/png') ext = 'png';
            if (formatSelect.value === 'image/webp') ext = 'webp';

            const link = document.createElement('a');
            link.href = URL.createObjectURL(compressedBlob);
            link.download = `${originalFileName}_compressed.${ext}`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }
});
