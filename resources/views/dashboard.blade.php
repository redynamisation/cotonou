<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Tableau de bord</h2>
                <p class="mt-1 text-sm text-slate-500">Suivez l’impact, les fonds et les leaders d’engagement.</p>
            </div>
            <div class="rounded-full bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-800">BuloC de Cotonou</div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @auth
            @if(auth()->user()->isAdmin())
                <div class="pb-6 space-y-6">
                    <div class="rounded-3xl border border-orange-200 bg-orange-50 p-6">
                        <h3 class="text-lg font-semibold text-orange-900 mb-4">Outils d'administration</h3>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <a href="{{ route('admin.users') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                                <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Utilisateurs</p>
                                <p class="mt-2 text-sm">Gérer les membres</p>
                            </a>
                            <a href="{{ route('admin.activities') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                                <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Activités</p>
                                <p class="mt-2 text-sm">Créer des activités</p>
                            </a>
                            <a href="{{ route('admin.tasks') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                                <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Tâches</p>
                                <p class="mt-2 text-sm">Assigner des tâches</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-orange-200 bg-orange-50 p-6">
                    <h3 class="text-lg font-semibold text-orange-900 mb-4">Gestion des modules</h3>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <a href="{{ route('admin.announcements') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                            <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Annonces</p>
                            <p class="mt-2 text-sm">Publier des communiqués</p>
                        </a>
                        <a href="{{ route('admin.library') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                            <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Bibliothèque</p>
                            <p class="mt-2 text-sm">Ajouter des ressources</p>
                        </a>
                        <a href="{{ route('admin.partners') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                            <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Partenaires</p>
                            <p class="mt-2 text-sm">Gérer les sponsors</p>
                        </a>
                        <a href="{{ route('admin.events') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                            <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Événements</p>
                            <p class="mt-2 text-sm">Organiser des événements</p>
                        </a>
                        <a href="{{ route('admin.event-expenses') }}" class="rounded-3xl border border-orange-300 bg-white px-5 py-4 text-center text-slate-900 shadow-sm transition hover:border-orange-400 hover:bg-orange-50">
                            <p class="text-sm font-semibold uppercase tracking-[0.1em] text-orange-600">Comptabilité</p>
                            <p class="mt-2 text-sm">Suivre les dépenses</p>
                        </a>
                    </div>
                </div>
            @endif
        @endauth

        <div class="grid gap-4 sm:grid-cols-3 pb-6">
            <a href="{{ route('commissions.index') }}" class="rounded-3xl border border-slate-200 bg-white px-5 py-6 text-center text-slate-900 shadow-sm transition hover:border-orange-300">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Commissions</p>
                <p class="mt-4 text-xl font-semibold">Organiser les équipes</p>
            </a>
            <a href="{{ route('finances.index') }}" class="rounded-3xl border border-slate-200 bg-white px-5 py-6 text-center text-slate-900 shadow-sm transition hover:border-yellow-300">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Trésorerie</p>
                <p class="mt-4 text-xl font-semibold">Suivre les fonds</p>
            </a>
            <a href="{{ route('events.index') }}" class="rounded-3xl border border-slate-200 bg-white px-5 py-6 text-center text-slate-900 shadow-sm transition hover:border-orange-300">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Billetterie</p>
                <p class="mt-4 text-xl font-semibold">Voir les ventes</p>
            </a>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @livewire('dashboard-stats')
            </div>
        </div>
    </div>
</x-app-layout>
