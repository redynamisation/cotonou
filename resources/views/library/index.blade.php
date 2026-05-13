<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Bibliothèque en ligne</h2>
                <p class="mt-1 text-sm text-slate-500">Ressources islamique et supports de formation à télécharger.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Retour au dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 lg:grid-cols-3">
                @forelse($documents as $document)
                    <a href="{{ $document->url }}" target="_blank" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-orange-300">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">{{ $document->category }}</p>
                                <h3 class="mt-3 text-lg font-semibold text-slate-900">{{ $document->title }}</h3>
                            </div>
                            <span class="rounded-full bg-orange-100 px-3 py-2 text-xs font-semibold text-orange-800">Télécharger</span>
                        </div>
                        <p class="mt-4 text-sm leading-6 text-slate-600">{{ $document->description }}</p>
                    </a>
                @empty
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-600">Aucune ressource disponible pour l’instant.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
