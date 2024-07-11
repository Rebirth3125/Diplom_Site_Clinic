document.addEventListener('DOMContentLoaded', function() {
    loadSpecialties();

    function loadSpecialties() {
        fetch('/get-specialties.php')
            .then(response => response.json())
            .then(data => {
                const specialtiesContainer = document.getElementById('specialties');
                data.forEach(specialty => {
                    const specialtyElement = document.createElement('div');
                    specialtyElement.textContent = specialty.name;
                    specialtyElement.classList.add('specialty');
                    specialtyElement.onclick = function() {
                        let nextElem = specialtyElement.nextElementSibling;
                        if (nextElem && nextElem.classList.contains('doctors-info')) {
                            specialtiesContainer.removeChild(nextElem);
                        } else {
                            loadDoctors(specialty.id, specialtyElement);
                        }
                    };
                    specialtiesContainer.appendChild(specialtyElement);
                });
            });
    }

    function loadDoctors(specialtyId, afterElement) {
        
        fetch('/get-doctors.php?specialty_id=' + specialtyId)
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
            });
    }
});
