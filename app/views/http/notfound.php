<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- stylesheet -->
  <link id="pagestyle" href="<?= BASEURL ?>/css/bootstrap.css" rel="stylesheet" />
  <link id="pagestyle" href="<?= BASEURL ?>/css/soft-ui-dashboard.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- CSS -->
  <link href="<?= BASEURL ?>/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= BASEURL ?>/css/nucleo-svg.css" rel="stylesheet" />
  <!-- title -->
  <title>POS - <?= $data['title'] ?></title>
</head>
<body>
  <main class="main-content d-flex align-items-center" style="height: 100vh;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 my-auto">
          <h1 class="display-1 text-bolder text-gradient text-danger">Error 404</h1>
          <h2>Erm. Page not found</h2>
          <p class="lead">We suggest you to go to the homepage while we solve this issue.</p>
          <a href="<?= BASEURL ?>" class="btn bg-gradient-dark mt-4">Go to Homepage</a>
        </div>
        <div class="col-lg-6 my-auto position-relative">
          <img class="w-100 position-relative" src="<?= BASEURL ?>/img/illustrations/error-404.png" alt="404-error">
        </div>
      </div>
    </div>
  </main>
</body>
</html>