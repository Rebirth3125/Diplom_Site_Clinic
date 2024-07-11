document.getElementById('editButton').addEventListener('click', function() {
  document.getElementById('editModal').style.display = 'block';
});

document.getElementsByClassName('close')[0].addEventListener('click', function() {
  document.getElementById('editModal').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('editForm').addEventListener('submit', function(event) {
      event.preventDefault();

      let formData = new FormData(this);

      fetch('', {
          method: 'POST',
          body: formData
      })
      .then(response => response.text())
      .then(data => {
          alert('Данные обновлены!');
          console.log('DEBUG: ' + data);
          document.getElementById('editModal').style.display = 'none';
          window.location.reload();
      })
      .catch(error => {
          console.error('Ошибка:', error);
      });
  });
});

document.getElementById('editForm').addEventListener('submit', function(event) {
  event.preventDefault();
  
  document.getElementById('editModal').style.display = 'none';
});
