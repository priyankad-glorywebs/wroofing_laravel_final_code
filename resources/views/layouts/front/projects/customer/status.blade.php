@if(isset($status))
    <div class="quotes-detail-item-title">Status:</div>
    @if($status == 'Requested')
    <div class="quotes-detail-item-content">{{$status??''}}</div>
    @elseif($status == 'approved')
    <div><span class="approved-status">{{$status??''}}</span></div>
    @elseif($status == 'Responded')
    <div><span class="approved-status">{{$status??''}}</span></div>
    @elseif($status == 'rejected')
    <div><span class="rejected-status">{{$status??''}}</span></div>
    @endif	
@endif
