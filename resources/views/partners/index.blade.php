<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Partenaires et sponsors</h2>
                <p class="mt-1 text-sm text-slate-500">Réseau de partenaires qui soutiennent les projets BuloC.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Retour au dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @forelse($partners as $partner)
                    <a href="{{ $partner->website ?: '#' }}" target="_blank" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-yellow-300">
                        <div class="flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-slate-100 overflow-hidden">
                                @if($partner->logo_url)
                                    <img src="{{ $partner->logo_url }}" alt="Logo {{ $partner->name }}" class="h-full w-full object-cover" />
                                @else
                                    <span class="text-lg font-bold text-slate-700">{{ strtoupper(substr($partner->name, 0, 1)) }}</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">{{ $partner->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $partner->website ?: 'Site non disponible' }}</p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm leading-6 text-slate-600">{{ $partner->description }}</p>
                    </a>
                @empty
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">Aucun partenaire n’est encore référencé.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
