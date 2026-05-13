<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4 lg:flex lg:items-center lg:justify-between lg:space-y-0">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Rechercher un événement..." class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-orange-300 focus:outline-none" />
            <select wire:model="filterCommission" class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900">
                <option value="">Toutes les commissions</option>
                @foreach($commissions as $commission)
                    <option value="{{ $commission->id }}">{{ $commission->name }}</option>
                @endforeach
            </select>
            <select wire:model="filterStatus" class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900">
                <option value="">Tous statuts</option>
                <option value="planned">Planifié</option>
                <option value="open">Ouvert</option>
                <option value="termine">Terminé</option>
            </select>
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-3 text-white font-semibold hover:bg-orange-700">+ Nouvel événement</button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">{{ $formMode === 'create' ? 'Créer un événement' : 'Éditer l’événement' }}</h3>
            <form wire:submit.prevent="save" class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Titre *</label>
                        <input type="text" wire:model="title" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Lieu *</label>
                        <input type="text" wire:model="location" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('location') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Début *</label>
                        <input type="datetime-local" wire:model="start_at" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('start_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Fin</label>
                        <input type="datetime-local" wire:model="end_at" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('end_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Prix</label>
                        <input type="number" wire:model="price" step="0.01" min="0" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Statut *</label>
                        <select wire:model="status" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                            <option value="planned">Planifié</option>
                            <option value="open">Ouvert</option>
                            <option value="termine">Terminé</option>
                        </select>
                        @error('status') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Affiche URL</label>
                        <input type="url" wire:model="poster_url" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('poster_url') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Commission</label>
                        <select wire:model="commission_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                            <option value="">Aucune</option>
                            @foreach($commissions as $commission)
                                <option value="{{ $commission->id }}">{{ $commission->name }}</option>
                            @endforeach
                        </select>
                        @error('commission_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Description</label>
                    <textarea wire:model="description" rows="4" class="w-full rounded-2xl border border-slate-200 px-4 py-3"></textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" wire:click="resetForm" class="rounded-2xl border border-slate-200 px-5 py-3 text-slate-900 hover:bg-slate-50">Annuler</button>
                    <button type="submit" class="rounded-2xl bg-orange-600 px-5 py-3 text-white font-semibold hover:bg-orange-700">{{ $formMode === 'create' ? 'Créer' : 'Mettre à jour' }}</button>
                </div>
            </form>
        </div>
    @endif

    <div class="rounded-3xl border border-slate-200 bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Titre</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Date</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Lieu</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Statut</th>
                        <th class="px-6 py-3 text-center uppercase tracking-[0.18em] text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($events as $event)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $event->title }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $event->start_at?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $event->location }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $event->status === 'planned' ? 'Planifié' : ($event->status === 'open' ? 'Ouvert' : 'Terminé') }}</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="openEdit({{ $event->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Éditer</button>
                                <button wire:click="delete({{ $event->id }})" class="ms-3 text-red-600 hover:text-red-700 font-semibold text-sm">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $events->links() }}
        </div>
    </div>
</div>
