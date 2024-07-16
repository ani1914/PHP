<?php require 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добре дошли, <?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="home_login.css">

</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.html"><span>Л</span>евски</a>
            </div>

            <nav class="navbar">
                <button id="burger" class="burger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                </button>
                <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label>Menu</label>
                <ul>
                    <li><a href="news.php" class="active"> Новини</a> </li>
                    <li><a href="players.php" class="active"> Отбор</a> </li>
                    <li><a href="logout.php">Изход</a></li> 
                </ul>
            </nav>

        </div>
    </header>
    <main>
        <section class="home" id="home">
            <div class="container">
                <div class="home_text">
                    <h1>Добре дошли, ВКЪЩИ!</h1>
                    <h3 style="align-items: center;">#ТиСиВсичкоЗаНас</h3>
                </div>
            </div>
        </section>
    </main>
    <script>
        const burger = document.getElementById('burger');
        const ul = document.querySelector('nav ul');

        burger.addEventListener('click', () => {
            burger.classList.toggle('show-x');
            ul.classList.toggle('show');
        });
    </script>
</body>

</html>