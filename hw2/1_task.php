<?php

// Базовый класс
abstract class BaseItem {
    
    public $name;
    public $price;
    public $selfWorth;
    public $countItems;
    public $finalPrice;
    public $profit;

    abstract protected function printPrice($countItems);
 
    public function __construct($name = null, $price = null, $selfWorth = null, $countItems = null, $finalPrice = null, $profit = null) {
        $this->name = $name;
        $this->price = $price;
        $this->selfWorth = $selfWorth;
        $this->countItems = $$countItems;
        $this->finalPrice = $finalPrice;
        $this->profit = $profit;
    }
}

class PhysicalItem extends BaseItem {

    public function __construct($name = null, $price = null, $selfWorth = null, $countItems = null, $finalPrice = null, $profit = null) {
        parent::__construct($name, $price, $selfWorth, $countItems, $finalPrice, $profit);
    }

    public function printPrice($countItems) {

        $this->countItems = $countItems;

        echo "Поскольку {$this->name} — физический товар, его стоимость не меняется и составляет {$this->price} за единицу.<br>";
        $this->finalPrice = $this->price * $this->countItems;
        $this->profit = $this->finalPrice - $this->selfWorth;
        echo "Себестоимость единицы продкуции — {$this->selfWorth}, поэтому доход от продажи {$this->countItems} шт составил {$this->profit}.";

    }
}

class DigitalItem extends BaseItem {

    public function __construct($name = null, $price = null, $selfWorth = null, $countItems = null, $finalPrice = null, $profit = null) {
        parent::__construct($name, $price, $selfWorth, $countItems, $finalPrice, $profit);
    }

    public function printPrice($countItems) {

        $this->countItems = $countItems;

        echo "Поскольку {$this->name} — цифровой товар, его стоимость на 50% ниже физического и составляет {$this->price} за единицу.<br>";
        $this->finalPrice = $this->price * $this->countItems;
        $this->profit = $this->finalPrice - $this->selfWorth;
        echo "Себестоимость единицы продкуции — {$this->selfWorth}, поэтому доход от продажи {$this->countItems} шт составил {$this->profit}.";
    }
}

class WeightItem extends BaseItem {

    public function __construct($name = null, $price = null, $selfWorth = null, $countItems = null, $finalPrice = null, $profit = null) {
        parent::__construct($name, $price, $selfWorth, $countItems, $finalPrice, $profit);
    }

    public function printPrice($countItems) {

        $this->countItems = $countItems;

        echo "Поскольку {$this->name} — весовой товар, его стоимость зависит от объёмов заказа.<br>";
        if ($this->countItems <= 2.5) {
            $this->finalPrice = $this->price * $this->countItems;
            $this->profit = $this->finalPrice - $this->selfWorth;
            echo "При покупке в розницу скидки не предусмотрено, цена составляет {$this->price} за кг.<br>";
        } else if ($this->countItems <= 20) { 
            $this->price = $this->price*90/100;
            $this->finalPrice = $this->price * $this->countItems;
            $this->profit = $this->finalPrice - $this->selfWorth;
            echo "При небольшом опте скидка составляет 10%, итоговая цена - {$this->price} за кг.<br>";            
        } else {
            $this->price =  $this->price*80/100;
            $this->finalPrice = $this->price * $this->countItems;
            $this->profit = $this->finalPrice - $this->selfWorth;
            echo "При большом опте скидка составляет 20%, итоговая цена - {$this->price} за кг.<br>";  
        }
        echo "Себестоимость единицы продкуции — {$this->selfWorth}, поэтому доход от продажи {$this->countItems} кг составил {$this->profit}.";
    }
}

$item1 = new PhysicalItem("Игра на диске", 5400, 1000);
$item2 = new DigitalItem("Цифровой ключ игры", $item1->price /2, 300);
$item3 = new WeightItem("Крупа", 50, 15);

$msg = "Выберите товар:";

if(isset($_POST['buyPhysical'])) {    
    $msg = "";
    $item1->printPrice(2);
}

if(isset($_POST['buyDigital'])) {
    $msg = "";
    $item2->printPrice(3);
}

if(isset($_POST['buyWeight1'])) {
    $msg = "";
    $item3->printPrice(1);
}

if(isset($_POST['buyWeight20'])) {
    $msg = "";
    $item3->printPrice(20);
}

if(isset($_POST['buyWeight100'])) {
    $msg = "";
    $item3->printPrice(100);
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>task 1</title>
    <style>
        
    </style>
</head>
<body>
<?=$msg?>
<br><br>
<form method="post">
    <input type="submit" name="buyPhysical" value="Купить физическую копию"><br><br>
    <input type="submit" name="buyDigital" value="Купить цифровую копию"><br><br>
    <input type="submit" name="buyWeight1" value="Купить 1 кг крупы">&nbsp;
    <input type="submit" name="buyWeight20" value="Купить 20 кг крупы">&nbsp;
    <input type="submit" name="buyWeight100" value="Купить 100 кг крупы">
</form>
</body>
</html>