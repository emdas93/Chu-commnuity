<div class="tab-content">
    <!--Intro-->
    <div role="tabpanel" class="tab-pane fade in active" id="intro">
        <div class="inner cover">
            <div class="fadeSet">
                <h1 class="fadeText">추승협</h1>
                <h1 class="fadeText">포트폴리오</h1>
                <h1 class="fadeText">START</h1>
            </div>
            <h1 class="cover-heading">Chu's Portfolio</h1>
            <p class="lead">
                <!--<a href="{{secure_url('/')}}" class="btn btn-lg btn-default" id="enter">들어가기</a>-->
            </p>
        </div>
    </div>
    <!--Intro-->
    
    <!--About Me-->
    <div role="tabpanel" class="tab-pane fade" id="aboutMe">
        <div class="inner cover">
            <div class="row">
                <div class="col-md-8 text-left">
                    <h3>이름 : 추승협</h3>
                    <h3>취미 : 운동</h3>
                    <h3>생년월일 : 1993-07-09</h3>
                </div>
                <div class="col-md-4">
                    <img src="{{secure_asset('image/introMe.jpg')}}" class="img-responsive img-circle" alt="Responsive image">
                </div>
            </div>
            <h1 class="cover-heading">Chu's Portfolio</h1>
                <p class="lead">좀 더 알고 싶으시면 아래의 버튼을 눌러주세요</p>
            <p class="lead">
                <a href="{{secure_url('/')}}" class="btn btn-lg btn-default" id="enter">들어가기</a>
            </p>
        </div>
    </div>
    <!--About Me-->
    
    <!--Login-->
    @if(!Session::has('user'))
    <div role="tabpanel" class="tab-pane fade" id="login">
        <div class="text-left">
            <div class="col-md-12">
                <form action="{{secure_url('account/loginAction')}}" method="post">
                    <div class="form-group">
                        <label for="user_id">아이디를 입력해주세요</label>
                        <input type="text" class="form-control" name="user_id" id="user_id" placeholder=""/>
                    </div>
                    <div class="form-group">
                        <label for="user_pw">비밀번호를 입력해주세요</label>
                        <input type="password" class="form-control" name="user_pw" id="user_pw" placeholder=""/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default center-block">Submit</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
    <!--Login-->
    
    <!--Join-->
    <div role="tabpanel" class="tab-pane fade" id="join">
        <div class="text-left">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{secure_url('account/registerAction')}}" method="post">
                        <div class="form-group">
                            <label for="user_name">이름</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder=""/>
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <label for="user_email">이메일</label>-->
                        <!--    <input type="text" class="form-control" name="user_email" id="user_email" placeholder=""/>-->
                        <!--</div>-->
                        <div class="form-group">
                            <label for="user_id">아이디</label>
                            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="user_pw">비밀번호</label>
                            <input type="password" class="form-control" name="user_pw" id="user_pw" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="user_birth">생년월일</label>
                            <input type="user_birth" class="form-control" name="user_birth" id="user_birth" placeholder="1900-01-01">
                        </div> 
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="female">여</label>
                                <input type="radio" class="form-control" name="user_gender" value="female" id="female">
                            </div>
                            <div class="col-md-6">
                                <label for="male">남</label>
                                <input type="radio" class="form-control" name="user_gender" value="male" id="male">
                            </div>
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <div class="col-md-4">-->
                        <!--        <label for="user_phone1">휴대전화1</label>-->
                        <!--        <select name="user_phone1" id="user_phone1" class="text-muted form-control">-->
                        <!--            <option value="null" class="text-muted" selected>선택해주세요</option>-->
                        <!--            <option value="010" class="text-muted">010</option>-->
                        <!--            <option value="011" class="text-muted">011</option>-->
                        <!--            <option value="016" class="text-muted">016</option>-->
                        <!--        </select>    -->
                        <!--    </div>-->
                        <!--    <div class="col-md-4">-->
                        <!--        <label for="user_phone2">휴대전화2</label>-->
                        <!--        <input type="user_phone2" class="form-control" name="user_phone2" id="user_phone2" placeholder="" maxlength="4">-->
                        <!--    </div>-->
                        <!--    <div class="col-md-4">-->
                        <!--        <label for="user_phone3">휴대전화3</label>-->
                        <!--        <input type="user_phone3" class="form-control" name="user_phone3" id="user_phone3" placeholder="" maxlength="4">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-md-12 text-center">
                            <h3>빠짐 없이 작성 하셨나요?</h3>
                        </div>
                        {{csrf_field()}}
                        <button type="submit" class="form-control">가입</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Join-->
    @endif
    @if(!$boardList->count() == 0)
    <!--GuestBook-->
    @foreach($boardList as $board)
    <div role="tabpanel" class="tab-pane fade mast-height" id="board{{$board->board_no}}" data-id="{{$board->board_no}}">
        <div class="text-left guestWrap">
            <div class="inner cover guestBook board">
                <div class="row">
                    <div class="col-md-12 write-form">
                        <div class="form-group">
                            <input type="hidden" name="board_no" id="board_no" value="{{$board->board_no}}"/>
                            <div class="col-md-8">
                                <label for="b_title">제목</label>
                                <input type="text" class="form-control" name="b_title" id="b_title" value=""/>
                            </div>
                            <div class="col-md-4">
                                <label for="b_writer">작성자</label>
                                @if(Session::has('user'))
                                <input type="text" class="form-control" name="b_writer" id="b_writer" value="{{Session::get('user')->user_name}}"/>
                                @else
                                <input type="text" class="form-control" name="b_writer" id="b_writer"/>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="b_content">내용</label>
                            <textarea class="form-control" name="b_content" id="b_content" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group text-right">
                            @if(Session::has('user'))
                            <button class="btn btn-success text-right guestBookWriteBtn">작성</button>
                            @else
                            <button class="btn btn-success text-right">글을 쓰시려면 로그인이 필요합니다.</button>
                            @endif
                        </div>
                    </div>
                    <div class="devide"></div>
                    <!--posted-->
                    @for($i=0; $i<$board->count();$i++)
                    @foreach($content[$i] as $cont)
                    @if($board->board_no == $cont->board_no)
                    <div class="col-md-12 content-set" data-id="{{$cont->b_no}}">
                        <div class="content-title">
                            <h3>[{{$cont->b_no}}] {{$cont->b_title}}</h3>
                            <p class="text-right">작성자 : {{$cont->b_writer}}</p>
                        </div>
                        <div class="content editor">
                            <p>{!!nl2br($cont->b_content)!!}</p>
                        </div>
                        <div class="content-menu text-right">
                            <a href="#!" id="modify" class="btn btn-info">수정</a>
                            <a href="#!" id="delete" class="btn btn-danger">삭제</a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endfor
                    
                    <div class="col-md-12 moreContent">
                        <a href="#!" class="btn btn-primary btn-block more">더보기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!--GuestBook-->
    @endif
    <!--admin-->
    <div role="tabpanel" class="tab-pane fade mast-height" id="admin">
        <div class="text-left">
            <div class="inner cover guestBook">
                <div class="row">
                    <div class="col-md-12">
                        @include('intro.management')
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!--admin-->
    
    <!--Chat-->
    <div role="tabpanel" class="tab-pane fade mast-height" id="chat">
        <div class="text-left">
            <div class="inner cover guestBook">
                <div class="row">
                        @include('intro.chat')
                </div>
            </div>
        </div>
    </div>
    <!--Chat-->
    
    <!--Game-->
    <div role="tabpanel" class="tab-pane fade mast-height" id="game">
        <div class="text-left">
            <div class="inner cover guestBook">
                <div class="row">
                        @include('intro.game')
                </div>
            </div>
        </div>
    </div>
    <!--Game-->
</div>

