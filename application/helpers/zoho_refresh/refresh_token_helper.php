<?php
    //Comprobar token
    function comprobarToken(){
        $str  = file_get_contents('./assets/js/data_token.json');
        $json = json_decode($str,true);

        if($json['created_at']+$json['expires_in'] < time())
        {
            $test = refresh();
        }

        $token = (array) json_decode(file_get_contents('./assets/js/data_token.json'));

        return $token['access_token'];
        
    }
    function refresh(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://accounts.zoho.com/oauth/v2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('client_id' => '1000.P8CRFLB5JTI8EGV74OTBGD49MUJEDI','client_secret' => 'c2b00f7a02b8b581568c30b808857075f8f2542cbc','refresh_token' => '1000.f83ec41bf51b260eeaf98e10eed24fc9.076b8da6c6d351525c9cdd487badae50','grant_type' => 'refresh_token'),
            CURLOPT_HTTPHEADER => array(
                'Cookie: _zcsr_tmp=4c17d725-e5b0-4878-a54c-ad55780c9c6a; b266a5bf57=a711b6da0e6cbadb5e254290f114a026; iamcsr=4c17d725-e5b0-4878-a54c-ad55780c9c6a'
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response, true);
        curl_close($curl);

        if (!file_exists('./assets/js/data_token.json')) {
            touch('./assets/js/data_token.json');
        }
        $response["created_at"] = time();
        if (!is_writable('./assets/js/data_token.json')) {
           die("Error al escribir en el archivo data_token.json");
        }
 
        if (file_put_contents('./assets/js/data_token.json', json_encode($response,JSON_PRETTY_PRINT)) === false) {
           die("Error al guardar la respuesta en el archivo data_token.json");
        }
        return $response;
    }