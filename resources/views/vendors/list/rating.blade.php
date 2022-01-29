<div class="rating">

    <label class="star_label star_label_1" for="star-1"><i class="rating_star {{$vendor->averageRating >= 0.5 && $vendor->averageRating < 1 ? 'fas fa-star-half-alt' : ''}} {{$vendor->averageRating >= 1 && $vendor->averageRating <= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></label>

    <label class="star_label star_label_2" for="star-2"><i class="rating_star {{$vendor->averageRating >= 1.5 && $vendor->averageRating < 2 ? 'fas fa-star-half-alt' : ''}} {{$vendor->averageRating >= 2 && $vendor->averageRating <= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></label>

    <label class="star_label star_label_3" for="star-3"><i class="rating_star {{$vendor->averageRating >= 2.5 && $vendor->averageRating < 3 ? 'fas fa-star-half-alt' : ''}} {{$vendor->averageRating >= 3 && $vendor->averageRating <= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></label>

    <label class="star_label star_label_4" for="star-4"><i class="rating_star {{$vendor->averageRating >= 3.5 && $vendor->averageRating < 4 ? 'fas fa-star-half-alt' : ''}} {{$vendor->averageRating >= 4 && $vendor->averageRating <= 5 ? 'fas fa-star' : 'far fa-star'}}"></i></label>

    <label class="star_label star_label_5" for="star-5"><i class="rating_star {{$vendor->averageRating >= 4.5 && $vendor->averageRating < 5 ? 'fas fa-star-half-alt' : ''}} {{$vendor->averageRating == 5 ? 'fas fa-star' : 'far fa-star'}}"></i></label>

    <label>{{$vendor->averageRating}} Rate from {{$vendor->usersRated()}} users voted</label>
</div>
