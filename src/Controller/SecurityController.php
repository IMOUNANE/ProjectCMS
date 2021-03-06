<?php


namespace Controller;


use Entity\User;
use Model\UserManager;
use Vendor\App\MessageTrigger;

class SecurityController extends Controller
{
    /**
     * Shows the login page if no $_POST
     * try to log the user with the infos otherwise
     * @return mixed
     */
    public function executeLogin()
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            return $this->render('Please LogIn', [], 'Security/login');
        }

        $manager = new UserManager();
        $user = $manager->getUserByEmail($_POST['email']);

        if ($user !== false && password_verify($_POST['password'], $user->getPassword())) {
            $this->logUser($user);
            $this->HTTPResponse->redirect('/admin');
        }
        elseif ($user !== false && !password_verify($_POST['password'], $user->getPassword())) {
            MessageTrigger::setMessage('Wrong Password');
        }
        else {
            MessageTrigger::setMessage('No User Found');
        }
        $this->HTTPResponse->redirect('/login');
    }

    /**
     * Serialize the user entity in $_SESSION
     * @param User $user
     */
    private function logUser(User $user): void
    {
        $_SESSION['logged_user'] = serialize($user);
    }

    /**
     * unsets the user entity from $_SESSION
     */
    public function executeLogout()
    {
        unset($_SESSION['logged_user']);
        $this->HTTPResponse->redirect('/');
    }

    /**
     * Shows the signup page if no $_POST
     * register the new user otherwise
     * @return mixed
     */
    public function executeSignup()
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            return $this->render('Create a new user', [], 'Security/signup');
        }

        $manager = new UserManager();

        if (!$manager->userExists($_POST['email']) && ($_POST['password'] === $_POST['password_check'])) {
            $newUser = new User(array(
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ));

            $this->logUser($manager->addUser($newUser));

            $this->HTTPResponse->redirect('/admin');
        }
        elseif ($manager->userExists($_POST['email'])) {
            MessageTrigger::setMessage('The user already exists');
        }
        elseif ($_POST['password'] !== $_POST['password_check']) {
            MessageTrigger::setMessage('Passwords are not identical');
        }
        else {
            MessageTrigger::setMessage('Unknown error');
        }

        $this->HTTPResponse->redirect('/signup');
    }

    /**
     * Updates user information
     */
    public function executeUpdateUser()
    {
        if (self::isAuthenticated() && isset($_POST['userFirstName']) && isset($_POST['userLastName']) && ($_POST['userPassword'] === $_POST['userCheckPassword'])) {
            $updatedUser = new User(array(
                'firstName' => $_POST['userFirstName'],
                'lastName' => $_POST['userLastName'],
                'email' => self::getLoggedUser()->getEmail(),
                'admin' => $_POST['userRole'],
                'password' => $_POST['userPassword']
            ));

            $manager = new UserManager();
            $this->logUser($manager->updateUser($updatedUser));

            $this->HTTPResponse->redirect('/admin');
        }
        elseif (self::isAuthenticated() && isset($_POST['userFirstName']) && isset($_POST['userLastName']) && ($_POST['userPassword'] !== $_POST['userCheckPassword'])) {
            MessageTrigger::setMessage('Passwords are not identical');
            $this->HTTPResponse->redirect('/admin');
        }
        else {
            MessageTrigger::setMessage('Unknown error');
            $this->HTTPResponse->redirect('/');
        }
    }

    /**
     * Deletes user
     */
    public function executeDeleteUser()
    {
        if (SecurityController::isAuthenticated() && SecurityController::getLoggedUser()->isAdmin() && SecurityController::getLoggedUser()->getId() != $this->params['id']) {
            $userManager = new UserManager();
            $userManager->deleteUserById($this->params['id']);
        }

        if (SecurityController::getLoggedUser()->getId() == $this->params['id']) {
            MessageTrigger::setMessage('Invalid action');
        }

        $this->HTTPResponse->redirect('/userlist');
    }

    /**
     * Verify if there is a logged user
     * and if it's legit
     * @return bool
     */
    public static function isAuthenticated(): bool
    {
        if (isset($_SESSION['logged_user'])) {
            $manager = new UserManager();
            return $manager->userMatches(unserialize($_SESSION['logged_user']));
        }

        return false;
    }

    /**
     * Returns the user entoty from $_SESSION, null otherwise
     * @return User|null
     */
    public static function getLoggedUser()
    {
        if (isset($_SESSION['logged_user'])) {
            return unserialize($_SESSION['logged_user']);
        }

        return null;
    }
}