<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">

    <!-- ↓をつける -->
    <meta name="csrf-token" content="{{ csrf_token() }}">         

    <title>Summernote with Bootstrap 4</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/src/lang/summernote-ja-JP.js"></script>
    
  </head>
  <body>
    @if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <div class="container">
      <div class="row">
          <div class="col-md-7 offset-3 mt-4">
              <div class="card-body">
                <form method="post" action="{{route('summernote.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">件名</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for ="body">投稿本文</label>
                        <textarea class="form-control" name="body" id="summernote" cols="30" rows="10"></textarea>
                    </div>
                    <button type=”submit” class="btn btn-danger btn-block">保存</button>
                </form>
              </div>
          </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  </body>
</html>

<script>
  
  $('#summernote').summernote({
    placeholder: 'ここにテキストを書きます。画像も入れる事ができます。',
    height: 200,
    lang: 'ja-JP',
    callbacks: {
      onImageUpload: function(files) {            //コールバック関数名
        sendFile(files[0]);
        console.log(files[0]);                    //情報の確認用
      },
    }
  });

  function sendFile(file) {
    var form_data = new FormData();
    form_data.append('image', file);
  
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},        //「X-CSRF-TOKEN」に「$('meta[name="csrf-token"]').attr('content')」を送信する、7行目と一緒に使う事で安全なajax通信を行う事ができる
      data: form_data,         //送信するデータ
      type: "POST",
      contentType: 'multipart/form-data',
      url: 'temp',           //ファイルの保存先
      cache: false,          //ajaxの際にキャッシュが残らない様にする
      contentType: false,    //サーバーにデータを送った時に適切なデータに変換するのをなしにする
      processData: false,    //ファイルを文字列にせずそのままの状態でサーバーに送る
      
    })
    .done(function(url){
      $('#summernote').summernote('insertImage', url);
    })
    .fail(function(url){
      console.log('画像を送れません');
    })
    .always(function(url){
      console.log('画像を送りました');
    });
  }
 

  
</script>