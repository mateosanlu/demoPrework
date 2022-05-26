<?php

class transfersModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getClientAccounts($id_client){
        $datos = $this->_db->query("select * from accounts acc where acc.id_clients = '$id_client'");
        return $datos->fetchall();
    }

    public function getClientTransactions($id_client){
        $datos = $this->_db->query(
            "select ori.acc_nnumber as 'ori_nnumber', ori.acc_cname as 'ori_cname',
                    dest.acc_nnumber as 'dest_nnumber', dest.acc_cname as 'dest_cname',
                    tra.tra_nvalue, tra.tra_ddate, tra.id_transactions_status, tra.id_accounts_ori, tra.id_accounts_des
            from transactions tra 
            inner join accounts ori on ori.id = tra.id_accounts_ori
            inner join accounts dest on dest.id = tra.id_accounts_des
            where ori.id_clients = '$id_client' or dest.id_clients = '$id_client'
            and tra.id_transactions_status = 3");
        return $datos->fetchall();
    }

    public function getClientRegisteredAccounts($id_client){
        $datos = $this->_db->query(
            "select acc.id, acc.acc_nnumber, acc.acc_bstatus, rac.rac_cname, rac.rac_bstatus 
            from accounts acc 
            inner join reg_accounts rac on rac.id_accounts = acc.id
            where rac.id_clients = '$id_client'");
        return $datos->fetchall();
    }

    public function getbalance($id_account, $id_client)
    {
        $data = $this->_db->query(
                "select acc.acc_nbalance
                from accounts acc 
                where " .
                "acc.id = '$id_account' " .
                "and acc.id_clients = '$id_client'"
                );
        
        return $data->fetch()["acc_nbalance"];
    }

    public function setTransfer($id_account_origin, $id_account_destiny, $amount)
    {
        $sql = "insert into transactions (id, id_accounts_ori, id_accounts_des, tra_nvalue, tra_ddate, id_transactions_status) values (null, '$id_account_origin', '$id_account_destiny', '$amount', current_timestamp(), '1')";
        
        $this->_db->query($sql);

        $id_transaction = $this->_db->lastInsertId();

        if($id_transaction != 0){
            $this->updateBalanceAccount($id_account_origin, $amount*-1);
            $this->updateBalanceAccount($id_account_destiny, $amount);

            $this->updateTransferStatus($id_transaction, 3);
        }

        return $id_transaction;
    }

    public function updateBalanceAccount($id_account, $amount){
        
        $currentBalance = $this->_db->query("select acc_nbalance from accounts where id = '$id_account'");
        $currentBalance = $currentBalance->fetch()["acc_nbalance"];
        
        $datos = $this->_db->query("update accounts set acc_nbalance = '".($currentBalance+$amount)."' where id = '$id_account';");
    }

    public function updateTransferStatus($id, $status){
        
        $datos = $this->_db->query("update transactions set id_transactions_status = '$status' where id = '$id';");
    }
}

?>
