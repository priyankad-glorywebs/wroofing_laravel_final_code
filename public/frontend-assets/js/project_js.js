
Dropzone.autoDiscover = false;

$(document).ready(function () {
    var project_id = $('#project_id').val();

    // Initialize Dropzone
    var dropzone = new Dropzone('#image-upload', {
        thumbnailWidth: 200,
        url: "{{ route('test') }}",
        maxFilesize: 1,
        addRemoveLinks: true, // Enable remove button
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4",
        dictRemoveFile: "Remove file",
		uploadMultiple: true,
        init: function () {
            // Load existing images into Dropzone
            loadExistingImages(this);

            // Add event listener for remove button
            this.on("removedfile", function (file) {
                // Display confirmation popup
                if (confirm("Are you sure you want to delete this image?")) {
                    // Make an AJAX request to remove the image from the server and database
                    var fileName = file.name;
                    removeImageFromServer(fileName);
                }
            });
        }
    });

    // Trigger the upload when the submit button is clicked
    $('#submit-all').click(function () {
        // Your existing submit logic
        // Make an AJAX request to your designStudioStore function
        var files = dropzone.getAcceptedFiles();
        var formData = new FormData();

        // Append newly added files
        for (var i = 0; i < files.length; i++) {
            formData.append('file[]', files[i]);
        }

        // Append existing images
        var existingImages = <?php echo json_encode($imageArray); ?> || [];
        for (var i = 0; i < existingImages.length; i++) {
            formData.append('existing_images[]', existingImages[i]);
        }

        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'POST',
            url: "{{ route('design.studio.post', ['project_id' => '__project_id__']) }}".replace('__project_id__', project_id),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var project_id = response.project_id;
                window.location.href = "{{ route('general.info', ['project_id' => '__project_id__']) }}".replace('__project_id__', project_id);
            },
            error: function (error) {
                // Handle the error response
                console.log(error);
            }
        });
    });

    function loadExistingImages(dropzoneInstance) {
        // Load existing images from the server and add them to the Dropzone instance
        var existingImages = <?php echo json_encode($imageArray); ?> || [];

        if (existingImages.length > 0) {
            for (var i = 0; i < existingImages.length; i++) {
                var file = {
                    name: existingImages[i],
                    size: 12345, // Set a dummy size or fetch the actual size from the server
                    accepted: true,
                    kind: 'image',
                    dataURL: "{{ asset('storage/project_images/') }}" + '/' + existingImages[i]
                };
                dropzoneInstance.emit('addedfile', file);
                dropzoneInstance.emit('thumbnail', file, "{{ asset('storage/project_images/') }}" + '/' + existingImages[i]);
            }
        }
    }

    // Function to remove image from server and database
    function removeImageFromServer(fileName) {
        // Make an AJAX request to your server to remove the image
        $.ajax({
            type: 'POST',
            url: "{{ route('remove.image') }}", // Replace with your actual route for removing images
            data: { file_name: fileName, project_id: project_id, _token: '{{ csrf_token() }}' },
            success: function (response) {
                console.log(response); // Handle success response
            },
            error: function (error) {
                console.log(error); // Handle error response
            }
        });
    }
});