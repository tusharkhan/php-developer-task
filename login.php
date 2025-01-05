<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>';
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['register_success'])) {
                    echo '<p class="success">' . htmlspecialchars($_SESSION['register_success']) . '</p>';
                    unset($_SESSION['register_success']);
                }
                ?>
                <div class="card-body">
                    <h2 class="card-title">Login</h2>

                    <form action="lib/login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Email</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const errorElement = document.querySelector('.error');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }, 5000);
</script>


</body>
</html>