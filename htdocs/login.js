const user = {
  username: 'user',
  password: 'pass'
};

function login() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  if(username === user.username && password === user.password) {
      document.getElementById('login-form').style.display = 'none';
      document.getElementById('user-dashboard').style.display = 'block';
      document.getElementById('user-name').textContent = username;
  } else {
      alert('Неправильное имя пользователя или пароль');
  }
}

function logout() {
  document.getElementById('login-form').style.display = 'block';
  document.getElementById('user-dashboard').style.display = 'none';
  document.getElementById('username').value = '';
  document.getElementById('password').value = '';
}
