<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- icon -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= BASEURL ?>/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?= BASEURL ?>/img/favicon.png">
	<!-- stylesheet -->
	<link id="pagestyle" href="<?= BASEURL ?>/css/bootstrap.css" rel="stylesheet" />
	<link id="pagestyle" href="<?= BASEURL ?>/css/soft-ui-dashboard.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<!-- CSS -->
	<link href="<?= BASEURL; ?>/css/nucleo-icons.css" rel="stylesheet" />
	<link href="<?= BASEURL; ?>/css/nucleo-svg.css" rel="stylesheet" />
	<!-- jquery -->
	<script src="<?= BASEURL ?>/js/jquery-1.10.2.js"></script>
	<!-- title -->
	<title>POS - <?= $data['title'] ?></title>
</head>
<body>
	<main class="main-content  mt-0">
		<section>
			<div class="page-header min-vh-100">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
							<div class="card card-plain">
								<div class="card-header pb-0 text-left">
									<h4 class="font-weight-bolder">Sign Up</h4>
									<p class="mb-0">Enter your email and password to register</p>
								</div>
								<div class="card-body pb-3">
									<form action="<?= BASEURL ?>/register/process" method="post">
										<?= csrf() ?>
										<input type="hidden" name="id" id="id">
										<label>Name</label>
										<div class="mb-3">
											<input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
										</div>
										<label>Email</label>
										<div class="mb-3">
											<input type="email" class="form-control" placeholder="email@example.com" id="email" name="email" required>
										</div>
										<label>Password</label>
										<div class="mb-3 position-relative">
											<input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
											<i class="bi bi-eye-slash-fill position-absolute top-50 end-2 translate-middle" id="show-password"></i>
										</div>
										<div class="text-center">
											<button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0">
												Sign up</button>
										</div>
									</form>
								</div>
								<div class="card-footer text-center pt-0 px-sm-4 px-1">
									<p class="mb-4 mx-auto">
										Already have an account?
										<a href="<?= BASEURL ?>/login" class="text-primary text-gradient font-weight-bold">Sign in</a>
									</p>
								</div>
							</div>
						</div>
						<div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
							<div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
								<img src="<?= BASEURL ?>/img/shapes/pattern-lines.svg" alt="pattern-lines" class="position-absolute opacity-4 start-0">
								<div class="position-relative">
									<img class="max-width-500 w-100 position-relative z-index-2" 
										src="<?= BASEURL ?>/img/illustrations/rocket-white.png" alt="rocket">
								</div>
								<h4 class="mt-5 text-white font-weight-bolder">Your journey starts here</h4>
								<p class="text-white">Just as it takes a company to sustain a product, it takes a community
									to sustain a protocol.</p>
							</div>
						</div>
					</div>
					<?php Flasher::flash() ?>
				</div>
			</div>
		</section>
	</main>
	<!-- script -->
	<script src="<?= BASEURL; ?>/js/core/popper.min.js"></script>
	<script src="<?= BASEURL; ?>/js/core/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

	<script>
		$('#show-password').click(function () {
			if ($(this).hasClass('bi-eye-slash-fill')) {
				$('#password').attr('type', 'text');
				$(this)[0].classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
			} else {
				$('#password').attr('type', 'password');
				$(this)[0].classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
			}
		});
	</script>

</body>
</html>