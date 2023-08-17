<?php 

function getCorreoRules(){

return array(
    array(
        'field' => 'nombre',
        'label' => 'nombre',
        'rules' => 'required|trim',
        'errors' => array(
            'required' => 'El %s es requerido.',
        ),
    ),
    array(
            'field' => 'correo',
            'label' => 'correo',
            'rules' => 'required|valid_email',
            'errors' => array(
                'required' => 'El %s es requerido.',
            ),
    ),
    array(
        'field' => 'telefono',
        'label' => 'telefono',
        'rules' => 'required|trim',
        'errors' => array(
            'required' => 'El %s es requerido.',
        ),
    ),
    array(
        'field' => 'mensaje',
        'label' => 'mensaje',
        'rules' => 'required|trim',
        'errors' => array(
            'required' => 'El %s es requerido.',
        ),
    ),
);

}