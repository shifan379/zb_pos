<x-app-layout>
    @section('title', 'Dashboard')

    @push('css')
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <!-- Bootstrap Tagsinput CSS -->
        <link rel="stylesheet" href="{{ asset(path: 'assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
        <!-- Daterangepikcer CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">


        <style>
            /* sds */
        </style>
    @endpush

    @section('content')


        <div class="content">

            <div>
                <div class="page-header">
                    <div class="add-item d-flex">
                        <div class="page-title">
                            <h4>Supplier Report</h4>
                            <h6>View Reports of Supplier</h6>
                        </div>
                    </div>
                    <ul class="table-top-head">
                        <li class="me-2">
                            <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Refresh"><i class="ti ti-refresh"></i></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                    class="ti ti-chevron-up"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    @if (session('alert'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('alert') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body pb-1">
                        <form id="supplier-report-form" method="GET" action="{{ route('supplierReport.index') }}">
                            <input type="hidden" name="export" value="excel">
                            <div class="row align-items-end">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Choose Date</label>
                                                <input type="text" class="form-control date-range bookingrange"
                                                    name="date_range" value="{{ request('date_range') }}"
                                                    placeholder="dd/mm/yyyy - dd/mm/yyyy">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Supplier</label>
                                                <select class="form-select" name="supplier_id">
                                                    <option value="all">All</option>
                                                    @foreach ($allSuppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                            {{ $supplier->company_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100" type="submit">Generate Report</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('supplier-report-form').addEventListener('submit', function(e) {
                                const dateInput = document.querySelector('input[name="date_range"]');
                                if (!dateInput.value) {
                                    e.preventDefault(); // stop form submission
                                    alert('Please select the date for filter');
                                }
                            });
                        </script>


                    </div>
                </div>

                <div class="card no-search">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <div>
                            <h4>Supplier Report</h4>
                        </div>
                        {{-- <ul class="table-top-head">
                            <li class="me-2">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li class="me-2">
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                        src="assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
                                        class="ti ti-printer"></i></a>
                            </li>
                        </ul> --}}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Reference</th>
                                            <th>ID</th>
                                            <th>Supplier</th>
                                            <th>Total Items</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $supplier)
                                            <tr>
                                                <td><a href="#">{{ $supplier['reference'] }}</a></td>
                                                <td>{{ $supplier['supplier_code'] }}</td>
                                                <td>
                                                    @php
                                                        $image = $supplier['image'];
                                                        $imageUrl = !empty($image)
                                                            ? $image
                                                            : asset('assets/img/products/istockphoto.png');
                                                    @endphp
                                                    <div class="d-flex align-items-center">

                                                        <a href="#" class="avatar avatar-md me-2">
                                                            <img src="{{ url($imageUrl) }}" alt="product">
                                                            {{-- <img src="{{ asset('storage/suppliers/' . $image) }}"
                                                                    alt="Img"> --}}
                                                        </a>

                                                        <h6 class="fw-medium"><a href="#">{{ $supplier['name'] }}</a>
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td>{{ $supplier['total_items'] }}</td>
                                                <td>${{ number_format($supplier['amount'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="bg-light fw-bold p-3 fs-16" colspan="4">Total</td>
                                            <td class="bg-light fw-bold p-3 fs-16">${{ number_format($grandTotal, 2) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /product list -->
            </div>
        </div>


    @endsection



    @push('js')
        <!-- Select2 JS -->
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap Tagsinput JS -->
        <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}" type="text/javascript"></script>

        <!-- Datetimepicker JS -->
        <script src="{{ asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <!-- Daterangepikcer JS -->
        <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>

        <script>
            $(function() {
                $('.bookingrange').daterangepicker({
                    opens: 'left',
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
                    autoUpdateInput: false
                });


                // When user applies date, set input value
                $('.bookingrange').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(
                        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
                    );
                });

                // Optional: clear input when cancelled
                $('.bookingrange').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });
        </script>
    @endpush
</x-app-layout>
