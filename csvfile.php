<?php
//The code read multiple data and compare both data and also save it as new csv file

$handle = fopen("others.csv", "r");

// Now check file 2 for matches
$handle = fopen("new.csv", "r");

// Grab the header row from the file first
$header = fgetcsv($handle, 1000);

echo "<pre>Header data\n";
print_r($header);
header("content-type: text/plain");
$array = [];
$i = 0;
$csv1 = "new.csv";
$csv2 = "others.csv";

// Load file 1 into an array
// Skip row 1
if (($handle = fopen($csv1, "r")) !== FALSE){
    while (($data = fgetcsv($handle)) !== FALSE){
        if($i == 0){$i++; continue;}
        $array[] = $data;
        $i++;
    }
    fclose($handle);
}

$i = 0;
// Load file 2 into the array if the values don't exist
// Skip row 1


if (($handle = fopen($csv2, "r")) !== FALSE){
    while (($data = fgetcsv($handle)) !== FALSE){
        if($i == 0){$i++; continue;}
        $inarray = false;
        foreach($array as $itm){
            if(in_array($data[1], $itm)){
                $inarray = true;
                break;
            }
        }
        if(!$inarray){
            $array[] = $data;
        }
        $i++;
    }
    fclose($handle);

}


print_r($array);
?>
