<!doctype html>
<html class="fsvs" lang="ru">
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
    <link rel="stylesheet" href="webroot/css/styles.css">
    <link rel="stylesheet" href="webroot/css/fsvs.css">

    <!-- JS -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="webroot/js/bundle.js"></script>

</head>
<body>

<div id="fsvs-body">

    <section class="bg-main slide" align="center">
        <div class="container">
            <div class="row" align="center">
                <img class="img-responsive logo" src="webroot/images/logo-ishift.png" width="235">
                <h1 class="date">28-30 АПРЕЛЯ</h1>
                <h2 class="place">Центральный дом офицеров</h2>
                <a href="#3" class="register-btn">Регистрация</a>
            </div>
        </div>
    </section>

    <section class="bg-video slide">
	<br>
        <div class="container outer">
            <div class="slider">
                <input type="radio" id="btn-1" name="toggle" checked>
                <input type="radio" id="btn-2" name="toggle">
                <input type="radio" id="btn-3" name="toggle">
                <div class="slide-box">
                    <div class="slides" id="slide1">
                        <iframe class="video" src="https://www.youtube.com/embed/T6tRtvtVqVM"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="slides" id="slide2">
                        <iframe class="video" src="https://www.youtube.com/embed/jcyMn-4F6Vo"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="slides" id="slide3">
                        <iframe class="video" src="https://www.youtube.com/embed/H4xD5_oIRvg"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="slider-controls">
                        <label for="btn-1"></label>
                        <label for="btn-2"></label>
                        <label for="btn-3"></label>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='3' class="bg-register slide">
        <div class="container">
            <form id="form" action="" method="post">
                <div class="row">
                    <h2 class="register-text" align="center">РЕГИСТРАЦИЯ</h2>

                    <!---->
                    <div align="center">
                        <?php if (isset($data['success'])) : ?>
                            <div class="message message-success"><?php echo $data['success']; ?></div>
                        <?php endif; ?>
                        <?php if (isset($data['errors']) || (isset($data['emailError']) && !$data['emailError'])) : ?>
                            <div class="message">Данные заполнены неверно</div>
                        <?php endif; ?>
                        <?php if (isset($data['secondEmail'])): ?>
                            <div class="message"><?php echo $data['secondEmail']; ?></div>
                        <?php endif; ?>
                        <?php if (isset($data['fail'])): ?>
                            <div class="message"><?php echo $data['fail']; ?></div>
                        <?php endif; ?>
                    </div>
                    <!---->

                    <div class="col-sm-3 col-sm-offset-3">
                        <?php if (isset($data['errors']['surname'])) : ?>
                            <input type="text" name="surname"
                                   value="<?php \Controller\IndexController::info('surname'); ?>" class="form-control"
                                   placeholder="Фамилия*" style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="text" name="surname"
                                   value="<?php \Controller\IndexController::info('surname'); ?>" class="form-control"
                                   placeholder="Фамилия*" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3 ">
                        <?php if (isset($data['errors']['name'])) : ?>
                            <input type="text" name="name" value="<?php \Controller\IndexController::info('name'); ?>"
                                   class="form-control" placeholder="Имя*" style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="text" name="name" value="<?php \Controller\IndexController::info('name'); ?>"
                                   class="form-control" placeholder="Имя*" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 col-sm-offset-3">
                        <?php if ((isset($data['emailError']) && !$data['emailError']) || isset($data['secondEmail'])) : ?>
                            <input type="email" name="email" value="<?php \Controller\IndexController::info('email'); ?>"
                                   class="form-control" placeholder="Email*" style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="email" name="email" value="<?php \Controller\IndexController::info('email'); ?>"
                                   class="form-control" placeholder="Email*" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3 col-sm-offset-3">
                        <?php if (isset($data['errors']['phone'])) : ?>
                            <input type="number" name="phone"
                                   value="<?php \Controller\IndexController::info('phone'); ?>" class="form-control"
                                   placeholder="Телефон*" style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="number" name="phone"
                                   value="<?php \Controller\IndexController::info('phone'); ?>" class="form-control"
                                   placeholder="Телефон*" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3 ">
                        <?php if (isset($data['errors']['age'])) : ?>
                            <input type="number" name="age" value="<?php \Controller\IndexController::info('age'); ?>"
                                   class="form-control" placeholder="Возраст*" min="1" max="99"
                                   style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="number" name="age" value="<?php \Controller\IndexController::info('age'); ?>"
                                   class="form-control" placeholder="Возраст*" min="1" max="99" required>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-3 col-sm-offset-3">
                        <?php if (isset($data['errors']['country'])) : ?>
                            <input type="text" name="country"
                                   value="<?php \Controller\IndexController::info('country'); ?>" class="form-control"
                                   placeholder="Страна*" style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="text" name="country"
                                   value="<?php \Controller\IndexController::info('country'); ?>" class="form-control"
                                   placeholder="Страна*" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3">
                        <?php if (isset($data['errors']['city'])) : ?>
                            <input type="text" name="city" value="<?php \Controller\IndexController::info('city'); ?>"
                                   class="form-control" placeholder="Город*" style="border: 1px solid #fe5242" required>
                        <?php else: ?>
                            <input type="text" name="city" value="<?php \Controller\IndexController::info('city'); ?>"
                                   class="form-control" placeholder="Город*" required>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-2 col-sm-offset-3">
                        <input type="checkbox" name="children" value="1" id="children" class="children checkbox">
                        <label for="children" class="children-label">Я буду с детьми</label>
                    </div>
                    <div class="children-info col-sm-4">
                        <input type="text" name="childrenInfo" id="childrenInfo" class="form-control"
                               value="<?php \Controller\IndexController::info('childrenInfo'); ?>"
                               placeholder="Укажите здесь количество и возраст">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 col-sm-offset-3">
                        <input type="checkbox" name="breakfast" value="1" id="breakfast" class="breakfast checkbox">
                        <label for="breakfast" class="breakfast-label">Обед</label>
                    </div>

                    <div class="breakfast-info col-sm-2">
                        <input type="checkbox" name="breakfastSaturday" value="1" id="saturday" class="checkbox">
                        <label for="saturday">Суббота 29.04</label>
                    </div>

                    <div class="breakfast-info col-sm-2">
                        <input type="checkbox" name="breakfastSunday" value="1" id="sunday" class="checkbox">
                        <label for="sunday">Воскресенье 30.04</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-3">
                        <input type="checkbox" name="oportunity" value="1" id="oportunity" class="checkbox">
                        <label for="oportunity">У меня нет возможности оплатить регистрацию</label>
                    </div>
                </div>
                <br>
                <div align="center">
                    <p class="register-price">Регистрация - 100грн</p>
                    <input type="submit" class="register-btn pay-btn" value="ОПЛАТИТЬ">
                    <p class="register-info">Если у вас возникли вопросы - вы можете написать нам на почту - <span
                            class="register-mail">hello@ishift.com.ua</span></p>
                </div>
            </form>
        </div>
    </section>

</div>

<!-- JS -->
<script src="webroot/js/scripts.js"></script>

</body>
</html>