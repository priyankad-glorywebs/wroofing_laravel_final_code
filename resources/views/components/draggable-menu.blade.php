<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
        <ul class="nav flex-column nav-pills" id="post_sortable" role="tablist">
            @foreach($sections as $index => $section)
                <li class="nav-item d-flex align-items-center ui-state-default" data-menu-id="{{ $section->id }}" data-report-id="{{ $reportId }}">
                    <span class="pos_num pl-20"> {{ $loop->index + 1 }}</span>
                    
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                       id="pills-{{ $section->name }}-tab" 
                       data-bs-toggle="pill" 
                       href="#pills-{{ $section->name }}" 
                       role="tab" 
                       aria-controls="pills-{{ $section->name }}" 
                       aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                        {{ $section->name }}
                    </a>
                    
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input switch-tabs"  
                               type="checkbox" 
                               id="switch-{{ $section->name }}" 
                               data-section-id="{{ $section->id }}"
                               @if(trim($section->status ?? '') === 'active') checked @endif>
                        <label class="form-check-label" for="switch-{{ $section->name }}"></label>
                    </div> 
                </li> 
            @endforeach
        </ul>
    {{-- </div> --}}
</div>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<script>
    $(document).ready(function() {
//  $("#post_sortable").sortable({
//         placeholder: "ui-state-highlight",
//         update: function(event, ui) {
//             var post_order_ids = [];
//             var report_ids = [];

//             $('#post_sortable li').each(function() {
//                 post_order_ids.push($(this).data("menu-id"));
//                 report_ids.push($(this).data('report-id'));
//             });

//             $.ajax({
//                 type: "POST",
//                 url: "{{-- route('post.order_change') --}}",
//                 dataType: "json",
//                 data: {
//                     order: post_order_ids,
//                     report: report_ids[0], 
//                     _token: "{{ csrf_token() }}"
//                 },
//                 success: function(response) {
//                     if(response.success == true){
//                         $('#toast-message .toast-body').text('Order change success !');
//                         var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
//                             autohide: true,
//                             delay: 3000
//                         });
//                         toast.show();
//                     }

//                     $('#post_sortable li').each(function(index) {
//                         $(this).find('.pos_num').text(index + 1);
//                     });
//                 },
//                 error: function(xhr, status, error) {
//                     console.log(xhr.responseText);
//                 }
//             });
//         }
//     });
$(document).ready(function() {
    $("#post_sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function(event, ui) {
            var post_order_ids = [];
            var report_ids = [];

            $('#post_sortable li').each(function() {
                post_order_ids.push($(this).data("menu-id"));
                report_ids.push($(this).data('report-id'));
            });

            $.ajax({
                type: "POST",
                url: "{{ route('post.order_change') }}",
                dataType: "json",
                data: {
                    order: post_order_ids,
                    report: report_ids[0], 
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('#toast-message .toast-body').text('Order change success!');
                        var toast = new bootstrap.Toast(document.getElementById('toast-message'), {
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();
                    }

                    $('#post_sortable li').each(function(index) {
                        $(this).find('.pos_num').text(index + 1);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    }).disableSelection();
});


});
</script>