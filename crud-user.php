<?php
require ('koneksi_uts.php');

function cariUserDariUsername($email)    {
    $koneksi = koneksiUts();
    $sql = "select * from user where email='$email'";
    $hasil = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($hasil)>0) {
        $baris=mysqli_fetch_assoc($hasil);
        $data['username'] = $baris['username'];
        $data['email']=$baris['email'];
        $data['password'] = $baris['password'];
        mysqli_close($koneksi);
        return $data;
    } else {
        mysqli_close($koneksi);
        return null;
    }
}

function otentik($email, $password){
    $dataUser = array();
    $pwdmd5 = md5($password);
    $dataUser = cariUserDariUsername($email);
    if ($dataUser != null) {
        if ($pwdmd5==$dataUser['password']) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
// create Faq
function createFaq($data){
    $full_name = $data["full_name"];
    $email = $data["email"];
    $message = $data["message"];

    $koneksi = koneksiUts();
    $sql = "INSERT INTO faq VALUES ('','$full_name','$email','$message')";

    mysqli_query($koneksi,$sql);
    return mysqli_affected_rows($koneksi);
}

// create User
function createUser($data){
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $password_md5 = md5 ($password);

    $koneksi = koneksiUts();
    $sql = "INSERT INTO user VALUES ('','$username','$email','$password_md5')";

    mysqli_query($koneksi,$sql);
    return mysqli_affected_rows($koneksi);
}
// update User
function updateUser($data) {
    $koneksi = koneksiUts();
    $id = $data["id"];
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $password_md5 = md5 ($password);

    $sql = "UPDATE user SET
            username='$username',
            email='$email',
            password='$password_md5'
            WHERE id=$id
            ";

    mysqli_query($koneksi,$sql);
    return mysqli_affected_rows($koneksi);

}
// delete User
function deleteUser($email){
    $koneksi = koneksiUts();
    $sql = "DELETE FROM user WHERE email=$email";

    mysqli_query($koneksi,$sql);
    return mysqli_affected_rows($koneksi);
}


?>