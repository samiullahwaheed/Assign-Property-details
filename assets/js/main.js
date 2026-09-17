document.addEventListener('DOMContentLoaded', () => {
    const inquiryForm = document.querySelector('.js-inquiry-form');

    if (!inquiryForm) {
        return;
    }

    inquiryForm.addEventListener('submit', (event) => {
        const requiredFields = inquiryForm.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach((field) => {
            if (!field.value.trim()) {
                valid = false;
                field.setAttribute('aria-invalid', 'true');
            } else {
                field.removeAttribute('aria-invalid');
            }
        });

        const email = inquiryForm.querySelector('input[type="email"]');
        if (email && !email.validity.valid) {
            valid = false;
            email.setAttribute('aria-invalid', 'true');
        }

        if (!valid) {
            event.preventDefault();
            alert('Please complete all inquiry fields with a valid email address.');
        }
    });
});

