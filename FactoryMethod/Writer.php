<?php

abstract class Writable
{
    public abstract function written(string $message): void;
    public abstract function show(): void;
}

abstract class Writer
{
    final public function write(string $message): Writable
    {
        $writable = $this->createWritable();
        $writable->written($message);

        return $writable;
    }

    protected abstract function createWritable(): Writable;
}

class Paper extends Writable
{
    private $message;

    public function written(string $message): void
    {
        $this->message = $message;
        echo '紙に' . $message . 'と書き込まれました' . "\n";
    }

    public function show(): void
    {
        echo '紙には' . $this->message . 'と書かれています' . "\n";
    }
}

class PaperWriter extends Writer
{
    protected function createWritable(): Writable
    {
        return new Paper();
    }
}

function main(): void
{
    $writer = new PaperWriter();

    $writable1 = $writer->write('一昨日の記録');
    $writable2 = $writer->write('昨日の記録');
    $writable3 = $writer->write('今日の記録');

    $writable1->show();
    $writable2->show();
    $writable3->show();
}

main();
