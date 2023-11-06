<form class="filter">
    <div class="filter-container">
        <div class="basic-search">
            <input id="search" type="search" name="title" placeholder="Поиск по ключевым словам..." value="{{request('title')}}"/>
        </div>

        <div class="advance-search">
            <div class="row">
                <div class="colum">
                    <div>Тип:</div>
                    <div class="check_select">
                        @foreach($types as $type)
                            <label><input type="checkbox" name="type[]" value="{{$type->id}}"
                                @if(request()->exists('type'))
                                    @foreach(request('type') as $typeValue)
                                        @checked($type->id === (int) $typeValue)
                                        @endforeach
                                    @endif
                                >{{$type->title}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="colum">
                    <div>Категория:</div>
                    <div class="check_select">
                        @foreach($categories as $category)
                            <label><input type="checkbox" name="category[]" value="{{$category->id}}"
                                @if(request()->exists('category'))
                                    @foreach(request('category') as $categoryValue)
                                        @checked($category->id === (int) $categoryValue)
                                        @endforeach
                                    @endif
                                >{{$category->title}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="colum">
                    <div>Жанр:</div>
                    <div class="check_select">
                        @foreach($genres as $genre)
                            <label><input type="checkbox" name="genre[]" value="{{$genre->id}}"
                                @if(request()->exists('genre'))
                                    @foreach(request('genre') as $genreValue)
                                        @checked($genre->id === (int) $genreValue)
                                        @endforeach
                                    @endif
                                >{{$genre->title}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="colum">
                    <div>Страна:</div>
                    <div class="check_select">
                        @foreach($countries as $country)
                            <label><input type="checkbox" name="country[]" value="{{$country->id}}"
                                @if(request()->exists('country'))
                                    @foreach(request('country') as $countryValue)
                                        @checked($country->id === (int) $countryValue)
                                        @endforeach
                                    @endif
                                >{{$country->title}}</label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="colum">
                    <div>Год от:</div>
                    <input id="year_from" type="number" name="year_from" placeholder="Год от..." value="{{request('year_from')}}"/>
                </div>

                <div class="colum">
                    <div>Год до:</div>
                    <input id="year_to" type="number" name="year_to" placeholder="Год до..." value="{{request('year_to')}}"/>
                </div>

                <div class="colum">
                    <div>Строгий поиск по жанру?</div>
                    <label class="toggle-wrapper">
                        <input type="checkbox" id="genre_and_or" name="genre_and_or" @checked(request('genre_and_or') !== null) />
                        <div class="toggle-slider">
                            <div class="toggle-knob"></div>
                        </div>
                    </label>
                </div>

                <div class="colum"></div>
            </div>

            <div class="filter-footer">
                <div class="result-count">
                    Найдено&nbsp;<span>{{ $articles->total() }}</span>
                </div>
                <div class="group-btn">
                    <a href="#" onClick="window.location.replace(location.pathname);">
                        <button type="button" class="btn-delete">СБРОСИТЬ</button>
                    </a>
                    <button type="submit" class="btn-search">ПОИСК</button>
                </div>
            </div>
        </div>
    </div>
</form>

