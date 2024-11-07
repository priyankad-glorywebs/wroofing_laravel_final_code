@extends('layouts.front.master')
@section('title', 'Contractor Payment Filter Page')
@section('content')
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <div class="breadcrumb-title-wrap">
        <div class="container">
            <div class="row d-lg-none mt-4">
                <div class="col-12">
                    <div class="signin-notes">Home / Contractor Payment Filter</div>
                </div>
            </div>
            <div class="row breadcrumb-title">
                <div class="col-12 col-lg-7">
                    <div class="section-title">Roofing Contractor Payment Filter</div>
                </div>
            </div>
        </div>
    </div>
    <section class="studio-stepform-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="payment-details">
                        <!-- START PAYMENT TABLE -->
                        <div class="table-responsive">
                            <table id="paymentTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Customer Name</th>
                                        <th>Payment Date</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated by DataTables via AJAX -->
                                </tbody>
                            </table>
                        </div>
                        <!-- END PAYMENT TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Initialize DataTables with AJAX -->
        <!-- Include DataTables JS -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <!-- Include DataTables Bootstrap JS -->
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#paymentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('payments.data') }}", // Laravel route to fetch data
                        type: 'GET',
                        error: function(xhr, error, thrown) {
                            console.error('Error fetching data:', thrown);
                            console.log('Response:', xhr.responseText);
                        }
                    },
                    columns: [
                        {
                            data: 'project_title',
                            name: 'projects.title',
                            render: function(data, type, row) {
                            // Assuming you have a route like 'project.show' to show project details
                            var projectUrl = '/contractor/project/details/' + row.project_id;
                            return data + ' <a class="overlay-link" href="' + projectUrl + '">[#' + row.p_id + ']</a>';                            }
                        },
                        {
                            data: 'customer_name',
                            name: 'users.name'
                        },
                        {
                            data: 'payment_date',
                            name: 'transactions.created_at'
                        },
                        {
                            data: 'amount_paid',
                            name: 'transactions.amount',
                            render: function(data, type, row) {
                                return '$'+data;                            
                            }
                        },
                        {
                            data: 'payment_status',
                            name: 'transactions.payment_status'
                        }
                    ],
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                });

                // Event listener for search input
                $('#paymentTable_filter input').on('keyup', function() {
                    console.log('Search term:', $(this).val());
                });
            });
        </script>
    </section>
    <style>
        .table-responsive {
            overflow: hidden;
        }
        .payment-details{
            background-color: #FFF;
            padding: 25px 25px;
            border-radius: 10px;
        }
        .dataTables_length label, .dataTables_filter label{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dataTables_length select.custom-select.custom-select-sm.form-control.form-control-sm {
            margin: 7px;
        }
        /* Pagination styles */
        .dataTables_wrapper .dataTables_paginate {
            padding: 10px 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
           
           
            background: #f1f1f1; /* Default background */
            color: #333; /* Default text color */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #53B746; /* Active button color */
            color: white; /* Active text color */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #53B746; /* Hover color */
            color: white; /* Hover text color */
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 1px;
        }
        th.sorting {
            border-top: 1px solid;
        }
        a.overlay-link {
            font-weight: 600;
            float: inline-end;
        }
    </style>
@endsection
