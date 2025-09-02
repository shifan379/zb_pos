<x-app-layout>
    @section('title', 'Income')

    @push('css')
        <style>
            /* Custom styling if needed */
        </style>
    @endpush

    @section('content')

        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Income</h4>
                        <h6>Manage Your Income</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    {{-- <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg"
                                alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                src="assets/img/icons/excel.svg" alt="img"></a>
                    </li> --}}
                    <li>
                        <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                                class="ti ti-refresh"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                class="ti ti-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-income"><i
                            class="ti ti-circle-plus me-1"></i>Add Income</a>
                </div>
            </div>

            <!-- Income List -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
                            <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        </div>
                    </div>
                    <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                        <div class="dropdown me-2">
                            <a href="javascript:void(0);"
                                class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                Category
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Salary</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Product Sales</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Investment</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0);"
                                class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                Status
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Approved</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item rounded-1">Pending</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="no-sort">
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Reference</th>
                                    <th>Income Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody class="income-list-blk">
                                @foreach ($incomes as $income)
                                    {{-- Only show if date exists --}}
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>INC00{{ $income->id }}</td> {{-- Or use any code like IN{{ $income->id }} --}}
                                        <td class="text-gray-9 p-2">
                                            {!! !empty($income->reason) ? $income->reason : 'Sales Income' !!}</td>
                                        <td>{{ \Carbon\Carbon::parse($income->date)->format('d M Y') ??  $income->created_at->format('d M Y') }}</td>
                                        <td>Rs.{{ number_format($income->amount, 2) }}</td>
                                        <td class="action-table-data p-2">
                                            <div class="edit-delete-action">
                                                @if (!empty($income->reason))
                                                    <!-- Only show edit button if it's income -->
                                                    <a class="me-2 p-2 mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#edit-income-{{ $income->id }}">
                                                        <i data-feather="edit"></i>
                                                    </a>

                                                    <a class="me-2 p-2 mb-0" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal-{{ $income->id }}">
                                                        <i data-feather="trash-2"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /Income List -->
        </div>

        <!-- Add Income Modal -->

        <div class="modal fade" id="add-income">
            <div class="modal-dialog modal-m modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-header text-white">
                        <h5 class="modal-title">Add Income</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <form action="{{ route('incomes.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Income Name <span class="text-danger">*</span></label>
                                    <input type="text" name="income_name" class="form-control"
                                        placeholder="Enter income name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" class="form-control" placeholder="Enter amount">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Add Income</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Income Modal -->

        <!-- Edit Income Modal -->
        @foreach ($incomes as $income)
            @if ($income->name == 'payin')
                <!-- Only for editable incomes -->
                <div class="modal fade" id="edit-income-{{ $income->id }}">
                    <div class="modal-dialog modal-m modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-3">
                            <div class="modal-header text-dark">
                                <h5 class="modal-title">Edit Income</h5>
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <form action="{{ route('incomes.update', $income->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Income Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="income_name" class="form-control"
                                                value="{{ $income->reason }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="amount" class="form-control"
                                                value="{{ $income->amount }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" class="form-control"
                                                value="{{ $income->date }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- /Edit Income Modal -->

        @foreach ($incomes as $income)
            <!-- Delete Modal -->
            <div class="modal fade" id="delete-modal-{{ $income->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('incomes.destroy', $income->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="page-wrapper-new p-0">
                                <div class="content p-5 px-3 text-center">
                                    <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2">
                                        <i class="ti ti-trash fs-24 text-danger"></i>
                                    </span>
                                    <h4 class="fs-20 fw-bold mb-2 mt-1">Delete Income</h4>
                                    <p class="mb-0 fs-16">
                                        Are you sure you want to delete this
                                        <b style="color: red">{{ $income->reason }}</b> income?
                                    </p>
                                    <div class="modal-footer-btn mt-3 d-flex justify-content-center">
                                        <button type="button"
                                            class="btn me-2 btn-secondary fs-13 fw-medium p-2 px-3 shadow-none"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary fs-13 fw-medium p-2 px-3">
                                            Yes Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach


    @endsection

    @push('js')
    @endpush
</x-app-layout>
