<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Billetterie</h2>
                <p class="mt-1 text-sm text-slate-500">Suivi des tickets vendus et des recettes d’événements.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Retour au dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Tickets vendus</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $summary['sold'] }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Revenu total</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($summary['revenue'], 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Événements couverts</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $tickets->pluck('event_name')->unique()->count() }}</p>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900">Ventes récentes</h3>
                <div class="mt-6 space-y-4">
                    @foreach($tickets as $ticket)
                        <div class="flex flex-col gap-2 rounded-3xl border border-slate-200 bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $ticket->event_name }}</p>
                                <p class="text-sm text-slate-500">{{ $ticket->user_external_name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">{{ number_format($ticket->price, 0, ',', ' ') }} FCFA</p>
                                <p class="text-sm text-slate-500">{{ $ticket->sold_at?->format('d/m/Y') ?? 'Date indisponible' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
