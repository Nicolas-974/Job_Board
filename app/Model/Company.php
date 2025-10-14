<?php

class Company
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM companies ORDER BY company_id ASC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM companies WHERE company_id = :id");
        $stmt->execute(['id' => $id]);

        $company = $stmt->fetch();

        return $company ?: null;
    }

    public function insert(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO companies (name, sector, location, email, phone)
         VALUES (:name, :sector, :location, :email, :phone)"
        );

        $stmt->execute([
            'name' => $data['name'],
            'sector' => $data['sector'],
            'location' => $data['location'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE companies SET
                    name = :name,
                    sector = :sector,
                    location = :location,
                    email = :email,
                    phone = :phone
                WHERE company_id = :id"

        );

        $stmt->execute([

            'id' => $id,
            'name' => $data['name'],
            'sector' => $data['sector'],
            'location' => $data['location'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);


    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM companies WHERE company_id = :id");
        $stmt->execute(['id' => $id]);
    }


}

?>