<?php
session_start();
require_once("includes/library.php");
$pdo = connectDB();

// Initialize session counters if not set
// Initialize or reset after game over
if (!isset($_SESSION['numberOfGames']) || $_SESSION['numberOfGames'] >= 10) {
  $_SESSION['numberOfGames'] = 0;
  $_SESSION['wins'] = 0;
  $_SESSION['losses'] = 0;
}

$results = 'No previous games yet.';

// Core game logic
function play($weapon) {
  $options = ['rock', 'paper', 'scissors'];
  $emojis = [
      'rock' => '🪨',
      'paper' => '📄',
      'scissors' => '✂️'
  ];

  $computer = $options[array_rand($options)];
  $resultText = '';

  if (
      ($weapon == 'rock' && $computer == 'scissors') ||
      ($weapon == 'paper' && $computer == 'rock') ||
      ($weapon == 'scissors' && $computer == 'paper')
  ) {
      $_SESSION['wins']++;
      $resultText = "✅ You won! {$emojis[$weapon]} beats {$emojis[$computer]}";
  } elseif ($weapon == $computer) {
      $resultText = "😐 It's a tie! You both chose {$emojis[$weapon]}";
  } else {
      $_SESSION['losses']++;
      $resultText = "❌ You lost! {$emojis[$weapon]} loses to {$emojis[$computer]}";
  }

  return [
      'text' => $resultText,
      'player' => $weapon,
      'computer' => $computer,
      'playerEmoji' => $emojis[$weapon],
      'computerEmoji' => $emojis[$computer]
  ];
}

// When player makes a choice
if (isset($_POST['weapon'])) {
    $results = play($_POST['weapon']);
    $_SESSION['numberOfGames']++;

    // Redirect to gameover after 10 total games
    if ($_SESSION['numberOfGames'] >= 10) {
        header("Location: gameover.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rock Paper Scissors</title>
  <link rel="stylesheet" href="styles/main.css">
</head>
<body>
  <div class="container">
  <h1 class="stacked-title">
  <span class="rock">🪨 Rock</span><br>
  <span class="paper">📄 Paper</span><br>
  <span class="scissors">✂️ Scissors</span>
</h1>



    <h3>Games Played: <?= $_SESSION['numberOfGames'] ?></h3>
    <h3>Wins: <?= $_SESSION['wins'] ?></h3>
    <h3>Losses: <?= $_SESSION['losses'] ?></h3>

    <?php if (is_array($results)): ?>
      <p class="result-text"><?= htmlspecialchars($results['text']) ?></p>

      <div class="emoji-display">
        <div class="choice">
          <h3>You chose:</h3>
          <div class="emoji"><?= $results['playerEmoji'] ?></div>
        </div>

        <div class="vs">⚡️VS⚡️</div>

        <div class="choice">
          <h3>Computer chose:</h3>
          <div class="emoji"><?= $results['computerEmoji'] ?></div>
        </div>
      </div>
    <?php else: ?>
      <p><strong><?= htmlspecialchars($results) ?></strong></p>
    <?php endif; ?>

    <form method="post">
      <label><input type="radio" name="weapon" value="rock" required> 🪨 Rock</label><br>
      <label><input type="radio" name="weapon" value="paper"> 📄 Paper</label><br>
      <label><input type="radio" name="weapon" value="scissors"> ✂️ Scissors</label><br><br>
      <button type="submit">🎮 PLAY!</button>
    </form>

    <form action="scores.php" method="get" style="margin-top:1rem">
      <button type="submit">🏆 View High Scores</button>
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
