<?php

interface AggregateInterface
{
    public function iterator(): IteratorInterface;
}

interface IteratorInterface
{
    public function hasNext(): bool;

    public function next(): object;
}

class Book
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class BookShelf implements AggregateInterface
{
    private $books;

    public function getLength(): int
    {
        return count($this->books);
    }

    public function appendBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function getBookAt(int $index): Book
    {
        return $this->books[$index];
    }

    public function iterator(): IteratorInterface
    {
        return new BookShelfIterator($this);
    }
}

class BookShelfIterator implements IteratorInterface
{
    private $bookShelf;
    private $index;

    public function __construct(BookShelf $bookShelf)
    {
        $this->bookShelf = $bookShelf;
        $this->index = 0;
    }

    public function hasNext(): bool
    {
        return $this->index < $this->bookShelf->getLength();
    }

    public function next(): object
    {
        $book = $this->bookShelf->getBookAt($this->index);
        $this->index++;

        return $book;
    }
}

function main()
{
    $bookShelf = new BookShelf();
    $bookShelf->appendBook(new Book('book-A'));
    $bookShelf->appendBook(new Book('book-B'));
    $bookShelf->appendBook(new Book('book-C'));
    $bookShelf->appendBook(new Book('book-D'));

    $iterator = new BookShelfIterator($bookShelf);
    while ($iterator->hasNext()) {
        echo $iterator->next()->getName() . "\n";
    }
}

main();
