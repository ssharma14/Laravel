<x-layout>
    <x-setting :heading="'Edit Post: ' . $work->title">
        <form method="POST" action="/admin/works/{{ $work->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $work->title)" required />
            <x-form.input name="slug" :value="old('slug', $work->slug)" required />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="img_path" type="file" :value="old('img_path', $work->img_path)" />
                </div>

                <img src="{{ asset('storage/' . $work->img_path) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.textarea name="description" required>{{ old('description', $work->description) }}</x-form.textarea>
            <x-form.textarea name="features" required>{{ old('features', $work->features) }}</x-form.textarea>
            <x-form.input name="website_url" :value="old('website_url', $work->website_url)"/>
            <x-form.input name="github_url" :value="old('github_url', $work->github_url)"/>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
