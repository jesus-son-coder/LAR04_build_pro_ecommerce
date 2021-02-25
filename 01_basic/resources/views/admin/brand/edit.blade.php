<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            {{ __('Edit Brand') }}
        </h2>
        @if(session('success'))
        <div class="row alert alert-success alert-dismissible fade show" role="alert">
            <div class="col-10"><strong>{{ session('success') }}</strong></div>
            <button type="button" class="col-2 close text-right" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="margin-bottom:10px;padding:30px;">
                <style>
                    .dashboard-table-container {
                        padding: 1.5rem;
                        border: 1px solid #dee2e6;
                        border-top-left-radius: .25rem;
                        border-top-right-radius: .25rem;
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



                            <div class="card-header h5">Modifier une Marque</div>
                            <div class="card-body">
                                <form action="{{ url('brand/update/' . $brand->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name='old_image' value="{{ $brand->brand_image }}" />
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="brandInput"  style="margin-bottom: 5px;"><strong>Modifier le Nom de la Marque</strong></label>
                                        <input type="text" name="brand_name" class="form-control" id="brandInput" aria-describedby="emailHelp" placeholder="Saisir une marque" value="{{ $brand->brand_name }}">

                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="brandImage" id="label-image-brand"  style="margin-bottom: 5px;"><strong>Modifier l'image de la Marque</strong></label>
                                        <input type="file" name="brand_image" class="form-control" id="brandImageInput" aria-describedby="emailHelp" placeholder="Insérer une Image" value="{{ $brand->brand_name }}">
                                        {{-- <img class="image-update" src="{{ asset($brand->brand_image) }}" alt="" width="75px">  --}}

                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <div class="form-group">
                                            <img class="image-update" src="{{ asset($brand->brand_image) }}" alt="" width="75px">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Modifier la marque</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>



            </div>
        </div>


    </div>
</x-app-layout>
