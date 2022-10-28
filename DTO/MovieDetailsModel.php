<?php

class MovieDetailsModel
{
    public string $id;
    public string $name;
    public string $poster;
    public int $year;
    public string $country;
    public array $genres;
    public array $reviews;
    public int $time;
    public string|null $tagline;
    public string $description;
    public string $director;
    public int $budget;
    public int $fees;
    public string $ageLimit;
}