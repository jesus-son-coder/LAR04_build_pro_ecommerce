<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <!-- Nouveau bloc personnalisable dans le Dashboard -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="margin-bottom:10px;padding:30px;">
                <style>
                    .dashboard-table-container {
                        padding: 1.5rem;
                        border: 1px solid #dee2e6;
                        border-top-left-radius: .25rem;
                        border-top-right-radius: .25rem;
                        /* margin-top: 25px; */
                    }
                </style>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Modifier une Categorie</div>
                            <div class="card-body">
                                <form action="{{ url('category/update/' . $category->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="categoryInput"  style="margin-bottom: 5px;"><strong>Modifier le Nom de la Catégorie</strong></label>
                                        <input type="text" name="category_name" class="form-control" id="categoryInput" aria-describedby="emailHelp" placeholder="Saisir une catégorie" value="{{ $category->category_name }}">

                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Modifier la catégorie</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>



            </div>
        </div>


    </div>
</x-app-layout>
