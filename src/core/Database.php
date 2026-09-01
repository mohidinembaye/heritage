<?php
namespace App\Core;

class Database{

    private static ?\PDO $connexion = null;

    private function __construct(){}

    public static function getConnexion(): \PDO {
        if (self::$connexion === null) {
            try {
                $pdo = new \PDO(
                    "pgsql:host=localhost;dbname=test31;port=5432",
                    "postgres",
                    "motdepasse"
                );
                $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$connexion = $pdo;
            } catch (\Throwable $th) {
                throw new \Exception("Erreur de connexion : " . $th->getMessage());
            }
        }
        return self::$connexion;
    }

    public static function query(string $sql, bool $single = true): mixed
    {
        $query = self::getConnexion()->query($sql);
        return $single ? $query->fetch() : $query->fetchAll(\PDO::FETCH_OBJ);
    }

    private static function prepare(string $sql, array $datas): \PDOStatement
    {
        $prepare = Database::getConnexion()->prepare($sql);
        $prepare->execute($datas);
        return $prepare;
    }

    public static function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = self::prepare($sql, $datas);
        return $single ? $statement->fetch() : $statement->fetchAll(\PDO::FETCH_OBJ);
    }
    public static function executeUpdate(string $sql, array $datas): int|string
    {
        $statement = self::prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? self::getConnexion()->lastInsertId() : $statement->rowCount();
    }

    public static function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return self::query($sql, false);
    }
}
// Connexion initialisée à la demande, pas au chargement du fichier