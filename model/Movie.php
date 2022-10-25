<?php

class Movie
{
    private string $id;
    private string $name;
    private string $poster;
    private int $year;
    private string $country;
    private array $genres; //Genre
    private array $reviews;//Review
    private int $time;
    private string $tagline;
    private string $description;
    private string $director;
    private int $budget;
    private int $fees;
    private string $ageLimit;

    /**
     * @return array
     */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /**
     * @param array $reviews
     */
    public function setReviews(array $reviews): void
    {
        $this->reviews = $reviews;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        return $this->poster;
    }

    /**
     * @param string $poster
     */
    public function setPoster(string $poster): void
    {
        $this->poster = $poster;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param array $genres
     */
    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * @param string $tagline
     */
    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    /**
     * @return int
     */
    public function getBudget(): int
    {
        return $this->budget;
    }

    /**
     * @param int $budget
     */
    public function setBudget(int $budget): void
    {
        $this->budget = $budget;
    }

    /**
     * @return int
     */
    public function getFees(): int
    {
        return $this->fees;
    }

    /**
     * @param int $fees
     */
    public function setFees(int $fees): void
    {
        $this->fees = $fees;
    }

    /**
     * @return string
     */
    public function getAgeLimit(): string
    {
        return $this->ageLimit;
    }

    /**
     * @param string $ageLimit
     */
    public function setAgeLimit(string $ageLimit): void
    {
        $this->ageLimit = $ageLimit;
    }

}