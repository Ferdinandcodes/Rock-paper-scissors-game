<?php
session_start();
require_once("includes/library.php");
$pdo = connectDB();

if (!isset($_SESSION['numberOfGames'])) {
    header("Location: index.php");
    exit();
}

$pdo = connectDB();

// Reset option
if (isset($_POST['reset'])) {
    $_SESSION['numberOfGames'] = 0;
    $_SESSION['wins'] = 0;
    $_SESSION['losses'] = 0;
    header("Location: index.php");
    exit();
}

// Save name to leaderboard
if (isset($_POST['name'])) {
    $name = trim($_POST['name']);
    $score = $_SESSION['wins'];

    $stmt = $pdo->prepare(
        'INSERT INTO HIGHSCORES (PLAYER_NAME, SCORE, DATE_ACHIEVED) VALUES (?, ?, NOW())'
    );
    $stmt->execute([$name, $score]);

    header("Location: scores.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Over</title>
  <link rel="stylesheet" href="styles/main.css">
</head>
<body>

  <div class="container">
    <h1>🎮 Game Over! 10 rounds complete.</h1>
    <h3>Games Played: <?= $_SESSION['numberOfGames'] ?></h3>
    <h3>Wins: <?= $_SESSION['wins'] ?></h3>
    <h3>Losses: <?= $_SESSION['losses'] ?></h3>

    <h4>Submit your name to the leaderboard:</h4>
    <form method="post">
      <label for="name">Enter Name:</label>
      <input type="text" id="name" name="name" required>
      <button type="submit">Submit Score</button>
    </form>

    <form method="post" style="margin-top:1rem">
      <button type="submit" name="reset" value="1">Play Again</button>
    </form>

    <form action="scores.php" method="get" style="margin-top:0.5rem">
      <button type="submit">View Leaderboard</button>
    </form>
  </div>
  <script>
  if (!sessionStorage.getItem('crtShown')) {
    const flash = document.createElement('div');
    flash.className = 'crt-flash';
    document.body.appendChild(flash);
    sessionStorage.setItem('crtShown', 'true');
  }
</script>

</body>
</html>
