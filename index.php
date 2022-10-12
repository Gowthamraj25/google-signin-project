<?php 

include('head1.php');

require 'google-api-php-client/vendor/autoload.php';

$client = new Google_Client();
		
$client->setClientId('756743847038-sh9qga6vu35ngomvep7eq752ng6sa339.apps.googleusercontent.com');
	
$client->setClientSecret('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');

$client->setRedirectUri('http://localhost/login_signup_project/google-signin.php');

$client->addScope("email");
$client->addScope("profile");

$authurl = $client->createAuthUrl();
		
		//echo $authurl;die;

?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Login Form</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
					<center>
						<strong>
						<p class="text-danger" id="error"></p>
						<p class="text-success" id="success"></p>
						</strong>
					</center>
				  </div>

                  <form class="row g-3 needs-validation">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
					<div class="col-12">
                      <center><a href="<?php echo $authurl; ?>"><img src="sign-images/login-google.png" width="75%"></a></center>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="page-signup.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">Gowthamraj</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<?php include('footer1.php');?>
<script>
$(document).ready(function(){

$('form').on('submit', function (e) {

	e.preventDefault();
	$('#error').html('');
	$('#success').html('');
	$.ajax({
	
		type: 'post',
		url: 'login.php',
		data: $('form').serialize(), 
		success: function (output) { 
		  if(output == 0){
			$('#error').html('Invalid Data');
		  } else if(output == 1){
			$('#success').html('Login sucessfully!');			
			setTimeout(function () {
               window.location.href = "dashboard.php";     
            }, 1000);
		  } else {
			$('#error').html(output);			
		  }
		 
		},
		error : function(error){
			$('#error').html(error);
		}
	});
	
});

});
</script>