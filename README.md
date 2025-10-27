# 🎮 Rock Paper Scissors — Retro Arcade Edition  

A fully functional, session-based PHP web game with a retro arcade vibe.  
Play up to 10 rounds of Rock Paper Scissors, track your wins and losses, and submit your name to the online leaderboard — all powered by a MySQL database.

---

## 🌐 Live Demo  
🔗 **Play it here:** [ferdinandsrps.infinityfree.me](https://ferdinandsrps.infinityfree.me)

---

## 🧩 Features  
- 🪨 Rock / 📄 Paper / ✂️ Scissors game logic  
- 🕹️ 10-round session limit (auto “Game Over”)  
- 🧠 Smart win/loss tracking with PHP sessions  
- 💾 Persistent leaderboard stored in MySQL  
- 💻 Fully responsive, retro-themed CSS design  
- 🌈 Separate configuration for **local** and **live** environments  

---

## ⚙️ Tech Stack  
| Component | Technology |
|------------|-------------|
| Frontend | HTML5 / CSS3 |
| Backend | PHP 8 + Sessions |
| Database | MySQL (local + InfinityFree live) |
| Hosting | InfinityFree – free PHP hosting |
| Local Dev | MAMP (macOS) – Apache + MySQL |

---

## 🏗️ Project Structure
RPS_game/

├── includes/
│ ├── library.php
│ ├── config_local.ini
│ └── config_live.ini

├── styles/
│ └── main.css

├── index.php # Main gameplay
├── gameover.php # Game-over screen + submit name
├── scores.php # Leaderboard display
└── testdb.php # Database connection test


---

## 🧠 How It Works
1. The player selects a move (rock/paper/scissors).  
2. The computer randomly selects a move.  
3. PHP evaluates win/lose/draw and stores results in the session.  
4. After 10 games, the player is redirected to **Game Over**.  
5. Enter your name to save your score in the **HIGHSCORES** table.  

---

## 💾 Database Schema
```sql
CREATE TABLE HIGHSCORES (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  PLAYER_NAME VARCHAR(50),
  SCORE INT,
  DATE_ACHIEVED DATETIME
);
🔧 Configuration
The app automatically switches between environments:

File	Purpose
config_local.ini	Local MAMP connection (localhost / root / root / 8889)
config_live.ini	InfinityFree live credentials (internal MySQL host)

library.php detects the environment and loads the correct file automatically.

🕹️ How to Play Locally
Clone this repo into your MAMP htdocs folder (or set Desktop as Document Root).

Create a local database called rps_game and import the table above.

Start MAMP servers and open


http://localhost:8888/
Enjoy the game!

👾 Future Improvements
🎨 Animated transitions between rounds

🏆 Global leaderboard filtering

📱 Mobile-optimized retro layout

🎵 Arcade sound effects

👤 Author
Ferdinand Nel


📜 License
MIT License – free to use, modify, and share.
If you fork or use this project, please credit the original author.