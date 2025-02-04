<?php

namespace Source\App\Admin;

use Source\Models\Auth;
use Source\Models\User;
use Source\Support\Pager;
use Source\Support\Thumb;
use Source\Support\Upload;
use Source\App\Admin\Admin;

class Users extends Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(?array $data): void
    {
        $user = Auth::user();

        //search redirect
        if (!empty($data["s"])) {
            $s = str_search($data["s"]);
            echo json_encode(["redirect" => url("/admin/users/home/{$s}/1")]);
            // redirect("/admin/users/home/{$s}/1");
            // echo json_encode($json);
            return;
        }

        // if ($user->level >= 100) {
        //     $users = (new User())->find("level <= 100");
        // } elseif ($user->level > 6) {
        //     $users = (new User())->find("level <= 10");
        // } else {
        //     $users = (new User())->find("level <= {$user->level} && level != 'inativo'");
        // }

        //read
        $search = null;
        $users = (new User())->find("level <= {$user->level} ");
        // $users = (new User())->find("level <= {$user->level}");
        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $users = (new User())->find("MATCH(first_name, last_name, email) AGAINST(:s)", "s={$search}");
            if (!$users->count()) {
                $this->message->info("Sua pesquisa não retornou resultados")->flash();
                redirect("/admin/users/home");
            }
        }
        $all = ($search ?? "all");
        $pager = new Pager(url("/admin/users/home/{$all}/"));
        $pager->pager($users->count(), 6, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Usuários",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/users/home", [
            "app" => "users/home",
            "head" => $head,
            "search" => $search,
            "users" => $users->limit($pager->limit())->offset($pager->offset())->order("first_name, last_name")->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function user(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $userCreate = new User();
            $userCreate->first_name = $data["first_name"];
            $userCreate->last_name = $data["last_name"];
            $userCreate->email = $data["email"];
            $userCreate->password = $data["password"];
            $userCreate->level = $data["level"];
            $userCreate->genre = $data["genre"];
            $userCreate->office = $data["office"];
            $userCreate->datebirth = date_fmt_back($data["datebirth"]);
            $userCreate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $userCreate->status = $data["status"];
            //upload photo
            if (!empty($_FILES["photo"])) {
                $files = $_FILES["photo"];
                $upload = new Upload();
                $image = $upload->image($files, $userCreate->fullName(), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $userCreate->photo = $image;
            }

            if (!$userCreate->save()) {
                $json["message"] = $userCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário cadastrado com sucesso...")->flash();
            echo json_encode(["redirect" => url("/admin/users/user/{$userCreate->id}")]);

            return;
        }
        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userUpdate = (new User())->findById($data["user_id"]);

            /**
             * Condição para travar um User->Level menor de alterar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10 || $userUpdate->level != 'Inativo') {
                if (Auth::user()->level < $userUpdate->level) {
                    $this->message->error("Você não tem permissão de editar o perfil do usuário, pois ele possui nível acima do seu usuário")->flash();
                    echo json_encode(["redirect" => url("admin/users/home")]);
                    return;
                }
            }

            if (!$userUpdate) {
                $this->message->error("Você tentou gerenciar um usuário que não existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("admin/users/home")]);
                return;
            }

            $userUpdate->first_name = $data["first_name"];
            $userUpdate->last_name = $data["last_name"];
            $userUpdate->email = $data["email"];
            $userUpdate->password = (!empty($data["password"]) ? $data["password"] : $userUpdate->password);
            $userUpdate->level = $data["level"];
            $userUpdate->genre = $data["genre"];
            $userUpdate->office = $data["office"];
            $userUpdate->datebirth = date_fmt_back($data["datebirth"]);
            $userUpdate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $userUpdate->status = $data["status"];

            //upload cover
            if (!empty($_FILES["photo"])) {
                if ($userUpdate->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userUpdate->photo}")) {
                    unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userUpdate->photo}");
                    (new Thumb())->flush($userUpdate->photo);
                }

                $files = $_FILES["photo"];
                $upload = new Upload();
                $image = $upload->image($files, $userUpdate->fullName(), 600);

                if (!$image) {
                    $json["message"] = $upload->message()->render();
                    echo json_encode($json);
                    return;
                }

                $userUpdate->photo = $image;
            }
            if (!$userUpdate->save()) {
                $json["message"] = $userUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Usuário atualizado com sucesso...")->flash();
            echo json_encode(["reload" => true]);

            return;
        }
        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userDelete = (new User())->findById($data["user_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10 || Auth::user()->id == $userDelete->id) {
                $this->message->error("Você não tem permissão para deletar o perfil desse usuário ou é o perfil pertence ao seu usuário.")->flash();
                echo json_encode(["redirect" => url("admin/users/home")]);
                return;
            }

            // if (!(Auth::user()->level >= $userDelete->level && $userDelete->level !== 'inativo')) {
            //     $this->message->error("Você não tem permissão de editar o perfil do usuário, pois ele possui nível acima do seu usuário ou está inativo.")->flash();
            //     echo json_encode(["redirect" => url("admin/users/home")]);
            //     return;
            // }

            if (!$userDelete) {
                $this->message->error("Você tentou Deletar um usuário que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/users/home")]);
                return;
            }

            // if ($userDelete->photo && file_exists(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}")) {
            //     unlink(__DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/{$userDelete->photo}");
            //     (new Thumb())->flush($userDelete->photo);
            // }

            // $userDelete->destroy();
            $userDelete->level = 'Inativo';
            $userDelete->save();

            $this->message->success("Usuário excluido com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/users/home")]);
            return;
        }

        //ativar
        if (!empty($data["action"]) && $data["action"] == "ativar") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userActivate = (new User())->findById($data["user_id"]);

            /**
             * Condição para travar um User->Level menor de deletar os dados de um User->Level maior
             */
            if (Auth::user()->level < 10 || Auth::user()->id == $userActivate->id) {
                $this->message->error("Você não tem permissão para ativar o perfil desse usuário.")->flash();
                echo json_encode(["redirect" => url("admin/users/home")]);
                return;
            }

            // if (!(Auth::user()->level >= $userDelete->level && $userDelete->level !== 'inativo')) {
            //     $this->message->error("Você não tem permissão de editar o perfil do usuário, pois ele possui nível acima do seu usuário ou está inativo.")->flash();
            //     echo json_encode(["redirect" => url("admin/users/home")]);
            //     return;
            // }

            if (!$userActivate) {
                $this->message->error("Você tentou Ativar um usuário que não existe ou que já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/users/home")]);
                return;
            }
            $userActivate->level = '5';
            $userActivate->save();

            $this->message->success("Usuário Ativado com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/users/home")]);
            return;
        }


        $userEdit = null;
        if (!empty($data["user_id"])) {
            $userId = filter_var($data["user_id"], FILTER_SANITIZE_STRIPPED);
            $userEdit = (new User())->findById($userId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($userEdit ? "Perfil de {$userEdit->fullName()}" : "Novo Usuário"),
            CONF_SITE_DESC,
            url("/admin"),
            theme("/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/users/user", [
            "app" => "users/user",
            "head" => $head,
            "user" => $userEdit
        ]);
    }
}
