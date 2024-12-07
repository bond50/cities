<?php
declare(strict_types=1);

class WorldCityRepository
{

    public function __construct(private PDO $pdo)
    {
    }

    private function arrayToModel(array $entry): WorldCityModel
    {
        return new WorldCityModel(
            $entry['id'],
            $entry['city'],
            $entry['admin_name'],
            $entry['city_ascii'],
            (float)$entry['lat'],
            (float)$entry['lng'],
            $entry['country'],
            $entry['iso2'],
            $entry['iso3'],
            $entry['population'],
        );
    }

    public function fetch(): array
    {
        $stmt = $this->pdo->prepare("SELECT *
        FROM `worldcities` 
        ORDER BY `population` DESC LIMIT 10");
        $stmt->execute();
        $models = [];
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($entries as $entry) {
            $models [] = $this->arrayToModel($entry);
        }

        return $models;
    }

    public function paginate(int $page, int $perPage = 15): array
    {
        $page = max($page, 1);
        $stmt = $this->pdo->prepare("SELECT * FROM `worldcities` ORDER BY `population` DESC  LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
        $stmt->execute();
        $models = [];
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($entries as $entry) {
            $models [] = $this->arrayToModel($entry);
        }
        return $models;


    }

    public function fetchById(int $id): ?WorldCityModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `worldcities`  WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($entry)) {
            return $this->arrayToModel($entry);
        } else {
            return null;
        }
    }

    public function count(): int
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS `count` FROM `worldcities`");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    }

    public function update(int $id, array $properties): WorldCityModel
    {
        $stmt = $this->pdo->prepare(" UPDATE `worldcities` 
                SET 
                    `city` = :city ,
                    `city_ascii` = :cityAscii,
                    `country` = :country,
                    `iso2` = :iso2,
                    `population`= :population  WHERE `id` = :id
                    ");

        $stmt->bindValue(':city', $properties['city'], PDO::PARAM_STR);
        $stmt->bindValue(':cityAscii', $properties['cityAscii'], PDO::PARAM_STR);
        $stmt->bindValue(':country', $properties['country'], PDO::PARAM_STR);
        $stmt->bindValue(':iso2', $properties['iso2'], PDO::PARAM_STR);
        $stmt->bindValue(':population', $properties['population'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $this->fetchById($id);

    }


}
