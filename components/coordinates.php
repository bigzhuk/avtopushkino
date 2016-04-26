<?php
require_once("../admin/config.php");
require_once("../classes/getCoordinates.class.php");
require_once(BASE_PATH.'/admin/models/cars.class.php');
require_once(BASE_PATH.'/admin/controllers/datachecker.class.php');

// добавить проверку на наличие session_id, иначе - возвращать null. Ибо иначе не секурно.
//Добавил
if(!isset($_SESSION)){
    session_start();
};

if(isset($_SESSION['car_id']) && !empty($_SESSION['car_id']) && isset($_SESSION['user_id'])) {
    $car_ids = DataChecker::checkFloat($_SESSION['car_id']);
    if(empty($car_ids)) {
        return null;
    }

        $cars_model = new CarsModel();
        $car_ids = explode(",", $car_ids);
        $gps_ids = array();
        foreach ($car_ids as $car_id) {
            $cars_data = $cars_model->getTableDataById(
                $car_id
            );
            $gps_ids[] = $cars_data[0]['gps_ids'];
        }


    $coordinates = new getCoordinatesFromApi(getCoordinatesFromApi::USER_ID, getCoordinatesFromApi::USER_PWD); // todo получать из конфига
    $coordinates_csv_response = $coordinates->getCoordinates($gps_ids);
    $coordinates_array = $coordinates->parsCoordinatesInfo($coordinates_csv_response);
    echo json_encode($coordinates_array);
}