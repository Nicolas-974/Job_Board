<?php

require_once __DIR__ . '/../Model/User.php';

class UserController
{
    private User $model;
    // Le contrôleur reçoit la connexion PDO et crée le modèle

    public function __construct(PDO $pdo)
    {
        $this->model = new User($pdo);
    }

    public function index()
    {
        // Numéro de page (par défaut 1)
        $page = isset($_GET['page_num']) ? (int) $_GET['page_num'] : 1;
        $limit = 10; // nombre d’utilisateurs par page
        $offset = ($page - 1) * $limit;

        // Récupération des données
        $users = $this->model->paginate($limit, $offset);
        $total = $this->model->countAll();
        $totalPages = ceil($total / $limit);

        // On charge la vue
        include __DIR__ . '/../View/users/index.php';
    }
    //Fonction pour le read
    public function show(int $id)
    {
        // 1. On récupère l’annonce par son id via le modèle
        $user = $this->model->find($id);

        // 2. Si aucune annonce trouvée
        if (!$user) {
            echo "<div class='alert alert-danger'>Utilisateur introuvable.</div>";
            return;
        }


        // 3. On charge la vue correspondante
        include __DIR__ . '/../View/users/show.php';
    }

    public function create(): void
    {
        include __DIR__ . '/../View/users/create.php';
    }

    //Fonction store() pour l'admin
    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $admin = $_POST['admin'] ?? 0; // 0 = utilisateur, 1 = admin

        if ($name && $email && $password) {
            $this->model->insert([
                'name' => $name,
                'firstname' => $firstname,
                'phone' => $phone,
                'address' => $address,
                'email' => $email,
                'admin' => $admin,     // ✅ cohérent avec ta table
                'password' => $password   // ✅ sera hashé dans le modèle
            ]);
        }

        header('Location: admin.php?section=users');
        exit;
    }

    //Fonction store() pour le public
    public function storePublic(): void
    {
        $name = $_POST['name'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmation = $_POST['confirmation'] ?? '';
        $admin = "user"; // par défaut, un candidat n’est pas admin

        // 1. Vérification des champs obligatoires
        if (!$name || !$email || !$password) {
            echo "<div class='alert alert-danger'>Veuillez remplir tous les champs obligatoires.</div>";
            return;
        }

        // 2. Vérification confirmation mot de passe
        if ($password !== $confirmation) {
            echo "<div class='alert alert-danger'>Les mots de passe ne correspondent pas.</div>";
            return;
        }

        // 3. Vérification email déjà existant
        // (il faut ajouter une méthode findByEmail() dans ton modèle User)
        if (method_exists($this->model, 'findByEmail')) {
            $existing = $this->model->findByEmail($email);
            if ($existing) {
                echo "<div class='alert alert-danger'>Cet email est déjà utilisé.</div>";
                return;
            }
        }

        // 4. Hash du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 5. Insertion en base et récupération de l’ID
        $id = $this->model->insert([
            'name' => $name,
            'firstname' => $firstname,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
            'admin' => $admin,
            'password' => $hashedPassword
        ]);

        // 6. Récupération de l’utilisateur inséré
        $user = $this->model->find($id);

        // 7. Mise en session
        $_SESSION['user'] = $user;

        // 8. Redirection vers profil
        header('Location: index.php?page=profil_user');
        exit;
    }

    public function edit(int $id): void
    {
        $user = $this->model->find($id);

        if (!$user) {
            echo "<div class='alert alert-danger'>Utilisateur introuvable.</div>";
            return;
        }

        include __DIR__ . '/../View/users/edit.php';
    }

    public function update(int $id): void
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'firstname' => $_POST['firstname'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'address' => $_POST['address'] ?? '',
            'email' => $_POST['email'] ?? '',
            'admin' => $_POST['admin'] ?? 0,
            'password' => $_POST['password'] ?? ''
        ];

        $this->model->update($id, $data);

        header('Location: admin.php?section=users');
        exit;
    }


    public function delete(int $id): void
    {
        $this->model->delete($id);
        header('Location: admin.php?section=users');
        exit;
    }


}



?>