$(function() {
  var $hamburger = $(".hamburger");
  $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
    // Do something else, like open/close menu
  });
  $("#clients_slider").on("slid.bs.carousel", function(e) {
    if (e.direction == "left") {
      alert("left");
    } else {
      alert("right");
    }
  });

  $(".carousel-control-next").click(function(e) {
    e.preventDefault();

    if ($(e.target).hasClass("carousel-control-next")) {
      var button = $(e.target);
    } else {
      var button = $(e.target).parents(".carousel-control-next");
    }

    var slide = $(button).attr("href");
    var active = [];
    var all = [];
    $(slide + " .carousel-item").each(function(i, e) {
      all.push(e);
    });

    all.forEach(function(i) {
      if ($(i).hasClass("active")) {
        active.push(i);
      }
    });
    var position = all.findIndex(findEl);
    if (position == all.length - 1) {
      var shifts = 0;
      for (let j = 3; j > 0; j--) {
        $(active[position]).addClass(shifts);
        if ($(all[position - j]).hasClass("active")) {
          break;
        }
        shifts++;
      }
      console.log(shifts);
      if (shifts == 0) {
        var next = 0;
      } else {
        active = shift(shifts, active);

        var next = all.findIndex(findEl) + 1;
      }
    } else {
      var next = all.findIndex(findEl) + 1;
    }

    all.forEach(e => {
      $(e).removeAttr("style");
    });
    var order = active.length;
    $(all[next]).css("order", order--);
    for (let i = active.length - 1; i > 0; i--) {
      console.log(order);
      $(active[i]).css("order", order--);
    }

    $(active[0]).removeClass("active");
    $(all[next]).addClass("active");

    function findEl(find) {
      return find == active[3];
    }
  });
});

function shift(shifts, arr) {
  var temp;
  do {
    temp = arr[0];
    for (let i = 0; i < arr.length; i++) {
      if (i + 1 < arr.length) {
        arr[i] = arr[i + 1];
      }
    }
    arr[arr.length - 1] = temp;
    shifts--;
  } while (shifts > 0);

  return arr;
}
