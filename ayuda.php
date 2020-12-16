<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    <script src="js/jQuery.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/all.css">
    <title>Contáctanos</title>
</head>
<body>
    <div class="header">
        <div class="header-img">
            <a href="index.html"><img src="img/Logo.png" alt="Logo Proserbin"></a>
        </div>
        <div class="header-con">
            <div><a href=""><i class="fab fa-whatsapp-square"></i><label>0979376851</label></a></div>
            <div><a href=""><i class="fas fa-envelope-square"></i><label>Mail@gmail.com</label></a></div>
           
        </div>
    </div>

    <div class="nav">
        <div class="nav-int">
            <ul >
                <li><a href="">Tienda</a></li>
                <li><a href="index.html">Nosotros</a></li>
                <li><a href="contacto.php">Contáctanos</a></li>
                <li><a href="ayuda.php">Ayuda</a></li>
            </ul>
        </div>
    </div>
<!--------------------------------------------------------------------Contenido---------------------------------------------------------------------->
    <div class="contenido">
        <?php

    //Llamamos a la función, y ella hace todo :)
    echo write_visita ();
    echo get_client_ip();
    echo ip_info();
    //función que escribe la IP del cliente en un archivo de texto    
    function write_visita (){

        //Indicar ruta de archivo válida
        $archivo="ruta/archivo/visitas.txt";

        //Si que quiere ignorar la propia IP escribirla aquí, esto se podría automatizar
        $ip="mi.ip.";
        $new_ip=get_client_ip();

        if ($new_ip!==$ip){
            $now = new DateTime();

       //Distinguir el tipo de petición, 
       // tiene importancia en mi contexto pero no es obligatorio

        }
    }


    //Obtiene la IP del cliente
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    //Obtiene la info de la IP del cliente desde geoplugin

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

?>


    </div>
<!------------------------------------------------------------------------------------------------------------------------------------------>
    <div class="footer">
        <div class="footer-int">

            <div class="columna1">
                <div align="center">Contacto:</div> <br>
                <p> 
                    Bartolomé Hernandez Oe1-89 y, Quito 170120 <br>
                    Telf: (02) 344-3852 <br>
                    jrodriguez@proserbin.com <br>
                    dario.rodriguez@proserbin.com <br>
                </p>
                <br>
                <div align="center">Quito-Ecuador</div>
            </div>
            
            
            <div class="columna1">
                <div align="center">Redes Sociales:</div> <br>
                <div align="center" class="redes">
                    <a href=""><i class="fab fa-facebook"></i></a> 
                    <a href=""><i class="fab fa-skype"></i></a>
                </div>
            </div>

            <div class="columna1">
                <div align="center">Encuentranos aquí:</div><br>
                <div align="center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8133503735053!2d-78.47239098474233!3d-0.09043529993401404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d58f5de11b14f1%3A0xbf6841ae4f261e6d!2sPROSERBIN!5e0!3m2!1ses-419!2sec!4v1608127897534!5m2!1ses-419!2sec" width="250" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div align="center"><label>2020 ©PROSERBIN Todos los derechos reservados </label></div>
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>