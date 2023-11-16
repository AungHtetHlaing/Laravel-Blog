<div class=" position-sticky" style=" top:80px">
    <div class=" search-form mb-4">
        <p class=" mb-2 fw-bold">Article Search</p>
        <form action="">
            <div class="input-group">
                <input type="text" class=" form-control" value="{{ request()->keyword }}" name="keyword">
                <button class=" btn btn-dark">
                    <i class=" bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="text-center my-2">


        {{ QrCode::style('round')->generate( request()->url() )    }}
        <br>
        <span class=" text-info">QrCode For this page</span>
    </div>

    <div class=" categories mb-4">
        <p class=" mb-2 fw-bold">Article Categories</p>
        <div class=" list-group">
            <a href="{{ route('index') }}"
                class=" list-group-item list-group-item-action  {{route('index') === request()->url() ? 'bg-dark text-white' : ''}}">All Categories</a>
            @foreach ($categories as $category)
                <a href="{{ route('categorized',$category->slug) }}"
                    class=" list-group-item list-group-item-action {{route('categorized',$category->slug) === request()->url() ? 'bg-dark text-white' : ''}}">{{ $category->title }}</a>
            @endforeach
        </div>
    </div>

    <div class=" recent-articles mb-4">
        <p class=" mb-2 fw-bold">Recent Articles</p>
        <div class=" list-group">

            @foreach (App\Models\Article::latest("id")->limit(5)->get() as $article)
                <a href="{{ route('detail',$article->slug) }}"
                    class=" list-group-item list-group-item-action {{route('detail',$article->slug) === request()->url() ? 'bg-dark text-white' : ''}}">{{ $article->title }}</a>
            @endforeach
        </div>
    </div>
</div>
