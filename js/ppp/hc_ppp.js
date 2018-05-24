var divName = ''; // div that follows the mouse
var offX = 15;          // X offset from mouse position
var offY = 15;          // Y offset from mouse position
var init=0;

function mouseX(evt) {
    if (!evt) evt = window.event;
    if (evt.pageX) return evt.pageX;
    else if (evt.clientX)
        return evt.clientX + (document.documentElement.scrollLeft ?  document.documentElement.scrollLeft : document.body.scrollLeft);
    else return 0;
}
function mouseY(evt) {
    if (!evt) evt = window.event;
    if (evt.pageY) return evt.pageY;
    else if (evt.clientY)
        return evt.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
    else return 0;
}

function follow(evt) {
    if ( $(divName)) {

        var obj = $(divName).style;
        var viewport = document.viewport.getDimensions(); // Gets the viewport as an object literal
        var window_width = viewport.width+100; // viewable window width
        var window_height = viewport.height+20; // viewable window height
        var element_height = $(divName).getHeight();
        var element_width = $(divName).getWidth();
        var y_middle = (window_height - element_height + offY)/2;
        var x_middle = (window_width - element_width + offX)/2;

        var mouse_x = mouseX(evt);
        var mouse_y = mouseY(evt);

        var rel_mouse_position=Object.extend(document.viewport.getDimensions(),document.viewport.getScrollOffsets());
        mouse_x-=rel_mouse_position.left;
        mouse_y-=rel_mouse_position.top;

        if ( (element_height + mouse_y) >= ( window_height - offY) ){
            if (element_height+offY > mouse_y ){                
                mouse_y = y_middle;
                mouse_y = mouse_y - offY;
            }else{
                mouse_y = mouse_y - element_height;               
                mouse_y = mouse_y - offY;
            }

        } else {
            mouse_y = mouse_y + offY;
        }

        if ( (element_width + mouse_x) >= ( window_width - offX) ){ 

            if (element_width +offX > mouse_x){
                mouse_x = x_middle;
                mouse_x = mouse_x - offX;
            }else{
                mouse_x = mouse_x - element_width;               
                mouse_x = mouse_x - offX;
            }
        } else {
            mouse_x = mouse_x + offX;
        }
        obj.left = mouse_x + rel_mouse_position.left + 'px';
        obj.top = mouse_y + rel_mouse_position.top + 'px';
        
    }
}
var pppdestroyer = false;

function pppDestroy(pppDiv){
       $(pppDiv).style.display = "none";
        $(pppDiv).update("");
}

function HideContent(_divName) {
    if(_divName.length < 1) {
        return;
    }
    pppDestroy(_divName);
}

function ShowContent(_divName, event) {
    if(_divName.length < 1) {
        return;
    }

    divName = _divName;
    if (init<1){
         follow(event);
        init++;
    }
        document.onmousemove = follow;
    $(_divName).style.display = "block";

}

function resizeX(){
    if(divName.length > 1) {
        var h2=1;
        try{
            h2 = $(divName).getElementsByTagName('h2')[0].getHeight();
        }catch(e){}
        $(divName).style.height = $(divName).getElementsByTagName('img')[0].getHeight()+h2+'px';

        $(divName).style.width = $(divName).getElementsByTagName('img')[0].getWidth()+'px';

    }
    setTimeout('resizeX()',1);
}
resizeX();
