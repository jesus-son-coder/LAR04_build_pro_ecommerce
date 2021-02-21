<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            {{ __('Mon Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <!-- Nouveau bloc personnalisable dans le Dashboard -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="margin-bottom:10px;padding:30px;">
                <div class="row">
                    <div class="col-6">
                        <h1 class="h4">Hello <strong>{{ Auth::user()->name }}</strong> ;)</h1>
                    </div>

                    <div class="col-6 text-right">
                        <strong>Total users: <span class="badge bg-danger">{{ count($users) }}</span></strong>
                    </div>
                </div>

                <style>
                    .dashboard-table-container {
                        padding: 1.5rem;
                        border: solid #dee2e6;
                        border-width: 1px;
                        border-top-left-radius: .25rem;
                        border-top-right-radius: .25rem;
                        margin-top: 25px;
                    }
                </style>

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
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- C'est ci que se trouve la bloc visuel de la homepage du Dashboard en mode connecté.
                Vous pouvez le supprimer pour le personnaliser ! -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
        <!-- fin du bloc visuel de la homepage du Dashboard -->
    </div>
</x-app-layout>
