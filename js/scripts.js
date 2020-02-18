$(function () {
  var $hamburger = $(".hamburger");
  $hamburger.on("click", function (e) {
    $hamburger.toggleClass("is-active");
    // Do something else, like open/close menu
  });
  addWidth();
  $(".carousel-button").click(e =>{
    e.preventDefault();
    if ($(e.target).hasClass("carousel-button")) {
      var button = $(e.target);
    } else {
      var button = $(e.target).parents(".carousel-button");
    }
    if (($(button).attr("href") != '#')) {
      slidemove(button);
    }
      
  });
});


function slidemove(button){

    var wrapper = $(button).siblings('.carousel-inner').children('.items-wrapper');
    var slide = $(button).attr("href");
    $(button).attr('href', '#');

    var active = [];
    var all = [];
    $(slide + " .carousel-item").each(function (i, e) {
      all.push(e);
    });
    all.forEach(function (i) {
      if ($(i).hasClass("active")) {
        active.push(i);
      }
    });
    var perc = Math.ceil(100 / active.length) - 3.8;

    if ($(button).hasClass("carousel-control-next")) {
      var epos = all.length - 1,
        eapos = active.length - 1,
        eind = 0,
        eaind = [0, active.length - 1],
        pom = 1,
        efind = active.length - 1,
        op = [">", "<"];
       /*  all.forEach(e => {
          $(e).css('order', '0');
        }); */
    } else {
      var epos = 0, // if this side has the 0
        eapos = 0,
        eind = all.length - 1,
        eaind = [active.length - 1, 0],
        pom = -1,
        efind = 0,
        op = ["<", ">"];
        all.forEach(e => {
          $(e).css('order', '1000');
        });
    }
    var right = ($(wrapper).width() * ((perc + 3.8)/100)) / 2;
    $(wrapper).css('margin-right', -right * pom)
    var comp = {
      "<": function (i, eaind) {
        return i < eaind;
      },
      ">": function (i, eaind) {
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
      if (shifts == 0) {
        var next = eind;
      } else {
        active = shift(shifts, active);
        var next = all.findIndex(findEl) + 1 * pom;
      }
    } else {
      var next = all.findIndex(findEl) + 1 * pom;
    }
    console.log(right);
    var order = eapos;
    $(all[next]).css("order", order);
    
    order += -1 * pom;
    for (let i = eaind[1]; comp[op[0]](i, eaind[0]); i += -1 * pom) {
      $(active[i]).css("order", order);
      order += -1 * pom;
    }

    
    $(all[next]).addClass("active");

    $(wrapper).animate({right: right * 2 * pom + "px"}, 
    2000,
    () => {
     
      $(active[eaind[0]]).removeClass("active");
      all.forEach(e => {
        if (!$(e).hasClass('active')) {
          $(e).css("order", '1000');
        }else{
        }
      });
      $(wrapper).removeAttr('style');
      $(button).attr('href', slide);

    });
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
    return true;
  }

function addWidth() {
  var act = 0;
  $(".carousel-item").each(function (i) {
    if ($(this).hasClass('active')) {
      act++;
    }
  });
  $(".carousel-item").each(function (i) {
    $(this).css('flex-basis', Math.ceil(100 / (act - 1)) - 3.8 + '%');
  });

}