<?php

declare(strict_types=1);

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevereto.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chevereto\Chevere\ErrorHandler;

use DateTime;
use Chevereto\Chevere\Console;
use Chevereto\Chevere\Json;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpFoundation\JsonResponse as HttpJsonResponse;

class Output
{
    /** @var ErrorHandler */
    protected $errorHandler;

    /** @var Formatter */
    protected $formatter;

    /** @var string */
    protected $output;

    /** @var array */
    protected $headers = [];

    public function __construct(ErrorHandler $errorHandler, Formatter $formatter)
    {
        $this->errorHandler = $errorHandler;
        $this->formatter = $formatter;
        if ($errorHandler->httpRequest && $errorHandler->httpRequest->isXmlHttpRequest()) {
            $this->setJsonOutput();
        } else {
            if ('cli' == php_sapi_name()) {
                $this->setConsoleOutput();
            } else {
                $this->setHtmlOutput();
            }
        }
    }

    protected function setJsonOutput(): void
    {
        $json = new Json();
        $this->headers = array_merge($this->headers, Json::CONTENT_TYPE);
        $response = [Template::NO_DEBUG_TITLE_PLAIN, 500];
        $log = [
            'id' => $this->formatter->getTemplateTag('id'),
            'level' => $this->loggerLevel,
            'filename' => $this->formatter->getTemplateTag('logFilename'),
        ];
        switch ($this->errorHandler->isDebugEnabled) {
            case 0:
                unset($log['filename']);
            break;
            case 1:
                $response[0] = $this->thrown . ' in ' . $this->formatter->getTemplateTag('file') . ':' . $this->formatter->getTemplateTag('line');
                $error = [];
                foreach (['file', 'line', 'code', 'message', 'class'] as $v) {
                    $error[$v] = $this->formatter->getTemplateTag($v);
                }
                $json->setDataKey('error', $error);
            break;
        }
        $json->setDataKey('log', $log);
        $json->setResponse(...$response);
        $this->output = (string) $json;
    }

    protected function setHtmlOutput(): void
    {
        switch ($this->errorHandler->isDebugEnabled) {
            default:
            case 0:
                $this->content = Template::NO_DEBUG_CONTENT_HTML;
                $this->formatter->addTemplateTag('content', $this->content);
                $this->formatter->addTemplateTag('title', Template::NO_DEBUG_TITLE_PLAIN);
                $bodyTemplate = Template::NO_DEBUG_BODY_HTML;
            break;
            case 1:
                $bodyTemplate = Template::DEBUG_BODY_HTML;
            break;
        }
        $this->formatter->addTemplateTag('body', strtr($bodyTemplate, $this->formatter->templateTags));
        $this->output = strtr(Template::HTML_TEMPLATE, $this->formatter->templateTags);
    }

    protected function setConsoleOutput(): void
    {
        foreach ($this->formatter->consoleSections as $k => $v) {
            if ('title' == $k) {
                $tpl = $v[0];
            } else {
                Console::io()->section(strtr($v[0], $this->formatter->templateTags));
                $tpl = $v[1];
            }
            $message = strtr($tpl, $this->formatter->templateTags);
            if ('title' == $k) {
                Console::io()->error($message);
            } else {
                Console::io()->writeln($message);
            }
        }
        Console::io()->writeln('');
    }

    public function out(): void
    {
        if ($this->errorHandler->httpRequest && $this->errorHandler->httpRequest->isXmlHttpRequest()) {
            $response = new HttpJsonResponse();
        } else {
            $response = new HttpResponse();
        }
        $response->setContent($this->output);
        $response->setLastModified(new DateTime());
        $response->setStatusCode(500);
        foreach ($this->headers as $k => $v) {
            $response->headers->set($k, $v);
        }
        $response->send();
    }
}
