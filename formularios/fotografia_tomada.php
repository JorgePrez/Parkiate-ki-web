<?php





   $url = 'http://192.168.1.15/picture';

//   $received = file_get_contents($url);
$img = 'flower2.jpeg';
file_put_contents($img, file_get_contents($url));

   






















//$img = date("d.m.Y-H:i:s") . ".jpeg";




// TODO: insert your settings !
$cloudinary_upload_preset = "is-sales-preset";
$cloudinary_url = "cloudinary://794241658481217:qRQnXnrfL-xqXug4sfFlMgGfeAY@parkiate-ki";
//CLOUDINARY_URL=cloudinary://794241658481217:qRQnXnrfL-xqXug4sfFlMgGfeAY@parkiate-ki


// Send image to Cloudinary API
$headers = array("Content-Type:multipart/form-data");
$folder = "fotosentradas";
$post_fields = array("file" => new CURLFile($img), "upload_preset" => $cloudinary_upload_preset , "folder" => $folder);

$ch = curl_init();
$options = array(
    CURLOPT_URL => $cloudinary_url,
    CURLOPT_HEADER => false,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => $headers,  
    CURLOPT_POSTFIELDS => $post_fields,
    CURLOPT_RETURNTRANSFER => true
);

curl_setopt_array($ch, $options);
$response = curl_exec($ch);

curl_close($ch);

print_r($response);
echo $response;

// Get response from Cloudinary - image URL
$json = json_decode($response);
$image_public_url = $json->url;





  

?>
