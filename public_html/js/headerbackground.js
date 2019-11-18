var x, y, r;
var height = 100;

function setup() {
  CreateHeader();
}

function CreateHeader() {
  let canvas = createCanvas(window.innerWidth, height);
  canvas.parent('headercanvas');
  noStroke();
  background('#00CC99');
  for (i=0; i<100; i++)
  {
    x = random(width);
    y = random(height);
    r = random(2, 15);

    fill(255, 255, 255, random(30, 100));
    rectMode(RADIUS);
    rect(x, y, r, r);
  }
}

function windowResized(){
  CreateHeader();
}


