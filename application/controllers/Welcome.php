<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Homepage for our app
	 */
	public function index()
	{
		// this is the view we want shown
		$this->data['pagebody'] = 'homepage_view';

		// THIS IS AN EXAMPLE
		$source = $this->logs->all();
		$items = array ();
		foreach ($source as $record)
		{
			$items[] = array ('who' => $record['who'], 'pic' => $record['pic'], 'href' => $record['where'], 'what' => $record['what']);
		}
		$this->data['items'] = $items;
        // END OF EXAMPLE

        // build the list of recipes, to pass on to our homepage_view
        $recipe_source = $this->recipes->all();
        $recipes = array ();
        foreach ($recipe_source as $record)
        {
            $recipes[] = array ('id' => $record['id'],'name' => $record['name'], 'pic' => $record['pic'], 'href' => $record['where'], 'ingredients' => $record['ingredients'],'ingredientAmount' => count($record['ingredients'], COUNT_RECURSIVE));
        }
        $this->data['recipes'] = $recipes;

        // build the list of stocks, to pass on to our homepage_view
        $stock_source = $this->stock->all();
        $stocks = array ();
        $total_stock_price = array ();
        $total_stock_order = array ();
        foreach ($stock_source as $record)
        {
            $stocks[] = array ('id' => $record['id'],'name' => $record['name'], 'pic' => $record['pic'], 'href' => $record['where'], 'price' => $record['price'], 'order' => $record['order'],'description' => $record['description']);
            array_push($total_stock_price, $record['price']);
            array_push($total_stock_order, $record['order']);
        }
        $this->data['stocks'] = $stocks;
        $this->data['total_stock_price'] = array_sum($total_stock_price);
        $this->data['average_stock_price'] = array_sum($total_stock_price) / count($stocks);
        $this->data['total_stock_order'] = array_sum($total_stock_order);

        // build the list of supplies, to pass on to our homepage_view
        $supply_source = $this->supplies->all();
        $supplies = array ();
        $total_supply_quantities = array ();
        $total_supply_receivingCost = array ();
        $total_supply_receivingNo = array ();

        foreach ($supply_source as $record)
        {
            $supplies[] = array ('id' => $record['id'],'name' => $record['name'], 'href' => $record['where'],'receivingCost' => $record['receivingCost'],'quantities' => $record['quantities'], 'receivingUnit' => $record['receivingUnit'], 'receivingNo' => $record['receivingNo'],'description' => $record['description']);
            array_push($total_supply_quantities, $record['quantities']);
            array_push($total_supply_receivingCost, $record['receivingCost']);
            array_push($total_supply_receivingNo, $record['receivingNo']);
        }
        $this->data['supplies'] = $supplies;
        $this->data['total_supply_quantities'] = array_sum($total_supply_quantities);
        $this->data['total_supply_receivingCost'] = array_sum($total_supply_receivingCost);
        $this->data['average_supply_receivingCost'] = array_sum($total_supply_receivingCost) / count($supplies);
        $this->data['total_supply_receivingNo'] = array_sum($total_supply_receivingNo);


        $this->render();
	}

}