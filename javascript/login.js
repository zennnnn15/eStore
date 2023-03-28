$(document).ready(function() {
    $('#registration-form').submit(function(event) {
      event.preventDefault();
      var email = $('#email').val();
      var username = $('#username').val();
      var password = $('#password').val();
      var retypePassword = $('#retype-password').val();
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
      // Username validation
      if (!username) {
        $('#username-error').text('Username is required');
        isValid = false;
      } else {
        $('#username-error').text('');
      }
      // Password validation
      if (!password) {
        $('#password-error').text('Password is required');
        isValid = false;
      } else if (password.length < 8) {
        $('#password-error').text('Password must be at least 8 characters long');
        isValid = false;
      } else {
        $('#password-error').text('');
      }
      // Retype password validation
      if (!retypePassword) {
        $('#retype-password-error').text('Retype password is required');
        isValid = false;
      } else if (password !== retypePassword) {
        $('#retype-password-error').text('Passwords do not match');
        isValid = false;
      } else {
        $('#retype-password-error').text('');
      }
      if (isValid) {
        // Call API to register user
        $.ajax({
          url: 'registerUser.php',
          method: 'POST',
          data: {
            email: email,
            username: username,
            password: password
          },
          success: function(response) {
            window.location.href = 'login1.php';

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
          url: 'checkEmail.php',
          method: 'POST',
          data: { email: email },
          success: function(response) {
            if (response == 'taken') {
              $('#email-error').text('This email is already taken');
            } else {
              $('#email-error').empty();
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });
    
    $('#retype-password').blur(function() {
      var password = $('#password').val();
      var retypePassword = $(this).val();
      if (password && password !== retypePassword) {
        $('#retype-password-error').text('Passwords do not match');
      } else {
        $('#retype-password-error').text('');
      }
    });
  });
  
  function isValidEmail(email) {
    var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
  }

  function redirectToRegister() {
    window.location.href = "login1.php";
  }
  
  


  