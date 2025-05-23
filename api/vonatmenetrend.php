<h1>Távolság</h1>
    <form>
        Indulas:<input name="inthely"><br>
        Érlezes:<input name="erthely"><br>
        <input type="submit" value="Távolság számítás">
    </form>

    <hr>

    <?php
		$hely = urlencode($_GET['inthely']) ;
		$url  = "https://nominatim.openstreetmap.org/search?q=$hely&format=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36");

		$json = curl_exec($ch);

		curl_close($ch);

		$adat = json_decode( $json ) ;

		//print "<pre>"; print_r($adat); print "</pre>";

        $lat1 = $adat[0]->lat;
        $lon1 = $adat[0]->lon;
        $hely1 = $adat[0]->display_name;
        print "$lat1 , $lon1 : $hely1";

        print"<br>";


        $hely = urlencode($_GET['erthely']) ;
		$url  = "https://nominatim.openstreetmap.org/search?q=$hely&format=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36");

		$json = curl_exec($ch);

		curl_close($ch);

		$adat = json_decode( $json ) ;

		//print "<pre>"; print_r($adat); print "</pre>";

        $lat2 = $adat[0]->lat;
        $lon2 = $adat[0]->lon;
        $hely2 = $adat[0]->display_name;
        print "$lat2 , $lon2 : $hely2";




        $dlat = abs($lat1 - $lan2);
        $dlon = abs($lon1 - $lon2);
        $a = pow(sin($dlat/2),2) + cos($dlat1)*cos($dlat2)*pow(sin($dlon/2) ,2);
        $c = 2*atan2(sqrt($a) , sqrt(1-$a));
        $d = 6371 * $c;

        print "A két hely távolsága Légvonalban: $d km";