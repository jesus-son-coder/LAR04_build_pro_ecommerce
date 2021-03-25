<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multi Pictures') }}
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
                        <div class="card-group">
                            @foreach($images as $image)
                                <div class="col-md-4 mt-5">
                                    <div class=="card">
                                        <img src="{{ asset($image->image) }}" alt="" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header h5">Multi Images</div>
                            <div class="card-body">
                                <form action="{{ route('multi.images.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label id="label-image-brand" for="brandImageInput">Multi images</label>
                                        <input type="file" name="images[]" class="form-control" id="brandImageInput" aria-describedby="" placeholder="Insérer une Image" multiple="">

                                        @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter les Images</button>
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
