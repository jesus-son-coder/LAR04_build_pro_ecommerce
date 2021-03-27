<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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


    public function Edit($id)
    {
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }


    public function Update(Request $request, $id)
    {
        // Validation :
        $validatedData = $request->validate(
            [
                'brand_name' => 'required|min:4',
            ],
            [
                'brand_name.required' => "Le nom de la marque est obligatoire !",
                'brand_name.min' => "La taille minimum du nom de la marque est de 4 caractères !"
            ]
        );

        $old_image = $request->old_image;


        if($request->file('brand_image')) {
            $brand_image = $request->file('brand_image');

            $name_generated = hexdec(uniqid());
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_generated . '.' . $image_extension;
            $upload_location = 'images/brands/';
            $last_image = $upload_location . $image_name;
            // Copie physique du fichier image dans le répertoire '/public/images/brands/xxx' :
            $brand_image->move($upload_location, $image_name);

            // Suppression de l'ancienne image :
            unlink($old_image);

            Brand::find($id)->update([
                'brand_image' => $last_image
            ]);
        }

        // Persistence de l'objet Brand en Base de données :
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
        ]);

        return Redirect()->back()->with('success', "La Marque a été modifiée avec succès !");
    }


    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', "La Marque a été supprimée !");
    }

}
