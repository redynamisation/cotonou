<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex-1 flex gap-2">
            <input type="text" wire:model.live="search" placeholder="Rechercher une tâche..." 
                   class="flex-1 rounded-3xl border border-slate-200 px-4 py-2 text-slate-900 placeholder-slate-400 focus:border-orange-500 focus:outline-none">
            <select wire:model.live="filterActivity" class="rounded-3xl border border-slate-200 px-4 py-2">
                <option value="">-- Activité --</option>
                @foreach ($activities as $activity)
                    <option value="{{ $activity->id }}">{{ $activity->title }}</option>
                @endforeach
            </select>
            <select wire:model.live="filterCompleted" class="rounded-3xl border border-slate-200 px-4 py-2">
                <option value="">-- Statut --</option>
                <option value="0">En cours</option>
                <option value="1">Terminée</option>
            </select>
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-2 text-white font-semibold hover:bg-orange-700 whitespace-nowrap">
            + Créer
        </button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">
                {{ $formMode === 'create' ? 'Créer une tâche' : 'Éditer la tâche' }}
            </h3>
            <form wire:submit="save" class="space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Activité *</label>
                        <select wire:model="activity_id" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                            <option value="">-- Choisir --</option>
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->title }}</option>
                            @endforeach
                        </select>
                        @error('activity_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Responsable *</label>
                        <select wire:model="responsible_id" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                            <option value="">-- Choisir --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('responsible_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">Titre *</label>
                    <input type="text" wire:model="title" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                    @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Points alloués *</label>
                        <input type="number" wire:model="points_allocated" required step="1" min="0" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                        @error('points_allocated') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Date limite</label>
                        <input type="date" wire:model="due_date" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">
                        <input type="checkbox" wire:model="is_completed" class="me-2 rounded">
                        Tâche terminée
                    </label>
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
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Activité</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Responsable</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Points</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Statut</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($tasks as $task)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $task->title }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $task->activity->title }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $task->responsible->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $task->points_allocated }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                                      :class="{ 'bg-green-100 text-green-700': {{ $task->is_completed ? 'true' : 'false' }}, 'bg-yellow-100 text-yellow-700': !{{ $task->is_completed ? 'true' : 'false' }} }">
                                    {{ $task->is_completed ? 'Terminée' : 'En cours' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="toggleComplete({{ $task->id }})" class="text-green-600 hover:text-green-700 font-semibold text-sm">
                                    {{ $task->is_completed ? 'Réactiver' : 'Compléter' }}
                                </button>
                                <button wire:click="openEdit({{ $task->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm ms-3">Éditer</button>
                                <button wire:click="delete({{ $task->id }})" wire:confirm="Êtes-vous sûr ?" class="text-red-600 hover:text-red-700 font-semibold text-sm ms-3">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
