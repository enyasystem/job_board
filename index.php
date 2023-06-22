<!DOCTYPE html>
<html>
<head>
  <title>Job Board</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <header>
    <?php
        include("src/header.php");
    ?>
  </header>

  <main class="container">
    <div class="row">
      <div class="col-lg-8">
        <section id="job-listings">
          <!-- Job listings will be dynamically added here -->
        </section>
      </div>

      <div class="col-lg-4">
        <aside id="filters">
          <!-- Search and filter options go here -->
        </aside>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <section id="job-form">
          <!-- Job listing submission form goes here -->
            <h1>In the News Today</h1>
        </section>
        <details>
          <p>The height that was reached and kept by great men was not achieved by
            sudden flight but while their companion slept, they kept awake burning the
            midnight candle</p>
          <summary><em>The Cool</em>😎✌🏿 Cats
          </summary>
        </details>
        <div>
          <img src="../ecommerce/uploads/Cat.jpg" height="500">
          <figure>Two cats staring at a PC</figure>
        </div>
      </div>
    </div>
    <address>
    No. 107 Yellow Duke by Latter Day's Saint, Calabar Cross River State
    </address>
  </main>

  <!-- Include Bootstrap JS and your custom JavaScript file -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <?php
    include("src/footer.php");
  ?>
</body>
</html>
