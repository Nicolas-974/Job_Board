<?php
require_once __DIR__ . '/../Model/Advertisement.php';


class AdvertisementController
{
    private Advertisement $model;

    // Le contrôleur reçoit la connexion PDO et crée le modèle
    public function __construct(PDO $pdo)
    {
        $this->model = new Advertisement($pdo);
    }

    // Action "index" : liste toutes les annonces
    public function index()
    {
        // 1. On récupère les annonces via le modèle
        $ads = $this->model->all();

        // 2. On récupère aussi les entreprises pour le formulaire
        $companies = $this->model->getCompanies();


        // 2. On charge la vue correspondante
        include __DIR__ . '/../View/advertisements/index.php';
    }

    //Fonction create, store et insert pour le create
    public function create()
    {
        // On récupère les entreprises depuis la base
        $companies = $this->model->getCompanies();


        // On affiche le formulaire avec les entreprises disponibles
        include __DIR__ . '/../View/advertisements/create.php';
    }

    public function store()
    {
        // 1. On récupère les données du formulaire
        $title = $_POST['title'] ?? '';
        $location = $_POST['location'] ?? '';
        $contract_type = $_POST['contract_type'] ?? '';
        $salary = $_POST['salary'] ?? '';
        $description = $_POST['description'] ?? '';
        $company_id = $_POST['company_id'] ?? null;

        // 2. On insère l’annonce via le modèle
        $this->model->insert([
            'title' => $title,
            'location' => $location,
            'contract_type' => $contract_type,
            'salary' => $salary,
            'description' => $description,
            'company_id' => $company_id
        ]);

        // 3. On redirige vers la liste des annonces
        header('Location: admin.php?section=offers');
        exit;
    }

    //Fonction pour le read
    public function show(int $id)
    {
        // 1. On récupère l’annonce par son id via le modèle
        $ad = $this->model->find($id);

        // 2. Si aucune annonce trouvée
        if (!$ad) {
            echo "Annonce introuvable.";
            return;
        }

        // 3. On charge la vue correspondante
        include __DIR__ . '/../View/advertisements/show.php';
    }

    //Fonction pour le update
    public function edit(int $id)
    {
        // 1. Récupérer l’annonce
        $ad = $this->model->find($id);
        if (!$ad) {
            echo "Annonce introuvable.";
            return;
        }

        // 2. Récupérer les entreprises
        $companies = $this->model->getCompanies();


        // 3. Afficher le formulaire pré-rempli
        include __DIR__ . '/../View/advertisements/edit.php';
    }

    public function update(int $id)
    {
        // 1. Récupérer les données du formulaire
        $title = $_POST['title'] ?? '';
        $location = $_POST['location'] ?? '';
        $contract_type = $_POST['contract_type'] ?? '';
        $salary = $_POST['salary'] ?? '';
        $description = $_POST['description'] ?? '';
        $company_id = $_POST['company_id'] ?? null;

        // 2. Mettre à jour l’annonce via le modèle
        $this->model->update($id, [
            'title' => $title,
            'location' => $location,
            'contract_type' => $contract_type,
            'salary' => $salary,
            'description' => $description,
            'company_id' => $company_id
        ]);

        // 3. Rediriger vers la liste
        header('Location: admin.php?section=offers');
        exit;
    }

    public function delete(int $id)
    {
        $this->model->delete($id);

        // Après suppression, on revient à la liste
        header('Location: admin.php?section=offers');
        exit;
    }

}