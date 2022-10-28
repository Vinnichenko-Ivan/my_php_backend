<?php

class ReviewModifyModel
{
    public string $reviewText;
    public int $rating;
    public bool $isAnonymous;

    public function __construct(Request $request = null)
    {
        if($request != null)
        {
            $body = $request->getBody();
            if(property_exists($body, 'reviewText'))
            {
                $this->reviewText = $body->reviewText;
            }
            else
            {
                $this->reviewText = null;
            }
            if(property_exists($body, 'rating'))
            {
                $this->rating = $body->rating;
            }
            else
            {
                throw new Exception();
            }
            if(property_exists($body, 'isAnonymous'))
            {
                $this->isAnonymous = $body->isAnonymous == 'true'?true:false;
            }
            else
            {
                throw new Exception();//TODO новые ошибки.
            }
        }
    }


}