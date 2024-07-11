document.addEventListener('DOMContentLoaded', function() {
    loadCertificates();

    function loadCertificates() {
        fetch('/get-certificates.php')
            .then(response => response.json())
            .then(certificates => {
                const certificatesList = document.querySelector('.certificates-list');
                certificates.forEach(certificate => {
                    const certificateItem = document.createElement('div');
                    certificateItem.classList.add('certificate-item');
                    certificateItem.innerHTML = `
                        <h3>${certificate.certificate_name}</h3>
                        <p>${certificate.description}</p>
                        <button class="btn btn-secondary order-button">Заказать</button> <!-- Кнопка "Заказать" -->
                    `;

                    certificatesList.appendChild(certificateItem);
                });

                const orderButtons = document.querySelectorAll('.order-button');
                orderButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        window.location.href = '/order-page.html';
                    });
                });
            })
            .catch(error => console.error('Ошибка:', error));
    }
});
