@if($works->count())
    @foreach ($works as $work)
        <x-work-card :work="$work" class="mt-6 mb-4 w-full max-w-[30rem] md:max-w-full" />
    @endforeach
@endif
