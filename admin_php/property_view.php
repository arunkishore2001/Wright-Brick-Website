<?php
include 'config.php';

// Fetch data from the properties table
$sql = "SELECT * FROM properties";
$landing_page_images = $conn->query($sql);

// Fetch data from the contact_form table
$query_contact = "SELECT name, email, phone FROM contact_form"; // Adjust query if needed
$result_contact = mysqli_query($conn, $query_contact);

// Get contact information
$contact_info = [];
if ($result_contact && mysqli_num_rows($result_contact) > 0) {
    while ($row_contact = mysqli_fetch_assoc($result_contact)) {
        $contact_info[] = $row_contact; // Store contact information in an array
    }
}

// Get the current date and time
$current_date_time = date('Y-m-d H:i:s'); // Format as 'YYYY-MM-DD HH:MM:SS'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Page</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            margin-bottom: 30px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Property Listings</h1>
    <button onclick="window.print()" class="btn btn-primary">Print</button>
    <!-- Display current date and time -->
    <div class="text-right mb-3">
        <p><strong>Date and Time:</strong> <?php echo $current_date_time; ?></p>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Property Type</th>
                <th>Property Name</th>
                <th>Floorplan Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($landing_page_images->num_rows > 0): ?>
                <?php while($row = $landing_page_images->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['property_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['floorplan_type']); ?></td>
                        <td>
                            <a href="delete_property.php?id=<?php echo $row['id']; ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this property?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No properties found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Display contact information -->
    <h2 class="text-center">Contact Information</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($contact_info)): ?>
                <?php foreach ($contact_info as $contact): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No contact information available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
