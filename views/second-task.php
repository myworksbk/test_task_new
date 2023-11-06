<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second task</title>
    <link rel="stylesheet" href="/css/simple.min.css">
    <style>
        main {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
        }
    </style>
</head>
<body>
    <main>
        <p>Goods with their fields</p>
        <ul>
            <?php foreach($goods as $good): ?>
                <li><?= $good['good_name'] ?></li>
                <ul>
                    <?php foreach($good['fields'] as $field): ?>
                        <li>
                            <?= $field['field_name'] ?>:
                            <?= $field['field_value'] ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endforeach ?>
        </ul>
    </main>
</body>
</html>