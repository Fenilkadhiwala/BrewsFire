// console.log("Hey");

document.addEventListener("DOMContentLoaded", () => {
  var allItems = document.querySelectorAll(".collection-list .best");
  var allFilters = document.querySelectorAll(".filters");
  var filterBtn = document.querySelector(".filterBtn");

  allFilters.forEach((e) => {
    e.addEventListener("click", () => {
      //   console.log(e.textContent);

      pBtn = e.textContent;
      filterBtn.textContent = pBtn;

      if (pBtn != "All") {
        for (var i = 0; i < allItems.length; i++) {
          var flag = allItems[i].textContent.includes(pBtn);

          if (flag) {
            allItems[i].style.display = "block";
          } else {
            allItems[i].style.display = "none";
          }
        }
      } else {
        // console.log("Clicked On All");
        location.reload();
      }
    });
  });

  var hiddenField = document.querySelector(".hiddenField");
  var orderBtn = document.getElementById("place");

  if (hiddenField) {
    orderBtn.style.display = "none";
  } else {
    orderBtn.style.display = "block";
  }

  var placeBtn = document.getElementById('place')

function updateCODText() {
    placeBtn.innerText = "Place Order";
}


function updateText() {
    placeBtn.innerText = "Proceed With Payment";
}

placeBtn.addEventListener("click", () => {
    if (placeBtn.innerText === "Proceed With Payment") {
        window.location.href = "pay.php";
    } else {
        window.location.href = "cod.php";
        // console.log("CC");
    }
})
});
