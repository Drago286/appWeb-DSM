<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class ImageUploadController extends Controller
{
    /**
     * RETORNA LAS IMAGENES
     *
     * @return void
     */
    public function index()
    {
        return Imagen::get();

        //
    }
    /**
     * Valida y guarda la imagen obtenida desde el frontend
     *
     * @param Request $request
     * @return void
     */
    public function uploadImage(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required', File::image()->max(2 * 1024), 'unique'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $image = new Imagen();
        $file = $request->file('image');
        $filename = uniqid() . "_" . $file->getClientOriginalName();
        $file->move(public_path('public/images'), $filename);
        $url = URL::to('/') . '/public/images/' . $filename;
        $image['url'] = $url;
        $image->save();
        return response()->json(['isSuccess' => true, 'url' => $url, 'id' => $image->id]);
    }
}
