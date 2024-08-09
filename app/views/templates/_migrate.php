<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Migrate Management</title>
  <!-- Stylesheets -->
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous"
  >
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    #table td {
      vertical-align: middle;
    }
    .database td {
      background-color: #fff45e;
      font-weight: bold;
    }

    #sql-files :is(.table_template, .users) td {
      background-color: #ffbbb3;
      font-style: italic;
    }

    #details li {
      font-family: monospace;
      list-style: none;
    }
  </style>
</head>
<body>
  <nav class="navbar bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-bg-dark" href="#"><i class="bi bi-database-fill m-2"></i>Database Management</a>
    </div>
  </nav>

  <main class="container-fluid my-5">
    <ul id="details" class="container p-3 bg-secondary-subtle">
      <li>DB_HOST = <b><?= DB_HOST ?></b></li>
      <li>DB_USER = <b><?= DB_USER ?></b></li>
      <li>DB_PASS = <b><?= DB_PASS ?></b></li>
      <li>DB_NAME = <b><?= DB_NAME ?></b></li>
    </ul>
    <?php if (isset($_SESSION['flash'])) : ?>
      <div class="container alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">
        <?= $_SESSION['flash']['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <div id="sql-files" class="container card p-4">
      <h2>SQL Files</h2>  
      <hr>
      <table id="table" class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>File Name</th>
            <th>Related Table</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach($data['files'] as $filename) : ?>
            <?php 
              if ($filename =='database.sql') {
                $table_related = 'All';
              } else {
                $table_related = explode('.', $filename)[0];
              }
            ?>
            <tr class="<?= explode('.', $filename)[0] ?>">
              <td><?= $i++ ?></td>
              <td><?= $filename ?></td>
              <td><?= $table_related ?></td>
              <td>
                <a 
                  class="btn btn-success submit"
                  href="<?= BASEURL ?>/migrate/export/<?= $filename ?>"
                  data-message="<?= ($table_related == 'All') ? 
                    'This action will migrate all tables. Continue process?' : 
                    "Are you sure want to migrate table '{$table_related}'?" ?>"
                  onclick="return confirm(this.dataset.message)">
                  Migrate
                </a>
                <a 
                  class="btn btn-outline-danger"
                  href="<?= BASEURL ?>/migrate/delete/<?= $filename ?>"
                  data-message="Are you sure want to delete <?= $filename ?>?"
                  onclick="return confirm(this.dataset.message)">
                  Delete
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <br>

    <div id="available-tables" class="container card p-4">
      <h2>Available Tables</h2>  
      <hr>
      <table id="table" class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Table Name</th>
            <th>Data Count</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach($data['tables'] as $table) : ?>
            <?php 
              $database = ($table['name'] == 'database') ? true : false;
            ?>
            <tr class="<?= $table['name'] ?>">
              <td><?= $i++ ?></td>
              <td><?= $table['name'] ?></td>
              <td><?= $table['rows'] ?></td>
              <td>
                <?php $method = (in_array($table['name'] . '.sql', $data['files'])) ? 'Update' : 'Import' ?>
                <a 
                  class="btn btn-<?= (in_array($table['name'] . '.sql', $data['files'])) ? 'primary' : 'secondary' ?> submit"
                  href="<?= BASEURL ?>/migrate/import/<?= $table['name'] ?>"
                  data-message="Are you sure want to <?= strtolower($method) ?> <?= $table['name'] ?>.sql to your project?"
                  onclick="return confirm(this.dataset.message)">
                  <?= $method ?>
                </a>
                <?php if (!$database) : ?>
                  <a 
                    class="btn btn-warning"
                    href="<?= BASEURL ?>/migrate/empty/<?= $table['name'] ?>"
                    data-message="Are you sure want to empty table '<?= $table['name'] ?>'?"
                    onclick="return confirm(this.dataset.message)">
                    Empty
                  </a>
                <?php endif ?>
                <a 
                  class="btn btn-outline-danger"
                  href="<?= BASEURL ?>/migrate/drop/<?= $table['name'] ?>"
                  data-message="<?= ($table['name'] == 'database') ? 
                    'This action will drop all tables. Continue process?' : 
                    "Are you sure want to drop table '". $table['name'] ."'?" ?>"
                  onclick="return confirm(this.dataset.message)">
                  Drop
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous">
  </script>
</body>
</html>