// const ratingStars = [...document.getElementsByClassName("rating__star")];
// const ratingResult = document.querySelector(".rating__result");
//
// printRatingResult(ratingResult);
//
// function executeRating(stars, result) {
//     const starClassActive = "rating__star fas fa-star";
//     const starClassUnactive = "rating__star far fa-star";
//     const starsLength = stars.length;
//     let i;
//     stars.map((star) => {
//         star.onclick = () => {
//             i = stars.indexOf(star);
//
//             if (star.className.indexOf(starClassUnactive) !== -1) {
//                 printRatingResult(result, i + 1);
//                 for (i; i >= 0; --i) stars[i].className = starClassActive;
//             } else {
//                 printRatingResult(result, i);
//                 for (i; i < starsLength; ++i) stars[i].className = starClassUnactive;
//             }
//         };
//     });
// }
//
// function printRatingResult(result, num = 0) {
//     result.textContent = `${num}/5`;
// }
//
// executeRating(ratingStars, ratingResult);

$(document).ready(function(){
    $(".rating .star_label").on("click", function(){
        $(this).find('.rating_star').removeClass('far').addClass('fas');
        $(this).prevAll().find('.rating_star').removeClass('far').addClass('fas');
        $(this).nextAll().find('.rating_star').removeClass('fas').addClass('far');
    });

    // $(".rating .star_label_1").on("click", function(){
    //     $('input[name="star"]').prop('checked', false);
    //     console.log($(this).prev().removeAttr('checked'));
    // });
    //
    // $("#add-vendor-rating").on("submit", function(){
    //     console.log("check",$('.star_label_1 .rating_star').hasClass('far') && !!$('input[name="star"]:checked').val());
    //     if($('.star_label_1 .rating_star').hasClass('far') && !!$('input[name="star"]:checked').val())
    //     {
    //         $('input[name="star"]').prop('checked', false);
    //
    //     }
    // });
    //
    // $("#edit-vendor-rating").on("submit", function(){
    //     console.log("check",$('.star_label_1 .rating_star').hasClass('far') && !!$('input[name="star"]:checked').val());
    //     if($('.star_label_1 .rating_star').hasClass('far') && !!$('input[name="star"]:checked').val())
    //     {
    //         $('input[name="star"]').prop('checked', false);
    //
    //     }
    // });

});




