<?php

abstract class AbstractDisplay
{
    /**
     * オープン => 5回プリント => クローズ
     * という大まかな流れだけは決まっている
     */
    public function display(): void
    {
        $this->open();
        for ($i = 0; $i < 5; $i++) {
            $this->print();
        }
        $this->close();
    }

    public abstract function open(): void;
    public abstract function print(): void;
    public abstract function close(): void;
}

class CharDisplay extends AbstractDisplay
{
    private $char;

    public function __construct(string $char)
    {
        $this->char = $char;
    }

    public function open(): void
    {
        echo '<<';
    }

    public function print(): void
    {
        echo $this->char;
    }

    public function close(): void
    {
        echo '>>' . "\n";
    }
}

class StringDisplay extends AbstractDisplay
{
    private $string;
    private $width;

    public function __construct(string $string)
    {
        $this->string = $string;
        $this->width = mb_strlen($string);
    }

    public function open(): void
    {
        echo $this->printLine();
    }

    public function print(): void
    {
        echo '|' . $this->string . '|' . "\n";
    }

    public function close(): void
    {
        echo $this->printLine();
    }

    private function printLine(): void
    {
        echo '+' . str_repeat('-', $this->width) . '+' . "\n";
    }
}

function main()
{
    $charDisplay = new CharDisplay('H');
    $charDisplay->display();

    $stringDisplay = new StringDisplay('Hello, World');
    $stringDisplay->display();
}

main();
