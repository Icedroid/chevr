
    var mW = 300;
    var mH = 300;
    var mData = [['速度', 77],['力量', 72], ['防守', 46],['射门', 50], ['传球', 80]];
    var mCount = mData.length; //边数 
    var mCenter = mW /2; //中心点
    var mRadius = mCenter - 50; //半径(减去的值用于给绘制的文本留空间)
    var mAngle = Math.PI * 2 / mCount; //角度
    var mCtx = null;
    var mColorPolygon = '#ebd909'; //多边形颜色
    var mColorLines = '#d09c17'; //顶点连线颜色
    var mColorText = '#f1b51b';

    //初始化
    (function(){
      var canvas = document.getElementById("myCanvas");
      canvas.height = mH;
      canvas.width = mW;
      mCtx = canvas.getContext('2d');
      
      drawPolygon(mCtx);
      drawLines(mCtx);
      drawText(mCtx);
      drawRegion(mCtx);
    })();
  
      // 绘制多边形边
      function drawPolygon(ctx){
        ctx.save();
        
        ctx.strokeStyle = mColorPolygon;
        var r = mRadius/ mCount; //单位半径
        //画6个圈
        for(var i = 0; i < mCount; i ++){
            ctx.beginPath();        
            var currR = r * ( i + 1); //当前半径
            //画6条边
            for(var j = 0; j < mCount; j ++){
                var x = mCenter + currR * Math.cos(mAngle * j+55);
                var y = mCenter + currR * Math.sin(mAngle * j+55);
                
                ctx.lineTo(x, y);
            }
            ctx.closePath()
            ctx.stroke();
        }
        
        ctx.restore();
      }
    
    //顶点连线
    function drawLines(ctx){
        ctx.save();
        ctx.beginPath();
        ctx.strokeStyle = mColorLines;
        
        for(var i = 0; i < mCount; i ++){
            var x = mCenter + mRadius * Math.cos(mAngle * i+55);
            var y = mCenter + mRadius * Math.sin(mAngle * i+55);
            
            ctx.moveTo(mCenter, mCenter);
            ctx.lineTo(x, y);
        }
        
        ctx.stroke();
        
        ctx.restore();
    }
    
    //绘制文本
    function drawText(ctx){
        ctx.save();
        
        var fontSize = mCenter / 8;
        ctx.font = fontSize + 'px Microsoft Yahei';
        ctx.fillStyle = mColorText;
        
        for(var i = 0; i < mCount; i ++){
            var x = mCenter + mRadius * Math.cos(mAngle * i+55);
            var y = mCenter + mRadius * Math.sin(mAngle * i+55);
            if(i == 0){
                x+=-20;
                y+=-30;
            }else if(i == 1){
                x+=10;
                y+=-10;
            }else if(i == 2){
                x+=40;
                y+=5;
            }else if(i == 3){
                x+=-15;
                y+=20;
            }else if(i == 4){
                x+=-50;
                y+=10;
            }
            if( mAngle * i >= 0 && mAngle * i <= Math.PI / 2 ){
                ctx.fillText(mData[i][0], x, y + fontSize); 
            }else if(mAngle * i > Math.PI / 2 && mAngle * i <= Math.PI){
                ctx.fillText(mData[i][0], x - ctx.measureText(mData[i][0]).width, y + fontSize);    
            }else if(mAngle * i > Math.PI && mAngle * i <= Math.PI * 3 / 2){
                ctx.fillText(mData[i][0], x - ctx.measureText(mData[i][0]).width, y);   
            }else{
                ctx.fillText(mData[i][0], x, y);
            }
            
        }
        
        ctx.restore();
    }
    
    //绘制数据区域
    function drawRegion(ctx){
        ctx.save();
        
        ctx.beginPath();
        for(var i = 0; i < mCount; i ++){
            var x = mCenter + mRadius * Math.cos(mAngle * i+55) * mData[i][1] / 100;
            var y = mCenter + mRadius * Math.sin(mAngle * i+55) * mData[i][1] / 100;
            
            ctx.lineTo(x, y);
        }
        ctx.closePath();
        ctx.fillStyle = 'rgba(89,67,9,0.8)';
        ctx.fill();
        
        ctx.restore();
    }
    
