$(document).ready(function() {

$('#block-cart > p').toggle(
function() {
$('#block-cart > div').show();
$('#corner').attr("class","corner-up");
},
function() {
$('#block-cart > div').hide();
$('#corner').attr("class","corner-down");
}
);

var newcount = 0;

$('.add-tovar').click(function(){

var allprice = $('#block-cart span#price').attr("price");
var price = $(this).attr("price");
var tovarid = $(this).attr("rel");

newprice = Number(allprice) + Number(price);
newcount ++;

$('#block-cart span#price').html (newprice+' руб.').attr("price",newprice);
$('#block-cart span.count').html (newcount);

$(document).mousemove(function(pos){
$(".messagecart").css('left',(pos.pageX+10)+'px').css('top',(pos.pageY+10)+'px');
});

$(".messagecart".html("Добавляю...").show();

$.ajax({
type: "POST",
url:"/addtocart.php",
dataType: "html",
data: "id="+tovarid,
success: function(data) {

$(".messagecart".html("Добавлено");
setTimeout('$(".messagecart").hide();',600);

}
});
});
});
