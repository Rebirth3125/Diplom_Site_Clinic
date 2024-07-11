document.addEventListener('DOMContentLoaded', function() {
    loadConsults();

    function loadConsults() {
        fetch('/get-consults.php')
            .then(response => response.json())
            .then(data => {
                const consultsContainer = document.getElementById('consults');
                data.forEach(consult => {
                    const consultElement = document.createElement('div');
                    consultElement.textContent = consult.consult_name;
                    consultElement.classList.add('consult');
                    consultElement.onclick = function() {
                        const nextElement = consultElement.nextElementSibling;
                        if (nextElement && nextElement.classList.contains('doctors-info')) {
                            consultsContainer.removeChild(nextElement);
                        } else {
                            loadDoctors(consult.consult_id, consultElement);
                        }
                    };
                    consultsContainer.appendChild(consultElement);
                });
            })
            .catch(error => console.error('Ошибка при загрузке консультаций:', error));
    }

    function loadDoctors(consultId, afterElement) {
        fetch(`/get-doctors-for-consult.php?consult_id=${consultId}`)
            .then(response => response.json())
            .then(data => {
                const doctorsInfoContainer = document.createElement('div');
                doctorsInfoContainer.classList.add('doctors-info');
                data.forEach(doctor => {
                    const doctorElement = document.createElement('div');
                    doctorElement.innerHTML = `
                        <div class="doctor-card" data-name="${doctor.name}">
                            <img src="${doctor.image_url}" alt="Портрет врача">
                            <h3>${doctor.name}</h3>
                        </div>
                    `;
                    doctorElement.onclick = function() {
                        const doctorName = doctor.name;
                        console.log('Clicked Doctor Name:', doctorName); 
                        window.location.href = '/doctor-profile.php?doctor_name=' + encodeURIComponent(doctorName);
                    };
                    doctorsInfoContainer.appendChild(doctorElement);
                });
                afterElement.insertAdjacentElement('afterend', doctorsInfoContainer);
            })
            .catch(error => console.error('Ошибка при загрузке данных о врачах:', error));
    }
});
