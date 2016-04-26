function Notify(message){				// Показываем текст сообщения
	var notify = '<div class="notify">' + message + '</div>';
	$(notify).appendTo('body').show('500').delay('1500').hide('500', function(){$(this).remove()});
}

function Filter(numb){						// Быстрая фильтрация
	var	text=($('#fast_filter_' + numb).val());

	jQuery.expr[":"].contains = function( elem, i, match, array ) {return (elem.textContent || elem.innerText || jQuery.text( elem ) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;}
	$('.filter_line_' + numb).stop(true, true).hide();

	$('.filter_line_' + numb).children('*:contains('+text+')').stop(true, true).parents('.filter_line_' + numb).show();
	
	var filter_count_show = $('.filter_line_' + numb).children('*:contains('+text+')').parent('.filter_line_' + numb).length;
	$('#filter_count_show_' + numb).text(filter_count_show);
};

$(document).ready(function() {
	$( "#tabs" ).tabs({});

	$('#fast_filter_1').on('keyup', function(){					
		Filter('1');
	});
	$('#clean_filter_1').on('click', function(){
		$('#fast_filter_1').val('');
		Filter('1');
	});

	$('#fast_filter_2').on('keyup', function(){					
		Filter('2');
	});
	$('#clean_filter_2').on('click', function(){
		$('#fast_filter_2').val('');
		Filter('2');
	});

	//Добавление заказа

	$('#add_order').on('click', function(){
		$('#order_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#order_editor').fadeOut('300');
		})
		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#order_editor').fadeOut('300');
		    }
		});
		$('#order_editor_container').find('input[type=text]').val('');

		editor = $('#order_editor_container');

		avalibleCustomers();

		$//('editor').find('.customer_name[value='+ $(order) +']').prop('selected','selected');

		$('.customer_name').on('change', function(){
			customer_id = $(editor).find('.customer_name').find('option:selected').val();
			avalibleContracts(customer_id);
		})

		avalibleCars();

		$('.update').on('click', function(){

			var id = $(editor).find('.id').text();
			var customer_id = $(editor).find('.customer_name').find('option:selected').val();

			//var customer_name = $(editor).find('.customer_name').val();
			var contract_id = $(editor).find('.contract_number').find('option:selected').val();
			var car_id = $(editor).find('.car_id').find('option:selected').val();

			var delivery_from = $(editor).find('.delivery_from_0').val();			// Склеиваем город, улицу и дом в одну строку.
			if ($(editor).find('.delivery_from_1').val() !== '') { delivery_from += ', '+ $(editor).find('.delivery_from_1').val(); }
			if ($(editor).find('.delivery_from_2').val() !== '') { delivery_from += ', '+ $(editor).find('.delivery_from_2').val(); }

			var delivery_to = $(editor).find('.delivery_to_0').val();
			if ($(editor).find('.delivery_to_1').val() !== '') { delivery_to += ', '+ $(editor).find('.delivery_to_1').val(); }
			if ($(editor).find('.delivery_to_2').val() !== '') { delivery_to += ', '+ $(editor).find('.delivery_to_2').val(); }

			var date_added = $.datepicker.parseDate('dd.mm.yy', $(editor).find('.date_added').val())
			var date_added = (date_added.valueOf())/1000;

			var status = $(editor).find('.status').val();
			var customer_name = $(editor).find('.customer_name').val();
			var comment = $(editor).find('.comment').val();

            $.post("controllers/orders.class.php", {
                customer_id: customer_id,
                id: id,
                car_id: car_id,
                contract_id: contract_id,
                delivery_from: delivery_from,
                delivery_to: delivery_to,
                status: status,
                comment: comment,
                button_click: 'add'
            },
            function(data) {
                if(data !== false) {
                    Notify('Готово');
                    $('#order_editor').hide('300');
                }
                else {
                    Notify('Не сохранили');
                }
            });

        });

	});

	//Редактирование заказа


	$('.order_line').on('dblclick', function(){				//Editor заказа
		$('#order_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#order_editor').fadeOut('300');
		})
		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#order_editor').fadeOut('300');
		    }
		});

		order = $(this);
		editor = $('#order_editor_container');

		avalibleCustomers();

		

		customer_id = $(editor).find('.customer_name').find('option:selected').val();
		avalibleContracts(customer_id);
		
		$('.customer_name').on('change', function(){
			customer_id = $(editor).find('.customer_name').find('option:selected').val();
			avalibleContracts(customer_id);
		})

		avalibleCars();



		var delivery_from = $(order).find('.delivery_from').text().split(',');

		for (var i = 0; i < delivery_from.length; i++) {								//Разделяем город, улицу и дом
			$(editor).find('.delivery_from_' + i).val(delivery_from[i].trim());
		};

		var delivery_to = $(order).find('.delivery_to').text().split(',');

		for (var i = 0; i < delivery_to.length; i++) {
			$(editor).find('.delivery_to_' + i).val(delivery_to[i].trim());
		};

		$(editor).find('.id').text($(order).find('.id').text());
		$(editor).find('.date_added').val($(order).find('.date_added').text());
		$(editor).find('.status').val($(order).find('.status').text());
		$(editor).find(".status[value=" + $(order).find('.status').text() + "]").attr("selected", "selected");
		$(editor).find('.comment').val($(order).find('.comment_mini').text());

        //Редактирование заказа
		$('.update').on('click', function(){
			var id = $(editor).find('.id').text();
			var customer_id = $(editor).find('.customer_name').find('option:selected').val();

			var contract_id = $(editor).find('.contract_number').find('option:selected').val();
			var car_id = $(editor).find('.car_id').find('option:selected').val();
			console.log(car_id);

			var delivery_from = $(editor).find('.delivery_from_0').val();			// Склеиваем город, улицу и дом в одну строку.
			if ($(editor).find('.delivery_from_1').val() !== '') { delivery_from += ', '+ $(editor).find('.delivery_from_1').val(); }
			if ($(editor).find('.delivery_from_2').val() !== '') { delivery_from += ', '+ $(editor).find('.delivery_from_2').val(); }

			var delivery_to = $(editor).find('.delivery_to_0').val();
			if ($(editor).find('.delivery_to_1').val() !== '') { delivery_to += ', '+ $(editor).find('.delivery_to_1').val(); }
			if ($(editor).find('.delivery_to_2').val() !== '') { delivery_to += ', '+ $(editor).find('.delivery_to_2').val(); }

			var date_added = $.datepicker.parseDate('dd.mm.yy', $(editor).find('.date_added').val())
			var date_added = (date_added.valueOf())/1000;

			var status = $(editor).find('.status').val();
			var comment = $(editor).find('.comment').val();

            $.post("controllers/orders.class.php", {
                customer_id: customer_id,
                id: id,
                car_id: car_id,
                contract_id: contract_id,
                delivery_from: delivery_from,
                delivery_to: delivery_to,
                date_added: date_added,
                status: status,
                comment: comment,
                button_click: 'update'
            },
            function(data) {

                if(data !== false) {
                    Notify('Готово');
                    $('#order_editor').hide('300');
                }
                else {
                    Notify('Не сохранили');
                }
            });

        });

        //Удаление заказов
        $('.delete').on('click', function(){
            var id = $(editor).find('.id').text();
            $.post("controllers/orders.class.php", {
                    id: id,
                    button_click: 'delete'
                },
                function(data) {
                    if(data !== false) {
                        Notify('Готово');
                        $('#cars_editor').hide('300');
                    }
                    else {
                        Notify('Запись не была удалена');
                    }
                });

        });
	})

	//Добавление клиента
	$('#add_customer').on('click', function(){
		$('#customers_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#customers_editor').fadeOut('300');
		})
		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#customers_editor').fadeOut('300');
		    }
		});

		$('#customers_editor_container').find('input[type=text]').val('');

		$('.update').on('click', function(){

			editor = $('#customers_editor_container');

			var id = $(editor).find('.id').text();
			var name = $(editor).find('.name').val();
			var company = $(editor).find('.company').val();
			var email = $(editor).find('.email').val();
			var phone = $(editor).find('.phone').val();
			var comment = $(editor).find('.comment').val();
			var status = $(editor).find('.status').val();

            $.post("controllers/customers.class.php", {
                id: id,
                name: name,
                company: company,
                email: email,
                phone: phone,
                status: status,
                comment: comment,
                button_click: 'add'
            },
            function(data) {
                    if (data !== false) {
                        var data_test = +data;
                        if(typeof data_test == 'number'){
                            //alert('aaaaa');
                            Notify('Готово');
                            $('#customer_editor').hide('300');
                        }
                        else{
                            alert('ошибки');
                            //var errors  = JSON.parse(data);
                        }
                    }
                    else {
                        Notify('Не сохранили');
                    }
            });

        });

	});


function avalibleCustomers(){
	$(editor).find('.customer_name').html('');

	var avalibleCustomers = $.ajax({
		url: './controllers/customers.class.php',
		type: 'POST',
		dataType: 'json',
		data: {button_click: 'getAutocomplete'},
	}).done(function(data) {
		$(data).each(function(key, val) {
			$(editor).find('.customer_name').append('<option value="' + val.id + '">' + val.name + '</option>');
		});

			$(editor).find('.customer_name').find('option[value="' + $(order).find('.customer_name').attr('id')+'"]').attr('selected', 'selected');

		
	});
};
		
function avalibleContracts(customer_id){
	$(editor).find('.contract_number').html('');

	var avalibleContracts = $.ajax({
		url: './controllers/contracts.class.php',
		type: 'POST',
		dataType: 'json',
		data: {button_click: 'getAutocomplete', where: customer_id},
	})
	.done(function(data) {
		$(data).each(function(key, val) {
			$(editor).find('.contract_number').append('<option value="' + val.id + '">' + val.number + '</option>');
		});
	});
};

function avalibleCars(){
	$(editor).find('.car_id').html('');

	var avalibleCars = $.ajax({
		url: './controllers/cars.class.php',
		type: 'POST',
		dataType: 'json',
		data: {button_click: 'getAutocomplete'},
	})
	.done(function(data) {
		$(data).each(function(key, val) {
			$(editor).find('.car_id').append('<option value="' + val.id + '">' + val.number + '</option>');
		});
	});
};

	//Редактирование клиента
	$('.customer_line').on('dblclick', function(){
		$('#customers_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#customers_editor').fadeOut('300');
		})

		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#customers_editor').fadeOut('300');
		    }
		});

		customer = $(this);
		editor = $('#customers_editor_container');

		console.log($(customer).find('.id').text());

		$(editor).find('.id').text($(customer).find('.id').text());
		$(editor).find('.name').val($(customer).find('.name').text());
		$(editor).find('.company').val($(customer).find('.company').text());
		$(editor).find('.email').val($(customer).find('.email').text());
		$(editor).find('.phone').val($(customer).find('.phone').text());
		$(editor).find(".status[value=" + $(customer).find('.status').text() + "]").attr("selected", "selected");
		$(editor).find('.comment').val($(customer).find('.comment_mini').text());

		$('.update').on('click', function(){
            var id = $(editor).find('.id').text();
            var name = $(editor).find('.name').val();
            var company = $(editor).find('.company').val();
            var email = $(editor).find('.email').val();
            var phone = $(editor).find('.phone').val();
            var comment = $(editor).find('.comment').val();
            var status = $(editor).find('.status').val();


            $.post("controllers/customers.class.php", {
                    id: id,
                    name: name,
                    company: company,
                    email: email,
                    phone: phone,
                    status: status,
                    comment: comment,
                    button_click: 'update'
                },
                function(data) {
                    if(data !== false) {
                        Notify('Готово');
                        $('#customers_editor').hide('300');
                    }
                    else {
                        Notify('Не сохранили');
                    }
                });
        });

        $('.send').on('click', function(){
            var id = $(editor).find('.id').text();
            $.getJSON("controllers/users.class.php", {
                    id: id,
                    button_click: 'get_user_by_customer_id'
                },
                function(data) {
                    var login = data.user_login;
                    var password = data.user_password;
                    var email = $(editor).find('.email').val();
                    $.ajax({
                        async: false,
                        url: '../../modules/send_email.php',
                        type: 'POST',
                        dataType: 'html',
                        data: {
                            email: email,
                            login: login,
                            password: password,
                            button_click: 'send_access_to_user'
                        },
                    })
                        .done(function(data) {
                            console.log(data);
                            if(data == '1') {
                                alert('Отправлено');
                            }
                            else {
                                alert('Отправить логин/пароль не удалось');
                            }
                        });
                });
        });



        //Удаление клиентов
        $('.delete').on('click', function(){
            var id = $(editor).find('.id').text();
            $.post("controllers/customers.class.php", {
                    id: id,
                    button_click: 'delete'
                },
                function(data) {
                    if(data !== false) {
                        Notify('Готово');
                        $('#cars_editor').hide('300');
                    }
                    else {
                        Notify('Запись не была удалена');
                    }
                });

        });


	});

	//Редактирование машины
	$('.cars_line').on('dblclick', function(){
		$('#cars_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#cars_editor').fadeOut('300');
		})

		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#cars_editor').fadeOut('300');
		    }
		});

		cars = $(this);
		editor = $('#cars_editor_container');

		$(editor).find('.id').text($(cars).find('.id').text());
		$(editor).find('.name').val($(cars).find('.name').text());
		$(editor).find('.phone').val($(cars).find('.phone').text());
		$(editor).find('.number').val($(cars).find('.number').text());

		$('.update').on('click', function(){
			var id = $(editor).find('.id').text();
			var name = $(editor).find('.name').val();
			var phone = $(editor).find('.phone').val();
			var number = $(editor).find('.number').val();

            $.post("controllers/cars.class.php", {
                id: id,
                name: name,
                phone: phone,
                number: number,
                button_click: 'update'
            },
            function(data) {
                if(data !== false) {
                    Notify('Готово');
                    $('#cars_editor').hide('300');
                }
                else {
                    Notify('Не сохранили');
                }
            });

        });



        //Удаление машин
        $('.delete').on('click', function(){
            var id = $(editor).find('.id').text();
            $.post("controllers/cars.class.php", {
                    id: id,
                    button_click: 'delete'
                },
                function(data) {
                    if(data !== false) {
                        Notify('Готово');
                        $('#cars_editor').hide('300');
                    }
                    else {
                        Notify('Запись не была удалена');
                    }
                });

        });

	});

	//Редактирование договора
	$('.contracts_line').on('dblclick', function(){
		$('#contracts_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#contracts_editor').fadeOut('300');
		})

		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#contracts_editor').fadeOut('300');
		    }
		});

		cars = $(this);
		editor = $('#contracts_editor_container');
		order = $(this);

		avalibleCustomers();

		$(editor).find('.id').text($(cars).find('.id').text());
		$(editor).find('.contract_sign_date').val($(cars).find('.contract_sign_date').text());

		//$(editor).find('.customer_name').val($(cars).find('.customer_name').text());
		//$(editor).find('.customer_name').attr('id', $(cars).find('.customer_name').attr('id'));
		$(editor).find('.number').val($(cars).find('.number').text());

		$('.update').on('click', function(){
			var id = $(editor).find('.id').text();

			var contract_sign_date = $.datepicker.parseDate('dd.mm.yy', $(editor).find('.contract_sign_date').val())
			var contract_sign_date = (contract_sign_date.valueOf())/1000;

			var customer_id = $(editor).find('.customer_name').find('option:selected').val();
			var number = $(editor).find('.number').val();

            $.post("controllers/contracts.class.php", {
                id: id,
                contract_sign_date: contract_sign_date,
                customer_id: customer_id,
                number: number,
                button_click: 'update'
            },
            function(data) {
                if(data !== false) {
                    Notify('Готово');
                    $('#contracts_editor').hide('300');
                }
                else {
                    Notify('Не сохранили');
                }
            });

        });

        //Удаление договоров
        $('.delete').on('click', function(){
            var id = $(editor).find('.id').text();
            $.post("controllers/contracts.class.php", {
                    id: id,
                    button_click: 'delete'
                },
                function(data) {
                    if(data !== false) {
                        Notify('Готово');
                        $('#cars_editor').hide('300');
                    }
                    else {
                        Notify('Запись не была удалена');
                    }
                });

        });

	});
	
	//Добавление договора

	$('#add_contract').on('click', function(){
		$('#contracts_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#contracts_editor').fadeOut('300');
		})
		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#contracts_editor').fadeOut('300');
		    }
		});
		$('#contracts_editor_container').find('input[type=text]').val('');

		editor = $('#contracts_editor_container');

			avalibleCustomers();


		$('.update').on('click', function(){

			

			var id = $(editor).find('.id').text();

			var contract_sign_date = $.datepicker.parseDate('dd.mm.yy', $(editor).find('.contract_sign_date').val())
			var contract_sign_date = (contract_sign_date.valueOf())/1000;

			//var contract_sign_date = $(editor).find('.contract_sign_date').val();
			var customer_id = $(editor).find('.customer_name').find('option:selected').val();
			var number = $(editor).find('.number').val();

            $.post("controllers/contracts.class.php", {
                id: id,
                contract_sign_date: contract_sign_date,
                customer_id: customer_id,
                number: number,
                button_click: 'add'
            },
            function(data) {
                if(data !== false) {
                    Notify('Готово');
                    $('#contracts_editor').hide('300');
                }
                else {
                    Notify('Не сохранили');
                }
            });

        });

	});

	//Редактирование машины

	// $('.cars_line').on('dblclick', function(){
	// 	$('#cars_editor').fadeIn('300');
	// 	$('.mask').on('click', function(){
	// 		$('#cars_editor').fadeOut('300');
	// 	})

	// 	$(document).on('keydown', function(e) {				
	// 	    if (e.keyCode == 27) {
	// 	        $('#cars_editor').fadeOut('300');
	// 	    }
	// 	});

	// 	cars = $(this);
	// 	editor = $('#cars_editor_container');

	// 	$(editor).find('.id').text($(cars).find('.id').text());
	// 	$(editor).find('.name').val($(cars).find('.name').text());
	// 	$(editor).find('.phone').val($(cars).find('.phone').text());
	// 	$(editor).find('.number').val($(cars).find('.number').text());

	// 	$('.update').on('click', function(){
	// 		var id = $(editor).find('.id').text();
	// 		var name = $(editor).find('.name').val();
	// 		var phone = $(editor).find('.phone').attr('id');
	// 		var number = $(editor).find('.number').val();

 //            $.post("controllers/contracts.class.php", {
 //                id: id,
 //                name: name,
 //                phone: phone,
 //                number: number,
 //                button_click: 'update'
 //            },
 //            function(data) {
 //                if(data !== false) {
 //                    Notify('Готово');
 //                    $('#contracts_editor').hide('300');
 //                }
 //                else {
 //                    Notify('Не сохранили');
 //                }
 //            });

 //        });

	// });

	
	//Добавление машины

	$('#add_car').on('click', function(){
		$('#cars_editor').fadeIn('300');
		$('.mask').on('click', function(){
			$('#cars_editor').fadeOut('300');
		})
		$(document).on('keydown', function(e) {				
		    if (e.keyCode == 27) {
		        $('#cars_editor').fadeOut('300');
		    }
		});
		$('#cars_editor_container').find('input[type=text]').val('');

		$('.update').on('click', function(){

			editor = $('#cars_editor_container');

			var id = $(editor).find('.id').text();
			var name = $(editor).find('.name').val();
			var phone = $(editor).find('.phone').val();
			var number = $(editor).find('.number').val();

            $.post("controllers/cars.class.php", {
                id: id,
                name: name,
                phone: phone,
                number: number,
                button_click: 'add'
            },
            function(data) {
                if(data !== false) {
                    Notify('Готово');
                    $('#cars_editor').hide('300');
                }
                else {
                    Notify('Не сохранили');
                }
            });

        });

	});




});