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
                <h1>Hello Hervé ;)</h1>

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
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
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
