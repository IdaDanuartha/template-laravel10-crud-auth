<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <!-- Core CSS -->
  <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="/assets/css/demo.css" />

</head>
<body>
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
      <div>
        <h2>Page Not Found :(</h2>
        <p style="margin-top: -10px">Oops! 😖 The requested URL was not found on this server.</p>
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary fw-medium mt-2 mb-4">Back to Home</a>
      </div>
      <img src="{{ asset('assets/img/custom-errors/error-404.png') }}" width="500" alt="">
    </div>
  </div>
</body>
</html>