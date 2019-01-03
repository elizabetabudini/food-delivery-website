<?php session_start();
class Cart {
    protected $carrello = array();

    public function __construct(){
        // get the shopping cart array from the session
        $this->carrello = !empty($_SESSION['carrello']) ? $_SESSION['carrello'] : NULL;
        if ($this->carrello === NULL){
            // set some base values
            $this->carrello = array('totale' => 0, 'numero_prodotti' => 0);
        }
    }

    /**
     * Cart Contents: Returns the entire cart array
     * @param    bool
     * @return    array
     */
    public function contents(){
        // rearrange the newest first
        $cart = array_reverse($this->carrello);

        // remove these so they don't create a problem when showing the cart table
        unset($cart['numero_prodotti']);
        unset($cart['totale']);

        return $cart;
    }

    /**
     * Get cart item: Returns a specific cart item details
     * @param    string    $row_id
     * @return    array
     */
    public function get_item($row_id){
        return (in_array($row_id, array('numero_prodotti', 'totale'), TRUE) OR ! isset($this->carrello[$row_id]))
            ? FALSE
            : $this->carrello[$row_id];
    }

    /**
     * Total Items: Returns the total item count
     * @return    int
     */
    public function total_items(){
        return $this->carrello['numero_prodotti'];
    }

    /**
     * Cart Total: Returns the total prezzo
     * @return    int
     */
    public function total(){
        return $this->carrello['totale'];
    }

    /**
     * Insert items into the cart and save it to the session
     * @param    array
     * @return    bool
     */
    public function insert($alimento = array()){
        if(!is_array($alimento) OR count($alimento) === 0){
            return FALSE;
        }else{
            if(!isset($alimento['id'], $alimento['nome'], $alimento['prezzo'], $alimento['quantità'])){
                return FALSE;
            }else{
                /*
                 * Insert Item
                 */
                // prep the quantity
                $alimento['quantità'] = (float) $alimento['quantità'];
                if($alimento['quantità'] == 0){
                    return FALSE;
                }
                // prep the prezzo
                $alimento['prezzo'] = (float) $alimento['prezzo'];
                // create a unique identifier for the item being inserted into the cart
                $rowid = md5($alimento['id']);
                // get quantity if it's already there and add it on
                $old_quantità = isset($this->carrello[$rowid]['quantità']) ? (int) $this->carrello[$rowid]['quantità'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $alimento['rowid'] = $rowid;
                $alimento['quantità'] += $old_quantità;
                $this->carrello[$rowid] = $alimento;

                // save Cart Item
                if($this->save_cart()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }

    /**
     * Update the cart
     * @param    array
     * @return    bool
     */
    public function update($alimento = array()){
        if (!is_array($alimento) OR count($alimento) === 0){
            return FALSE;
        }else{
            if (!isset($alimento['rowid'], $this->carrello[$alimento['rowid']])){
                return FALSE;
            }else{
                // prep the quantity
                if(isset($alimento['quantità'])){
                    $alimento['quantità'] = (float) $alimento['quantità'];
                    // remove the item from the cart, if quantity is zero
                    if ($alimento['quantità'] == 0){
                        unset($this->carrello[$alimento['rowid']]);
                        return TRUE;
                    }
                }

                // find updatable keys
                $keys = array_intersect(array_keys($this->carrello[$alimento['rowid']]), array_keys($alimento));
                // prep the prezzo
                if(isset($alimento['prezzo'])){
                    $alimento['prezzo'] = (float) $alimento['prezzo'];
                }
                // product id & nome shouldn't be changed
                foreach(array_diff($keys, array('id', 'nome')) as $key){
                    $this->carrello[$alimento['rowid']][$key] = $alimento[$key];
                }
                // save cart data
                $this->save_cart();
                return TRUE;
            }
        }
    }

    /**
     * Save the cart array to the session
     * @return    bool
     */
    protected function save_cart(){
        $this->carrello['numero_prodotti'] = $this->carrello['totale'] = 0;
        foreach ($this->carrello as $key => $val){
            // make sure the array contains the proper indexes
            if(!is_array($val) OR !isset($val['prezzo'], $val['quantità'])){
                continue;
            }

            $this->carrello['totale'] += ($val['prezzo'] * $val['quantità']);
            $this->carrello['numero_prodotti'] += $val['quantità'];
            $this->carrello[$key]['subtotale'] = ($this->carrello[$key]['prezzo'] * $this->carrello[$key]['quantità']);
        }

        // if cart empty, delete it from the session
        if(count($this->carrello) <= 2){
            unset($_SESSION['carrello']);
            return FALSE;
        }else{
            $_SESSION['carrello'] = $this->carrello;
            return TRUE;
        }
    }

    /**
     * Remove Item: Removes an item from the cart
     * @param    int
     * @return    bool
     */
     public function remove($row_id){
        // unset & save
        unset($this->carrello[$row_id]);
        $this->save_cart();
        return TRUE;
     }

    /**
     * Destroy the cart: Empties the cart and destroy the session
     * @return    void
     */
    public function destroy(){
        $this->carrello = array('totale' => 0, 'numero_prodotti' => 0);
        unset($_SESSION['carrello']);
    }
}
