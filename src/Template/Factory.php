<?php

namespace Nova\Template;

use Nova\View\View;

use Language;


class Factory
{
    /**
     * Create new Template Factory instance.
     *
     * @return void
     */
    function __construct()
    {
    }

    /**
     * Create a View instance
     *
     * @param string $view
     * @param array|string $data
     * @param string $custom
     * @return \Nova\View\View
     */
    public function make($view, $data = array(), $template = null)
    {
        if (is_string($data)) {
            if (! empty($data) && ($template === null)) {
                // The Module name given as second parameter; adjust the information.
                $template = $data;
            }

            $data = array();
        }

        // Get the View file path.
        $path = $this->viewFile($view, $template);

        return new View($view, $path, $data, true);
    }

    /**
     * Check if the view file exists.
     *
     * @param    string     $view
     * @return    bool
     */
    public function exists($view, $template = null)
    {
        // Get the View file path.
        $path = $this->viewFile($view, $template);

        return file_exists($path);
    }

    /**
     * Get the view file.
     *
     * @param    string     $view
     * @return    string
     */
    protected function viewFile($view, $template = null)
    {
        // Adjust the current Template.
        $template = ($template !== null) ? $template : TEMPLATE;

        // Get the base path for the current Template files.
        $basePath = APPDIR .'Templates' .DS .$template .DS;

        // Get the name of the current Template files.
        $ltrFile = $view .'.php';
        $rtlFile = $view .'-rtl.php';

        // Use the LTR Template file by default.
        $path = $basePath .$ltrFile;

        // Depending on the Language direction, adjust to RTL Template file, if case.
        if ((Translator::direction() == 'rtl') && file_exists($basePath .$rtlFile)) {
            $path = $basePath .$rtlFile;
        }

        return $path;
    }
}