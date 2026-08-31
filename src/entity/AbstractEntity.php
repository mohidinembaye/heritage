<?php


namespace App\Entity;

use DateTime;
abstract class AbstractEntity
{
    protected int $id;
    protected DateTime $dateCreation;
    public function __construct(int $id, DateTime $dateCreation)
    {
        $this->id = $id;
        $this->dateCreation = $dateCreation;
    }
}
