<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class MultiImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Multipic()
    {
        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImages(Request $request)
    {
        $images = $request->file('images');

        foreach($images as $image){
            $name_generated = hexdec(uniqid());
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = $name_generated . '.' . $image_extension;
            $upload_location = 'images/mutli-pictures/';
            $last_image = $upload_location . $image_name ;
            // Copie physique du fichier image dans le répertoire '/public/images/mutli-pictures/xxx' :
            Image::make($image)->resize(300,200)->save($last_image);

            // Persistence de l'objet Brand en Base de données :
            Multipic::insert([
                'image' => $last_image,
                'created_at' => Carbon::now()
            ]);
        }



        return Redirect()->back()->with('success', "Les images ont été uploadés avec succès !");
    }

}
