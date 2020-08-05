<?php

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
