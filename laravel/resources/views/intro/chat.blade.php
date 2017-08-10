@include('intro.chatBox')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">채팅목록</h3>
    </div>
    <div class="panel-body">
        <button type="button" class="btn btn-primary btn-block joinRoomBtn" data-id="room1">들어온나</button>
        <button type="button" class="btn btn-primary btn-block joinRoomBtn" data-id="room2">들어온나</button>
    </div>
    <div class="panel-footer">
        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#createChatRoomModalBtn">채팅방개설</button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createChatRoomModalBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">채팅방개설</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="r_name">채팅방이름</label>
                <input type="text" name="r_name" class="form-control" id="r_name"/>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-info btn-block" id="createChatRoomBtn" data-dismiss="modal">개설</button>
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">취소</button>
        </div>
      </div>
    </div>
</div>