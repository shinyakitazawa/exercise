'use strict';

{
  function drawBG(){
    var canvas = document.getElementById("background");
    var width = window.innerWidth;
    var height = window.innerHeight;
    canvas.width = width;
    canvas.height = height;
    const ctx = canvas.getContext('2d');
  

    var dx = width / 30;
    var dy = height / 30;
    
    for (var i = 0; i < width; i+=dx) {
      for (var j = 0; j < height; j+=dx) {
        var r = dx / (Math.random()*5 + 2);
        var alpha = Math.random();
        ctx.beginPath();
        ctx.arc(i, j, r, r,0, Math.PI * 2);
        ctx.fillStyle = "rgba(150, 150, 150, " + alpha + ")";
        ctx.fill();
      }
    }
    
  }

  drawBG();

  window.onresize = function() {
    drawBG();
}
}