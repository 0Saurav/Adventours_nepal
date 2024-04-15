<?php
// Include your database connection file
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adventours_nepal';
$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Retrieve existing packages
$packages = [];
$query = "SELECT * FROM packages";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $packages[] = $row;
    }
}

// Create or update a package
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageId = $_POST['package_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $price = $_POST['price'];

    if (empty($packageId)) {
        // Create new package
        $query = "INSERT INTO packages (title, description, image, price) VALUES ('$title', '$description', '$image', '$price')";
    } else {
        // Update existing package
        $query = "UPDATE packages SET title = '$title', description = '$description', image = '$image', price = '$price' WHERE id = '$packageId'";
    }

    $result = mysqli_query($connection, $query);

    if ($result) {
        // Redirect to the read_package page
        header('Location: read_package.php');
        exit();
    } else {
        // Display an error message
        $error = "Error: " . mysqli_error($connection);
    }
}

// Delete a package
if (isset($_GET['delete'])) {
    $packageId = $_GET['delete'];

    $query = "DELETE FROM packages WHERE id = '$packageId'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Redirect to the read_package page
        header('Location: read_package.php');
        exit();
    } else {
        // Display an error message
        $error = "Error: " . mysqli_error($connection);
    }
}

// Fetch package details for editing
$editPackage = null;
if (isset($_GET['edit'])) {
    $editPackageId = $_GET['edit'];

    $query = "SELECT * FROM packages WHERE id = '$editPackageId'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $editPackage = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <header class="admin-header">
        <div class="admin-container">
            <h1 class="logo">Adventours Nepal</h1>
            <nav class="admin-navbar">
                <a href="bookings.php">Manage Bookings</a>
                <a href="read_package.php">Packages</a>
                <a href="users.php">Users</a>
                <a href="reviews.php">Reviews</a>
                <a href="analytics.php" class="active">Analytics</a>
                <a href="crm_dashboard.php" class="active">Customer Details</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <section class="admin-content">
        <div class="admin-container">
            <h1>Admin Panel</h1>

            <!-- Form for adding/editing packages -->
            <form class="package-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="package_id" value="<?php echo isset($editPackage['id']) ? $editPackage['id'] : ''; ?>">
                <label class="form-label">Title:</label>
                <input type="text" name="title" value="<?php echo isset($editPackage['title']) ? $editPackage['title'] : ''; ?>" class="form-input">
                <br>
                <label class="form-label">Description:</label>
                <textarea name="description" class="form-textarea"><?php echo isset($editPackage['description']) ? $editPackage['description'] : ''; ?></textarea>
                <br>
                <label class="form-label">Image URL:</label>
                <input type="text" name="image" value="<?php echo isset($editPackage['image']) ? $editPackage['image'] : ''; ?>" class="form-input">
                <br>
                <label class="form-label">Price:</label>
                <input type="text" name="price" value="<?php echo isset($editPackage['price']) ? $editPackage['price'] : ''; ?>" class="form-input">
                <br>
                <button type="submit" class="form-button">Save</button>
            </form>

            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <!-- Display existing packages -->
            <table class="package-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $package): ?>
                        <tr>
                            <td><?php echo $package['title']; ?></td>
                            <td><?php echo $package['description']; ?></td>
                            <td><img src="<?php echo $package['image']; ?>" alt="Package Image" width="100"></td>
                            <td><?php echo $package['price']; ?></td>
                            <td>
                                <a href="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $package['id']; ?>" class="edit-link">Edit</a>
                                <a href="<?php echo $_SERVER['PHP_SELF'] . '?delete=' . $package['id']; ?>" onclick="return confirm('Are you sure you want to delete this package?')" class="delete-link">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>

    <footer class="admin-footer">
        <div class="admin-container">
            <p>&copy; 2023 Adventours. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
