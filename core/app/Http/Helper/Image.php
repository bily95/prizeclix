<?php

use Intervention\Image\Facades\Image;


//get images paths
function imagePath()
{

    $data['verify'] = [
        'withdraw' => [
            'path' => 'asset/uploads/withdraw/verify'
        ]
    ];

    $data['withdraw'] = [
        'method' => [
            'path' => 'asset/uploads/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'asset/uploads/support',
    ];
    

    $data['users'] = [
        'path' => 'asset/uploads/users',
        'size' => '200x200'
    ];

    $data['offers'] = [
        'path' => 'asset/uploads/offerwalls',
        'size' => '800x800'
    ];

    return $data;
}

//upload images
function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new \Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if ($size) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if ($thumb) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}
    
//upload files
function uploadFile($file, $location, $size = null, $old = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new \Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location, $filename);
    return $filename;
}

//as it is , make directory
function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


//delete files
function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function getImage($image, $size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image', $size);
    }
    // return asset('asset/uploads/default.png');
    return asset('asset/uploads/users/default.png');
}

function uploads($location, $file)
{
    return asset('/asset/uploads/' . $location . '/' . $file);
}