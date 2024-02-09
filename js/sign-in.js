const sign_in = () => {

  let username = $('#username').val();
  let password = $('#password').val();

  $.ajax({
    url: 'process/sign_in.php',
    type: 'POST',
    cache: false,
    data: {
      username: username,
      password: password
    },
    success: response => {
      if (response == 'success') {
        window.location.href = "admin/dashboard.php";
        $("#username").val('');
        $("#password").val('');
      } else if (response == 'failed') {
        swal('Account Information', `Sign In Failed. Maybe an incorrect credential or account not found`, 'info');
      } else {
        swal('System Error', `Error: ${response}`, 'error');
      }
    }
  });

}

$('#sign-in').submit(e => {
  e.preventDefault();
  sign_in();
});