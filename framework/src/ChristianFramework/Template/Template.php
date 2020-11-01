<?php


namespace ChristianFramework\Template;

/**
 * Class Template
 * @package ChristianFramework\Template
 */
class Template
{
    /**
     * Get html code from specified template path
     *
     * @param string $pathToTemplate
     * @param array $parameters
     * @return string
     */
    public static function getTemplateContent(string $pathToTemplate, array $parameters = []): string
    {
        $keys = [];
        $values = [];
        if (!empty($parameters)) {
            foreach ($parameters as $k => $v) {
                $keys[] = "%%" . $k . "%%";
                $values[] = $v;
            }
        }

        $fileContent = file_get_contents(__DIR__ . '/../../../../templates/' . $pathToTemplate);
        return str_replace($keys, $values, $fileContent);
    }
}