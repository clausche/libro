@foreach ($tricks as $trick)
    {{-- expr --}}
@endforeach
@section('title', $trick->pageTitle)
@section('description', $trick->pageDescription)

@section('scripts')
    <script src="{{ url('js/vendor/highlight.pack.js')}}"></script>
    <script type="text/javascript">
    (function($) {
        hljs.tabReplace = '  ';
        hljs.initHighlightingOnLoad();
        $('[data-toggle=tooltip]').tooltip();
    })(jQuery);
    </script>
    @if(Auth::check())
    <script>
    (function(e){e(".js-like-trick").click(function(t){t.preventDefault();var n=e(this).data("liked")=="0";var r={_token:"{{ csrf_token() }}"};e.post('{{ route("tricks.like", $trick->slug) }}',r,function(t){if(t!="error"){if(!n){e(".js-like-trick .fa").removeClass("text-primary");e(".js-like-trick").data("liked","0");e(".js-like-status").html("Like this?")}else{e(".js-like-trick .fa").addClass("text-primary");e(".js-like-trick").data("liked","1");e(".js-like-status").html("You like this")}e(".js-like-count").html(t+" likes")}})})})(jQuery)
    </script>
    @endif
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="content-box">
                    @if(Auth::check() && (Auth::user()->id == $trick->user_id))
                        <div class="text-right">
                            <a data-toggle="modal" href="#deleteModal">Delete</a> |
                            <a href="{{$personal->editLink}}">Editar</a>
                            @include('tricks.delete',['link'=>$trick->deleteLink])
                        </div>
                    @endif
                    <div class="trick-user">
                       
                        <div class="trick-user-data">
                            <h1 class="page-title">{{ $personal->name }} Consulado de Venezuela en 
                                {{ $trick->title }}
                            </h1>
                            <div>
                              
                            </div>
                        </div>
                    </div>
                    <p>{{{ $trick->description }}}</p>
                  
                </div>
                <div class="content-box">
                            <div>
                                Consulado de {{ $personal->name }}</a></b> 
                            </div>
                </div>
                <div class="content-box">
                
                            <div>
                                slug: {{ $personal->slug }}</a></b> 
                            </div>
                </div>
            </div>
                
            </div>
         </div>       
    
    </div>
@stop
