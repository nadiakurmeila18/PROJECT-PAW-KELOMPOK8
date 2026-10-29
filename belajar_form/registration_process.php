<?php
    if (!isset($_POST["submit"])) {
        header("Location: registration.php");
        die();
    } else {
        $title = "Data Registrasi Mahasiswa";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <h2><?= $title ?></h2>
    <fieldset style="width: 600px;">
        <legend>Biodata</legend>
        <table>
            <tr>
                <td>Nama Mahasiswa</td>
                <td>:</td>
                <td><?= $student_name ?></td>
            </tr>
            <tr>
                <td>No Induk Mahasiswa (NIM)</td>
                <td>:</td>
                <td><?= $student_number ?></td>
            </tr>
            <tr>
                <td>Alamat Mahasiwa</td>
                <td>:</td>
                <td><?= $student_address ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><?= $student_birth_date.'-'.$student_birth_month.'-'.$student_birth_year ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $student_gender ?></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>:</td>
                <td>
                    <img src="<?= "folder_upload/$file_name" ?>">
                </td>
            </tr>
            <tr>
                <td>URL Website</td>
                <td>:</td>
                <td><?= $student_website ?></td>
            </tr>
        </table>
    </fieldset>
    <br>
    <fieldset style="width: 600px;">
        <legend>Info Akun</legend>
        <table>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $student_email ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?= $student_username ?></td>
            </tr>
        </table>
    </fieldset>
    <br>
    <fieldset style="width: 600px;">
        <legend>Kemampuan Dasar</legend>
        <table>
            <tr>
                <td>
                    <?php 
                        echo $student_skill_html_text;
                        echo $student_skill_css_text;
                        echo $student_skill_js_text;
                        echo $student_skill_php_text;
                        echo $student_skill_mysql_text;
                        echo $student_skill_laravel_text;
                        echo $student_skill_react_native_text;
                    ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <a href="registration.php"><h4>Kembali ke Form Registrasi</h4></a>
</body>
</html>