<x-layout>
    <x-adminheader heading="Publish New Post">
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
    </x-adminheader>
</x-layout>
