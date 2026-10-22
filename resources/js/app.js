import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

Alpine.start();

/**
 * Animaciones declarativas basadas en atributos data-*, para no tener que
 * escribir JS a medida en cada vista Blade.
 *
 *  - [data-animate="hero"]   → entra con fade + slide al cargar la página,
 *                              respetando [data-animate-delay] (segundos).
 *  - [data-animate="up"]     → fade + slide hacia arriba cuando entra en
 *                              viewport (ScrollTrigger). Agrupa con
 *                              [data-animate-group="x"] para stagger.
 *  - [data-float]            → flotación suave e infinita (decorativos).
 *  - [data-counter="123"]    → cuenta desde 0 hasta el valor al entrar en
 *                              viewport.
 *  - [data-bar="70"]         → barra de progreso que crece de 0% al valor
 *                              indicado (%) al entrar en viewport.
 */
// Lee un token de movimiento (--t-*) de app.css; así se ajustan desde CSS sin tocar este archivo.
const token = (name, fallback) =>
    parseFloat(getComputedStyle(document.documentElement).getPropertyValue(name)) || fallback;

function initScrollAnimations() {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.querySelectorAll('[data-animate="hero"]').forEach((el) => {
        const delay = parseFloat(el.dataset.animateDelay || 0);

        if (reduceMotion) {
            gsap.set(el, { opacity: 1, y: 0 });
            return;
        }

        gsap.fromTo(
            el,
            { opacity: 0, y: 24 },
            { opacity: 1, y: 0, duration: 0.8, delay, ease: 'power3.out' }
        );
    });

    const groups = new Map();
    document.querySelectorAll('[data-animate="up"]').forEach((el) => {
        const group = el.dataset.animateGroup || el;
        if (!groups.has(group)) groups.set(group, []);
        groups.get(group).push(el);
    });

    groups.forEach((elements) => {
        if (reduceMotion) {
            gsap.set(elements, { opacity: 1, y: 0 });
            return;
        }

        gsap.fromTo(
            elements,
            { opacity: 0, y: 32 },
            {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: 'power3.out',
                stagger: 0.08,
                scrollTrigger: {
                    trigger: elements[0],
                    start: 'top 85%',
                },
            }
        );
    });

    if (!reduceMotion) {
        document.querySelectorAll('[data-float]').forEach((el, index) => {
            gsap.to(el, {
                y: '+=18',
                duration: 3 + (index % 3),
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: index * 0.2,
            });
        });
    }

    // Spinning counter: cada dígito es una columna 0-9-0-9 que gira hasta su valor (estilo odómetro).
    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = Math.round(parseFloat(el.dataset.counter || '0'));
        const text = target + (el.dataset.counterSuffix || '');

        if (reduceMotion) {
            el.textContent = text;
            return;
        }

        el.setAttribute('aria-label', text);
        el.textContent = '';
        const columns = [];
        [...text].forEach((char) => {
            if (!/\d/.test(char)) {
                el.append(Object.assign(document.createElement('span'), { textContent: char, ariaHidden: 'true' }));
                return;
            }
            const digit = document.createElement('span');
            digit.className = 't-digit';
            digit.setAttribute('aria-hidden', 'true');
            const column = document.createElement('span');
            column.className = 't-digit-col';
            column.innerHTML = Array.from({ length: 20 }, (_, i) => '<span>' + (i % 10) + '</span>').join('');
            digit.append(column);
            el.append(digit);
            columns.push({ column, value: Number(char) });
        });

        ScrollTrigger.create({
            trigger: el,
            start: 'top bottom',
            once: true,
            onEnter: () => {
                columns.forEach(({ column, value }, i) => {
                    // 20 filas: termina en la segunda vuelta (value + 10) → gira una vuelta completa.
                    gsap.to(column, {
                        yPercent: -(value + 10) * 5,
                        duration: token('--t-counter-duration', 1.4) + i * token('--t-counter-stagger', 0.12),
                        ease: 'power3.out',
                    });
                });
            },
        });
    });

    document.querySelectorAll('[data-bar]').forEach((el) => {
        const target = parseFloat(el.dataset.bar || '0');

        if (reduceMotion) {
            gsap.set(el, { width: target + '%' });
            return;
        }

        gsap.set(el, { width: '0%' });

        ScrollTrigger.create({
            trigger: el,
            start: 'top bottom',
            once: true,
            onEnter: () => {
                gsap.to(el, { width: target + '%', duration: 1.2, ease: 'power2.out' });
            },
        });
    });
}

/**
 * Animaciones de showcase (inspiradas en voiceflow.com):
 *  - [data-animate="words"] → Texts reveal: el titular entra palabra por palabra (blur + slide) al verse.
 *  - [data-draw]            → trazo SVG que se dibuja al entrar en viewport.
 *  - [data-match]           → filas .match-row pasan queued → running → passed.
 *  - [data-type]            → líneas [data-type-line] que se "teclean" una tras otra.
 */
function splitWords(node) {
    [...node.childNodes].forEach((child) => {
        if (child.nodeType === Node.TEXT_NODE) {
            const frag = document.createDocumentFragment();
            child.textContent.split(/(\s+)/).forEach((part) => {
                if (!part) return;
                if (/^\s+$/.test(part)) {
                    frag.append(' ');
                } else {
                    const span = document.createElement('span');
                    span.className = 'word';
                    span.textContent = part;
                    frag.append(span);
                }
            });
            child.replaceWith(frag);
        } else if (child.nodeType === Node.ELEMENT_NODE) {
            splitWords(child);
        }
    });
}

function initShowcase() {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const once = (trigger, run, start = 'top 80%') =>
        ScrollTrigger.create({ trigger, start, once: true, onEnter: run });

    document.querySelectorAll('[data-animate="words"]').forEach((el) => {
        splitWords(el);
        if (reduceMotion) return;
        gsap.fromTo(
            el.querySelectorAll('.word'),
            { opacity: 0, y: token('--t-reveal-distance', 28), filter: `blur(${token('--t-reveal-blur', 8)}px)` },
            {
                opacity: 1, y: 0, filter: 'blur(0px)', duration: token('--t-reveal-duration', 0.9), ease: 'power3.out',
                stagger: token('--t-reveal-stagger', 0.07), delay: parseFloat(el.dataset.animateDelay || 0),
                scrollTrigger: { trigger: el, start: 'top 88%', once: true },
            }
        );
    });

    document.querySelectorAll('[data-draw]').forEach((path) => {
        const length = path.getTotalLength();
        if (reduceMotion) return;
        gsap.set(path, { strokeDasharray: length, strokeDashoffset: length });
        once(path, () => gsap.to(path, { strokeDashoffset: 0, duration: 2, ease: 'power2.inOut' }));
    });

    document.querySelectorAll('[data-match]').forEach((list) => {
        const rows = [...list.querySelectorAll('.match-row')];
        if (reduceMotion) {
            rows.forEach((row) => row.classList.add('is-passed'));
            return;
        }
        once(list, () => {
            rows.forEach((row, i) => {
                gsap.delayedCall(i * 1.1, () => row.classList.add('is-running'));
                gsap.delayedCall(i * 1.1 + 0.9, () => {
                    row.classList.remove('is-running');
                    row.classList.add('is-passed');
                });
            });
        });
    });

    document.querySelectorAll('[data-type]').forEach((box) => {
        const lines = [...box.querySelectorAll('[data-type-line]')];
        const texts = lines.map((line) => line.textContent);
        if (reduceMotion) return;
        lines.forEach((line) => (line.textContent = ''));
        once(box, () => {
            const tl = gsap.timeline();
            lines.forEach((line, i) => {
                const state = { n: 0 };
                tl.to(state, {
                    n: texts[i].length,
                    duration: Math.max(0.3, texts[i].length * 0.02),
                    ease: 'none',
                    onUpdate: () => (line.textContent = texts[i].slice(0, Math.round(state.n))),
                }, '+=0.25');
            });
        });
    });
}

function init() {
    initScrollAnimations();
    initShowcase();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

// Las posiciones de ScrollTrigger se calculan con el layout en el momento en
// que se crean; si una fuente web o imagen carga después y mueve el
// contenido, los triggers quedan desalineados (p. ej. un contador que nunca
// dispara). Recalculamos cuando la página termina de cargar del todo.
window.addEventListener('load', () => ScrollTrigger.refresh());


// <form data-confirm="mensaje"> pide confirmación en el modal global (components/confirm-modal).
document.addEventListener('submit', (e) => {
    const form = e.target;
    if (!form.dataset?.confirm || form.dataset.confirmed) return;

    e.preventDefault();
    window.dispatchEvent(new CustomEvent('confirm-action', { detail: { form, message: form.dataset.confirm } }));
});

// Error state shake: marca (y hace vibrar) el último campo antes de cada mensaje [data-error].
function initErrorShake() {
    document.querySelectorAll('[data-error]').forEach((error) => {
        const fields = [...error.parentElement.querySelectorAll('input:not([type=hidden]), select, textarea')]
            .filter((f) => f.compareDocumentPosition(error) & Node.DOCUMENT_POSITION_FOLLOWING);
        const field = fields.at(-1);
        if (!field) return;

        field.setAttribute('aria-invalid', 'true');
        field.classList.add('t-shake');
        field.addEventListener('animationend', () => field.classList.remove('t-shake'), { once: true });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initErrorShake);
} else {
    initErrorShake();
}

// Indicador de carga: barra superior + píldora al navegar a otra página (links internos y formularios).
function initPageLoader() {
    const root = document.documentElement;
    const bar = document.createElement('div');
    bar.id = 't-loader-bar';
    const pill = document.createElement('div');
    pill.id = 't-loader-pill';
    pill.setAttribute('role', 'status');
    pill.innerHTML = '<i></i>Cargando…';
    document.body.append(bar, pill);

    // El progreso se guarda en sessionStorage: la página nueva retoma la barra donde quedó
    // y la completa al 100% cuando termina de cargar de verdad (evento load).
    const KEY = 't-loading';
    const save = (p) => { try { sessionStorage.setItem(KEY, JSON.stringify({ p, t: Date.now() })); } catch { /* sin storage: la barra solo corre en la página actual */ } };
    const clear = () => { try { sessionStorage.removeItem(KEY); } catch { /* idem */ } };

    let timer;
    const stop = () => {
        clearInterval(timer);
        clear();
        root.classList.remove('is-loading');
        bar.style.transform = 'scaleX(0)';
    };
    const start = () => {
        let progress = 0.08;
        const set = () => { bar.style.transform = `scaleX(${progress})`; save(progress); };
        set();
        root.classList.add('is-loading');
        clearInterval(timer);
        // Avanza hasta ~70% mientras sale la página actual; la nueva retoma desde ahí.
        timer = setInterval(() => {
            progress += (0.7 - progress) * 0.07;
            set();
        }, 200);
        setTimeout(stop, 20000); // seguro: descargas o navegaciones canceladas
    };

    // Página nueva: retoma la barra anterior y la lleva al 100% al terminar de cargar.
    let resumed = null;
    try { resumed = JSON.parse(sessionStorage.getItem(KEY)); } catch { /* sin storage */ }
    clear();
    if (resumed && Date.now() - resumed.t < 15000) {
        bar.style.transition = 'none';
        bar.style.transform = `scaleX(${resumed.p})`;
        root.classList.add('is-finishing');
        void bar.offsetWidth; // fija la posición inicial antes de reactivar la transición
        bar.style.transition = '';
        bar.style.transform = 'scaleX(0.85)'; // DOM listo
        const finish = () => {
            bar.style.transform = 'scaleX(1)';
            setTimeout(() => {
                root.classList.remove('is-finishing');
                setTimeout(() => (bar.style.transform = 'scaleX(0)'), 300);
            }, 450);
        };
        document.readyState === 'complete' ? finish() : window.addEventListener('load', finish, { once: true });
    }

    document.addEventListener('click', (e) => {
        const link = e.target.closest?.('a[href]');
        if (!link || e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        if (link.target === '_blank' || link.hasAttribute('download') || link.dataset.noLoader !== undefined) return;

        const url = new URL(link.href, location.href);
        const samePageHash = url.pathname === location.pathname && url.search === location.search && url.hash;
        if (url.origin !== location.origin || samePageHash || !/^https?:$/.test(url.protocol)) return;
        start();
    });

    // Se registra después del listener de confirmación: si éste canceló el envío, no mostramos carga.
    document.addEventListener('submit', (e) => {
        if (!e.defaultPrevented && e.target.target !== '_blank') start();
    });

    window.addEventListener('pageshow', (e) => e.persisted && stop()); // volver con "atrás"
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPageLoader);
} else {
    initPageLoader();
}

// Input clear with dissolve: botón × en [data-clearable]; el texto se disuelve y luego se vacía.
function initClearableInputs() {
    document.querySelectorAll('input[data-clearable]').forEach((input) => {
        const wrap = document.createElement('span');
        wrap.style.cssText = 'position:relative;display:block';
        input.replaceWith(wrap);
        wrap.append(input);
        input.style.paddingRight = '2.5rem';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 't-clear-btn';
        btn.setAttribute('aria-label', 'Borrar texto');
        btn.textContent = '×';
        wrap.append(btn);

        const sync = () => btn.classList.toggle('is-visible', input.value !== '');
        input.addEventListener('input', sync);
        sync();

        btn.addEventListener('click', () => {
            const done = () => {
                input.classList.remove('t-dissolve');
                input.value = '';
                sync();
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.focus();
            };
            btn.classList.remove('is-visible');
            input.classList.add('t-dissolve');
            input.addEventListener('animationend', done, { once: true });
            // Sin animación (movimiento reducido) animationend no dispara.
            if (getComputedStyle(input).animationName === 'none') done();
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initClearableInputs);
} else {
    initClearableInputs();
}
