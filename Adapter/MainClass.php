<?php

/**
 * 継承を利用して実現するパターン
 */

interface PrintInterface
{
    public function printWeak(): void;
    public function printStrong(): void;
}

class Banner
{
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function showWithParen(): void
    {
        echo '(' . $this->string . ')' . "\n";
    }

    public function showWithAster(): void
    {
        echo '*' . $this->string . '*' . "\n";
    }
}

class PrintBanner extends Banner implements PrintInterface
{
    public function printWeak(): void
    {
        $this->showWithParen();
    }

    public function printStrong(): void
    {
        $this->showWithAster();
    }
}

function main(PrintInterface $print)
{
    $print->printWeak();
    $print->printStrong();
}

$print = new PrintBanner('Hello');
main($print);
