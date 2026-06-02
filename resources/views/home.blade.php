<x-layout>
    <main>
        <!-- Hero Section -->
        @include('_banner')

        <!-- About Section -->
        <section id="about" class="about-section">
            <div class="about-image-wrapper">
                <div class="about-image">
                    <img src="{{ url('/images/about-me.jpg') }}" alt="Shrishti Sharma" />
                </div>
            </div>

            <div class="about-content">
                <div class="freelance-badge">
                    Available for Freelance
                </div>

                <span class="section-label">About</span>

                <h2 class="about-heading">Building digital experiences that make an impact</h2>

                <div class="about-text">
                    <p>I'm a frontend developer who loves turning complex problems into elegant, user-friendly solutions. I focus on building fast, accessible websites that not only look great but perform exceptionally.</p>

                    <p>I specialize in integrating modern CSS and JavaScript into Drupal websites, building custom modules, and developing React components with Storybook for consistent UI documentation.</p>

                    <p>I've delivered award-winning projects including <a href="https://www.ogilvielaw.com/" target="_blank">Ogilvie</a> (ACE Award for best website under 50K), <a href="https://mcsnet.ca/" target="_blank">MCSnet</a>, <a href="https://kagcanada.ca/" target="_blank">KAG Canada</a>, and <a href="https://alwaysplumbing.ca/" target="_blank">Always Plumbing & Heating</a>.</p>

                    <p>When I'm not coding, you'll find me trekking through nature trails, sketching new ideas, or exploring Edmonton's food scene.</p>
                </div>
            </div>
        </section>

        <!-- Skills Marquee Section -->
        <section class="skills-marquee-section">
            <div class="marquee-wrapper">
                <!-- First row -->
                <div class="marquee">
                    <div class="marquee-content">
                        <span class="skill-item">HTML <span class="years">6+ yrs</span></span>
                        <span class="skill-item">CSS <span class="years">6+ yrs</span></span>
                        <span class="skill-item">JavaScript <span class="years">6+ yrs</span></span>
                        <span class="skill-item">TypeScript <span class="years">2+ yrs</span></span>
                        <span class="skill-item">React <span class="years">2+ yrs</span></span>
                        <span class="skill-item">React Native <span class="years">1+ yrs</span></span>
                        <span class="skill-item">SASS <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Tailwind <span class="years">2+ yrs</span></span>
                        <span class="skill-item">jQuery <span class="years">6+ yrs</span></span>
                        <span class="skill-item">A11y <span class="years">2+ yrs</span></span>
                        <!-- Duplicate for seamless loop -->
                        <span class="skill-item">HTML <span class="years">6+ yrs</span></span>
                        <span class="skill-item">CSS <span class="years">6+ yrs</span></span>
                        <span class="skill-item">JavaScript <span class="years">6+ yrs</span></span>
                        <span class="skill-item">TypeScript <span class="years">2+ yrs</span></span>
                        <span class="skill-item">React <span class="years">2+ yrs</span></span>
                        <span class="skill-item">React Native <span class="years">1+ yrs</span></span>
                        <span class="skill-item">SASS <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Tailwind <span class="years">2+ yrs</span></span>
                        <span class="skill-item">jQuery <span class="years">6+ yrs</span></span>
                        <span class="skill-item">A11y <span class="years">2+ yrs</span></span>
                    </div>
                </div>

                <!-- Second row (reverse direction) -->
                <div class="marquee reverse">
                    <div class="marquee-content">
                        <span class="skill-item">PHP <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Laravel <span class="years">3+ yrs</span></span>
                        <span class="skill-item">WordPress <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Drupal <span class="years">3+ yrs</span></span>
                        <span class="skill-item">MySQL <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Git <span class="years">6+ yrs</span></span>
                        <span class="skill-item">Docker <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Storybook <span class="years">2+ yrs</span></span>
                        <span class="skill-item">AWS <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Webpack <span class="years">3+ yrs</span></span>
                        <!-- Duplicate for seamless loop -->
                        <span class="skill-item">PHP <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Laravel <span class="years">3+ yrs</span></span>
                        <span class="skill-item">WordPress <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Drupal <span class="years">3+ yrs</span></span>
                        <span class="skill-item">MySQL <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Git <span class="years">6+ yrs</span></span>
                        <span class="skill-item">Docker <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Storybook <span class="years">2+ yrs</span></span>
                        <span class="skill-item">AWS <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Webpack <span class="years">3+ yrs</span></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Work Section -->
        <section id="work" class="work-section">
            <div class="work-header">
                <span class="section-label">Selected Work</span>
                <h2 class="work-heading">Projects I've <span>Built</span></h2>
            </div>

            @if($works->count())
                <!-- Mobile swipe hint (clickable) -->
                <button type="button" class="scroll-hint" aria-label="Go to next project">
                    <span>Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>

                <div class="horizontal-scroll-wrapper">
                    <div class="horizontal-scroll-container">
                        @foreach ($works as $index => $work)
                            <x-work-card :work="$work" :index="$index + 1" />
                        @endforeach
                    </div>
                </div>

                <!-- Mobile scroll dots -->
                <div class="scroll-dots">
                    @foreach ($works as $index => $work)
                        <div class="scroll-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact-section">
            <span class="section-label">Contact</span>

            <h2 class="contact-heading">Let's work<br>together</h2>

            <p class="contact-subtext">
                Have a project in mind? I'm always open to discussing new opportunities, creative ideas, or ways to bring your vision to life.
            </p>

            <a href="mailto:sshrishti14@gmail.com" class="magnetic-btn">
                <span class="magnetic-btn-inner contact-email">sshrishti14@gmail.com</span>
            </a>

            <div class="contact-socials">
                <a href="https://github.com/ssharma14" target="_blank" class="social-link">GitHub</a>
                <a href="https://www.linkedin.com/in/shrishti-s-4b03aa9a/" target="_blank" class="social-link">LinkedIn</a>
            </div>
        </section>

        @include('_footer')
    </main>
</x-layout>
