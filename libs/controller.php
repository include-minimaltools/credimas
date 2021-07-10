 <?php
class Controller
{
    function __construct()
    {
        $this->view = new View();
    }

    function InitModel($model)
    {
        $url = 'Models/' . $model . 'Model.php';
        if(file_exists($url))
        {
            require $url;

            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }

    function ExistPOST($parameters)
    {
        foreach($parameters as $parameter)
            if(!isset($_POST[$parameter]))
            {
                error_log('Controller::ExistPOST -> No existe el parametro ' . $parameter);
                return false;
            }
        return true;
    }

    function ExistGET($parameters)
    {
        foreach($parameters as $parameter)
            if(!isset($_GET[$parameter]))
            {
                error_log('Controller::ExistGET -> No existe el parametro ' . $parameter);
                return false;
            }
        return true;
    }

    function GET($name)
    {
        return $_GET[$name];
    }

    function POST($name)
    {
        return $_POST[$name];
    }

    function Redirect($path, $messages)
    {
        $data = [];
        $parameters = '';
        foreach ($messages as $key => $message)
        {
            array_push($data, $key . '=' . $message);
        }

        $parameters = join('&', $data);

        if($parameters != '')
            $parameters = '?' . $parameters;

        header('Location: ' . constant('URL') . '/' . $path . $parameters);
    }
}
?>