$(document).ready(function() {


  var recipe_textbox = $('#recipe_textbox');
  var add_btn = $('#add_btn');
  var cart = $('.cart');
  var deleteList = $('#deleteList');

  add_btn.on('click', function() {

    if(recipe_textbox.val().length > 0) {

      cart.append(`<div>Item List<p>Recipee: ${recipe_textbox.val()} <button class="deleteBtn">Delete</button></p></div>`);
      recipe_textbox.val('');
    
      $('.deleteBtn').on('click', function() {
        // console.log($(this).parent());
        // $(this).parent().remove();
        // $(this).parent().parent().remove();
        $(this).parentsUntil(".cart").remove();
      });
    } else {
      alert("Required");
    }
  });

  deleteList.on('click', function() {
    // $('#check-list').children().css({"color" : "red"});
    // $('#check-list').find(".unq").css({"color" : "red", "font-size" : "32px"});
    // $('#check-list > ul > li').first().css({"color" : "red", "font-size" : "32px"});
    // $('#check-list > ul > li').last().css({"color" : "red", "font-size" : "32px"});
    // $('#check-list > ul > li').eq(3).css({"color" : "red", "font-size" : "32px"});
    // $('#check-list > ul > li').filter(".unq").css({"color" : "red", "font-size" : "32px"});
    $('#check-list > ul > li').not(".unq").css({"color" : "red", "font-size" : "32px"});
  });

  

});