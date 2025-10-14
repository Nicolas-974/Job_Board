<?php

require_once __DIR__ . '/../Model/Company.php';
require_once __DIR__ . '/../Model/User.php';

class CompanyController
{
    private PDO $pdo;
    private Company $model;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->model = new Company($pdo);
    }

    public function index()
    {
        $page = isset($_GET['page_num']) ? (int) $_GET['page_num'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $companies = $this->model->paginate($limit, $offset);
        $total = $this->model->countAll();
        $totalPages = ceil($total / $limit);

        include __DIR__ . '/../View/companies/index.php';
    }

    public function show(int $id)
    {
        $company = $this->model->find($id);

        if (!$company) {
            echo "<div class='alert alert-danger'>Entreprise introuvable.</div>";
            return;
        }

        include __DIR__ . '/../View/companies/show.php';
    }

    public function create(): void
    {
        include __DIR__ . '/../View/companies/create.php';
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $sector = $_POST['sector'] ?? '';
        $location = $_POST['location'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';

        $this->model->insert([
            'name' => $name,
            'sector' => $sector,
            'location' => $location,
            'email' => $email,
            'phone' => $phone
        ]);

        header('Location: admin.php?section=companies');
        exit;
    }

    public function storePublic(): void
    {
        $userModel = new User($this->pdo);

        // Récupération des données du formulaire
        $lastname = $_POST['name'] ?? '';        // nom du représentant
        $firstname = $_POST['firstname'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirmation'] ?? '';

        $companyName = $_POST['company_name'] ?? ($_POST['name'] ?? '');
        $sector = $_POST['sector'] ?? '';
        $location = $_POST['location'] ?? '';

        // Vérifications basiques
        if (!$firstname || !$lastname || !$email || !$phone || !$password || !$companyName) {
            echo "<div class='alert alert-danger'>Veuillez remplir tous les champs obligatoires.</div>";
            return;
        }

        if ($password !== $confirm) {
            echo "<div class='alert alert-danger'>Les mots de passe ne correspondent pas.</div>";
            return;
        }

        // ⚠️ On NE hash plus ici : User::insert() s'en charge
        $userId = $userModel->insert([
            'name' => $lastname,
            'firstname' => $firstname,
            'phone' => $phone,
            'address' => $location,
            'email' => $email,
            'admin' => 'company',
            'password' => $password // mot de passe en clair → hashé dans User::insert()
        ]);

        // Insertion dans companies
        $this->model->insert([
            'name' => $companyName,
            'sector' => $sector,
            'location' => $location,
            'email' => $email,
            'phone' => $phone
        ]);

        // Mise en session de l’utilisateur
        $user = $userModel->find($userId);
        $_SESSION['user'] = $user;

        // Redirection vers le profil entreprise
        header('Location: index.php?page=profil_companies');
        exit;
    }
    public function edit(int $id): void
    {
        $company = $this->model->find($id);

        if (!$company) {
            echo "<div class='alert alert-danger'>Entreprise introuvable.</div>";
            return;
        }

        include __DIR__ . '/../View/companies/edit.php';
    }

    public function update(int $id): void
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'sector' => $_POST['sector'] ?? '',
            'location' => $_POST['location'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? ''
        ];

        $this->model->update($id, $data);

        header('Location: admin.php?section=companies');
        exit;
    }

    public function delete(int $id): void
    {
        $this->model->delete($id);
        header('Location: admin.php?section=companies');
        exit;
    }
}

?>