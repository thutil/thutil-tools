/**
 * WebApp Shell Navigation & Mobile UX
 */

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

// Mobile Drawer & Filter Handling
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('app-sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');
    const toggleBtn = document.getElementById('sidebar-toggle-btn');
    const searchInput = document.getElementById('global-search-input');

    function toggleSidebar(forceState) {
        if (!sidebar) return;
        const willOpen = forceState !== undefined ? forceState : !sidebar.classList.contains('open');
        sidebar.classList.toggle('open', willOpen);
        if (backdrop) backdrop.classList.toggle('active', willOpen);
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => toggleSidebar());
    }

    if (backdrop) {
        backdrop.addEventListener('click', () => toggleSidebar(false));
    }

    // Mobile bottom nav buttons
    const btnMobileMenu = document.getElementById('mobile-btn-menu');
    if (btnMobileMenu) {
        btnMobileMenu.addEventListener('click', () => toggleSidebar(true));
    }

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
    const chips = document.querySelectorAll('.chip-btn');
    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            chips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');

            const category = chip.getAttribute('data-category');
            const cards = document.querySelectorAll('.overview-card');

            cards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
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
