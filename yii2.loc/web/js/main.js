

 $('#sl2').slider();

 	$('.catalog').dcAccordion({speed: 300});

 	function showCart(cart) {
		$('#cart .modal-body').html(cart);
		$('#cart').modal();
    }

     // function showImg(image) {
     //     $('#image .modal-body').html(image);
     //     $('#image').modal();
     // }
     //
     // $('.view-product').on('click', function (e) {
     //     // e.preventDefault();
     //     var id = $(this).data('id');
     //     var img = $(this);
     //     $.ajax({
     //         url: '/product/show',
     //         data: {id: id},
     //         type: 'GET',
     //         success: function(res) {
     //             // if (!res) alert('Error!');
     //             showImg(res);
     //         },
     //         error: function() {
     //             // alert('Error!');
     //         }
     //     });
     // });

     $(document).ready(function() { // Ждём загрузки страницы

         $(".imagel").click(function(){	// Событие клика на маленькое изображение
             var img = $(this);	// Получаем изображение, на которое кликнули
             var src = img.attr('src'); // Достаем из этого изображения путь до картинки
             $("body").append("<div class='popup'>"+ //Добавляем в тело документа разметку всплывающего окна
                 "<div class='popup_bg'><button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Закрыть</button></div>"+ // Блок, который будет служить фоном затемненным
                 "<img src='"+src+"' class='popup_img' />"+ // Само увеличенное фото
                 "</div>");
             $(".popup").fadeIn(800); // Медленно выводим изображение
             $(".popup_bg").click(function(){	// Событие клика на затемненный фон
                 $(".popup").fadeOut(800);	// Медленно убираем всплывающее окно
                 setTimeout(function() {	// Выставляем таймер
                     $(".popup").remove(); // Удаляем разметку всплывающего окна
                 }, 800);
             });
         });

     });



    
    function getCart() {
        $.ajax({
            url: '/cart/show',
            type: 'GET',
            success: function(res) {
                if (!res) alert('Error!');
                showCart(res);
            },
            error: function() {
                alert('Error!');
            }
        });
 	    return false;
        
    }
    // удаление товара
    $('#cart .modal-body').on('click', '.del-item', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/cart/del-item',
            data: {id: id},
            type: 'GET',
            success: function(res) {
                if (!res) alert('Error!');
                showCart(res);
            },
            error: function() {
                alert('Error!');
            }
        });
    });

    function clearCart() {
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function(res) {
                if (!res) alert('Error!');
                showCart(res);
            },
            error: function() {
                alert('Error!');
            }
        });

    }
    //добавление в корзину
 	$('.add-to-cart').on('click', function(e) {
		e.preventDefault();
		var id = $(this).data('id'),
            qty = $('#qty').val();
		$.ajax({
			url: '/cart/add',
			data: {id: id, qty: qty},
			type: 'GET',
			success: function(res) {
				if (!res) alert('Error!');
				showCart(res);
            },
			error: function() {
				alert('Error!');
            }
			});
    });

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')');
	};

/* scroll to top*/

$(document).ready(function() {
	$(function() {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					// scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647, // Z-Index for the overlay
		});
	});
});
