由于之前做项目的时候有需求是需要实现裁剪图片来做头像并上传到服务器，所以上网查询了很多资料，也试用了许多案例，发现cropper插件裁剪是比较完善的，所以结合之前的使用情况，编写了此案例。本案例是参考[cropper站点](http://fengyuanchen.github.io/cropper/)实例，进行修改简化。

[案例下载](http://download.csdn.net/download/kesixin/9941451)

##option相关参数说明：
**viewMode 显示模式**
Type: Number
Default: 0
Options:
0: the crop box is just within the container    裁剪框只能在 1内移动
1: the crop box should be within the canvas   裁剪框 只能在  2图片内移动
2: the canvas should not be within the container  2图片 不全部铺满1 （即缩小时可以有一边出现空隙）
3: the container should be within the canvas  2图片 全部铺满1 （即 再怎么缩小也不会出现空隙）

**dragMode  拖动模式**
Default: 'crop'
Options:
'crop': create a new crop box  当鼠标 点击一处时根据这个点重新生成一个 裁剪框
'move': move the canvas    可以拖动图片
'none': do nothing  图片就不能拖动了

**toggleDragModeOnDblclick：**  默认true .是否允许 拖动模式 “crop” 跟“move” 的切换状态。。即当点下为crop 模式，如果未松开拖动这时就是“move”模式。放开后又为“crop”模式。

**preview：** 截图的显示位置。类型：String

**responsive：**是否在窗口尺寸改变的时候重置cropper。类型：Boolean，默认值true。

**checkImageOrigin：**类型：Boolean，默认值true。默认情况下，插件会检测图片的源，如果是跨域图片，图片元素会被添加crossOriginclass，并会为图片的url添加一个时间戳来使getCroppedCanvas变为可用。添加时间戳会使图片重新加载，以使跨域图片能够使用getCroppedCanvas。在图片上添加crossOriginclass会阻止在图片url上添加时间戳，及图片的重新加载。

**background：**类型：Boolean，默认值true。是否在容器上显示网格背景。 要想改背景，是直接改，cropper.css样式中的 cropper-bg。

**canvas（图片）相关**
**movable：**类型：Boolean，默认值true。是否允许移动图片
**rotatable：**类型：Boolean，默认值true。是否允许旋转图片。
**scalable：** 默认 true 。 是否允许扩展图片。（暂时不知道干嘛用）
**zoomable：** 默认true, 石头允许缩放图片。
**zoomOnWheel：** 默认 true 是否允许鼠标滚轴 缩放图片
**zoomOnTouch：** 默认true 是否允许触摸缩放图片（触摸屏上两手指操作。）
**wheelZoomRatio：** 默认0.1 师表滚轴缩放图片比例。即滚一下。图片缩放多少。如 0.1 就是图片的10%

**crop(裁剪框)相关**
**aspectRatio**裁剪框比例  默认NaN
   例如：: 1 / 1,//裁剪框比例 1：1
**modal**：类型：Boolean，默认值true。是否在剪裁框上显示黑色的模态窗口。
**cropBoxMovable**:默认true ,是否允许拖动裁剪框
**cropBoxResizable**:默认 true,//是否允许拖动 改变裁剪框大小
**autoCrop**：类型：Boolean，默认值true。是否允许在初始化时自动出现裁剪框。
**autoCropArea**：类型：Number，默认值0.8（图片的80%）。0-1之间的数值，定义自动剪裁框的大小。
**highlight**：类型：Boolean，默认值true。是否在剪裁框上显示白色的模态窗口。
**guides**：类型：Boolean，默认值true。是否在剪裁框上显示虚线。
**center**:  默认true  是否显示裁剪框 中间的+ restore :  类型：Boolean，默认值true  是否调整窗口大小后恢复裁剪区域。

**大小相关**
**minContainerWidth**：类型：Number，默认值200。容器的最小宽度。
**minContainerHeight**：类型：Number，默认值100。容器的最小高度。
**minCanvasWidth**：类型：Number，默认值0。canvas 的最小宽度（image wrapper）。
**minCanvasHeight**：类型：Number，默认值0。canvas 的最小高度（image wrapper）。

**监听触发的方法**
**build**：类型：Function，默认值null。build.cropper
事件的简写方式。 ====== 。控件初始化前执行
**built**：类型：Function，默认值null。built.cropper
事件的简写方式。  ====== 空间初始化完成后执行
**dragstart**：类型：Function，默认值null。dragstart.cropper
事件的简写方式。 ======  拖动开始执行
**dragmove**：类型：Function，默认值null。dragmove.cropper
事件的简写方式。======  拖动移动中执行
**dragend**：类型：Function，默认值null。dragend.cropper
事件的简写方式。======  拖动结束执行
**zoomin**：类型：Function，默认值null。zoomin.cropper
事件的简写方式。 ======  缩小执行
**zoomout**：类型：Function，默认值null。zoomout.cropper
事件的简写方式。 ======  放大执行

index.html代码如下：
```
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/cropper.css">
  <link rel="stylesheet" href="css/main.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <!-- Content -->
  <div class="container" style="margin-top:50px;">
    <div class="row">
      <div class="col-md-9">
        <!-- <h3>Demo:</h3> -->
        <div class="img-container">
          ![](images/picture.jpg)
        </div>
      </div>
      <div class="col-md-3">
        <!-- <h3>Preview:</h3> -->
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 docs-buttons">
        <!-- <h3>Toolbar:</h3> -->

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("zoom", 0.1)">
              放大
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("zoom", -0.1)">
              缩小
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("move", -10, 0)">
              左移
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("move", 10, 0)">
              右移
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("move", 0, -10)">
              上移
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("move", 0, 10)">
              下移
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate Left">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("rotate", -90)">
              左转90º
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate Right">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("rotate", 90)">
              右转90º
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper("reset")">
              刷新
            </span>
          </button>
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
              上传图片
            </span>
          </label>
        </div>

        <div class="btn-group btn-group-crop">
            <button class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ "width": 180, "height": 90 }" type="button">
                上传头像
            </button>
        </div>

        <!-- Show the cropped image in modal -->
        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
              </div>
            </div>
          </div>
        </div><!-- /.modal -->
      </div><!-- /.docs-buttons -->
  </div>

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
  <script src="js/cropper.js"></script>
  <script src="js/main.js"></script>
</body>
</html>

```

cropper.js部分参数代码：
```
(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) :
  typeof define === 'function' && define.amd ? define(['jquery'], factory) :
  (factory(global.$));
}(this, (function ($) { 'use strict';

$ = 'default' in $ ? $['default'] : $;

var DEFAULTS = {
  // Define the view mode of the cropper
  viewMode: 0, // 0, 1, 2, 3  显示

  // Define the dragging mode of the cropper
  dragMode: 'crop', // 'crop', 'move' or 'none'

  // Define the aspect ratio of the crop box
  aspectRatio: NaN,

  // An object with the previous cropping result data
  data: null,

  // A selector for adding extra containers to preview
  preview: '',

  // Re-render the cropper when resize the window
  responsive: true,

  // Restore the cropped area after resize the window
  restore: true,

  // Check if the current image is a cross-origin image
  checkCrossOrigin: true,

  // Check the current image's Exif Orientation information
  checkOrientation: true,

  // Show the black modal
  modal: true,

  // Show the dashed lines for guiding
  guides: true,

  // Show the center indicator for guiding
  center: true,

  // Show the white modal to highlight the crop box
  highlight: true,

  // Show the grid background
  background: true,

  // Enable to crop the image automatically when initialize
  autoCrop: true,

  // Define the percentage of automatic cropping area when initializes
  autoCropArea: 0.8,

  // Enable to move the image
  movable: true,

  // Enable to rotate the image
  rotatable: true,

  // Enable to scale the image
  scalable: true,

  // Enable to zoom the image
  zoomable: true,

  // Enable to zoom the image by dragging touch
  zoomOnTouch: true,

  // Enable to zoom the image by wheeling mouse
  zoomOnWheel: true,

  // Define zoom ratio when zoom the image by wheeling mouse
  wheelZoomRatio: 0.1,

  // Enable to move the crop box
  cropBoxMovable: true,

  // Enable to resize the crop box
  cropBoxResizable: true,

  // Toggle drag mode between "crop" and "move" when click twice on the cropper
  toggleDragModeOnDblclick: true,

  // Size limitation
  minCanvasWidth: 0,
  minCanvasHeight: 0,
  minCropBoxWidth: 0,
  minCropBoxHeight: 0,
  minContainerWidth: 200,
  minContainerHeight: 100,

  // Shortcuts of events
  ready: null,
  cropstart: null,
  cropmove: null,
  cropend: null,
  crop: null,
  zoom: null
};
```
main.js 代码如下：

```
$(function () {

  'use strict';//表示强规则

  var console = window.console || { log: function () {} };
  var URL = window.URL || window.webkitURL;
  var $image = $('#image');
  var $download = $('#download');
  //获取图片截取的位置
  var $dataX = $('#dataX');
  var $dataY = $('#dataY');
  var $dataHeight = $('#dataHeight');
  var $dataWidth = $('#dataWidth');
  var $dataRotate = $('#dataRotate');
  var $dataScaleX = $('#dataScaleX');
  var $dataScaleY = $('#dataScaleY');
  var options = {
        aspectRatio: 1 / 1, //裁剪框比例1:1
        preview: '.img-preview',
        crop: function (e) {
          $dataX.val(Math.round(e.x));
          $dataY.val(Math.round(e.y));
          $dataHeight.val(Math.round(e.height));
          $dataWidth.val(Math.round(e.width));
          $dataRotate.val(e.rotate);
          $dataScaleX.val(e.scaleX);
          $dataScaleY.val(e.scaleY);
        }
      };
  var originalImageURL = $image.attr('src');
  var uploadedImageURL;


  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();


  // Cropper
  $image.on({
    ready: function (e) {
      console.log(e.type);
    },
    cropstart: function (e) {
      console.log(e.type, e.action);
    },
    cropmove: function (e) {
      console.log(e.type, e.action);
    },
    cropend: function (e) {
      console.log(e.type, e.action);
    },
    crop: function (e) {
      console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
    },
    zoom: function (e) {
      console.log(e.type, e.ratio);
    }
  }).cropper(options);


  // Buttons
  if (!$.isFunction(document.createElement('canvas').getContext)) {
    $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
  }

  if (typeof document.createElement('cropper').style.transition === 'undefined') {
    $('button[data-method="rotate"]').prop('disabled', true);
    $('button[data-method="scale"]').prop('disabled', true);
  }


  // Download
  if (typeof $download[0].download === 'undefined') {
    $download.addClass('disabled');
  }


  // Options
  $('.docs-toggles').on('change', 'input', function () {
    var $this = $(this);
    var name = $this.attr('name');
    var type = $this.prop('type');
    var cropBoxData;
    var canvasData;

    if (!$image.data('cropper')) {
      return;
    }

    if (type === 'checkbox') {
      options[name] = $this.prop('checked');
      cropBoxData = $image.cropper('getCropBoxData');
      canvasData = $image.cropper('getCanvasData');

      options.ready = function () {
        $image.cropper('setCropBoxData', cropBoxData);
        $image.cropper('setCanvasData', canvasData);
      };
    } else if (type === 'radio') {
      options[name] = $this.val();
    }

    $image.cropper('destroy').cropper(options);
  });


  // Methods
  // 点击开始计算图片位置，获取位置
  $('.docs-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var $target;
    var result;

    if ($this.prop('disabled') || $this.hasClass('disabled')) {
      return;
    }

    if ($image.data('cropper') && data.method) {
      data = $.extend({}, data); // Clone a new one

      if (typeof data.target !== 'undefined') {
        $target = $(data.target);

        if (typeof data.option === 'undefined') {
          try {
            data.option = JSON.parse($target.val());
          } catch (e) {
            console.log(e.message);
          }
        }
      }

      if (data.method === 'rotate') {
        $image.cropper('clear');
      }

      result = $image.cropper(data.method, data.option, data.secondOption);

      if (data.method === 'rotate') {
        $image.cropper('crop');
      }

      switch (data.method) {
        case 'scaleX':
        case 'scaleY':
          $(this).data('option', -data.option);
          break;

        case 'getCroppedCanvas':
        //上传头像
          if (result) {
            var imgBase=result.toDataURL('image/jpeg');
            var data={imgBase:imgBase};
            $.post('/docs/upload.php',data,function(ret){
              if(ret=='true'){
                alert('上传成功');
              }else{
                alert('上传失败');
              }
            },'text');
          }

          break;

        case 'destroy':
          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
            uploadedImageURL = '';
            $image.attr('src', originalImageURL);
          }

          break;
      }

      if ($.isPlainObject(result) && $target) {
        try {
          $target.val(JSON.stringify(result));
        } catch (e) {
          console.log(e.message);
        }
      }

    }
  });


  // Keyboard
  $(document.body).on('keydown', function (e) {

    if (!$image.data('cropper') || this.scrollTop > 300) {
      return;
    }

    switch (e.which) {
      case 37:
        e.preventDefault();
        $image.cropper('move', -1, 0);
        break;

      case 38:
        e.preventDefault();
        $image.cropper('move', 0, -1);
        break;

      case 39:
        e.preventDefault();
        $image.cropper('move', 1, 0);
        break;

      case 40:
        e.preventDefault();
        $image.cropper('move', 0, 1);
        break;
    }

  });


  // Import image
  var $inputImage = $('#inputImage');

  if (URL) {
    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
          }

          uploadedImageURL = URL.createObjectURL(file);
          $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
  } else {
    $inputImage.prop('disabled', true).parent().addClass('disabled');
  }

});
```
使用canvas生成的截图转换生成base64代码。
后台处理base64代码片段（PHP服务端）。

upload.php代码如下：
```
<?php
	error_reporting(0);//禁用错误报告  
	if (IS_POST) {

		header('Content-type:text/html;charset=utf-8');
		$base64_image_content = $_POST['imgBase'];


		//将base64编码转换为图片保存
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
			$type = $result[2];
			$new_file = "./uploads/";
			if (!file_exists($new_file)) {
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0700);
            }
            $img=time() . ".{$type}";
            $new_file = $new_file . $img;
            //将图片保存到指定的位置
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
            	echo 'true';
            }else{
            	echo 'false';
            }
		}else{
			echo 'false';
		}

	}


?>
```

实现效果：


![](http://upload-images.jianshu.io/upload_images/6673460-dc4841b2330ed932.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

选择要截取的图片位置，按“上传头像”按钮，截取的图片就上传并保存到服务器本站点目录的uploads文件夹中。
