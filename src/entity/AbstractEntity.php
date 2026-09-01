<?php


namespace App\Entity;

abstract class AbstractEntity
{
    protected int $id;
    protected \DateTimeImmutable $dateCreation;
    public function __construct(int $id, \DateTimeImmutable $dateCreation)
    {
        $this->id = $id;
        $this->dateCreation = $dateCreation;
    }
}
