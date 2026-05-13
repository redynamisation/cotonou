<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex-1">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Rechercher une annonce..." class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-orange-300 focus:outline-none" />
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-3 text-white font-semibold hover:bg-orange-700">+ Nouvelle annonce</button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">{{ $formMode === 'create' ? 'Créer une annonce' : 'Éditer l’annonce' }}</h3>
            <form wire:submit.prevent="save" class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Titre *</label>
                        <input type="text" wire:model="title" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Type *</label>
                        <select wire:model="type" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                            <option value="annonce">Annonce</option>
                            <option value="communique">Communiqué</option>
                        </select>
                        @error('type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Commission</label>
                    <select wire:model="commission_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
                        <option value="">Général</option>
                        @foreach($commissions as $commission)
                            <option value="{{ $commission->id }}">{{ $commission->name }}</option>
                        @endforeach
                    </select>
                    @error('commission_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Contenu *</label>
                    <textarea wire:model="content" rows="5" class="w-full rounded-2xl border border-slate-200 px-4 py-3"></textarea>
                    @error('content') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <button type="button" wire:click="resetForm" class="rounded-2xl border border-slate-200 px-5 py-3 text-slate-900 hover:bg-slate-50">Annuler</button>
                    <button type="submit" class="rounded-2xl bg-orange-600 px-5 py-3 text-white font-semibold hover:bg-orange-700">{{ $formMode === 'create' ? 'Publier' : 'Mettre à jour' }}</button>
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
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Type</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Commission</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Publié</th>
                        <th class="px-6 py-3 text-center uppercase tracking-[0.18em] text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($announcements as $announcement)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $announcement->title }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ ucfirst($announcement->type) }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $announcement->commission?->name ?? 'Général' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $announcement->published_at?->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="openEdit({{ $announcement->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Éditer</button>
                                <button wire:click="delete({{ $announcement->id }})" class="ms-3 text-red-600 hover:text-red-700 font-semibold text-sm">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
