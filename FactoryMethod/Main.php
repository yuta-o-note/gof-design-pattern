<?php

abstract class Product
{
    public abstract function use(): void;
}

abstract class Factory
{
    final public function create(string $owner): Product
    {
        $product = $this->createProduct($owner);
        $this->registerProduct($product);
        return $product;
    }

    protected abstract function createProduct(string $owner): Product;
    protected abstract function registerProduct(Product $product): void;
}

class IDCard extends Product
{
    private $owner;

    public function __construct(string $owner)
    {
        echo $owner . 'のID cardを作ります。' . "\n";
        $this->owner = $owner;
    }
    public function use(): void
    {
        echo $this->owner . 'のID cardを使います。' . "\n";
    }
}

class IDCardFactory extends Factory
{
    private $owners;

    protected function createProduct(string $owner): Product
    {
        return new IDCard($owner);
    }

    protected function registerProduct(Product $idCard): void
    {
        $this->owners[] = $idCard;
    }
}

function main(): void
{
    $factory = new IDCardFactory();
    $card1 = $factory->create('hitorime');
    $card2 = $factory->create('hutarime');
    $card3 = $factory->create('sannninme');
    $card1->use();
    $card2->use();
    $card3->use();
}

main();
