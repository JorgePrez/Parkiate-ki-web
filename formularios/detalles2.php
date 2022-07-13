<?php


include('dbcon.php');




/*
   $postData = ['id_servicio'=>"ADE134",
    'id_parqueo'=>"6074G5",
    'nombre_parqueo'=>"Parqueo LA SEXTA",
    'nombre'=>"Jorge Pérez",
    'telefono'=> "56721449",
    'modeloauto'=>"Chevrolet Camaro",
    'no_placa'=>"Placa2",
    'hora_entrada'=> "14:00",
    'hora_desalida'=> "15:00",
    'direccion'=>"6a calle, 2-23, Zona 1, Guatemala, Guatemala",
    'precio'=> "0.00",
    'fecha'=> "16 oct 2021",
    'imagenes'=> "https://res.cloudinary.com/parkiate-ki/image/upload/v1633747330/z061b3ieu1yabzrswu6u.jpg",
    


    ]; */


    $postData = ['id_servicio'=>"AER453",
    'id_parqueo'=>"6074GE",
    'nombre_parqueo'=>"Parqueo LA QUINTAR",
    'nombre'=>"Jorge Péreza",
    'telefono'=> "5672144D",
    'modeloauto'=>"Chevrolet Corvete",
    'no_placa'=>"Placa3q",
    'hora_entrada'=> "16:00",
    'hora_desalida'=> "17:00",
    'direccion'=>"6a calle, 2-24 Zona 15 Guatemala, Guatemala",
    'precio'=> "10.00",
    'fecha'=> "17 oct 2021",
    'imagenes'=> "https://res.cloudinary.com/parkiate-ki/image/upload/v1633747330/z061b3ieu1yabzrswu6u.jpg",
    


    ];


$ref_tabla="contacts";

$postRef_result = $database->getReference('servicios')->push($postData);

if($postRef_result){

    echo "momoland_thumbs_up";
}
else{

    echo "somi - dumb dumb";

}



?>
