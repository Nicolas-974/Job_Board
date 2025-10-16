<?php

class Advertisement
{
    private PDO $pdo; // Connexion à la base

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer toutes les annonces
    public function all(): array
    {
        $sql = "SELECT a.ad_id, a.title, a.location, a.contract_type, a.salary,
                       c.name AS company_name
                FROM advertisements a
                JOIN companies c ON a.company_id = c.company_id
                ORDER BY a.posted_date ASC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // Dernières annonces (pour la home)
    public function latest(int $limit = 6): array
    {
        $stmt = $this->pdo->prepare("
            SELECT ad_id, title, short_description
            FROM advertisements
            ORDER BY ad_id ASC
            LIMIT :limit
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Trouver une annonce par ID
    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT a.ad_id, a.title, a.location, a.contract_type, a.salary, a.description,
                   a.company_id, c.name AS company_name
            FROM advertisements a
            JOIN companies c ON a.company_id = c.company_id
            WHERE a.ad_id = :id
        ");
        $stmt->execute(['id' => $id]);
        $ad = $stmt->fetch();
        return $ad ?: null;
    }

    // Récupérer toutes les entreprises
    public function getCompanies(): array
    {
        $stmt = $this->pdo->query("SELECT company_id, name FROM companies");
        return $stmt->fetchAll();
    }

    // Pagination pour l’admin (corrigée avec toutes les colonnes nécessaires)
    public function paginate(int $limit, int $offset): array
    {
        $sql = "SELECT a.ad_id, a.title, a.location, a.contract_type, a.salary,
                       c.name AS company_name
                FROM advertisements a
                JOIN companies c ON a.company_id = c.company_id
                ORDER BY a.ad_id ASC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Compter le nombre total d’annonces
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) as total FROM advertisements";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch();
        return (int) $row['total'];
    }

    // Annonces d’une entreprise
    public function findByCompanyId(int $companyId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT ad_id, title, short_description, location, contract_type, salary, posted_date
            FROM advertisements
            WHERE company_id = :cid
            ORDER BY posted_date DESC, ad_id DESC
        ");
        $stmt->execute(['cid' => $companyId]);
        return $stmt->fetchAll();
    }

    // Pagination publique (avec détails complets)
    public function paginateWithDetails(int $limit, int $offset): array
    {
        $sql = "SELECT a.ad_id, a.title, a.short_description, a.description,
                       a.location, a.contract_type, a.salary, a.posted_date,
                       c.name AS company_name
                FROM advertisements a
                JOIN companies c ON a.company_id = c.company_id
                ORDER BY a.ad_id DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Mise à jour d’une annonce
    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE advertisements
            SET title = :title,
                location = :location,
                contract_type = :contract_type,
                salary = :salary,
                description = :description,
                company_id = :company_id
            WHERE ad_id = :id
        ");

        $stmt->execute([
            'title' => $data['title'],
            'location' => $data['location'],
            'contract_type' => $data['contract_type'],
            'salary' => $data['salary'],
            'description' => $data['description'],
            'company_id' => $data['company_id'],
            'id' => $id
        ]);
    }

    // Insertion d’une annonce
    public function insert(array $data): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO advertisements (title, location, contract_type, salary, description, company_id)
            VALUES (:title, :location, :contract_type, :salary, :description, :company_id)
        ");

        $stmt->execute([
            'title' => $data['title'],
            'location' => $data['location'],
            'contract_type' => $data['contract_type'],
            'salary' => $data['salary'],
            'description' => $data['description'],
            'company_id' => $data['company_id']
        ]);
    }

    // Suppression d’une annonce
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM advertisements WHERE ad_id = :id");
        $stmt->execute(['id' => $id]);
    }
}