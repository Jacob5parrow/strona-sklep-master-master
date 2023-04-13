
<?php

//connect to database

$serwer = 'localhost';
$user = 'root';
$pass = '';
$db = 'produkty';

$connect = mysqli_connect($serwer, $user, $pass, $db);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$nazwa = array();
$ilosc = array();
$cena = array();


$len = $_POST['cartItemsLength'];

for ($i = 0; $i < $len; $i++) {
    $nazwa[$i] = $_POST['name'.$i];
    $ilosc[$i] = $_POST['quantity'.$i];
    $cena[$i] = $_POST['price'.$i];
}

for ($i = 0; $i < $len; $i++) {
    $sql = "UPDATE produkty
SET ilosc = CASE
    WHEN ilosc - $ilosc[$i] >= 0 THEN ilosc - $ilosc[$i]
    ELSE ilosc
END
WHERE nazwa = '$nazwa[$i]';";
    $connect->query($sql);
}

$connect->close();

//dane nabywcy

echo '<h2>nabywca: '.$_POST['imie'].' '.$_POST['nazwisko'].'<br>';
echo 'adres: '.$_POST['adres'].'<br></h2>';

//invoice as table
echo '<h2>Twoje zamówienie</h2>';

echo '<table border="1" cellpadding="10" cellspacing="0">';
echo '<tr><th>Nazwa</th><th>Ilość</th><th>Cena</th></tr>';
for($i = 0; $i < $len; $i++) {
    echo '<tr>';
    echo '<td>'.$nazwa[$i].'</td>';
    echo '<td>'.$ilosc[$i].'</td>';
    echo '<td>'.$cena[$i].' zł</td>';
    echo '</tr>';
}
//sum of all products with VAT (23%)

$sum = 0;
for($i = 0; $i < $len; $i++) {
    $sum += $cena[$i];
}
$sum *= 1.23;
echo '<tr><td colspan="2">Suma + (VAT)</td><td>'.$sum.' zł </td></tr>';
echo '</table>';

?>





