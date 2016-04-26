<!DOCTYPE html>
<html>
<head>
    <title>Примеры. Расчет стоимости доставки</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="//api-maps.yandex.ru/2.0/?load=package.standard,package.route&lang=ru-RU" type="text/javascript"></script>
    <script src="//yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        function init() {
            var myMap = new ymaps.Map('map', {
                    center: [55.755768, 37.617671],
                    zoom: 10,
                    type: 'yandex#map',
                    behaviors: ['scrollZoom', 'drag']
                }),
                searchStartPoint = new ymaps.control.SearchControl({
                    useMapBounds: true,
                    noPlacemark: true,
                    noPopup: true,
                    placeholderContent: 'Адрес начальной точки'
                }),
                searchFinishPoint = new ymaps.control.SearchControl({
                    useMapBounds: true,
                    noCentering: true,
                    noPopup: true,
                    noPlacemark: true,
                    placeholderContent: 'Адрес конечной точки'
                }),
                calculator = new DeliveryCalculator(myMap, myMap.getCenter());

            myMap.controls.add(searchStartPoint, { left: 5, top: 260 });
            myMap.controls.add(searchFinishPoint, { left: 5, top: 290 });

            searchStartPoint.events.add('resultselect', function (e) {
                var results = searchStartPoint.getResultsArray(),
                    selected = e.get('resultIndex'),
                    point = results[selected].geometry.getCoordinates();

                calculator.setStartPoint(point);
            });

            searchFinishPoint.events.add('resultselect', function (e) {
                var results = searchFinishPoint.getResultsArray(),
                    selected = e.get('resultIndex'),
                    point = results[selected].geometry.getCoordinates();

                calculator.setFinishPoint(point);
            });
        }

        function DeliveryCalculator(map, finish) {
            this._map = map;
            this._start = null;
            this._route = null;

            map.events.add('click', this._onClick, this);
        }

        var ptp = DeliveryCalculator.prototype;

        ptp._onClick= function (e) {
            if (this._start) {
                this.setFinishPoint(e.get('coordPosition'));
            } else {
                this.setStartPoint(e.get('coordPosition'));
            }
        };

        ptp._onDragEnd = function (e) {
            this.getDirection();
        }

        ptp.getDirection = function () {
            if (this._route) {
                this._map.geoObjects.remove(this._route);
            }

            if (this._start && this._finish) {
                var self = this,
                    start = this._start.geometry.getCoordinates(),
                    finish = this._finish.geometry.getCoordinates();

                ymaps.geocode(start, { results: 1 })
                    .then(function (geocode) {
                        var address = geocode.geoObjects.get(0) &&
                            geocode.geoObjects.get(0).properties.get('balloonContentBody') || '';

                        ymaps.route([start, finish])
                            .then(function (router) {
                                var distance = Math.round(router.getLength() / 1000),
                                    message = '<span>Расстояние: ' + distance + 'км.</span><br/>' +
                                        '<span style="font-weight: bold; font-style: italic">Стоимость доставки: %sр.</span>';

                                self._route = router.getPaths();

                                self._route.options.set({ strokeWidth: 5, strokeColor: '0000ffff', opacity: 0.5 });
                                self._map.geoObjects.add(self._route);
                                self._start.properties.set('balloonContentBody', address + message.replace('%s', self.calculate(distance)));
                                var cost = self.calculate(distance);
                                $('#cost').text(cost+'Р');
                            });
                    });
                self._map.setBounds(self._map.geoObjects.getBounds())
            }
        };

        ptp.setStartPoint = function (position) {
            if(this._start) {
                this._start.geometry.setCoordinates(position);
            }
            else {
                this._start = new ymaps.Placemark(position, { iconContent: 'А' }, { draggable: true });
                this._start.events.add('dragend', this._onDragEnd, this);
                this._map.geoObjects.add(this._start);
            }
            this.getDirection();
        };

        ptp.setFinishPoint = function (position) {
            if(this._finish) {
                this._finish.geometry.setCoordinates(position);
            }
            else {
                this._finish = new ymaps.Placemark(position, { iconContent: 'Б' }, { draggable: true });
                this._finish.events.add('dragend', this._onDragEnd, this);
                this._map.geoObjects.add(this._finish);
            }
            this.getDirection();
        };

        ptp.calculate = function (len) {
            var delivery_tarif = $("#tariff_list").val(),
                minimum_cost = 500;


            return Math.max(len * delivery_tarif, minimum_cost);
        };

        ymaps.ready(init);


    </script>
</head>
<body>
<div id="map" style="width:520px; height:350px;">
</div>
<div id = "tariff">
    <select id = "tariff_list">
        <option value="1000">Тариф за 1000</option>
        <option value="2000">Тариф за 2000</option>
    </select>
</div>

<div id="cost"></div>
</body>
</html>
