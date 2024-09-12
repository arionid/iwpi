<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


if( !function_exists("replaceLastVowel"))
{
    function replaceLastVowel(string $string, string $chars = '*', int $length = 4, int $init = 6): string  {
        // Define the vowels
        $vowels = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];

        // Split the input into individual words
        $words = explode(' ', $string);

        // Iterate over each word
        foreach ($words as &$word) {
            // Find the position of the last vowel
            $lastVowelPos = -1;
            for ($i = strlen($word) - 1; $i >= 0; $i--) {
                if (in_array($word[$i], $vowels)) {
                    $lastVowelPos = $i;
                    break;
                }
            }

            // If a vowel was found, replace it with '*'
            if ($lastVowelPos !== -1) {
                $word[$lastVowelPos] = $chars;
            }
        }

        // Return the modified string by joining the words back
        return implode(' ', $words);
    }
}

if( !function_exists("hide_string"))
{
    function hide_string(string $string, string $chars = '*', int $length = 4, int $init = 6): string {
    $stLeng = strlen($string);
    $roun = round($stLeng * (80 / 100));
        $getString  = $string;  // String yang akan disensor.
        $getChars   = $chars;   // Karakter yang akan digunakan.
        $getLength  = round($stLeng * (40 / 100));  // Panjang karakter sensor.
        $getInit    = $stLeng - $roun;    // Jumlah default karakter sensor.
        return substr_replace($getString, str_repeat($getChars, (strlen($getString) - $getLength)), $getInit, (strlen($getString) - $getLength));
    }
}

if( !function_exists("fNoKTA"))
{
    function fNoKTA($village_id, $type = 'kehormatan'){
        $counter = 1;
        if($type ==  'kehormatan'){
                $checking = \App\Models\PendaftaranAnggotaKehormatan::whereNotNull('no_kta_kehormatan')
                ->where([['no_kta_kehormatan', 'LIKE', $village_id."%"]])
                ->orderBy('no_kta_kehormatan', 'DESC')->first();
                if($checking){
                    try {
                        $explode = \explode('.', $checking->no_kta_kehormatan);
                        $counter = (int) end($explode) + 1;
                    } catch (\Throwable $th) {  }
                }
        }
        return $village_id.".B.".sprintf('%05d', $counter);
    }
}

if(! function_exists('fUrlGenerator')){
    function fUrlGenerator($user = '0')
    {
        return "iwpi-".bin2hex(random_bytes(5)).time().'c4llme62816554176Y'.$user;
    }
}
if(! function_exists('fWaNumber')){
    function fWaNumber($phone)
    {
        try {
            $noWA = str_replace('+','',$phone);

            if(!empty($noWA) && $noWA[0] == 0 ){
                $noWA = substr_replace($noWA, "62", 0, 1);
            }elseif(!empty($noWA) && $noWA[0] == 8 ){
                $noWA = '62'.$noWA;
            }
        } catch (\Throwable $th) {
            $noWA = $phone;
        }

        return $noWA;
    }
}

if( !function_exists("saveAndResizeImage") )
{
    function saveAndResizeImage( $image, $type, $dir_name, $width, $height, $old_image = null )
    {
        if( isset( $old_image) )
            unlinkFile( $old_image );

        $dir        =   'images/' . $type . '/' . $dir_name;

        // Create directory first
        if(!File::exists( public_path( $dir ) ))
        {
            Storage::disk('public')->makeDirectory( $dir, 0755, true, true );
        }

        $file_name  =   uniqid() . '_' . $width . 'x' . $height . '.' . $image->getClientOriginalExtension();
        $str_path   =   $dir . '/' . $file_name;
        $path       =   public_path( 'uploads/' . $str_path );


        // Create new Canvas and insert the image
        $img        =   Image::make( $image )->resize( $width, $height, function($constraint)
                        {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });

        $img->save( $path );

        return $str_path;
    }
}

if( !function_exists('uploadFile') )
{
    function uploadFile( $fileType, $type, $dir_name, $file, $old_file = null)
    {
        if( isset( $old_file) )
            unlinkFile( $old_file );

        $file_path  =   $fileType . '/' . $type . '/' . $dir_name.'/';

        // Create directory first
        if(!File::exists( public_path( $file_path ) ))
        {
            Storage::disk('public')->makeDirectory( $file_path, 0755, true, true );
        }


        if( $file )
        {
            $file_name  =   uniqid() . '.' . $file->extension();
            $output     =   $file->move( public_path('uploads/' . $file_path), $file_name);
        }

        return $file_path . $file_name;
    }
}

if( !function_exists("unlinkFile"))
{
    function unlinkFile( $path )
    {
	if( empty($path) || !isset($path) || !$path )
            return false;

        if(File::exists(public_path( 'uploads/' . $path )))
        {
            File::delete(public_path( 'uploads/' . $path ));

            //Check if folder empty
            $files  =   File::files(public_path( 'uploads/' . dirname($path) ));
            if(empty($files))
                File::deleteDirectory( public_path( 'uploads/' . dirname($path)) );
        }
    }
}

if( !function_exists("fGetClientIp"))
{
    function fGetClientIp()
    {

        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }
}

if( !function_exists("fUserStatus"))
{


    function fUserStatus(string $status): string
    {

        switch (\Str::lower($status)) {
            case 'waiting':
                $badge = 'badge-light-warning';
                break;

            case 'active':
                $badge = 'badge-light-success';
                break;

            case 'approve':
                $status = "Active";
                $badge = 'badge-light-success';
                break;

            case 'overdue':
                $badge = 'badge-light-primary';
                break;

            case 'blacklist':
                $badge = 'badge-light-danger';
                break;

            case 'decline':
                $badge = 'badge-light-danger';
                break;

            default:
                $badge = 'badge-light-default';
                break;
        }

        return "<span class=\"badge ".$badge."\">".Str::upper($status)."</span>";
    }
}

if( !function_exists("fLogs"))
{
    function fLogs($str, $type='standard'){

        switch ($type) {
            case 'e': //error
                echo "\033[31m$str \033[0m\n";
            break;
            case 's': //success
                echo "\033[92m$str \033[0m\n";
            break;
            case 'w': //warning
                echo "\033[93m$str \033[0m\n";
            break;
            case 'i': //info
                echo "\033[96m$str \033[0m\n";
            break;
            default:
                echo $str."\n";
            break;
        }
    }
}

?>
