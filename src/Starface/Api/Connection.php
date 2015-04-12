<?php


namespace Starface\Api;


class Connection extends Api
{
    const METHOD_LOGIN = 'ucp.v22.requests.connection.login';
    const METHOD_LOGOUT = 'ucp.v22.requests.connection.logout';
    const METHOD_KEEP_ALIVE = 'ucp.v22.requests.connection.keepAlive';

    /**
     * @return bool
     */
    public function login()
    {
        return boolval($this->rpcCall(self::METHOD_LOGOUT, [], false));
    }

    /**
     * @return bool
     */
    public function logout()
    {
        return boolval($this->rpcCall(self::METHOD_LOGOUT));
    }

    /**
     * @return bool
     */
    public function keepAlive()
    {
        return boolval($this->rpcCall(self::METHOD_KEEP_ALIVE));
    }
}
