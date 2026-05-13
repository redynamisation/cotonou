<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Trésorerie</h2>
                <p class="mt-1 text-sm text-slate-500">Suivi des financements, recettes et dépenses.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Retour au dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">Analyse par événement</h3>
                    <p class="mt-1 text-sm text-slate-500">Filtrer et comparer les flux financiers liés aux événements.</p>
                </div>
                <form method="GET" class="flex items-center gap-3">
                    <label for="event_id" class="text-sm font-medium text-slate-700">Événement</label>
                    <select id="event_id" name="event_id" class="rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-slate-300 focus:outline-none">
                        <option value="">Tous les événements</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" @selected($eventId == $event->id)>{{ $event->title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Filtrer</button>
                </form>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Recettes</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($totals['recettes'], 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Dépenses</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($totals['depenses'], 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Solde</p>
                    <p class="mt-4 text-3xl font-semibold text-slate-900">{{ number_format($totals['net'], 0, ',', ' ') }} FCFA</p>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-slate-900">Journal financier</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($finances as $finance)
                            <div class="flex flex-col gap-2 rounded-3xl border border-slate-200 bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ ucfirst($finance->type_flux) }} — {{ $finance->source }}</p>
                                    <p class="text-sm text-slate-500">
                                        {{ $finance->commission?->name ?? 'Commission inconnue' }}
                                        @if($finance->event)
                                            · {{ $finance->event->title }}
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-slate-900">{{ number_format($finance->amount, 0, ',', ' ') }} FCFA</p>
                                    <p class="text-sm text-slate-500">{{ $finance->recorded_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-sm text-slate-500">
                                Aucun flux financier trouvé pour ce filtre.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-slate-900">Récapitulatif par événement</h3>
                    <div class="mt-6 space-y-4">
                        @foreach($eventTotals as $eventTitle => $summary)
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <p class="font-semibold text-slate-900">{{ $eventTitle }}</p>
                                    <p class="text-sm text-slate-500">Net: {{ number_format($summary['net'], 0, ',', ' ') }} FCFA</p>
                                </div>
                                <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                    <div class="rounded-2xl bg-white p-4 border border-slate-200">
                                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Recettes</p>
                                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ number_format($summary['recettes'], 0, ',', ' ') }} FCFA</p>
                                    </div>
                                    <div class="rounded-2xl bg-white p-4 border border-slate-200">
                                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Dépenses</p>
                                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ number_format($summary['depenses'], 0, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
