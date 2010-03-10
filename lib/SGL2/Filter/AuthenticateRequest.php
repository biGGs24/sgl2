<?php
/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | Copyright (c) 2008, Demian Turner                                         |
// | All rights reserved.                                                      |
// |                                                                           |
// | Redistribution and use in source and binary forms, with or without        |
// | modification, are permitted provided that the following conditions        |
// | are met:                                                                  |
// |                                                                           |
// | o Redistributions of source code must retain the above copyright          |
// |   notice, this list of conditions and the following disclaimer.           |
// | o Redistributions in binary form must reproduce the above copyright       |
// |   notice, this list of conditions and the following disclaimer in the     |
// |   documentation and/or other materials provided with the distribution.    |
// | o The names of the authors may not be used to endorse or promote          |
// |   products derived from this software without specific prior written      |
// |   permission.                                                             |
// |                                                                           |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS       |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT         |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR     |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT      |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,     |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT          |
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,     |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY     |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT       |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE     |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.      |
// |                                                                           |
// +---------------------------------------------------------------------------+
// | Seagull 2.0                                                               |
// +---------------------------------------------------------------------------+
// $Id: AuthenticateRequest.php 4202 2008-10-24 12:06:36Z demian $


/**
 * Initiates session check.
 *
 *      o global set of perm constants loaded from file cache
 *      o current class's config file is checked to see if authentication is required
 *      o if yes, session is checked for validity and expiration
 *      o if it's valid and not expired, the session is deemed valid.
 *
 * @package Task
 * @author  Demian Turner <demian@phpkitchen.com>
 */
class SGL2_Filter_AuthenticateRequest extends SGL2_DecorateProcess
{
    /**
     * Returns 'remember me' cookie data.
     *
     * @return mixed
     */
    protected function _getRememberMeCookieData()
    {
        //  no 'remember me' cookie found
        if (!isset($_COOKIE['SGL2_REMEMBER_ME'])) {
            return false;
        }
        $cookie = $_COOKIE['SGL2_REMEMBER_ME'];
        list($username, $cookieValue) = unserialize($cookie);
        //  wrong cookie value was saved
        if (!$username || !$cookieValue) {
            return false;
        }
        //  get UID by cookie value
        require_once SGL2_MOD_DIR . '/user/classes/UserDAO.php';
        $da  = UserDAO::singleton();
        $uid = $da->getUserIdByCookie($username, $cookieValue);
        if ($uid) {
            $ret = array('uid' => $uid, 'cookieVal' => $cookieValue);
        } else {
            $ret = false;
        }
        return $ret;
    }

    /**
     * Authenticate user.
     *
     * @param integer $uid
     *
     * @return void
     */
    protected function _doLogin($uid)
    {
        // if we do login here, then $uid was recovered by cookie,
        // thus activating 'remember me' functionality
        SGL2_Registry::set('session', new SGL2_Session($uid, $rememberMe = true));
    }

    public function process(SGL2_Request $input, SGL2_Response $output)
    {
        // check for timeout
        $session = SGL2_Registry::get('session');
        $timeout = !$session->updateIdle();

        //  store request in session
        $aRequestHistory = SGL2_Session::get('aRequestHistory');
        if (empty($aRequestHistory)) {
            $aRequestHistory = array();
        }
        array_unshift($aRequestHistory, $input->getClean());
        $aTruncated = array_slice($aRequestHistory, 0, 2);
        SGL2_Session::set('aRequestHistory', $aTruncated);

        $ctlr = SGL2_Registry::get('controller');
        $ctlrName = get_class($ctlr);

        //  test for anonymous session and rememberMe cookie
        if (($session->isAnonymous() || $timeout)
                && SGL2_Config::get('cookie.rememberMeEnabled')
                && !SGL2_Config::get('site.maintenanceMode')) {
            $aCookieData = $this->_getRememberMeCookieData();
            if (!empty($aCookieData['uid'])) {
                $this->_doLogin($aCookieData['uid']);

                //  session data updated
#FIXME - what's going on here, 2nd invocation
                $session = SGL2_Registry::get('session');
                $timeout = !$session->updateIdle();
            }
        }
        //  if page requires authentication and we're not debugging
        if (   SGL2_Config::get("$ctlrName.requiresAuth")
            && SGL2_Config::get('debug.authorisationEnabled')
            && $input->getType() != SGL2_Request::CLI)
        {
            //  check that session is valid or timed out
            if (!$session->isValid() || $timeout) {

                //  prepare referer info for redirect after login
                $url = SGL2_Registry::get('url');
                $redir = $url->toString();
                $loginPage = array(
                    'moduleName'    => 'user',
                    'controllerName'=> 'login',
                    'redir'         => base64_encode($redir)
                    );

                if (!$session->isValid()) {
//SGL::raiseMsg('authentication required');
                    SGL2_Response::redirect($loginPage);
                } else {
                    $session->destroy();
//SGL::raiseMsg('session timeout');
                    SGL2_Response::redirect($loginPage);
                }
            }
        }

        $this->_processRequest->process($input, $output);
    }
}
?>