import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

gsap.registerPlugin(ScrollTrigger);

class RevealAnimation {
    constructor() {
        this.stripsContainer = document.getElementById('preloader-strips');

        if (this.stripsContainer) {
            this.init();
        } else {
            document.body.classList.remove('is-loading');
            window.dispatchEvent(new CustomEvent('preloaderComplete'));
        }
    }

    init() {
        document.body.style.overflow = 'hidden';
        document.body.classList.remove('is-loading');

        const strips = this.stripsContainer.querySelectorAll('.preloader-strip');

        strips.forEach((strip) => {
            const delay = parseFloat(strip.dataset.delay) || 0;
            gsap.to(strip, {
                scaleY: 0,
                duration: 0.8,
                delay: delay,
                ease: 'power3.inOut'
            });
        });

        gsap.delayedCall(1.0, () => {
            this.stripsContainer.style.display = 'none';
            document.body.style.overflow = '';
            window.dispatchEvent(new CustomEvent('preloaderComplete'));
        });
    }
}

class CustomCursor {
    constructor() {
        this.cursor = document.getElementById('cursor');

        if (!this.cursor || window.innerWidth < 768) return;

        this.cursorDot = this.cursor.querySelector('.cursor-dot');
        this.cursorOutline = this.cursor.querySelector('.cursor-outline');
        this.cursorText = this.cursor.querySelector('.cursor-text');

        this.mouseX = 0;
        this.mouseY = 0;
        this.cursorX = 0;
        this.cursorY = 0;
        this.outlineX = 0;
        this.outlineY = 0;

        this.init();
    }

    init() {
        document.addEventListener('mousemove', (e) => {
            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
        });

        document.addEventListener('mouseleave', () => {
            this.cursor.classList.add('cursor-hidden');
        });

        document.addEventListener('mouseenter', () => {
            this.cursor.classList.remove('cursor-hidden');
        });

        this.animate();
        this.addHoverEffects();
    }

    animate() {
        // The dot tracks tightly, the outline lags behind for a trailing feel.
        this.cursorX += (this.mouseX - this.cursorX) * 0.2;
        this.cursorY += (this.mouseY - this.cursorY) * 0.2;
        this.outlineX += (this.mouseX - this.outlineX) * 0.1;
        this.outlineY += (this.mouseY - this.outlineY) * 0.1;

        this.cursorDot.style.left = `${this.cursorX}px`;
        this.cursorDot.style.top = `${this.cursorY}px`;

        this.cursorOutline.style.left = `${this.outlineX}px`;
        this.cursorOutline.style.top = `${this.outlineY}px`;

        this.cursorText.style.left = `${this.cursorX}px`;
        this.cursorText.style.top = `${this.cursorY}px`;

        requestAnimationFrame(() => this.animate());
    }

    addHoverEffects() {
        const hoverElements = document.querySelectorAll('a, button, .btn, .nav-link, .social-link, .skill-item');
        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                this.cursor.classList.add('cursor-hover');
            });
            el.addEventListener('mouseleave', () => {
                this.cursor.classList.remove('cursor-hover');
            });
        });

        const projectCards = document.querySelectorAll('.project-card');
        projectCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                this.cursor.classList.add('cursor-project');
                this.cursor.classList.remove('cursor-hover');
            });
            card.addEventListener('mouseleave', () => {
                this.cursor.classList.remove('cursor-project');
            });
        });

        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('mouseenter', () => {
                this.cursor.classList.add('cursor-hidden');
            });
            input.addEventListener('mouseleave', () => {
                this.cursor.classList.remove('cursor-hidden');
            });
        });
    }

    refresh() {
        this.addHoverEffects();
    }
}

class MagneticButtons {
    constructor() {
        this.buttons = document.querySelectorAll('.magnetic-btn');
        if (this.buttons.length && window.innerWidth >= 768) {
            this.init();
        }
    }

    init() {
        this.buttons.forEach(btn => {
            const inner = btn.querySelector('.magnetic-btn-inner') || btn;

            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;

                gsap.to(inner, {
                    x: x * 0.3,
                    y: y * 0.3,
                    duration: 0.4,
                    ease: 'power2.out'
                });
            });

            btn.addEventListener('mouseleave', () => {
                gsap.to(inner, {
                    x: 0,
                    y: 0,
                    duration: 0.4,
                    ease: 'power2.out'
                });
            });
        });
    }
}

// Splits text into spans so characters/words/lines can animate individually.
class TextSplitter {
    static splitChars(element) {
        const text = element.textContent;
        element.innerHTML = '';
        element.setAttribute('aria-label', text);

        text.split('').forEach((char) => {
            const span = document.createElement('span');
            span.className = 'char';
            span.style.display = 'inline-block';
            span.textContent = char === ' ' ? ' ' : char;
            element.appendChild(span);
        });

        return element.querySelectorAll('.char');
    }

    static splitWords(element) {
        const text = element.textContent;
        const words = text.split(' ');
        element.innerHTML = '';
        element.setAttribute('aria-label', text);

        words.forEach((word, i) => {
            const wordWrapper = document.createElement('span');
            wordWrapper.className = 'word';
            wordWrapper.style.display = 'inline-block';
            wordWrapper.style.overflow = 'hidden';

            const wordInner = document.createElement('span');
            wordInner.className = 'word-inner';
            wordInner.style.display = 'inline-block';
            wordInner.textContent = word;

            wordWrapper.appendChild(wordInner);
            element.appendChild(wordWrapper);

            if (i < words.length - 1) {
                const space = document.createElement('span');
                space.innerHTML = '&nbsp;';
                element.appendChild(space);
            }
        });

        return element.querySelectorAll('.word-inner');
    }

    static splitLines(element) {
        const lines = element.innerHTML.split('<br>');
        element.innerHTML = '';

        lines.forEach((line) => {
            const lineWrapper = document.createElement('div');
            lineWrapper.className = 'line-reveal';
            lineWrapper.style.overflow = 'hidden';

            const lineInner = document.createElement('div');
            lineInner.className = 'line-reveal-inner';
            lineInner.innerHTML = line;

            lineWrapper.appendChild(lineInner);
            element.appendChild(lineWrapper);
        });

        return element.querySelectorAll('.line-reveal-inner');
    }
}

class HeroAnimations {
    constructor() {
        this.hero = document.querySelector('.hero');
        if (!this.hero) return;

        window.addEventListener('preloaderComplete', () => this.init());
    }

    init() {
        const header = document.querySelector('.site-header');
        const heroName = this.hero.querySelector('.hero-name');
        const heroRoles = this.hero.querySelector('.hero-roles');
        const heroTagline = this.hero.querySelector('.hero-tagline');
        const heroCta = this.hero.querySelector('.hero-cta');
        const scrollIndicator = this.hero.querySelector('.scroll-indicator');

        const tl = gsap.timeline({ delay: 0.1 });

        if (header) {
            tl.to(header, {
                opacity: 1,
                duration: 0.6,
                ease: 'power3.out'
            });
        }

        if (heroName) {
            const firstName = heroName.querySelector('.hero-name-first');
            const lastName = heroName.querySelector('.hero-name-last');

            let allChars = [];
            if (firstName) {
                allChars = [...TextSplitter.splitChars(firstName)];
            }
            if (lastName) {
                allChars = [...allChars, ...TextSplitter.splitChars(lastName)];
            }
            if (allChars.length === 0) {
                allChars = TextSplitter.splitChars(heroName);
            }

            // Reveal the name now that its characters are split and hidden.
            heroName.classList.add('ready');
            tl.to(allChars, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.03,
                ease: 'power3.out'
            }, '-=0.3');
        }

        if (heroRoles) {
            tl.to(heroRoles, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.4');

            this.cycleRoles();
        }

        if (heroTagline) {
            tl.to(heroTagline, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.3');
        }

        if (heroCta) {
            tl.to(heroCta, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.3');
        }

        if (scrollIndicator) {
            tl.to(scrollIndicator, {
                opacity: 1,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.2');
        }
    }

    cycleRoles() {
        const roleElement = document.querySelector('.hero-role-text');
        if (!roleElement) return;

        const roles = [
            'Frontend Developer',
            'React Specialist',
            'Drupal Expert',
            'Freelancer'
        ];

        let currentIndex = 0;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % roles.length;

            gsap.to(roleElement, {
                opacity: 0,
                y: -10,
                duration: 0.3,
                ease: 'power2.in',
                onComplete: () => {
                    roleElement.textContent = roles[currentIndex];
                    gsap.fromTo(roleElement,
                        { opacity: 0, y: 10 },
                        { opacity: 1, y: 0, duration: 0.3, ease: 'power2.out' }
                    );
                }
            });
        }, 3000);
    }
}

class ScrollAnimations {
    constructor(lenis) {
        this.lenis = lenis;
        this.init();
    }

    init() {
        this.animateAboutSection();
        this.animateSkillsMarquee();
        this.animateWorkSection();
        this.animateContactSection();
        this.setupSectionStacking();
        this.setupScrollSpy();
    }

    setupScrollSpy() {
        const links = Array.from(document.querySelectorAll('.nav-link[href^="#"]'));
        if (!links.length) return;

        const setActive = (id) => {
            links.forEach((link) => {
                link.classList.toggle('active', link.getAttribute('href') === '#' + id);
            });
        };

        // Skills has no nav link of its own, so it keeps "About" active.
        const sections = [
            { id: 'about', selectors: ['#about', '.skills-marquee-section'] },
            { id: 'work', selectors: ['#work'] },
            { id: 'contact', selectors: ['#contact'] },
        ];

        sections.forEach(({ id, selectors }) => {
            selectors.forEach((selector) => {
                const el = document.querySelector(selector);
                if (!el) return;

                ScrollTrigger.create({
                    trigger: el,
                    start: 'top center',
                    end: 'bottom center',
                    onToggle: (self) => {
                        if (self.isActive) setActive(id);
                    }
                });
            });
        });
    }

    setupSectionStacking() {
        if (window.innerWidth < 1024) return;
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        // Pin the last section of each layer so the next one slides up and covers
        // it. About stays unpinned so Skills rides over the banner with it.
        // Full-height sections pin at 'bottom bottom'; the shorter skills marquee
        // pins at 'center center' so it's centred before Projects covers it.
        const covered = [
            { selector: '.hero', start: 'bottom bottom' },
            { selector: '.skills-marquee-section', start: 'center center', requireFit: true },
            { selector: '.work-section', start: 'bottom bottom' },
        ];
        covered.forEach(({ selector, start, requireFit }) => {
            const el = document.querySelector(selector);
            if (!el) return;

            // If a section is taller than the viewport, don't pin it — the overlap
            // would hide its lower rows before they can be read.
            if (requireFit && el.offsetHeight > window.innerHeight - 40) return;

            ScrollTrigger.create({
                trigger: el,
                start,
                end: '+=' + window.innerHeight,
                pin: true,
                pinSpacing: false,
                anticipatePin: 1,
                invalidateOnRefresh: true
            });
        });
    }

    animateAboutSection() {
        const aboutSection = document.querySelector('.about-section');
        if (!aboutSection) return;

        const aboutImage = aboutSection.querySelector('.about-image');
        if (aboutImage) {
            gsap.from(aboutImage, {
                scrollTrigger: {
                    trigger: aboutImage,
                    start: 'top 80%',
                    once: true
                },
                opacity: 0,
                scale: 0.95,
                duration: 1,
                ease: 'power3.out'
            });
        }

        const paragraphs = aboutSection.querySelectorAll('.about-text p');
        paragraphs.forEach((p, i) => {
            gsap.to(p, {
                scrollTrigger: {
                    trigger: p,
                    start: 'top 85%',
                    once: true
                },
                opacity: 1,
                y: 0,
                duration: 0.8,
                delay: i * 0.1,
                ease: 'power3.out'
            });
        });

        const heading = aboutSection.querySelector('.about-heading');
        if (heading) {
            gsap.from(heading, {
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 85%',
                    once: true
                },
                opacity: 0,
                y: 30,
                duration: 0.8,
                ease: 'power3.out'
            });
        }

        const badge = aboutSection.querySelector('.freelance-badge');
        if (badge) {
            gsap.from(badge, {
                scrollTrigger: {
                    trigger: badge,
                    start: 'top 90%',
                    once: true
                },
                opacity: 0,
                x: -20,
                duration: 0.6,
                ease: 'power3.out'
            });
        }
    }

    animateSkillsMarquee() {
        const section = document.querySelector('.skills-marquee-section');
        if (!section) return;

        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

        const header = section.querySelector('.skills-header');
        const groups = section.querySelectorAll('.skills-group');

        if (header) {
            gsap.from(header, {
                scrollTrigger: { trigger: section, start: 'top 80%', once: true },
                opacity: 0,
                y: 24,
                duration: 0.7,
                ease: 'power3.out'
            });
        }

        if (groups.length) {
            gsap.from(groups, {
                scrollTrigger: { trigger: section, start: 'top 75%', once: true },
                opacity: 0,
                y: 32,
                duration: 0.7,
                stagger: 0.12,
                ease: 'power3.out'
            });
        }
    }

    animateWorkSection() {
        const workSection = document.querySelector('.work-section');
        if (!workSection) return;

        const workHeading = workSection.querySelector('.work-heading');
        if (workHeading) {
            gsap.from(workHeading, {
                scrollTrigger: {
                    trigger: workHeading,
                    start: 'top 80%',
                    once: true
                },
                opacity: 0,
                y: 50,
                duration: 1,
                ease: 'power3.out'
            });
        }

        this.setupWorkReveal();
    }

    setupWorkReveal() {
        const cards = gsap.utils.toArray('.project-card');
        if (!cards.length) return;

        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        cards.forEach((card, index) => {
            // Alternate the slide direction so cards zig-zag in from each side.
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 82%',
                    once: true
                },
                opacity: 0,
                y: 70,
                x: reduceMotion ? 0 : (index % 2 === 0 ? -48 : 48),
                duration: 1,
                ease: 'power3.out'
            });
        });
    }

    animateContactSection() {
        const contactSection = document.querySelector('.contact-section');
        if (!contactSection) return;

        const heading = contactSection.querySelector('.contact-heading');
        const subtext = contactSection.querySelector('.contact-subtext');
        const email = contactSection.querySelector('.contact-email');
        const socials = contactSection.querySelector('.contact-socials');

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: contactSection,
                start: 'top 60%',
                once: true
            }
        });

        if (heading) {
            tl.from(heading, {
                opacity: 0,
                y: 50,
                duration: 1,
                ease: 'power3.out'
            });
        }

        if (subtext) {
            tl.from(subtext, {
                opacity: 0,
                y: 30,
                duration: 0.8,
                ease: 'power3.out'
            }, '-=0.6');
        }

        if (email) {
            tl.from(email, {
                opacity: 0,
                y: 20,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.4');
        }

        if (socials) {
            const links = socials.querySelectorAll('.social-link');
            tl.from(links, {
                opacity: 0,
                y: 20,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power3.out'
            }, '-=0.3');
        }
    }
}

class HeaderScroll {
    constructor(lenis) {
        this.header = document.querySelector('.site-header');
        this.lenis = lenis;

        if (this.header) {
            this.init();
        }
    }

    init() {
        this.lenis.on('scroll', ({ scroll }) => {
            this.header.classList.toggle('scrolled', scroll > 100);
        });
    }
}

class MobileNav {
    constructor() {
        this.btn = document.getElementById('nav-open-button');
        this.closeBtn = document.getElementById('button-close');
        this.menu = document.getElementById('mobile-menu');

        if (this.btn && this.menu) {
            this.init();
        }
    }

    init() {
        this.btn.addEventListener('click', () => this.toggle());

        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => this.toggle());
        }

        const links = this.menu.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', () => this.close());
        });
    }

    toggle() {
        this.menu.classList.toggle('active');
        document.body.style.overflow = this.menu.classList.contains('active') ? 'hidden' : '';
    }

    close() {
        this.menu.classList.remove('active');
        document.body.style.overflow = '';
    }
}

class SmoothScrollLinks {
    constructor(lenis) {
        this.lenis = lenis;
        this.init();
    }

    init() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = anchor.getAttribute('href');
                const target = document.querySelector(targetId);

                if (target) {
                    this.lenis.scrollTo(target, {
                        offset: -50,
                        duration: 1.5
                    });
                }
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        smoothTouch: false,
        touchMultiplier: 2,
    });

    // Drive Lenis from GSAP's ticker and keep ScrollTrigger in sync.
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);

    new RevealAnimation();
    new CustomCursor();
    new MagneticButtons();
    new HeroAnimations();
    new ScrollAnimations(lenis);
    new HeaderScroll(lenis);
    new MobileNav();
    new SmoothScrollLinks(lenis);

    document.fonts.ready.then(() => {
        ScrollTrigger.refresh();
    });
});
