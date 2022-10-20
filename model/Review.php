<?php

class Review
{
    private string $id;
    private string $userId;
    private string $movieId;
    private string $reviewText;
    private int $rating;
    private bool $isAnonymous;
    private string $createDateTime;

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
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getReviewText(): string
    {
        return $this->reviewText;
    }

    /**
     * @param string $reviewText
     */
    public function setReviewText(string $reviewText): void
    {
        $this->reviewText = $reviewText;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return bool
     */
    public function isAnonymous(): bool
    {
        return $this->isAnonymous;
    }

    /**
     * @param bool $isAnonymous
     */
    public function setIsAnonymous(bool $isAnonymous): void
    {
        $this->isAnonymous = $isAnonymous;
    }

    /**
     * @return string
     */
    public function getCreateDateTime(): string
    {
        return $this->createDateTime;
    }

    /**
     * @param string $createDateTime
     */
    public function setCreateDateTime(string $createDateTime): void
    {
        $this->createDateTime = $createDateTime;
    }

    /**
     * @return string
     */
    public function getMovieId(): string
    {
        return $this->movieId;
    }

    /**
     * @param string $movieId
     */
    public function setMovieId(string $movieId): void
    {
        $this->movieId = $movieId;
    }

}