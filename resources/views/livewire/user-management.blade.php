<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-3xl border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex-1">
            <input type="text" wire:model.live="search" placeholder="Rechercher par nom ou email..." 
                   class="w-full rounded-3xl border border-slate-200 px-4 py-2 text-slate-900 placeholder-slate-400 focus:border-orange-500 focus:outline-none">
        </div>
        <button wire:click="openCreate" class="rounded-3xl bg-orange-600 px-6 py-2 text-white font-semibold hover:bg-orange-700">
            + Ajouter un utilisateur
        </button>
    </div>

    @if ($showForm)
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">
                {{ $formMode === 'create' ? 'Créer un utilisateur' : 'Éditer l\'utilisateur' }}
            </h3>
            <form wire:submit="save" class="space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Nom *</label>
                        <input type="text" wire:model="name" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">E-mail *</label>
                        <input type="email" wire:model="email" required {{ $formMode === 'edit' ? 'disabled' : '' }} class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if ($formMode === 'create')
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Mot de passe *</label>
                        <input type="password" wire:model="password" required class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                        @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                @endif

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Rôle *</label>
                        <select wire:model="role" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                            <option value="member">Membre</option>
                            <option value="lead_sociale">Lead Commission Sociale</option>
                            <option value="lead_communication">Lead Communication</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-1">Commission</label>
                        <select wire:model="commission_id" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
                            <option value="">-- Aucune --</option>
                            @foreach ($commissions as $commission)
                                <option value="{{ $commission->id }}">{{ $commission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-1">École/Université</label>
                    <input type="text" wire:model="school" class="w-full rounded-2xl border border-slate-200 px-3 py-2">
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
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">E-mail</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Rôle</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-600">Commission</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-900 font-semibold">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold" 
                                      :class="{
                                        'bg-orange-100 text-orange-700': '{{ $user->role }}' === 'admin',
                                        'bg-yellow-100 text-yellow-700': '{{ $user->role }}' === 'lead_sociale' || '{{ $user->role }}' === 'lead_communication',
                                        'bg-slate-100 text-slate-700': '{{ $user->role }}' === 'member'
                                      }">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $user->commission?->name ?? '--' }}</td>
                            <td class="px-6 py-4 text-center">
                                <button wire:click="openEdit({{ $user->id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">Éditer</button>
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Êtes-vous sûr ?" class="text-red-600 hover:text-red-700 font-semibold text-sm ms-3">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
