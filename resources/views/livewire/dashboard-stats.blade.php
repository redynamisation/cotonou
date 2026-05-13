<div class="space-y-6">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between text-slate-900">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Membres actifs</p>
                    <p class="mt-4 text-3xl font-semibold">{{ number_format($totalMembers) }}</p>
                </div>
                <div class="rounded-2xl bg-yellow-100 p-3 text-yellow-800">
                    <span class="text-xl">👥</span>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between text-slate-900">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Actions planifiées</p>
                    <p class="mt-4 text-3xl font-semibold">{{ number_format($activeActivities) }}</p>
                </div>
                <div class="rounded-2xl bg-orange-100 p-3 text-orange-800">
                    <span class="text-xl">🚀</span>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between text-slate-900">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Tâches terminées</p>
                    <p class="mt-4 text-3xl font-semibold">{{ number_format($completedTasks) }}</p>
                </div>
                <div class="rounded-2xl bg-yellow-100 p-3 text-yellow-800">
                    <span class="text-xl">✅</span>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between text-slate-900">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Fonds transparents</p>
                    <p class="mt-4 text-3xl font-semibold">{{ number_format($fundsRaised, 0, ',', ' ') }} FCFA</p>
                </div>
                <div class="rounded-2xl bg-orange-100 p-3 text-orange-800">
                    <span class="text-xl">💰</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-base font-semibold text-slate-900">Impact en temps réel</h3>
            <div class="mt-5 space-y-4">
                @foreach($impactStats as $label => $value)
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-4">
                        <p class="text-sm text-slate-600">{{ $label }}</p>
                        <span class="text-lg font-semibold text-slate-900">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-900">Leaderboard des bénévoles</h3>
                    <p class="mt-1 text-sm text-slate-500">Les membres les plus engagés ce mois-ci.</p>
                </div>
            </div>
            <div class="mt-6 space-y-4">
                @foreach($topMembers as $member)
                    <div class="flex items-center justify-between rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
                        <div>
                            <p class="font-semibold text-slate-900">{{ $member['name'] }}</p>
                            <p class="text-sm text-slate-500">{{ $member['role'] ?? 'Membre' }} - {{ $member['school'] ?? 'École / Université' }}</p>
                        </div>
                        <div class="rounded-full bg-orange-100 px-4 py-2 text-orange-700">{{ $member['points_motivation'] }} pts</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-base font-semibold text-slate-900">Événements récents</h3>
        <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($recentEvents as $event)
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm font-semibold text-slate-900">{{ $event['title'] }}</p>
                    <p class="mt-2 text-sm text-slate-500">{{ \Carbon\Carbon::parse($event['scheduled_at'])->format('d F Y') }}</p>
                    <p class="mt-3 text-sm text-slate-600">Budget: {{ number_format($event['budget'], 0, ',', ' ') }} FCFA</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
