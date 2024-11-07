<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
    {{-- @php
        $content = $sectionContents[$section->id] ?? [];
    @endphp --}}

    @php 
    $data =  \App\Models\ReportSection::select('content')->where('id',$section->id)->first();
    $content = json_decode($data->content, true);
   @endphp

    <div class="row mt-3">
        <div class="col-md-12">
            <label class="form-label">Title:</label>
            <input type="text" id="warranty-title"
                value="{{ $content['title'] ?? '' }}" name="warranty-title">
            <input type="hidden" name="warranty_id" id="warranty_id"
                value="{{ $section->id }}" />
        </div>
        <div class="col-md-12 mt-3">
            <label class="form-label">Select the warranty start date:</label>
            <input type="date" id="warranty_start_date"
                value="{{ $content['date'] ?? '' }}" name="warranty_start_date">
        </div>
    </div>

    <div class="mt-3">
        <div class="mt-4"><strong>Customer Name</strong><br/></div>
        {{ $customerDetails->name ?? '' }}
        <div class="mt-4"><strong>Address</strong><br /></div>
        {{ $customerDetails->address ?? '' }}

        @if (isset($content['date']))
            <div class="mt-4"><strong>Date project completed</strong><br />
                <span class="displayDate"> {{ $content['date'] ?? '' }}</span>
            </div>
        @endif
    </div>
    {{-- End Warranty page --}}

   
</div>

 <script type="text/javascript">
    function saveWarrantyData() {
    var reportId = $('#report_id').val();
    var warranty_title = $('#warranty-title').val();
    var warranty_start_date = $('#warranty_start_date').val(); // Get the updated date value
    var warranty_id = $('#warranty_id').val();

    $('.displayDate').text(warranty_start_date);

    $.ajax({
        url: '{{ route('store.warranty') }}',
        type: 'POST',
        data: {
            '_token': '{{ csrf_token() }}',
            'section_type_id': warranty_id,
            'reportId': reportId,
            'date': warranty_start_date,
            'title': warranty_title
        },
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
            alert('An error occurred while saving data');
        }
    });
}

$(document).ready(function() {
    $('#warranty_start_date').on('change', saveWarrantyData);
    $('#warranty-title').on('input', saveWarrantyData);
});
    </script>