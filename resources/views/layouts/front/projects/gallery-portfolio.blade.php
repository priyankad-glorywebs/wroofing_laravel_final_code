@if(isset($portfolio) && $portfolio !== "")
    <div class="items">
        @foreach($portfolio as $image)
            @if($image->media_type === 'image')
                <div class="item" data-category="images">
                    <a class="image-gallery-popup" href="{{ asset('storage/' . $image->image) }}">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="gallery-img" width="170" height="150">
                    </a>
                </div>
            @elseif($image->media_type === 'video')
                <div class="item video-container" data-category="video">
                    <a class="video-gallery-popup video_model" href="{{ asset('storage/' . $image->image) }}">
                        <video width="150" height="150" controls>
                            <source src="{{ asset('storage/' . $image->image) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                    {{-- <span class="image-upload-time">{{ $image->time }}</span> --}}
                </div>
            @endif
        @endforeach
    {{-- @else
    No images uploaded by contractors --}}
@endif

<script>
    jQuery(document).ready(function ($) {
        $('#gallerypopup').on('shown.bs.modal', function (e) {
            // Define App Namespace
            var popup = {
                // Initializer
                init: function () {
                    popup.popupVideo();
                },
                popupVideo: function () {
                    $('.video_model').magnificPopup({
                        type: 'iframe',
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        preloader: false,
                        fixedContentPos: false,
                        gallery: {
                            enabled: true
                        }
                    });
                    /* Image Popup*/
                    $('.image-gallery-popup').magnificPopup({
                        // delegate: 'a',
                        type: 'image',
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        preloader: false,
                        fixedContentPos: false,
                        gallery: {
                            enabled: true
                        }
                    });
                }
            };
            popup.init($);
        });
    });
</script>