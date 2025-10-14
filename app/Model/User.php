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

    // Récupérer une portion d'utilisateurs (pagination)
    public function paginate(int $limit, int $offset): array
    {
        $sql = "SELECT * FROM people ORDER BY people_id ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Compter le nombre total d'utilisateurs
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) as total FROM people";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch();
        return (int) $row['total'];
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

    // 🔍 Récupérer un utilisateur par son email
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM people WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function insert(array $data): int
    {
        // ✅ On hash le mot de passe avant insertion
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql = "INSERT INTO people (name, firstname, phone, address, email, admin, password)
            VALUES (:name, :firstname, :phone, :address, :email, :admin, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return (int) $this->pdo->lastInsertId();
    }
    public function update(int $id, array $data): void
    {
        // ✅ On hash le mot de passe seulement si un nouveau est fourni
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql = "UPDATE people 
            SET name = :name, firstname = :firstname, phone = :phone, 
                address = :address, email = :email, admin = :admin, password = :password
            WHERE people_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
    }
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM people WHERE people_id = :id");
        $stmt->execute(['id' => $id]);
    }




}

?>