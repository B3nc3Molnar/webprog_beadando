<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>FoxDesign</title>
        <link rel="stylesheet"  href="./css/home.css">
        <?php if($viewData['style']) echo '<link rel="stylesheet" href="./css/home/style.css">'; ?>    </head>
    <body>

        <header>
            <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
          
        </header>

        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        
        

        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>

    </body>
</html>