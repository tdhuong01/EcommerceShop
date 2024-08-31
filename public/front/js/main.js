/*  ---------------------------------------------------
    Template Name: Fashi
    Description: Fashi eCommerce HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });
    $(document).ready(function (){
        setTimeout(function (){
            $('.del-noti').hide("slow");
        },4000);
        setTimeout(function (){
            $('.change-noti').hide("slow");
        },4000);
    })
    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Product Slider
    --------------------*/
   $(".product-slider").owlCarousel({
        loop:true,
        margin: 25,
        nav: true,
        items: 4,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /*------------------
       logo Carousel
    --------------------*/
    $(".logo-carousel").owlCarousel({
        loop: false,
        margin: 30,
        nav: false,
        items: 5,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        mouseDrag: false,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
            },
            768: {
                items: 5,
            }
        }
    });

    /*-----------------------
       Product Single Slider
    -------------------------*/
    $(".ps-slider").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 3,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end

    console.log(timerdate);


    // Use this for real timer date
    /* var timerdate = "2020/01/01"; */

	$("#countdown").countdown(timerdate, function(event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));
    });


    /*----------------------------------------------------
     Language Flag js
    ----------------------------------------------------*/
    $(document).ready(function(e) {
    //no use
    try {
        var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
            var val = data.value;
            if(val!="")
                window.location = val;
        }}}).data("dd");

        var pagename = document.location.pathname.toString();
        pagename = pagename.split("/");
        pages.setIndexByValue(pagename[pagename.length-1]);
        $("#ver").html(msBeautify.version.msDropdown);
    } catch(e) {
        // console.log(e);
    }
    $("#ver").html(msBeautify.version.msDropdown);

    //convert
    $(".language_drop").msDropdown({roundedBorder:false});
        $("#tech").data("dd");
    });
    /*-------------------
		Range Slider
	--------------------- */
	var rangeSlider = $(".price-range"),
		minamount = $("#minamount"),
		maxamount = $("#maxamount"),
		minPrice = rangeSlider.data('min'),
		maxPrice = rangeSlider.data('max'),
        minValue = rangeSlider.data('min-value') != '' ? rangeSlider.data('min-value') : minPrice,
        maxValue = rangeSlider.data('max-value') != '' ? rangeSlider.data('max-value') : maxPrice;
	    rangeSlider.slider({
		range: true,
		min: minPrice,
        max: maxPrice,
		values: [minValue, maxValue],
		slide: function (event, ui) {
			minamount.val(ui.values[0]);
			maxamount.val(ui.values[1]);
		}
	});
	minamount.val( rangeSlider.slider("values", 0));
    maxamount.val( rangeSlider.slider("values", 1));

    /*-------------------
		Radio Btn
	--------------------- */
    $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").on('click', function () {
        $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").removeClass('active');
        $(this).addClass('active');
    });
    $(".pd-color-choose .cc-item label").on('click', function () {
        $(".pd-color-choose .cc-item label").removeClass('active');
        $(this).addClass('active');
    });
    /*-------------------
		Nice Select
    --------------------- */
    $('.sorting, .p-show').niceSelect();

    /*------------------
		Single Product
	--------------------*/
	$('.product-thumbs-track .pt').on('click', function(){
		$('.product-thumbs-track .pt').removeClass('active');
		$(this).addClass('active');
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product-big-img').attr('src');
		if(imgurl != bigImg) {
			$('.product-big-img').attr({src: imgurl});
			$('.zoomImg').attr({src: imgurl});
		}
	});

    $('.product-pic-zoom').zoom();

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('inc')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
                var newVal = 0;
			}
		}
		$button.parent().find('input').val(newVal);
        var cartId = $button.parent().find('input').data('id');
        if(newVal === 0){
            deleteCart(cartId)
        }else {
            updateQty(cartId,newVal);
        }
	});

    // filter index
    const product_men = $(".product-slider.men");
    const product_women = $(".product-slider.women");

    $('.filter-control').on('click','.item', function(){
        const $item = $(this);
        const filter = $item.data('tag');
        const category =$item.data('category');

        $item.siblings().removeClass('active');
        $item.addClass('active');

        if (category === 'men'){
            product_men.owlcarousel2_filter(filter);
        }

        if (category === 'women'){
            product_women.owlcarousel2_filter(filter);
        }
    });
    //choose
    var chooseQty = $('.choose-qty');
    chooseQty.prepend('<span class="decrease btn-qty">-</span>');
    chooseQty.append('<span class="increase btn-qty">+</span>');
    chooseQty.on('click', '.btn-qty', function () {
        var $button = $(this);
        var oldVal = $button.parent().find('input').val();
        if ($button.hasClass('increase')) {
            var newValue = parseFloat(oldVal) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldVal > 0) {
                var newValue = parseFloat(oldVal) - 1;
            } else {
                newValue = 0;
            }
        }
        $button.parent().find('input').val(newValue);
    });
    $('.cart-color select').change(function (){
        var $select = $(this);
        var cardId = $select.data("id");
        var color = $select.val();
        updateColor(cardId,color);
    });
    $('.cart-size select').change(function (){
        var $select = $(this);
        var cardId = $select.data("id");
        var size = $select.val();
        updateSize(cardId,size);
    });
    $('.wl-color select').change(function (){
        var $select = $(this);
        var cardId = $select.data("id");
        var color = $select.val();
        updateColorWl(cardId,color);
    });
    $('.wl-size select').change(function (){
        var $select = $(this);
        var cardId = $select.data("id");
        var size = $select.val();
        updateSizeWl(cardId,size);
    });
    $('.cmt-btn').on('click',function (){
        var form = $('.comment-form');
        var rating = $("input[type='radio'].rating:checked");
        if(rating.length >0){
            form.submit();
        }else {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                text: 'Hãy nhập số sao đánh giá sản phẩm',
                showConfirmButton: false,
                timer: 1000
            })
        }
    });
})(jQuery);
function chooseCart(productId){
    $.ajax({
        type:"GET",
        url: "cart/choose",
        data:{productId : productId},
        success:function (response){
            $(".cart").show("fast");
            $('.choose-id').val(response['id']);
            $('.choose-name').text(response['name']);
            $('.img_popup').attr('src','front/img/products/'+ response['img_path'] +'');
            var color = $('.color-choose');
            var size = $('.size-choose');
            color.children().remove();
            size.children().remove();
            $.each(response['color'], function () {
                $.each(this, function (name, value) {
                    var option_color ='<option value="'+value+'">'+value+'</option>';
                    color.append(option_color);
                });
            });
            $.each(response['size'], function () {
                $.each(this, function (name, value) {
                    var option_size ='<option value="'+value+'">'+value+'</option>';
                    size.append(option_size);
                });
            });
            console.log(response);
        },
        error: function (response){
            alert("fail");
            console.log(response);
        }
    });
}
function addCart(productID,color,size,qty){
    productID = $('.choose-id').val();
    color = $('.color-choose').find(":selected").val();
    size = $('.size-choose').find(":selected").val();
    qty = $('.qty-choose').val();
    $.ajax({
       type:'get',
       url: 'cart/add',
       data:{ productID:productID,color:color,size:size,qty:qty},
       success: function (response){
           if(response['checkQTY'] === 0){
               Swal.fire({
                   position: 'center',
                   icon: 'error',
                   title: '',
                   text: 'Sản phẩm có đặc đểm này đã hết hàng. Hãy chọn đặc điểm khác',
                   showConfirmButton: false,
                   timer: 1500
               });
           }else if (response['checkQTY'] < qty){
               Swal.fire({
                   position: 'center',
                   icon: 'warning',
                   title: 'Số lượng sản phẩm không đủ',
                   text: 'Hãy giảm bớt số lượng',
                   showConfirmButton: false,
                   timer: 1500
               });
           }else {
               $('.cart-count').text(response['count']);

               $('.cart').hide("fast");
               Swal.fire({
                   position: 'center',
                   icon: 'success',
                   title: 'Đã thêm vào giỏ hàng',
                   showConfirmButton: false,
                   timer: 800
               });
           }
            console.log(response);
       } ,
       error: function (response) {

       },
    });
}
function deleteCart(cartId){
    Swal.fire({
        title: 'Bạn có muốn xóa không?',
        text: "Không thể khôi phục sau khi đã xóa",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có',
        cancelButtonText: 'Không'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:'GET',
                url: 'cart/delete',
                data:{cartId: cartId},
                success: function (response){
                    $('.cart-count').text(response['count']);
                    //"cart/index"
                    var cart_tbody =$('.cart-table tbody');
                    var cart_existItem = cart_tbody.find("tr[data-id='"+cartId+"']");
                    cart_existItem.remove();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Xóa thành công',
                        showConfirmButton: false,
                        timer: 800
                    })
                    if(response['count'] !== 0){
                        $('.cart-total span').text(response['total'] +' VND');
                    }else {
                        setTimeout(function (){
                            location.reload();
                        },1200);
                    }

                    console.log(response);
                } ,
                error: function (response) {
                    alert("fail");
                },
            });
        }
    })
}
function destroyCart(){
    Swal.fire({
        title: 'Bạn có muốn xóa không?',
        text: "Không thể khôi phục sau khi đã xóa",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có',
        cancelButtonText: 'Không'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:'GET',
                url: 'cart/destroy',
                data:{},
                success: function (response){
                    $('.cart-count').text('0');
                    //"cart/index"
                    var cart_tbody =$('.cart-table tbody');
                    cart_tbody.children().remove();

                    $('.cart-total span').text('0');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Xóa thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function (){
                        location.reload();
                    },1500);
                    console.log(response);
                } ,
                error: function (response) {
                },
            });
        }
    })

}
function updateQty(cartId,qty){
    $.ajax({
        type:'GET',
        url: 'cart/updateQty',
        data:{cartId: cartId,qty:qty},
        success: function (response){
            $('.cart-count').text(response['count']);
            //"cart/index"
            var cart_tbody =$('.cart-table tbody');
            var cart_existItem = cart_tbody.find("tr[data-id='"+cartId+"']");
            if (qty === 0){
                cart_existItem.remove();
            }else {
                cart_existItem.find('.total-price').text((response['price']) +' VND');
            }
            $('.cart-total span').text(response['total'] +' VND');
            console.log(response);
        } ,
        error: function (response) {
            alert("fail");
        },
    });
}
function updateColor(cardId,color){
    $.ajax({
        type:'GET',
        url: 'cart/updateColor',
        data:{cartId: cardId,color:color},
        success: function (response){

            console.log(response);
        } ,
        error: function (response) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Cập nhật không thành công',
                showConfirmButton: false,
                timer: 800
            })
        },
    });
}
function updateSize(cardId,size){
    $.ajax({
        type:'GET',
        url: 'cart/updateSize',
        data:{cartId: cardId,size:size},
        success: function (response){

            console.log(response);
        } ,
        error: function (response) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Cập nhật không thành công',
                showConfirmButton: false,
                timer: 800
            })
        },
    });
}
function chooseWishlist(productId){
    $.ajax({
        type:"GET",
        url: "wishlist/choose",
        data:{productId : productId},
        success:function (response){
            $(".wishlist").show("fast");
            $('.wl-choose-id').val(response['id']);
            $('.choose-name').text(response['name']);
            $('.img_popup').attr('src','front/img/products/'+ response['img_path'] +'');
            var color = $('.wl-color-choose');
            var size = $('.wl-size-choose');
            color.children().remove();
            size.children().remove();
            if(response['color'].length >0){
                for (let i=0;i< response['color'].length;i++){
                    var option_color_exist = $('.wl-color-choose option').val();
                    if (option_color_exist !== response['color'][i].color){
                        var option_color ='<option value="'+response['color'][i].color+'">'+response['color'][i].color+'</option>';
                        color.append(option_color);
                    }
                    var option_size_exist = $('.wl-size-choose option').val();
                    if (option_size_exist !== response['color'][i].size){
                        var option_size ='<option value="'+response['color'][i].size+'">'+response['color'][i].size+'</option>';
                        size.append(option_size);
                    }
                }
            }

            console.log(response);
        },
        error: function (response){
            alert("fail");
            console.log(response);
        }
    });
}
function addWishlist(productId,color,size){
    productId = $('.wl-choose-id').val();
    color = $('.wl-color-choose').find(":selected").val();
    size = $('.wl-size-choose').find(":selected").val();
    $.ajax({
        type:'get',
        url: 'wishlist/add',
        data:{ productId:productId,color:color,size:size},
        success: function (response){
            if(response['check']=== true){
                $('.wl-count').text(response['count']);
                $('.wishlist').hide("fast");
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Đã thêm vào danh sách yêu thích',
                    showConfirmButton: false,
                    timer: 800
                })
            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Sản phẩm này đã có trong danh sách yêu thích',
                    showConfirmButton: false,
                    timer: 800
                })
            }

            console.log(response);
        } ,
        error: function (response) {
        },
    });
}
function updateColorWl(wlId,color){
    $.ajax({
        type:'GET',
        url: 'wishlist/updateColor',
        data:{wlId: wlId,color:color},
        success: function (response){
        } ,
        error: function (response) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Cập nhật không thành công',
                showConfirmButton: false,
                timer: 800
            })
        },
    });
}
function updateSizeWl(wlId,size){
    $.ajax({
        type:'GET',
        url: 'wishlist/updateSize',
        data:{wlId: wlId,size:size},
        success: function (response){

            console.log(response);
        } ,
        error: function (response) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Cập nhật không thành công',
                showConfirmButton: false,
                timer: 800
            })
        },
    });
}
function addCartWl(wlId){
    $.ajax({
        type:'GET',
        url: 'wishlist/addCart',
        data:{wlId:wlId},
        success: function (response){
            $('.cart-count').text(response['count_cart']);
            $('.wl-count').text(response['countWl']);
            var wl_tbody =$('.wl-tb tbody');
            var wl_existItem = wl_tbody.find("tr[data-id='"+wlId+"']");
            wl_existItem.remove();
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đã thêm vào giỏ hàng ',
                showConfirmButton: false,
                timer: 800
            })
            console.log(response);
        } ,
        error: function (response) {

        },
    });
}
function deleteWl(wlId){
    Swal.fire({
        title: 'Bạn có muốn xóa không?',
        text: "Không thể khôi phục sau khi đã xóa",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có',
        cancelButtonText: 'Không'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:'GET',
                url: 'wishlist/delete',
                data:{wlId: wlId},
                success: function (response){
                    $('.cart-count').text(response['count']);
                    var wl_tbody =$('.wl-tb tbody');
                    var wl_existItem = wl_tbody.find("tr[data-id='"+wlId+"']");
                    wl_existItem.remove();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Xóa thành công',
                        showConfirmButton: false,
                        timer: 800
                    })
                    console.log(response);
                } ,
                error: function (response) {
                    alert("fail");
                },
            });
        }
    })
}
function destroyWl(){
    Swal.fire({
        title: 'Bạn có muốn xóa không?',
        text: "Không thể khôi phục sau khi đã xóa",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có',
        cancelButtonText: 'Không'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:'GET',
                url: 'wishlist/destroy',
                data:{},
                success: function (response){
                    $('.wl-count').text('0');
                    var wl_tbody =$('.wl-tb tbody');
                    wl_tbody.children().remove();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Đã xóa',
                        showConfirmButton: false,
                        timer: 800
                    })
                    setTimeout(function (){
                        location.reload();
                    },1200);
                    console.log(response);
                } ,
                error: function (response) {
                },
            });
        }
    })
}
function addCartPro(productID,color,size,qty){
    productID = $('.pro-id').val();
    color = $("input[type='radio'].radio-color:checked").val();
    size = $("input[type='radio'].radio-size:checked").val();
    qty = $('.pro-choose-qty').val();
    $.ajax({
        type:'GET',
        url: 'cart/addCartPro',
        data:{ productID:productID,color:color,size:size,qty:qty},
        success: function (response){
            if(response['checkQTY'] === 0){
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '',
                    text: 'Sản phẩm có đặc đểm này đã hết hàng. Hãy chọn đặc điểm khác',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else if (response['checkQTY'] < qty){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Số lượng sản phẩm không đủ',
                    text: 'Hãy giảm bớt số lượng',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else {
                $('.cart-count').text(response['count']);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Đã thêm vào giỏ hàng',
                    showConfirmButton: false,
                    timer: 800
                })
            }

        } ,
        error: function (response) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                text: 'Hãy chọn màu sắc và kích thước trước khi thêm vào giỏ hàng',
                showConfirmButton: false,
                timer: 1500
            })
        },
    });
}

