<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie extends Media
{
    
}
