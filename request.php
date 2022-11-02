<?php

class Request
{
    private string $type;
    private string $path;
    private array $segmentPath;
    private array $params;
    private array $headers;
    private object|null $body;

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return object
     */
    public function getBody(): object|null
    {
        return $this->body;
    }

    /**
     * @param object $body
     */
    public function setBody(object|null $body): void
    {
        $this->body = $body;
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getSegmentPath(): array
    {
        return $this->segmentPath;
    }

    /**
     * @param array $segmentPath
     */
    public function setSegmentPath(array $segmentPath): void
    {
        $this->segmentPath = $segmentPath;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getToken():string{
        if(key_exists('Authorization', $this->headers)){
            return explode(' ',$this->headers['Authorization'])[1];
        }
        throw new UnauthorizedException();
    }
}

function getRequest(): Request
{
    $request = new Request();
    $type = $_SERVER['REQUEST_METHOD'];
    $path = $_GET['query'];
    $segmentPath = explode('/', $_GET['query']);
    $params = [];
    foreach ($_GET as $key => $value) {
        if($key != 'query')
        {
            $params[$key] = $value;
        }
    }
    $request->setBody(null);
    $request->setHeaders(getallheaders());
    $request->setParams($params);
    $request->setPath($path);
    $request->setSegmentPath($segmentPath);
    $request->setType($type);
    if(file_get_contents('php://input')) {
        $request->setBody(json_decode(file_get_contents('php://input')));
    }

    return $request;
}