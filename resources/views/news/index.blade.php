<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>News Aggregation from NEWS.API</title>
</head>
<div class="container">
    <div class="card mt-5">
        <h3 class="card-header p-3">Search</h3>
        <div class="card-body">
           
            <form action="#" method="POST" enctype="multipart/form-data" class="mt-2">
                @csrf
       
                <select class="form-control" id="search" style="width:500px;" name="title"></select>
       
                <div class="mb-3 mt-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            
            </form>
        </div>
    </div>  
     
</div>

<script type="text/javascript">

    var path = "{{ route('autocomplete') }}";
    $('#search').select2({
        placeholder: 'Select news title',
        ajax: {
          url: path,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: news.title,
                        id: news.id
                    }
                })
            };
          },
          cache: true
        }
      });
   
</script>

<body>
    @foreach($newsinfo as $news)

    <div class="card mt-5 ml-5" style="width:90%">
        <div class="row center">
            <div class="col-sm-6">
                <img src="{{ $news['urlToImage'] }}" class="card-img-top" alt="..." style="width:90%;height:90%">
            </div>
            <div class="col-sm-6">
                <div class="card-body">
                    <h5 class="card-title">{{ $news['title'] }}</h5>
                    <p class="card-text">{{ $news['content'] }}</p>
                    <p class="card-text"><small class="text-muted"> Publish Date:
                            {{ date('d-m-Y', strtotime($news['publishedAt']));  }}</small></p>
                    <p class="card-text"><small class="text-muted"> Author: {{ $news['author'] }}</small></p>
                  <a href="{{url($news['url'])}}" data-toggle="tooltip">{{ $news['url'] }}</a>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>
    {!! $newsinfo->withQueryString()->links('pagination::bootstrap-5') !!}
</html>