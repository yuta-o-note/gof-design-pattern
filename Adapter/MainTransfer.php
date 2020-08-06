<?php

/**
 * 委譲を利用して実現するパターン
 */

abstract class PrintAbstract
{
    abstract public function printWeak(): void;
    abstract public function printStrong(): void;
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

class PrintBanner extends PrintAbstract
{
    private $banner;

    public function __construct(string $string)
    {
        $this->banner = new Banner($string);
    }

    public function printWeak(): void
    {
        $this->banner->showWithParen();
    }

    public function printStrong(): void
    {
        $this->banner->showWithAster();
    }
}

function main()
{
    $print = new PrintBanner('Hello');
    $print->printWeak();
    $print->printStrong();
}

main();
