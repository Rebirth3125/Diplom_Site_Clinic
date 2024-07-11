document.addEventListener('DOMContentLoaded', function() {
    loadServices();

    function loadServices() {
        fetch('/get-services.php')
            .then(response => response.json())
            .then(data => {
                const servicesContainer = document.getElementById('services');
                servicesContainer.classList.add('service-container');
                data.forEach(service => {
                    const serviceElement = document.createElement('div');
                    serviceElement.classList.add('service-item');
                    serviceElement.innerHTML = `
                        <h3>${service.service_name}</h3>
                        <p>${service.description}</p>
                    `;
                    serviceElement.onclick = function() {
                        if (service.service_name === 'Консультация врача') {
                            window.location.href = 'consult-doctor.html';
                        } else if (service.service_name === 'Заказ справок') {
                            window.location.href = 'certificates.html';
                        } else if (service.service_name === 'Выезд на дом') {
                            window.location.href = 'home-visit.html';
                        } else if (service.service_name === 'Скорая помощь') {
                            window.location.href = 'ambulance.html';
                        } else if (service.service_name === 'Диагностика') {
                            window.location.href = 'diagnostik.html';
                        } else {
                            loadDoctorsByService(service.service_id);
                        }
                    };
                    servicesContainer.appendChild(serviceElement);
                });
            });
    }
});
