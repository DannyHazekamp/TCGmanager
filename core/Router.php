<?php

namespace app\core;


class Router 
{
    public Request $request;
    public Response $response;
    protected array $routes = [];


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {   
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        
        foreach ($this->routes[$method] as $route => $callback) {
            // Patroonmatcher voor dynamische segmenten in de URL
            $pattern = preg_replace('/\/{(.*?)}/', '/(.*?)', $route);
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Eerste match is het volledige pad, niet nodig
                
                // Voeg dynamische parameters toe aan de route
                $routeParams = [];
                preg_match_all('/{(.*?)}/', $route, $routeParamsMatches);
                $routeParamsNames = $routeParamsMatches[1];
                for ($i = 0; $i < count($routeParamsNames); $i++) {
                    $routeParams[$routeParamsNames[$i]] = $matches[$i];
                }
                
                $this->request->setRouteParams($routeParams);

                // Roep de callback-functie aan met de request, response en dynamische parameters
                if (is_string($callback)) {
                    return $this->render($callback);
                }
                if (is_array($callback)) {
                    $callback[0] = new $callback[0];
                }
                return call_user_func($callback, $this->request, $this->response);
            }
        }

        // Als er geen overeenkomende route is gevonden, retourneer 404
        $this->response->setStatus(404);
        return $this->render("_404"); 
    }

    public function render($view, $params = [])
    {

        $content = $this->content();
        $viewContent = $this->renderView($view, $params);
        return str_replace('{{content}}', $viewContent, $content);
    }

    public function renderContent($viewContent)
    {
        $content = $this->content();
        return str_replace('{{content}}', $viewContent, $content);
    }

    protected function content() 
    {
        ob_start();
        include_once App::$ROOT_DIRECTORY . "/views/layouts/main.php";; 
        return ob_get_clean();
    }

    protected function renderView($view, $params) 
    {
        foreach($params as $key => $value) {
            $$key = $value;
        }
        $viewPath = str_replace('.', '/', $view);

        ob_start();
        include_once App::$ROOT_DIRECTORY."/views/$viewPath.php"; 
        return ob_get_clean();
    }

}