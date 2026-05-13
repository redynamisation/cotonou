<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-slate-900 leading-tight">Bienvenue, {{ auth()->user()->name }}</h2>
                <p class="mt-2 text-sm text-slate-600">Suivez l'impact, les fonds et les leaders d'engagement.</p>
                <div class="mt-3 flex items-center gap-2">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Responsabilité :</span>
                    <span class="@if(auth()->user()->isAdmin()) bg-orange-100 text-orange-700 @elseif(auth()->user()->isCommissionLead()) bg-yellow-100 text-yellow-700 @else bg-slate-100 text-slate-700 @endif rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide">
                        @if(auth()->user()->isAdmin())
                            Administrateur
                        @elseif(auth()->user()->isCommissionLead())
                            Responsable de Commission
                        @else
                            Membre
                        @endif
                    </span>
                </div>
            </div>
            <div class="rounded-2xl bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-200 px-6 py-4 shadow-sm">
                <div class="text-sm font-semibold text-yellow-700">Organisation</div>
                <div class="text-lg font-bold text-slate-900 mt-1">BuloC de Cotonou</div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        @auth
            @if(auth()->user()->isAdmin())
                <div class="space-y-8">
                    <!-- Administration Section -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H3.75A2.25 2.25 0 001.5 3.75v12.5A2.25 2.25 0 003.75 18.5h12.5a2.25 2.25 0 002.25-2.25V9.5m-15-4h14m-14 7h14M11 1.5v4"/></svg>
                            Outils d'administration
                        </h3>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <a href="{{ route('admin.users') }}" class="group rounded-2xl border border-orange-200 bg-gradient-to-br from-white to-orange-50 p-6 shadow-sm hover:shadow-md transition hover:border-orange-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-widest text-orange-600">👥 Utilisateurs</p>
                                        <p class="mt-2 text-sm text-slate-600">Gérer les membres et leurs rôles</p>
                                    </div>
                                    <div class="text-3xl group-hover:scale-110 transition">👤</div>
                                </div>
                            </a>
                            <a href="{{ route('admin.activities') }}" class="group rounded-2xl border border-blue-200 bg-gradient-to-br from-white to-blue-50 p-6 shadow-sm hover:shadow-md transition hover:border-blue-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-widest text-blue-600">📋 Activités</p>
                                        <p class="mt-2 text-sm text-slate-600">Créer et organiser les activités</p>
                                    </div>
                                    <div class="text-3xl group-hover:scale-110 transition">📅</div>
                                </div>
                            </a>
                            <a href="{{ route('admin.tasks') }}" class="group rounded-2xl border border-green-200 bg-gradient-to-br from-white to-green-50 p-6 shadow-sm hover:shadow-md transition hover:border-green-300">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-widest text-green-600">✅ Tâches</p>
                                        <p class="mt-2 text-sm text-slate-600">Assigner et suivre les tâches</p>
                                    </div>
                                    <div class="text-3xl group-hover:scale-110 transition">📝</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Module Management Section -->
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H3a1 1 0 00-1 1v10a1 1 0 001 1h14a1 1 0 001-1V6a1 1 0 00-1-1h3a1 1 0 000-2 2 2 0 00-2 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"></path></svg>
                            Gestion des modules
                        </h3>
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                            <a href="{{ route('admin.announcements') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition hover:border-slate-300 text-center">
                                <p class="text-2xl mb-2">📢</p>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-700">Annonces</p>
                                <p class="mt-2 text-xs text-slate-500">Communiqués</p>
                            </a>
                            <a href="{{ route('admin.library') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition hover:border-slate-300 text-center">
                                <p class="text-2xl mb-2">📚</p>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-700">Bibliothèque</p>
                                <p class="mt-2 text-xs text-slate-500">Ressources</p>
                            </a>
                            <a href="{{ route('admin.partners') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition hover:border-slate-300 text-center">
                                <p class="text-2xl mb-2">🤝</p>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-700">Partenaires</p>
                                <p class="mt-2 text-xs text-slate-500">Sponsors</p>
                            </a>
                            <a href="{{ route('admin.events') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition hover:border-slate-300 text-center">
                                <p class="text-2xl mb-2">🎉</p>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-700">Événements</p>
                                <p class="mt-2 text-xs text-slate-500">Conférences</p>
                            </a>
                            <a href="{{ route('admin.event-expenses') }}" class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition hover:border-slate-300 text-center">
                                <p class="text-2xl mb-2">💰</p>
                                <p class="text-xs font-bold uppercase tracking-widest text-slate-700">Comptabilité</p>
                                <p class="mt-2 text-xs text-slate-500">Dépenses</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endauth

        <!-- Main Navigation Sections -->
        <div class="mt-12">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 000-2H7zM4 7a1 1 0 011-1h10a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V7z"></path></svg>
                Accès rapide
            </h3>
            <div class="grid gap-4 sm:grid-cols-3">
                <a href="{{ route('commissions.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-lg transition hover:border-slate-300">
                    <p class="text-3xl mb-3">🏢</p>
                    <p class="text-sm font-bold uppercase tracking-widest text-slate-700">Commissions</p>
                    <p class="mt-2 text-sm text-slate-600">Gérer les équipes de travail</p>
                </a>
                <a href="{{ route('finances.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-lg transition hover:border-slate-300">
                    <p class="text-3xl mb-3">💵</p>
                    <p class="text-sm font-bold uppercase tracking-widest text-slate-700">Trésorerie</p>
                    <p class="mt-2 text-sm text-slate-600">Suivre les finances et fonds</p>
                </a>
                <a href="{{ route('events.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-lg transition hover:border-slate-300">
                    <p class="text-3xl mb-3">🎫</p>
                    <p class="text-sm font-bold uppercase tracking-widest text-slate-700">Billetterie</p>
                    <p class="mt-2 text-sm text-slate-600">Gérer les ventes de tickets</p>
                </a>
            </div>
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
