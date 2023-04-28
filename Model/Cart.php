<?php


class Model_Cart extends Model_Core_Table
{
	
    protected $resourceClass = 'Model_Cart_Resource';
    protected $collectionClass= 'Model_Core_Table_Collection';

	public function getStatusText()
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues)){
            return $statues[$this->status];
        }
        return $statues[Model_Cart_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Cart_Resource::STATUS_DEFAULT;
    }

    public function getCustomers()
    {
        $sql = "SELECT `customer_id`,`first_name` FROM `customer`";
        return Ccc::getModel('Customer')->fetchAll($sql);
    }

    public function getCustomer($id)
    {
        if($id){
            $sql = "SELECT `customer_id`,`email`,`mobile` FROM `customer` WHERE `customer_id` = '{$id}'";
            $customer = Ccc::getModel('Customer')->fetchRow($sql);
            if($customer){
                return $customer;
            }
            return Ccc::getModel('Customer');
        }
        return Ccc::getModel('Customer');
    }

    public function getBillingAddress()
    {
        $customerId = Ccc::getModel('Core_Session')->get('customer_id');
        if($customerId){
            $address = Ccc::getModel('Customer')
                ->load($customerId);
            if($billingAddressId = $address->billing_address_id){
                return Ccc::getModel('Customer_Address')->load($billingAddressId);
            }
            return $address;
        }

        return Ccc::getModel('Customer');
    }

    public function getShippingAddress()
    {
        $customerId = Ccc::getModel('Core_Session')->get('customer_id');
        if($customerId){
            $address = Ccc::getModel('Customer')
                ->load($customerId);
            if($shippingAddressId = $address->shipping_address_id){
                return Ccc::getModel('Customer_Address')->load($shippingAddressId);
            }
            return $address;
        }

        return Ccc::getModel('Customer');
    }


}


?>