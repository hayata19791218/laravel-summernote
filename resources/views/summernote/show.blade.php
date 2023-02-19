<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">投稿一覧</h1>
            @foreach($contents as $content)
            <p>{{$content->created_at}}</p>
            <h2 class="mt-0">{{$content->title}}</h2>
            <p>{!!$content->body!!}</p>
            <!-- <form method="post" action="{{route('summernote.delete',['id' => $content->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか?');">削除</button>
            </form> -->
            <hr>
            @endforeach

            
        </div>
    </div>
 </div>