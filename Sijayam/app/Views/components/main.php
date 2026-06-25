<!DOCTYPE html>
<html>
<head>
    <?= view('components/header') ?> </head>
<body>
    <?= view('components/navbar') ?> <div class="main-content">
        <?= $this->renderSection('content') ?> </div>

    <?= view('components/footer') ?> </body>
</html>