<?php

class Car 
{
  private $brand;
  private $color;

  public function __construct($brand, $color) 
  {
    $this->brand = $brand;
    $this->color = $color;
  }

  public function getCarBrand()
  {
    return $this->brand;
  }

  public function getCarColor()
  {
    return $this->color;
  }
}


$car = new Car("BMW", "blue");

echo $car->getCarBrand() . ' ' . $car->getCarColor();

