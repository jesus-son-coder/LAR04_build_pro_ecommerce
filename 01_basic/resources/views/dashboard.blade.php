<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            {{ __('Mon Tableau de Bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- C'est ci que se trouve la bloc visuel de la homepage du Dashboard en mode connecté.
                Vous pouvez le supprimer pour le personnaliser ! -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
            <!-- fin du bloc visuel de la homepage du Dashboard -->
        </div>
    </div>
</x-app-layout>
