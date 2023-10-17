<div class="rating_cont">
    <div class="rating">
        <div id="warning_rating"><span></span></div>
        <div class="rating_text">
            <span>{{$article->rating->rating}}/10</span>
            <sub size="10px">{{$article->rating->count_assessments}}</sub>
             @if($article->user_assessment) <br>Ваша оценка: {{$article->user_assessment}} @endif
        </div>
        <div class="rating_stars">
            <form class="stars" id="rating">
                <input type="radio" id="star10" name="rating" @checked(round($article->rating->rating) == 10)>
                <label for="star10" title="Оценка 10" onclick="rating({{$article->id}}, 10)"></label>
                <input type="radio" id="star9" name="rating" @checked(round($article->rating->rating) == 9)>
                <label for="star9" title="Оценка 9" onclick="rating({{$article->id}}, 9)"></label>
                <input type="radio" id="star8" name="rating" @checked(round($article->rating->rating) == 8)>
                <label for="star8" title="Оценка 8" onclick="rating({{$article->id}}, 8)"></label>
                <input type="radio" id="star7" name="rating" @checked(round($article->rating->rating) == 7)>
                <label for="star7" title="Оценка 7" onclick="rating({{$article->id}}, 7)"></label>
                <input type="radio" id="star6" name="rating" @checked(round($article->rating->rating) == 6)>
                <label for="star6"  title="Оценка 6" onclick="rating({{$article->id}}, 6)"></label>
                <input type="radio" id="star5" name="rating" @checked(round($article->rating->rating) == 5)>
                <label for="star5" title="Оценка 5" onclick="rating({{$article->id}}, 5)"></label>
                <input type="radio" id="star4" name="rating" @checked(round($article->rating->rating) == 4)>
                <label for="star4" title="Оценка 4" onclick="rating({{$article->id}}, 4)"></label>
                <input type="radio" id="star3" name="rating" @checked(round($article->rating->rating) == 3)>
                <label for="star3" title="Оценка 3" onclick="rating({{$article->id}}, 3)"></label>
                <input type="radio" id="star2" name="rating" @checked(round($article->rating->rating) == 2)>
                <label for="star2" title="Оценка 2" onclick="rating({{$article->id}}, 2)"></label>
                <input type="radio" id="star1" name="rating" @checked(round($article->rating->rating) == 1)>
                <label for="star1" title="Оценка 1" onclick="rating({{$article->id}}, 1)"></label>
            </form>
        </div>
    </div>
</div>
