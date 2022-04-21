<?php
if (!isset($_GET['rows']) || !isset($_GET['cols'])) return 'Please input row/col size';
else if ($_GET['rows'] < 1 || $_GET['cols'] < 1) return 'Please input a valid row/col count';

$rows = $_GET['rows'];
$cols = $_GET['cols'];

$row_arr = range(0, $rows-1);
$col_arr = range(0, $cols-1);
$rand_lights = array();

if($rows*$cols > 5){
    while(count($rand_lights) < 5){
        $x = rand(0, $rows-1);
        $y = rand(0, $cols-1);
        // echo $x . ', ' . $y . '<br>';
        if(in_array(array($x, $y), $rand_lights) === false){
            // echo 'added<br>';
            $rand_lights[] = array($x, $y);
        }
    }
}
else{
    for($i = 0; $i < $rows; $i++){
        for($j = 0; $j < $cols; $j++){
            $rand_lights[] = array($i, $j);
        }
    }
}

// print_r($rand_lights);


$board = "<table class='mx-auto mt-5'><tbody>";
$buttonsize = '5rem';

for ($i = 0; $i < $rows; $i++) {
    $board = $board . "<tr>";
    for ($j = 0; $j < $cols; $j++) {
        if(in_array(array($i, $j), $rand_lights)){
            $board = $board . "<td>
                                <button class='w-auto btn btn-warning' onclick='toggleArea(" . $i . ", " . $j . ")' id='btn" . $i . "_" . $j . "'>
                                </button>
                            </td>";
        }
        else{
            $board = $board . "<td>
                                <button class='w-auto btn' onclick='toggleArea(" . $i . ", " . $j . ")' id='btn" . $i . "_" . $j . "'>
                                </button>
                            </td>";
        }
        
    }
    $board = $board . "</tr>";
}

echo $board . "</tbody></table>";

return json_encode($rand_lights); // return 