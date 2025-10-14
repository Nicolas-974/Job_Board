<?php

class Advertisement
{
    private PDO $pdo;       //On garde la co à la base

    // Quand on crée un "Advertisement", on lui donne la connexion PDO
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    //Pour récupérer toutes les annonces
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


    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT a.ad_id, a.title, a.location, a.contract_type, a.salary, a.description,
                        a.company_id, c.name AS company_name
                FROM advertisements a
                JOIN companies c ON a.company_id = c.company_id
                WHERE a.ad_id = :id"
        );

        $stmt->execute(['id' => $id]);
        $ad = $stmt->fetch();

        return $ad ?: null;
    }

    public function getCompanies(): array
    {
        $stmt = $this->pdo->query("SELECT company_id, name FROM companies");
        return $stmt->fetchAll();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE advertisements
                SET title = :title,
                    location = :location,
                    contract_type = :contract_type,
                    salary = :salary,
                    description = :description,
                    company_id = :company_id
                WHERE ad_id = :id"
        );

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

    public function insert(array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO advertisements (title, location, contract_type, salary, description, company_id)
                VALUES (:title, :location, :contract_type, :salary, :description, :company_id)"
        );

        $stmt->execute([
            'title' => $data['title'],
            'location' => $data['location'],
            'contract_type' => $data['contract_type'],
            'salary' => $data['salary'],
            'description' => $data['description'],
            'company_id' => $data['company_id']
        ]);
    }


    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM advertisements WHERE ad_id = :id");
        $stmt->execute(['id' => $id]);
    }


}

?>