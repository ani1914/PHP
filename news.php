<?php
// Включване на файла за конфигурация
require 'config.php';

// Заявка за извличане на всички новини и статии от базата данни
$sql = "SELECT * FROM news";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Левски София - Новини</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="news.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Левски София</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="players.php">Отбор</a>
                </li>
                <li class="nav-item">
                    <form action="logout.php" method="post" class="form-inline">
                        <button type="submit" class="btn btn-danger">Изход</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container news-container">
        <h1 class="text-center mb-4">Новини</h1>
        <div class="row">
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="col-md-4">
                        <div class="news-card animate__animated animate__fadeInUp" data-toggle="modal" data-target="#newsModal<?php echo $row['id']; ?>">
                            <h2 class="news-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                            <p class="news-date"><?php echo htmlspecialchars($row['date']); ?></p>
                        </div>
                    </div>

                    <div class="modal fade" id="newsModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="newsModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newsModalLabel<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                                    <p class="news-date"><?php echo htmlspecialchars($row['date']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Няма налични новини и статии.</p>
            <?php endif; ?>
            <?php $conn->close(); ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>