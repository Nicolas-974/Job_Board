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

        // Action "index" : liste tous les utilisateurs
        public function index()
        {
            // 1. On récupère les utilisateurs via le modèle
            $users = $this->model->all();

            // 2. On charge la vue correspondante
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

        public function store(): void
        {
            $name      = $_POST['name'] ?? '';
            $firstname = $_POST['firstname'] ?? '';
            $phone     = $_POST['phone'] ?? '';
            $address   = $_POST['address'] ?? '';
            $email     = $_POST['email'] ?? '';
            $password  = $_POST['password'] ?? '';
            $admin     = $_POST['admin'] ?? 0; // 0 = utilisateur, 1 = admin

            if ($name && $email && $password) {
                $this->model->insert([
                    'name'      => $name,
                    'firstname' => $firstname,
                    'phone'     => $phone,
                    'address'   => $address,
                    'email'     => $email,
                    'admin'     => $admin,     // ✅ cohérent avec ta table
                    'password'  => $password   // ✅ sera hashé dans le modèle
                ]);
            }

            header('Location: admin.php?section=users');
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
                'name'      => $_POST['name'] ?? '',
                'firstname' => $_POST['firstname'] ?? '',
                'phone'     => $_POST['phone'] ?? '',
                'address'   => $_POST['address'] ?? '',
                'email'     => $_POST['email'] ?? '',
                'admin'     => $_POST['admin'] ?? 0,
                'password'  => $_POST['password'] ?? ''
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