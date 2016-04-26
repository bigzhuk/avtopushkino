ymaps.route([
                    // Список точек, которые необходимо посетить
                    [start], [end]], {
                    // Опции маршрутизатора
                    mapStateAutoApply: true // автоматически позиционировать карту
                }).then(function (router) {
                    route && myMap.geoObjects.remove(route);
                    route = router;
                    //myMap.geoObjects.add(route);
                    //var objectsInsideCircle = objects.searchInside(circle);
                    //console.log(route);

                    var distance = Math.round(router.getLength() / 1000);

                    $("#distance_result").text('Длина маршрута: '+ distance +' км');

                    var tarif = 10;
                    var round = 100; // сумма к округлению
                    var luft = 20; // процент погрешности 20 это (-10% + 10%)

                    var km1 = 0;
                    var km2 = 0;
                    var km = 0;
                    var tarif1 = 0;
                    var tarif2 = 0;
                    var tarif = 0;


                    mass = $('#distance_mass').val();
                    size = $('#distance_size').val();


                    console.log(mass);
                    console.log(size);

                    switch (mass) {
                        case '1':
                        tarif1 = 2350;
                        km1 = 15 * 2;
                        break

                        case '2':
                        tarif1 = 3000;
                        km1 = 15 * 2;
                        break

                        case '3':
                        tarif1 = 4200;
                        km1 = 17 * 2;
                        break

                        case '4':
                        tarif1 = 6000;
                        km1 = 21 * 2;
                        break

                        case '5':
                        tarif1 = 8000;
                        km1 = 25 * 2;
                        break

                        case '6':
                        tarif1 = 10400;
                        km1 = 40;
                        break
                    }

                    switch (size) {
                        case '1':
                        tarif2 = 2350;
                        km2 = 15 * 2;
                        break

                        case '2':
                        tarif2 = 2500;
                        km2 = 15 * 2;
                        break

                        case '3':
                        tarif2 = 3000;
                        km2 = 15 * 2;
                        break

                        case '4':
                        tarif2 = 4200;
                        km2 = 17 * 2;
                        break

                        case '5':
                        tarif2 = 6000;
                        km2 = 21 * 2;
                        break

                        case '6':
                        tarif2 = 8000;
                        km2 = 25 * 2;
                        break

                        case '7':
                        tarif2 = 10400;
                        km2 = 40;
                        break
                    }

                    

                    // size = parseInt($('#distance_size').val());

                    // if(size > 0){ tarif2 = 2350; km2 = 15 * 2;}
                    // if(size > 7){ tarif2 = 2500; km2 = 15 * 2;}
                    // if(size > 10){ tarif2 = 3000; km2 = 15 * 2;}
                    // if(size > 14){ tarif2 = 4200; km2 = 17 * 2;}
                    // if(size > 18){ tarif2 = 6000; km2 = 21 * 2;}
                    // if(size > 30){ tarif2 = 8000; km2 = 25 * 2;}
                    // if(size > 45){ tarif2 = 10400; km2 = 40;}

                    if (tarif1 => tarif2 && tarif1 > 0){
                        tarif = tarif1;
                    }

                    if (tarif1 < tarif2 && tarif2 > 0){
                        tarif = tarif2;
                    }

                    if (km1 => km2 && km1 > 0){
                        km = km1;
                    }

                    if (km1 < km2 && km2 > 0){
                        km = km2;
                    }

                    console.log('km1: ' + km1);
                    console.log('km2: ' + km2);
                    console.log('km:' + km);
                    console.log('tarif1: ' + tarif1);
                    console.log('tarif2: ' + tarif2);
                    console.log('tarif: ' + tarif);
                    console.log('distance: ' + distance);
                

                    if (distance > 70){
                            
                        alert('Тарифы: ' + tarif1 + ' <> ' + tarif2 + ' (' + tarif + ')' + '  \nКилометраж: ' + km1 + ' <> ' + km2 + ' (' + km + ') \nДистанция: ' + distance + '\nИтого: ' + tarif + ' + (' + km + ' * ' + distance +') = '+ (tarif + (km * distance)));
                        var price = (tarif + (km * distance));
                    } else {

                        alert('Тарифы: ' + tarif1 + ' <> ' + tarif2 + ' (' + tarif + ')' + '  \nКилометраж не учитываем!');
                        var price = tarif;
                    }

                    //var price = tarif;

                    //price = 1999;

                    var price_min = (price)/100*(100-luft/2);
                    var price_max = (price)/100*(100+luft/2);

                    price_min = Math.round(price_min / round) * round;
                    price_max = Math.round(price_max / round) * round;


                    $("#price_result").text('Стоимость: '+ price_min + ' ~ ' + price_max + ' руб.');
                    $("#distanсe_result").text('Расстояние: '+ distance + ' км');


                }, function (error) {

                    //alert("Возникла ошибка: " + error.message);

                });