<?php
header("content-type: application/json");
$rows = file('Mustard php backend developer - Sheet1.csv');
array_shift($rows);
    $columns = [];
    $months = [];
    $currentMonth = "";
    $currentMonthData = [];
    $dataByMonth = [];
    foreach($rows as $k=>$v){
        $date = str_getcsv($v)[1];
        $dateWithoutTime = str_getcsv($date, ' ')[0];
        $time = str_getcsv($date, ' ')[1];
        $month = intval(str_getcsv($dateWithoutTime, '-')[1]);
        if(!isset($months[$month]))$months[$month] = 1;
        if($currentMonth == "")$currentMonth = $month;
        
        $columns[$k] = [
            "rate" => str_getcsv($v)[0],
            "date" => $date,
            "dateWithoutTime" => $dateWithoutTime,
            "time" => $time,
        ];
        
        if($month == $currentMonth){
            $currentMonthData[] = $columns[$k];
        }
        if(!isset($dataByMonth[$month]))$dataByMonth[$month] = [];
        $dataByMonth[$month][] =$columns[$k];
    }
    $months = array_keys($months);
    $data = [
        "months" => $months,
        "data" => $columns,
        "currentMonth" => $currentMonth,
        "currentMonthData" => $currentMonthData,
        "dataByMonth" => $dataByMonth
    ];
    $monthInWords = [
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December"
    ];
    // echo json_encode($data);
    $json = json_encode($data);
    echo $json;
    // require_once 'chart.html';
    // echo json_encode($allMonths);