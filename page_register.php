<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="login.css">
    <title>Registrazione</title>
</head>
<body>
  <h1>Registrazione</h1>
    <form action="register.php" method="post">
        <div>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
        </div>
        <input type="submit" value="Accedi">
      </form>
      <p>Utente già registratto?</p>
      <a href="login.html">Accedi!</a>
</body>
</html>