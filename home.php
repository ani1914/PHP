<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="home.css">
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
                <input type='checkbox' id='responsive-menu' onclick='updatemenu()'>
                <label>Menu</label>
                <ul>
                    <li><a href="#" id="loginBtn" class="active">Вход</a></li>
                    <li><a href="#" id="registerBtn" class="active">Регистрация</a></li>
                </ul>
            </nav>


        </div>
    </header>
    <main>
        <section class="home" id="home">
            <div class="container">
                <div class="home_text">
                    <h1>Историята вдъхновява,</h1>
                    <h1>фанелката задължава!</h1>
                    <h3 style="align-items: center;">#ТиСиВсичкоЗаНас</h3>
                </div>
            </div>
        </section>
    </main>

    <!-- Login form -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="login.php" method="post">
                <label for="username">Потребителско име:</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Парола:</label><br>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" value="Вход">
            </form>
        </div>
    </div>
    <!--Register form -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="register_process.php" method="post">
                <label for="username">Потребителско име:</label><br>
                <input type="text" id="reg-username" name="username" required><br>
                <label for="email">Имейл:</label><br>
                <input type="email" id="reg-email" name="email" required><br>
                <label for="password">Парола:</label><br>
                <input type="password" id="reg-password" name="password" required><br><br>
                <input type="submit" value="Регистрация">
            </form>
        </div>
    </div>


    <script>
        const burger = document.getElementById('burger');
        const ul = document.querySelector('nav ul');
        const loginBtn = document.getElementById('loginBtn');
        const registerBtn = document.getElementById('registerBtn');
        const loginModal = document.getElementById('loginModal');
        const registerModal = document.getElementById('registerModal');
        const closeButtons = document.querySelectorAll('.close');

        burger.addEventListener('click', () => {
            burger.classList.toggle('show-x');
            ul.classList.toggle('show');
        });

        loginBtn.onclick = function() {
            loginModal.style.display = 'block';
        }

        registerBtn.onclick = function() {
            registerModal.style.display = 'block';
        }

        closeButtons.forEach(btn => {
            btn.onclick = function() {
                btn.parentElement.parentElement.style.display = 'none';
            }
        });

        window.onclick = function(event) {
            if (event.target == loginModal) {
                loginModal.style.display = 'none';
            }
            if (event.target == registerModal) {
                registerModal.style.display = 'none';
            }
        }
    </script>

</body>

</html>