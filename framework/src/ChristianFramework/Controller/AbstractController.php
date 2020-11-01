<?php


namespace ChristianFramework\Controller;


use ChristianFramework\HttpModule\Response;
use ChristianFramework\HttpModule\RunnableResponse;
use ChristianFramework\Template\Template;

/**
 * Class AbstractController
 * @package ChristianFramework\Controller
 */
class AbstractController
{
    /**
     * Returns a rendered view.
     * @param string $view
     * @param array $parameters
     * @return string
     */
    protected function renderView(string $view, array $parameters = []): string
    {
        return sprintf($view, $parameters);
    }

    /**
     * Renders a view.
     * @param string $view
     * @param array $parameters
     * @param Response|null $response
     * @return Response
     */
    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $content = $this->renderView($view, $parameters);

        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($content);

        return $response;
    }

    /**
     * Render specified template from path
     *
     * @param string $templatePath
     * @param array $parameters
     * @return Response
     */
    protected function renderTemplate(string $templatePath, array $parameters = []): Response
    {
        $templateContent = Template::getTemplateContent($templatePath, $parameters);

        return new Response($templateContent);
    }

    /**
     * Render specified template php from path
     *
     * @param string $templatePath
     * @param array $parameters
     * @return RunnableResponse
     */
    protected function runTemplate(string $templatePath, array $parameters = []): RunnableResponse
    {
        $runnableResponse = new RunnableResponse($templatePath);
        $runnableResponse->setTemplateParams($parameters);
        return $runnableResponse;
    }
}