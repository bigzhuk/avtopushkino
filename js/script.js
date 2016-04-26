// Приложения, аякс

								// Яндекс карта на главной
	var myMap,
	    bigMap = false;
	function init () {
	    myMap = new ymaps.Map('map', {
	        center: [55.755768, 37.617671],
	        zoom: 10,
            controls: []
	    }, {});
	    var actualProvider = new ymaps.traffic.provider.Actual({}, { infoLayerShown: true });
	    actualProvider.setMap(myMap);
	    $('#toggler').click(toggle);
	}

	function toggle () {
	    bigMap = !bigMap;
	    if (bigMap) {
	        $('#map').removeClass('smallMap');
	    } else {
	        $('#map').addClass('smallMap');
	    }
	    if ($('#checkbox').attr('checked')) {
	        myMap.container.fitToViewport();
	    }
	}
	


