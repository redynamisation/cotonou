<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Annonces et communiqués</h2>
                <p class="mt-1 text-sm text-slate-500">Actualités de la commission communication et informations de l’association.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Retour au dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($announcements as $announcement)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">{{ ucfirst($announcement->type) }} {{ $announcement->commission?->name ? '• ' . $announcement->commission->name : '' }}</p>
                            <h3 class="mt-3 text-xl font-semibold text-slate-900">{{ $announcement->title }}</h3>
                        </div>
                        <span class="rounded-full bg-slate-100 px-3 py-2 text-sm text-slate-700">{{ $announcement->published_at?->format('d/m/Y') ?? 'Date indisponible' }}</span>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-slate-600">{{ $announcement->content }}</p>
                </div>
            @empty
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">Aucune annonce disponible pour le moment.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
