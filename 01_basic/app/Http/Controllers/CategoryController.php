<?php

namespace App\Http\Controllers;

use App\Model\Admin\Category as AdminCategory;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // afficher toutes les catégories :
    public function AllCat()
    {
        // Pagination avec Eloquent :
        $categories = Category::latest()->paginate(5);

        $trashCategories = Category::onlyTrashed()->latest()->paginate(3);

        // Pagination avec Query Builder :
        // $categories = DB::table('categories')->latest()->paginate(5);

        /*
        $categories = DB::table('categories')
                    ->join('users', 'categories.user_id', 'users.id')
                    // On veut tous les champs de la table "categories"
                    // et seulement le champ "name" de la table "users" :
                    ->select('categories.*', 'users.name')
                    ->latest()->paginate(5);
        */

        return view('admin.category.index', compact('categories', 'trashCategories'));
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

    public function Edit($id)
    {
        // Eloquent ORM :
        // $category = Category::find($id);

        // Query Builder :
        $category = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id)
    {
        // Méthode  Eloquent ORM :
/*      $category = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
*/
        // Méthode Query Builder :
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);

        return redirect()->route('all.categories')->with('success', "La Catégorie a été modifiée avec succès !");
    }


    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();

        return redirect()->back()->with('success', "La Catégorie a été supprimée (soft-delete) !");
    }


    public function Restore($id)
    {
        // On récupère un élément "soft-deleté" :
        $deleted = Category::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', "La Catégorie a été restaurée avec succès !");
    }


    public function Destroy($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', "La Catégorie a été définitivement supprimée !");
    }


}
