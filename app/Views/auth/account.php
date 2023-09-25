<?=$this->extend('layouts/auth')?>

<?=$this->section('content')?>

    <h4>Update your account:</h4>

    <?=form_open('auth/account', ['method' => 'post'])?>

    <p>Username: <?=$username?></p>

    <?=form_label('Old Password:', 'old_password')?>
    <?=form_password('old_password')?>
    <?=validation_show_error('old_password')?>

    <?=form_label('New Password:', 'new_password')?>
    <?=form_password('new_password')?>
    <?=validation_show_error('new_password')?>

    <?=form_label('Confirm Password:', 'confirm_password')?>
    <?=form_password('confirm_password')?>
    <?=validation_show_error('confirm_password')?>

    </br>

    <?=form_submit('update_submit', 'Save');?>

    <?=form_close()?>

    <?= session()->getFlashdata('update_form_message') ?>
    <?= session()->getFlashdata('update_form_error') ?>

    </br>

    <h4>Logout from your account:</h4>
    <?=form_open('auth/account/logout', ['method' => 'post'])?>
        <?=form_submit('logout_submit', 'Logout');?>
    <?=form_close()?>

    </br>

    <h4>Delete your account:</h4>
    <?=form_open('auth/account/delete', ['method' => 'post'])?>

    <?=form_label('Confirm your username:', 'confirm_username')?>
    <?=form_input('confirm_username')?>
    <?=validation_show_error('confirm_username')?>

    <?=form_label('Password:', 'password')?>
    <?=form_password('password')?>
    <?=validation_show_error('password')?>
    
    <br/>

    <?=form_submit('delete_submit', 'Delete');?>
    

    <?=form_close()?>

    <?= session()->getFlashdata('_delete_form_message') ?>
    <?= session()->getFlashdata('delete_form_error') ?>
<?=$this->endSection()?>