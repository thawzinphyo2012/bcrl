import './bootstrap';

const drawer = document.querySelector('[data-nav]');
const toggles = document.querySelectorAll('[data-nav-toggle]');
const backdrop = document.querySelector('[data-nav-backdrop]');
const root = document.documentElement;
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function setOpen(open) {
    if (!drawer) {
        return;
    }

    drawer.classList.toggle('is-open', open);
    drawer.hidden = !open;
    document.body.classList.toggle('nav-open', open);

    toggles.forEach((toggle) => {
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (toggle.classList.contains('nav-toggle')) {
            toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        }
    });
}

toggles.forEach((toggle) => {
    toggle.addEventListener('click', () => setOpen(!drawer.classList.contains('is-open')));
});

backdrop?.addEventListener('click', () => setOpen(false));
drawer?.querySelectorAll('nav a').forEach((link) => link.addEventListener('click', () => setOpen(false)));

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        setOpen(false);
    }
});

function currentTheme() {
    return root.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
}

function applyTheme(theme) {
    const next = theme === 'light' ? 'light' : 'dark';
    root.setAttribute('data-theme', next);
    try {
        localStorage.setItem('bcrl-theme', next);
    } catch (e) {
        // ignore storage failures
    }

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        const toLight = next === 'dark';
        const label = toLight ? 'Switch to light mode' : 'Switch to dark mode';
        button.setAttribute('aria-label', label);
        button.setAttribute('title', label);
        const icon = button.querySelector('[data-theme-icon]');
        if (icon) {
            icon.textContent = toLight ? '☀' : '☾';
        }
    });
}

applyTheme(currentTheme());

document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        applyTheme(currentTheme() === 'dark' ? 'light' : 'dark');
    });
});

function greetingKey() {
    const hour = new Date().getHours();
    if (hour < 12) {
        return 'morning';
    }
    if (hour < 18) {
        return 'afternoon';
    }
    return 'evening';
}

document.querySelectorAll('[data-greeting]').forEach((el) => {
    const key = greetingKey();
    const text = el.getAttribute(`data-${key}`);
    if (text) {
        el.textContent = text;
    }
});

function typewriter(el) {
    const target = el.querySelector('[data-type-text]');
    const text = el.getAttribute('data-text') || '';
    if (!target || !text) {
        return;
    }

    let index = 0;
    target.textContent = '';

    const tick = () => {
        index += 1;
        target.textContent = text.slice(0, index);
        if (index < text.length) {
            window.setTimeout(tick, reduceMotion ? 0 : 55);
        }
    };

    window.setTimeout(tick, reduceMotion ? 0 : 420);
}

document.querySelectorAll('[data-typewriter]').forEach(typewriter);

function bindGlow(card) {
    card.addEventListener('pointermove', (event) => {
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mx', `${event.clientX - rect.left}px`);
        card.style.setProperty('--my', `${event.clientY - rect.top}px`);
    });
}

document.querySelectorAll('.glow-card, .card, .news-card, .band, .song-card, .service, .founder, .review, .faq details').forEach(bindGlow);

function markReveal(el, extraClass = '', delay = 0) {
    if (!el || el.classList.contains('reveal')) {
        return;
    }
    el.classList.add('reveal');
    if (extraClass) {
        el.classList.add(extraClass);
    }
    if (delay) {
        el.style.setProperty('--delay', `${delay}ms`);
    }
}

function prepareReveals() {
    document.querySelectorAll('.section-head, .page-hero .about-hero-copy, .finale-copy').forEach((el) => {
        markReveal(el);
    });

    document.querySelectorAll('.belief-grid > *, .about-pillars > *, .service-grid > *, .founder-grid > *, .news-grid > *, .poster-grid > *, .dash-grid > *').forEach((el, index) => {
        markReveal(el, 'reveal-scale', (index % 6) * 80);
    });

    document.querySelectorAll('.band-list .band').forEach((el, index) => {
        markReveal(el, 'reveal-left', index * 90);
    });

    document.querySelectorAll('.sleeve li').forEach((el, index) => {
        markReveal(el, '', index * 55);
    });

    document.querySelectorAll('.about-vision-media, .finale-media').forEach((el) => {
        markReveal(el, 'reveal-scale', 80);
    });

    document.querySelectorAll('.footer > *').forEach((el, index) => {
        markReveal(el, '', index * 70);
    });

    document.querySelectorAll('.identity, .form, .auth-card, .account-card, .month-block').forEach((el) => {
        markReveal(el);
    });
}

function observeReveals() {
    const nodes = document.querySelectorAll('.reveal');
    if (!nodes.length) {
        return;
    }

    if (reduceMotion || !('IntersectionObserver' in window)) {
        nodes.forEach((el) => el.classList.add('is-in'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }
            entry.target.classList.add('is-in');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.14,
        rootMargin: '0px 0px -8% 0px',
    });

    nodes.forEach((el) => observer.observe(el));
}

function bootHero() {
    const hero = document.querySelector('.hero');
    if (!hero) {
        return;
    }

    if (reduceMotion) {
        hero.classList.add('is-ready');
        return;
    }

    window.requestAnimationFrame(() => {
        hero.classList.add('is-ready');
    });
}

function bindParallax() {
    if (reduceMotion) {
        return;
    }

    const layers = [...document.querySelectorAll('.about-hero-media img, .finale-media img')];
    if (!layers.length) {
        return;
    }

    let ticking = false;

    const update = () => {
        const viewport = window.innerHeight || 1;
        layers.forEach((img) => {
            const host = img.closest('.about-hero-media, .finale-media') || img;
            const rect = host.getBoundingClientRect();
            const progress = (rect.top + rect.height / 2 - viewport / 2) / viewport;
            const shift = Math.max(-36, Math.min(36, progress * -48));
            img.style.setProperty('--py', `${shift.toFixed(1)}px`);
        });
        ticking = false;
    };

    const onScroll = () => {
        if (ticking) {
            return;
        }
        ticking = true;
        window.requestAnimationFrame(update);
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    update();
}

function mountAmbient() {
    if (reduceMotion || document.querySelector('.ambient')) {
        return;
    }

    const layer = document.createElement('div');
    layer.className = 'ambient';
    layer.setAttribute('aria-hidden', 'true');
    layer.innerHTML = '<span class="ambient-orb"></span><span class="ambient-orb"></span><span class="ambient-orb"></span>';
    document.body.prepend(layer);
}

function bindToTop() {
    const button = document.querySelector('.to-top');
    if (!button) {
        return;
    }

    const sync = () => {
        button.classList.toggle('is-visible', window.scrollY > 420);
    };

    window.addEventListener('scroll', sync, { passive: true });
    sync();
}

function bindMagneticButtons() {
    if (reduceMotion || window.matchMedia('(pointer: coarse)').matches) {
        return;
    }

    document.querySelectorAll('.btn-gold').forEach((button) => {
        button.addEventListener('pointermove', (event) => {
            const rect = button.getBoundingClientRect();
            const x = event.clientX - rect.left - rect.width / 2;
            const y = event.clientY - rect.top - rect.height / 2;
            button.style.transform = `translate(${x * 0.12}px, ${y * 0.18 - 2}px)`;
        });

        button.addEventListener('pointerleave', () => {
            button.style.transform = '';
        });
    });
}

prepareReveals();
observeReveals();
bootHero();
bindParallax();
mountAmbient();
bindToTop();
bindMagneticButtons();
