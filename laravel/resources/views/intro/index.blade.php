<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(Session::has('user'))
    <meta name="user_name" content="{{Session::get('user')->user_name}}">
    <meta name="user_id" content="{{Session::get('user')->user_id}}">
    @endif
    <title>채팅테스트</title>
    <link href="{{secure_asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{secure_asset('css/intro.css')}}" rel="stylesheet">
    <link href="{{secure_asset('css/master.css')}}" rel="stylesheet">
    <script src="{{secure_asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{secure_asset('js/jquery-ui.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.slim.js"></script>
    <script src="{{secure_asset('js/socket.js')}}"></script>
    <script src="{{secure_asset('js/intro.js')}}"></script>
    <script src="{{secure_asset('js/chat.js')}}"></script>
    <script src="{{secure_asset('js/master.js')}}"></script>
    <script src="{{secure_asset('js/game.js')}}"></script>
  </head>
    <body>
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    <div class="masthead clearfix">
                        <div class="inner">
                            <h3 class="masthead-brand">Chatting Test Page</h3>
                            <nav>
                                <ul class="nav masthead-nav">
                                <li class="active"><a href="#intro" aria-controls="intro" role="tab" data-toggle="tab">Intro</a></li>
                                <li><a href="#aboutMe" aria-controls="aboutMe" role="tab" data-toggle="tab">About Me</a></li>
                                @if(!Session::has('user'))
                                <li><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
                                <li><a href="#join" aria-controls="join" role="tab" data-toggle="tab">Join</a></li>
                                @endif
                                @if(Session::has('user') && Session::get('user')->user_level == 0)
                                <li><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Admin</a></li>
                                @endif
                                @if($boardList->count() == 0)
                                @else
                                <li role="presentation" class="dropdown">
                                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Board</a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                        @foreach($boardList as $board)
                                        <li><a href="#board{{$board->board_no}}" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">{{$board->board_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                <li><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">Chat</a></li>
                                <li><a href="#game" aria-controls="game" role="tab" data-toggle="tab">Game</a></li>
                                @if(Session::has('user'))
                                <li><a href="{{secure_url('account/logoutAction')}}">Logout</a></li>
                                @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @include('intro.tab-content')
                    <div class="mastfoot">
                        <div class="inner">
                            <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ASSETS-->
        <script src="{{secure_asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>