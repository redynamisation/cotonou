<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>BuloC de Cotonou</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-slate-900 antialiased">
        <div class="min-h-screen bg-white">
            <header class="mx-auto flex max-w-7xl flex-col gap-6 px-6 py-6 sm:px-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-orange-100 text-orange-900 shadow-sm">
                        <span class="text-2xl font-black">B</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">BuloC de Cotonou</p>
                        <p class="text-xs text-slate-400">Plateforme associative jeunesse</p>
                    </div>
                </div>

                <nav class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-700">
                    <a href="{{ route('announcements.index') }}" class="rounded-full border border-slate-200 px-4 py-2 hover:bg-slate-100">Annonces</a>
                    <a href="{{ route('library.index') }}" class="rounded-full border border-slate-200 px-4 py-2 hover:bg-slate-100">Bibliothèque</a>
                    <a href="{{ route('partners.index') }}" class="rounded-full border border-slate-200 px-4 py-2 hover:bg-slate-100">Partenaires</a>
                    @if(Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-full border border-orange-200 bg-orange-50 px-4 py-2 text-orange-700 transition hover:bg-orange-100">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-full border border-slate-200 px-4 py-2 hover:bg-slate-100">Connexion</a>
                            @if(Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-yellow-300">Inscription</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </header>

            <main class="mx-auto max-w-7xl px-6 pb-16 sm:px-8">
                <section class="grid gap-10 lg:grid-cols-[1.4fr_1fr] lg:items-center">
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-2 rounded-full bg-orange-50 px-4 py-2 text-sm font-semibold text-orange-800">
                            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-orange-900"></span>
                            Plus de 400 membres connectés et des partenariats en croissance.
                        </div>

                        <div class="space-y-4">
                            <h1 class="text-4xl font-semibold leading-tight tracking-tight text-slate-900 sm:text-5xl">Transformez l’engagement en actions concrètes</h1>
                            <p class="max-w-2xl text-lg leading-8 text-slate-600">BuloC de Cotonou accompagne les élèves et étudiants dans la gestion associative : commissions, trésorerie, motivation, billetterie et visibilité.</p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-yellow-400 px-6 py-3 text-sm font-semibold text-slate-950 shadow-sm transition hover:bg-yellow-300">Rejoindre l’équipe</a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">Voir le dashboard</a>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Impact</p>
                                <p class="mt-3 text-3xl font-semibold text-slate-900">+120 actions</p>
                                <p class="mt-2 text-sm text-slate-600">Missions gérées et valorisées.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Budget</p>
                                <p class="mt-3 text-3xl font-semibold text-slate-900">{{ number_format($solde, 0, ',', ' ') }} FCFA</p>
                                <p class="mt-2 text-sm text-slate-600">Solde courant après dépenses et dons.</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[40px] border border-slate-200 bg-gradient-to-br from-white via-yellow-50 to-orange-50 p-8 shadow-xl">
                        <div class="rounded-3xl bg-white p-6 shadow-sm">
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500">Tableau de bord</p>
                            <h2 class="mt-4 text-2xl font-semibold text-slate-900">Analyse & motivation</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-600">Visualisez les performances des commissions, les points de motivation des membres et le budget de chaque mission.</p>

                            <div class="mt-8 space-y-4">
                                <div class="rounded-3xl bg-slate-50 p-4">
                                    <p class="text-sm text-slate-500">Leaderboard</p>
                                    <p class="mt-2 text-xl font-semibold text-slate-900">Top membres du mois</p>
                                </div>
                                <div class="rounded-3xl bg-slate-50 p-4">
                                    <p class="text-sm text-slate-500">Billetterie</p>
                                    <p class="mt-2 text-xl font-semibold text-slate-900">Ventes et rentabilité</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-10 rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-orange-700">Banderole donateur</p>
                            <h2 class="mt-2 text-xl font-semibold text-slate-900">Dépôt des versements</h2>
                        </div>
                        <div class="rounded-full bg-white px-4 py-2 text-sm text-slate-700">Recettes: {{ number_format($recettes, 0, ',', ' ') }} FCFA</div>
                        <div class="rounded-full bg-white px-4 py-2 text-sm text-slate-700">Dépenses: {{ number_format($depenses, 0, ',', ' ') }} FCFA</div>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Les commissions peuvent déposer leurs justificatifs de dépôt directement dans l’espace trésorerie pour une transparence complète.</p>
                </section>

                <section class="grid gap-6 lg:grid-cols-3">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Commission Sociale</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Salubrité des mosquées, cimetières et soutien aux orphelinats.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Commission Communication</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Événements, annonces, design et billetterie pour donner de la visibilité.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Commission Formation</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Ateliers, formations et ressources islamiques pour les membres.</p>
                    </div>
                </section>

                <section class="mt-10 grid gap-6 lg:grid-cols-3">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Commission Logistique</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Organisation d’événements, transport et accueil.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Trésorerie & Partenariats</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Financement durable et sponsors pour renforcer les actions.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900">Supervision AGR</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Boutique associative, ventes et investissements rentables.</p>
                    </div>
                </section>

                <section class="mt-16 space-y-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Communiqué de la Commission Communication</p>
                            <h2 class="text-2xl font-semibold text-slate-900">Dernières annonces</h2>
                        </div>
                        <a href="{{ route('announcements.index') }}" class="text-sm font-semibold text-orange-700 hover:text-orange-900">Voir toutes les annonces →</a>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-3">
                        @forelse($announcements as $announcement)
                            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                                <div class="flex items-center justify-between gap-4 text-slate-500">
                                    <span class="rounded-full bg-orange-100 px-3 py-2 text-xs uppercase tracking-[0.2em] text-orange-800">{{ ucfirst($announcement->type) }}</span>
                                    <span class="text-xs">{{ $announcement->published_at?->format('d/m/Y') ?? '-' }}</span>
                                </div>
                                <h3 class="mt-4 text-xl font-semibold text-slate-900">{{ $announcement->title }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ Str::limit($announcement->content, 120) }}</p>
                                <p class="mt-4 text-sm text-slate-500">{{ $announcement->commission?->name ?? 'General' }}</p>
                            </div>
                        @empty
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">Aucune annonce récente.</div>
                        @endforelse
                    </div>
                </section>

                <section class="mt-16 space-y-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Bibliothèque islamique</p>
                            <h2 class="text-2xl font-semibold text-slate-900">Ressources en ligne</h2>
                        </div>
                        <a href="{{ route('library.index') }}" class="text-sm font-semibold text-orange-700 hover:text-orange-900">Accéder à la bibliothèque →</a>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-4">
                        @forelse($documents as $document)
                            <a href="{{ $document->url }}" target="_blank" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-orange-300">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-500">{{ $document->category }}</p>
                                <h3 class="mt-4 text-lg font-semibold text-slate-900">{{ $document->title }}</h3>
                                <p class="mt-3 text-sm leading-6 text-slate-600">{{ Str::limit($document->description, 100) }}</p>
                            </a>
                        @empty
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">La bibliothèque est en cours de remplissage.</div>
                        @endforelse
                    </div>
                </section>

                <section class="mt-16 space-y-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Événements</p>
                            <h2 class="text-2xl font-semibold text-slate-900">Calendrier et galerie</h2>
                        </div>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-orange-700 hover:text-orange-900">Voir la billetterie →</a>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-3">
                        @forelse($events as $event)
                            <article class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1">
                                <div class="h-52 bg-slate-100">
                                    @if($event->poster_url)
                                        <img src="{{ $event->poster_url }}" alt="{{ $event->title }}" class="h-full w-full object-cover" />
                                    @else
                                        <div class="flex h-full items-center justify-center text-slate-500">Image évènement</div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <p class="text-sm uppercase tracking-[0.2em] text-orange-700">{{ $event->commission?->name ?? 'Général' }}</p>
                                    <h3 class="mt-3 text-xl font-semibold text-slate-900">{{ $event->title }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ Str::limit($event->description, 100) }}</p>
                                    <div class="mt-5 flex items-center justify-between text-sm text-slate-500">
                                        <span>{{ $event->start_at?->format('d/m/Y') }}</span>
                                        <span>{{ number_format($event->price, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">Aucun événement planifié pour le moment.</div>
                        @endforelse
                    </div>
                </section>

                <section class="mt-16 space-y-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Partenaires</p>
                            <h2 class="text-2xl font-semibold text-slate-900">Soutiens et sponsors</h2>
                        </div>
                        <a href="{{ route('partners.index') }}" class="text-sm font-semibold text-orange-700 hover:text-orange-900">Voir tous les partenaires →</a>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($partners as $partner)
                            <a href="{{ $partner->website ?: '#' }}" target="_blank" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-slate-100 overflow-hidden">
                                        @if($partner->logo_url)
                                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-full w-full object-cover" />
                                        @else
                                            <span class="text-lg font-bold text-slate-700">{{ strtoupper(substr($partner->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-900">{{ $partner->name }}</h3>
                                        <p class="text-sm text-slate-500">{{ $partner->website ?: 'Site non disponible' }}</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-sm leading-6 text-slate-600">{{ Str::limit($partner->description, 100) }}</p>
                            </a>
                        @empty
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">Aucun partenaire référencé.</div>
                        @endforelse
                    </div>
                </section>
            </main>

            <x-site-footer />
        </div>
    </body>
</html>
