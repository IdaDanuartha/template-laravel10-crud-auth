<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;

class UploadFile 
{
  public function uploadSingleFile($file, $path): string
  {    
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path("uploads/$path"), $filename);

    return $filename;
  }
  
  public function deleteExistFile($path)
  {    
    if(File::exists("uploads/$path") ) {
      File::delete("uploads/$path");
    }
  }
}