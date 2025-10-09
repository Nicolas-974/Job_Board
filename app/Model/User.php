<?php

    class User
    {
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        // Récupérer tous les utilisateurs avec toutes les colonnes
        public function all(): array
        {
            // Ici on sélectionne * pour prendre toutes les colonnes de la table people
            $sql = "SELECT * FROM people ORDER BY people_id ASC";
            $stmt = $this->pdo->query($sql);

            // $users = $stmt->fetchAll();

            // On re-hash les mots de passe récupérés (⚠️ temporaire)
            // foreach ($users as &$user) {
            //     $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            // }

            
            
            return $stmt->fetchAll();
            // return $users;
        }

        // Récupérer un utilisateur par son ID
        public function find(int $id): ?array
        {
            $stmt = $this->pdo->prepare("SELECT * FROM people WHERE people_id = :id");
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch();

            // if ($user) {
            //     // On re-hash le mot de passe récupéré (⚠️ temporaire)
            //     $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            // }

            return $user ?: null;
        }

        // Insérer un nouvel utilisateur
        public function insert(array $data): void
        {
            $stmt = $this->pdo->prepare(
                "INSERT INTO people (name, firstname, phone, address, email, admin, password) 
                VALUES (:name, :firstname, :phone, :address, :email, :admin, :password)"
            );

            $stmt->execute([
                'name'      => $data['name'],
                'firstname' => $data['firstname'],
                'phone'     => $data['phone'],
                'address'   => $data['address'],
                'email'     => $data['email'],
                'admin'     => $data['admin'], // 0 ou 1
                'password'  => $data['password']
            ]);
        }

        public function update(int $id, array $data): void
        {
            $stmt = $this->pdo->prepare(
                "UPDATE people SET 
                    name = :name,
                    firstname = :firstname,
                    phone = :phone,
                    address = :address,
                    email = :email,
                    admin = :admin,
                    password = :password
                WHERE people_id = :id"
            );

            $stmt->execute([
                'id'        => $id,
                'name'      => $data['name'],
                'firstname' => $data['firstname'],
                'phone'     => $data['phone'],
                'address'   => $data['address'],
                'email'     => $data['email'],
                'admin'     => $data['admin'],
                'password'  => $data['password']
            ]);
        }

        public function delete(int $id): void
        {
            $stmt = $this->pdo->prepare("DELETE FROM people WHERE people_id = :id");
            $stmt->execute(['id' => $id]);
        }

        


    }

?>