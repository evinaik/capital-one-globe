<!DOCTYPE HTML>
<html lang="en">
<head>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <title>WebGL Globe</title>
  <meta charset="utf-8">
  <style type="text/css">
    html {
      height: 100%;
    }
    body {
      margin: 0;
      padding: 0;
      background: #000000 url(/globe/loading.gif) center center no-repeat;
      color: #ffffff;
      font-family: sans-serif;
      font-size: 13px;
      line-height: 20px;
      height: 100%;
    }

    #info {

      font-size: 11px;
      position: absolute;
      bottom: 5px;
      background-color: rgba(0,0,0,0.8);
      border-radius: 3px;
      right: 10px;
      padding: 10px;

    }

    a {
      color: #aaa;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }

    .bull {
      padding: 0 5px;
      color: #555;
    }

    #title {
      position: absolute;
      top: 20px;
      width: 270px;
      left: 20px;
      background-color: rgba(0,0,0,0.2);
      border-radius: 3px;
      font: 20px Georgia;
      padding: 10px;
    }

    #ce span {
      display: none;
    }

    #ce {
      width: 107px;
      height: 55px;
      display: block;
      position: absolute;
      bottom: 15px;
      left: 20px;
      background: url(/globe/ce.png);
    }


  </style>
</head>
<body>

  <div id="container"></div>

  <div id="info">
    <strong><a href="http://www.chromeexperiments.com/globe">WebGL Globe</a></strong> <span class="bull">&bull;</span> Created by the Google Data Arts Team <span class="bull">&bull;</span> Data acquired from <a href="https://www.ngdc.noaa.gov/nndc/struts/results?type_0=Exact&query_0=$HAZ_EVENT_ID&t=102557&s=50&d=54&dfn=volerup.txt">NOAA</a>
  </div>

  <div id="title">
    Major Volcanic Eruptions
  </div>

  <a id="ce" href="http://www.chromeexperiments.com/globe">
    <span>This is a Chrome Experiment</span>
  </a>

  <script type="text/javascript" src="/globe/third-party/Detector.js"></script>
  <script type="text/javascript" src="/globe/third-party/three.min.js"></script>
  <script type="text/javascript" src="/globe/third-party/Tween.js"></script>
  <script type="text/javascript" src="/globe/globe.js"></script>
  <script type="text/javascript">

    function update(globe) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '/globe/data/clowns.txt', true);
      xhr.onreadystatechange = function(e) {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var data = xhr.responseText;
            var lines = data.split("\n");
            for (i = 0; i < lines.length; i++) {
              if (lines[i])
                globe.addData(lines[i].split(",").map(parseFloat), true);
            }
            document.body.style.backgroundImage = 'none'; // remove loading
          }
        }
        globe.createPoints();
        globe.animate();
      };
      xhr.send(null);
    }
    if(!Detector.webgl){
      Detector.addGetWebGLMessage();
    } else {
      var container = document.getElementById('container');
      var globe = new DAT.Globe(container);
      update(globe);
    }

    </script>

  </body>

  </html>
