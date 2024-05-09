<?php
namespace Controllers;

use App\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function notFound()
    {

        $this->render('pages/404NotFound');
    }

    public function login()
    {

        if (!isset($_SESSION['id_account'])) {
            $this->render('pages/login');
        } else {
            header('Location: /');
        }

    }

    public function index()
    {

        if (isset($_SESSION['id_account'])) {
            $this->render('dashboard/index');
        } else {
            header("Location: /login");
        }

    }

    public function auth()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $password = md5($password);

            $user = User::getLogin($username, $password);

            if ($user) {
                $_SESSION["id_account"] = $user->getId();
                header("Location: /");
                exit;
            } else {
                // echo "Login gagal. Periksa kembali username dan password Anda.";
                header('Location: /login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit;
    }
}

