<?php


namespace awe;


class HtmlProductWriter extends ShopProductWriter
{

    public function write()
    {
        echo $this->htmlHeader();
        echo $this->htmlBody();
        echo '</html>';
    }

    private function htmlHeader()
    {
        return
            '<!DOCTYPE html>
            <html>
            <head>
                <title>AWE Product List</title>
                <link rel="stylesheet" href="./css/styles.css">
            </head>';
    }

    private function htmlBody()
    {
        $bookproducts = [];
        $cdproducts = [];
        $gameproducts = [];/*creating the gameproduct array*/

        /*Check if given object belong to book, cd or game class*/
        foreach ($this->products as $product) {
         if($product instanceof BookProduct) $bookproducts[] = $product;
         if($product instanceof CdProduct) $cdproducts[] = $product;
         if($product instanceof GameProduct) $gameproducts[] = $product;
        }

        $booktable = $this->generateBookTable($bookproducts);
        $cdtable = $this->generateCdTable($cdproducts);

        /*this will generate game table and store in gametable*/
        $gametable = $this->generateGameTable($gameproducts);

        $addProduct = $this->generateAddProductForm();

        return
            '<body>'
            . $booktable .
            '<br />'
            .$cdtable.
            '<br />'
            /*This will show he game table*/
            .$gametable.
            '<br />'
            .$addProduct .
            '</body>';
    }

    private function generateBookTable($bookproducts)
    {
        $contents = '';
        foreach ($bookproducts as $book) {
            $contents .= '<tr>
                  <td>'.$book->getFullName().'</td>'
                .'<td>'.$book->getTitle().'</td>'
                .'<td>'.$book->getNumberOfPages().'</td>'
                .'<td>'.$book->getPrice().'</td>'
                .'<td>'.'<a href="./index.php?delete='.$book->getId().'">X</a>'.'</td>
                </tr>';
        }
        return
            '
            <h3>BOOKS</h3>
            <table class="paleBlueRows equal-width">
                <thead>
                    <tr>
                        <th>AUTHOR</th>
                        <th>TITLE</th>
                        <th>PAGES</th>
                        <th>PRICE</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>'
            .$contents.
                '</tbody>
            </table>';
    }

    private function generateCdTable($cdproducts)
    {
        $contents = '';
        foreach ($cdproducts as $cd) {
            $contents .= '<tr>
                  <td>'.$cd->getFullName().'</td>'
                .'<td>'.$cd->getTitle().'</td>'
                .'<td>'.$cd->getPlayLength().'</td>'
                .'<td>'.$cd->getPrice().'</td>'
                .'<td>'.'<a href="./index.php?delete='.$cd->getId().'">X</a>'.'</td>
                </tr>';
        }
        return
            '
            <h3>CDs</h3>
            <table class="paleBlueRows equal-width">
                 <thead>
                    <tr>                    
                        <th>ARTIST</th>
                        <th>TITLE</th>
                        <th>DURATION</th>
                        <th>PRICE</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>'
            .$contents.
            '</tbody>
            </table>';
    }

    /*Formating of the game table */
    private function generateGameTable($gameproducts)
    {
        $contents = '';
        foreach ($gameproducts as $game) {
            $contents .= '<tr>
                  <td>'.$game->getFullName().'</td>'
                .'<td>'.$game->getTitle().'</td>'
                .'<td>'.$game->getPegi().'</td>'
                .'<td>'.$game->getPrice().'</td>'
                .'<td>'.'<a href="./index.php?delete='.$game->getId().'">X</a>'.'</td>
                </tr>';
        }
        return
            '
            <h3>Game</h3>
            <table class="paleBlueRows equal-width">
                 <thead>
                    <tr>                    
                        <th>Console</th>
                        <th>TITLE</th>
                        <th>PEGI</th>
                        <th>PRICE</th>
                        <th>DELETE</th>
                    </tr>
                    </thead>
                    <tbody>'
            .$contents.
            '</tbody>
            </table>';
    }

    /*Form the input teh value into the table*/
    private function generateAddProductForm()
    {
        return '
          <hr />
          <h2>ADD NEW PRODUCT</h2>
         <form action="./index.php" method="post">
          <label for="producttype">Product Type:</label>
          <select id="producttype" name="producttype">
                <option value="book">Book</option>
                <option value="cd">CD</option>
                <option value="game">Game</option>
          </select> 
          <br />
          <br />
         <label for="name">Author / Artist / Console:</label><br />
         <label for="fname">First Name:</label>
           <input type="text" id="fname" name="fname"><br />
          <label for="sname">Main Name / Surname:</label>
           <input type="text" id="sname" name="sname">
           <br />
           <br />
         <label for="title">Title:</label>
           <input type="text" id="title" name="title">
           <br />
           <br />
         <label for="pages">Pages / Duration / PEGI:</label>
           <input type="text" id="pages" name="pages">
           <br />
           <br />
          <label for="price">Price:</label>
           <input type="text" id="price" name="price">
           <br />
           <br /> 
           <input type="submit" value="Submit">
        </form> 
        ';
    }
}