<?php

declare(strict_types=1);

//What makes a South african ID a South African ID
// YY MM DD SSSS C A Z
// YY - Year of bith
// MM - Month of birth
// DD - Day of birth
// SSSS - Gender -> Females 0000-4999 & Males 5000-9999
// C - citizenship -> Born SA citizen -> 0, Permanent Resident -> 1 
// A - ? (8 or 9)
// Z - checksum digit of Luhn algorithm (But with a south african twist)
// If the sum of the digits is divisible by 10, it passes

$br ='<br>';

$year = rand(1, 99);
$month = rand(1, 12);
$day;
$gender = rand(1, 9999);
$citezenship = rand(0,1);
$randomNumber = rand(0, 9);
$finalDigit;

if (7 <= $month && 0 === $month % 2) {
    if ( 0 === $year % 4 && 2 === $month) {
        $day = rand(1,29);
    }
    else if ( 0 !== $year % 4 && 2 === $month) {
        $day = rand(1, 28);
    }
    else {
        $day = rand(1,30);
    }
} else if (8 >= $month && 1 === $month % 2) {
    $day = rand(1,30);
} else {
    $day = rand(1,31);
}

$adjustedYear   = sprintf("%1$02d", $year);
$adjustedMonth  = sprintf("%1$02d", $month);
$adjustedDay    = sprintf("%1$02d", $day);
$adjustedGender = sprintf("%1$04d", $gender);

$id = $adjustedYear . $adjustedMonth . $adjustedDay . $adjustedGender . $citezenship . $randomNumber;

$checksumArray = str_split($id);

for ($n = 0; $n < count($checksumArray); $n++) {
    if($n % 2 === 1) {
        $checksumArray[$n] = $checksumArray[$n] * 2;
    }    
    if ($checksumArray[$n] > 9) {
        $checksumArray[$n] = $checksumArray[$n] - 9;
    }
}

$sum = ($checksumArray[0] + $checksumArray[1] + $checksumArray[2] + $checksumArray[3] + $checksumArray[4] + $checksumArray[5] + $checksumArray[6] + $checksumArray[7] + $checksumArray[8] + $checksumArray[9] + $checksumArray[10] + $checksumArray[11]);
$finalDigit = 10 - (($checksumArray[0] + $checksumArray[1] + $checksumArray[2] + $checksumArray[3] + $checksumArray[4] + $checksumArray[5] + $checksumArray[6] + $checksumArray[7] + $checksumArray[8] + $checksumArray[9] + $checksumArray[10] + $checksumArray[11]) % 10);
if ($finalDigit === 10) {
    $finalDigit = 0;
}
$validID = $id . $finalDigit;

echo $validID;
