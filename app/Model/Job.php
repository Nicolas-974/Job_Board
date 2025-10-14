<?php

class Job
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all(): array
    {
        $sql = "SELECT j.job_id, a.title AS advertisement_title, 
                        p.name AS people_name, p.firstname AS people_firstname, j.date_candidature 
                    FROM job_applications j
                    JOIN advertisements a ON j.ad_id = a.ad_id
                    JOIN people p ON j.people_id = p.people_id
                    ORDER BY j.date_candidature DESC";


        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    // Récupérer une portion de candidatures (pagination)
    public function paginate(int $limit, int $offset): array
    {
        $sql = "SELECT j.job_id, a.title AS advertisement_title, 
                    p.name AS people_name, p.firstname AS people_firstname, j.date_candidature 
                    FROM job_applications j
                    JOIN advertisements a ON j.ad_id = a.ad_id
                    JOIN people p ON j.people_id = p.people_id
                    ORDER BY j.job_id ASC
            LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Compter le nombre total de candidatures
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) as total FROM job_applications";
        $stmt = $this->pdo->query($sql);
        $row = $stmt->fetch();
        return (int) $row['total'];
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT j.job_id, j.ad_id, j.people_id,
                        a.title AS advertisement_title,
                        p.name AS people_name, p.firstname AS people_firstname,
                        j.date_candidature
                FROM job_applications j
                JOIN advertisements a ON j.ad_id = a.ad_id
                JOIN people p ON j.people_id = p.people_id
                WHERE j.job_id = :id"
        );

        $stmt->execute(['id' => $id]);
        $job = $stmt->fetch(PDO::FETCH_ASSOC);

        return $job ?: null;
    }

    public function insert(array $data): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO job_applications (ad_id, people_id, date_candidature)
                VALUES (:ad_id, :people_id, :date_candidature)"
        );

        $stmt->execute([
            'ad_id' => $data['ad_id'],
            'people_id' => $data['people_id'],
            'date_candidature' => $data['date_candidature']
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE job_applications
                SET ad_id = :ad_id,
                    people_id = :people_id,
                    date_candidature = :date_candidature
                WHERE job_id = :id"
        );

        $stmt->execute([
            'ad_id' => $data['ad_id'],
            'people_id' => $data['people_id'],
            'date_candidature' => $data['date_candidature'],
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM job_applications WHERE job_id = :id");
        $stmt->execute(['id' => $id]);
    }






}

?>