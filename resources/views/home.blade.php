<x-layout>
    <main>
        @include ('_banner')
        <section id="about" class="py-16 md:pb-32 md:pt-0 md:mt-20 relative">
            <div class="profile-picture hidden md:flex md:justify-end relative md:z-10">
                <img class="md:w-[22rem] lg:w-[31.25rem]" src="{{url('/images/about-me.jpg')}}" alt="profile-picture" />
            </div>
            <div class="heading relative grid w-[19rem] md:w-8/12 h-20 md:h-[11rem] md:z-0 md:-mt-44 mb-12 md:mb-0">
                <div class="bg-yellow-400 absolute inset-0 w-full z-0 md:mt-8 lg:mt-10"></div>
                <div class="sm:mt-[3.5rem] md:mt-0 px-4 md:pl-20 heading font-normal static w-full h-auto sm:min-h-58 z-10">
                    <h2 class="font-light text-4xl md:text-[3.25rem] lg:text-6xl">This is <span class="font-semibold">me</span></h2>
                </div>
            </div>
            <div class="profile-picture md:hidden">
                <img src="{{url('/images/about-me.jpg')}}" alt="profile-picture" />
            </div>
            <div class="py-8 pb-0 px-4 md:w-2/3 lg:w-2/4 mx-w-[48rem] mx-auto md:mt-8 md:mb-48 lg:mb-60">
                <div class="content"><p class="mb-4 lg:mb-5">Since I was 13 years old, I've been passionate about computers. I have always had a keen interest in exploring
                        new technologies. Graduating from NAIT with a diploma in Web Design and Development
                        and Bachelor's degree in Computer Science, I've got the opportunity to gain advanced knowledge in various programming languages.</p>
                    <p class="mb-4 lg:mb-5">As a web developer, I have worked on some projects, but not limited to <a href="https://www.ogilvielaw.com/" class="border-b-2 border-b-black" target="_blank">Ogilvie</a><strong> (won ACE awards for best website under 50K)</strong>, <a href="https://mcsnet.ca/" class="border-b-2 border-b-black" target="_blank">MCSnet</a>, <a href="https://kagcanada.ca/" class="border-b-2 border-b-black" target="_blank">KAG Canada</a>, <a href="https://alwaysplumbing.ca/" class="border-b-2 border-b-black" target="_blank">Always Plumbing & Heating</a>,
                                            <a href="https://felesky.com/" class="border-b-2 border-b-black" target="_blank">Felesky Flynn</a>, Insight Medical Imaging, and Capital Care Foundation.</p>
                    <p>The excitement of being able to learn and grow every day is what gets me out of bed in the morning. I am constantly progressing and looking to work
                        with new and inventive technologies and clients.</p>
                </div>
                <div class="skills mt-8 md:mt-12 mb-6">
                    <p class="font-light text-xl md:text-4xl mb-8 md:mb-10">
                        <span class="mr-1.5">HTML</span>
                        <span class="mr-1.5 bg-black text-white p-2">jQuery</span>
                        <span class="bg-grey p-2">WordPress</span>
                    </p>
                    <p class="font-light text-xl md:text-4xl mb-8 md:mb-10">
                        <span class="mr-1.5 bg-black text-white p-2">Gutenberg</span>
                        <span>Javascript</span>
                    </p>
                    <p  class="font-light text-xl md:text-4xl mb-8 md:mb-10">
                        <span class="mr-1.5 bg-grey p-2">Typescript</span>
                        <span class="bg-black text-white p-2">SASS</span>
                    </p>
                    <p class="font-light text-xl md:text-4xl mb-8 md:mb-10">
                        <span class="mr-1.5 bg-grey p-2">Tailwind</span>
                        <span class="mr-1.5">PHP</span>
                        <span class="bg-black text-white p-2">Laravel</span>
                    </p>
                    <p class="font-light text-xl md:text-4xl mb-8 md:mb-10">
                        <span class="mr-1.5 bg-grey p-2">ASP.NET</span>
                        <span>MySQL</span>
                    </p>
                    <p class="font-light text-xl md:text-4xl">
                        <span class="mr-1.5 bg-black text-white p-2">Webpack</span>
                        <span class="mr-1.5">NPM</span>
                        <span class="bg-grey p-2">Git</span>
                    </p>
                </div>
                <a class="mt-10 bg-transparent inline-block border-2 border-black text-black capitalize font-light py-3 px-10 hover:bg-yellow-400 hover:text-white hover:bg-black" href="{{url('/files/resume.pdf')}}" target="_blank">Get Resume</a>
            </div>
        </section>

        <section id="work">
            <div class="heading relative grid w-[19rem] md:w-8/12 h-20 md:h-[11rem] md:-z-1 md:-mt-44 mb-12 md:mb-0">
                <div class="bg-yellow-400 absolute inset-0 w-full z-0 md:mt-12 lg:mt-10"></div>
                <div class="mt-[3.5rem] md:-mt-[2.5rem] lg:-mt-[5.5rem] px-4 md:pl-20 heading font-normal static w-full h-auto sm:min-h-58 z-10">
                    <h2 class="font-light text-4xl md:text-[3.25rem] lg:text-6xl leading-[1.15] md:w-[21rem] lg:w-[30rem]">Some Things <span class="font-semibold">I’ve Built</span></h2>
                </div>
            </div>
            @if($works->count())
                <div class="px-4 my-10 work-slider relative mb-24 md:mb-80 pt-4 md:pt-0">
                    <div class="relative max-w-7xl mx-auto overflow-hidden md:flex md:flex-wrap justify-between">
                        @foreach ($works as $work)
                            <x-work-card :work="$work" class="mt-6 mb-4 shadow-black relative mb-5 lg:mb-0 md:w-1/2 lg:w-1/3" />
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
        <section id="contact">
            <div class="heading relative grid w-[19rem] md:w-8/12 h-20 md:h-[11rem] md:-z-1 md:-mt-44 mb-12 md:mb-0">
                <div class="bg-yellow-400 absolute inset-0 w-full z-0 md:mt-8 lg:mt-10"></div>
                <div class="mt-[3.5rem] md:mt-0 px-4 md:pl-20 heading font-normal static w-full h-auto sm:min-h-58 z-10">
                    <h2 class="font-light text-4xl md:text-[3.25rem] lg:text-6xl">Get in <span class="font-semibold">touch</span></h2>
                </div>
            </div>
            <div class="px-4 form-container mb-16 md:mb-24 md:bg-neutral-100 md:w-2/3 lg:w-2/4 md:mx-auto pt-10 pb-8 relative -mt-16">
                @include('contact')
            </div>
        </section>
    </main>
</x-layout>
