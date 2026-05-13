<footer class="border-t border-slate-200 bg-slate-950 text-slate-300">
    <div class="mx-auto max-w-7xl px-6 py-10 sm:px-8 lg:px-10">
        <div class="grid gap-10 md:grid-cols-[1.6fr_1fr_1fr]">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-300">BuloC de Cotonou</p>
                <p class="mt-4 max-w-md text-sm leading-6 text-slate-400">Plateforme associative jeunesse pour coordonner les commissions, les événements, la trésorerie et la communication.</p>
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-200">Liens rapides</p>
                <div class="mt-4 space-y-3 text-sm text-slate-400">
                    <a href="{{ route('home') }}" class="block hover:text-white">Accueil</a>
                    <a href="{{ route('announcements.index') }}" class="block hover:text-white">Annonces</a>
                    <a href="{{ route('library.index') }}" class="block hover:text-white">Bibliothèque</a>
                    <a href="{{ route('partners.index') }}" class="block hover:text-white">Partenaires</a>
                </div>
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-200">Contact</p>
                <p class="mt-4 text-sm leading-6 text-slate-400">Support BuloC, Cotonou<br>contact@buloc.ci</p>
            </div>
        </div>
        <div class="mt-10 border-t border-slate-800 pt-6 text-sm text-slate-500">© {{ date('Y') }} BuloC de Cotonou. Tous droits réservés.</div>
    </div>
</footer>
