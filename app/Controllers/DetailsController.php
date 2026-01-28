<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Show.php';


class DetailsController extends Controller
{
    public function index(): void
    {
        $type = $_GET['type'] ?? '';
        $id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $msg = $_GET['msg'] ?? '';

        if (($type !== 'film' && $type !== 'serial') || $id <= 0) {
            die('Nieprawidłowe dane');
        }

        if ($type === 'film') {
            $model      = new Movie();
            $posterDir  = 'plakaty_filmow/';
        } else {
            $model      = new Show();
            $posterDir  = 'plakaty_seriali/';
        }

        $item       = $model->find($id);
        if (!$item) die('Nie znaleziono pozycji');

        $categories = $model->getCategories($id);
        $directors  = $model->getDirectors($id);
        $rating     = $model->getRating($id);
        $platforms  = $model->getPlatforms($id);
        $actors     = $model->getActors($id);
        $comments   = $model->getComments($id);

        $this->render('details', [
            'type'       => $type,
            'item'       => $item,
            'posterDir'  => $posterDir,
            'categories' => $categories,
            'directors'  => $directors,
            'rating'     => $rating,
            'platforms'  => $platforms,
            'actors'     => $actors,
            'comments'   => $comments,
            'msg'        => $msg
        ]);
    }

    public function addComment(): void
    {
        $type = $_GET['type'] ?? '';
        $id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if (($type !== 'film' && $type !== 'serial') || $id <= 0) {
            die('Nieprawidłowe dane wejściowe');
        }

        $commentText = $_POST['commentText'] ?? '';
        // Sprawdzenie czy komentarz jest pusty
        if (trim($commentText) == "" || preg_replace("/[\p{Z}\p{C}\s\u{2800}]+/u", "", $commentText) == "") {
            header("Location: index.php?controller=details&action=index&type=$type&id=$id&msg=empty_comment");
            exit();
        }

        if (strlen($commentText) > 500) {
            header("Location: index.php?controller=details&action=index&type=$type&id=$id&msg=comment_too_long");
            exit();
        }
        if ($type === 'film') {
            $model = new Movie();
        } else {
            $model = new Show();
        }

        $model->addComment($id, $commentText);

        header("Location: index.php?controller=details&action=index&type=$type&id=$id&msg=comment_added");
        exit();
    }

    public function likeComment(): void
    {
        $type = $_GET['type'] ?? '';
        $commentId = isset($_POST['commentId']) ? (int)$_POST['commentId'] : 0;

        if (($type !== 'film' && $type !== 'serial') || $commentId <= 0) {
            die('Nieprawidłowe dane wejściowe');
        }

        if ($type === 'film') {
            $model = new Movie();
        } else {
            $model = new Show();
        }

        $model->likeComment($commentId);

        http_response_code(200);
        echo "Sukces";
    }

    public function unlikeComment(): void
    {
        $type = $_GET['type'] ?? '';
        $commentId = isset($_POST['commentId']) ? (int)$_POST['commentId'] : 0;

        if (($type !== 'film' && $type !== 'serial') || $commentId <= 0) {
            die('Nieprawidłowe dane wejściowe');
        }

        if ($type === 'film') {
            $model = new Movie();
        } else {
            $model = new Show();
        }

        $model->unlikeComment($commentId);

        http_response_code(200);
        echo "Sukces";
    }


    public function rateItem(): void
    {
        header('Content-Type: application/json');

        $type = $_POST['type'] ?? '';
        $id = (int)($_POST['id'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);

        if (!in_array($type, ['film', 'serial']) || $id <= 0 || $rating < 1 || $rating > 10) {
            echo json_encode(['success' => false, 'message' => 'Nieprawidłowe dane']);
            return;
        }

        $userIdentifier = $this->getUserIdentifier();

        try {
            if ($type === 'film') {
                $model = new Movie();
            } else {
                $model = new Show();
            }

            $existingRating = $model->getUserRating($id, $userIdentifier);

            if ($existingRating) {
                $model->updateRating($id, $userIdentifier, $rating);
                $message = 'Ocena została zaktualizowana';
            } else {
                $model->addRating($id, $userIdentifier, $rating);
                $message = 'Ocena została dodana';
            }

            $newAverage = $model->getRating($id);

            echo json_encode([
                'success' => true,
                'message' => $message,
                'newAverage' => $newAverage
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Błąd serwera: ' . $e->getMessage()]);
        }
    }

    public function deleteRating(): void
    {
        header('Content-Type: application/json');

        $type = $_POST['type'] ?? '';
        $id = (int)($_POST['id'] ?? 0);

        if (!in_array($type, ['film', 'serial']) || $id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Nieprawidłowe dane']);
            return;
        }

        $userIdentifier = $this->getUserIdentifier();

        try {
            if ($type === 'film') {
                $model = new Movie();
            } else {
                $model = new Show();
            }

            $model->deleteUserRating($id, $userIdentifier);
            $newAverage = $model->getRating($id);

            echo json_encode([
                'success' => true,
                'message' => 'Ocena została usunięta',
                'newAverage' => $newAverage
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Błąd serwera: ' . $e->getMessage()]);
        }
    }

    private function getUserIdentifier(): string
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return hash('sha256', $ip . $userAgent);
    }
}