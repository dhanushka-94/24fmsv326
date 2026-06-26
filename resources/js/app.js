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

function initScrollReveal() {
    const items = document.querySelectorAll('.reveal');
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
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
    );

    items.forEach((el) => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) {
        window.lucide.createIcons();
    }

    initScrollReveal();
});
