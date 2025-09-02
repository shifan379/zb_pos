@forelse ($categories as $category)
    <tr>
        <td>
            <label class="checkboxs">
                <input type="checkbox">
                <span class="checkmarks"></span>
            </label>
        </td>
         @php
            $images = $category->images  ;
            $imageUrl = !empty($images) ? $images : asset('assets/img/products/istockphoto.png');
        @endphp
        <td>
            <a class="avatar avatar-md me-2">
                <img src="{{ url($imageUrl) }}" alt="product">
            </a>
        </td>
        <td><span class="text-gray-9">{{ $category->category }}</span></td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->created_at }}</td>
        <td>
             <span class="badge table-badge  {{ $category->status == 1 ? 'bg-success' : 'bg-info' }} fw-medium fs-10">
                {{ $category->status == 1 ? 'Active' : 'Deactivate' }}
            </span>
        </td>
        <td class="action-table-data">
            <div class="edit-delete-action">
                <a class="me-2 p-2 edit-category-btn" href="javascript:void(0);" data-id="{{ $category->id }}"
                    data-image="{{ $imageUrl }}" data-name="{{ $category->category }}" data-slug="{{ $category->slug }}"
                    data-status="{{ $category->status }}" data-bs-toggle="modal" data-bs-target ="#edit-category">
                    <i data-feather="edit" class="feather-edit"></i>
                </a>
                <a data-bs-toggle="modal" class="delete-product-btn" data-id="{{ $category->id }}"
                    data-bs-target="#delete-modal" class="p-2" href="javascript:void(0);">
                    <i data-feather="trash-2" class="feather-trash-2"></i>
                </a>
            </div>

        </td>
    </tr>
@empty
@endforelse
