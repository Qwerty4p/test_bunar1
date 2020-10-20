<?php
/*Добавление значений в файл*/
$fileName = "test.txt";
$count = 500000;
    $file=fopen($fileName,"w");
    for ($i=0;$i<$count;$i++) {
        fwrite($file,"ключ".$i."\t"."значение".$i."\x0A");
}

function getTime($time = false)
{
    return $time === false? microtime(true) : round(microtime(true) - $time, 3);
}//функция установки и получения времени
function binarySearch($fileName, $desiredValue)
{
    $file=new SplFileObject($fileName); //объект файла

    $start = 0; //левая граница
    $end = sizeof(file($fileName)) - 1; //вычисление правой границы

    while ($start <= $end) { //условие выхода за границы
        $position = floor(($start + $end) / 2);  //вычисление середины массива
        $file->seek($position);//взятие строки с вычесленным номером
        //echo $position."\n";
        $elem = explode("\t", $file->current());// разбиение строки на пару ключ:значение
        $strnatcmp = strnatcmp($elem[0],$desiredValue);
        //echo $elem[0];
        //echo $elem[1];
        if ($strnatcmp>0){
            $end = $position-1;
        }elseif($strnatcmp<0){
            $start = $position+1;
        }else{
            return $elem[1];
        }
    }
    return 'undef'; // не найденно значение
}
$desiredValue=(isset($_POST['val']))? "ключ".$_POST['val']:"ключ500000";


    if(isset($_POST['submit'],$_POST['val']) && !empty($_POST['val'])){
        $time=getTime();
        $result=binarySearch($fileName,$desiredValue);
        $time=getTime($time);
        $view = "</br> Поиск ключа - ".$result. "</br>" ."Времени затрачено - ".$time." секунд  ";
    }else{
        $view = " </br> Введите число в поле для ввода ";
    }



?>

<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Бинарный поиск</title>
</head>
<body>
<div class="row">

</div>

<form action="" method="post" class="row" style="margin-top: 30px">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="form-group">
            <input type="text" name="val" autocomplete="off" placeholder="напишите число">
            <button class="btn btn-success" name="submit"> Найти </button>
        </div>
    </div>
    <div class="col-lg-3"></div>
</form>
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <?=$view?>
    </div>
    <div class="col-lg-3"></div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
