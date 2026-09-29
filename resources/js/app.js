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
 */
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

    document.querySelectorAll('[data-counter]').forEach((el) => {
        const target = parseFloat(el.dataset.counter || '0');
        const counter = { value: 0 };
        const suffix = el.dataset.counterSuffix || '';

        const run = () => {
            gsap.to(counter, {
                value: target,
                duration: 1.4,
                ease: 'power2.out',
                onUpdate: () => {
                    el.textContent = Math.round(counter.value) + suffix;
                },
            });
        };

        if (reduceMotion) {
            el.textContent = target + suffix;
            return;
        }

        ScrollTrigger.create({
            trigger: el,
            start: 'top bottom',
            once: true,
            onEnter: run,
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollAnimations);
} else {
    initScrollAnimations();
}

// Las posiciones de ScrollTrigger se calculan con el layout en el momento en
// que se crean; si una fuente web o imagen carga después y mueve el
// contenido, los triggers quedan desalineados (p. ej. un contador que nunca
// dispara). Recalculamos cuando la página termina de cargar del todo.
window.addEventListener('load', () => ScrollTrigger.refresh());

