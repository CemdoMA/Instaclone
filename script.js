// // var imgid = $('[id=imageid]').map(function(){
// //     return $(this).attr("class");
// // }).get();
// // console.log(imgid);
//
// $("form.ajax").on('click',".bewerken", function(){
//     $(".bewerken").css("display", "none");
//     $(".span").css("display", "none");
//     $(".editinput").css("display", "inline-block");
//     $(".submitPHP").css("display", "inline-block");
// });
//
// $('').on('submit',".ajax", function() {
//     var form = $(this),
//         url = form.attr('action'),
//         type = form.attr('method'),
//         data = {};
//
//     form.find('[name]').each(function(){
//         var input = $(this),
//             name = input.attr('name'),
//             value = input.val();
//
//         data[name] = value;
//     });
//
//     $.ajax({
//         url: url,
//         type: type,
//         data: data,
//         success: function(response) {
//             console.log(response);
//             updateDescription();
//         }
//     });
//     $(".span").css("display", "inline-block");
//     $(".bewerken").css("display", "inline-block");
//     $(".editinput").css("display", "none");
//     $(".submitPHP").css("display", "none");
//     return false;
// });
//
function updateDescription() {
    $(".container").load("index.php .artic");
}

$(".editButton").click(function(){
    $(".editButton").css("display", "none");
    $(".span").css("display", "none");
    $(".editSpan").css("display", "inline-block");
    $(".submitPHP").css("display", "inline-block");
});

$(".submitPHP").click(function(){
    $(".editButton").css("display", "inline-block");
    $(".span").css("display", "inline-block");
    $(".editSpan").css("display", "none");
    $(".submitPHP").css("display", "none");

    var Content = document.getElementById('span');
    var editedContent = document.getElementsByClassName('editSpan');

        Content = editedContent;
        updateDescription();


});

