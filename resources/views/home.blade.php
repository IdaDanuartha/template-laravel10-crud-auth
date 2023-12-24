<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home Page</title>
</head>
<body>
  <h4>Home page</h4>
  <form action="{{ route('logout') }}" method="POST">
  @csrf
  <button type="submit">Logout</button>
  </form>
</body>
</html>