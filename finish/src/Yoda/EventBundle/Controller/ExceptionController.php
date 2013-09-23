<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends BaseController
{
    private $exceptionClass;

    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html')
    {
        $this->exceptionClass = $exception->getClass();

        return parent::showAction($request, $exception, $logger, $format);
    }

    protected function findTemplate(Request $request, $format, $code, $debug)
    {
        if (!$debug && $this->exceptionClass == 'Yoda\EventBundle\Exception\EventNotFoundException') {
            return 'EventBundle:Exception:error404.html.twig';
        }

        return parent::findTemplate($request, $format, $code, $debug);
    }


}