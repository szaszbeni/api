<?php
        $fu   = fopen( "https://api.infojegyzet.hu/idojaras/" , "r" ) ;
        $json = "";
        while (!feof($fu))  $json .= fread($fu, 1024);
        fclose( $fu ) ;
        $adat = json_decode( $json ) ;
$orszag=($adat->location->country);
$bp=($adat->location->region);
for ($i=0; $i < 3; $i++) { 
    $ido=date("Y-m-d",strtotime("+$i day"));
    $dayOfWeek = date("l", strtotime($ido));
    echo $dayOfWeek; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>idojaras</title>
    <style>
    #table, tr, td{
        color: white;
        background-color: purple;
    }
</style>
</head>
<body>
<table id='ido'>
<tr>
<td><?php echo $orszag ?></td>
<td><?php echo $bp ?></td>
</tr>
</table>
<?php
    for ($i=0; $i <count($adat->forecast->forecastday[0]->hour) ; $i++) { 
        print"<div>
        <table>
            <tr>
                <td>Idő</td>
                <td>".$i.":00</td>
            </tr>
            <tr>
                <td>várható hőmérséklet</td>
                <td>".$adat->forecast->forecastday[0]->hour[$i]->temp_c."°</td>
            </tr>
            <tr>
                <td>felhőtakaró aránya</td>
                <td>".$adat->forecast->forecastday[0]->hour[$i]->cloud."%</td>
            </tr>
            <tr>
                <td>csapadék valószínűsége</td>
                <td>".$adat->forecast->forecastday[0]->hour[$i]->chance_of_rain."%</td>
            </tr>
            <tr>
                <td>szélsebesség</td>
                <td>".$adat->forecast->forecastday[0]->hour[$i]->wind_kph."kph</td>
            </tr>
        </table>
        </div>";
    }
    ?>

</body>
</html>