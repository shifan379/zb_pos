$(document).ready(function () {

    // Clear discount amount input on focus
    $(document).on('focus', '.discount_amount, .discount_percent', function () {
        $(this).val('');
    });

    // Gen Item code
    $('.genBarcode').on('click', function () {
        $('.item_code').val('Checking...');
        $.get(routes.nextItemCode, function (data) {
            $('.item_code').val(data.code);
            $('.itembarCodeValue').val(data.code);
        });
    });

    // Format decimals on blur
    $('input[name="selling_price"], input[name="buying_price"],input[name="quantity"]').on('blur', function () {
        let val = parseFloat($(this).val());
        if (!isNaN(val)) {
            $(this).val(val.toFixed(2));
        }
    });

    // Product tab required fields
    $('#pills-profile-tab').on('click', function () {
        $('.buying_price').removeAttr('required');
        $('.selling_price').removeAttr('required');
    });
    $('#pills-home-tab').on('click', function () {
        $('.buying_price').attr('required');
        $('.selling_price').attr('required');
    });

    // Discount and stock value functions
    function updateStockvalueFields() {
        let price = parseFloat($('.buying_price').val()) || 0;
        let qty = parseFloat($('.quantity').val()) || 0;
        $('.stock_value').val((qty * price).toFixed(2));
    }
    function updateDiscountFields() {
        let price = parseFloat($('.selling_price').val()) || 0;
        let percent = parseFloat($('.discount_percent').val()) || 0;
        $('.discount_amount').val(((percent / 100) * price).toFixed(2));
    }
    $('.selling_price').on('input', updateDiscountFields);
    $('.discount_percent').on('input', updateDiscountFields);
    $('.discount_amount').on('input', function () {
        let price = parseFloat($('.selling_price').val()) || 0;
        let amount = parseFloat($(this).val()) || 0;
        let percent = price ? (amount / price) * 100 : 0;
        $('.discount_percent').val(percent.toFixed(2));
    });
    $('.quantity, .buying_price').on('input', updateStockvalueFields);
    updateDiscountFields();

    // Save category
    $('#submitCategory').on('click', function () {
        var $btn = $(this);
        var category = $('#category_name').val();
        if (!category) {
            toastr.warning('Please enter a category name.');
            return;
        }
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        $.ajax({
            url: routes.categoriesStore,
            type: 'POST',
            data: {
                category: category,
                _token: csrfToken
            },
            success: function (response) {
                toastr.success('Category added!');
                $('#categorySelect').append(
                    $('<option>', {
                        value: response.id,
                        text: response.category,
                        selected: true
                    })
                );
                $('#categorySelect').val(response.id).trigger('change');
                $('#category_name').val('');
                $btn.prop('disabled', false).html('Add Another');
            },
            error: function (xhr) {
                toastr.error('Error adding category.');
                $btn.prop('disabled', false).html('Try Again');
            }
        });
    });

    // Save Variant
    $('#submitVariant').on('click', function () {
        var $btn = $(this);
        var variant = $('#variant_name').val();
        var variantValue = $('#variant_value').val();
        if (!variant) {
            toastr.warning('Please enter a variant name.');
            return;
        }
        if (!variantValue) {
            toastr.warning('Please enter a variant value.');
            return;
        }
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        var variantValueArray = variantValue.split(',').map(function (item) {
            return item.trim();
        }).filter(Boolean);

        $.ajax({
            url: routes.variantsStore,
            type: 'POST',
            data: {
                variant: variant,
                variantValue: variantValueArray,
                _token: csrfToken
            },
            success: function (response) {
                toastr.success('Variant added!');
                $('.variantSelect').append(
                    $('<option>', {
                        value: response.variant,
                        text: response.variant,
                        selected: true
                    })
                );
                $('.variantSelect').append(
                    $('<option>', {
                        value: response.variant,
                        text: response.variant,
                        selected: true
                    })
                );
                $('.variantSelect').val(response.variant).trigger('change');
                $('#variant_name').val('');
                $('#variant_value').val('');
                $btn.prop('disabled', false).html('Add Another');
            },
            error: function (xhr) {
                toastr.error('Error adding variant.');
                $btn.prop('disabled', false).html('Try Again');
            }
        });
    });

    // Mark generate
    $('#markAdd').on('click', function () {
        var $btn = $(this);
        let price = $('input[name="buying_price"]').val();
        price = price.replace(/\D/g, '');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        let mappingStr = "T=1,E=2,F=3,A=4,S=5,I=6,O=7,N=8,V=9,H=0";
        let mappingArr = mappingStr.split(',');
        let numToLetter = {};
        mappingArr.forEach(function (pair) {
            let [letter, num] = pair.split('=');
            if (letter && num) {
                numToLetter[num.trim()] = letter.trim().toUpperCase();
            }
        });
        let mark = '';
        for (let i = 0; i < price.length; i++) {
            let digit = price[i];
            mark += numToLetter[digit] || '';
        }
        $('input[name="mark"]').val(mark);
        toastr.info('Mark Number Created.');
        $btn.prop('disabled', false).html('Generate');
    });

    // Mark generate for TD
    $(document).on('click', '#TDmarkAdd', function () {
        var $btn = $(this);
        var $row = $(this).closest('tr');
        var pricex = $row.find('.tdprice').val();
        if (!pricex) {
            toastr.warning('Please enter a Price.');
            return;
        }
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        pricex = pricex.replace(/\D/g, '');
        let mappingStr = "A=1,B=2,C=3,D=4,E=5,F=6,G=7,H=8,I=9,J=0";
        let mappingArr = mappingStr.split(',');
        let numToLetter = {};
        mappingArr.forEach(function (pair) {
            let [letter, num] = pair.split('=');
            if (letter && num) {
                numToLetter[num.trim()] = letter.trim().toUpperCase();
            }
        });
        let mark = '';
        for (let i = 0; i < pricex.length; i++) {
            let digit = pricex[i];
            mark += numToLetter[digit] || '';
        }
        $row.find('input[name="mark[]"]').val(mark);
        toastr.info('Mark Number Created.');
        $btn.prop('disabled', false).html('Generate');
    });

    // Table tr mark generate for TD
    $(document).on('input', '.selling_priceTD', function () {
        var $row = $(this).closest('tr');
        let price = parseFloat($row.find('.selling_priceTD').val()) || 0;
        let percent = parseFloat($row.find('.discount_percentTD').val()) || 0;
        $row.find('.discount_amountTD').val(((percent / 100) * price).toFixed(2));
    });
    $(document).on('input', '.discount_percentTD', function () {
        var $row = $(this).closest('tr');
        let price = parseFloat($row.find('.selling_priceTD').val()) || 0;
        let percent = parseFloat($row.find('.discount_percentTD').val()) || 0;
        $row.find('.discount_amountTD').val(((percent / 100) * price).toFixed(2));
    });
    $(document).on('input', '.discount_amountTD', function () {
        var $row = $(this).closest('tr');
        let price = parseFloat($row.find('.selling_priceTD').val()) || 0;
        let amount = parseFloat($row.find('.discount_amountTD').val()) || 0;
        let percent = price ? (amount / price) * 100 : 0;
        $row.find('.discount_percentTD').val(percent.toFixed(2));
    });

    // Change Decimal Value
    $(document).on('blur', '.tdprice, .selling_priceTD', function () {
        let val = parseFloat($(this).val());
        if (!isNaN(val)) {
            $(this).val(val.toFixed(2));
        }
    });

    // Hide all initially
    $('.wholesale_price, .online_price, .manufacturer, .expiry_date, .warranties, .services').hide();

    // Function to toggle visibility
    function toggleSection(checkboxId, sectionClass) {
        if ($(checkboxId).is(':checked')) {
            $(sectionClass).show();
        } else {
            $(sectionClass).hide();
        }
    }

    // On page load: show/hide based on checkbox status
    toggleSection('#wholesale', '.wholesale_price');
    toggleSection('#online', '.online_price');
    toggleSection('#manufacturer', '.manufacturer');
    toggleSection('#expiry', '.expiry_date');
    toggleSection('#warranties', '.warranties');
    toggleSection('#services', '.services');

    // On checkbox change
    $('#wholesale').on('change', function () {
        toggleSection('#wholesale', '.wholesale_price');
    });

    $('#online').on('change', function () {
        toggleSection('#online', '.online_price');
    });

    $('#manufacturer').on('change', function () {
        toggleSection('#manufacturer', '.manufacturer');
    });

    $('#expiry').on('change', function () {
        toggleSection('#expiry', '.expiry_date');
    });

    $('#warranties').on('change', function () {
        toggleSection('#warranties', '.warranties');
    });

    $('#services').on('change', function () {
        toggleSection('#services', '.services');
    });

    // Category select
    $('#categorySelect').on('change', function () {
        var categoryId = $(this).val();
        $('#subCategorySelect').empty().append('<option value="">Checking...</option>');
        if (categoryId) {
            $.ajax({
                url: routes.subData,
                type: 'POST',
                data: {
                    category_id: categoryId,
                    _token: csrfToken
                },
                success: function (data) {
                    $('#subCategorySelect').empty().append('<option value="">Select</option>');
                    if (data.length > 0) {
                        $.each(data, function (index, subCategory) {
                            $('#subCategorySelect').append('<option value="' + subCategory.subcategory + '">' + subCategory.subcategory + '</option>');
                        });
                    } else {
                        $('#subCategorySelect').append('<option value="" disabled>No subcategories found</option>');
                    }
                },
                error: function () {
                    toastr.error('Unable to load subcategories. Please contact the Support Team.');
                }
            });
        } else {
            $('#subCategorySelect').empty().append('<option value="">Select</option>');
        }
    });

    // Add dynamically Variant
    $('#colorSelect').on('change', function () {
        var selectedName = $(this).val();
        var selectedVariant = window.variantData.find(function (v) {
            return v.name === selectedName;
        });

        $('#inputBox').tagsinput('removeAll');
        if (selectedVariant && selectedVariant.values) {
            let values = selectedVariant.values;
            if (typeof values === 'string') {
                try {
                    values = JSON.parse(values);
                } catch (e) {
                    values = [];
                }
            }
            values.forEach(function (val) {
                $('#inputBox').tagsinput('add', val);
            });

            var tbody = $('#variant-table tbody');
            tbody.empty();
            values.forEach(function (val, idx) {
                var row = `
                    <tr>
                        <td>
                            <input type="hidden" class="form-control" name="variantion_name[]" value="${selectedName}" readonly>
                            <div class="add-product">
                                <input type="text" class="form-control" name="variantion_value[]" value="${val}" readonly>
                            </div>
                        </td>
                        <td>
                            <div class="add-product">
                                <input type="number" class="form-control" name="quantity[]" min="0" step="0.01"  >
                            </div>
                        </td>
                        <td>
                            <div class="add-product">
                                <input type="number" class="form-control tdprice" name="buying_price[]" min="0" step="0.01" >
                            </div>
                        </td>
                        <td>
                            <div class="add-product">
                                <input type="number" class="form-control selling_priceTD" name="selling_price[]" min="0" step="0.01" >
                            </div>
                        </td>
                        <td>
                            <div class="add-product">
                               <div class="discount-input me-2">
                                    <input type="number" name="discount_percentage[]"  style="width:70px" class="discount_percentTD " min="0" step="0.01" placeholder="%" >
                                    <span  >%</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="add-product">
                               <div class="discount-input me-2">
                                    <input type="number" name="discount_amount[]"  style="width:70px" class="discount_amountTD" min="0" placeholder="Rs" step="0.01">
                                    <span  >Rs</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="add-product">
                                <div class="mb-3 list position-relative">
                                    <input type="text" name="mark[]"  class="form-control list">
                                    <button type="button" id="TDmarkAdd" class="btn btn-primaryadd">
                                        Generate
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a  class="p-2 remove-variant-row" href="javascript:void(0);">
                                    <i data-feather="trash-2" class="feather-trash-2"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        }
    });

    // Remove row on click
    $(document).on('click', '.remove-variant-row', function () {
        $(this).closest('tr').remove();
    });

    // Show file dialog when clicking the "Add Images" box
    $(document).on('click', '.image-uploads', function () {
        $(this).closest('.image-upload-two').find('input[type="file"]').click();
    });

    // Image preview
    $(document).on('change', '.image-upload-two input[type="file"]', function (e) {
        var files = e.target.files;
        // alert(files);
        var $previewArea = $(this).closest('.add-choosen').find('.preview-images');
        Array.from(files).forEach(function (file) {
            if (!file.type.startsWith('image/')) {
                toastr.error('Only image files are allowed!');
                return;
            }
            var reader = new FileReader();
            reader.onload = function (evt) {
                var imgHtml = `
                    <div class="phone-img uploaded" style="position:relative; display:inline-block; margin:5px;">
                        <img src="${evt.target.result}" alt="image" style="max-width:110px; max-height:110px; border-radius:8px; box-shadow:0 2px 8px #eee;">
                        <a href="javascript:void(0);" class="remove-product" style="position:absolute;top:5px;right:5px;">
                            <span style="background:#f33;color:#fff;border-radius:50%;padding:2px 6px;font-weight:bold;font-size:16px;line-height:1;">×</span>
                        </a>
                    </div>
                `;
                $previewArea.append(imgHtml);
                if (window.feather) feather.replace();
            };
            reader.readAsDataURL(file);
        });
    });

    // Remove image preview
    $(document).on('click', '.remove-product', function () {
        $(this).closest('.phone-img.uploaded').remove();
    });

    // AI Image Generation
    $('#generateAiBtn').on('click', function () {
        var productName = $('#product_name').val();
        if (!productName) {
            toastr.warning('Please enter a product name!');
            return;
        }
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Generating...');
        $('#generation-status')
            .removeClass('alert-danger alert-success')
            .addClass('alert-info')
            .text('Generating image...')
            .show();

        $.ajax({
            url: routes.generateAiImage,
            type: 'POST',
            data: {
                product_name: productName,
                _token: csrfToken
            },
            success: function (res) {
                if (res.success) {
                    $('.preview-images').html(`
                        <div class="phone-img uploaded">
                            <img src="${res.image_url}" style="max-width:100%;max-height:400px;">
                            <a href="javascript:void(0);" class="remove-product" style="position:absolute;top:5px;right:5px;">
                                <span style="background:#f33;color:#fff;border-radius:50%;padding:2px 6px;font-weight:bold;font-size:16px;line-height:1;">×</span>
                            </a>
                        </div>
                    `);
                    $('#image-path-input').val(res.file_path);
                    $('#save-section').show();
                    $('#generation-status')
                        .removeClass('alert-info')
                        .addClass('alert-success')
                        .text('Image generated successfully!');
                } else {
                    throw new Error(res.message || 'Image generation failed');
                    toastr.error('Image generation failed');
                }
            },
            error: function (xhr) {
                var errorMsg = xhr.responseJSON?.message || 'Image generation failed!';
                $('#generation-status')
                    .removeClass('alert-info')
                    .addClass('alert-danger')
                    .text(errorMsg);
            },
            complete: function () {
                $('#generateAiBtn').prop('disabled', false).html('<i class="fas fa-magic"></i> Generate AI Image');
            }
        });
    });

    // Remove AI image preview
    $(document).on('click', '.remove-product', function () {
        $(this).closest('.phone-img').remove();
        $('#save-section').hide();
    });

});


$(function() {
    const focusableSelector = 'input:visible:not([type=hidden]):not([disabled]):not([readonly]), select:visible:not([disabled]):not([readonly]), textarea:visible:not([disabled]):not([readonly])';

    $(document).on('keydown', focusableSelector, function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const $inputs = $(focusableSelector);
            const idx = $inputs.index(this);
            if (idx > -1 && idx < $inputs.length - 1) {
                $inputs.eq(idx + 1).focus();
            }
        }
    });

    $(document).on('keydown', function(e) {
        if (e.key === "F2") {
            e.preventDefault();
            $('#functionKey').click();
        }
    });
});
