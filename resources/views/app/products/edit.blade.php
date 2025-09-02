<x-app-layout>
    @section('title', 'Dashboard')

    @push('css')
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
        <!-- Summernote CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
        <!-- Bootstrap Tagsinput CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
        <!-- Product create CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/product-create.css') }}">
    @endpush

    @section('content')
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4 class="fw-bold">Create Product</h4>
                        <h6>Create new product</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                                class="ti ti-refresh"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                class="ti ti-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn mt-0">
                    <a href="{{ route('product.index') }}" class="btn btn-secondary"><i data-feather="arrow-left"
                            class="me-2"></i>Back to Product</a>
                </div>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="POST" class="add-product-form"
                enctype="multipart/form-data">
                @csrf
                <div class="add-product">
                    <div class="accordions-items-seperate" id="accordionSpacingExample">
                        <div class="accordion-item border mb-4">
                            <h2 class="accordion-header" id="headingSpacingOne">
                                <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                    data-bs-target="#SpacingOne" aria-expanded="true" aria-controls="SpacingOne">
                                    <div class="d-flex align-items-center justify-content-between flex-fill">
                                        <h5 class="d-flex align-items-center"><i data-feather="info"
                                                class="text-primary me-2"></i><span>Product Information</span></h5>
                                    </div>
                                </div>
                            </h2>
                            <div id="SpacingOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingSpacingOne">
                                <div class="accordion-body border-top">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="mb-3 list position-relative">
                                                <label class="form-label">Item Barcode<span
                                                        class="text-danger ms-1">*</span></label>
                                                <input type="text" readonly
                                                    value="{{ old('item_code', $product->item_code ?? '') }}"
                                                    name="item_code" required class="form-control list item_code">

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Product Name<span
                                                        class="text-danger ms-1">*</span></label>
                                                <input name="product_name"
                                                    value="{{ old('product_name', $product->product_name ?? '') }}" required
                                                    id="product_name" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Using for websites --}}
                                    <div class="row">
                                        {{-- <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Slug</label>
                                                <input name="slug" value="{{ old('slug', $product->slug ?? '') }}"
                                                    type="text" class="form-control">
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                <div class="add-newplus">
                                                    <label class="form-label">Brand</label>
                                                </div>
                                                <select name="brand" class="form-select">
                                                    <option value="" disabled
                                                        {{ old('brand', $product->brand ?? '') ? '' : 'selected' }}>Select
                                                    </option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ old('brand', $product->brand ?? '') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Using for websites --}}
                                    <div class="row">

                                        <div class="col-sm-6 col-12">
                                            <div class="mb-3">
                                                @php
                                                    $sellingTypes = ['Online', 'POS'];
                                                @endphp
                                                <label class="form-label">Selling Type</label>
                                                <select name="selling_type" class="form-select">
                                                    <option disabled value="">Select</option>
                                                    @foreach ($sellingTypes as $sellingType)
                                                        <option @if ($product->selling_type == $sellingType) selected @endif
                                                            value="{{ $sellingType }}">{{ $sellingType }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="addservice-info">
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <div class="add-newplus">
                                                        <label class="form-label">Category</label>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#add-product-category"><i
                                                                data-feather="plus-circle"
                                                                class="plus-down-add"></i><span>Add
                                                                New</span></a>
                                                    </div>
                                                    <select name="category" id="categorySelect" class="form-select">
                                                        <option value="" disabled selected>Select Category</option>
                                                        @forelse ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                @if ($category->id == $product->category) selected @endif>
                                                                {{ $category->category }}
                                                            </option>
                                                        @empty
                                                            <option value="" disabled>No data available. Please add a
                                                                new category.</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sub Category</label>
                                                    <select name="sub_category" id="subCategorySelect"
                                                        class="form-select">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-product-new">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <div class="mb-3">
                                                        <div class="add-newplus">
                                                            <label class="form-label">Unit</label>
                                                        </div>
                                                        <select name="unit" class="form-select">
                                                            <option value="" disabled selected>Select Unit</option>
                                                            @forelse ($units as $unit)
                                                                <option value="{{ $unit->name }}"
                                                                    @if ($product->unit == $unit->name) selected @endif>
                                                                    {{ $unit->name }}</option>
                                                            @empty
                                                                <option value="" disabled>No data available. Please
                                                                    add a new unit.</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Loaction</label>
                                                        <select name="location" class="form-select">
                                                            <option disabled selected value="">Select Loaction
                                                            </option>
                                                            @forelse ($locations as $location)
                                                                <option value="{{ $location->id }} "
                                                                    @if ($location->id == $product->location) selected @endif>
                                                                    {{ $location->name }}</option>
                                                            @empty
                                                                <option value="" disabled>No data available. Please
                                                                    add a new location.</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Editor -->
                                        {{-- <div class="col-lg-12">
											<div class="summer-description-box">
												<label class="form-label">Description</label>
												<div id="summernote"></div>
												<p class="fs-14 mt-1">Maximum 60 Words</p>
											</div>
										</div> --}}
                                        <!-- /Editor -->
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border mb-4">
                                <h2 class="accordion-header" id="headingSpacingTwo">
                                    <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                        data-bs-target="#SpacingTwo" aria-expanded="true" aria-controls="SpacingTwo">
                                        <div class="d-flex align-items-center justify-content-between flex-fill">
                                            <h5 class="d-flex align-items-center"><i data-feather="life-buoy"
                                                    class="text-primary me-2"></i><span>Pricing & Stocks</span></h5>
                                        </div>
                                    </div>
                                </h2>
                                <div id="SpacingTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingSpacingTwo">
                                    <div class="accordion-body border-top">
                                        <div class="mb-3s">
                                            <label class="form-label">Product Type<span
                                                    class="text-danger ms-1">*</span></label>
                                            <div class="single-pill-product mb-3">
                                                <ul class="nav nav-pills" id="pills-tab1" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <span class="custom_radio me-4 mb-0  active " id="pills-home-tab"
                                                            data-bs-toggle="pill" data-bs-target="#pills-home"
                                                            role="tab" aria-controls="pills-home"
                                                            aria-selected="true">
                                                            <input type="radio" class="form-control"
                                                                name="single_product" value="1">
                                                            <span class="checkmark"></span> Single Product</span>
                                                    </li>
                                                    {{-- <li class="nav-item" role="presentation">
                                                            <span  class="custom_radio me-2 mb-0 @if (isset($product->product_type) && $product->product_type == 0)  active @endif" id="pills-profile-tab" data-bs-toggle="pill"
                                                            data-bs-target="#pills-profile"  role="tab" aria-controls="pills-profile" aria-selected="false">
                                                            <input type="radio" class="form-control" name="single_product" value="0">
                                                            <span class="checkmark"></span> Variable Product</span>
                                                        </li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade   show active  " id="pills-home" role="tabpanel"
                                                aria-labelledby="pills-home-tab">
                                                <div class="single-product">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Quantity</label>
                                                                <input name="quantity"
                                                                    value="{{ old('quantity', $product->quantity ?? '') }}"
                                                                    type="number" class="form-control quantity">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Buying Price<span
                                                                        class="text-danger ms-1">*</span></label>
                                                                <input type="number" min="1"
                                                                    value="{{ old('buying_price', $product->buying_price ?? '') }}"
                                                                    step="00.1" name="buying_price" required
                                                                    class="form-control buying_price">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Selling Price<span
                                                                        class="text-danger ms-1">*</span></label>
                                                                <input type="number" min="1" step="00.1"
                                                                    value="{{ old('selling_price', $product->selling_price ?? '') }}"
                                                                    name="selling_price" required
                                                                    class="form-control selling_price">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Stock Value</label>
                                                                <input type="number" readonly
                                                                    class="form-control stock_value">
                                                            </div>
                                                        </div>
                                                        {{-- Tax Field for  --}}
                                                        {{-- <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tax Type<span class="text-danger ms-1">*</span></label>
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Exclusive</option>
                                                                        <option>Inclusive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-6 col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tax<span class="text-danger ms-1">*</span></label>
                                                                    <select class="select">
                                                                        <option>Select</option>
                                                                        <option>IGST (8%)</option>
                                                                        <option>GST (5%)</option>
                                                                        <option>SGST (4%)</option>
                                                                        <option>CGST (16%)</option>
                                                                    <option>Gst 18%</option>
                                                                </select>
                                                            </div>
                                                        </div> --}}


                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Discount Amount</label>
                                                                <div class="discount-input me-2">
                                                                    <input type="number"
                                                                        value="{{ old('discount_amount', $product->discount_amount ?? '') }}"
                                                                        name="discount_amount" class="discount_amount"
                                                                        min="0" placeholder="Rs" step="0.01">
                                                                    <span>Rs</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Discount Percent</label>
                                                                <div class="discount-input me-2">
                                                                    <input type="number"
                                                                        value="{{ old('discount_percentage', $product->discount_percentage ?? '') }}"
                                                                        name="discount_percentage"
                                                                        class="discount_percent " min="0"
                                                                        step="0.01" placeholder="%">
                                                                    <span>%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Quantity Alert</label>
                                                                <input type="text" name="quantity_alert"
                                                                    value="{{ old('quantity_alert', $product->quantity_alert ?? '') }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12">
                                                            <div class="mb-3 list position-relative">
                                                                <label class="form-label">Mark</label>
                                                                <input type="text" name="mark"
                                                                    value="{{ old('mark', $product->mark ?? '') }}"
                                                                    class="form-control list">
                                                                <button type="button" id="markAdd"
                                                                    class="btn btn-primaryadd">
                                                                    Generate
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-lg-12 col-sm-6 col-12 p-3 bg-light rounded d-flex align-items-center border mb-3">
                                                            <div class=" d-flex align-items-center">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="wholesale" value="option1">
                                                                    <label class="form-check-label"
                                                                        for="wholesale">Wholesale Price</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="online" value="option2">
                                                                    <label class="form-check-label" for="online">Online
                                                                        Price</label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4 col-sm-6 col-12 wholesale_price ">
                                                            <div class="mb-3">
                                                                <label class="form-label">Wholesale Price<span
                                                                        class="text-danger ms-1">*</span></label>
                                                                <input type="number" min="0" step="00.1"
                                                                    value="{{ old('wholesale_price', $product->wholesale_price ?? '') }}"
                                                                    name="wholesale_price" class="form-control ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 col-12 online_price">
                                                            <div class="mb-3">
                                                                <label class="form-label">Online Price<span
                                                                        class="text-danger ms-1">*</span></label>
                                                                <input type="number" min="0" step="00.1"
                                                                    value="{{ old('online_price', $product->online_price ?? '') }}"
                                                                    name="online_price" class="form-control ">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="tab-pane fade   " id="pills-profile" role="tabpanel"
                                                    aria-labelledby="pills-profile-tab">
                                                    <div class="row select-color-add">
                                                        <div class="col-lg-6 col-sm-6 col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Variant Attribute <span class="text-danger ms-1">*</span></label>
                                                                <div class="row">
                                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                                        <select class="form-control variant-select select-option variantSelect" id="colorSelect">
                                                                            <option value="" disabled selected>Choose Variant Attribute</option>
                                                                            @forelse ($variants as $variant )
                                                                                <option data-attribute="{{ $variant->id }}" value="{{ $variant->name }}">{{ $variant->name }}</option>
                                                                            @empty
                                                                                <option value="" disabled>No data available. Please add a new attribute.</option>
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                                                        <div class="add-icon tab">
                                                                            <a class="btn btn-filter" data-bs-toggle="modal" data-bs-target="#add-variant"><i class="feather feather-plus-circle"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="selected-hide-color" id="input-show">
                                                                <label class="form-label">Variant Attribute <span class="text-danger ms-1">*</span></label>
                                                                <div class="row align-items-center" >
                                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                                        <div class="mb-3">
                                                                            <input class="input-tags form-control" id="inputBox" readonly type="text" data-role="tagsinput"  name="specialist" >
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="modal-body-table border" id="variant-table">
                                                    <div class="table-responsive">
                                                        <table class="table border">
                                                            <thead>
                                                                <tr>
                                                                    <th>Value</th>
                                                                    <th>Quantity</th>
                                                                    <th>Buying Price (Rs)</th>
                                                                    <th>Selling Price (Rs)</th>
                                                                    <th>Discount %</th>
                                                                    <th>Discount Rs</th>
                                                                    <th>Mark Number</th>
                                                                    <th class="no-sort"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border mb-4">
                                <h2 class="accordion-header" id="headingSpacingThree">
                                    <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                        data-bs-target="#SpacingThree" aria-expanded="true" aria-controls="SpacingThree">
                                        <div class="d-flex align-items-center justify-content-between flex-fill">
                                            <h5 class="d-flex align-items-center"><i data-feather="image"
                                                    class="text-primary me-2"></i><span>Images</span></h5>
                                        </div>
                                    </div>
                                </h2>
                                <div id="SpacingThree"
                                    class="accordion-collapse collapse @if (isset($product->images)) show @endif "
                                    aria-labelledby="headingSpacingThree">
                                    <div class="accordion-body border-top">
                                        <div class="text-editor add-list add">
                                            <div class="col-lg-12">
                                                <div class="mb-3 list position-relative">
                                                    <p>
                                                        <!-- ZB AI Image Generation Info -->
                                                    <div class="alert alert-info d-flex align-items-center"
                                                        role="alert">
                                                        <i data-feather="zap" class="me-2"></i>
                                                        <div>
                                                            <strong>ZB AI:</strong> Struggling to upload images one by one?
                                                            Try our super solution! Click <b>Generate AI</b> and let ZB AI
                                                            create images similar to your item details. See the magic
                                                            happen!
                                                        </div>
                                                    </div>
                                                    </p>

                                                    <button type="button" id="generateAiBtn" class="btn btn-primary">
                                                        Generate AI
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="add-choosen d-flex align-items-center">
                                                    <div class="image-upload image-upload-two"
                                                        style="position:relative; display:inline-block; margin:5px;">
                                                        <input type="file" name="images[]"
                                                            accept=".jpg, .jpeg, .png, .gif, .webp" multiple>
                                                        <div class="image-uploads" style="cursor:pointer;">
                                                            <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                                            <h4>Add Images</h4>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $images = $product->images
                                                            ? json_decode($product->images, true)
                                                            : [];
                                                    @endphp
                                                    <div class="preview-images d-flex align-items-center">
                                                        @if (!empty($images))
                                                            @foreach ($images as $img)
                                                                <div class="phone-img uploaded"
                                                                    style="position:relative; display:inline-block; margin:5px;">
                                                                    <img src="{{ $img }}" alt="image"
                                                                        style="max-width:110px; max-height:110px; border-radius:8px; box-shadow:0 2px 8px #eee;">
                                                                    <a href="javascript:void(0);" class="remove-product"
                                                                        style="position:absolute;top:5px;right:5px;">
                                                                        <span
                                                                            style="background:#f33;color:#fff;border-radius:50%;padding:2px 6px;font-weight:bold;font-size:16px;line-height:1;">×</span>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border mb-4">
                                <h2 class="accordion-header" id="headingSpacingFour">
                                    <div class="accordion-button collapsed bg-white" data-bs-toggle="collapse"
                                        data-bs-target="#SpacingFour" aria-expanded="true" aria-controls="SpacingFour">
                                        <div class="d-flex align-items-center justify-content-between flex-fill">
                                            <h5 class="d-flex align-items-center"><i data-feather="list"
                                                    class="text-primary me-2"></i><span>Custom Fields</span></h5>
                                        </div>
                                    </div>
                                </h2>
                                <div id="SpacingFour"
                                    class="accordion-collapse collapse @if (isset($product->manufacturer) || isset($product->expiry_date) || isset($product->manufacturer_date)) show @endif "
                                    aria-labelledby="headingSpacingFour">
                                    <div class="accordion-body border-top">
                                        <div>
                                            <div class="p-3 bg-light rounded d-flex align-items-center border mb-3">
                                                <div class=" d-flex align-items-center">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input"
                                                            @if (isset($product->serial_number1)) checked @endif
                                                            type="checkbox" id="warranties" value="option1">
                                                        <label class="form-check-label"
                                                            for="warranties">Warranties</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input"
                                                            @if (isset($product->manufacturer_date)) checked @endif
                                                            type="checkbox" id="manufacturer" value="option2">
                                                        <label class="form-check-label"
                                                            for="manufacturer">Manufacturer</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input"
                                                            @if (isset($product->expiry_date)) checked @endif
                                                            type="checkbox" id="expiry" value="option2">
                                                        <label class="form-check-label" for="expiry">Expiry</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            @if (isset($product->free_service_count)) checked @endif
                                                            id="services" value="option4">
                                                        <label class="form-check-label" for="services">Services</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-12 warranties">
                                                    <div class="mb-3 add-product">
                                                        <label class="form-label">Serial Number 1</label>
                                                        <input name="serial_number1"
                                                            value="{{ old('serial_number1', $product->serial_number1 ?? '') }}"
                                                            type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12 warranties">
                                                    <div class="mb-3 add-product">
                                                        <label class="form-label">Serial Number 2</label>
                                                        <input name="serial_number2"
                                                            value="{{ old('serial_number1', $product->serial_number2 ?? '') }}"
                                                            type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12 warranties">
                                                    <div class="mb-3">
                                                        <label class="form-label">Warranty</label>
                                                        <select class="form-select" name="warranty">
                                                            <option value="" disabled selected> Select</option>
                                                            @forelse ($warrentys as $warrenty)
                                                                <option @if ($product->warranty == $warrenty->id) selected @endif
                                                                    value="{{ $warrenty->id }}">{{ $warrenty->warranty }}
                                                                    - {{ $warrenty->duration }} {{ $warrenty->period }}
                                                                </option>
                                                            @empty
                                                                <option>Empty</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-12 manufacturer">
                                                    <div class="mb-3">
                                                        <label class="form-label">Manufactured Date<span
                                                                class="text-danger ms-1">*</span></label>

                                                        <div class="input-groupicon calender-input">
                                                            <i data-feather="calendar" class="info-img"></i>
                                                            <input type="text"
                                                                value="{{ old('manufacturer_date', $product->manufacturer_date ?? '') }}"
                                                                name="manufacturer_date"
                                                                class="datetimepicker form-control"
                                                                placeholder="dd/mm/yyyy">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12 expiry_date">
                                                    <div class="mb-3">
                                                        <label class="form-label">Expiry On<span
                                                                class="text-danger ms-1">*</span></label>

                                                        <div class="input-groupicon calender-input">
                                                            <i data-feather="calendar" class="info-img"></i>
                                                            <input name="expiry_date"
                                                                value="{{ old('expiry_date', $product->expiry_date ?? '') }}"
                                                                type="text" class="datetimepicker form-control"
                                                                placeholder="dd/mm/yyyy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-12 services">
                                                    <div class="mb-3">
                                                        <label class="form-label">Free Service Count<span
                                                                class="text-danger ms-1">*</span></label>

                                                        <div class="input-groupicon">
                                                            <input type="number"
                                                                value="{{ old('free_service_count', $product->free_service_count ?? '') }}"
                                                                name="free_service_count" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12 services">
                                                    <div class="mb-3">
                                                        <label class="form-label">Free Service Duration <span
                                                                class="text-danger ms-1">*</span></label>
                                                        <div class="input-groupicon calender-input">
                                                            <i data-feather="calendar" class="info-img"></i>
                                                            <input name="free_service_duration"
                                                                value="{{ old('free_service_duration', $product->free_service_duration ?? '') }}"
                                                                type="text" class=" form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <a href="{{ route('product.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" id="functionKey" class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
            </form>
        </div>

        {{-- model --}}
        <!-- Add Category -->
        <div class="modal fade" id="add-product-category">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add Category</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Category<span class="ms-1 text-danger">*</span></label>
                        <input name="category" id="category_name" required type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn me-2 btn-secondary fs-13 fw-medium p-2 px-3 shadow-none"
                            data-bs-dismiss="modal">Cancel</a>
                        <a href="javascript:void(0);" id="submitCategory"
                            class="btn btn-primary text-white fs-13 fw-medium p-2 px-3">Add Category</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Category -->

        <!-- Add Main Variant -->
        <div class="modal fade" id="add-variant">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add Variant</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Variant<span class="text-danger ms-1">*</span></label>
                                <input type="text" name="name" id="variant_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Values<span class="text-danger ms-1">*</span></label>
                                <input class="fs-14 bg-secondary-transparent" id="variant_value" type="text"
                                    data-role="tagsinput" name="values[]">
                                <span class="tag-text mt-2 d-flex">Enter value separated by comma</span>
                            </div>
                            <div class="mb-0 mt-4">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="checkbox" id="user2" class="check" name="status" checked="">
                                    <label for="user2" class="checktoggle"></label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0);" class="btn me-2 btn-secondary"
                                data-bs-dismiss="modal">Cancel</a>
                            <a href="javascript:void(0);" id="submitVariant" class="btn btn-primary">Add Variant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Main Variant -->

    @endsection





    @push('js')
        <script>
            window.variantData = @json($variants);
            const routes = {
                nextItemCode: @json(route('products.nextItemCode')),
                categoriesStore: @json(route('categories.store')),
                variantsStore: @json(route('variants.store')),
                subData: @json(route('get.sub.data')),
                generateAiImage: @json(route('products.generateAiImage')),

            };
            const csrfToken = '{{ csrf_token() }}';
        </script>

        <!-- Select2 JS -->
        <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap Tagsinput JS -->
        <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/js/product-create.js') }}" type="text/javascript"></script>
    @endpush
</x-app-layout>
