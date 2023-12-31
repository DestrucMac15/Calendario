<?php
    class Calendar_model extends CI_Model{

<<<<<<< HEAD
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
=======
        public function get_allCalendar($token,$start_date,$end_date,$desarrollo_id='',$vendedor_id=''){
        
            $start_date = "\'".$start_date."\'";
            $end_date = "\'".$end_date."\'";
            
            if($desarrollo_id != Null && $vendedor_id != Null){
              $filtro = "(Fecha between $start_date and $end_date) and (Desarrollos.id = $desarrollo_id and Vendedores = $vendedor_id)";
            }else if($desarrollo_id != Null){
              $filtro = "Fecha between $start_date and $end_date and Desarrollos.id = $desarrollo_id";
            }else if($vendedor_id != Null){
              $filtro = "Fecha between $start_date and $end_date and Vendedores = $vendedor_id";
            }else{
              $filtro = "Fecha between $start_date and $end_date";
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/coql',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{"select_query":"select Fecha,Descripcion,id,Vendedores,Vendedores.first_name,Vendedores.last_name as vend,Desarrollos.Name,Desarrollos.id,Tipo from Calendario where '.$filtro.' order by Fecha asc"}',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Zoho-oauthtoken '.$token,
                'Content-Type: application/json'
              ),
>>>>>>> Dev
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