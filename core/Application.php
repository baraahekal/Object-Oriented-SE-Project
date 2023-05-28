<?php
/**
 * @package app\core
 *
 */
namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;
use app\models\Module;

class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass = 'User';
    public Router $router;
    public Request $request;
    public Database $db;
    public Response $response;
    public Session $session;
    public static Application $app;
    public ?Controller $controller = null;
    public ?UserModel $user = null;
    public ?ModuleModel $module = null;
    public View $view;

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
    public function __construct($rootPath, array $config)
    {
        if (isset($config['userClass']) && is_string($config['userClass'])) {
            $this->userClass = $config['userClass'];
        } else {
            $this->userClass = 'DefaultUserClass';
        }
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->module = new Module();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = Database::getInstance($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            $this->user = $user ?: null;
        } else {
            $this->user = null;
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        }
        catch (\Exception $e) {

            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

}
