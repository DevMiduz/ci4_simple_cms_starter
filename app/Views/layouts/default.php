<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=csrf_meta()?>

    <title>Simple Auth Starter - <?=$page_title?></title>

    <?=link_tag('https://cdn.simplecss.org/simple.min.css')?>
    <?=link_tag('assets/css/style.css')?>
</head>
<body>
    <h1><?=$page_title?></h1>
    <?=$this->renderSection('content')?>
</body>
</html>

<?=script_tag('assets/js/main.js')?>