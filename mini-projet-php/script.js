let all_check_boxs = document.querySelectorAll("input[type='checkbox']");
console.log(all_check_boxs);

let num = 0;
let max = 4;
function checkCount() {
  var count = 0;
  for (var i = 0; i < all_check_boxs.length; i++) {
    if (all_check_boxs[i].checked) {
      count++;
    }
  }
  if (count == 0) {
    document.getElementById("envoyer").disabled = true;
  } else {
    document.getElementById("envoyer").disabled = false;
  }
}



all_check_boxs.forEach(element => {
  element.addEventListener("change", function () {
 
    if (element.checked) {
      num++;
    }
    else {
      num--;
    }
    if (num >= max) {
      all_check_boxs.forEach(element => {
        if (!element.checked) {
          element.disabled = true;
        }
      });
    }
    else {
      all_check_boxs.forEach(element => {
        element.disabled = false;
      });
    }


  });

});

let btn_envoyer = document.querySelector(".envoyer-btn");

//Number Of essays




