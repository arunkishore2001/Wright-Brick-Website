<?php
// Include the database connection file
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
    <title>Property Submissions</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional: Link to your CSS file for styling -->
    <style>
        /* Add basic table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
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
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['country']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td><?php echo $row['whatsapp'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($row['property_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['property_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['floorplan_type']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No submissions found.</p>
    <?php endif; ?>

    <?php $conn->close(); // Close the database connection ?>
</body>
</html>
