

  $(document).ready(function() {
    $('#registration-form').submit(function(event) {
      event.preventDefault();
      var email = $('#email').val();
      var password = $('#password').val();
      var isValid = true;
      // Email validation
      if (!email) {
        $('#email-error').text('Email is required');
        isValid = false;
      } else if (!isValidEmail(email)) {
        $('#email-error').text('Invalid email format');
        isValid = false;
      } else {
        $('#email-error').text('');
      }
      // Password validation
      if (!password) {
        $('#password-error').text('Password is required');
        isValid = false;
      } else {
        $('#password-error').text('');
      }

      if (isValid) {
        $.ajax({
          url: 'loginuser.php',
          method: 'POST',
          data: {
            email: email,
            password: password
          },
          success: function(response) {
            window.location.href = 'home.php';

          },
          error: function(jqXHR, textStatus, errorThrown) {
            // Handle error
          }
        });
      }
    });

      // Validate email field onblur using AJAX
      $('#email').blur(function() {
        var email = $(this).val();
        $.ajax({
          url: 'checkEmailLogin.php',
          method: 'POST',
          data: { email: email },
          success: function(response) {
            if (response == 'taken') {
              $('#email-error').text('This email is not registered yet!');
            } else {
              $('#email-error').empty();
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });
    
  
  });
  
  function isValidEmail(email) {
    var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
  }


  function redirecttoLogin() {
    window.location.href = "login.php";
  }

  


  