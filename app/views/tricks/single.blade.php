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
                            <a href="{{$trick->editLink}}">Editar</a>
                            @include('tricks.delete',['link'=>$trick->deleteLink])
                        </div>
                    @endif
                    <div class="trick-user">
                        <!-- <div class="trick-user-image">
                            <img src="{{ $trick->user->photocss }}" class="user-avatar">
                        </div> -->
                        <div class="trick-user-data">
                            <h1 class="page-title">
                                {{ $trick->title }}
                            </h1>
                            <div>
                                Submitted by <b><a href="{{ route('user.profile', $trick->user->username) }}">{{ $trick->user->username }}</a></b> - {{ $trick->timeago }}
                            </div>
                        </div>
                    </div>
                    <p>{{{ $trick->description }}}</p>
                    
                </div>
                <div class="content-box">
                            <div>
                                Submitted by <b><a href="{{ route('user.profile', $trick->user->username) }}">{{ $trick->user->username }}</a></b> - {{ $trick->timeago }}
                            </div>
                </div>
                <div class="content-box">
                            <div>
                                Submitted by <b><a href="{{ route('user.profile', $trick->user->username) }}">{{ $trick->user->username }}</a></b> - {{ $trick->timeago }}
                            </div>
                </div>
                <div class="content-box">
                            <div>
                                @foreach ($paises as $pais)
                                    Modelo -> id = {{ $pais->continent }}
                                @endforeach
                            </div>
                </div>
            </div>
                <div class="col-lg-3 col-md-4">
                    <div class="content-box">
                    @foreach ($trick->ciudades as $ciudad)
                    
                     @endforeach
                        <b>Datos del País</b>
                        <ul class="list-group trick-stats">
                            
                            <li class="list-group-item">
                                <span class="fa fa-eye"></span> {{ $trick->view_cache }} views
                            </li>
                            <li class="list-group-item">
                                <span class="fa fa-eye"></span> Población : {{ number_format($ciudad->population) }}
                            </li>
                            <li class="list-group-item" >
                                <span class="fa fa-eye"></span> Distrito : {{ $ciudad->district }}
                                
                            </li>
                        </ul>
                        @if(count($trick->allCategories))
                            <b>Categorias</b>
                            <ul class="nav nav-list push-down">
                                @foreach($trick->allCategories as $category)
                                    <li>
                                        <a href="{{ route('tricks.browse.category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(count($trick->tags))
                            <b>País-(Tags)</b>
                            <ul class="nav nav-list push-down">
                                @foreach($trick->tags as $tag)
                                    <li>
                                        <a href="{{ route('tricks.browse.tag', $tag->slug) }}">
                                            {{ $tag->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="clearfix">
                            @if($prev)
                                <a  href="{{ route('tricks.show', $prev->slug) }}"
                                    title="{{ $prev->title }}" data-toggle="tooltip"
                                    class="btn btn-sm btn-primary">
                                        &laquo; Previous Trick
                                </a>
                            @endif

                            @if($next)
                                <a  href="{{ route('tricks.show', $next->slug) }}"
                                    title="{{ $next->title }}" data-toggle="tooltip"
                                    class="btn btn-sm btn-primary pull-right">
                                        Next Trick &raquo;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                

    </div>
@stop
