/**
 * WebApp Shell Navigation, Favorites & Default Tool Preferences
 * 100% Client-Side with localStorage persistence
 */

// =========================================================================
// 1. AUTO REDIRECT FOR DEFAULT TOOL (IMMEDIATE EXECUTION BEFORE FULL RENDER)
// =========================================================================
(function checkDefaultLandingRedirect() {
    const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
    const isHome = currentPath === '' || currentPath === '/' || currentPath.endsWith('/index.php');
    const params = new URLSearchParams(window.location.search);

    // Only redirect if visiting home without override flags (?stay=1, ?home=1, ?noredirect=1)
    if (isHome && !params.has('home') && !params.has('stay') && !params.has('noredirect')) {
        try {
            const rawDefault = localStorage.getItem('thutil_default_tool');
            if (rawDefault) {
                const defaultObj = JSON.parse(rawDefault);
                if (defaultObj && defaultObj.url) {
                    const targetUrl = defaultObj.url + (defaultObj.url.includes('?') ? '&' : '?') + 'redirected=1';
                    window.location.replace(targetUrl);
                }
            }
        } catch (e) {}
    }
})();

// Theme Management
function toggleTheme() {
    const current = document.documentElement.getAttribute('data-theme');
    const target = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', target);
    localStorage.setItem('thutil_theme', target);
}

(function() {
    const saved = localStorage.getItem('thutil_theme');
    if (saved) {
        document.documentElement.setAttribute('data-theme', saved);
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }
})();

// =========================================================================
// 2. PREFERENCES MANAGER (FAVORITES & DEFAULT LANDING TOOL)
// =========================================================================
const ThutilPrefs = {
    // Show Toast Notification to User
    showToast(message, isWarning = false) {
        let toast = document.getElementById('thutil-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'thutil-toast';
            toast.className = 'thutil-toast';
            document.body.appendChild(toast);
        }

        const iconSvg = isWarning ? `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        ` : `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        `;

        toast.innerHTML = `
            ${iconSvg}
            <div style="flex: 1;">${message}</div>
        `;
        toast.style.display = 'flex';

        if (this._toastTimer) clearTimeout(this._toastTimer);
        this._toastTimer = setTimeout(() => {
            if (toast) toast.style.display = 'none';
        }, 4000);
    },

    // Favorites
    getFavorites() {
        try {
            const raw = localStorage.getItem('thutil_favorites');
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            return [];
        }
    },

    isFavorite(urlOrSlug) {
        const favs = this.getFavorites();
        return favs.some(f => f.slug === urlOrSlug || f.url === urlOrSlug);
    },

    toggleFavorite(tool) {
        let favs = this.getFavorites();
        const existsIndex = favs.findIndex(f => f.slug === tool.slug || f.url === tool.url);
        let isNowFav = false;

        if (existsIndex >= 0) {
            favs.splice(existsIndex, 1);
            isNowFav = false;
            this.showToast(`นำ <strong>${tool.title || 'เครื่องมือ'}</strong> ออกจากรายการโปรดแล้ว (บันทึกใน localStorage)`);
        } else {
            favs.push(tool);
            isNowFav = true;
            this.showToast(`เพิ่ม <strong>${tool.title || 'เครื่องมือ'}</strong> ในรายการโปรดแล้ว (บันทึกใน localStorage)`);
        }

        localStorage.setItem('thutil_favorites', JSON.stringify(favs));
        this.renderSidebarFavorites();
        this.renderHomeFavorites();
        return isNowFav;
    },

    // Default Landing Tool
    getDefaultTool() {
        try {
            const raw = localStorage.getItem('thutil_default_tool');
            return raw ? JSON.parse(raw) : null;
        } catch (e) {
            return null;
        }
    },

    setDefaultTool(tool) {
        localStorage.setItem('thutil_default_tool', JSON.stringify(tool));
        this.showToast(`ตั้ง <strong>${tool.title || 'เครื่องมือนี้'}</strong> เป็นหน้าเริ่มต้นเมื่อเข้าเว็บแล้ว (บันทึกใน localStorage)`);
        this.updateToolPrefBarUI();
        this.renderHomeDefaultToolStatus();
    },

    clearDefaultTool() {
        localStorage.removeItem('thutil_default_tool');
        this.showToast('ยกเลิกหน้าเริ่มต้นแล้ว ระบบจะเปิดหน้าศูนย์รวมเครื่องมือตามปกติ (บันทึกใน localStorage)');
        this.updateToolPrefBarUI();
        this.renderHomeDefaultToolStatus();
    },

    // Update Current Tool Page Preference Bar UI
    updateToolPrefBarUI() {
        const prefBar = document.getElementById('tool-pref-bar');
        if (!prefBar) return;

        const slug = prefBar.dataset.toolSlug;
        const title = prefBar.dataset.toolTitle;
        const url = prefBar.dataset.toolUrl;

        const btnFav = document.getElementById('btn-toggle-fav');
        const favLabel = document.getElementById('fav-label');
        const starIcon = prefBar.querySelector('.pref-star-icon');

        const btnDefault = document.getElementById('btn-toggle-default-tool');
        const defaultLabel = document.getElementById('default-tool-label');

        const isFav = this.isFavorite(slug) || this.isFavorite(url);
        if (btnFav) {
            btnFav.classList.toggle('active', isFav);
            if (favLabel) favLabel.textContent = isFav ? 'อยู่ในรายการโปรด' : 'เพิ่มในรายการโปรด';
            if (starIcon) {
                starIcon.setAttribute('fill', isFav ? '#f59e0b' : 'none');
                starIcon.setAttribute('stroke', isFav ? '#f59e0b' : 'currentColor');
            }
        }

        const defaultTool = this.getDefaultTool();
        const isCurrentDefault = defaultTool && (defaultTool.slug === slug || defaultTool.url === url);
        if (btnDefault) {
            btnDefault.classList.toggle('active', isCurrentDefault);
            if (defaultLabel) {
                defaultLabel.textContent = isCurrentDefault 
                    ? 'หน้าเริ่มต้นของคุณ (คลิกเพื่อยกเลิก)' 
                    : 'ตั้งเป็นหน้าเริ่มต้น (เปิดเว็บแล้วเจอเลย)';
            }
        }
    },

    // Render Pinned Favorites in Sidebar
    renderSidebarFavorites() {
        const container = document.getElementById('sidebar-favorites-section');
        const list = document.getElementById('sidebar-favorites-list');
        if (!container || !list) return;

        const favs = this.getFavorites();
        if (favs.length === 0) {
            container.style.display = 'none';
            list.innerHTML = '';
            return;
        }

        container.style.display = 'block';
        list.innerHTML = favs.map(f => `
            <li class="tool-nav-item">
                <a href="${f.url}">
                    <span class="tool-nav-icon" style="color: #f59e0b;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </span>
                    <span>${f.title || f.slug}</span>
                </a>
            </li>
        `).join('');
    },

    // Render Favorites on Home Page
    renderHomeFavorites() {
        const container = document.getElementById('home-favorites-section');
        const grid = document.getElementById('home-favorites-grid');
        if (!container || !grid) return;

        const favs = this.getFavorites();
        if (favs.length === 0) {
            container.style.display = 'none';
            grid.innerHTML = '';
            return;
        }

        container.style.display = 'block';
        grid.innerHTML = favs.map(f => `
            <div class="overview-card" style="border-color: rgba(245, 158, 11, 0.4); background: var(--bg-surface);">
                <div class="card-header-row" style="margin-bottom: 0.5rem;">
                    <div class="card-icon" style="background: rgba(245, 158, 11, 0.15); color: #d97706;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <span class="tag-badge" style="background: rgba(245,158,11,0.15); color: #d97706;">รายการโปรด</span>
                </div>
                <h3 class="card-title" style="margin-bottom: 0.35rem;">${f.title || f.slug}</h3>
                <p class="card-desc" style="flex: 1; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
                    บันทึกไว้ในอุปกรณ์เพื่อเข้าใช้งานด่วนได้ทันที
                </p>
                <div class="card-action-row">
                    <a href="${f.url}" class="card-link" style="color: var(--green-primary); font-weight: 700;">
                        เปิดใช้งาน &rarr;
                    </a>
                </div>
            </div>
        `).join('');
    },

    // Render Default Tool Status Bar on Home Page
    renderHomeDefaultToolStatus() {
        const statusBar = document.getElementById('home-default-tool-status');
        const nameElem = document.getElementById('home-default-tool-name');
        const btnClear = document.getElementById('btn-home-clear-default');
        if (!statusBar || !nameElem) return;

        const def = this.getDefaultTool();
        if (def) {
            statusBar.style.display = 'flex';
            nameElem.textContent = def.title || def.slug;
            if (btnClear) {
                btnClear.onclick = () => this.clearDefaultTool();
            }
        } else {
            statusBar.style.display = 'none';
        }
    }
};

// =========================================================================
// 3. CORE DOM INITIALIZATION
// =========================================================================
document.addEventListener('DOMContentLoaded', () => {
    // 3.1 Check if user arrived via default redirect (?redirected=1)
    const params = new URLSearchParams(window.location.search);
    if (params.has('redirected')) {
        const banner = document.getElementById('default-tool-banner');
        if (banner) banner.style.display = 'flex';

        const btnClearBanner = document.getElementById('btn-banner-clear-default');
        if (btnClearBanner) {
            btnClearBanner.addEventListener('click', () => {
                ThutilPrefs.clearDefaultTool();
                if (banner) banner.style.display = 'none';
            });
        }
    }

    // 3.2 Tool Page Preferences Bar Event Handlers
    const prefBar = document.getElementById('tool-pref-bar');
    if (prefBar) {
        const slug = prefBar.dataset.toolSlug;
        const title = prefBar.dataset.toolTitle;
        const url = prefBar.dataset.toolUrl;

        ThutilPrefs.updateToolPrefBarUI();

        const btnFav = document.getElementById('btn-toggle-fav');
        if (btnFav) {
            btnFav.addEventListener('click', () => {
                ThutilPrefs.toggleFavorite({ slug, title, url });
                ThutilPrefs.updateToolPrefBarUI();
            });
        }

        const btnDefault = document.getElementById('btn-toggle-default-tool');
        if (btnDefault) {
            btnDefault.addEventListener('click', () => {
                const currentDefault = ThutilPrefs.getDefaultTool();
                if (currentDefault && (currentDefault.slug === slug || currentDefault.url === url)) {
                    ThutilPrefs.clearDefaultTool();
                } else {
                    ThutilPrefs.setDefaultTool({ slug, title, url });
                }
            });
        }
    }

    // 3.3 Render Pinned Favorites & Home Status
    ThutilPrefs.renderSidebarFavorites();
    ThutilPrefs.renderHomeFavorites();
    ThutilPrefs.renderHomeDefaultToolStatus();

    // 3.4 Wire up Star buttons on all Overview Cards on the Home Page
    const overviewCards = document.querySelectorAll('.overview-card');
    overviewCards.forEach(card => {
        const link = card.querySelector('a.card-link') || card.querySelector('a');
        if (!link) return;

        const url = link.getAttribute('href');
        const titleElem = card.querySelector('.card-title');
        const title = titleElem ? titleElem.textContent.trim() : 'เครื่องมือ';
        const slug = url.split('/').pop();

        // Create Star button on card
        let starBtn = card.querySelector('.card-fav-btn');
        if (!starBtn) {
            starBtn = document.createElement('button');
            starBtn.type = 'button';
            starBtn.className = 'card-fav-btn' + (ThutilPrefs.isFavorite(slug) || ThutilPrefs.isFavorite(url) ? ' active' : '');
            starBtn.title = 'เพิ่ม/ลบ เครื่องมือโปรด';
            starBtn.innerHTML = `
                <svg width="14" height="14" viewBox="0 0 24 24" fill="${ThutilPrefs.isFavorite(slug) ? '#f59e0b' : 'none'}" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            `;
            card.style.position = 'relative';
            card.appendChild(starBtn);

            starBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const isNow = ThutilPrefs.toggleFavorite({ slug, title, url });
                starBtn.classList.toggle('active', isNow);
                const svg = starBtn.querySelector('svg');
                if (svg) svg.setAttribute('fill', isNow ? '#f59e0b' : 'none');
            });
        }
    });

    // 3.5 Desktop & Mobile Sidebar Toggle Logic
    const sidebar = document.getElementById('app-sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');
    const toggleBtn = document.getElementById('sidebar-toggle-btn');
    const searchInput = document.getElementById('global-search-input');

    const savedCollapsed = localStorage.getItem('thutil_sidebar_collapsed');
    if (savedCollapsed === '1' && window.innerWidth > 960) {
        document.body.classList.add('sidebar-collapsed');
    }

    function toggleSidebar(forceState) {
        if (!sidebar) return;
        if (window.innerWidth > 960) {
            const isNowCollapsed = document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('thutil_sidebar_collapsed', isNowCollapsed ? '1' : '0');
        } else {
            const willOpen = forceState !== undefined ? forceState : !sidebar.classList.contains('open');
            sidebar.classList.toggle('open', willOpen);
            if (backdrop) backdrop.classList.toggle('active', willOpen);
        }
    }

    if (toggleBtn) toggleBtn.addEventListener('click', () => toggleSidebar());

    const btnWide = document.getElementById('btn-sidebar-wide');
    if (btnWide) {
        btnWide.addEventListener('click', () => {
            document.body.classList.toggle('sidebar-wide');
        });
    }

    const btnCollapse = document.getElementById('btn-sidebar-collapse');
    if (btnCollapse) {
        btnCollapse.addEventListener('click', () => {
            document.body.classList.add('sidebar-collapsed');
            localStorage.setItem('thutil_sidebar_collapsed', '1');
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', () => toggleSidebar(false));
    }

    const btnMobileMenu = document.getElementById('mobile-btn-menu');
    if (btnMobileMenu) btnMobileMenu.addEventListener('click', () => toggleSidebar(true));

    const btnMobileSearch = document.getElementById('mobile-btn-search');
    if (btnMobileSearch) {
        btnMobileSearch.addEventListener('click', () => {
            toggleSidebar(true);
            setTimeout(() => {
                const search = document.getElementById('global-search-input');
                if (search) search.focus();
            }, 300);
        });
    }

    // Category Chips Filtering
    const chips = document.querySelectorAll('.category-chips-bar .chip-btn');
    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            chips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');

            const category = chip.getAttribute('data-category');
            const cards = document.querySelectorAll('.overview-card');

            cards.forEach(card => {
                if (!category || category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Keyboard shortcut (⌘K or Ctrl+K)
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            if (searchInput) searchInput.focus();
        }
    });

    // Global Search input filter
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            const items = document.querySelectorAll('.tool-nav-item');
            const cards = document.querySelectorAll('.overview-card');

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(query) ? 'block' : 'none';
            });

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? 'flex' : 'none';
            });
        });
    }
});
