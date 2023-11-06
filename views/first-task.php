<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First task</title>
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
        <div>
            <form id="user_form">
                <input type="hidden" name="id" id="id">
                <input type="text" name="first_name" id="first_name">
                <input type="text" name="last_name" id="last_name">
                <select name="position_id" id="position">
                    <?php foreach($positions as $position): ?>
                        <option value="<?= $position['id'] ?>"><?= $position['title'] ?></option>
                    <?php endforeach ?>
                </select>
                <span id="create-action-block">
                    <button type="button" id="create-user">create</button>
                </span>
                <span id="update-action-block" style="display: none">
                    <button type="button" id="cancel-update-user">cancel</button>
                    <button type="button" id="update-user">update</button>
                </span>
            </form>
        </div>
        
        <div>
            <table id="users">
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
                <?php foreach($users as $user): ?>
                    <tr data-id="<?= $user['id'] ?>">
                        <td class="first_name"><?= $user['first_name'] ?></td>
                        <td class="last_name"><?= $user['last_name'] ?></td>
                        <td class="position"><?= $user['position'] ?></td>
                        <td>
                            <button type="button"
                                data-id="<?= $user['id'] ?>"
                                data-first_name="<?= $user['first_name'] ?>"
                                data-last_name="<?= $user['last_name'] ?>"
                                data-position_id="<?= $user['position_id'] ?>"
                                class="update-action">
                                update
                            </button>
                            <button type="button" data-id="<?= $user['id'] ?>" class="delete-action">delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </main>
    <script src="/js/axios.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>