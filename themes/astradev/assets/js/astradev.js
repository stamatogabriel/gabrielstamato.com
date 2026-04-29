/**
 * AstraDev — front-end scripts.
 * Dark mode (JS-injected toggle), reading progress, back-to-top, copy-link, ToC.
 */
(function () {
    'use strict';

    var html   = document.documentElement;
    var LS_KEY = 'astradev-theme';

    /* ── Helper ───────────────────────────────────────────────── */
    function qs(sel, ctx) { return (ctx || document).querySelector(sel); }

    /* ─────────────────────────────────────────────────────────────
       1. DARK MODE — header button injected by JS
          Works with Astra Header Builder (ast-hfb-header body class)
          and the classic Astra header as fallback.
    ───────────────────────────────────────────────────────────── */
    (function initDarkMode() {

        /* Apply saved preference immediately (anti-FOUC handled by
           the inline script in wp_head, but re-apply after JS loads) */
        var saved = localStorage.getItem(LS_KEY);
        if (!saved) {
            saved = 'dark';
            localStorage.setItem(LS_KEY, saved);
        }
        html.setAttribute('data-theme', saved);

        /* Create toggle button */
        function makeBtn() {
            var b = document.createElement('button');
            b.className = 'ad-theme-toggle';
            b.setAttribute('aria-label', 'Toggle dark mode');
            b.setAttribute('type', 'button');
            b.innerHTML = '<span class="ad-moon" aria-hidden="true">&#9790;</span>'
                        + '<span class="ad-sun"  aria-hidden="true">&#9728;</span>';
            b.addEventListener('click', function () {
                var next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-theme', next);
                localStorage.setItem(LS_KEY, next);
            });
            return b;
        }

        function injectToggles() {
            var injected = false;

            /* ── Astra Header Builder (ast-hfb-header) ── */
            /* Desktop: append into the right section of the desktop header */
            var desktopRight = qs('#ast-desktop-header .site-header-primary-section-right');
            if (desktopRight && !qs('.ad-theme-toggle', desktopRight)) {
                desktopRight.appendChild(makeBtn());
                injected = true;
            }

            /* Mobile: inject before the hamburger trigger in the mobile header */
            var mobileRight = qs('#ast-mobile-header .site-header-primary-section-right');
            if (mobileRight && !qs('.ad-theme-toggle', mobileRight)) {
                var trigger = qs('[data-section="section-header-mobile-trigger"]', mobileRight);
                if (trigger) {
                    mobileRight.insertBefore(makeBtn(), trigger);
                } else {
                    mobileRight.appendChild(makeBtn());
                }
                injected = true;
            }

            /* ── Classic Astra header fallback ── */
            if (!injected) {
                var container = qs('.main-header-container');
                if (container && !qs('.ad-theme-toggle', container)) {
                    var hamburger = qs('.ast-mobile-menu-buttons', container);
                    if (hamburger) {
                        container.insertBefore(makeBtn(), hamburger);
                    } else {
                        container.appendChild(makeBtn());
                    }
                    injected = true;
                }
            }

            return injected;
        }

        if (!injectToggles()) {
            document.addEventListener('DOMContentLoaded', injectToggles);
        }

    })();

    /* ── 2. Reading progress bar ─────────────────────────────── */
    (function initProgress() {
        var fill    = qs('#ad-progress-fill');
        var content = qs('#ad-content-area') || document.body;
        if (!fill) return;

        function updateProgress() {
            var total = content.offsetHeight - window.innerHeight;
            var done  = -content.getBoundingClientRect().top;
            fill.style.width = (total > 0 ? Math.min(100, Math.max(0, done / total * 100)) : 0) + '%';
        }

        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();
    })();

    /* ── 3. Back-to-top ──────────────────────────────────────── */
    (function initBackToTop() {
        var btn = qs('#ad-back-to-top');
        if (!btn) return;

        window.addEventListener('scroll', function () {
            btn.classList.toggle('is-visible', window.scrollY > 400);
        }, { passive: true });

        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();

    /* ── 4. Copy link ────────────────────────────────────────── */
    (function initCopyLink() {
        var btn = qs('#ad-copy-link');
        if (!btn) return;

        btn.addEventListener('click', function () {
            var url      = btn.getAttribute('data-url') || window.location.href;
            var original = btn.textContent;

            function onSuccess() {
                btn.textContent = 'Copiado!';
                btn.classList.add('copied');
                setTimeout(function () {
                    btn.textContent = original;
                    btn.classList.remove('copied');
                }, 2200);
            }

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(onSuccess).catch(function () {
                    fallbackCopy(url, onSuccess);
                });
            } else {
                fallbackCopy(url, onSuccess);
            }
        });

        function fallbackCopy(text, cb) {
            var ta = document.createElement('textarea');
            ta.value = text;
            ta.style.cssText = 'position:fixed;left:-9999px;top:-9999px';
            document.body.appendChild(ta);
            ta.focus(); ta.select();
            try { document.execCommand('copy'); cb(); } catch (e) {}
            document.body.removeChild(ta);
        }
    })();

    /* ── 5. Auto Table of Contents ───────────────────────────── */
    (function initToC() {
        var content = qs('#ad-entry-content');
        var toc     = qs('#ad-toc');
        var nav     = qs('#ad-toc-nav');
        if (!content || !toc || !nav) return;

        var headings = content.querySelectorAll('h2, h3, h4');
        if (headings.length < 3) return;

        var links = [];

        headings.forEach(function (h, idx) {
            if (!h.id) {
                h.id = 'heading-' + idx + '-' + h.tagName.toLowerCase();
            }

            var level = parseInt(h.tagName.charAt(1), 10);
            var a     = document.createElement('a');
            a.href        = '#' + h.id;
            a.textContent = h.textContent;
            a.dataset.level = level;

            a.addEventListener('click', function (e) {
                e.preventDefault();
                var target = document.getElementById(h.id);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            nav.appendChild(a);
            links.push({ el: h, link: a });
        });

        toc.style.display = '';

        if (!('IntersectionObserver' in window)) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                var match = links.find(function (item) { return item.el === entry.target; });
                if (!match) return;

                if (entry.isIntersecting) {
                    links.forEach(function (item) { item.link.classList.remove('is-active'); });
                    match.link.classList.add('is-active');
                }
            });
        }, { rootMargin: '0px 0px -60% 0px', threshold: 0 });

        links.forEach(function (item) { observer.observe(item.el); });
    })();

})();
