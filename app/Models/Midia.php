<?php

namespace App\Models;

use App\Exceptions\MaxSizeException;
use App\Exceptions\InvalidFileTypeException;
use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Imagick;

class Midia extends Model
{
    use HasFactory;
    protected $table = 'midia';

    const MAX_UPLOAD_SIZE_KB = 1000;

    protected $fillable = [
        'url',
        'name',
        'mime',
        'owner_id'
    ];

    public static function getValidator($required = false){
        $validator_string = "file|max:".Midia::MAX_UPLOAD_SIZE_KB."|mimes:jpg,bmp,png,jpeg";
        if($required){
            $validator_string = $validator_string."|required";
        }
        return $validator_string;
    }
    public static function upload(\Illuminate\Http\UploadedFile $file){
        Midia::validadeMimeType($file, ['jpeg', 'jpg', 'bmp', 'png']);
    
        Midia::validateSize($file);
        
        $compressed_file = Midia::compressImage($file);



        $file_name = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        try {
            DB::beginTransaction();

            $midia = Midia::create([
                'name' => $file_name,
                'mime' => $file->getClientMimeType(),
                'owner_id' => Usuario::current()->id,
                'url' => Midia::generateURL(),
            ]);
    
            $compressed_file->storeAs('images', $midia->url);
            DB::commit();
            
            return $midia;
    
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }

    public static function generateURL(){
        $url = Str::random(100);
        while(Midia::where('url', $url)->exists()){
            $url = Str::random(100);
        }
        return $url;
    }
    
    /**
     * Validates mime type
     *
     * @throws  InvalidFileTypeException 
     * @param \Illuminate\Http\UploadedFile $file
     * @param array $mimes_allowed
     * @return boolean
     */
    public static function validadeMimeType(\Illuminate\Http\UploadedFile $file, array $mimes_allowed = []){
        if (in_array($file->getClientMimeType(), $mimes_allowed)) {
            throw new InvalidFileTypeException($file, $mimes_allowed);
        }
        return true;
    }

        /**
     * Validates file size
     *
     * @throws  MaxSizeException 
     * @param \Illuminate\Http\UploadedFile $file
     * @param int $size_in_kb
     * @return boolean
     */
    public static function validateSize(\Illuminate\Http\UploadedFile $file, int $size_in_kb = Midia::MAX_UPLOAD_SIZE_KB){
        if (Helpers::to_KB($file->getSize()) > $size_in_kb) {
            throw new MaxSizeException($file, $size_in_kb);
        }
        return true;
    }

    public static function compressImage(\Illuminate\Http\UploadedFile $file, $quality = 80){
        $file_path = $file->path();
        $file_name = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);

        $image = new Imagick($file_path);
        unlink($file_path);
        clearstatcache($file_path);
        
        $profiles = $image->getImageProfiles("icc", true);
        $image->stripImage();

        if(!empty($profiles)) {
           $image->profileImage("icc", $profiles['icc']);
        }

        $image->setFormat("jpg");
        $image->setImageCompression(Imagick::COMPRESSION_JPEG);
        $image->setImageCompressionQuality($quality);

        $image->writeImage($file_path);
        $file =  new \Illuminate\Http\UploadedFile( $file_path, $file_name.'.jpg', 'image/jpeg',null,false);
        return $file;
    }


}
