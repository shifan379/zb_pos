<x-app-layout>
    @section('title', 'Dashboard')

    @push('css')
        <style>
            /* sds */
        </style>
    @endpush

    @section('content')

        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Users</h4>
                        <h6>Manage your users</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="assets/img/icons/pdf.svg"
                                alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                src="assets/img/icons/excel.svg" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                                class="ti ti-refresh"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                class="ti ti-chevron-up"></i></a>
                    </li>
                </ul>
                @can('User Management Create')
                    <div class="page-btn">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user"><i
                                class="ti ti-circle-plus me-1"></i>Add User</a>
                    </div>
                @endcan

            </div>


            <!-- /product list -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                    <div class="search-set">
                        <div class="search-input">
                            <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                        </div>
                    </div>
                    <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">

                        <div class="dropdown">
                            <a href="javascript:void(0);"
                                class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center"
                                data-bs-toggle="dropdown">
                                Status
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-3">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Active</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Inactive</a>
                                </li>

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
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="no-sort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{-- <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('assets/img/users/default.png') }}"
                                                        alt="user">
                                                </a> --}}
                                                <a href="javascript:void(0);">{{ $user->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->userRole->name ?? '-' }}</td>

                                        {{-- <td>{{ $user->roles->pluck('name')->first() ?? '-' }}</td> --}}

                                        <td>
                                            @if ($user->status)
                                                <span
                                                    class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10">
                                                    <i class="ti ti-point-filled me-1 fs-11"></i>Active
                                                </span>
                                            @else
                                                <span
                                                    class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10">
                                                    <i class="ti ti-point-filled me-1 fs-11"></i>Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                @can('User Management Edit')
                                                    <a href="{{ route('users-permissions') }}" class="me-2 p-2 mb-0"
                                                        href="javascript:void(0);" title="View">
                                                        <i data-feather="shield" class="action-eye"></i>
                                                    </a>
                                                @endcan

                                                {{-- <a class="me-2 p-2 mb-0" data-bs-toggle="modal"
                                                    data-bs-target="#edit-user-{{ $user->id }}" title="Edit">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a> --}}

                                                @can('User Management Delete')
                                                    <a data-bs-toggle="modal" data-bs-target="#delete-user"
                                                        class="p-2 deleteUserBtn" data-id="{{ $user->id }}"
                                                        href="javascript:void(0);">
                                                        <i data-feather="trash-2" class="feather-trash-2"></i>
                                                    </a>
                                                @endcan


                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /product list -->
        </div>



        <!-- Add User -->
        <div class="modal fade" id="add-user">
            <div class="modal-dialog modal-sm modal-dialog-centered"><!-- smaller modal -->
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span> </button>
                    </div>

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="modal-body p-3">

                            {{-- User Name --}}
                            <div class="mb-2">
                                <label class="form-label">User Email <span class="text-danger">*</span></label>
                                <select name="user_id" id="employeeSelect" class="form-select form-select-sm">
                                    <option value="" disabled selected>Select Employee</option>
                                    @if ($users->count() > 0)
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->email }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No employees available</option>
                                    @endif

                                </select>
                            </div>

                            {{-- Role --}}
                            <div class="mb-2">
                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role_id" class="form-select form-select-sm">
                                    <option value="" disabled selected>Select Role</option>
                                    @if ($roles->count() > 0)
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No roles available</option>

                                    @endif

                                </select>
                            </div>

                            {{-- Status --}}
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="small">Status</span>
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="status" class="form-check-input" id="statusSwitch"
                                        checked>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer"> <button type="button" class="btn me-2 btn-secondary"
                                data-bs-dismiss="modal">Cancel</button> <button type="submit"
                                class="btn btn-primary">Create User</button> </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- /Add User -->

        <!-- Edit User -->
        <div class="modal fade" id="edit-user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="page-wrapper-new p-0">
                        <div class="content">
                            <div class="modal-header">
                                <div class="page-title">
                                    <h4>Edit User</h4>
                                </div>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="https://dreamspos.dreamstechnologies.com/html/template/users.html">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="new-employee-field">
                                                <div class="profile-pic-upload image-field">
                                                    <div class="profile-pic p-2">
                                                        <img src="assets/img/users/user-49.png"
                                                            class="object-fit-cover h-100 rounded-1" alt="user">
                                                        <button type="button" class="close rounded-1">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="image-upload mb-0">
                                                            <input type="file">
                                                            <div class="image-uploads">
                                                                <h4>Change Image</h4>
                                                            </div>
                                                        </div>
                                                        <p class="mt-2">JPEG, PNG up to 2 MB</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">User<span
                                                        class="text-danger ms-1">*</span></label>
                                                <input type="text" class="form-control" value="Henry Bryant">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Role<span
                                                        class="text-danger ms-1">*</span></label>
                                                <select class="form-select">
                                                    <option>Admin</option>
                                                    <option>Manager</option>
                                                    <option>Salesman</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Email<span
                                                        class="text-danger ms-1">*</span></label>
                                                <input type="email" class="form-control" value="henry@example.com">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Phone<span
                                                        class="text-danger ms-1">*</span></label>
                                                <input type="tel" class="form-control" value="+12498345785">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password<span
                                                        class="text-danger ms-1">*</span></label>
                                                <div class="pass-group">
                                                    <input type="password" class="pass-input form-control"
                                                        value="********">
                                                    <i class="ti ti-eye-off toggle-password"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password<span
                                                        class="text-danger ms-1">*</span></label>
                                                <div class="pass-group">
                                                    <input type="password" class="pass-input form-control"
                                                        value="********">
                                                    <i class="ti ti-eye-off toggle-password"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div
                                                class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                                <span class="status-label">Status</span>
                                                <input type="checkbox" id="user2" class="check" checked="">
                                                <label for="user2" class="checktoggle"> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn me-2 btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit User -->


        <!-- delete modal -->
        <div class="modal fade" id="delete-user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="page-wrapper-new p-0">
                        <form method="POST" id="deleteUserForm">
                            @csrf
                            @method('DELETE')

                            <div class="content p-5 px-3 text-center">
                                <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2">
                                    <i class="ti ti-trash fs-24 text-danger"></i>
                                </span>
                                <h4 class="fs-20 fw-bold mb-2 mt-1">Delete User</h4>
                                <p class="mb-0 fs-16">Are you sure you want to delete this user?</p>

                                <div class="modal-footer-btn mt-3 d-flex justify-content-center">
                                    <button type="button"
                                        class="btn me-2 btn-secondary fs-13 fw-medium p-2 px-3 shadow-none"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary fs-13 fw-medium p-2 px-3">
                                        Yes, Delete
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    @endsection


    @push('js')
        <script>
            $(document).on('click', '.deleteUserBtn', function() {
                var userId = $(this).data('id');
                var deleteUrl = "{{ route('users.destroy', ':id') }}".replace(':id', userId);
                $('#deleteUserForm').attr('action', deleteUrl);
            });
        </script>
    @endpush
</x-app-layout>
