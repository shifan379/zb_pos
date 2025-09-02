<x-app-layout>
    @section('title', 'Edit Role Permissions')

    @push('css')
        <style>
            .permission-card {
                background: #fff;
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .module-header {
                font-weight: 600;
                font-size: 16px;
                margin-bottom: 15px;
                border-bottom: 1px solid #eee;
                padding-bottom: 8px;
            }

            .permission-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
            }

            .form-switch .form-check-input {
                width: 2.5em;
                height: 1.3em;
            }
        </style>
    @endpush

    @section('content')
        <div class="content">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div class="page-title">
                    <h4 class="fw-bold">Edit Permissions for Role: <span class="text-primary">{{ $role->name }}</span></h4>
                    <p class="text-muted mb-0">Select which permissions should be assigned to this role</p>
                </div>
                <div class="page-btn">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-primary">
                        <i data-feather="arrow-left" class="me-1"></i> Back
                    </a>
                </div>
            </div>

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($permissionGroups as $permissionGroup)
                    <div class="permission-card">
                        <div class="module-header">{{ $permissionGroup->name }}</div>
                        <div class="permission-grid">
                            @foreach ($permissionGroup->permissions as $permission)
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="permission_ids[]"
                                        value="{{ $permission->id }}" id="perm-{{ $permission->id }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm-{{ $permission->id }}"> &nbsp;
                                        {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="mt-4 mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4"> Save Changes</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
