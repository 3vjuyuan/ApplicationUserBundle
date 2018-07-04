<?php
/**
 * Copyright (c) 2014-present, San Wei Ju Yuan Tech Ltd. <https://www.3vjuyuan.com>
 * This file is part of ApplicationUserBundle
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * For more details:
 * https://www.3vjuyuan.com/licenses.html
 *
 * @author Team Weave <weave@3vjuyuan.com>
 */

namespace Savwy\SuluBundle\ApplicationUserBundle\FrontendUser;

use Symfony\Component\HttpFoundation\Session\Session;
use Savwy\SuluBundle\ApplicationUserBundle\Help\AliCaptcha;

class SettingManager
{
    /**
     * @var string
     */
    private $mailerHost;

    /**
     * @var array
     */
    private $settingConfiguration;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * SettingManager constructor.
     * @param $mailerHost
     * @param $settingConfiguration
     * @param Session $session
     * @param \Twig_Environment $twig
     */
    public function __construct($mailerHost, $settingConfiguration, Session $session,\Twig_Environment $twig)
    {
        $this->mailerHost = $mailerHost;
        $this->settingConfiguration = $settingConfiguration;
        $this->session = $session;
        $this->twig = $twig;
    }

    /**
     * Send mobile code
     * @param $phone
     * @return bool
     */
    public function sendMobileCode($phone)
    {
        $configuration = $this->settingConfiguration['mobile_code'];

        $regex = '/^((1[3,5,8][0-9])|(14[5,7])|(17[0,6,7,8]))\d{8}$/';
        if (!preg_match($regex, $phone)) {
            return false;
        }
        $code = rand(10000, 99999);
        $this->session->set($phone . '-code', (string)$code);

        $params['code'] = (string)$code;
        $template = $configuration['template'];
        $appKey = $configuration['app_key'];
        $secret = $configuration['secret'];
        $signName = $configuration['sign_name'];
        $aliCaptcha = new AliCaptcha($appKey, $secret, $signName);

        if ($aliCaptcha->sendMobileCode($phone, $template, $params)) {
            return true;
        }

        return false;
    }

    /**
     * Validate mobile code
     * @param $code
     * @param $phone
     * @return bool
     */
    public function validate($code, $phone)
    {
        return ($code == $this->session->get($phone . '-code'));
    }

    /**
     * Send email
     * @param $data array The parameters required for the mail template
     * @param $toEmail string Address to send
     * @param $twigTemplate string Created in the app/resources/emails/ directory
     */
    public function sendEmail($toEmail, $twigTemplate, array $data)
    {
        $configuration = $this->settingConfiguration['email'];

        $message = (new \Swift_Message())
            ->setFrom($configuration['send_from'])
            ->setTo($toEmail)
            ->setBody(
                $this->twig->render(
                    'emails/' . $twigTemplate,
                    $data
                ),
                'text/html'
            );

        $transport = new \Swift_SmtpTransport($this->mailerHost, $configuration['port']);
        $mailer = \Swift_Mailer::newInstance($transport);

        $mailer->send($message);
    }

}
