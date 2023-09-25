<?=$this->extend('layouts/auth')?>

<?=$this->section('content')?>
    <?=form_open('auth/login', ['method' => 'post'])?>

    <?=form_label('Username:', 'username')?>
    <?=form_input('username', is_null(old('username')) ? "" : old('username'))?>
    <?=validation_show_error('username')?>

    <?=form_label('Password:', 'password')?>
    <?=form_password('password')?>
    <?=validation_show_error('password')?>

    <br/>
    <?=form_submit('login_submit', 'Login');?>

    <?=form_close()?>

    <?= session()->getFlashdata('message') ?>
    <?= session()->getFlashdata('error') ?>
<?=$this->endSection()?>