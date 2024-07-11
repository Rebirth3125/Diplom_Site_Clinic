document.addEventListener('DOMContentLoaded', function() {
  const homeServiceForm = document.getElementById('homeServiceForm');

  homeServiceForm.addEventListener('submit', function(event) {
      event.preventDefault();

      const name = document.getElementById('name').value;
      const phone = document.getElementById('phone').value;

      const requestData = {
          name: name,
          phone: phone
      };

      fetch('/home_visit.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify(requestData)
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              console.log('Заявка успешно отправлена');
              alert('Заявка успешно отправлена!');
          } else {
              console.error('Ошибка при отправке заявки');
              alert('Произошла ошибка. Попробуйте еще раз.');
          }
      })
      .catch(error => {
          console.error('Ошибка:', error);
          alert('Произошла ошибка. Попробуйте еще раз.');
      });

      homeServiceForm.reset();
  });
});
