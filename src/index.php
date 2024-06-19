<?php
include 'config.php';

// Fetch products from the database
$sql = "SELECT id, name, price, description FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-commerce Application</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Welcome to my E-commerce Store</h1>
    <div class="product-list">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>" . $row["name"]. "</h2>";
                echo "<p>" . $row["description"]. "</p>";
                echo "<p>Price: $" . $row["price"]. "</p>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
