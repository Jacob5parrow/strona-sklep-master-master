function openNav() {
  document.getElementById("mySidebar").style.width = "12%";
  document.getElementById("main").style.marginLeft = "12%";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

function openCart() {
  document.getElementById("myCart").style.width = "60%";
  document.getElementById("main").style.marginRight = "60%";
}

function closeCart() {
  document.getElementById("myCart").style.width = "0";
  document.getElementById("main").style.marginRight = "0";
}

function addToCart(img, nazwa, cena, ilosc) {
  var cart = document.getElementById("cart");
  var cartItems = cart.getElementsByClassName("cartItem");
  for (var i = 0; i < cartItems.length; i++) {
    var cartItemName = cartItems[i].getElementsByClassName("cartItemName")[0];
    if (cartItemName.innerHTML == nazwa) {
      alert("Ten produkt jest już w koszyku");
      return;
    }
  }
  var cartItem = document.createElement("div");
  cartItem.className = "cartItem";
  cartItem.id = "cartItem" + i;
  cart.appendChild(cartItem);
  var cartItemImg = document.createElement("img");
  cartItemImg.src = img;
  cartItemImg.className = "cartItemImg";
  cartItem.appendChild(cartItemImg);
  var cartItemName = document.createElement("p");
  cartItemName.innerHTML = nazwa;
  cartItemName.className = "cartItemName";
  cartItem.appendChild(cartItemName);
  var cartItemPrice = document.createElement("p");
  cartItemPrice.innerHTML = "Cena: " + cena + " zł";
  cartItemPrice.className = "cartItemPrice";
  cartItem.appendChild(cartItemPrice);
  var cartItemQuantity = document.createElement("p");
  cartItemQuantity.innerHTML = "Ilość: <input type='number' onchange='inputChange()' value = '" + ilosc + "'> szt.";
  cartItemQuantity.className = "cartItemQuantity";
  cartItem.appendChild(cartItemQuantity);
  var cartItemRemove = document.createElement("button");
  cartItemRemove.innerHTML = "Usuń";
  cartItemRemove.className = "cartItemRemove";
  cartItemRemove.onclick = function () {
    cartItem.remove();
    sumTotalPrice();
  }
  cartItem.appendChild(cartItemRemove);
  sumTotalPrice();

  cartItem.width = "100%";
  cartItem.height = "100%";
  cartItem.style.border = "none";
  cartItem.style.margin = "2%";
  cartItem.style.padding = "5px";
  cartItem.style.display = "flex";
  cartItem.style.flexDirection = "row";
  cartItem.style.alignItems = "center";
  cartItem.style.justifyContent = "space-between";
  cartItem.style.flexWrap = "wrap";
  cartItem.style.backgroundColor = "#4e4e4e";
  cartItem.style.borderRadius = "5px";
  cartItem.style.overflow = "hidden";
  cartItem.style.position = "relative";
  cartItem.style.zIndex = "0";
  cartItem.style.textAlign = "center";
  cartItem.style.fontSize = "20px";
  cartItem.style.fontFamily = "Arial";
  cartItem.style.color = "gaisboro";
  cartItem.style.textDecoration = "none";
  cartItem.style.textTransform = "uppercase";
  cartItem.style.paddingRight = "5%";

  cartItemRemove.style.border = "none";
  cartItemRemove.style.margin = "2%";
  cartItemRemove.style.padding = "1%";
  cartItemRemove.style.borderRadius = "10px";
  cartItemRemove.style.alignItems = "center";
  cartItemRemove.style.flexWrap = "wrap";
  cartItemRemove.style.backgroundColor = "gray";
  cartItemRemove.style.cursor = "pointer";
  cartItemRemove.style.borderRadius = "10px";
  cartItemRemove.style.transition = "0.3s";
  cartItemRemove.style.color = "black";

  //hover
  cartItemRemove.onmouseover = function () {
    cartItemRemove.style.color = "gaisboro";
    cartItemRemove.style.backgroundColor = "#3a3a3a";
  }
  cartItemRemove.onmouseout = function () {
    cartItemRemove.style.backgroundColor = "gray";
    cartItemRemove.style.color = "black";
  }

}

// sum total price
function sumTotalPrice() {
  var cart = document.getElementById("cart");
  var cartItems = cart.getElementsByClassName("cartItem");
  var totalPrice = 0;
  for (var i = 0; i < cartItems.length; i++) {
    var cartItemPrice = cartItems[i].getElementsByClassName("cartItemPrice")[0];
    var cartItemQuantity = cartItems[i].getElementsByClassName("cartItemQuantity")[0];
    var price = parseFloat(cartItemPrice.innerHTML.replace("Cena: ", "").replace(" zł", ""));
    var quantity = parseFloat(cartItemQuantity.getElementsByTagName("input")[0].value);
    totalPrice = totalPrice + (price * quantity);
  }
  document.getElementById("totalPrice").innerHTML = "Suma: " + totalPrice + " zł";
}

// when input value change sum total price
// input can't be less than 1 
function inputChange() {
  var cart = document.getElementById("cart");
  var cartItems = cart.getElementsByClassName("cartItem");
  for (var i = 0; i < cartItems.length; i++) {
    var cartItemQuantity = cartItems[i].getElementsByClassName("cartItemQuantity")[0];
    var quantity = parseFloat(cartItemQuantity.getElementsByTagName("input")[0].value);
    if (quantity < 1) {
      cartItemQuantity.getElementsByTagName("input")[0].value = 1;
    }
  }
  sumTotalPrice();
}

// send form

function sendForm() {
  if (document.getElementById("cart").innerHTML == "") {
    alert("Koszyk jest pusty");
    return;
  }
  else {
    var cart = document.getElementById("cart");
    var cartItems = cart.getElementsByClassName("cartItem");
    var form = document.getElementById("form");
    var formItems = form.getElementsByClassName("formItem");
    for (var i = 0; i < cartItems.length; i++) {
      var cartItemName = cartItems[i].getElementsByClassName("cartItemName")[0];
      var cartItemPrice = cartItems[i].getElementsByClassName("cartItemPrice")[0];
      var cartItemQuantity = cartItems[i].getElementsByClassName("cartItemQuantity")[0];
      var name = cartItemName.innerHTML;
      var price = cartItemPrice.innerHTML.replace("Cena: ", "").replace(" zł", "");
      var quantity = cartItemQuantity.getElementsByTagName("input")[0].value;
      var formItem = document.createElement("input");
      formItem.type = "hidden";
      formItem.name = "name" + i;
      formItem.value = name;
      form.appendChild(formItem);
      var formItem = document.createElement("input");
      formItem.type = "hidden";
      formItem.name = "price" + i;
      formItem.value = price;
      form.appendChild(formItem);
      var formItem = document.createElement("input");
      formItem.type = "hidden";
      formItem.name = "quantity" + i;
      formItem.value = quantity;
      form.appendChild(formItem);
      //send imie nazwisko adres
      var imie = document.getElementById("imie").value;
      var nazwisko = document.getElementById("nazwisko").value;
      var adres = document.getElementById("adres").value;
      var formItem = document.createElement("input");
      formItem.type = "hidden";
      formItem.name = "imie";
      formItem.value = imie;
      form.appendChild(formItem);
      var formItem = document.createElement("input");
      formItem.type = "hidden";
      formItem.name = "nazwisko";
      formItem.value = nazwisko;
      form.appendChild(formItem);
      var formItem = document.createElement("input");
      formItem.type = "hidden";
      formItem.name = "adres";
      formItem.value = adres;
      form.appendChild(formItem);

    }
    sentCartItemsLength();
    form.submit();
  }
}


// sent cartItems.length to order.php

function sentCartItemsLength() {
  var cart = document.getElementById("cart");
  var cartItems = cart.getElementsByClassName("cartItem");
  var form = document.getElementById("form");
  var formItems = form.getElementsByClassName("formItem");
  var formItem = document.createElement("input");
  formItem.type = "hidden";
  formItem.name = "cartItemsLength";
  formItem.value = cartItems.length;
  form.appendChild(formItem);
}

function kup() {
  //if imie nazwisko adres is not empty
  if (document.getElementById("imie").value != "" && document.getElementById("nazwisko").value != "" && document.getElementById("adres").value != "") {
    sendForm();
  }
  else {
    alert("Wypełnij wszystkie pola do faktury");
  }
}