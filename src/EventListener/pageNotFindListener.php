<?php

namespace App\EventListener;

use Twig\Environment;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::EXCEPTION)]
class pageNotFindListener{
    public function __construct(private Environment $twig){}

    public function onKernelException(ExceptionEvent $event):void{
        $exception = $event->getThrowable();
        if(!$exception instanceof NotFoundHttpException){
            return;
        }

        $content = $this->twig->render('notifications/page_not_found_exception.html.twig');
        $event->setResponse((new Response())->setContent($content));
    }
}