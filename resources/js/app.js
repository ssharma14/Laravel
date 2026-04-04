import './bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// ==========================================
// REVEAL ANIMATION (Strip reveal on page load)
// ==========================================

class RevealAnimation {
    constructor() {
        this.stripsContainer = document.getElementById('preloader-strips');

        if (this.stripsContainer) {
            this.init();
        } else {
            // No strips, just trigger hero animations immediately
            document.body.classList.remove('is-loading');
            window.dispatchEvent(new CustomEvent('preloaderComplete'));
        }
    }

    init() {
        // Prevent scrolling during reveal
        document.body.style.overflow = 'hidden';

        // Remove loading state to reveal content behind strips
        document.body.classList.remove('is-loading');

        const strips = this.stripsContainer.querySelectorAll('.preloader-strip');

        // Animate each strip vertically from bottom to top with staggered delays
        strips.forEach((strip) => {
            const delay = parseFloat(strip.dataset.delay) || 0;
            gsap.to(strip, {
                scaleY: 0,
                duration: 0.8,
                delay: delay,
                ease: 'power3.inOut'
            });
        });

        // Complete after all animations
        gsap.delayedCall(1.0, () => {
            this.stripsContainer.style.display = 'none';
            document.body.style.overflow = '';
            // Trigger hero animations
            window.dispatchEvent(new CustomEvent('preloaderComplete'));
        });
    }
}

// ==========================================
// CUSTOM CURSOR
// ==========================================

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
        // Track mouse movement
        document.addEventListener('mousemove', (e) => {
            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
        });

        // Hide cursor when leaving window
        document.addEventListener('mouseleave', () => {
            this.cursor.classList.add('cursor-hidden');
        });

        document.addEventListener('mouseenter', () => {
            this.cursor.classList.remove('cursor-hidden');
        });

        // Animate cursor
        this.animate();

        // Add hover effects
        this.addHoverEffects();
    }

    animate() {
        // Smooth follow for dot
        this.cursorX += (this.mouseX - this.cursorX) * 0.2;
        this.cursorY += (this.mouseY - this.cursorY) * 0.2;

        // Smoother follow for outline
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
        // Regular hover elements
        const hoverElements = document.querySelectorAll('a, button, .btn, .nav-link, .social-link, .skill-item');
        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                this.cursor.classList.add('cursor-hover');
            });
            el.addEventListener('mouseleave', () => {
                this.cursor.classList.remove('cursor-hover');
            });
        });

        // Project cards - show "View" text
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

        // Input fields - hide cursor
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

    // Refresh hover effects (call after dynamic content load)
    refresh() {
        this.addHoverEffects();
    }
}

// ==========================================
// MAGNETIC BUTTONS
// ==========================================

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

// ==========================================
// TEXT SPLIT ANIMATION
// ==========================================

class TextSplitter {
    static splitChars(element) {
        const text = element.textContent;
        element.innerHTML = '';
        element.setAttribute('aria-label', text);

        text.split('').forEach((char, i) => {
            const span = document.createElement('span');
            span.className = 'char';
            span.style.display = 'inline-block';
            span.textContent = char === ' ' ? '\u00A0' : char;
            element.appendChild(span);
        });

        return element.querySelectorAll('.char');
    }

    static splitWords(element) {
        const text = element.textContent;
        element.innerHTML = '';
        element.setAttribute('aria-label', text);

        text.split(' ').forEach((word, i) => {
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

            // Add space between words
            if (i < text.split(' ').length - 1) {
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

        lines.forEach((line, i) => {
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

// ==========================================
// HERO ANIMATIONS
// ==========================================

class HeroAnimations {
    constructor() {
        this.hero = document.querySelector('.hero');
        if (!this.hero) return;

        // Wait for reveal animation to complete
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

        // Animate header first
        if (header) {
            tl.to(header, {
                opacity: 1,
                duration: 0.6,
                ease: 'power3.out'
            });
        }

        // Animate name characters
        if (heroName) {
            // Split each name part separately
            const firstName = heroName.querySelector('.hero-name-first');
            const lastName = heroName.querySelector('.hero-name-last');

            let allChars = [];
            if (firstName) {
                const firstChars = TextSplitter.splitChars(firstName);
                allChars = [...firstChars];
            }
            if (lastName) {
                const lastChars = TextSplitter.splitChars(lastName);
                allChars = [...allChars, ...lastChars];
            }

            // Fallback if no spans found
            if (allChars.length === 0) {
                allChars = TextSplitter.splitChars(heroName);
            }

            // Make parent visible now that chars are split and hidden
            heroName.classList.add('ready');
            tl.to(allChars, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.03,
                ease: 'power3.out'
            }, '-=0.3');
        }

        // Animate roles
        if (heroRoles) {
            tl.to(heroRoles, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.4');

            // Start role cycling
            this.cycleRoles();
        }

        // Animate tagline
        if (heroTagline) {
            tl.to(heroTagline, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.3');
        }

        // Animate CTA buttons
        if (heroCta) {
            tl.to(heroCta, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power3.out'
            }, '-=0.3');
        }

        // Animate scroll indicator
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

// ==========================================
// SCROLL ANIMATIONS
// ==========================================

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
    }

    animateAboutSection() {
        const aboutSection = document.querySelector('.about-section');
        if (!aboutSection) return;

        // Image reveal
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

        // Text reveal
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

        // Heading animation
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

        // Badge animation
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
        const marqueeSection = document.querySelector('.skills-marquee-section');
        if (!marqueeSection) return;

        gsap.from(marqueeSection, {
            scrollTrigger: {
                trigger: marqueeSection,
                start: 'top 90%',
                once: true
            },
            opacity: 0,
            duration: 0.8,
            ease: 'power3.out'
        });
    }

    animateWorkSection() {
        const workSection = document.querySelector('.work-section');
        if (!workSection) return;

        // Heading animation
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

        // Horizontal scroll (desktop only)
        if (window.innerWidth >= 768) {
            this.setupHorizontalScroll();
        }
    }

    setupHorizontalScroll() {
        const wrapper = document.querySelector('.horizontal-scroll-wrapper');
        const container = document.querySelector('.horizontal-scroll-container');

        if (!wrapper || !container) return;

        const cards = container.querySelectorAll('.project-card');
        if (cards.length === 0) return;

        // Calculate scroll distance
        const totalWidth = container.scrollWidth;
        const viewportWidth = window.innerWidth;
        const scrollDistance = totalWidth - viewportWidth + 100;

        gsap.to(container, {
            x: -scrollDistance,
            ease: 'none',
            scrollTrigger: {
                trigger: wrapper,
                start: 'top top',
                end: `+=${scrollDistance}`,
                scrub: 1,
                pin: true,
                anticipatePin: 1,
                invalidateOnRefresh: true
            }
        });

        // Animate cards as they come into view
        cards.forEach((card, index) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: wrapper,
                    start: 'top center',
                    once: true
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                delay: index * 0.15,
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

// ==========================================
// HEADER SCROLL EFFECT
// ==========================================

class HeaderScroll {
    constructor(lenis) {
        this.header = document.querySelector('.site-header');
        this.lenis = lenis;

        if (this.header) {
            this.init();
        }
    }

    init() {
        let lastScroll = 0;

        this.lenis.on('scroll', ({ scroll }) => {
            if (scroll > 100) {
                this.header.classList.add('scrolled');
            } else {
                this.header.classList.remove('scrolled');
            }
            lastScroll = scroll;
        });
    }
}

// ==========================================
// MOBILE NAVIGATION
// ==========================================

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

        // Close on link click
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

// ==========================================
// SMOOTH SCROLL LINKS
// ==========================================

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

// ==========================================
// MOBILE SCROLL HINT
// ==========================================

class MobileScrollHint {
    constructor() {
        this.wrapper = document.querySelector('.horizontal-scroll-wrapper');
        this.hint = document.querySelector('.scroll-hint');
        this.dots = document.querySelectorAll('.scroll-dot');
        this.cards = document.querySelectorAll('.project-card');

        if (this.wrapper && window.innerWidth < 768) {
            this.init();
        }
    }

    init() {
        this.currentIndex = 0;

        this.wrapper.addEventListener('scroll', () => {
            const maxScroll = this.wrapper.scrollWidth - this.wrapper.clientWidth;
            const currentScroll = this.wrapper.scrollLeft;

            // Hide gradient when scrolled to end
            if (currentScroll >= maxScroll - 10) {
                this.wrapper.classList.add('scrolled-end');
            } else {
                this.wrapper.classList.remove('scrolled-end');
            }

            // Update active dot based on scroll position
            this.updateActiveDot(currentScroll);
        });

        // Click hint to go to next project
        if (this.hint) {
            this.hint.addEventListener('click', () => this.scrollToNext());
        }

        // Click dots to go to specific project
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.scrollToIndex(index));
            dot.style.cursor = 'pointer';
        });
    }

    scrollToNext() {
        if (!this.cards.length) return;

        const cardWidth = this.cards[0].offsetWidth;
        const gap = 32; // 2rem gap
        const currentScroll = this.wrapper.scrollLeft;

        // Calculate current index
        this.currentIndex = Math.round(currentScroll / (cardWidth + gap));

        // Go to next, or loop back to first
        const nextIndex = (this.currentIndex + 1) % this.cards.length;
        this.scrollToIndex(nextIndex);
    }

    scrollToIndex(index) {
        if (!this.cards.length) return;

        const cardWidth = this.cards[0].offsetWidth;
        const gap = 32;
        const targetScroll = index * (cardWidth + gap);

        this.wrapper.scrollTo({
            left: targetScroll,
            behavior: 'smooth'
        });
    }

    updateActiveDot(scrollLeft) {
        if (!this.dots.length || !this.cards.length) return;

        const cardWidth = this.cards[0].offsetWidth;
        const gap = 32; // 2rem gap
        const activeIndex = Math.round(scrollLeft / (cardWidth + gap));

        this.dots.forEach((dot, index) => {
            if (index === activeIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }
}

// ==========================================
// INITIALIZE
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lenis smooth scroll
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        smoothTouch: false,
        touchMultiplier: 2,
    });

    // Connect Lenis to GSAP ScrollTrigger
    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    // Initialize components
    new RevealAnimation();
    new CustomCursor();
    new MagneticButtons();
    new HeroAnimations();
    new ScrollAnimations(lenis);
    new HeaderScroll(lenis);
    new MobileNav();
    new SmoothScrollLinks(lenis);
    new MobileScrollHint();

    // Refresh ScrollTrigger after fonts load
    document.fonts.ready.then(() => {
        ScrollTrigger.refresh();
    });
});
