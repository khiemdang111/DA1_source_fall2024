var rating_data = 0;


function reset_background() {
  var stars = document.querySelectorAll(".submit_star");
  stars.forEach(function (star) {
    star.classList.remove("text-warning");
    star.classList.add("star-light");
  });
}


document.addEventListener("mouseover", function (event) {
  if (event.target.classList.contains("submit_star")) {
    var rating = parseInt(event.target.getAttribute("data-rating"));

    reset_background();

    var stars = document.querySelectorAll(".submit_star");
    stars.forEach(function (star, index) {
      if (index < rating) {
        star.classList.add("text-warning");
      }
    });
  }
});


document.addEventListener("mouseout", function (event) {
  if (event.target.classList.contains("submit_star")) {
    reset_background();

    var stars = document.querySelectorAll(".submit_star");
    stars.forEach(function (star, index) {
      if (index < rating_data) {
        star.classList.remove("star-light");
        star.classList.add("text-warning");
      }
    });
  }
});


document.addEventListener("click", function (event) {
  if (event.target.classList.contains("submit_star")) {
    rating_data = parseInt(event.target.getAttribute("data-rating"));
    document.getElementById("rating_data").value = rating_data; 

    reset_background();

    var stars = document.querySelectorAll(".submit_star");
    stars.forEach(function (star, index) {
      if (index < rating_data) {
        star.classList.add("text-warning");
      }
    });
  }
});
