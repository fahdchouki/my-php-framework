//====== cookies management =========//
function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
function eraseCookie(name) {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}
//====== cookies management =========//

function setCartNum() {
  if (getCookie("prods") != null) {
    document.getElementById("cartProdsNum").textContent =
      JSON.parse(getCookie("prods")).length > 0
        ? JSON.parse(getCookie("prods")).length
        : 0;
  }
}
window.onload = function () {
  setCartNum();
};
let btnScroll = document.getElementById("scrollBtn");
window.onscroll = function () {
  if (
    document.body.scrollTop > 250 ||
    document.documentElement.scrollTop > 250
  ) {
    btnScroll.style.display = "block";
  } else {
    btnScroll.style.display = "none";
  }
};

btnScroll.addEventListener("click", function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});

let openMenubtn = document.getElementById("openMenu");
let closeMenubtn = document.getElementById("closeMenu");
let menu = document.getElementById("mediaMenu");
openMenubtn.addEventListener("click", function () {
  menu.style.right = "0px";
});

closeMenubtn.addEventListener("click", function () {
  menu.style.right = "-350px";
});

function getInfo() {
  let prodsQtes = document.querySelectorAll(".prodCount");
  let totalPrice = 0;
  let prodCount = 0;
  let prodObj = [];
  for (let i = 0; i < prodsQtes.length; i++) {
    prodCount += parseInt(
      prodsQtes[i].value == "" || prodsQtes[i].value == 0
        ? 1
        : prodsQtes[i].value
    );
    prodObj.push([
      prodsQtes[i].parentElement.parentElement.parentElement.dataset.prodid,
      parseInt(
        prodsQtes[i].value == "" || prodsQtes[i].value == 0
          ? 1
          : prodsQtes[i].value
      ),
    ]);
    totalPrice +=
      parseInt(
        prodsQtes[i].value == "" || prodsQtes[i].value == 0
          ? 1
          : prodsQtes[i].value
      ) * prodsQtes[i].parentElement.previousElementSibling.dataset.price;
  }
  document.getElementById("totalPrice").textContent =
    totalPrice.toFixed(2) + " Dhs";
  document.getElementById("totalItems").textContent = prodCount;
  if (getCookie("prods") != null) {
    setCookie("prods", JSON.stringify(prodObj), 20);
  }
  setCartNum();
}
if (document.querySelectorAll(".prodCount").length > 0) {
  getInfo();
}

let addCartBtns = document.querySelectorAll("span.addCart");
let products_ids = JSON.parse(getCookie("prods")) || [];
for (let i = 0; i < addCartBtns.length; i++) {
  addCartBtns[i].onclick = function () {
    products_ids.push([addCartBtns[i].parentElement.dataset.prodId, 1]);
    setCookie("prods", JSON.stringify(products_ids));
    setCartNum();
    addCartBtns[i].classList.add("added");
  };
}

let addCartBtn = document.querySelector("button.addCart");
if (addCartBtn !== null) {
  addCartBtn.onclick = function () {
    products_ids.push([addCartBtn.dataset.prodId, 1]);
    setCookie("prods", JSON.stringify(products_ids));
    setCartNum();
    addCartBtn.classList.add("added");
  };
}
