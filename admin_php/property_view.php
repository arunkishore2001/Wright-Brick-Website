<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property View</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Property Records</h2>
        
        <?php
        include 'config.php';
        session_start();

        // Retrieve all entries with specified columns from the contact_form table
        $query = "SELECT id, name, email, phone, property_type, property_name, floorplan_type FROM contact_form";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-striped'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Property Type</th>
                            <th>Property Name</th>
                            <th>Floorplan Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['property_type']}</td>
                        <td>{$row['property_name']}</td>
                        <td>{$row['floorplan_type']}</td>
                        <td>
                            <button class='btn btn-danger delete-btn' data-id='{$row['id']}'>Delete</button>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-center'>No data available.</p>";
        }

        $conn->close();
        ?>

    </div>

    <script>
        $(document).ready(function() {
            // Handle delete button click
            $('.delete-btn').click(function() {
                var recordId = $(this).data('id');
                
                // Show confirmation modal
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action will permanently delete the record.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to delete the record
                        $.ajax({
                            url: 'delete_record.php',
                            type: 'POST',
                            data: { id: recordId },
                            success: function(response) {
                                if (response === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'The record has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload(); // Refresh the page to update the table
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an issue deleting the record.',
                                        'error'
                                    );
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
