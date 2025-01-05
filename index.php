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

<div class="container-fluid">
<?php if( isset($_SESSION['username']) ) : ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3" id="navbar_data" data-name="<?php echo $_SESSION['username'] ?>">
        <a class="navbar-brand"  href="#"><?php echo $_SESSION['username'] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="lib/logout.php">Logout</a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cart (<span id="cart-total">0</span>)
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cartDropdown">
                            <h6 class="dropdown-header">Cart Items</h6>
                            <div id="cart-items" class="px-3">
                                <p class="text-muted">Your cart is empty.</p>
                            </div>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>
    <div class="row mb-3">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Manage Categories</h1>
                    <form id="category-form" method="POST" action="lib/add_cat.php">
                        <div class="form-group">
                            <label for="category_name">Category Name:</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </form>
                    <ul id="category-list"></ul>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Add Product</h1>
                    <form id="product-form" enctype="multipart/form-data" method="POST" action="lib/save.php">
                        <div class="form-group">
                            <label for="product_name">Product Name:</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="product_category">Category:</label>
                            <select name="product_category" id="product_category" class="form-control" required>
                                <option value="" selected disabled>Select Category</option>
                            </select>
                        </div>
                        <hr>
                        <div id="options-container">
                            <div class="form-group" data-index="0">
                                <label>Option Name:</label>
                                <input type="text" name="options[0][name]" class="form-control" required>

                                <label>Image:</label>
                                <input type="file" name="options[0][image]" class="form-control" required>

                                <label>Price:</label>
                                <input type="number" name="options[0][price]" class="form-control" required>

                                <button type="button" class="remove-option btn btn-danger">Remove</button>
                            </div>
                        </div>
                        <button type="button" id="add-option" class="btn btn-info">Add Option</button>
                        <button type="submit" class="btn btn-success">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Product List</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Price</th>
                                    <th>Option Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
