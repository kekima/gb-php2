<?php

//1: Базовый самолёт, исчерпав горючее, должен вернуться на аэродром
class Plane {

    //2: Свойства самолёта: его название, общий объём баков и текущее количество топлива на борту
    public $name;
    public $maxFuel;
    public $curFuel;
 
    public function __construct($name = null, $maxFuel = null, $curFuel = null) {
        $this->name = $name;
        $this->maxFuel = $maxFuel;
        $this->curFuel = $curFuel;
    }

    //3: Метод: дозаправка в воздухе
    public function refuel(Plane $plane) {
        echo "На борту {$this->name} находится {$this->curFuel} кг топлива, на борту {$plane->name} — {$plane->curFuel} кг.<br>";
        if ($this->curFuel > $this->fuelPerTransaction) {  
            echo ">>> Самолёт {$this->name} заправляет {$plane->name} на {$this->fuelPerTransaction} кг.<br>";
            $plane->curFuel += $this->fuelPerTransaction;
            $this->curFuel -= $this->fuelPerTransaction;
            echo "Теперь у {$plane->name} на борту {$plane->curFuel} кг топлива, а у {$this->name} осталось {$this->curFuel} кг топлива.";
        } else {
            echo "У {$this->name} недостаточно топлива для дозаправки {$plane->name}!";
        }
    }
}

//4: Самолёт-дозаправщик обладает всеми свойствами, что и базовый самолёт, но дополнительно наделён свойством перекачивать топливо другим самолётам
class Tanker extends Plane {

    public $fuelPerTransaction;

    public function __construct($name = null, $maxFuel = null, $curFuel = null, $fuelPerTransaction = null)
    {
        parent::__construct($name, $maxFuel, $curFuel);
        $this->fuelPerTransaction = $fuelPerTransaction;
    }
}

$fighter = new Plane("Су-30", 9640, 5000);
$fullTanker = new Tanker("Ил-78М", 126000, 63200, 2300);
$emptlyTanker = new Tanker("Ил-78", 126000, 2000, 2300);

$msg = "Одному из наших истребителей требуется заправка в воздухе. Ваши действия:";

if(isset($_POST['refuelFull'])) {    
    $msg = "";
    $fullTanker->refuel($fighter);
}

if(isset($_POST['refuelEmpty'])) {
    $msg = "";
    $emptlyTanker->refuel($fighter);
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
    <input type="submit" name="refuelFull" value="Дозаправить полным заправщиком!"><br><br>
    <input type="submit" name="refuelEmpty" value="Дозаправить пустым заправщиком!">
</form>
</body>
</html>