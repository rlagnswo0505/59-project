<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="input.css">
    <script src="input.js" defer></script>
    <title>Document</title>
</head>

<body>
    <form class="num--form">
        <div class="num--box">
            <div class="value-button .decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
            <input type="number" class="number" value="0" />
            <div class="value-button .increase" onclick="increaseValue()" value="Increase Value">+</div>
        </div>
    </form>
</body>

</html>