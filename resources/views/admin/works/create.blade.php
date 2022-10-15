<x-layout>
    <div class="px-4 py-8 md:w-2/3 md:mx-auto">
        <h1 class="font-semibold text-4xl">Create Post</h1>
        <form method="POST" action="/admin/works" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" required />
            <x-form.input name="slug" required />
            <x-form.input name="img_path" type="file" required />
            <x-form.textarea name="description" required />
            <x-form.textarea name="features" required />
            <x-form.input name="website_url"/>
            <x-form.input name="github_url"/>

            <x-form.button>Publish</x-form.button>
        </form>
    </div>
</x-layout>
