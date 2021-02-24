<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function AllBrands()
    {
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        // Validation :
        $validatedData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png,gif',
            ],
            [
                'brand_name.required' => "Le nom de la marque est obligatoire !",
                'brand_name.min' => "La taille minimum du nom de la marque est de 4 caractères !"
            ]
        );

        $brand_image = $request->file('brand_image');

        $name_generated = hexdec(uniqid());
        $image_extension = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_generated . '.' . $image_extension;
        $upload_location = 'images/brands/';
        $last_image = $upload_location . $image_name ;
        // Copie physique du fichier image dans le répertoire '/public/images/brands/xxx' :
        $brand_image->move($upload_location, $image_name);

        // Persistence de l'objet Brand en Base de données :
        Brand::insert([
           'brand_name' => $request->brand_name,
           'brand_image' => $last_image,
           'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', "La Marque a été créée avec succès !");
    }
}
