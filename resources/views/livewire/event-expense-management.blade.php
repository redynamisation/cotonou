<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4 lg:flex lg:items-center lg:justify-between lg:space-y-0">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Rechercher une dépense..." class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-orange-300 focus:outline-none" />
            <select wire:model="filterEvent" class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900">
                <option value="">Tous les événements</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-3 text-white font-semibold hover:bg-orange-700">+ Nouvelle dépense</button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">{{ $formMode === 'create' ? 'Ajouter une dépense' : 'Éditer la dépense' }}</h3>
            <form wire:submit.prevent="save" class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Événement *</label>
                        <select wire:model="event_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                            <option value="">Sélectionner un événement</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->title }}</option>
                            @endforeach
                        </select>
                        @error('event_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Montant *</label>
                        <input type="number" wire:model="amount" step="0.01" min="0" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('amount') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Date *</label>
                        <input type="date" wire:model="occurred_at" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('occurred_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Description *</label>
                        <input type="text" wire:model="description" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Notes</label>
                    <textarea wire:model="notes" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3"></textarea>
                    @error('notes') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" wire:click="resetForm" class="rounded-2xl border border-slate-200 px-5 py-3 text-slate-900 hover:bg-slate-50">Annuler</button>
                    <button type="submit" class="rounded-2xl bg-orange-600 px-5 py-3 text-white font-semibold hover:bg-orange-700">{{ $formMode === 'create' ? 'Ajouter' : 'Mettre à jour' }}</button>
                </div>
            </form>
        </div>
    @endif

    <div class="rounded-3xl border border-slate-200 bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Événement</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Montant</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Date</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Description</th>
                        <th class="px-6 py-3 text-center uppercase tracking-[0.18em] text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($expenses as $expense)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $expense->event?->title ?? 'Événement supprimé' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ number_format($expense->amount, 2, ',', ' ') }} FCFA</td>
                            <td class="px-6 py-4 text-slate-600">{{ $expense->occurred_at?->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $expense->description }}</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="openEdit({{ $expense->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Éditer</button>
                                <button wire:click="delete({{ $expense->id }})" class="ms-3 text-red-600 hover:text-red-700 font-semibold text-sm">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $expenses->links() }}
        </div>
    </div>
</div>
