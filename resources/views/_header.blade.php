<header class="site-header">
    <nav class="flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="nav-link font-display text-base font-semibold tracking-normal normal-case">
            SS
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center gap-8">
            <a href="#about" class="nav-link">About</a>
            <a href="#work" class="nav-link">Work</a>
            <a href="#contact" class="nav-link">Contact</a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="nav-open-button" type="button" class="md:hidden flex flex-col gap-1.5 p-2" aria-label="Open menu">
            <span class="w-6 h-px bg-white"></span>
            <span class="w-6 h-px bg-white"></span>
        </button>
    </nav>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu">
    <button id="button-close" type="button" class="absolute top-6 right-6 p-2" aria-label="Close menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <a href="#about" class="nav-link">About</a>
    <a href="#work" class="nav-link">Work</a>
    <a href="#contact" class="nav-link">Contact</a>
</div>
