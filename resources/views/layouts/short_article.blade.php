<div class="articles_cont">
    <a href="{{route('article.show', $article->id)}}">
        <div class="article">
            <img class="image_article" src="{{asset('images_articles/' . $article->image)}}" alt="">
            <div class="count_series">
                @isset($article->episodes) EPS: {{$article->episodes}} @endisset
            </div>
            <div class="article_type">{{$article->type->title}}</div>
            <div class="article_rating">☆ {{$article->rating->rating}}</div>
        </div>
        <div class="title_article">{{$article->title_rus}}</div>
    </a>
</div>
