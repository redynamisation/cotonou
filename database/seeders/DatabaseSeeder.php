<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Commission;
use App\Models\Event;
use App\Models\EventExpense;
use App\Models\Finance;
use App\Models\LibraryDocument;
use App\Models\Partner;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $commissions = [
            ['name' => 'Commission Sociale', 'slug' => 'sociale', 'description' => 'Salubrité des mosquées et dons aux orphelinats.', 'attributions' => 'Nettoyage, collecte de dons, soutien communautaire.'],
            ['name' => 'Commission Communication', 'slug' => 'communication', 'description' => 'Référencement sur les réseaux, thèmes mensuels et supports.', 'attributions' => 'Réseaux sociaux, visuels, cartes de membre.'],
            ['name' => 'Commission Formation', 'slug' => 'formation', 'description' => 'Montée en compétences des élèves et étudiants.', 'attributions' => 'Ateliers, suivi de coopératives, mentorat.'],
            ['name' => 'Commission Logistique', 'slug' => 'logistique', 'description' => 'Organisation d’événements et activités de santé.', 'attributions' => 'Conférences, dépistage, transport, accueil.'],
            ['name' => 'Commission Trésorerie', 'slug' => 'tresorerie', 'description' => 'Gestion des cotisations et recherche de financements.', 'attributions' => 'Cotisations, sponsoring, rapports financiers.'],
            ['name' => 'Supervision AGR', 'slug' => 'agr', 'description' => 'Suivi de la boutique et des investissements locaux.', 'attributions' => 'Rentabilité, ventes, partenariats commerciaux.'],
            ['name' => 'Commission Partenariats', 'slug' => 'partenariats', 'description' => 'Relations externes et sponsors pour rentabiliser les projets.', 'attributions' => 'Sponsors, événements payants, mécénat.'],
        ];

        foreach ($commissions as $commission) {
            Commission::create($commission);
        }

        $admin = User::factory()->create([
            'name' => 'Admin BuloC',
            'email' => 'admin@buloc.ci',
            'password' => 'password',
            'role' => 'admin',
            'points_motivation' => 1200,
            'school' => 'Université de Cotonou',
            'member_code' => Str::upper(Str::random(10)),
        ]);

        $socialLead = User::factory()->create([
            'name' => 'Fatou Aïssatou',
            'email' => 'fatou@buloc.ci',
            'password' => 'password',
            'role' => 'lead_sociale',
            'commission_id' => Commission::where('slug', 'sociale')->value('id'),
            'points_motivation' => 820,
            'school' => 'Ecole Normale Supérieure',
            'member_code' => Str::upper(Str::random(10)),
        ]);

        $comLead = User::factory()->create([
            'name' => 'Olivier Mensah',
            'email' => 'j',
            'password' => 'password',
            'role' => 'lead_communication',
            'commission_id' => Commission::where('slug', 'communication')->value('id'),
            'points_motivation' => 680,
            'school' => 'Institut Supérieur de Communication',
            'member_code' => Str::upper(Str::random(10)),
        ]);

        $members = User::factory(6)->state(function () {
            return [
                'role' => 'member',
                'member_code' => Str::upper(Str::random(10)),
            ];
        })->create();

        $activities = [
            ['commission_slug' => 'sociale', 'title' => 'Nettoyage des mosquées locales', 'scheduled_at' => Carbon::now()->addDays(4), 'status' => 'active', 'budget' => 150000, 'impact_metric' => 'mosquée', 'notes' => 'Opération de salubrité avec les jeunes volontaires.'],
            ['commission_slug' => 'sociale', 'title' => 'Collecte pour orphelinats', 'scheduled_at' => Carbon::now()->addDays(10), 'status' => 'planned', 'budget' => 80000, 'impact_metric' => 'orphelinat', 'notes' => 'Dons de fournitures et denrées alimentaires.'],
            ['commission_slug' => 'communication', 'title' => 'Campagne réseaux sociaux', 'scheduled_at' => Carbon::now()->addDays(2), 'status' => 'active', 'budget' => 12000, 'impact_metric' => 'visuel', 'notes' => 'Lancement de thèmes mensuels et posts d’engagement.'],
            ['commission_slug' => 'communication', 'title' => 'Création de cartes de membre', 'scheduled_at' => Carbon::now()->addDays(1), 'status' => 'active', 'budget' => 9000, 'impact_metric' => 'carte', 'notes' => 'Cartes numériques avec QR code pour les membres.'],
            ['commission_slug' => 'formation', 'title' => 'Atelier de graphisme', 'scheduled_at' => Carbon::now()->addDays(7), 'status' => 'planned', 'budget' => 25000, 'impact_metric' => 'atelier', 'notes' => 'Formation pratique sur Canva et design social.'],
            ['commission_slug' => 'formation', 'title' => 'Suivi de coopérative locale', 'scheduled_at' => Carbon::now()->addDays(9), 'status' => 'planned', 'budget' => 30000, 'impact_metric' => 'coopérative', 'notes' => 'Accompagnement des partenaires locaux.'],
            ['commission_slug' => 'logistique', 'title' => 'Conférence santé communautaire', 'scheduled_at' => Carbon::now()->addDays(14), 'status' => 'planned', 'budget' => 50000, 'impact_metric' => 'conférence', 'notes' => 'Organisation d’une journée de dépistage.'],
            ['commission_slug' => 'logistique', 'title' => 'Campagne de dépistage', 'scheduled_at' => Carbon::now()->addDays(12), 'status' => 'planned', 'budget' => 40000, 'impact_metric' => 'dépistage', 'notes' => 'Mobilisation de la communauté et centres mobiles.'],
            ['commission_slug' => 'tresorerie', 'title' => 'Suivi des cotisations', 'scheduled_at' => Carbon::now()->addDays(3), 'status' => 'active', 'budget' => 0, 'impact_metric' => 'cotisation', 'notes' => 'Collecte des cotisations mensuelles de 5 000 à 10 000 FCFA.'],
            ['commission_slug' => 'tresorerie', 'title' => 'Rapport de transparence', 'scheduled_at' => Carbon::now()->addDays(11), 'status' => 'planned', 'budget' => 10000, 'impact_metric' => 'rapport', 'notes' => 'Publication du rapport financier mensuel.'],
            ['commission_slug' => 'agr', 'title' => 'Audit rentabilité boutique', 'scheduled_at' => Carbon::now()->addDays(5), 'status' => 'active', 'budget' => 20000, 'impact_metric' => 'vente', 'notes' => 'Suivi des ventes et marge des produits.'],
            ['commission_slug' => 'agr', 'title' => 'Investissement local', 'scheduled_at' => Carbon::now()->addDays(20), 'status' => 'planned', 'budget' => 60000, 'impact_metric' => 'investissement', 'notes' => 'Recherche de rentabilité pour la boutique.'],
            ['commission_slug' => 'partenariats', 'title' => 'Vente de tickets événementiels', 'scheduled_at' => Carbon::now()->addDays(18), 'status' => 'planned', 'budget' => 120000, 'impact_metric' => 'billetterie', 'notes' => 'Création de l’événement public pour générer des fonds.'],
            ['commission_slug' => 'partenariats', 'title' => 'Recherche de sponsors', 'scheduled_at' => Carbon::now()->addDays(6), 'status' => 'active', 'budget' => 25000, 'impact_metric' => 'sponsor', 'notes' => 'Démarchage de partenaires économiques.'],
            ['commission_slug' => 'communication', 'title' => 'Thème mensuel de motivation', 'scheduled_at' => Carbon::now()->addDays(8), 'status' => 'planned', 'budget' => 15000, 'impact_metric' => 'thème', 'notes' => 'Conception du thème du mois et des hashtags.'],
        ];

        foreach ($activities as $activityData) {
            $commissionId = Commission::where('slug', $activityData['commission_slug'])->value('id');
            Activity::create([
                'commission_id' => $commissionId,
                'title' => $activityData['title'],
                'scheduled_at' => $activityData['scheduled_at'],
                'status' => $activityData['status'],
                'budget' => $activityData['budget'],
                'impact_metric' => $activityData['impact_metric'],
                'notes' => $activityData['notes'],
            ]);
        }

        Task::create([
            'activity_id' => Activity::where('title', 'Nettoyage des mosquées locales')->value('id'),
            'responsible_id' => $socialLead->id,
            'title' => 'Coordonner l’équipe de nettoyage',
            'points_allocated' => 50,
            'is_completed' => true,
            'due_date' => Carbon::now()->addDays(4),
            'notes' => 'Planifier les équipes et les zones de travail.',
        ]);

        Task::create([
            'activity_id' => Activity::where('title', 'Campagne réseaux sociaux')->value('id'),
            'responsible_id' => $comLead->id,
            'title' => 'Publier le calendrier des posts',
            'points_allocated' => 35,
            'is_completed' => false,
            'due_date' => Carbon::now()->addDays(2),
            'notes' => 'Préparer visuels et messages pour 4 semaines.',
        ]);

        Task::create([
            'activity_id' => Activity::where('title', 'Suivi des cotisations')->value('id'),
            'responsible_id' => $admin->id,
            'title' => 'Saisir les paiements reçus',
            'points_allocated' => 40,
            'is_completed' => true,
            'due_date' => Carbon::now()->addDays(1),
            'notes' => 'Enregistrer les cotisations de la semaine.',
        ]);

        Finance::create(['type_flux' => 'cotisation', 'amount' => 65000, 'commission_id' => Commission::where('slug', 'tresorerie')->value('id'), 'source' => 'Cotisations adhérents', 'notes' => 'Collecte mensuelle de 5 000 à 10 000 FCFA.',]);
        Finance::create(['type_flux' => 'sponsoring', 'amount' => 120000, 'commission_id' => Commission::where('slug', 'partenariats')->value('id'), 'source' => 'Sponsor local', 'notes' => 'Soutien pour la billetterie et les conférences.',]);
        Finance::create(['type_flux' => 'vente', 'amount' => 93000, 'commission_id' => Commission::where('slug', 'agr')->value('id'), 'source' => 'Boutique associative', 'notes' => 'Ventes de produits artisanaux et t-shirts BuloC.',]);
        Finance::create(['type_flux' => 'dépense', 'amount' => 42000, 'commission_id' => Commission::where('slug', 'logistique')->value('id'), 'source' => 'Matériel événementiel', 'notes' => 'Achats de matériel pour conférence et dépistage.',]);

        $forumBuloC = Event::create([
            'commission_id' => Commission::where('slug', 'partenariats')->value('id'),
            'title' => 'Forum Jeunesse BuloC',
            'description' => 'Une journée de rencontres, de formation et de collecte de fonds pour les projets associatifs.',
            'location' => 'Centre Culturel de Cotonou',
            'start_at' => Carbon::now()->addDays(7)->setTime(14, 0),
            'end_at' => Carbon::now()->addDays(7)->setTime(18, 0),
            'price' => 2500,
            'status' => 'open',
            'poster_url' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80',
        ]);

        $conferenceSante = Event::create([
            'commission_id' => Commission::where('slug', 'logistique')->value('id'),
            'title' => 'Conférence Santé Communautaire',
            'description' => 'Session de sensibilisation et actions concrètes pour la santé des jeunes et des familles.',
            'location' => 'Salle Polyvalente BuloC',
            'start_at' => Carbon::now()->addDays(12)->setTime(9, 30),
            'end_at' => Carbon::now()->addDays(12)->setTime(13, 0),
            'price' => 3000,
            'status' => 'planned',
            'poster_url' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80',
        ]);

        $atelierGraphisme = Event::create([
            'commission_id' => Commission::where('slug', 'communication')->value('id'),
            'title' => 'Atelier Graphisme Jeunes',
            'description' => 'Atelier pratique pour apprendre à créer des visuels attractifs pour les réseaux sociaux.',
            'location' => 'Laboratoire Multimédia',
            'start_at' => Carbon::now()->addDays(4)->setTime(10, 0),
            'end_at' => Carbon::now()->addDays(4)->setTime(13, 0),
            'price' => 1500,
            'status' => 'open',
            'poster_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80',
        ]);

        EventExpense::create([
            'event_id' => $conferenceSante->id,
            'description' => 'Location de la salle et matériel technique',
            'amount' => 42000,
            'occurred_at' => Carbon::now()->subDays(2),
            'notes' => 'Achat des supports et impression des flyers.',
        ]);

        EventExpense::create([
            'event_id' => $forumBuloC->id,
            'description' => 'Approvisionnement boissons et snack',
            'amount' => 18000,
            'occurred_at' => Carbon::now()->subDays(1),
            'notes' => 'Préparation des rafraîchissements pour les participants.',
        ]);

        $announcements = [
            ['commission_slug' => 'communication', 'title' => 'Lancement du thème national', 'content' => 'La commission communication lance un nouveau thème pour encourager l’engagement chaque semaine.', 'type' => 'annonce'],
            ['commission_slug' => 'tresorerie', 'title' => 'Rapport de transparence publié', 'content' => 'La trésorerie publie le rapport financier du trimestre et précise les besoins de financement.', 'type' => 'communique'],
            ['commission_slug' => 'partenariats', 'title' => 'Nouveau sponsor local', 'content' => 'Nous avons signé un partenariat avec une association locale pour soutenir la billetterie.', 'type' => 'annonce'],
        ];

        foreach ($announcements as $announcementData) {
            Announcement::create([
                'commission_id' => Commission::where('slug', $announcementData['commission_slug'])->value('id'),
                'title' => $announcementData['title'],
                'content' => $announcementData['content'],
                'type' => $announcementData['type'],
                'published_at' => Carbon::now()->subDays(rand(1, 5)),
            ]);
        }

        LibraryDocument::create([ 'title' => 'Guide de la prière en groupe', 'description' => 'Fiches pratiques pour organiser les prières et les médiations.', 'category' => 'Islamique', 'url' => 'https://example.com/guide-priere.pdf', ]);
        LibraryDocument::create([ 'title' => 'Charte associative BuloC', 'description' => 'Modèle de charte pour les membres et les commissions.', 'category' => 'Administration', 'url' => 'https://example.com/charte-buloc.pdf', ]);
        LibraryDocument::create([ 'title' => 'Kit de communication', 'description' => 'Modèles de visuels, flyers et messages pour les réseaux sociaux.', 'category' => 'Communication', 'url' => 'https://example.com/kit-communication.pdf', ]);

        Partner::create([ 'name' => 'Université de Cotonou', 'description' => 'Partenaire institutionnel pour les formations et événements.', 'website' => 'https://unicotonou.example.com', 'logo_url' => 'https://images.unsplash.com/photo-1508973374398-3c70adfc3bea?auto=format&fit=crop&w=600&q=80', ]);
        Partner::create([ 'name' => 'Fondation Jeunesse', 'description' => 'Soutien logistique et sponsoring pour les projets sociaux.', 'website' => 'https://fondationjeunesse.example.com', 'logo_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80', ]);
        Partner::create([ 'name' => 'Club des Étudiants', 'description' => 'Réseau de mobilisateurs pour les campagnes de terrain.', 'website' => 'https://clubetudiants.example.com', 'logo_url' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=600&q=80', ]);

        Ticket::create(['event_name' => 'Forum Jeunesse BuloC', 'user_external_name' => 'Patrice K.', 'qr_code' => Str::upper(Str::random(12)), 'price' => 2500, 'sold_at' => Carbon::now()->subDays(1), 'event_id' => $forumBuloC->id,]);
        Ticket::create(['event_name' => 'Conférence Santé Communautaire', 'user_external_name' => 'Nadia O.', 'qr_code' => Str::upper(Str::random(12)), 'price' => 3000, 'sold_at' => Carbon::now()->subDays(2), 'event_id' => $conferenceSante->id,]);
        Ticket::create(['event_name' => 'Atelier Graphisme Jeunes', 'user_external_name' => 'Blaise D.', 'qr_code' => Str::upper(Str::random(12)), 'price' => 1500, 'sold_at' => Carbon::now()->subDays(3), 'event_id' => $atelierGraphisme->id,]);
    }
}
