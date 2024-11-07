@extends('layouts.front.master')
@section('title', 'Send Qutation')
@section('content')
{{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> --}}
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

<section class="about-quotation-sec">
    <div class="container">
        <div class="row">
            <div class="about-quotation-wrap">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-12 text-center mb-4">
                    <div class="section-title">About Our Quotation Service:</div>
                </div>
                <div class="col-12 text-center">
                    <form action="{{ route('quotation_information.store') }}" method="POST">
                        @csrf
                        @php
                            $contractor_id = auth()->guard('contractor')->user()->id;
                        @endphp
                        <input type="hidden" id="contractor_id" name="contractor_id" value="{{ $contractor_id ?? '' }}">
                        <div>
                            <div class="field-wrap">
                            <textarea name="content" id="content" rows="10"
                                cols="80">{{ old('content', $quotationInformation->content ?? '') }}</textarea>
            {{-- <textarea name="content" id="content" rows="10"
                                    cols="80">{{ old('content', $quotationInformation->content ?? '') }}</textarea> --}}
                            </div>
                            <script>
                                // CKEDITOR.replace('content');
                                // CKEDITOR.replace('content', {
                                //     removePlugins: 'image,uploadimage',
                                //     toolbar: [
                                //         { name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
                                //         { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                                //         { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'] },
                                //         { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
                                //         '/',
                                //         { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                                //         { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
                                //         { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                                //         { name: 'insert', items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
                                //         '/',
                                //         { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                                //         { name: 'colors', items: ['TextColor', 'BGColor'] },
                                //         { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                                //     ]
                                // });
                            </script>
                        </div>
                        <button class="btn btn-primary mt-4" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        ClassicEditor
            .create(document.querySelector('textarea'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    </script>

</section>
@endsection