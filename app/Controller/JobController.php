<?php

    require_once __DIR__ . '/../Model/Job.php';

    


    class JobController
    {
        private Job $model;
        private PDO $pdo;

        // Le contrôleur reçoit la connexion PDO et crée le modèle

        public function __construct(PDO $pdo)
        {

            $this->pdo = $pdo;
            $this->model = new Job($pdo);
            
        }

        // Action "index" : liste tous les utilisateurs 
        public function index()
        {
            // 1. On récupère les utilisateurs via le modèle
            $jobs = $this->model->all();

            // ✅ On utilise $this->pdo
            $users = $this->pdo->query("SELECT people_id, name, firstname FROM people ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
            $ads = $this->pdo->query("SELECT ad_id, title FROM advertisements ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);


            // 2. On charge la vue correspondante
            include __DIR__ . '/../View/jobs/index.php';
        }

        //Fonction pour le read
        public function show(int $id)
        {
            // 1. On récupère l’annonce par son id via le modèle
            $job = $this->model->find($id);

            // 2. Si aucune annonce trouvée
            if (!$job) {
                echo "Candidature introuvable.";
                return;
            }

            // 3. On charge la vue correspondante
            include __DIR__ . '/../View/jobs/show.php';
        }

        public function create()
        {

            include __DIR__ . '/../View/jobs/create.php';
        }


        public function store(): void
        {
            $ad_id = $_POST['ad_id'] ?? null;
            $people_id = $_POST['people_id'] ?? null;
            $date = $_POST['date_candidature'] ?? date('Y-m-d H:i:s');

            if (!$ad_id || !$people_id) {
                echo "<div class='alert alert-danger'>Veuillez sélectionner un candidat et une offre.</div>";
                return;
            }

            $this->model->insert([
                'ad_id' => $ad_id,
                'people_id' => $people_id,
                'date_candidature' => $date
            ]);

            header('Location: admin.php?section=jobs');
            exit;
        }

        // Afficher le formulaire de modification
        public function edit(int $id)
        {
            $job = $this->model->find($id);

            if (!$job) {
                echo "<div class='alert alert-danger'>Candidature introuvable.</div>";
                return;
            }

            // On récupère aussi les listes pour les <select>
            $users = $this->pdo->query("SELECT people_id, name, firstname FROM people ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
            $ads = $this->pdo->query("SELECT ad_id, title FROM advertisements ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);

            include __DIR__ . '/../View/jobs/edit.php';
        }

        // Enregistrer la modification
        public function update(int $id): void
        {
            $ad_id = $_POST['ad_id'] ?? null;
            $people_id = $_POST['people_id'] ?? null;
            $date = $_POST['date_candidature'] ?? date('Y-m-d H:i:s');

            if (!$ad_id || !$people_id) {
                echo "<div class='alert alert-danger'>Veuillez sélectionner un candidat et une offre.</div>";
                return;
            }

            $this->model->update($id, [
                'ad_id' => $ad_id,
                'people_id' => $people_id,
                'date_candidature' => $date
            ]);

            header('Location: admin.php?section=jobs');
            exit;
        }

        public function delete(int $id)
        {
            $this->model->delete($id);

            // Après suppression, on revient à la liste
            header('Location: admin.php?section=jobs');
            exit;
        }


    }

?>