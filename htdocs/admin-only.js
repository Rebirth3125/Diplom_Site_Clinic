$(document).ready(function() {
  $.get('check_role.php', function(response) {
      if (response.authenticated) {
          if (response.role === 'admin') {
              $('.admin-only').show();
          } else if (response.role === 'user') {
              $('.user-only').show();
          }
      } else {
          $('.guest-only').show();
      }
  }, 'json');
});