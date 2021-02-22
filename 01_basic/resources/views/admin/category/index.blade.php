<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            {{ __('All Categories') }}
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
                            <div class="card-header">All Categories</div>
                            <div class="dashboard-table-container">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach($users as $user) #}  --}}
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    {{-- @endforeach --}}
                                    </tbody>
                                </table>
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
v


            </div>
        </div>


    </div>
</x-app-layout>
