<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 05.08.15
 * Time: 22:40
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Intervention\Image\Facades\Image as Image;

class MediaController extends Controller
{
    public function getOriginDir($media_type = 'images')
    {
        return base_path() . '/storage/app/media/' . $media_type . '/';
    }
    /**
     * @param Request $request
     * @return \App\Models\Media
     */
    public function postUpload(Request $request)
    {
        $file_data = $_FILES['files'];
        $tmp_name = is_array($file_data['tmp_name']) ? $file_data['tmp_name'][0] : $file_data['tmp_name'];
        $file_extention = 'jpg';
        $file_name = md5(microtime()) . '.' . $file_extention;

        move_uploaded_file($tmp_name, $this->getOriginDir() . $file_name);

        $media_model = new \App\Models\Media;
        $media_model->product_id = Input::get('product_id');
        $media_model->file_name  = $file_name;
        $media_model->save();
        $media_model->success = true;

        return $media_model;
    }

    public function getRemove($id)
    {
        $media_model = \App\Models\Media::find($id);
        if (!$media_model) {
            return ['success' => false];
        }
        $media_model->delete();
        return ['success' => true];
    }

    public function getImage($width_height, $file_name)
    {
        $media_id = (int) \Input::get('mid');

        $canvas_color = 'FFFFFF';

        if ($media_id) {
            $media_model = \App\Models\Media::findOrFail($media_id);

            $canvas_color = $media_model->canvas_color;

            if (empty($media_model->file_name) and !empty($media_model->source_url)) {

                $file_extention = 'jpg';
                $file_name = md5(microtime() . rand(0, 1000)) . '.' . $file_extention;

                $source_url = $media_model->source_url;

                if ((substr($source_url, 0, 7) != 'http://') and (substr($source_url, 0, 8) != 'https://')) {
                    $source_url = 'http://' . $source_url;
                }

                \Storage::put('media/images/' . $file_name, file_get_contents($source_url));

                $media_model->file_name = $file_name;
                $media_model->save();
            }
        }

        $width_height_arr = explode('x', $width_height);

        $width  = $width_height_arr[0];
        $height = $width_height_arr[1];

        $image_path = $this->getOriginDir() . $file_name;

        if (!file_exists($image_path)) {
            $img = Image::canvas($width, $height);
            $img->text('Image not found ;{', 110, 110, function($font) {
                $font->size(48);
                $font->align('center');
            });
            return $img->response('jpg');
        }

        $img = Image::make($image_path);

        $source_width  = $img->width();
        $source_height = $img->height();

        if ($source_width < $source_height) {

            if (($width = $height) or ($width > $height)) {
                // resize H
                $img->heighten($height);
            }

        } elseif ($source_width > $source_height) {

            if (($width = $height) or ($width < $height)) {
                // resize V
                $img->widen($width);
            }

        } else {
            if ($width > $height) {
                // resize H
                $img->heighten($height);
            }
            if ($width < $height) {
                // resize V
                $img->widen($width);
            }
        }

        $img->resizeCanvas($width, $height, 'center', false, $canvas_color);

        //$img->fit($width, $height);

        $storage_dir = base_path() . '/public/media/images/' . $width_height;

        $storage_file = $storage_dir . '/' . $file_name;

        if (!file_exists($storage_dir)) {
            mkdir($storage_dir);
        }

        $img->save($storage_file);

        return $img->response('jpg');
    }
}