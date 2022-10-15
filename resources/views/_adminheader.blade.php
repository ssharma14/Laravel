<header class="relative z-50 w-full flex-none text-sm font-semibold leading-6 text-slate-900 border-b-2 border-b-black">
    <nav aria-label="Global" class="mx-auto max-w-container px-4 sm:px-6 lg:px-8">
        <div class="relative flex items-center py-[2.125rem]">
            <a class="mr-auto flex-none text-slate-900" href="/"><img src="/images/logo.png" alt="logo"></a>
            <div class="hidden lg:flex lg:items-center">
                <a class="font-semibold border-transparent border-b-2 border-transparent hover:border-black" href="/admin/works">All Work Posts</a>
                <a class="font-semibold ml-8 border-transparent border-b-2 border-transparent hover:border-black" href="/admin/works/create">New Work Post</a>
                <a class="font-semibold ml-8 border-transparent border-b-2 border-transparent hover:border-black" href="/logout">Logout</a>
            </div>
            <button id="nav-open-button" type="button" class="-my-1 ml-6 -mr-1 flex h-12 w-12 items-center nav-open-button justify-center lg:hidden">
                <span class="sr-only">Open navigation</span>
                <svg viewBox="0 0 24 24" class="h-10 w-10 stroke-slate-900"><path d="M3.75 12h16.5M3.75 6.75h16.5M3.75 17.25h16.5" fill="none" stroke-width="1.5" stroke-linecap="round"></path></svg>
            </button>
            <div id="nav-menu" class="nav-menu fixed inset-0 z-50 overflow-hidden lg:hidden" role="dialog" aria-modal="true" style="display: none">
                <div class="absolute inset-0 bg-slate-900/25 backdrop-blur-sm transition-opacity opacity-100"></div>
                <div class="fixed inset-0 flex items-start justify-end overflow-y-auto translate-x-0">
                    <div class="min-h-full w-[min(20rem,calc(100vw-theme(spacing.10)))] bg-white shadow-2xl ring-1 ring-black/10 transition">
                        <h2 class="sr-only">Navigation</h2>
                        <button id="button-close" type="button" class="button-close absolute top-5 right-6 flex h-12 w-12 items-center justify-center" tabindex="0">
                            <span class="sr-only">Close navigation</span><svg class="h-3.5 w-3.5 overflow-visible stroke-slate-900" fill="none" stroke-width="1.5" stroke-linecap="round" xmlns="http://www.w3.org/2000/svg"><path d="M0 0L14 14M14 0L0 14"></path></svg>
                        </button>
                        <nav class="divide-y divide-slate-900/10 text-base leading-7 text-slate-900">
                            <div class="py-6 px-8">
                                <div class="-my-2 items-start space-y-2 mt-16">
                                    <a class="font-semibold border-transparent border-b-2 border-transparent hover:border-black" href="/admin/works">All Work Posts</a>
                                    <a class="font-semibold ml-8 border-transparent border-b-2 border-transparent hover:border-black" href="/admin/works/create">New Work Post</a>
                                    <a class="font-semibold ml-8 border-transparent border-b-2 border-transparent hover:border-black" href="/logout">Logout</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
