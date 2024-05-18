<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= Constant::PROJECT_NAME; ?> | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <?= AppAsset::registerCss(); ?>
  <style>
    :root {
      --color-primary: #343a40;
      --color-text-primary: #ffb03b;
      --bg-white: #fff;
    }
    h2.card-title{
        font-size: 1.5rem;
        font-weight: 700;
    }
    table.table-bordered > thead > tr > th {
        background-color: var(--color-primary)!important;
    }
    th a, th {
        color: var(--color-text-primary);
    }
    .ml-10{
        margin-left: 10px;
    }
    .swal2-styled.swal2-confirm, .swal2-styled.swal2-deny {
        font-size: 1.4rem!important;
    }
    .swal2-html-container {
        font-size: 1.5rem!important;
    }
    .none {
      display: none!important;
    }
    .errorMessage, .errorSummary{
      color: red;
    }
    .lightbox-popup {
    display: none;
    position: fixed;
    z-index: 9999;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.5);
}
.lightbox-popup .box {
    margin: 0px;
    border: 0;
    position: absolute;
    padding: 0 !important;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    width: 100vw;
}
.lightbox-popup .container {
    background-color: #fff;
    color: #000;
    max-width: 80%;
    padding: 50px 15px 0px 15px;
    border-radius: 8px;
    position: relative;
}
.lightbox-popup .container p {
    margin: 0;
}
.lightbox-popup .box .container a{
    padding: 15px 5px;
    float: right;
    margin-right: 10px;
    text-decoration: none;
    color: #000;
}
.lightbox-popup .box .container a:hover{
    text-decoration: none;
}
.lightbox-popup .box .container a[class*="choice-"]{
    display: inline-flex;
}
.lightbox-popup .box .container .closed {
    position: absolute;
    top: 15px;
    right: 5px;
    border: 1px solid;
    margin: -10px 0 0 -10px;
    width: 20px;
    height: 20px;
    color: #ff0707;
    font-size: 13px;
    font-weight: 700;
    text-align: center;
    border-radius: 50%;
    background-color: #fff;
    cursor: pointer;
    text-decoration: none;
    padding: 0px;
}
h2 small{
    font-size: 80%;
}
.lightbox-popup .box .container a[name="submit"]{
    padding: 8px 15px;
    border: 1px solid #bfb6b6;
    border-radius: 8px;
    box-shadow: 1px 1px 2px 0 #827b7b;
    background: #00d410;
    color: #fff;
    float: left;
}
.lightbox-popup .detail-view, .detail-view{
    width: 96%;
    margin: 20px 15px;
    line-height: 2;
}
.lightbox-popup .content-container{
    padding: 0px 20px 20px 20px;
}
.lightbox-popup .content-container h1{
    font-weight: bold;
    margin-left: 15px;
        font-size: 2.5rem;
    color: #0C496C;
}
.lightbox-popup .box .inner-box{
    overflow-y: scroll;
    max-height: 90vh;
}
a.lightbox img {
height: 150px;
border: 3px solid white;
box-shadow: 0px 0px 8px rgba(0,0,0,.3);
margin: 94px 20px 20px 20px;
}

/* Styles the lightbox, removes it from sight and adds the fade-in transition */

.lightbox-target {
position: fixed;
top: -100%;
width: 100%;
background: rgba(0,0,0,.7);
width: 100%;
opacity: 0;
-webkit-transition: opacity .5s ease-in-out;
-moz-transition: opacity .5s ease-in-out;
-o-transition: opacity .5s ease-in-out;
transition: opacity .5s ease-in-out;
overflow: hidden;
 
}
/* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */
.lightbox-target img {
margin: auto;
position: absolute;
top: 0;
left:0;
right:0;
bottom: 0;
max-height: 0%;
max-width: 0%;
border: 3px solid white;
box-shadow: 0px 0px 8px rgba(0,0,0,.3);
box-sizing: border-box;
-webkit-transition: .5s ease-in-out;
-moz-transition: .5s ease-in-out;
-o-transition: .5s ease-in-out;
transition: .5s ease-in-out;
}

/* Styles the close link, adds the slide down transition */
a.lightbox {
  color: var(--color-link);
}
a.lightbox-close {
display: block;
width:50px;
height:50px;
box-sizing: border-box;
background: white;
color: black;
text-decoration: none;
position: absolute;
top: -80px;
right: 0;
-webkit-transition: .5s ease-in-out;
-moz-transition: .5s ease-in-out;
-o-transition: .5s ease-in-out;
transition: .5s ease-in-out;
}
/* Provides part of the "X" to eliminate an image from the close link */
a.lightbox-close:before {
content: "";
display: block;
height: 30px;
width: 1px;
background: black;
position: absolute;
left: 26px;
top:10px;
-webkit-transform:rotate(45deg);
-moz-transform:rotate(45deg);
-o-transform:rotate(45deg);
transform:rotate(45deg);
}
/* Provides part of the "X" to eliminate an image from the close link */
a.lightbox-close:after {
content: "";
display: block;
height: 30px;
width: 1px;
background: black;
position: absolute;
left: 26px;
top:10px;
-webkit-transform:rotate(-45deg);
-moz-transform:rotate(-45deg);
-o-transform:rotate(-45deg);
transform:rotate(-45deg);
}
/* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */
.lightbox-target:target {
  opacity: 1;
    top: 0;
    bottom: 0;
    overflow: scroll;
    right: 0;
    z-index: 9999;
}
.lightbox-target:target img {
max-height: 100%;
max-width: 100%;
}
.lightbox-target:target a.lightbox-close {
top: 0;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<?php 
    $className = $this->Id;
    Yii::app()->clientScript->scriptMap = array(
        'jquery.js' => false,
        'jquery.ba-bbq.js' => false
    );
?>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= Constant::baseAdminUrl() . '/' ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?= Constant::baseUrl() . '/site/logout' ?>" role="button">
          <i class="fas fa-power-off"></i> Sign Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo Constant::baseAdminUrl() . '/'; ?>" class="brand-link">
      <img src="<?= Constant::getImageUrl() . '/logo.png' ?>" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= Constant::PROJECT_NAME ?></span>
    </a>

    <!-- Sidebar -->
    <?php
    if (isset(Yii::app()->user->role)):
        $this->sideNav(Yii::app()->user->role);
    endif;
    ?> 
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'htmlOptions'=>array('class'=>'breadcrumb float-sm-right'),
                    'separator'=>'&nbsp;/&nbsp;'
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?= $content ?>

                <!-- popup -->
                <div class="lightbox-popup" style="display: none;">
                              <div class="box">
                                <div class="inner-box">
                                    <div class="container">
                                        <div class="content-container"></div>
                                        <a href="javascript:void(0);" class="closed">X</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end popup -->
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright  &copy; <?= date('Y'); ?> - <a href="javascript:void(0);"><?= Constant::PROJECT_NAME; ?></a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?= AppAsset::registerJs(); ?>
<script type="text/javascript">
    var $className = "<?php echo $className; ?>";
    $('#btn-refresh').on('click', function(){
        $("#"+$className+"-grid").yiiGridView("update", {});
    });
    $(".input-group-sm select:not(.for-filter)").on("change", function(e) {
		var data = {};
		data['display'] = $(this).val();
		updateGrid(data);
	});
	$(".input-group-sm :input.input-sm").on("keyup", function(e) {
		var data = {};
		data['filter'] = $(this).val();
		updateGrid(data);
	});
    $(".input-group-sm :input.date").on("change", function(e) {
		var data = {};
		data['date_filter'] = $(this).val();
		updateGrid(data);
	});

	function updateGrid(data, classNamed){
		if (typeof(data) === "undefined" || data === null)
			return false;

        if (typeof(classNamed) !== "undefined" && classNamed !== null) {
            $className = classNamed;
        }
        $className = $className.replace("/", "-");
        console.log(data);
        console.log($className);
		$("#"+$className+"-grid").yiiGridView("update", {
			data: data,
			complete: function(){
                
			},
            error : function(data){
                if (typeof(data.responseText) !== "undefined")
                    console.log(data.responseText);
            }
		});
	}
    <?php
        //flashes
        foreach(Yii::app()->user->getFlashes() as $key => $message){
            ?>
            swal.fire('<?= $message ?>', '', '<?= $key ?>');
            <?php
        }
    ?>

// Swal.fire({
//         html: "<p style='font-size:1.5rem;line-height:20px;'>Apakah Anda sudah yakin ingin memproses order barang ini? ?</p>",  
//         confirmButtonText: "Proses", 
//         confirmButtonColor: '#343a40',
//         customClass: 'swal-wide',
//         showCancelButton: true,
//     }).then((result) => {
//         /* Read more about isConfirmed, isDenied below */
//         if (result.isConfirmed) {
//             document.getElementById("supplier-form").submit()
//         }
//     });
$('a.closed').click(function() {
        $('.lightbox-popup').hide();
    });

  $('a').on('click', function(){
      var link = $(this).attr('href');
      if (typeof(link) !== 'undefined' && link === 'javascript:void(0);') {
          alert('Coming Soon');
      }
  });
</script>
</body>
</html>
