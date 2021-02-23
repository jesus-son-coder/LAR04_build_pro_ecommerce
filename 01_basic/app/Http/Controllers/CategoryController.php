<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // afficher toutes les catégories :
    public function AllCat()
    {
        // Méthode 1 (Eloquent) :
        // $categories = Category::all();

        // Méthode 2 : du plus récent au plus ancien :
        $categories = Category::latest()->get();

        return view('admin.category.index', compact('categories'));
    }


    // inésrer une catégorie :
    public function AddCat(Request $request)
    {
        // Validation :
        $validatedData = $request->validate([
                'category_name' => 'required|unique:categories|max:255',
            ],
            [
                'category_name.required' => "Le nom de la catégorie est obligatoire !",
                'category_name.max' => "La taille maximum de la catégorie est 255 caractères !"
            ]
        );

        // Insert - Méthode 1 (Eloquent ORM):
        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        /* Insert - Méthode 2 :
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();
        */

        // Méthode avec Query Buidler :
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->route('all.categories')->with('success', "La Catégorie a été enregistrée avec succès !");

    }
}
