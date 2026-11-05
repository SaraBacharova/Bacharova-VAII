<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Model knihy v katalógu (tabuľka `books`).
 */
class Book extends Model
{
    protected static ?array $fillable = ['title', 'author', 'description'];

    protected ?int $id = null;
    protected ?string $title = null;
    protected ?string $author = null;
    protected ?int $year = null;
    protected ?int $pages = null;
    protected ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(?int $pages): void
    {
        $this->pages = $pages;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}