'use strct';

const boton_foto= document.querySelector('#btn-foto');

const imagen= document.querySelector('#user-photo');


let widget_cloudinary= cloudinary.createUploadWidget({
    cloudName: 'parkite-ki',
    uploadPreset: 'zljya79r',
    api_key: '794241658481217',
    api_secret:'qRQnXnrfL-xqXug4sfFlMgGfeAY'  
},
 (err,result)=>{

    if(!err && result && result.event === 'success'){
        console.log('imagen subida con exito',result.info);
        imagen.src= result.info.secure_url;
    }

 }
);


boton_foto.addEventListener('click',()=>{
    widget_cloudinary.open();
} , false );