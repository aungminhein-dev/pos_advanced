$(document).ready(function () {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var previousShipping = 0;
    const totalCalculation = () => {
        let total = 0;
        $('.detail-qty').each(function () {
            let subtotal = parseFloat($(this).closest('tr').find('.subtotal').text());
            total += subtotal; // Add subtotal to total initially
        });

        if (previousShipping === 0) {
            $('.cart_total_amount').text(total.toFixed(2) + ' Kyats').css({
                'color': 'grey',
                'font-weight': '900'
            });
            $('#total_').text(total.toFixed(2) + ' Kyats').css({
                'color': 'grey',
                'font-weight': '900'
            });

            $('#shipping').text("0.00 Kyats").css({
                'color': 'grey',
                'font-weight': '900'
            });
        } else {
            $('.cart_total_amount').text(total.toFixed(2) + ' Kyats').css({
                'color': 'grey',
                'font-weight': '900'
            });
        }

    };
    totalCalculation(); // Initial calculation

    // Store the original total without shipping
    let totalWithoutShipping = parseFloat($('#total').text().replace('Kyats', ''));

    function changeShippingCost() {
        let gate_fee = parseFloat($('.select-active').find(':selected').attr('gate-fee'));
        let shipping = parseFloat($('.select-active').val());

        // Calculate total with shipping
        let totalWithShipping = totalWithoutShipping + shipping;

        // Update displayed shipping cost
        $('.deli-price').empty().append(changeTextColor(shipping.toFixed(2) + ' Kyats'));

        // Update displayed total with shipping and gate fee
        let totalIncludingFees = totalWithShipping + gate_fee;
        let totalShipping = shipping + gate_fee
        $('.shipping_total').empty().append(changeTextColor(totalShipping.toFixed(2) + ' Kyats'));

        // Display shipping cost with gate fee if applicable
        if (gate_fee > 0) {
            $('.shipping').empty().append(changeTextColor(shipping.toFixed(2) + ' Kyats' + ' + ' + gate_fee.toFixed(2) + ' Kyats'));
            $('#gate-fee').empty().append(changeTextColor(gate_fee.toFixed(2) + ' Kyats'));
        } else {
            $('.shipping').empty().append(changeTextColor(shipping.toFixed(2) + ' Kyats'));
        }

        // Update total displayed on the page
        $('#total').empty().append(changeTextColor(totalIncludingFees.toFixed(2) + ' Kyats'));
        $('#total').addClass('font-xl text-brand fw-900');
        $('#totalWithDeliveryPrice').val(totalIncludingFees);
        $('#deliveryPrice').val(totalShipping)

    }


    //Qty Up-Down
    $('.detail-qty').each(function () {
        var $detailQty = $(this);
        var qtyVal = parseInt($detailQty.find('.qty-val').text(), 10);
        var price = parseInt($detailQty.closest('tr').find('.price span').text(), 10);
        var $subtotal = $detailQty.closest('tr').find('.subtotal');

        $detailQty.find('.qty-up').on('click', function (event) {
            event.preventDefault();
            qtyVal = qtyVal + 1;
            $detailQty.find('.qty-val').text(qtyVal);
            $subtotal.text(qtyVal * price);
            totalCalculation();
            if ($('.select-active').val() > 0) {
                changeShippingCost()
            }
        });

        $detailQty.find('.qty-down').on('click', function (event) {
            event.preventDefault();
            qtyVal = Math.max(qtyVal - 1, 1);
            $detailQty.find('.qty-val').text(qtyVal);
            $subtotal.text(qtyVal * price);
            totalCalculation();
            if ($('.select-active').val() > 0) {
                changeShippingCost()
            }
        });
    });

    changeTextColor = (text) => {
        return $('<span>').css({
            'font-weight': '900'
        }).text(text);
    }

    $('.select-active').change(changeShippingCost);


    addressPreview = () => {
        let region = $('.select-active').find(':selected').attr('region');
        let address = $('#address').val();
        let fullAddress = address + '/' + region;
        $('#full-address').val(fullAddress);
    }

    $('.update-cart-btn').click(function (event) {
        event.preventDefault();
        // Initialize cartData object
        let cartData = {};

        $('.shopping-summery tbody tr').each(function () {
            let row = $(this);
            let cartId = row.data('cart-id');
            let quantityText = row.find('.qty-val').text().trim();
            // Check if the quantity text is not empty or not NaN
            if (quantityText !== '' && !isNaN(quantityText)) {
                let quantity = parseInt(quantityText, 10);
                // Assign quantity only when it's valid
                cartData[cartId] = quantity;
            }
        });
        $.ajax({
            url: '/cart/update',
            method: 'get', // Assuming POST method
            data: cartData,
            success: function (response) {
                location.reload()
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    function clearCart() {
        $.ajax({
            url: '/cart/clear',
            method: 'post',
            success: function (response) {
                location.reload()
                toastr.success(response.message,"Success.")
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    $('.clear-cart').click(function () {
        clearCart();
    })


})
