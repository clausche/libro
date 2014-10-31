@foreach($tricks as $trick)
            
        @endforeach

@section('title', $pais->name)
@section('description', $pais->pageDescription)

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
   
    @endif
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="content-box">
                    @if(Auth::check() && (Auth::user()->id == $pais->user_id))
                        <div class="text-right">
                            <a data-toggle="modal" href="#deleteModal">Delete</a> |
                            <a href="{{$trick->editLink}}">Editar</a>
                            @include('tricks.delete',['link'=>$ciudad->deleteLink])
                        </div>
                    @endif
                    <div class="trick-user">
                        
                        <div class="trick-user-data">
                            <h1 class="page-title">
                                 en {{ $pais->name }}
                            </h1>
                            
                            
                        </div>
                    </div>
                    <p>{{{ $pais->ccode }}}</p>
                    
                    
                </div>
                
            </div>
                <div class="col-lg-3 col-md-4">
                    <div class="content-box">
                        <b>Stats</b>
                        <ul class="list-group trick-stats">
                            
                            <li class="list-group-item">
                                <span class="fa fa-eye"></span> Continente : {{ $pais->continent }}
                            </li>
                            <li class="list-group-item" >
                                <span class="fa fa-eye"></span> Jefe de Estado : {{ $pais->headofstate }}
                                
                            </li>
                            <li class="list-group-item" >
                            
                                <span class="fa fa-eye"></span> País : {{ $pais->name }}
                                
                            </li>
                        </ul>
                       
                        
                        
                        <div class="clearfix">
                           
                        </div>
                    </div>
                </div>
            </div>
                

    </div>
@stop
