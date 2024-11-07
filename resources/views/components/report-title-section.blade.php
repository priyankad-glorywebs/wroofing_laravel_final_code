<div>
    <style type="text/css">

	.upload-img-wrap {
    position: relative;
}

.delete-img-btn {
	/* display: none; */
position: absolute;
top: -10px;
right: -10px;
height: 30px;
width: 30px;
border-radius: 10em;
padding: 2px 6px 3px;
text-align: center;
line-height: 25px;
text-decoration: none;
font: 700 14px/25px sans-serif;
background: #0A84FF;
color: #FFF;
s  -webkit-transition: background 0.5s;
  transition: background 0.5s;
}

.upload-img-wrap:hover .delete-img-btn {
    display: block;
	background: #E54E4E;
  padding: 3px 7px 5px;
  top: -11px;
right: -11px;
}
    </style>
    <form id="content" class="content-form" enctype="multipart/form-data">
        @php
            $data = \App\Models\ReportSection::select('content')
                ->where('id', $section->id)
                ->first();
                // dd($data);
            $content = json_decode($data->content, true);
        @endphp
        <input type="hidden" id="section_type_id" value="{{ $section->id }}">

        <div class="mb-3">
            <label for="title" class="form-label">Report Type</label>
            <input type="text" placeholder="Add Title" value="{{ $content['title'] ?? '' }}" id="title"
                class="form-control mb-2">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" id="date" value="{{ $content['date'] ?? '' }}" class="form-control mb-2">
        </div>

        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" placeholder="Company Name" value="{{ $content['company_name'] ?? '' }}"
                id="company_name" class="form-control mb-2">
        </div>

        <div class="row mb-3" id="containimages">
            <div class="col-md-6">
                <label class="form-label">Company Logo</label>
                <div class="upload-img-wrap" id="companyLogo">
                    <input id="company_logo" type="file" name="company_logo"
                        accept="image/jpg, image/jpeg, image/png" hidden>
                    <label for="company_logo" class="custom-file-upload company">
                        @if (isset($content['company_logo']) && !empty($content['company_logo']))
                            <img src="{{ asset($content['company_logo']) }}" id="blah" alt="company logo"
                                width="180px" style="height:200px">
                        @else
                            <div class="upload-img-icon">
                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon">
                            </div>
                            <div class="upload-img-text">Upload your picture</div>
                            <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                        @endif
                    </label>  
                    {{-- @if(isset($content['company_logo']) && $content['company_logo'] !== NULL && $content['company_logo'] !== '')
                        <div class="delete-img-btn" style="cursor: pointer" onclick="deleteCompanyImage('{{ $content['company_logo'] }}')">X</div>
                    @endif   --}}
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Banner Image</label>
                <div class="upload-img-wrap" id="banner">
                    <input id="banner_image" type="file" name="banner_image"
                        accept="image/jpg, image/jpeg, image/png" hidden >
                    <label for="banner_image" class="custom-file-upload" id="bannerimg">
                        @if (isset($content['banner_image']) && !empty($content['banner_image']))
                            <img src="{{ asset($content['banner_image']) }}" id="banner_container" alt="banner image"
                                width="180px" style="height:200px">
                        @else
                            <div class="upload-img-icon">
                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon">
                            </div>
                            <div class="upload-img-text">Upload your picture</div>
                            <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                        @endif
                    </label>
                    {{-- @if(isset($content['banner_image']) && $content['banner_image'] !== NULL && $content['banner_image'] !== '')
						<div class="delete-img-btn" style="cursor: pointer" onclick="deletebannerImage('{{ $content['banner_image'] }}')">X</div>
					@endif --}}
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" placeholder="Address" value="{{ $content['address'] ?? '' }}" id="address"
                class="form-control mb-2">
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" placeholder="First Name" value="{{ $content['first_name'] ?? '' }}" id="first_name"
                class="form-control mb-2">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" placeholder="Last Name" value="{{ $content['last_name'] ?? '' }}" id="last_name"
                class="form-control mb-2">
        </div>
    </form>
</div>


<script type="text/javascript">
function deletebannerImage(imageName) {
        var section_type_id = $('#section_type_id').val();
       $.ajax({
        url: "{{ route('delete.banner.image') }}", 
        type: 'POST',
        data: { 
            image_name: imageName,
            "_token": "{{ csrf_token() }}",
            section_type_id:section_type_id
        },
        success: function(response) {
            if (response.success) {
                $('#banner').html(`<div class="upload-img-wrap" id="banner">
                    <input id="banner_image" type="file" name="banner_image"
                        accept="image/jpg, image/jpeg, image/png" hidden >
                    <label for="banner_image" class="custom-file-upload">
                      
                            <div class="upload-img-icon">
                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon">
                            </div>
                            <div class="upload-img-text">Upload your picture</div>
                            <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                    </label>
                  
                </div>`);
                console.log('Image deleted successfully');
            } else {
                console.error('Error deleting image:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error deleting image:', error);
        }
    });
}

function deleteCompanyImage(imageName){
    var section_type_id = $('#section_type_id').val();
       $.ajax({
        url: "{{ route('delete.company.logo.image') }}", 
        type: 'POST',
        data: { 
            image_name: imageName,
            "_token": "{{ csrf_token() }}",
            section_type_id:section_type_id
        },
        success: function(response) {
            if (response.success) {
                $('#companyLogo').html(`
                <div class="upload-img-wrap" id="companyLogo">
                    <input id="company_logo" type="file" name="company_logo"
                        accept="image/jpg, image/jpeg, image/png" hidden>
                    <label for="company_logo" class="custom-file-upload">
                            <div class="upload-img-icon">
                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon">
                            </div>
                            <div class="upload-img-text">Upload your picture</div>
                            <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                    </label>  
                </div>`);
                console.log('Image deleted successfully');
            } else {
                console.error('Error deleting image:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error deleting image:', error);
        }
    });
}


    $(document).ready(function() {
        
        $('#company_logo').on('change', function() {
            const file = this.files[0];
            if (file) {
                $('#blah').attr('src', URL.createObjectURL(file));
            }
        });

        $('#banner_image').on('change', function() {
            const file = this.files[0];
            if (file) {
                $('#banner_container').attr('src', URL.createObjectURL(file));
            }
        });

        $('.content-form input').on('change', function() {
            saveFormData();
        });

        function saveFormData() {
            let data = new FormData();
            data.append('title', $('#title').val());
            data.append('date', $('#date').val());
            data.append('company_name', $('#company_name').val());
            data.append('address', $('#address').val());
            data.append('first_name', $('#first_name').val());
            data.append('last_name', $('#last_name').val());
            data.append('company_logo', $('#company_logo')[0].files[0]);
            data.append('banner_image', $('#banner_image')[0].files[0]);
            data.append('_token', '{{ csrf_token() }}');
            data.append('report_id', $('#report_id').val());
            data.append('section_type_id', $('#section_type_id').val());

            //console.log(data);
            $.ajax({
                url: '{{ route('report_sections.store') }}',
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#toast-message .toast-body').text('Data saved successfully!');
                        var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();

                    var content = JSON.parse(response.data.content);
                    var baseUrl = '{{ asset('') }}';

                    if (content.company_logo) {
                        $('.company').html(`<img src="${baseUrl + content.company_logo}" id="blah" alt="company logo" width="180px" style="height:auto">`);
                    } 
                    if (content.banner_image) {
                        $('#bannerimg').html(`<img src="${baseUrl + content.banner_image}" id="banner_container" alt="banner image" width="180px" style="height:200px">`);
                    }
                    
                    
                    }

                },
                error: function(xhr) {
                    console.error('Error saving data:', xhr.responseText);
                }
            });

        }

        


        // function deleteImage(imageName) {
        // // Ajax call to delete image
        // $.ajax({
        //     url: "{{--route('delete.image')--}}",
        //     type: 'POST',
        //     data: { image_name: imageName ,
		// 		"_token": "{{ csrf_token() }}",
		// 	},
        //     success: function(response) {
        //         // Handle success, e.g., remove UI elements
        //         console.log('Image deleted successfully');
		// 		$('.upload-img-text').text('');
		// 		$('.upload-img-text').text('Upload your picture');
		// 		$('.delete-img-btn').hide();
		// 		$('.profile-image').html(`<img src="http://127.0.0.1:8000/frontend-assets/images/defaultimage.jpg" onerror="this.onerror=null;callfun(this);" height="50" width="50">`);				
        //     },
        //     error: function(xhr, status, error) {
        //         // Handle error
        //         console.error('Error deleting image:', error);
        //     }
        // });
    // }

        // company_logo.onchange = evt => {
        //     const [file] = company_logo.files
        //     if (file) {
        //         blah.src = URL.createObjectURL(file)
        //     }
        // }

        // banner_image.onchange = evt => {
        //     const [file] = banner_image.files
        //     if (file) {
        //         banner_container.src = URL.createObjectURL(file)
        //     }
        // }
    });
</script>
