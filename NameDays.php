<?php

namespace sbolch;

use PDO;

class NameDays
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO('sqlite:' . __DIR__ . '/data/name-days.sqlite');
    }

    /**
     * @return string[]
     */
    public function today(): array
    {
        $query = $this->db->prepare('SELECT `name` FROM `today`');
        $query->execute();

        return array_map(fn(array $n) => $n['name'], $query->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @return array{date: string, names: string}
     */
    public function calendar(): array
    {
        $query = $this->db->prepare('SELECT `date`, `names` FROM `calendar`');
        $query->execute();

        return array_map(fn(array $d) => [
            'date' => $d['date'],
            'names' => $d['names'],
        ], $query->fetchAll(PDO::FETCH_ASSOC));
    }
}
