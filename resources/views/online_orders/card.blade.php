 @forelse ($carts as $cart)
     @php
         $priceToShow = $cart->product->selling_price; // default retail
         if ($cart->sales_type == 'wholesale') {
             $priceToShow = $cart->product->wholesale_price ?? $priceToShow;
         } elseif ($cart->sales_type == 'online') {
             $priceToShow = $cart->product->online_price ?? $priceToShow;
         }
     @endphp
     <tr class="align-items-center" data-order-id="{{ $cart->order_id }}" data-product-id="{{ $cart->product_id }}"
         data-product-name="{{ $cart->product->product_name }}" data-product-price="{{ $priceToShow }}"
         data-discount="{{ $cart->discount }}" data-net-price="{{ $cart->net_price }}" data-qty= "{{ $cart->quantity }}"
         data-discount-type="{{ $cart->discount_type }}">
         {{-- Product Name --}}



         <td>

             <div class="d-flex align-items-center mb-1 product-info">
                 <input type="hidden" name="order_id" class="classorderID" value="{{ $cart->order_id }}">
                 <h6 class="fs-16 fw-medium"><a href="#">{{ $cart->product->product_name }}</a></h6>
                 <a href="#" class="ms-2 edit-icon editCart" data-bs-toggle="modal"
                     data-bs-target="#edit-product"><i class="ti ti-edit"></i></a>

             </div>
             <div class="info">
                 @if ($cart->product->variantion_name)
                     <span class=" text-dark">{{ $cart->product->variantion_name }} :
                         {{ $cart->product->variantion_value }}</span> <br>
                 @endif

                 @if ($cart->return == 1)
                     <span class="badge bg-danger text-dark ms-1">Return</span>
                 @endif
                 <span>{{ $cart->product->item_code }}</span>

                 {{-- <p class="fw-bold text-teal">Rs. {{ $cart->product->selling_price }}</p> --}}
                 <p class="fw-bold text-teal">Rs. {{ number_format($priceToShow, 2) }}</p>
             </div>

             {{-- <p class="fw-bold text-teal">Rs. {{ number_format($priceToShow, 2) }}</p> --}}

             </div>



         </td>

         {{-- Quantity --}}
         <td>
             <div class="qty-item d-flex align-items-center justify-content-center position-relative"
                 style="width: 120px; height: 45px; background: #f4f6f8; border-radius: 8px;">
                 {{-- Decrease Button --}}
                 <a href="javascript:void(0);"
                     class="btn btn-light btn-sm d-flex align-items-center justify-content-center decrease"
                     style="width: 32px; height: 32px; border-radius: 50%; position: absolute; left: 5px; top: 50%; transform: translateY(-50%);">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512"
                         fill="#092C4C">
                         <path
                             d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                     </svg>
                 </a>
                 {{-- Quantity Input --}}
                 <input type="text" name="qty[]" class=" text-center border-0 fw-bold"
                     style="width: 50px; background: transparent; font-size: 20px; color: #212B36;"
                     value="{{ $cart->quantity }}" readonly>
                 {{-- Increase Button --}}
                 <a href="javascript:void(0);"
                     class="btn btn-light btn-sm d-flex align-items-center justify-content-center increase"
                     style="width: 32px; height: 32px; border-radius: 50%; position: absolute; right: 5px; top: 50%; transform: translateY(-50%);">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512"
                         fill="#092C4C">
                         <path
                             d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32v144H48c-17.7 0-32 14.3-32 32s14.3 32 32 32h144v144c0 17.7 14.3 32 32 32s32-14.3 32-32V288h144c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                     </svg>
                 </a>
             </div>
         </td>



         {{-- Discount --}}
         <td>
             @if ($cart->discount_type == 'Flat')
                 Rs. {{ $cart->discount }}
             @elseif($cart->discount_type == 'Percentage')
                 {{ $cart->discount }}%
             @else
                 Rs. {{ $cart->discount }}
             @endif
         </td>
         {{-- Net Price --}}
         <td class="info">
             <p class="fw-bold text-teal">{{ $cart->net_price }}</p>
         </td>
         {{-- Total --}}
         <td class="info">
             <p class="fw-bold text-teal">{{ $cart->total }}</p>

         </td>

         {{-- Action --}}
         <td class="text-end  align-items-center action">
             <a class="btn-icon delete-icon editCart" href="javascript:void(0);" data-bs-toggle="modal"
                 data-bs-target="#edit-product">
                 <i class="ti ti-edit" style="font-size: 200%;"></i>
             </a>
             <a class="btn-icon delete-icon deleteCart" href="javascript:void(0);" data-bs-toggle="modal"
                 data-bs-target="#delete">
                 <i class="ti ti-trash" style="font-size: 200%;"></i>
             </a>
         </td>
     </tr>



 @empty
     <tr>
         <td colspan="7" class="text-center">No items in the cart</td>
     </tr>
 @endforelse


