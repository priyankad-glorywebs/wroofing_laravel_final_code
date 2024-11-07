<div>
    {{-- @if (isset($sectionContents[$section->id]))
    @php
        $content = $sectionContents[$section->id];
    @endphp
@endif --}}
<style type="text/css">
     p{
        color:black !important;
     }
</style>
@php
// dd($section->section_type_id);
 $data =  \App\Models\ReportSection::select('content')->where('id',$section->id)->first();
         $content = json_decode($data->content, true);
        
@endphp

    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    {{-- <form id="content-form" class="content-form"> --}}
        <div class="mb-3">
            <label for="introduction_title" class="form-label">Title</label>
            <input type="text" placeholder="Add Title"
                value="{{ $content['introduction_title'] ?? '' }}" id="introduction_title"
                class="form-control mb-2">
        </div>
    
        <div class="mb-3">
            {{-- {{ $section->id ?? '' }} --}}
            <label for="tokenDropdown" class="form-label">Insert Token</label>
            <select class="form-select" id="tokenDropdown">
                <option value="">Select a Token</option>
                @foreach ($tokens as $token => $label)
                    <option value="{{ $token }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="editor" class="form-label">Content</label>
            <textarea id="editor">{!! $content['content'] ?? '' !!}</textarea>
            <input type="hidden" id="report_id" value="{{ $section->report_id ?? '' }}">
            <input type="hidden" id="section_type_intro_id" value="{{ $section->id ?? '' }}">
            {{-- <input type="TEXT" id="section_type_id" value="{{ $section->section_type_id ?? '' }}"> --}}
        </div>
    {{-- </form> --}}

    </div>
    <script type="text/javascript">
let editorInstance;

ClassicEditor
    .create(document.querySelector("#editor"), {
        toolbar: {
            items: [
                'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList',
                'numberedList', '|', 'blockQuote', '|', 'undo', 'redo'
            ]
        },
    })
    .then(editor => {
        editorInstance = editor;
        editor.model.document.on('change:data', () => {
            const content = editor.getData();
            saveEditorData(content);
        });
    })
    .catch(error => {
        console.error(error);
    });



function insertToken(token) {
    if (editorInstance) {
        const editor = editorInstance;
        editor.model.change(writer => {
            const insertPosition = editor.model.document.selection.getFirstPosition();
            writer.insertText(token, insertPosition);
        });
    }
}

document.getElementById('tokenDropdown').addEventListener('change', function() {
    const selectedValue = this.value;
    insertToken(selectedValue);
});

document.getElementById('introduction_title').addEventListener('input', function() {
    saveEditorData(editorInstance.getData());
});


function saveEditorData(content) {
    $.ajax({
        url: '{{ route("reports.introduction") }}',
        method: 'POST',
        data: {
            content: content,
            _token: '{{ csrf_token() }}',
            report_id: $('#report_id').val(),
            introduction_title: $('#introduction_title').val(),
            section_type_id: $('#section_type_intro_id').val()
        },
        success: function(response) {
            if (response.success) {
                $('#toast-message .toast-body').text('Data saved successfully!');
                var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                    autohide: true,
                    delay: 1000
                });
                toast.show();
            }
        },
        error: function(response) {
            console.error('Error saving data');
        }
    });
}
</script>


