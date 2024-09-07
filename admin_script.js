$(document).ready(function() {
    // Edit Button Click
    $('.edit-button').on('click', function() {
        var projectId = $(this).data('id');
        
        // Fetch project data via AJAX
        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: { action: 'fetch', project_id: projectId },
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success') {
                    $('#edit_project_id').val(response.data.project_id);
                    $('#edit_project_name').val(response.data.project_name);
                    $('#edit_description').val(response.data.description);
                    $('#edit_date').val(response.data.date);
                    $('#edit_status').val(response.data.status);
                    $('#edit_category').val(response.data.category);
                    
                    $('#editProjectModal').modal('show');
                } else {
                    alert('Failed to fetch project data.');
                }
            }
        });
    });

    // Edit Project Form Submission
    $('#editProjectForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        formData.append('action', 'update');
        
        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });

    // Delete Button Click
    $('.delete-button').on('click', function() {
        var projectId = $(this).data('id');
        
        if(confirm('Are you sure you want to delete this project?')) {
            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: { action: 'delete', project_id: projectId },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        }
    });
});
