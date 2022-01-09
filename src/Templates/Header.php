<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clocker - <?php echo $title ?></title>
    <link rel="stylesheet" href="src/Styles/style.css">
    <?php 
    if (isset($styles) && is_array($styles)) {
        load_css($styles);
    }
    ?>
</head>
<body>