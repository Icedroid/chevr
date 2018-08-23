var mW = 300;
var mH = 300;
var mData = [
  ['操控力', randomNum(60,98)],
  ['激情', randomNum(60,98)],
  ['心理素质', randomNum(60,98)],
  ['技术', randomNum(60,98)],
  ['反应力', randomNum(60,98)]
];
var mCount = mData.length; //边数
var mCenter = mW / 2; //中心点
var mXDelta = 0;
var mYDelta = 0;
var mRadius = mCenter - 60; //半径(减去的值用于给绘制的文本留空间)
var mAngle = Math.PI * 2 / mCount; //角度
var mCtx = null;
var mColorPolygon = '#DEA719'; //多边形颜色
var mColorLines = '#f1b41b'; //顶点连线颜色
var mColorText = '#f1b41b';
var mColorButton = '#5D050B';

var timeOutEvent = 0;

function randomNum(minNum,maxNum){
  switch(arguments.length){
    case 1:
      return parseInt(Math.random()*minNum+1,10);
      break;
    case 2:
      return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10);
      break;
    default:
      return 0;
      break;
  }
}
//绘制背景
function drawBackground(ctx) {
  ctx.save();
  ctx.fillStyle= "#000000";
  ctx.beginPath();
  ctx.fillRect(0,0,document.body.clientWidth,mH);
  ctx.restore();
}
// 绘制多边形边
function drawPolygon(ctx) {
  ctx.save();

  ctx.strokeStyle = mColorPolygon;
  ctx.lineWidth=2;
  var r = mRadius / mCount; //单位半径
  //画6个圈
  for (var i = 0; i < mCount; i++) {
    if(i<4) {
      ctx.setLineDash([4,2]);
    } else {
      ctx.setLineDash([]);
    }
    ctx.beginPath();
    var currR = r * (i + 1); //当前半径
    //画6条边
    for (var j = 0; j < mCount; j++) {
      var x = mCenter + currR * Math.cos(mAngle * j + 175)+mXDelta;
      var y = mCenter + currR * Math.sin(mAngle * j + 175)-mYDelta;
      if(i>0) {
        ctx.lineTo(x, y);
      }
    }
    ctx.closePath()
    ctx.stroke();
  }

  ctx.restore();
}

//顶点连线
function drawLines(ctx) {
  ctx.save();
  ctx.beginPath();
  ctx.strokeStyle = mColorLines;
  ctx.lineWidth=2;

  for (var i = 0; i < mCount; i++) {
    var x = mCenter + mRadius * Math.cos(mAngle * i + 175)+mXDelta;
    var y = mCenter + mRadius * Math.sin(mAngle * i + 175)-mYDelta;

    ctx.moveTo(mCenter+mXDelta, mCenter-mYDelta);
    ctx.lineTo(x, y);
  }

  ctx.stroke();

  ctx.restore();
}

//绘制文本
function drawText(ctx) {
  ctx.save();

  var fontSize = mCenter / 10;
  ctx.font = "bold " + fontSize + 'px Microsoft Yahei';
  ctx.fillStyle = mColorText;

  for (var i = 0; i < mCount; i++) {
    var x = mCenter + mRadius * Math.cos(mAngle * i + 175)+mXDelta;
    var y = mCenter + mRadius * Math.sin(mAngle * i + 175)-mYDelta;
    if (i == 0) {
      x += -10;
      y += -30;
    } else if (i == 1) {
      x += +15;
      y += -20;
    } else if (i == 2) {
      x += 40;
      y += 5;
    } else if (i == 3) {
      x += -15;
      y += 0;
    } else if (i == 4) {
      x += -50;
      y += -10;
    }
    if (mAngle * i >= 0 && mAngle * i <= Math.PI / 2) {
      ctx.fillText(mData[i][0], x, y + fontSize);
    } else if (mAngle * i > Math.PI / 2 && mAngle * i <= Math.PI) {
      ctx.fillText(mData[i][0], x - ctx.measureText(mData[i][0]).width, y + fontSize);
    } else if (mAngle * i > Math.PI && mAngle * i <= Math.PI * 3 / 2) {
      ctx.fillText(mData[i][0], x - ctx.measureText(mData[i][0]).width, y);
    } else {
      ctx.fillText(mData[i][0], x, y);
    }
  }

  ctx.restore();
}

//绘制文本色块
function drawTextButton(ctx) {
  var fontSize = mCenter / 10;

  ctx.save();
  ctx.fillStyle= mColorButton;

  for (var i = 0; i < mCount; i++) {
    var x = mCenter + mRadius * Math.cos(mAngle * i + 175)+mXDelta;
    var y = mCenter + mRadius * Math.sin(mAngle * i + 175)-mYDelta;
    if (i == 0) {
      x += -10;
      y += -30;
    } else if (i == 1) {
      x += +15;
      y += -20;
    } else if (i == 2) {
      x += 110-fontSize*4;
      y += 5;
    } else if (i == 3) {
      x += 25-fontSize*2;
      y += 0;
    } else if (i == 4) {
      x += -50;
      y += -10;
    }

    ctx.beginPath();
    x += 0 - fontSize/2;
    y += -5;
    var buttonWidth = fontSize*(mData[i][0].length+1);
    if (mAngle * i >= 0 && mAngle * i <= Math.PI / 2) {
      ctx.fillRect(x,y+fontSize,buttonWidth,fontSize/5*3);
    } else if (mAngle * i > Math.PI / 2 && mAngle * i <= Math.PI) {
      ctx.fillRect(x - ctx.measureText(mData[i][0]).width*2+fontSize/2, y + fontSize,buttonWidth,fontSize/5*3);
    } else if (mAngle * i > Math.PI && mAngle * i <= Math.PI * 3 / 2) {
      ctx.fillRect(x - ctx.measureText(mData[i][0]).width*2, y,buttonWidth,fontSize/5*3);
    } else {
      ctx.fillRect(x,y,buttonWidth,fontSize/5*3);
    }
  }

  ctx.restore();
}
//绘制数据区域
function drawRegion(ctx) {
  ctx.save();

  ctx.beginPath();
  for (var i = 0; i < mCount; i++) {
    var x = mCenter + mRadius * Math.cos(mAngle * i + 175) * mData[i][1] / 100+mXDelta;
    var y = mCenter + mRadius * Math.sin(mAngle * i + 175) * mData[i][1] / 100-mYDelta;

    ctx.lineTo(x, y);
  }
  ctx.closePath();
  ctx.fillStyle = 'rgba(59,42,09,0.8)';
  ctx.fill();

  ctx.restore();
}

function convertToCanvas() {

  var cntElem = $('#container')[0];

  var shareContent = cntElem;//需要截图的包裹的（原生的）DOM 对象
  var width = document.body.clientWidth; //获取dom 宽度
  var height = document.body.scrollHeight; //获取dom 高度
  console.log(width,height);
  var canvas = document.createElement("canvas"); //创建一个canvas节点
  var scale = 2; //定义任意放大倍数 支持小数
  canvas.width = width * scale; //定义canvas 宽度 * 缩放
  canvas.height = height * scale; //定义canvas高度 *缩放
  canvas.getContext("2d").scale(scale, scale); //获取context,设置scale
  var opts = {
    backgroundColor:"#000000",
    scale: scale, // 添加的scale 参数
    canvas: canvas, //自定义 canvas
    logging: true, //日志开关，便于查看html2canvas的内部执行流程
    width: width, //dom 原始宽度
    height: height,
    //allowTaint:true,
    useCORS: true // 【重要】开启跨域配置
  };

  html2canvas(shareContent, opts).then(function (canvas) {
    var context = canvas.getContext('2d');
    // 【重要】关闭抗锯齿
    context.mozImageSmoothingEnabled = false;
    context.webkitImageSmoothingEnabled = false;
    context.msImageSmoothingEnabled = false;
    context.imageSmoothingEnabled = false;

    /*
      * 传入对应想要保存的图片格式的mime类型
      * 常见：image/png，image/gif,image/jpg,image/jpeg
      */
    //var type = 'image/jpeg';
    //var imgData = canvas.toDataURL(type);
    //var img = document.getElementById("save-img");
    //img.src=imgData;
    //var saveHref = document.getElementById("save-href");
    //saveHref.href=imgData;
    // $(img).css({
    //   "width": canvas.width / 2 + "px",
    //   "height": canvas.height / 2 + "px",
    // })
    //console.log(imgData);
    //var img = document.getElementById("save-img");
    //$("#save-img").setAttribute('src',imgData);
    // 【重要】默认转化的格式为png,也可设置为其他格式
    var img = Canvas2Image.convertToJPEG(canvas, canvas.width, canvas.height);
    document.body.appendChild(img);
    $("#container").remove();
    $(img).css({
      "width": canvas.width / 2 + "px",
      "height": canvas.height / 2 + "px",
    }).addClass('f-full');

    //$(".foot").css('top',$('#container').height()-22 );
    $(".foot").css("top", canvas.height / 2-25);
    //$(".foot").top(canvas.height / 2-25);

    //var type = 'image/png';
    //var imgData = canvas.toDataURL(type);
    // // 加工image data，替换mime type
    // var _fixType = function(type) {
    //   type = type.toLowerCase().replace(/jpg/i, 'jpeg');
    //   var r = type.match(/png|jpeg|bmp|gif/)[0];
    //   return 'image/' + r;
    // };
    // imgData = imgData.replace(_fixType(type),'image/octet-stream');
    // saveFile(imgData, '雪佛兰试驾报告.jpg', function() {
    // });

  });
}

// function saveFile(data, filename, callback){
//   var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
//   save_link.href = data;
//   save_link.download = filename;
//
//   var event = document.createEvent('Events');
//   event.initEvent('touchstart', true, true);
//   save_link.dispatchEvent(event);
//   // var event = document.createEvent('MouseEvents');
//   // event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
//   // save_link.dispatchEvent(event);
//   callback && callback();
// }
//为jquery扩展了一个getUrlParam()方法
(function ($) {
  $.getUrlParam = function (name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    // if (r != null) return decodeURI(r[2]);
    if (r != null) return decodeURIComponent(r[2]);
    return null;
  }
})(jQuery);

//初始化
(function () {
  var canvas = document.getElementById("myCanvas");
  mH = document.body.clientWidth / 300.00 * 200;
  mW = mH;
  canvas.height = mH;
  canvas.width = document.body.clientWidth ;
  //设置外层div高
  $('#canvas-container').css('height', mH);
  mCenter = canvas.width / 2;
  mRadius = 70 * document.body.clientWidth / 300.00;
  //mXDelta = canvas.width/2 - mCenter;
  mYDelta = mXDelta+document.body.clientWidth / 300.00 * 65;
  mCtx = canvas.getContext('2d');
  drawBackground(mCtx);
  drawPolygon(mCtx);
  drawLines(mCtx);
  drawTextButton(mCtx)
  drawText(mCtx);
  drawRegion(mCtx);
})();

(function () {

  // var json = '{"uid":10000, "carid":1, "foursname":"4s店名称","time":20, "speed":50, "stability":1}';
  // console.log(encodeURIComponent(json));
  try{
    var param = $.getUrlParam('param');
    var paramObj = JSON.parse(param);
  } catch(e) {
    console.log(e);
  }
  var carid = 1;
  if(paramObj && paramObj.carid) {
    carid = paramObj.carid;
    $('#time').html(paramObj.time + "mins");
    $('#speed').html(paramObj.speed + "km/h");
    var stabilityArr = ["优秀", "优秀", "优秀", "优秀", "优秀"];
    $('#stability').html(stabilityArr[paramObj.stability]);
    $('#store').html( paramObj.foursname );
  }
  $(".foot").css("background-color","#000000");

  //var testGetUrl = 'http://chevr.test/api/v1/cars/';
  var getUrl = 'https://chevrolet-app.zedigital.com.cn/api/v1/cars/';
  jQuery.get(getUrl + carid, function (result) {
    if (result.msg == "OK" && result.data) {
      $('#h5image').attr("src", result.data.h5image);
      $('#slogan').attr("src", result.data.slogan);
      //转换成图片
      setTimeout("convertToCanvas()",500);
      $(".foot").css('top',$('#container').height()-22 );
    }
  });

})();

