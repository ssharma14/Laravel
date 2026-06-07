@props(['work', 'index' => 1])

@php
    // The whole card is clickable via a stretched link on the title.
    // Live Site takes preference; fall back to the GitHub repo.
    $primaryUrl = $work->website_url ?: $work->github_url;
@endphp

<article class="project-card" data-cursor="view">
    <!-- Project Image -->
    <div class="project-image">
        <img src="{{ asset($work->img_path) }}" alt="{{ $work->title }}" loading="lazy" />
    </div>

    <!-- Project Info -->
    <div class="project-info">
        <span class="project-number">0{{ $index }}</span>
        <h3 class="project-title">
            @if($primaryUrl)
                <a href="{{ $primaryUrl }}" class="project-card-link" target="_blank" rel="noopener noreferrer">{{ $work->title }}</a>
            @else
                {{ $work->title }}
            @endif
        </h3>
        <p class="project-description">{!! Str::limit(strip_tags($work->description), 280) !!}</p>

        @php
            // Features may be stored as comma-separated text or as <span>… </span> chips.
            // Normalise both into a clean list of tags.
            $rawFeatures = str_ireplace(['<span>', '</span>'], ',', $work->features ?? '');
            $features = array_filter(array_map('trim', explode(',', strip_tags($rawFeatures))));
        @endphp

        @if(!empty($features))
            <div class="project-tech">
                @foreach($features as $feature)
                    <span>{{ $feature }}</span>
                @endforeach
            </div>
        @endif

        <!-- Project Links -->
        <div class="project-links">
            @if(!empty($work->github_url))
                <a href="{{ $work->github_url }}" target="_blank" class="project-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                    </svg>
                    GitHub
                </a>
            @endif
            @if(!empty($work->website_url))
                <a href="{{ $work->website_url }}" target="_blank" class="project-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    Live Site
                </a>
            @endif
        </div>
    </div>
</article>
