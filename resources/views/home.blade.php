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
                    <p>I'm a developer with 7+ years of experience building and maintaining enterprise web applications, CMS platforms, and integrated business systems. I love turning complex problems into elegant, accessible, user-focused solutions.</p>

                    <p>I work across the stack with JavaScript, TypeScript, React, PHP, and ASP.NET C#, building REST APIs and reusable, scalable application architecture. I'm just as comfortable troubleshooting tricky production issues as I am shaping component systems documented in Storybook, collaborating with cross-functional Agile teams along the way.</p>

                    <p>I've delivered award-winning projects including <a href="https://www.ogilvielaw.com/" target="_blank">Ogilvie</a> (ACE Award for best website under 50K), <a href="https://mcsnet.ca/" target="_blank">MCSnet</a>, <a href="https://kagcanada.ca/" target="_blank">KAG Canada</a>, and <a href="https://alwaysplumbing.ca/" target="_blank">Always Plumbing & Heating</a>.</p>

                    <p>When I'm not coding, you'll find me trekking through nature trails, sketching new ideas, or exploring Edmonton's food scene.</p>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section class="skills-marquee-section">
            <div class="skills-header">
                <span class="section-label">Skills</span>
                <h2 class="skills-heading">Tools &amp; technologies I work with</h2>
            </div>

            <div class="skills-grid">
                <div class="skills-group">
                    <h3 class="skills-group-title">Frontend</h3>
                    <div class="skills-pills">
                        <span class="skill-item">React <span class="years">2+ yrs</span></span>
                        <span class="skill-item">TypeScript <span class="years">2+ yrs</span></span>
                        <span class="skill-item">JavaScript <span class="years">6+ yrs</span></span>
                        <span class="skill-item">HTML <span class="years">6+ yrs</span></span>
                        <span class="skill-item">CSS <span class="years">6+ yrs</span></span>
                        <span class="skill-item">SASS <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Tailwind <span class="years">2+ yrs</span></span>
                        <span class="skill-item">React Native <span class="years">1+ yrs</span></span>
                        <span class="skill-item">jQuery <span class="years">6+ yrs</span></span>
                    </div>
                </div>

                <div class="skills-group">
                    <h3 class="skills-group-title">Backend &amp; Data</h3>
                    <div class="skills-pills">
                        <span class="skill-item">PHP <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Laravel <span class="years">3+ yrs</span></span>
                        <span class="skill-item">C# / .NET <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Next.js <span class="years">2 yrs</span></span>
                        <span class="skill-item">WordPress <span class="years">4.5+ yrs</span></span>
                        <span class="skill-item">Drupal <span class="years">3+ yrs</span></span>
                        <span class="skill-item">Payload CMS <span class="years">2 yrs</span></span>
                        <span class="skill-item">MySQL <span class="years">4.5+ yrs</span></span>
                    </div>
                </div>

                <div class="skills-group">
                    <h3 class="skills-group-title">Tooling &amp; Practices</h3>
                    <div class="skills-pills">
                        <span class="skill-item">Git <span class="years">6+ yrs</span></span>
                        <span class="skill-item">Docker <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Storybook <span class="years">2+ yrs</span></span>
                        <span class="skill-item">AWS <span class="years">2+ yrs</span></span>
                        <span class="skill-item">Webpack <span class="years">3+ yrs</span></span>
                        <span class="skill-item">REST APIs <span class="years">5+ yrs</span></span>
                        <span class="skill-item">Agile/Scrum <span class="years">3+ yrs</span></span>
                        <span class="skill-item">Responsive Design <span class="years">6+ yrs</span></span>
                        <span class="skill-item">A11y <span class="years">2+ yrs</span></span>
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
                <div class="work-list">
                    @foreach ($works as $index => $work)
                        <x-work-card :work="$work" :index="$index + 1" />
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
