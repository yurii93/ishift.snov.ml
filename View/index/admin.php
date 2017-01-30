<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iSHIFT</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="webroot/css/login.css">

    <style>
        @media print {
            .none {
                display: none;
            }
        }
    </style>

</head>
<body>

<?php if (isset($_SESSION['admin']) && $_SESSION['adminRole'] == 'admin') : ?>

    <div class="container-fluid">
        <div class="navbar navbar-default" style="margin-top: 10px">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Открыть навигацию</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav">
                    <li><a href="/"><i class="fa fa-arrow-left"></i>На главную</a></li>
                    <li><a href="/logout">Выйти</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="<?php if ($_SERVER['REQUEST_URI'] == '/admin/on/') {
                        echo 'active';
                    } ?>"><a href="/admin/on/">Оплаченые</a></li>
                    <li class="<?php if ($_SERVER['REQUEST_URI'] == '/admin/un/') {
                        echo 'active';
                    } ?>"><a href="/admin/un/">Неоплаченые</a></li>
                    <li class="<?php if ($_SERVER['REQUEST_URI'] == '/admin/oportunity/') {
                        echo 'active';
                    } ?>"><a href="/admin/oportunity/">Нет возможности</a></li>


                    <li class="<?php if ($_SERVER['REQUEST_URI'] == '/admin') {
                        echo 'active';
                    } ?>"><a href="/admin">Все</a></li>

                </ul>
            </div>
        </div>
    </div>

    <!---->

    <div class="row">
        <div class="col-md-12">
            <?php if ($data['people']) : ?>
                <table class="table table-striped" border="1" style="border: 1px solid #ddd">
                    <tr>
                        <th>#</th>
                        <th>Статус</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Почта</th>
                        <th>Телефон</th>
                        <th>Возраст</th>
                        <th>Страна</th>
                        <th>Город</th>
                        <th>Дети?</th>
                        <th>О детях</th>
                        <th>Обед 29.04</th>
                        <th>Обед 30.04</th>
                        <th>Возможности</th>
                        <th>Дата</th>
                        <th class="none">Изменить</th>
                        <th class="none">Удалить</th>
                    </tr>
                    <?php foreach ($data['people'] as $people) : ?>
                        <tr>
                            <td><?php echo $people['id']; ?></td>
                            <td>
                                <?php if ($people['status']) {
                                    echo 'Оплачено';
                                } else {
                                    echo 'Неоплачено';
                                } ?>
                            </td>
                            <td><?php echo $people['surname'] ?></td>
                            <td><?php echo $people['name'] ?></td>
                            <td><?php echo $people['email']; ?></td>
                            <td><?php echo $people['phone']; ?></td>
                            <td><?php echo $people['age']; ?></td>
                            <td><?php echo $people['country']; ?></td>
                            <td><?php echo $people['city']; ?></td>

                            <td>
                                <?php if ($people['children']) {
                                    echo 'Да';
                                } else {
                                    echo 'Без';
                                } ?>
                            </td>

                            <td><?php echo $people['childrenInfo']; ?></td>

                            <td>
                                <?php if ($people['breakfastSaturday']) {
                                    echo 'Да';
                                } else {
                                    echo 'Нет';
                                } ?>
                            </td>

                            <td>
                                <?php if ($people['breakfastSunday']) {
                                    echo 'Да';
                                } else {
                                    echo 'Нет';
                                } ?>
                            </td>

                            <td>
                                <?php if ($people['oportunity']) {
                                    echo 'Нет возможности';
                                } else {
                                    echo 'Есть возможность';
                                } ?>
                            </td>

                            <td><?php echo $people['date']; ?></td>

                            <?php if ($people['status']) : ?>
                                <td class="none"><a href="/editstatus/<?php echo $people['id']; ?>/0"
                                       onclick="return confirmation();">Сделать неоплаченым</a></td>
                            <?php else : ?>
                                <td class="none"><a href="/editstatus/<?php echo $people['id']; ?>/1"
                                       onclick="return confirmation();">Сделать оплаченым</a></td>
                            <?php endif; ?>

                            <td class="none"><a href="/delete/<?php echo $people['id']; ?>"
                                   onclick="return confirmation();">Удалить</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <h4 align="center">Список пуст</h4><br>
            <?php endif; ?>
        </div>
    </div>

<?php else : ?>
    <form action="/login" method="post" class="navbar-form text-center admin-form">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Имя*" required>
        </div>
        <br><br>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Пароль*" required>
        </div>
        <br><br>
        <button type="submit" class="register-btn pay-btn">
            <i class="fa fa-sign-in"></i> Войти
        </button>
    </form>

<?php endif; ?>
<!---->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script>
    /* Confirm delete */
    function confirmation() {
        if (confirm('Вы подтверждаете действие?')) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>