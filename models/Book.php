<?php

class Book
{
    public int $id;
    public string $title;
    public string $description;
    public string $author;
    public int $year;
    public int $userId;
    public ?int $avgRating = null;
    public int $reviewsCount = 0;
}