<?php
    class Calendar_model extends CI_Model{

        public function get_allCalendar($token){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Calendario',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Zoho-oauthtoken '.$token
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);
        }

        public function create_calendar($token,$data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Calendario',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => array(
                'Authorization: Zoho-oauthtoken '.$token,
                'Content-Type: application/json'
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);
        }

        public function upd_calendar($token,$data,$id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Calendario/'.$id,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'PUT',
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => array(
                'Authorization: Zoho-oauthtoken '.$token,
                'Content-Type: application/json'
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);           
        }
    }