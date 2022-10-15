@props(['work'])

<article {{ $attributes->merge(['class' => 'p-0']) }}>
    <div class="z-1 thumbnail"><img src="{{ asset('storage/' . $work->img_path) }}" alt="Work" /></div>
    <div class="content bg-black text-white px-10 pt-10 pb-8 relative z-10 h-full">
        <div class="content-inner">
            <h2 class="font-medium text-3xl mb-3.5">{{$work->title}}</h2>
            <div><p class="text-base text-indigo-50 text-1xl font-light pb-8">{!! $work->description !!}</p></div>
        </div>
        <div class="features pb-4">
            <p class="text-xs font-light">{!! $work->features !!}</p>
        </div>
        <div class="links flex align-middle">
            @if(!empty($work->github_url))
                <a class="inline-block w-[1.5rem] mr-4" href="{{$work->github_url}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><title class="hidden">GitHub</title><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg></a>
            @endif
            @if(!empty($work->website_url))
                <a class="inline-block w-[1.5rem]" href="{{$work->website_url}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><title class="hidden">External Link</title><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg></a>
            @endif
        </div>
    </div>
</article>
