<div>
  

    @php
        $data = \App\Models\ReportSection::select('content')
            ->where('id', $section->id)
            ->first();
        $content = json_decode($data->content, true);
    @endphp

    <form name="term-form" id="term-form">
        <div class="row">

            <div class="mt-3">
                <label class="form-label" for="term_condition_title">Term & Condition Title</label>
                <input type="text" class="form-control" placeholder="Enter Title" name="t_and_c_title"
                    id="term_condition_title" value="{{ $content['term_page_title'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="termandcon_title" class="form-label">Content</label>
                <textarea id="termandcon_title">{!! $content['content'] ?? '' !!}</textarea>
            </div>
            <input type="hidden" name="section_type_termpage_id" id="section_type_termpage_id" value="{{$section->id??''}}">
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        let editorInstanceData;

        ClassicEditor
            .create(document.querySelector("#termandcon_title"), {
                toolbar: {
                    items: [
                        // 'sources','save',
                        'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList',
                        'numberedList', '|', 'blockQuote', '|', 'undo', 'redo',
                    ]
                },
            })
            .then(editor => {
                editorInstanceData = editor;
                editor.model.document.on('change:data', () => {
                    const content = editor.getData();
                    saveTermPageData(content);
                });
            })
            .catch(error => {
                console.error(error);
            });

        // Save title section data on input change
        $('#term_condition_title').on('input', function() {
            const titleContent = $(this).val();
            const editorContent = editorInstanceData.getData();
            saveTermPageData(editorContent, titleContent);
        });

        function saveTermPageData(content, titleContent) {
            if (!titleContent) {
                titleContent = $('#term_condition_title').val();
            }

            let data = {
                term_condition_title: titleContent,
                content: content,
                _token: '{{ csrf_token() }}',
                report_id: $('#report_id').val(),
                section_type_term_id: $('#section_type_termpage_id').val(),
            };

            // console.log(data);
            $.ajax({
                url: "{{ route('term.page.store') }}",
                method: 'POST',
                data: data,
                success: function(response) {
                    if (response.success) {
                        $('#toast-message .toast-body').text('Data saved successfully!');
                        var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();
                    }
                },
                error: function(xhr) {
                    console.error('Error saving data:', xhr.responseText);
                }
            });
        }
    });
</script>
