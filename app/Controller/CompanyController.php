<?php

    require_once __DIR__ . '/../Model/Company.php';

    class CompanyController
    {
        private Company $model;

        public function __construct(PDO $pdo)
        {
            $this->model = new Company($pdo);
        }

        public function index()
        {
            $companies = $this->model->all();

            // 2. On charge la vue correspondante
            include __DIR__ . '/../View/companies/index.php';
        }

        public function show(int $id)
        {
            $company = $this->model->find($id);

            if(!$company){
                echo "<div class='alert alert-danger'>Entreprise introuvable.</div>";
                return;
            }

            // 3. On charge la vue correspondante
            include __DIR__ . '/../View/companies/show.php';
        }

        public function create(): void
        {
            include __DIR__ . '/../View/companies/create.php';
        }

        public function store(): void
        {
            $name       = $_POST['name'] ?? '';
            $sector     = $_POST['sector'] ?? '';
            $location   = $_POST['location'] ?? '';
            $email      = $_POST['email'] ?? '';
            $phone      = $_POST['phone'] ?? '';

            $this->model->insert([
                'name'      => $name,
                'sector'    => $sector,
                'location'  => $location,
                'email'     => $email,
                'phone'     => $phone
            ]);

            // 3. On redirige vers la liste des annonces
            header('Location: admin.php?section=companies');
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
                'name'     => $_POST['name'] ?? '',
                'sector'   => $_POST['sector'] ?? '',
                'location' => $_POST['location'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'phone'    => $_POST['phone'] ?? ''
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