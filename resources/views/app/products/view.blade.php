<x-app-layout>
    @section('title','Dashboard')

    @push('css')
    @endpush

    @section('content')
            <div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Product Details</h4>
							<h6>Full details of a product</h6>
						</div>
					</div>
					<!-- /add -->
					<div class="row">
						<div class="col-lg-8 col-sm-12">
							<div class="card">
								<div class="card-body">

									<div class="bar-code-view">
                                        @if ($product->item_code)

                                        {!! $generator->getBarcode($product->item_code, $generator::TYPE_CODE_128) !!}

                                        @else
                                            {{-- <img src="assets/img/barcode/barcode1.png" alt="barcode"> --}}
                                        @endif

										<a class="printimg">
											<img src="{{ asset('assets/img/icons/printer.svg') }}" alt="print">
										</a>
									</div>
									<div class="productdetails">
										<ul class="product-bar">
                                            <li>
												<h4>Item code</h4>
												<h6>{{$product->item_code }}</h6>
											</li>
											<li>
												<h4>Product</h4>
												<h6>{{ $product->product_name ?? '-' }}	</h6>
											</li>
											<li>
												<h4>Category</h4>
												<h6>{{ !empty($product->cate) ? $product->cate->category : '-'}}</h6>
											</li>
											<li>
												<h4>Sub Category</h4>
												<h6>{{ $product->sub_category ?? '-'}}</h6>
											</li>
											<li>
												<h4>Brand</h4>
												<h6>{{$product->brand ?? '-'}}</h6>
											</li>
											<li>
												<h4>Unit</h4>
												<h6>{{ $product->unit ?? '-'}}</h6>
											</li>

											<li>
												<h4>Minimum Qty</h4>
												<h6>{{ $product->quantity_alert ?? 0 }} </h6>
											</li>
											<li>
												<h4>Quantity</h4>
												<h6>{{$product->quantity ?? 0}}</h6>
											</li>
                                            <li>
												<h4>Buying Price</h4>
												<h6>Rs. {{ $product->buying_price ?? 0.00}}</h6>
											</li>
                                            <li>
												<h4>Selling Price</h4>
												<h6>Rs. {{ $product->selling_price ?? 0.00}}</h6>
											</li>
                                            <li>
												<h4>Average Cost</h4>
												<h6>Rs. {{ $product->average_cost_price ?? 0.00}}</h6>
											</li>
											<li>
												<h4>Discount Amount</h4>
												<h6>Rs. {{$product->discount_amount ?? 0.00}} </h6>
											</li>
											<li>
												<h4>Discount Percentage</h4>
												<h6>{{$product->discount_percentage ?? 0.00}}%</h6>
											</li>

                                            @if (isset($product->online_price))
                                                <li>
                                                    <h4>Online Price</h4>
                                                    <h6>{{ $product->online_price ?? 0.00 }}</h6>
                                                </li>
                                            @endif
                                            @if (isset($product->wholesale_price))
                                                <li>
                                                    <h4>Wholesale Price</h4>
                                                    <h6>{{ $product->wholesale_price ?? 0.00 }}</h6>
                                                </li>
                                            @endif



										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="slider-product-details">
										@php
                                            $images = $product->images ? json_decode($product->images, true) : [];
                                        @endphp
                                        <div class="owl-carousel owl-theme product-slide">
                                            @if(!empty($images))
                                                @foreach($images as $img)
                                                    <div class="slider-product">
                                                        <img src="{{ $img }}" alt="img">
                                                        <h4>{{  basename(parse_url($img, PHP_URL_PATH)) }}</h4>
                                                        {{-- Optionally, you can get file size if stored, or leave blank --}}
                                                        <h6></h6>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="slider-product">
                                                    <img src="{{ asset('assets/img/products/istockphoto.png') }}" alt="img">
                                                    <h4>No Image</h4>
                                                    <h6></h6>
                                                </div>
                                            @endif
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- /add -->
				</div>

    @endsection





    @push('js')

                <!-- Owl JS -->
		<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}" type="text/javascript"></script>


    @endpush
</x-app-layout>
