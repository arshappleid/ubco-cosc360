/* jQuery and JavaScript code here for lab6-1.html */

$(document).ready(function () {
  $("#pageTitle").html("Lab 6 –DOM Manipulation with jQuery");
  $("#msgArea").html(`My class is ${$("#msgArea").attr("class")}`);
  $("button").attr("class", "btn btn-danger");
  $("body").css("background-color", "ivory");
  $(".center-icons").addClass("selected");

  $(".panel:first").click(function () {
    $("#message").html("You clicked this panel");
  }).hover(function (e) {
    $("#message").html(`x=${e.pageX} y=${e.pageY}`);
  }, function () {
    $("#message").html("The mouse has left");
  });

  let image = document.createElement("img");
  image.src = "images/art/thumbs/13030.jpg";
  image.alt = "image";
  $("#panel-2").append(image);

  $(".img-responsive").hover(function () {
    // construct preview filename based on existing img
    let alt = $(this).attr('alt');
    let src = $(this).attr('src');
    let newsrc = src.replace("small","medium");

    // make dynamic element with larger preview image and caption
    let preview = $('<div id="preview"></div>').css("display", "block");
    let image = $('<img src="' + newsrc + '">');
    let caption = $('<p>' + alt + '</p>');

    $(this).addClass("gray");
    preview.append(image).append(caption).css({"left": "0", "bottom": "0"});
    $("body").prepend(preview);
  }, function () {
    $("#preview").fadeOut();
    $(this).removeClass("gray");
  });
});