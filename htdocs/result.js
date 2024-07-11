document.addEventListener('DOMContentLoaded', function () {
    const searchResults = getParameterByName('results');
  
    const parsedResults = JSON.parse(decodeURIComponent(searchResults));
  
    displaySearchResults(parsedResults);
});

function displaySearchResults(results) {
    const searchResultsContainer = document.querySelector('.search-results-content');

    if (!searchResultsContainer) {
        console.error('Error: searchResultsContainer not found');
        return;
    }

    console.log('Displaying search results:', results);

    results.forEach(result => {
        const searchResult = document.createElement('div');
        searchResult.classList.add('search-result');

        const titleElement = document.createElement('h3');
        const specialtyInfo = document.createElement('p');
        specialtyInfo.classList.add('specialty-info');

        if (result.type === 'doctor') {
            titleElement.textContent = result.name;
            specialtyInfo.textContent = result.specialty || '';
            titleElement.addEventListener('click', function () {
                window.location.href = `doctor-profile.php?doctor_name=${encodeURIComponent(result.name)}`;
            });
        } else if (result.type === 'service') {
            titleElement.textContent = result.name;
            specialtyInfo.textContent = '';
            titleElement.classList.add('service-name');
            titleElement.addEventListener('click', function () {
                navigateToServicePage(result.name);
            });
        } else if (result.type === 'diagnostic') {
            titleElement.textContent = result.name;
            titleElement.classList.add('diagnostic-name');
            titleElement.addEventListener('click', function () {
                navigateToDiagnosticPage(result.name);
            });
        } else if (result.type === 'certificate') {
            titleElement.textContent = result.name;
            specialtyInfo.textContent = result.description || '';
            titleElement.classList.add('certificate-name');
            searchResult.appendChild(titleElement);
            searchResult.appendChild(specialtyInfo);
        } else if (result.type === 'consult') {
            titleElement.textContent = result.name;
            const doctorNameElement = document.createElement('p');
            doctorNameElement.textContent = result.doctor_name || '';
            titleElement.classList.add('consult-name');
            titleElement.addEventListener('click', function () {
                navigateToConsultPage(result.name);
            });
            searchResult.appendChild(doctorNameElement); 
        } else {
            console.error('Error: Invalid result type', result);
            return;
        }

        searchResult.appendChild(titleElement);
        if (result.type !== 'certificate' && result.type !== 'consult') {
            searchResult.appendChild(specialtyInfo);
        }

        searchResultsContainer.appendChild(searchResult);
    });
}


function navigateToServicePage(serviceName) {
    switch (serviceName) {
        case 'Консультация врача':
            window.location.href = 'consult-doctor.html';
            break;
        case 'Заказ справок':
            window.location.href = 'certificates.html';
            break;
        case 'Скорая помощь':
            window.location.href = 'ambulance.html';
            break;
        case 'Выезд на дом':
            window.location.href = 'home-visit.html';
            break;
        case 'Диагностика':
            window.location.href = 'diagnostik.html';
            break;
        default:
            console.error('Error: Unknown service name', serviceName);
    }
}

function navigateToDiagnosticPage(diagnosticName) {
    switch (diagnosticName) {
        case 'УЗИ':
            window.location.href = 'uzi.html';
            break;
        case 'МРТ':
            window.location.href = 'mrt.html';
            break;
        case 'КТ':
            window.location.href = 'kt.html';
            break;
        case 'РЕНТГЕН':
            window.location.href = 'rentgen.html';
            break;
        default:
            console.error('Error: Unknown diagnostic name', diagnosticName);
    }
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
    const results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
