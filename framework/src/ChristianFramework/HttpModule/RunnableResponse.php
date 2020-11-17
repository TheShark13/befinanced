<?php


namespace ChristianFramework\HttpModule;

/**
 * Class RunnableResponse
 * @package ChristianFramework\HttpModule
 */
class RunnableResponse extends Response
{
    protected array $templateParams = [];

    /**
     * @inheritDoc
     */
    public function send()
    {
        $this->sendHeaders();

        $this->requireFile($this->content, $this->templateParams);
    }

    /**
     * @return array
     */
    public function getTemplateParams(): array
    {
        return $this->templateParams;
    }

    /**
     * @param array $templateParams
     * @return RunnableResponse
     */
    public function setTemplateParams(array $templateParams): RunnableResponse
    {
        $this->templateParams = $templateParams;
        return $this;
    }

    /**
     * @param string $absPath
     * @param array $params
     */
    private function requireFile(string $absPath, array $params = [])
    {
        $params = array_merge($params, $this->getUtilMethods());
        extract($params);
        require __DIR__ . '/../../../../templates/' . $absPath;
    }

    /**
     * @return callable[]
     */
    private function getUtilMethods(): array
    {
        return [
            "loadTemplate" => function (string $templatePath, array $params = []) {
                $this->requireFile($templatePath, $params);
            },
            "getFileSrc" => function (string $fileSrc) {
                return "/$fileSrc";
            },
            "getUser" => function () {
                return $_SESSION['user'] ?? null;
            },
        ];
    }
}