// ===== Mobile Menu Toggle =====
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
const menuIcon = document.getElementById('menu-icon');
let menuOpen = false;

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
        menuOpen = !menuOpen;
        mobileMenu.classList.toggle('open');
        menuIcon.className = menuOpen ? 'ph-bold ph-x text-xl' : 'ph-bold ph-list text-xl';
        mobileMenuBtn.setAttribute('aria-expanded', menuOpen ? 'true' : 'false');
    });

    document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            menuOpen = false;
            mobileMenu.classList.remove('open');
            menuIcon.className = 'ph-bold ph-list text-xl';
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
        });
    });
}

// ===== Navbar scroll effect (Light Mode) =====
const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-md', 'shadow-slate-200/60');
        } else {
            navbar.classList.remove('shadow-md', 'shadow-slate-200/60');
        }
    });
}

// ===== Reveal on Scroll (Intersection Observer) =====
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ===== Lacak Servis — AJAX Resi Tracker =====
const btnCekResi = document.getElementById('btn-cek-resi');
const inputResi  = document.getElementById('input-resi');
const resiResult = document.getElementById('resi-result');

/**
 * Render hasil pelacakan resi ke area #resi-result.
 *
 * @param {'loading'|'success'|'not-found'|'warning'|'error'} state
 * @param {string|object} data  Pesan string atau object data resi dari server.
 */
function showResiResult(state, data) {
    resiResult.classList.remove('hidden');

    const templates = {
        loading: `
            <div class="p-3 rounded-xl bg-sky-50 border border-sky-200 flex items-center gap-2 text-sky-700 text-sm">
                <i class="ph-bold ph-spinner-gap animate-spin"></i>
                <span>${data}</span>
            </div>`,
        success: `
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 space-y-1">
                <p class="text-emerald-700 font-semibold text-sm">
                    <i class="ph-bold ph-check-circle mr-1"></i>Resi <strong>${data.resi}</strong> ditemukan
                </p>
                <p class="text-slate-700 text-sm">Status: <span class="font-semibold text-emerald-600">${data.status}</span></p>
                <p class="text-slate-500 text-xs">Estimasi selesai: ${data.estimasi}</p>
            </div>`,
        'not-found': `
            <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm">
                <i class="ph-bold ph-warning mr-1"></i>${data}
            </div>`,
        warning: `
            <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm">
                <i class="ph-bold ph-warning-circle mr-1"></i>${data}
            </div>`,
        error: `
            <div class="p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                <i class="ph-bold ph-x-circle mr-1"></i>${data}
            </div>`,
    };

    resiResult.innerHTML = templates[state] ?? templates.error;
}

async function handleCekResi() {
    const resi = inputResi.value.trim();

    // Guard: kosong atau format salah
    if (!resi || !resi.startsWith('SRV-')) {
        showResiResult('warning', 'Format tidak valid. Gunakan format SRV-XXXX.');
        return;
    }

    btnCekResi.disabled = true;
    showResiResult('loading', 'Mencari data servis...');

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

        const response = await fetch('/resi/track', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ resi }),
        });

        const responseData = await response.json();

        if (response.status === 422) {
            const message = responseData.message ?? 'Format resi tidak valid.';
            showResiResult('error', message);
        } else if (response.status === 404 || !responseData.found) {
            showResiResult('not-found', `Resi <strong>${resi}</strong> tidak ditemukan.`);
        } else {
            showResiResult('success', responseData);
        }
    } catch {
        showResiResult('error', 'Terjadi kesalahan jaringan. Coba lagi.');
    } finally {
        btnCekResi.disabled = false;
    }
}

if (btnCekResi && inputResi && resiResult) {
    btnCekResi.addEventListener('click', handleCekResi);
    inputResi.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') { handleCekResi(); }
    });
}

// ===== Active nav link highlight on scroll (Light Mode) =====
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        if (window.scrollY >= section.offsetTop - 100) {
            current = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        const isActive = link.getAttribute('href') === '#' + current;
        link.classList.toggle('text-sky-600', isActive);
        link.classList.toggle('text-slate-600', !isActive);
    });
});
