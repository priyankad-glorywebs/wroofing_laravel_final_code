

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
    <form id="thankyou-form" class="thankyou-form" enctype="multipart/form-data">
        @php
            $data = \App\Models\ReportSection::select('content')
                ->where('id', $section->id)
                ->first();
            $content = json_decode($data->content, true);
            // dd($content);
        @endphp
        <input type="hidden" id="thankyou_section_type_id" value="{{ $section->id }}">
        <div class="mb-3">
            <label for="thankyou-title" class="form-label">Title</label>
            <input type="text" placeholder="Add Title" value="{{ $content['thankyou_title'] ?? '' }}" id="thankyou-title"
                class="form-control mb-2">
        </div>

       

        <div class="row mb-3" id="containimages">
            <div class="col-md-6">
                <label class="form-label">Upload Logo</label>
                <div class="upload-img-wrap" id="thankyouLogo">
                    <input id="thankyou_logo" type="file" name="thankyou_logo"
                        accept="image/jpg, image/jpeg, image/png" hidden>
                    <label for="thankyou_logo" class="custom-file-upload thankyou_logo">
                        @if (isset($content['thankyou_logo']) && !empty($content['thankyou_logo']))
                            <img src="{{ asset($content['thankyou_logo']) }}" id="thankyoulogo" alt="ThankYou logo"
                                width="180px" style="height:200px">
                        @else
                            <div class="upload-img-icon">
                                <img src="{{ asset('frontend-assets/images/img-icon.svg') }}" alt="img-icon">
                            </div>
                            <div class="upload-img-text">Upload your picture</div>
                            <div class="upload-img-formate">(PNG or JPEG file accepted)</div>
                        @endif
                    </label>  
                    {{-- @if(isset($content['thankyou_logo']) && $content['thankyou_logo'] !== NULL && $content['thankyou_logo'] !== '') --}}
                        {{-- <div class="delete-img-btn" style="cursor: pointer" onclick="deleteCompanyImage('{{ $content['thankyou_logo'] }}')">X</div> --}}
                    {{-- @endif   --}}
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Content</label>
                
               <textarea id="thankyou-content">{!! $content['thankyou-content']??''!!}</textarea>
            </div>
        </div>

        
    </form>
</div>


<script type="text/javascript">
$('#thankyou-content').on('input', function() {
    const titleContent = $('#thankyou-title').val(); 
    const thankYouContent = editorInstanceData.getData(); 
    saveThankyouFormData(thankYouContent, titleContent);
});
let editorInstanceData;
const titleContent = $('#thankyou-title').val(); 

ClassicEditor
    .create(document.querySelector("#thankyou-content"), {
        toolbar: {
            items: [
                'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList',
                'numberedList', '|', 'blockQuote', '|', 'undo', 'redo',
            ]
        },
    })
    .then(editor => {
        editorInstanceData = editor;
        editor.model.document.on('change:data', () => {
            const content = editor.getData();
            saveThankyouFormData(content,titleContent);
        });
    })
    .catch(error => {
        console.error(error);
    });

// Save title section data on input change
$('#thankyou-title').on('input', function() {
    const titleContent = $(this).val();
    const thankYouContent = editorInstanceData.getData();
    saveThankyouFormData(thankYouContent, titleContent);
});

$('#thankyou-form input').on('change', function() {
    saveThankyouFormData(editorInstanceData.getData(), $('#thankyou-title').val());
});

$('#thankyou_logo').on('change', function() {
    saveThankyouFormData(editorInstanceData.getData(), $('#thankyou-title').val());
});

function saveThankyouFormData(content, titleContent) {
    let thankyoupageData = new FormData();
    thankyoupageData.append('thankyou_title', titleContent); 
    thankyoupageData.append('thankyou_logo', $('#thankyou_logo')[0].files[0]);
    thankyoupageData.append('_token', '{{ csrf_token() }}');
    thankyoupageData.append('report_id', $('#report_id').val());
    thankyoupageData.append('thankyou_section_type_id', $('#thankyou_section_type_id').val());
    thankyoupageData.append('thankyou-content', content); 

    $.ajax({
        url: '{{route('thank-you-page')}}',
        method: 'POST',
        data: thankyoupageData, 
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            var thankyoudata = response.data;
            console.log(thankyoudata);
            var baseUrl = '{{ asset('') }}';

            if (thankyoudata.thankyou_logo) {
                $('.thankyou_logo').html(`<img src="${baseUrl + thankyoudata.thankyou_logo}" id="thankyoulogo" alt="ThankYou logo" width="180px" style="height:200px">`);
            } 

            $('#toast-message .toast-body').text('Data saved successfully!');
                        var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();

        },
        error: function(xhr) {
            console.error('Error saving data:', xhr.responseText);
        }
    });
}
</script>

