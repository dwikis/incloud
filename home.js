let show = false;
function clickP(x){
    if(x){
        document.getElementById("pl").style.display="none";
        document.getElementById("pa").style.display='block';
        document.getElementById('player').play();
    }
    else{
        document.getElementById("pa").style.display='none';
        document.getElementById("pl").style.display='block';
        document.getElementById('player').pause();
    }
    
}
function mute(x){
    if(x){
        document.getElementById('player').muted=true;
        document.getElementById("v11").style.display="none";
        document.getElementById("v22").style.display="block";
    }
    else{
        document.getElementById('player').muted=false;
        document.getElementById("v11").style.display="block";
        document.getElementById("v22").style.display="none";
    }
}