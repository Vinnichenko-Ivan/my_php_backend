<?php

class ReviewModifyModel
{
    public string $reviewText;
    public int|null $rating;
    public bool|null $isAnonymous;

    public function __construct(Request $request = null)
    {
        if($request != null)
        {
            $body = $request->getBody();
            if($body == null)
            {
                throw new BadDTOCastException();
            }
            if(property_exists($body, 'reviewText'))
            {
                $this->reviewText = $body->reviewText;
            }
            else
            {
                throw new BadDTOCastException();
            }
            if(property_exists($body, 'rating'))
            {
                $this->rating = $body->rating;
                if($this->rating < 1 or $this->rating > 10)
                {
                    throw new BadDTOCastException();
                }
            }
            else
            {
                $this->rating = null;
            }
            if(property_exists($body, 'isAnonymous'))
            {
                $this->isAnonymous = $body->isAnonymous == 'true'?true:false;
            }
            else
            {
                $this->isAnonymous = true;
            }
        }
    }


}