{{-- Message container for success/error messages --}}
<div id="form-message-container"></div>

{{-- Contact Form --}}
<div id="contact-form-wrapper">
    <form method="post" action="{{ route('contact.store') }}" id="contact-form">
        @csrf
        <x-form.input name="name" required />
        <x-form.input name="email" type="email" required />
        <x-form.input name="subject" />
        <x-form.textarea name="message" required />

        {{-- Honeypot field - hidden from humans, bots will fill it --}}
        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

        {{-- Time-based validation token --}}
        <input type="hidden" name="form_token" value="{{ $formToken }}">

        <x-form.button type="submit">Submit</x-form.button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const formWrapper = document.getElementById('contact-form-wrapper');
    const messageContainer = document.getElementById('form-message-container');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Disable submit button to prevent double submission
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';

        // Clear previous messages
        messageContainer.innerHTML = '';

        // Clear individual field errors
        document.querySelectorAll('.text-red-500').forEach(el => el.remove());
        document.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
        });

        try {
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                             form.querySelector('input[name="_token"]')?.value;

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            let data;
            try {
                data = await response.json();
            } catch (parseError) {
                console.error('JSON Parse Error:', parseError);
                throw new Error('Invalid response from server');
            }

            console.log('Response status:', response.status);
            console.log('Response data:', data);

            if (response.ok && data.success) {
                // Show success message and hide form
                messageContainer.innerHTML = `
                    <div class="success-message text-center py-8">
                        <p class="text-xl md:text-2xl text-yellow-400">Thank you! Your submission has been received!</p>
                    </div>
                `;
                formWrapper.style.display = 'none';

                // Scroll to success message
                messageContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                // Display validation errors
                if (data.errors) {
                    let errorHtml = `
                        <div class="bg-red-500/10 border border-red-500 rounded p-4 mb-6">
                            <p class="text-red-500 font-semibold mb-2">Please correct the following errors:</p>
                            <ul class="list-disc list-inside text-red-500">
                    `;

                    // Display each error
                    Object.keys(data.errors).forEach(field => {
                        data.errors[field].forEach(error => {
                            errorHtml += `<li>${error}</li>`;

                            // Highlight the field with error
                            const fieldElement = document.getElementById(field);
                            if (fieldElement) {
                                fieldElement.classList.add('border-red-500');
                                const errorMsg = document.createElement('p');
                                errorMsg.className = 'text-red-500 text-xs mt-2';
                                errorMsg.textContent = error;
                                fieldElement.parentElement.appendChild(errorMsg);
                            }
                        });
                    });

                    errorHtml += `</ul></div>`;
                    messageContainer.innerHTML = errorHtml;

                    // Scroll to error message
                    messageContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else if (data.message) {
                    messageContainer.innerHTML = `
                        <div class="bg-red-500/10 border border-red-500 rounded p-4 mb-6">
                            <p class="text-red-500">${data.message}</p>
                        </div>
                    `;
                }

                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            }
        } catch (error) {
            console.error('Error:', error);
            messageContainer.innerHTML = `
                <div class="bg-red-500/10 border border-red-500 rounded p-4 mb-6">
                    <p class="text-red-500">An error occurred: ${error.message}</p>
                </div>
            `;
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
        }
    });
});
</script>
