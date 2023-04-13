<?php
// Sprawdzenie, czy zostały przesłane dane z formularza
if (isset($_POST['password'])) {
    // Sprawdzenie, czy wprowadzone dane są poprawne
    if ($_POST['password'] == 'wrobel') {
        // Połączenie z bazą danych
        $conn = new mysqli('localhost', 'root', '', 'produkty');

        // Sprawdzenie, czy udało się połączyć z bazą danych
        if ($conn->connect_error) {
            die('Nie udało się połączyć z bazą danych: ' . $conn->connect_error);
        }

        // Wykonanie zapytania SQL
        $sql = 'SELECT * FROM produkty';
        $result = $conn->query($sql);
        
        echo '<!DOCTYPE html>';
        echo '<head>';
        echo '    <meta charset="utf-8">';
        echo '    <link rel="stylesheet" type="text/css" href="style.css">';
        echo '    <title>Admin</title>';
        echo '    <script type="text/javascript" src="main.js"></script>';
        echo '</head>';
        echo '<body>';
        echo '    <div id="mySidebar" class="sidebar">';
        echo '        <b href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</b>';
        echo '        <a href="index.html">Stona główna</a>';
        echo '        <a href="admin.html">Admin</a>';
        echo '    </div>';
        echo '    <button class="openbtn" onclick="openNav()">&#9776;</button>';
        echo '    <div class="container">';
        echo '        <header>';
        echo '            <h1>Baza Danych</h1>';
        echo '        </header>';
        echo '        <main>';
        

       
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                
            echo 'ID: ' . $row['id'] . '<br>';
            echo 'Nazwa produktu: ' . $row['nazwa'] . '<br>';
            echo 'Ilość: : ' . $row['ilosc'] . '<br>';
            echo 'Cena: ' . $row['cena'] . '<br>';
            echo '<br>';
                
         
            }
            echo '        </main>';
        echo '        <footer>';
        echo '            Data ostatniej modyfikacji strony:';
        echo '            <script>';
        echo '                document.write(document.lastModified);';
        echo '            </script>';
        echo '        </footer>';
        echo '    </div>';
        echo '</body>';
        echo '</html>';
        }
        
        else {
            echo 'Brak produktów w bazie danych';
        }

        
        $conn->close();
    } else {
        echo 'Nieprawidłowe hasło';
    }
} else {
    echo 'Wystąpił błąd podczas logowania';
}
?>