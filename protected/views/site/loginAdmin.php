
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= Constant::baseUrl() . '/' ?>" class="h1"><?= Constant::PROJECT_NAME ?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php
        $form=$this->beginWidget('CActiveForm', array(
          'id'=>'login-form',
          // 'enableClientValidation'=>true,
          'clientOptions'=>array(
          'validateOnSubmit'=>false
          ),
        )); 
        ?>
        <div class="input-group mb-3">
          <input type="email" name="LoginForm[username]" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="LoginForm[password]" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        <span style="float:left;color: red;margin-top: 20px;text-align: center;width: 100%;">
        <?php  echo $form->error($model,'username') . '<br/>'; ?>
        <?php  echo $form->error($model,'password'); ?>
        </span>
        
        <?php $this->endWidget(); ?>

     <!--  <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->