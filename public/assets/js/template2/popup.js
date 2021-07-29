function MM_findObj(n, d) { //v4.01
var p,i,x; if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}


//function MM_showHideLayers() { //v3.0
//var i,p,v,obj,args=MM_showHideLayers.arguments;
//for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
//if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
//obj.visibility=v; }

//}


var allowpop=1;
function popWin(){
var ppl="popLayer";var objppl=findObj(ppl);
if (objppl==null){return;}// if the layer does not exist, do nothing.
var args=arguments,movetoX=parseInt(args[0]),movetoY=parseInt(args[1]),movespeed=parseInt(args[2]);
var cycle=10,pxl="";
if(!document.layers){objppl=objppl.style;}
if(objppl.tmofn!=null){clearTimeout(objppl.tmofn);}
var pplcoordX=parseInt(objppl.left),pplcoordY=parseInt(objppl.top);
var xX=movetoX,yY=movetoY;if((pplcoordX!=movetoX)||(pplcoordY!=movetoY)){
var moveX=((movetoX-pplcoordX)/movespeed),moveY=((movetoY-pplcoordY)/movespeed);
moveX=(moveX>0)?Math.ceil(moveX):Math.floor(moveX);movetoX=pplcoordX+moveX;
moveY=(moveY>0)?Math.ceil(moveY):Math.floor(moveY);movetoY=pplcoordY+moveY;
if((parseInt(navigator.appVersion)>4||navigator.userAgent.indexOf("MSIE")>-1) && (!window.opera)) {pxl="px";}
if (moveX!=0){eval("objppl.left='" + movetoX + pxl + "'");}
if (moveY != 0) {eval("objppl.top = '" + movetoY + pxl + "'");}
var sFunction = "popWin(" + xX + "," + yY + "," + movespeed+ ")";
objppl.tmofn = setTimeout(sFunction,cycle);
}
}

function findObj(theObj, theDoc){
var p, i, foundObj;
if(!theDoc) theDoc = document;
if((p = theObj.indexOf("?")) > 0 && parent.frames.length)
{theDoc = parent.frames[theObj.substring(p+1)].document;
theObj = theObj.substring(0,p);}
if(!(foundObj = theDoc[theObj]) && theDoc.all) foundObj = theDoc.all[theObj];
for (i=0; !foundObj && i < theDoc.forms.length; i++)
foundObj = theDoc.forms[i][theObj];
for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++)
foundObj = findObj(theObj,theDoc.layers[i].document);
if(!foundObj && document.getElementById) foundObj = document.getElementById(theObj);
return foundObj;
}
function hideLayer(layername){
layer=findObj(layername);
if(layer.style){layer=layer.style;}
layer.visibility='hidden'; }
// -->
window.defaultStatus="canalrioclaro"
