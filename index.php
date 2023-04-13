<!DOCTYPE html>
    
    <head>

        <?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS `produkty`";
if ($conn->query($sql) === FALSE) {
  echo "Error creating database: " . $conn->error;
}

// Connect to the database
$conn->select_db("produkty");

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)";

if ($conn->query($sql) === FALSE) {
  echo "Error creating table: " . $conn->error;
}

$sql = "SELECT COUNT(*) as count FROM produkty";
$result = $conn->query($sql);
$count = $result->fetch_assoc()["count"];
if ($count == 0) {
  // Insert data into table
  $sql = "INSERT INTO produkty (id, nazwa, ilosc, cena) VALUES
  (1, 'sekator', 10, 100),
  (2, 'kosiarka', 10, 500),
  (3, 'glebogryzarka', 10, 1500),
  (4, 'szpadel', 10, 300),
  (5, 'pila', 0, 500),
  (6, 'podkaszarka', 10, 800),
  (7, 'wertykulator', 10, 400),
  (8, 'nozyce', 10, 700),
  (9, 'dmuchawa', 10, 1200),
  (10, 'wyrywacz', 10, 80)";
}

if ($conn->query($sql) === FALSE) {
  echo "Error inserting data: " . $conn->error;
}

// Close connection
$conn->close();
?>

        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="main.js"></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <title>Kosiarki Jakuba</title>    

    </head>

    <form id="form" name="order" action="order.php" method="post">

    </form>

    <body>

        <div id="mySidebar" class="sidebar">
            <b href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</b>
            <a href="admin.html">Admin</a>
        </div>

        <div id="myCart" class="cartBar">
            <div id="cart">
                <b href="javascript:void(0)" class="closebtn" onclick="closeCart()">&times;</b>
                <h2>Koszyk</h2>
                <div id="totalPrice">Razem 0 zł</div>    
                Dane do faktury: <br>
                <input type="text" id="imie" placeholder="Imię">
                <input type="text" id="nazwisko" placeholder="Nazwisko">
                <input type="text" id="adres" placeholder="Adres">
                <br>
                <button onclick="kup()">Kup</button>     
            </div>
        </div>

        <button class="openbtn" onclick="openNav()">&#9776;</button>
        <button class="cartbtn" onclick="openCart()"><i class="fa fa-shopping-cart"></i></button>
        </a>
        
        <div class="container">
            
        <header>
            <h1><img src="logo.svg" alt="Logo" class="imgLogo">Kosiarki Jakuba</h1>
        </header>

        <main>

            <div class="product">
            
                <img src="sekator.png" alt="sekator">
                <h3>Sekator</h3>
                <p>Bardzo ostry i wykrzymały sekator</p>
                <span>100zł</span>
            
                
                <button onclick="addToCart('sekator.png', 'sekator', 100, 1)">Dodaj do koszyka <i class='fa fa-cart-arrow-down'></i></button>
            
            </div>

            <div class="product">
            
                <img src="kosiarka.jpg" alt="kosiarka">
                <h3>Kosiarka</h3>
                <p>Duża kosiarka spalinowa do pracy na większym terenie</p>
                <span>5000zł</span>
                <button onclick="addToCart('kosiarka.jpg' ,'kosiarka', 5000, 1)">Dodaj do koszyka <i class='fa fa-cart-arrow-down'></i></button>
            
            </div>

            <div class="product">
            
                <img src="glebogryzarka.jpg" alt="glebogryzarka">
                <h3>Glebogryzarka</h3>
                <p>Wydajna glebogryzarka świetnie spulchniająca ziemie</p>
                <span>1500zł</span>
            
            
                <button onclick="addToCart('glebogryzarka.jpg', 'Glebogryzarka', 1500, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            </div>

            <div class="product">
            
                <img src="szpadel.png" alt="szpadel">
                <h3>Szpadel</h3>
                <p>Wytrzymały szpadel przydatny do wielu prac ogrodowych i nie tylko</p>
                <span>300zł</span>
                <button onclick="addToCart('szpadel.png', 'szpadel', 300, 1)">Dodaj do koszyka <i class='fa fa-cart-arrow-down'></i></button>
            
            </div>
            
            <div class="product">
            
                <img src="pila.png" alt="piła">
                <h3>Piła Łańcuchowa</h3>
                <p>Akumulatorowa piła idealna do obcinania większych gałęzi</p>
                <span>500zł</span>
            
            
                <button onclick="addToCart('pila.png', 'pila', 500, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            </div>
            
            <div class="product">
            
                <img src="podkaszarka.jpg" alt="podkaszarka">
                <h3>Podkaszarka</h3>
                <p>Idealne narzędzie to koszenia trawy tam gdzie normalna kosiarka nie daje rady</p>
                <span>800zł</span>
            
            
                <button onclick="addToCart('podkaszarka.jpg', 'podkaszarka', 800, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            </div>
            
            <div class="product">
            
                <img src="wertykulator.png" alt="wertykulator">
                <h3>Wertykulator</h3>
                <p>Solidny elektryczny wertykulator dobrze spulchniający ziemie</p>
                <span>400zł</span>
            
            
                <button onclick="addToCart('wertykulator.png', 'wertykulator', 400, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            </div>
            
            <div class="product">
            
                <img src="nozyce.jpg" alt="nożyce">
                <h3>Nożyce spalinowe</h3>
                <p>Świetne narzędzie do szykiego przycinania żywopłotów lub innych roślin</p>
                <span>700zł</span>
            
            
                <button onclick="addToCart('nozyce.jpg', 'nożyce spalinowe', 700, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            
            </div>
            
            <div class="product">
            
                <img src="dmuchawa.png" alt="dmuchawa">
                <h3>Dmuchawa</h3>
                <p>Niezawodna przy usuwaniu niechnianych liści nawet w dużych ilościach</p>
                <span>1200zł</span>
            
            
                <button onclick="addToCart('dmuchawa.png', 'dmuchawa', 1200, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            </div>
            
            <div class="product">
            
                <img src="wyrywacz.png" alt="wyrywacz">
                <h3>Wyrywacz do chwastów</h3>
                <p>Niezastąpione ręczne narzędzie niezbędne przy usuwaniu chwastów</p>
                <span>80zł</span>
            
            
                <button onclick="addToCart('wyrywacz.png', 'wyrywacz', 80, 1)">Dodaj do koszyka <i
                        class='fa fa-cart-arrow-down'></i></button>
            
            
            </div>

        </main>

        <footer>
            Data ostatniej modyfikacji:
            <script>
                document.write(document.lastModified);
            </script>
            <br>
            Dzisiejsza data:
            <script>
                var d = new Date();
                document.write(d.getDate() + "." + (d.getMonth() + 1) + "." + d.getFullYear());
            </script>
        </footer>
    </div>
    </body>
    
</html>



