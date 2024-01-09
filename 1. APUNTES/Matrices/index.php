<?php 

$mat = [
    '100A' => ['1A' => 1, '2B' => 2, '3C' => 3],
    [4,5,6],
    12
];

$curso = [ 'DAW2' => [
                'cod' => 206,
                'desc' => 'CFGS DAW'
            ],
            'DAM2' => [
                'cod' => 209,
                'desc' => 'CFGS DAM'
            ],
            'SMR2' => [12,4,"loquesea"]
        ];
echo $curso['SMR2'][1];
$curso['DAM2']['cod'] = 212;
$curso['DAW2']['cod'] = 108;
$curso['ASIR2']['cod'] = 205;
$curso['ASIR2']['desc'] = "CFGS ASIR";
$curso['ASIR2']['taller'] = 3476;
// echo $curso['DAM2']['desc'];
foreach ($curso as $key => $value) {
    echo $key.' => ';
    print_r($value);
    echo '<br>';
    foreach ($value as $key2 => $ciclo) {
        echo $key2. ' => '.$ciclo.' <br> ';
    }
}
// echo $mat[0][1];
// $mat[1][1] = "Cambiado";
// // echo $mat[2];
// // echo $mat[1][1];
// // unset($mat[0]);
// // $mat[0] = "Otra cosa";

// foreach ($mat as $key => $value) {
//     echo $key.' -> ';
//     if (is_array($value)){
//         // print_r($value);
//         foreach ($value as $key2 => $v2) {
//             echo $key2. ' => ' .$v2.' ';
//         }
//     }
//     else {
//         echo $value;
//     }
//     echo '<br>';
// }

$ve = [];
$ve[0]=12;
$ve[27] = 14;
$ve[] = "kldsfj";
print_r($ve);