<x-layout>
    <main>
        @include ('_banner')
        <section class="pb-20 pt-12 md:pb-32 md:pt-0 md:mt-20 relative">
            <div class="profile-picture hidden md:flex md:justify-end">
                <img src="{{url('/images/about-me.jpg')}}" alt="profile-picture" />
            </div>
            <div class="heading relative grid w-[19rem] md:w-8/12 h-20 md:h-32 lg:h-44 md:-z-1 md:-mt-44 mb-12 md:mb-0">
                <div class="bg-yellow-400 absolute inset-0 w-full z-0 md:mt-12 lg:mt-10"></div>
                <div class="mt-[3rem] md:mt-0 px-4 md:pl-20 heading font-normal static w-full h-auto sm:min-h-58 z-10">
                    <h2 class="font-light text-4xl lg:text-6xl">This is <span class="font-semibold">me</span></h2>
                </div>
            </div>
            <div class="profile-picture md:hidden">
                <img src="{{url('/images/about-me.jpg')}}" alt="profile-picture" />
            </div>
            <div class="py-8 px-4 md:w-2/4 mx-auto md:mt-8">
                <div class="content"><p class="mb-6 lg:mb-7">Since I was 13 years old, I've been passionate about computers.
                    I always had a keen interest in exploring new technologies. Graduated from NAIT with
                    a diploma in Web Design and Development, I've got the opportunity to gain advanced knowledge
                    in various programming languages.</p>
                    <p>The excitement of being able to learn and grow everyday is what gets me out of bed in the morning.
                        I am always progressing myself and looking to work with new and inventive technologies and clients.</p>
                </div>
                <div class="skills">
                    <p class="font-light text-xl lg:text-4xl mb-4">
                        <span>HTML</span>
                        <span class="bg-black text-white p-1">jQuery</span>
                    </p>
                    <p class="font-light text-xl lg:text-4xl mb-4">
                        <span class="bg-grey p-1">WordPress, Gutenberg</span>
                    </p>
                    <p  class="font-light text-xl lg:text-4xl mb-4">
                        <span class="bg-black text-white p-1">Javascript, Typescript</span>
                        <span>SASS</span>
                    </p>
                    <p class="font-light text-xl lg:text-4xl mb-4">
                        <span class="bg-grey p-1">Tailwind</span>
                        <span class="bg-black text-white p-1">PHP</span>
                        <span>Laravel</span>
                    </p>
                    <p class="font-light text-xl lg:text-4xl mb-4">
                        <span class="bg-black text-white p-1">MySQL</span>
                        <span class="bg-grey p-1">NPM</span>
                    </p>
                    <p class="font-light text-xl lg:text-4xl">
                        <span class="bg-black text-white p-1">Webpack</span>
                        <span>Git</span>
                    </p>
                </div>
                <a class="mt-10 bg-black inline-block text-white capitalize font-light py-3 px-10 hover:bg-yellow-400 hover:text-black" href="{{url('/files/resume.pdf')}}" target="_blank">Download Resume</a>
            </div>
        </section>

        <section>
            <div class="heading bg-yellow-400">
                <h2>Some Things I’ve <strong>Built</strong></h2>
            </div>
            @if($works->count())
                <div id="work-slider" class="work-slider carousel slide relative" data-bs-ride="carousel">
                    <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                        @foreach ($works as $work)
                            <button
                                type="button"
                                data-bs-target="#work-slider"
                                data-bs-slide-to="{{ $loop->index}}"
                                class="{{ $loop->first ? 'active' : '' }}"
                                aria-current="{{ $loop->first ? 'true' : '' }}"
                                aria-label="Slide {{ $loop->index + 1}}"
                            ></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner relative max-w-7xl mx-auto overflow-hidden">
                        @foreach ($works as $work)
                            <x-work-card :work="$work" class="py-8 carousel-item relative float-left w-full {{ $loop->first ? 'active' : '' }}" />
                        @endforeach
                    </div>
                    <button
                        class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                        type="button"
                        data-bs-target="#work-slider"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                        type="button"
                        data-bs-target="#work-slider"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
        </section>
    </main>
</x-layout>
