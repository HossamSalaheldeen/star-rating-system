{{--@dd($rating)--}}
<div class="rating">
    {{--        <span class="rating_span">--}}
    <input class="star star-1" value="1" id="star-1" type="radio" name="star" {{$rating == 1 ? 'checked' : ''}}/>
    <label class="star_label star_label_1" for="star-1"><i class="rating_star {{$rating >= 1 && $rating <= 5 ? 'fas' : 'far'}} fa-star"></i></label>
    {{--        </span>--}}

    {{--    <span class="rating_span">--}}
    <input class="star star-2" value="2" id="star-2" type="radio" name="star" {{$rating == 2 ? 'checked' : ''}}/>
    <label class="star_label star_label_2" for="star-2"><i class="rating_star {{$rating >= 2 && $rating <= 5 ? 'fas' : 'far'}} fa-star"></i></label>
    {{--        </span>--}}

    {{--    <span class="rating_span">--}}
    <input class="star star-3" value="3" id="star-3" type="radio" name="star" {{$rating == 3 ? 'checked' : ''}}/>
    <label class="star_label star_label_3" for="star-3"><i class="rating_star {{$rating >= 3 && $rating <= 5 ? 'fas' : 'far'}} fa-star"></i></label>
    {{--        </span>--}}

    {{--    <span class="rating_span">--}}
    <input class="star star-4" value="4" id="star-4" type="radio" name="star" {{$rating == 4 ? 'checked' : ''}}/>
    <label class="star_label star_label_4" for="star-4"><i class="rating_star {{$rating >= 4 && $rating <= 5 ? 'fas' : 'far'}} fa-star"></i></label>
    {{--        </span>--}}

    {{--    <span class="rating_span">--}}
    <input class="star star-5" value="5" id="star-5" type="radio" name="star" {{$rating == 5 ? 'checked' : ''}}/>
    <label class="star_label star_label_5" for="star-5"><i class="rating_star {{$rating == 5 ? 'fas' : 'far'}} fa-star"></i></label>
    {{--        </span>--}}
</div>

