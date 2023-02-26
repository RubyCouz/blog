<?php
function upload(){
  
     $picValidation =
             [
                 'content_pic' => [
                     'label' => 'Image File',
                     'rules' => [
                         'uploaded[content_pic]',
                         'is_image[content_pic]',
                         'mime_in[content_pic,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                     ],
                 ],
             ];
                 if (validate($picValidation)) {
             $data = [
                 'errors' => validator->getErrors(),
                 'title' => 'un titre',
             ];
            }
}