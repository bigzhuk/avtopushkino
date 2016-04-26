<?php
class getCoordinatesFromApi {
    const API_URL = "http://otsledim.ru";
    const API_SCRIPT = "/position.php";
    const USER_ID = 1304;
    const USER_PWD = 321;
    public function __construct($user_id, $pwd){
        $this->user_id = $user_id; // 1304
        $this->pwd = $pwd; // 321
    }

    /**
     * Возвращает информацию об авто в CSV
     * unitID=208620;date=1408050011;ignition=0;lat=55.877016666667;lon=37.702655;speed=0;course=27;sat=13
     * unitID=208702;date=1408050058;ignition=0;lat=55.832821666667;lon=37.580183333333;speed=0.2778;course=258;sat=15
     * @param array $array_units_id -  массив id авто
     * @param timestamp $date - дата на которую нужно узнать положение авто
     * @return string
     */
    public function getCoordinates (array $array_units_id, $date = null){
        $user_id_section = "?userID=".$this->user_id;
        $pwd_section = "&pwd=".$this->pwd;
        $date_section = is_null($date) ? "" : "&dt=".$date;
        $units_id = implode(",", $array_units_id);
        $units_section = "&unitIDs=".$units_id;
        $url = self::API_URL.self::API_SCRIPT.$user_id_section.$pwd_section.$date_section.$units_section;
        $response = file_get_contents($url);
        return $response;
    }

    public function parsCoordinatesInfo($coordinates_csv_response){
        $coordinates_strings_array = explode("\n", $coordinates_csv_response);
        foreach($coordinates_strings_array as $coordinates_line){
            $coordinates_array = explode(";",$coordinates_line);
            foreach($coordinates_array as $coordinates_pair){
                if($coordinates_pair){
                    $coordinates_2_value = explode("=", $coordinates_pair);
                    if($coordinates_2_value[0]=="unitID"){
                        $unitID = $coordinates_2_value[1];
                    }
                    $coordinates[$unitID][$coordinates_2_value[0]] = $coordinates_2_value[1];
                }
            }
        }
        return $coordinates;
    }
}


