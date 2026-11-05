<?php

namespace App\Controllers;

use App\Models\Book;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Kontrolér katalógu kníh: zoznam, pridanie, úprava a zmazanie (CRUD).
 */
class BookController extends BaseController
{
    /** Zoznam všetkých kníh (Read). */
    public function index(Request $request): Response
    {
        return $this->html(['books' => Book::getAll(orderBy: '`id` desc')]);
    }

    /** Prázdny formulár pre novú knihu. */
    public function add(Request $request): Response
    {
        return $this->html(['book' => new Book(), 'errors' => []], 'form');
    }

    /** Formulár predvyplnený údajmi existujúcej knihy. */
    public function edit(Request $request): Response
    {
        $book = $this->getBookOr404((int)$request->value('id'));
        return $this->html(['book' => $book, 'errors' => []], 'form');
    }

    /** Uloženie knihy z formulára (Create aj Update). */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        // id > 0 znamená úpravu existujúcej knihy, inak ide o novú knihu
        $id = (int)$request->post('id');
        $book = $id > 0 ? $this->getBookOr404($id) : new Book();

        $book->setTitle(trim((string)$request->post('title')));
        $book->setAuthor(trim((string)$request->post('author')));
        $book->setDescription(trim((string)$request->post('description')));

        // čísla nastavujeme až po kontrole, aby sa do ?int nedostal text
        $year = filter_var($request->post('year'), FILTER_VALIDATE_INT);
        $pages = filter_var($request->post('pages'), FILTER_VALIDATE_INT);
        $book->setYear($year === false ? null : $year);
        $book->setPages($pages === false ? null : $pages);

        $errors = $this->validate($book);
        if (count($errors) > 0) {
            return $this->html(['book' => $book, 'errors' => $errors], 'form');
        }

        $book->save();
        return $this->redirect($this->url('book.index'));
    }

    /** Zmazanie knihy (Delete). */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $book = $this->getBookOr404((int)$request->post('id'));
        $book->delete();
        return $this->redirect($this->url('book.index'));
    }

    private function getBookOr404(int $id): Book
    {
        $book = Book::getOne($id);
        if ($book === null) {
            throw new HttpException(404);
        }
        return $book;
    }

    private function validate(Book $book): array
    {
        $errors = [];
        if ($book->getTitle() === '') {
            $errors[] = 'Názov knihy nesmie byť prázdny.';
        } elseif (mb_strlen($book->getTitle()) > 200) {
            $errors[] = 'Názov knihy môže mať najviac 200 znakov.';
        }
        if ($book->getAuthor() === '') {
            $errors[] = 'Autor nesmie byť prázdny.';
        } elseif (mb_strlen($book->getAuthor()) > 150) {
            $errors[] = 'Meno autora môže mať najviac 150 znakov.';
        }
        if ($book->getYear() === null || $book->getYear() < 1 || $book->getYear() > (int)date('Y')) {
            $errors[] = 'Rok vydania musí byť celé číslo od 1 do ' . date('Y') . '.';
        }
        if ($book->getPages() === null || $book->getPages() < 1) {
            $errors[] = 'Počet strán musí byť kladné celé číslo.';
        }
        return $errors;
    }
}