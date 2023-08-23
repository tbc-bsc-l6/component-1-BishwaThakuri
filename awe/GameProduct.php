<?php
namespace awe;
/*gameproduct inherit the property of shopproperty*/
class GameProduct extends ShopProduct
{
    private $pegi;

    public function __construct(
        string $id,
        string $title,
        string $firstName,
        string $mainName,
        float $price,
        int $pegi
    )
    {
        parent::__construct(
            $id,
            $title,
            $firstName,
            $mainName,
            $price
        );
        //passing value
        $this->pegi = $pegi;
    }
    /*function to retun the pegi value*/
    public function getPegi()
    {
        return $this->pegi;
    }
}