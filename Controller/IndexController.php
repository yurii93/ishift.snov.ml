<?php

namespace Controller;

use Model\PeopleModel;

class IndexController extends BaseController
{
    protected $name = 'index';

    /*
     * Shows main page & sends subscriber's data
     */

    public function index()
    {
		// if there is certain session - delete it
		if(isset($_SESSION['success'])) {
			$this->data['success'] = $_SESSION['success'];
			unset($_SESSION['success']);
		}

        if ($_POST) {
			
			// if there is POST - make object, validate data, set errors
            $peopleModel = new PeopleModel();
            $validationResult = $peopleModel->validate($_POST);
            $validateEmail = $peopleModel->validateEmail($_POST['email']);
            $this->data['emailError'] = $validateEmail;

			// if validation is OK
            if ($validationResult === false && $validateEmail === true) {

				// checking if there is guest with certain email
                if (!$peopleModel->check($_POST['email'])) {

					// adding new guest
                    if ($id = $peopleModel->add($_POST)) {
                        $_SESSION['success'] = 'Спасибо, вы зарегистрировались';
                        unset($_SESSION['info']);

						// if there is field 'oportunity' - redirect on payment page
                        if(!isset($_POST['oportunity']) || !$_POST['oportunity']) {
                            header('Location: https://www.liqpay.com/ru/checkout/privat24/380967140949');
                            die();
                        }
						
						header('Location: /');
						die();
						
					// if hasn't been added
                    } else {
                        $this->data['fail'] = 'Произошла ошибка, попробуйте снова';
                        $this->session($_POST);
                    }

				// if there is guest with certain email
                } else {
                    $this->data['secondEmail'] = 'Человек с таким email ранее уже был зарегистрирован. Выберите другой email';
                    $this->session($_POST);
                }

			// if validation isn't OK
            } else {
                $this->data['errors'] = $validationResult;
                $this->session($_POST);
            }
        }

		// rendering html
        $this->render('index');
    }

    /*
     * Shows admin pages
     */
    public function admin($alias)
    {
		// if this is admin
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
            
			// additional verification
			$this->isAdmin();
            $peopleModel = new PeopleModel();

            if ($alias[0] == null) {
                $alias[0] = 'all';
            }

			// start methods depending on the alias
            if ($alias[0] === 'all') {
                $this->data['people'] = $peopleModel->all();
            } elseif ($alias[0] === 'on') {
                $this->data['people'] = $peopleModel->status($alias);
            } elseif ($alias[0] === 'un') {
                $this->data['people'] = $peopleModel->status($alias);
            } elseif ($alias[0] === 'oportunity') {
                $this->data['people'] = $peopleModel->oportunity();
            }
			
			// rendering html	
            $this->render('admin');

		// if this is not admin
        } else {
			// rendering html
            $this->render('admin');
            die();
        }

    }

    /*
     * Authentication
     */
    public function login()
    {
        if ($_POST) {
            $peopleModel = new PeopleModel();

			// setting sessions
            if ($admin = $peopleModel->login($_POST)) {
                $_SESSION['admin'] = $admin['name'];
                $_SESSION['adminRole'] = $admin['role'];

                header('Location: /admin');
                die();
            }
        }

        header('Location: /');
        die();
    }

    /*
     * Logout
     */
    public function logout()
    {
        if ($_SESSION['admin']) {
			
			// deleting sessions
            unset($_SESSION['admin']);
            unset($_SESSION['adminRole']);
        }
        header('Location: /');
        die();
    }

    /*
     * Edits guest's status
     */
    public function editStatus($id)
    {
		// verifications
        $this->isAdmin();
        $this->refer('/admin', '/admin');

		// editing status
        $peopleModel = new PeopleModel();
        $peopleModel->editStatus($id);

        $path = $_SERVER['HTTP_REFERER'];
        header("Location: $path");
        die;
    }

    /*
     * Deletes guest
     */
    public function delete($id)
    {
		
		// verifications
        $this->isAdmin();
        $this->refer('/admin', '/admin');

		// deleting data
        $peopleModel = new PeopleModel();
        $peopleModel->delete($id[0]);

        $path = $_SERVER['HTTP_REFERER'];
        header("Location: $path");
        die;
    }

    /*
     * Sets sessions
     */
    private function session($info)
    {
        foreach ($info as $key => $value) {
            if ($value) {
                $_SESSION['info'][$key] = $value;
            }
        }
    }
}