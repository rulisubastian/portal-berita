<?php
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>

<!-- Tabs -->
<ul class="nav nav-tabs mb-4" id="loginTabs">
  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#signin">Sign In</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#signup">Sign Up</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#recover">Password recovery</a>
  </li>
</ul>

<div class="tab-content">
  <!-- SIGN IN -->
  <div class="tab-pane fade show active" id="signin">
    <h4 class="fw-bold mb-3">Sign In</h4>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username')->textInput([
            'placeholder' => 'Login / Email',
            'class' => 'form-control form-control-lg mb-3'
        ])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput([
            'placeholder' => 'Password',
            'class' => 'form-control form-control-lg mb-3'
        ])->label(false) ?>

        <div class="mb-3">
            <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="terms">
            <label class="form-check-label small" for="terms">
                I agree to Portal Berita <a href="#">Terms of use</a>
            </label>
        </div>

        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary w-100 btn-lg']) ?>
    <?php ActiveForm::end(); ?>
  </div>

  <!-- SIGN UP -->
  <div class="tab-pane fade" id="signup">
    <h4 class="fw-bold mb-3">Create Account</h4>
    <p class="text-muted">Form registrasi di sini...</p>
  </div>

  <!-- RECOVER -->
  <div class="tab-pane fade" id="recover">
    <h4 class="fw-bold mb-3">Recover Password</h4>
    <p class="text-muted">Form recovery di sini...</p>
  </div>
</div>
