<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex-1 flex gap-2">
            <input type="text" wire:model.live="search" placeholder="Rechercher une activité..." 
                   class="flex-1 rounded-3xl border border-slate-200 px-4 py-2 text-slate-900 placeholder-slate-400 focus:border-orange-500 focus:outline-none">
            <select wire:model.live="filterCommission" class="rounded-3xl border border-slate-200 px-4 py-2">
                <option value="">-- Commission --</option>
                @foreach ($commissions as $commission)
                    <option value="{{ $commission->id }}">{{ $commission->name }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterStatus" class="rounded-3xl border border-slate-200 px-4 py-2">
                <option value="">-- Statut --</option>
                <option value="planned">Planifiée</option>
                <option value="active">Active</option>
                <option value="completed">Terminée</option>
                <option value="cancelled">Annulée</option>
            </select>
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-2 text-white font-semibold hover:bg-orange-700 whitespace-nowrap">
            + Créer
        </button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">
                {{ $formMode === 'create' ? 'Créer une activité' : 'Éditer l\'activité' }}
            </h3>
            <form wire:submit="save" class="space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Commission *</label>
                        <select wire:model="commission_id" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                            <option value="">-- Choisir --</option>
                            @foreach ($commissions as $commission)
                                <option value="{{ $commission->id }}">{{ $commission->name }}</option>
                            @endforeach
                        </select>
                        @error('commission_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Titre *</label>
                        <input type="text" wire:model="title" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                        @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Date/Heure *</label>
                        <input type="datetime-local" wire:model="scheduled_at" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                        @error('scheduled_at') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Statut *</label>
                        <select wire:model="status" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                            <option value="planned">Planifiée</option>
                            <option value="active">Active</option>
                            <option value="completed">Terminée</option>
                            <option value="cancelled">Annulée</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Budget (FCFA)</label>
                        <input type="number" wire:model="budget" step="0.01" min="0" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Métrique d'impact</label>
                        <input type="text" wire:model="impact_metric" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Notes</label>
                    <textarea wire:model="notes" rows="3" class="w-full rounded-2xl border border-slate-200 px-3 py-2"></textarea>
                </div>

                <div class="flex gap-3 justify-end">
                    <button type="button" wire:click="resetForm" class="rounded-2xl border border-slate-200 px-4 py-2 text-slate-900 hover:bg-slate-50">
                        Annuler
                    </button>
                    <button type="submit" class="rounded-2xl bg-orange-600 px-4 py-2 text-white font-semibold hover:bg-orange-700">
                        {{ $formMode === 'create' ? 'Créer' : 'Mettre à jour' }}
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="rounded-3xl border border-slate-200 bg-white overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Titre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Commission</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Budget</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($activities as $activity)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $activity->title }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $activity->commission->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $activity->scheduled_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                                      :class="{
                                        'bg-yellow-100 text-yellow-700': '{{ $activity->status }}' === 'planned',
                                        'bg-green-100 text-green-700': '{{ $activity->status }}' === 'active',
                                        'bg-blue-100 text-blue-700': '{{ $activity->status }}' === 'completed',
                                        'bg-red-100 text-red-700': '{{ $activity->status }}' === 'cancelled'
                                      }">
                                    {{ $activity->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ number_format($activity->budget, 0, ',', ' ') }} FCFA</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="openEdit({{ $activity->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Éditer</button>
                                <button wire:click="delete({{ $activity->id }})" wire:confirm="Êtes-vous sûr ?" class="text-red-600 hover:text-red-700 font-semibold text-sm ms-3">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $activities->links() }}
        </div>
    </div>
</div>
