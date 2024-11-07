<div>
    <style type="text/css">
	.upload-img-wrap {
    position: relative;
    }

.delete-img-btn {
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
    <form id="inspection-form" class="inspection-form" enctype="multipart/form-data">
        @php
            $data = \App\Models\ReportSection::select('content')
                 ->where('id', $section->id)
                    ->first();
            $content = json_decode($data->content, true);
        @endphp
        <input type="hidden" id="inspection_section_type_id" value="{{ $section->id }}">
        <div class="mb-3">
            <label for="inspection-title" class="form-label">Title</label>
            <input type="text" placeholder="Add Title" value="{{ $content['inspection_title'] ?? '' }}" id="inspection-title"
                class="form-control mb-2">
        </div>

        <div class="row mb-3" id="containimages">
            <div class="col-md-6">
                <label class="form-label">Upload File</label>
                <div class="upload-img-wrap" id="inspectionFile">
                    <input id="inspection_image" type="file" name="inspection_image"
                        accept="image/jpg, image/jpeg, image/png" hidden>
                    <label for="inspection_image" class="custom-file-upload inspection_image">
                        @if (isset($content['inspection_image']) && !empty($content['inspection_image']))
                            <img src="{{ asset($content['inspection_image']) }}" id="inspectionFile" alt="ThankYou logo"
                                width="180px" style="height:200px">
                        @else
                            <div class="upload-img-icon">
                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon">
                            </div>
                            <div class="upload-img-text">Upload your picture</div>
                            <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                        @endif
                    </label>  
                    {{-- @if(isset($content['inspection_image']) && $content['inspection_image'] !== NULL && $content['thankyou_logo'] !== '') --}}
                        {{-- <div class="delete-img-btn" style="cursor: pointer" onclick="deleteCompanyImage('{{ $content['thankyou_logo'] }}')">X</div> --}}
                    {{-- @endif --}}
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Content</label>
                 <textarea id="inspection_content">{!! $content['inspection_content']??''!!}</textarea>
            </div>
        </div>
     </form>
</div>

<script type="text/javascript">

</script>

<script type="text/javascript">
    let contentData;
    
    ClassicEditor
        .create(document.querySelector("#inspection_content"), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList',
                    'numberedList', '|', 'blockQuote', '|', 'undo', 'redo',
                ]
            },
        })
        .then(editor => {
            contentData = editor;
            
            editor.model.document.on('change:data', () => {
                saveInspectionFormData();
            });
        })
        .catch(error => {
            console.error(error);
        });
    
    function saveInspectionFormData() {
        let inspectionData = new FormData(document.getElementById('inspection-form'));
        inspectionData.append('inspection_content', contentData.getData()); 
        inspectionData.append('inspection_title', document.getElementById('inspection-title').value);
        inspectionData.append('inspection_section_type_id', document.getElementById('inspection_section_type_id').value); 
        inspectionData.append('_token', '{{ csrf_token() }}'); 
    
        $.ajax({
            url: '{{ route('inspection.store') }}', 
            method: 'POST',
            data: inspectionData,
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
                    var inspectionData =  response.data;
                    var baseUrl = '{{ asset('') }}';

                    $('.inspection_image').html();
                    if (inspectionData.inspection_image) {
                        $('.inspection_image').html(`<img src="${baseUrl + inspectionData.inspection_image}" id="blah" alt="company logo" width="180px" style="height:200px">`);
                    } 
                    
                } else {
                    alert('Error saving data.');
                }
            },
            error: function(xhr) {
                console.error('Error saving data:', xhr.responseText);
                alert('Error saving data.');
            }
        });
    }
    
    $('#inspection-title').on('input', function() {
        saveInspectionFormData();
    });
    
    $('#inspection_image').on('change', function() {
        saveInspectionFormData();
    });
    </script>