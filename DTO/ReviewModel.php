<?php

class ReviewModel
{
    public string $id;
    public int $rating;
    public string $reviewText;
    public bool $isAnonymous;
    public string $createDateTime;
    public string|null $author;
}