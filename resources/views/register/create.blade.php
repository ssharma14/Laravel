<x-layout>
    <section class="py-8 px-6">
        <main class="lg:max-w-4xl mx-auto mt-10">
            <div class="border border-gray-200 p-6 rounded-xl">
                <h1 class="text-center font-bold text-xl">Register!</h1>

                <form method="POST" action="/register" class="mt-10">
                    @csrf

                    <x-form.input name="name" required />
                    <x-form.input name="username" required />
                    <x-form.input name="email" type="email" required />
                    <x-form.input name="password" type="password" autocomplete="new-password" required />
                    <x-form.button>Sign Up</x-form.button>
                </form>
            </div>
        </main>
    </section>
</x-layout>
