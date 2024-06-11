<?php

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
