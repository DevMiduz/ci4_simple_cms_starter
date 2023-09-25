<?=$this->extend('layouts/auth')?>

<?=$this->section('content')?>
    <?=form_open('auth/register', ['method' => 'post'])?>

    <?=form_label('Username:', 'username')?>
    <?=form_input('username', is_null(old('username')) ? "" : old('username'))?>
    <?=validation_show_error('username')?>

    <?=form_label('Password:', 'password')?>
    <?=form_password('password')?>
    <?=validation_show_error('password')?>

    <?=form_label('Confirm Password:', 'password_confirm')?>
    <?=form_password('password_confirm')?>
    <?=validation_show_error('password_confirm')?>

    <br/>
    <?=form_submit('register_submit', 'Register');?>

    <?=form_close()?>

    <?= session()->getFlashdata('message') ?>
    <?= session()->getFlashdata('error') ?>

<?=$this->endSection()?>
