document.addEventListener('DOMContentLoaded', function() {
    const cookieBanner = document.getElementById('cookie-banner');
    const cookieAcceptButton = document.getElementById('cookie-accept');

    // Check if cookie consent is already given
    if (document.cookie.includes('cookieConsent=true')) {
        cookieBanner.style.display = 'none';
    } else {
        cookieBanner.style.display = 'block';
    }

    // Accept cookie consent
    cookieAcceptButton.addEventListener('click', function() {
        document.cookie = 'cookieConsent=true; path=/; max-age=31536000'; // 1 year
        cookieBanner.style.display = 'none';
    });
});
