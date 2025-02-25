
// Newsletter form submission alert
document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.querySelector('.newsletter-input').value;
    if (email) {
        alert('Thank you for subscribing with ' + email);
        document.querySelector('.newsletter-input').value = ''; // Clear the input field
    } else {
        alert('Please enter a valid email address.');
    }
});
