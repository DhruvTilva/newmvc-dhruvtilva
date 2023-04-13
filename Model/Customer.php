<?php


class Model_Customer extends Model_Core_Table
{
	protected $resourceClass = 'Model_Customer_Resource';
    protected $collectionClass= 'Model_Core_Table_Collection';
	public function getStatusText()
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Customer_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Customer_Resource::STATUS_DEFAULT;
    }


    public function getBillingAddress()     
    {
        if ($this->address_id) {
            $billingAdd= Ccc::getModel('CustomerAddress');
            $billingAdd->load($this->address_id);
            return $billingAdd;
        }
        else{
            return false;
        }
    }

    public function getShippingAddress()
    {
        if($this->address_id){
            $shippingAdd= Ccc::getModel('CustomerAddress');
            $shippingAdd->load($this->address_id);
            return $shippingAdd;
        }
        else{
            return false;
        }
        
    }

}


?>