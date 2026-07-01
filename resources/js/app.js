import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('floatingActions', () => ({
    showTop: false,
    init() {
        const onScroll = () => {
            this.showTop = window.scrollY > 320;
        };

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    },
    scrollTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    },
}));

Alpine.data('logoLoader', (duration = 4000) => ({
    visible: true,
    leaving: false,
    exitMs: 1100,
    timer: null,
    init() {
        this.visible = true;
        document.documentElement.classList.add('site-loading');
        document.documentElement.classList.remove('loader-done');
        document.body.style.overflow = 'hidden';

        const exitAt = Math.max(duration - this.exitMs, 1200);
        this.timer = window.setTimeout(() => this.beginExit(), exitAt);
    },
    beginExit() {
        this.leaving = true;
        this.timer = window.setTimeout(() => this.dismiss(), this.exitMs);
    },
    dismiss() {
        if (this.timer) {
            clearTimeout(this.timer);
            this.timer = null;
        }

        this.visible = false;
        this.leaving = false;
        document.documentElement.classList.add('loader-done');
        document.documentElement.classList.remove('site-loading');
        document.body.style.overflow = '';
    },
}));

Alpine.data('introReel', () => ({
    visible: false,
    phase: 'video',
    init() {
        const key = 'frames_intro_seen';
        if (!localStorage.getItem(key)) {
            this.visible = true;
            document.body.style.overflow = 'hidden';
            setTimeout(() => this.finishVideo(), 8000);
        }
    },
    finishVideo() {
        this.phase = 'logo';
        setTimeout(() => this.skip(), 2500);
    },
    skip() {
        localStorage.setItem('frames_intro_seen', '1');
        this.visible = false;
        document.body.style.overflow = '';
    },
}));

Alpine.data('videoTheater', () => ({
    active: false,
    url: '',
    title: '',
    open(payload) {
        this.url = payload?.url || '';
        this.title = payload?.title || '';
        this.active = Boolean(this.url);
        document.body.style.overflow = this.active ? 'hidden' : '';
    },
    close() {
        this.active = false;
        this.url = '';
        this.title = '';
        document.body.style.overflow = '';
    },
}));

Alpine.start();

const TEXT_ANIMATE_SELECTOR = [
    '.art-quote',
    '.page-hero-title',
    '.page-hero-quote',
    '.about-title',
    '.section-heading',
    '.portfolio-feature-title',
    '.brand-showcase-title',
    '[data-animate-text]',
].join(',');

const AUTO_REVEAL_SELECTOR = [
    'main article',
    'main .card-surface',
    'main .pipeline-panel',
    'main .director-card',
    'main .portfolio-feature',
    'main .contact-detail-card',
    'main form.card-surface',
    'main .brand-showcase-header',
].join(',');

function splitTextIntoWords(element) {
    if (element.dataset.wordsSplit === 'true') {
        return;
    }

    if (element.innerHTML.includes('<')) {
        element.classList.add('text-animate-block');

        return;
    }

    const text = element.textContent.trim();

    if (!text) {
        return;
    }

    element.dataset.wordsSplit = 'true';
    element.setAttribute('aria-label', text);
    element.innerHTML = text
        .split(/\s+/)
        .map((word, index) => `<span class="text-word" style="--word-i:${index}" aria-hidden="true">${word}</span>`)
        .join(' ');
}

function initTextAnimations() {
    document.querySelectorAll(TEXT_ANIMATE_SELECTOR).forEach((element) => {
        if (element.closest('.sr-only')) {
            return;
        }

        splitTextIntoWords(element);

        if (!element.classList.contains('text-animate')) {
            element.classList.add('text-animate');
        }

        if (element.classList.contains('text-animate-loop') || element.dataset.animateLoop === 'true') {
            element.classList.add('text-animate-loop');
        }
    });
}

function initAutoReveal() {
    document.querySelectorAll(AUTO_REVEAL_SELECTOR).forEach((element, index) => {
        if (element.classList.contains('reveal') || element.classList.contains('no-reveal')) {
            return;
        }

        element.classList.add('reveal', 'reveal-slow');

        if (index % 2 === 1) {
            element.classList.add('reveal-left');
        }

        if (element.classList.contains('card-surface') || element.classList.contains('pipeline-panel')) {
            element.classList.add('card-loop');
        }
    });
}

function initScrollReveal() {
    initTextAnimations();
    initAutoReveal();

    const items = document.querySelectorAll('.reveal, .reveal-slow, .reveal-fade, .reveal-left, [data-stagger], .text-animate, .text-animate-block');
    if (!items.length) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -30px 0px' },
    );

    items.forEach((el) => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) {
        window.lucide.createIcons();
    }

    initScrollReveal();
});

document.addEventListener('livewire:navigated', () => {
    if (window.lucide) {
        window.lucide.createIcons();
    }

    initScrollReveal();
});
