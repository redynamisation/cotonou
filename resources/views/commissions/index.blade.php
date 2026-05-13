<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-slate-900 leading-tight">Commissions</h2>
                <p class="mt-1 text-sm text-slate-500">Vue d’ensemble des équipes et missions en cours.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50">Retour au dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 xl:grid-cols-3">
                @foreach($commissions as $commission)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">{{ $commission->name }}</h3>
                                <p class="mt-2 text-sm text-slate-500">{{ $commission->slug }}</p>
                            </div>
                            <div class="rounded-2xl bg-yellow-100 px-3 py-2 text-yellow-800">{{ $commission->users_count }} membres</div>
                        </div>

                        <p class="mt-5 text-sm leading-6 text-slate-600">{{ $commission->description }}</p>
                        <div class="mt-5 flex items-center justify-between text-sm text-slate-500">
                            <span>{{ $commission->activities_count }} actions</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-700">{{ $commission->attributions }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
