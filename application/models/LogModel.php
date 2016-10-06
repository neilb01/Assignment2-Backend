<?php

class TransactionLogs extends CI_Model {
        
        // Log information.
	var $data = array(
            array('spentPurchasing' => 0, 
                'earnedSales' => 0, 
                'ingredientsConsumed' => 
                    array('code' => 'fake', 'amount' => 0)),
            );

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}
        
        //Add a log entry to the data model.
        public function addLog($purchasingSpent, $salesEarned, $consumedIngredients) {
           $spentPurchasing = 0;
           $earnedSales = 0;
           $ingredientsConsumed = array();
           
           if (!is_null($spentPurchasing)) {
               $spentPurchasing = $purchasingSpent;
           }
           
           if (!is_null($earnedSales)) {
               $earnedSales = $salesEarned;
           }
           
           foreach ($consumedIngredients as $amount){
               array_push($ingredientsConsumed, $amount);
           }
           
           $data = array(
               'spentPurchasing' => $spentPurchasing,
               'earnedSales' => $earnedSales,
               'ingredientsConsumed' => $ingredientsConsumed
            );

            $this->db->insert($data);
        }

	// Retrieve the money spent on purchasing.
	public function RetrieveMoneySpentPurchasing()
	{
            $cost = 0;
            foreach($this->data as $log){
                $cost += $log['spentPurchasing'];
            }
            
            return $cost;
	}
        
        // Retrieve money earned in sales.
        public function RetrieveMoneyEarnedSales() 
        {
            $revenue = 0;
            
            foreach ($this->data as $log) {
                $revenue += $log['earnedSales'];
            }
            
            return $revenue;
        }
        
        //Retrieve the amount consumed of a specific ingredient.
        public function RetrieveConsumedIngredient($ingredient) {
            $consumedAmount = 0;
            
            foreach($this->data as $log){
                foreach ($log['ingredientsConsumed'] as $ingredients){
                    if ($ingredients['code'] == $ingredient) {
                        $consumedAmount += $ingredients['amount'];
                    }
                }
            }
            
            return $consumedAmount;
        }
}