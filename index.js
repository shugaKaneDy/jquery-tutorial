$(document).ready(function() {


  var recipe_textbox = $('#recipe_textbox');
  var add_btn = $('#add_btn');
  var cart = $('.cart');
  var deleteList = $('#deleteList');

  var fname = $('#fname');
  var lname = $('#lname');
  var form = $('#form');

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

  $('#loadBtn').on('click', function() {
    // $('#main-container').load('sample.txt #data');

    $.get("https://jsonplaceholder.typicode.com/users", function(data) {
      data.forEach(element => {
        // console.log(element.name);

        $('#main-container').append(`<p>${element.name}</p>`);
      });
    });
  });

  form.on('submit', function(e) {
    e.preventDefault();

    $.ajax({
      type: 'POST',
      url: '/jquery-tutorial/process.php',
      data: {firstname: fname.val(), lastname: lname.val()},
      success: function(response) {
        // console.log(JSON.parse(response));

        var data = JSON.parse(response);

        $('#main-container').append(`<p>${data.firstname} ${data.lastname}</p>`);

        Swal.fire({
          title: data.lastname,
          text: data.firstname,
          icon: "success"
        });
      }
    });

    // console.log("This was submitted");
  })

  
  /* fname.on('focus', function() {
    var lg = $(this).val().length;

    console.log("This was selected");
  }); */

  /* fname.on('keyup', function() {
    var lg = $(this).val().length;

    console.log(lg);
  }); */
  



});