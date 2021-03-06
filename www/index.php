<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
</head>
<body>
    <?php
        class ComplexCalc
        {
            public $re = 0, $im = 0;
            public function __construct($re, $im) {
                $this->re = $re;
                $this->im = $im;
            }
            public function addition(ComplexCalc $obj) {
                $this->re = $this->re + $obj->re;
                $this->im = $this->im + $obj->im;
            }
            public function substraction(ComplexCalc $obj) {
                $this->re = $this->re - $obj->re;
                $this->im = $this->im - $obj->im;
            }
            public function multiply(ComplexCalc $obj) {
                $re = ($this->re * $obj->re) - ($this->im * $obj->im);
                $im = ($obj->re * $this->im) + ($this->re * $obj->im);
                $this->re = $re;
                $this->im = $im;
            }
            public function divide(ComplexCalc $obj) {
                $re = ($this->re * $obj->re + $this->im * $obj->im)/($obj->re * $obj->re + $obj->im * $obj->im);
                $im = ($obj->re * $this->im - $this->re * $obj->im)/($obj->re * $obj->re + $obj->im * $obj->im);
                $this->re = $re;
                $this->im = $im;
            }
        }
        if($_POST['submit']) {
            $a = new ComplexCalc($_POST['re1'], $_POST['im1']);
            $b = new ComplexCalc($_POST['re2'], $_POST['im2']);
            $c = $a;
            $p = $_POST['operation'];
            if ($p == '+')
                $c->addition($b);
            else if ($p == '-')
                $c->substraction($b);
            else if ($p == '*')
                $c->multiply($b);
            else if ($p == '/') {
                if ($b->re == 0 && $b->im == 0)
                    echo "You can't divide by zero";
                else
                    $c->divide($b);
            }
        }
    ?>
    <form action="" method="post" style="text-align:center;">
        <br><br>
        <input type="textbox" name="re1" required>
         + 
        <input type="textbox" name="im1" required> i
        <br><br>
        <select name="operation" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <br><br>
        <input type="textbox" name="re2" required>
         + 
        <input type="textbox" name="im2" required> i
        <br><br>
        <input type="submit" name="submit" value=" = ">
        <br><br>
        <?php
            if($c) {
                if ($c->re == 0 && $c->im == 0) {
                    echo 0;
                }
                else if ($c->re == 0) {
                    echo $c->im . "i";
                }    
                else if ($c->im == 0) {
                    echo $c->re;
                }
                else if ($c->im < 0 && $c->im != -1) {
                    echo $c->re . " - " . -$c->im . "i";
                }
                else if ($c->im == 1) {
                    echo $c->re . " + i";
                }
                else if ($c->im == -1) {
                    echo $c->re . " - i";
                }
                else {
                    echo $c->re . " + " . $c->im . "i";
                }
            }
        ?>
    </form>
</body>
</html>