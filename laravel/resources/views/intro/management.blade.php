<div class="panel-group" id="management" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#management" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          게시판 관리
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <form action="{{secure_url('board/createBoard')}}" method="post">
          <div class="form-group">
            <label for="board_name">게시판이름</label>
            <input type="text" name="board_name" class="form-control" id="board_name"/>
            {{csrf_field()}}
            <input type="submit" class="btn btn-primary btn-block"/>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#management" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          유저 관리
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        내용입력
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#management" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          기타
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        내용 입력
      </div>
    </div>
  </div>
</div>