// QRCODE reader Copyright 2011 Lazar Laszlo
// http://www.webqr.com

var gCtx = null;
var gCanvas = null;
var c=0;
var stype=0;
var gUM=false;
var webkit=false;
var moz=false;
var NL=false;
var v=null;

var imghtml='<div id="qrfile"><canvas id="out-canvas" width="320" height="320"></canvas>'+
    '<div id="imghelp">drag and drop a QRCode here'+
	'<br>or select a file'+
	'<input type="file" onchange="handleFiles(this.files)"/>'+
	'</div>'+
'</div>';

var vidhtml = '<video id="v" autoplay width="320" height="320"></video>';

function initCanvas(w,h)
{
    gCanvas = document.getElementById("qr-canvas");
    gCanvas.style.width = w + "px";
    gCanvas.style.height = h + "px";
    gCanvas.width = w;
    gCanvas.height = h;
    gCtx = gCanvas.getContext("2d");
    gCtx.clearRect(0, 0, w, h);
}


function captureToCanvas() {
    if(gUM)
    {
        try{
            gCtx.drawImage(v,0,0,400,400);
            try{
                qrcode.decode();
            }
            catch(e){       
                console.log(e);
                setTimeout(captureToCanvas, 5);
            };
        }
        catch(e){       
                console.log(e);
                setTimeout(captureToCanvas, 5);
        };
    }
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function read(a)
{
	alert(a);
}

function isCanvasSupported(){
  var elem = document.createElement('canvas');
  return !!(elem.getContext && elem.getContext('2d'));
}
function success(stream) {
	if(webkit)
	{
        	v.src = window.URL.createObjectURL(stream);
		//v.play();
		console.log("fuck you webkit"+stream);
    	}
	else
    if(moz)
    {
        v.mozSrcObject = stream;
       // v.play();
	console.log("fuck you moz"+stream);
    }
    else
	if(NL)
   {
        v.src = stream;
	//v.play();
	console.log("fuck you normal"+stream);
    }
    gUM=true;
    stype = 1;
    setTimeout(captureToCanvas, 5);
}
		
function error(error) {
    gUM=false;
    return;
}


function load()
{
	if(isCanvasSupported() && window.File && window.FileReader)
	{
		initCanvas(400, 400);
		qrcode.callback = read;
		document.getElementById("mainbody").style.display="inline";
        setwebcam(true);
	}
	else
	{
		document.getElementById("mainbody").style.display="inline";
		document.getElementById("mainbody").innerHTML='<p id="mp1">QR code scanner for HTML5 capable browsers</p><br>'+
        '<br><p id="mp2">sorry your browser is not supported</p><br><br>'+
        '<p id="mp1">try <a href="http://www.mozilla.com/firefox"><img src="firefox.png"/></a> or <a href="http://chrome.google.com"><img src="chrome_logo.gif"/></a> or <a href="http://www.opera.com"><img src="Opera-logo.png"/></a></p>';
	}
}

function setwebcam(options)
{
	console.log(options);
    if(stype==1)
    {
        setTimeout(captureToCanvas, 5);    
        return;
    }
    var n=navigator;
    document.getElementById("outdiv").innerHTML = vidhtml;
    v=document.getElementById("v");


    if(n.getUserMedia)
	{
		alert("got normal");
		
		NL=true;
        n.getUserMedia({video: options, audio: false}, success, error);
	}
    else
    if(n.webkitGetUserMedia)
    {
		alert("got webkit");
		
        webkit=true;
        n.webkitGetUserMedia({video:options, audio: false}, success, error);
    }
    else
    if(n.mozGetUserMedia)
    {
		alert("got moz");
		
        moz=true;
        n.mozGetUserMedia({video: options, audio: false}, success, error);
    }

    //document.getElementById("qrimg").style.opacity=0.2;
    //document.getElementById("webcamimg").style.opacity=1.0;

    stype=1;
    setTimeout(captureToCanvas, 5);
}