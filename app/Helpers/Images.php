<?php
namespace App\Helpers;

class Images {
    
    public function Validated($file) {
        
        $payload = ['error' => '', 'valid' => true];
        if (!$file['error'] === UPLOAD_ERR_OK) {
            return ['error' => 'La imagen no se subio correctamente', 'valid' => false];
        }

        if (!$file['size'] > (800 * 1024)) {
            return ['error' => 'La imagen es muy grande', 'valid' => false];
        }
        $mimeType = mime_content_type($file['tmp_name']);
        if ($mimeType !== 'image/jpeg' && $mimeType !== 'image/png') {
            return ['error' => 'La imagen no cumple con el formato permitido', 'valid' => false];
        }
        if(in_array(pathinfo(!$file['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
            return ['error' => 'Solo se permiten archivos con extensipon jpg, jpeg, png', 'valid' => false];
            
        }
        if(getimagesize($file['tmp_name']) == false) {
            return ['error' => 'La imagen no es valida', 'valid' => false];
        }
        return $payload;
    }

    public function UploadFile($file, $img_path = '../../../assets/img/contacts/') {
        $img_name = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $img_temp = $file['tmp_name'];
        if (file_exists($img_path.$img_name )) {
            var_dump(file_exists($img_path.$img_name));
            var_dump($img_path.$img_name);
            return ['error' => 'Ya existe la imagen con el mismo nombre', 'valid' => false];
        }else {
            if(!is_uploaded_file($img_temp)) {
                return ['error' => 'No se pudo subir la imagen', 'valid' => false];
            }else {
                if(!move_uploaded_file($img_temp ,$img_path.$img_name)) {
                    return ['error' => 'No se pudo mover la imagen', 'valid' => false];
                }
            }
        }

        return ['error' => '', 'valid' => true, 'img' => $img_name];
    }


}


?>

