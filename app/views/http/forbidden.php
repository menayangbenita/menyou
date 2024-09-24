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
  <title>Menune - <?= $data['title'] ?></title>
</head>
<body>
  <main class="main-content  mt-0">
    <div>
      <section class="min-vh-100 d-flex align-items-center">
        <div class="container">
          <div class="row mt-lg-0 mt-8">
            <div class="col-lg-5 my-auto">
              <h1 class="display-1 text-bolder text-gradient text-warning fadeIn1 fadeInBottom mt-5">Error 403
              </h1>
              <h2 class="fadeIn3 fadeInBottom opacity-8">Forbidden</h2>
              <p class="lead opacity-6 fadeIn2 fadeInBottom">The page you're looking are forbidden</p>
              <a href="<?= BASEURL ?>" class="btn bg-gradient-warning mt-4 fadeIn2 fadeInBottom">Back to Homepage</a>
            </div>
            <div class="col-lg-7 my-auto">
              <img class="w-100 fadeIn1 fadeInBottom" src="<?= BASEURL ?>/img/illustrations/error-500.png" alt="500-error">
            </div>
          </div>
      </section>
    </div>
  </main>
</body>
</html>