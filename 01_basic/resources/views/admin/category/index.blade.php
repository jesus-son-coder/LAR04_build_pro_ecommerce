<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <!-- ------------------------ -->
        <!-- Les Catégories actives : -->
        <!-- ------------------------ -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="margin-bottom:10px;padding:30px;">
                <style>
                    .dashboard-table-container {
                        padding: 1.5rem;
                        border: 1px solid #dee2e6;
                        border-top-left-radius: .25rem;
                        border-top-right-radius: .25rem
                    }
                    .alert-dismissible {
                        padding-right: 0px !important;
                        margin-left: 0px !important;
                        margin-right: 0px !important;
                    }
                </style>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">

                            @if(session('success'))
                                <div class="row alert alert-success alert-dismissible fade show" role="alert">
                                    <div class="col-10"><strong>{{ session('success') }}</strong></div>
                                    <button type="button" class="col-2 close text-right" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-header h4">Categories actives</div>
                            <div class="dashboard-table-container">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>

                                    {{--   @php($i = 1) --}}
                                    <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if($category->created_at)
                                                {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/edit/'. $category->id) }}" class="btn btn-info"><strong>Edit</strong></a>
                                            <a href="{{ url('category/softdelete/' . $category->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <!-- La Pagination (affichée en bas du tableau): -->
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Ajouter une Categorie</div>
                            <div class="card-body">
                                <form action="{{ route('store.category') }}" method="POST">
                                    @csrf
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="categoryInput">Nom de la Catégorie</label>
                                        <input type="text" name="category_name" class="form-control" id="categoryInput" aria-describedby="emailHelp" placeholder="Saisir une catégorie">

                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter une catégorie</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>



            </div>
        </div>
        <!-- Fin des Categories actives -->



        <!-- ------------------------------------------- -->
        <!-- Les Catégories supprimées ("Soft Delete") : -->
        <!-- ------------------------------------------- -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="margin-bottom:10px;padding:30px;">
                <style>
                    .dashboard-table-container {
                        padding: 1.5rem;
                        border: 1px solid #dee2e6;
                        border-top-left-radius: .25rem;
                        border-top-right-radius: .25rem
                    }
                    .alert-dismissible {
                        padding-right: 0px !important;
                        margin-left: 0px !important;
                        margin-right: 0px !important;
                    }
                </style>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header h4">Delete Categories (TrashList)</div>
                            <div class="dashboard-table-container">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>

                                    {{--   @php($i = 1) --}}
                                    <tbody>
                                    @foreach($trashCategories as $trashCategory)
                                    <tr>
                                        <th scope="row">{{ $trashCategories->firstItem() + $loop->index }}</th>
                                        <td>{{ $trashCategory->category_name }}</td>
                                        <td>{{ $trashCategory->user->name }}</td>
                                        <td>
                                            @if($trashCategory->created_at)
                                                {{ Carbon\Carbon::parse($trashCategory->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/restore/'. $trashCategory->id) }}" class="btn btn-success">Restore</a>
                                            <a href="{{ url('category/destroy/'. $trashCategory->id) }}" class="btn btn-outline-danger"><strong>Destroy</strong></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    {{--  La Pagination (affichée en haut du tableau):
                                    {{ $categories->links() }}
                                    --}}
                                    </tbody>
                                </table>

                                <!-- La Pagination (affichée en bas du tableau): -->
                                {{ $trashCategories->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                    </div>

                </div>



            </div>
        </div>
        <!-- End Trashlist -->

    </div>
</x-app-layout>
