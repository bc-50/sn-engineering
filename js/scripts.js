$(function() {
  var $hamburger = $(".hamburger");
  $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
    // Do something else, like open/close menu
  });
  var check;
  var start = true;
  $(".carousel-button").click(function(e) {
    e.preventDefault();

    if ($(e.target).hasClass("carousel-button")) {
      var button = $(e.target);
    } else {
      var button = $(e.target).parents(".carousel-button");
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
    if ($(button).hasClass("carousel-control-next")) {
      var epos = all.length - 1,
        eapos = active.length - 1,
        eind = 0,
        eaind = [0, active.length - 1],
        pom = 1,
        efind = active.length - 1,
        op = [">", "<"];
    } else {
      var epos = 0, // if this side has the 0
        eapos = 0,
        eind = all.length - 1,
        eaind = [active.length - 1, 0],
        pom = -1,
        efind = 0,
        op = ["<", ">"];
    }

    if (start) {
      check = active.length - 1;
      start = false;
    }

    var comp = {
      "<": function(i, eaind) {
        return i < eaind;
      },
      ">": function(i, eaind) {
        return i > eaind;
      }
    };

    var position = all.findIndex(findEl);

    if (position == epos) {
      var shifts = active.length - 1;
      for (let j = 1; j < all.length - 1; j++) {
        if ($(all[position - j * pom]).hasClass("active")) {
          shifts--;
        } else {
          break;
        }
      }
      console.log(shifts);
      if (shifts == 0) {
        var next = eind;
      } else {
        active = shift(shifts, active);
        var next = all.findIndex(findEl) + 1 * pom;
        console.log("henor");
      }
    } else {
      var next = all.findIndex(findEl) + 1 * pom;
    }

    all.forEach(e => {
      $(e).removeAttr("style");
    });
    var order = eapos + 1;
    $(all[next]).css("order", order);
    order += -1 * pom;
    for (let i = eaind[1]; comp[op[0]](i, eaind[0]); i += -1 * pom) {
      $(active[i]).css("order", order);
      order += -1 * pom;
    }
    $(active[eaind[0]]).removeClass("active");
    $(all[next]).addClass("active");

    function findEl(find) {
      return find == active[efind];
    }

    function shift(shifts, arr) {
      var temp;
      do {
        temp = arr[eaind[0]];
        for (let i = eaind[0]; comp[op[1]](i, eaind[1] + pom); i += 1 * pom) {
          if (comp[op[1]](i - 1, eaind[1] + pom)) {
            arr[i] = arr[i + 1 * pom];
          }
        }
        arr[eaind[1]] = temp;
        shifts--;
      } while (shifts > 0);

      return arr;
    }
  });
});
