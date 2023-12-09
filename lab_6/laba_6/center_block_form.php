<!DOCTYPE html>
<html lang="en">
</head>
<body>
    <div class="center-menu">
        <img src="img/backgrounds/header-2.jpg" alt="Рулетка">
        <div class="back">
            <div class="col">
                <!-- -->
                <!-- <form id="user_form" action="" method="POST" onsubmit="return validateForm();" enctype="multipart/form-data"> -->
                <form id="user_form" action="validation.php" method="POST" enctype="multipart/form-data">
        
                    <!--First name input block-->
                    <div class="row">
                        <label class="required" for="firstName">First name / Имя:</label><br />
                        <input id="firstName" name="firstName" type="text" value="" class="textField"/><br />
                        <span id="firstName_validation" class="error"></span>
                    </div>

                    <!--Second name input block-->
                    <div class="row">
                        <label class="required" for="secondName">Second name / Фамилия:</label><br />
                        <input id="secondName" name="secondName" type="text" value="" class="textField"/><br />
                        <span id="secondName_validation" class="error"></span>
                    </div>

                    <!--Second name input block-->
                    <div class="row">
                        <label class="required" for="middleName">Middle name / Отчество:</label><br />
                        <input id="middleName" name="middleName" type="text" value="" class="textField"/><br />
                        <span id="middleName_validation" class="error"></span>
                    </div>

                    <!--Preferences input block-->
                    <div class="preferencesDiv">
                        <label class="required">Preferences / Предпочтения:</label><br />
                        <input type="checkbox" name="preferences[]" id="study" value="study" /> Study / Учёба<br />
                        <input type="checkbox" name="preferences[]" id="sport" value="sport" /> Sport / Спорт<br />
                        <input type="checkbox" name="preferences[]" id="reading" value="reading" /> Reading / Чтение<br />
                        <input type="checkbox" name="preferences[]" id="music" value="music"/> Games / Игры <br />
                        <input type="checkbox" name="preferences[]" id="music" value="music" /> Music / Музыка<br />
                        <input type="checkbox" name="preferences[]" id="dance" value="dance" /> Dance / Танцы<br />
                        <input type="checkbox" name="preferences[]" id="painting" value="painting" /> Painting / Рисование<br />
                        <span id="preferences_validation" class="error" ></span>
                    </div>

                    <!--Sending form data by POST method-->
                    <input type="submit" value="Try!"/>
                </form>
            </div>
            <!-- <script src="js/validation.js"></script> -->
        </div>
        <div class="main-foot"></div>
    </div>
</body>
</html>