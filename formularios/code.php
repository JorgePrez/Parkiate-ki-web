

<?php

include('dbcon.php');



$first_name = "Chaeryoungss";
$last_name = "Lee";
$email = "chaeryoung@gmail.com";


$phone = "32453123";

$postData = ['fname'=>$first_name,
    'lname'=>$last_name,
    'email'=>$email,
    'phone'=> $phone,
];

$ref_tabla="contacts";

$postRef_result = $database->getReference('contacts')->push($postData);

if($postRef_result){

    echo "momoland_thumbs_up";
}
else{

    echo "vale madres";

}


?>