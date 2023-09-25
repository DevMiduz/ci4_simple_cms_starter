<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RequestLogFilter implements FilterInterface
{
    private $password_fields = [
        'password', 'confirm_password', 'new_password', 'old_password'
    ];

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $request_data = isset($_REQUEST) ? $_REQUEST : [];
        $this->redact_password_fields($request_data);

        $session = isset($_SESSION) ? $_SESSION : [];
        $this->redact_password_fields($session);
        
        if(isset($session['_ci_old_input'])) {
            if(isset($session['_ci_old_input']['post'])) {
                $this->redact_password_fields($session['_ci_old_input']['post']);
            }
        }
        

        $audit = [
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
            'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'],
            'PATH_INFO' => $_SERVER['PATH_INFO'],
            'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
            'HTTP_ACCEPT' => $_SERVER['HTTP_ACCEPT'],
            'HTTP_ACCEPT_LANGUAGE' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'HTTP_ACCEPT_ENCODING' => $_SERVER['HTTP_ACCEPT_ENCODING'],
            'HTTP_COOKIE' => $_SERVER['HTTP_COOKIE'],
            'QUERY_STRING' => $_SERVER['QUERY_STRING'],
            'REQUEST_DATA' => print_r($request_data, true),
            'SESSION' => print_r($session, true),
            
        ];

        /*
            Should remove passwords from logs.
        */


        
        log_message('notice', print_r($audit, true));
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {


    }

    private function redact_password_fields(&$array) {
        foreach ($this->password_fields as $value) {
            if(isset($array[$value])) {
                $array[$value] = 'REDACTED';
            }
        }
    }
}
