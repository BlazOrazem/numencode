<?php

namespace Admin\Http\Requests;

use Numencode\Http\Request;
use Admin\Repositories\ManagerRepository;

class LoginRequest extends Request
{
    /**
     * Existing manager.
     *
     * @var Manager
     */
    protected $resolvedManager;

    /**
     * Get the validation rules that apply to the login request.
     *
     * @return array
     */
    public function rules()
    {
        $this->customRule('login', 'checkLogin');

        return [
            'email' => 'required|email',
            'password' => 'required|login'
        ];
    }

    /**
     * Validate manager login.
     *
     * @param ManagerRepository $repository
     * @return bool
     */
    public function checkLogin(ManagerRepository $repository)
    {
        if ($this->email && $this->password) {
            $this->resolvedManager = $repository->getByLogin($this->email, $this->password);

            return !empty($this->resolvedManager);
        }

        return true;
    }

    /**
     * Return existing manager.
     *
     * @return object
     */
    public function resolveManager()
    {
        return $this->resolvedManager;
    }
}
