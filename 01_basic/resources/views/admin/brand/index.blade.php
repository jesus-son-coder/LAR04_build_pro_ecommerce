<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les Marques (Brands)') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <!-- ------------------------ -->
        <!-- Les Brands actives : -->
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

                    #brandImageInput {
                        border: 1px solid #ded6d6;
                        border-radius: 4px;
                        padding: 7px;
                        margin-bottom: 12px;
                    }

                    label#label-image-brand {
                        margin-top: 12px;
                        font-weight: bold;
                    }

                    label#label-brand-name {
                        font-weight: bold;
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

                            <div class="card-header h4">La Marques</div>
                            <div class="dashboard-table-container">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>

                                    {{--   @php($i = 1) --}}
                                    <tbody>
                                    @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" alt="" width="75px"></td>
                                        <td>
                                            @if($brand->created_at)
                                                {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('brand/edit/'. $brand->id) }}" class="btn btn-info"><strong>Edit</strong></a>
                                            <a href="{{ url('brand/delete/' . $brand->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <!-- La Pagination (affichée en bas du tableau): -->
                                {{ $brands->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header h5">Ajouter une Marque</div>
                            <div class="card-body">
                                <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="brandInput" id="label-brand-name" >Nom de la Marque</label>
                                        <input type="text" name="brand_name" class="form-control" id="brandInput" aria-describedby="emailHelp" placeholder="Saisir le nom de la Marque">

                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label id="label-image-brand" for="brandImageInput">Image de la Marque</label>
                                        <input type="file" name="brand_image" class="form-control" id="brandImageInput" aria-describedby="emailHelp" placeholder="Insérer une Image">

                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter une Marque</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>



            </div>
        </div>
        <!-- Fin des Brands actives -->

    </div>
</x-app-layout>
