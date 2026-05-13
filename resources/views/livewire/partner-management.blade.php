<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex-1">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Rechercher un partenaire..." class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-slate-900 focus:border-orange-300 focus:outline-none" />
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-3 text-white font-semibold hover:bg-orange-700">+ Nouveau partenaire</button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">{{ $formMode === 'create' ? 'Ajouter un partenaire' : 'Éditer le partenaire' }}</h3>
            <form wire:submit.prevent="save" class="space-y-5">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Nom *</label>
                        <input type="text" wire:model="name" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Website</label>
                        <input type="url" wire:model="website" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                        @error('website') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Logo URL</label>
                    <input type="url" wire:model="logo_url" class="w-full rounded-2xl border border-slate-200 px-4 py-3" />
                    @error('logo_url') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Description</label>
                    <textarea wire:model="description" rows="4" class="w-full rounded-2xl border border-slate-200 px-4 py-3"></textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
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
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Nom</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Website</th>
                        <th class="px-6 py-3 text-left uppercase tracking-[0.18em] text-slate-600">Logo</th>
                        <th class="px-6 py-3 text-center uppercase tracking-[0.18em] text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($partners as $partner)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $partner->name }}</td>
                            <td class="px-6 py-4 text-slate-600 break-all">@if($partner->website)<a href="{{ $partner->website }}" target="_blank" class="text-orange-600 hover:text-orange-700">Visiter</a>@else - @endif</td>
                            <td class="px-6 py-4 text-slate-600">@if($partner->logo_url)<a href="{{ $partner->logo_url }}" target="_blank" class="text-orange-600 hover:text-orange-700">Image</a>@else - @endif</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="openEdit({{ $partner->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Éditer</button>
                                <button wire:click="delete({{ $partner->id }})" class="ms-3 text-red-600 hover:text-red-700 font-semibold text-sm">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $partners->links() }}
        </div>
    </div>
</div>
