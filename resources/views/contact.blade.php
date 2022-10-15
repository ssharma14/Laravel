<form method="post" action="{{ route('contact.store') }}">
    @csrf
    <x-form.input name="name" required />
    <x-form.input name="email" type="email" required />
    <x-form.input name="subject" />
    <x-form.textarea name="message" required />

    <x-form.button>Submit</x-form.button>
</form>
