<?php
session_start();
require_once("includes/library.php");
$pdo = connectDB();

$stmt = $pdo->query("SELECT PLAYER_NAME, SCORE, DATE_ACHIEVED FROM HIGHSCORES ORDER BY SCORE DESC, DATE_ACHIEVED ASC");
$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>High Scores</title>
  <link rel="stylesheet" href="styles/main.css">
</head>
<body>
  <div class="container">
    <h1>🏆 High Scores 🏆</h1>

    <?php if (count($scores) > 0): ?>
      <table border="1" cellpadding="8" cellspacing="0">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Player</th>
            <th>Score</th>
            <th>Date Achieved</th>
          </tr>
        </thead>
        <tbody>
          <?php $rank = 1; foreach ($scores as $row): ?>
            <tr>
              <td><?= $rank++ ?></td>
              <td><?= htmlspecialchars($row['PLAYER_NAME']) ?></td>
              <td><?= htmlspecialchars($row['SCORE']) ?></td>
              <td><?= htmlspecialchars($row['DATE_ACHIEVED']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No scores yet! Be the first to play.</p>
    <?php endif; ?>

    <form action="index.php" method="get" style="margin-top:1rem">
      <button type="submit">Back to Game</button>
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
