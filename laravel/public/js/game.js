$(document).ready(function(){
    $("#startGame").on("click", function(){
        
        var ground  = $(".game");
        var map     = [
            [2,2,2,2,2,2,2,2,2,2,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,1,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,0,0,0,0,0,0,0,0,0,2],
            [2,2,2,2,2,2,2,2,2,2,2],
        ];
        var hero = new User();
        render(map, hero);
        
        $(document).on("keydown", function(event){
            switch(event.keyCode){
                case 37:
                    event.preventDefault();
                    var temp = map[hero.offsetY][hero.offsetX-1]
                    map[hero.offsetY][hero.offsetX-1] = map[hero.offsetY][hero.offsetX]
                    map[hero.offsetY][hero.offsetX] = temp;
                    --hero.offsetX;
                    render(map, hero);
                    break;
                case 38:
                    event.preventDefault();
                    var temp = map[hero.offsetY-1][hero.offsetX]
                    map[hero.offsetY-1][hero.offsetX] = map[hero.offsetY][hero.offsetX]
                    map[hero.offsetY][hero.offsetX] = temp;
                    --hero.offsetY;
                    render(map, hero);
                    break;
                case 39:
                    event.preventDefault();
                    var temp = map[hero.offsetY][hero.offsetX+1]
                    map[hero.offsetY][hero.offsetX+1] = map[hero.offsetY][hero.offsetX]
                    map[hero.offsetY][hero.offsetX] = temp;
                    ++hero.offsetX;
                    render(map, hero);
                    break;
                case 40:
                    event.preventDefault();
                    var temp = map[hero.offsetY+1][hero.offsetX]
                    map[hero.offsetY+1][hero.offsetX] = map[hero.offsetY][hero.offsetX]
                    map[hero.offsetY][hero.offsetX] = temp;
                    ++hero.offsetY;
                    render(map, hero);
                    break;
            }
        })
    });
    var User = (function(){
        this.offsetX;
        this.offsetY;
    });
    
    var render = (function(map, hero){
        var target = $(".game");
        var div = $("<div></div>");
        for(var i = 0; i<map.length; ++i){
            for(var j = 0; j<map[i].length; ++j){
                switch(map[i][j]){
                    case 0:
                        $("<span><span>").text("　").appendTo(div);
                        break;
                    case 1:
                        $("<span></span>").addClass("text-primary").text("★").appendTo(div); 
                        hero.offsetX = j;
                        hero.offsetY = i;
                        break;
                    case 2:
                        $("<span></span>").text("■").appendTo(div); 
                }
                
            }
            $("<br>").appendTo(div);
        }
        target.html(div);
    });
});
