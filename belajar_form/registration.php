<?php
    $title = "Form Registrasi Mahasiswa";
    $arr_month = [
        "1" => "Januari",
        "2" => "Februari",
        "3" => "Maret",
        "4" => "April",
        "5" => "Mei",
        "6" => "Juni",
        "7" => "Juli",
        "8" => "Agustus",
        "9" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember", 
    ];
    $error_message = "";

    if (isset($_POST["submit"])) {
        $student_name = htmlentities(strip_tags(trim($_POST["student_name"])));
        $student_number = htmlentities(strip_tags(trim($_POST["student_number"])));
        $student_address = htmlentities(strip_tags(trim($_POST["student_address"])));
        $student_birth_date = htmlentities(strip_tags(trim($_POST["student_birth_date"])));
        $student_birth_month = htmlentities(strip_tags(trim($_POST["student_birth_month"])));
        $student_birth_year = htmlentities(strip_tags(trim($_POST["student_birth_year"])));
        $student_gender = htmlentities(strip_tags(trim($_POST["student_gender"])));
        $student_website = htmlentities(strip_tags(trim($_POST["student_website"])));
        $student_email = htmlentities(strip_tags(trim($_POST["student_email"])));
        $student_username = htmlentities(strip_tags(trim($_POST["student_username"])));
        $student_password = htmlentities(strip_tags(trim($_POST["student_password"])));
        $student_password_confirmation = htmlentities(strip_tags(trim($_POST["student_password_confirmation"])));

        if (empty($student_name)) $error_message .= "- Nama Mahasiwa belum diisi <br>";
        if (empty($student_number)) $error_message .= "- No Induk Mahasiswa (NIM) belum diisi <br>";
        if (empty($student_address)) $error_message .= "- Alamat Mahasiswa belum diisi <br>";
        if (empty($student_website)) $error_message .= "- URL Website belum diisi <br>";

        $upload_error = $_FILES["student_photo"]["error"];
        if ($upload_error !== 0){
            $arr_upload_error = [
                1 => '- Ukuran file foto melewati batas maksimal <br>',
                2 => '- Ukuran file foto melewati batas maksimal 1MB <br>',
                3 => '- File foto hanya ter-upload sebagian <br>',
                4 => '- Foto tidak ditemukan <br>',
                6 => '- Server Error (Upload Foto) <br>',
                7 => '- Server Error (Upload Foto) <br>',
                8 => '- Server Error (Upload Foto) <br>',
            ];
            $error_message .= $arr_upload_error[$upload_error];
        } else {
            $folder_name = "folder_upload";
            $file_name = $_FILES["student_photo"]["name"];
            $file_path = "$folder_name/$file_name";

            if (file_exists($file_path)) {
                $error_message .= "- File dengan nama sama sudah ada di server <br>";
            }

            $file_size = $_FILES["student_photo"]["size"];
            if ($file_size > 1048576) {
                $error_message .= "- Ukuran file melebihi 700KB <br>";
            }
            $check = getimagesize($_FILES["student_photo"]["tmp_name"]);
            if ($check === false) {
                $error_message .= "- Mohon upload file gambar (gif, png, atau jpg) <br>";
            }
        }

        if (empty($student_email)) $error_message .= "- Email belum diisi <br>";
        if (empty($student_username)) $error_message .= "- Username belum diisi <br>";
        if (empty($student_password)) $error_message .= "- Password belum diisi <br>";
        if (empty($student_password_confirmation)) $error_message .= "- Konfirmasi Password belum diisi <br>";
        
        $checked_man = ""; 
        $checked_woman = "";
        switch ($student_gender) {
            case 'man':
                $student_gender = "Pria";
                $checked_man = "checked";
                break;
            case 'woman':
                $student_gender = "Wanita";
                $checked_woman = "checked";
                break;
        }

        $student_skill_html = ""; $student_skill_html_text = "";
        $student_skill_css = ""; $student_skill_css_text = "";
        $student_skill_js = ""; $student_skill_js_text = "";
        $student_skill_php = ""; $student_skill_php_text = "";
        $student_skill_mysql = ""; $student_skill_mysql_text = "";
        $student_skill_laravel = ""; $student_skill_laravel_text = "";
        $student_skill_react_native = ""; $student_skill_react_native_text = "";

        if (isset($_POST["student_skill_html"])) {
            $student_skill_html = "checked";
            $student_skill_html_text = "HTML";
        }

        if (isset($_POST["student_skill_css"])) {
            $student_skill_css = "checked";
            $student_skill_css_text = ", CSS";
        }

        if (isset($_POST["student_skill_js"])) {
            $student_skill_js = "checked";
            $student_skill_js_text = ", Javascript";
        }

        if (isset($_POST["student_skill_php"])) {
            $student_skill_php = "checked";
            $student_skill_php_text = ", PHP";
        }

        if (isset($_POST["student_skill_mysql"])) {
            $student_skill_mysql = "checked";
            $student_skill_mysql_text = ", MySQL";
        }

        if (isset($_POST["student_skill_laravel"])) {
            $student_skill_laravel = "checked";
            $student_skill_laravel_text = ", Laravel";
        }

        if (isset($_POST["student_skill_react_native"])) {
            $student_skill_react_native = "checked";
            $student_skill_react_native_text = ", React Native";
        }

        if ($error_message === "") {
            $folder_name="folder_upload";
            $tmp = $_FILES["student_photo"]["tmp_name"];
            $file_name = $_FILES["student_photo"]["name"];
            move_uploaded_file($tmp, "$folder_name/$file_name");

            include("registration_process.php");
            die();
        }
    } else {
        $student_name = "";
        $student_number = "";
        $student_address = "";
        $student_birth_date = 1;
        $student_birth_month = "1";
        $student_birth_year = "1990";
        $checked_man = "checked";
        $checked_woman = "";
        $student_website = "";
        $student_email = "";
        $student_username = "";
        $student_password = "";
        $student_password_confirmation = "";
        $student_skill_html = "";
        $student_skill_css = "";
        $student_skill_js = "";
        $student_skill_php = "";
        $student_skill_mysql = "";
        $student_skill_laravel = "";
        $student_skill_react_native = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Purnama Anaking">
    <meta name="keyword" content="Belajar HTML, Belajar Web">
    <meta name="description" content="Halaman praktikum modul 8 mata kuliah pemrograman web di program studi sistem informasi">
    <meta name="robots" content="index, follow">

    <title><?= $title ?></title>

    <style>
        .container {
            width: 600px;
        }
        .error {
            background-color: #FFECEC;
            padding: 10px 15px;
            margin: 3px 3px 20px 3px;
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= $title ?></h2>
        <?php
            if ($error_message !== "")
                echo "<div class='error'>$error_message</div>";
        ?>
        <form action="registration.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Biodata</legend>
                <table>
                    <tr>
                        <td>Nama Mahasiswa*</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="student_name" value="<?= $student_name ?>" size="20" placeholder="Nama Anda">
                        </td>
                    </tr>
                    <tr>
                        <td>No Induk Mahasiswa (NIM)*</td>
                        <td>:</td>
                        <td><input type="text" name="student_number" value="<?= $student_number ?>" size="20" placeholder="NIM Anda"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Alamat Mahasiswa*</td>
                        <td style="vertical-align: top;">:</td>
                        <td><textarea name="student_address" cols="30" rows="5" placeholder="Alamat Anda"><?= $student_address ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir*</td>
                        <td>:</td>
                        <td>
                            <select name="student_birth_date" id="student_birth_date">
                                <?php 
                                    for ($i=1; $i <= 31 ; $i++) { 
                                        if ($i == $student_birth_date) {
                                            echo "<option value='$i' selected>"; 
                                        } else {
                                            echo "<option value='$i'>"; 
                                        }       
                                        echo str_pad($i,2,"0",STR_PAD_LEFT);
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                            <select name="student_birth_month">
                                <?php 
                                    foreach ($arr_month as $key => $value) {
                                        if ($key == $student_birth_month) {
                                            echo "<option value='$key' selected>$value</option>";
                                        } else {
                                            echo "<option value='$key'>$value</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <select name="student_birth_year">
                                <?php
                                for ($i=1990; $i <= 2007 ; $i++) { 
                                        if ($i == $student_birth_year) {
                                            echo "<option value='$i' selected>$i</option>"; 
                                        } else {
                                            echo "<option value='$i'>$i</option>"; 
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin*</td>
                        <td>:</td>
                        <td>
                            <input type="radio" name="student_gender" value="man" id="pria" <?php echo $checked_man  ?>><label for="pria">Pria</label>
                            <input type="radio" name="student_gender" value="woman" id="wanita" <?php echo $checked_woman  ?>><label for="wanita">Wanita</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload Foto*</td>
                        <td>:</td>
                        <td>
                            <input type="file" name="student_photo" id="file_upload" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                        </td>
                    </tr>
                    <tr>
                        <td>URL Website*</td>
                        <td>:</td>
                        <td>
                            <input type="url" name="student_website" value="<?= $student_website ?>" size="40" placeholder="URL Website Anda">
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <fieldset>
                <legend>Info Akun</legend>
                <table>
                    <tr>
                        <td>Email*</td>
                        <td>:</td>
                        <td><input type="email" name="student_email" value="<?= $student_email ?>" size="20" placeholder="Email Anda"></td>
                    </tr>
                    <tr>
                        <td>Username*</td>
                        <td>:</td>
                        <td><input type="text" name="student_username" value="<?= $student_username ?>" size="20" placeholder="Username Anda"></td>
                    </tr>
                    <tr>
                        <td>Password*</td>
                        <td>:</td>
                        <td><input type="password" name="student_password" value="<?= $student_password ?>" size="20" placeholder="Password Anda"></td>
                    </tr>
                    <tr>
                        <td>Konfirmasi Password*</td>
                        <td>:</td>
                        <td><input type="password" name="student_password_confirmation" value="<?= $student_password_confirmation ?>" size="20" placeholder="Password Anda"></td>
                        </tr>
                </table>
            </fieldset>
            <br>
            <fieldset>
                <legend>Kemampuan Dasar</legend>
                <table>
                    <tr>
                        <td>
                            <input type="checkbox" name="student_skill_html" value="html" id="html" <?= $student_skill_html ?>><label for="html">HTML</label>
                            <input type="checkbox" name="student_skill_css" value="css" id="css" <?= $student_skill_css ?>><label for="css">CSS</label>
                            <input type="checkbox" name="student_skill_js" value="javascript" id="javascript" <?= $student_skill_js ?>><label for="javascript">Javascript</label>
                            <input type="checkbox" name="student_skill_php" value="php" id="php" <?= $student_skill_php ?>><label for="php">PHP</label>
                            <input type="checkbox" name="student_skill_mysql" value="mysql" id="mysql" <?= $student_skill_mysql ?>><label for="mysql">MySQL</label>
                            <input type="checkbox" name="student_skill_laravel" value="laravel" id="laravel" <?=
                            $student_skill_laravel ?>><label for="laravel">Laravel</label>
                            <input type="checkbox" name="student_skill_react_native" value="react_native" id="react_native" <?= $student_skill_react_native ?>><label for="react_native">React Native</label>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <div>
                <input type="reset" value="Reset">
                <input type="submit" name="submit" value="Simpan">
            </div>
        </form>
    <div>
</body>
</html>