<div>
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
            <div class="row breadcrumb-title d-none d-lg-flex">
                <div class="col-12 col-lg-6">
                    <div class="section-title">Your projects</div>
                </div>
                <div class="col-12 col-lg-6 text-end">
                    <a class="btn-primary" id="addProjectBtn" href="javascript:void(0);">Add a new project</a>
                </div>
            </div>
        </div>
    </div>
    <div class="project-list-sec">
        <div class="container">
            <div class="row d-lg-none">
                <div class="col-12">
                    <div class="signin-notes">Get started</div>
                    <div class="section-title text-center">Your projects</div>
                </div>
            </div>
            <div class="row">
                @foreach($projects as $project) 

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="project-list-item">

                            <div class="project-item-img">
                                @if(!isset($project->project_image))
                                    <img src="{{asset('frontend-assets/images/project-list-1.png')}}" alt="project img"
                                        width="270" height="230">
                                @else
                                    <img src="{{asset('frontend-assets/images/project-list-1.png')}}" alt="project img"
                                        width="270" height="230">
                                @endif
                            </div>
                            <div class="project-item-title-wrap d-flex align-items-center justify-content-between">
                                <div class="project-item-title">{{$project->title}}</div>
                                <div class="project-item-icon"><svg width="9" height="17" viewBox="0 0 9 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 16L7.43043 9.82576C8.18986 9.09659 8.18986 7.90341 7.43043 7.17424L1 1"
                                            stroke="#0A84FF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg></div>
                            </div>
                            <a class="project-list-item-link"
                                href="{{URL::to('add/project/' . base64_encode($project->id))}}">

                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="project-list-item">
                        <div class="project-item-img">
                            <img src="{{asset('frontend-assets/images/project-list-7.png')}}" alt="project img"
                                width="270" height="230">
                        </div>
                        <div class="project-item-title-wrap d-flex align-items-center justify-content-between">
                            <div class="project-item-title">New Project</div>
                            <div class="project-item-icon"><svg width="9" height="17" viewBox="0 0 9 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 16L7.43043 9.82576C8.18986 9.09659 8.18986 7.90341 7.43043 7.17424L1 1"
                                        stroke="#0A84FF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg></div>
                        </div>
                        <a class="project-list-item-link project-link-trigger" href="javascript:void(0);"
                            id="addnewprojectlink"></a>

                    </div>
                </div>
            </div>
            <div class="row d-lg-none">
                <div class="col-12">
                    <a class="btn-primary d-block" id="addProjectBtntwo" href="javascript:void(0);">Add a new
                        project</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    <div class="modal fade addprojectpopup quotepopup" id="addprojectpopup" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="staticBackdropLabel">Add Project</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form name="addProjectform" method="post">
                    <div class="modal-body">
                        <div class="quotepopup-wrap">
                            <div class="form-label">
                                <label for="uname">Project Name<span>*</span></label>
                            </div>

                            <div class="form-element">
                                <input type="text" name="projectname" id="projectname"
                                    placeholder="Enter your Project Name">
                            </div>
                            <span style="color:red" class="error-message d-none"></span>
                            <br />
                            <div class="quotepopup-button-wrap d-flex">
                                <a class="btn-primary d-block" id="approvebtn" href="javascript:void(0);">Add</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.project-link-trigger').on("click", function () {
                $('#projectname').val('');
                $('#addprojectpopup').modal('show');
            });

            $('.btn-close').on('click', function () {
              //  location.reload();
              $('#addprojectpopup').modal('hide');
            });


            $('#addProjectBtn').on("click", function () {
                $('.error-message').val('');
                $('#addprojectpopup').modal('show');

            });
            $('#addProjectBtntwo').on("click", function () {
                $('.error-message').val('');
                $('#addprojectpopup').modal('show');

            });

            $('#projectname').on('keydown', function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    $('#approvebtn').click();
                }
            });
            $('#approvebtn').on("click", function (e) {
                e.preventDefault();

                var projectname = $('#projectname').val();
                if (projectname == "") {
                    $('#projectname').css("border", "1px solid red");
                } else {
                    $('#projectname').css("border", "");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('add.project') }}",
                        data: { projectname: projectname },
                        success: function (response) {
                            if (response.success == true) {
                                $('#addproject').modal('hide');
                                if (response.success) {
                                    var projectId = response.data;
                                    window.location = "{{route('add.project')}}" + "/" + btoa(projectId);
                                }
                            } else {
                                $('.error-message').html(response.errors.projectname[0]).removeClass('d-none');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</div>